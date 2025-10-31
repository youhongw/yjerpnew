<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class astb03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  invi14 invte1 盤點儲位輸入檔
	
//計算 產生盤點表 invtc  
    //查新增資料是否輸入訂單訂號 
    function selone1($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tc001', $seg1);
		   $this->db->where('tc003', $seg2);
		    $this->db->where('tc004', $seg3);
	      $query = $this->db->get('invtc');
	      return $query->num_rows() ;
	    }  				
	function batchaf()           
        {
			$vtd001=$this->input->post('td001c');
			$vtd002=substr($this->input->post('td002c'),0,4).substr($this->input->post('td002c'),5,2).substr(rtrim($this->input->post('td002c')),8,2);
		    $vtd003=$this->input->post('cmsq03a');    //庫別
			$vtd004=$this->input->post('invq02a');
			$vtd005=$this->input->post('invq02a1');
		  //盤點表 底稿編號, 盤點日期, 盤點庫別   invtc
         /*   $this->db->where('tc001', $vtd001);   //盤點底稿編號
			$this->db->where('tc009', $vtd002);     //日期
			$this->db->where('tc004', $vtd003);     //庫別
			$this->db->where('tc003 >=', $vtd004);  //起品號
			$this->db->where('tc003 <=', $vtd005);　//迄品號
		    $this->db->delete('invtc');  */		  
		  
          //
		    //刪除 庫存檔 invmc
				/*	 $this->db->where('mc002', $vtd003);     //庫別
			         $this->db->where('mc001 >=', $vtd004);  //起品號
			         $this->db->where('mc001 <=', $vtd005);　//迄品號
		             $this->db->delete('invmc');  */
			
			
	         return true;  
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>