<?php 

class Customer_address_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	 
 
 /**
  * load by id
  *customer_address表裡面包含了 收貨人的基本資訊province_id,city_id,district_id等
  *
  */ 
    function load($customer_id)
    {
        if (!$customer_id){
            return array();
        }
        $query = $this->db->get_where('customer_address',array('customer_id' => $customer_id,'is_default' => 1));
        if ($row = $query->row_array()){
            return $row;
        }
        return array();
    }
?>