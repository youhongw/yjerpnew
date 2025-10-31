<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cstb02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 發薪  
	function batchaf($date='')
        {
			//echo "<script>alert('OK!!');myJsProgressBarHandler.setPercentage('element1','100');</script>";
		
		$sql="select a.* from cstmc  as a ";
		
		$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		$temp_count = 0;
		while($row=mysql_fetch_assoc($result)){
			$temp_count ++;
			foreach($row as $i=>$v){
				$$i=$v;
			}
		 
				//計算每月天數
						
				
            //   $this->db->where('td001', $mv001);
		    //   $this->db->where('td005', $vyymm1);
			//   $this->db->update('paltd', $data1);
      }			
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>