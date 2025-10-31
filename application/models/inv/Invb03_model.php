<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invb03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//計算庫存及金額
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
	   FROM `invlc` as c WHERE  lc002='$vyymm'
	        GROUP BY lc001,lc002 ) AS B  
    SET A.lb003=B.lc004, A.lb004=B.lc005, A.lb041=B.lc041, A.lb042=B.lc042 WHERE A.lb001=B.lc001 and A.lb002='$vyymm'  "; 
  
		    $this->db->query($sqlz21);
		
		 //invmc 統計檔 
			 $sqlz22 = " UPDATE  `invmc` AS A,  
       (SELECT lc001,lc002,lc003,IFNULL(sum(lc004),0) as lc004, IFNULL(sum(lc005),0) as lc005, IFNULL(sum(lc041),0) as lc041, IFNULL(sum(lc042),0) as lc042  
	   FROM `invlc` as c WHERE  lc002='$vyymm'
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
			 
	     //invlc 0 刪除 lc004+lc006-lc008-lc010+lc012+lc014+lc018-lc020-lc022-lc024+lc31-lc033+lc035-lc037 
		$sqlz3 = " delete from `invlc` 
        WHERE (lc004=0 and lc006=0 and lc008=0 and lc010=0 and lc012=0 and lc014=0 and lc018=0 and lc020=0 and lc022=0 and 
              lc024=0 and lc031=0 and lc033=0 and lc035=0 and lc037=0 and lc041=0) and  lc002='$vyymm' 		";
		    $this->db->query($sqlz3); 
        //invmc 0 刪除 7,8 	
        $sqlz31 = " delete from `invmc` 
        WHERE (mc007<>0 and mc008<>0 )  		";
		    $this->db->query($sqlz31);  
			
		  return true;		
    } 
	
	
 	//庫存明細匯入	1080806
	function batchbf()           
       {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
		  //科目代號
		    $vyymmdd1=$vyy.$vmm.'01';
			$vyymmdd2=$vyy.$vmm.'31';      
		  
		  //刪除 庫存明細檔 invla
			         $this->db->where('la004 >=', $vyymmdd1);
					 $this->db->where('la004 <=', $vyymmdd2);
		             $this->db->delete('invla'); 
		  
		   // 入庫進貨 purth 品號,庫別, 單位, 數量, 金額,單價mc014 Y 確認碼 th030='Y'  品號,日期,入出別,單別,單號,序號,庫別,數量,成本,金額,異動別, 單位 la016
		  $sql11 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.th004,a.tg014,1,b.th001,b.th002,b.th003,b.th009,b.th016,b.th018,b.th019,'1',b.th008 from purtg as a,purth as b 
                               WHERE tg001=th001 and tg002=th002 and th016>0 and tg014>='$vyymmdd1' and  tg014<='$vyymmdd2'  ";
            $this->db->query($sql11);
		   
		 // 退庫退貨 purtj  tj020='Y'
		     $sql21 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.tj004,a.ti014,-1,b.tj001,b.tj002,b.tj003,b.tj011,b.tj009,b.tj008,b.tj010,'1',b.tj007 from purti as a,purtj as b 
                               WHERE ti001=tj001 and ti002=tj002 and tj009>0 and ti014>='$vyymmdd1' and  ti014<='$vyymmdd2'  ";
            $this->db->query($sql21); 
	
		   //銷貨 copth 品號,庫別, 單位, 數量, x金額 th020='Y'
		   $sql31 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.th004,a.tg042,-1,b.th001,b.th002,b.th003,b.th007,b.th008,b.th012,b.th013,'2',th009 from coptg as a,copth as b 
                               WHERE tg001=th001 and tg002=th002 and th008>0 and tg042>='$vyymmdd1' and  tg042<='$vyymmdd2' ";
            $this->db->query($sql31);
			
		 //銷退 coptj 品號,庫別, 單位, 數量, x金額 tj021='Y'
		   $sql32 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.tj004,a.ti034,1,b.tj001,b.tj002,b.tj003,b.tj013,b.tj007,b.tj011,b.tj012,'2',tj008 from copti as a,coptj as b 
                               WHERE ti001=tj001 and ti002=tj002 and tj007>0 and ti034>='$vyymmdd1' and  ti034<='$vyymmdd2' ";
            $this->db->query($sql32);
			
		 //轉撥單   轉出庫 - invtb 品號,庫別, 單位, 數量 tb018='Y'
		  $sql41 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.tb004,a.ta014,-1,b.tb001,b.tb002,b.tb003,b.tb012,b.tb009,b.tb010,b.tb011,'4',b.tb008 from invta as a,invtb as b 
                               WHERE ta001=tb001 and ta002=tb002 and tb009>0 and ta014>='$vyymmdd1' and  ta014<='$vyymmdd2' ";
            $this->db->query($sql41);
			
		//轉撥單   轉入庫 + invtb 品號,庫別, 單位, 數量 tb018='Y'
		    $sql42 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.tb004,a.ta014,1,b.tb001,b.tb002,b.tb003,b.tb013,b.tb009,b.tb010,b.tb011,'4',b.tb008 from invta as a,invtb as b 
                               WHERE ta001=tb001 and ta002=tb002 and tb009>0 and ta014>='$vyymmdd1' and  ta014<='$vyymmdd2' ";
            $this->db->query($sql42);
			
		//組合單   轉入庫 + bomtd 品號,庫別, 單位, 數量 td012='Y'  1041022 有問題
		   $sql43 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,a.td004,a.td014,1,a.td001,a.td002,'',a.td010,a.td007,0,0,'6',a.td005 from bomtd as a
                               WHERE  td007>0 and td014>='$vyymmdd1' and  td014<='$vyymmdd2' ";
            $this->db->query($sql43);
			
		//組合單   轉出庫 + bomte 品號,庫別, 單位, 數量 te010='Y'  1040926
		   $sql44 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.te004,a.td014,-1,b.te001,b.te002,b.te003,b.te007,b.te008,0,0,'6',b.te005 from bomtd as a, bomte as b
                               WHERE td001=te001 and td002=te002 and te008>0 and td014>='$vyymmdd1' and  td014<='$vyymmdd2' ";
            $this->db->query($sql44);
			
		//拆解單   轉出庫 - bomtf 品號,庫別, 單位, 數量 td012='Y'  1041022 有問題
		   $sql431 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,a.tf004,a.tf012,-1,a.tf001,a.tf002,'',a.tf008,a.tf007,0,0,'6',a.tf005 from bomtf as a
                               WHERE  tf007>0 and tf012>='$vyymmdd1' and  tf012<='$vyymmdd2' ";
            $this->db->query($sql431);
		//拆解單   轉入庫 + bomtg 品號,庫別, 單位, 數量 te010='Y'  1040926
		   $sql441 = " INSERT INTO  invla (company,creator,usr_group,create_date,modifier,modi_date,flag,la001,la004,la005,la006,la007,la008,la009,la011,la012,la013,la014,la016)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,b.tg004,a.tf012,1,b.tg001,b.tg002,b.tg003,b.tg007,b.tg008,0,0,'6',b.tg005 from bomtf as a, bomtg as b
                               WHERE tf001=tg001 and tf002=tg002 and tg008>0 and tf012>='$vyymmdd1' and  tf012<='$vyymmdd2' ";
            $this->db->query($sql441);
			
	 //換算單位 invmd  1041023---
		   // 入庫進貨 purth 品號,庫別, 單位, 數量, 金額,單價mc014 Y 確認碼,換算單位 數量th030=y  la016單位
		     $sqla1 = " UPDATE  `invla` AS A,  
       (SELECT th004,th009,th008,IFNULL(sum(th016),0) as th016, IFNULL(sum(th047),0) as th047, IFNULL(sum(md003),0) as md003  FROM `invmd` as c, `purth` as d,purtg as e 
	   WHERE tg001=th001 and tg002=th002 and md001=th004 and md002=th008 
	       and th016>0   GROUP BY th004,th009,th008 ) AS B  
    SET A.`la011`=A.`la011`+(B.`th016`*B.`md003`) ,A.`la013`=A.`la013`+B.`th047`,A.`la012`=B.`th047`/(B.`th016`*B.`md003`) 
    WHERE A.`la001`=B.`th004` and A.`la009`=B.`th009`  and A.`la016`!=B.`th008` and tg014>='$vyymmdd1' and  tg014<='$vyymmdd2' "; 
	    $this->db->query($sqla1); 	

      // 退庫退貨 purtj  tj020=y   
		     $sqlb1 = " UPDATE  `invla` AS A,  
       (SELECT tj004,tj011,tj007,IFNULL(sum(tj009),0) as tj009, IFNULL(sum(tj010),0) as tj010, IFNULL(sum(md003),0) as md003  
	   FROM `invmd` as c, `purtj` as d ,purti as e WHERE ti001=tj001 and ti002=tj002 and  md001=tj004 and md002=tj007 
	       and tj009>0   GROUP BY tj004,tj011,tj007 ) AS B  
    SET A.`la011`=A.`la011`-(B.`tj009`*B.`md003`) ,A.`la013`=A.`la013`-B.`tj010` 
    WHERE A.`la001`=B.`tj004` and A.`la009`=B.`tj011`  and A.`la016`!=B.`tj007` and ti014>='$vyymmdd1' and  ti014<='$vyymmdd2' "; 
	    $this->db->query($sqlb1); 

        //銷貨 copth 品號,庫別, 單位, 數量, x金額th020=y
		     $sqlc1 = " UPDATE  `invla` AS A,  
       (SELECT th004,th007,th009,IFNULL(sum(th008),0) as th008, IFNULL(sum(th013),0) as th013, IFNULL(sum(md003),0) as md003  
	   FROM `invmd` as c, `copth` as d ,coptg as e WHERE tg001=th001 and tg002=th002 and md001=th004 and md002=th009 
	       and th008>0  GROUP BY th004,th007,th009 ) AS B  
    SET A.`la011`=A.`la011`-(B.`th008`*B.`md003`) 
    WHERE A.`la001`=B.`th004` and A.`la009`=B.`th007` and A.`la016`!=B.`th009` and tg042>='$vyymmdd1' and  tg042<='$vyymmdd2'  ";
		    $this->db->query($sqlc1); 	

         //銷退 coptj 品號,庫別, 單位, 數量, x金額 tj021=y
		     $sql32 = " UPDATE  `invla` AS A,  
       (SELECT tj004,tj013,tj008,IFNULL(sum(tj007),0) as tj007, IFNULL(sum(tj012),0) as tj012, IFNULL(sum(md003),0) as md003  
	   FROM `invmd` as c, `coptj` as d ,copti as e WHERE ti001=tj001 and ti002=tj002 and md001=tj004 and md002=tj008 
	       and tj007>0  GROUP BY tj004,tj013,tj008 ) AS B  
    SET A.`la011`=A.`la011`+(B.`tj007`*B.`md003`)  
    WHERE A.`la001`=B.`tj004` and A.`la009`=B.`tj013` and A.`la016`!=B.`tj008` and ti034>='$vyymmdd1' and  ti034<='$vyymmdd2' ";
		    $this->db->query($sql32); 	
		  return true;	
    } 
	
