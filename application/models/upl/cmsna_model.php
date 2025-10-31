<?php 

class cmsna_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		  $this->load->database();
       }	

   
    function add_Excel($value)
      {  
	    //  $msg3=$value['na018'];
		//  $msg3='na018';
		//  return $msg3;
        $data = array(
             //   'na001' => excelTime($value['na001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'na001'  => $value['na001'],  
				'na002'  => $value['na002'], 
                'na003'  => $value['na003'],
		        'na004'  => $value['na004'],
		        'na005'  => $value['na005'],
		        'na006'  => $value['na006'],
		        'na007'  => $value['na007'],
		        'na008'  => $value['na008'],
		        'na009'  => $value['na009'],
		        'na010'  => $value['na010'],
		        'na011'  => $value['na011'],
		        'na012'  => $value['na012'],
		        'na013'  => $value['na013'],
	        	'na014'  => $value['na014'],
	        	'na015'  => $value['na015'],
		        'na016'  => $value['na016'],
	        	'na017'  => $value['na017'],
		        'na018'  => $value['na018'],
	        	'na019'  => $value['na019'],
	        	
		);
        return $this->db->insert('cmsna', $data); 
      }
    
   
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsna');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
