<?php 

class Invtb_model extends CI_Model {
	
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
	    //  $msg3=$value['tb018'];
		//  $msg3='tb018';
		//  return $msg3;
        $data = array(
             //   'tb001' => excelTime($value['tb001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'tb001'  => $value['tb001'],  
				'tb002'  => $value['tb002'], 
                'tb003'  => $value['tb003'],
		        'tb004'  => $value['tb004'],
		        'tb005'  => $value['tb005'],
		        'tb006'  => $value['tb006'],
		        'tb007'  => $value['tb007'],
		        'tb008'  => $value['tb008'],
		        'tb009'  => $value['tb009'],
		        'tb010'  => $value['tb010'],
		        'tb011'  => $value['tb011'],
		        'tb012'  => $value['tb012'],
		        'tb013'  => $value['tb013'],
	        	'tb014'  => $value['tb014'],
	        	'tb015'  => $value['tb015'],
		        'tb016'  => $value['tb016'],
	        	'tb017'  => $value['tb017'],
		        'tb018'  => $value['tb018'],
	        	'tb019'  => $value['tb019'],
				'tb020'  => $value['tb020'],
				'tb021'  => $value['tb021'],
				'tb022'  => $value['tb022'],
				'tb023'  => $value['tb023'],
		       
		);
        return $this->db->insert('invtb', $data); 
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
                 'tb001' => $value['tb001'],
                'tb002'  => $value['tb002'],  
                'tb003'  => $value['tb003'],
		        'tb004'  => $value['tb004'],
		        'tb005'  => $value['tb005'],
		        'tb006'  => $value['tb006'],
		        'tb007'  => $value['tb007'],
		        'tb008'  => $value['tb008'],
		        'tb009'  => $value['tb009'],
		        'tb010'  => $value['tb010'],
		        'tb011'  => $value['tb011'],
		        'tb012'  => $value['tb012'],
		        'tb013'  => $value['tb013'],
	        	'tb014'  => $value['tb014'],
	        	'tb015'  => $value['tb015'],
		        'tb016'  => $value['tb016'],
	        	'tb017'  => $value['tb017'],
		        'tb018'  => $value['tb018'],
	        	'tb019'  => $value['tb019'],
	        	'tb020'  => $value['tb020'],
		        'tb021'  => $value['tb021'],
		        'tb022'  => $value['tb022'],
	        	'tb023'  => $value['tb023'],
	        
				);
		$this->db->where('tb001', $value['tb001']);
		$this->db->where('tb002', $value['tb002']);
        return $this->db->update('invtb', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('invtb');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
