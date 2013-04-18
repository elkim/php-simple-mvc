<?php

class HomeController extends BaseController{
    
    public function index(){
        
        $this->view->assign('foo', 'Home controller!');
        
        //$this->view->display('404','error'); //displaying other view
    }
    
}