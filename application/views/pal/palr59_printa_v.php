<?php 
//echo "<pre>";var_dump($results);exit;
$date_ary = array();
preg_match_all('/\d/S',$dateo, $matches);  //處理日期字串
$dateo = implode('',$matches[0]);
preg_match_all('/\d/S',$datec, $matches);  //處理日期字串
$datec = implode('',$matches[0]);
for($i=$dateo;$i<=$datec;$i++){
	$temp_year = substr($i,0,4);$temp_month = substr($i,4,2);
	if($temp_month>12){
		$temp_year++;$temp_month="01";
		$i = $temp_year.$temp_month;
	}
	$date_ary[] = $i;
}
$avg_width = 60/(count($date_ary)+1);
$data = array();//先分裝組別
foreach($results as $key => $val){
	$data[$val->td001]['td001'] = $val->td001;
	$data[$val->td001]['td002'] = $val->td002;
	//$data[$val->td001]['td003'] = $val->td003;//部門代號
	$data[$val->td001]['me002'] = $val->me002;
	$data[$val->td001]['td054'] = $val->td054;
	$data[$val->td001]['td050'] = $val->td050;
	$data[$val->td001]['sa_data'][$val->td005]["td047"] = $val->td047;
	$data[$val->td001]['sa_data'][$val->td005]["td037"] = $val->td037;
	$data[$val->td001]['sa_data'][$val->td005]["td049"] = $val->td049;
	$data[$val->td001]['sa_data'][$val->td005]["td044"] = $val->td044;
	$data[$val->td001]['sa_data'][$val->td005]["td005"] = "";
	/*foreach($val as $k=>$v){
		if($v == 0){
			$val->$k = "";
		}
	}*/
}
//echo "<pre>";var_dump($data);exit;

foreach($data as $key => $val){
	foreach($date_ary as $k => $v){
		if(!@$data[$key]['sa_data'][$v]){
			$data[$key]['sa_data'][$v]["td047"] = "";
			$data[$key]['sa_data'][$v]["td037"] = "";
			$data[$key]['sa_data'][$v]["td049"] = "";
			$data[$key]['sa_data'][$v]["td044"] = "";
			$data[$key]['sa_data'][$v]["td005"] = "";
		}
	}
}
//echo "<pre>";var_dump($data);exit;

$num_each_page = 4;$total_page = 0;$current_count = 0;
$total_trans_money = 0;$total_cash_money = 0;$total_people = 0;
$page_data = array();
foreach($data as $key => $val){
	if($current_count%$num_each_page==0){
		$total_page++;
	}
	$current_count++;
	$page_data[$total_page][] = $val;$total_people++;
}

$month_ary = array(
	'01' => "一月",'02' => "二月",'03' => "三月",'04' => "四月",
	'05' => "五月",'06' => "六月",'07' => "七月",'08' => "八月",
	'09' => "九月",'10' => "十月",'11' => "十一月",'12' => "十二月",
);
$payclass_ary = array(
	'1'=>'薪資','2'=>'薪稅','3'=>'伙食津貼','4'=>'加班費','5'=>'蓋章'
);

?>
<?php
	foreach($page_data as $page_key => $page_val){
?>
	<table class="store">
	    <tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
	    </tr>
		<tr>
			<td align="left" width="33%">查詢年月期間:&nbsp;<?php echo substr($dateo,0,4)."/".substr($dateo,4,2)."~".substr($datec,0,4)."/".substr($datec,4,2);?></td>
			<td align="center" width="33%">薪資印領清冊</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $page_key .'/'.$total_page; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr style="background-color: rgba(0, 0, 0, 0.25);">
		<td width="8%" align="center">領款人編號</td>
	    <td width="8%" align="center">領款人姓名</td>
		<td width="11%" align="center">地址</td>
	    <td width="7%" align="center">身分證號</td>
	    <td width="6%" align="center">給付別</td>
		<?php 
			foreach($date_ary as $d_key => $d_val){
				echo "<td style='width:".$avg_width."%;' align='center'>".$month_ary[substr($d_val,4,2)]."</td>";
			}
			echo "<td style='width:".$avg_width."%;' align='center'>總計</td>";
		?>
      </tr>
	<?php foreach($page_val as $epy_key => $epy_val){ //$page_val->頁面資料,$epy_val->單人資料$epy_val->sa_data->各月資料 
			$each_row_count = 0;
			foreach($epy_val['sa_data'] as $temp_key => $temp_val){
			foreach($temp_val as $key => $val){
				$each_row_count ++;
	?>		<tr <?php if($each_row_count==1 || $each_row_count==5){echo "style='height:53px;'";} ?> >
				<td width="8%" align="center"><?php echo $epy_val['td001']; ?></td>
				<td width="8%" align="center"><?php if($each_row_count==1){echo $epy_val['td002'];} ?></td>
				<td width="11%" align="left"><?php if($each_row_count==1){echo $epy_val['td054'];}if($each_row_count==2){echo $epy_val['me002'];} ?></td>
				<td width="7%" align="right"><?php if($each_row_count==1){echo $epy_val['td050'];} ?></td>
				<td width="6%" align="left"><?php echo $payclass_ary[$each_row_count]; ?></td>
			<?php 
				$row_total = 0;
				foreach($date_ary as $d_key => $d_val){
					//echo "<pre>";var_dump($epy_val['sa_data'][$d_val][$key]);exit;
					if($epy_val['sa_data'][$d_val][$key]!=0){
						echo "<td style='width:".$avg_width."%;' align='right'>".$epy_val['sa_data'][$d_val][$key]."</td>";
					}else{
						echo "<td style='width:".$avg_width."%;' align='right'></td>";
					}
					$row_total += $epy_val['sa_data'][$d_val][$key];
				}
				if($row_total){
					echo "<td style='width:".$avg_width."%;' align='right'>".$row_total."</td>";
				}else{
					echo "<td style='width:".$avg_width."%;' align='right'></td>";
				}
				
			?>
			</tr>
	<?php	}break;
			}
		
	?>
		
		
		
		
	<?php } ?>
	<?php /* if($key==$total_page){ ?>
	  <tr>
	     <td align="right" colspan="6" >合計:<?php echo $total_people;?>人</td>
      </tr>
	<?php } */?>
	</table>
	<div style="page-break-before: always;"></div>
<?php	
	}
?>