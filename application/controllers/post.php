<?php

class PostController extends BaseController{
    
    public function index(){
        
    }
    
    public function view(){
        
        echo "<pre>"; var_dump($this->request);
        
        $id = !empty($this->request['id']) ? $this->request['id'] : "";
    
        $this->view->assign("id", $id);
        
    }
    
}