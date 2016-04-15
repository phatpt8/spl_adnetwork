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

    public static function getClicksFromBanner($intBannerId)
    {

    }

    public static function insertNewClick($intClickPrice, $strClickUrl, $intBannerId)
    {
        $intUserId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO clickdetail (ClickPrice, ClickUrl, BannerId) VALUES(?,?,?); SET @p_clickid = LAST_INSERT_ID()', array($intClickPrice, $strClickUrl, $intBannerId));
            $stmt->closeCursor();
            unset($stmt);
            $intUserId = $storage->query("SELECT @p_clickid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intUserId;
    }

}
