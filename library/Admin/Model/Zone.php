<?php
class Admin_Model_Zone {

    public static function getZones()
    {
        return Admin_Business_Zone::getZones();
    }

    public static function getPublisherZones($userId)
    {
        return Admin_Business_Zone::getPublisherZones($userId);
    }

    public static function createNewZone($userId, $width, $height, $name, $format)
    {
        return Admin_Business_Zone::createNewZone($userId, $width, $height, $name, $format);
    }

    public static function updateZoneInfo($id, $width, $height, $name, $format)
    {
        return Admin_Business_Zone::updateZoneInfo($id, $width, $height, $name, $format);
    }

    public static function updateZoneStatus($id, $status)
    {
        return Admin_Business_Zone::updateZoneStatus($id, $status);
    }

    public static function deactivateZone($id)
    {
        return Admin_Business_Zone::deactivateZone($id);
    }

    public static function getZoneById($id)
    {
        return Admin_Business_Zone::getZoneById($id);
    }
}