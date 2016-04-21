<?php
class Admin_AdrequestController extends Zend_Controller_Action {

    public function requestAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $zoneId = trim($this->_request->getParam('id', null));
            $callbackName = trim($this->_request->getParam('callback', null));
            if (!isset($callbackName)) {
                return;
            }

            $suitBanners = array();
            $zoneData = Admin_Model_Zone::getZoneById($zoneId);
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
                        'banners' => array($suitBanner)
                    );
                    echo $callbackName . ' && ' . $callbackName . '(' . json_encode($response) . ')';
                }
            } else {
                echo $callbackName . ' && ' . $callbackName . '(' . json_encode(array('INVALID' => true, 'ZONE_INACTIVE' => true)) . ')';
            }

        }
    }

    public function clickadAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $price = trim($this->_request->getParam('price', null));
            $url = trim($this->_request->getParam('url', null));
            $bannerId = trim($this->_request->getParam('bid', null));
            $zoneId = trim($this->_request->getParam('zid', null));
            $redirect = trim($this->_request->getParam('redirect', null));

            $result = Admin_Model_Click::insertClick($price, $url, $bannerId);
            if ($result > 0) {
                $ubid = Admin_Model_User::getUserByBannerId($bannerId);
                $minus = Admin_Model_User::updateBalance($ubid, intval("-" . $price));

                $uzid = Admin_Model_User::getUserByZoneId($zoneId);
                $plus = Admin_Model_User::updateBalance($uzid, intval($price) / 10);
            }

            $this->redirect($redirect);
        }
    }

    public function trueviewAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $zoneid = trim($this->_request->getParam('id', null));
            $bannerid = trim($this->_request->getParam('bid', null));
            $url = trim($this->_request->getParam('url', null));

            $result = Admin_Model_Trueview::insertTrueview($zoneid, $bannerid, $url);
        }
    }

    public function impressionAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $zoneid = trim($this->_request->getParam('id', null));
            $bannerid = trim($this->_request->getParam('bid', null));
            $url = trim($this->_request->getParam('url', null));

            $result = Admin_Model_Impression::insertImpression($zoneid, $bannerid, $url);
        }
    }
}