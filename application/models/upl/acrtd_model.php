<?php 

class acrtd_model extends CI_Model {
	
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
	    //  $msg3=$value['td018'];
		//  $msg3='td018';
		//  return $msg3;
        $data = array(
             //   'td001' => excelTime($value['td001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'td001'  => $value['td001'],  
				'td002'  => $value['td002'], 
                'td003'  => $value['td003'],
		        'td004'  => $value['td004'],
		        'td005'  => $value['td005'],
		        'td006'  => $value['td006'],
		        'td007'  => $value['td007'],
		        'td008'  => $value['td008'],
		        'td009'  => $value['td009'],
		        'td010'  => $value['td010'],
		        'td011'  => $value['td011'],
		        'td012'  => $value['td012'],
		        'td013'  => $value['td013'],
	        	'td014'  => $value['td014'],
	        	'td015'  => $value['td015'],
		        'td016'  => $value['td016'],
	        	'td017'  => $value['td017'],
		        'td018'  => $value['td018'],
	        	'td019'  => $value['td019'],
	        	'td020'  => $value['td020'],
		        'td021'  => $value['td021'],
		        
		);
        return $this->db->insert('acrtd', $data); 
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
                 'td001' => $value['td001'],
                'td002'  => $value['td002'],  
                'td003'  => $value['td003'],
		        'td004'  => $value['td004'],
		        'td005'  => $value['td005'],
		        'td006'  => $value['td006'],
		        'td007'  => $value['td007'],
		        'td008'  => $value['td008'],
		        'td009'  => $value['td009'],
		        'td010'  => $value['td010'],
		        'td011'  => $value['td011'],
		        'td012'  => $value['td012'],
		        'td013'  => $value['td013'],
	        	'td014'  => $value['td014'],
	        	'td015'  => $value['td015'],
		        'td016'  => $value['td016'],
	        	'td017'  => $value['td017'],
		        'td018'  => $value['td018'],
	        	'td019'  => $value['td019'],
	        	'td020'  => $value['td020'],
		        'td021'  => $value['td021'],
		        'td022'  => $value['td022'],
	        	'td023'  => $value['td023'],
	        	'td024'  => $value['td024'],
	        	'td025'  => $value['td025'],
	        	'td026'  => $value['td026'],
		        'td027'  => $value['td027'],
		        'td028'  => $value['td028'],
		        'td029'  => $value['td029'],
		        'td030'  => $value['td030'],
		        'td031'  => $value['td031'],
		        'td032'  => $value['td032'],
		        'td033'  => $value['td033'],
		        'td034'  => $value['td034'],
		        'td035'  => $value['td035'],
				'td036'  => $value['td036'],
		        'td037'  => $value['td037'],
		        'td038'  => $value['td038'],
		        'td039'  => $value['td039'],
		        'td040'  => $value['td040'],
				'td041'  => $value['td041'],
		        'td042'  => $value['td042'],
		        'td043'  => $value['td043'],
				'td044'  => $value['td044'],
		        'td045'  => $value['td045'],
				'td046'  => $value['td046'],
		        'td047'  => $value['td047'],
		        'td048'  => $value['td048'],
		        'td049'  => $value['td049'],
		        'td050'  => $value['td050'],
				'td051'  => $value['td051'],
		        'td052'  => $value['td052'],
		        'td053'  => $value['td053'],
				);
		$this->db->where('td001', $value['td001']);
		$this->db->where('td002', $value['td002']);
        return $this->db->update('acrtd', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('acrtd');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
