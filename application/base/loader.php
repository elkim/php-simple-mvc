<?php

class BaseLoader{
    
    private $controller = 'default';
    private $action = 'index';
    private $request;
    
    public function __construct() {
        
        $this->processRequest($_REQUEST);
        Service::setIni(APPS_DIR . 'config.ini');
        
    }        
    
    public function execute() {
        
        $class_path = CONTROLLERS_DIR . $this->controller . '.php';
        $controller = '';
        
        if (file_exists($class_path)) { 
            
            require($class_path);
            
            $controller = Service::getClassName($class_path); // be sure to check for the file first!
            
        }
        
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
                
                $request_uri = substr($request_uri, strpos($_SERVER['PHP_SELF'], '/index.php', 1), strlen($request_uri)); //added to support sub folder installations
                
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