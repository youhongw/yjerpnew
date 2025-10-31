<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajsb22_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  invi14 invte1 盤點儲位輸入檔
	
//計算 還原盤點表 invtc  
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
			$vtd002=$this->input->post('td002c');
		    
		  //刪除分錄底稿傳票號
		    $sql00 ="update ajsta set ta004='',ta005='' where ta004='$vtd001' and ta005='$vtd002' ";   
	        $query=$this->db->query($sql00);
			
			//刪除傳票
			 if ($query->num_rows() > 0) 
		    {
            $this->db->where('ta001', $vtd001);   
			$this->db->where('ta002', $vtd002);     
		    $this->db->delete('actta'); 
            $this->db->where('tb001', $vtd001);   
			$this->db->where('tb002', $vtd002);     
		    $this->db->delete('acttb');			
			}
          
	         return true;  
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>