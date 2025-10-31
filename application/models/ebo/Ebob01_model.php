<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ebob01_model extends CI_Model {
	
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
		
					 
		//	$sql = " INSERT INTO  invmc (company,creator,usr_group,create_date,modifier,modi_date,flag,mc001,mc002,mc003,mc007)
		//	            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,a.mb001,b.mc001,a.mb004,0  from invmb as a,cmsmc as b where b.mc001='$vtd003' and b.mc001>='$vtd004' and b.mc001<='$vtd005'  ";
         //   $this->db->query($sql); 
		 
		   
			
	         return true;  
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>