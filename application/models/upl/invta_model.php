<?php 

class Invta_model extends CI_Model {
	
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
	    //  $msg3=$value['ta018'];
		//  $msg3='ta018';
		//  return $msg3;
        $data = array(
             //   'ta001' => excelTime($value['ta001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'ta001'  => $value['ta001'],  
				'ta002'  => $value['ta002'], 
                'ta003'  => $value['ta003'],
		        'ta004'  => $value['ta004'],
		        'ta005'  => $value['ta005'],
		        'ta006'  => $value['ta006'],
		        'ta007'  => $value['ta007'],
		        'ta008'  => $value['ta008'],
		        'ta009'  => $value['ta009'],
		        'ta010'  => $value['ta010'],
		        'ta011'  => $value['ta011'],
		        'ta012'  => $value['ta012'],
		        'ta013'  => $value['ta013'],
	        	'ta014'  => $value['ta014'],
	        	'ta015'  => $value['ta015'],
		        'ta016'  => $value['ta016'],
	        	'ta017'  => $value['ta017'],
		       
		);
        return $this->db->insert('invta', $data); 
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
                 'ta001' => $value['ta001'],
                'ta002'  => $value['ta002'],  
                'ta003'  => $value['ta003'],
		        'ta004'  => $value['ta004'],
		        'ta005'  => $value['ta005'],
		        'ta006'  => $value['ta006'],
		        'ta007'  => $value['ta007'],
		        'ta008'  => $value['ta008'],
		        'ta009'  => $value['ta009'],
		        'ta010'  => $value['ta010'],
		        'ta011'  => $value['ta011'],
		        'ta012'  => $value['ta012'],
		        'ta013'  => $value['ta013'],
	        	'ta014'  => $value['ta014'],
	        	'ta015'  => $value['ta015'],
		        'ta016'  => $value['ta016'],
	        	'ta017'  => $value['ta017'],
		        'ta018'  => $value['ta018'],
	        	'ta019'  => $value['ta019'],
	        	'ta020'  => $value['ta020'],
		        'ta021'  => $value['ta021'],
		        'ta022'  => $value['ta022'],
	        	'ta023'  => $value['ta023'],
	        	'ta024'  => $value['ta024'],
	        	'ta025'  => $value['ta025'],
	        	'ta026'  => $value['ta026'],
		        'ta027'  => $value['ta027'],
		        'ta028'  => $value['ta028'],
		        'ta029'  => $value['ta029'],
		        'ta030'  => $value['ta030'],
		        'ta031'  => $value['ta031'],
		        'ta032'  => $value['ta032'],
		        'ta033'  => $value['ta033'],
		        'ta034'  => $value['ta034'],
		        'ta035'  => $value['ta035'],
				'ta036'  => $value['ta036'],
		        'ta037'  => $value['ta037'],
		        'ta038'  => $value['ta038'],
		        'ta039'  => $value['ta039'],
		        'ta040'  => $value['ta040'],
				'ta041'  => $value['ta041'],
		        'ta042'  => $value['ta042'],
		        'ta043'  => $value['ta043'],
				);
		$this->db->where('ta001', $value['ta001']);
		$this->db->where('ta002', $value['ta002']);
        return $this->db->update('invta', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('invta');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
