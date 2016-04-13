<?php
class Admin_Business_Click {

    public static function getClicksCount()
    {
        $result = 67;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(*) FROM clickdetail');
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result[0];
    }
}
