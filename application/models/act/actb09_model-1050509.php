<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actb09_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	
//計算 月底結轉   actmb 各期餘額 轉下月
	function batchaf()           
        {
			$vyy=$this->input->post('dateyy1');
			$vmm=$this->input->post('datemm1');
			$yyy = (int)$vyy+1 ;
			$num = (int)$vmm+1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			
			if ($vmm=='12') {$yyy=$yyy;$mmm='00';} else {$yyy=$vyy;}  //下月
		  //科目代號  actmb		刪除下月 1050505
		
           $this->db->where('mb002', $yyy);
		   $this->db->where('mb003', $mmm);
		  $this->db->delete('actmb');
         //  echo var_dump($mmm);var_dump($vyy);exit;
		   
		$sql="select a.* from `actmb` as a where mb002='$vyy' and mb003='$vmm'  ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//科目各期金額檔  actmb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mb001' => $mb001, 
		         'mb002' => $yyy,
		         'mb003' => $mmm,
		         'mb004' => $mb004,
				 'mb005' => $mb005,
			     'mb006' => $mb006,
				 'mb007' => $mb007,
				 'mb008' => $mb008,
				 'mb009' => $mb009,
				 'mb010' => $mb010
				     
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('actmb', $data1);	
	
	}  
	// 試算表
     //科目代號  actmba		刪除下月
	     
           $this->db->where('mba001', $yyy);
		   $this->db->where('mba002', $mmm);
		  $this->db->delete('actmba');  

		$sql="select a.* from `actmba` as a where mba001='$vyy' and mba002='$vmm'  ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//科目各期金額檔  actmba  
		$data12 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mba001' => $yyy,
		         'mba002' => $mmm,
		         'mba003' => $mba003,
		         'mba004' => $mba004,
				 'mba005' => $mba005,
			     'mba006' => $mba014,
				 'mba007' => $mba015
				
				     
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('actmba', $data12);	
	
	}
   // 損益表  actmd  1050421 
            $yy1=$this->input->post('dateyy1');
			$yymm1=$yyy.'00';
			
			 $query9991 = $this->db->query("SELECT mc005,mc006   FROM actmc ");         
		     foreach ($query9991->result() as $row)
              {
               $mc005[]=$row->mc005;	
                $mc006[]=$row->mc006;				   
               }
			$vmc005=$mc005[0];     //   計算本期損益						
			$vmc006=$mc006[0];     //上期損益代號 3218
			$v12=0;             //暫時停用1050505
			
            if ($vmm=='12') {  
			//刪除本期損益
		    $this->db->where('md001', $yymm1);
		    $this->db->delete('actmd'); 
		  //科目代號  actmd		本期損益3218
             $sql3219=$this->db->query("SELECT sum(md003) as vmd003  FROM `actmd` WHERE substring( md001, 1, 4 ) = '$yy1' ");
			 foreach ($sql3219->result() as $row)
              {
                 $vmd003[]=$row->vmd003;		 
              }
			$vmd003=$vmd003[0];     //   計算本期損益
			if (!isset($vmd003)) {$vmd003=0;}
			
			 $sqla1="insert into  actmd(md001,md002,md003) values ($yymm1,$vmc005,$vmd003)  ";
			 $this->db->query($sqla1);
		//科目全部資料actmbb	刪除下月 1040522
		$this->db->where('mbb001', $yyy);
		$this->db->where('mbb002', $mmm);
		    $this->db->delete('actmbb'); 
			
		$sql2= "INSERT INTO actmbb(mbb001,mbb002,mbb003,mbb004,mbb005,mbb016,mbb017) 
SELECT '$yyy','$mmm',mbb003,mbb004,mbb005,mbb016,mbb017 from actmbb b
WHERE  b.mbb001='$vyy' and b.mbb002='$vmm' ";
         $this->db->query($sql2);
 
		  //2016 00 年本期損益 actmd 3219 轉入前期損益
		   //echo var_dump($yyy.$mmm.$vmc006);var_dump($vmd003);exit;
		   
		   $sql3= "update actmbb set mbb017='$vmd003'  where  mbb001='$yyy' and mbb002='$mmm' and mbb003='$vmc006' ";
		   $this->db->query($sql3);
			 $v12=1;
			 }
			 
			 //自動月結 00 月actb09_model->
		     if ($v12==1) { $this->batchaf00($yyy,$mmm); } 
			 //月底結轉把前期損益 1050506
			 
			 
			 
	         return true;  
   }  //	batchaf
   
	 function batchaf00($vyy,$vmm)           
        {
			
			$yyy = (int)$vyy+1 ;
			$num = (int)$vmm+1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			
			if ($vmm=='12') {$yyy=$yyy;$mmm='00';} else {$yyy=$vyy;}  //下月
		  //科目代號  actmb		刪除下月 2016,00
           $this->db->where('mb002', $yyy);
		   $this->db->where('mb003', $mmm);
		   $this->db->delete('actmb'); 
         //  echo var_dump($mmm);var_dump($vyy);exit;
		   
		$sql="select a.* from `actmb` as a where mb002='$vyy' and mb003='$vmm'  ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//科目各期金額檔  actmb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mb001' => $mb001, 
		         'mb002' => $yyy,
		         'mb003' => $mmm,
		         'mb004' => $mb004,
				 'mb005' => $mb005,
			     'mb006' => $mb006,
				 'mb007' => $mb007,
				 'mb008' => $mb008,
				 'mb009' => $mb009,
				 'mb010' => $mb010
				     
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('actmb', $data1);	
	
	}  
	// 試算表
     //科目代號  actmba		刪除下月
           $this->db->where('mba001', $yyy);
		   $this->db->where('mba002', $mmm);
		   $this->db->delete('actmba'); 

		$sql="select a.* from `actmba` as a where mba001='$vyy' and mba002='$vmm'  ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//科目各期金額檔  actmba  
		$data12 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mba001' => $yyy,
		         'mba002' => $mmm,
		         'mba003' => $mba003,
		         'mba004' => $mba004,
				 'mba005' => $mba005,
			     'mba006' => $mba014,
				 'mba007' => $mba015,
				 'mba014' => $mba014,
				 'mba015' => $mba015
				     
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('actmba', $data12);	
	
	}  //actmba 試算表
			 }  //fun00
			
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>