<?php

class PostController extends BaseController{
    
    public function index(){
        
    }
    
    public function view(){
        
        $id = !empty($this->request['id']) ? $this->request['id'] : "";
                        
        $member = $this->getModel('member');
        
        $this->view->assign('userinfo', $member->getUser($id));
        $this->view->assign("id", $id);
        
    }
    
}