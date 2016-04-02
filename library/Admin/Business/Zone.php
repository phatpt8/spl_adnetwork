<?php
class Business_Zone {

    public static function getZones()
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM zone');
            $stmt->execute();
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getActiveZones()
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM zone WHERE ZoneStatus=1');
            $stmt->execute();
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

}