//計算 試算表檔資料 actmba
	function batchcf()           
        {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			$num = (int)$vmm-1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='01') {$mmm='00';}  //上月
		  //科目代號 
		          //刪除計算月份
			         $this->db->where('mba001', $vyy);
					 $this->db->where('mba002', $vmm);
		             $this->db->delete('actmba'); 
		  
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
	$vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;$mvtb005a;
   
	$vdail=0;             //第一次廻圈
	$n=0;
	//		sleep(10);科目編號,科目名稱, 借貸餘額別,期初借方金額 mb0041,期初貸方金額mb0051, 本期借方金額,本期貸方金額,借方筆數, 貸方筆數, 期未  
     $sql="select mb001,ma003,ma019, 0 as mb0041, 0 as mb0051,mb004,mb005,mb006,mb007,0 as mb008,0 as mb009 
	  from `actmb` as a,`actma` as b  where  mb001=ma001 AND mb002 = '$vyy' AND mb003 = '$vmm'
      union
      select mb001,ma003,ma019,mb004,mb005,0,0,0,0,0,0 from  `actmb` as a,`actma` as b 
	   where  mb001=ma001 AND mb002 = '$vyy' AND mb003 = '$mmm' ";
	
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  if ($vdail==0) {$vtb005=$tb005;  }            //第一筆 科目相等 1040618
		 				 
	//	if ($vtb005!=$tb005 and $vdail >0 and $ma019==1)  {$tb0071=$mb0041-$mb004;$tb0072=0;$tb0151=$mb0051-$mb005;$tb0152=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;} else {$tb0072=$mb004-$mb0041;$tb0071=0;$tb0152=$mb005-$mb0051;$tb0151=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;}
	 	 
 		// if ($vtb005==$mb001 and  $vdail==0  and $ma019==1 )   {$tb0071=$mb0041-$mb004;$tb0072=0;$tb0151=$mb0051-$mb005;$tb0152=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;} else {$tb0072=$mb004-$mb0041;$tb0071=0;$tb0152=$mb005-$mb0051;$tb0151=0;$mb0041a=$mb0041a+$mb0041;$mb0051a=$mb0051a+$mb0051;}   //vtc0021 單號+1 
            if ( $vdail==0  and $ma019==1 )   {$vmb0041=$mb0041;$vmb0051=$mb0051;$vmb004=$mb004;$vmb005=$mb005;$vmb006=$mb006;$vmb007=$mb007;$tb0071=$mb0041+$mb004;$tb0151=$mb0051+$mb005;} 
		 if ( $vdail==0  and $ma019!=1 )      {$vmb0051=$mb0051;$vmb0041=$mb0041;$vmb005=$mb005;$vmb004=$mb004;$vmb007=$mb007;$vmb006=$mb006;$tb0071=$mb004+$mb0041;$tb0151=$mb005+$mb0051;} 
		
 		if ($vtb005!=$mb001 and  $vdail>0  and $ma019==1 )  {$vmb0041=$mb0041;$vmb0051=$mb0051;$vmb004=$mb004;$vmb005=$mb005;$vmb006=$mb006;$vmb007=$mb007;$tb0071=$mb0041+$mb004;$tb0151=$mb0051+$mb005;} 
		  if ($vtb005!=$mb001 and $vdail>0 and $ma019!=1)   {$vmb0051=$mb0051;$vmb0041=$mb0041;$vmb005=$mb005;$vmb004=$mb004;$vmb007=$mb007;$vmb006=$mb006;$tb0071=$mb004+$mb0041;$tb0151=$mb005+$mb0051;} 
		
    	if ($vtb005==$mb001 and  $vdail>0  and $ma019==1 )   {$vmb0041=$vmb0041+$mb0041;$vmb004=$vmb004+$mb004;$vmb005=$vmb005+$mb005;$vmb006=$vmb006+$mb006;$vmb007=$vmb007+$mb007;$tb0071=$mb0041+$mb004;$tb0151=$mb0051+$mb005;} 
		 if ($vtb005==$mb001 and $vdail>0 and $ma019!=1)     {$vmb0051=$vmb0051+$mb0051;$vmb005=$vmb005+$mb005;$vmb007=$vmb007+$mb007;$tb0071=$mb004+$mb0041;$tb0151=$mb005+$mb0051;}
		
        	$vtb005=$mb001;  //科目代號
			$vtb004=$ma019;  //借貸		

     		
			
		//	echo $mvtc002.'test';
		//	sleep(5);
		
				//科目各期金額檔 (試算表檔)  actmba
		$data2 = array(
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
				
	//	   if ($tb005>='' and $vdail==0) {$this->db->insert('actmb', $data1);}
			
		   //不同單號合計歸0  到  1040616
		    
		   if ($mvtb005a<>$vtb005 or $vdail==0  ) {	
			   $this->db->insert('actmba', $data2);			   
			   }
			   else {$this->db->where('mba003', $vtb005); 
			         $this->db->where('mba001', $vyy);
					 $this->db->where('mba002', $vmm);
				   $this->db->update('actmba ', $data2);}
		  //合計不同單號
		   $vdail++;           //預設 0  	
			$mvtb005a=$mb001;
			//if ($mvtb005<>$vtb005  or $vdail==0  ) {$vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;}
		//    $vmb0041=0;$vmb0051=0;$vmb004=0;$vmb005=0;$vmb006=0;$vmb007=0;
		    $n++; 
		
    }
		  return true;	
    } 
