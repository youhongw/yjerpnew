<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>請 購 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<style>
	tr{
		border:1px;
		border-bottom-style:solid;border-color:black;
	}
	td{
		border:1px;
		height:45px;
		border-color:black;
		text-align:center;
	}
	.td_right td{
		border:1px;
		border-right-style:solid;
	}
	.narrow td{
		height:20px;
	}
	.td_nobot{
		border-bottom-style:hidden;
	}
	.tr_nobot{
		border-bottom-style:hidden;
	}
</style>
<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri06/printdetailc';location = url; </script> 
  <?php exit;} ?>
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri06/printdetailc';location = url; </script> 
 <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
<?php  //處理資料
//echo var_dump($results1);exit;  //印出來看歷史價格
$page = 1;//預設第一頁
$page_limit = 5;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
$page_data1;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%5==4){
		if(@$results[$page*5]){
			$page++;
		}
	}
	$pur_date = substr($value->TA003,0,4).'/'.substr($value->TA003,4,2).'/'.substr($value->TA003,6,2);
}

foreach($results1 as $key1=>$value1){
	$page_data1[$page][] = $value1;
	if($key1%5==4){
		if(@$results1[$page*5]){
			$page++;
		}
	}
	//$pur_date = substr($value->TA003,0,4).'/'.substr($value->TA003,4,2).'/'.substr($value->TA003,6,2);
}

