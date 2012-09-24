<?php

namespace DevToolbar\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ToolbarController extends AbstractActionController 
{
    /**
     * Get memory usage for the tab 
     */
    public function memoryAction() 
    {
        echo number_format(memory_get_usage()) . " bytes used.";
        exit;
    }
    
    /**
     * Get the access log's tail for the tab
     */
    public function accessAction() 
    {
        echo $this->tail('access_log');
        exit;
    }
    
    /**
     * Get the error log's tail for the tab
     */
    public function errorAction() 
    {
        echo $this->tail('error_log');
        exit;
    }
    
    /**
     * Get the phpinfo(), remove the styles and return the content
     */
    public function phpinfoAction() 
    {
        $config = $this->getServiceLocator()->get('config');
        $params = $config['DevToolbar']['params'];
        
        if ($params['show_phpinfo']) {
            ob_start();
            phpinfo();
            $pinfo = ob_get_contents();
            ob_end_clean();
            
            //Remove phpinfo's CSS definitions to replace with DevToolbar's CSS
            $pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
            
            echo $pinfo;
        } else {
            echo "This feature is not enabled.";
        }
        
        exit;
    }
    
    /**
     * Tail a file
     * 
     * @param string $logType
     * @param int $lines
     * @param int $buffer
     * @return string 
     */
    function tail($logType, $buffer = 4096)
    {
        $config = $this->getServiceLocator()->get('config');
        $params = $config['DevToolbar']['params'];
        
        $filename = $params[$logType];
        if ($params[$logType . '_rows']) {
            $lines = $params[$logType . '_rows'];
        } else {
            $lines = 20;
        }
        
        $f = fopen($filename, "rb");
        fseek($f, -1, SEEK_END);
        if(fread($f, 1) != "\n") {
            $lines -= 1;
        }

        $output = '';
        $chunk = '';

        while(ftell($f) > 0 && $lines >= 0) {
            $seek = min(ftell($f), $buffer);
            fseek($f, -$seek, SEEK_CUR);
            $output = ($chunk = fread($f, $seek)).$output;
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
            $lines -= substr_count($chunk, "\n");
        }

        while($lines++ < 0) {
            $output = substr($output, strpos($output, "\n") + 1);
        }

        $output = str_replace("\n", "<br/>", $output);
        
        fclose($f);
        return $output;
    }

    
}
