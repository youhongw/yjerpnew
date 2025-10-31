<?php 
//echo "<pre>";var_dump($results);exit;
$rows = array();								//依照組別分裝資料
foreach($results as $key => $val){
	$rows[$val->yh047][] = $val;
}

if(@$results[0]){
$total_col = array();
foreach($results[0] as $t_k => $t_v){//設定計算total的欄位
	$total_col[$t_k] = "";
}
}else{
	echo "<script>alert('查無資料!!');history.back();</script>";
	exit;
}
/*					
for($o=10;$o<=50;$o++){	//這樣設定等於只合計yh010~yh050這些欄位
	$temp_varname = "yh0";
	if($o<10) $o = "0".$o;
	$temp_varname = $temp_varname.$o;
	$total_col[$temp_varname] = "";
}unset($total_col['yh010']);
*/
//以下分裝為頁
$page_data = array();$pages = 0;$group_total=0;	//分組合計
$page_data_total = array();
foreach($rows as $key => $val){					//each 組
	unset($group_total);
	foreach($val as $k => $v){					//each Data
		if($k!=0 && $k%34 == 0){					//%多少等於一頁多少筆
			$page_data_total[$pages]['num'] = 34;//一頁多少筆(需跟上面一樣多)
			foreach($total_col as $t_k => $t_v){	//裝資料同時計算合計
				$page_data_total[$pages]['total'][$t_k] = "";
			}
			$page_data_total[$pages]['total']['yh007'] = "合計：";
			$page_data_total[$pages]['total']['yh005'] = "續下頁";
			$page_data_total[$pages]['group'] = $key;
			$page_data_total[$pages]['company'] = $page_data[$pages][0]->yh048;  //分類中文
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
	$page_data_total[$pages]['company'] = $page_data[$pages][0]->yh048;
	$pages++;
}
//echo "<pre>";var_dump($page_data_total);exit;

?>
<style>
.thead td{
	font-size:12px;
	border:1px solid;
	border-bottom:0px solid;
}
.list td{
	border:1px solid;
	//border-bottom:1px solid;
	padding : 0px 0px 0px 0px;
	vertical-align : middle;
	text-align:center;
	font-size:12px;
}
div span{
   // border-bottom: 1px solid;
	text-decoration: underline;
}
div {
	text-align:center;
}
td div {
	height: 18px;
}
div.baseline {
	border-bottom:1px solid;
	height: 18px;
}
.grayback{
	background-color:rgba(225,225,225,1);;
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
			<td align="center" width="33%">年 終 發 放 彙 總 表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i+1 .'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="7%" align="center" valign="top">員工代號</td>
		<td width="7%" align="center" valign="top">部　門</td>
		<td width="7%" align="center" valign="top">職　稱</td>
	    <td width="7%" align="center" valign="top">姓　名</td>
	    <td width="8%" align="center" valign="top">可發金額</td>
		<td width="8%" align="center" valign="top">加減調整</td>
		<td width="8%" align="center" valign="top">應發總額</td>
	    <td width="8%" align="center" valign="top">扣繳稅率</td>
		<td width="8%" align="center" valign="top">扣繳金額</td>
		<td width="8%" align="center" valign="top">扣健保2%</td>
		<td width="8%" align="center" valign="top">現金發放</td>
		<td width="8%" align="center" valign="top">轉帳發放</td>
		<td width="8%" align="center" valign="top">備註</td>
      </tr>
	</table>
    <table class="list">
<?php	
	foreach($page_data[$i] as $key => $val){
?>
	  <tr><!-- 表身 物料 -->
	    <td width="7%" align="center" valign="top"><?php echo $val->yh002?></td>
		<td width="7%" align="center" valign="top"><?php echo $val->yh006?></td>
		<td width="7%" align="right" valign="top"><?php echo $val->yh007?></td>
	    <td width="7%" align="right" valign="top"><?php echo $val->yh005?></td>
		
		<td width="8%" align="right" valign="top" class="grayback"><?php if ($val->yh046=="2")  {echo $val->yh051-$val->yh034;}   ?><?php if ($val->yh046=="1")  {echo $val->yh051;}   ?></td>
		<td width="8%" align="right" valign="top"><?php if ($val->yh046=='2') { echo $val->yh034;}  ?><?php if ($val->yh046=="1")  {echo '0';}   ?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh051?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh052?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh053?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh054?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh056?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh057?></td>
		<td width="8%" align="right" valign="top"><?php echo $val->yh044?></td>
      </tr>
<?php 
	}
?>
	  <tr><!-- 表身 物料 -->
	    <td width="7%" align="right" valign="top"><?php echo ''?></td>
	    <td width="7%" align="center" valign="top"><?php if(@$page_data_total[$i]['total']['yh007']=="") echo "";else echo $page_data_total[$i]['total']['yh007']?></td>
		<td width="7%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh005']=="") echo "";else echo "" ?></td>
	    <td width="7%" align="right" valign="top"><?php echo ''?></td>
	    <td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh051']=="") echo "";else echo $page_data_total[$i]['total']['yh051']-$page_data_total[$i]['total']['yh034']?></td>
		<td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh034']=="") echo "";else echo $page_data_total[$i]['total']['yh034']?></td>
		<td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh051']=="") echo "";else echo $page_data_total[$i]['total']['yh051']?></td>
		<td width="8%" align="right" valign="top"><?php echo ''?></td>
		<td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh053']=="") echo "";else echo $page_data_total[$i]['total']['yh053']?></td>
		<td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh054']=="") echo "";else echo $page_data_total[$i]['total']['yh054']?></td>
		<td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh056']=="") echo "";else echo $page_data_total[$i]['total']['yh056']?></td>
		<td width="8%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh057']=="") echo "";else echo $page_data_total[$i]['total']['yh057']?></td>
		<td width="8%" align="right" valign="top"><?php echo ''?></td>
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
