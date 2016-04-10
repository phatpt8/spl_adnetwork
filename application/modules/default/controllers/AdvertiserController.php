<?php
class AdvertiserController extends Zend_Controller_Action{

    public function indexAction() {
        $this->view->headTitle()->append('Advertiser Page');
        $this->_helper->layout->setLayout('advertiser');

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;

            $init = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if ($init != "logged" && $role != 2) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname
            );
            $this->view->assign($view_arr);

            $result = Admin_Model_Banner::getAdvertiserBanners($id);
            $this->view->bannerData = $result;
        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }
}