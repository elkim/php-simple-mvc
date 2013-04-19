<?php

class ModelBase{
    
    public $db;
    public $has_db;
    
    public function __construct($has_db = TRUE){
        
        
        $config = Service::get('database.default');
        
        if (!empty($config) && $has_db) {
            
            $this->has_db = $has_db;
            $this->db = new PdoBase($config);
            
        }
        
    }
    
}