<?php
class Admin_ZoneController extends Zend_Controller_Action{

    public function indexAction(){
        $this->view->headTitle()->append(' Admin>>Zone ');
        $this->_helper->layout->setLayout('admin');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if ($condition != "logged" && ($role == 2 || $role == 3)) {
                $this->redirect(SITE_URL . '/auth/login?err=unaccess');
            }

            $countClick = Admin_Model_Click::getClicksCount();
            $countImpression = Admin_Model_Impression::getImpressionsCount();
            $countTrueview = Admin_Model_Trueview::getTrueviewsCount();

            $view_arr = array(
                'fullname' => $fullname,
                'id' => $id,
                'clicks' => $countClick,
                'impressions' => $countImpression,
                'trueviews' => $countTrueview
            );

            $this->view->assign($view_arr);
            $layout->fullname = $fullname;
            $layout->role = $role;

            $result = Admin_Model_Zone::getZones();
            $this->view->zoneData = $result;
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }

    public function updatestatusAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $zoneId = trim($this->_request->getParam('id', null));
            $status = trim($this->_request->getParam('status', null));
            $result = Admin_Model_Zone::updateZoneStatus($zoneId, $status);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/admin/zone');
            } else {
                $this->redirect(SITE_URL . '/admin/zone?err=updatestatusFailed');
            }
        }
    }
}