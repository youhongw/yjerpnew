<?php 
    $td030=0;$td031=0;$td033=0;$td034=0;$td036=0;$td037=0;$td039=0;$td040=0;$td041=0;
	$rows = array();							//依照切傳組別分裝資料
	foreach($results as $key => $val){
		$rows[$val->mk004][] = $val;
	}
	$sum_line_num = count($rows);				//計算幾行合計(每組別一合計)
	$total_num = $num_results + $sum_line_num+1;	//總筆數 = 筆數 + 合計行數 + 最後總計
	$pages = ceil($total_num/24);
	$data = array();$per_group_total = array();
	$count_col = array(
		"yh051","yh034","yh053","yh054","yh056","yh057"
	);
	foreach($rows as $key => $val){
		$per_group_total[$key] = new stdClass;  //物件 轉 陣列
		foreach($val as $k => $v){
			$data[] = $v;
			$per_group_total[$key]->mkj001 = "T".$key;
			$per_group_total[$key]->mkj002 = "合計";
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
			<td align="center" width="33%">年終切傳票二代健保</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i.'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="11%" align="center" valign="top">類別代號</td>
		<td width="12%" align="center" valign="top">類別名稱</td>
	    <td width="11%" align="left" valign="top">可發金額</td>
	    <td width="11%" align="left" valign="top">免稅金額</td>
		<td width="11%" align="left" valign="top">應發總額</td>
		<td width="11%" align="left" valign="top">扣繳金額</td>
	    <td width="11%" align="left" valign="top">扣健保2%</td>
		<td width="11%" align="left" valign="top">現金發放</td>
		<td width="11%" align="left" valign="top">轉帳發放</td>
      </tr>
	</table>
    <table class="list">
	<?php
	$num_each_page = $i*24;
	if($i==$pages && $total_num%24 != 0 )
		$num_each_page = $total_num%24+($i-1)*24;
	
	for($j=$i*24-24;$j<$num_each_page;$j++){
	?>
	  <tr><!-- 表身 物料 -->
	    <td width="11%" align="center" valign="top"><?php echo $data[$j]->mkj001?></td>
		<td width="12%" align="center" valign="top"><?php echo $data[$j]->mkj002?></td>
		<?php if (($data[$j]->yh051-$data[$j]->yh034)<0) {$vyh051=($data[$j]->yh051);$vyh034=0;} else {$vyh051=($data[$j]->yh051-$data[$j]->yh034);$vyh034=$data[$j]->yh034;}   ?>
	    <td width="11%" align="center" valign="top"><?php echo $vyh051 ?></td>
		 <td width="11%" align="center" valign="top"><?php echo $vyh034 ?></td>
	    <td width="11%" align="center" valign="top"><?php echo $data[$j]->yh051?></td>
		<td width="11%" align="center" valign="top"><?php echo $data[$j]->yh053?></td>
	    <td width="11%" align="center" valign="top"><?php echo $data[$j]->yh054?></td>
		<td width="11%" align="center" valign="top"><?php echo $data[$j]->yh056?></td>
		<td width="11%" align="center" valign="top"><?php echo $data[$j]->yh057?></td>
      </tr>
	<?php 
	}?>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
