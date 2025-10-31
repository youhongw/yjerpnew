<?php 
//echo "<pre>";var_dump($results);exit;
//以下分裝為頁
$select_date = $results['select_date'];unset($results['select_date']);
//echo "<pre>";var_dump($results);exit;
$page_data = array();
$pages = 0;$count_amount = 0;$each_epy_num = count($select_date);
foreach($results as $key => $val){//each員工	
	if($count_amount!=0 && $count_amount>35){
		$pages++;$count_amount=0;
	}
	$page_data[$pages][] = $val;
	if(@$val->times){$count_amount+=count($val->times);}
}$pages++;
if($count_amount<=0){echo "<script>alert('無刷卡資料!!');</script>";}
//echo "<pre>";var_dump($page_data);exit;

preg_match_all('/\d/S',$dateo, $matches);  //處理日期字串
$dateo = implode('',$matches[0]);
preg_match_all('/\d/S',$datec, $matches);  //處理日期字串
$datec = implode('',$matches[0]);
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
			<td align="left" width="33%"><font size="1">刷卡日期:&nbsp;<?php echo substr($dateo,0,4)."/".substr($dateo,4,2)."/".substr($dateo,6,2)." ~ ".substr($datec,0,4)."/".substr($datec,4,2)."/".substr($datec,6,2); ?></font></td>
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
		<?php if(@$type != "A"){?><td width="10%" align="center" valign="top">日　期</td><?php }?>
		<td width="30%" align="left" valign="top">刷卡時間</td>
	    <td width="30%" align="center" valign="top">狀　　態</td>
      </tr>
	</table>
    <table class="list">
<?php	
	foreach($page_data[$i] as $key => $val){
		if(!@$val->times){continue;}
		foreach($val->times as $k => $v){
?>
	  <tr><!-- 表身 物料 -->
	    <td width="8%" align="center" valign="top"><?php echo $val->mv004?></td>
		<td width="8%" align="center" valign="top"><?php echo $val->me002?></td>
	    <td width="8%" align="center" valign="top"><?php echo $val->te001?></td>
	    <td width="10%" align="center" valign="top"><?php echo $val->mv002?></td>
		<td width="8%" align="left" valign="top"><?php if(@$val->mv027){echo $val->mv027.":".$val->mo002;}else{echo "無班別";}?></td>
		<?php if(@$type != "A"){?><td width="10%" align="left" valign="top"><?php echo substr($k,0,4)."/".substr($k,4,2)."/".substr($k,6,2) ?></td><?php }?>
		<td width="30%" align="left" valign="top"><font size="1">
		<?php foreach($v as $t_k=>$t_v){if($t_k<7)echo $t_v." ";if($t_k==6)echo "資料過多";}?>
		</font></td>
	    <td width="30%" align="center" valign="top">
		<?php 
			if(@$val->status[$k]) echo $val->status[$k];echo " ";
			if(@$val->absenteeism_hr[$k]) {echo "缺:".$val->absenteeism_hr[$k];}
			if(@$val->leave_hr[$k]) {echo "請:".$val->leave_hr[$k];}
			//echo check_state($val);
		?>
		</td>
      </tr>
<?php 
		}
	}
?>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php 	
	}?>