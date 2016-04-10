<?php
class Admin_IndexController extends Zend_Controller_Action{
    public function indexAction(){
        $option=array(
            "layout" => "layout",
            "layoutPath" => APPLICATION_PATH."/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $init = $defaultNamespace->initialized;
            $role = $defaultNamespace->activeRole;
            $fullname = $defaultNamespace->activeFullname;

            if ($init != "logged" && $role != 1) {
                $this->redirect(SITE_URL . '/auth/login');
            }

            $view_arr = array(
                'fullname' => $fullname
            );
            $this->view->assign($view_arr);

            $this->view->headTitle()->append(' admin ');
            $this->_helper->layout->setLayout('admin');
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }

    public function userAction(){
        $this->view->headTitle()->append('admin>>User');
        $this->_helper->layout->setLayout('admin');

        $result = Admin_Model_User::getUsers();
    }

}