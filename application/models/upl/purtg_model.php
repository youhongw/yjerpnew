<?php 

class Purtg_model extends CI_Model {
	
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
	    //  $msg3=$value['tg018'];
		//  $msg3='tg018';
		//  return $msg3;
        $data = array(
             //   'tg001' => excelTime($value['tg001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'tg001'  => $value['tg001'],  
				'tg002'  => $value['tg002'], 
                'tg003'  => $value['tg003'],
		        'tg004'  => $value['tg004'],
		        'tg005'  => $value['tg005'],
		        'tg006'  => $value['tg006'],
		        'tg007'  => $value['tg007'],
		        'tg008'  => $value['tg008'],
		        'tg009'  => $value['tg009'],
		        'tg010'  => $value['tg010'],
		        'tg011'  => $value['tg011'],
		        'tg012'  => $value['tg012'],
		        'tg013'  => $value['tg013'],
	        	'tg014'  => $value['tg014'],
	        	'tg015'  => $value['tg015'],
		        'tg016'  => $value['tg016'],
	        	'tg017'  => $value['tg017'],
		        'tg018'  => $value['tg018'],
	        	'tg019'  => $value['tg019'],
	        	'tg020'  => $value['tg020'],
		        'tg021'  => $value['tg021'],
		        'tg022'  => $value['tg022'],
	        	'tg023'  => $value['tg023'],
	        	'tg024'  => $value['tg024'],
	        	'tg025'  => $value['tg025'],
	        	'tg026'  => $value['tg026'],
		        'tg027'  => $value['tg027'],
		        'tg028'  => $value['tg028'],
		        'tg029'  => $value['tg029'],
		        'tg030'  => $value['tg030'],
		        'tg031'  => $value['tg031'],
		        'tg032'  => $value['tg032'],
		        'tg033'  => $value['tg033'],
		        'tg034'  => $value['tg034'],
		        'tg035'  => $value['tg035'],
				'tg036'  => $value['tg036'],
		        'tg037'  => $value['tg037'],
		        'tg038'  => $value['tg038'],
		        'tg039'  => $value['tg039'],
		        'tg040'  => $value['tg040'],
				'tg041'  => $value['tg041'],
		        'tg042'  => $value['tg042'],
		        'tg043'  => $value['tg043'],
		);
        return $this->db->insert('purtg', $data); 
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
                 'tg001' => $value['tg001'],
                'tg002'  => $value['tg002'],  
                'tg003'  => $value['tg003'],
		        'tg004'  => $value['tg004'],
		        'tg005'  => $value['tg005'],
		        'tg006'  => $value['tg006'],
		        'tg007'  => $value['tg007'],
		        'tg008'  => $value['tg008'],
		        'tg009'  => $value['tg009'],
		        'tg010'  => $value['tg010'],
		        'tg011'  => $value['tg011'],
		        'tg012'  => $value['tg012'],
		        'tg013'  => $value['tg013'],
	        	'tg014'  => $value['tg014'],
	        	'tg015'  => $value['tg015'],
		        'tg016'  => $value['tg016'],
	        	'tg017'  => $value['tg017'],
		        'tg018'  => $value['tg018'],
	        	'tg019'  => $value['tg019'],
	        	'tg020'  => $value['tg020'],
		        'tg021'  => $value['tg021'],
		        'tg022'  => $value['tg022'],
	        	'tg023'  => $value['tg023'],
	        	'tg024'  => $value['tg024'],
	        	'tg025'  => $value['tg025'],
	        	'tg026'  => $value['tg026'],
		        'tg027'  => $value['tg027'],
		        'tg028'  => $value['tg028'],
		        'tg029'  => $value['tg029'],
		        'tg030'  => $value['tg030'],
		        'tg031'  => $value['tg031'],
		        'tg032'  => $value['tg032'],
		        'tg033'  => $value['tg033'],
		        'tg034'  => $value['tg034'],
		        'tg035'  => $value['tg035'],
				'tg036'  => $value['tg036'],
		        'tg037'  => $value['tg037'],
		        'tg038'  => $value['tg038'],
		        'tg039'  => $value['tg039'],
		        'tg040'  => $value['tg040'],
				'tg041'  => $value['tg041'],
		        'tg042'  => $value['tg042'],
		        'tg043'  => $value['tg043'],
				);
		$this->db->where('tg001', $value['tg001']);
		$this->db->where('tg002', $value['tg002']);
        return $this->db->update('purtg', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('purtg');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
