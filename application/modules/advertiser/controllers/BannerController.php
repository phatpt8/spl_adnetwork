<?php
class Advertiser_BannerController extends Zend_Controller_Action{
    public function addAction() {
        $this->view->headTitle()->append('Advertiser Page');
        $this->_helper->layout->setLayout('advertiser');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $condition != "logged" && $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            if ($this->_request->isPost()) {
                $title = trim(strip_tags($this->_request->getParam('title', null)));
                $image = trim(strip_tags($this->_request->getParam('image', null)));
                $clickUrl = trim(strip_tags($this->_request->getParam('clickUrl', null)));
                $format = trim(strip_tags($this->_request->getParam('format', null)));
                $price = trim(strip_tags($this->_request->getParam('price', null)));
                $placement = trim(strip_tags($this->_request->getParam('placement', null)));
                $method = trim(strip_tags($this->_request->getParam('method', null)));
                list($width, $height) = explode('x',$placement);
                $info = array(
                    'title' => $title,
                    'file' => $image,
                    'url' => $clickUrl
                );
                $strInfo = json_encode($info);

                $result = Admin_Model_Banner::createNewBanner($id, $price, $format, $width, $height, $method, $strInfo);
                if ($result) {
                    $this->redirect(SITE_URL . '/advertiser/index');
                } else {
                    $this->redirect(SITE_URL . '/advertiser/index?err=addfailed');
                }
            }



        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }

    public function editAction() {
        $this->view->headTitle()->append('Edit Banner');
        $this->_helper->layout->setLayout('advertiser');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            if ($this->_request->isGet()) {
                $val = $this->_request->getParams();
                $this->view->assign(array(
                    'editBanner' => $val
                ));

            }
            if ($this->_request->isPost()) {
                $bannerId = trim(strip_tags($this->_request->getParam('id', null)));
                $title = trim(strip_tags($this->_request->getParam('title', null)));
                $image = trim(strip_tags($this->_request->getParam('image', null)));
                $clickUrl = trim(strip_tags($this->_request->getParam('clickUrl', null)));
                $format = trim(strip_tags($this->_request->getParam('format', null)));
                $price = trim(strip_tags($this->_request->getParam('price', null)));
                $placement = trim(strip_tags($this->_request->getParam('placement', null)));
                $method = trim(strip_tags($this->_request->getParam('method', null)));
                list($width, $height) = explode('x',$placement);
                $info = array(
                    'title' => $title,
                    'file' => $image,
                    'url' => $clickUrl
                );
                $strInfo = json_encode($info);

                $result = Admin_Model_Banner::updateBannerInfo($bannerId, $price, $format, $width, $height, $method, $strInfo, $id);
                if ($result == "1") {
                    $this->redirect(SITE_URL . '/advertiser/index?console=editsuccess');
                } else {
                    $this->redirect(SITE_URL . '/advertiser/index?err=editfailed');
                }

            }



        } else {
            $this->redirect(SITE_URL . '/user/login');
        }


    }

    public function updatestatusAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $bannerid = trim($this->_request->getParam('id', null));
            $status = trim($this->_request->getParam('status', null));
            $result = Admin_Model_Banner::updateBannerStatus($bannerid, $status);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/advertiser/banner');
            } else {
                $this->redirect(SITE_URL . '/advertiser/banner?err=updatestatusFailed');
            }
        }
    }

    public function analyzeAction() {
        $this->view->headTitle()->append('Edit Banner');
        $this->_helper->layout->setLayout('advertiser');


    }
}