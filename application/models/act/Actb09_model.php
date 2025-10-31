<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actb09_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	
//計算 月底結轉   actmb 各期餘額 轉下月 2015   12  轉 2016 00
	function batchaf()           
        {
			$vyy=$this->input->post('dateyy1');   
			$vmm=$this->input->post('datemm1');
			$yyy = (int)$vyy+1 ;
			$mmm='00';
		
           $this->db->where('mb002', $yyy);
		   $this->db->where('mb003', $mmm);
		   $this->db->delete('actmb');
         //  echo var_dump($mmm);var_dump($vyy);exit;
		 // 轉入隔年00年 actmb
		   $sql = " INSERT INTO  actmb (mb001,mb002,mb003,mb008,mb004,mb005,mb006,mb007,mb009,mb010) 
			SELECT mb001,$yyy as vyy,concat('0','0' ) as vmm,mb008,sum(mb004) as vmb004,sum(mb005) as vmb005,
                      sum(mb006) as vmb006, sum(mb007) as vmb007,
                      sum(mb009) as vmb009,sum(mb010) as vmb010
			 from actmb as b
             where b.mb002='$vyy' 
             group by b.mb001,vyy,vmm,b.mb008  ";
			 
		    $this->db->query($sql); 
	// 試算表
     //科目代號  actmba		刪除下月  2016 00  12 到期初
	     
           $this->db->where('mba001', $yyy);
		   $this->db->where('mba002', $mmm);
		  $this->db->delete('actmba');  

		$sql="select a.* from `actmba` as a where mba001='$vyy' and mba002='$vmm'  ";
	//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
   // while($row=mysql_fetch_assoc($result)){
	   $query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//科目各期金額檔 actmb 轉 actmba  
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
				 'mba012' => $mba014,
				 'mba013' => $mba015,
				 'mba014' => $mba014,
				 'mba015' => $mba015
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('actmba', $data12);	
	
	}
	//計算試算表 actmba 
	            //期初金額 上月累計(00-到上月)
				/*	  $sqlupd1=" update  actmba as a, 
				  (select mb001,mb002,mb003,sum(mb004) as vmb004,sum(mb005) as vmb005 from actmb 
				  where  mb002='$vyy' and mb003<='$vmm' group by mb001,mb002,mb003 ) as c 
                  set a.mba026=c.vmb004, a.mba027=c.vmb005 				  
				  where a.mba001='$yyy' and a.mba002='$mmm' and a.mba003=c.mb001 ";
                 $this->db->query($sqlupd1);
				 //期初借方餘
				 $sqlupd11=" update  actmba set mba006=mba026-mba027 
				  where mba001='$yyy' and mba002='$mmm' and (mba005=1 and mba026-mba027>=0)   ";
                 $this->db->query($sqlupd11);
				  $sqlupd12=" update  actmba set mba007=mba027-mba026 
				  where mba001='$yyy' and mba002='$mmm' and (mba005=1 and mba026-mba027<0)  ";
                 $this->db->query($sqlupd12);
				 //期初貸方餘
				 $sqlupd13=" update  actmba set mba007=mba027-mba026
				  where mba001='$yyy' and mba002='$mmm' and (mba005=-1 and mba027-mba026>=0)   ";
                 $this->db->query($sqlupd13);
				  $sqlupd14=" update  actmba set mba006=mba026-mba027 
				  where mba001='$yyy' and mba002='$mmm' and  (mba005=-1 and mba027-mba026<0)  ";
                 $this->db->query($sqlupd14); */
				  //本期金額
			/*	  $sqlupd2=" update  actmba as a, 
				  (select mb001,mb004,mb005,mb006,mb007 from actmb where  mb002='$yyy' and mb003='$mmm' ) as c
                  set a.mba008=c.mb004, a.mba009=c.mb005, a.mba010=c.mb006, a.mba011=c.mb007				  
				  where mba001='$yyy' and mba002='$mmm' and mba003=c.mb001 ";
                 $this->db->query($sqlupd2);
	            //期未金額
				  $sqlupd3=" update  actmba set mba012=mba006+mba008,mba013=mba007+mba009 
				  where mba001='$yyy' and mba002='$mmm' ";
                 $this->db->query($sqlupd3);
				 //期未借方餘
				 $sqlupd4=" update  actmba set mba014=mba012-mba013 
				  where mba001='$yyy' and mba002='$mmm' and (mba005=1 and mba012-mba013>=0)   ";
                 $this->db->query($sqlupd4);
				  $sqlupd41=" update  actmba set mba015=mba013-mba012 
				  where mba001='$yyy' and mba002='$mmm' and (mba005=1 and mba012-mba013<0)  ";
                 $this->db->query($sqlupd41);
				 //期未貸方餘
				 $sqlupd5=" update  actmba set mba014=mba012-mba013
				  where mba001='$yyy' and mba002='$mmm' and (mba005=-1 and mba013-mba012<0)   ";
                 $this->db->query($sqlupd5);
				  $sqlupd51=" update  actmba set mba015=mba013-mba012
				  where mba001='$yyy' and mba002='$mmm' and  (mba005=-1 and mba013-mba012>=0)  ";
                 $this->db->query($sqlupd51);  */
				 //期未本期及累計餘 1071228
			/*	 $sqlupd6=" update  actmba set mba016=mba014-mba015,mba017=mba006-mba007+mba016 
				  where mba001='$yyy' and mba002='$mmm' and mba005=1  ";
                 $this->db->query($sqlupd6);
				 //期未貸方餘
				 $sqlupd7=" update  actmba set mba016=mba015-mba014,mba017=mba007-mba006+mba016 
				  where mba001='$yyy' and mba002='$mmm' and mba005=-1 ";
                 $this->db->query($sqlupd7); */
				 //期未本期及累計餘 ddddddd 1071228 14-15 modi 8-9
				 
				 $sqlupd6=" update  actmba set mba016=mba008-mba009,mba017=mba006-mba007+mba016 
				  where mba001='$vyy' and mba002='$vmm' and mba005=1  ";
                 $this->db->query($sqlupd6); 
				 if ($vmm=='01') {$sqlupd61=" update  actmba set mba016=mba008-mba009,mba017=mba014-mba015
				  where mba001='$vyy' and mba002='$vmm' and mba005=1 and mba003<='1zzz'  ";
                 $this->db->query($sqlupd61); }
				 //期未貸方餘   1071228 14-15 modi 8-9
				
				 $sqlupd7=" update  actmba set mba016=mba009-mba008,mba017=mba007-mba006+mba016 
				  where mba001='$vyy' and mba002='$vmm' and mba005=-1 ";
                 $this->db->query($sqlupd7); 
				 if ($vmm=='01') {
					$sqlupd71=" update  actmba set mba016=mba009-mba008,mba017=mba015-mba014 
				  where mba001='$vyy' and mba002='$vmm' and mba005=-1 and mba003<='1zzz' ";
                 $this->db->query($sqlupd71);  
				 }
	
   // 損益表  actmbb  1050421  計算00月本期損益 3219 1071226        
		$this->db->where('mbb001', $yyy);
		$this->db->where('mbb002', $mmm);
		    $this->db->delete('actmbb'); 
			
		$sql2= "INSERT INTO actmbb(mbb001,mbb002,mbb003,mbb004,mbb005,mbb016,mbb017,mbb018,mbb019) 
