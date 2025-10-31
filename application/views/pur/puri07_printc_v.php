<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>採 購 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri07/printdetailc';location = url; </script> 
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
$vtc002=''; //預設單號
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	if(($value->tc002)!=$vtc002 and $vtc002!=''){ $page++;   }
	   $vtc002=$value->tc002;
	
	$page_data[$page][] = $value;
	/*if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	} */
	
	$pur_date = substr($value->tc024,0,4).'/'.substr($value->tc024,4,2).'/'.substr($value->tc024,6,2);
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
		  
			<tr><td class="title" align="center" valign="top">採  購  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>採購單號：</b><span><?php echo $results[$vi]->tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->tc024 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $results[$vi]->tc004.' '.$results[$vi]->tc004disp; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $results[$vi]->tc004disp2; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商電話：</b><?php echo $results[$vi]->tc004disp3; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $results[$vi]->tc007; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商地址：</b><?php echo $results[$vi]->tc004disp1; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $results[$vi]->tc004disp5; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><span><?php echo $results[$vi]->tc005.' '.$results[$vi]->tc005disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $results[$vi]->tc018 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>採購人員：</b><?php echo $results[$vi]->tc011.' '.$results[$vi]->tc011disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>滙    率：</b><?php echo $results[$vi]->tc006; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商傳真：</b><?php echo $results[$vi]->tc004disp4 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠別代號：</b><?php echo $results[$vi]->tc010.' '.$results[$vi]->tc010disp;  ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[$vi]->tc027.' '.$results[$vi]->tc027disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>營業稅率：</b><?php echo $results[$vi]->tc026 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連輸方式：</b><?php echo $results[$vi]->tc017 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備    註：</b><?php echo $results[$vi]->tc009 ?></td>
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
					  <td align="center" width="25%" ><b>品號</b><br><b>品名</b><br><b>規格</b></td>
					  <td align="center" width="14%" ><b>採購數量</b><br><b>已交數量</b><br><b>結案碼</b></td>
					  <td align="center" width="14%"><b>單位</b><br><b>小單位</b><br><b></b></td>
					  <td align="right" width="14%"><b>交貨庫別</b><br><b>採購單價</b><br><b>採購金額</b></td>
					  <td align="right" width="14%"><b>預 交 日</b><br><b>參考單別</b><br><b>參考單號</b></td>
					  <td align="right" width="14%"><b>專案代號</b><br><b>備註</b><br><b>廠商品號</b></td>
					  <td align="right" width="5%"><b>急料</b><br><br></td>
					</tr>
					 <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><?php echo $val->td004;?><br><?php echo $val->td005;?><br><?php echo $val->td006;?></td>
					  <td align="right"><?php echo $val->td008;?><br><?php echo $val->td015;?><br><?php echo $val->td016;?></td>
					  <td align="left"><?php echo $val->td009;?><br><?php echo $val->td020;?><br></td>
					  <td align="right"><?php echo $val->td027;?><br><?php echo $val->td010;?><br><?php echo $val->td011;?></td>
					  <td align="right"><?php echo $val->td012;?><br><?php echo $val->td013;?><br><?php echo $val->td021;?></td>
					  <td align="right"><?php echo $val->td022;?><br><?php echo $val->td014;?><br><?php echo $val->td017disp;?></td>
					  <td align="right"><?php echo $val->td025;?></td>					 
					</tr>
					    <?php $rownum++;$rownum1++;$vi++;$vii++;$totalp=ceil($val->vcount/$vaa); ?>
					
						<?php if ($page == $page1  and  ($rownum1 >=$vaa ) ) { ?>
					<?php $rownum1=0;} ?>
					
				  <!--同一單據有2張以上         -->
					<?php if (    ($vii >=$vaa ) ) { ?>
					<tr>
					  <td colspan="7" align="left">
						<b>數量合計：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;採購金額：<?php echo '' ?></b>
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
		  <!-- 開始列印 -->		
	 <table class="store" width="100%">
			<tr>
			  <td class="logo" align="center" valign="top">
				<?php echo $this->session->userdata('sysml003'); ?> <br>
				<?php echo $this->session->userdata('sysml012'); ?><br>
				<?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
				<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			  </td>
			</tr>
			<tr><td class="title" align="center" valign="top">採  購  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>採購單號：</b><span><?php echo $results[$vi]->tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->tc024 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $results[$vi]->tc004.' '.$results[$vi]->tc004disp; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $results[$vi]->tc004disp2; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商電話：</b><?php echo $results[$vi]->tc004disp3; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $results[$vi]->tc007; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商地址：</b><?php echo $results[$vi]->tc004disp1; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $results[$vi]->tc004disp5; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><span><?php echo $results[$vi]->tc005.' '.$results[$vi]->tc005disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $results[$vi]->tc018 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>採購人員：</b><?php echo $results[$vi]->tc011.' '.$results[$vi]->tc011disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>滙    率：</b><?php echo $results[$vi]->tc006; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商傳真：</b><?php echo $results[$vi]->tc004disp4 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠別代號：</b><?php echo $results[$vi]->tc010.' '.$results[$vi]->tc010disp;  ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[$vi]->tc027.' '.$results[$vi]->tc027disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>營業稅率：</b><?php echo $results[$vi]->tc026 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連輸方式：</b><?php echo $results[$vi]->tc017 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備    註：</b><?php echo $results[$vi]->tc009 ?></td>
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
					  <td align="center" width="25%" ><b>品號</b><br><b>品名</b><br><b>規格</b></td>
					  <td align="center" width="14%" ><b>採購數量</b><br><b>已交數量</b><br><b>結案碼</b></td>
					  <td align="center" width="14%"><b>單位</b><br><b>小單位</b><br><b></b></td>
					  <td align="right" width="14%"><b>交貨庫別</b><br><b>採購單價</b><br><b>採購金額</b></td>
					  <td align="right" width="14%"><b>預 交 日</b><br><b>參考單別</b><br><b>參考單號</b></td>
					  <td align="right" width="14%"><b>專案代號</b><br><b>備註</b><br><b>廠商品號</b></td>
					  <td align="right" width="5%"><b>急料</b><br><br></td>
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
					  <td align="right">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td> 
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
					  <td align="right">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>			 
					</tr>
					<?php } ?> <?php } ?>   
					<tr>
					  <td colspan="7" align="left">
					     <?php if ($totle_page >= $page  ) { ?>
						<b>數量合計：<?php echo $results[$vi-1]->tc023 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;採購金額：<?php echo $results[$vi-1]->tc019 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $results[$vi-1]->tc020 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $results[$vi-1]->tc019+$results[$vi-1]->tc020 ?></b> <?php } ?> 
					
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
