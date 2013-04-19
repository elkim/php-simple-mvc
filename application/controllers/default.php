<?php

class DefaultController extends BaseController{
    
    public function index(){        
        
        $this->view->assign('foo', 'Welcome!'); //assigning variable
                                
    }
    
}