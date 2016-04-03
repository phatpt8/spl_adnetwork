<?php
class AuthController extends Zend_Controller_Action{

    public function indexAction(){
        if (isset($this->view->user['user_id']) && $this->view->user['user_id'] > 0) {
//            $this->_redirect(SITE_URL);
            // co userId
            echo 'CCoo';
            echo SITE_URL;die;
        } else {
            // ko co userId
            echo 'ko co';
            echo SITE_URL;die;
//            $this->_forward('login', 'user');
        }
    }

    public function loginAction(){
        $this->view->headTitle()->append('Login');
        $this->_helper->layout->setLayout('login');
    }

    public function verifyAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isPost()){
//            $autologin = trim($this->_request->getParam('autologin', null));
            $userEmail = trim($this->_request->getParam('email', null));
            $userPass = trim($this->_request->getParam('password', null));
            $result = Admin_Model_User::getUserByEmailandPassword($userEmail, $userPass);
            if (!empty($result)) {
                $status = $result["UserStatus"];
                $role = $result["UserRole"];
                $fullname = $result["UserName"];

                if ($status == 0) {
                    echo 'User inactive';
                    return;
                }

                $defaultNamespace = new Zend_Session_Namespace('ZSN');
                if (!isset($defaultNamespace->initialized) && $autologin) {
                    $defaultNamespace->initialized = "logged";
                    $defaultNamespace->activeRole = $role;
                    $defaultNamespace->activeFullname = $fullname;
                    $defaultNamespace->setExpirationSeconds(9000);
                }

                if ($role == 1) {
                    $this->redirect(SITE_URL . '/admin/index');
                } elseif ($role == 2) {
                    $this->redirect(SITE_URL . '/publisher/index');
                } elseif ($role == 3) {
                    $this->redirect(SITE_URL . '/advertiser/index');
                }
            } else {
                $this->redirect(SITE_URL . '/auth/login?err=unaccess');
            }
        }
//        $redirect = $this->_request->getParam('redirect', null);
//        $redirect = str_replace(SITE_URL.'/?redirect=','',$redirect);
//        $this->redirect(SITE_URL . '/admin/index');

    }

    public function logoutAction() {
        Zend_Session::destroy();
        $this->redirect('/auth/login');
    }

}