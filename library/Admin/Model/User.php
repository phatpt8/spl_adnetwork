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

    public static function getUsers()
    {
        return  Admin_Business_User::getUsers();
    }

    public static function getAdvPub()
    {
        return  Admin_Business_User::getAdvPub();
    }

    public static function getUserByRole($role, $active = 0)
    {
        return  Admin_Business_User::getUserByRole($role, $active);
    }

    public static function setNewUser($name, $email, $phone, $pass, $role)
    {
        return  Admin_Business_User::setNewUser($name, $email, $phone, $pass, $role);
    }

    public static function updateUserInfo($id, $name, $email, $phone)
    {
        return  Admin_Business_User::updateUserInfo($id, $name, $email, $phone);
    }

    public static function updateBalance($id, $plus)
    {
        if (filter_var($plus, FILTER_VALIDATE_FLOAT))
        {
            return  Admin_Business_User::updateBalance($id, $plus);
        }
        return null;
    }

    public static function setAdminUser($id)
    {
        return  Admin_Business_User::setAdminUser($id);
    }

    public static function unsetAdminUser($id)
    {
        return  Admin_Business_User::unsetAdminUser($id);
    }

    public static function activateUser($id)
    {
        return  Admin_Business_User::activateUser($id);
    }

    public static function deactivateUser($id)
    {
        return  Admin_Business_User::deactivateUser($id);
    }

}