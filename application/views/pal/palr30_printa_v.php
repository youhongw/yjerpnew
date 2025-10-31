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
		if($k!=0 && $k%6 == 0){					//%多少等於一頁多少筆
			$page_data_total[$pages]['num'] = 6;//一頁多少筆(需跟上面一樣多)
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
			<td align="center" width="33%">年　終　核　發　試　算　表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i+1 .'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="4%" align="center" valign="top">員工代號</td>
		<td width="4%" align="center" valign="top">部　門</td>
		<td width="4%" align="center" valign="top">職　稱</td>
	    <td width="4%" align="center" valign="top">姓　名</td>
	    <td width="4%" align="center" valign="top">年　資</td>
		<td width="4%" align="center" valign="top">換算基數</td>
		<td width="4%" align="center" valign="top">可發天數</td>
	    <td width="4%" align="center" valign="top">遲 到 天</td>
		<td width="4%" align="center" valign="top">病 假 天</td>
		<td width="4%" align="center" valign="top">事 假 天</td>
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
	    <td width="4%" align="center" valign="top"><?php echo $val->yh002?></td>
		<td width="4%" align="center" valign="top"><?php echo $val->yh006?></td>
		<td width="4%" align="right" valign="top"><?php echo $val->yh007?></td>
	    <td width="4%" align="right" valign="top"><?php echo $val->yh005?></td>
	    <td width="4%" align="right" valign="top"><?php echo $val->yh008?></td>
		<td width="4%" align="right" valign="top" class="grayback"><?php echo $val->yh009?></td>
		<td width="4%" align="right" valign="top">
			<div class="baseline"><?php echo $val->yh010?></div>
			<div class="baseline"><?php echo $val->yh011?></div>
			<div class="baseline"><?php echo $val->yh012?></div>
			<div class="baseline"><?php echo $val->yh013?></div>
			<div><?php echo $val->yh014?></div></td>
		<td width="4%" align="right" valign="top"><?php echo $val->yh015?></td>
		<td width="4%" align="right" valign="top"><?php echo $val->yh016?></td>
		<td width="4%" align="right" valign="top"><?php echo $val->yh017?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh018?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh019?></td>
		<td width="5%" align="right" valign="top">
			<div class="baseline grayback"><?php echo $val->yh020?></div>
			<div class="baseline grayback"><?php echo $val->yh021?></div>
			<div class="baseline grayback"><?php echo $val->yh022?></div>
			<div class="baseline grayback"><?php echo $val->yh023?></div>
			<div class="grayback"><?php echo $val->yh024?></div></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh025?></td>
			<?php  $vyh026='應稅獎金';$vyh027='考勤功過';$vyh028='金額小計';$vyh029='免稅獎金';$vyh030='獎金合計'; ?>
			<?php  $vyh031=' ';$vyh032=' ';$vyh033=' ';$vyh034=' ';$vyh035=' '; ?>
			<?php if ($val->yh046=='1') {$vyh026=$val->yh026;$vyh027=$val->yh027;$vyh028=$val->yh028;$vyh029=$val->yh029;$vyh030=$val->yh030;}?>
			<?php if ($val->yh046=='2') {$vyh031=$val->yh031;$vyh032=$val->yh032;$vyh033=$val->yh033;$vyh034=$val->yh034;$vyh035=$val->yh035;}?>
			<?php if ($val->yh046=='1') {$vyh031=$val->yh036;}?>
		<td width="5%" align="right" valign="top">
			<div class="baseline grayback"><?php echo $vyh026?></div>
			<div class="baseline grayback"><?php echo $vyh027?></div>
			<div class="baseline grayback"><?php echo $vyh028?></div>
			<div class="baseline grayback"><?php echo $vyh029?></div>
			<div class="grayback"><?php echo $vyh030?></div></td>		  
		<td width="5%" align="right" valign="top">
			<div class="baseline"><?php echo $vyh031?></div>
			<div class="baseline"><?php echo $vyh032?></div>
			<div class="baseline"><?php echo $vyh033?></div>
			<div class="baseline"><?php echo $vyh034?></div>
			<div><?php echo $vyh035?></div></td>
		<td width="5%" align="right" valign="top">
			<div class="baseline"><?php echo ''?></div>
			<div class="baseline"><?php echo ''?></div>
			<div class="baseline"><?php echo ''?></div>
			<div class="baseline"><?php echo ''?></div>
			<div><?php echo ''?></div></td>
			 <?php if ($val->yh041=='') {$vyh041='';}   ?>
		  <?php if ($val->yh041=='1') {$vyh041='優';}   ?>
		   <?php if ($val->yh041=='2') {$vyh041='甲';}   ?>
		    <?php if ($val->yh041=='3') {$vyh041='乙';}   ?>
			 <?php if ($val->yh041=='4') {$vyh041='丙';}   ?>
			  <?php if ($val->yh041=='5') {$vyh041='丁';}   ?>
			   <?php if ($val->yh041>'5') {$vyh041=$val->yh041;}   ?>
			    <?php if ($val->yh042==0) {$vyh042='';} else {$vyh042=$val->yh042;}   ?>
		<td width="5%" align="right" valign="top"><?php echo $vyh041?></td>
		<td width="5%" align="right" valign="top"><?php echo $vyh042?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh043 ?></td>
		<td width="5%" align="right" valign="top"><?php echo $val->yh044 ?></td>
      </tr>
<?php 
	}
