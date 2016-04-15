<?php
class Admin_Model_User {
    public static function getUserById($id)
    {
        return Admin_Business_User::getUserById($id);
    }

    public static function getUserByEmailandPassword($email, $pass)
    {
        return Admin_Business_User::getUserByEmailandPassword($email, $pass);
    }

    public static function getActiveUserByRole($role)
    {
        return Admin_Business_User::getActiveUserByRole($role);
    }

    public static function getUsersExcept($id)
    {
        return  Admin_Business_User::getUsersExcept($id);
    }

    public static function getAdvPub()
    {
        return  Admin_Business_User::getAdvPub();
    }

    public static function getUserByRole($role, $active = 0)
    {
        return  Admin_Business_User::getUserByRole($role, $active);
    }

    public static function checkEmail($email)
    {
        return Admin_Business_User::checkEmail($email);
    }

    public static function checkInfo($name)
    {
        return Admin_Business_User::checkInfo($name);
    }

    public static function setNewUser($name, $email, $phone, $pass, $role)
    {
        return  Admin_Business_User::setNewUser($name, $email, $phone, $pass, $role);
    }

    public static function updateUserPass($userId, $newpass)
    {
        return  Admin_Business_User::updateUserPass($userId, $newpass);
    }

    public static function updateUserInfo($id, $name, $email, $phone)
    {
        return  Admin_Business_User::updateUserInfo($id, $name, $email, $phone);
    }

    public static function updateUserRole($id, $role)
    {
        return  Admin_Business_User::updateUserRole($id, $role);
    }

    public static function updateUserStatus($id, $status)
    {
        return  Admin_Business_User::updateUserStatus($id, $status);
    }

    public static function updateBalance($id, $plus)
    {
        if (filter_var($plus, FILTER_VALIDATE_INT))
        {
            return  Admin_Business_User::updateBalance($id, $plus);
        }
        return null;
    }

}