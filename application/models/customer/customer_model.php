<?php 

class Customer_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	 
 
 function load($id)
    {
        if (!$id){
            return array();
        }
        $query = $this->db->get_where('customer',array('id' => $id));
        
        if ($row = $query->row_array()){
            return $row;
        }
        return array();
    }
?>