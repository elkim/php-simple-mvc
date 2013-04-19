<?php

class BaseView {
    
    public $extension = '.tpl';
    public $is_displayed = FALSE;
    
    protected $data;
    protected $controller;
        
    public function __construct($controller_name, $action = ""){
                
        $this->controller = strtolower($controller_name);
        $this->data['controller'] = $this->controller;
        $this->data['action'] = $action;
        
        $xt = Service::get('application.views_extension');
        if ($xt) $this->extension = $xt;
        
    }
    
    public function assign($name, $value) {                
        
        $this->data[$name] = $value;
        
    }
    
    public function display($filename, $base_path = '') {                
        
        $base_path = (empty($base_path)) ? $this->controller : $base_path;
        
        $view_file = VIEWS_DIR . $base_path . DS . $filename . $this->extension; 
        
        if (file_exists($view_file)) {
            
            extract($this->data);
        
            include $view_file;
            
            $this->is_displayed = TRUE;
                        
        }  else {
            
            ErrorController::notFound("missing view");
                
        }     
        
        return $this->is_displayed;
        
    }
    
}