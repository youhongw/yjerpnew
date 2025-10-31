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
<?php if($paper9=="1")  {$vaa=5; $vbb=$vaa-1;} else 
		  {$vaa=5; $vbb=$vaa-1;} ?>	
<body onLoad="window.print()">
 
       <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
$page = 0;//預設第一頁
$vta002=''; //預設單號
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	if(($value->ta002)!=$vta002 and $vta002!=''){ $page++;   }
	   $vta002=$value->ta002;
	
	$page_data[$page][] = $value;
	/*if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	} */
	
	$pur_date = substr($value->ta003,0,4).'/'.substr($value->ta003,4,2).'/'.substr($value->ta003,6,2);
}

$totle_page = $page+1;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$vi=0;$vii=0;  //總筆數單張筆數
$page = 1;//第一頁開始 單據筆數
$page1= 1;
$total=1;
$totalp=1;
foreach($page_data as $key=>$value){
?>       
	 <?php  $totalp=ceil($results[$vi]->vcount/$vaa);  ?>		
	 <!-- 開始列印 -->		
	 <table class="store">
		<tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml012'); ?><br>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">報  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單別：</b><span><?php echo $results[$vi]->ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $results[$vi]->ta007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $results[$vi]->ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單號：</b><?php echo $results[$vi]->ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							   <?php if ($results[0]->ta022=='1') {$ta022disp='應稅內含';}
							   else if ($results[0]->ta022=='2') {$ta022disp='應稅外加';} else {$ta022disp='不計稅';} ?>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $results[$vi]->ta022.' '.$ta022disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交 貨 日：</b><?php echo '訂貨日起 '.$results[$vi]->ta014.' 日內' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[$vi]->ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $results[$vi]->ta004.' '.$results[$vi]->ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $results[$vi]->ta010 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo '1'.'/'.$totalp ?></td>
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
					  <td align="left" ><? echo $val->tb004;?></td>
					  <td align="left" ><? echo $val->tb005;?><br><? echo $val->tb006;?></td>
					  <td align="right" ><? echo $val->tb007;?><br><? echo $val->tb009;?></td>
					   <td align="right" ><? echo $val->tb008;?><br><? echo $val->tb010;?></td>
					  <td align="left" ><? echo $val->tb016;?><br><? echo $val->tb017;?></td>
					  <td align="left" ><? echo $val->tb012;?></td>					 
					</tr>
					   <?php $rownum++;$rownum1++;$vi++;$vii++;$totalp=ceil($val->vcount/$vaa); ?>
					
						<?php if ($page == $page1  and  ($rownum1 >=$vaa ) ) { ?>
					<?php $rownum1=0;} ?>
					
				  <!--同一單據有2張以上         -->
					<?php if (    ($vii >=$vaa ) ) { ?>
					<tr>
					  <td colspan="6" align="left">
						<b>數量合計：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo '' ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：</b> 
					         <?php echo '續下頁..'; ?> 
					  </td>
					</tr>
			<table >
			<tr>
			  <td width="300" align="left"><b></b></td>
			</tr>
			<tr>
			  <td width="300" align="left"><b></b></td>
			</tr>
			<tr>
			  <td width="300" align="left"><b></b></td>
			</tr>
			<tr>
			  <td width="300" align="left"><b>報  准：</b></td>
			  <td width="300" align="left"><b>審  報：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
					     <div style="page-break-before: always;"></div> 
						<!--  <P style='page-break-after:always'></P> -->
						 <?php $vii++;$total++; ?>
						 <?php for ($i=$vii; $i<6; $i++) { ?>
					<!--	 <table class="product" border=0 cellspacing=0 cellpadding=0> 
					<tr >					 
					 <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>	 
					</tr>
					</table> -->
					<?php } ?>
						
						
						  <!-- 開始列印 -->		
	 <table class="store" width="100%">
		<tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml012'); ?><br>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">報  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單別：</b><span><?php echo $results[$vi]->ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $results[$vi]->ta007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $results[$vi]->ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單號：</b><?php echo $results[$vi]->ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							   <?php if ($results[0]->ta022=='1') {$ta022disp='應稅內含';}
							   else if ($results[0]->ta022=='2') {$ta022disp='應稅外加';} else {$ta022disp='不計稅';} ?>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $results[$vi]->ta022.' '.$ta022disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交 貨 日：</b><?php echo '訂貨日起 '.$results[$vi]->ta014.' 日內' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[$vi]->ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $results[$vi]->ta004.' '.$results[$vi]->ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $results[$vi]->ta010 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $total.'/'.$totalp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
				</table>
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="10%"><b>數量</b><br><b>單價</b></td>
					   <td align="right" width="10%"><b>單位</b><br><b>金額</b></td>
					  <td align="left" width="10%"><b>生效日</b><br><b>失效日</b></td>
					  <td align="left" width="25%"><b>備註</b></td>
					</tr>
					
				
						  
					<?php $rownum1=0;$vii=0;} ?> 
					<?php  } ?>
					
					<?php if (($page == $page1)  and  ($rownum1 <=$vaa )  )  { ?>
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
					
						<?php if (($totle_page < $page) and ($totle_page>=1) and  ($rownum1 <=$vaa ) )  { ?>
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
					     <?php if ($totle_page >= $page  ) { ?>
						<b>數量合計：<?php echo $results[$vi-1]->ta025 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo $results[$vi-1]->ta009 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $results[$vi-1]->ta023 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $results[$vi-1]->ta009+$results[$vi-1]->ta023 ?></b> <?php } ?> 
					
					    <?php if ($totle_page < $page ) { ?>
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
		   <?php if($paper9=="1")  {$vaa=5; $vbb=$vaa-1;} else 
		  {$vaa=5; $vbb=$vaa-1;} ?>	
		 <?php $page++;$page1++;$vii=0; }
		 ?> 
		
</body>
</html>
