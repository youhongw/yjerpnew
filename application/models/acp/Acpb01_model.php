<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acpb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006, create_date');
          $this->db->from('purtb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tb001 desc, tb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purtb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//ajax 查詢主鍵 顯示用 品類代號  
	function ajaxkey($seg1)    
        {                   
	      $this->db->set('tb002', $this->uri->segment(4));
	      $this->db->where('tb002', $this->uri->segment(4));
	      $query = $this->db->get('purtb');
			
	      if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->tb002;
           }
		   return $result;   
		  }
	    }
		
	//查詢一筆 修改用   
	function selone()    
        { 
		  $this->db->select('purtb.*,a.mv002 as tb013disp, b.mf002 as tb016disp,c.ma002 as tb010disp,d.mc002 as tb008disp,e.ta013,e.ta003,f.mb039');	
	      $this->db->from('purtb');
		  $this->db->where('purtb.tb001', $this->uri->segment(4)); 
		  $this->db->where('purtb.tb002', $this->uri->segment(5));
		  $this->db->where('purtb.tb003', $this->uri->segment(6));
		  $this->db->join('purta as e', 'purtb.tb001 = e.ta001' and 'purtb.tb002 = e.ta002','left');
		  $this->db->join('cmsmkv4 as a', 'purtb.tb013 = a.mv001','left');
	      $this->db->join('cmsmf as b', 'purtb.tb016 = b.mf001','left');
		  $this->db->join('purma as c', 'purtb.tb010 = c.ma001','left');
		  $this->db->join('cmsmc as d', 'purtb.tb008 = d.mc001','left');
		  $this->db->join('invmb as f', 'purtb.tb004 = f.mb001','left');
	      $query = $this->db->get();			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	    }		
	
		
	//計算進貨 	
	function batchaf()           
        {
		  $vta001=$this->input->post('acpq01a71');    //應付憑單別單別,單據日期
	      $vta003=substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2);
		  $sql = " SELECT ta001,ta003,MAX(ta002) as ta002  FROM acpta 
		  WHERE ta001 = '$vta001'  AND ta003 = '$vta003'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		  
		  foreach ($query->result() as $row)
            {  
			$mta002[]=$row->ta002;                 //應付憑單單號 $vta002
			$i++;
            }
			IF ($mta002[0] > '0'  ) {
			 $vta002=$mta002[0]; $num = (int)$vta002 ; $vta002 =  (string)$num; }
			ELSE {$vta002=$vta003.'000';}
		 
		    // 滙率 幣別 $vta008  測試 echo sleep(10)
		   $vta008=$this->input->post('cmsq06a');
		   $sql = " SELECT mg001,mg003,MAX(mg002) as mg002  FROM cmsmg 
		  WHERE mg001 = '$vta008'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		    if ($query->num_rows() > 0)  {
		  foreach ($query->result() as $row)
            {  
			$mta009[]=$row->mg003;                 //匯率 $vta009
			$i++;
            }
			}
			if ($mta009[0] >'0' AND $mta009[0] <= '999999' ) {$vta009=$mta009[0]; }
             ELSE {$vta009=1;}	
		  
		  //廠商 結帳日 進貨資料
		  
	      $btg005=$this->input->post('purq01ac');    
	      $etg005=$this->input->post('purq01ao'); 
		  $btg003=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $etg003=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
  
   $n=2;
    $totqty=0;
	$vtc0022=$vta002;
	$vtc0021=$vta002;
	$vtc002=$vta002;       //單號
	 $mvtc002=$vta002;        //單號換廠商時使用單頭
	      $num1 = (int)$mvtc002 + 1;
	      $mvtc002 =  (string)$num1;
    $vtb010='';           //廠商
	$vta028=0;  $vta029=0;  $vta037=0;  $vta038=0;    //小計 
	       
	$vdail=0;             //第一次廻圈
	$mno='1000';
	$vno=1000;
	//		sleep(10);單別,單號,日期,廠別,廠商tg005,廠商單號,7幣別,8匯率,10課稅別,17進貨金額,19原幣稅額,16備註,30營業稅率,31貨款金額,32稅額,
	//                9發票聯數,11發票號,22統編,26數量,27發票日,33付款代號,th3序號,4,14驗收日,19進貨金額, 45原金額,46稅額,47本金額,48本稅額,th33明細備註
    $sql="select tg001,tg002,tg003,tg014,tg004,tg005,tg006,tg007,tg008,tg010,tg017-tg018 as tg017,tg019,tg016,tg030,tg031,tg032
	               ,tg009,tg011,tg022,tg026,tg027,tg033,ma055,ma015,ma014,ma044,ma026,ma025,th003,th004,th014,(th019-th020+th045) as th019,th045,th046,th047,th048,th033
	  from `purtg` as a,`purma` as b,`purth` as c 
	  where  tg001=th001 AND tg002=th002 and tg005=ma001  AND tg005 >= '$btg005' AND tg005 <= '$etg005' AND tg014 >= '$btg003' AND tg014<='$etg003' AND tg005 !='' AND tg013='Y' AND tg015='N'
	  order by  tg005,th001,th002,th003 ";
	//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
   // while($row=mysql_fetch_assoc($result)){
	    $query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb010=$tg005;  }            //第一筆 廠商相等 1040306
			if ($vtb010==$tg005 and  $vdail==0 ) {$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;}   //vtc0021 單號+1 	
		 
				if ($vtb010==$tg005 and  $vdail==0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
			       $mno='1000';$vno=1000;$vtb010=$tg005;  } 
				if ($vtb010!=$tg005 and $vdail >0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
				   $mno='1000';$vno=1000;$vtb010=$tg005;  } 
				   
	 	    $totqty+=$tg026;   //數量
			$vtb010=$tg005;  //廠商代號
			
		//	echo $mvtc002.'test';
		//	sleep(5);
			
			$vdail++;           //預設 0  
			$vno = $vno + 10;   //預設1000
			
				//明細 acptb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tb001' => $this->input->post('acpq01a71'), 
		         'tb002' => $vtc002,
		         'tb003' => (string)$vno,
		         'tb004' => '1',
		         'tb005' => $tg001,
				 'tb006' => $tg002,
				 'tb007' => $th003,
				 'tb008' => $tg014,
				 'tb012' => 'Y', 
				 'tb011' => $th033,
				 'tb015' => $th045,
			     'tb016' => $th046,
		         'tb017' => $th047,
				 'tb018' => $th048
				     
                );	
		   if ($tg005>='') {$this->db->insert('acptb', $data1);}
			
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
                 'ta001' => $this->input->post('acpq01a71'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $mta004,   //廠商代號
		         'ta005' => $mta005,   //廠別
				 'ta006' => $mta006,  //統編
				 'ta008' => $mta008,  //幣別
			     'ta009' => $mta009,  //匯率
				 'ta011' => $mta011,    //課稅別
				 'ta021' => $mta021,       //備註
				 'ta024' => $mta024,    //確認碼
			     'ta026' => 'N',    //結案碼
				 'ta028' => $vta028,    //應付金額
				 'ta029' => $vta029,    //稅額	
                  'ta030' => 0,         //己付金額				 
				 'ta037' => $vta037,    //本幣金額
				 'ta038' => $vta038,   // 本幣稅額 
				 'ta034' => $mta034,     //單據日期
			     'ta035' => $mta035,     //確認者  
				 'ta036' => $mta036,     //營業稅率  
 				 'ta044' => $mta044       //簽核狀態  
				
                );	
			   
			   $this->db->insert('acpta', $data);
			   $num2 = (int)$mvtc002 + 1;
	           $mvtc002 =  (string)$num2;
			   $vta028=$vta028+$tg017;
			
			   $vta028=0;$vta029=0;$vta037=0;$vta038=0;}
		  //合計不同單號
			$vta028=$vta028+$th045;
			$vta029=$vta029+$th046;
			$vta037=$vta037+$th047;
			$vta038=$vta038+$th048;
			
			$mta004=$tg005;       //廠商代號
			$mta005=$tg004;        //廠別
			$mta006=$tg022;         //統編
           	$mta008=$tg007;          //幣別
           	$mta009=$tg008;         //匯率
			$mta011=$tg010;          //課稅別
			$mta021=$tg016;         //備註
           	$mta024='Y';            //確認碼
           	$mta028=$tg017;        //應付金額
			$mta029=$tg019;       //稅額
			$mta037=$tg031;         //本幣金額
			$mta038=$tg032;          // 本幣稅額 
           	$mta034=date("Ymd");        //單據日期
			$mta035=$this->session->userdata('manager');          //確認者  
		    $mta036=$tg030;           //營業稅率  
			$mta044= 'N';             //簽核狀態  
			
		$n++; 
		
    }
	if (isset($mta004)) {
	  $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acpq01a71'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		        'ta004' => $mta004,   //廠商代號
		         'ta005' => $mta005,   //廠別
				 'ta006' => $mta006,  //統編
				 'ta008' => $mta008,  //幣別
			     'ta009' => $mta009,  //匯率
				 'ta011' => $mta011,    //課稅別
				 'ta021' => $mta021,       //備註
				 'ta024' => $mta024,    //確認碼
			     'ta026' => 'N',    //結案碼
				 'ta028' => $vta028,    //應付金額
				 'ta029' => $vta029,    //稅額	
                 'ta030' => 0,         //己付金額						 
				 'ta037' => $vta037,    //本幣金額
				 'ta038' => $vta038,   // 本幣稅額 
				 'ta034' => $mta034,     //單據日期
			     'ta035' => $mta035,     //確認者  
				 'ta036' => $mta036,     //營業稅率  
 				 'ta044' => $mta044       //簽核狀態  
                );	
	$this->db->insert('acpta', $data); }
	//進貨單更新碼N 改 Y TG015 
	$sql92 =" update purtg as c,(select tb005,tb006,tg015 from acptb as b,purtg as c
                   where  tb005=tg001 and tb006=tg002
                      and tg005 >= '$btg005' AND tg005 <= '$etg005' AND tg014 >= '$btg003' AND tg014<='$etg003' AND tg005 !='' AND tg013='Y' AND tg015='N'
                ) d
               set c.tg015='Y'
               where d.tb005=c.tg001 and d.tb006=c.tg002  " ; 

