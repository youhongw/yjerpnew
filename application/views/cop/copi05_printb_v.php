<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>報 價 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi05/printdetailc';location = url; </script> 
 <?php exit;} ?>
  <!--   頁直行數  -->
   <?php $paper9="1"; ?> 
<?php if($paper9=="1")  {$vaa=14; $vbb=$vaa-1;} else 
		  {$vaa=6; $vbb=$vaa-1;} ?>	
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
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	}
	$pur_date = substr($value->ta003,0,4).'/'.substr($value->ta003,4,2).'/'.substr($value->ta003,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->		
	 <table class="store">
		 <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">報  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單別：</b><span><?php echo $results[0]->ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[0]->ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $results[0]->ta007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $results[0]->ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單號：</b><?php echo $results[0]->ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							   <?php if ($results[0]->ta022=='1') {$ta022disp='應稅內含';}
							   else if ($results[0]->ta022=='2') {$ta022disp='應稅外加';} else {$ta022disp='不計稅';} ?>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $results[0]->ta022.' '.$ta022disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交 貨 日：</b><?php echo '訂貨日起 '.$results[0]->ta014.' 日內' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[0]->ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $results[0]->ta004.' '.$results[0]->ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $results[0]->ta010 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $page."/".$totle_page ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
			
			
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="10%"><b>數量</b><br><b>單價</b></td>
					   <td align="right" width="10%"><b>單位</b><br><b>金額</b></td>
					  <td align="left" width="10%"><b>生效日</b><br><b>失效日</b></td>
					  <td align="left" width="25%"><b>備註</b></td>
					</tr>
					  <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><? echo $val->tb004;?></td>
					  <td align="left"><? echo $val->tb005;?><br><? echo $val->tb006;?></td>
					  <td align="right"><? echo $val->tb007;?><br><? echo $val->tb009;?></td>
					   <td align="right"><? echo $val->tb008;?><br><? echo $val->tb010;?></td>
					  <td align="left"><? echo $val->tb016;?><br><? echo $val->tb017;?></td>
					  <td align="left"><? echo $val->tb012;?></td>					 
					</tr>
					   <?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<?php } ?> <?php } ?> 
					
					<?php  } ?>
					
					<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>	 
					</tr>
					<?php } ?> <?php } ?>   
					
						<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>			 
					</tr>
					<?php } ?> <?php } ?>   
					<tr>
					  <td colspan="6" align="left">
					     <?php if ($totle_page == $page  ) { ?>
						<b>數量合計：<?php echo $results[0]->ta025 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo $results[0]->ta009 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $results[0]->ta023 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $results[0]->ta009+$results[0]->ta023 ?></b> <?php } ?> 
					
					    <?php if ($totle_page > $page ) { ?>
						<b>數量合計：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo '' ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：</b> 
					         <?php echo '續下頁..';} ?> 
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		 <br>
		  <table >
			<tr>
			  <td width="300" align="left"><b>報  准：</b></td>
			  <td width="300" align="left"><b>審  報：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		   <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
		
</body>
</html>
