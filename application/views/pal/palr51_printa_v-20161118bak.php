<?php 
//echo "<pre>";var_dump($results);exit;
$rows = array();								//依照員工分裝資料
global $leave_rows;$leave_rows = array();
global $work_class_rows;$work_class_rows = array();
foreach($results as $key => $val){
	$rows[$val->te003disp][] = $val;
}
foreach($leave as $key => $val){
	$leave_rows[$val->tg001][] = $val;
}
foreach($work_class as $key => $val){
	$work_class_rows[$val->mo001] = $val;
}
//echo "<pre>";var_dump($leave_rows);exit;
//以下分裝為頁
$page_data = array();
$pages = 0;
foreach($rows as $key => $val){					//each 員工
	$temp_time=array();$true_time=array();		//裝每個員工時間
	foreach($val as $k => $v){					//each 時間te006
		if($k!=0 && $k%40 == 0){				//滿24筆換頁
			$pages++;
		}
		$temp_time[] = $v->te006disp;
	}
	if(count($temp_time)>7){								//如果時間數量過多，則處理冗贅時間
		$true_time[0] = $temp_time[0];$i = 0;
		foreach($temp_time as $t_k => $t_v){
			$this_time = substr($true_time[$i],0,2)*60+substr($true_time[$i],2,2);
			$next_time = substr($t_v,0,2)*60+substr($t_v,2,2);
			if(abs($next_time - $this_time) > 2){
				$true_time[] = $t_v;$i++;
			}
		}
	}else{
		$true_time = $temp_time;
	}//處理時間完成
	$temp_data = array();
	$temp_data = $val[0];
	$temp_data->time = $true_time;
	$page_data[$pages][] = $temp_data;
}$pages++;
//echo "<pre>";var_dump($pages);exit;

