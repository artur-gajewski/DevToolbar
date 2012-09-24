<?php

namespace DevToolbar\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

class DevToolbar extends AbstractHelper
{
    /**
     * @var DevToolbar Service
     */
    protected $service;
    
    /**
     * @var array $params
     */
    protected $params;
    
    /**
     * Called upon invoke
     * 
     * @param integer $id
     * @return DevToolbar\Helper
     */
    public function __invoke($type, $option = null)
    {
        $link = $this->service->get(strtolower($type), $option);
        return $link;
    }

    /**
     * Get DevToolbar service.
     *
     * @return $this->service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set DevToolbar service.
     *
     * @param $service
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
    
    /**
     * Get DevToolbar params.
     *
     * @return $this->params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set DevToolbar params.
     *
     * @param array $params
     */
    public function setParams(Array $params)
    {
        $this->params = $params;
        return $this;
    }
    
}