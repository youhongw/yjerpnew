<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb35_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 發薪  
	function batchaf()           
        {
			$vyymm1=substr($this->input->post('dateyymm'),0,4).substr($this->input->post('dateyymm'),5,2);
			$vyymm=$this->input->post('dateyymm');
			
		//計算年月>關帳年月 判斷
             $query = $this->db->query("SELECT ma022   FROM cmsma  
		  WHERE 1  ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;		 
            }
			$vma022=$ma022[0];		
			if ($vma022 >= $vyymm1 ) { return "計算日期要大於關帳日期.";}
		//刪除計算當月 固定扣款檔 PALTa
		   $this->db->where('ta003', $vyymm1);
		   $this->db->delete('palta'); 
		
		//新增  PALTa
		  $sql2 = "INSERT INTO  palta (ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012) 
		           select ta001,ta002,$vyymm1,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012 from palta1 as a
		            "; 
		  $this->db->query($sql2);
			
	         return  "轉入完成";  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>