preg_match_all('/\d/S',$dateo, $matches);  //處理日期字串
$dateo = implode('',$matches[0]);
?>
<style>
.thead td{
	font-size:12px;
	border:0px solid;
	border-top:2px solid;
	border-bottom:2px solid;
}
.list td{
	border:0px solid;
	border-bottom:1px solid;
	padding : 0px 0px 0px 0px;
}
</style>
<?php
	for($i=0;$i<$pages;$i++){
?>
	<table class="store">
	    <tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
	    </tr>
		<tr>
			<td align="left" width="33%"><font size="1">刷卡日期:&nbsp;<?php echo substr($dateo,0,4)."/".substr($dateo,4,2)."/".substr($dateo,6,2);?></font></td>
			<td align="center" width="33%">出　勤　日　報　表</td>
			<td align="right" width="33%"><font size="1">頁次:&nbsp;<?php echo $i+1 .'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></font></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center" valign="top">部門代號</td>
		<td width="8%" align="center" valign="top">部門名稱</td>
	    <td width="8%" align="center" valign="top">員工代號</td>
	    <td width="10%" align="center" valign="top">員工姓名</td>
		<td width="8%" align="center" valign="top">班　別</td>
		<td width="45%" align="left" valign="top">刷卡時間</td>
	    <td width="15%" align="center" valign="top">狀　　態</td>
      </tr>
	</table>
    <table class="list">
<?php	
	foreach($page_data[$i] as $key => $val){
?>
	  <tr><!-- 表身 物料 -->
	    <td width="8%" align="center" valign="top"><?php echo $val->te001disp?></td>
		<td width="8%" align="center" valign="top"><?php echo $val->te002disp?></td>
	    <td width="8%" align="center" valign="top"><?php echo $val->te003disp?></td>
	    <td width="10%" align="center" valign="top"><?php echo $val->te004disp?></td>
		<td width="8%" align="left" valign="top"><?php if(@$val->te005disp){echo $val->te005disp.":".$work_class_rows[$val->te005disp]->mo002;}else{echo "無班別";}?></td>
		<td width="45%" align="left" valign="top"><font size="1">
		<?php foreach($val->time as $k=>$v){if($k<7)echo $v." ";if($k==6)echo "資料過多";}?>
		</font></td>
	    <td width="15%" align="left" valign="top">
		<?php 
			echo check_state($val);
		?>
		</td>
      </tr>
<?php 
	}
?>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
<?php
//以下出缺勤狀況判別
function check_state($data){
	global $leave_rows;global $work_class_rows;$show_str = "";
/***請假別設定***/
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
/***請假別***/
	$late_time="0800";if(@$work_class_rows[$data->te005disp]->mo003) {$late_time=$work_class_rows[$data->te005disp]->mo003;}
	$year_late_time="0800";if(@$work_class_rows[$data->te005disp]->mo006) {$year_late_time=$work_class_rows[$data->te005disp]->mo006;}
	$brake_time="1700";if(@$work_class_rows[$data->te005disp]->mo004) {$brake_time=$work_class_rows[$data->te005disp]->mo004;}
	$owe_hr = 0;$leave_hr = 0;$owe_str="";$leave_str="";
	if($data->time[0]=="") {
		$owe_hr = 8;
		$owe_str .= " 未到 曠職:8HR";
	}else{
		$status="in";$first_time = $data->time[0];$last_time = $data->time[count($data->time)-1];
		
		/***以下判斷上班(抓第一筆)***/
		if($first_time>$brake_time){return "<font color='red'>上班異常</font>";}
		if($data->time[0]>$year_late_time/* && $data->time[0]<=$late_time*/) {
			if($data->time[0]<=$late_time){
				$owe_str .= " 年遲到".$data->te005disp." ";
			}else if($data->time[0]<=($late_time+5)){
				$owe_str .= " 遲到 ";
			}
			else{
				$t_time = $late_time;$t_ylate_time = $year_late_time;
				$hr = substr($t_time,0,2);$mn = substr($t_time,2,2);
				$yl_hr = substr($t_ylate_time,0,2);$yl_mn = substr($t_ylate_time,2,2);
				$t_hr = $hr - $yl_hr;$t_mn = $mn - $yl_mn;
				$total_ylmn = $t_hr*60 + $t_mn;
				$t_hr = floor($total_ylmn/30);$t_mn = $total_ylmn%30;if($t_mn<30&&$t_mn>0){$t_hr++;}if($hr>12){$t_hr=$t_hr-2;}
				$yl_hr = $t_hr/2;
				$owe_str .= " 年遲到".$data->te005disp." ";//":".$yl_hr."HR ";
				//$owe_hr+=$yl_hr;
			}
		}
		if($first_time>($late_time+5)) {
		if($first_time<1200){
			$t_time = $first_time;$t_late_time = $late_time;}
		else if($first_time<=1300){
			$t_time = 1200;$t_late_time = $late_time;}
		else if($first_time>1300){
			$t_time = $first_time;$t_late_time = Intval($late_time)+100;}
		
			$hr = substr($t_time,0,2);$mn = substr($t_time,2,2);
			$l_hr = substr($t_late_time,0,2);$l_mn = substr($t_late_time,2,2);
			$t_hr = $hr - $l_hr;$t_mn = $mn - $l_mn;
			$total_lmn = $t_hr*60 + $t_mn;
			$t_hr = floor($total_lmn/30);$t_mn = $total_lmn%30;if($t_mn<30&&$t_mn>0){$t_hr++;}
			$l_hr = $t_hr/2;
			$owe_str .= " 曠職".":".$l_hr."HR ";
			$owe_hr+=$l_hr;
		}
		/***以下判斷中離(取中間)***/
		$morning = array();$noon = array();$afternoon = array();
		foreach($data->time as $mid_key => $mid_val){
			if($mid_key==0||$mid_key==(count($data->time)-1)){continue;}//只抓中間的時間
			if($mid_val<=$late_time || $mid_val>=$brake_time){
				continue;//若此時間不在正常上下班時間的中間則略過
			}
			//開始處理並初始化參數
			$mid_hr = Intval(substr($mid_val,0,2));$mid_mn = substr($mid_val,2,2);$mid_tmn=$mid_hr*60+$mid_mn;
			$pre_time = $data->time[$mid_key-1];
			$pre_hr = substr($pre_time,0,2);$pre_mn = substr($pre_time,2,2);$pre_tmn=$pre_hr*60+$pre_mn;
			if($mid_tmn-$pre_tmn<10){
				continue;//十分鐘內重複的資料不處理(寬容處理)
			}
			//上午的事情
			if($mid_hr<12){
				$morning[] = $mid_val;
			}
			//午休的事情
			if($mid_hr==12 || $mid_hr==13){
				$noon[] = $mid_val;
			}
			//下午的事情
			if($mid_hr>13 && $mid_hr<$brake_time){
				$afternoon[] = $mid_val;
			}
		}
		//處理上午
		if(count($morning)%2!=0 && count($noon)<1 && count($afternoon)<1){
			$owe_str .=" <font color='red'>上午異常</font> ";//無法整除代表正在外出，如果上午出去到中午下午都沒回來就是異常
		}
		if(count($morning)>1){
			$morning_hr = 0;
			foreach($morning as $t_key => $t_val){
				if(!@$morning[$t_key+1]){break;}
				if($morning%2==0){continue;}//如果是偶數項則跳過
				$t_hr = Intval(substr($t_val,0,2));$t_mn = substr($t_val,2,2);//計算一進一出曠職時數
				if($t_mn>0 && $t_mn<30){$t_mn=00;}if($t_mn>30){$t_mn=30;$t_hr++;}$t_tmn=$t_hr*60+$t_mn;
				$t2_val = $morning[$t_key+1];
				$t2_hr = Intval(substr($t2_val,0,2));$t2_mn = substr($t2_val,2,2);
				if($t_mn>0 && $t_mn<30){$t_mn=30;}if($t_mn>30){$t_mn=00;$t_hr++;}$t2_tmn=$t2_hr*60+$t2_mn;
				$morning_hr += ($t2_tmn - $t_tmn)/60;
			}
			$owe_str .=" 上午曠職:".$morning_hr."小時";
		}
		//處理中午、下午
		$afternoon_hr = 0;
		if(count($noon)%2!=0 && count($afternoon)<1){
			$owe_str .=" <font color='red'>中午異常</font> ";//無法整除代表正在外出，如果中午出去到下午都沒回來就是異常
		}
		if(count($noon)%2!=0 && count($afternoon)>0){
			$t_hr = Intval(substr($noon[count($noon)-1],0,2));$t_mn = substr($noon[count($noon)-1],2,2);//計算一進一出曠職時數
			if($t_mn>0 && $t_mn<30){$t_mn=00;}if($t_mn>30){$t_mn=30;$t_hr++;}$t_tmn=$t_hr*60+$t_mn;
			$t2_val = $afternoon[0];
			$t2_hr = Intval(substr($t2_val,0,2));$t2_mn = substr($t2_val,2,2);
			if($t_mn>0 && $t_mn<30){$t_mn=30;}if($t_mn>30){$t_mn=00;$t_hr++;}$t2_tmn=$t2_hr*60+$t2_mn;
			$afternoon_hr += ($t2_tmn - $t_tmn)/60;
			unset($afternoon[0]);
		}
		if(count($afternoon)>1){//如果中午沒有回來，第一筆下午就是回來
			foreach($afternoon as $t_key => $t_val){
				if(!@$afternoon[$t_key+1]){break;}
				if($afternoon%2==0){continue;}//如果是偶數項則跳過
				$t_hr = Intval(substr($t_val,0,2));$t_mn = substr($t_val,2,2);//計算一進一出曠職時數
				if($t_mn>0 && $t_mn<30){$t_mn=00;}if($t_mn>30){$t_mn=30;$t_hr++;}$t_tmn=$t_hr*60+$t_mn;
				$t2_val = $afternoon[$t_key+1];
				$t2_hr = Intval(substr($t2_val,0,2));$t2_mn = substr($t2_val,2,2);
				if($t_mn>0 && $t_mn<30){$t_mn=30;}if($t_mn>30){$t_mn=00;$t_hr++;}$t2_tmn=$t2_hr*60+$t2_mn;
				$afternoon_hr += ($t2_tmn - $t_tmn)/60;
			}
			$owe_str .=" 下午曠職:".$afternoon_hr."小時";
		}
		
		
		/*if($data->te003disp == "85001"){
			var_dump($morning);
			exit;
		}*/
		
		/***以下判斷下班(抓最後一筆)***/
		if($data->time[count($data->time)-1]<$brake_time && count($data->time)>1) {
			$t_time = $data->time[count($data->time)-1];$t_brake_time = $brake_time;if(substr($t_time,0,2)<8){$t_time=$late_time;}
			$hr = substr($t_time,0,2);$mn = substr($t_time,2,2);
			$b_hr = substr($t_brake_time,0,2);$l_mn = substr($t_brake_time,2,2);
			$t_hr = $b_hr - $hr;$t_mn = $l_mn - $mn;
			$total_bmn = $t_hr*60 + $t_mn;
			$t_hr = floor($total_bmn/30);$t_mn = $total_bmn%30;if($t_mn<30&&$t_mn>0){$t_hr++;}if($hr<13){$t_hr=$t_hr-2;}
			$b_hr = $t_hr/2;
			$owe_str .= " 早退:".$b_hr."HR ";
			$owe_hr+=$b_hr;
		}
	}
	/***以下判斷請假***/
	if(@$leave_rows[$data->te003disp][0]){
		foreach($leave_class_hr as $key => $val){
			if($leave_rows[$data->te003disp][0]->$key)
				$leave_str .= $val.$leave_rows[$data->te003disp][0]->$key."小時";
			$leave_hr += $leave_rows[$data->te003disp][0]->$key;
		}
		foreach($leave_class_day as $key => $val){
			if($leave_rows[$data->te003disp][0]->$key)
				$leave_str .= $val.($leave_rows[$data->te003disp][0]->$key*8)."小時";
			$leave_hr += $leave_rows[$data->te003disp][0]->$key*8;
		}
		if($leave_str == ""){
			$leave_str .= "請假資料異常";
		}
		if($leave_hr == $owe_hr){$owe_str = "";}
		else if($leave_hr > $owe_hr){$leave_str .= " 多請".$leave_hr-$owe_hr."小時";}
		else if($leave_hr < $owe_hr){$leave_str .= " 少請".$owe_hr-$leave_hr."小時";}
	}
	$show_str = $owe_str.$leave_str;
	
	return $show_str;
}
?>



