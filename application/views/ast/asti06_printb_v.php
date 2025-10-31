<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>資　產　改　良 單</title>
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
	$pur_date = substr($value->tc027,0,4).'/'.substr($value->tc027,4,2).'/'.substr($value->tc027,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
	foreach($value as $key2=>$value2){
		$page += 1;
	extract((array)$value2);
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
			 
			<tr><td class="title" align="center" valign="top">產 品 改 良 單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="50%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>單別：</b><span><?php echo $tc001."  ".$tc001disp; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單號：</b><?php echo $tc002; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $pur_date; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>資產編號：</b><?php echo $tc004; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>資產名稱：</b><?php echo $tc004disp; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>規格：</b><?php echo $tc004disp2 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $tc013; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="50%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>改良成本：</b><?php echo $tc007; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>增減年限：</b><?php echo $tc009."   月"; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>增減殘值：</b><?php echo $tc010; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>應付編號：</b><?php echo '  -  '; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票編號：</b><?php echo '  -  '; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>確認碼：</b><?php echo $tc015; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>

<?php $page++; }} ?> 
</body>
</html>
