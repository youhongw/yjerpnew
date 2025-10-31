<?php 

class cmsmf_model extends CI_Model {
	
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
	    //  $msg3=$value['mf018'];
		//  $msg3='mf018';
		//  return $msg3;
        $data = array(
             //   'mf001' => excelTime($value['mf001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'mf001'  => $value['mf001'],  
				'mf002'  => $value['mf002'], 
                'mf003'  => $value['mf003'],
		        'mf004'  => $value['mf004'],
		        'mf005'  => $value['mf005'],
		        'mf006'  => $value['mf006'],
		        'mf007'  => $value['mf007'],
		        
		);
        return $this->db->insert('cmsmf', $data); 
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
                 'mf001' => $value['mf001'],
                'mf002'  => $value['mf002'],  
                'mf003'  => $value['mf003'],
		        'mf004'  => $value['mf004'],
		        'mf005'  => $value['mf005'],
		        'mf006'  => $value['mf006'],
		        'mf007'  => $value['mf007'],
		        'mf008'  => $value['mf008'],
		        'mf009'  => $value['mf009'],
		        'mf010'  => $value['mf010'],
		        'mf011'  => $value['mf011'],
		        'mf012'  => $value['mf012'],
		        'mf013'  => $value['mf013'],
	        	'mf014'  => $value['mf014'],
	        	'mf015'  => $value['mf015'],
		        'mf016'  => $value['mf016'],
	        	'mf017'  => $value['mf017'],
		        'mf018'  => $value['mf018'],
	        	'mf019'  => $value['mf019'],
	        	'mf020'  => $value['mf020'],
		        'mf021'  => $value['mf021'],
		        'mf022'  => $value['mf022'],
	        	'mf023'  => $value['mf023'],
	        	'mf024'  => $value['mf024'],
	        	'mf025'  => $value['mf025'],
	        	'mf026'  => $value['mf026'],
		        'mf027'  => $value['mf027'],
		        'mf028'  => $value['mf028'],
		        'mf029'  => $value['mf029'],
		        'mf030'  => $value['mf030'],
		        'mf031'  => $value['mf031'],
		        'mf032'  => $value['mf032'],
		        'mf033'  => $value['mf033'],
		        'mf034'  => $value['mf034'],
		        'mf035'  => $value['mf035'],
				'mf036'  => $value['mf036'],
		        'mf037'  => $value['mf037'],
		        'mf038'  => $value['mf038'],
		        'mf039'  => $value['mf039'],
		        'mf040'  => $value['mf040'],
				'mf041'  => $value['mf041'],
		        'mf042'  => $value['mf042'],
		        'mf043'  => $value['mf043'],
				);
		$this->db->where('mf001', $value['mf001']);
		$this->db->where('mf002', $value['mf002']);
        return $this->db->update('cmsmf', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsmf');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
