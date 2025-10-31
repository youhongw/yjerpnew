<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actb02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 本期損益期間設定   actmb 各期餘額 轉下月
	function batchaf()           
        {
			$vyy=$this->input->post('dateyy1');
			$vyy1=$vyy.'00';
			$vyy2=$vyy.'12';
		//	$vmm=$this->input->post('datemm1');
		/*	$num = (int)$vmm+1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='12') {$mmm='00';}  //下月  */
		  //科目代號  actmd		刪除 本期損益期間
        /*   $this->db->where('md001 >=', $vyy1);
		    $this->db->where('md001 <=', $vyy2);
		   $this->db->where('md003', 0);
		   $this->db->delete('actmd');  */
		    $sqld="DELETE FROM actmd WHERE md001>='$vyy1' and md001<='$vyy2' and md003=0  ";
			 $this->db->query($sqld);
		   
               // 取本期代號
           $query44 = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query44->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //本期損益代號
         $i=1;
         for ($i=1; $i<=13 ; $i++ )			
		 {
			
			  if ($i=1) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'01'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=2) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'02'),$vmc005,0) ";
			 $this->db->query($sqla);}
			  if ($i=3) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'03'),$vmc005,0) ";
			 $this->db->query($sqla);}
			  if ($i=4) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'04'),$vmc005,0) ";
			 $this->db->query($sqla);}
			  if ($i=5) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'05'),$vmc005,0) ";
			 $this->db->query($sqla);}
			  if ($i=6) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'06'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=7) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'07'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=8) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'08'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=9) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'09'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=10) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'10'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=11) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'11'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=12) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'12'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 if ($i=13) {
			 $sqla="insert into actmd (md001,md002,md003) values (concat($vyy,'00'),$vmc005,0) ";
			 $this->db->query($sqla);}
			 
		 }
		   return true;  
	}  	
	        

}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>