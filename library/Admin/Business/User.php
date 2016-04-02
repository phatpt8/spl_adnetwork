<?php
class Admin_Business_User {

    public static function getUserById($intUserId) {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM user WHERE UserId = :userId ');
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

    public static function getUserByEmailandPassword($strUserEmail, $strUserPassword) {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $arrResult = $storage->fetchRow('SELECT * FROM user WHERE UserEmail= ? AND UserPassword= ?', array($strUserEmail, $strUserPassword));
            unset($storage);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getAdvPub() {
        // user status = 1 - dang cho duyet - dev => cho active

        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM user WHERE UserRole = 2 AND UserRole = 3');
            $stmt->execute();
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getUserByRole($intUserRole, $boolActive = 0) {
        if ($boolActive) {
            $query = 'SELECT * FROM user WHERE UserRole = :userRole AND UserStatus=1';
        } else {
            $query = 'SELECT * FROM user WHERE UserRole = :userRole';
        }

        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query($query);
            $stmt->bindParam('userRole', $intUserRole, PDO::PARAM_INT);
            $stmt->execute();
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getUsers() {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM user');
            $stmt->execute();
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }
}