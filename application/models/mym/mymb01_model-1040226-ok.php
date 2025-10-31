<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mymb01_model extends CI_Model {
	
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
        $data = array(
        'uname' => $value['uname'] ,
        'usex'  => $value['usex'],  
        'utel'  => $value['utel'],);
        return $this->db->insert('users', $data); 
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
                'uname' => $value['uname'] ,
                'usex'  => $value['usex'],  
                'utel'  => $value['utel'],);
        $this->db->where('uid', $value['uid']);
        return $this->db->update('users', $data); 
    
    }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
     {
		$this->db->select('*');    //查詢數
	    $this->db->from('users');		
        $query = $this->db->get();
        return $query->result_array();
     }  

}
?>