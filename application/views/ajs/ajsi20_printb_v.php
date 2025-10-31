<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>轉 帳 傳 票</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
 <?php } ?>
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
$paper9='1';$tprint='Y';$tb071amt=0; $tb072amt=0;
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
	$pur_date = substr($value->ta003,0,4).'/'.substr($value->ta003,4,2).'/'.substr($value->ta003,6,2);
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
			<?php  echo $vsysml003; ?> <br>
			
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">轉  帳  傳  票</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單別：</b><span><?php echo $results[0]->ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單號：</b><?php echo $results[0]->ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $results[0]->ta009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票日期：</b><?php echo $results[0]->ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $page."/".$totle_page  ?></td>
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
					  <td align="center" width="8%"><b>會 計 科 目</b><br><b>會 計 名 稱</b></td>
					  <td align="center" width="18%"><b>摘    要</b></td>
					  <td align="center" width="6%"><b>部門代號</b><br><b>部門名稱</b></td>
					  <td align="right" width="6%"><b>借方金額</b></td>
					  <td align="right" width="6%"><b>貸方金額</b></td>
					</tr>
					  <?php $rownum=5;$rownum1=0;$rownum2=6;  ?>
					   <?php foreach($page_data[$key] as $k=>$val){?>
					<tr>	
					
					  <td align="left"><? echo $val->tb005;?><br><? echo $val->tb005disp;?></td>
					  <td align="left"><? echo $val->tb010;?></td>
					  <td align="left"><? echo $val->tb006;?><br><? echo $val->tb006disp;?></td>
					  <td align="right"><? if ($val->tb004==1) {echo $val->tb007;}?></td>
					  <td align="right"><? if ($val->tb004==-1) {echo $val->tb007;}?></td>
					 		 <? if ($val->tb004==1) { $tb071amt=$tb071amt+$val->tb007;}?>
							 <? if ($val->tb004==-1) { $tb072amt=$tb072amt+$val->tb007;}?>
					</tr>
					  <?php $rownum++;$rownum1++; ?>
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=6 ) ) { ?>
				        <?php for ($i=1; $i<$rownum; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>
					<?php } ?> <?php } ?> 
					
					<?php  } ?>
					
					<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=6 ) )  { ?>
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
					 
					 	<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=6 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>						 
					</tr>
					<?php } ?> <?php } ?>   
					
					 
					  <td colspan="3" align="center"><? echo '合　　　計：'; ?><br></td>
                       <?php if ($totle_page == $page  ) { ?>					  
					        <td align="right"><? echo $tb071amt; ?><br></td>
					        <td align="right"><?  echo $tb072amt; ?><br></td>  <?php } ?> 
					  <?php if ($totle_page > $page ) { ?>
                            <td align="right"><? echo ''; ?><br></td>
					        <td align="right"><?  echo '續下頁..'; ?><br></td>
					         <?php  } ?> 
						
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		
		  <table >
		     <br>
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		   <div style="page-break-before: always;"></div>
		 <!--  <br/>   -->
		 <?php $page++; } ?> 
		 
</body>
</html>
