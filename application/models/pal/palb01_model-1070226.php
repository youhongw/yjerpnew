<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 發薪  
	function batchaf($date='')
        {
			//echo "<script>alert('OK!!');myJsProgressBarHandler.setPercentage('element1','100');</script>";
			$vyymm1=substr($this->input->post('dateyymm'),0,4).substr($this->input->post('dateyymm'),5,2);
			$vyymm=$this->input->post('dateyymm');
			if($date) $vyymm1=substr($date,0,4).substr($date,5,2);
			if($date) $vyymm=$date;
		//計算年月>關帳年月 判斷
             $query = $this->db->query("SELECT ma022,ma205   FROM cmsma  
		  WHERE 1 ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;
            $ma205[]=$row->ma205;
            }
			$vma022=$ma022[0];
			$vma205=$ma205[0];
			if ($vma022 >= $vyymm1 ) { return "計算日期要大於關帳日期.";}
		//刪除計算當月薪資檔 PALTD  1061103
		
		  $this->db->where('td005', $vyymm1);
		   $this->db->delete('paltd'); 
		
		//新增月發薪 PALTD  TD055='N'
		  $sql2 = "INSERT INTO paltd (td001,td002,td003,td004,td005,td050,td051,td052,td053,td054,td055) 
		           select tc001,b.mv002,b.mv004,c.me002,$vyymm1,b.mv009,b.mv021,b.mv022,b.mv206,b.mv019,'N' from paltc as a
		           LEFT JOIN cmsmv as b ON a.tc001=b.mv001 and ((b.mv022='' or b.mv022 IS NULL) or substr(b.mv022,1,6)>='$vyymm1')
				   LEFT JOIN cmsme as c ON a.tc002=c.me001 WHERE a.tc003='$vyymm1' and SUBSTR(b.mv021,1,6)<='$vyymm1'"; 
		  $this->db->query($sql2);   
		  
		 //新增離職追補發薪 PALTK TD055='Y'
		  $sql3 = "INSERT INTO paltd (td001,td002,td003,td004,td005,td050,td051,td052,td053,td054,td055) 
		           select tc001,b.mv002,b.mv004,c.me002,$vyymm1,b.mv009,b.mv021,b.mv022,b.mv206,b.mv019,'Y' from paltc as a
		           LEFT JOIN cmsmv as b ON a.tc001=b.mv001 and ( substr(b.mv022,1,6) < '$vyymm1')
				   LEFT JOIN cmsme as c ON a.tc002=c.me001 
				   LEFT JOIN paltk as d ON a.tc001=d.tk001 and a.tc002=d.tk002 WHERE a.tc003='$vyymm1' and d.tk003='$vyymm1' "; 
		  $this->db->query($sql3);  
		  //新增勞保自提金額6%
		 /* $sql31 ="update  paltd as a,(select ti001,ti016 from palti ) as b
          set a.td056=b.ti016
          where  a.td005='$vyymm1' and a.td001=b.ti001 "; 
          $this->db->query($sql31); */
		  
			//echo $sql2;exit;
		  /*
		  //固定扣款+變動津貼 = palta2 1050809
		   $this->db->where('ta003', $vyymm1);
		   $this->db->delete('palta2'); 
		   
		   $sql21="INSERT INTO palta2 select * from palta where ta003='$vyymm1' "; 
		   $this->db->query($sql21);
		   
		    $sql22 =" update palta2 b,(select a.*
               from palta1 a                
                ) c
               set b.ta004=b.ta004+c.ta004, b.ta005=b.ta005+c.ta005,b.ta006=b.ta006+c.ta006,b.ta007=b.ta007+c.ta007,b.ta008=b.ta008+c.ta008,
			       b.ta009=b.ta009+c.ta009,b.ta010=b.ta010+c.ta010,b.ta011=b.ta011+c.ta011
               where b.ta001=c.ta001 and b.ta003='$vyymm1' " ; 
			 $this->db->query($sql22);
		  
		      $sql23 =" INSERT INTO palta2  ( ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013) 
                        select a.ta001,a.ta002,'$vyymm1',a.ta004,a.ta005,a.ta006,a.ta007,a.ta008,a.ta009,a.ta010,a.ta011,a.ta012,a.ta013 from palta1 a                
                        where ta001 != a.ta001  " ; 
			 $this->db->query($sql23);
			*/
			$this->db->where('ta003', $vyymm1);
			$this->db->delete('palta9');
		   
			$sql21="INSERT INTO palta9 (ta001,ta002,ta003) select td001,td003,td005 from paltd where td005='$vyymm1' "; 
			$this->db->query($sql21);
			$sql22 =" update palta9 b,(select a.*
               from palta a where a.ta003='$vyymm1'             
                ) c
               set b.ta004=b.ta004+c.ta004, b.ta005=b.ta005+c.ta005,b.ta006=b.ta006+c.ta006,b.ta007=b.ta007+c.ta007,b.ta008=b.ta008+c.ta008,
			       b.ta009=b.ta009+c.ta009,b.ta010=b.ta010+c.ta010,b.ta011=b.ta011+c.ta011,b.ta012=c.ta012,
				   b.ta014=b.ta014+c.ta014,b.ta015=b.ta015+c.ta015,b.ta016=b.ta016+c.ta016,b.ta017=b.ta017+c.ta017
               where b.ta001=c.ta001 and b.ta003='$vyymm1' " ; 
			 $this->db->query($sql22);
			 $sql22 =" update palta9 b,(select a.*
               from palta1 a 
                ) c
               set b.ta004=b.ta004+c.ta004, b.ta005=b.ta005+c.ta005,b.ta006=b.ta006+c.ta006,b.ta007=b.ta007+c.ta007,b.ta008=b.ta008+c.ta008,
			       b.ta009=b.ta009+c.ta009,b.ta010=b.ta010+c.ta010,b.ta011=b.ta011+c.ta011
               where b.ta001=c.ta001 and b.ta003='$vyymm1' " ; 
			 $this->db->query($sql22);
			 //離職補發薪 
			 $sql24 =" update palta9 b,(select a.*
               from paltk a
                ) c
               set b.ta006=b.ta006+c.tk004
               where b.ta001=c.tk001 and c.tk003='$vyymm1' and b.ta003='$vyymm1' " ; 
			 $this->db->query($sql24);
			
			
		  //計算先合併檔案一筆一筆計算	cmsmv 人事palmd 固定palta2 變動, 勞健保palml, paltc 月出勤,借支paltb	 
		$sql="select COUNT(a.tc003) from paltc as a LEFT JOIN palmd as b ON tc001=md001
		                                  LEFT JOIN palta9 as c ON tc001=ta001 and ta003='$vyymm1'
		                                  LEFT JOIN palml as d ON tc001=ml001 
                                          LEFT JOIN cmsmv as e ON tc001=mv001 
                                          LEFT JOIN cmsme as f ON tc001=me001 
                                          LEFT JOIN paltb as g ON tc001=tb001 and tb003='$vyymm1'
                                          WHERE tc003='$vyymm1'";
										  
		$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		$result = mysql_fetch_row($result);
		$totle = $result[0];
		$sql="select a.*,b.*,c.*,d.*,e.*,f.me002,g.tb004,h.ti016 from paltc as a LEFT JOIN palmd as b ON tc001=md001
		                                  LEFT JOIN palta9 as c ON tc001=ta001 and ta003='$vyymm1'
		                                  LEFT JOIN (select * 
												from (SELECT MAX(create_date) as max_create_date,create_date,ml001,ml002,ml003,ml004,ml005,ml006,ml007,ml008,ml009,ml010,ml011,ml012,ml013,ml014,ml015,ml016,ml017,ml018
												FROM palml
												GROUP BY ml001,create_date
												ORDER BY `create_date` DESC) x group by `ml001`) as d ON tc001=ml001 
                                          LEFT JOIN cmsmv as e ON tc001=mv001 
                                          LEFT JOIN cmsme as f ON tc001=me001 
										  LEFT JOIN palti as h ON tc001=ti001    
                                          LEFT JOIN paltb as g ON tc001=tb001 and tb003='$vyymm1'
                                          WHERE tc003='$vyymm1'";
		/*	2017.03.31	抓取保費資料要抓最新資料  //勞保自提金額6% palti
		$sql="select a.*,b.*,c.*,d.*,e.*,f.me002,g.tb004 from paltc as a LEFT JOIN palmd as b ON tc001=md001
		                                  LEFT JOIN palta9 as c ON tc001=ta001 and ta003='$vyymm1'
		                                  LEFT JOIN palml as d ON tc001=ml001 
                                          LEFT JOIN cmsmv as e ON tc001=mv001 
                                          LEFT JOIN cmsme as f ON tc001=me001 
                                          LEFT JOIN paltb as g ON tc001=tb001 and tb003='$vyymm1'
                                          WHERE tc003='$vyymm1'";
		*/
		$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		$temp_count = 0;
		while($row=mysql_fetch_assoc($result)){
			$temp_count ++;
			foreach($row as $i=>$v){
				$$i=$v;
			}
		 
				//計算每月天數
				$vmm=substr($vyymm,5,2);
				if ( ($vmm=='04') || ($vmm=='06') || ($vmm=='09') || ($vmm=='11'))  {
                        $vdd=30;
                     } elseif ($vmm=='02' ) {
                        $vdd=28;
                      } else {
                       $vdd=31;
                   }
				   $month_day = cal_days_in_month(CAL_GREGORIAN, substr($vyymm1,4,2), substr($vyymm1,0,4));
			    //計算外勞 到職 天數 未滿 183天所得稅扣 0.18 18%, 183天以上0.06 6% 稅率
				
					 $sdate=substr($mv021,0,4).'-'.substr($mv021,4,2).'-'.substr($mv021,6,2);
					 $edate=substr($vyymm1,0,4).'-'.substr($vyymm1,4,2).'-'.'30';
				  $startdate=strtotime($sdate);
				  $enddate=strtotime($edate); 
				  $days=round(($enddate-$startdate)/3600/24);
				 // return $days;
				 
				  /*$vtax=0;	//183天外勞所得稅算法 已遮蔽 2017.02.21
				  if ( substr($mv009,1,1)>'9' && $days < 183 )  { $vtax = 0.18;}
				  if (substr($mv009,1,1)>'9' && $days >= 183)  { $vtax = 0.06;}
				  if (substr($mv009,1,1)>'9' && $mv040 >0) { $vtax = $mv040;}//如果基本資料有輸入以基本資料為主，除非離境日計算
				  */
				  //勞健保費計算 退保計算 扣零
				   $vml003=$ml003;
				   $vml004=$ml004;
				   if (substr($ml016,0,6) >=$vyymm1 ) {$vml003=0;}
				   if (substr($ml018,0,6) >=$vyymm1 ) {$vml004=0;}
				 //伙食費計算  當月到職離職破月自行輸入扣款, 破月伙食費
				 $vfood=0;
                if ($mv201=='1') {if(!@$vma205){$vfood=990;}else{$vfood=$vma205;}} else {$vfood=0;}	
				  if ($ta011>0) {$vfood=$ta011;}
                //計算上班天數 workday  當月到職, 離職 天數  1050909
				  if (substr($mv021,6,2) =="01" && $vdd>30) {$vdd = 30;}
				  if (substr($mv021,0,6) ==$vyymm1 and substr($mv022,0,6) !=$vyymm1) {$workday9=($vdd-(int)substr($mv021,6,2))+1;}
			      if (substr($mv021,0,6) !=$vyymm1 and substr($mv022,0,6)==$vyymm1) {$workday9=(int)substr($mv022,6,2);if($workday9>30){$workday9=30;}}
				  if (substr($mv021,0,6) ==$vyymm1 and substr($mv022,0,6) ==$vyymm1) {$workday9=((int)substr($mv022,6,2)-(int)substr($mv021,6,2))+1;}
               //   $workday=30-(($tc006/8)+($tc007/8)+($tc008/8)+($tc009)+($tc010/8)+($tc011)+($tc012)+($tc013)+($tc014)+($tc015)+($tc016));
				   $workday=30-(($tc006/8)+($tc007/8)+($tc009)+($tc010/8)+($tc012)+($tc013)+($tc015));
				 //  IF ($mv001=='A105002') {var_dump($workday);exit;}
              //    if (substr($mv021,0,6)==$vyymm1) { $workday1=30-substr($mv021,6,2)+1;$workday=$workday+round($workday/7);}				  
			 //	  if (substr($mv022,0,6)==$vyymm1) { $workday1=30-substr($mv022,6,2);$workday=$workday+round($workday/7);}	
				
			       /*edit_20161108 if (substr($mv021,0,6)==$vyymm1) { $workday1=$vdd-substr($mv021,6,2)+1;$workday=$workday1-(($tc006/8)+($tc007/8)+($tc008/8)+($tc009)+($tc010/8)+($tc011)+($tc012)+($tc013)+($tc014)+($tc015)+($tc016));}				  
			 	   if (substr($mv022,0,6)==$vyymm1) { $workday1=substr($mv022,6,2);$workday=$workday1-(($tc006/8)+($tc007/8)+($tc008/8)+($tc009)+($tc010/8)+($tc011)+($tc012)+($tc013)+($tc014)+($tc015)+($tc016));}	
				   if  ((substr($mv022,0,6)==$vyymm1) && (substr($mv022,6,2)=='31')) { $workday1=30;$workday=$workday1-(($tc006/8)+($tc007/8)+($tc008/8)+($tc009)+($tc010/8)+($tc011)+($tc012)+($tc013)+($tc014)+($tc015)+($tc016));}	*/
				   $day_str = 0;$day_end = 30;
				   if (substr($mv021,0,6)==$vyymm1) { $day_end=$vdd;$day_str=(substr($mv021,6,2)-1);}
			 	   if (substr($mv022,0,6)==$vyymm1) { $day_end=substr($mv022,6,2);}	
				   if  ((substr($mv022,0,6)==$vyymm1) && (substr($mv022,6,2)=='31')) { $day_end=30;}
				   $workday = $day_end - $day_str - (($tc006/8)+($tc007/8)+($tc009)+($tc010/8)+($tc012)+($tc013)+($tc014)+($tc015));
				   //作為之前以請假請就職前日子的補救
				   if($workday<0){$workday=$workday+(($tc006/8)+($tc007/8)+($tc009)+($tc010/8)+($tc012)+($tc013)+($tc014)+($tc015));}
			
                 //  離職追補工作天數0 
				 //  if ($td055=='Y') {$workday=0;$workday9=0;}
				   
			//   if (substr($mv021,0,6)==$vyymm1 && $workday>30) { $workday=30;}
				//   if (substr($mv022,0,6)==$vyymm1 && $workday>30) { $workday=30;}
				//   if (substr($mv021,5,2)=='02' && $workday>28) { $workday=30;}
				//   if (substr($mv022,5,2)=='02' && $workday>28) { $workday=30;}
				  //扣假
				//   if (substr($mv021,0,6)==$vyymm1) { $tc006=(30-$workday)*8;}
                //   if (substr($mv022,0,6)==$vyymm1) { $tc006=(30-$workday)*8;}
				  //時底薪, 時全薪, 加班使用  請假扣款不扣伙食津貼:hhamt2
				    $hhamt=$md004/30/8;
					$hhamt1=round($md013/30/8,2);
					$hhamt2=round(($md013-$md007)/30/8,2);
				//	$hhamt3=($md004+$md005+$md006+$md012)/240;    //皇興 加班
					$hhamt3=($md004+$md005+$md006+$md009+$md010+$md011+$md012)/240;    //皇興 加班1050810
				//	$hhamt4=($md004+$md005+$md006+$md007+$md012)/240;    //皇興 請假
					$hhamt4=($md004+$md005+$md006+$md007+$md009+$md010+$md011+$md012)/240;    //皇興伙食津貼全勤不扣 請假1050810
				  //扣全勤奬金 =4小時 500, 8小時 02  allworkamt 1051006
				    $allworkamt=0;
					//if ($md008>0) { $allworkamt= $md008;}
					/*	2017.03.31	事假>4無全勤 病假>8無全勤  遲到>=3 500 >=5 1000 tc004
                    $hh=$tc006+round($tc007/2,0);
					if ( (($hh>4) && ($hh<8)) && ($md008>0) ) { $allworkamt= 500;}
					if ( ($hh>=8) && ($md008>0) ) { $allworkamt= 1000;}
					*/
					if($md008>0){
						if ( $tc004>=3 && $tc004< 5 ){ $allworkamt= 500; }
						if ( $tc006>4 ){ $allworkamt= 1000; }
						if ( $tc007>8 ){ $allworkamt= 1000; }
						if ( ($tc015 > 0) || ($tc004>=5) )  { $allworkamt= 1000; }//2017.03.30	有曠職就沒扣全勤1000
						//if (substr($mv021,0,6)==$vyymm1 && substr($mv022,0,6)==$vyymm1) { $allworkamt= 1000;}  //離職沒全勤
					}
                  //請假扣款 曠職扣款damt1 ,事,病,無薪
				 /*   $damt1=round($hhamt2*($tc015*3*8),0);
					$damt2=round($hhamt2*$tc006,0);
					$damt3=round($hhamt2*($tc007/2),0);
                    $damt4=round($hhamt*$tc010,0);	*/
					//皇興請假 無條件拾去
					$damt1=round($hhamt4*($tc015*8),0);
					$damt2=round($hhamt4*$tc006,0);
					$damt3=round($hhamt4*($tc007/2),0);
                    $damt4=round($hhamt*$tc010,0);	
					//if ($tc010==8) {$damt4=$md003;}
                    $damt=$damt1+$damt2+$damt3+$damt4;
				  //固定津貼請假扣款  vtd008. md004..12  得貹
			/*		$vtd008=round(round($md004/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)+$tc010),0);
					$vtd009=round(round($md005/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd010=round(round($md006/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
				
					$vtd011=0;
					$vtd012=round(round($md008/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd013=round(round($md009/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd014=round(round($md010/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd015=round(round($md011/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
				    $vtd016=round(round($md012/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$damt=$vtd008+$vtd009+$vtd010+$vtd011+$vtd012+$vtd013+$vtd014+$vtd015+$vtd016;    */
				//固定津貼請假扣款  vtd008. md004..12  皇興 1050722  0909
					$vtd008=0;
					$vtd009=0;
					$vtd010=0;
				//	$vtd011=round(round($md007/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd011=0;
					$vtd012=$allworkamt;
					$vtd013=0;
					$vtd014=0;
					$vtd015=0;
				    $vtd016=0;
					if (((substr($mv021,0,6)==$vyymm1) or (substr($mv022,0,6)==$vyymm1))) { $vtd012=0;  }
				//	$damt=$vtd008+$vtd009+$vtd010+$vtd011+$vtd012+$vtd013+$vtd014+$vtd015+$vtd016;    // 皇興1050722
				   //皇興固定津貼
				    $zmd004=$md004;$zmd005=$md005;$zmd006=$md006;$zmd007=$md007;$zmd008=$md008;$zmd009=$md009;
				    $zmd010=$md010;$zmd011=$md011;$zmd012=$md012;
				   //皇興到職 離職 固定津貼金額 1050809 0909 and (substr($mv022,6,2)<=30)
				   if (((substr($mv021,0,6)==$vyymm1 && substr($mv021,6,2)!="01") or (substr($mv022,0,6)==$vyymm1 && substr($mv022,6,2)!=$month_day))) {
				   $zmd004=round(($md004/30)*$workday9,0);$zmd005=round(($md005/30)*$workday9,0);$zmd006=round(($md006/30)*$workday9,0);$zmd007=round(($md007/30)*$workday9,0); 
				   $zmd009=round(($md009/30)*$workday9,0);$zmd010=round(($md010/30)*$workday9,0);$zmd011=round(($md011/30)*$workday9,0);
				   $zmd012=round(($md012/30)*$workday9,0);$zmd008=0;/*var_dump($mv021);var_dump($zmd004);*/}
				//   if ($md001="A105007") {$zmd008=1000; $vtd012= 0;} 新進第一天01,離職最後一天30月底
				if (((substr($mv021,0,6)==$vyymm1) && (substr($mv021,-2,2)=='01'))) {$zmd008=$md008;}
				if (((substr($mv022,0,6)==$vyymm1) && (substr($mv022,-2,2)==$vdd))) {$zmd008=$md008;}
 				//加班費 皇興假日 1.2 底薪 hhamt3    外勞1  1050809 mv032=3
				  //  $vtc017=round($hhamt1*$tc017*1.33,0);   
				//	$vtc018=round($hhamt1*$tc018*1.66,0);
				//	$vtc019=round($hhamt1*$tc019,0);
				//	$vtc021=round($hhamt1*$tc021,0);
				//	if (substr($mv009,1,1)>'9'){$vtc019=round($vtc019*0.58,0);} //外勞假日照正常算2017.02.14
				/*
					$vtc017=round($hhamt3*$tc017*1.33,0);
					$vtc018=round($hhamt3*$tc018*1.66,0);
					$vtc019=round($hhamt3*$tc019*1,0);
					$vtc020=round($hhamt3*$tc020*1.33,0);
				    $vtc021=round($hhamt3*$tc021*1,0);
					$vtc022=round($hhamt3*$tc022*1.33,0);
				*/
				//	2017.02.14新的加班薪資計算	
					$vtc017=round($hhamt3*$tc017*4/3,0);
					$vtc018=round($hhamt3*$tc018*5/3,0);
					$vtc019=round($hhamt3*$tc019*4/3,0);
					$vtc020=round($hhamt3*$tc020*5/3,0);
				    $vtc021=round($hhamt3*$tc021*1,0);
					$vtc022=round($hhamt3*$tc022*4/3,0);
					$vtc024=round($hhamt3*$tc024*5/3,0);//六加班8小時以上 先以三-八算法算 正常應為:*2.66
					$vtc025=round($hhamt3*$tc025*5/3,0);
					
					if ($mv032>='3') {$vtc021=round($hhamt3*$tc021,0);$vtc022=round($hhamt3*$tc022,0);}
				//應稅免稅時數46 overtime  tc020,tc021 六日加班8小時以上 //舊
				    /*$overtime1=$tc017+$tc018+$tc019+$tc021;
					$overtime2=$tc017+$tc018+$tc019+$tc021+$tc020+$tc022+$tc024+$tc025;
					if ($overtime1>46) {$over1=46;$over2=$overtime1-46;} else {$over1=$overtime1;$over2=0;}
					$over2=$overtime2-$over1;
					$over1amt=round($over1*$hhamt1*1.33,0);
					if (($vtc017+$vtc018+$vtc019+$vtc020+$vtc021+$vtc022+$vtc024+$vtc025)-$over1amt>0) {
					$over2amt=round(($vtc017+$vtc018+$vtc019+$vtc020+$vtc021+$vtc022+$vtc024+$vtc025)-$over1amt,0);} else {$over2amt=0;}
					*/
				//應稅免稅時數46 overtime  tc020,tc021 六日加班8小時以上	2017.03.02
					/*$non_tax_hour = 0;	$non_tax_over = 0;	//免稅
					$need_tax_hour = 0;	$need_tax_over = 0;	//應稅
					$nor_overtime = $tc017+$tc018;
					$sat_overtime = $tc019+$tc020;
					$sun_overtime = $tc021+$tc022;
					if($nor_overtime>46){
						$non_tax_hour=46;
						$need_tax_hour=$nor_overtime-46;
					}else{
						$non_tax_hour=$nor_overtime;
					}
					$non_tax_hour+=$tc019+$tc020+$tc021;//假日八小時內的欄位
					if($tc024>0){
						$need_tax_hour+=$tc024;
					}
					if($tc022+$tc025>0){
						$need_tax_hour+=$tc022+$tc025;
					}
					
					if($nor_overtime>46){
						if($tc017>46){
							$non_tax_over+=round($hhamt3*46*4/3,0);
							$need_tax_over+=round($hhamt3*($tc017-46)*4/3,0)+round($hhamt3*$tc018*5/3,0);
						}else{
							$non_tax_over+=round($hhamt3*$tc017*4/3,0)+round($hhamt3*(46-$tc017)*5/3,0);
							$need_tax_over+=round($hhamt3*($tc018-(46-$tc017))*5/3,0);
						}
					}else{
						$non_tax_over+=round($hhamt3*$tc017*4/3,0)+round($hhamt3*$tc018*5/3,0);
					}
					
					$non_tax_over+=round($hhamt3*$tc019*4/3,0)+round($hhamt3*$tc020*5/3,0)+round($hhamt3*$tc021*1,0);
					$need_tax_over+=round($hhamt3*$tc024*5/3,0)+round($hhamt3*$tc022*4/3,0)+round($hhamt3*$tc025*5/3,0);
					*/
					
				//↓---Talence Editor 2017.03.20
				//免稅加班46HR算法
					if($tc017+$tc018+$tc019+$tc020 <= 46){
						$non_tax_hour = $tc017+$tc018+$tc019+$tc020+$tc021+$tc022;
						$non_tax_over = round(($tc017*4/3+$tc018*5/3+$tc019*4/3+$tc020*5/3+$tc021*1+$tc022*4/3)*$hhamt3,0);
						$need_tax_hour = 0;
						$need_tax_over = 0;
					}else if($tc017+$tc018+$tc019+$tc020 > 46){
						$total_hr = $tc017+$tc018+$tc019+$tc020;
						
						$col_ary = array('tc017'=>$tc017,'tc018'=>$tc018,'tc019'=>$tc019
										,'tc020'=>$tc020
									);
						$rate_ary = array('tc017'=>(4/3),'tc018'=>(5/3),'tc019'=>(4/3)
										,'tc020'=>(5/3),'tc021'=>1,'tc022'=>(4/3)
									);
						$need_tax_hr = 0;$need_tax = 0;$non_tax_hr=0;$non_tax = 0;
						foreach($col_ary as $k=>$v){
							if($total_hr>46){
								$total_hr -= $v;
								$need_tax_hr += $v;
								$need_tax += $v*$rate_ary[$k]*$hhamt3;
								
								if($total_hr<46){//如果扣到低於46則補正
									$non_tax_hr += (46-$total_hr);
									$non_tax += (46-$total_hr)*$rate_ary[$k]*$hhamt3;
									$need_tax_hr -= (46-$total_hr);
									$need_tax -= (46-$total_hr)*$rate_ary[$k]*$hhamt3;
								}
							}else{
								$non_tax_hr += $v;
								$non_tax += $v*$rate_ary[$k]*$hhamt3;
							}
						}
						
						$non_tax_hour = $non_tax_hr+$tc021+$tc022;
						$non_tax_over = round($non_tax,0)+round($tc021*$hhamt3+$tc022*$rate_ary['tc022']*$hhamt3,0);
						$need_tax_hour = $need_tax_hr;
						$need_tax_over = round($need_tax,0);
						
					}
				//↑---Talence Editor 2017.03.20
				
				
				//其他加減項
			/*其他加項*/   $vtd029=$ta004+$ta006+$ta007+$ta013;
			/*其他減項*/   $vtd038=$ta005+$ta008+$ta009+$ta010+$ta014+$ta015+$ta016+$ta017+$mv203;
				   // 1050809 其他加減項 到職離職
			/*	   if ((substr($mv021,0,6)==$vyymm1) or (substr($mv022,0,6)==$vyymm1)) {$vtd038=$md004-round(($md004/30)*$workday,0)+
				       $md005-round(($md005/30)*$workday,0)+$md006-round(($md006/30)*$workday,0)+$md007-round(($md007/30)*$workday,0)+
					   $md009-round(($md009/30)*$workday,0)+$md010-round(($md010/30)*$workday,0)+
					   $md011-round(($md011/30)*$workday,0)+$md012-round(($md012/30)*$workday,0);  } */
				   
				//應領薪資 vtd030  1050909
				//應領薪資=本薪(固定津貼)-本薪(薪資計算)+職務加級-職務加級+主管-主管+伙食-伙食
				//+全勤獎金-全勤獎金+特別-特別+業務-業務+執照-執照+資歷-資歷
				   $vtd030=$md004-$vtd008+$md005-$vtd009+$md006-$vtd010+$md007-$vtd011+$md008-$vtd012+$md009-$vtd013+
				   $md010-$vtd014+$md011-$vtd015+$md012-$vtd016+$vtc017+$vtc018+$vtc019+$vtc020+$vtc021+$vtc022+$vtd029-$damt;
				  
					if (((substr($mv021,0,6)==$vyymm1) or (substr($mv022,0,6)==$vyymm1))) {
					$vtd030=$zmd004-$vtd008+$zmd005-$vtd009+$zmd006-$vtd010+$zmd007-$vtd011+$zmd008-$vtd012+$zmd009-$vtd013+$zmd010-$vtd014+$zmd011-$vtd015+$zmd012-$vtd016+$vtc017+$vtc018+$vtc019+$vtc020+$vtc021+$vtc022+$vtd029-$damt;}
				  
				  $vtax = 0;
				  if(substr($mv009,1,1)>'9'){
					  $vtax = 0.06;
				  }
				  //2017.02.21	新增入境日所得稅判斷
				  if(substr($mv009,1,1)>'9'){
					  if(substr($mv021,0,4)==substr($vyymm1,0,4)){//當年度計算才需要判斷，其他交給離境
							$in_year = substr($mv021,0,4)*1;
							$in_month = substr($mv021,4,2)*1;
							$in_day = substr($mv021,6,2)*1;
							if($in_month>7 || ($in_month==7&&$in_day>=3)){
								if($vtd030>$md004*1.5)
									$vtax = 0.18;
							}
					  }
					  if(@$vtax<=0){
						  $vtax = 0.06;
					  }
				  }
					
				  //2017.01.12 新增離境日判斷
				  if(@$mv050){//有輸入才判斷
					$leave_year = substr($mv050,0,4)*1;
					$leave_month = substr($mv050,4,2)*1;
					$leave_day = substr($mv050,6,2)*1;
					if(($leave_year == substr($vyymm1,0,4))||$leave_year == substr($vyymm1,0,4)+1 && substr($vyymm1,4,2)==12){//當年分或上年份的12月才計算
						if($leave_month<7 || ($leave_month==7&&$leave_day<3)){//過當年份的7/3可以略過
							if($vtd030>$md004*1.5)
								$vtax = 0.18;
						}
					}
				  }
				  //if (substr($mv009,1,1)>'9' && $mv040 >0) { $vtax = $mv040;}//如果基本資料有輸入以基本資料為主，除非離境日計算

				//應稅所得 vtaxamt1=應領金額-免稅加班金額44-免稅伙食津貼49,   所得稅=vtaxamt1*稅率
				    //$vtaxamt1=$vtd030-$over1amt-$md007;
					$vtaxamt1=$vtd030;
					$vtd037=round($vtaxamt1*$vtax,0);
					if ($mv039>0) {$vtd037=$mv039;}
				   //外勞 1050809 0不扣所得稅
					//if ($mv032>='3') {$vtd037=round(($vtd030-$damt)*$vtax,0);}//$damt請假扣款
					if ($mv032>='3') {$vtd037=round($vtd030*$vtax,0);}
					if (($mv032>='3') && ($mv038=='0')) {$vtd037=0;}	//就算是外勞也按照設定
					if($vtd037<0) {$vtd037 = round($vtaxamt1*$vtax,0);}
					
				//個人代扣保費	//0.0191	//2017.03.20以前舊版
				    //if ($mv200>0&&$mv200<2) {$vtd035=round($vtaxamt1*$mv200,0);} else {$vtd035=0;}
				
				//↓---Talence Editor 2017.03.20
				//新增應稅所得 $td047=$vtd030-$td049 應領-免稅伙食	//應領大於10000才扣免稅伙食
					if($vtd030>=10000){$td047 = $vtd030-$md007;}else{$td047 = $vtd030;}
				//修改個人代扣 最低工資
					$vtd035 = 0;//歸零
					if($ml007<=0){
						if($mv200>0&&$mv200<1){
							$vtd035 = round($td047*$mv200,0);
						}else if($mv200==1||$mv200==2){
							$vtd035 = 0;
						}else if($mv200>2){
							$vtd035 = $mv200;
						}
					}
					if($vtd030<22000){
						$vtd035 = 0;
					}
					if(!isset($vtd035)){$vtd035 = 0;}
					
				//↑---Talence Editor 2017.03.20
				
				    if ($mv200>2) {$vtd035=$mv200;}
				//勞保健保費依照加保退保日期計算	2017.02.21 Talence Editor
					$sub_ml003 = $ml003;$sub_ml004 = $ml004;
					
					$ml015_day = substr($ml015,6,2);$ml016_day = substr($ml016,6,2);if(substr($ml015,0,6)!=$vyymm1){$ml015_day="01";}
					$ml017_day = substr($ml017,6,2);$ml018_day = substr($ml018,6,2);if(substr($ml017,0,6)!=$vyymm1){$ml017_day="01";}
					if($ml015_day>1 && substr($ml015,0,6)==$vyymm1){$sub_ml003=$sub_ml003-($ml003*($ml015_day-1)/30);}
					if($ml016_day<date("t",strtotime($ml016)) && substr($ml016,0,6)==$vyymm1){$sub_ml003=$sub_ml003-($ml003*(30-$ml016_day)/30);}
					if($ml018_day<date("t",strtotime($ml018)) && substr($ml018,0,6)==$vyymm1){$sub_ml004=0;}
					if($ml017_day>1 && substr($ml017,0,6)==$vyymm1){$sub_ml004=$ml004;if($ml017==$ml018){$sub_ml004=0;}}
					if($ml015<=$ml016 && substr($ml016,0,6)<$vyymm1){$sub_ml003=0;}
					if($ml017<=$ml018 && substr($ml018,0,6)<$vyymm1){$sub_ml004=0;}
					$ml003 = round($sub_ml003,0);$ml004 = round($sub_ml004,0);
					
				//實領金額 vtd039   1050722  減勞保自提金額6% ti016 yd056  1070115
				    $vtd056=$ti016;
				    $vtd039=$vtd030-$tb004-$ml003-$ml004-$vfood-$vtd037-$vtd038-$vtd035-$vtd056;
				//轉帳金額
					if ($mv034 == 'C') {$vtd041=$vtd039;$vtd040=0;} else {$vtd040=$vtd039;$vtd041=0;}
				//固定現金
					if ($mv204 > 0) {$vtd041=$mv204;$vtd040=$vtd039-$mv204;}
					//判斷null
					if (is_null($md003)) {$md003=0;}
					if (is_null($tb004)) {$tb004=0;}
					if (is_null($ml003)) {$ml003=0;}
					if (is_null($ml004)) {$ml004=0;}
					if (is_null($ml007)) {$ml007=0;}
					if (is_null($md007)) {$md007=0;}
					if (is_null($ta012)) {$ta012='';}

		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
		         'td006' => $workday,
		         'td007' => $md003,
				 'td008' => $zmd004-$vtd008,
				 'td009' => $zmd005-$vtd009,
				 'td010' => $zmd006-$vtd010,
				 'td011' => $zmd007-$vtd011,
				 'td012' => $zmd008-$vtd012,
				 'td013' => $zmd009-$vtd013,
				 'td014' => $zmd010-$vtd014,
				 'td015' => $zmd011-$vtd015,
				 'td016' => $zmd012-$vtd016,
				 'td017' => $tc017,
				 'td018' => $vtc017,
				 'td019' => $tc018,
				 'td020' => $vtc018,
				 'td021' => $tc019,
				 'td022' => $vtc019,
				 'td023' => $tc020,
				 'td024' => $vtc020,
				 'td025' => $tc021,
				 'td026' => $vtc021,
				 'td027' => $tc022,
				 'td028' => $vtc022,
				 'td029' => $vtd029,
				 'td030' => $vtd030,
				 'td031' => $tb004,
				 'td032' => $damt,
				 'td033' => $ml003,
				 'td034' => $ml004,
				 'td035' => $vtd035,
				 'td036' => $vfood,
				 'td037' => $vtd037,
				 'td038' => $vtd038+$vtd056,
				 'td039' => $vtd039,
				 'td040' => $vtd040,
				 'td041' => $vtd041,
				 'td042' => $ta012,
				 'td043' => $non_tax_hour,
				 'td044' => $non_tax_over,
				 'td045' => $need_tax_hour,
				 'td046' => $need_tax_over,
				 'td047' => $td047,
				 'td048' => $ml007,
				 'td056' => $vtd056,
				 'td049' => $md007
               				  
                );
					//echo "<pre>"; var_dump($data1);exit;			
				
               $this->db->where('td001', $mv001);
		       $this->db->where('td005', $vyymm1);
			   $this->db->update('paltd', $data1);
			   $vtd039=0;
			  // if(($temp_count/$totle*100)==100) echo "<script>alert('轉入完成');parent.$.unblockUI();parent.show_totle($totle);</script>";
	}
	
	//離職追補
	$data2 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
		         'td006' => 0,
		         'td007' => 0,
				 'td008' => 0,
				 'td009' => 0,
				 'td010' => 0,
				 'td011' => 0,
				 'td012' => 0,
				 'td013' => 0,
				 'td014' => 0,
				 'td015' => 0,
				 'td016' => 0,
				 'td017' => 0,
				 'td018' => 0,
				 'td019' =>0,
				 'td020' => 0,
				 'td021' => 0,
				 'td022' => 0,
				 'td023' => 0,
				 'td024' =>0,
				 'td025' => 0,
				 'td026' => 0,
				 'td027' => 0,
				 'td028' => 0,
				 'td030' => 0,
				// 'td031' => 0,
				 'td032' => 0,
				 'td033' => 0,
				 'td034' => 0,
				 'td035' => 0,
				 'td036' => 0,
				 'td037' => 0,
				 'td038' => 0,
				 'td039' => 0,
				 'td040' => 0,
				 'td041' => 0,
				 'td043' => 0,
				 'td044' => 0,
				 'td045' => 0,
				 'td046' => 0,
				 'td047' => 0,
				 'td048' => 0,
				 'td049' => 0
               				  
                );
					//echo "<pre>"; var_dump($data1);exit;
		       $this->db->where('td005', $vyymm1);
			   $this->db->where('td055', 'Y');
			   $this->db->update('paltd', $data2);
			   $sql299 ="update paltd set td030=td029,td039=td029-td031,td040=td029-td031 where td055='Y' and td005='$vyymm1'  ";
			   $this->db->query($sql299);
//	if(($temp_count/$totle*100)<=0) echo "<script>alert('無資料');parent.$.unblockUI();parent.show_totle(0);</script>";
			//計算切傳票
			//刪除計算當月切傳票 PALTV
		   $this->db->where('tv003', $vyymm1);
		   $this->db->delete('paltv');  
		
		//新增切傳票 PALTV 1050722
		 /* $sql299 = "INSERT INTO  paltv (company,tv001,tv002,tv003,tv004,tv005,tv006,tv007,tv008,tv009,tv010,tv011,tv012,tv013,tv014,tv015) 
		           select '001',mv206,mv205,$vyymm1,IFNULL(mj002,'') as mv205disp,sum(td030),sum(td031),sum(td033),sum(td034),sum(td035),sum(td036),sum(td037),sum(td038),sum(td039),sum(td040),sum(td041) from paltd as a
		           LEFT JOIN cmsmv as b ON td001=mv001 
				   LEFT JOIN palmj as c ON mv205=mj001 group by '001',mv206,mv205,'$vyymm1',mj002 "; 
		  $this->db->query($sql299); */
	//echo "<script>parent.$('#ps').text('計算完成年月　：　".$vyymm."');</script>";
	        //return  "轉入完成";  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>