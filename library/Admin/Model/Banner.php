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

    public static function getBannerTrueviewAnalyze($intUserId)
    {
        return Admin_Business_Banner::getBannerTrueviewAnalyze($intUserId);
    }

    public static function countPendingBanners()
    {
        return Admin_Business_Banner::countPendingBanners();
    }

    public static function createNewBanner($userId, $price, $format, $width, $height, $method, $info)
    {
        return Admin_Business_Banner::createNewBanner($userId, $price, $format, $width, $height, $method, $info);
    }

    public static function updateBannerInfo($bannerId, $price, $format, $width, $height, $method, $info, $userId)
    {
        $checkUserId = "";
        if ($userId != 1 || $userId != 11) {
            $checkUserId = 'AND UserId=' . $userId;
        }
        return Admin_Business_Banner::updateBannerInfo($bannerId, $price, $format, $width, $height, $method, $info, $checkUserId);
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