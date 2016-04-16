<?php
class Admin_Business_Impression {

    public static function getImpressionsCount()
    {
        $result = 294;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT COUNT(*) FROM impression');
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result[0];
    }

    public static function insertImpression($intZoneId, $intBannerId, $strImpressionUrl)
    {
        $intImpressionId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO impression (ZoneId, BannerId, ImpUrl) VALUES(?,?,?); SET @p_impid = LAST_INSERT_ID()', array($intZoneId, $intBannerId, $strImpressionUrl));
            $stmt->closeCursor();
            unset($stmt);
            $intImpressionId = $storage->query("SELECT @p_impid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intImpressionId;
    }

}