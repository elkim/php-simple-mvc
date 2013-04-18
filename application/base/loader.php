<?php

class BaseLoader{
    
    private $controller = 'home';
    private $action = 'index';
    
    function __construct() {

        if (!empty($_REQUEST['controller'])) {
            $this->controller = $_REQUEST['controller'];
        }
        
        if (!empty($_REQUEST['action'])) {
            $this->action = $_REQUEST['action'];
        }
        
    }
    
    function execute() {
        
        $class_path = CONTROLLERS_DIR . $this->controller . '.php';
        
        if (file_exists($class_path)) require($class_path);
        
        $controller = ucfirst($this->controller) . 'Controller';
        
        if (class_exists($controller)) {
            
            $action = $this->action;
            
            $class = new $controller(); //create class
            
            if (method_exists($class, $action)) {
                
                $class->$action(); //call action of created class
                
                if (!$class->view->is_displayed) //default display call
                
                    $class->view->display($action);                
                
                return TRUE;
            } 
            
        }
        
        //include error controller
        
        require(BASE_DIR . 'error.php');
        
        $error_controller = new ErrorController();
        
        return $error_controller->badUrl();
    }
    
}