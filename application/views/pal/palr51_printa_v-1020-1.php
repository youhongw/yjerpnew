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

?>
<style>
.thead td{
	font-size:3px;
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
			<td align="left" width="33%"><font size="1">刷卡日期:&nbsp;<?php echo $dateo;?></font></td>
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
	    <td width="8%" align="center" valign="top">員工姓名</td>
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
	    <td width="8%" align="center" valign="top"><?php echo $val->te004disp?></td>
		<td width="8%" align="left" valign="top"><?php echo $val->te005disp.":".$work_class_rows[$val->te005disp]->mo002?></td>
		<td width="45%" align="left" valign="top"><font size="1">
		<?php foreach($val->time as $k=>$v){if($k<8)echo $v." ";if($k==7)echo "資料過多";}?>
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
	if(@$leave_rows[$data->te003disp][0]){
		foreach($leave_class_hr as $key => $val){
			if($leave_rows[$data->te003disp][0]->$key)
				$show_str .= $val.$leave_rows[$data->te003disp][0]->$key."小時";
		}
		foreach($leave_class_day as $key => $val){
			if($leave_rows[$data->te003disp][0]->$key)
				$show_str .= $val.$leave_rows[$data->te003disp][0]->$key."天";
		}
		if($show_str == ""){
			$show_str .= "請假資料異常";
		}
	}
	if($show_str == ""){
		if($data->time[0]=="") return " 曠職 ";
		if($data->time[0]>$work_class_rows[$data->te005disp]->mo003) $show_str .= " 遲到 ";
		if($data->time[0]>$work_class_rows[$data->te005disp]->mo006 && $data->time[0]<=$work_class_rows[$data->te005disp]->mo003) $show_str .= " 年遲到".$data->te005disp." ";
		
		if($data->time[count($data->time)-1]<$work_class_rows[$data->te005disp]->mo004) $show_str .= " 早退 ";
	}
	
	return $show_str;
}
?>



