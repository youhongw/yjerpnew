<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<style>
#title{
	text-align: right !important;
}
</style>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>銷 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi08/printdetailc';location = url; </script> 
  <?php exit;} ?>
<body onLoad="window.print()">
    <!-- 公司抬頭 -->
<?php foreach($results1 as $row ) : ?>
		    <!-- //公司簡稱 公司全稱 電話 傳真 地址 E-MAIL 備註 -->
			 <?php  $ml002sys[]=$row->ml002;  ?>
			 <?php $ml003sys[]=$row->ml003;   ?>
			 <?php $ml005sys[]=$row->ml005;  ?>
			 <?php $ml006sys[]=$row->ml006;   ?>
			 <?php $ml012sys[]=$row->ml012;  ?> 
			 <?php $ml010sys[]=$row->ml010;   ?> 
			 <?php $ml011sys[]=$row->ml011;   ?> 
        <?php endforeach;?>
		     <?php    $vsysml002=$ml002sys[0];  ?>
			 <?php    $vsysml003=$ml003sys[0];  ?>
		     <?php    $vsysml005=$ml005sys[0];  ?>
			 <?php    $vsysml006=$ml006sys[0];  ?>
			 <?php    $vsysml012=$ml012sys[0];  ?>
			 <?php    $vsysml010=$ml010sys[0];  ?>
			 <?php    $vsysml011=$ml011sys[0];  ?>
       <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
$page = 1;//預設第一頁
$page_limit = 8;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數

foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%8==7){
		if(@$results[$page*8]){
			$page++;
		}
	}
	$pur_date = substr($value->tg042,0,4).'/'.substr($value->tg042,4,2).'/'.substr($value->tg042,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
$item_number = 0;
$sum_th008 = 0;
$sum_th012 = 0;
$sum_th013 = 0;
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->		
			
		<table class="store">
			<tr><td class="title" align="right" valign="center" id="title" style="font-size:22px"><b>銷貨單</b></td></tr>
		</table>
		<table class="store">
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="100%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="33%" align="left" valign="center" style="font-size:14px"><b>製表日期：<span><?php echo date("Y/m/d") ?></span></b></td>
							  <td width="34%" align="center" valign="center" style="font-size:14px"><b>單號：<span><?php echo $results[0]->tg002;?></span></b></td>
							  <td width="33%" align="right" valign="center" style="font-size:14px"><b><span>DR21-04-00-02</span></b></td>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
			
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="12.5%" colspan="2"><b>客戶名稱：</b></td>
					  <td align="center" width="12.5%" colspan="2"><b><?php echo $results[0]->tg004disp;?></b></td>
					  <td align="center" width="12.5%" colspan="2"><b>送貨地址：</b></td>
					  <td align="center" width="12.5%" colspan="2"><b><?php echo $results[0]->tg008;?></b></td>
					</tr>

					<tr class="heading">
					  <td align="left" width="4%"><b>序號</b></td>
					  <td align="center" width="10%"><b>品號</b></td>
					  <td align="center" width="21%"><b>品名</b></td>
					  <td align="center" width="21%"><b>規格</b></td>
					  <td align="center" width="8%"><b>數量</b></td>
					  <td align="center" width="8%"><b>單價</b></td>
					  <td align="center" width="8%"><b>金額</b></td>
					  <td align="center" width="20%"><b>備註</b></td>
					</tr>
					  <?php  $rownum=7;$rownum1=0;$rownum2=8;  ?>
					  <?php //for ($i=1; $i<=$pagerownow; $i++) { ?>
					  <?php foreach($page_data[$key] as $k=>$val){ 
						$item_number ++;
						$sum_th008 += $val->th008;
						$sum_th012 += $val->th012;
						$sum_th013 += $val->th013;
					  
					  
					  ?>
					<tr>					 
					  <td align="left"><? echo $item_number;?></td>
					  <td align="center"><? echo $val->th004;?></td>
					  <td align="center"><? echo $val->th005;?></td>
					  <td align="center"><? echo $val->th006;?></td>
					  <td align="center"><? echo $val->th008;?></td>
					  <td align="center"><? echo $val->th012;?></td>
					  <td align="center"><? echo $val->th013;?></td>
					  <td align="center"><? echo $val->th018;?></td>
					</tr>
					<?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=8 ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>  
					
					<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=8 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					<?php } ?> <?php } ?>   
					
			      <?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=8 ) )  { ?>
				        <?php  for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					<?php  } ?> <?php } ?>    
					
					<tr>
					<?php if ($totle_page == $page && $tprint=='Y') { 
						echo "<td align='left'>合計</td><td></td><td></td><td></td><td align='center'>".$sum_th008."</td><td align='center'>".$sum_th012."</td><td align='center'>".$sum_th013."</td><td></td>";
					}else if($totle_page > $page && $tprint=='Y'){
						echo "<td align='left'>合計</td><td></td><td></td><td></td><td></td><td></td><td></td><td>接下頁..</td>";
					}
					?>
					
					  
					  <!--<td colspan="7" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $results[0]->tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $results[0]->tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $results[0]->tg045+$results[0]->tg046;} ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>-->
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
			<tr>
			  <td width="250" align="left"><b>客戶簽收：</b></td>
			  <td width="250" align="left"><b>審核：</b></td>
			  <td width="250" align="left"><b>品管：</b></td>
			  <td width="250" align="left"><b>倉庫：</b></td>
			  <td width="250" align="left"><b>製表：</b></td>
			</tr>
		  </table>
		  
		  <div style="page-break-before: always;"></div>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php $page++; } ?> 
		
</body>
</html>
