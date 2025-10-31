<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bomb07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  invi14 invte1 盤點儲位輸入檔
	
//計算 產生盤點表 invtc  
    //查新增資料是否輸入訂單訂號 
    function selone1($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tc001', $seg1);
		   $this->db->where('tc003', $seg2);
		    $this->db->where('tc004', $seg3);
	      $query = $this->db->get('invtc');
	      return $query->num_rows() ;
	    }  				
	function batchaf($td001c,$td001cn,$td002c,$td0021c,$td003c,$td004c,$td005c,$td006c,$td007c,$td008c,$td009c)           
        {
			$user = $this->session->userdata('sysuser');
			
					  
			$array = explode("\n", trim($td001cn)); 			
			$arr = explode("\n", trim($td002c));  
			$cnt = count($array);
			$MB001 = TRIM($array[0]);
			$sql_chk = "SELECT COUNT(*) AS NUM FROM INVMB WHERE MB001 = '$MB001'";
			$query_chk = $this->db->query($sql_chk);
			$num = $query_chk->result();
			$NUM1 = $num[0] -> NUM; //輸入的品號是否存在*/
			$td004_d = substr($td004c,0,4)-1911 .substr($td004c,5,2);
			$td004_1 = substr($td004c,0,4).substr($td004c,5,2).substr($td004c,8,2);
			

			
			
			$sql = "
			SELECT CASE  WHEN MAX(TA002) IS NULL THEN '$td004_d' + '001' ELSE MAX(TA002)+ 1 END AS TA002

		    FROM PURTA WHERE TA001 = '$td003c' AND CREATE_DATE > '20210101' AND TA002 LIKE '$td004_d%'";
			
			$query = $this->db->query($sql);
			$tb002 = $query->result();
			$TB002_N = $tb002[0] -> TA002; //取出最大單號+1
			
			

			
			$sql1 = "INSERT INTO PURTA (COMPANY,CREATOR,USR_GROUP,CREATE_DATE,MODIFIER,MODI_DATE,FLAG,TA001,TA002,TA003,TA004,TA005,TA006,TA007,TA008,TA009,TA010,TA011,TA012,TA013,TA014,TA015,TA016)
			VALUES ('DER SHENG','$user','A100',convert(varchar, getdate(), 112),'','','1','$td003c','$TB002_N','$td004_1','$td007c','','','N','0','4','DS','0','$user','$td004_1','','0','N') 
			";
			
			$query1 = $this->db->query($sql1);
			
			
			$sql5 ="TRUNCATE TABLE bommd_pur_tmp";
			$query5 = $this->db->query($sql5);
			
			for ( $i=0 ; $i<$cnt;$i++ ) {
			$MC001 = TRIM($array[$i]);
			$sql3 = "EXEC PRO_BOMMD_PUR @MC001 = '$MC001' , @TD008 = '$td008c',@TD009 = '$td009c'";
			$query3 = $this->db->query($sql3);
			
			$sql4 ="INSERT INTO bommd_pur_tmp(MD003,MD006,NODE)  SELECT DISTINCT MD003,SUM(MD006*$arr[$i]),NODE FROM bommd_pur,INVMB WHERE MD003 = MB001 AND DP <> '0' AND MB025 IN ('P','S')  GROUP BY MD003,NODE ORDER BY NODE";
			$query4 = $this->db->query($sql4);
			
			}

			//exit;
						
			$sql2 = "INSERT INTO PURTB (COMPANY,CREATOR,USR_GROUP,CREATE_DATE,MODIFIER,MODI_DATE,FLAG,TB001,TB002,TB003,TB004,TB005,TB006,TB007,TB008,TB009,TB010,TB011,TB012,TB013,TB014,TB015,TB016,TB017,TB018,TB019,TB020,TB021,TB022,TB023,TB024,TB025,TB026,TB027,TB028,TB029,TB030,TB031,TB032,TB033,TB034,TB035,TB036,TB037,TB038,TB039)
			SELECT  'DER SHENG','$user','A100',convert(varchar, getdate(), 112),'','','1','$td003c','$TB002_N',right('0000' + convert(varchar(4),bommd_pur_tmp.id), 4),A.MD003,MB002,MB003,MB004,MB017,A.MD006,'','$td004_1','','',A.MD006,MB004,'',0,0,'','N','N','','','','N','','','','','','','N','',0,0,'','','','N' 
			FROM (SELECT  MD003 , SUM(MD006) AS MD006 FROM bommd_pur_tmp GROUP BY MD003) A,bommd_pur_tmp,INVMB 
			WHERE A.MD003 = bommd_pur_tmp.MD003 AND A.MD003 = MB001  AND MB025 IN ('P','S')  
			";
			
			$query2 = $this->db->query($sql2);
				

			
			$sql6 ="DELETE PURTB WHERE TB001 = '$td003c' AND TB002 = '$TB002_N' AND TB003 NOT IN (Select min(right('0000' + convert(varchar(4),bommd_pur_tmp.id), 4)) From bommd_pur_tmp Group By MD003)";
			$query6 = $this->db->query($sql6);
			
			
			$sql7 ="UPDATE PURTA SET TA011 = (SELECT SUM(TB009) FROM PURTB WHERE TB001 = '$td003c' AND TB002 = '$TB002_N') WHERE TA001 = '$td003c' AND TA002 = '$TB002_N'";
			$query7 = $this->db->query($sql7);
	
	
			
			
			if($NUM1 == 0 ) {
			  return "0";
			}else{
			  return $TB002_N;
			}	

		
		
			/*
			$vtd001=$this->input->post('td001c');
			$vtd002=substr($this->input->post('td004c'),0,4).substr($this->input->post('td004c'),5,2).substr(rtrim($this->input->post('td004c')),8,2);
		    $vtd003=$this->input->post('cmsq03a');    //庫別
			$vtd004=$this->input->post('invq02a');
			$vtd005=$this->input->post('invq02a1');
		  //盤點表 底稿編號, 盤點日期, 盤點庫別   invtc
         /*   $this->db->where('tc001', $vtd001);   //盤點底稿編號
			$this->db->where('tc009', $vtd002);     //日期
			$this->db->where('tc004', $vtd003);     //庫別
			$this->db->where('tc003 >=', $vtd004);  //起品號
			$this->db->where('tc003 <=', $vtd005);　//迄品號
		    $this->db->delete('invtc');  */		  
		  
          //
		    //刪除 庫存檔 invmc
				/*	 $this->db->where('mc002', $vtd003);     //庫別
			         $this->db->where('mc001 >=', $vtd004);  //起品號
			         $this->db->where('mc001 <=', $vtd005);　//迄品號
		             $this->db->delete('invmc');  */
			//$sqlk = " delete from invmc  where mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005'  ";
            //$this->db->query($sqlk); 
					 
			//$sql = " INSERT INTO  invmc (company,creator,usr_group,create_date,modifier,modi_date,flag,mc001,mc002,mc003,mc007)
			          //  SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,a.mb001,b.mc001,a.mb004,0  from invmb as a,cmsmc as b where b.mc001='$vtd003' and b.mc001>='$vtd004' and b.mc001<='$vtd005'  ";
           // $this->db->query($sql); 
		  //庫存歸零 invmc  原庫存量金額日期
		   // $sqla = " update invmc set mc011='$vtd002', mc200=mc007, mc201=mc008 where mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005'  "; 
		  //  $query = $this->db->query($sqla);	
		  //庫存歸零 invmc
		  // $sqlb = " update invmc set mc007=0, mc008=0 where mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005'  "; 
		  //  $query = $this->db->query($sqlb);	
		    //共用參數盤點日期轉入		1050615	
		//	$sql0 = " UPDATE  cmsma set ma204=$vtd002  WHERE 1=1 ";
         //   $this->db->query($sql0); 

			
		  
         /*   $sql1=" select mb001,mb004,mc002 from invmb a,invmc b
            where mb001=mc001 and mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005' "; */
			
		/*	   $sql1=" select mb001,mb004 from invmb a
            where  mb001>='$vtd004' and mb001<='$vtd005' "; 
            
			$vnum='10001';
             $result = mysql_query($sql1) or die_content("查詢資料失敗".mysql_error());
          while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			
            $data1 = array(
				 'tc001' => $vtd001,
				 'tc002' => $vnum,
				 'tc003' => $mb001,
				 'tc004' => $vtd003,
				 'tc009' => $vtd002
                );	
			
			   $exist = $this->bomb07_model->selone1($vtd001,$mb001,$vtd003);
	      if ($exist)
	         {
		      return 'exist';
		     } 
            			
			 $this->db->insert('invtc', $data1);
			 $mnum = (int) $vnum+1;
			 $vnum =  (string)$mnum;
		 }	
		  
		  //儲位轉入
		  $sql2 = " UPDATE  invtc AS A,  
         (select te1004,tc005,tc001,tc003,tc004,tc009 from invtc as a, invte1 as b where tc001=te1001 and tc003=te1005 and tc004=te1003  ) AS B  
    SET A.`tc005`=B.`te1004` 
    WHERE A.`tc001`=B.`tc001` and  A.`tc003`=B.`tc003` and A.`tc004`=B.`tc004`   and A.`tc009`=B.`tc009` "; 	
		$query = $this->db->query($sql2);
			
	         return true;  */
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>