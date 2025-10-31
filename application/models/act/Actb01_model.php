<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 年底結轉   actmb 各期餘額 轉下月
	function batchaf()           
        {
			$vyy=$this->input->post('dateyy1');
			$vmm=$this->input->post('datemm1');
			$yyy = (int)$vyy+1 ;   //下年度
			$num = (int)$vmm+1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='12') {$mmm='00';}  //下月
			$mmm='00';  //年度月
			
			$yy1=$yyy.$mmm;  //取本期損益
			$vmbb017=0;
			
		  //科目代號  actmbb		查本期損益3219 mc005,上期代號3218 mc006
		   $query = $this->db->query("SELECT mc005,mc006   FROM actmc ");         
		foreach ($query->result() as $row)
            {
            $mc005[]=$row->mc005;
            $mc006[]=$row->mc006;			
            }
			$vmc005=$mc005[0];     //本期損益代號 3219
		    $vmc006=$mc006[0];     //上期損益代號 3218
			
			  // actmd		本期損益檔
             $sql3219=$this->db->query("SELECT sum(md003) as vmd003  FROM `actmd` WHERE  md001 = '$yy1' ");
			 foreach ($sql3219->result() as $row)
              {
                 $vmd003[]=$row->vmd003;		 
              }
			 $vmd003=$vmd003[0];     //   計算本期損益
			if (!isset($vmd003)) {$vmd003=0;}
         
		/*  $query = $this->db->query("SELECT mbb001,mbb002,mbb003,mbb016,mbb017   FROM actmbb where mbb001='$vyy' and mbb002='12' and mbb003='$vmc005' ");         
		foreach ($query->result() as $row)
            {
            $mbb017[]=$row->mbb017;		 
            }
			$vmbb017=$mbb017[0];     //本期損益金額轉上期代號
			if (!isset($vmbb017))   { $vmbb017=0; }   */
		 
		 //刪除 計算年00 虛帳戶資料
			         $this->db->where('mb002', $yyy);
					 $this->db->where('mb003', '00');
				     $this->db->where('mb001 >=', 4);
		             $this->db->delete('actmb'); 
					 
					  $this->db->where('mbb001', $yyy);
					 $this->db->where('mbb002', '00');
				     $this->db->where('mbb003 >=', 4);
		             $this->db->delete('actmbb'); 
		 
		/*  $sql2 = "INSERT INTO  actmb (mb001,mb002,mb003,mb005,mb010) values ($vmc006,$yyy,'00',$vmbb017,$vmbb017)  "; 
          $this->db->query($sql2);	 */
		  //2016 00 年本期損益 actmd 3219 轉入前期損益
		   $sql3= "update actmbb set mbb017='$vmd003'  where  mbb001='$yyy' and mbb002='$mmm' and mbb003='$vmc006' ";
		   $this->db->query($sql3);
		   
		 //  $sql3a= "update actmb set mb005='$vmd003',mb010='$vmd003'  where  mb002='$yyy' and mb003='$mmm' and mb001='$vmc006' ";
		   $sql3a= "INSERT INTO  actmb (mb001,mb002,mb003,mb005,mb010) values ($vmc006,$yyy,'00',$vmd003,$vmd003)   ";
		   $this->db->query($sql3a);
			
	         return true;  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>