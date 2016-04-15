<?php
class Admin_AdrequestController extends Zend_Controller_Action {

    public function requestAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $zoneId = trim($this->_request->getParam('id', null));
            $callbackName = trim($this->_request->getParam('callback', null));
            if (!isset($callbackName)) {

            }

            $suitBanners = array();
            $zoneData = Admin_Model_Zone::getZoneById($zoneId); // GET APPROVED ZONE !!!!!!!!!!!
            if (!empty($zoneData)) {

                $zoneFormat = $zoneData["ZoneFormat"];
                $zoneWidth = $zoneData["ZoneWidth"];
                $zoneHeight = $zoneData["ZoneHeight"];

                $bannersData = Admin_Model_Banner::getBannersByFormat($zoneFormat);
                if (!empty($bannersData)) {
                    foreach ($bannersData as $banner) {
                        if ($banner["BannerHeight"] == $zoneHeight && $banner["BannerWidth"] == $zoneWidth) {
                            array_push($suitBanners, $banner);
                        }
                    }

                    $suitBanner = $suitBanners[array_rand($suitBanners)];
                    $response = array(
                        'zoneId' => $zoneId,
                        'width' => $zoneWidth,
                        'height' => $zoneHeight,
                        'format' => $zoneFormat,
                        'banner' => array($suitBanner)
                    );
                    echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">' . $callbackName . ' && ' . $callbackName . '(' . json_encode($response) . ')' . '</pre>';
                }
            } else {
                echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">' . $callbackName . ' && ' . $callbackName . '(' . json_encode(array('INVALID' => true)) . ')' . '</pre>';
            }

        }
    }
}