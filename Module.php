<?php

namespace DevToolbar;

use DevToolbar\View\Helper\DevToolbar;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DevToolbar' => 'DevToolbar\Service\Factory',
            )
        ); 
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'getDevToolbar' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $config = $locator->get('Configuration');
                    $params = $config['DevToolbar']['params'];
                    
                    $viewHelper = new View\Helper\DevToolbar();
                    $viewHelper->setService($locator->get('DevToolbar'));
                    $viewHelper->setParams($params);
                    
                    return $viewHelper;
                },
            ),
        );

    }


    
}