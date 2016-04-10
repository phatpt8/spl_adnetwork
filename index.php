<?php

define('APPLICATION_ENV','production');

define('ROOT_PATH', dirname(__FILE__));
// Define library path
define('LIBRARY_PATH', ROOT_PATH . '/library/');


// Define path to application directory
define('APPLICATION_PATH', ROOT_PATH . '/application');

/* Setup Include Paths */
set_include_path(implode(PATH_SEPARATOR,
    array(
        get_include_path(),
        LIBRARY_PATH
    )
));

require_once APPLICATION_PATH . '/configs/defined.php';
require_once 'Zend/Application.php' ;

require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace(array('Zend_', 'Admin_'));
$loader->registerNamespace(array('Zend_', 'User_'));

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application-' . APPLICATION_ENV . '.ini'
);

$layoutInstance = Zend_Layout::startMvc(
    array(
        'layout' => 'default',
        'layoutPath' => APPLICATION_PATH . '/layouts/scripts',
        'contentKey' => 'content'
    )
);
$view = $layoutInstance->getView();
$view->setHelperPath(APPLICATION_PATH . '/layouts/helpers')
    ->addScriptPath(APPLICATION_PATH . '/layouts');

$application->bootstrap()->run();