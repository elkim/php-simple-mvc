<?php

class BaseController {
    
    public $view;    
    protected $request;
        
    function __construct(){
                
        $this->view = new BaseView(strtolower(str_replace('Controller','',get_called_class())));
        
        $this->processRequest($_REQUEST);
        
    }
    
    private function processRequest($request) {
        
        //TODO: sanitize request here
        //TODO: evaluate request_uri if seo mode process it and add to request 
        $this->request = $request;                
        
        //echo "<pre>"; var_dump($request, $_SERVER);exit;        
        
    }
    
}