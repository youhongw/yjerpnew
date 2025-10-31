<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>託 外 退 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
<?php exit;} ?>
  <!--   頁直行數  -->
 <?php $paper9="1"; ?> 
<?php if($paper9=="1")  {$vaa=6; $vbb=$vaa-1;} else 
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
	$pur_date = substr($value->tk027,0,4).'/'.substr($value->tk027,4,2).'/'.substr($value->tk027,6,2);
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
			 
			<tr><td class="title" align="center" valign="top">託 外 退 貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="40%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>退貨單別：</b><span><?php echo $results[0]->tk001."  ".$results[0]->puri04disp; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>退貨單號：</b><?php echo $results[0]->tk002; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo substr($results[0]->tk027,0,4).'/'.substr($results[0]->tk027,4,2).'/'.substr($results[0]->tk027,6,2); ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>加工廠商：</b><?php echo $results[0]->tk004."   ".$results[0]->puri01disp; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $results[0]->tk032; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="20%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠別：</b><span><?php echo $results[0]->tk005."  ".$results[0]->cmsi02disp; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>件數:</b><span><?php echo $results[0]->tk008; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>營業稅率：</b><?php echo $results[0]->tk029; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $results[0]->tk006; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>匯率：</b><?php echo $results[0]->tk007; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="20%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>統一編號：</b><?php echo $results[0]->tk010; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>發票聯數：</b><?php echo $results[0]->tk011; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>發票日期：</b><?php echo $results[0]->tk012; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>發票號碼：</b><?php echo $results[0]->tk013; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="20%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $results[0]->tk014; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>扣抵區分：</b><?php echo $results[0]->tk015; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[0]->tk009; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>確認碼：</b><?php echo $results[0]->tk021; ?></td>
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
					  <td align="left"  width="9%"><b>品號</b></td>
					  <td align="left" width="9%"><b>品名</b></td>
					  <td align="left"  width="9%"><b>規格</b></td>
					  <td align="left"  width="9%"><b>單位/計價單位</b></td>
					  <td align="left"  width="8%"><b>退貨庫別</b></td>
					  <td align="left" width="8%"><b>退貨數量</b></td>
					  <td align="left" width="8%"><b>計價數量</b></td>
					  <td align="left" width="8%"><b>加工單價</b></td>
					  <td align="left" width="8%"><b>加工金額</b></td>
					  <td align="left" width="8%"><b>製令編號</b></td>
					  <td align="left" width="8%"><b>製程代號</b></td>
					  <td align="left" width="8%"><b>備註</b></td>
					<!--   <td align="right"  width="100"><b>毛重</b><br><b>備註</b></td>  -->
					</tr>
					  <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><? echo $val->tl004;?></td>
					  <td align="left"><? echo $val->tl005;?></td>
					  <td align="left"><? echo $val->tl006;?></td>
					  <td align="left"><? echo $val->tl008."/".$val->tl010;?></td>
					  <td align="left"><? echo $val->tl013;?></td>
					  <td align="left"><? echo $val->tl007;?></td>
					  <td align="left"><? echo $val->tl009;?></td>
					  <td align="left"><? echo $val->tl017;?></td>
					  <td align="left"><? echo $val->tl018;?></td>
					  <td align="left"><? echo $val->tl015."-".$val->tl016;?></td>
					  <td align="left"><? echo $val->tl017;?></td>	
					  <td align="left"><? echo $val->tl023;?></td>	
					</tr>
					   <?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
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
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>								 	 
					</tr>
					<?php } ?> <?php } ?> 
					
					<?php  } ?>
					
					<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
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
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					<?php } ?> <?php } ?>   
					
						<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
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
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>							 
					</tr>
					<?php } ?> <?php } ?>   
					
				</table>
			</td></tr>
		</table>
		<?php 
		/*$sum1=0;$sum2=0;$sum3=0;$sum4=0;$sum5=0;$sum6=0;$sum7=0;
		
			foreach($value as $key=>$val){
				$sum1 += $val->ti025;
				$sum2 += $val->ti026;
				$sum3 = $sum1 - $sum2;
				$sum4 += $val->ti020;
				$sum5 += $val->ti027;
				$sum6 += $val->ti047;
				$sum7 = $sum3-$sum6;
			}*/
		?>
		<table>
			<tr>
				<td width="300" align="left">數量合計：<?php echo $val->tk020; ?></td>
				<td width="300" align="left">原幣未稅金額：<?php echo $val->tk017; ?></td>
				<td width="300" align="left">本幣未稅金額：<?php echo $val->tk030; ?></td>
				<!--<td width="300" align="left">數量合計：<?php echo $val->tl009; ?></td>-->
			</tr>
			<tr>
				<td width="300" align="left"></td>
				<td width="300" align="left">原幣稅額：<?php echo $val->tk019; ?></td>
				<td width="300" align="left">本幣稅額：<?php echo $val->tk031;?></td>
			</tr>
			<tr>
				<td width="300" align="left"></td>
				<td width="300" align="left">原幣金額合計：<?php echo $val->tk017 + $val->tk019 ?></td>
				<td width="300" align="left">本幣金額合計：<?php echo $val->tk030 + $val->tk031; ?></td>
			</tr>
		</table>
		  <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		    <div style="page-break-before: always;"></div>
		
		 <?php $page++; } ?> 
</body>
</html>
