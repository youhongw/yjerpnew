<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acrb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
//計算銷貨 	
	public function batchaf()   	
        {
		  $vta001=$this->input->post('acrq01a61');    //結帳單別單別,單據日期 ta038 改 ta003  1050106 取號
	      $vta003=substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2);
		  $sql = " SELECT ta001,ta003,MAX(ta002) as ta002  FROM acrta     
		  WHERE ta001 = '$vta001'  AND ta003 = '$vta003'  "; 
		  $query = $this->db->query($sql);
		  $i=0;
		  
		  foreach ($query->result() as $row)
            {  
			$mta002[]=$row->ta002;                 //結帳單單號 $vta002  26  >'0'
			//$i++;
            }
			IF ($mta002[0] >'0' )
			      { $vta002=$mta002[0]; $num = (int)$vta002 ; $vta002 =  (string)$num; }
			ELSE {$vta002=$vta003.'000';}

		  // 滙率 幣別 $vta008  測試 echo sleep(10)
		   $mta009[0]=1;
		   // test
		   $vta008=$this->input->post('cmsq06a');    //幣別
		   $sql = " SELECT mg001,mg003,MAX(mg002) as mg002  FROM cmsmg 
		  WHERE mg001 = '$vta008' group by mg001,mg003  "; 
		  $query = $this->db->query($sql);
		  $i=0;
		    if ($query->num_rows() > 0)  {
		  foreach ($query->result() as $row)
            {  
			$mta009[]=$row->mg003;                 //匯率 $vta009 預設1
		//	$i++;
            }
			}
			if ($mta009[0] >'0' AND $mta009[0] <= '999999' ) {$vta009=$mta009[0]; }
             ELSE {$vta009=1;}	
		  
		  //客戶 結帳日 銷貨資料		  
	      $btg005=$this->input->post('copq01ac');    
	      $etg005=$this->input->post('copq01ao');
		  $btg003=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $etg003=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
          $n=2;
          $totqty=0;
	      $vtc0022=$vta002;
	      $vtc0021=$vta002;
	      $vtc002=$vta002;       //單號
	      $mvtc002=$vta002;        //單號換客戶時使用單頭 結帳單號
	      $num1 = (int)$mvtc002 + 1;
	      $mvtc002 =  (string)$num1;
	
          $vtb010='';           //客戶
	
	 $vtg013=0;  $vtg025=0;  $vtg045=0;  $vtg046=0;$vtg200=0;      //小計     
	      
	$vdail=0;             //第一次廻圈
	$mno='1000';
	$vno=1000;
	
	//		sleep(10);單別,單號,日期,客戶,部門,6業務,7客戶全名,10廠別,11幣別,12匯率,16發票聯數,17課稅別,21發票日,44稅率, 200未收,20備註,ma031付款條件,th018備註,th004品號,確認碼, 更新碼
   
	  $sql="select tg001,tg002,tg003,tg004,tg005,tg006,tg007,tg008,tg010,tg011,tg012,tg016,tg017,tg021,tg044,tg013+tg025-tg052-tg053 as tg200,tg020,tg013,tg025,tg045,tg046,tg031,ma031,tg033
	  from `coptg` as a,`copma` as b
	  where   tg004=ma001  AND tg004 >= '$btg005' AND tg004 <= '$etg005' AND tg042 >= '$btg003' AND tg042<='$etg003' AND tg004 !='' AND tg023='Y' AND tg024='N'
	  order by  tg004,tg001,tg002 ";
	//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
   // while($row=mysql_fetch_assoc($result)){
	    $query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {

        foreach($row as $i=>$v){
            $$i=$v;
        }
		   
		  if ($vdail==0) {$vtb010=$tg004;  }            //第一筆 客戶相等 1040306
			if ($vtb010==$tg004 and  $vdail==0 ) {$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;}   //vtc0021 單號+1	
		 
				if ($vtb010==$tg004 and  $vdail==0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
			       $mno='1000';$vno=1000;$vtb010=$tg004;  } 
				if ($vtb010!=$tg004 and $vdail >0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
				   $mno='1000';$vno=1000;$vtb010=$tg004;  } 
				   
	 	    $totqty+=$tg033;   
			$vtb010=$tg004;  //客戶代號
			
		//	echo $mvtc002.'test';
		//	sleep(5);
			
			$vdail++;           //預設 0  
			$vno = $vno + 10;   //預設1000
			
				//明細 acrtb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tb001' => $this->input->post('acrq01a61'), 
		         'tb002' => $vtc002,
		         'tb003' => (string)$vno,
		         'tb004' => '1',
		         'tb005' => $tg001,
				 'tb006' => $tg002,
				 'tb012' => 'Y', 
				 'tb017' => $tg013,
			     'tb018' => $tg025,
		         'tb019' => $tg045,
				 'tb020' => $tg046
				     
                );	
		   if ($tg004>='') {$this->db->insert('acrtb', $data1);}
			
		   //不同單號合計歸0
		   if ($mvtc002<>$vtc002  ) {
			   $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acrq01a61'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $mtg004,
		         'ta005' => $mtg006,   //業務員
				 'ta006' => $mtg010,  //廠別
				 'ta008' => $mtg007,  //客戶全名
			     'ta009' => $mtg011,  //幣別
		         'ta010' => $mtg012,   //匯率
				 'ta011' => $mtg016,    //發票聯數
				 'ta025' => 'Y',       //確認碼
				 'ta027' => 'N',       //結案碼
				 'ta012' => $mtg017,    //課稅別
				 'ta022' => $mtg020,    //備註
				 'ta016' => $mtg021,    //發票日期				
				 'ta038' =>date("Ymd"),    //單據日
				 'ta039' =>$this->session->userdata('manager'),     
				 'ta040' => $mtg044,     //營業稅率
			     'ta048' => 'N',          //簽核狀態  
				 'ta029' => $vtg013,    
 				 'ta030' => $vtg025, 
				 'ta041' => $vtg045, 
				 'ta042' => $vtg046, 
				 'ta031' => 0
				// 'ta031' => $vtg200
                );	
			   
			   $this->db->insert('acrta', $data);
			   $num2 = (int)$mvtc002 + 1;
	           $mvtc002 =  (string)$num2;
			   $vtg013=0;$vtg025=0;$vtg045=0;$vtg046=0;$vtg200=0;}
			   //合計不同單號 
			$vtg013=$vtg013+$tg013;
			$vtg025=$vtg025+$tg025;
			$vtg045=$vtg045+$tg045;
			$vtg046=$vtg046+$tg046;
			$vtg200=$vtg200+$tg200;
			
			$mtg004=$tg004;
			$mtg006=$tg006;
           	$mtg010=$tg010;
           	$mtg007=$tg007;
			$mtg011=$tg011;
			$mtg012=$tg012;
           	$mtg016=$tg016;
           	$mtg017=$tg017;
			$mtg020=$tg020;
			$mtg021=$tg021;
           	$mtg044=$tg044;
		$n++; 
		
    }
	if (isset($mtg004)) {
	  $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acrq01a61'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $mtg004,
		         'ta005' => $tg006,   //業務員
				 'ta006' => $tg010,  //廠別
				 'ta008' => $tg007,  //客戶全名
			     'ta009' => $tg011,  //幣別
		         'ta010' => $tg012,   //匯率
				 'ta011' => $tg016,    //發票聯數
				 'ta025' => 'Y',       //確認碼
				  'ta027' => 'N',       //結案碼
				 'ta012' => $tg017,    //課稅別
				 'ta022' => $tg020,    //備註
				 'ta016' => $tg021,    //發票日期				
				 'ta038' =>date("Ymd"),    //單據日
				 'ta039' =>$this->session->userdata('manager'),     
				 'ta040' => $tg044,     //營業稅率
			     'ta048' => 'N',          //簽核狀態  
				 'ta029' => $vtg013,    
 				 'ta030' => $vtg025, 
				 'ta041' => $vtg045, 
				 'ta042' => $vtg046, 
				  'ta031' => 0
				// 'ta031' => $vtg200
                );	
	$this->db->insert('acrta', $data); }
	//銷貨單更新碼N 改 Y TG024 
	$sql9 =" update coptg as c,(select tb005,tb006,tg024 from acrtb as b,coptg as c
                   where  tb005=tg001 and tb006=tg002
                      and tg004 >= '$btg005' AND tg004 <= '$etg005' AND tg042 >= '$btg003' AND tg042<='$etg003' AND tg004 !='' AND tg023='Y' AND tg024='N'
                ) d
               set c.tg024='Y'
               where d.tb005=c.tg001 and d.tb006=c.tg002  " ; 

