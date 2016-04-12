<?php
class Admin_IndexController extends Zend_Controller_Action{
    public function indexAction(){
        $this->view->headTitle()->append(' admin ');
        $this->_helper->layout->setLayout('admin');
        $layout = $this->_helper->layout();

//        $option=array(
//            "layout" => "layout",
//            "layoutPath" => APPLICATION_PATH."/layouts/scripts/"
//        );
//        Zend_Layout::startMvc($option);

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $arr_session = $defaultNamespace->newsession;
            $condition = $arr_session['condition'];
            $role = $arr_session['activeRole'];
            $fullname = $arr_session['activeFullname'];
            $id = $arr_session['activeId'];

            if ($condition != "logged" && $role != 1) {
                $this->redirect(SITE_URL . '/auth/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->$layout->fullname = $fullname;
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