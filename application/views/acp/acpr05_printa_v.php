<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<!--<title>請 購 單</title> -->
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
<?php if (!$results1)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/acp/acpr05/printdetail';location = url; </script> 
  <?php exit;} ?>
</head>
 <?php if (!$results1)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/acp/acpr05/printdetail';location = url; </script> 
 <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
<?php  //處理資料
//echo var_dump($results1);exit;  //印出來看歷史價格
$page = 1;//預設第一頁
$page_limit = 15;//每頁筆數
$page_data1;//先依page_limit分類資料裝入變數
$getDate= date("Y-m-d");//今天日期
$i = 0;

foreach($results1 as $key1=>$value1){
	$page_data1[$page][] = $value1;
	if($key1%15==14){
		if(@$results1[$page*15]){
			$page++;
		}
	}
	//$pur_date = substr($value->TA003,0,4).'/'.substr($value->TA003,4,2).'/'.substr($value->TA003,6,2);
}

$totle_page = $page;
//var_dump($page_data1[$page]);exit;
?>

	<div id="top_div" name="top_div">
	<!--	<div style="text-align:center;"><font size="4"><b><?php echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?></b></font></div>
	<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
	<!--	<div style="text-align:center;"><font size="4">應&nbsp付&nbsp帳&nbsp款&nbsp明&nbsp細&nbsp表</font></div>-->
	</div>
	
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data1 as $key1=>$value1){
?>
	<div id="top_div" name="top_div">
		<div style="text-align:center;"><font size="4"><b><?php echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?></b></font></div>
	<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
		<div style="text-align:center;"><font size="4">應&nbsp付&nbsp帳&nbsp款&nbsp明&nbsp細&nbsp表</font></div>
	<!--	</font><div style="text-align:center;"><font size="3">期間<?php echo substr($results[0]->dateo,0,4)-1911 ."/".substr($results[0]->dateo,5,2)."/".substr($results[0]->dateo,8,2)?><?php echo "至"?> <?php echo substr($results[0]->datec,0,4)-1911 ."/".substr($results[0]->datec,5,2)."/".substr($results[0]->datec,8,2)?></font></div>-->
	</div>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="text-align:left;width:30%;">製表日期 : <?php echo $getDate ?></td>
			<td style="text-align:center;width:40%;"><font size="3">期間<?php echo substr($results[0]->dateo,0,4)-1911 ."/".substr($results[0]->dateo,5,2)."/".substr($results[0]->dateo,8,2)?><?php echo "至"?> <?php echo substr($results[0]->datec,0,4)-1911 ."/".substr($results[0]->datec,5,2)."/".substr($results[0]->datec,8,2)?></font></td>
			<td style="text-align:right;width:90%;">頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"> <?php echo $page."/".$totle_page?></span></td>
			<!--單別/單號 : <span><?php// echo $results[0]->TA001."/".$results[0]->TA002?></span>-->
			</td>
			<td style="text-align:center;width:40%;"></td>
			<td style="text-align:right;width:30%;">
			<!--<div>頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"> <?php echo $page."/".$totle_page?></span></div>-->
			<!--<div>頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"> <?php echo $page."/".$totle_page?> </span></div>-->
			</td>
	</tr>
	<table width="100%" style="border-collapse:collapse;">
		<tr class="narrow">
			<td width="6%" style="font-size: 10pt;text-align:left;">廠商代號<br>日期</td>
			<td width="8%"style="font-size: 10pt;text-align:left;">廠商名稱<br>原幣應付帳款</td>
			<td width="6%"style="font-size: 10pt;text-align:left;">憑證日期</td>
			<td width="10%" style="font-size: 10pt;text-align:left;">憑證號碼</td>
			<td width="20%" style="font-size: 10pt;text-align:left;">品名<br>規格</td>
			<td width="10%" style="font-size: 10pt;text-align:left;">數量</td>
			<td width="6%" style="font-size: 10pt;text-align:left;">單位</td>
			<td width="6%" style="font-size: 10pt;text-align:left;">單價</td>
			<td width="6%" style="font-size: 10pt;text-align:left;">金額</td>

			
		</tr>
		<tr>
		<?php foreach($page_data1[$key1] as $k1=>$val1){?>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php if($i == 0 || $results1[$i]->TA002 !== $results1[$i-1]->TA002) echo $results1[$i]->TA004?>
				<br><?php if($i == 0 || $results1[$i]->TA002 !== $results1[$i-1]->TA002) echo substr($results1[$i]->TA003,0,4)-1911 ."/".substr($results1[$i]->TA003,4,2)."/".substr($results1[$i]->TA003,6,2)?></td>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php if($i == 0 || $results1[$i]->TA002 !== $results1[$i-1]->TA002) echo iconv("big-5","utf-8//IGNORE",$results1[$i]->MA002)?>
				<br><?php if($i == 0 || $results1[$i]->TA002 !== $results1[$i-1]->TA002) echo number_format($results1[$i]->TA028,0)?></td>	
			<td style="text-align:center; font-size: 10px;text-align:left;"><?php echo substr($results1[$i]->TB008,0,4)-1911 ."/".substr($results1[$i]->TB008,4,2)."/".substr($results1[$i]->TB008,6,2)?>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php echo $results1[$i]->TB005 ."-". $results1[$i]->TB006 ."-".$results1[$i]->TB007 ?></td>
			<td style="text-align:left; font-size: 7px;text-align:left;"><?php echo iconv("big-5","utf-8//IGNORE",$val1->TH005)?>
				<br><?php echo iconv("big-5","utf-8//IGNORE",$val1->TH006)?></td>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php echo number_format($val1->TH007,2)?></td>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php echo $val1->TH008?></td>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php echo number_format($val1->TH018,3)?></td>
			<td style="text-align:left; font-size: 10px;text-align:left;"><?php echo number_format($val1->TH019,2)?></td>
			
		</tr>
		<?php $i++;}?>
		
		
		<?php //}?>
	</table>
	
<?php
	$page++;  //結束一頁
}
?>
	<table width="100%" >
		<tr><td width="25%" style="font-size: 10pt;text-align:left;">前期結欠： <?php echo number_format($results[0]->TA028,2)?>&nbsp&nbsp&nbsp&nbsp<?php echo $results[0]->CNT?>   筆</td>
		<td width="25%"style="font-size: 10pt;text-align:left;">本期應付： <?php echo number_format($results[0]->TA0281,2)?>&nbsp&nbsp&nbsp&nbsp<?php echo $results[0]->CNT1?>　筆</td></tr>
		<tr><td width="25%"style="font-size: 10pt;text-align:left;">本期已付： <?php echo number_format($results[0]->TA030,2)?></td>
		<?PHP $TA0281 = $results[0]->TA0281;$TA030 = $results[0]->TA030 ?>
		<td width="25%" style="font-size: 10pt;text-align:left;">總應付：<?php echo number_format(INTVAL($results[0]->TA028),2)+ $TA0281-$TA030?>  </td></tr>
	</table>
		
					

</body>
</html>
