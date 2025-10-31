<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actb04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//計算切傳票資料
	function batchaf()           
        {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
		  //傳票幣別及本幣無加入acttb 105.01.28
		//  $sql01 ="update acttb set tb013='NTD' WHERE tb013<>'NTD' and  substring(tb002,1,4) = '$vyy' AND SUBSTRING(tb002,5,2) = '$vmm' ";  
	    //  $this->db->query($sql01);
		  
		  $sql02 ="update acttb set tb015=tb007 where tb007!=tb015 and tb015=0  and  substring(tb002,1,4) = '$vyy' AND SUBSTRING(tb002,5,2) = '$vmm' ";   
	      $this->db->query($sql02);
		  
		          //刪除計算月份 會計科目各期額檔
			         $this->db->where('mb002', $vyy);
					 $this->db->where('mb003', $vmm);
		             $this->db->delete('actmb'); 
		  
		  $query = $this->db->query("SELECT min(tb005) as tb005  FROM actta as a, acttb as b 
		  WHERE ta001=tb001 AND ta002=tb002  AND substring(ta003,1,4) = '$vyy' AND SUBSTRING(TA003,5,2) = '$vmm'  AND ta010='Y'  ");         
		foreach ($query->result() as $row)
            {
            $tb005[]=$row->tb005;		 
            }
			$mtb005=$tb005[0];
			
	 $vtb005=$mtb005;       //科目代號  1101.001
	 $mvtb005=$mtb005;        //科目代號換 借貸時使用單頭
	    
    $vtb005='';           //科目代號
	
	$tb0071=0;$tb0072=0;$tb0151=0;$tb0152=0;$tb0071c=0;$tb0072c=0;
	
	$vdail=0;             //第一次廻圈
	$n=0;
	//		sleep(10);科目編號tb005,借貸,年度,期別,幣別, 本幣金額,原幣金額, 筆數 ok

	$sql="select tb005,tb004,substring(ta003,1,4) as yy, substring(ta003,5,2) as mm, tb013,
	             sum(tb007*tb014) as tb007 , sum(tb015) as tb015, count(tb007) as tb007c
	  from `actta` as a,`acttb` as b 
	  where  ta001=tb001 AND ta002=tb002  AND substring(ta003,1,4) = '$vyy' AND SUBSTRING(TA003,5,2) = '$vmm'  AND ta010='Y'
	  group by tb005,tb004,substring(ta003,1,4),substring(ta003,5,2), tb013
	  order by  tb005,tb004,substring(ta003,1,4),substring(ta003,5,2), tb013 ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb005=$tb005;$vtb004=$tb004;$vtb013=$tb013;$vtb007=$tb007;$vtb015=$tb015;$vtb007c=$tb007c;  }            //第一筆 科目相等 1040306
		//  if ($vdail!=0) {$vtb005=$tb005;$vtb004=$tb004;$vtb013=$tb013;$vtb007=$tb007;$vtb015=$tb015;$vtb007c=$tb007c;  }    				 
	//	if ($vtb005!=$tb005 and $vdail >0 and $tb004==1)  {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} else {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;} 
	 	 //mvb005 科目代號, tb004 借貸別
 	//0618	 if ($vtb005==$tb005 and  $vdail==0  and $tb004==1 )   {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} else {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}   //vtc0021 單號+1 
		 if ( $vdail==0  and $tb004==1 )   {$tb0071=$tb0071+$tb007;$tb0072=$tb0072+$tb007;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} 
		 if ( $vdail==0  and $tb004!=1 )  {$tb0072=$tb0072+$tb007;$tb0071=$tb0071+$tb007;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}
		 
		 if ($mvtb005!=$tb005 and  $vdail>0  and $tb004==1 )  {$tb0071=$tb0071+$tb007;$tb0072=$tb0072+$tb007;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} 
		 if ($mvtb005!=$tb005 and $vdail>0 and $tb004!=1)   {$tb0072=$tb0072+$tb007;$tb0071=$tb0071+$tb007;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}
		
    	if ($mvtb005==$tb005 and  $vdail>0  and $tb004==1 )   {$tb0071=$tb0071+$tb007;$tb0072=$tb0072+$tb007;$tb0151=$tb0151+$tb015;$tb0152=$tb0152+0;$tb0071c=$tb0071c+$tb007c;$tb0072c=0;} 
		 if ($mvtb005==$tb005 and $vdail>0 and $tb004!=1)     {$tb0072=$tb0072+$tb007;$tb0071=$tb0071+$tb007;$tb0152=$tb0152+$tb015;$tb0151=$tb0151+0;$tb0072c=$tb0072c+$tb007c;$tb0071c=$tb0071c+0;}
		
        	$vtb005=$tb005;  //科目代號
		//	$vtb004=$tb004;  //借貸
		//    $vtb013=$vtb013;
		//	echo $mvtc002.'test';
		//	sleep(5);
			
				//科目各期金額檔  actmb  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mb001' => $vtb005, 
		         'mb002' => $yy,
		         'mb003' => $mm,
		         'mb004' => $tb0071,
				 'mb005' => $tb0072,
			     'mb006' => $tb0071c,
				 'mb007' => $tb0072c,
				 'mb008' => $vtb013,
				 'mb009' => $tb0151,
				 'mb010' => $tb0152
				     
                );	
				
	//	   if ($tb005>='' and $vdail==0) {$this->db->insert('actmb', $data1);}
			
		   //不同單號合計歸0  到  1040616
		 
                 //上      本		   
		   if ($mvtb005<>$vtb005 or $vdail==0  ) {
			   $this->db->insert('actmb', $data1);		   
			   }
			   else {$this->db->where('a.mb001', $mvtb005);   //vtb005 改
			         $this->db->where('a.mb002', $yy);
					 $this->db->where('a.mb003', $mm);
				   $this->db->update('actmb as a', $data1);}
				   
		  // if ( $mvtb005<>$vtb005)   {$tb0071=0;$tb0072=0;$tb0071c=0;$tb0072c=0;$tb0151=0;$tb0152=0;}
		  //合計不同單號
		   $vdail++;           //預設 0 
         //  	$vtb005=$tb005;  //科目代號
			$vtb004=$tb004;  //借貸
		    $vtb013=$vtb013;
			
			$mvtb005=$tb005;
		    $n++; 
		
    }
		  return true;	
    } 
	
	
 	//計算統制帳的明細	(明細分類帳)1040623 1041118 x actmbz
	function batchbf()           
       {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
		  //科目代號 2105 08
		      //刪除計算月份 會計科目各期額檔
			         $this->db->where('mb002', $vyy);
					 $this->db->where('mb003', $vmm);
		             $this->db->delete('actmbz');      
		  
		  $query = $this->db->query("SELECT min(substring(tb005,1,4)) as tb005  FROM actta as a, acttb as b 
		  WHERE ta001=tb001 AND ta002=tb002  AND substring(ta003,1,4) = '$vyy' AND SUBSTRING(TA003,5,2) = '$vmm'  AND ta010='Y'  ");         
		foreach ($query->result() as $row)
            {
            $tb005[]=$row->tb005;		 
            }
			$mtb005=$tb005[0];
			
	 $vtb005=$mtb005;       //科目代號 1101
	 $mvtb005=$mtb005;        //科目代號換     借貸時使用單頭
	    
    $vtb005='';           //科目代號
	$tb0071=0;$tb0072=0;$tb0151=0;$tb0152=0;$tb0071c=0;$tb0072c=0;
	
	$vdail=0;             //第一次廻圈
	$n=0;
	//		sleep(10);科目編號,借貸,年度,期別,幣別, 本幣金額,原幣金額, 筆數, 科目大於4碼

	$sql="select substring(tb005,1,4) as tb005,tb004,substring(ta003,1,4) as yy, substring(ta003,5,2) as mm, tb013,
	             sum(tb007) as tb007 , sum(tb015*tb014) as tb015, count(tb007) as tb007c
	  from `actta` as a,`acttb` as b,`actma` as c 
	  where  ta001=tb001 AND ta002=tb002  AND tb005=ma001 AND length(ma003)>='4' AND substring(ta003,1,4) = '$vyy' 
	  AND SUBSTRING(TA003,5,2) = '$vmm'  AND ta010='Y'
	  group by substring(tb005,1,4),tb004,substring(ta003,1,4),substring(ta003,5,2), tb013
	  order by  substring(tb005,1,4),tb004,substring(ta003,1,4),substring(ta003,5,2), tb013 ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb005=$tb005;  }            //第一筆 科目相等 1040306
		 				 
	//	if ($vtb005!=$tb005 and $vdail >0 and $tb004==1)  {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;} else {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;} 
	 	 
 		 if ($vtb005==$tb005 and  $vdail==0  and $tb004==1 )   {$tb0071=$tb007;$tb0072=0;$tb0151=$tb015;$tb0152=0;$tb0071c=$tb007c;$tb0072c=0;}    //vtc0021 單號+1 
         if ($vtb005==$tb005 and  $vdail==0  and $tb004!=1 )   {$tb0072=$tb007;$tb0071=0;$tb0152=$tb015;$tb0151=0;$tb0072c=$tb007c;$tb0071c=0;}		
		
		if ($vtb005!=$tb005 and  $vdail>0  and $tb004==1 )  {$tb0071=$tb007;$tb0151=$tb015;$tb0071c=$tb007c;} 
		if ($vtb005!=$tb005 and $vdail>0 and $tb004!=1)   {$tb0072=$tb007;$tb0152=$tb015;$tb0072c=$tb007c;}
		
    	if ($vtb005==$tb005 and  $vdail>0  and $tb004==1 )   {$tb0071=$tb0071+$tb007;$tb0151=$tb0151+$tb015;$tb0071c=$tb007c+$tb0071c;} 
		if ($vtb005==$tb005 and $vdail>0 and $tb004!=1)     {$tb0072=$tb0072+$tb007;$tb0152=$tb0152+$tb015;$tb0072c=$tb0072c+$tb007c;}
		
		$vtb005=$tb005;  //科目代號
			
		//	echo $mvtc002.'test';
		//	sleep(5);
			
				//科目各期金額檔  acpmbz  
		$data2 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'mb001' => $vtb005, 
		         'mb002' => $yy,
		         'mb003' => $mm,
		         'mb004' => $tb0071,
				 'mb005' => $tb0072,
			     'mb006' => $tb0071c,
				 'mb007' => $tb0072c,
				 'mb008' => $tb013,
				 'mb009' => $tb0151,
				 'mb010' => $tb0152
				     
                );	
				
	//	   if ($tb005>='' and $vdail==0) {$this->db->insert('actmb', $data1);}
			
		   //不同單號合計歸0  到  1040616
		    
		   if ($mvtb005<>$vtb005 or $vdail==0  ) {
			   $this->db->insert('actmbz', $data2);			   
			   }
			   else {$this->db->where('mb001', $vtb005); 
			         $this->db->where('mb002', $yy);
					 $this->db->where('mb003', $mm);
				   $this->db->update('actmbz', $data2);}
		  //合計不同單號
		   $vdail++;           //預設 0  	
			$mvtb005=$tb005;
		    $n++; 
		
    }
		  return true;	
    } 

