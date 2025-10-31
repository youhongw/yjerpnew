<?php 

class cmsml_model extends CI_Model {
	
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
	    //  $msg3=$value['ml018'];
		//  $msg3='ml018';
		//  return $msg3;
        $data = array(
             //   'ml001' => excelTime($value['ml001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'ml001'  => $value['ml001'],  
				'ml002'  => $value['ml002'], 
                'ml003'  => $value['ml003'],
		        'ml004'  => $value['ml004'],
		        'ml005'  => $value['ml005'],
		        'ml006'  => $value['ml006'],
		        'ml007'  => $value['ml007'],
		        'ml008'  => $value['ml008'],
		        'ml009'  => $value['ml009'],
		        'ml010'  => $value['ml010'],
		        'ml011'  => $value['ml011'],
		        'ml012'  => $value['ml012'],
		        'ml013'  => $value['ml013'],
	        	'ml014'  => $value['ml014'],
	        	'ml015'  => $value['ml015'],
		        'ml016'  => $value['ml016'],
	        	'ml017'  => $value['ml017'],
		        'ml018'  => $value['ml018'],
	        	'ml019'  => $value['ml019'],
	        	
		);
        return $this->db->insert('cmsml', $data); 
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
                 'ml001' => $value['ml001'],
                'ml002'  => $value['ml002'],  
                'ml003'  => $value['ml003'],
		        'ml004'  => $value['ml004'],
		        'ml005'  => $value['ml005'],
		        'ml006'  => $value['ml006'],
		        'ml007'  => $value['ml007'],
		        'ml008'  => $value['ml008'],
		        'ml009'  => $value['ml009'],
		        'ml010'  => $value['ml010'],
		        'ml011'  => $value['ml011'],
		        'ml012'  => $value['ml012'],
		        'ml013'  => $value['ml013'],
	        	'ml014'  => $value['ml014'],
	        	'ml015'  => $value['ml015'],
		        'ml016'  => $value['ml016'],
	        	'ml017'  => $value['ml017'],
		        'ml018'  => $value['ml018'],
	        	'ml019'  => $value['ml019'],
	        	'ml020'  => $value['ml020'],
		        'ml021'  => $value['ml021'],
		        'ml022'  => $value['ml022'],
	        	'ml023'  => $value['ml023'],
	        	'ml024'  => $value['ml024'],
	        	'ml025'  => $value['ml025'],
	        	'ml026'  => $value['ml026'],
		        'ml027'  => $value['ml027'],
		        'ml028'  => $value['ml028'],
		        'ml029'  => $value['ml029'],
		        'ml030'  => $value['ml030'],
		        'ml031'  => $value['ml031'],
		        'ml032'  => $value['ml032'],
		        'ml033'  => $value['ml033'],
		        'ml034'  => $value['ml034'],
		        'ml035'  => $value['ml035'],
				'ml036'  => $value['ml036'],
		        'ml037'  => $value['ml037'],
		        'ml038'  => $value['ml038'],
		        'ml039'  => $value['ml039'],
		        'ml040'  => $value['ml040'],
				'ml041'  => $value['ml041'],
		        'ml042'  => $value['ml042'],
		        'ml043'  => $value['ml043'],
				);
		$this->db->where('ml001', $value['ml001']);
		$this->db->where('ml002', $value['ml002']);
        return $this->db->update('cmsml', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsml');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
