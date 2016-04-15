<?php
class Admin_Business_User {

    public static function getUserById($intUserId) {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT * FROM user WHERE UserId = :userId ');
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
            $stmt = $storage->query('SELECT * FROM user WHERE UserEmail= ? AND UserPassword= ?', array($strUserEmail, $strUserPassword));
            $arrResult = $stmt->fetch();
            $stmt->closeCursor();
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
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getUserByRole($intUserRole, $boolActive = 0) {
        if ($boolActive) {
            $prepare = 'SELECT * FROM user WHERE UserRole = :userRole AND UserStatus=1';
        } else {
            $prepare = 'SELECT * FROM user WHERE UserRole = :userRole';
        }

        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare($prepare);
            $stmt->bindParam('userRole', $intUserRole, PDO::PARAM_INT);
            $stmt->execute();
            $arrResult = $stmt->fetchAll();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $arrResult;
    }

    public static function getUsersExcept($intUserId) {
        $arrResult = array();
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->query('SELECT * FROM user WHERE UserId != ? AND UserRole != 11', array($intUserId));
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
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT COUNT(UserEmail) FROM user WHERE UserEmail=:email');
            $stmt->bindParam('email', $strUserEmail, PDO::PARAM_STR);
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function checkInfo($strUserName)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('SELECT COUNT(*) FROM user WHERE UserName=:name');
            $stmt->bindParam('name', $strUserName, PDO::PARAM_STR);
            $result = $stmt->fetchColumn(0);
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
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

    public static function updateUserPass($strUserId, $strUserPass)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE user SET UserPassword=:pass WHERE UserId=:userId');
            $stmt->bindParam('userId', $strUserId, PDO::PARAM_STR);
            $stmt->bindParam('pass', $strUserPass, PDO::PARAM_STR);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function updateUserInfo($intUserId, $strUserName, $strUserEmail, $strUserPhone)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE user SET UserName=:name, UserEmail=:mail, UserPhone=:phone WHERE UserId=:userId');
            $stmt->bindParam('name', $strUserName, PDO::PARAM_STR);
            $stmt->bindParam('mail', $strUserEmail, PDO::PARAM_STR);
            $stmt->bindParam('phone', $strUserPhone, PDO::PARAM_STR);
            $stmt->bindParam('userId', $intUserId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function updateBalance($intUserId, $plus)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE user SET UserBalance= (UserBalance + :plus) WHERE UserId=:userId');
            $stmt->bindParam('plus', $plus, PDO::PARAM_INT);
            $stmt->bindParam('userId', $intUserId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function updateUserRole($intUserId, $intUserRole)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE user SET UserRole=:role WHERE UserId=:userid');
            $stmt->bindParam('userid', $intUserId, PDO::PARAM_INT);
            $stmt->bindParam('role', $intUserRole, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }

    public static function updateUserStatus($intUserId, $intUserStatus)
    {
        $result = 0;
        try {
            $storage = Admin_Global::getDb('db', 'master');
            $stmt = $storage->prepare('UPDATE user SET UserStatus=:status WHERE UserId=:userId');
            $stmt->bindParam('userId', $intUserId, PDO::PARAM_INT);
            $stmt->bindParam('status', $intUserStatus, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            unset($stmt);
        } catch (Zend_Db_Exception $e) {
            Admin_Global::sendLog($e);
        }
        return $result;
    }
}