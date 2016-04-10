<?php
class AuthController extends Zend_Controller_Action{

    public function indexAction(){

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
                $userid = $result["UserId"];

                if ($status == 0) {
                    echo 'User inactive';
                    return;
                }

                $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
                if (!isset($defaultNamespace->initialized)) {
                    $defaultNamespace->initialized = "logged";
                    $defaultNamespace->activeId = $userid;
                    $defaultNamespace->activeRole = $role;
                    $defaultNamespace->activeFullname = $fullname;
                    $defaultNamespace->setExpirationSeconds(9000);
                }

                if ($role == 1) {
                    $this->redirect(SITE_URL . '/admin/index');
                } else {
                    $this->redirect(SITE_URL . '/auth/login?err=unaccess');
                }

            } else {
                $this->redirect(SITE_URL . '/auth/login?err=unaccess');
            }
        }
    }

    public function logoutAction() {
        Zend_Session::destroy();
        $this->redirect('/auth/login');
    }

}