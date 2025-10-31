<?php 

class Purth_model extends CI_Model {
	
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
	    //  $msg3=$value['th018'];
		//  $msg3='th018';
		//  return $msg3;
        $data = array(
             //   'th001' => excelTime($value['th001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'th001'  => $value['th001'],  
				'th002'  => $value['th002'], 
                'th003'  => $value['th003'],
		        'th004'  => $value['th004'],
		        'th005'  => $value['th005'],
		        'th006'  => $value['th006'],
		        'th007'  => $value['th007'],
		        'th008'  => $value['th008'],
		        'th009'  => $value['th009'],
		        'th010'  => $value['th010'],
		        'th011'  => $value['th011'],
		        'th012'  => $value['th012'],
		        'th013'  => $value['th013'],
	        	'th014'  => $value['th014'],
	        	'th015'  => $value['th015'],
		        'th016'  => $value['th016'],
	        	'th017'  => $value['th017'],
		        'th018'  => $value['th018'],
	        	'th019'  => $value['th019'],
	        	'th020'  => $value['th020'],
		        'th021'  => $value['th021'],
		        'th022'  => $value['th022'],
	        	'th023'  => $value['th023'],
	        	'th024'  => $value['th024'],
	        	'th025'  => $value['th025'],
	        	'th026'  => $value['th026'],
		        'th027'  => $value['th027'],
		        'th028'  => $value['th028'],
		        'th029'  => $value['th029'],
		        'th030'  => $value['th030'],
		        'th031'  => $value['th031'],
		        'th032'  => $value['th032'],
		        'th033'  => $value['th033'],
		        'th034'  => $value['th034'],
		        'th035'  => $value['th035'],
				'th036'  => $value['th036'],
		        'th037'  => $value['th037'],
		        'th038'  => $value['th038'],
		        'th039'  => $value['th039'],
		        'th040'  => $value['th040'],
				'th041'  => $value['th041'],
		        'th042'  => $value['th042'],
		        'th043'  => $value['th043'],
				'th044'  => $value['th044'],
		        'th045'  => $value['th045'],
				'th046'  => $value['th046'],
		        'th047'  => $value['th047'],
		        'th048'  => $value['th048'],
		        'th049'  => $value['th049'],
		        'th050'  => $value['th050'],
				'th051'  => $value['th051'],
		        'th052'  => $value['th052'],
		        'th053'  => $value['th053'],
		);
        return $this->db->insert('purth', $data); 
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
                 'th001' => $value['th001'],
                'th002'  => $value['th002'],  
                'th003'  => $value['th003'],
		        'th004'  => $value['th004'],
		        'th005'  => $value['th005'],
		        'th006'  => $value['th006'],
		        'th007'  => $value['th007'],
		        'th008'  => $value['th008'],
		        'th009'  => $value['th009'],
		        'th010'  => $value['th010'],
		        'th011'  => $value['th011'],
		        'th012'  => $value['th012'],
		        'th013'  => $value['th013'],
	        	'th014'  => $value['th014'],
	        	'th015'  => $value['th015'],
		        'th016'  => $value['th016'],
	        	'th017'  => $value['th017'],
		        'th018'  => $value['th018'],
	        	'th019'  => $value['th019'],
	        	'th020'  => $value['th020'],
		        'th021'  => $value['th021'],
		        'th022'  => $value['th022'],
	        	'th023'  => $value['th023'],
	        	'th024'  => $value['th024'],
	        	'th025'  => $value['th025'],
	        	'th026'  => $value['th026'],
		        'th027'  => $value['th027'],
		        'th028'  => $value['th028'],
		        'th029'  => $value['th029'],
		        'th030'  => $value['th030'],
		        'th031'  => $value['th031'],
		        'th032'  => $value['th032'],
		        'th033'  => $value['th033'],
		        'th034'  => $value['th034'],
		        'th035'  => $value['th035'],
				'th036'  => $value['th036'],
		        'th037'  => $value['th037'],
		        'th038'  => $value['th038'],
		        'th039'  => $value['th039'],
		        'th040'  => $value['th040'],
				'th041'  => $value['th041'],
		        'th042'  => $value['th042'],
		        'th043'  => $value['th043'],
				'th044'  => $value['th044'],
		        'th045'  => $value['th045'],
				'th046'  => $value['th046'],
		        'th047'  => $value['th047'],
		        'th048'  => $value['th048'],
		        'th049'  => $value['th049'],
		        'th050'  => $value['th050'],
				'th051'  => $value['th051'],
		        'th052'  => $value['th052'],
		        'th053'  => $value['th053'],
				);
		$this->db->where('th001', $value['th001']);
		$this->db->where('th002', $value['th002']);
        return $this->db->update('purth', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('purth');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
