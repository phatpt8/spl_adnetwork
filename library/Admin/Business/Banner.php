<?php
class Admin_Business_Banner {

    public static function getBanners()
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT b.BannerId, u.UserName, u.UserEmail, b.BannerWidth, b.BannerHeight,b.BannerPrice, b.BannerFormat, b.BannerMethod, b.BannerInfo, b.BannerStatus FROM banner b, user u WHERE b.UserId = u.UserId');
            $arrResult = $stmt->fetchAll();
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
            $stmt = $storage->prepare('SELECT * FROM banner WHERE UserId = :userId');
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

    public static function createNewBanner($intUserId, $intBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo)
    {
        $intBannerId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO banner (BannerPrice, BannerFormat, BannerWidth, BannerHeight, BannerMethod, BannerInfo, UserId) VALUES(?,?,?,?,?,?,?); SET @p_bannerid = LAST_INSERT_ID()', array( $intBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo, $intUserId));
            $stmt->closeCursor();
            unset($stmt);
            $intBannerId = $storage->query("SELECT @p_bannerid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intBannerId;
    }

    public static function updateBannerInfo($intBannerId, $intBannerPrice, $intBannerFormat, $intBannerWidth, $intBannerHeight, $intBannerMethod, $strBannerInfo)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE banner SET BannerPrice=:price,BannerFormat=:format,BannerWidth=:width,BannerHeight=:height,BannerMethod=:method,BannerInfo=:info WHERE BannerId=:bannerId');
            $stmt->bindParam('price', $intBannerPrice, PDO::PARAM_INT);
            $stmt->bindParam('format', $intBannerFormat, PDO::PARAM_INT);
            $stmt->bindParam('width', $intBannerWidth, PDO::PARAM_INT);
            $stmt->bindParam('height', $intBannerHeight, PDO::PARAM_INT);
            $stmt->bindParam('method', $intBannerMethod, PDO::PARAM_INT);
            $stmt->bindParam('info', $strBannerInfo, PDO::PARAM_STR);
            $stmt->bindParam('bannerId', $intBannerId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function activateBanner($intBannerId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE banner SET BannerStatus=2 WHERE BannerId=:bannerId');
            $stmt->bindParam('bannerId', $intBannerId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function deactivateBanner($intBannerId)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE banner SET BannerStatus=0 WHERE BannerId=:bannerId');
            $stmt->bindParam('bannerId', $intBannerId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }


}