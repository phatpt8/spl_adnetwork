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
                if (!isset($defaultNamespace->newsession)) {
                    $arrSession = array(
                        'condition' => 'logged',
                        'activeId' => $userid,
                        'activeRole' => $role,
                        'activeFullname' => $fullname
                    );
                    $defaultNamespace->newsession = $arrSession;
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

    public function logoutAction() {
        Zend_Session::destroy();
        $this->redirect('/user/login');
    }

    public function forgotpassAction() {

    }

    public function registerAction() {
        $this->_helper->layout->setLayout('login');
//        $this->_helper->layout->disableLayout();
//        $this->_helper->viewRenderer->setNoRender();
        if ($this->_request->isPost()) {
            $name = trim(strip_tags($this->_request->getParam('fullname', null)));
            $email = trim(strip_tags($this->_request->getParam('email', null)));
            $phone = trim(strip_tags($this->_request->getParam('phone', null)));
            $pass = trim(strip_tags($this->_request->getParam('password', null)));
            $role = trim(strip_tags($this->_request->getParam('userRole', null)));
            $hasEmail = Admin_Model_User::checkEmail($email);
            if (count($hasEmail)) {
                echo 'email used!!';
                return;
            }

            $result = Admin_Model_User::setNewUser($name, $email, $phone, $pass, $role);
            if ($result) {
                $this->redirect(SITE_URL . '/user/login?status=registersuccess');
            }
        }
    }
}