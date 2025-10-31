<?php 

class cmsma_model extends CI_Model {
	
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
	    //  $msg3=$value['ma018'];
		//  $msg3='ma018';
		//  return $msg3;
        $data = array(
             //   'ma001' => excelTime($value['ma001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'ma001'  => $value['ma001'],  
				'ma002'  => $value['ma002'], 
                'ma003'  => $value['ma003'],
		        'ma004'  => $value['ma004'],
		        'ma005'  => $value['ma005'],
		        'ma006'  => $value['ma006'],
		        'ma007'  => $value['ma007'],
		        'ma008'  => $value['ma008'],
		        'ma009'  => $value['ma009'],
		        'ma010'  => $value['ma010'],
		        'ma011'  => $value['ma011'],
		        'ma012'  => $value['ma012'],
		        'ma013'  => $value['ma013'],
	        	'ma014'  => $value['ma014'],
	        	'ma015'  => $value['ma015'],
		        'ma016'  => $value['ma016'],
	        	'ma017'  => $value['ma017'],
		        'ma018'  => $value['ma018'],
	        	'ma019'  => $value['ma019'],
	        	'ma020'  => $value['ma020'],
		        'ma021'  => $value['ma021'],
		        'ma022'  => $value['ma022'],
	        	'ma023'  => $value['ma023'],
	        	'ma024'  => $value['ma024'],
	        	'ma025'  => $value['ma025'],
	        	'ma026'  => $value['ma026'],
		        'ma027'  => $value['ma027'],
		        'ma028'  => $value['ma028'],
		        'ma029'  => $value['ma029'],
		        'ma030'  => $value['ma030'],
		       
		);
        return $this->db->insert('cmsma', $data); 
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
                 'ma001' => $value['ma001'],
                'ma002'  => $value['ma002'],  
                'ma003'  => $value['ma003'],
		        'ma004'  => $value['ma004'],
		        'ma005'  => $value['ma005'],
		        'ma006'  => $value['ma006'],
		        'ma007'  => $value['ma007'],
		        'ma008'  => $value['ma008'],
		        'ma009'  => $value['ma009'],
		        'ma010'  => $value['ma010'],
		        'ma011'  => $value['ma011'],
		        'ma012'  => $value['ma012'],
		        'ma013'  => $value['ma013'],
	        	'ma014'  => $value['ma014'],
	        	'ma015'  => $value['ma015'],
		        'ma016'  => $value['ma016'],
	        	'ma017'  => $value['ma017'],
		        'ma018'  => $value['ma018'],
	        	'ma019'  => $value['ma019'],
	        	'ma020'  => $value['ma020'],
		        'ma021'  => $value['ma021'],
		        'ma022'  => $value['ma022'],
	        	'ma023'  => $value['ma023'],
	        	'ma024'  => $value['ma024'],
	        	'ma025'  => $value['ma025'],
	        	'ma026'  => $value['ma026'],
		        'ma027'  => $value['ma027'],
		        'ma028'  => $value['ma028'],
		        'ma029'  => $value['ma029'],
		        'ma030'  => $value['ma030'],
		        'ma031'  => $value['ma031'],
		        'ma032'  => $value['ma032'],
		        'ma033'  => $value['ma033'],
		        'ma034'  => $value['ma034'],
		        'ma035'  => $value['ma035'],
				'ma036'  => $value['ma036'],
		        'ma037'  => $value['ma037'],
		        'ma038'  => $value['ma038'],
		        'ma039'  => $value['ma039'],
		        'ma040'  => $value['ma040'],
				'ma041'  => $value['ma041'],
		        'ma042'  => $value['ma042'],
		        'ma043'  => $value['ma043'],
				);
		$this->db->where('ma001', $value['ma001']);
		$this->db->where('ma002', $value['ma002']);
        return $this->db->update('cmsma', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsma');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