$this->db->query($sql9);

	
	
		  return true;	
    }  
 
    //計算銷退 	
	public function batchbf()           
        {		
	      $vta001=$this->input->post('acrq01a61');    //結帳單別單別,單據日期  ta038 改 ta003  1050106 取號
	      $vta003=substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2);
		  $sql = " SELECT ta001,ta003,MAX(ta002) as ta002  FROM acrta     
		  WHERE ta001 = '$vta001'  AND ta003 = '$vta003'  "; 
		  $query = $this->db->query($sql);
		  $i=0;
		  
		  foreach ($query->result() as $row)
            {  
			$mta002[]=$row->ta002;                 //結帳單單號 $vta002
			$i++;
            }
			IF ($mta002[0] > '0'  ) {
			 $vta002=$mta002[0]; $num = (int)$vta002 ; $vta002 =  (string)$num; }
			ELSE {$vta002=$vta003.'000';}

		  // 滙率 幣別 $vta008  測試 echo sleep(10)
		   $mta009[0]=1;
		   $vta008=$this->input->post('cmsq06a');    //幣別
		   $sql = " SELECT mg001,mg003,MAX(mg002) as mg002  FROM cmsmg 
		  WHERE mg001 = '$vta008' group by mg001,mg003  "; 
		  $query = $this->db->query($sql);
		  $i=0;
		    if ($query->num_rows() > 0)  {
		  foreach ($query->result() as $row)
            {  
			$mta009[]=$row->mg003;                 //匯率 $vta009 預設1
			$i++;
            }
			}
			if ($mta009[0] >'0' AND $mta009[0] <= '999999' ) {$vta009=$mta009[0]; }
             ELSE {$vta009=1;}	
		  
		  //客戶 結帳日 銷退資料		  
	      $btg005=$this->input->post('copq01ac');    
	      $etg005=$this->input->post('copq01ao');
		  $btg003=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $etg003=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
          $n=2;
          $totqty=0;
	      $vtc0022=$vta002;
	      $vtc0021=$vta002;
	      $vtc002=$vta002;       //單號
	      $mvtc002=$vta002;        //單號換客戶時使用單頭
	      $num1 = (int)$mvtc002 + 1;
	      $mvtc002 =  (string)$num1;
	
          $vtb010='';           //客戶
	
	 $vtg013=0;  $vtg025=0;  $vtg045=0;  $vtg046=0;$vtg200=0;      //小計     
	      
	$vdail=0;             //第一次廻圈
	$mno='1000';
	$vno=1000;
	
	//		sleep(10);單別,單號,日期,客戶,部門,6業務,7客戶全名,10廠別,11幣別,12匯率,16發票聯數,17課稅別,21發票日,44稅率, 200未收,20備註,ma031付款條件, th018備註,th004品號
   //	單據日34	sleep(10);單別,單號,日期,4客戶,部門,6業務,21客戶全名,7廠別,8幣別,9匯率,14發票號碼,13課稅別,17發票日,36稅率, 200未收,20備註,39付款條件,金額,稅額,本幣金額,稅額,確認碼,數量
   	  
	/*  $sql="select ti001 as tg001,ti002 as tg002,ti003 as tg003,ti004 as tg004,ti005 as tg005,ti006 as tg006,ti021 as tg007,ti023 as tg008,
	ti007 as tg010,ti008 as tg011,ti009 as tg012,ti014 as tg016,ti013 as tg017,ti017 as tg021,ti036 as tg044,ti010+ti011 as tg200,ti020 as tg020,
	ti039 as tg039,ti010 as tg013,ti011 as tg025,ti037 as tg045,ti038 as tg046,ti019 as tg031,ma031,ti029 as tg033
	  from `copti` as a,`copma` as b
	  where   ti004=mi001  AND ti004 >= '$btg005' AND ti004 <= '$etg005' AND ti034 >= '$btg003' AND ti034<='$etg003' AND ti004 !=''
	  order by  ti004,ti001,ti002 ";  */
	  
	//  $sql="select tg001,tg002,tg003,tg004,tg005,tg006,tg007,tg008,tg010,tg011,tg012,tg016,tg017,tg021,tg044,tg013+tg025-tg052-tg053 as tg200,tg020,tg013,tg025,tg045,tg046,tg031,ma031,tg033	
   /*   $sql="select ti001,ti002,ti003,ti004,ti005,ti006,ti021,ti023,ti007,ti008,ti009,ti014,ti013,ti017,ti036,ti010+ti011 as ti200,ti020,ti039,ti010,ti011,ti037,ti038,ti019,ma031,ti029
	  from `copti` as a,`copma` as b
	  where   ti004=ma001  AND ti004 >= '$btg005' AND ti004 <= '$etg005' AND ti042 >= '$btg003' AND ti042<='$etg003' AND tg004 !=''
	  order by  ti004,ti001,ti002 ";  */
	$sql="select ti001 as tg001,ti002 as tg002,ti003 as tg003,ti004 as tg004,ti005 as tg005,ti006 as tg006,ti021 as tg007,ti023 as tg008,
	ti007 as tg010,ti008 as tg011,ti009 as tg012,ti014 as tg016,ti013 as tg017,ti017 as tg021,ti036 as tg044,ti010+ti011 as tg200,ti020 as tg020,
	ti039 as tg039,ti010 as tg013,ti011 as tg025,ti037 as tg045,ti038 as tg046,ti019 as tg031,ti029 as tg033,ma031
	from copti as a,copma as b where ti004=ma001 and ti004>='$btg005' and ti004 <='$etg005' and ti034>='$btg003' and ti034<='$etg003' and ti004 !='' AND ti019='Y' AND ti018='N'
    order by ti004,ti001,ti002	";
	//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    //while($row=mysql_fetch_assoc($result)){
		$query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {

        foreach($row as $i=>$v){
            $$i=$v;
        }
		   
		  if ($vdail==0) {$vtb010=$tg004;  }            //第一筆 客戶相等
			if ($vtb010==$tg004 and  $vdail==0 ) {$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;}   //vtc0021 單號+1	
		 
				if ($vtb010==$tg004 and  $vdail==0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
			       $mno='1000';$vno=1000;$vtb010=$tg004;  } 
				if ($vtb010!=$tg004 and $vdail >0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
				   $mno='1000';$vno=1000;$vtb010=$tg004;  } 
				   
	 	    $totqty+=$tg033;   
			$vtb010=$tg004;  //客戶代號
			
		//	echo $mvtc002.'test';
		//	sleep(5);
			
			$vdail++;           //預設 0  
			$vno = $vno + 10;   //預設1000
			
				//明細 acrtb  1050302
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tb001' => $this->input->post('acrq01a61'), 
		         'tb002' => $vtc002,
		         'tb003' => (string)$vno,
		         'tb004' => '2',
		         'tb005' => $tg001,
				 'tb006' => $tg002,
				 'tb012' => 'Y', 
				 'tb017' => ($tg013)*-1,
			     'tb018' => ($tg025)*-1,
		         'tb019' => ($tg045)*-1,
				 'tb020' => ($tg046)*-1
				     
                );	
		   if ($tg004>='') {$this->db->insert('acrtb', $data1);}
			
		   //不同單號合計歸0
		   if ($mvtc002<>$vtc002  ) {
			   $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acrq01a61'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $mtg004,
		         'ta005' => $mtg006,   //業務員
				 'ta006' => $mtg010,  //廠別
				 'ta008' => $mtg007,  //客戶全名
			     'ta009' => $mtg011,  //幣別
		         'ta010' => $mtg012,   //匯率
				 'ta011' => $mtg016,    //發票聯數
				 'ta025' => 'Y',       //確認碼
				  'ta027' => 'N',       //結案碼
				 'ta012' => $mtg017,    //課稅別
				 'ta022' => $mtg020,    //備註
				 'ta016' => $mtg021,    //發票日期				
				 'ta038' =>date("Ymd"),    //單據日
				 'ta039' =>$this->session->userdata('manager'),     
				 'ta040' => $mtg044,     //營業稅率
			     'ta048' => 'N',          //簽核狀態  
				 'ta029' => ($vtg013)*-1,    
 				 'ta030' => ($vtg025)*-1, 
				 'ta041' => ($vtg045)*-1, 
				 'ta042' => ($vtg046)*-1, 
			     'ta031' => 0
			//	 'ta031' => $vtg200
                );	
			   
			   $this->db->insert('acrta', $data);
			   $num2 = (int)$mvtc002 + 1;
	           $mvtc002 =  (string)$num2;
			   $vtg013=0;$vtg025=0;$vtg045=0;$vtg046=0;$vtg200=0;}
			   //合計不同單號 
			$vtg013=$vtg013+$tg013;
			$vtg025=$vtg025+$tg025;
			$vtg045=$vtg045+$tg045;
			$vtg046=$vtg046+$tg046;
			$vtg200=$vtg200+$tg200;
			
			$mtg004=$tg004;
			$mtg006=$tg006;
           	$mtg010=$tg010;
           	$mtg007=$tg007;
			$mtg011=$tg011;
			$mtg012=$tg012;
           	$mtg016=$tg016;
           	$mtg017=$tg017;
			$mtg020=$tg020;
			$mtg021=$tg021;
           	$mtg044=$tg044;
		$n++; 
		
    }
	   if (isset($mtg004)) {
	  $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acrq01a61'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $mtg004,
		         'ta005' => $tg006,   //業務員
				 'ta006' => $tg010,  //廠別
				 'ta008' => $tg007,  //客戶全名
			     'ta009' => $tg011,  //幣別
		         'ta010' => $tg012,   //匯率
				 'ta011' => $tg016,    //發票聯數
				 'ta025' => 'Y',       //確認碼
				  'ta027' => 'N',       //結案碼
				 'ta012' => $tg017,    //課稅別
				 'ta022' => $tg020,    //備註
				 'ta016' => $tg021,    //發票日期				
				 'ta038' =>date("Ymd"),    //單據日
				 'ta039' =>$this->session->userdata('manager'),     
				 'ta040' => $tg044,     //營業稅率
			     'ta048' => 'N',          //簽核狀態  
				 'ta029' => ($vtg013)*-1,    
 				 'ta030' => ($vtg025)*-1, 
				 'ta041' => ($vtg045)*-1, 
				 'ta042' => ($vtg046)*-1, 
				  'ta031' => 0
			//	 'ta031' => $vtg200
                );	
	  $this->db->insert('acrta', $data); }
	//銷退單更新碼N 改 Y TI018 
	$sql91 =" update copti as c,(select tb005,tb006,ti018 from acrtb as b,copti as c
                   where  tb005=ti001 and tb006=ti002
                      and ti004>='$btg005' and ti004 <='$etg005' and ti034>='$btg003' and ti034<='$etg003' and ti004 !='' AND ti019='Y' AND ti018='N'
                ) d
               set c.ti018='Y'
               where d.tb005=c.ti001 and d.tb006=c.ti002  " ; 

$this->db->query($sql91);

		  return true;	
    }  
	 		
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>