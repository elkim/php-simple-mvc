<?php

class BaseView {
    
    public $extension = '.tpl';
    public $is_displayed = false;    
    public $layout;
    
    protected $data;
    protected $controller;
    protected $view_file;
        
    public function __construct($controller_name, $action = ""){
                
        $this->controller = strtolower($controller_name);
        $this->data['controller'] = $this->controller;
        $this->data['action'] = $action;
        
        $xt = Service::get('application.views_extension');
        if ($xt) $this->extension = $xt;
        
        $this->layout = Service::get('application.layout');
        
    }
    
    public function assign($name, $value) {                
        
        $this->data[$name] = $value;
        
    }
    
    public function display($filename, $base_path = '') {                
        
        $base_path = (empty($base_path)) ? $this->controller : $base_path;
        
        $view_file = VIEWS_DIR . $base_path . DS . $filename . $this->extension; 
        
        if (file_exists($view_file)) {
                                   
            $this->data['view'] = $this;
            
            extract($this->data);            
            
            ob_start(); include $view_file; //capture view content
                
            $this->view_file = ob_get_clean(); //store it.
            
            include LAYOUTS_DIR . $this->layout . DS . 'index' . $this->extension; 
            
            $this->is_displayed = true;
                        
        }  else {
            
            ErrorController::notFound("missing view");
                
        }     
        
        return $this->is_displayed;
        
    }
    
    public function show404(){
        
        $path_to_page = LAYOUTS_DIR . $this->layout . DS . '404' . $this->extension;
        
        if ( file_exists($path_to_page)) {
            
            include $path_to_page;
            
            return true;
        }
        
        return false;
        
    }    
    
    public function getContents(){
        
        echo $this->view_file;

    }

}