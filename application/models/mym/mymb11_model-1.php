<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mymb11_model extends CI_Model {
	
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
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $seg1=$this->uri->segment(4);
		$seg2=$this->uri->segment(5);
	    $this->db->where('tg002 >=', $seg1);
		$this->db->where('tg002 <=', $seg2);
        $this->db->delete('coptga'); 
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
    function add_Excel($value)
      {  
	    //  $msg3=$value['ta018'];
		//  $msg3='ta018';
		//  return $msg3;
        $data = array(
             //   'ta001' => excelTime($value['ta001']),
                'tg001'  => $value['ta001'],  
				'tg002'  => $value['ta002'], 
                'tg003'  => $value['ta003'],
		        'tg004'  => '0000',
		        'tg011'  => 'NTD',
		        'tg012'  => 1,
				'tg013'  => $value['ta012'],
		        'tg023'  => 'Y',
				'tg024'  => 'Y',
		        'tg034'  => 'Y',
				
		);
        return $this->db->insert('coptg1', $data); 
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
                'tg001'  => $value['ta001'],  
				'tg002'  => $value['ta002'], 
                'tg003'  => $value['ta003'],
		        'tg004'  => '0000',
		        'tg011'  => 'NTD',
		        'tg012'  => 1,
				'tg013'  => $value['ta012'],
		        'tg023'  => 'Y',
				'tg024'  => 'Y',
		        'tg034'  => 'Y',
		       
				);
		$this->db->where('tg002', $value['ta002']);
		$this->db->where('tg001', $value['ta001']);
        return $this->db->update('coptg1', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('coptg1');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
?>