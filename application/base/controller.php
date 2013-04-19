<?php

class BaseController{
    
    private $caller;

    public $view;    
    public $request;    
        
    public function __construct($action=""){
        
        $this->models = new ModelBase();
        $this->caller = get_called_class();        
        $this->view = new BaseView(strtolower(str_replace('Controller','',$this->caller)), $action);
        
    }
    
    public function __call($name, $arguments){
        
        //inaccessible methods falls here
        ErrorController::badUrl();
     
    }
    
    public function getModel($model_name, $has_db = TRUE){
        
        $model_file_path = MODELS_DIR . $model_name . '.php';
        
        if (file_exists($model_file_path)) {
            
            $class_name = Service::getClassName($model_file_path);

            require($model_file_path);
            
            if (class_exists($class_name)) {
                
                return new $class_name($has_db);
                
            }
            
        }
        
        return NULL;
    
    }
        
}