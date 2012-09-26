<?php

namespace DevToolbar;

return array(
    __NAMESPACE__ => array(
        'params' => array(
            // DevToolbar settings
            'enabled'                  => true,
            'activator'                => '__debug',
            'access_log'               => '/usr/local/zend/apache2/logs/access_log',
            'error_log'                => '/usr/local/zend/apache2/logs/error_log',
            'access_log_rows'          => 20,
            'error_log_rows'           => 20,
            'show_phpinfo'             => true,
            
            // DevToolbar related JS and CSS
            'js_source_path'           => '/js/DevToolbar.js',
            'css_source_path'          => '/css/DevToolbar.css',
            
            // jQuery related JS and CSS
            'jquery_js_source_path'    => '/js/jquery-1.8.0.min.js',
            'jquery-ui_js_source_path' => '/js/jquery-ui-1.8.23.custom.min.js',
            'jquery_ui_css_path'       => '/css/ui-lightness/jquery-ui-1.8.23.custom.css',
            ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'DevToolbar' => __DIR__ . '/../public',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            __NAMESPACE__ . '\Controller\Toolbar' => __NAMESPACE__ . '\Controller\ToolbarController',
        ),
    ),
    'router' => array(
        'routes' => array(
            __NAMESPACE__ => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/devtoolbar/:action',
                    'defaults' => array(
                        'controller' => __NAMESPACE__ . '\Controller\Toolbar',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
);