SELECT '$yyy','$mmm',mbb003,mbb004,mbb005,mbb016,mbb017,mbb018,mbb019 from actmbb b
WHERE  b.mbb001='$vyy' and b.mbb002='$vmm' ";
         $this->db->query($sql2);
           
		  
		   //本期損益mc005 3219  3218 前期損益mc006
			$query218 = $this->db->query("SELECT mc005,mc006 FROM actmc   ");         
		    foreach ($query218->result() as $row)
            {
              $mbb3219[]=$row->mc005;
			  $mbb3218[]=$row->mc006;
            }
			 //前期幣別
		   $query3218 = $this->db->query("SELECT ma018,ma003,ma019 FROM actma where ma001=$mbb3218[0]   ");         
		    foreach ($query3218->result() as $row)
            {
			  $ma018[]=$row->ma018;
			  $ma003[]=$row->ma003;
			  $ma019[]=$row->ma019;
            }
		  //2016 00 年本期損益 actmd 3219 轉入前期損益 3218
		   //echo var_dump($yyy.$mmm.$vmc006);var_dump($vmd003);exit;
		   $sql3219=$this->db->query("SELECT sum(mbb016) as vmbb016,sum(mbb017) as vmbb017  FROM `actmbb` WHERE mbb001='$vyy' and mbb003='$mbb3219[0]'  ");
			 foreach ($sql3219->result() as $row)
              {
                 $vmd016[]=$row->vmbb016;
                 $vmd017[]=$row->vmbb017;				 
              }
			$vmd016=$vmd016[0];     //   計算本期損益
			$vmd017=$vmd017[0];
			//插入 3218 前期科目 餘額檔actmb actmba actmbb
			 $sql = " INSERT IGNORE INTO  actmb (mb001,mb002,mb003,mb008) values
			           ($mbb3218[0],$yyy ,concat('0','0' ),'.$ma018[0].' ) ";
		      $this->db->query($sql); 
			  
			  $sql1 = " INSERT IGNORE INTO  actmba (mba001,mba002,mba003) values
			           ($yyy ,concat('0','0' ),$mbb3218[0]) ";
		      $this->db->query($sql1); 
			  
			   $sql2 = " INSERT IGNORE INTO  actmbb (mbb001,mbb002,mbb003) values
			           ($yyy ,concat('0','0' ),$mbb3218[0]) ";
		      $this->db->query($sql2); 
			 //餘額轉
		   $sql33= "update actmb set mb005=$vmd017,mb010=$vmd017  where  mb002='$yyy' and mb003='$mmm' and mb001='$mbb3218[0]' ";
		   $this->db->query($sql33); 
			//試算轉
		   $sql3= "update actmba set  mba007=$vmd017,mba013=$vmd017,mba015=$vmd017,mba017=$vmd017,mba027=$vmd017,mba004='$ma003[0]',mba005=$ma019[0]  where  mba001='$yyy' and mba002='$mmm' and mba003='$mbb3218[0]' ";
		   $this->db->query($sql3);
		   $sql4= "update actmba set mba016=0, mba017=0 where  mba001='$yyy' and mba002='$mmm' and mba003='$mbb3219[0]' ";
		   $this->db->query($sql4);
			//損益轉
		   $sql31= "update actmbb set  mbb017=$vmd017,mbb004='$ma003[0]'  where  mbb001='$yyy' and mbb002='$mmm' and mbb003='$mbb3218[0]' ";
		   $this->db->query($sql31);
		   $sql41= "update actmbb set mbb016=0, mbb017=0 where  mbb001='$yyy' and mbb002='$mmm' and mbb003='$mbb3219[0]' ";
		   $this->db->query($sql41); 
			 //刪除 計算年00 虛帳戶資料 actmb 各期餘額, actmba 試算表,  actmbb 損益表
			         $this->db->where('mb002', $yyy);
					 $this->db->where('mb003', '00');
				     $this->db->where('mb001 >=','4');
		             $this->db->delete('actmb'); 
					 
					 $this->db->where('mba001', $yyy);
					 $this->db->where('mba002', '00');
				     $this->db->where('mba003 >=','4');
		             $this->db->delete('actmba');
					 
                     $this->db->where('mbb001', $yyy);
					 $this->db->where('mbb002', '00');
				     $this->db->where('mbb003 >=','4');
		             $this->db->delete('actmbb');
			 
	         return true;  
   }  //	batchaf
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>