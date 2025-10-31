<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actr20_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	
	
	//印試算表	
	function printfd()          
        {
			//先計算餘額檔actmb
			$this->batchaf();
			
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
				 //期初金額 上月累計(00-到上月) 1071228
				  $sqlupd1=" update  actmba as a, 
				  (select mb001,mb002,sum(mb004) as vmb004,sum(mb005) as vmb005 from actmb 
				  where  mb002='$yyy' and mb003<='$mmm' group by mb001,mb002 ) as c 
                  set a.mba026=c.vmb004, a.mba027=c.vmb005 				  
				  where a.mba001='$vyy' and a.mba002='$vmm' and a.mba003=c.mb001 ";
                 $this->db->query($sqlupd1);
				// return true;
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
				 
		//顯示資料
		if ($mf001c=='1') {
		 $sql = " select mba001,mba002,substring(mba003,1,4) as mba003,ma003,sum(mba006) as mba006,sum(mba007) as mba007,sum(mba008) as mba008,sum(mba009) as mba009,
       sum(mba010) as mba010,sum(mba011) as mba011,sum(mba012) as mba012,sum(mba013) as mba013,sum(mba014) as mba014,sum(mba015) as mba015,
       sum(mba016) as mba016,sum(mba017) as mba017
from actmba as a,actma as b
where  mba001='$vyy' and mba002='$vmm' and substring(mba003,1,4)=ma001
group by mba001,mba002,substring(mba003,1,4),ma003
order by mba001,mba002,substring(mba003,1,4),ma003 "; 
		$query = $this->db->query($sql);}  else
		{
		 $sql = " select mba001,mba002,mba003,ma003,sum(mba006) as mba006,sum(mba007) as mba007,sum(mba008) as mba008,sum(mba009) as mba009,
       sum(mba010) as mba010,sum(mba011) as mba011,sum(mba012) as mba012,sum(mba013) as mba013,sum(mba014) as mba014,sum(mba015) as mba015,
       sum(mba016) as mba016,sum(mba017) as mba017
from actmba as a,actma as b
where  mba001='$vyy' and mba002='$vmm' and mba003=ma001
group by mba001,mba002,mba003,ma003
order by mba001,mba002,mba003,ma003 "; 
		$query = $this->db->query($sql);}	
		
		
       $ret['rows'] = $query->result();  
          $seq32 = "mba001 = '$vyy'  AND mba002 = '$vmm'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actmba')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//轉excel檔	 
	function excelnewf()  {	  
	     $vyy=substr($this->input->post('vdate'),0,4);
		 $vmm=substr($this->input->post('vdate'),5,2);
	     $sql = " SELECT substring(mba003,1,4) as mba003,ma003,sum(mba006) as mba006,sum(mba007) as mba007,sum(mba008) as mba008,sum(mba009) as mba009,
		 sum(mba010) as mba010,sum(mba011) as mba011,sum(mba014) as mba014,sum(mba015) as mba015
		 FROM actmba as a left join actma as b on substring(a.mba003,1,4)=b.ma001 
		 WHERE mba001 = '$vyy'  AND mba002 = '$vmm'  
		 group by substring(mba003,1,4),ma003 order by substring(mba003,1,4),ma003 "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
	//計算切傳票資料 會計科目各期額檔 OK
	function batchaf()           
        {
			$vyy=substr($this->input->post('vdate'),0,4);
			$vmm=substr($this->input->post('vdate'),5,2);
		  //傳票幣別及本幣無加入acttb 105.01.28
		//  $sql01 ="update acttb set tb013='NTD' WHERE tb013<>'NTD' and  substring(tb002,1,4) = '$vyy' AND SUBSTRING(tb002,5,2) = '$vmm' ";  
	    //  $this->db->query($sql01);
		  
		  $sql02 ="update acttb set tb015=tb007 where tb007!=tb015 and tb015=0  and  substring(tb002,1,4) = '$vyy' AND SUBSTRING(tb002,5,2) = '$vmm' ";   
	      $this->db->query($sql02);
		  
		          //刪除計算月份 會計科目各期額檔
			         $this->db->where('mb002', $vyy);
					 $this->db->where('mb003', $vmm);
		             $this->db->delete('actmb'); 
		  //年月科目insert 
		  $sql03 ="insert into actmb (mb001,mb002,mb003,mb008)
select distinct tb005,substring(ta003,1,4) as yy, substring(ta003,5,2) as mm,tb013
 from actta as a left join acttb as b on a.ta001=b.tb001 and a.ta002=b.tb002
where substring(ta003,1,4) ='$vyy' and  substring(ta003,5,2) ='$vmm' and tb005>'0' ";
          $this->db->query($sql03);  
		  //年月借update 科目編號tb005,借貸,年度,期別,幣別, 本幣金額,原幣金額, 筆數 ok
		  $sql04 ="update actmb as a ,
		 (select tb005,substring(ta003,1,4) as yy, substring(ta003,5,2) as mm, tb013, tb004,sum(tb015) as vtb015, 
sum(tb007) as vtb007,count(tb004) as vcount from actta as a left join acttb as b on a.ta001=b.tb001 and a.ta002=b.tb002
where substring(ta003,1,4) ='$vyy' and  substring(ta003,5,2) ='$vmm' and tb004=1
group by tb005,yy,mm,tb013,tb004) as c set a.mb009=c.vtb015,a.mb004=vtb007,a.mb006=c.vcount
where a.mb001=c.tb005 and a.mb002=c.yy and a.mb003=c.mm and a.mb008=c.tb013 ";
           $this->db->query($sql04); 
		  //年月貸update
		  $sql05 ="update actmb as a ,
		 (select tb005,substring(ta003,1,4) as yy, substring(ta003,5,2) as mm, tb013, tb004,sum(tb015) as vtb015, 
sum(tb007) as vtb007,count(tb004) as vcount from actta as a left join acttb as b on a.ta001=b.tb001 and a.ta002=b.tb002
where substring(ta003,1,4) ='$vyy' and  substring(ta003,5,2) ='$vmm' and tb004=-1
group by tb005,yy,mm,tb013,tb004) as c set a.mb010=c.vtb015,a.mb005=vtb007,a.mb007=c.vcount
where a.mb001=c.tb005 and a.mb002=c.yy and a.mb003=c.mm and a.mb008=c.tb013 ";
           $this->db->query($sql05); 
		   
		 
		  return true;	
    } 
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>