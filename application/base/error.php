<?php

class ErrorController extends BaseController{
    
    function badUrl(){
        
        $this->view->display('404');
        
    }
    
}