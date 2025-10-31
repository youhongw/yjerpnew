<?php 

class Cmsmc_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		  $this->load->database();
       }	

    /**
    * 增加
    * @param 姓名
    * @param 性别
    * @param 电话
    * @return bool
    */ 
	
    function add_Excel($value)
      {  
	    //  $msg3=$value['mc018'];
		//  $msg3='mc018';
		//  return $msg3;
        $data = array(
             //   'mc001' => excelTime($value['mc001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				'mc001'  => $value['mc001'],  
				'mc002'  => $value['mc002'], 
                'mc003'  => $value['mc003'],
		        'mc004'  => $value['mc004'],
		        'mc005'  => $value['mc005'],
		        'mc006'  => $value['mc006'],
		        'mc007'  => $value['mc007'],
		       
		       
		);
        return $this->db->insert('cmsmc', $data); 
      }
    
   /**
    * 更新
    * @param 姓名
    * @param 性别
    * @param 电话
    * @param ID
    * @return bool
    */
    function upd_Excel($value='')
      {    
        $data = array(
                 'mc001' => $value['mc001'],
                'mc002'  => $value['mc002'],  
                'mc003'  => $value['mc003'],
		        'mc004'  => $value['mc004'],
		        'mc005'  => $value['mc005'],
		        'mc006'  => $value['mc006'],
		        'mc007'  => $value['mc007'],
		      
		       
				);
		$this->db->where('mc001', $value['mc001']);
		$this->db->where('mc002', $value['mc002']);
        return $this->db->update('cmsmc', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsmc');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
