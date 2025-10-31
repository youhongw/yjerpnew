<?php  
class Mautocomplete extends CI_Model{  
    function __construct()
        {
                parent::__construct();
               
        }
		
    function lookup($keyword){  
        $this->db->select('*')->from('country');  
        $this->db->like('printable_name',$keyword,'after');  
        $query = $this->db->get();      
           
        return $query->result();  
    }  
}  