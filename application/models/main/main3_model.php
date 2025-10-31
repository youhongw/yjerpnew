<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main3_model extends CI_Model {
	
	function __construct()
        {
        parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
	
	//ajax 查詢一筆 顯示 請購部門
    function ajaxcmsq05a($seg1)    
        { 
	    $this->db->where('me001', $this->uri->segment(4));	
	    $query = $this->db->get('cmsme');
			
	    if ($query->num_rows() > 0) 
		   {
		    $res = $query->result();
		    foreach ($query->result() as $row)
            {
            $result=$row->me002;
            }
		    return $result;   
		   }
	    }
		
	//ajax 查詢一筆 顯示 使用者權限	
	function ajaxadmi10a($seg1)    
        {
	    $this->db->where('mg001', $this->session->userdata('manager'));
        $this->db->where('mg002', $this->uri->segment(3));		  
	    $query = $this->db->get('admmg');
			
	    if ($query->num_rows() > 0) 
		   {
		    $res = $query->result();
		    foreach ($query->result() as $row)
              {
               $result=$row->mg004;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢一筆 顯示 群組代號	
    function ajaxadmq04a($seg1)    
        { 
        $this->db->where('mg001', '89044');			
	    $query = $this->db->get('admmg');
	    if ($query->num_rows() > 0) 
		   {
		    $res = $query->result();
		    foreach ($query->result() as $row)
             {
              $result=$row->mg004;
             }
		   return $result;   
		  }
	   }	
	
	//ajax 查詢一筆 顯示 群組代號
	function ajaxamdq05a($seg1)    
        {
	    $this->db->where('mg001', '89044');
        $this->db->where('mg002', 'INVI01');		  
	    $query = $this->db->get('admmg');
			
	    if ($query->num_rows() > 0) 
		   {
		    $res = $query->result();
		    foreach ($query->result() as $row)
              {
               $result=$row->mg004;
			   $mg001sys[]=$row->mg001;
			   $mg004sys[]=$row->mg004;
			   $mg006sys[]=$row->mg006;
              }
			 $this->session->set_userdata('sysmg001',$mg001sys[0]); 
             $this->session->set_userdata('sysmg004',$mg004sys[0]);  
             $this->session->set_userdata('sysmg006',$mg006sys[0]);  			  
		   return $result;   
		  }
	    }
	
	//使用者權限系統變數
	function admmgf($seg1)     
       {
	    $query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008')  
		                  ->from('admmg')
		     		      ->where('mg001', '89044')
			         	  ->where('mg002', 'INVI01');
		foreach ($query->result() as $row)
          {
			$mg001sys[]=$row->mg001;
			$mg004sys[]=$row->mg004;
			$mg006sys[]=$row->mg006;
		  } 
			$this->session->set_userdata('sysmg001',$mg001sys[0]); 
			$this->session->set_userdata('sysmg004',$mg004sys[0]); 
			$this->session->set_userdata('sysmg006',$mg006sys[0]); 
			return $mg004sys[]; 
	    }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>