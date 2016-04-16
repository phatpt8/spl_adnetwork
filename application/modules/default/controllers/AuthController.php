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
            $userEmail = trim($this->_request->getParam('email', null));
            $userPass = trim($this->_request->getParam('password', null));
            if (trim($userEmail)==='' &&
                trim($userPass)==='') {
                $this->redirect(SITE_URL . '/auth/login?err=validation');
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

                if ($role == 1 || $role == 11) {
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