$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>
<div STYLE="page-break-after: always;">
	<div id="top_div" name="top_div">
		<div style="text-align:center;"><font size="4"><b><?php echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?></b></font></div>
	<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
		<div style="text-align:center;"><font size="5">請&nbsp;&nbsp;購&nbsp;&nbsp;明&nbsp;&nbsp;細&nbsp;&nbsp;表</font></div>
		<br>
	</div>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="text-align:left;width:30%;">
			單別/單號 : <span><?php echo $results[0]->TA001."/".$results[0]->TA002?></span>
			</td>
			<td style="text-align:center;width:40%;"></td>
			<td style="text-align:right;width:30%;">
			<div>日&nbsp;&nbsp;&nbsp;&nbsp;期 : <span id="pur_date" name="pur_date"> <?php echo $pur_date ?></span></div>
			<div>頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"> <?php echo $page."/".$totle_page?> </span></div>
			</td>
	</tr>
	<table width="100%" style="border-collapse:collapse;">
		<tr class="narrow">
			<td width="12%" style="text-align:left;">請購品號</td><td width="25%"style="text-align:left;">品名/規格</td><td width="5%">單位</td><td width="7%" style="border-right-style:solid;">請購數量</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td>
		</tr>
		<?php //foreach($page_data[$key] as $k=>$val){?>
		<tr>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-5]->TB004) echo $results[$page*5-5]->TB004?></td>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-5]->TB005) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-5]->TB005)."/".iconv("big-5","utf-8//IGNORE",$results[$page*5-5]->TB006)?></td>
			<?php //echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?>
			<td style="font-size: 10px;"><?php if(@$results[$page*5-5]->TB007) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-5]->TB007)?></td>
			<td style="border-right-style:solid; font-size: 10px;"><?php if (@$results[$page*5-5]->TB009) echo number_format($results[$page*5-5]->TB009,0)?></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		
		<tr>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-4]->TB004) echo $results[$page*5-4]->TB004?></td>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-4]->TB005) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-4]->TB005)."/".iconv("big-5","utf-8//IGNORE",$results[$page*5-4]->TB006)?></td>
			<?php //echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?>
			<td style="font-size: 10px;"><?php if(@$results[$page*5-4]->TB007) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-4]->TB007)?></td>
			<td style="border-right-style:solid; font-size: 10px;"><?php if (@$results[$page*5-4]->TB009) echo number_format($results[$page*5-4]->TB009,0)?></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		
		<tr>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-3]->TB004) echo $results[$page*5-3]->TB004?></td>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-3]->TB005) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-3]->TB005)."/".iconv("big-5","utf-8//IGNORE",$results[$page*5-3]->TB006)?></td>
			<?php //echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?>
			<td style="font-size: 10px;"><?php if(@$results[$page*5-3]->TB007) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-3]->TB007)?></td>
			<td style="border-right-style:solid; font-size: 10px;"><?php if (@$results[$page*5-3]->TB009) echo number_format($results[$page*5-3]->TB009,0)?></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		
		<tr>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-2]->TB004) echo $results[$page*5-2]->TB004?></td>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-2]->TB005) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-2]->TB005)."/".iconv("big-5","utf-8//IGNORE",$results[$page*5-2]->TB006)?></td>
			<?php //echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?>
			<td style="font-size: 10px;"><?php if(@$results[$page*5-2]->TB007) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-2]->TB007)?></td>
			<td style="border-right-style:solid; font-size: 10px;"><?php if (@$results[$page*5-2]->TB009) echo number_format($results[$page*5-2]->TB009,0)?></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		
		<tr>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-1]->TB004) echo $results[$page*5-1]->TB004?></td>
			<td style="text-align:left; font-size: 10px;"><?php if(@$results[$page*5-1]->TB005) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-1]->TB005)."/".iconv("big-5","utf-8//IGNORE",$results[$page*5-1]->TB006)?></td>
			<?php //echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?>
			<td style="font-size: 10px;"><?php if(@$results[$page*5-1]->TB007) echo iconv("big-5","utf-8//IGNORE",$results[$page*5-1]->TB007)?></td>
			<td style="border-right-style:solid; font-size: 10px;"><?php if (@$results[$page*5-1]->TB009) echo number_format($results[$page*5-1]->TB009,0)?></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		
		<?php //}?>
	</table>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td rowspan="2" width="2%" style="border-right-style:solid;">用途</br>說明</td>
			<td rowspan="2" width="35%" style="border-right-style:solid;" colspan="4"></td>
			<td rowspan="2" width="2%" style="border-right-style:solid;">請購核決</td>
			<td width="15%" style="height:20px;border-right-style:solid;">(副)總經理</td><td width="15%" style="height:20px;border-right-style:solid;">經理</td><td style="height:20px;">主辦</td>
		</tr>
		<tr>
			<td style="border-right-style:solid;height:20px;"></td><td style="border-right-style:solid;"></td><td></td><!--用途說明留白-->
		</tr>
		<tr class="narrow">
			<td colspan="5" style="height:20px;border-right-style:solid;">過&nbsp;&nbsp;去&nbsp;&nbsp;歷&nbsp;&nbsp;史&nbsp;&nbsp;資&nbsp;&nbsp;料</td><td width="3%"rowspan="4"style="border-right-style:solid;">採購意見</td><td class="td_nobot" style="text-align:left;height:40px;">1.擬向#</td><td class="td_nobot"></td><td class="td_nobot" style="text-align:left;">購買</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" width="7%" style="text-align:left;">進貨日期</td><td width="15%">廠商代號/廠牌</td><td>數量</td><td>單價</td><td class="td_nobot" style="text-align:left;height:40px;">2.訂購後</td><td class="td_nobot"></td><td class="td_nobot" style="text-align:left;">天交貨.&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日)</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" style="border-bottom-style:hidden; font-size: 10px; text-align:left;height:40px;"><?php if(@$results1[$page*5-5]->TH014) echo $results1[$page*5-5]->TH014?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-5]->TH014) echo iconv("big-5","utf-8//IGNORE",$results1[$page*5-5]->TG005)."/".iconv("big-5","utf-8//IGNORE",$results1[$page*5-5]->MA002)?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-5]->TH014) echo $results1[$page*5-5]->TH015?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-5]->TH014) echo $results1[$page*5-5]->TH018?></td>
			<td class="td_nobot" style="text-align:left;height:40px;">3.報價</td><td class="td_nobot">月</td><td class="td_nobot" style="text-align:left;">日有效</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" style="border-bottom-style:hidden; font-size: 10px; text-align:left;height:40px;"><?php if(@$results1[$page*5-4]->TH014) echo $results1[$page*5-4]->TH014?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-4]->TH014) echo iconv("big-5","utf-8//IGNORE",$results1[$page*5-4]->TG005)."/". iconv("big-5","utf-8//IGNORE",$results1[$page*5-4]->MA002)?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-4]->TH014) echo $results1[$page*5-4]->TH015?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-4]->TH014) echo $results1[$page*5-4]->TH018?></td>
			<td style="text-align:left;height:40px;">4.其他說明</td><td></td><td style="text-align:left;">5.分批進料:</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" style="border-bottom-style:hidden; font-size: 10px; text-align:left;height:40px;"><?php if(@$results1[$page*5-3]->TH014) echo $results1[$page*5-3]->TH014?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-3]->TH014) echo iconv("big-5","utf-8//IGNORE",$results1[$page*5-3]->TG005)."/".iconv("big-5","utf-8//IGNORE",$results1[$page*5-3]->MA002)?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-3]->TH014) echo $results1[$page*5-3]->TH015?></td>
			<td style="border-bottom-style:hidden;border-right-style:solid; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-3]->TH014) echo $results1[$page*5-3]->TH018?></td>
			<td rowspan="3" style="border-right-style:solid;height:40px;">呈核</td><td colspan="1" style="padding-left: 12px;border-right-style:solid;">總&nbsp;經&nbsp;理:</td><td colspan="1" style="border-right-style:solid;">經&nbsp;&nbsp;&nbsp;&nbsp;理:</td><td style="border-right-style:solid;">主辦:</td>
		</tr>
		<tr>
			<td colspan="2" style="border-bottom-style:hidden; font-size: 10px; text-align:left;height:40px;"><?php if(@$results1[$page*5-2]->TH014) echo $results1[$page*5-2]->TH014?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-2]->TH014) echo iconv("big-5","utf-8//IGNORE",$results1[$page*5-2]->TG005)."/".iconv("big-5","utf-8//IGNORE",$results1[$page*5-2]->MA002)?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-2]->TH014) echo $results1[$page*5-2]->TH015?></td>
			<td style="border-bottom-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-2]->TH014) echo $results1[$page*5-2]->TH018?></td>
			<td style="border-bottom-style:hidden;border-right-style:solid;height:40px;"></td>
			<td style="border-bottom-style:hidden;border-right-style:solid;height:40px;"></td>
			<td style="border-bottom-style:hidden;"></td>
		</tr>
		<tr>
			<td colspan="2" style="font-size: 10px; text-align:left;height:40px;"><?php if(@$results1[$page*5-1]->TH014) echo $results1[$page*5-1]->TH014?></td>
			<td style="font-size: 10px;height:40px;"><?php if(@$results1[$page*5-1]->TH014) echo iconv("big-5","utf-8//IGNORE",$results1[$page*5-1]->TG005)."/".iconv("big-5","utf-8//IGNORE",$results1[$page*5-1]->MA002)?></td>
			<td style="font-size: 10px;height:40px;"><?php if(@$results1[$page*5-1]->TH014) echo $results1[$page*5-1]->TH015?></td>
			<td style="border-right-style:hidden; font-size: 10px;height:40px;"><?php if(@$results1[$page*5-1]->TH014) echo $results1[$page*5-1]->TH018?></td>
			<td style="border-right-style:solid;height:40px;"></td>
			<td style="border-right-style:solid;height:40px;"></td>
			<td></td>
		</tr>
	</table>
<?php
	$page++;  //結束一頁
}
?>
</div>
</body>
</html>
