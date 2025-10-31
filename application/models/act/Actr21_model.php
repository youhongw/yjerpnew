<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actr21_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	                           
	function printfd()          
        {
			//先計算試算表actmba
			$this->batchcf();
			
			//損益表  actmbb 
		    $vyy=substr($this->input->post('vdate'),0,4);
			$vmm=substr($this->input->post('vdate'),5,2);
			IF (substr($vmm,0,1)!='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			$this->db->where('mbb001', $vyy);
			$this->db->where('mbb002', $vmm);
			$this->db->delete('actmbb');
			//insert into 科目代號轉入損益表
			if (substr($vmm,0,1)!='0')  {
			 $sql = " INSERT INTO  actmbb (mbb001,mbb002,mbb003,mbb004,mbb005,mbb016,mbb017,mbb018,mbb019) 
			SELECT $vyy,concat('',$vmm ),ma001,ma003,ma008,0,0,ma018,ma002 FROM actma WHERE ma001>= '1'  "; }
			else {
			 $sql = " INSERT INTO  actmbb (mbb001,mbb002,mbb003,mbb004,mbb005,mbb016,mbb017,mbb018,mbb019) 
			SELECT $vyy,concat('0',$vmm ),ma001,ma003,ma008,0,0,ma018,ma002 FROM actma WHERE ma001>= '1'  "; }
			
		     $this->db->query($sql);
			 
			//update  試算表資料轉入損益表
             $sql2 =" update actmbb b,(select a.mba001 ,a.mba002 ,
               a.mba003 ,a.mba016 ,a.mba017 
               from actmba  a
               where a.mba001='$vyy' and a.mba002='$vmm'
                ) c
               set b.mbb016=c.mba016, b.mbb017=c.mba017
               where b.mbb001=c.mba001 and  b.mbb002=c.mba002 and  b.mbb003=c.mba003 
			   and b.mbb001='$vyy' and b.mbb002='$vmm'  " ; 
			 $this->db->query($sql2);			 
		
		//分類 計算金額 1071224 , 1,2,3階
		
			$sql4001 = " UPDATE  actmbb as a,  
         (select mbb001,mbb002,mbb019,sum(mbb016) as vmbb016,sum(mbb017) as vmbb017
          from  actmbb 
          where  mbb001= '$vyy' and mbb002='$vmm' and mbb019>'0' and ( mbb016!=0 or mbb017!=0 )
          group by mbb001,mbb002,mbb019 ) as b  
         set a.mbb016=b.vmbb016, a.mbb017=b.vmbb017 
         where a.mbb003=b.mbb019 and  a.mbb001 = '$vyy'  and a.mbb002 = '$vmm'  ";
		  $this->db->query($sql4001); 			
		$sql4002 = " UPDATE  actmbb as a,  
         (select mbb001,mbb002,mbb019,sum(mbb016) as vmbb016,sum(mbb017) as vmbb017
          from  actmbb 
          where  mbb001= '$vyy' and mbb002='$vmm' and mbb019>'0' and ( mbb016!=0 or mbb017!=0 )
          group by mbb001,mbb002,mbb019 ) as b  
         set a.mbb016=b.vmbb016, a.mbb017=b.vmbb017 
         where a.mbb003=b.mbb019 and  a.mbb001 = '$vyy'  and a.mbb002 = '$vmm'  ";
		  $this->db->query($sql4002); 
        $sql4003 = " UPDATE  actmbb as a,  
         (select mbb001,mbb002,mbb019,sum(mbb016) as vmbb016,sum(mbb017) as vmbb017
          from  actmbb 
          where  mbb001= '$vyy' and mbb002='$vmm' and mbb019>'0' and ( mbb016!=0 or mbb017!=0 )
          group by mbb001,mbb002,mbb019 ) as b  
         set a.mbb016=b.vmbb016, a.mbb017=b.vmbb017 
         where a.mbb003=b.mbb019 and  a.mbb001 = '$vyy'  and a.mbb002 = '$vmm'  ";
		  $this->db->query($sql4003); 	
            //資產負債計算 1071225 計算
		/*	$query311 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '1 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query311->result() as $row)
            {
              $mbb1016[]=$row->mbb016;
              $mbb1017[]=$row->mbb017;			
            }
			
			$query312 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '2 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query312->result() as $row)
            {
              $mbb2016[]=$row->mbb016;
              $mbb2017[]=$row->mbb017;			
            }
			
		$query313 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '3 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query313->result() as $row)
            {
              $mbb3016[]=$row->mbb016;
              $mbb3017[]=$row->mbb017;			
            } */
			 //營業毛利 5999
		  
		  $query211 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '4 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query211->result() as $row)
            {
              $mbb4016[]=$row->mbb016;
              $mbb4017[]=$row->mbb017;			
            }
			if (!isset($mbb4016[0])) {$mbb4016[0]=0;}
			if (!isset($mbb4017[0])) {$mbb4017[0]=0;}
		 $query212 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '5 '  and mbb001='$vyy' and mbb002='$vmm'  ");         
		foreach ($query212->result() as $row)
            {
            $mbb5016[]=$row->mbb016;
            $mbb5017[]=$row->mbb017;			
            }
			if (!isset($mbb5016[0])) {$mbb5016[0]=0;}
			if (!isset($mbb5017[0])) {$mbb5017[0]=0;}
		 $query213 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '6 ' and mbb001='$vyy' and mbb002='$vmm'  ");         
		foreach ($query213->result() as $row)
            {
            $mbb6016[]=$row->mbb016;
            $mbb6017[]=$row->mbb017;			
            }
		    if (!isset($mbb6016[0])) {$mbb6016[0]=0;}
			if (!isset($mbb6017[0])) {$mbb6017[0]=0;}
			
		//7 改 71, 73	
		 $query214 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,3) = '71 '  and mbb001='$vyy' and mbb002='$vmm'  ");         
		foreach ($query214->result() as $row)
            {
            $mbb71016[]=$row->mbb016;
            $mbb71017[]=$row->mbb017;			
            }
		    if (!isset($mbb71016[0])) {$mbb71016[0]=0;}
			if (!isset($mbb71017[0])) {$mbb71017[0]=0;}
			
            $query214a = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,3) = '73 '  and mbb001='$vyy' and mbb002='$vmm'  ");         
		foreach ($query214a->result() as $row)
            {
            $mbb73016[]=$row->mbb016;
            $mbb73017[]=$row->mbb017;			
            }
			if (!isset($mbb73016[0])) {$mbb73016[0]=0;}
			if (!isset($mbb73017[0])) {$mbb73017[0]=0;}
			$mbb5999a=$mbb4016[0]-$mbb5016[0];
			$mbb5999b=$mbb4017[0]-$mbb5017[0];
			
			$mbb6999a=$mbb4016[0]-$mbb5016[0]-$mbb6016[0];
			$mbb6999b=$mbb4017[0]-$mbb5017[0]-$mbb6017[0];
			
			$mbb7999a=$mbb4016[0]-$mbb5016[0]-$mbb6016[0]+$mbb71016[0]-$mbb73016[0];
			$mbb7999b=$mbb4017[0]-$mbb5017[0]-$mbb6017[0]+$mbb71017[0]-$mbb73017[0];
		
			//營業毛利 5999 actmbb 5 計算
			 $data215 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '5999',
				 'mbb004' => '營業毛利',
				 'mbb005' => '5',
				 'mbb016' => $mbb5999a,
				 'mbb017' => $mbb5999b
                );	
			$this->db->insert('actmbb', $data215);
			 //營業利益 6999
		   $data216 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '6999',
				 'mbb004' => '營業利益',
				 'mbb005' => '5',
				 'mbb016' => $mbb6999a,
				 'mbb017' => $mbb6999b
                );	
			$this->db->insert('actmbb', $data216);
		  //本期損益 7999
		   $data217 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '7999',
				 'mbb004' => '本期損益',
				 'mbb005' => '5',
				 'mbb016' => $mbb7999a,
				 'mbb017' => $mbb7999b
                );	
			$this->db->insert('actmbb', $data217);
			//本期損益 3219
			$query218 = $this->db->query("SELECT mc005 FROM actmc   ");         
		    foreach ($query218->result() as $row)
            {
              $mbb3219[]=$row->mc005;
            }
			$data219 = array(
				 'mbb004' => '本期損益',
				 'mbb005' => '5',
				 'mbb016' => $mbb7999a,
				 'mbb017' => $mbb7999b
                );					
			$this->db->where('mbb001', $vyy);
			$this->db->where('mbb002', $vmm);
            $this->db->where('mbb003', $mbb3219[0]);			
			$this->db->update('actmbb', $data219);
			//分類 計算金額 1071224 , 1,2,3階 (專計算本期損益使用)
		
			$sql4001 = " UPDATE  actmbb as a,  
         (select mbb001,mbb002,mbb019,sum(mbb016) as vmbb016,sum(mbb017) as vmbb017
          from  actmbb 
          where  mbb001= '$vyy' and mbb002='$vmm' and mbb019>'0' and ( mbb016!=0 or mbb017!=0 )
          group by mbb001,mbb002,mbb019 ) as b  
         set a.mbb016=b.vmbb016, a.mbb017=b.vmbb017 
         where a.mbb003=b.mbb019 and  a.mbb001 = '$vyy'  and a.mbb002 = '$vmm'  ";
		  $this->db->query($sql4001); 			
		$sql4002 = " UPDATE  actmbb as a,  
         (select mbb001,mbb002,mbb019,sum(mbb016) as vmbb016,sum(mbb017) as vmbb017
          from  actmbb 
          where  mbb001= '$vyy' and mbb002='$vmm' and mbb019>'0' and ( mbb016!=0 or mbb017!=0 )
          group by mbb001,mbb002,mbb019 ) as b  
         set a.mbb016=b.vmbb016, a.mbb017=b.vmbb017 
         where a.mbb003=b.mbb019 and  a.mbb001 = '$vyy'  and a.mbb002 = '$vmm'  ";
		  $this->db->query($sql4002); 
        $sql4003 = " UPDATE  actmbb as a,  
         (select mbb001,mbb002,mbb019,sum(mbb016) as vmbb016,sum(mbb017) as vmbb017
          from  actmbb 
          where  mbb001= '$vyy' and mbb002='$vmm' and mbb019>'0' and ( mbb016!=0 or mbb017!=0 )
          group by mbb001,mbb002,mbb019 ) as b  
         set a.mbb016=b.vmbb016, a.mbb017=b.vmbb017 
         where a.mbb003=b.mbb019 and  a.mbb001 = '$vyy'  and a.mbb002 = '$vmm'  ";
		  $this->db->query($sql4003); 	
		  //股東權益重計算
		  	$query311 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '1 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query311->result() as $row)
            {
              $mbb1016[]=$row->mbb016;
              $mbb1017[]=$row->mbb017;			
            }
			if (!isset($mbb1016[0])) {$mbb1016[0]=0;}
			if (!isset($mbb1017[0])) {$mbb1017[0]=0;}
			$query312 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '2 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query312->result() as $row)
            {
              $mbb2016[]=$row->mbb016;
              $mbb2017[]=$row->mbb017;			
            }
			if (!isset($mbb2016[0])) {$mbb2016[0]=0;}
			if (!isset($mbb2017[0])) {$mbb2017[0]=0;}
		$query313 = $this->db->query("SELECT mbb016,mbb017 FROM actmbb 
		  WHERE  substring(mbb003,1,2) = '3 '  and mbb001='$vyy' and mbb002='$vmm'   ");         
		foreach ($query313->result() as $row)
            {
              $mbb3016[]=$row->mbb016;
              $mbb3017[]=$row->mbb017;			
            }
			if (!isset($mbb3016[0])) {$mbb3016[0]=0;}
			if (!isset($mbb3017[0])) {$mbb3017[0]=0;}
		//資產負債計算
			$mbb1999a=$mbb1016[0];
			$mbb1999b=$mbb1017[0];
			
			$mbb2999a=$mbb2016[0];
			$mbb2999b=$mbb2017[0];
			
			$mbb3998a=$mbb3016[0];
			$mbb3998b=$mbb3017[0]; 
			
			$mbb3999a=$mbb2016[0]+$mbb3016[0];
			$mbb3999b=$mbb2017[0]+$mbb3017[0];
			//資產負債計算
			//資產總額 1999 actmbb
			 $data315 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '1999',
				 'mbb004' => '資產總額',
				 'mbb005' => '4',
				 'mbb016' => $mbb1999a,
				 'mbb017' => $mbb1999b
                );	
			$this->db->insert('actmbb', $data315);
			 //負債合計 2999
		   $data316 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '2999',
				 'mbb004' => '負債合計',
				 'mbb005' => '4',
				 'mbb016' => $mbb2999a,
				 'mbb017' => $mbb2999b
                );	
			$this->db->insert('actmbb', $data316);
		  //股東權益合計 3998
		   $data317 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '3998',
				 'mbb004' => '股東權益合計',
				 'mbb005' => '4',
				 'mbb016' => $mbb3998a,
				 'mbb017' => $mbb3998b
                );	
			$this->db->insert('actmbb', $data317);
		 //負債與股東權益總額 3999
		   $data318 = array(
				 'mbb001' => $vyy,
				 'mbb002' => $vmm,
				 'mbb003' => '3999',
				 'mbb004' => '負債與股東權益總額',
				 'mbb005' => '4',
				 'mbb016' => $mbb3999a,
				 'mbb017' => $mbb3999b
                );	
			$this->db->insert('actmbb', $data318); 	
		//==========計算結束
			//列印損益表1071219
	        $vyy=substr($this->input->post('vdate'),0,4);
			$vmm=substr($this->input->post('vdate'),5,2);
			$this->db->where('mbb001', $vyy);
			$this->db->where('mbb002', $vmm);
			$this->db->delete('actmbbp');
			$sqla = " INSERT INTO  actmbbp  
			SELECT *  FROM actmbb  WHERE mbb001='$vyy' and mbb002='$vmm' and mbb003>='4'  "; 					
		     $this->db->query($sqla);
			$sqlb = " delete from actmbbp  
			     WHERE mbb001='$vyy' and mbb002='$vmm' and mbb005<='3' and mbb016=0 and mbb017=0  "; 					
		     $this->db->query($sqlb);
		 
		   $this->db->select('* '); 
           $this->db->from('actmbbp ');
		   $this->db->where('mbb001 =', $vyy); 
	       $this->db->where('mbb002 =', $vmm); 
	       $this->db->where('mbb003 >=', '4');	   
	       $this->db->order_by('mbb001,mbb002,mbb003');
		
		   $query = $this->db->get();
		
          $ret['rows'] = $query->result();  
          $seq32 = "mbb001 = '$vyy'  AND mbb002 = '$vmm'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actmbbp')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		//轉excel檔	 
	function excelnewf()  {	  
	     $vyy=substr($this->input->post('vdate'),0,4);
		 $vmm=substr($this->input->post('vdate'),5,2);
	     $sql = " SELECT mbb003,mbb004,mbb016,mbb017
		 FROM actmbbp 
		 WHERE mbb001 = '$vyy'  AND mbb002 = '$vmm' and mbb003>='4' 
		  order by mbb001,mbb002,mbb003 "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		//計算 試算表檔資料 actmba OK
	function batchcf()           
        {
			$vyy=substr($this->input->post('vdate'),0,4);
			$vmm=substr($this->input->post('vdate'),5,2);
		    $mf001c=$this->input->post('mf001c');
		   $yyy = (int)$vyy-0 ;
			$num = (int)$vmm-1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}  //上月
			if ($vmm=='01') {$yyy=$yyy;$mmm='00';}    //本年$yyy,$mmm
			
			// echo var_dump($vyy);var_dump($vmm);var_dump($yyy);var_dump($mmm);exit;
		   //計算試算表
		          //刪除試算表檔月份
			        $this->db->where('mba001', $vyy);
				    $this->db->where('mba002', $vmm);
		            $this->db->delete('actmba'); 
				//年月科目insert 加上月加本月
				if (substr($vmm,0,1)=='0') {
				 $sql1=" insert  IGNORE into actmba (mba003,mba001,mba002)
				  select distinct mb001,$vyy,concat('0',$vmm ) from actmb as a 
				  where mb002='$yyy' and mb003<='$mmm' ";
				$this->db->query($sql1); }
				else {
				 $sql1=" insert  IGNORE into actmba (mba003,mba001,mba002)
				  select distinct mb001,$vyy,$vmm from actmb as a 
				  where mb002='$yyy' and mb003<='$mmm' ";
				$this->db->query($sql1); }
                  
				 $sql2=" insert IGNORE into actmba (mba003,mba001,mba002)
				  select distinct mb001,mb002,mb003 from actmb as a 
				  where mb002='$vyy' and mb003='$vmm' ";
                 $this->db->query($sql2);
				 //增加科目名稱及借貸別
				  $sql3=" update  actmba as a, 
				  (select ma001,ma003,ma007 from actma ) as c 
                  set a.mba004=c.ma003, a.mba005=c.ma007				  
				  where a.mba001='$vyy' and a.mba002='$vmm' and a.mba003=c.ma001 ";
                 $this->db->query($sql3);
				 //期初金額 上月累計(00-到上月)
				  $sqlupd1=" update  actmba as a, 
				  (select mb001,mb002,mb003,sum(mb004) as vmb004,sum(mb005) as vmb005 from actmb 
				  where  mb002='$yyy' and mb003<='$mmm' group by mb001,mb002,mb003 ) as c 
                  set a.mba026=c.vmb004, a.mba027=c.vmb005 				  
				  where a.mba001='$vyy' and a.mba002='$vmm' and a.mba003=c.mb001 ";
                 $this->db->query($sqlupd1);
				 //期初借方餘
				 $sqlupd11=" update  actmba set mba006=mba026-mba027 
				  where mba001='$vyy' and mba002='$vmm' and (mba005=1 and mba026-mba027>=0)   ";
                 $this->db->query($sqlupd11);
				  $sqlupd12=" update  actmba set mba007=mba027-mba026 
				  where mba001='$vyy' and mba002='$vmm' and (mba005=1 and mba026-mba027<0)  ";
                 $this->db->query($sqlupd12);
				 //期初貸方餘
				 $sqlupd13=" update  actmba set mba007=mba027-mba026
				  where mba001='$vyy' and mba002='$vmm' and (mba005=-1 and mba027-mba026>=0)   ";
                 $this->db->query($sqlupd13);
				  $sqlupd14=" update  actmba set mba006=mba026-mba027 
				  where mba001='$vyy' and mba002='$vmm' and  (mba005=-1 and mba027-mba026<0)  ";
                 $this->db->query($sqlupd14);
				  //本期金額
				  $sqlupd2=" update  actmba as a, 
				  (select mb001,mb004,mb005,mb006,mb007 from actmb where  mb002='$vyy' and mb003='$vmm' ) as c
                  set a.mba008=c.mb004, a.mba009=c.mb005, a.mba010=c.mb006, a.mba011=c.mb007				  
				  where mba001='$vyy' and mba002='$vmm' and mba003=c.mb001 ";
                 $this->db->query($sqlupd2);
				  //期未金額
				  $sqlupd3=" update  actmba set mba012=mba006+mba008,mba013=mba007+mba009 
				  where mba001='$vyy' and mba002='$vmm' ";
                 $this->db->query($sqlupd3);
				 //期未借方餘
				 $sqlupd4=" update  actmba set mba014=mba012-mba013 
				  where mba001='$vyy' and mba002='$vmm' and (mba005=1 and mba012-mba013>=0)   ";
                 $this->db->query($sqlupd4);
				  $sqlupd41=" update  actmba set mba015=mba013-mba012 
				  where mba001='$vyy' and mba002='$vmm' and (mba005=1 and mba012-mba013<0)  ";
                 $this->db->query($sqlupd41);
				  //期未貸方餘
				 $sqlupd5=" update  actmba set mba014=mba012-mba013
				  where mba001='$vyy' and mba002='$vmm' and (mba005=-1 and mba013-mba012<0)   ";
                 $this->db->query($sqlupd5);
				  $sqlupd51=" update  actmba set mba015=mba013-mba012
				  where mba001='$vyy' and mba002='$vmm' and  (mba005=-1 and mba013-mba012>=0)  ";
                 $this->db->query($sqlupd51);
				//期未本期及累計餘 ddddddd 1071228 14-15 modi 8-9
				 
				 $sqlupd6=" update  actmba set mba016=mba008-mba009,mba017=mba006-mba007+mba016 
				  where mba001='$vyy' and mba002='$vmm' and mba005=1  ";
                 $this->db->query($sqlupd6); 
				 if ($vmm=='01') {$sqlupd61=" update  actmba set mba016=mba008-mba009,mba017=mba014-mba015
				  where mba001='$vyy' and mba002='$vmm' and mba005=1 and mba003<='1zzz'  ";
                 $this->db->query($sqlupd61); }
				 //期未貸方餘 1071228 14-15 modi 9-8
				
				 $sqlupd7=" update  actmba set mba016=mba009-mba008,mba017=mba007-mba006+mba016 
				  where mba001='$vyy' and mba002='$vmm' and mba005=-1 ";
                 $this->db->query($sqlupd7); 
				 if ($vmm=='01') {
					$sqlupd71=" update  actmba set mba016=mba009-mba008,mba017=mba015-mba014 
				  where mba001='$vyy' and mba002='$vmm' and mba005=-1 and mba003<='1zzz' ";
                 $this->db->query($sqlupd71);  
				 }
				 // 3218 上期損益特殊計算
				 //上期損益 3218
			     $query218 = $this->db->query("SELECT mc006 FROM actmc   ");         
		         foreach ($query218->result() as $row)
                 {
                   $mbb3218[]=$row->mc006;
                 }
				 $sqlupd8=" update  actmba set mba016=0,mba017=mba007-mba006+mba016 
				  where mba001='$vyy' and mba002='$vmm' and mba005=-1 and mba003='$mbb3218[0]' ";
                 $this->db->query($sqlupd8); 
				
		  return true;	
    }  
		
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>