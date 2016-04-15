<?php
class Admin_Model_Click {

    public static function getClicksCount()
    {
        return Admin_Business_Click::getClicksCount();
    }

    public static function insertNewClick($price, $url, $bid)
    {
        return Admin_Business_Click::insertNewClick($price, $url, $bid);
    }

}
