<?php

class BaseLoader{
    
    private $controller = 'home';
    private $action = 'index';
    private $request;
    
    public function __construct() {
              
        $this->processRequest($_REQUEST);
        
    }        
    
    public function execute() {
        
        $class_path = CONTROLLERS_DIR . $this->controller . '.php';
        
        if (file_exists($class_path)) require($class_path);
        
        $controller = ucfirst($this->controller) . 'Controller';
        
        if (class_exists($controller)) {
            
            $action = $this->action;
            
            $class = new $controller($action); //create class
            $class->request = $this->request; //set class request variables
                        
            $class->$action(); //call action of created class BaseController will handle this and process proper action
                
            if (!$class->view->is_displayed) //default display call
            
                $class->view->display($action);                
                
            return $class;
 
            
        } else {
            ErrorController::badUrl();
        }
        
        return FALSE;
    }
    
    private function processRequest($request) {

        if (empty($request)) { //process request_uri from $_SERVER
            
            $request = array();
            $request_uri = $_SERVER['REQUEST_URI'];
            
            if (strlen($request_uri) > 1) {
                
                $segments = explode('/',$request_uri);
                
                $this->controller = (!empty($segments[1])) ? $segments[1] : $this->controller;
                $this->action = (!empty($segments[2])) ? $segments[2] : $this->action;                
                
                foreach ($segments as $k => $segment) {
                    
                    if ($k == 0) continue;
                    
                    if ($k == 1 || $k == 2){
                        $request[($k == 1)?'controller':'action'] = $segment;
                    }elseif ($k % 2 == 0) {
                        if (isset($request[$segments[$k - 1]])) $request[$segments[$k - 1]] = $segment;
                    } else {                        
                        $request[$segment] = '';                        
                    }                    
                }
                
                $_REQUEST = $request; //fill request variable also
                
            }
            
        } else {

            $this->controller = (empty($request['controller'])) ? $this->controller : $request['controller'];
            $this->action = (empty($request['action'])) ? $this->action : $request['action'];
        }
        
        $this->request = $request;
        
    }
    
}