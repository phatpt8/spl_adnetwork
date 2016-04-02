<?php
class PublisherController extends Zend_Controller_Action{

    public function indexAction() {

        $defaultNamespace = new Zend_Session_Namespace('ZSN');
        $ss = $defaultNamespace->initialized;
        $role = $defaultNamespace->user_role;

        if ($ss != "logged" && $role != 2) {
            $this->redirect(SITE_URL . '/auth/login');
        }

        $this->view->headTitle()->append('Publisher page');
        $this->_helper->layout->setLayout('publisher');
    }
}