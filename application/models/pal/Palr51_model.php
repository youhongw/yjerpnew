<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palr51_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
			$leave_class_hr = Array(
				'tg006' => "事假",
				'tg007' => "病假",
				'tg008' => "特休",
				'tg010' => "無薪假"
			);
			$leave_class_day = Array(
				'tg009' => "喪假",
				'tg011' => "產假",
				'tg012' => "陪產假",
				'tg013' => "婚嫁",
				'tg014' => "公傷假",
				'tg016' => "公假"
			);
        }
		
	
	//印明細表	
	function printfd()          
        {
		$insert = "";
		preg_match_all('/\d/S',$this->input->post('dateo'), $matches);  //處理日期字串
		$seq3 = implode('',$matches[0]);
		if($this->input->post('type')=="A"){$insert .= "b.te002 = '$seq3' ";}
		if($this->input->post('type')=="B"){
			preg_match_all('/\d/S',$this->input->post('dateo1'), $matches);  //處理日期字串
			$dateo1 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('datec1'), $matches);  //處理日期字串
			$datec1 = implode('',$matches[0]);
			$insert .= "b.te002 >= '$dateo1' and b.te002 <= '$datec1' ";
		}
		if($this->input->post('type')=="C"){
			preg_match_all('/\d/S',$this->input->post('dateo2'), $matches);  //處理日期字串
			$dateo2 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('datec2'), $matches);  //處理日期字串
			$datec2 = implode('',$matches[0]);
			$insert .= "b.te002 >= '$dateo2' and b.te002 <= '$datec2' ";
		}
		
			//員工代號,刷卡日期,時間 palte
			
			$sql9 = " SELECT a.mv004 ,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,b.te003,b.te002, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006 
				FROM cmsmv as a
				LEFT JOIN palte as b ON a.mv001=b.te001 and ";
			$sql9 .= $insert;
			$sql9 .= "LEFT JOIN cmsme as c ON a.mv004=c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL) and a.mv026='Y'  
				ORDER BY a.mv004 asc, a.mv021 asc, b.te002 asc, b.te003 asc"; 
			/*
			$sql9 = "
				SELECT a.mv004 , c.me002, b.te001, a.mv002, a.mv027, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006, b.te003, b.te002 FROM `cmsmv` as a 
				LEFT JOIN palte as b ON b.te001 = a.mv001 and a.mv026='Y' and ";
			$sql9 .= $insert;
			$sql9 .=
				"LEFT JOIN cmsme as c ON a.mv004 = c.me001 
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL) ORDER BY a.mv004 asc, a.mv021 asc, b.te002 asc, b.te003 asc";
				*/
			//echo $sql9;exit;
			$result = mysql_query($sql9) or die_content("查詢資料失敗".mysql_error());
			$query = $this->db->query($sql9);
			$ret['rows'] = $query->result();
			
			$ret['result'] = $this->compute_status($ret['rows'],$this->input->post('type'));
		  
			$seq32 = "te002 = '$seq3' ";	
			$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
					->from('palte')
					->where($seq32);
			$num = $query->get()->result();
			
			$ret['num_rows'] = $num[0]->count;
			
			return $ret;
        }
		
		function get_leave($date){
			preg_match_all('/\d/S',$date, $matches);  //處理日期字串
			$date = implode('',$matches[0]);
			$sql = " SELECT * FROM `paltg` WHERE tg003 = '".$date."' "; 
			$query = $this->db->query($sql);
			$ret = $query->result();
			
			return $ret;
		}
		
		function get_work_class(){
			$sql = " SELECT * FROM `palmo` "; 
			$query = $this->db->query($sql);
			$ret = $query->result();
			
			return $ret;
		}
		
		function check_holiday($seq1){
			preg_match_all('/\d/S',$seq1, $matches);
			$seq1 = implode('',$matches[0]);
			$seq_1=substr($seq1,0,4);$seq_2=substr($seq1,4,4);
			$this->db->select('*');
			$this->db->from('palms');
			$this->db->where('ms001', $seq_1);
			$this->db->where('ms002', $seq_2);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
			   return true;
			}
			else{
				return false;
			}
		}
		
		function get_oneday_data($seq1){
			preg_match_all('/\d/S',$seq1, $matches);
			$seq1 = implode('',$matches[0]);
			$sql9 = " SELECT a.mv004 ,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,b.te003,b.te002, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006 
				FROM cmsmv as a
				LEFT JOIN palte as b ON a.mv001=b.te001 and b.te002 = $seq1 ";
			$sql9 .= "LEFT JOIN cmsme as c ON a.mv004=c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL) and a.mv026='Y'  
				ORDER BY a.mv004 asc, a.mv021 asc, b.te002 asc, b.te003 asc";
			//echo $sql9;exit;
			$result = mysql_query($sql9) or die_content("查詢資料失敗".mysql_error());
			$query = $this->db->query($sql9);
			$ret = $query->result();
			return $ret;
		}
		
		function compute_status($data,$type){//自動計算出缺勤狀況
			$punch_data = array();$select_date = array();
			foreach($data as $out_key=>$out_val){
				if(!@$punch_data[$out_val->te001]){//先裝員工基本資料
					$punch_data[$out_val->te001] = $out_val;
				}
				if($out_val->te003){$punch_data[$out_val->te001]->times[$out_val->te002][] = $out_val->te003;}//依照日期裝刷卡時間
				else{
					
				}
				if(strlen($out_val->te002)==8){$select_date[$out_val->te002] = $out_val->te002;}
				unset($punch_data[$out_val->te001]->te002,$punch_data[$out_val->te001]->te003);
			}
			$leave_data = array();
			$leave_class_hr = Array(
				'tg006' => "事",
				'tg007' => "病",
				'tg008' => "特",
				'tg010' => "無薪"
			);
			$leave_class_day = Array(
				'tg009' => "喪",
				'tg011' => "產",
				'tg012' => "陪產",
				'tg013' => "婚",
				'tg014' => "公傷",
				'tg016' => "公"
			);
			foreach($select_date as $day_key){
				$temp_data = $this->get_leave($day_key);
				foreach($temp_data as $key=>$val){
					foreach($val as $k=>$v){
						if($v)
							$leave_data[$day_key][$val->tg001][$k] = $v;
					}
				}
			}
			foreach($punch_data as $epy_key=>$epy_val){//$epy_key=員工編號,$epy_val=員工的所有資料,each迴圈等於一名員工
				/*無班別者套用預設值*/
				if(!@$epy_val->mv027){$epy_val->mv027=0;}if(!@$epy_val->mo002){$epy_val->mo002="無班別";}if(!@$epy_val->mo003){$epy_val->mo003="0800";}if(!@$epy_val->mo004){$epy_val->mo004="1700";}if(!@$epy_val->mo005){$epy_val->mo005="1700";}if(!@$epy_val->mo006){$epy_val->mo006="0750";}
				foreach($select_date as $day_key){//$day_key=日期,$day_val=當天刷卡時間each迴圈等於一天
					$week=date("w",mktime(0,0,0,substr($day_key,4,2),substr($day_key,6,2),substr($day_key,0,4)));//判斷平日六日假日
					$holiday = $this->check_holiday($day_key);
					if($week==6||$week==0||$holiday){
						if($this->input->post('type')=="B"){
							unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
						}
						if($this->input->post('type')=="C"){
							unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
						}
						continue;
					}
					
					/***夜班另外處理，如果別的跨日班別，可於此處加入***/
					if(@$epy_val->mv027 == "8"){
						$leave_status = "";$leave_hr = 0;
						if(@$leave_data[$day_key][$epy_key]['tg001']){
							foreach($leave_class_hr as $c_k => $c_v){
								if(@$leave_data[$day_key][$epy_key][$c_k]){
									$leave_status .= $c_v.":".$leave_data[$day_key][$epy_key][$c_k]."";
									$leave_hr+=$leave_data[$day_key][$epy_key][$c_k];
								}
							}
							foreach($leave_class_day as $c_k => $c_v){
								if(@$leave_data[$day_key][$epy_key][$c_k]){
									$leave_status .= $c_v.":".$leave_data[$day_key][$epy_key][$c_k]*8 ."";
									$leave_hr+=$leave_data[$day_key][$epy_key][$c_k]*8;
								}
							}
							$punch_data[$epy_key]->leave_hr[$day_key] = $leave_hr;
							if($leave_hr)$punch_data[$epy_key]->status[$day_key] = "<font color='blue'>".$leave_status."</font>";
						}
						//先判斷有沒有後一天
						$tomorrow = date('Ymd', strtotime("+1 day", strtotime($day_key)));
						if($tomorrow_data = $this->get_oneday_data($tomorrow)){
						//有的話開始抓後面下班時間
							$useful_time = array();
							foreach($tomorrow_data as $tomo_key => $tomo_val){
								//var_dump($tomorrow_data);exit;
								if($tomo_val<1200){
									$useful_time[] = $tomo_val;
								}
							}
							
						}else{
							if($day_key!=date("Ymd")){$error_status = "無刷下班";}
						}
						$real_time = array();
						if(is_array($epy_val->times[$day_key])){
							foreach($epy_val->times[$day_key] as $t_k => $t_v){
								if($t_v>=($epy_val->mo003-300)){
									$real_time[] = $t_v;
								}
							}
						}
						if(count($real_time)==0){
							if($yes_week==6||$yes_week==0||$yes_holiday){
								continue;
							}else{//沒有刷上班
								if(count($useful_time)==0){//也沒刷下班=根本沒有來
									$punch_data[$epy_key]->status[$day_key] = "<font color='red'>未到</font> 曠:8";
									$punch_data[$epy_key]->absenteeism_hr[$day_key] = 8;
									if($leave_hr==8){
										$punch_data[$epy_key]->status[$day_key] = "<font color='blue'>".$leave_status."</font>";
										if($this->input->post('type')=="C"){
											unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
										}
									}else if($leave_hr!=0){
										$punch_data[$epy_key]->status[$day_key] .= "<font color='blue'>".$leave_status."</font>";
									}
									
									continue;
								}
							}
						}else{
							foreach($real_time as $t_k=>$t_v){
								
							}
						}
						
						/*echo "<pre>";
						var_dump($useful_time);var_dump($real_time);
						echo "</pre>";
						exit;*/
						continue;
					}
					
					if(!@$epy_val->times[$day_key]){
						$day_val=array();$epy_val->times[$day_key] = array();
							$punch_data[$epy_key]->status[$day_key] = "<font color='red'>未到</font> 曠:8";
							$leave_status = "";$leave_hr = 0;
							$punch_data[$epy_key]->absenteeism_hr[$day_key] = 8;
							if(@$leave_data[$day_key][$epy_key]['tg001']){
								foreach($leave_class_hr as $c_k => $c_v){
									if(@$leave_data[$day_key][$epy_key][$c_k]){
										$leave_status .= $c_v.":".$leave_data[$day_key][$epy_key][$c_k]."";
										$leave_hr+=$leave_data[$day_key][$epy_key][$c_k];
									}
								}
								foreach($leave_class_day as $c_k => $c_v){
									if(@$leave_data[$day_key][$epy_key][$c_k]){
										$leave_status .= $c_v.":".$leave_data[$day_key][$epy_key][$c_k]*8 ."";
										$leave_hr+=$leave_data[$day_key][$epy_key][$c_k]*8;
									}
								}
								$punch_data[$epy_key]->leave_hr[$day_key] = $leave_hr;
								if($leave_hr)$punch_data[$epy_key]->status[$day_key] = "<font color='blue'>".$leave_status."</font>";
							}
							if($leave_hr==8){
								$punch_data[$epy_key]->status[$day_key] = "<font color='blue'>".$leave_status."</font>";
								if($this->input->post('type')=="C"){
									unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
								}
							}
							
						continue;//不用判斷了，跳脫
					}
					$day_val = $epy_val->times[$day_key];
					$year_late_status="";$late_status="";$morning_status="";$afternoon_status="";$error_status="";
					$status = "";$daily[$day_key] = array();//初始化狀態(新的一天新的開始)
					/*依照時間區間裝資料*/
					foreach($day_val as $k => $v){//$k=順序,$v等於刷卡時間each迴圈等於一筆刷卡
						if($k>0&&(substr($v,0,2)*60+substr($v,2,2)-substr($day_val[$k-1],0,2)*60-substr($day_val[$k-1],2,2))<5) continue;//相隔不到5分鐘不存
						if($k==0){$first_time = $v;} if($k==count($day_val)-1){$end_time = $v;}
						if($v<=($epy_val->mo003+5))			{$daily[$day_key]['before'][]=$v;}//比遲到時間還早的就是before
						if($v>($epy_val->mo003+5)&&$v<1200)	{$daily[$day_key]['morning'][]=$v;}
						if($v>=1200&&$v<=1300)				{$daily[$day_key]['noon'][]=$v;}
						if($v>1300&&$v<$epy_val->mo004)		{$daily[$day_key]['afternoon'][]=$v;}
						if($v>$epy_val->mo004)				{$daily[$day_key]['after'][]=$v;}
					}
					/***
					$daily[$day_key]['before']上班前$daily[$day_key]['after']上班後
					$daily[$day_key]['morning']早$daily[$day_key]['noon']中$daily[$day_key]['afternoon']晚
					***/
					/*開始判斷出缺勤狀況*/
					//先從最簡單的開始
					//接下來判斷最單純的資料
					if(@$daily[$day_key]['before']&&@$daily[$day_key]['after']&&!@$daily[$day_key]['morning']&&!@$daily[$day_key]['noon']&&!@$daily[$day_key]['afternoon']){
						//$punch_data[$epy_key]->status[$day_key] = "正常上班";
						if(@end($daily[$day_key]['before'])>$epy_val->mo006)
							$year_late_status = "<font color='orange'>年遲到".$epy_val->mv027."</font>";
						//$punch_data[$epy_key]->temp = $daily;
						//continue;//不用判斷了，跳脫
					}
					if(count($day_val)==1){//只有刷一筆耶
						if($day_key == date("Ymd")){//原來是今天匯的，饒了你
							if(!@$daily[$day_key]['before']){//但是你遲到了!
							}else if($day_val[0]>$epy_val->mo006&&$day_val[0]<=$epy_val->mo003){
								$year_late_status = "<font color='orange'>年遲到".$epy_val->mv027."</font>";
							}else if(end($daily[$day_key]['before'])>$epy_val->mo003){
								$late_status = "<font color='orange'>遲到</font>";
							}
							//$punch_data[$epy_key]->temp = $daily;
							//continue;//不用判斷了，跳脫
						}
						if($day_val[0]>=1300){
							$error_status = "<font color='red'>缺刷上班</font>";
							//$punch_data[$epy_key]->temp = $daily;
							//continue;//不用判斷了，跳脫
						}
						else if($day_val[0]<1300){
							if($day_key != date("Ymd")){
								$error_status = "<font color='red'>缺刷下班</font>";
							}
							//$punch_data[$epy_key]->temp = $daily;
							//continue;//不用判斷了，跳脫
						}
					}
					//接下來才開始做判斷遲到曠職
					$morning_single = 0;
					if(@$daily[$day_key]['before']){
						if(end($daily[$day_key]['before'])>$epy_val->mo006&&end($daily[$day_key]['before'])<=$epy_val->mo003){
							$year_late_status = " <font color='orange'>年遲到".$epy_val->mv027."</font> ";
						}else if(end($daily[$day_key]['before'])>$epy_val->mo003){
							$late_status = " <font color='orange'>遲到</font> ";
						}
						if(@$daily[$day_key]['morning']){//難道又跑出去了?
							$t_outtime = $daily[$day_key]['morning'][0];//從這時間開始算曠職
							if(count($daily[$day_key]['morning'])==1){
								$t_out_hr = substr($t_outtime,0,2);$t_out_mn = substr($t_outtime,2,2);
								if($t_out_mn<30){$t_out_mn=00;}if($t_out_mn>30){$t_out_mn=30;}
								$t_out_tmn=$t_out_hr*60+$t_out_mn;
								$morning_Absenteeism = (720-$t_out_tmn)/60;
								$morning_single = 1;
								if(count($daily[$day_key]['before'])%2==0){
									$t_late_hr = substr($epy_val->mo003,0,2);$t_late_mn = substr($epy_val->mo003,2,2);
									$t_late_tmn=$t_late_hr*60+$t_late_mn;
									$t_out_hr = substr($t_outtime,0,2);$t_out_mn = substr($t_outtime,2,2);
									if($t_out_mn<30){$t_out_mn=30;}if($t_out_mn>30){$t_out_mn=00;$t_out_hr++;}
									$t_out_tmn=$t_out_hr*60+$t_out_mn;
									$morning_Absenteeism = ($t_out_tmn-$t_late_tmn)/60;
									$morning_single = 0;
								}
							}else{
								$morning_Absenteeism = 0;
								foreach($daily[$day_key]['morning'] as $t_k => $t_v){
									if($t_k%2==0){
										$t_hr = substr($t_v,0,2);$t_mn = substr($t_v,2,2);
										if($t_mn<30&&$t_mn>0){$t_mn=00;}if($t_mn>30){$t_mn=30;}
										$t_tmn=$t_hr*60+$t_mn;
										if(@$daily[$day_key]['morning'][$t_k+1]){
											$t_b_time = $daily[$day_key]['morning'][$t_k+1];
											$t_b_hr = substr($t_b_time,0,2);$t_b_mn = substr($t_b_time,2,2);
											if($t_b_mn<30&&$t_b_mn>0){$t_b_mn=30;}if($t_b_mn>30){$t_b_mn=00;$t_b_hr++;}
											$t_b_tmn=$t_b_hr*60+$t_b_mn;
											$morning_Absenteeism += ($t_b_tmn-$t_tmn)/60;
										}else{
											$morning_Absenteeism += (720-$t_tmn)/60;
											$morning_single = 1;
										}
									}
								}
							}
						}
						
					}else{
						//既然遲到了，就要算一下曠了多少小時(早上)
						if(@$daily[$day_key]['morning']){
							$m_1st_hr = substr($daily[$day_key]['morning'][0],0,2);$m_1st_mn = substr($daily[$day_key]['morning'][0],2,2);
							if($m_1st_mn<30&&$m_1st_mn>0){$m_1st_mn=30;}if($m_1st_mn>30){$m_1st_mn=00;$m_1st_hr++;}
							$m_1st_tmn=$m_1st_hr*60+$m_1st_mn;
							$late_hr = substr($epy_val->mo003,0,2);$late_mn = substr($epy_val->mo003,2,2);
							$late_tmn = $late_hr*60+$late_mn;
							$morning_Absenteeism = ($m_1st_tmn-$late_tmn)/60;
							if($m_1st_tmn == end($daily[$day_key]['morning'])){//OK，沒有再亂跑了
							}else{//又...跑掉了
								foreach($daily[$day_key]['morning'] as $t_k => $t_v){
									if($t_k%2==1&&$t_k>0){
										$t_hr = substr($t_v,0,2);$t_mn = substr($t_v,2,2);
										if($t_mn<30&&$t_mn>0){$t_mn=00;}if($t_mn>30){$t_mn=30;}
										$t_tmn=$t_hr*60+$t_mn;
										if(@$daily[$day_key]['morning'][$t_k+1]){
											$t_b_time = $daily[$day_key]['morning'][$t_k+1];
											$t_b_hr = substr($t_b_time,0,2);$t_b_mn = substr($t_b_time,2,2);
											if($t_b_mn<30&&$t_b_mn>0){$t_b_mn=30;}if($t_b_mn>30){$t_b_mn=00;$t_b_hr++;}
											$t_b_tmn=$t_b_hr*60+$t_b_mn;
											$morning_Absenteeism += ($t_b_tmn-$t_tmn)/60;
										}else{
											$morning_Absenteeism += (720-$t_tmn)/60;
											$morning_single = 1;
										}
									}
								}
							}
						}else{
							$morning_Absenteeism += 4;//都沒來就不用說了
						}
					}
					//早上判斷完畢裝一下狀態
					if(@$morning_Absenteeism>0){$morning_status .= " 早上曠:".$morning_Absenteeism." ";}
					//接下來是中午
					$noon_notbak = 0;
					if(@$daily[$day_key]['noon']){
						if(@$morning_single==1){
							if(count($daily[$day_key]['noon'])%2==0){//這樣等於還沒回來呀
								$noon_notbak = 1;
							}
						}else{
							if(count($daily[$day_key]['noon'])%2==1){//這樣等於還沒回來呀
								$noon_notbak = 1;
							}
						}
					}
					//下午
					$afternoon_Absenteeism = 0;
					if($noon_notbak==1&&@$daily[$day_key]['afternoon']){
						$t_v = $daily[$day_key]['afternoon'][0];
						$t_hr = substr($t_v,0,2);$t_mn = substr($t_v,2,2);
						if($t_mn<30&&$t_mn>0){$t_mn=30;}if($t_mn>30){$t_mn=00;$t_hr++;}
						$t_tmn=$t_hr*60+$t_mn;
						$afternoon_Absenteeism += ($t_tmn-780)/60;
						if(count($daily[$day_key]['afternoon'])>1){
							foreach($daily[$day_key]['afternoon'] as $t_k => $t_v){
								if($t_k%2==1&&$t_k>0){
									$t_hr = substr($t_v,0,2);$t_mn = substr($t_v,2,2);
									if($t_mn<30&&$t_mn>0){$t_mn=00;}if($t_mn>30){$t_mn=30;}
									$t_tmn=$t_hr*60+$t_mn;
									if(@$daily[$day_key]['afternoon'][$t_k+1]){
										$t_b_time = $daily[$day_key]['afternoon'][$t_k+1];
										$t_b_hr = substr($t_b_time,0,2);$t_b_mn = substr($t_b_time,2,2);
										if($t_b_mn<30&&$t_b_mn>0){$t_b_mn=30;}if($t_b_mn>30){$t_b_mn=00;$t_b_hr++;}
										$t_b_tmn=$t_b_hr*60+$t_b_mn;
										$afternoon_Absenteeism += ($t_b_tmn-$t_tmn)/60;
									}else{
										$afternoon_Absenteeism += (substr($epy_val->mo004,0,2)*60-$t_tmn)/60;
										$afternoon_single = 1;
									}
								}
							}
						}
					}else if($noon_notbak==0&&@$daily[$day_key]['afternoon']){
						foreach($daily[$day_key]['afternoon'] as $t_k => $t_v){
							if($t_k%2==0){
								$t_hr = substr($t_v,0,2);$t_mn = substr($t_v,2,2);
								if($t_mn<30&&$t_mn>0){$t_mn=00;}if($t_mn>30){$t_mn=30;}
								$t_tmn=$t_hr*60+$t_mn;
								if(@$daily[$day_key]['afternoon'][$t_k+1]){
									$t_b_time = $daily[$day_key]['afternoon'][$t_k+1];
									$t_b_hr = substr($t_b_time,0,2);$t_b_mn = substr($t_b_time,2,2);
									if($t_b_mn<30&&$t_b_mn>0){$t_b_mn=30;}if($t_b_mn>30){$t_b_mn=00;$t_b_hr++;}
									$t_b_tmn=$t_b_hr*60+$t_b_mn;
									$afternoon_Absenteeism += ($t_b_tmn-$t_tmn)/60;
								}else{
									$afternoon_Absenteeism += (substr($epy_val->mo004,0,2)*60-$t_tmn)/60;
									$afternoon_single = 1;
								}
							}
						}
					}else if($noon_notbak==1&&!@$daily[$day_key]['afternoon']&&!@$daily[$day_key]['after']){
						$afternoon_Absenteeism += 4;
					}else if($noon_notbak==0&&!@$daily[$day_key]['before']&&!@$daily[$day_key]['morning']&&!@$daily[$day_key]['afternoon']&&!@$daily[$day_key]['after']){
						$afternoon_Absenteeism += 4;
					}
					
					if(!@$daily[$day_key]['before']&&!@$daily[$day_key]['morning']&&!@$daily[$day_key]['noon']&&!@$daily[$day_key]['afternoon']&&@$daily[$day_key]['after']){
						$error_status = "<font color='red'>缺刷上班</font>";$afternoon_Absenteeism = 4;
						
					}
					if(@$afternoon_Absenteeism>0){$afternoon_status .= " 下午曠:".$afternoon_Absenteeism." ";}
					$total_Absenteeism = @$morning_Absenteeism + $afternoon_Absenteeism;
					$leave_status = "";$leave_hr = 0;
					if(@$leave_data[$day_key][$epy_key]['tg001']){
						foreach($leave_class_hr as $c_k => $c_v){
							if(@$leave_data[$day_key][$epy_key][$c_k]){
								$leave_status .= $c_v.":".$leave_data[$day_key][$epy_key][$c_k]."";
								$leave_hr+=$leave_data[$day_key][$epy_key][$c_k];
							}
						}
						foreach($leave_class_day as $c_k => $c_v){
							if(@$leave_data[$day_key][$epy_key][$c_k]){
								$leave_status .= $c_v.":".$leave_data[$day_key][$epy_key][$c_k]*8 ."";
								$leave_hr+=$leave_data[$day_key][$epy_key][$c_k]*8;
							}
						}
					}
					
					if($leave_hr-$total_Absenteeism>=0 && $total_Absenteeism!=0){
						$morning_status="";$afternoon_status="";$year_late_status="";$late_status="";
					}
					$punch_data[$epy_key]->status[$day_key] = $year_late_status.$late_status.$morning_status.$afternoon_status;
					if($leave_status){$punch_data[$epy_key]->status[$day_key] .= "<font color='blue'>".$leave_status."</font>";}
					if(@$error_status){$punch_data[$epy_key]->status[$day_key]=$error_status." "."<font color='blue'>".$leave_status."</font>";}
					$punch_data[$epy_key]->leave_hr[$day_key] = $leave_hr;
					$punch_data[$epy_key]->absenteeism_hr[$day_key] = $total_Absenteeism;
					
					$morning_Absenteeism=0;$afternoon_Absenteeism = 0;
					if($this->input->post('type')=="B"){
						if(!@$morning_status&&!@$afternoon_status&&!@$leave_status){
							unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
						}
					}
					if($this->input->post('type')=="C"){
						/*if((((!@$year_late_status&&!@$late_status)||($punch_data[$epy_key]->leave_hr[$day_key]-$punch_data[$epy_key]->absenteeism_hr[$day_key]<=0.5&&$punch_data[$epy_key]->leave_hr[$day_key]-$punch_data[$epy_key]->absenteeism_hr[$day_key]>=0)))&&!@$error_status){
							unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
						}*/
						if(!@$year_late_status&&!@$late_status&&!@$error_status&&$punch_data[$epy_key]->leave_hr[$day_key]-$punch_data[$epy_key]->absenteeism_hr[$day_key]>=0){
							unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
						}else{
							if((@$year_late_status||@$late_status)&&$punch_data[$epy_key]->leave_hr[$day_key]-$punch_data[$epy_key]->absenteeism_hr[$day_key]>=0.5){
								unset($punch_data[$epy_key]->times[$day_key]);unset($punch_data[$epy_key]->status[$day_key]);unset($punch_data[$epy_key]->leave_hr[$day_key]);unset($punch_data[$epy_key]->absenteeism_hr[$day_key]);
							}
						}
					}
				}
				
			}
			$punch_data['select_date'] = $select_date;
			//echo "<pre>";var_dump($punch_data);exit;
			return $punch_data;
		}
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>