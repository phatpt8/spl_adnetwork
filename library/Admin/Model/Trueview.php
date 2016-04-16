<?php
class Admin_Model_Trueview {

    public static function getTrueviewsCount()
    {
        return Admin_Business_Trueview::getTrueviewsCount();
    }

    public static function getBannersTrueviewsFromUser($userId)
    {
        return Admin_Business_Trueview::getBannersTrueviewsFromUser($userId);
    }

    public static function getZonesTrueviewsFromUser($userId)
    {
        return Admin_Business_Trueview::getZonesTrueviewsFromUser($userId);
    }

    public static function getZoneTrueviews($userId, $zoneId)
    {
        return Admin_Business_Trueview::getZoneTrueviews($userId, $zoneId);
    }

    public static function getBannerTrueviews($userId, $bannerId)
    {
        return Admin_Business_Trueview::getBannerTrueviews($userId, $bannerId);
    }
    public static function insertTrueview($zoneId, $bannerId, $url)
    {
        return Admin_Business_Trueview::insertTrueview($zoneId, $bannerId, $url);
    }
}
