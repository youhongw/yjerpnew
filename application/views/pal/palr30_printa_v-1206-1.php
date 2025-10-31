<?php 
//echo "<pre>";var_dump($results);exit;
$rows = array();								//依照組別分裝資料
foreach($results as $key => $val){
	$rows[$val->yh045][] = $val;
}

$total_col = array();							//設定計算total的欄位
for($o=10;$o<=40;$o++){
	$temp_varname = "yh0";
	if($o<10) $o = "0".$o;
	$temp_varname = $temp_varname.$o;
	$total_col[$temp_varname] = "";
}unset($total_col['yh010']);
//以下分裝為頁
$page_data = array();$pages = 0;$group_total=0;	//分組合計
$page_data_total = array();
foreach($rows as $key => $val){					//each 組
	unset($group_total);
	foreach($val as $k => $v){					//each Data
		if($k!=0 && $k%24 == 0){
			$page_data_total[$pages]['num'] = 24;
			foreach($total_col as $t_k => $t_v){	//裝資料同時計算合計
				$page_data_total[$pages]['total'][$t_k] = "";
			}
			$page_data_total[$pages]['total']['yh007'] = "合計：";
			$page_data_total[$pages]['total']['yh005'] = "續下頁";
			$page_data_total[$pages]['group'] = $key;
			$page_data_total[$pages]['company'] = $page_data[$pages][0]->yh006;
			$pages++;
		}
		$page_data[$pages][] = $v;
		foreach($total_col as $t_k => $t_v){	//裝資料同時計算合計
			if(!@$group_total[$t_k]){
				$group_total[$t_k] = $v->$t_k;
			}else{
				$group_total[$t_k] += $v->$t_k;
			}
		}
		
	}
	$page_data_total[$pages]['total'] = $group_total;
	$page_data_total[$pages]['total']['yh007'] = "合計：";
	$page_data_total[$pages]['group'] = $key;
	$page_data_total[$pages]['company'] = $page_data[$pages][0]->yh006;
	$pages++;
}
//echo "<pre>";var_dump($page_data);exit;

?>
<style>
.thead td{
	font-size:3px;
	border:1px solid;
	border-bottom:0px solid;
}
.list td{
	border:1px solid;
	//border-bottom:1px solid;
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
			<td align="left" width="33%">核發年度:&nbsp;<?php echo $dateo;?>　　<?php echo $page_data_total[$i]['group'];?>　　<?php echo $page_data_total[$i]['company'];?></td>
			<td align="center" width="33%">年　終　核　發　試　算　表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i+1 .'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="5%" align="center" valign="top">部　門</td>
		<td width="5%" align="center" valign="top">職　稱</td>
	    <td width="5%" align="center" valign="top">姓　名</td>
	    <td width="5%" align="center" valign="top">年　資</td>
		<td width="5%" align="center" valign="top">換算基數</td>
		<td width="5%" align="center" valign="top">可發天數</td>
	    <td width="5%" align="center" valign="top">遲 到 次</td>
		<td width="5%" align="center" valign="top">病 假 天</td>
		<td width="5%" align="center" valign="top">事 假 天</td>
		<td width="5%" align="center" valign="top">功 過 天</td>
		<td width="5%" align="center" valign="top">全 勤 天</td>
		<td width="5%" align="center" valign="top">可發日數</td>
		<td width="5%" align="center" valign="top">日    薪</td>
		<td width="5%" align="center" valign="top">可發金額</td>
		<td width="5%" align="center" valign="top">實發金額</td>
		<td width="5%" align="center" valign="top">總經理核</td>
		<td width="5%" align="center" valign="top">今年考績</td>
		<td width="5%" align="center" valign="top">今年總分</td>
		<td width="5%" align="center" valign="top">去年核發</td>
		<td width="5%" align="center" valign="top">備註</td>
      </tr>
	</table>
    <table class="list">
<?php	
	foreach($page_data[$i] as $key => $val){
?>
	  <tr><!-- 表身 物料 -->
	    <td width="5%" align="center" valign="top"><?php echo $val->yh006?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh007?></td>
	    <td width="5%" align="right" valign="top"><?php echo $val->yh005?></td>
	    <td width="5%" align="right" valign="top"><?php echo $val->yh008?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh009?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh010?><br><?php echo $val->yh011?><br><?php echo $val->yh012?>
		                                          <br><?php echo $val->yh013?><br><?php echo $val->yh014?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh015?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh016?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh017?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh018?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh019?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh020?><br><?php echo $val->yh021?><br><?php echo $val->yh022?>
		                                          <br><?php echo $val->yh023?><br><?php echo $val->yh024?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh017+$val->yh019?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh018+$val->yh020?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh021+$val->yh023?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh022+$val->yh024?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh025+$val->yh027?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh026+$val->yh028?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh029?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh030?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh031?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh033?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh034?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh037?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh036?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh038?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh035?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh039?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh040?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh041?></td>
      </tr>
<?php 
	}
?>
	  <tr><!-- 表身 物料 -->
	    <td width="5%" align="center" valign="top"><?php echo '' ?></td>
		<td width="5%" align="right" valign="top"><?php echo ''?></td>
	    <td width="5%" align="right" valign="top"><?php echo ''?></td>
	    <td width="5%" align="right" valign="top"><?php echo ''?></td>
		<td width="5%" align="right" valign="top"><?php echo ''?></td>
		<td width="5%" align="right" valign="top"><?php echo ''?></td>
	    <td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh011']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh012']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh013']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh014']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh015']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh016']?></td>
		<td width="5%" align="right" valign="top"><?php if($page_data_total[$i]['total']['yh017']=="") echo "";else echo $page_data_total[$i]['total']['yh017']+$page_data_total[$i]['total']['yh019']?></td>
		<td width="5%" align="right" valign="top"><?php if($page_data_total[$i]['total']['yh018']=="") echo "";else echo $page_data_total[$i]['total']['yh018']+$page_data_total[$i]['total']['yh020']?></td>
		<td width="5%" align="right" valign="top"><?php if($page_data_total[$i]['total']['yh021']=="") echo "";else echo $page_data_total[$i]['total']['yh021']+$page_data_total[$i]['total']['yh023']?></td>
		<td width="5%" align="right" valign="top"><?php if($page_data_total[$i]['total']['yh022']=="") echo "";else echo $page_data_total[$i]['total']['yh022']+$page_data_total[$i]['total']['yh024']?></td>
		<td width="5%" align="right" valign="top"><?php if($page_data_total[$i]['total']['yh025']=="") echo "";else echo $page_data_total[$i]['total']['yh025']+$page_data_total[$i]['total']['yh027']?></td>
		<td width="5%" align="right" valign="top"><?php if($page_data_total[$i]['total']['yh026']=="") echo "";else echo $page_data_total[$i]['total']['yh026']+$page_data_total[$i]['total']['yh028']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh029']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh030']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh031']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh033']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh034']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh037']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh036']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh038']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh035']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh039']?></td>
		<td width="5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['yh040']?></td>
		<td width="5%" align="right" valign="top"><?php echo ''?></td>
      </tr>
	</table>
	<table class="store">
	<tr>
		<td align="left" width="33%">核　　准：</td>
		<td align="center" width="33%">審　　核：</td>
		<td align="right" width="33%">製　　表：</td>
	</tr>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
