<?php 

class acptb_model extends CI_Model {
	
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
	        	
		);
        return $this->db->insert('acptb', $data); 
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
	        	'tb024'  => $value['tb024'],
	        	'tb025'  => $value['tb025'],
	        	'tb026'  => $value['tb026'],
		        'tb027'  => $value['tb027'],
		        'tb028'  => $value['tb028'],
		        'tb029'  => $value['tb029'],
		        'tb030'  => $value['tb030'],
		        'tb031'  => $value['tb031'],
		        'tb032'  => $value['tb032'],
		        'tb033'  => $value['tb033'],
		        'tb034'  => $value['tb034'],
		        'tb035'  => $value['tb035'],
				'tb036'  => $value['tb036'],
		        'tb037'  => $value['tb037'],
		        'tb038'  => $value['tb038'],
		        'tb039'  => $value['tb039'],
		        'tb040'  => $value['tb040'],
				'tb041'  => $value['tb041'],
		        'tb042'  => $value['tb042'],
		        'tb043'  => $value['tb043'],
				'tb044'  => $value['tb044'],
		        'tb045'  => $value['tb045'],
				'tb046'  => $value['tb046'],
		        'tb047'  => $value['tb047'],
		        'tb048'  => $value['tb048'],
		        'tb049'  => $value['tb049'],
		        'tb050'  => $value['tb050'],
				'tb051'  => $value['tb051'],
		        'tb052'  => $value['tb052'],
		        'tb053'  => $value['tb053'],
				);
		$this->db->where('tb001', $value['tb001']);
		$this->db->where('tb002', $value['tb002']);
        return $this->db->update('acptb', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('acptb');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
