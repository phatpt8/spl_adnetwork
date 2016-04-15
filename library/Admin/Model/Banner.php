<?php
class Admin_Model_Banner {

    public static function getBanners()
    {
        return  Admin_Business_Banner::getBanners();
    }

    public static function getAdvertiserBanners($id)
    {
        return Admin_Business_Banner::getAdvertiserBanners($id);
    }

    public static function createNewBanner($userId, $price, $format, $width, $height, $method, $info)
    {
        return Admin_Business_Banner::createNewBanner($userId, $price, $format, $width, $height, $method, $info);
    }

    public static function updateBannerInfo($bannerId, $price, $format, $width, $height, $method, $info)
    {
        return Admin_Business_Banner::updateBannerInfo($bannerId, $price, $format, $width, $height, $method, $info);
    }

    public static function updateBannerStatus($bannerId, $bannerStatus)
    {
        return Admin_Business_Banner::updateBannerStatus($bannerId, $bannerStatus);
    }

    public static function getBannersByFormat($format)
    {
        return Admin_Business_Banner::getBannersByFormat($format);
    }
}