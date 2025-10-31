<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>退 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri11/printdetailc';location = url; </script> 
 <?php } ?>
<body onLoad="window.print()">
  <!-- 公司抬頭 -->
<?php foreach($results1 as $row ) : ?>
		   
       <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
$page = 1;//預設第一頁
$page_limit = 6;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%6==5){
		if(@$results[$page*6]){
			$page++;
		}
	}
	$pur_date = substr($value->ti014,0,4).'/'.substr($value->ti014,4,2).'/'.substr($value->ti014,6,2);
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
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml012'); ?> <br/>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>
			</td>
		  </tr>
		  
		  
			<tr><td class="title" align="center" valign="top">退  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>退貨單號：</b><span><?php echo $results[0]->ti002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $results[0]->ti014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[0]->ti012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>件數：</b><span><?php echo $results[0]->ti021 ?></span></td>
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
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $results[0]->ti004.' '.$results[0]->ti004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
					  <td align="left" width="8%"><b>品號</b><br><b>單位</b></td>
					  <td align="left" width="22%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="8%"><b>採購單號</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單位價格</b><br><b>退貨金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>庫別</b></td>
					</tr>
					   <?php  $rownum=6;$rownum1=0;$rownum2=5;  ?>
					  <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><?php echo $val->tj004;?><br><?php echo $val->tj007;?></td>
					  <td align="left"><?php echo $val->tj005;?><br><?php echo $val->tj006;?></td>
					  <td align="right"><?php echo $val->tj017;?><br><?php echo $val->tj009;?></td>
					  <td align="right"><?php echo $val->tj008;?><br><?php echo $val->tj010;?></td>
					  <td align="right"><?php echo $val->tj019;?><br><?php echo $val->tj011;?></td>
					 		 
					</tr>
					 <?php $rownum++;$rownum1++;$vqty=$vqty+$val->tj009;$vamt=$vamt+$val->tj010; ?>
					   
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=6 ) ) { ?>
				        <?php for ($i=1; $i<$rownum; $i++) { ?>
					<tr>					 
					 
					  <td align="left">&nbsp;<br>&nbsp;</td>
					  <td align="left">&nbsp;<br>&nbsp;</td>
					  <td align="right">&nbsp;<br>&nbsp;</td>
					  <td align="right">&nbsp;<br>&nbsp;</td>
					  <td align="right">&nbsp;<br>&nbsp;</td>			 
					</tr>
				<?php } ?> <?php } ?> 
					<?php  } ?>
				<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=6 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>						 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=6 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>					 
					</tr>
					<?php } ?> <?php } ?>   
					<tr>
					  <td colspan="8" align="left">
					   <?php if ($totle_page == $page  ) { ?>
						<b>金額：</b><? echo $results[0]->tg031;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $results[0]->tg032; ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><? echo  $results[0]->tg031+ $results[0]->tg032;?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>金額：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>稅額：<?php echo ''; ?></b>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><? echo  '';?>   <?php echo '續下頁..';} ?> 
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		   <div style="page-break-before: always;"></div>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
		 <?php $page++; } ?> 
		  
		 
</body>
</html>
