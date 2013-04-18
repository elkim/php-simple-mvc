<?php

class BaseController{
    
    private $caller;
    
    public $view;    
    public $request;    
        
    public function __construct($action=""){
        
        $this->caller = get_called_class();        
        $this->view = new BaseView(strtolower(str_replace('Controller','',$this->caller)), $action);
        
    }
    
    public function __call($name, $arguments){
        
        //inaccessible methods falls here
        ErrorController::badUrl();
     
    }
    
}