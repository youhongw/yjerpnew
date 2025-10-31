<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>託 外 進 貨  單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
<?php if (!$results)  { ?>
	<script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci06/printdetailc';location = url; </script> 
<?php exit;}
//$data		按單裝資料
$data = Array();
foreach($results as $key => $val ){
	$data[$val->th002][] = $val;
}
//$print_data	裝成一筆一頁，按照 單->頁 排序
$print_data = Array();$count_total = Array();$money_total = Array();$pages = Array();
$currrent_order=0;$current_page=0;$perpage_count = 0;
foreach($data as $key => $val){
	$pages[$key] = 1;
	foreach($val as $k => $v){
		//此區段為計算真實的總金額與總數量，可取用也可直接參照資料庫
		/*if(!@$count_total[$v->td002])
			$count_total[$v->td002] = (int)$v->td008;
		else
			$count_total[$v->td002] += $v->td008;
		if(!@$money_total[$v->td002])
			$money_total[$v->td002] = (int)$v->td012;
		else
			$money_total[$v->td002] += $v->td012;*/
		//取用方式$count_total[單號]、$money_total[單號]
		$print_data[$current_page][$perpage_count] = $v;
		$print_data[$current_page][$perpage_count]->order_no = $currrent_order;
		$perpage_count++;
		if($perpage_count %6 == 0){
			$perpage_count = 0;
			$current_page++;
			$pages[$v->ti002]++;
		}
	}
	$perpage_count = 0;
	$currrent_order++;
	$current_page++;
}
//echo "<pre>";var_dump($print_data);exit;//取消註解可看資料結構
//echo "<pre>";var_dump($count_total);echo "</pre>";
  ?>
  <!--   頁直行數  -->
 <?php $paper9="1"; ?> 
<?php if($paper9=="1")  {$vaa=6; $vbb=$vaa-1;} else 
		  {$vaa=6; $vbb=$vaa-1;} ?>	
<body onLoad="window.print()">
  <!-- 公司抬頭 -->
<?php foreach($results1 as $row ) : ?>
		    <!-- //公司簡稱 公司全稱 電話 傳真 地址 E-MAIL 備註 -->
			 <?php $ml002sys[]=$row->ml002; ?>
			 <?php $ml003sys[]=$row->ml003; ?>
			 <?php $ml005sys[]=$row->ml005; ?>
			 <?php $ml006sys[]=$row->ml006; ?>
			 <?php $ml012sys[]=$row->ml012; ?> 
			 <?php $ml010sys[]=$row->ml010; ?> 
			 <?php $ml011sys[]=$row->ml011; ?> 
        <?php endforeach;?>
		     <?php $vsysml002=$ml002sys[0]; ?>
			 <?php $vsysml003=$ml003sys[0]; ?>
		     <?php $vsysml005=$ml005sys[0]; ?>
			 <?php $vsysml006=$ml006sys[0]; ?>
			 <?php $vsysml012=$ml012sys[0]; ?>
			 <?php $vsysml010=$ml010sys[0]; ?>
			 <?php $vsysml011=$ml011sys[0]; ?>
<?php
$temp_order = "";$temp_page="";
foreach($print_data as $index => $value){
	if($temp_order != $value[0]->th002){  //判斷是否同一張單  不是就重新計算頁數
		$temp_order = $value[0]->th002;
		$temp_page = 1;
	}
?>
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
			<tr><td class="title" align="center" valign="top">託 外 進 貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="40%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>進貨單別：</b><span><?php echo $results[0]->th001."  ".$results[0]->puri04disp; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>進貨單號：</b><?php echo $results[0]->th002; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>進貨日期：</b><?php echo substr($results[0]->th003,0,4).'/'.substr($results[0]->th003,4,2).'/'.substr($results[0]->th003,6,2); ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="20%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠別：</b><span><?php echo $results[0]->th004."  ".$results[0]->cmsi02disp; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>件數:</b><span><?php echo $results[0]->th009; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[0]->th010; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="20%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>加工廠商：</b><?php echo $results[0]->th005."  ".$results[0]->puri01disp; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商單號：</b><?php echo $results[0]->th006; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="20%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $results[0]->th015; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>扣抵區分：</b><?php echo $results[0]->th016; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>確認碼：</b><?php echo $results[0]->th023; ?></td>
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
					  <td align="left"  width="10%"><b>品號</b></td>
					  <td align="left" width="9%"><b>品名</b></td>
					  <td align="left"  width="9%"><b>規格</b></td>
					  <td align="left"  width="9%"><b>單位</b></td>
					  <td align="left"  width="9%"><b>計價數量</b></td>
					  <td align="left" width="9%"><b>進貨費用</b></td>
					  <td align="left" width="9%"><b>加工單價</b></td>
					  <td align="left" width="9%"><b>加工金額</b></td>
					  <td align="left" width="9%"><b>扣款金額</b></td>
					  <td align="left" width="9%"><b>進貨庫別</b></td>
					  <td align="left" width="9%"><b>製令單號</b></td>
					</tr>
				<?php foreach($value as $key=>$val){?>
					<tr>					 
					  <td align="left"><? echo $val->ti004;?></td>
					  <td align="left"><? echo $val->ti005;?></td>
					  <td align="left"><? echo $val->ti006;?></td>
					  <td align="left"><? echo $val->ti023;?></td>
					  <td align="right"><? echo $val->ti020;?></td>
					  <td align="right"><? echo $val->ti027;?></td>
					  <td align="right"><? echo $val->ti024;?></td>
					  <td align="right"><? echo $val->ti025;?></td>
					  <td align="right"><? echo $val->ti026;?></td>
					  <td align="right"><? echo $val->ti009disp;?></td>
					  <td align="right"><? echo $val->ti014;?></td>	
					</tr>
				<?php }?>
				<?php for($i=0; $i<5-$key; $i++) { ?>
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
					</tr>
				<?php }?>
				</table>
			</td></tr>
		</table>
		<?php 
		$sum1=0;$sum2=0;$sum3=0;$sum4=0;$sum5=0;$sum6=0;$sum7=0;
		
			foreach($value as $key=>$val){
				$sum1 += $val->ti025;
				$sum2 += $val->ti026;
				$sum3 = $sum1 - $sum2;
				$sum4 += $val->ti020;
				$sum5 += $val->ti027;
				$sum6 += $val->ti047;
				$sum7 = $sum3-$sum6;
			}
		?>
		<table>
			<tr>
				<td width="300" align="left">加工金額：<?php echo $sum1; ?></td>
				<td width="300" align="left">扣款金額：<?php echo $sum2; ?></td>
				<td width="300" align="left">貸款金額：<?php echo $sum3; ?></td>
				<td width="300" align="left">數量合計：<?php echo $sum4; ?></td>
			</tr>
			<tr>
				<td width="300" align="left"></td>
				<td width="300" align="left"></td>
				<td width="300" align="left">稅額：<?php echo $sum6;?></td>
			</tr>
			<tr>
				<td width="300" align="left">進貨費用：<?php echo $sum5;?></td>
				<td width="300" align="left"></td>
				<td width="300" align="left">金額合計：<?php echo $sum7; ?></td>
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
<?php
$temp_page++;
}
?>
</body>
</html>
