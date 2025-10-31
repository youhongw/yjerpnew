<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invb06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 年底結轉   invlc invlb 各期餘額 轉下月
	function batchaf()           
        {
			$vyy=$this->input->post('dateyy1');   
			$vmm=$this->input->post('datemm1');
			$vyyvmm=$vyy.$vmm;
			$yyy = (int)$vyy+1 ;
			$mmm='00';
		    $yyymmm=$yyy.'00';
           $this->db->where('lc002', $yyymmm);
		   $this->db->delete('invlc');
		   
		   $this->db->where('lb002', $yyymmm);
		   $this->db->delete('invlb');
         //  echo var_dump($mmm);var_dump($vyy);exit;
		 // 轉入隔年00年 invlc
		   $sql = " INSERT INTO  invlc (lc001,lc002,lc003,lc004,lc005) 
			SELECT lc001,$yyymmm,lc003,lc041,lc042
			 from invlc as b
             where b.lc002='$vyyvmm' 
             order by b.lc001,b.lc002,b.lc003  ";
			 
		    $this->db->query($sql); 
			
			 $sql1 = " INSERT INTO  invlb (lb001,lb002,lb003,lb004) 
			SELECT lb001,$yyymmm,lb041,lb042
			 from invlb as b
             where b.lb002='$vyyvmm' 
             order by b.lb001,b.lb002  ";
		    $this->db->query($sql1); 
			
			
			
	         return true;  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>