<?php
class Admin_IndexController extends Zend_Controller_Action{
    public function indexAction(){
        $this->view->headTitle()->append(' Admin ');
        $this->_helper->layout->setLayout('admin');
        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Admin_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];
            if (!isset($session) || $role == 2 || $role == 3) {
                $this->redirect(SITE_URL . '/auth/login');
            }

            $countClick = Admin_Model_Click::getClicksCount();
            $countImpression = Admin_Model_Impression::getImpressionsCount();
            $countTrueview = Admin_Model_Trueview::getTrueviewsCount();
            $countPendingBanners = Admin_Model_Banner::countPendingBanners();
            $countPendingZones = Admin_Model_Zone::countPendingZones();

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id,
                'clicks' => $countClick,
                'impressions' => $countImpression,
                'trueviews' => $countTrueview,
                'pendingBanners' => $countPendingBanners,
                'pendingZones' => $countPendingZones
            );

            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;
            $layout->pendingBanners = $countPendingBanners;
            $layout->pendingZones = $countPendingZones;

            $this->view->headScript()->appendFile(STATIC_URL . '/js/library/jquery.countTo.js');
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }

    public function userAction() {
        $this->view->headTitle()->append('admin>>User');
        $this->_helper->layout->setLayout('admin');

        $result = Admin_Model_User::getUsers();
    }

    public function bannerAction() {
        $this->view->headTitle()->append('admin>>Banner');
        $this->_helper->layout->setLayout('admin');
    }

    public function zoneAction() {
        $this->view->headTitle()->append('admin>>Zone');
        $this->_helper->layout->setLayout('admin');
    }

}