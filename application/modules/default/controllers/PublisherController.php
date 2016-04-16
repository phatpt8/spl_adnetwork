<?php
class PublisherController extends Zend_Controller_Action{

    public function indexAction() {
        $this->view->headTitle()->append('Publisher page');
        $this->_helper->layout->setLayout('publisher');
        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session['condition'];
            $role = $session['activeRole'];
            $fullname = $session['activeFullname'];
            $id = $session['activeId'];

            if (!isset($session) || $role != 2) {
                $this->redirect(SITE_URL . '/user/login');
            }

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id
            );
            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            $result = Admin_Model_Zone::getPublisherZones($id);
            $this->view->zoneData = $result;
        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }
}