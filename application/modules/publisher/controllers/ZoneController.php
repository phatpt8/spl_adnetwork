<?php
class Publisher_ZoneController extends Zend_Controller_Action{
    
    public function addAction() {
        $this->view->headTitle()->append('Publisher Page');
        $this->_helper->layout->setLayout('publisher');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

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

            if ($this->_request->isPost()) {
                $title = trim(strip_tags($this->_request->getParam('name', null)));
                $format = trim(strip_tags($this->_request->getParam('format', null)));
                $placement = trim(strip_tags($this->_request->getParam('placement', null)));
                list($width, $height) = explode('x',$placement);

                $result = Admin_Model_Zone::createNewZone($id, $width, $height, $title, $format);
                if ($result) {
                    $this->redirect(SITE_URL . '/publisher/index');
                } else {
                    $this->redirect(SITE_URL . '/publisher/index?err=addfailed');
                }
            }



        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }

    public function editAction() {
        $this->view->headTitle()->append('Edit Zone');
        $this->_helper->layout->setLayout('publisher');
        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

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

            if ($this->_request->isGet()) {
                $val = $this->_request->getParams();
                $this->view->assign(array(
                    'editZone' => $val
                ));
            }
            if ($this->_request->isPost()) {
                $zoneId = trim(strip_tags($this->_request->getParam('id', null)));
                $name = trim(strip_tags($this->_request->getParam('name', null)));
                $format = trim(strip_tags($this->_request->getParam('format', null)));
                $placement = trim(strip_tags($this->_request->getParam('placement', null)));
                list($width, $height) = explode('x',$placement);

                $result = Admin_Model_Zone::updateZoneInfo($zoneId, $width, $height, $name, $format, $id);
                if ($result == "1") {
                    $this->redirect(SITE_URL . '/publisher/index?console=editsuccess');
                } else {
                    $this->redirect(SITE_URL . '/publisher/index?err=editfailed');
                }

            }

        } else {
            $this->redirect(SITE_URL . '/user/login');
        }
    }

    public function updatestatusAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $zoneid = trim($this->_request->getParam('id', null));
            $status = trim($this->_request->getParam('status', null));
            $result = Admin_Model_Zone::updateZoneStatus($zoneid, $status);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/publisher/zone');
            } else {
                $this->redirect(SITE_URL . '/publisher/zone?err=updatestatusFailed');
            }
        }
    }
}