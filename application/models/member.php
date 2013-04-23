<?php
/**
 *sample model
*/
class member extends ModelBase{
    
    public function getUser($id) {
        
        if ($id) {
            
            //getting result from database
            $result = $this->db
                            ->select('*')
                            ->from('tbl_user')
                            ->where('id=?', array($id))
                            ->query_one();
            
            return $result;
        }
        
        return array();
        
    }
    
}