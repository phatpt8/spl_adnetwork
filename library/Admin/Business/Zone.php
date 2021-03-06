<?php
class Admin_Business_Zone {

    public static function getZones()
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT z.ZoneId, u.UserName, u.UserEmail,z.ZoneName, z.ZoneWidth, z.ZoneHeight, z.ZoneFormat, z.ZoneStatus FROM zone z, user u WHERE z.UserId = u.UserId');
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getPublisherZones($intUserId)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT * FROM zone WHERE UserId = :userId');
            $stmt->bindParam('userId', $intUserId, PDO::PARAM_INT);
            $stmt->execute();
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getZoneAnalyze($intUserId)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT z.ZoneId, z.ZoneWidth, z.ZoneHeight, z.ZoneFormat, z.ZoneCreateTimestamp, z.ZoneName, COUNT(i.ImpId) as "Impression" FROM zone z, impression i WHERE z.ZoneId = i.ZoneId AND z.UserId = :userId');
            $stmt->bindParam('userId', $intUserId, PDO::PARAM_INT);
            $stmt->execute();
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function countPendingZones()
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(*) FROM zone WHERE ZoneStatus=1');
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function createNewZone($intUserId, $intZoneWidth, $intZoneHeight, $strZoneName, $intZoneFormat)
    {
        $intBannerId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO zone (ZoneWidth, ZoneHeight, ZoneName, ZoneFormat, UserId) VALUES(?,?,?,?,?); SET @p_zoneid = LAST_INSERT_ID()', array( $intZoneWidth, $intZoneHeight, $strZoneName, $intZoneFormat, $intUserId ));
            $stmt->closeCursor();
            unset($stmt);
            $intBannerId = $storage->query("SELECT @p_zoneid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intBannerId;
    }

    public static function updateZoneInfo($intZoneId, $intZoneWidth, $intZoneHeight, $strZoneName, $intZoneFormat, $checkUserId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE zone SET ZoneWidth=:width,ZoneHeight=:height,ZoneName=:zname,ZoneFormat=:format, ZoneStatus=1 WHERE ZoneId=:zoneId ' . $checkUserId);
            $stmt->bindParam('width', $intZoneWidth, PDO::PARAM_INT);
            $stmt->bindParam('height', $intZoneHeight, PDO::PARAM_INT);
            $stmt->bindParam('zname', $strZoneName, PDO::PARAM_STR);
            $stmt->bindParam('format', $intZoneFormat, PDO::PARAM_INT);
            $stmt->bindParam('zoneId', $intZoneId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function updateZoneStatus($intZoneId, $intZoneStatus)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE zone SET ZoneStatus=:status WHERE ZoneId=:zoneId');
            $stmt->bindParam('zoneId', $intZoneId, PDO::PARAM_INT);
            $stmt->bindParam('status', $intZoneStatus, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function getZoneById($intZoneId)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT * FROM zone WHERE ZoneId = :zoneId AND ZoneStatus = 2');
            $stmt->bindParam('zoneId', $intZoneId, PDO::PARAM_INT);
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