<?php
class Admin_Business_Trueview {

    public static function getTrueviewsCount()
    {
        $result = 134;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(*) FROM trueview');
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function getBannersTrueviewsFromUser($intUserId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(t.TrueviewId) FROM user u, trueview t, banner b WHERE u.UserID = ? AND u.UserRole = 3 AND u.UserId = b.UserId AND b.BannerId = t.BannerId', array($intUserId));
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function getBannerTrueviews($intUserId, $intBannerId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(t.TrueviewId) FROM user u, trueview t, banner b WHERE u.UserID = ? AND u.UserRole = 3 AND u.UserId = b.UserId AND b.BannerId = t.BannerId AND b.BannerId = ?', array($intUserId, $intBannerId));
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function getZonesTrueviewsFromUser($intUserId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(t.TrueviewId) FROM user u, trueview t, zone z WHERE u.UserID = ? AND u.UserRole = 2 AND u.UserId = z.UserId AND z.ZoneId = t.ZoneId', array($intUserId));
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function getZoneTrueviews($intUserId, $intZoneId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(t.TrueviewId) FROM user u, trueview t, zone z WHERE u.UserID = ? AND u.UserRole = 2 AND u.UserId = z.UserId AND z.ZoneId = t.ZoneId AND z.ZoneId = ?', array($intUserId, $intZoneId));
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function insertTrueview($intZoneId, $intBannerId, $strTrueviewUrl)
    {
        $intTrueviewId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO trueview (ZoneId, BannerId, TrueviewUrl) VALUES(?,?,?); SET @p_trueviewid = LAST_INSERT_ID()', array($intZoneId, $intBannerId, $strTrueviewUrl));
            $stmt->closeCursor();
            unset($stmt);
            $intTrueviewId = $storage->query("SELECT @p_trueviewid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intTrueviewId;
    }


}
