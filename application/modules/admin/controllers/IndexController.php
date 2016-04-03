<?php
class Admin_IndexController extends Zend_Controller_Action{
    public function init(){
        $option=array(
            "layout" => "layout",
            "layoutPath" => APPLICATION_PATH."/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);

        $defaultNamespace = new Zend_Session_Namespace('ZSN');
        $ss = $defaultNamespace->initialized;
        $role = $defaultNamespace->user_role;

        if ($ss != "logged" && $role != 1) {
            $this->redirect(SITE_URL . '/auth/login');
        } else {
            $this->view->fullname = $defaultNamespace->activeUser['fullname'];
        }

    }
    public function indexAction(){
        $this->view->headTitle()->append(' admin ');
        $this->_helper->layout->setLayout('admin');
    }

    public function userAction(){
        $this->view->headTitle()->append('admin>>User');
        $this->_helper->layout->setLayout('admin');

        $result = Admin_Model_User::getUsers();
        echo '<pre>'; print_r($result);die;
    }

}