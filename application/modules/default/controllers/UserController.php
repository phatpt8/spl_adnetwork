<?php
class UserController extends Zend_Controller_Action{

    public function loginAction() {
        $this->view->headTitle()->append('User Login');
        $this->_helper->layout->setLayout('login');
    }

    public function verifyAction() {
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

                if ($role == 2) {
                    $this->redirect(SITE_URL . '/publisher/index');
                } elseif ($role == 3) {
                    $this->redirect(SITE_URL . '/advertiser/index');
                } else {
                    $this->redirect(SITE_URL . '/user/login?err=unaccess');
                }
            } else {
                $this->redirect(SITE_URL . '/user/login?err=unaccess');
            }
        }
    }

    public static function forgotpassAction() {

    }

    public static function registerAction() {

    }
}