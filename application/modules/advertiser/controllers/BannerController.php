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

            if ($condition != "logged" && $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;



        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }
}