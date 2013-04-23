<?php

class PostController extends BaseController{
    
    public function index(){
        
        //passing variables in layouts  
        $this->view->layout->setContent('sidebar', array('show_sidebar'=>true, 'sidebar_title'=>'dynamic sidebar') );
        
    }
    
    public function view(){
        
        //retrieving request
        $id = !empty($this->request['id']) ? $this->request['id'] : "";
        
        //getting models                
        $member = $this->getModel('member');
        
        //passing variables to view
        $this->view->assign('userinfo', $member->getUser($id));
        $this->view->assign("id", $id);
        
        //passing variables in layouts                
        $this->view->layout->setContent('sidebar', array('sidebar_hide'=>false, 'sidebar_title'=>'dynamic sidebar') );
        
    }
    
}