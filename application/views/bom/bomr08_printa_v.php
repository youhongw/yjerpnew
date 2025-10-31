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
<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/bom/bomr08/printdetail';location = url; </script> 
  <?php exit;} ?>
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/bom/bomr08/printdetail';location = url; </script> 
 <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
<?php  //處理資料
//echo var_dump($results1);exit;  //印出來看歷史價格
$page = 1;//預設第一頁
$page_limit = 19;//每頁筆數
$page_data1;//先依page_limit分類資料裝入變數
$getDate= date("Y-m-d");//今天日期

foreach($results1 as $key1=>$value1){
	$page_data1[$page][] = $value1;
	if($key1%19==18){
		if(@$results1[$page*19]){
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
foreach($page_data1 as $key1=>$value1){
?>
	<div id="top_div" name="top_div">
		<div style="text-align:center;"><font size="4"><b><?php echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?></b></font></div>
	<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
		<div style="text-align:center;"><font size="5">多&nbsp階&nbsp標&nbsp準&nbsp成&nbsp本&nbsp表</font></div>
		<br>
	</div>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="text-align:left;width:30%;">
			<!--單別/單號 : <span><?php// echo $results[0]->TA001."/".$results[0]->TA002?></span>-->
			</td>
			<td style="text-align:center;width:40%;"></td>
			<td style="text-align:right;width:30%;">
			<div>日&nbsp;&nbsp;&nbsp;&nbsp;期 : <span id="pur_date" name="pur_date"> <?php echo $getDate ?></span></div>
			<div>頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"> <?php echo $page."/".$totle_page?> </span></div>
			</td>
	</tr>
	<table width="100%" style="border-collapse:collapse;">
		<tr class="narrow">
			<td width="10%" style="font-size: 10pt;text-align:left;">主件品號</td>
			<td width="3%"style="font-size: 10pt;text-align:left;">階次</td>
			<td width="20%"style="font-size: 10pt;">元件品號<br>品名<br>規格</td>
			<td width="7%" style="font-size: 10pt;text-align:left;">單位<br>小單位</td>
			<td width="6%" style="font-size: 10pt;text-align:left;">屬性</td>
			<td width="8%" style="font-size: 10pt;text-align:left;">標準批量<br>標準用量</td>
			<td width="8%" style="font-size: 10pt;text-align:left;">標準材料</td>
			<td width="10%" style="font-size: 10pt;text-align:left;">標準人工<br>本階人工</td>
			<td width="10%" style="font-size: 10pt;text-align:left;">標準製費<br>本階製費</td>
			<td width="10%" style="font-size: 10pt;text-align:left;">標準加工<br>本階加工</td>
			<td width="15%" style="font-size: 10pt;text-align:left;">標準成本<br>本階成本</td>
			
		</tr>
		<tr>
		<?php foreach($page_data1[$key1] as $k1=>$val1){?>
			<td style="text-align:left; font-size: 10px;"><?php if(@$val1->DP == '0') echo $results1[0]->MD001?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo $val1->DP?></td>
			<td style="text-align:center; font-size: 10px;"><?php if(@$val1->MD001 != $val1->MD003) echo $val1->MD003?>
				<br><?php echo iconv("big-5","utf-8//IGNORE",$val1->MB002)?>
				<br><?php echo iconv("big-5","utf-8//IGNORE",$val1->MB003)?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo $results1[0]->MB004?>
				<br><?php echo $val1->MD005?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo iconv("big-5","utf-8//IGNORE",$val1->MB025)?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo number_format($val1->MD007,4)?>
				<br><?php echo number_format($val1->MD006,4)?></td>		
			<td style="text-align:left; font-size: 10px;"><?php echo number_format($val1->MB057,4)?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo number_format($val1->MB058,4)?>
				<br><?php echo number_format($val1->MB061,4)?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo number_format($val1->MB059,4)?>
				<br><?php echo number_format($val1->MB062,4)?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo number_format($val1->MB060,4)?>
				<br><?php echo number_format($val1->MB063,4)?></td>
			<td style="text-align:left; font-size: 10px;"><?php echo number_format($val1->MB064,4)?>
				<br><?php echo number_format($val1->MB065,4)?></td>
		</tr>
		<?php }?>
		
		
		<?php //}?>
	</table>
	
	<br><br>
<?php
	$page++;  //結束一頁
}
?>

</body>
</html>