//計算 試算表檔餘額 actmba  mba014, mba015  0623-ok
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
			
            $data3 = array(
				 'mba014' => $vmba014,
				 'mba015' => $vmba015
                );	
			$this->db->where('mba003', $mba003); 
			$this->db->where('mba001', $vyy);
			$this->db->where('mba002', $vmm);
			$this->db->update('actmba', $data3);
			$n++; 	
			
		 }
		  return true;	
    } 
  //計算 損益表檔餘額 actmba 本期 8,9 mba016, 14,15累計mba017  
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
			
            $data4 = array(
				 'mba016' => $vmba016,
				 'mba017' => $vmba017
                );	
			$this->db->where('mba003', $mba003); 
			$this->db->where('mba001', $vyy);
			$this->db->where('mba002', $vmm);
			$this->db->update('actmba', $data4);
			$n++; 	
			
		 }
	//	  return true;	
   // } 
	//1040630 加上 3219 上期損益
      //科目代號 3218 本期損益		         
		  
		  $query = $this->db->query("SELECT mc005   FROM actmc ");         
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
			$mbb2001a=$mbb2001a[0];
			$mbb2002a=$mbb2002a[0];
			
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
			
		   $query99 = $this->db->query("SELECT mba003   FROM actmba where mba003='$vmc005' ");         
		foreach ($query99->result() as $row)
            {
            $mba0031[]=$row->mba003;		 
            }
			$vmba0031=$mba003[0];     //本期損益代號
		  
		  if ($vmba0031=='3219') {
		  $sql2 = "INSERT INTO  actmba (mba001,mba002,mba003,mba005,mba009,mba011,mba013,mba015,mba016,mba017) values ($vyy,$vmm,$vmc005,-1,$mbb2016z,1,$mbb2016z,$mbb2016z,$mbb2016z,$mbb2017z)    "; }
		  else
		  {$sql2 = "UPDATE actmba set mba001='$vyy',mba002='$vmm',mba003='$vmc005',mba005=-1,mba009='$mbb2016z',mba011=1,mba013='$mbb2016z',mba015='$mbb2016z',mba016='$mbb2016z',mba017='$mbb2017z'
                    WHERE mba001='$vyy' and mba002='$vmm' and mba003='$vmc005'  "; }
		   $this->db->query($sql2);	  
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
			 
			 //actmbb 本期損益 3219  1040701
			 //科目代號 3218 本期損益		         
		  
		  $query9991 = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query9991->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //本期損益代號
			
	      
			 $query2119 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  ");         
		foreach ($query2119->result() as $row)
            {
			 $mbb2001a1[]=$row->mbb2001;
			 $mbb2002a1[]=$row->mbb2002;
            $mbb2016a1[]=$row->mbb2016;
            $mbb2017a1[]=$row->mbb2017;			
            }
			$mbb2001a1=$mbb2001a1[0];
			$mbb2002a1=$mbb2002a1[0];
			
			 if(isset($mbb2016a1[0])) {
			$mbb2016a1=$mbb2016a1[0];
			$mbb2017a1=$mbb2017a1[0];}
			 else 
			{ $mbb2016a1=0;
			  $mbb2017a1=0;}
			
			
		  $query2129 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '5 '  ");         
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
		  WHERE  substring(mbb2003,1,2) = '6 '  ");         
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
		  WHERE  substring(mbb2003,1,2) = '7 '  ");         
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
		   $this->db->query($sql29);	
			 
			 
			 
			//找相同品號update  test 1200
             $sql2 =" update actmbb b,(select b.mbb001,b.mbb002,b.mbb003,b.mbb016,b.mbb017,a.mba001 as mba001,a.mba002 as mba002,
               a.mba003 as mba003,a.mba016 as mba016,a.mba017 as mba017
               from actmba  a, actmbb b
               where a.mba001=b.mbb001 and a.mba002=b.mbb002 and a.mba003=b.mbb003 
                ) c
               set b.mbb016=c.mba016, b.mbb017=c.mba017
               where b.mbb001=c.mba001 and  b.mbb002=c.mba002 and  b.mbb003=c.mba003 " ; 
			 $this->db->query($sql2);
			 
		 //計算分類 前3碼  actmbb1   23 test 1620
		        
		    $vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			IF (substr($vmm,0,1)=='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			    $this->db->where('mbb1001', $vyy);
			    $this->db->where('mbb1002', $vmm);
		       $this->db->delete('actmbb1'); 
			 
		 //     $vyy=substr($this->input->post('ta034c'),0,4);
		//	$vmm=substr($this->input->post('ta034c'),5,2);
		    if (substr($vmm,0,1)=='0')  {
		       $sql3 = " INSERT INTO  actmbb1 (mbb1001,mbb1002,mbb1003,mbb1004,mbb1005,mbb1016,mbb1017) 
			SELECT $vyy,concat('0',$mmm),ma001,ma003,ma008,0,0 FROM actma where length(ma001) <='3'   "; }
			else {
			    $sql3 = " INSERT INTO  actmbb1 (mbb1001,mbb1002,mbb1003,mbb1004,mbb1005,mbb1016,mbb1017) 
			SELECT $vyy,concat('',$mmm),ma001,ma003,ma008,0,0 FROM actma where length(ma001) <='3'   "; } 
			
		     $this->db->query($sql3);
			 
		 //計算分類 update 前3碼  金額 actmbb1  1040622 
		      $vmbb016=0;$vmbb017=0;
		      $vyy=substr($this->input->post('ta034c'),0,4);
			 $vmm=substr($this->input->post('ta034c'),5,2);
			 IF (substr($vmm,0,1)=='0') {$mmm='0'.$vmm;} else {$mmm=$vmm;}
			    $this->db->where('mbb2001', $vyy);
			    $this->db->where('mbb2002', $vmm);
		        $this->db->delete('actmbb2'); 
			 // 3碼 
			 $sql21=" SELECT mbb001,mbb002,concat( substring( mbb003, 1, 2 ) , '0' ) AS mbb003, sum( mbb016) AS mbb016, sum( mbb017) AS mbb017
                    FROM `actmbb`  WHERE mbb001 = '$vyy'  AND mbb002 = '$vmm' 
					GROUP BY mbb001,mbb002,concat( substring( mbb003, 1, 2 ) , '0' )
                    HAVING sum( mbb016 ) >0 OR sum( mbb017 ) >0  ORDER BY mbb001,mbb002,concat( substring( mbb003, 1, 2 ) , '0' )  ";
					
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
                    HAVING sum( mbb016 ) >0 OR sum( mbb017 ) >0  ORDER BY mbb001,mbb002,substring( mbb003, 1, 2 )  ";
					
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
		 // 1碼
		  $sql23=" SELECT mbb001,mbb002,substring( mbb003, 1, 1 ) AS mbb003, sum( mbb016) AS mbb016, sum( mbb017) AS mbb017
                    FROM `actmbb`  WHERE mbb001 = '$vyy'  AND mbb002 = '$vmm' 
					GROUP BY mbb001,mbb002,substring( mbb003, 1, 1 )
                    HAVING sum( mbb016 ) >0 OR sum( mbb017 ) >0  ORDER BY mbb001,mbb002,substring( mbb003, 1, 1 )  ";
					
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
               where a.mbb2001=b.mbb1001 and a.mbb2002=b.mbb1002 and a.mbb2003=b.mbb1003 
                ) c
               set b.mbb1016=c.mbb2016, b.mbb1017=c.mbb2017
               where b.mbb1001=c.mbb2001 and  b.mbb1002=c.mbb2002 and  b.mbb1003=c.mbb2003 " ; 
			 $this->db->query($sql24);
			 
          //找相同品號update  前3碼 test 1200 actmbb  損益表 完成
		$sql25 =" update actmbb b,(select b.mbb001,b.mbb002,b.mbb003,b.mbb016,b.mbb017,a.mbb2001,a.mbb2002,
               a.mbb2003 ,a.mbb2016,a.mbb2017
               from actmbb2 a, actmbb b
               where a.mbb2001=b.mbb001 and a.mbb2002=b.mbb002 and a.mbb2003=b.mbb003 
                ) c
               set b.mbb016=c.mbb2016, b.mbb017=c.mbb2017
               where b.mbb001=c.mbb2001 and  b.mbb002=c.mbb2002 and  b.mbb003=c.mbb2003 " ; 
			 $this->db->query($sql25);	
		//損益表 1040624-1	 
			 //營業毛利 5999
		  
		  $query211 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  ");         
		foreach ($query211->result() as $row)
            {
			 $mbb2001a[]=$row->mbb2001;
			 $mbb2002a[]=$row->mbb2002;
            $mbb2016a[]=$row->mbb2016;
            $mbb2017a[]=$row->mbb2017;			
            }
			$mbb2001a=$mbb2001a[0];
			$mbb2002a=$mbb2002a[0];
			
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
			     
//    加入資產負債表		加本期損益


		
			
			//資產負債表 1040624-2	 
			 //資產總額 1999
		  
		  $query311 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '1 '  ");         
		foreach ($query311->result() as $row)
            {
			 $mbb2001e[]=$row->mbb2001;
			 $mbb2002e[]=$row->mbb2002;
            $mbb2016e[]=$row->mbb2016;
            $mbb2017e[]=$row->mbb2017;			
            }
			$mbb2001e=$mbb2001e[0];
			$mbb2002e=$mbb2002e[0];
			
			 if(isset($mbb2016e[0])) {
			$mbb2016e=$mbb2016e[0];
			$mbb2017e=$mbb2017e[0];}
			 else 
			{ $mbb2016e=0;
			  $mbb2017e=0;}
			
			
		 $query312 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '2 '  ");         
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
		  WHERE  substring(mbb2003,1,2) = '3 '  ");         
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
			$mbb2017z=$mbb2016g;    
			
			$mbb2016r=$mbb2016f+$mbb2016g;
			$mbb2017r=$mbb2017f+$mbb2016g;
			
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
			
		 //資產總額 1999 actmbb  更新合計 1040701
		 
		/*   $query9921 = $this->db->query("SELECT sum( mbc1006 ) AS mbc1006 FROM `actmbc1` WHERE length( mbc1003 )=4 and mbc1001='$vyy' and mbc1002='$vmm' ");         
			  foreach ($query9921->result() as $row)
            {
            $mbc1006[]=$row->mbc1006;		
            }			 
			$vmbc1006=$mbc1006[0];
			
			 $data992 = array(
				 'mbc006' => $vmbc1006
                );	
			$this->db->where('mbc001', $vyy);
			$this->db->where('mbc002', $vmm);
			$this->db->where('mbc003', '1999');
			$this->db->update('actmbc', $data992);  */
		 
		  return true;	 
	 }
	 //計算 資產負債表報表檔 actmbc  開始0624 
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
				     'mbc1005' => $mbb017[$i],
					 'ida' => $i
					 );
					 
				$this->db->where('mbc1001', $vyy);
			    $this->db->where('mbc1002', $vmm);	
				$this->db->where('mbc1003', $mbb003[$i]);	
				$this->db->insert('actmbc1',$data411a);
                   
		       $i++;
			  }
		   
	/*		if ($vmma>='10')  {
			 $sql411 = "INSERT INTO actmbc1 (mbc1001,mbc1002,mbc1003,mbc1004,mbc1005,mbc1006) 
			SELECT concat($vyy,$vmma),$vmma,mbb003,mbb004,0,mbb017 FROM actmbb WHERE  mbb003>= '1' and mbb003<= '1999' "; 
		}
			else {
			 $sql411 = " INSERT INTO  actmbc1 (mbc1001,mbc1002,mbc1003,mbc1004,mbc1005,mbc1006) 
			SELECT concat($vyy,'0',$vmma),$vmma,mbb003,mbb004,0,mbb017 FROM actmbb WHERE  mbb003>= '1' and mbb003<= '1999' "; }  */
		//	concat('0',$vmm )
		  //   $this->db->query($sql411);
		//負債	
			$this->db->where('mbc2001', $vyy);
			$this->db->where('mbc2002', $vmm);
			$this->db->delete('actmbc2');      //刪除負債	
			
			 //insert into 基本資料  actmbc1  1040701  add 負債
			
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
					 
				$this->db->where('mbc2001', $vyy);
			    $this->db->where('mbc2002', $vmm);	
				$this->db->where('mbc2003', $mbb003b[$i]);	
				$this->db->insert('actmbc2',$data412z);
                   
		       $i++;
			  }
			//insert into 基本資料
		/*	if (substr($vmm,0,1)=='0')  {
			 $sql412 = " INSERT INTO  actmbc2 (mbc2001,mbc2002,mbc2003,mbc2004,mbc2005,mbc2006) 
			SELECT $vyy,$vmm,mbb003,mbb004,0,mbb017 FROM actmbb WHERE mbb003>= '2' and mbb003<='3999' "; 
			}
			else {
			 $sql412 = " INSERT INTO  actmbc2 (mbc2001,mbc2002,mbc2003,mbc2004,mbc2005,mbc2006) 
			SELECT $vyy,$vmm ),mbb003,mbb004,0,mbb017 FROM actmbb WHERE mbb003>= '2' and mbb003<='3999'  "; }
			
		     $this->db->query($sql412);  */ 
		
	
		 //計算合併 actmc  1750
	       	  $query413 = $this->db->query("SELECT count(*) as mc1 from actmbc1 ");         
		  foreach ($query413->result() as $row)
            {
            $mc1[]=$row->mc1;		
            }			 
			$mc1=$mc1[0];
			
			$query414 = $this->db->query("SELECT count(*) as mc2 from actmbc2 ");   
         
			
		  foreach ($query414->result() as $row)
            {
            $mc2[]=$row->mc2;		
            }			 
			$mc2=$mc2[0];
			
			if ($mc1>=$mc2) {
				 $sql415 = " INSERT INTO  actmbc (mbc001,mbc002,mbc003,mbc004,mbc005,mbc006,mbc007,mbc008,mbc009,mbc010) 
			     SELECT mbc1001,mbc1002,mbc1003,mbc1004,mbc1005,mbc1006,'','',0,0 from actmbc1 ";
			//	 $sql416 = " UPDATE actmbc set mbc007=mbc2003,mbc008=mbc2004,mbc009=mbc2005,mbc010=mbc2006 from actmbc as a ,actmbc2 as b where a.idc=b.idb "; }
				  $sql416 = " UPDATE  `actmbc` AS A,  
       (SELECT idb,mbc2003,mbc2004,mbc2005,mbc2006  FROM `actmbc2` GROUP BY `idb`) AS B  
    SET A.`mbc007`=B.`mbc2003` ,A.`mbc008`=B.`mbc2004` ,A.`mbc009`=B.`mbc2005` ,A.`mbc010`=B.`mbc2006`
    WHERE A.`idc`=B.`idb`   "; }	 
				 
			if ($mc1 < $mc2) {
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
			// $sql4121=" SELECT * from actmbc1 order by id1  ";
			 $query = $this->db->get();
	         $result = $query->result();
			// $data['result'] = $query->result();
			//  $this->load->vars($data);
			 $ii=0;
			 $i=0;
			 foreach($result as $row) { 
			     $mbc001[]=$row->mbc001; 
			     $mbc002[]=$row->mbc002; 
				 $mbc003[]=$row->mbc003; 
				 $id[]=$ii;
			     $ii = $ii + 1 ; }
				 
		      while ($i<$ii) {
				  //   $ida[i]=$ii;
				  	$data4173 = array(
				     'idc' => $i  );   //1040701 id modi idc
					 
				$this->db->where('mbc001', $mbc001[$i]);
			    $this->db->where('mbc002', $mbc002[$i]);	
				$this->db->where('mbc003', $mbc003[$i]);	
				$this->db->update('actmbc',$data4173);
                   
		       $i++;
			  }
			  
		 //判斷12  actmbc ok 1040701-19:20
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
            
			// if ($vmbc12==1) {$this->db->query($sql427c);} 
			// if ($vmbc12==2) { $this->db->query($sql428c);} 
			 $this->db->query($sql427c);
			 $this->db->query($sql428c);
		 //科目代號 3218 本期損益		         
		  
		  $query = $this->db->query("SELECT mc005   FROM actmc ");         
		foreach ($query->result() as $row)
            {
            $mc005[]=$row->mc005;		 
            }
			$vmc005=$mc005[0];     //本期損益代號
			
	      /*  $query222 = $this->db->query("SELECT sum(mba016) as mba016,sum(mba017) as mba017 from actmba where mba001='$vyy' and mba002='$vmm' and mba003>='4' and length(mba003)=4 ");		 
          foreach ($query222->result() as $row)    
			  {
            $mba017[]=$row->mba017;		 
            }
			$vmba017=$mba017[0];  */
			 $query211 = $this->db->query("SELECT mbb2001,mbb2002,mbb2003 ,mbb2016,mbb2017 FROM actmbb2 
		  WHERE  substring(mbb2003,1,2) = '4 '  ");         
		foreach ($query211->result() as $row)
            {
			 $mbb2001a[]=$row->mbb2001;
			 $mbb2002a[]=$row->mbb2002;
            $mbb2016a[]=$row->mbb2016;
            $mbb2017a[]=$row->mbb2017;			
            }
			$mbb2001a=$mbb2001a[0];
			$mbb2002a=$mbb2002a[0];
			
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
		   $this->db->query($sql2);	
          //資產總額重新計算
		    $query1999a = $this->db->query("SELECT sum(mbc1005) as mbc1005 from actmbc1 where mbc1003>='1' and mbc1003<'1999' and length(mbc1003)=4 ");         
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
			$this->db->update('actmbc',$data1999a);
			
		   
		  return true;	 
	 }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>