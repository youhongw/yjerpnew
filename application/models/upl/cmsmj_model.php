<?php 

class cmsmj_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		  $this->load->database();
       }	

   
    function add_Excel($value)
      {  
	    //  $msg3=$value['mj018'];
		//  $msg3='mj018';
		//  return $msg3;
        $data = array(
             //   'mj001' => excelTime($value['mj001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'mj001'  => $value['mj001'],  
				'mj002'  => $value['mj002'], 
                'mj003'  => $value['mj003'],
		        'mj004'  => $value['mj004'],
		        
	        	
		);
        return $this->db->insert('cmsmj', $data); 
      }
    
   
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsmj');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
