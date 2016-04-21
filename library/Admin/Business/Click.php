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
        return $result;
    }

    public static function getBannerClickCount($intBannerIds)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT COUNT(c.ClickId) as "Click", c.ClickUrl, b.BannerId FROM banner b, clickdetail c WHERE c.BannerId = b.BannerId AND c.BannerId IN (:bannerIds) GROUP BY b.BannerId');
            $stmt->bindParam('bannerIds', $intBannerIds, PDO::PARAM_STR);
            $stmt->execute();
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getBannersClicksFromUser($intUserId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(c.ClickId) FROM user u, clickdetail c, banner b WHERE u.UserID = ? AND u.UserRole = 3 AND u.UserId = b.UserId AND b.BannerId = c.BannerId', array($intUserId));
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function insertClick($intClickPrice, $strClickUrl, $intBannerId)
    {
        $intClickId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO clickdetail (ClickPrice, ClickUrl, BannerId) VALUES(?,?,?); SET @p_clickid = LAST_INSERT_ID()', array($intClickPrice, $strClickUrl, $intBannerId));
            $stmt->closeCursor();
            unset($stmt);
            $intClickId = $storage->query("SELECT @p_clickid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intClickId;
    }

}