//查新增資料是否重複 (單身)	檢查試算表 actmba
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('mba001', $seg1);
		  $this->db->where('mba002', $seg2);
		  $this->db->where('mba003', $seg3);
	      $query = $this->db->get('actmba');
	      return $query->num_rows() ;
	    }  	
//計算 試算表檔資料 actmba
	function batchcf()           
        {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			$yyy = (int)$vyy-1 ;
			$num = (int)$vmm-1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='01') {$yyy=$yyy;$mmm='00';} else {$yyy=$vyy;}   //上月
		  //科目代號 
		          //刪除計算月份
			      //   $this->db->where('mba001', $vyy);
				//	 $this->db->where('mba002', $vmm);
		          //   $this->db->delete('actmba'); 
				  $sql2upd1=" UPDATE actmba SET mba008=0,mba009=0,mba010=0,mba011=0,mba012=0,mba013=0,mba014=0,mba015=0,mba016=0,mba017=0 where
				               mba001='$vyy' and mba002='$vmm' ";
				  $this->db->query($sql2upd1);
		  
		  $query = $this->db->query("SELECT min(tb005) as tb005  FROM actta as a, acttb as b 
		  WHERE ta001=tb001 AND ta002=tb002  AND substring(ta003,1,4) = '$vyy' AND SUBSTRING(TA003,5,2) = '$vmm'  AND ta010='Y'  ");         
		foreach ($query->result() as $row)
            {
            $tb005[]=$row->tb005;		 
            }
			$mtb005=$tb005[0];
			
	 $vtb005=$mtb005;       //科目代號
	 $mvtb005a=$mtb005;        //科目代號換 借貸時使用單頭
	    
    $vtb005='';           //科目代號
	$vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;
   // $vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;$mvtb005a;
	$vdail=0;             //第一次廻圈
	$n=0;
	//		sleep(10);科目編號,科目名稱, 借貸餘額別,期初借方金額 mb0041,期初貸方金額mb0051, 本期借方金額,本期貸方金額,借方筆數, 貸方筆數, 期未 
     //                41,51 本月, 4,5 上月	1050422 modi vyy vmm yyy mmm(本月10)
   /*  $sql="select mb001,ma003,ma019, 0 as mb0041, 0 as mb0051,mb004,mb005,mb006,mb007,0 as mb008,0 as mb009 
	  from `actmb` as a,`actma` as b  where  mb001=ma001 AND mb002 = '$vyy' AND mb003 = '$vmm'
      union
      select mb001,ma003,ma019,mb004,mb005,0,0,0,0,0,0 from  `actmb` as a,`actma` as b 
	   where  mb001=ma001 AND mb002 = '$vyy' AND mb003 = '$mmm' order by mb001,ma019"; */
	   
	    $sql="select mb001,ma003,ma019, 0 as mb0041, 0 as mb0051,mb004,mb005,mb006,mb007,0 as mb008,0 as mb009 
	  from `actmb` as a,`actma` as b  where  mb001=ma001 AND mb002 = '$vyy' AND mb003 = '$vmm'
      union
      select mba003 as mb001,ma003,ma019,mba006 as mb0041,mba007 as mb0051,0 as mb004 ,0 as mb005,0 as mb006,0 as mb007 ,0 as mb008,0 as mb009 
	    from  `actmba` as a,`actma` as b 
	   where  mba003=ma001 AND mba001 = '$vyy' AND mba002 = '$vmm' order by mb001,ma019";
	
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb005=$tb005;  }            //第一筆 科目相等 1040618
		 				 
	//	if ($vtb005!=$tb005 and $vdail >0 and $ma019==1)  {$tb0071=$mb0041-$mb004;$tb0072=0;$tb0151=$mb0051-$mb005;$tb0152=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;} else {$tb0072=$mb004-$mb0041;$tb0071=0;$tb0152=$mb005-$mb0051;$tb0151=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;}
	 	 
 		// if ($vtb005==$mb001 and  $vdail==0  and $ma019==1 )   {$tb0071=$mb0041-$mb004;$tb0072=0;$tb0151=$mb0051-$mb005;$tb0152=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;} else {$tb0072=$mb004-$mb0041;$tb0071=0;$tb0152=$mb005-$mb0051;$tb0151=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;}   //vtc0021 單號+1 
            if ( $vdail==0   )   {$vmb0041=$mb0041;$vmb0051=$mb0051;$vmb004=$mb004;$vmb005=$mb005;$vmb006=$mb006;$vmb007=$mb007;$tb0071=$mb0041+$mb004;$tb0151=$mb0051+$mb005;} 
		// if ( $vdail==0  and $ma019!=1 )      {$vmb0051=$mb0051;$vmb0041=$mb0041;$vmb005=$mb005;$vmb004=$mb004;$vmb007=$mb007;$vmb006=$mb006;$tb0071=$mb004+$mb0041;$tb0151=$mb005+$mb0051;} 
		
 		if ($vtb005!=$mb001 and  $vdail>0   )  {$vmb0041=$mb0041;$vmb0051=$mb0051;$vmb004=$mb004;$vmb005=$mb005;$vmb006=$mb006;$vmb007=$mb007;$tb0071=$mb0041+$mb004;$tb0151=$mb0051+$mb005;} 
		//  if ($vtb005!=$mb001 and $vdail>0 and $ma019!=1)   {$vmb0051=$mb0051;$vmb0041=$mb0041;$vmb005=$mb005;$vmb004=$mb004;$vmb007=$mb007;$vmb006=$mb006;$tb0071=$mb004+$mb0041;$tb0151=$mb005+$mb0051;} 
		
    	if ($vtb005==$mb001 and  $vdail>0   )   {$vmb0041=$vmb0041+$mb0041;$vmb0051=$vmb0051+$mb0051;$vmb004=$vmb004+$mb004;$vmb005=$vmb005+$mb005;$vmb006=$vmb006+$mb006;$vmb007=$vmb007+$mb007;$tb0071=$mb0041+$mb004;$tb0151=$mb0051+$mb005;} 
	//	 if ($vtb005==$mb001 and $vdail>0 and $ma019!=1)     {$vmb0051=$vmb0051+$mb0051;$vmb005=$vmb005+$mb005;$vmb007=$vmb007+$mb007;$tb0071=$mb004+$mb0041;$tb0151=$mb005+$mb0051;}
		
        	$vtb005=$mb001;  //科目代號
			$vtb004=$ma019;  //借貸		

     		
			
		//	echo $mvtc002.'test';
		//	sleep(5);
		
				//科目各期金額檔 (試算表檔)  actmba
		$data22 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
		         'mba001' => $vyy,
		         'mba002' => $vmm,
                 'mba003' => $vtb005, 
		         'mba004' => $ma003,
		         'mba005' => $ma019,
		         'mba006' => $vmb0041,
				 'mba007' => $vmb0051,
			     'mba008' => $vmb004,
				 'mba009' => $vmb005,
				 'mba010' => $vmb006,
				 'mba011' => $vmb007,
				 'mba012' => $tb0071,
				 'mba013' => $tb0151
                );	
		
				//科目各期金額檔 (試算表檔)  actmba
		$data33 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
		         'mba004' => $ma003,
		         'mba005' => $ma019,
		         'mba006' => $vmb0041,
				 'mba007' => $vmb0051,
			     'mba008' => $vmb004,
				 'mba009' => $vmb005,
				 'mba010' => $vmb006,
				 'mba011' => $vmb007,
				 'mba012' => $vmb0041+$vmb004,
				 'mba013' => $vmb0051+$vmb005
                );	
	//	   if ($tb005>='' and $vdail==0) {$this->db->insert('actmb', $data1);}
			
		   //不同單號合計歸0  到  1040616 //除了key 不一樣, 放在期初or 一般 325-328 備註
		    
		   if ( $mvtb005a<>$vtb005  or $vdail==0 )  {
                $exist = $this->actb04_model->selone1d($vyy,$vmm,$vtb005);
	            if ($exist)
	               {  if ($vmb0041>0 or $vmb0051>0) {
		             $this->db->where('mba003', $vtb005); 
			         $this->db->where('mba001', $vyy);
				     $this->db->where('mba002', $vmm);
				   $this->db->update('actmba ', $data33); }
		           }else {$this->db->insert('actmba', $data22);}
			   
			//   $this->db->insert('actmba', $data2);	1041228		   
			   }
			   else { if (($vmb0041+$vmb004)>0 or ($vmb0051+$vmb005)>0) { $this->db->where('mba003', $vtb005); 
			         $this->db->where('mba001', $vyy);
					 $this->db->where('mba002', $vmm);
				   $this->db->update('actmba ', $data33);} } 
		  //合計不同單號
		   $vdail++;           //預設 0  	
			$mvtb005a=$mb001;
			//if ($mvtb005<>$vtb005  or $vdail==0  ) {$vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;}
		//    $vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;
		    $n++; 
		
    }
		  return true;	
    } 
