<?php

namespace DevToolbar;

class Manager
{
    /**
     * @var Array 
     */
    protected $params;
    
    /**
     * @var array
     */
    protected $cache;
    
    /**
     * Set the Module specific configuration parameters
     * 
     * @param Array $params
     */
    public function __construct($params) {
        $this->params = $params;
    }

    public function get($type, $option) 
    {
        if ($type == 'js') {
            return $this->getJavascript($option);
        }
        elseif ($type == 'css') {
            return $this->getCss($option);
        }
        elseif ($type == 'toolbar') {
            return $this->getDevToolbar($option);
        }
    }
    
    /**
     * Generate JS inclusion HTML code
     */
    public function getJavascript($includeBundledJquery = false)
    {
        $links = array();
        if ($this->params['enabled']) {
            if ($includeBundledJquery === true) {
                $links[] = '<script type="text/javascript" src="' . $this->params['jquery_js_source_path'] . '"></script>';
                $links[] = '<script type="text/javascript" src="' . $this->params['jquery-ui_js_source_path'] . '"></script>';
            }
            $links[] = '<script type="text/javascript" src="' . $this->params['js_source_path'] . '"></script>';
        }
        
        return implode("", $links);
    }
    
    /**
     * Generate CSS inclusion CSS code
     */
    public function getCss($includeBundledJquery = false)
    {
        $links = array();
        if ($this->params['enabled']) {
            $links[] = '<link href="' . $this->params['css_source_path'] . '" rel="stylesheet" type="text/css" />';
            if ($includeBundledJquery === true) {
                $links[] = '<link href="' . $this->params['jquery_ui_css_path'] . '" rel="stylesheet" type="text/css" />';
            }
        }
        
        return implode("", $links);
    }
    
    /**
     * Create DIV section for the jQuery-UI dialog
     * 
     * @return string 
     */
    public function getDevToolbar()
    {
        $html  = '<div class="devtoolbar">';
        $html .= '<div id="tabs">';
        $html .= '<ul>';
        $html .= '<li><a href="/devtoolbar/memory">Memory</a></li>';
        $html .= '<li><a href="/devtoolbar/access">Access log</a></li>';
        $html .= '<li><a href="/devtoolbar/error">Error log</a></li>';
        $html .= '<li><a href="/devtoolbar/phpinfo">PHP info</a></li>';
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';
        
        if ($this->params['enabled']) {
            return $html;
        } else {
            return '';
        }
    }
    
}
