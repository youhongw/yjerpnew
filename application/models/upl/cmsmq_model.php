<?php 

class cmsmq_model extends CI_Model {
	
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
	    //  $msg3=$value['mq018'];
		//  $msg3='mq018';
		//  return $msg3;
        $data = array(
             //   'mq001' => excelTime($value['mq001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'mq001'  => $value['mq001'],  
				'mq002'  => $value['mq002'], 
                'mq003'  => $value['mq003'],
		        'mq004'  => $value['mq004'],
		        'mq005'  => $value['mq005'],
		        'mq006'  => $value['mq006'],
		        'mq007'  => $value['mq007'],
		        'mq008'  => $value['mq008'],
		        'mq009'  => $value['mq009'],
		        'mq010'  => $value['mq010'],
		        'mq011'  => $value['mq011'],
		        'mq012'  => $value['mq012'],
		        'mq013'  => $value['mq013'],
	        	'mq014'  => $value['mq014'],
	        	'mq015'  => $value['mq015'],
		        'mq016'  => $value['mq016'],
	        	'mq017'  => $value['mq017'],
		        'mq018'  => $value['mq018'],
	        	'mq019'  => $value['mq019'],
	        	'mq020'  => $value['mq020'],
		        'mq021'  => $value['mq021'],
		        'mq022'  => $value['mq022'],
	        	'mq023'  => $value['mq023'],
	        	'mq024'  => $value['mq024'],
	        	'mq025'  => $value['mq025'],
	        	'mq026'  => $value['mq026'],
		        'mq027'  => $value['mq027'],
		        'mq028'  => $value['mq028'],
		        'mq029'  => $value['mq029'],
		        'mq030'  => $value['mq030'],
		        'mq031'  => $value['mq031'],
		        'mq032'  => $value['mq032'],
		        'mq033'  => $value['mq033'],
		        'mq034'  => $value['mq034'],
		        'mq035'  => $value['mq035'],
		);
        return $this->db->insert('cmsmq', $data); 
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
                 'mq001' => $value['mq001'],
                'mq002'  => $value['mq002'],  
                'mq003'  => $value['mq003'],
		        'mq004'  => $value['mq004'],
		        'mq005'  => $value['mq005'],
		        'mq006'  => $value['mq006'],
		        'mq007'  => $value['mq007'],
		        'mq008'  => $value['mq008'],
		        'mq009'  => $value['mq009'],
		        'mq010'  => $value['mq010'],
		        'mq011'  => $value['mq011'],
		        'mq012'  => $value['mq012'],
		        'mq013'  => $value['mq013'],
	        	'mq014'  => $value['mq014'],
	        	'mq015'  => $value['mq015'],
		        'mq016'  => $value['mq016'],
	        	'mq017'  => $value['mq017'],
		        'mq018'  => $value['mq018'],
	        	'mq019'  => $value['mq019'],
	        	'mq020'  => $value['mq020'],
		        'mq021'  => $value['mq021'],
		        'mq022'  => $value['mq022'],
	        	'mq023'  => $value['mq023'],
	        	'mq024'  => $value['mq024'],
	        	'mq025'  => $value['mq025'],
	        	'mq026'  => $value['mq026'],
		        'mq027'  => $value['mq027'],
		        'mq028'  => $value['mq028'],
		        'mq029'  => $value['mq029'],
		        'mq030'  => $value['mq030'],
		        'mq031'  => $value['mq031'],
		        'mq032'  => $value['mq032'],
		        'mq033'  => $value['mq033'],
		        'mq034'  => $value['mq034'],
		        'mq035'  => $value['mq035'],
				
				);
		$this->db->where('mq001', $value['mq001']);
		$this->db->where('mq002', $value['mq002']);
        return $this->db->update('cmsmq', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsmq');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
