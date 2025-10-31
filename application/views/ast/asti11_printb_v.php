<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>資 產 折 舊 單</title>
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
<?php 
function stringtodate($format,$string){            //stringtodate("Y/m/d",$string1)
		$time = strtotime($string);
		$newformat = date($format,$time);
		
		return $newformat;
	}
	function datetostring($date){
		preg_match_all('/\d/S',$date, $matches);  //處理日期字串
		$newdate = implode('',$matches[0]);
		return $newdate;
	}
?>			 

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
	//$pur_date = substr($value->tc039,0,4).'/'.substr($value->tc039,4,2).'/'.substr($value->tc039,6,2);
	$pur_date =stringtodate("Y/m/d",$value->tc027);
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
			 
			<tr><td class="title" align="center" valign="top">資  產  報  廢  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="25%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報廢單別：</b><span><?php echo $results[0]->tc001."-".$results[0]->tc001disp; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>報廢單號：</b><?php echo $results[0]->tc002; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $pur_date; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票：</b><?php echo "  -  "; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>確認碼：</b><?php echo $results[0]->tc015; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="25%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>資產編號：</b><span><?php echo $results[0]->tc004; ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>資產名稱：</b><?php echo $results[0]->tc004disp; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>資產規格：</b><?php echo $results[0]->tc004disp2; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[0]->tc013; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="25%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>數量：</b><?php echo $results[0]->tc005; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單位：</b><?php echo $results[0]->tc004disp3; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo  $page."/".$totle_page ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="25%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>轉銷取得成本：</b><?php echo $results[0]->tc006; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>轉銷改良成本：</b><?php echo $results[0]->tc007; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>轉銷累積折舊：</b><?php echo $results[0]->tc008; ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>轉銷預留殘值：</b><?php echo $results[0]->tc010; ?></td>
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
					  <td align="left"  width="16%"><b>部門代號</b></td>
					  <td align="left" width="16%"><b>部門名稱</b></td>
					  <td align="left"  width="17%"><b>保管人</b></td>
					  <td align="left"  width="17%"><b>人員名稱</b></td>
					  <td align="right" width="17%"><b>數量</b></td>
					  <td align="right" width="17%"><b>備註</b></td>
					<!--   <td align="right"  width="100"><b>毛重</b><br><b>備註</b></td>  -->
					</tr>
					   <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><? echo $val->td003;?></td>
					  <td align="left"><? echo $val->td003disp;?></td>
					  <td align="left"><? echo $val->td004;?></td>
					  <td align="left"><? echo $val->td004disp;?></td>
					  <td align="right"><? echo $val->td005;?></td>
					  <td align="right"><? echo $val->td008;?></td>
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
					</tr>
					  <?php } ?> <?php } ?> 
					
					  <?php  } ?>  <!-- end 明細 -->
					
					<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				    <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
					</tr>
					<?php } ?> <?php } ?>   
					
					<!--<tr>
					  <td colspan="7" align="right">
					  <?php if ($totle_page == $page  ) { ?>
						<b>訂單金額：<?php echo $results[0]->tc029 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo $results[0]->tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo $results[0]->tc029+$results[0]->tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo $results[0]->tc031 ?></b>  <?php echo '';} ?> 
					
					  <?php if ($totle_page > $page ) { ?>
                        <b>訂單金額：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo '' ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo '' ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo '' ?></b> 
					  <?php echo '續下頁..';} ?> 
					  </td>
					</tr>-->
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
		
		 <?php $page++; } ?> 
</body>
</html>
