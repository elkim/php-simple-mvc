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
        
        $this->layout = new layoutBase();
        
    }
    
    public function assign($name, $value) {                
        
        $this->data[$name] = $value;
        
    }
    
    public function display($filename, $base_path = '') {
        
        $base_path = (empty($base_path)) ? $this->controller : $base_path;
        
        $view_file = $this->layout->layout_path . 'views' . DS . $base_path . DS . $filename . $this->extension;

        if (file_exists($view_file)) {
            
            //set layout
            
            $this->layout->setContent($view_file, $this->data);
            
            $layout = $this->layout;
            
            $index_file = $this->layout->layout_path . 'index' . $this->extension;
            
            if (!file_exists($index_file)) die('ERROR: layout missing index file');
            
            include $index_file; //load index file (main file in layouts)
            
            $this->is_displayed = true;
                        
        }  else {
            
            ErrorController::notFound("missing view");
                
        }     
        
        return $this->is_displayed;
        
    }    

}