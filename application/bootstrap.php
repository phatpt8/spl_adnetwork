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

    public function run() {
        $front = $this->getResource('FrontController');
        $front->setDefaultModule('default');
        $default = $front->getDefaultModule();
        if (null === $front->getControllerDirectory($default)) {
            throw new Zend_Application_Bootstrap_Exception(
                'No default controller directory registered with front controller'
            );
        }
        $front->setParam('bootstrap', $this)->setParam('noErrorHandler', true)->returnResponse(true);
        $response = $front->dispatch();
        /** @var  $request Zend_Controller_Request_Http */
        $request = $front->getRequest();

        $view = Zend_Layout::getMvcInstance()->getView();
        $response->sendResponse();
    }
}