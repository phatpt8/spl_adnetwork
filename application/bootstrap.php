<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
    public function _initAutoload(){
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array(
            'module'     => 'error',
            'controller' => 'error',
            'action'     => 'error'
        )));
    }

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
    }

}