//計算 試算表檔餘額 上期+本期=期未餘額 actmba  mba014, mba015  0623-ok 1111 9:43
    function batchdf()           
        {
			$n=0;
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			 $sql="select mba003,mba005,mba012,mba013,mba014,mba015  from `actmba`   where  mba001 = '$vyy' AND mba002 = '$vmm' ";
	
	       $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
        while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			$vdamt1=0;$vcamt1=0;$vmba014=0;$vmba015=0;
			
			if ($mba005==1) {$vdamt1=$mba012-$mba013;}
			if ($mba005==1 and $vdamt1>0) {$vmba014=$vdamt1;} 
			if ($mba005==1 and $vdamt1<0) {$vmba015=$vdamt1*-1;} 
			
			if ($mba005!=1) {$vcamt1=$mba013-$mba012;}
			if ($mba005!=1 and $vcamt1>0) {$vmba015=$vcamt1;} 
			if ($mba005!=1 and $vcamt1<0) {$vmba014=$vcamt1*-1;}
			
            $data34 = array(
				 'mba014' => $vmba014,
				 'mba015' => $vmba015
                );	
			$this->db->where('mba003', $mba003); 
			$this->db->where('mba001', $vyy);
			$this->db->where('mba002', $vmm);
			$this->db->update('actmba', $data34);
			$n++; 	
			
		 }
		  return true;	
    } 
  //計算 損益表檔餘額 actmba 本期 8,9 mba016, 14,15累計餘額 mba017  
    function batchef()           
        {
			$n=0;
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
				IF (substr($vmm,0,1)!='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
				
			 $sql="select mba003,mba005,mba008,mba009,mba014,mba015,mba016,mba017  from `actmba`   where  mba001 = '$vyy' AND mba002 = '$vmm' ";
	
	       $result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
        while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			$vdamt1=0;$vdamt2=0;$vmba016=0;$vmba017=0;
			
			if ($mba005==1) {$vdamt1=$mba008-$mba009;$vmba016=$vdamt1;}
			if ($mba005!=1 ) {$vdamt1=$mba009-$mba008;$vmba016=$vdamt1;}
			
			if ($mba005==1) {$vdamt2=$mba014-$mba015;$vmba017=$vdamt2;}
			if ($mba005!=1 ) {$vdamt2=$mba015-$mba014;$vmba017=$vdamt2;}
			
            $data44 = array(
				 'mba016' => $vmba016,
				 'mba017' => $vmba017
                );	
			$this->db->where('mba003', $mba003); 
			$this->db->where('mba001', $vyy);
			$this->db->where('mba002', $vmm);
			$this->db->update('actmba', $data44);
			$n++; 	
			
		 }
		 //刪除試算表length actmba mba003=4 14,15,16,17=0   1041202
		  $sql61d = " delete from actmba  where mba001 = '$vyy'  AND mba002 = '$vmm'  AND length(mba003) = 4 AND mba006=0 AND mba007=0 AND mba008=0 AND mba009=0 AND mba012=0 AND mba013=0 AND mba014=0 AND mba015=0 AND mba016=0  AND mba017=0 "; 
		  $query = $this->db->query($sql61d);	 
		 
	//	  return true;	
   // } 
	//1040630 加上 3218 上期損益
      //科目代號 3219 本期損益  計算	  1040812 都加判斷年月 mbb2002=$vmm	   $vyy  ACTMC 參數檔      
		  
	/*	  $query = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //本期損益 計算 1041027
			
	      
			 $query211 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  and mbb2002=$vmm  " );         
		foreach ($query211->result() as $row)
            {
			 $mbb2001a[]=$row->mbb2001;
			 $mbb2002a[]=$row->mbb2002;
            $mbb2016a[]=$row->mbb2016;
            $mbb2017a[]=$row->mbb2017;			
            }
			 if(isset($mbb2001a[0])) {
			$mbb2001a=$mbb2001a[0];
			 $mbb2002a=$mbb2002a[0];}
				 else 
			{ $mbb2001a=$vyy;
			  $mbb2002a=$vmm;}
			
			 if(isset($mbb2016a[0])) {
			$mbb2016a=$mbb2016a[0];
			$mbb2017a=$mbb2017a[0];}
			 else 
			{ $mbb2016a=0;
			  $mbb2017a=0;}
			
			
		 $query212 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '5 '  and mbb2002=$vmm  ");         
		foreach ($query212->result() as $row)
            {
            $mbb2016b[]=$row->mbb2016;
            $mbb2017b[]=$row->mbb2017;			
            }
			 if(isset($mbb2016b[0])) {
			$mbb2016b=$mbb2016b[0];
			 $mbb2017b=$mbb2017b[0];}
			 else 
			{ $mbb2016b=0;
			  $mbb2017b=0;}
		 $query213 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '6 '  and mbb2002=$vmm  ");         
		foreach ($query213->result() as $row)
            {
            $mbb2016c[]=$row->mbb2016;
            $mbb2017c[]=$row->mbb2017;			
            }
			 if(isset($mbb2016c[0])) {
			$mbb2016c=$mbb2016c[0];
			$mbb2017c=$mbb2017c[0];}
			 else 
			{ $mbb2016c=0;
			  $mbb2017c=0;}
			
			
		 $query214 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '7 '  and mbb2002=$vmm  ");         
		foreach ($query214->result() as $row)
            {
            $mbb2016d[]=$row->mbb2016;
            $mbb2017d[]=$row->mbb2017;			
            }
			
			
			 if(isset($mbb2016d[0])) {
			$mbb2016d=$mbb2016d[0];
			$mbb2017d=$mbb2017d[0];}
			 else 
			{ $mbb2016d=0;
			  $mbb2017d=0;}
			
			
			
			$mbb2016x=$mbb2016a-$mbb2016b;
			$mbb2017x=$mbb2017a-$mbb2017b;
			
			$mbb2016y=$mbb2016a-$mbb2016b-$mbb2016c;
			$mbb2017y=$mbb2017a-$mbb2017b-$mbb2016c;
			
			$mbb2016z=$mbb2016a-$mbb2016b-$mbb2016c-$mbb2016d;
			$mbb2017z=$mbb2017a-$mbb2017b-$mbb2016c-$mbb2017d;
			$vmba017=$mbb2017z;             
			
		   $query99 = $this->db->query("SELECT mba003   FROM actmba where mba003='$vmc005' ");         
		foreach ($query99->result() as $row)
            {
            $mba0031[]=$row->mba003;		 
            }
			if(isset($mba0031[0])) {
			$vmba0031=$mba0031[0];
			$ii=0;
			                       }
			 else 
			{ $vmba0031=$vmc005;$ii=1;  //本期損益代號  1=insert 0 update  3299=$vmc005
			  }
			
			
		//	$vmba0031=$mba0031[0];     //本期損益代號
		  
		  if ($vmba0031 == $vmc005 and $ii==1) {
		  $sql2 = "INSERT INTO  actmba (mba001,mba002,mba003,mba005,mba009,mba011,mba013,mba015,mba016,mba017) values ($vyy,$vmm,$vmc005,-1,$mbb2016z,1,$mbb2016z,$mbb2016z,$mbb2016z,$mbb2017z)    "; 
		          $this->db->query($sql2);	} 
	 	   if ($vmba0031 == $vmc005 and $ii==0)
		  {$sql2 = "UPDATE actmba set mba001='$vyy',mba002='$vmm',mba003='$vmc005',mba005=-1,mba009='$mbb2016z',mba011=1,mba013='$mbb2016z',mba015='$mbb2016z',mba016='$mbb2016z',mba017='$mbb2017z'
                    WHERE mba001='$vyy' and mba002='$vmm' and mba003='$vmc005'  ";  $this->db->query($sql2);	  }      */
		   
		  return true;	
    } 
	
	//計算 損益表報表檔 actmbb  0623- dele actmbb
    function batchff()   
	 {
		 //損益表  actmbb 
		    $kmm='';
		    $vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			IF (substr($vmm,0,1)!='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			
			$this->db->where('mbb001', $vyy);
			$this->db->where('mbb002', $vmm);
			$this->db->delete('actmbb');
			//insert into 基本資料
			if (substr($vmm,0,1)!='0')  {
			 $sql = " INSERT INTO  actmbb (mbb001,mbb002,mbb003,mbb004,mbb005,mbb016,mbb017) 
			SELECT $vyy,concat('',$mmm ),ma001,ma003,ma008,0,0 FROM actma WHERE ma001>= '1'  "; }
			else {
			 $sql = " INSERT INTO  actmbb (mbb001,mbb002,mbb003,mbb004,mbb005,mbb016,mbb017) 
			SELECT $vyy,concat('0',$mmm ),ma001,ma003,ma008,0,0 FROM actma WHERE ma001>= '1'  "; }
			
		     $this->db->query($sql);
			 
			 //加上期損益 轉上期損益  1040521   1040522 604-623 本期轉上期//
		/*	  $query9991 = $this->db->query("SELECT mc005,mc006   FROM actmc ");         
		     foreach ($query9991->result() as $row)
              {
               $mc005[]=$row->mc005;	
                $mc006[]=$row->mc006;				   
               }
			$vmc005=$mc005[0];     //   計算本期損益						
			$vmc006=$mc006[0];     //上期損益代號 3218
			$yy1=$vyy.'00';
			$vmd003=0;  //初值
			//$vmd003[]=array();  //初值
			$sql3219=$this->db->query("SELECT md003 as vmd003  FROM `actmd` WHERE  md001 = '$yy1' ");
			 foreach ($sql3219->result() as $row)
              {
                 $vmd003[]=$row->vmd003;		 
              }
			$vmd003=$vmd003[0];     //   計算本期損益
			if (!isset($vmd003)) {$vmd003=0;}
			$sql3= "update actmbb set mbb017='$vmd003'  where  mbb001='$vyy' and mbb002='$vmm' and mbb003='$vmc006' ";
		    $this->db->query($sql3); */
			 
			 //actmbb 本期損益 3219 mc005 1040701 
			 //科目代號 3218 上期損益 mc006		1040812         
		  
	/*	  $query9991 = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query9991->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //   計算本期損益
			
	      
			 $query2119 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  and mbb2002=$vmm  ");         
		foreach ($query2119->result() as $row)
            {
			 $mbb2001a1[]=$row->mbb2001;
			 $mbb2002a1[]=$row->mbb2002;
            $mbb2016a1[]=$row->mbb2016;
            $mbb2017a1[]=$row->mbb2017;			
            }
			
			if(isset($mbb2001a1[0])) {
			$mbb2001a1=$mbb2001a1[0];
			$mbb2002a1=$mbb2002a1[0];}
			 else 
			{ $mbb2001a1=$vyy;
			  $mbb2002a1=$vmm;}
			
			 if(isset($mbb2016a1[0])) {
			$mbb2016a1=$mbb2016a1[0];
			$mbb2017a1=$mbb2017a1[0];}
			 else 
			{ $mbb2016a1=0;
			  $mbb2017a1=0;}
			
			
		  $query2129 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '5 '  and mbb2002=$vmm  ");         
		foreach ($query2129->result() as $row)
            {
            $mbb2016b1[]=$row->mbb2016;
            $mbb2017b1[]=$row->mbb2017;			
            }
			 if(isset($mbb2016b1[0])) {
			$mbb2016b1=$mbb2016b1[0];
			 $mbb2017b1=$mbb2017b1[0];}
			 else 
			{ $mbb2016b1=0;
			  $mbb2017b1=0;}
		 $query2139 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '6 '  and mbb2002=$vmm  ");         
		foreach ($query2139->result() as $row)
            {
            $mbb2016c1[]=$row->mbb2016;
            $mbb2017c1[]=$row->mbb2017;			
            }
			 if(isset($mbb2016c1[0])) {
			$mbb2016c1=$mbb2016c1[0];
			$mbb2017c1=$mbb2017c1[0];}
			 else 
			{ $mbb2016c1=0;
			  $mbb2017c1=0;}
			
			
		 $query2149 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '7 '  and mbb2002=$vmm  ");         
		foreach ($query2149->result() as $row)
            {
            $mbb2016d1[]=$row->mbb2016;
            $mbb2017d1[]=$row->mbb2017;			
            }
			
			
			 if(isset($mbb2016d1[0])) {
			$mbb2016d1=$mbb2016d1[0];
			$mbb2017d1=$mbb2017d1[0];}
			 else 
			{ $mbb2016d1=0;
			  $mbb2017d1=0;}
			
			
			
			$mbb2016x1=$mbb2016a1-$mbb2016b1;
			$mbb2017x1=$mbb2017a1-$mbb2017b1;
			
			$mbb2016y1=$mbb2016a1-$mbb2016b1-$mbb2016c1;
			$mbb2017y1=$mbb2017a1-$mbb2017b1-$mbb2016c1;
			
			$mbb2016z1=$mbb2016a1-$mbb2016b1-$mbb2016c1-$mbb2016d1;
			$mbb2017z1=$mbb2017a1-$mbb2017b1-$mbb2016c1-$mbb2017d1;
			//$vmba017=$mbb2017z;
		  $sql29 = " UPDATE actmbb  set mbb016='$mbb2016z1',mbb017='$mbb2017z1'  WHERE  mbb001 = '$vyy' AND mbb002 = '$vmm' AND  mbb003 = '$vmc005'   "; 
		   $this->db->query($sql29);	*/
			 
			 
			 
			//找相同品號update  test 1200
             $sql2 =" update actmbb b,(select b.mbb001,b.mbb002,b.mbb003,b.mbb016,b.mbb017,a.mba001 as mba001,a.mba002 as mba002,
               a.mba003 as mba003,a.mba016 as mba016,a.mba017 as mba017
               from actmba  a, actmbb b
               where a.mba001=b.mbb001 and a.mba002=b.mbb002 and a.mba003=b.mbb003 
                ) c
               set b.mbb016=c.mba016, b.mbb017=c.mba017
               where b.mbb001=c.mba001 and  b.mbb002=c.mba002 and  b.mbb003=c.mba003 " ; 
			 $this->db->query($sql2);
			 
		//4 開頭 actma -1 1  判斷正負值 1041228
			 $sql4000 = " UPDATE  actmbb AS A,  
         (SELECT  ma001,ma007   from actma  where substring(ma001,1,1)= '4' and ma007=1 ) AS B  
    SET A.`mbb016`=A.`mbb016`*-1,A.`mbb017`=A.`mbb017`*-1
    WHERE A.mbb003=B.ma001 and  A.mbb001 = '$vyy'  and A.mbb002 = '$vmm' and substring(A.mbb003,1,1) = '4' and B.ma007=1 and length(A.mbb003)=4 ";
	        $this->db->query($sql4000);
	
			 
		 //計算分類 前3碼  actmbb1   23 test 1620
		        
		    $vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			IF (substr($vmm,0,1)=='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			    $this->db->where('mbb1001', $vyy);
			    $this->db->where('mbb1002', $vmm);
		       $this->db->delete('actmbb1'); 
			 
		 //     $vyy=substr($this->input->post('ta034c'),0,4);
		//	$vmm=substr($this->input->post('ta034c'),5,2);  會計科目新增入actmbb1   concat('0',$mmm)
		    if (substr($vmm,0,1)=='0' and $vmm!='00' )  {
		       $sql3 = " INSERT INTO  actmbb1 (mbb1001,mbb1002,mbb1003,mbb1004,mbb1005,mbb1016,mbb1017) 
			SELECT $vyy,concat('0',$mmm),ma001,ma003,ma008,0,0 FROM actma where length(ma001) <='3'   "; }
			
			 if (substr($vmm,0,1)=='1' and $vmm!='00' ) {
			    $sql3 = " INSERT INTO  actmbb1 (mbb1001,mbb1002,mbb1003,mbb1004,mbb1005,mbb1016,mbb1017) 
			SELECT $vyy,$mmm,ma001,ma003,ma008,0,0 FROM actma where length(ma001) <='3'   "; } 
			
			 if (substr($vmm,0,1)=='0' and $vmm=='00' ) {
			    $sql3 = " INSERT INTO  actmbb1 (mbb1001,mbb1002,mbb1003,mbb1004,mbb1005,mbb1016,mbb1017) 
			SELECT $vyy,'00',ma001,ma003,ma008,0,0 FROM actma where length(ma001) <='3'   "; } 
			
		     $this->db->query($sql3);
			 
		 //計算分類 update 前3碼  金額 actmbb1  1040622 
		      $vmbb016=0;$vmbb017=0;
		      $vyy=substr($this->input->post('ta034c'),0,4);
			 $vmm=substr($this->input->post('ta034c'),5,2);
			 IF (substr($vmm,0,1)=='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			    $this->db->where('mbb2001', $vyy);
			    $this->db->where('mbb2002', $vmm);
		        $this->db->delete('actmbb2'); 
			 // 3碼   copy actmbb 到 actmbb2
			 $sql21=" SELECT mbb001,mbb002,concat( substring( mbb003, 1, 2 ) , '0' ) AS mbb003, sum( mbb016) AS mbb016, sum( mbb017) AS mbb017
                    FROM `actmbb`  WHERE mbb001 = '$vyy'  AND mbb002 = '$vmm' 
					GROUP BY mbb001,mbb002,concat( substring( mbb003, 1, 2 ) , '0' )
                    HAVING sum( mbb016 ) !=0 OR sum( mbb017 ) !=0  ORDER BY mbb001,mbb002,concat( substring( mbb003, 1, 2 ) , '0' )  ";
					
		  $result = mysql_query($sql21) or die_content("查詢資料失敗".mysql_error());
          while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			
            $data21 = array(
				 'mbb2001' => $mbb001,
				 'mbb2002' => $mbb002,
				 'mbb2003' => $mbb003,
				 'mbb2016' => $mbb016,
				 'mbb2017' => $mbb017
                );	
			$this->db->insert('actmbb2', $data21);
		 }	
		 // 2碼
		  $sql22=" SELECT mbb001,mbb002,substring( mbb003, 1, 2 ) AS mbb003, sum( mbb016) AS mbb016, sum( mbb017) AS mbb017
                    FROM `actmbb`  WHERE mbb001 = '$vyy'  AND mbb002 = '$vmm' 
					GROUP BY mbb001,mbb002,substring( mbb003, 1, 2 )
                    HAVING sum( mbb016 ) !=0 OR sum( mbb017 ) !=0  ORDER BY mbb001,mbb002,substring( mbb003, 1, 2 )  ";
					
		  $result = mysql_query($sql22) or die_content("查詢資料失敗".mysql_error());
          while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			
            $data22 = array(
				 'mbb2001' => $mbb001,
				 'mbb2002' => $mbb002,
				 'mbb2003' => $mbb003,
				 'mbb2016' => $mbb016,
				 'mbb2017' => $mbb017
                );	
			$this->db->insert('actmbb2', $data22);
		 }	
		 // 1碼  1041207
		  $sql23=" SELECT mbb001,mbb002,substring( mbb003, 1, 1 ) AS mbb003, sum( mbb016) AS mbb016, sum( mbb017) AS mbb017
                    FROM `actmbb`  WHERE mbb001 = '$vyy'  AND mbb002 = '$vmm' 
					GROUP BY mbb001,mbb002,substring( mbb003, 1, 1 )
                    HAVING sum( mbb016 ) !=0 OR sum( mbb017 ) !=0  ORDER BY mbb001,mbb002,substring( mbb003, 1, 1 ) desc ";
					
		  $result = mysql_query($sql23) or die_content("查詢資料失敗".mysql_error());
          while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			
            $data23 = array(
				 'mbb2001' => $mbb001,
				 'mbb2002' => $mbb002,
				 'mbb2003' => $mbb003,
				 'mbb2016' => $mbb016,
				 'mbb2017' => $mbb017
                );	
			$this->db->insert('actmbb2', $data23);
		 }	
					
				//找相同品號update  前3碼 test 1200 actmbb1
		$sql24 =" update actmbb1 b,(select b.mbb1001,b.mbb1002,b.mbb1003,b.mbb1016,b.mbb1017,a.mbb2001,a.mbb2002,
               a.mbb2003 ,a.mbb2016,a.mbb2017
               from actmbb2 a, actmbb1 b
               where a.mbb2001=b.mbb1001 and a.mbb2002=b.mbb1002 and a.mbb2003=b.mbb1003 and b.mbb1001 = '$vyy'  and  b.mbb1002 = '$vmm'
                ) c
               set b.mbb1016=c.mbb2016, b.mbb1017=c.mbb2017
               where b.mbb1001=c.mbb2001 and  b.mbb1002=c.mbb2002 and  b.mbb1003=c.mbb2003 and b.mbb1001 = '$vyy'  and  b.mbb1002 = '$vmm' " ; 
			 $this->db->query($sql24);
			 
          //找相同品號update  前3碼 test 1200 actmbb  損益表 完成
		$sql25 =" update actmbb b,(select b.mbb001,b.mbb002,b.mbb003,b.mbb016,b.mbb017,a.mbb2001,a.mbb2002,
               a.mbb2003 ,a.mbb2016,a.mbb2017
               from actmbb2 a, actmbb b
               where a.mbb2001=b.mbb001 and a.mbb2002=b.mbb002 and a.mbb2003=b.mbb003 and b.mbb001 = '$vyy'  and  b.mbb002 = '$vmm'
                ) c
               set b.mbb016=c.mbb2016, b.mbb017=c.mbb2017
               where b.mbb001=c.mbb2001 and  b.mbb002=c.mbb2002 and  b.mbb003=c.mbb2003 and b.mbb001 = '$vyy'  and  b.mbb002 = '$vmm' " ; 
			 $this->db->query($sql25);	
		//損益表 1040624-1	 
			 //營業毛利 5999
		  
		  $query211 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  and mbb2001='$vyy' and mbb2002='$vmm'   ");         
		foreach ($query211->result() as $row)
            {
			 $mbb2001a[]=$row->mbb2001;
			 $mbb2002a[]=$row->mbb2002;
            $mbb2016a[]=$row->mbb2016;
            $mbb2017a[]=$row->mbb2017;			
            }
			 if(isset($mbb2001a[0])) {
			$mbb2001a=$mbb2001a[0];
			 $mbb2002a=$mbb2002a[0];}
			  else 
			{ $mbb2001a=$vyy;
			  $mbb2002a=$vmm;}
			
			 if(isset($mbb2016a[0])) {
			$mbb2016a=$mbb2016a[0];
			$mbb2017a=$mbb2017a[0];}
			 else 
			{ $mbb2016a=0;
			  $mbb2017a=0;}
			
			
		 $query212 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '5 '  and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query212->result() as $row)
            {
            $mbb2016b[]=$row->mbb2016;
            $mbb2017b[]=$row->mbb2017;			
            }
			 if(isset($mbb2016b[0])) {
			$mbb2016b=$mbb2016b[0];
			 $mbb2017b=$mbb2017b[0];}
			 else 
			{ $mbb2016b=0;
			  $mbb2017b=0;}
		 $query213 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '6 ' and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query213->result() as $row)
            {
            $mbb2016c[]=$row->mbb2016;
            $mbb2017c[]=$row->mbb2017;			
            }
			 if(isset($mbb2016c[0])) {
			$mbb2016c=$mbb2016c[0];
			$mbb2017c=$mbb2017c[0];}
			 else 
			{ $mbb2016c=0;
			  $mbb2017c=0;}
			
		//7 改 71, 73	
		 $query214 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,3) = '71 '  and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query214->result() as $row)
            {
            $mbb2016d[]=$row->mbb2016;
            $mbb2017d[]=$row->mbb2017;			
            }
			
			
			 if(isset($mbb2016d[0])) {
			$mbb2016d=$mbb2016d[0];
			$mbb2017d=$mbb2017d[0];}
			 else 
			{ $mbb2016d=0;
			  $mbb2017d=0;}
		  
            $query214a = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,3) = '73 '  and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query214a->result() as $row)
            {
            $mbb2016da[]=$row->mbb2016;
            $mbb2017da[]=$row->mbb2017;			
            }
			
			
			 if(isset($mbb2016da[0])) {
			$mbb2016da=$mbb2016da[0];
			$mbb2017da=$mbb2017da[0];}
			 else 
			{ $mbb2016da=0;
			  $mbb2017da=0;}		  
			
			
			$mbb2016x=$mbb2016a-$mbb2016b;
			$mbb2017x=$mbb2017a-$mbb2017b;
			
			$mbb2016y=$mbb2016a-$mbb2016b-$mbb2016c;
			$mbb2017y=$mbb2017a-$mbb2017b-$mbb2016c;
			
			$mbb2016z=$mbb2016a-$mbb2016b-$mbb2016c+$mbb2016d-$mbb2016da;
			$mbb2017z=$mbb2017a-$mbb2017b-$mbb2016c+$mbb2017d-$mbb2017da;
			//營業毛利 5999 actmbb
			 $data215 = array(
				 'mbb001' => $mbb2001a,
				 'mbb002' => $mbb2002a,
				 'mbb003' => '5999',
				 'mbb004' => '營業毛利',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016x,
				 'mbb017' => $mbb2017x
                );	
			$this->db->insert('actmbb', $data215);
			 //營業利益 6999
		   $data216 = array(
				 'mbb001' => $mbb2001a,
				 'mbb002' => $mbb2002a,
				 'mbb003' => '6999',
				 'mbb004' => '營業利益',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016y,
				 'mbb017' => $mbb2017y
                );	
			$this->db->insert('actmbb', $data216);
		  //本期損益 7999
		   $data217 = array(
				 'mbb001' => $mbb2001a,
				 'mbb002' => $mbb2002a,
				 'mbb003' => '7999',
				 'mbb004' => '本期損益',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016z,
				 'mbb017' => $mbb2017z
                );	
			$this->db->insert('actmbb', $data217);
		//本期損益檔 actmd	1041226   3219
		    $vyymm1=$vyy.$vmm;
		    $this->db->where('md001', $vyymm1);
		    $this->db->delete('actmd'); 
	    $query9991 = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query9991->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //   計算本期損益
			
			 $sqla1="insert into  actmd(md001,md002,md003) values ($vyymm1,$vmc005,$mbb2016z)  ";
			 $this->db->query($sqla1);
		   
		   // $vyymm1=$vyy.$vmm;
			//$sqla="update  actmd set md003=$mbb2016z  where  md001=$vyymm1 ";
			// $this->db->query($sqla);
			     
