<?php
class Admin_Global{

    private static $_configs = array();

    private static $_db = array();

    public static function closeResource()
    {
        self::closeDb();
    }

    public static function closeDb()
    {
        //check empty
        if (!empty(self::$_db)) {
            //loop db ins to close
            foreach (self::$_db as $dbName => $db) {
                //check connected
                if ($db->isConnected()) {
                    $db->closeConnection();
                }
            }
        }
        self::$_db = array();
    }

    public static function getDb($strDbname, $strType = 'master', $server = 0)
    {
        $dbAdapter = Zend_Db::factory('Pdo_Mysql', array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'adnetwork'
        ));
        self::$_db["adnetwork"] = $dbAdapter;
//        //set key by $strType and $strDbname
//        $dbName = $strType . $strDbname . $server;
//        //print_r($dbName);echo '<br/>';die;
//        //check exists Db instance and Db instanceof Zend_Db_Adapter_Abstract
//        if (!array_key_exists($dbName, self::$_db) || !(($dbAdapter = self::$_db["$dbName"]) instanceof Zend_Db_Adapter_Abstract)) {
//            //get config database
//            $arrConf = self::getApplicationIni('db');
//
//            //check $strDbname && $strType isset config
//            if (null != ($arrConf = $arrConf["$strDbname"]["$strType"])) {
//
//                //set Zone
//                array_key_exists($server, $arrConf) && ($arrConf = $arrConf[$server]);
//                //construct Zend Db
//                $dbAdapter = Zend_Db::factory($arrConf['adapter'], $arrConf['params']);
//                //set instance to store db instance
//                self::$_db["$dbName"] = $dbAdapter;
//            } else {
//                //Exception $strDbname and $strType
//                throw new Exception("Db name $strDbname and type $strType not exists in config database.");
//            }
//        }
        return $dbAdapter;
    }

    public static function getApplicationIni($config_key = null)
    {
        $config = self::getConfig('application');
        //get config from Options of  Zend_Controller_Front
        //$config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOptions();
        //check section
        if ($config_key !== NULL) {
            //check key in config
            if (array_key_exists($config_key, $config)) {
                //return data config
                return $config["$config_key"];
            }
            return null;
        }
        //return data
        return $config;
    }

    public static function getConfig($filename, $type = 'ini')
    {
        //check instance by filename
        if (!isset(self::$_configs[$filename])) {
            $file = APPLICATION_PATH . '/' . 'configs' . '/' . $filename . '-' . APPLICATION_ENV . '.' . $type;

            //check extension apc
            if (extension_loaded('apc')) {
                //get cache apc and config by array
                if ((($config = apc_fetch($file)) === false) || !is_array($config)) {
                    //load file config by Zend_Config_Ini
                    if ($type == 'ini') {
                        $config = new Zend_Config_Ini($file);
                    } elseif ($type == 'json') {
                        $config = new Zend_Config_Json($file);
                    }
                    //conver to array
                    $config = $config->toArray();
                    //set to cache apc
                    apc_store($file, $config, 0);
                }
            } else {
                //load file config by Zend_Config_Ini
                if ($type == 'ini') {
                    $config = new Zend_Config_Ini($file);
                } elseif ($type == 'json') {
                    $config = new Zend_Config_Json($file);
                }
                //conver to array
                $config = $config->toArray();
            }
            //file is application then none instance
            if ($filename == 'application') {
                //retrun config
                return $config;
            }
            //set config to instance
            self::$_configs[$filename] = $config;
        }

        //retrun config
        return self::$_configs[$filename];
    }

    public static function sendLog($ex)
    {
        if (APPLICATION_ENV == 'development') {
            echo '<pre>';
            print_r($ex);
            die;
        } else {
            $arrTrace = (array)$ex->getTrace();
            //$arrTrace = isset($arrTrace[2]) ? $arrTrace[2] : $arrTrace;
            $logger = new Zend_Log(new Zend_Log_Writer_Stream(ROOT_PATH . '/logs/' . date('Ymd') . '_db.log'));
            $logger->info($ex->getMessage() . "\n" . json_encode($arrTrace));
            self::closeResource();
            throw new Exception($ex->getMessage(), 1);
        }
        //end if


    }
}