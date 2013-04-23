<?php
class layoutBase {
    
    public $selected_layout;
    
    private $extension;
    private $layout_path;
    private $data = array();
    
    public function __construct(){
        
        $this->selected_layout = strtolower(Service::get('application.layout'));
        $this->layout_path = LAYOUTS_DIR . $this->selected_layout;
        $this->extension = Service::get('application.views_extension');
    }
    
    public function setContent($file, $data = array()) {
        
        $path_to_file = '';
        $_unique_key = '';
        
        if (file_exists($this->layout_path . DS . $file . $this->extension)) {
            
            $_unique_key = md5($file);
            $path_to_file = $this->layout_path . DS . $file . $this->extension;
            
        } elseif ( file_exists($file)) {
            
            $_unique_key = md5('view');
            $path_to_file = $file;
        }         
        
        if (!empty($path_to_file) && !empty($_unique_key)) {
            
            ob_start();
            extract($data);
            include $path_to_file; 
            
            $this->data[$_unique_key] = ob_get_clean();
           
            return true;
        }

        return false;
    }
    
    public function getContent($key, $display = TRUE) {
        
        if ($key == 'index') return false;
        
        $data = $this->data;
        
        if (isset($data[md5($key)]) && $html = $data[md5($key)]) {
            
            if (!$display) {
                
                return $html;
            
            }
            
            Service::toHtml($html);
            
        } else { //try to get the file instead in selected layout folder
            
            $path_to_file = $this->layout_path . DS . strtolower($key) . $this->extension;
            
            if (file_exists($path_to_file)) {
                
                include $path_to_file;
                
                return true;
            }
            
        }
        
        return false;                
        
    }
    
    public function show404(){
        
        $path_to_page = LAYOUTS_DIR . $this->selected_layout . DS . '404' . $this->extension;
        
        if ( file_exists($path_to_page)) {
            
            include $path_to_page;
            
            return true;
        }
        
        return false;
    
    }

}
