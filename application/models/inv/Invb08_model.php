<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invb08_model extends CI_Model {
	
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
		$query141 = $this->db->query("SELECT ma204   FROM cmsma ");         
		foreach ($query141->result() as $row)
            {
            $ma204[]=$row->ma204;		 
            }
			$vma204=$ma204[0];     //盤點日期代號	
			
		  
		   // 入庫進貨 purth 品號,庫別, 單位, 數量, 金額,單價mc014 Y 確認碼 th030='Y' 單據日期tg014
		     $sql11 = " UPDATE  `invmc` AS A,  
       (SELECT th004,th009,th008,IFNULL(sum(th016),0) as th016, IFNULL(sum(th047),0) as th047  FROM `purtg` as c, `purth` as d WHERE tg001=th001 and tg002=th002 and tg014>='$vma204'
	       and th016>0   GROUP BY th004,th009,th008 ) AS B  
    SET A.`mc007`=B.`th016` ,A.`mc008`=B.`th047`,A.`mc014`=B.`th047`/B.`th016` 
    WHERE A.`mc001`=B.`th004` and A.`mc002`=B.`th009`  and A.`mc003`=B.`th008` "; 
	    $this->db->query($sql11); 
		 // 退庫退貨 purtj  tj020='Y'
		     $sql21 = " UPDATE  `invmc` AS A,  
       (SELECT tj004,tj011,tj007,IFNULL(sum(tj009),0) as tj009, IFNULL(sum(tj010),0) as tj010  FROM `purti` as c, `purtj` as d WHERE ti001=tj001 and ti002=tj002 and ti014>='$vma204'
	       and tj009>0   GROUP BY tj004,tj011,tj007 ) AS B  
    SET A.`mc007`=A.`mc007`-B.`tj009` ,A.`mc008`=A.`mc008`-B.`tj010` 
    WHERE A.`mc001`=B.`tj004` and A.`mc002`=B.`tj011`  and A.`mc003`=B.`tj007` "; 
	    $this->db->query($sql21); 
		
		//盤點INVTC  品號TC003,庫別TC004,數量 TC008 , 盤點日
		  $sqla1 = " UPDATE  `invmc` AS A,  
       (SELECT tc003,tc004,IFNULL((tc008),0) as tc008   FROM `invtc` as c  WHERE tc009>='$vma204'  
	        ) AS B  
    SET A.`mc007`=A.`mc007`+B.`tc008` WHERE A.`mc001`=B.`tc003` and A.`mc002`=B.`tc004`  ";
		    $this->db->query($sqla1); 
		
	
		   //銷貨 copth 品號,庫別, 單位, 數量, x金額 th020='Y'
		     $sql31 = " UPDATE  `invmc` AS A,  
       (SELECT th004,th007,th009,IFNULL(sum(th008),0) as th008, IFNULL(sum(th013),0) as th013  FROM `coptg` as c, `copth` as d WHERE tg001=th001 and tg002=th002 and tg042>='$vma204'
	       and th008>0  GROUP BY th004,th007,th009 ) AS B  
    SET A.`mc007`=A.`mc007`-B.`th008` WHERE A.`mc001`=B.`th004` and A.`mc002`=B.`th007` and A.`mc003`=B.`th009`  ";
		    $this->db->query($sql31); 
			
		 //銷退 coptj 品號,庫別, 單位, 數量, x金額 tj021='Y'
		     $sql32 = " UPDATE  `invmc` AS A,  
       (SELECT tj004,tj013,tj008,IFNULL(sum(tj007),0) as tj007, IFNULL(sum(tj012),0) as tj012  FROM `copti` as c, `coptj` as d WHERE ti001=tj001 and ti002=tj002 and ti034>='$vma204'
	       and tj007>0  GROUP BY tj004,tj013,tj008 ) AS B  
    SET A.`mc007`=A.`mc007`+B.`tj007`  
    WHERE A.`mc001`=B.`tj004` and A.`mc002`=B.`tj013` and A.`mc003`=B.`tj008`  ";
		    $this->db->query($sql32); 
			
		 //轉撥單   轉出庫 - invtb 品號,庫別, 單位, 數量 tb018='Y'
		     $sql41 = " UPDATE  `invmc` AS A,  
       (SELECT tb004,tb012,tb008,IFNULL(sum(tb007),0) as tb007, IFNULL(sum(tb011),0) as tb011  FROM `invta` as c, `invtb` as d WHERE ta001=tb001 and ta002=tb002 and ta014>='$vma204'
	       and tb007>0  GROUP BY tb004,tb012,tb008 ) AS B  
    SET A.`mc007`=A.`mc007`-B.`tb007` 
    WHERE A.`mc001`=B.`tb004` and A.`mc002`=B.`tb012` and A.`mc003`=B.`tb008`  ";
		    $this->db->query($sql41); 	
		//轉撥單   轉入庫 + invtb 品號,庫別, 單位, 數量 tb018='Y'
		     $sql42 = " UPDATE  `invmc` AS A,  
       (SELECT tb004,tb013,tb008,IFNULL(sum(tb007),0) as tb007, IFNULL(sum(tb011),0) as tb011  FROM `invta` as c, `invtb` as d WHERE ta001=tb001 and ta002=tb002 and ta014>='$vma204'
	       and tb007>0  GROUP BY tb004,tb013,tb008 ) AS B  
    SET A.`mc007`=A.`mc007`+B.`tb007` 
    WHERE A.`mc001`=B.`tb004` and A.`mc002`=B.`tb013` and A.`mc003`=B.`tb008`  ";
		    $this->db->query($sql42);
			
		//組合單   轉入庫 + bomtd 品號,庫別, 單位, 數量 td012='Y'  1040926 1023 檔頭
		     $sql43 = " UPDATE  `invmc` AS A,  
       (SELECT td004,td010,td005,IFNULL(sum(td007),0) as td007   FROM `bomtd` as c  WHERE   td014>='$vma204' and
	        td007>0  GROUP BY td004,td010,td005 ) AS B  
    SET A.`mc007`=A.`mc007`+B.`td007` 
    WHERE A.`mc001`=B.`td004` and A.`mc002`=B.`td010` and A.`mc003`=B.`td005`  ";
		    $this->db->query($sql43); 
			
		//組合單   轉出庫 + bomte 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sql44 = " UPDATE  `invmc` AS A,  
       (SELECT te004,te007,te005,IFNULL(sum(te008),0) as te008   FROM `bomtd` as c, `bomte` as d WHERE td001=te001 and td002=te002 and  td014>='$vma204'
	       and te008>0  GROUP BY te004,te007,te005 ) AS B  
    SET A.`mc007`=A.`mc007`-B.`te008` 
    WHERE A.`mc001`=B.`te004` and A.`mc002`=B.`te007` and A.`mc003`=B.`te005`  ";
		    $this->db->query($sql44);  	
			
			
	 //換算單位 invmd
		   // 入庫進貨 purth 品號,庫別, 單位, 數量, 金額,單價mc014 Y 確認碼,換算單位 數量th030=y
		     $sqla1 = " UPDATE  `invmc` AS A,  
       (SELECT th004,th009,th008,IFNULL(sum(th016),0) as th016, IFNULL(sum(th047),0) as th047, IFNULL(sum(md003),0) as md003  FROM `invmd` as c, `purth` as d, `purtg` as e  
	              WHERE md001=th004 and md002=th008 and tg001=th001 and tg002=th002 and  tg014>='$vma204'
	       and th016>0   GROUP BY th004,th009,th008 ) AS B  
    SET A.`mc007`=A.`mc007`+(B.`th016`*B.`md003`) ,A.`mc008`=A.`mc008`+B.`th047`,A.`mc014`=B.`th047`/(B.`th016`*B.`md003`) 
    WHERE A.`mc001`=B.`th004` and A.`mc002`=B.`th009`  and A.`mc003`!=B.`th008` "; 
	    $this->db->query($sqla1); 	

      // 退庫退貨 purtj  tj020=y
		     $sqlb1 = " UPDATE  `invmc` AS A,  
       (SELECT tj004,tj011,tj007,IFNULL(sum(tj009),0) as tj009, IFNULL(sum(tj010),0) as tj010, IFNULL(sum(md003),0) as md003  FROM `invmd` as c, `purtj` as d, `purti` as e 
	   WHERE md001=tj004 and md002=tj007 and ti001=tj001 and ti002=tj002 and ti014>='$vma204'
	       and tj009>0   GROUP BY tj004,tj011,tj007 ) AS B  
    SET A.`mc007`=A.`mc007`-(B.`tj009`*B.`md003`) ,A.`mc008`=A.`mc008`-B.`tj010` 
    WHERE A.`mc001`=B.`tj004` and A.`mc002`=B.`tj011`  and A.`mc003`!=B.`tj007` "; 
	    $this->db->query($sqlb1); 

        //銷貨 copth 品號,庫別, 單位, 數量, x金額th020=y
		     $sqlc1 = " UPDATE  `invmc` AS A,  
       (SELECT th004,th007,th009,IFNULL(sum(th008),0) as th008, IFNULL(sum(th013),0) as th013, IFNULL(sum(md003),0) as md003  FROM `invmd` as c, `copth` as d, `coptg` as e
	   WHERE md001=th004 and md002=th009 and tg001=th001 and tg002=th002 and tg042>='$vma204'
	       and th008>0  GROUP BY th004,th007,th009 ) AS B  
    SET A.`mc007`=A.`mc007`-(B.`th008`*B.`md003`) 
    WHERE A.`mc001`=B.`th004` and A.`mc002`=B.`th007` and A.`mc003`!=B.`th009`  ";
		    $this->db->query($sqlc1); 	

         //銷退 coptj 品號,庫別, 單位, 數量, x金額 tj021=y
		     $sql32 = " UPDATE  `invmc` AS A,  
       (SELECT tj004,tj013,tj008,IFNULL(sum(tj007),0) as tj007, IFNULL(sum(tj012),0) as tj012, IFNULL(sum(md003),0) as md003  FROM `invmd` as c, `coptj` as d, `copti` as e 
	   WHERE md001=tj004 and md002=tj008 and ti001=tj001 and ti002=tj002 and ti034>='$vma204'
	       and tj007>0  GROUP BY tj004,tj013,tj008 ) AS B  
    SET A.`mc007`=A.`mc007`+(B.`tj007`*B.`md003`)  
    WHERE A.`mc001`=B.`tj004` and A.`mc002`=B.`tj013` and A.`mc003`!=B.`tj008`  ";
		    $this->db->query($sql32); 	

			
		/* 換算單位 invmd  品號,1 單位2, 數量3 
		$sqlz1 = " UPDATE  `invmc` AS A,  
       (SELECT md001,md002,IFNULL((md003),1) as md003  FROM `invmd` as c, `invmb` as d WHERE md001=mb001  
	        ) AS B  
    SET A.`mc007`=A.`mc007`*B.`md003`  
    WHERE A.`mc001`=B.`md004`   ";
		    $this->db->query($sqlz1); */
			
		 //invmc 統計檔 庫存單價x數量=金額 
			 $sqlz2 = " UPDATE  `invmc`  SET `mc008`=`mc007`*`mc014`  ";
			 $this->db->query($sqlz2); 
			 
	     //invmc 統計檔 庫存數量 = 0 刪除 
			  //  $this->db->where('mc007', 0);
		      //   $this->db->delete('invmc'); 
				 
		// invmb  品號主檔update  數量 64,65 		
		$sqlz3 = " UPDATE  `invmb` AS A,  
       (SELECT mc001,IFNULL((mc007),0) as mc007,IFNULL((mc008),0) as mc008  FROM `invmc` as c WHERE mc007!=0  
	        ) AS B  
    SET A.`mb064`=B.`mc007` , A.`mb065`=B.`mc008` 
    WHERE A.`mb001`=B.`mc001`   ";
		    $this->db->query($sqlz3); 		 
		// invmb  品號主檔update  數量 57  成本64,65   1050617		
	/*	$sqlz4 = " UPDATE  `invmb`         
    SET mb057=mb065/mb064 
    WHERE mb064 > 0   ";
		    $this->db->query($sqlz4); 	*/
        //組合單 成本,金額
		//組合單   轉出庫 + bomte 品號,庫別, 單位, 數量 te010='Y'  1040926
		    $sqlz5 = " UPDATE  `bomte` AS A,  
       (SELECT c.te004,c.te008,d.mc007,d.mc001,d.mc014 FROM bomte as c,invmc as d where c.te004=d.mc001  ) AS B  
    SET A.`te200`=B.`mc014`,A.`te201`=B.`mc014`*B.`te008` 
    WHERE A.`te004`=B.`mc001`   ";
		    $this->db->query($sqlz5);  
		
		//組合單   轉入庫 + bomtd 品號,庫別, 單位, 數量 td012='Y'  1040926 1023 檔頭
		     $sqlz6 = " UPDATE  `bomtd` AS A,  
       (SELECT te001,te002,sum(te008) as te008, sum(te201) as te201 FROM bomte GROUP BY te001,te002 ) AS B  
    SET A.`td200`=B.`te201`/A.`td007`,A.`td201`=B.`te201` 
    WHERE A.`td001`=B.`te001` and A.`td002`=B.`te002`   ";
		    $this->db->query($sqlz6); 
		//組合單   invmc bomtd 轉入單價
		     $sqlz7 = " UPDATE  `invmc` AS A,  
       (SELECT td004,td007,td200 FROM bomtd  ) AS B  
    SET A.`mc014`=B.`td200` 
    WHERE A.`mc001`=B.`td004` and A.`mc014`= 0 ";
		    $this->db->query($sqlz7); 	
	   //重新計算成本		
		//invmc 統計檔 庫存單價x數量=金額 
			 $sqlz12 = " UPDATE  `invmc`  SET `mc008`=`mc007`*`mc014`  ";
			 $this->db->query($sqlz12); 
			 
	     //invmc 統計檔 庫存數量 = 0 刪除 1050617
			 //   $this->db->where('mc007', 0);
		     //    $this->db->delete('invmc'); 
				 
		// invmb  品號主檔update  數量 64,65 		
		$sqlz13 = " UPDATE  `invmb` AS A,  
       (SELECT mc001,IFNULL((mc007),0) as mc007,IFNULL((mc008),0) as mc008  FROM `invmc` as c WHERE mc007!=0  
	        ) AS B  
    SET A.`mb064`=B.`mc007` , A.`mb065`=B.`mc008` 
    WHERE A.`mb001`=B.`mc001`   ";
		    $this->db->query($sqlz13); 		 
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