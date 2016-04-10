<?php
class PublisherController extends Zend_Controller_Action{

    public function indexAction() {
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $init = $defaultNamespace->initialized;
            $role = $defaultNamespace->activeRole;
            $fullname = $defaultNamespace->activeFullname;

            if ($init != "logged" && $role != 3) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname
            );
            $this->view->assign($view_arr);

            $this->view->headTitle()->append('Publisher page');
            $this->_helper->layout->setLayout('publisher');
        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }
}