<?php

class ErrorController{
    
    public static function badUrl(){
        
        $view = new BaseView('error');
        $view->display('404');
        
    }
    
}