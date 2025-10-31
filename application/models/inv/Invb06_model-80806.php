<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invb06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 月底結轉   actmb 各期餘額 轉下月
	function batchaf()           
        {
			$vyy=substr($this->input->post('dateyy1'),0,4);
			$vmm=substr($this->input->post('dateyy1'),5,2);
			$vyymm=$vyy.$vmm;
			$num = (int)$vmm+1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='12') {$mmm='01';$num1 = (int)$vyy+1 ;$num1 = (int)$vyy+1 ;$vnum1 =  (string)$num1;$mmm=$vnum1;}  //下月
		  //科目代號  actmb		刪除下月
           $this->db->where('lc002', $vyymm);
		   $this->db->delete('invlc'); 

		$sql="select a.* from `invlc` as a where lc002='$vyymm'  ";
	// $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
	$query = $this->db->query($sql) ;
   // while($row=mysql_fetch_assoc($result)){
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//月底金額檔  invlc
				$vlc004=$lc006-$lc008-$lc010+$lc012+$lc014+$lc018+$lc020-$lc022-$lc024;
				$vlc005=$lc007-$lc009-$lc011+$lc013+$lc015+$lc019+$lc021-$lc023-$lc025;
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'lc001' => $lc001, 
		         'lc002' => $vyy.$mmm,
		         'lc003' => $lc003,
		         'lc004' => $vlc004,
				 'lc005' => $vlc005
				     
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('invlc', $data1);	
	
	}  
			
	         return true;  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>