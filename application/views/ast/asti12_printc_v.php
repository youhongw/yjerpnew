<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>資 產 移 轉 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
<?php if (!$results)  { ?>
	<script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/ast/asti12/printdetailc';location = url; </script> 
<?php exit;}

//$data		按單裝資料
$data = Array();
foreach($results as $key => $val ){
	$data[$val->tf002][] = $val;
}
//$print_data	裝成一筆一頁，按照 單->頁 排序
$print_data = Array();$count_total = Array();$money_total = Array();$pages = Array();
$currrent_order=0;$current_page=0;$perpage_count = 0;

foreach($data as $key => $val){
	$pages[$key] = 1;
	foreach($val as $k => $v){
		/***此區段為計算真實的總金額與總數量，可取用也可直接參照資料庫***/
	/*	if(!@$count_total[$v->td002])
			$count_total[$v->td002] = (int)$v->td008;
		else
			$count_total[$v->td002] += $v->td008;
		
		if(!@$money_total[$v->td002])
			$money_total[$v->td002] = (int)$v->td012;
		else
			$money_total[$v->td002] += $v->td012;		
		/***取用方式$count_total[單號]、$money_total[單號]***/
		$print_data[$current_page][$perpage_count] = $v;
		$print_data[$current_page][$perpage_count]->order_no = $currrent_order;
		$perpage_count++;
		if($perpage_count %6 == 0){
			$perpage_count = 0;
			$current_page++;
			$pages[$v->tf002]++;
		}
	}
	$perpage_count = 0;
	$currrent_order++;
	$current_page++;
}

//cho "<pre>";var_dump($print_data);exit;//取消註解可看資料結構
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
	if($temp_order != $value[0]->te002){  //判斷是否同一張單  不是就重新計算頁數
		$temp_order = $value[0]->te002;
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
			<tr><td class="title" align="center" valign="top">資 產 外 送 單</td></tr>
			<tr><td valign="top">
				<table class="order">
				  <tr>
				    <td width="35%" align="left" valign="top">
					<table class="company">
					  <tr>
						<td width="600" align="left" valign="top"><b>單別：</b><span><?php echo $value[0]->te001.'&nbsp;&nbsp;&nbsp;'.$value[0]->te001disp ?></span></td>
						<td align="left" valign="top" ></td>
					  </tr>
					</table>
				    </td>
					
				    <td width="35%" align="left" valign="top">
					<table class="company">
					  <tr>
						<td width="600" align="left" valign="top"><b>單號：</b><span><?php echo $value[0]->te002 ?></span></td>
						<td align="left" valign="top" ></td>
					  </tr>
					</table>
				    </td>
					
					<td width="30%" align="left" valign="top">
					<table class="company">
					  <tr>
						<td width="600" align="left" valign="top"><b>單據日期：</b><?php echo substr($value[0]->te008,0,4).'/'.substr($value[0]->te008,4,2).'/'.substr($value[0]->te008,6,2); ?></td>
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
					  <td align="left" width="10%"><b>資產編號</b></td>
					  <td align="left" width="35%"><b>資產名稱</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>部門名稱</b></td>
					  <td align="left" width="10%"><b>人員名稱</b></td>
					  <td align="right" width="10%"><b>外送數量</b></td>
					  <td align="right" width="10%"><b>收回數量</b></td>
					</tr>
				<?php foreach($value as $key=>$val){?>
					<tr>					 
					  <td align="left"><? echo $val->tf003;?></td>
					  <td align="left"><? echo $val->asti02;?></td>
					  <td align="left"><? echo $val->asti02_mb003;?></td>
					  <td align="left"><? echo $val->asti02_asti12_mc002disp;?></td>
					  <td align="left"><? echo $val->asti02_asti12_mc003disp;?></td>
					  <td align="right"><? echo $val->tf006;?></td>
					  <td align="right"><? echo $val->tf008;?></td>
					</tr>
				<?php }?>
				<?php for($i=0; $i<5-$key; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
				<?php }?>
					
				<!--	<tr>
					  <td colspan="7" align="right">
					  <?php if ($pages[$value[0]->td002] == $temp_page  ) { ?>
						<b>訂單金額：<?php echo $value[0]->tc029 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo $value[0]->tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo $value[0]->tc029+$value[0]->tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo $value[0]->tc031 ?></b>  <?php echo '';} ?> 
					
					  <?php if ($pages[$value[0]->td002] > $temp_page ) { ?>
                        <b>訂單金額：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo '' ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo '' ?></b> 
					    <?php echo '續下頁..';} ?> 
					</td>
					</tr>-->
					
				</table>
			</td></tr>
		</table>
		
		  <table>
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
