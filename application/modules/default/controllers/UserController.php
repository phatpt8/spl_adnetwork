<?php
class UserController extends Zend_Controller_Action{

    public function indexAction() {
        $this->redirect(SITE_URL . '/index');
    }

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
            if (trim($userEmail)==='' &&
                trim($userPass)==='') {
                $this->redirect(SITE_URL . '/user/login?err=validation');
            }
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
                unset($defaultNamespace->newsession);
                $arrSession = array(
                    'condition' => 'logged',
                    'activeId' => $userid,
                    'activeRole' => $role,
                    'activeFullname' => $fullname
                );
                $defaultNamespace->newsession = $arrSession;
                $defaultNamespace->setExpirationSeconds(9000);

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
        $this->view->headTitle()->append('Reset Password');
        $this->_helper->layout->setLayout('login');
        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session)) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            if ($this->_request->isPost()) {
                $name = trim(strip_tags($this->_request->getParam('name', null)));
                $email = trim(strip_tags($this->_request->getParam('email', null)));
                $newpass = trim(strip_tags($this->_request->getParam('newpass', null)));
                $confirmpass = trim(strip_tags($this->_request->getParam('confirmPassword', null)));
                if (trim($name)==='' &&
                    trim($email)==='' &&
                    trim($newpass)==='' &&
                    trim($confirmpass)==='' &&
                    trim($role)==='') {
                    return false;
                }

                if (trim($newpass) != trim($confirmpass)) {
                    $this->redirect(SITE_URL . '/user/forgotpass?status=confirmFailed');
                } else {
                    $canChangePass = false;
                    $hasEmail = Admin_Model_User::checkEmail($email);
                    if ($hasEmail > 0) {
                        $hasInfo = Admin_Model_User::checkInfo($name);
                        if ($hasInfo > 0) {
                            $canChangePass = true;
                        }
                    }

                    if ($canChangePass) {
                        $result = Admin_Model_User::updateUserPass($email, $newpass);
                        if ($result) {
                            $this->redirect(SITE_URL . '/user/login?status=updatepasssuccess');
                        } else {
                            $this->redirect(SITE_URL . '/user/login?status=updatepassfailed');
                        }
                    }
                }
            }
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }

    public function registerAction() {
        $this->view->headTitle()->append('Register Account');
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
            if ($hasEmail > 0 ||
                trim($name)==='' &&
                trim($email)==='' &&
                trim($phone)==='' &&
                trim($pass)==='' &&
                trim($role)==='') {
                return false;
            }

            $result = Admin_Model_User::setNewUser($name, $email, $phone, $pass, $role);
            if ($result) {
                $this->redirect(SITE_URL . '/user/login?status=registersuccess');
            } else {
                $this->redirect(SITE_URL . '/user/login?status=registerfailed');
            }
        }
    }

    public function updateinfoAction() {
        $this->view->headTitle()->append('Update Account info');
        $this->_helper->layout->setLayout('login');

        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role = $session["activeRole"];
            $fullname = $session["activeFullname"];
            $id = $session["activeId"];

            if (!isset($session)) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

        }
    }
}