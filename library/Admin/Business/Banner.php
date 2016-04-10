<?php
class Admin_Business_Banner {

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

    public static function getAdvertiserBanners($intUserId)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM banner WHERE UserId = :userId');
            $stmt->bindParam('userId', $intUserId, PDO::PARAM_INT);
            $stmt->execute();
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function createNewBanner($intUserId, $floatBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO banner (BannerPrice, BannerFormat, BannerWidth, BannerHeight, BannerMethod, BannerInfo, UserId) VALUES(?,?,?,?,?,?,?)', array( $floatBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo, $intUserId));
            $stmt->execute();
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function updateBannerInfo($intBannerId, $floatBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE banner SET BannerPrice=?,BannerFormat=?,BannerWidth=?,BannerHeight=?,BannerMethod=?,BannerInfo=? WHERE BannerId=?', array($floatBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo, $intBannerId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }

    public static function activateBanner($intBannerId)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE banner SET BannerStatus=2 WHERE BannerId=?', array($intBannerId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }

    public static function deactivateBanner($intBannerId)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE banner SET BannerStatus=0 WHERE BannerId=?', array($intBannerId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }


}