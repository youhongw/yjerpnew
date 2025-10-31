<?php 

class cmsmb_model extends CI_Model {
	
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
	    //  $msg3=$value['mb018'];
		//  $msg3='mb018';
		//  return $msg3;
        $data = array(
             //   'mb001' => excelTime($value['mb001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				'mb001'  => $value['mb001'],  
				'mb002'  => $value['mb002'], 
                'mb003'  => $value['mb003'],
		        'mb004'  => $value['mb004'],
		        'mb005'  => $value['mb005'],
		        'mb006'  => $value['mb006'],
		        'mb007'  => $value['mb007'],
		        'mb008'  => $value['mb008'],
		        'mb009'  => $value['mb009'],
		        'mb010'  => $value['mb010'],
		       
		);
        return $this->db->insert('cmsmb', $data); 
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
                 'mb001' => $value['mb001'],
                'mb002'  => $value['mb002'],  
                'mb003'  => $value['mb003'],
		        'mb004'  => $value['mb004'],
		        'mb005'  => $value['mb005'],
		        'mb006'  => $value['mb006'],
		        'mb007'  => $value['mb007'],
		        'mb008'  => $value['mb008'],
		        'mb009'  => $value['mb009'],
		        'mb010'  => $value['mb010'],
		       
				);
		$this->db->where('mb001', $value['mb001']);
		$this->db->where('mb002', $value['mb002']);
        return $this->db->update('cmsmb', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsmb');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