//    加入資產負債表		加本期損益
			
			//資產負債表 1040624-2	 
			 //資產總額 1999
		  
		  $query311 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '1 '  and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query311->result() as $row)
            {
			 $mbb2001e[]=$row->mbb2001;
			 $mbb2002e[]=$row->mbb2002;
            $mbb2016e[]=$row->mbb2016;
            $mbb2017e[]=$row->mbb2017;			
            }
			 if(isset($mbb2001e[0])) {
			$mbb2001e=$mbb2001e[0];
			 $mbb2002e=$mbb2002e[0];}
			 { $mbb2001e=$vyy;
			  $mbb2002e=$vmm;}
			
			 if(isset($mbb2016e[0])) {
			$mbb2016e=$mbb2016e[0];
			$mbb2017e=$mbb2017e[0];}
			 else 
			{ $mbb2016e=0;
			  $mbb2017e=0;}
			
			
		 $query312 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '2 '  and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query312->result() as $row)
            {
            $mbb2016f[]=$row->mbb2016;
            $mbb2017f[]=$row->mbb2017;			
            }
			 if(isset($mbb2016f[0])) {
			 $mbb2016f=$mbb2016f[0];
			 $mbb2017f=$mbb2017f[0];}
			 else 
			{ $mbb2016f=0;
			  $mbb2017f=0;}
			  
		 $query313 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '3 '   and mbb2001='$vyy' and mbb2002='$vmm'  ");         
		foreach ($query313->result() as $row)
            {
            $mbb2016g[]=$row->mbb2016;
            $mbb2017g[]=$row->mbb2017;			
            }
			 if(isset($mbb2016g[0])) {
			$mbb2016g=$mbb2016g[0];
			$mbb2017g=$mbb2017g[0];}
			 else 
			{ $mbb2016g=0;
			  $mbb2017g=0;}
			
			
			
			$mbb2016x=$mbb2016e;
			$mbb2017x=$mbb2017e;
			
			$mbb2016y=$mbb2016f;
			$mbb2017y=$mbb2017f;
			
			$mbb2016z=$mbb2016g;
			$mbb2017z=$mbb2017g;    
			
			$mbb2016r=$mbb2016f+$mbb2016g;
			$mbb2017r=$mbb2017f+$mbb2017g;
			
			//資產總額 1999 actmbb
			 $data315 = array(
				 'mbb001' => $mbb2001e,
				 'mbb002' => $mbb2002e,
				 'mbb003' => '1999',
				 'mbb004' => '資產總額',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016x,
				 'mbb017' => $mbb2017x
                );	
			$this->db->insert('actmbb', $data315);
			 //負債合計 2999
		   $data316 = array(
				 'mbb001' => $mbb2001e,
				 'mbb002' => $mbb2002e,
				 'mbb003' => '2999',
				 'mbb004' => '負債合計',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016y,
				 'mbb017' => $mbb2017y
                );	
			$this->db->insert('actmbb', $data316);
		  //股東權益合計 3998
		   $data317 = array(
				 'mbb001' => $mbb2001e,
				 'mbb002' => $mbb2002e,
				 'mbb003' => '3998',
				 'mbb004' => '股東權益合計',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016z,
				 'mbb017' => $mbb2017z
                );	
			$this->db->insert('actmbb', $data317);
		 //負債與股東權益總額 3999
		   $data318 = array(
				 'mbb001' => $mbb2001e,
				 'mbb002' => $mbb2002e,
				 'mbb003' => '3999',
				 'mbb004' => '負債與股東權益總額',
				 'mbb005' => '4',
				 'mbb016' => $mbb2016r,
				 'mbb017' => $mbb2017r
                );	
			$this->db->insert('actmbb', $data318);  
			//659-1036 計算損益表完成actmbb 1041202
			//刪除>=4 mbb003
			   $sql71d = " delete from actmbb  where mbb001 = '$vyy'  AND mbb002 = '$vmm' AND mbb003 >'4' AND length(mbb003) = 4 AND mbb016=0 AND mbb017=0 "; 
		       $query = $this->db->query($sql71d);	 
		  return true;	 
	 }
	 //計算 資產負債表報表檔 actmbc  開始0624 1202
    function batchgf()   
	 {
		 //資產負債表報表  actmbc1 資產 
		    $vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			IF (substr($vmm,0,1)=='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			
			$this->db->where('mbc001', $vyy);
			$this->db->where('mbc002', $vmm);
			$this->db->delete('actmbc');      //刪除資產負債表
			
			$this->db->where('mbc1001', $vyy);
			$this->db->where('mbc1002', $vmm);
			$this->db->delete('actmbc1');      //刪除資產
			
			
			
	//		 truncate table actmbc1;
			//insert into 基本資料  actmbc1  1040701  add 資產
			
			$this->db->select('mbb003,mbb004,mbb017');
		    $this->db->from('actmbb');
			$this->db->where('mbb001', $vyy);
			$this->db->where('mbb002', $vmm);
			$this->db->where('mbb003 >=', '1');
			$this->db->where('mbb003 <=', '1999');
			$this->db->order_by('mbb001,mbb002,mbb003');			
			 $query = $this->db->get();
	         $result = $query->result();
			
			 $ii=0;
			 $i=0;
			 foreach($result as $row) {
				 $mbb003[]=$row->mbb003; 
			     $mbb004[]=$row->mbb004;
				 $mbb017[]=$row->mbb017;
			     $ii = $ii + 1 ; }
				 
		      while ($i<$ii) {
				
				  	$data411a = array(
				     'mbc1001' => $vyy,
					 'mbc1002' => $vmm, 
					 'mbc1003' => $mbb003[$i],
					 'mbc1004' => $mbb004[$i],
					 'mbc1005' => 0,
				     'mbc1006' => $mbb017[$i],
					 'ida' => $i
					 );
					 
			//	$this->db->where('mbc1001', $vyy);
			//    $this->db->where('mbc1002', $vmm);	
			//	$this->db->where('mbc1003', $mbb003[$i]);	
				$this->db->insert('actmbc1',$data411a);
                   
		       $i++;
			  }
		   
	
		//負債	
			$this->db->where('mbc2001', $vyy);
			$this->db->where('mbc2002', $vmm);
			$this->db->delete('actmbc2');      //刪除負債	
			
			 //insert into 基本資料  actmbc1  1040701  add 負債 actmbc2
			
			$this->db->select('mbb003,mbb004,mbb017');
		    $this->db->from('actmbb');
			$this->db->where('mbb001', $vyy);
			$this->db->where('mbb002', $vmm);
			$this->db->where('mbb003 >=', '2');
			$this->db->where('mbb003 <=', '3999');
			$this->db->order_by('mbb001,mbb002,mbb003');			
			 $query412b = $this->db->get();
	         $result412c = $query412b->result();
			
			 $ii=0;
			 $i=0;
			 foreach($result412c as $row) {
				 $mbb003b[]=$row->mbb003; 
			     $mbb004b[]=$row->mbb004;
				 $mbb017b[]=$row->mbb017;
			     $ii = $ii + 1 ; }
				 
		      while ($i<$ii) {
				
				  	$data412z = array(
				     'mbc2001' => $vyy,
					 'mbc2002' => $vmm, 
					 'mbc2003' => $mbb003b[$i],
					 'mbc2004' => $mbb004b[$i],
					 'mbc2005' => 0,
				     'mbc2006' => $mbb017b[$i],
					 'idb' => $i
					 );
					 
			//	$this->db->where('mbc2001', $vyy);
			//    $this->db->where('mbc2002', $vmm);	
			//	$this->db->where('mbc2003', $mbb003b[$i]);	
				$this->db->insert('actmbc2',$data412z);
                   
		       $i++;
			  }
			  
		//插入 3219 7999 本期損益 1041203
		  /*     if (strlen($vmm)==1) {$vvmm='0'.$vmm;} else {$vvmm=$vmm;}
         	   $sql3219i = " insert into actmbc2 (mbc2001,mbc2002,mbc2003,mbc2004,mbc2005,mbc2006) select $vyy,$vvmm,'3219',mbb004,0,mbb017 from actmbb  where mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003 = '7999' "; 
		       $query = $this->db->query($sql3219i);	*/	
		//負債0 刪除	
                  $this->db->where('mbc2001', $vyy);
			      $this->db->where('mbc2002', $vmm);
                  $this->db->where('mbc2005', 0);	
                  $this->db->where('mbc2006', 0);	
				$this->db->delete('actmbc2');	
		
               // 取本期代號
           $query44 = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query44->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //本期損益代號	1041228		
            //update actmbb 3219 
			$sql32191 = " UPDATE  actmbb AS A,  
         (SELECT  sum(md003) as md003 from actmd where substring(md001,1,4)= '$vyy' and substring(md001,5,2)<= '$vmm' ) AS B  
    SET A.`mbb017`=B.`md003` 
    WHERE  A.mbb001 = '$vyy'  and A.mbb002 = '$vmm' and A.mbb003 = '7999' ";
	$query = $this->db->query($sql32191);  
	
             //  $this->db->close();
         	   $sql19i = " insert into actmbc2 (mbc2001,mbc2002,mbc2003,mbc2004,mbc2005,mbc2006) select mbb001,mbb002,$vmc005,mbb004,0,mbb017 from actmbb  where mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003 = '7999' "; 
		      $query = $this->db->query($sql19i);
			//   $this->db->close($sql19i);
			$query999 = $this->db->query("SELECT count(*) FROM actmbc2 where  mbc2001 = '$vyy'  and mbc2002 = '$vmm' and mbc2003=$vmc005 ");   
                if ($query999->num_rows() <= 0) 
		         {
			     $sql19i1 = " insert into actmbc2 (mbc2001,mbc2002,mbc2003,mbc2004,mbc2005,mbc2006) select mbb001,mbb002,$vmc005,mbb004,0,mbb017 from actmbb  where mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003 = '7999' "; 
				 $query = $this->db->query($sql19i1);	}	
				 
            // 3,3998 -  3219 合計用
			 $query3998v = $this->db->query("SELECT mbb017   FROM actmbb where mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003 = '7999'  ");         
		foreach ($query3998v->result() as $row)
            {
            $mbb017[]=$row->mbb017;		 
            }
			$vmbb017=$mbb017[0];     //本期損益金額 mbb017 改 mbb016
		
			if ($vmbb017 <= 0 ) {
			$sql3998 = " UPDATE  actmbc2 AS A,  
         (SELECT   mbb001,mbb002,mbb017  FROM actmbb  where  mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003='7999' ) AS B  
    SET A.`mbc2006`=A.`mbc2006`-B.`mbb017` 
    WHERE A.`mbc2001`=B.`mbb001` and  A.`mbc2002`=B.`mbb002` and A.`mbc2003`='3998' and  A.`mbc2001` = '$vyy'  and A.`mbc2002` = '$vmm' "; 	
		$query = $this->db->query($sql3998);	} else {
		$sql39981 = " UPDATE  actmbc2 AS A,  
         (SELECT   mbb001,mbb002,mbb017  FROM actmbb  where  mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003='7999' ) AS B  
    SET A.`mbc2006`=A.`mbc2006`+B.`mbb017` 
    WHERE A.`mbc2001`=B.`mbb001` and  A.`mbc2002`=B.`mbb002` and A.`mbc2003`='3998' and  A.`mbc2001` = '$vyy'  and A.`mbc2002` = '$vmm' "; 	
		$query = $this->db->query($sql39981);	}
		
		if ($vmbb017 <= 0 ) {
			$sql3999 = " UPDATE  actmbc2 AS A,  
         (SELECT   mbb001,mbb002,mbb017  FROM actmbb  where  mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003='7999' ) AS B  
    SET A.`mbc2006`=A.`mbc2006`-B.`mbb017` 
    WHERE A.`mbc2001`=B.`mbb001` and  A.`mbc2002`=B.`mbb002` and A.`mbc2003`='3999' and  A.`mbc2001` = '$vyy'  and A.`mbc2002` = '$vmm' "; 	
		$query = $this->db->query($sql3999);	} else {
		$sql39991 = " UPDATE  actmbc2 AS A,  
         (SELECT   mbb001,mbb002,mbb017  FROM actmbb  where  mbb001 = '$vyy'  and mbb002 = '$vmm' and mbb003='7999' ) AS B  
    SET A.`mbc2006`=A.`mbc2006`+B.`mbb017` 
    WHERE A.`mbc2001`=B.`mbb001` and  A.`mbc2002`=B.`mbb002` and A.`mbc2003`='3999' and  A.`mbc2001` = '$vyy'  and A.`mbc2002` = '$vmm' "; 	
		$query = $this->db->query($sql39991);	}   
		
        //資產0 刪除	長度4才刪除 1041202
           /*      $this->db->where('mbc1001', $vyy);
			      $this->db->where('mbc1002', $vmm);
                  $this->db->where('mbc1005', 0);	
                  $this->db->where('mbc1006', 0);	
				$this->db->delete('actmbc1');	*/	
               $sql81d = " delete from actmbc1  where mbc1001 = '$vyy'  AND mbc1002 = '$vmm' AND length(mbc1003) = 4 AND mbc1005=0 AND mbc1006=0 "; 
		       $query = $this->db->query($sql81d);	 				
	
		 //計算合併 actmc  1750  資產與負價合併一個檔案 actmbc   1041202
	       	  $query413 = $this->db->query("SELECT count(*) as mc1 from actmbc1 where mbc1001='$vyy' and mbc1002='$vmm' ");         
		  foreach ($query413->result() as $row)
            {
            $mc1[]=$row->mc1;		
            }			 
			$mc1=$mc1[0];
			
			$query414 = $this->db->query("SELECT count(*) as mc2 from actmbc2 where  mbc2001='$vyy' and mbc2002='$vmm' ");   
         
			
		  foreach ($query414->result() as $row)
            {
            $mc2[]=$row->mc2;		
            }			 
			$mc2=$mc2[0];
			
		/*	if ($mc1>=$mc2) {  */
				 $sql415 = " INSERT INTO  actmbc (mbc001,mbc002,mbc003,mbc004,mbc005,mbc006,mbc007,mbc008,mbc009,mbc010) 
			     SELECT mbc1001,mbc1002,mbc1003,mbc1004,mbc1005,mbc1006,'','',0,0 from actmbc1 where mbc1001='$vyy' and mbc1002='$vmm' order by mbc1003 ";
			$this->db->query($sql415);
			
			  $query419 = $this->db->query("SELECT min(id) as mc9 from actmbc where mbc001='$vyy' and mbc002='$vmm' ");         
		  foreach ($query419->result() as $row)
            {
            $mc9[]=$row->mc9;		
            }			 
			$mc9=$mc9[0];
		//	$mc9=$mc9+1000;
			$ik=1;
			while ($ik<$mc1) {
			$sql416 = " UPDATE  `actmbc` SET idc=$ik where id='$mc9' "; $this->db->query($sql416);$ik++;$mc9++;   }
			
		/*		  $sql416 = " UPDATE  `actmbc` AS A,  
       (SELECT idb,mbc2003,mbc2004,mbc2005,mbc2006  FROM `actmbc2` GROUP BY `idb`) AS B  
    SET A.`mbc007`=B.`mbc2003` ,A.`mbc008`=B.`mbc2004` ,A.`mbc009`=B.`mbc2005` ,A.`mbc010`=B.`mbc2006`
    WHERE A.`idc`=B.`idb`   "; }	*/
               $this->db->select('mbc2003,mbc2004,mbc2005,mbc2006');
		    $this->db->from('actmbc2');
			$this->db->where('mbc2001', $vyy);
			$this->db->where('mbc2002', $vmm);
			//$this->db->where('mbc2003 >=', '2');
			//$this->db->where('mbc2003 <=', '3999');
			$this->db->order_by('mbc2001,mbc2002,mbc2003');			
			 $query = $this->db->get();
	         $result = $query->result();	
	           $ii=0;
			 $i=0;
			 foreach($result as $row) {
				 $mbc007[]=$row->mbc2003; 
			     $mbc008[]=$row->mbc2004;
				 $mbc009[]=$row->mbc2005;
				 $mbc010[]=$row->mbc2006;
			     $ii = $ii + 1 ; }
				 
		      while ($i<$ii) {
				
				  	$data411a = array(
				  //   'mbc001' => $vyy,
				  //	 'mbc002' => $vmm, 
					 'mbc007' => $mbc007[$i],
					 'mbc008' => $mbc008[$i],
					 'mbc009' => $mbc009[$i],
				     'mbc010' => $mbc010[$i],
				//	 'ida' => $i
					 );
				 $i++;	 
				$this->db->where('mbc001', $vyy);
			    $this->db->where('mbc002', $vmm);
                $this->db->where('idc', $i);				
			//	$this->db->where('mbc1003', $mbb003[$i]);	
				$this->db->update('actmbc',$data411a);
                   
		     //  $i++;
			  }
				 
	/* 1119		if ($mc1 < $mc2) {
				 $sql415 = " INSERT INTO  actmbc (mbc001,mbc002,mbc003,mbc004,mbc005,mbc006,mbc007,mbc008,mbc009,mbc010) 
			     SELECT mbc2001,mbc2002,mbc2003,'',0,0,mbc2003,mbc2004,mbc2005,mbc2006 from actmbc2 "; 
			
				 $sql416 = " UPDATE  `actmbc` AS A,  
       (SELECT ida,mbc1003,mbc1004,mbc1005,mbc1006  FROM `actmbc1` GROUP BY `ida`) AS B  
    SET A.`mbc007`=B.`mbc1003` ,A.`mbc008`=B.`mbc1004` ,A.`mbc009`=B.`mbc1005` ,A.`mbc010`=B.`mbc1006`
    WHERE A.`idc`=B.`ida`   "; }	 
			     
			 $this->db->query($sql415);  
		     $this->db->query($sql416);  
			  
			     	//流水號idc 	actmbc   
		     $this->db->select(' a.* ');
			 $this->db->from('actmbc as a');
			 $this->db->order_by('id');
			
			 $query = $this->db->get();
	         $result = $query->result();
		
			 $ii=0;
			 $i=0;
			 foreach($result as $row) { 
			     $mbc001[]=$row->mbc001; 
			     $mbc002[]=$row->mbc002; 
				 $mbc003[]=$row->mbc003; 
				 $id[]=$ii;
			     $ii = $ii + 1 ; }
				 
		      while ($i<$ii) {
				 
				  	$data4173 = array(
				     'idc' => $i  );   //1040701 id modi idc
					 
				$this->db->where('mbc001', $mbc001[$i]);
			    $this->db->where('mbc002', $mbc002[$i]);	
				$this->db->where('mbc003', $mbc003[$i]);	
				$this->db->update('actmbc',$data4173);
                   
		       $i++;
			  }
			  
		 //判斷12  actmbc ok 1040701-19:20  真正資料存入資產負債表檔 actmbc
		  $vmbc12=0;
			 if ($mc1 < $mc2) {$vmbc12=2;} {$vmbc12=1;}
			 if ($vmbc12==1)  { $sql427c = " UPDATE  `actmbc` AS A,  
       (SELECT ida,mbc1003,mbc1004,mbc1005,mbc1006  FROM `actmbc1` GROUP BY `ida`) AS B  
    SET A.`mbc003`=B.`mbc1003` ,A.`mbc004`=B.`mbc1004` ,A.`mbc005`=B.`mbc1005` ,A.`mbc006`=B.`mbc1006`
    WHERE A.`idc`=B.`ida`   "; }	
	
	        $sql428c = " UPDATE  `actmbc` AS A,  
       (SELECT idb,mbc2003,mbc2004,mbc2005,mbc2006  FROM `actmbc2` GROUP BY `idb`) AS B  
    SET A.`mbc007`=B.`mbc2003` ,A.`mbc008`=B.`mbc2004` ,A.`mbc009`=B.`mbc2005` ,A.`mbc010`=B.`mbc2006`
    WHERE A.`idc`=B.`idb`   "; 
            
			
			 $this->db->query($sql427c);
			 $this->db->query($sql428c); */
		 //科目代號 3219 本期損益  計算資產負價表的 本期損益科目更新至 actmbc		         
		  
	/*	  $query = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //本期損益代號
			
	     
			 $query211 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  ");         
		foreach ($query211->result() as $row)
            {
			 $mbb2001a[]=$row->mbb2001;
			 $mbb2002a[]=$row->mbb2002;
            $mbb2016a[]=$row->mbb2016;
            $mbb2017a[]=$row->mbb2017;			
            }
			if(isset($mbb2001a[0])) {
			$mbb2001a=$mbb2001a[0];
			$mbb2002a=$mbb2002a[0];}
			 else 
			{ $mbb2001a=0;
			  $mbb2002a=0;}
			
			 if(isset($mbb2016a[0])) {
			$mbb2016a=$mbb2016a[0];
			$mbb2017a=$mbb2017a[0];}
			 else 
			{ $mbb2016a=0;
			  $mbb2017a=0;}
			
			
		 $query212 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '5 '  ");         
		foreach ($query212->result() as $row)
            {
            $mbb2016b[]=$row->mbb2016;
            $mbb2017b[]=$row->mbb2017;			
            }
			 if(isset($mbb2016b[0])) {
			$mbb2016b=$mbb2016b[0];
			 $mbb2017b=$mbb2017b[0];}
			 else 
			{ $mbb2016b=0;
			  $mbb2017b=0;}
		 $query213 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '6 '  ");         
		foreach ($query213->result() as $row)
            {
            $mbb2016c[]=$row->mbb2016;
            $mbb2017c[]=$row->mbb2017;			
            }
			 if(isset($mbb2016c[0])) {
			$mbb2016c=$mbb2016c[0];
			$mbb2017c=$mbb2017c[0];}
			 else 
			{ $mbb2016c=0;
			  $mbb2017c=0;}
			
			
		 $query214 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '7 '  ");         
		foreach ($query214->result() as $row)
            {
            $mbb2016d[]=$row->mbb2016;
            $mbb2017d[]=$row->mbb2017;			
            }
			
			
			 if(isset($mbb2016d[0])) {
			$mbb2016d=$mbb2016d[0];
			$mbb2017d=$mbb2017d[0];}
			 else 
			{ $mbb2016d=0;
			  $mbb2017d=0;}
			
			
			
			$mbb2016x=$mbb2016a-$mbb2016b;
			$mbb2017x=$mbb2017a-$mbb2017b;
			
			$mbb2016y=$mbb2016a-$mbb2016b-$mbb2016c;
			$mbb2017y=$mbb2017a-$mbb2017b-$mbb2016c;
			
			$mbb2016z=$mbb2016a-$mbb2016b-$mbb2016c-$mbb2016d;
			$mbb2017z=$mbb2017a-$mbb2017b-$mbb2016c-$mbb2017d;
			$vmba017=$mbb2017z;
		  $sql2 = " UPDATE actmbc  set mbc010='$vmba017'  WHERE  mbc001 = '$vyy' AND mbc002 = '$vmm' AND  mbc007 = '$vmc005'   "; 
		   $this->db->query($sql2);	 */
          //資產總額重新計算
		/*    $query1999a = $this->db->query("SELECT sum(mbc1005) as mbc1005 from actmbc1 where mbc1003>='1' and mbc1003<'1999' and length(mbc1003)=4 ");         
		  foreach ($query1999a->result() as $row)
            {
            $mbc1005d[]=$row->mbc1005;		 
            }
			$vmbc1005d=$mbc1005d[0];  
			
				$data1999a = array(
				     'mbc005' => $vmbc1005d  ); 
			
			$this->db->where('mbc001', $vyy);
			$this->db->where('mbc002', $vmm);	
			$this->db->where('mbc003', '1999');	
			$this->db->update('actmbc',$data1999a); */
			 //負債與股東權益額重新計算
	/*  	    $query1999b = $this->db->query("SELECT sum(mbc2006) as mbc2006 from actmbc2 where mbc2003>='2' and mbc2003<'3998' and length(mbc2003)=4 ");         
		  foreach ($query1999b->result() as $row)
            {
            $mbc2006e[]=$row->mbc2006;		 
            }
			$vmbc2006e=$mbc2006e[0];  
			
				$data1999b = array(
				     'mbc010' => $vmbc2006e  ); 
			
			$this->db->where('mbc001', $vyy);
			$this->db->where('mbc002', $vmm);	
			$this->db->where('mbc007', '3999');	
			$this->db->update('actmbc',$data1999b);   */
			//清除資產負債左右少的部份
             $query918 = $this->db->query("SELECT count(*) as mc88 from actmbc1 ");         
		  foreach ($query918->result() as $row)
            {
            $mc88[]=$row->mc88;		
            }			 
			$mc88=$mc88[0];
			
			$query919 = $this->db->query("SELECT count(*) as mc99 from actmbc2 ");  
		  foreach ($query919->result() as $row)
            {
            $mc99[]=$row->mc99;		
            }			 
			$mc99=$mc99[0];
            
			  $sql999 = " UPDATE actmbc  set mbc007='', mbc008=''   WHERE  idc>'$mc99'   "; 
		       $this->db->query($sql999);
			   
			$this->db->close();   
		/*    if ($mc88<$mc99) {$sql999 = " UPDATE actmbc  set mbc003='', mbc004=''   WHERE  idc<='$mc88'   "; 
		       $this->db->query($sql999);	}  */  
		   
		   
		  return true;	 
	 }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>