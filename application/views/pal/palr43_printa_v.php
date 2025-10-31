<?php 
    $td030=0;$td031=0;$td033=0;$td034=0;$td036=0;$td037=0;$td039=0;$td040=0;$td041=0;
	$rows = array();							//依照切傳組別分裝資料
	foreach($results as $key => $val){
		$rows[$val->mk004][] = $val;
	}
	$sum_line_num = count($rows);				//計算幾行合計(每組別一合計)
	$total_num = $num_results + $sum_line_num+1;	//總筆數 = 筆數 + 合計行數 + 最後總計
	$per_page_num = 25;
	$pages = ceil($total_num/$per_page_num);
	$data = array();$per_group_total = array();
	$count_col = array(
		"td030","td031","td033","td034","td035","td036","td037","td038","td039","td040","td041"
	);
	foreach($rows as $key => $val){
		$per_group_total[$key] = new stdClass;
		foreach($val as $k => $v){
			$data[] = $v;
			$per_group_total[$key]->mkj001 = "T".$key;
			$per_group_total[$key]->mkj002 = "合計";
			if($v->mk004>1){$per_group_total[$key]->mkj002 .= mb_substr($v->mk002,0,2,'UTF-8');}
			else{$per_group_total[$key]->mkj002 .= "得貹";}
			foreach($count_col as $t_k => $t_v){
				if(!@$per_group_total[$key]->$t_v){
					$per_group_total[$key]->$t_v = 0;
				}
				$per_group_total[$key]->$t_v += $v->$t_v;
				//echo $t_v." : ".$per_group_total[$key]->$t_v."<br>";//檢查每行合計用
			}
			//echo "<pre>";var_dump($per_group_total[$key]);echo "</pre><br>";//檢查每行合計用
		}
		$data[] = $per_group_total[$key];
	}
	$all_group_total = new stdClass;
	$all_group_total->mkj001 = "TA";
	$all_group_total->mkj002 = "總計";
	foreach($per_group_total as $key => $val){
		foreach($count_col as $t_k => $t_v){
			if(!@$all_group_total->$t_v){
				$all_group_total->$t_v = 0;
			}
			$all_group_total->$t_v += $val->$t_v;
		}
	}
	$data[] = $all_group_total;
	//echo "<pre>";var_dump($data);exit;
?>
	<style>
	.thead td{
		border:0px;
		border-top:2px solid ;
		border-bottom:2px solid ;
	}
	.list td{
		border:0px;
		border-bottom:1px solid ;
		padding : 5px 0px 0px 0px;
	}
	</style>
	<?php
	for($i=1;$i<=$pages;$i++){
	?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	    <tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
	    </tr>
		<tr>
			<td align="left" width="33%">年月:&nbsp;<?php echo $qry_date;?></td>
			<td align="center" width="33%">切傳票明細表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i.'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center" valign="top">類別代號</td>
		<td width="15%" align="center" valign="top">類別名稱</td>
	    <td width="7%" align="left" valign="top">應領薪資</td>
	    <td width="7%" align="left" valign="top">借　　支</td>
		<td width="7%" align="left" valign="top">勞 保 費</td>
		<td width="7%" align="left" valign="top">健 保 費</td>
	    <td width="7%" align="left" valign="top">所 得 稅</td>
		<td width="7%" align="left" valign="top">伙 食 費</td>
		<td width="7%" align="left" valign="top">其　　他</td>
		<td width="7%" align="left" valign="top">補充保費</td>
		<td width="7%" align="left" valign="top">實領薪資</td>
		<td width="7%" align="left" valign="top">轉帳薪資</td>
		<td width="7%" align="left" valign="top">支領現金</td>
      </tr>
	</table>
    <table class="list">
	<?php
	$num_each_page = $i*$per_page_num;
	if($i==$pages && $total_num%$per_page_num != 0 )
		$num_each_page = $total_num%$per_page_num+($i-1)*$per_page_num;
	
	for($j=$i*$per_page_num-$per_page_num;$j<$num_each_page;$j++){
	?>
	  <tr <?php if(mb_substr($data[$j]->mkj002,0,2,'UTF-8')=="合計"){echo "style='background-color: rgba(128, 128, 128, 0.5);'";}?>><!-- 表身 物料 -->
	    <td width="8%" align="center" valign="top"><?php echo $data[$j]->mkj001?></td>
		<td width="15%" align="center" valign="top"><?php echo $data[$j]->mkj002?></td>
	    <td width="7%" align="center" valign="top"><?php echo round($data[$j]->td030,0) ?></td>
	    <td width="7%" align="center" valign="top"><?php echo round($data[$j]->td031,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td033,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td034,0) ?></td>
	    <td width="7%" align="center" valign="top"><?php echo round($data[$j]->td037,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td036,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td038,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td035,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td039,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td040,0) ?></td>
		<td width="7%" align="center" valign="top"><?php echo round($data[$j]->td041,0) ?></td>
      </tr>
	<?php 
	}?>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
