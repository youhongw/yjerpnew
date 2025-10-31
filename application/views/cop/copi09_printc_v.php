<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>銷 退 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi09/printdetailc';location = url; </script> 
 <?php exit;} ?>
  <!--   頁直行數  -->
   <?php $paper9="1"; ?> 
<?php if($paper9=="1")  {$vaa=7; $vbb=$vaa-1;} else 
		  {$vaa=7; $vbb=$vaa-1;} ?>	
<body onLoad="window.print()">
 
       <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
$page = 0;//預設第一頁
$vti002=''; //預設單號
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	if(($value->ti002)!=$vti002 and $vti002!=''){ $page++;   }
	   $vti002=$value->ti002;
	
	$page_data[$page][] = $value;
	/*if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	} */
	
	$pur_date = substr($value->ti034,0,4).'/'.substr($value->ti034,4,2).'/'.substr($value->ti034,6,2);
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
		  
			<tr><td class="title" align="center" valign="top">銷 退 單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷退單號：</b><span><?php echo $results[$vi]->ti002 ?></span></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->ti034 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" colspan="2" valign="top"><b>部門：</b><?php echo $results[$vi]->ti005.' '.$results[$vi]->ti005disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" colspan="2" valign="top"><b>備註：</b><?php echo $results[$vi]->ti020 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $results[$vi]->ti004.' '.$results[$vi]->ti004disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							 
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[$vi]->ti039.' '.$results[$vi]->ti039disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $results[$vi]->ti006.' '.$results[$vi]->ti006disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b<?php echo $results[$vi]->ti004disp3  ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $results[$vi]->ti004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $results[$vi]->ti004disp2 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left"  valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
					  <td align="center" width="15%"><b>品號</b><br><b>品名</b></td>
					  <td align="center" width="15%"><b>規格</b><br><b>單位</b></td>
					  <td align="right" width="8%"><b>庫別</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單價</b><br><b>金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>毛重</b></td>
					</tr>
					  <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><?php echo $val->tj004;?><br><?php echo $val->tj005;?></td>
					  <td align="left"><?php echo $val->tj006;?><br><?php echo $val->tj008;?></td>
					  <td align="left"><?php echo $val->tj013;?><br><?php echo $val->tj009;?></td>
					  <td align="left"><?php echo $val->tj011;?><br><?php echo $val->tj012;?></td>
					  <td align="right"><?php echo $val->tj023;?><br><?php echo $val->tj014;?></td>		 
					</tr>
					   <?php $rownum++;$rownum1++;$vi++;$vii++;$totalp=ceil($val->vcount/$vaa); ?>
					
						<?php if ($page == $page1  and  ($rownum1 >=$vaa ) ) { ?>
					<?php $rownum1=0;} ?>
					
				  <!--同一單據有2張以上         -->
					<?php if (    ($vii >=$vaa ) ) { ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><?php echo $results[$vi-1]->ti023;?>						
					  </td>
					</tr>		
					<tr>
					  <td colspan="5" align="left">
					    <b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '續下頁..';} ?>
								 
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
			  <td width="180" align="left"><b>核  准：</b></td>
			  <td width="180" align="left"><b>倉  管：</b></td>
			  <td width="180" align="left"><b>退  貨：</b></td>
			  <td width="180" align="left"><b>製  單：</b></td>
			  <td width="180" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
					     <div style="page-break-before: always;"></div> 
						<!--  <P style='page-break-after:always'></P> -->
						 <?php $vii++;$total++; ?>
						 <?php for ($i=$vii; $i<8; $i++) { ?>
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
		  
			<tr><td class="title" align="center" valign="top">銷 退 單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷退單號：</b><span><?php echo $results[$vi]->ti002 ?></span></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[$vi]->ti034 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" colspan="2" valign="top"><b>部門：</b><?php echo $results[$vi]->ti005.' '.$results[$vi]->ti005disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" colspan="2" valign="top"><b>備註：</b><?php echo $results[$vi]->ti020 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $results[$vi]->ti004.' '.$results[$vi]->ti004disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							 
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[$vi]->ti039.' '.$results[$vi]->ti039disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $results[$vi]->ti006.' '.$results[$vi]->ti006disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b<?php echo $results[$vi]->ti004disp3  ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $results[$vi]->ti004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $results[$vi]->ti004disp2 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left"  valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
					 <td align="center" width="15%"><b>品號</b><br><b>品名</b></td>
					  <td align="center" width="15%"><b>規格</b><br><b>單位</b></td>
					  <td align="right" width="8%"><b>庫別</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單價</b><br><b>金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>毛重</b></td>
					</tr>
					
				
						  
					<?php $rownum1=0;$vii=0;} ?> 
					<?php  } ?>
					
					<?php if (($page == $page1)  and  ($rownum1 <=$vaa )  )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>			 
					</tr>
					<?php } ?> <?php } ?>   
					
						<?php if (($totle_page < $page) and ($totle_page>=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>					 
					</tr>
					<?php } ?> <?php } ?>  
                    <tr>
					  <td colspan="5" align="left">
						<b>備  註：</b><? echo $results[$vi-1]->ti023;?>						
					  </td>
					</tr>					
					<tr>
					  <td colspan="7" align="left">
					     <?php if ($totle_page >= $page  ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $results[$vi-1]->ti037;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $results[$vi-1]->ti038;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $results[$vi-1]->ti037+$results[$vi-1]->ti038;} ?>  <?php echo '';} ?> 
					    <?php if ($totle_page < $page ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		 <br>
		  <table >
			<tr>
			   <td width="180" align="left"><b>核  准：</b></td>
			  <td width="180" align="left"><b>倉  管：</b></td>
			  <td width="180" align="left"><b>退  貨：</b></td>
			  <td width="180" align="left"><b>製  單：</b></td>
			  <td width="180" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		   
		   <div style="page-break-before: always;"></div>
		   <?php if($paper9=="1")  {$vaa=7; $vbb=$vaa-1;} else 
		  {$vaa=7; $vbb=$vaa-1;} ?>	
		 <?php $page++;$page1++;$vii=0; }
		 ?> 
		
</body>
</html>
