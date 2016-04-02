<?php
class Business_Banner {

    public static function getBanners()
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM banner');
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