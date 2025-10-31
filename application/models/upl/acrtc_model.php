<?php 

class acrtc_model extends CI_Model {
	
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
	    //  $msg3=$value['tc018'];
		//  $msg3='tc018';
		//  return $msg3;
        $data = array(
             //   'tc001' => excelTime($value['tc001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'tc001'  => $value['tc001'],  
				'tc002'  => $value['tc002'], 
                'tc003'  => $value['tc003'],
		        'tc004'  => $value['tc004'],
		        'tc005'  => $value['tc005'],
		        'tc006'  => $value['tc006'],
		        'tc007'  => $value['tc007'],
		        'tc008'  => $value['tc008'],
		        'tc009'  => $value['tc009'],
		        'tc010'  => $value['tc010'],
		        'tc011'  => $value['tc011'],
		        'tc012'  => $value['tc012'],
		        'tc013'  => $value['tc013'],
	        	'tc014'  => $value['tc014'],
	        	'tc015'  => $value['tc015'],
		        'tc016'  => $value['tc016'],
	        	'tc017'  => $value['tc017'],
		        'tc018'  => $value['tc018'],
	        	'tc019'  => $value['tc019'],
	        	
		        
		);
        return $this->db->insert('acrtc', $data); 
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
                 'tc001' => $value['tc001'],
                'tc002'  => $value['tc002'],  
                'tc003'  => $value['tc003'],
		        'tc004'  => $value['tc004'],
		        'tc005'  => $value['tc005'],
		        'tc006'  => $value['tc006'],
		        'tc007'  => $value['tc007'],
		        'tc008'  => $value['tc008'],
		        'tc009'  => $value['tc009'],
		        'tc010'  => $value['tc010'],
		        'tc011'  => $value['tc011'],
		        'tc012'  => $value['tc012'],
		        'tc013'  => $value['tc013'],
	        	'tc014'  => $value['tc014'],
	        	'tc015'  => $value['tc015'],
		        'tc016'  => $value['tc016'],
	        	'tc017'  => $value['tc017'],
		        'tc018'  => $value['tc018'],
	        	'tc019'  => $value['tc019'],
	        	'tc020'  => $value['tc020'],
		        'tc021'  => $value['tc021'],
		        'tc022'  => $value['tc022'],
	        	'tc023'  => $value['tc023'],
	        	'tc024'  => $value['tc024'],
	        	'tc025'  => $value['tc025'],
	        	'tc026'  => $value['tc026'],
		        'tc027'  => $value['tc027'],
		        'tc028'  => $value['tc028'],
		        'tc029'  => $value['tc029'],
		        'tc030'  => $value['tc030'],
		        'tc031'  => $value['tc031'],
		        'tc032'  => $value['tc032'],
		        'tc033'  => $value['tc033'],
		        'tc034'  => $value['tc034'],
		        'tc035'  => $value['tc035'],
				'tc036'  => $value['tc036'],
		        'tc037'  => $value['tc037'],
		        'tc038'  => $value['tc038'],
		        'tc039'  => $value['tc039'],
		        'tc040'  => $value['tc040'],
				'tc041'  => $value['tc041'],
		        'tc042'  => $value['tc042'],
		        'tc043'  => $value['tc043'],
				'tc044'  => $value['tc044'],
		        'tc045'  => $value['tc045'],
				'tc046'  => $value['tc046'],
		        'tc047'  => $value['tc047'],
		        'tc048'  => $value['tc048'],
		        'tc049'  => $value['tc049'],
		        'tc050'  => $value['tc050'],
				'tc051'  => $value['tc051'],
		        'tc052'  => $value['tc052'],
		        'tc053'  => $value['tc053'],
				);
		$this->db->where('tc001', $value['tc001']);
		$this->db->where('tc002', $value['tc002']);
        return $this->db->update('acrtc', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('acrtc');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
