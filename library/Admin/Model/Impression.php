<?php
class Admin_Model_Impression {

    public static function getImpressionsCount()
    {
        return Admin_Business_Impression::getImpressionsCount();
    }
}