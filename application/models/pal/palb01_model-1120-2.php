<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 發薪  
	function batchaf()           
        {
			$vyymm1=substr($this->input->post('dateyymm'),0,4).substr($this->input->post('dateyymm'),5,2);
			$vyymm=$this->input->post('dateyymm');
			
		//計算年月>關帳年月 判斷
             $query = $this->db->query("SELECT ma022   FROM cmsma  
		  WHERE 1  ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;		 
            }
			$vma022=$ma022[0];		
			if ($vma022 >= $vyymm1 ) { return "計算日期要大於關帳日期.";}
		//刪除計算當月薪資檔 PALTD
		   $this->db->where('td005', $vyymm1);
		   $this->db->delete('paltd'); 
		
		//新增月發薪 PALTD
		  $sql2 = "INSERT INTO  paltd (td001,td002,td003,td004,td005,td050,td051,td052,td053,td054) 
		           select tc001,mv002,mv004,me002,$vyymm1,mv009,mv021,mv022,mv206,mv019 from paltc as a
		           LEFT JOIN cmsmv as b ON tc001=mv001 and mv022='' or substr(mv022,0,6)='$vyymm1'
				   LEFT JOIN cmsme as c ON tc002=me001 WHERE  tc003='$vyymm1' "; 
		  $this->db->query($sql2);
			
		  //計算先合併檔案一筆一筆計算	cmsmv 人事palmd 固定palta 變動, 勞健保palml, paltc 月出勤,借支paltb	 

		$sql="select a.*,b.*,c.*,d.*,e.*,f.me002,g.tb004 from paltc as a  LEFT JOIN palmd as b ON tc001=md001
		                                  LEFT JOIN palta as c ON tc001=ta001 and ta003='$vyymm1'
		                                  LEFT JOIN palml as d ON tc001=ml001 
                                          LEFT JOIN cmsmv as e ON tc001=mv001 
                                          LEFT JOIN cmsme as f ON tc001=me001 
                                          LEFT JOIN paltb as g ON tc001=tb001 and tb003='$vyymm1'
                                          WHERE tc003='$vyymm1'										  
											  ";
		  
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//計算每月天數
				$vmm=substr($this->input->post('dateyymm'),5,2);
				if ( ($vmm=='04') || ($vmm=='06') || ($vmm=='09') || ($vmm=='11'))  {
                        $vdd=30;
                     } elseif ($vmm=='02' ) {
                        $vdd=28;
                      } else {
                       $vdd=31;
                   }
			    //計算外勞 到職 天數 未滿 183天所得稅扣 0.18 18%, 183天以上0.06 6% 稅率
				
					 $sdate=substr($mv021,0,4).'-'.substr($mv021,4,2).'-'.substr($mv021,6,2);
					 $edate=substr($vyymm1,0,4).'-'.substr($vyymm1,4,2).'-'.'30';
				  $startdate=strtotime($sdate);
				  $enddate=strtotime($edate); 
				  $days=round(($enddate-$startdate)/3600/24);
				 // return $days;
				  $vtax=0;
				  if ( substr($mv009,1,1)>'9' && $days < 183 )  { $vtax = 0.18;}
				  if (substr($mv009,1,1)>'9' && $days >= 183)  { $vtax = 0.06;}
				 //伙食費計算  當月到職離職破月自行輸入扣款, 破月伙食費
				 $vf00d=0;
                if ($mv201=='1') {$vfood=880;} else {$vf00d=0;}	
				  if ($ta011>0) {$vfood=$ta011;}
                //計算上班天數 workday  當月到職離職 天數
                  $workday=30-(($tc006/8)+($tc007/8)+($tc008/8)+($tc009)+($tc010/8)+($tc011)+($tc012)+($tc013)+($tc014)+($tc015)+($tc016));
                  if (substr($mv021,0,6)==$vyymm1) { $workday=30-substr($mv021,6,2);$workday=$workday+round($workday/7);}				  
				  if (substr($mv022,0,6)==$vyymm1) { $workday=30-substr($mv022,6,2);$workday=$workday+round($workday/7);}	
				  //扣假
				   if (substr($mv021,0,6)==$vyymm1) { $tc006=(30-$workday)*8;}
                   if (substr($mv022,0,6)==$vyymm1) { $tc006=(30-$workday)*8;}					   
				  //時底薪, 時全薪, 加班使用
				    $hhamt=round($md004/30/8,0);
					$hhamt1=round($md013/30/8,0);
				  //扣全勤奬金 =4小時 500, 8小時 02  allworkamt
                    $hh=$tc006+round($tc007/2,0);
					if ( ($hh>4) && ($hh<8) && ($md008>0) ) { $allworkamt= 500;}				  
					if ( ($hh>=8) && ($md008>0) ) { $allworkamt= 0;}
                  //請假扣款 曠職扣款damt1 ,事,病,無薪
				    $damt1=round($hhamt1*($tc015*3*8),0);
					$damt2=round($hhamt1*$tc006,0);
					$damt3=round($hhamt1*($tc007/2),0);
                    $damt4=round($hhamt*$tc010,0);	
                    $damt=$damt1+$damt2+$damt3+$damt4;
				  //固定津貼請假扣款  vtd008. md004..12
					$vtd008=round(round($md004/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)+$tc010),0);
					$vtd009=round(round($md005/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd010=round(round($md006/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd011=round(round($md007/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd012=round(round($md008/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd013=round(round($md009/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd014=round(round($md010/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$vtd015=round(round($md011/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
				    $vtd016=round(round($md012/30/8,0)*(($tc015*3*8)+$tc006+($tc007/2)),0);
					$damt=$vtd008+$vtd009+$vtd010+$vtd011+$vtd012+$vtd013+$vtd014+$vtd015+$vtd016;
				 //加班費
				    $vtc017=round($hhamt1*$tc017*1.33,0);
					$vtc018=round($hhamt1*$tc018*1.66,0);
					$vtc019=round($hhamt1*$tc019,0);
					$vtc020=round($hhamt1*$tc020*1.33,0);
					$vtc021=round($hhamt1*$tc021,0);
					$vtc022=round($hhamt1*$tc022*1.33,0);
				//應稅免稅時數46 overtime
				    $overtime1=$tc017+$tc018+$tc019+$tc021;
					$overtime2=$tc017+$tc018+$tc019+$tc021+$tc020+$tc022;
					if ($overtime1>46) {$over1=46;$over2=$overtime1-46;} else {$over1=$overtime1;$over2=0;}
					$over2=$overtime2-$over1;
					$over1amt=round($over1*$hhamt1*1.33,0);
					$over2amt=($vtc017+$vtc018+$vtc019+$vtc020+$vtc021+$vtc022)-$over1amt;
				//其他加減項
				   $vtd029=$ta006+$ta007;
				   $vtd038=$ta004+$ta005+$ta008+$ta009+$ta010+$mv203;
				//應領薪資 vtd030
				   $vtd030=$md004-$vtd008+$md005-$vtd009+$md006-$vtd010+$md007-$vtd011+$md008-$vtd012+$md009-$vtd013+$md010-$vtd014+$md011-$vtd015+$md012-$vtd016+$vtc017+$vtc018+$vtc019+$vtc020+$vtc021+$vtc022+$vtd029;
				//應稅所得 vtaxamt1=應領金額-免稅加班金額44-免稅伙食津貼49,   所得稅=vtaxamt1*稅率
				    $vtaxamt1=$vtd030-$over1amt-$md007;
					$vtd037=round($vtaxamt1*$vtax,0);
				   if ($mv039>0) {$vtd037=$mv039;}				  
				//個人代扣保費
				    if ($mv200 == 1) {$vtd035=round($vtaxamt1*0.02,0);} else {$vtd035=0;}
				//實領金額 vtd039 
				    $vtd039=$vtd030-$tb004-$ml003-$ml004-$vf00d-$vtd037-$vtd038;
				//轉帳金額
				   if ($mv034 == 1) {$vtd041=$vtd039;$vtd040=0;} else {$vtd040=$vtd039;$vtd041=0;}
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
				 'td008' => $md004-$vtd008,
				 'td009' => $md005-$vtd009,
				 'td010' => $md006-$vtd010,
				 'td011' => $md007-$vtd011,
				 'td012' => $md008-$vtd012,
				 'td013' => $md009-$vtd013,
				 'td014' => $md010-$vtd014,
				 'td015' => $md011-$vtd015,
				 'td016' => $md012-$vtd016,
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
				 'td036' => $vf00d,
				 'td037' => $vtd037,
				 'td038' => $vtd038,
				 'td039' => $vtd039,
				 'td040' => $vtd040,
				 'td041' => $vtd041,
				 'td042' => $ta012,
				 'td043' => $over1,
				 'td044' => $over1amt,
				 'td045' => $over2,
				 'td046' => $over2amt,
				 'td048' => $ml007,
				 'td049' => $md007
               				  
                );	
		 
               $this->db->where('td001', $mv001);     
		       $this->db->where('td005', $vyymm1);
			   $this->db->update('paltd', $data1);	
	
	}  
			//計算切傳票
			//刪除計算當月切傳票 PALTV
		   $this->db->where('tv003', $vyymm1);
		   $this->db->delete('paltv'); 
		
		//新增切傳票 PALTV
		  $sql299 = "INSERT INTO  paltv (company,tv001,tv002,tv003,tv004,tv005,tv006,tv007,tv008,tv009,tv010,tv011,tv012,tv013,tv014,tv015) 
		           select '001',mv206,mv205,$vyymm1,IFNULL(mj002,'') as mv205disp,sum(td030),sum(td031),sum(td033),sum(td034),sum(td035),sum(td036),sum(td037),sum(td038),sum(td039),sum(td040),sum(td041) from paltd as a
		           LEFT JOIN cmsmv as b ON td001=mv001 
				   LEFT JOIN palmj as c ON mv205=mj001 group by '001',mv206,mv205,'$vyymm1',mj002 "; 
		  $this->db->query($sql299);
			
	         return  "轉入完成";  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>