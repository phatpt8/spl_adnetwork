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

    public static function checkEmail($strUserEmail)
    {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT UserEmail FROM user WHERE UserEmail=?', array($strUserEmail));
            $stmt->execute();
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function setNewUser($strUserName, $strUserEmail, $strUserPhone, $strUserPassword, $intUserRole)
    {
        $intUserId = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('INSERT INTO user (UserName, UserEmail, UserPhone, UserPassword, UserRole) VALUES(?,?,?,?,?); SET @p_userid = LAST_INSERT_ID()', array($strUserName, $strUserEmail, $strUserPhone, $strUserPassword, $intUserRole));
            $stmt->closeCursor();
            unset($stmt);
            $intUserId = $storage->query("SELECT @p_userid")->fetchColumn();
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $intUserId;
    }

    public static function updateUserInfo($intUserId, $strUserName, $strUserEmail, $strUserPhone)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE user SET UserName=?, UserEmail=?, UserPhone=? WHERE UserId=?', array($strUserName, $strUserEmail, $strUserPhone, $intUserId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }

    public static function updateBalance($intUserId, $plus)
    {
        // get balance first then add plus
        // add plus:
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE user SET UserBalance= (UserBalance + ?) WHERE UserId=?', array($plus, $intUserId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }

    public static function setAdminUser($intUserId)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE user SET UserRole=1 WHERE UserId=?', array($intUserId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }

//    public static function unsetAdminUser($intUserId)
//    {
//
//    }

    public static function activateUser($intUserId)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE user SET UserStatus=2 WHERE UserId=?', array($intUserId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }

    public static function deactivateUser($intUserId)
    {
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('UPDATE user SET UserStatus=0 WHERE UserId=?', array($intUserId));
            $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
    }
}