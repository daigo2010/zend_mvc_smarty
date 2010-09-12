<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '/usr/local/ZendFramework/library/');
set_include_path(get_include_path() . PATH_SEPARATOR . '/usr/local/Smarty/');
require_once 'Zend/Controller/Front.php';
require_once '../lib/ZendViewSmarty.php';

$frontController = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true);

if (isset($_SERVER['HTTP_USER_AGENT']) &&
    (preg_match('#^DoCoMo/\d\.\d[ /]#', $_SERVER['HTTP_USER_AGENT']) ||
     preg_match('#^(?:(?:SoftBank|Vodafone|J-PHONE)/\d\.\d|MOT-)#', $_SERVER['HTTP_USER_AGENT']) ||
     preg_match('#(?:KDDI-[A-Z]+\d+[A-Z]? )?UP\.Browser\/#', $_SERVER['HTTP_USER_AGENT']))) {
    define('APP_DIR', dirname(dirname(__FILE__)) . '/m.app/');
} else {
    define('APP_DIR', dirname(dirname(__FILE__)) . '/app/');
} 
$frontController->setControllerDirectory(APP_DIR . 'controllers');
$view = new Zend_View_Smarty(APP_DIR . 'views/', 
                       array('compile_dir' => APP_DIR . 'var/template_c',
                             'config_dir'  => APP_DIR . 'var/configs',
                             'cache_dir'   => APP_DIR . 'var/cache'));
$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
$viewRenderer->setView($view)
             ->setViewScriptPathSpec(':controller/:action.:suffix')
             ->setViewBasePathSpec($view->getEngine()->template_dir)
             ->setViewScriptPathNoControllerSpec(':action.:suffix')
             ->setViewSuffix('tpl');

$frontController->dispatch();
