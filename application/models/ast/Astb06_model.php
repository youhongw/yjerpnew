<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class astb06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 全面計算copy invb13 轉入 invtd1 invtd 
	function batchaf()           
        {
			$vtd001=$this->input->post('td001c');
			$vtd002=substr($this->input->post('ta034c'),0,4).substr($this->input->post('ta034c'),5,2).substr(rtrim($this->input->post('ta034c')),8,2);
		 
		 $vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			$vyymm=$vyy.$vmm;
			//上月 $vmm
			$num = (int)$vmm-1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='01') {$mmm='12';}  //上月
           //共用參數盤點日期轉入		1050615	invb07
		//	$sql0 = " UPDATE  cmsma set ma204=$vtd002  WHERE 1=1 ";
         //   $this->db->query($sql0); 
			
		  //invmc 統計檔 
		          //刪除 庫存檔 invmc
			    //     $this->db->where('mc001 >=', '0');
		        //     $this->db->delete('invmc'); 
					 
		//	$sql = " INSERT INTO  invmc (company,creator,usr_group,create_date,modifier,modi_date,flag,mc001,mc002,mc003,mc007)
		//	            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,a.mb001,b.mc001,a.mb004,0  from invmb as a,cmsmc as b ";
        //    $this->db->query($sql); 
		//取盤點日期檔代號
			 
		// invmb  品號主檔update  數量 57  成本64,65 	 1050617	
	/*	$sqlz14 = " UPDATE  `invmb`         
    SET mb057=mb065/mb064 
    WHERE mb064 > 0   ";
		    $this->db->query($sqlz14);  */		

		//實盤數量轉入
        /*    $this->db->where('td001', $vtd001);
			$this->db->where('td002', $vtd002);
		    $this->db->delete('invtd'); 		  
		  
		    $sql1 = " INSERT INTO  invtd (td001,td002,td003,td005,td007) 
			     SELECT td1001,td1002,td1005,td1003,sum(td1006) as td1006 from invtd1 where td1001='$vtd001' and td1002='$vtd002' group by td1001,td1002,td1005,td1003 order by td1001,td1002,td1005,td1003 ";
		    $this->db->query($sql1);	  
		   
		   //帳面數量轉入
		   $sql2 =" UPDATE  
           `invtd` AS A,  
           (SELECT mc001,mc002,mc007  FROM `invmc` ) AS B  SET A.`td006`=B.`mc007` WHERE A.`td003`=B.`mc001` AND A.`td005`=B.`mc002`  " ; 
		
		    $this->db->query($sql2);
			//盤盈虧轉入
			 $sql3 = " UPDATE  invtd set td014=td006-td007  where td001='$vtd001' and td002='$vtd002'  ";
		      $this->db->query($sql3);  */
			
	         return true;  
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>