$this->db->query($sql92);
	
		  return true;	
    } 
	
	
 	//計算退貨 	
	function batchbf()           
        {
		  $vta001=$this->input->post('acpq01a71');    //應付憑單別單別,單據日期
	      $vta003=substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2);
		  $sql = " SELECT ta001,ta003,MAX(ta002) as ta002  FROM acpta 
		  WHERE ta001 = '$vta001'  AND ta003 = '$vta003'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		  
		  foreach ($query->result() as $row)
            {  
			$mta002[]=$row->ta002;                 //應付憑單單號 $vta002
			$i++;
            }
			IF ($mta002[0] > '0'  ) {
			 $vta002=$mta002[0]; $num = (int)$vta002 ; $vta002 =  (string)$num; }
			ELSE {$vta002=$vta003.'000';}
		 
		    // 滙率 幣別 $vta008  測試 echo sleep(10)
		   $vta008=$this->input->post('cmsq06a');
		   $sql = " SELECT mg001,mg003,MAX(mg002) as mg002  FROM cmsmg 
		  WHERE mg001 = '$vta008'   "; 
		  $query = $this->db->query($sql);
		  $i=0;
		    if ($query->num_rows() > 0)  {
		  foreach ($query->result() as $row)
            {  
			$mta009[]=$row->mg003;                 //匯率 $vta009
			$i++;
            }
			}
			if ($mta009[0] >'0' AND $mta009[0] <= '999999' ) {$vta009=$mta009[0]; }
             ELSE {$vta009=1;}	
		  
		  //廠商 結帳日 進貨資料
		  
	      $btg005=$this->input->post('purq01ac');    
	      $etg005=$this->input->post('purq01ao'); 
		  $btg003=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $etg003=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
  
   $n=2;
    $totqty=0;
	$vtc0022=$vta002;
	$vtc0021=$vta002;
	$vtc002=$vta002;       //單號
	 $mvtc002=$vta002;        //單號換廠商時使用單頭
	      $num1 = (int)$mvtc002 + 1;
	      $mvtc002 =  (string)$num1;
    $vtb010='';           //廠商
	$vta028=0;  $vta029=0;  $vta037=0;  $vta038=0;    //小計 
	       
	$vdail=0;             //第一次廻圈
	$mno='1000';
	$vno=1000;
	//		sleep(10);單別,單號,日期,廠別,廠商,廠商單號,7幣別,8匯率,10課稅別,17進貨金額,19原幣稅額,16備註,30營業稅率,31貨款金額,32稅額,
	//                9發票聯數,11發票號,22統編,26數量,27發票日,33付款代號,th3序號,4品號,9庫別,14驗收日,19進貨金額, 45原金額,46稅額,47本金額,48本稅額,th33明細備註
    $sql="select ti001 as tg001,ti002 as tg002,ti003 as tg003,ti014 as tg014,ti005 as tg004,ti004 as tg005,ti006 as tg007,ti007 as tg008,ti009 as tg010
	                     ,ti011 as  tg017,ti015 as tg019,ti012 as tg016,ti027 as tg030,ti028 as tg031,ti029 as tg032
	               ,ti008 as tg009,ti018 as tg011,ti017 as tg022,ti022 as tg026,ti023 as tg027,ti030 as tg033,ma055,ma015,ma014,ma044,ma026,ma025
				   ,tj003 as th003,tj004 as th004,tj011 as th009,ti029 as th014,tj010 as th019,tj030 as th045,tj031 as th046,tj032 as th047,tj033 as th048,tj019 as th033
	  from `purti` as a,`purma` as b,`purtj` as c 
	  where  ti001=tj001 AND ti002=tj002 and ti004=ma001  AND ti004 >= '$btg005' AND ti004 <= '$etg005' AND ti014 >= '$btg003' AND ti014<='$etg003' AND ti004 !='' AND ti013='Y' AND ti024='N'
	  order by  ti004,tj001,tj002,tj003 ";
	//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
   // while($row=mysql_fetch_assoc($result)){
	    $query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb010=$tg005;  }            //第一筆 廠商相等 1040306
			if ($vtb010==$tg005 and  $vdail==0 ) {$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;}   //vtc0021 單號+1 	
		 
				if ($vtb010==$tg005 and  $vdail==0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
			       $mno='1000';$vno=1000;$vtb010=$tg005;  } 
				if ($vtb010!=$tg005 and $vdail >0 ) {$totqty=0;$n=0;$num = (int)$vtc002 + 1; $vtc002 =  (string)$num;$num = (int)$vtc0021 + 1; $vtc0021 =  (string)$num;
				   $mno='1000';$vno=1000;$vtb010=$tg005;  } 
				   
	 	    $totqty+=$tg026;   //數量
			$vtb010=$tg005;  //廠商代號
			
		//	echo $mvtc002.'test';
		//	sleep(5);
			
			$vdail++;           //預設 0  
			$vno = $vno + 10;   //預設1000
			
				//明細 acptb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tb001' => $this->input->post('acpq01a71'), 
		         'tb002' => $vtc002,
		         'tb003' => (string)$vno,
		         'tb004' => '2',
		         'tb005' => $tg001,
				 'tb006' => $tg002,
				 'tb007' => $th003,
				 'tb008' => $tg014,
				 'tb012' => 'Y', 
				 'tb011' => $th033,
				 'tb015' => ($th045)*-1,
			     'tb016' => ($th046)*-1,
		         'tb017' => ($th047)*-1,
				 'tb018' => ($th048)*-1
				     
                );	
		   if ($tg004>='') {$this->db->insert('acptb', $data1);}
			
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
                 'ta001' => $this->input->post('acpq01a71'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		         'ta004' => $mta004,   //廠商代號
		         'ta005' => $mta005,   //廠別
				 'ta006' => $mta006,  //統編
				 'ta008' => $mta008,  //幣別
			     'ta009' => $mta009,  //匯率
				 'ta011' => $mta011,    //課稅別
				 'ta021' => $mta021,       //備註
				 'ta024' => $mta024,    //確認碼
				 'ta026' => 'N',    //結案碼
				 'ta028' => ($vta028)*-1,    //應付金額
				 'ta029' => ($vta029)*-1,    //稅額
                 'ta030' => 0,         //己付金額						 
				 'ta037' => ($vta037)*-1,    //本幣金額
				 'ta038' => ($vta038)*-1,   // 本幣稅額 
				 'ta034' => $mta034,     //單據日期
			     'ta035' => $mta035,     //確認者  
				 'ta036' => $mta036,     //營業稅率  
 				 'ta044' => $mta044       //簽核狀態  
				
                );	
			   
			   $this->db->insert('acpta', $data);
			   $num2 = (int)$mvtc002 + 1;
	           $mvtc002 =  (string)$num2;
			   $vta028=$vta028+$tg017;
			
			   $vta028=0;$vta029=0;$vta037=0;$vta038=0;}
		  //合計不同單號
			$vta028=$vta028+$th045;
			$vta029=$vta029+$th046;
			$vta037=$vta037+$th047;
			$vta038=$vta038+$th048;
			
			$mta004=$tg005;       //廠商代號
			$mta005=$tg004;        //廠別
			$mta006=$tg022;         //統編
           	$mta008=$tg007;          //幣別
           	$mta009=$tg008;         //匯率
			$mta011=$tg010;          //課稅別
			$mta021=$tg016;         //備註
           	$mta024='Y';            //確認碼
           	$mta028=$tg017;        //應付金額
			$mta029=$tg019;       //稅額
			$mta037=$tg031;         //本幣金額
			$mta038=$tg032;          // 本幣稅額 
           	$mta034=date("Ymd");        //單據日期
			$mta035=$this->session->userdata('manager');          //確認者  
		    $mta036=$tg030;           //營業稅率  
			$mta044= 'N';             //簽核狀態  
			
		$n++; 
		
    }
	if (isset($mta004)) {
	  $data = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'ta001' => $this->input->post('acpq01a71'), 
		         'ta002' => $mvtc002,
		         'ta003' => substr($this->input->post('ta003c'),0,4).substr($this->input->post('ta003c'),5,2).substr(rtrim($this->input->post('ta003c')),8,2),
		        'ta004' => $mta004,   //廠商代號
		         'ta005' => $mta005,   //廠別
				 'ta006' => $mta006,  //統編
				 'ta008' => $mta008,  //幣別
			     'ta009' => $mta009,  //匯率
				 'ta011' => $mta011,    //課稅別
				 'ta021' => $mta021,       //備註
				 'ta024' => $mta024,    //確認碼
				 'ta026' => 'N',    //結案碼
				 'ta028' => ($vta028)*-1,    //應付金額
				 'ta029' => ($vta029)*-1,    //稅額
                 'ta030' => 0,         //己付金額						 
				 'ta037' => ($vta037)*-1,    //本幣金額
				 'ta038' => ($vta038)*-1,   // 本幣稅額 
				 'ta034' => $mta034,     //單據日期
			     'ta035' => $mta035,     //確認者  
				 'ta036' => $mta036,     //營業稅率  
 				 'ta044' => $mta044       //簽核狀態  
                );	
	$this->db->insert('acpta', $data); }
	
	//退貨單更新碼N 改 Y ti024 
	$sql93 =" update purti as c,(select tb005,tb006,ti024 from acptb as b,purti as c
                   where  tb005=ti001 and tb006=ti002
                      and ti004 >= '$btg005' AND ti004 <= '$etg005' AND ti014 >= '$btg003' AND ti014<='$etg003' AND ti004 !='' AND ti013='Y' AND ti024='N'
                ) d
               set c.ti024='Y'
               where d.tb005=c.ti001 and d.tb006=c.ti002  " ; 

$this->db->query($sql93);
	
		  return true;	
    } 		
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>