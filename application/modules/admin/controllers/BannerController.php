<?php
class Admin_BannerController extends Zend_Controller_Action{

    public function indexAction() {
        $this->view->headTitle()->append(' Admin>>Banner ');
        $this->_helper->layout->setLayout('admin');
        $layout = $this->_helper->layout();
        $defaultNamespace = new Zend_Session_Namespace('Zend_Admin_Auth');
        if(isset($defaultNamespace)) {
            $session = $defaultNamespace->newsession;
            $condition = $session["condition"];
            $role =  $session["activeRole"];
            $fullname =  $session["activeFullname"];
            $id =  $session["activeId"];

            if (!isset($session) || $role == 2 || $role == 3) {
                $this->redirect(SITE_URL . '/auth/login');
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

            $result = Admin_Model_Banner::getBanners();
            $this->view->bannerData = $result;
        } else {
            $this->redirect(SITE_URL . '/auth/login');
        }
    }

    public function updatestatusAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if($this->_request->isGet()) {
            $bannerId = trim($this->_request->getParam('id', null));
            $status = trim($this->_request->getParam('status', null));
            $result = Admin_Model_Banner::updateBannerStatus($bannerId, $status);
            if ($result != 0) {
                $this->redirect(SITE_URL . '/admin/banner');
            } else {
                $this->redirect(SITE_URL . '/admin/banner?err=updatestatusFailed');
            }
        }
    }

}