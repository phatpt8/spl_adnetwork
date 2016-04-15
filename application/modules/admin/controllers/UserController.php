<?php
class Admin_UserController extends Zend_Controller_Action{

    public function indexAction(){
        $this->view->headTitle()->append(' Admin>>User ');
        $this->_helper->layout->setLayout('admin');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if ($condition != "logged" && ($role == 2 || $role == 3)) {
                $this->redirect(SITE_URL . '/auth/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id,
                'role' => $role
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            $result = Admin_Model_User::getUsersExcept($id);
            $this->view->userData = $result;
//            echo '<pre>';print_r($result);die;
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }

    public function updatestatusAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $userId = trim($this->_request->getParam('id', null));
            $status = trim($this->_request->getParam('status', null));
            $result = Admin_Model_User::updateUserStatus($userId, $status);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/admin/user');
            } else {
                $this->redirect(SITE_URL . '/admin/user?err=updatestatusFailed');
            }
        }
    }

    public function updateroleAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $userId = trim($this->_request->getParam('id', null));
            $role = trim($this->_request->getParam('role', null));
            $result = Admin_Model_User::updateUserRole($userId, $role);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/admin/user');
            } else {
                $this->redirect(SITE_URL . '/admin/user?err=updatestatusFailed');
            }
        }
    }

}