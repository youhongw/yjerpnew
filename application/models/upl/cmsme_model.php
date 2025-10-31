<?php 

class Cmsme_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		  $this->load->database();
       }	

   
    function add_Excel($value)
      {  
	    //  $msg3=$value['me018'];
		//  $msg3='me018';
		//  return $msg3;
        $data = array(
             //   'me001' => excelTime($value['me001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'me001'  => $value['me001'],  
				'me002'  => $value['me002'], 
                'me003'  => $value['me003'],
		        'me004'  => $value['me004'],
		        
	        	
		);
        return $this->db->insert('cmsme', $data); 
      }
    
   
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsme');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
