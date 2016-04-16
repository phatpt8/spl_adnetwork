<?php
class Admin_Model_Click {

    public static function getClicksCount()
    {
        return Admin_Business_Click::getClicksCount();
    }

    public static function insertClick($price, $url, $bid)
    {
        return Admin_Business_Click::insertClick($price, $url, $bid);
    }

    public static function getBannersClicksFromUser($id)
    {
        return Admin_Business_Click::getBannersClicksFromUser($id);
    }

}
