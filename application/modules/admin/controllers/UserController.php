<?php
class Admin_UserController extends Zend_Controller_Action{
    public function init(){
        $option=array(
            "layout" => "layout",
            "layoutPath" => APPLICATION_PATH."/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);

        $defaultNamespace = new Zend_Session_Namespace('ZSN');
        $ss = $defaultNamespace->initialized;
        $role = $defaultNamespace->activeRole;
        $fullname = $defaultNamespace->activeFullname;
        $this->view->fullname = $fullname;

        if ($ss != "logged" && $role != 1) {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }
    public function indexAction(){
        $this->view->headTitle()->append('admin>>User');
        $this->_helper->layout->setLayout('admin');

        $result = Admin_Model_User::getUsers();
        $this->view->userData = $result;
    }

}