<?php
class Admin_Model_Impression {

    public static function getImpressionsCount()
    {
        return Admin_Business_Impression::getImpressionsCount();
    }

    public static function insertImpression($zoneId, $bannerId, $url)
    {
        return Admin_Business_Impression::insertImpression($zoneId, $bannerId, $url);
    }

}