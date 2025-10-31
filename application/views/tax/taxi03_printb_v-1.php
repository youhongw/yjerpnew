<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>電 子 發 票</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
<?php exit;} ?>
  <!--   頁直行數  -->
 <?php $paper9="1"; ?> 
<?php if($paper9=="1")  {$vaa=24; $vbb=$vaa-1;} else 
		  {$vaa=24; $vbb=$vaa-1;} ?>	
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
	//$pur_date = substr($value->MC039,0,4).'/'.substr($value->MC039,4,2).'/'.substr($value->MC039,6,2);
	$pur_date =stringtodate("Y-m-d",$value->mc213);
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
			<?php  echo "電 子 發 票 證 明 聯" ?>   
			</td>
		  </tr>
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php  echo 'Tel:'.$vsysml005; ?>
			<?php  echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
			 
			<tr><td class="title" align="center" valign="top">電 子 發 票 證 明 聯</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="50%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>發票號碼：</b><span><?php echo $results[0]->mc214 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>買　　方：</b><?php echo $results[0]->mc203 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>統一編號：</b><?php echo $results[0]->mc204 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>地　　址：</b><?php echo $results[0]->mc215 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  
					  <td width="50%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>格式：</b><?php echo '25' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <?php if ($results[0]->mc210=='1') {$amc210='應稅';}   ?>
							  <?php if ($results[0]->mc210=='2') {$amc210='零稅率';}   ?>
							  <?php if ($results[0]->mc210=='3') {$amc210='免稅';}   ?>
							  <td width="600" align="left" valign="top"><b>稅別：</b><?php echo $amc210 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b><?php echo '' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo  '第'.$page.'頁'."/".'共'.$totle_page.'頁' ?></td>
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
					  <td align="left" width="45%"><b>品名</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					  <td align="left"  width="25%"><b>備註</b></td>
					<!--   <td align="right"  width="100"><b>毛重</b><br><b>備註</b></td>  -->
					</tr>
					   <?php $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>					 
					  <td align="left"><? echo $val->md005.''.$val->md006.''.$val->md007;?></td>
					  <td align="right"><? echo $val->md009;?></td>
					  <td align="right"><? echo $val->md010;?></td>
					  <td align="right"><? echo $val->md011;?></td>
					  <td align="left"><? echo $val->md012;?></td>
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
					</tr>
					<?php } ?> <?php } ?>   
					<tr>					 
					  <td colspan="3" align="left">銷售額合計：</td>
					  <td align="right"><?php echo $results[0]->mc217 ?></td>
					  <td align="center">營業人蓋統一發票專用章</td>				 
					</tr>
					<tr>					 
					  <td colspan="3" align="left">營業稅：</td>
					  <td align="right"><?php echo $results[0]->mc218 ?></td>
					  <td align="center"></td>				 
					</tr>
					<tr>					 
					  <td colspan="3" align="left">總計：</td>
					  <td align="right"><?php echo $results[0]->mc219 ?></td>
					  <td align="center"></td>				 
					</tr>
					<tr>					 
					  <td colspan="3" align="left">總計新台幣：</td>
					  <td align="right"><?php echo '' ?></td>
					  <td align="center"></td>				 
					</tr>
				<!--	<tr>
					  <td colspan="5" align="right">
					  <?php //if ($totle_page == $page  ) { ?>
						<b>銷售額合計：<?php  //echo $results[0]->mc217 ?></b>  <?php echo '';} ?> 
					
					  <?php // if ($totle_page > $page ) { ?>
                        <b>銷售額合計：<?php //echo '' ?></b> 
					  <?php //echo '續下頁..';} ?> 
					  </td>
					</tr> -->
				</table>
			</td></tr>
		</table>
		
		<!--  <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>  -->
		  
		    <div style="page-break-before: always;"></div>
		
		 <?php $page++; } ?> 
</body>
</html>
