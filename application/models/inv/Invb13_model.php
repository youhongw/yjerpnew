<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invb13_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//計算庫存傳新計算資料
	function batchaf()           
        {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			//$vdd=substr($this->input->post('ta034c'),7,2);
		//	$vtd003=$this->input->post('cmsq03a');    //庫別
			//$vymd=$vyy.$vmm.$vdd;
			$vyymm=$vyy.$vmm;
			$vyymmdd1=$vyy.$vmm.'01';
			$vyymmdd2=$vyy.$vmm.'31';
			//上月 $vmm
			 $yyy = (int)$vyy-0 ;
			$num = (int)$vmm-1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}  //上月
			if ($vmm=='01') {$yyy=$yyy;$mmm='00';}    //本年$yyy,$mmm //上月
			$lyymm=$yyy.$mmm;
			
		 			  
		//invmc 庫存歸零 where mc002='$vtd003'
		    $sqlk = " update  invmc set mc007=0,mc008=0    ";
            $this->db->query($sqlk); 
		//invlb 當月品號庫存歸零  刪除計算月份
		    $sqlk = " delete from invlb  where lb002='$vyymm'   ";
            $this->db->query($sqlk);
		//invlb 當月品號庫存歸零  刪除計算月份
		    $sqlk = " delete from invlc  where lc002='$vyymm'   ";
            $this->db->query($sqlk);
			
		//cmsmc 庫別 1080731  品號每月統計單頭 invlb invlc insert
		//品號年月 單位lb043 insert invlb
		$sql03 ="insert into invlb (lb001,lb002,lb043) select mb001,$vyymm,mb004 from invmb ";
          $this->db->query($sql03);
		  //品號年月庫別單位lc043 insert invlc 庫別cmsmc
		   $query101 = $this->db->query("SELECT mc001   FROM cmsmc ");         
		    foreach ($query101->result() as $row) {
				$vstockno=$row->mc001;
				$sql03 ="insert into invlc (lc001,lc002,lc003,lc043) select mb001,$vyymm,'$vstockno',mb004 from invmb ";
           $this->db->query($sql03);
		    }
	     //上月期未轉本月期初
		 $sql1=" update invlb as a,
		         (select lb001,lb002,lb041,lb042,lb043 from invlb where lb002='$lyymm' ) as b
				  set a.lb003=b.lb041, a.lb004=b.lb042 
				  where a.lb001=b.lb001 and a.lb002='$vyymm' and a.lb043=b.lb043 ";
		$this->db->query($sql1);
		$sql2=" update invlc as a,
		         (select lc001,lc002,lc003,lc041,lc042,lc043  from invlc where lc002='$lyymm' ) as b
				  set a.lc004=b.lc041, a.lc005=b.lc042 
				  where a.lc001=b.lc001 and a.lc002='$vyymm' and a.lc003=b.lc003 and a.lc043=b.lc043 ";
		$this->db->query($sql2);
		
		//cmsmc 庫別 1080731  品號每月統計單頭 invlb invlc
         	$querycmsmc = $this->db->query("SELECT mc001   FROM cmsmc ");         
		    foreach ($querycmsmc->result() as $row) {	
			        $vstockno=$row->mc001;
				 // 進貨lc006,lc007 purth 品號4,庫別9, 單位8, 數量16, 金額47,單價lc026 Y 確認碼 th030='Y' 單據日期tg014
		     $sql11 = " UPDATE  `invlc` AS A,  
       (SELECT th004,th009,th008,IFNULL(sum(th016),0) as th016, IFNULL(sum(th047),0) as th047  
	   FROM `purtg` as c, `purth` as d WHERE tg001=th001 and tg002=th002 and tg014>='$vyymmdd1' and tg014<='$vyymmdd2'
	       and th016>0  and th009='$vstockno' GROUP BY th004,th009,th008 ) AS B  
    SET A.`lc006`=A.`lc006`+B.`th016` ,A.`lc007`=A.`lc007`+B.`th047`,A.`lc026`=B.`th047`/B.`th016` 
    WHERE A.`lc001`=B.`th004` and A.`lc003`=B.`th009` and A.lc043=B.th008 and A.`lc002`='$vyymm' "; 
	    $this->db->query($sql11);
            // 退貨lc033,lc024  purtj  tj020='Y'
		     $sql21 = " UPDATE  `invlc` AS A,  
       (SELECT tj004,tj011,tj007,IFNULL(sum(tj009),0) as tj009, IFNULL(sum(tj010),0) as tj010  
	    FROM `purti` as c, `purtj` as d WHERE ti001=tj001 and ti002=tj002 and ti014>='$vyymmdd1' and ti014<='$vyymmdd2'
	       and tj009>0 and tj011='$vstockno'  GROUP BY tj004,tj011,tj007 ) AS B  
    SET A.`lc033`=A.`lc033`+B.`tj009` ,A.`lc034`=A.`lc034`+B.`tj010` 
    WHERE A.`lc001`=B.`tj004` and A.`lc003`=B.`tj011` and A.lc043=B.tj007  and A.`lc002`='$vyymm' "; 
	    $this->db->query($sql21);
		
        //銷貨 lc008,lc009  copth 品號,庫別, 單位, 數量, x金額 th020='Y' lc001品號 lc002 年月,lc003 庫別
		     $sql31 = " UPDATE  `invlc` AS A,  
       (SELECT th004,th007,th009,IFNULL(sum(th008),0) as th008, IFNULL(sum(th013),0) as th013  
	   FROM `coptg` as c, `copth` as d WHERE tg001=th001 and tg002=th002 and tg042>='$vyymmdd1' and tg042<='$vyymmdd2'
	       and th008>0 and th007='$vstockno' GROUP BY th004,th007,th009 ) AS B  
    SET A.`lc008`=A.`lc008`+B.`th008`, A.lc009=A.lc009+(B.th008*A.lc026)
	WHERE A.`lc001`=B.`th004` and A.`lc002`='$vyymm' and A.`lc003`=B.`th007` and A.lc043=B.th009 ";
		    $this->db->query($sql31);
		//銷退lc018,lc019 coptj 品號,庫別, 單位, 數量, x金額 tj021='Y' and A.`mc003`=B.`tj008`
		     $sql32 = " UPDATE  `invlc` AS A,  
       (SELECT tj004,tj013,tj008,IFNULL(sum(tj007),0) as tj007, IFNULL(sum(tj012),0) as tj012  
	   FROM `copti` as c, `coptj` as d WHERE ti001=tj001 and ti002=tj002 and ti034>='$vyymmdd1' and ti034<='$vyymmdd2'
	       and tj007>0 and tj013='$vstockno' GROUP BY tj004,tj013,tj008 ) AS B  
    SET A.`lc018`=A.`lc018`+B.`tj007`, A.lc019=A.lc019+(B.tj007*A.lc026)  
    WHERE A.`lc001`=B.`tj004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tj013` and A.lc043=B.tj008 ";
		    $this->db->query($sql32);	
			
		//轉撥單 lc022,lc023  轉出庫 - invtb 品號,庫別, 單位, 數量 tb018='Y'
		     $sql41 = " UPDATE  `invlc` AS A,  
       (SELECT tb004,tb012,tb008,IFNULL(sum(tb007),0) as tb007, IFNULL(sum(tb011),0) as tb011  
	   FROM `invta` as c, `invtb` as d WHERE ta001=tb001 and ta002=tb002 and ta014>='$vyymmdd1' and ta014<='$vyymmdd2'
	       and tb009>0 and tb012='$vstockno' GROUP BY tb004,tb012,tb008 ) AS B  
    SET A.`lc022`=A.`lc022`+B.`tb007`, A.lc023=A.lc023+(B.tb007*A.lc026) 
    WHERE A.`lc001`=B.`tb004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tb012` and A.lc043=B.tb008  ";
		    $this->db->query($sql41); 
		//轉撥單lc012,lc013   轉入庫 + invtb 品號,庫別, 單位, 數量 tb018='Y'
		     $sql42 = " UPDATE  `invlc` AS A,  
       (SELECT tb004,tb013,tb008,IFNULL(sum(tb007),0) as tb007, IFNULL(sum(tb011),0) as tb011  
	   FROM `invta` as c, `invtb` as d WHERE ta001=tb001 and ta002=tb002 and ta014>='$vyymmdd1' and ta014<='$vyymmdd2'
	       and tb009>0 and tb013='$vstockno' GROUP BY tb004,tb013,tb008 ) AS B  
    SET A.`lc012`=A.`lc012`+B.`tb007`, A.lc013=A.lc013+(B.tb007*A.lc026)  
    WHERE A.`lc001`=B.`tb004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tb013` and A.lc043=B.tb008 ";
		    $this->db->query($sql42);

	//組合單lc035,lc036 單頭檔  轉入庫 + bomtd 品號,庫別, 單位, 數量 td012='Y'  1040926 1023 檔頭
		     $sql43 = " UPDATE  `invlc` AS A,  
       (SELECT td004,td010,td005,IFNULL(sum(td007),0) as td007,IFNULL(sum(td201),0) as td201   
	   FROM `bomtd` as c  WHERE   td014>='$vyymmdd1' and td014<='$vyymmdd2' and
	        td007>0 and td010='$vstockno' GROUP BY td004,td010,td005 ) AS B  
    SET A.`lc035`=A.`lc035`+B.`td007`,A.`lc036`=A.`lc036`+(B.td007*A.lc026) 
    WHERE A.`lc001`=B.`td004` and A.`lc002`='$vyymm' and A.`lc003`=B.`td010` and A.lc043=B.td005  ";
		    $this->db->query($sql43);
    //組合單lc037,lc038  單身檔 轉出庫 + bomte 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql44 = " UPDATE  `invlc` AS A,  
       (SELECT te004,te007,te005,IFNULL(sum(te008),0) as te008,IFNULL(sum(te201),0) as te201   
	   FROM `bomtd` as c, `bomte` as d WHERE td001=te001 and td002=te002 and  td014>='$vyymmdd1' and  td014<='$vyymmdd2'
	       and te008>0 and te007='$vstockno' GROUP BY te004,te007,te005 ) AS B  
    SET A.`lc037`=A.`lc037`-B.`te008`,A.`lc038`=A.`lc038`-(B.te008*A.lc026) 
    WHERE A.`lc001`=B.`te004` and A.`lc002`='$vyymm' and A.`lc003`=B.`te007` and A.lc043=B.te005  ";
		    $this->db->query($sql44);  			
	
    //拆解單
    //拆解單lc037,lc038 單頭檔  轉出庫 + bomtf 品號,庫別, 單位, 數量 td012='Y'  1040926 1023 檔頭
		     $sql43 = " UPDATE  `invlc` AS A,  
       (SELECT tf004,tf008,tf005,IFNULL(sum(tf007),0) as tf007,IFNULL(sum(tf201),0) as tf201   
	   FROM `bomtf` as c  WHERE   tf012>='$vyymmdd1' and tf012<='$vyymmdd2' and
	        tf007>0 and tf008='$vstockno' GROUP BY tf004,tf008,tf005 ) AS B  
    SET A.`lc037`=A.`lc037`-B.`tf007`,A.`lc038`=A.`lc038`-(B.tf007*A.lc026) 
    WHERE A.`lc001`=B.`tf004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tf008` and A.lc043=B.tf005  ";
		    $this->db->query($sql43);
	//拆解單lc035,lc036  單身檔 轉入庫 + bomtg 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql44 = " UPDATE  `invlc` AS A,  
       (SELECT tg004,tg007,tg005,IFNULL(sum(tg008),0) as tg008,IFNULL(sum(tg201),0) as tg201   
	   FROM `bomtf` as c, `bomtg` as d WHERE tf001=tg001 and tf002=tg002 and  tf012>='$vyymmdd1' and  tf012<='$vyymmdd2'
	       and tg008>0 and tg007='$vstockno' GROUP BY tg004,tg007,tg005 ) AS B  
    SET A.`lc035`=A.`lc035`+B.`tg008`,A.`lc036`=A.`lc036`+(B.tg008*A.lc026) 
    WHERE A.`lc001`=B.`tg004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tg007` and A.lc043=B.tg005  ";
		    $this->db->query($sql44);

	//調整單lc014,lc015  單身檔 轉入庫 + INVTJ TK 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql45 = " UPDATE  `invlc` AS A,  
       (SELECT tk004,tk017,tk018,IFNULL(sum(tk007),0) as tk007, IFNULL(sum(tk016),0) as tk016  
	   FROM `invtj` as c, `invtk` as d WHERE tj001=tk001 and tj002=tk002 and tj012>='$vyymmdd1' and tj012<='$vyymmdd2'
	       and tk007>0 and tk017='$vstockno' GROUP BY tk004,tk017,tk018 ) AS B  
    SET A.`lc014`=A.`lc014`+B.`tk007`, A.lc015=A.lc015+(B.tk007*A.lc026)  
    WHERE A.`lc001`=B.`tk004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tk017` and A.lc043=B.tk018 ";
		    $this->db->query($sql45);		
	
	//換算單位 invmd  品號,單位,換算數量分子******************************************************************
	
	// 進貨lc006,lc007 purth 品號4,庫別9, 單位8, 數量16, 金額47,單價lc026 Y 確認碼 th030='Y' 單據日期tg014
		     $sql11 = " UPDATE  `invlc` AS A,  
       (SELECT th004,th009,th008,IFNULL(sum(th016),0) as th016, IFNULL(sum(th047),0) as th047, IFNULL(sum(md003),0) as md003  
	   FROM `purtg` as c, `purth` as d , invmd as g WHERE th004=md001 and th008=md002 and tg001=th001 and tg002=th002  and tg014>='$vyymmdd1' and tg014<='$vyymmdd2'
	       and th016>0  and th009='$vstockno' GROUP BY th004,th009,th008 ) AS B  
    SET A.`lc006`=A.`lc006`+(B.`th016`*md003) ,A.`lc007`=A.`lc007`+B.`th047`,A.`lc026`=B.`th047`/(B.`th016`*md003) 
    WHERE A.`lc001`=B.`th004` and A.`lc003`=B.`th009` and A.lc043=B.th008 and A.`lc002`='$vyymm' "; 
	    $this->db->query($sql11);
            // 退貨lc033,lc024  purtj  tj020='Y'
		     $sql21 = " UPDATE  `invlc` AS A,  
       (SELECT tj004,tj011,tj007,IFNULL(sum(tj009),0) as tj009, IFNULL(sum(tj010),0) as tj010, IFNULL(sum(md003),0) as md003  
	    FROM `purti` as c, `purtj` as d, invmd as g WHERE tj004=md001 and tj007=md002 and ti001=tj001 and ti002=tj002 and ti014>='$vyymmdd1' and ti014<='$vyymmdd2'
	       and tj009>0 and tj011='$vstockno'  GROUP BY tj004,tj011,tj007 ) AS B  
    SET A.`lc033`=A.`lc033`+(B.`tj009`*md003) ,A.`lc034`=A.`lc034`+B.`tj010` 
    WHERE A.`lc001`=B.`tj004` and A.`lc003`=B.`tj011` and A.lc043=B.tj007  and A.`lc002`='$vyymm' "; 
	    $this->db->query($sql21);
		
		
        //銷貨 lc008,lc009  copth 品號,庫別, 單位, 數量, x金額 th020='Y' lc001品號 lc002 年月,lc003 庫別
		     $sql31 = " UPDATE  `invlc` AS A,  
       (SELECT th004,th007,th009,IFNULL(sum(th008),0) as th008, IFNULL(sum(th013),0) as th013, IFNULL(sum(md003),0) as md003  
	   FROM `coptg` as c, `copth` as d, invmd as g WHERE th004=md001 and th009=md002 and tg001=th001 and tg002=th002 and tg042>='$vyymmdd1' and tg042<='$vyymmdd2'
	       and th008>0 and th007='$vstockno' GROUP BY th004,th007,th009 ) AS B  
    SET A.`lc008`=A.`lc008`+(B.`th008`*md003), A.lc009=A.lc009+(B.th008*md003*A.lc026)
	WHERE A.`lc001`=B.`th004` and A.`lc002`='$vyymm' and A.`lc003`=B.`th007` and A.lc043=B.th009 ";
		    $this->db->query($sql31);
		//銷退lc018,lc019 coptj 品號,庫別, 單位, 數量, x金額 tj021='Y' and A.`mc003`=B.`tj008`
		     $sql32 = " UPDATE  `invlc` AS A,  
       (SELECT tj004,tj013,tj008,IFNULL(sum(tj007),0) as tj007, IFNULL(sum(tj012),0) as tj012, IFNULL(sum(md003),0) as md003  
	   FROM `copti` as c, `coptj` as d, invmd as g WHERE tj004=md001 and tj008=md002 and ti001=tj001 and ti002=tj002 and ti034>='$vyymmdd1' and ti034<='$vyymmdd2'
	       and tj007>0 and tj013='$vstockno' GROUP BY tj004,tj013,tj008 ) AS B  
    SET A.`lc018`=A.`lc018`+(B.`tj007`*md003), A.lc019=A.lc019+(B.tj007*md003*A.lc026)  
    WHERE A.`lc001`=B.`tj004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tj013` and A.lc043=B.tj008 ";
		    $this->db->query($sql32);	
			
		//轉撥單 lc022,lc023  轉出庫 - invtb 品號,庫別, 單位, 數量 tb018='Y'
		     $sql41 = " UPDATE  `invlc` AS A,  
       (SELECT tb004,tb012,tb008,IFNULL(sum(tb007),0) as tb007, IFNULL(sum(tb011),0) as tb011, IFNULL(sum(md003),0) as md003  
	   FROM `invta` as c, `invtb` as d, invmd as g WHERE tb004=md001 and tb008=md002 and ta001=tb001 and ta002=tb002 and ta014>='$vyymmdd1' and ta014<='$vyymmdd2'
	       and tb009>0 and tb012='$vstockno' GROUP BY tb004,tb012,tb008 ) AS B  
    SET A.`lc022`=A.`lc022`+(B.`tb007`*md003), A.lc023=A.lc023+(B.tb007*md003*A.lc026) 
    WHERE A.`lc001`=B.`tb004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tb012` and A.lc043=B.tb008  ";
		    $this->db->query($sql41); 
		//轉撥單lc012,lc013   轉入庫 + invtb 品號,庫別, 單位, 數量 tb018='Y'
		     $sql42 = " UPDATE  `invlc` AS A,  
       (SELECT tb004,tb013,tb008,IFNULL(sum(tb007),0) as tb007, IFNULL(sum(tb011),0) as tb011, IFNULL(sum(md003),0) as md003  
	   FROM `invta` as c, `invtb` as d, invmd as g WHERE tb004=md001 and tb008=md002 and ta001=tb001 and ta002=tb002 and ta014>='$vyymmdd1' and ta014<='$vyymmdd2'
	       and tb009>0 and tb013='$vstockno' GROUP BY tb004,tb013,tb008 ) AS B  
    SET A.`lc012`=A.`lc012`+(B.`tb007`*md003), A.lc013=A.lc013+(B.tb007*md003*A.lc026)  
    WHERE A.`lc001`=B.`tb004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tb013` and A.lc043=B.tb008 ";
		    $this->db->query($sql42);

	//組合單lc035,lc036 單頭檔  轉入庫 + bomtd 品號,庫別, 單位, 數量 td012='Y'  1040926 1023 檔頭
		     $sql43 = " UPDATE  `invlc` AS A,  
       (SELECT td004,td010,td005,IFNULL(sum(td007),0) as td007,IFNULL(sum(td201),0) as td201, IFNULL(sum(md003),0) as md003   
	   FROM `bomtd` as c, invmd as g WHERE td004=md001 and td005=md002 and   td014>='$vyymmdd1' and td014<='$vyymmdd2' and
	        td007>0 and td010='$vstockno' GROUP BY td004,td010,td005 ) AS B  
    SET A.`lc035`=A.`lc035`+(B.`td007`*md003),A.`lc036`=A.`lc036`+(B.td007*md003*A.lc026) 
    WHERE A.`lc001`=B.`td004` and A.`lc002`='$vyymm' and A.`lc003`=B.`td010` and A.lc043=B.td005  ";
		    $this->db->query($sql43);
    //組合單lc037,lc038  單身檔 轉出庫 + bomte 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql44 = " UPDATE  `invlc` AS A,  
       (SELECT te004,te007,te005,IFNULL(sum(te008),0) as te008,IFNULL(sum(te201),0) as te201, IFNULL(sum(md003),0) as md003   
	   FROM `bomtd` as c, `bomte` as d, invmd as g WHERE te004=md001 and te005=md002 and td001=te001 and td002=te002 and  td014>='$vyymmdd1' and  td014<='$vyymmdd2'
	       and te008>0 and te007='$vstockno' GROUP BY te004,te007,te005 ) AS B  
    SET A.`lc037`=A.`lc037`-(B.`te008`*md003),A.`lc038`=A.`lc038`-(B.te008*md003*A.lc026) 
    WHERE A.`lc001`=B.`te004` and A.`lc002`='$vyymm' and A.`lc003`=B.`te007` and A.lc043=B.te005  ";
		    $this->db->query($sql44);  			
	
    //拆解單
    //拆解單lc037,lc038 單頭檔  轉出庫 + bomtf 品號,庫別, 單位, 數量 td012='Y'  1040926 1023 檔頭
		     $sql43 = " UPDATE  `invlc` AS A,  
       (SELECT tf004,tf008,tf005,IFNULL(sum(tf007),0) as tf007,IFNULL(sum(tf201),0) as tf201, IFNULL(sum(md003),0) as md003   
	   FROM `bomtf` as c, invmd as g WHERE tf004=md001 and tf005=md002 and   tf012>='$vyymmdd1' and tf012<='$vyymmdd2' and
	        tf007>0 and tf008='$vstockno' GROUP BY tf004,tf008,tf005 ) AS B  
    SET A.`lc037`=A.`lc037`-(B.`tf007`*md003),A.`lc038`=A.`lc038`-(B.tf007*md003*A.lc026) 
    WHERE A.`lc001`=B.`tf004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tf008` and A.lc043=B.tf005  ";
		    $this->db->query($sql43);
	//拆解單lc035,lc036  單身檔 轉入庫 + bomtg 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql44 = " UPDATE  `invlc` AS A,  
       (SELECT tg004,tg007,tg005,IFNULL(sum(tg008),0) as tg008,IFNULL(sum(tg201),0) as tg201, IFNULL(sum(md003),0) as md003   
	   FROM `bomtf` as c, `bomtg` as d, invmd as g WHERE tg004=md001 and tg005=md002 and tf001=tg001 and tf002=tg002 and  tf012>='$vyymmdd1' and  tf012<='$vyymmdd2'
	       and tg008>0 and tg007='$vstockno' GROUP BY tg004,tg007,tg005 ) AS B  
    SET A.`lc035`=A.`lc035`+(B.`tg008`*md003),A.`lc036`=A.`lc036`+(B.tg008*md003*A.lc026) 
    WHERE A.`lc001`=B.`tg004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tg007` and A.lc043=B.tg005  ";
		    $this->db->query($sql44);

	//調整單lc014,lc015  單身檔 轉入庫 + INVTJ TK 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql45 = " UPDATE  `invlc` AS A,  
       (SELECT tk004,tk017,tk018,IFNULL(sum(tk007),0) as tk007, IFNULL(sum(tk016),0) as tk016, IFNULL(sum(md003),0) as md003  
	   FROM `invtj` as c, `invtk` as d, invmd as g WHERE tk004=md001 and tk018=md002 and tj001=tk001 and tj002=tk002 and tj012>='$vyymmdd1' and tj012<='$vyymmdd2'
	       and tk007>0 and tk017='$vstockno' GROUP BY tk004,tk017,tk018 ) AS B  
    SET A.`lc014`=A.`lc014`+(B.`tk007`*md003), A.lc015=A.lc015+(B.tk007*md003*A.lc026)  
    WHERE A.`lc001`=B.`tk004` and A.`lc002`='$vyymm' and A.`lc003`=B.`tk017` and A.lc043=B.tk018 ";
		    $this->db->query($sql45);	
			}
	//*****計算完成	
    //invlc 月單身檔lc041,lc042 金額 
			 $sqlz2 = " UPDATE  `invlc`  SET `lc041`=lc004+lc006-lc008-lc010+lc012+lc014+lc018-lc022-lc024+lc031-lc033+lc035-lc037,
			 `lc042`=lc005+lc007-lc009-lc011+lc013+lc015+lc019-lc023-lc025+lc032-lc034+lc036-lc038
              WHERE lc002='$vyymm' ";
			 $this->db->query($sqlz2);
     //invlb 單頭			 
       $sqlz21 = " UPDATE  `invlb` AS A,  
       (SELECT lc001,lc002,IFNULL(sum(lc004),0) as lc004, IFNULL(sum(lc005),0) as lc005, IFNULL(sum(lc041),0) as lc041, IFNULL(sum(lc042),0) as lc042  
	   FROM `invlc` as c WHERE  lc002>='$vyymmdd1' and lc002<='$vyymmdd2'
	        GROUP BY lc001,lc002 ) AS B  
    SET A.lb003=B.lc004, A.lb004=B.lc005, A.lb041=B.lc041, A.lb042=B.lc042 WHERE A.lb001=B.lc001 and A.lb002='$vyymm'  "; 
  
		    $this->db->query($sqlz21);
		
		 //invmc 統計檔 
			 $sqlz22 = " UPDATE  `invmc` AS A,  
       (SELECT lc001,lc002,lc003,IFNULL(sum(lc004),0) as lc004, IFNULL(sum(lc005),0) as lc005, IFNULL(sum(lc041),0) as lc041, IFNULL(sum(lc042),0) as lc042  
	   FROM `invlc` as c WHERE  lc002>='$vyymmdd1' and lc002<='$vyymmdd2'
	        GROUP BY lc001,lc002,lc003 ) AS B  
    SET A.`mc007`=B.lc041, A.mc008=B.lc042   
    WHERE A.`mc001`=B.`lc001` and A.`mc002`=B.lc003  ";
		    $this->db->query($sqlz22); 
	//invmb 基本檔 
			 $sqlz22 = " UPDATE  `invmb` AS A,  
       (SELECT mc001,IFNULL(sum(mc007),0) as mc007, IFNULL(sum(mc008),0) as mc008  
	    FROM `invmc` as c 
	        GROUP BY mc001 ) AS B  
    SET A.`mb064`=B.mc007, A.mb065=B.mc008,A.mb057=(B.mc008/B.mc007)   
    WHERE A.`mb001`=B.`mc001` and B.mc007<>0   ";
		    $this->db->query($sqlz22); 
			 
	     //invlc 0 刪除 lc004+lc006-lc008-lc010+lc012+lc014+lc018-lc022-lc024+lc31-lc033+lc035-lc037 
		$sqlz3 = " delete from `invlc` 
        WHERE (lc004<>0 and lc006<>0 and lc008<>0 and lc010<>0 and lc012<>0 and lc014<>0 and lc018<>0 and lc022<>0 and 
              lc024<>0 and lc031<>0 and lc033<>0 and lc035<>0 and lc037<>0 and lc041<>0)  		";
		    $this->db->query($sqlz3); 
        //invmc 0 刪除 7,8 	
        $sqlz31 = " delete from `invmc` 
        WHERE (mc007<>0 and mc008<>0 )  		";
		    $this->db->query($sqlz31);  
			
		  return true;	
    } 
	

}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>