?>
	  <tr><!-- 表身 物料 -->
	    <td width="4%" align="right" valign="top"><?php echo ''?></td>
	    <td width="4%" align="center" valign="top"><?php if(@$page_data_total[$i]['total']['yh007']=="") echo "";else echo $page_data_total[$i]['total']['yh007']?></td>
		<td width="4%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh005']=="") echo "";else echo  "" ?></td>
	    <td width="4%" align="right" valign="top"><?php echo ''?></td>
	    <td width="4%" align="right" valign="top"><?php echo ''?></td>
		<td width="4%" align="right" valign="top"><?php echo ''?></td>
		<td width="4%" align="right" valign="top"><?php echo ''?></td>
		<td width="4%" align="right" valign="top"><?php //echo $page_data_total[$i]['total']['yh016']?></td>
		<td width="4%" align="right" valign="top"><?php echo ''?></td>
		<td width="4%" align="right" valign="top"><?php echo ''?></td>
		<td width="5%" align="right" valign="top"><?php //if(@$page_data_total[$i]['total']['yh021']=="") echo "";else echo $page_data_total[$i]['total']['yh021']+$page_data_total[$i]['total']['yh023']?></td>
		<td width="5%" align="right" valign="top"><?php //if(@$page_data_total[$i]['total']['yh022']=="") echo "";else echo $page_data_total[$i]['total']['yh022']+$page_data_total[$i]['total']['yh024']?></td>
		<td width="5%" align="right" valign="top"><?php //if(@$page_data_total[$i]['total']['yh025']=="") echo "";else echo $page_data_total[$i]['total']['yh025']+$page_data_total[$i]['total']['yh027']?></td>
		<td width="5%" align="right" valign="top"><?php //if(@$page_data_total[$i]['total']['yh026']=="") echo "";else echo $page_data_total[$i]['total']['yh026']+$page_data_total[$i]['total']['yh028']?></td>
		<td width="5%" align="right" valign="top"><?php //echo $page_data_total[$i]['total']['yh029']?></td>
		<td width="5%" align="right" valign="top"><?php //echo $page_data_total[$i]['total']['yh030']?></td>
		<td width="5%" align="right" valign="top"><?php //if(@$page_data_total[$i]['total']['yh043']=="") echo "";else echo $page_data_total[$i]['total']['yh043']?></td>
		<td width="5%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh041']=="") echo "";else echo  "" ?></td>
		<td width="5%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh042']=="") echo "";else echo $page_data_total[$i]['total']['yh042']?></td>
		<td width="5%" align="right" valign="top"><?php if(@$page_data_total[$i]['total']['yh043']=="") echo "";else echo $page_data_total[$i]['total']['yh043']?></td>
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
