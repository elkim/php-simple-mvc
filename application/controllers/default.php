<?php

class DefaultController extends BaseController{
    
    public function index(){        
        
        //assigning variable
        $this->view->assign('foo', 'Welcome!'); 
                                
    }
    
}