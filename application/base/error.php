<?php

class ErrorController{
    
    public static function badUrl() {
        self::notFound("The requested URL $_SERVER[REQUEST_URI] was not found on this server.");        
    }
    
    public static function notFound($message){
        
        $view = new BaseView('error');
        $view->assign('message', $message);
        $view->display('404');
        
    }
    
}