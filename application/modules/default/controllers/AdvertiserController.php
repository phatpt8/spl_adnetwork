<?php
class AdvertiserController extends Zend_Controller_Action{

    public function indexAction() {
        $defaultNamespace = new Zend_Session_Namespace('ZSN');
        $ss = $defaultNamespace->initialized;
        $role = $defaultNamespace->activeRole;
        $fullname = $defaultNamespace->activeFullname;
        $this->view->fullname = $fullname;

        if ($ss != "logged" && $role != 3) {
            $this->redirect(SITE_URL . '/auth/login');
        }

        $this->view->headTitle()->append('Advertiser Page');
        $this->_helper->layout->setLayout('advertiser');
    }

    public function createAction() {
        $this->view->headTitle()->append('Advertiser Page');
        $this->_helper->layout->setLayout('advertiser');
    }
}