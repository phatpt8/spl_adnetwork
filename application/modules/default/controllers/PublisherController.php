<?php
class PublisherController extends Zend_Controller_Action{

    public function indexAction() {
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $arr_session = $defaultNamespace->newsession;
            $condition = $arr_session['condition'];
            $role = $arr_session['activeRole'];
            $fullname = $arr_session['activeFullname'];
            $id = $arr_session['activeId'];

            if ($condition != "logged" && $role != 2) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);

            $this->view->headTitle()->append('Publisher page');
            $this->_helper->layout->setLayout('publisher');
        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }
}