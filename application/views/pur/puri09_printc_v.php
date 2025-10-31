<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>進 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri09/printdetailc';location = url; </script> 
  <?php exit;} ?>
   <!--   頁直行數  -->
   <?php $paper9="1"; ?> 
<?php if($paper9=="1")  {$vaa=12; $vbb=$vaa-1;} else 
		  {$vaa=12; $vbb=$vaa-1;} ?>
<body onLoad="window.print()">
        <!-- 第一頁 -->
<?php  //處理資料
// echo "<pre>";var_dump($results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
$page = 0;//預設第一頁
$vtg002=''; //預設單號
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	if(($value->tg002)!=$vtg002 and $vtg002!=''){ $page++;   }
	   $vtg002=$value->tg002;
	
	$page_data[$page][] = $value;
	/*if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	} */
	
	$pur_date = substr($value->tg014,0,4).'/'.substr($value->tg014,4,2).'/'.substr($value->tg014,6,2);
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
 //echo "<pre>";var_dump($results[$vi]->tc002);exit;
foreach($page_data as $key=>$value){
?>       
	 <?php  $totalp=ceil($results[$vi]->vcount/$vaa);  ?>		
	 <!-- 開始列印 -->		 
		<table class="store">
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml003'); ?> <br>
			<?php echo $this->session->userdata('sysml012'); ?><br>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">進  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>進貨單號：</b><span><?php echo $results[$vi]->tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->tg014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[$vi]->tg016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商單號：</b><span><?php echo $results[$vi]->tg006 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $results[$vi]->tg005.' '.$results[$vi]->tg005disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
					  <td align="left" width="8%"><b>品號</b><br><b>單位</b></td>
					  <td align="left" width="22%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="8%"><b>採購單號</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單位進價</b><br><b>進貨金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>庫別</b></td>
					</tr>
					 <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><?php echo $val->th004;?><br><?php echo $val->th008;?></td>
					  <td align="left"><?php echo $val->th005;?><br><?php echo $val->th006;?></td>
					  <td align="right"><?php echo $val->th012;?><br><?php echo $val->th007;?></td>
					  <td align="right"><?php echo $val->th018;?><br><?php echo $val->th019;?></td>
					  <td align="right"><?php echo $val->th033;?><br><?php echo $val->th009;?></td>
					 		 
					</tr>
					 <?php $rownum++;$rownum1++;$vi++;$vii++;$totalp=ceil($val->vcount/$vaa); ?>
					
						<?php if ($page == $page1  and  ($rownum1 >=$vaa ) ) { ?>
					<?php $rownum1=0;} ?>
					
				  <!--同一單據有2張以上         -->
					<?php if (    ($vii >=$vaa ) ) { ?>
					<tr>
					  <td colspan="5" align="left">
						<b>數量合計：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;進貨金額：<?php echo '' ?></b>
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
						 <?php for ($i=$vii; $i<13; $i++) { ?>
					
					<?php } ?>
		  
		  <!-- 第二頁 -->
					
		  <table class="store">
			<tr>
			  <td class="logo" align="center" valign="top">
				<?php echo $this->session->userdata('sysml003'); ?> <br>
				<?php echo $this->session->userdata('sysml012'); ?><br>
				<?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
				<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			  </td>
			</tr>
			<tr><td class="title" align="center" valign="top">進  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>進貨單號：</b><span><?php echo $results[$vi]->tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->tg014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[$vi]->tg016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商單號：</b><span><?php echo $results[$vi]->tg006 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $results[$vi]->tg005.' '.$results[$vi]->tg005disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
			
			
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="15%"><b>品號</b><br><b>品名</b></td>
					  <td align="center" width="15%"><b>規格</b><br><b>單位</b></td>
					  <td align="right" width="8%"><b>採購單號</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單位進價</b><br><b>進貨金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>庫別</b></td>
					</tr>
					   <?php $rownum1=0;$vii=0;} ?> 
					<?php  } ?>
					
					<?php if (($page == $page1)  and  ($rownum1 <=$vaa )  )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					</tr>
					<?php } ?> <?php } ?>   
					
						<?php if (($totle_page < $page) and ($totle_page>=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>		 
					</tr>
					<?php } ?> <?php } ?>   
					<tr>
					  <td colspan="5" align="left">
					     <?php if ($totle_page >= $page  ) { ?>
						<b>數量合計：<?php echo $results[$vi-1]->tg026 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;進貨金額：<?php echo $results[$vi-1]->tg028 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $results[$vi-1]->tg019 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $results[$vi-1]->tg028+$results[$vi-1]->tg019 ?></b> <?php } ?> 
					
					    <?php if ($totle_page < $page ) { ?>
						<b>數量合計：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;採購金額：<?php echo '' ?></b>
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
		   <?php if($paper9=="1")  {$vaa=12; $vbb=$vaa-1;} else 
		  {$vaa=12; $vbb=$vaa-1;} ?>	
		 <?php $page++;$page1++;$vii=0; }
		 ?> 
</body>
</html>
