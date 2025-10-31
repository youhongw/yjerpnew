<?
//echo "<pre>";var_dump($results);exit;
$num_results = count($results);
//$page = ceil($num_results/75);
//$last_num = $num_results%75;
//echo "<pre>";var_dump($page);exit;
$num_each_page = 24;
$page_data = array();$page = 1;$current_count = 0;
foreach($results as $key => $val){
	$current_count++;if($current_count>$num_each_page){$current_count=1;$page++;}
	$page_data[$page][$val['mv001']] = $val;
	extract($val);
	//處理特休日期
	if(substr($mv021,0,4) <= 2005 && $mv001!="70001" && $mv001!="73001" && $mv001!="67001" && $mv001!="77001" && $mv001!="82008"  ){$mv021="20050701";}
	$str_day1 = $mv217."/".substr($mv021,4,2)."/".substr($mv021,6,2);
	if($mv215<=3){$str_day1 = date('Y/m/d', strtotime ("+6 month", strtotime($str_day1)));}
	if($mv217==2016){
		if((substr($mv021,0,4)<=2016 && substr($mv021,4,2)<7) || substr($str_day1,0,4) < 2017 )
			$str_day1 = "2017/01/01";
	}
	$str_day2 = ($mv217+1)."/".substr($mv021,4,2)."/".substr($mv021,6,2);
	$end_day1 = date('Y/m/d', strtotime ("-1 day", strtotime($str_day2)));
	$end_day2 = date('Y/m/d', strtotime ("-1 day", strtotime(($mv217+2)."/".substr($mv021,4,2)."/".substr($mv021,6,2))));
	$mv021 = substr($mv021,0,4)."/".substr($mv021,4,2)."/".substr($mv021,6,2);
	$page_data[$page][$val['mv001']]['mv021'] = convert_TWdate($mv021);
	$page_data[$page][$val['mv001']]['spe_str1'] = convert_TWdate($str_day1);
	$page_data[$page][$val['mv001']]['spe_end1'] = convert_TWdate($end_day1);
	$page_data[$page][$val['mv001']]['spe_day1'] = $mv215;
	$page_data[$page][$val['mv001']]['spe_str2'] = convert_TWdate($str_day2);
	$page_data[$page][$val['mv001']]['spe_end2'] = convert_TWdate($end_day2);
	$page_data[$page][$val['mv001']]['spe_day2'] = $mv216;
}
function convert_TWdate($date){
	return (substr($date,0,4)-1911).substr($date,4,999);
	
}
//echo "<pre>";var_dump($page_data);exit;
?>
<?foreach($page_data as $key => $val){?>
	<?foreach($val as $k => $v){?>
	<div style="text-align:left;border-bottom-style:dashed;border-color:rgba(128, 128, 128, 0.2);font-family:標楷體;">
		<div style="overflow:auto;margin:0px 0px 4px 0px;"><!--第一列-->
			<div style="width:25%;float:left;">單位: <span style="text-decoration:underline;"><?php echo $v['me002']; ?></span></div>
			<div style="width:25%;float:left;">姓名: <span style="text-decoration:underline;"><?php echo $v['mv002']; ?></span></div>
			<div style="width:25%;float:left;">員編: <span style="text-decoration:underline;"><?php echo $v['mv001']; ?></span></div>
			<div style="width:25%;float:left;">到職日: <span style="text-decoration:underline;"><?php echo $v['mv021']; ?></span></div>
		</div>
		<div style="overflow:auto;margin:4px 0px 0px 0px;"><!--第二列-->
			<div style="width:30%;float:left;">自 <span style="text-decoration:underline;"><?php echo $v['spe_str1']; ?>~<?php echo $v['spe_end1']; ?></span>止</div>
			<div style="width:20%;float:left;">特休: <span style="text-decoration:underline;"><?php echo $v['spe_day1']; ?> 天</span></div>
			<div style="width:30%;float:left;">自 <span style="text-decoration:underline;"><?php echo $v['spe_str2']; ?>~<?php echo $v['spe_end2']; ?></span>止</div>
			<div style="width:20%;float:left;">特休: <span style="text-decoration:underline;"><?php echo $v['spe_day2']; ?> 天</span></div>
		</div>
	</div>
	<?
	}
	?>
<div style="page-break-before: always;"></div>
<?
}
?>