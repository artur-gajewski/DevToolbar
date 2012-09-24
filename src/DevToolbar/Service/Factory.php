<?php

namespace DevToolbar\Service;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    DevToolbar\Manager;

/**
* ContentEdit service manager factory
*/
class Factory implements FactoryInterface
{
    /**
     * Factory method for DevToolbar Manager service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return DevToolbar\Manager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');
        $params = $config['DevToolbar']['params'];
        
        $manager = new Manager($params);
        return $manager;
    }
}