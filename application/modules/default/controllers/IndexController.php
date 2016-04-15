<?php
class IndexController extends Zend_Controller_Action{

    public function indexAction(){
        $this->view->headTitle("Portal");
        $this->_helper->layout->setLayout('default');

    }
}