<?php
class UserController extends Zend_Controller_Action{

    public function loginAction() {
        $this->view->headTitle()->append('User Login');
    }

    public function verifyAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

//        if ($this->_request->isPost()) {
//            $arrParams = $this->_request->getParams();
//
//            $redirect = ($arrParams['choice'] == 1) ? SITE_URL . '/advertiser' : SITE_URL . '/publisher';
//
//            $this->_redirect($redirect);
//        }
    }
}