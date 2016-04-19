<?php
class Advertiser_BalanceController extends Zend_Controller_Action{
    public function topupAction() {
        $this->view->headTitle()->append('Topup account');
        $this->_helper->layout->setLayout('advertiser');
        $layout = $this->_helper->layout();

        $defaultNamespace = new Zend_Session_Namespace('Zend_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $role != 3) {
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
                $amount = trim(strip_tags($this->_request->getParam('amount', null)));
                if (trim($amount)==='' || trim($id)==='') {
                    return false;
                }

                $result = Admin_Model_User::updateBalance($id, intval($amount));
                if ($result) {
                    $this->redirect(SITE_URL . '/advertiser/index?status=topupsuccess');
                } else {
                    $this->redirect(SITE_URL . '/advertiser/index?err=topupfailed');
                }
            }

            if (trim($id)==='') {
                return false;
            }
            $balance = Admin_Model_User::getBalance($id);
            $this->view->activeBalance = $balance;
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }
}