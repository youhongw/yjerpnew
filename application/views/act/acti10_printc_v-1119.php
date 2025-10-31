<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>轉 帳 傳 票</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/act/acti10/printdetailc';location = url; </script> 
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
$vi=0;
$page = 1;//第一頁開始 單據筆數
$page1= 1;
foreach($page_data as $key=>$value){
?>       
			
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
		  
			<tr><td class="title" align="center" valign="top">轉  帳  傳  票</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單別：</b><span><?php echo $results[$vi]->ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單號：</b><?php echo $results[$vi]->ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[$vi]->ta009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票日期：</b><?php echo $results[$vi]->ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo '1/1' ?></td>
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
					   <td align="center" width="20%"><b>會 計 科 目</b><br><b>會 計 名 稱</b></td>
					  <td align="center" width="30%"><b>摘    要</b></td>
					  <td align="center" width="20%"><b>部門代號</b><br><b>部門名稱</b></td>
					  <td align="right" width="15%"><b>借方金額</b></td>
					  <td align="right" width="15%"><b>貸方金額</b></td>
					</tr>
					  <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					   <?php  if ($val->tb004==1)	{$tb071=$val->tb007;$tb072=0;} else   {$tb072=$val->tb007;$tb071=0;} ?>	
					<tr>					 
					  <td align="left"><? echo $val->tb005;?><br><? echo $val->tb005disp;?></td>
					  <td align="left"><? echo $val->tb010;?>
					  <td align="right"><? echo $val->tb006;?><br><? echo $val->tb006disp;?></td>
					   <td align="right"><? if ($tb071>0) {echo $tb071;} ?></td>
					   <td align="right"><? if ($tb072>0) {echo $tb072;}?><? echo $vi;?></td>			 
					</tr>
					   <?php $rownum++;$rownum1++;$vi++; ?>
					
						<?php if ($page == $page1  and  ($rownum1 >=$vaa ) ) { ?>
		      	　　				      
					
					<?php $rownum1=0;} ?> 
					
					<?php  } ?>
					
					<?php if (($totle_page < $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;<br>&nbsp;&nbsp;</td>
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
					</tr>
					<?php } ?> <?php } ?>   
					<tr>
					  <td colspan="6" align="left">
					     <?php if ($totle_page >= $page  ) { ?>
						<b>借方合計：<?php echo $results[$vi-1]->ta007 ?></b><b>
						 　　　　　　　　　　　　　　　　　　　　貸方合計：<?php echo $results[$vi-1]->ta008 ?></b>
						 <?php } ?> 
					
					    <?php if ($totle_page < $page ) { ?>
						<b>借方合計：<?php echo '' ?></b><b>
						 　　　　　　　　　　　　　　　　　　　　貸方合計：<?php echo '' ?></b>
					         <?php echo '續下頁..';} ?> 
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		 <br>
		  <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		   
		   <div style="page-break-before: always;"></div>
		   <?php if($paper9=="1")  {$vaa=5; $vbb=$vaa-1;} else 
		  {$vaa=5; $vbb=$vaa-1;} ?>	
		 <?php $page++;$page1++; }
		 ?> 
		
</body>
</html>
