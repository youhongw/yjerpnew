<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>扣繳憑單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/palr61/printdetail';location = url; </script> 
  <?php } ?>
<body onLoad="window.print()">
<!-- 公司抬頭 -->
<?php foreach($results1 as $row ) : ?>
		    <!-- //公司簡稱 公司全稱 電話 傳真 地址 E-MAIL 備註 -->
			 <?php $ml002sys[]=$row->ml002; ?>
			 <?php $ml003sys[]=$row->ml003; ?>
			 <?php $ml005sys[]=$row->ml005; ?>
			 <?php $ml006sys[]=$row->ml006; ?>
			 <?php $ml007sys[]=$row->ml007; ?>
			 <?php $ml012sys[]=$row->ml012; ?> 
			 <?php $ml009sys[]=$row->ml009; ?> 
			 <?php $ml010sys[]=$row->ml010; ?> 
			 <?php $ml011sys[]=$row->ml011; ?> 
        <?php endforeach;?>
		     <?php $vsysml002=$ml002sys[0]; ?>
			 <?php $vsysml003=$ml003sys[0]; ?>
		     <?php $vsysml005=$ml005sys[0]; ?>
			 <?php $vsysml006=$ml006sys[0]; ?>
			 <?php $vsysml007=$ml007sys[0]; ?>
			 <?php $vsysml012=$ml012sys[0]; ?>
			 <?php $vsysml009=$ml009sys[0]; ?>
			 <?php $vsysml010=$ml010sys[0]; ?>
			 <?php $vsysml011=$ml011sys[0]; ?>

          <!-- 第一頁 -->
		  <?php $paper9='1';$tprint='Y'; ?>
		  <?php if($paper9=="1")  { $tot=6;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1; $th008qty=0; $th013amt=0; ?>	
		
        <?php foreach($results as $row ) : ?>
		    
		<table class="store">
		   <tr><td colspan="2" align="center"><?php echo '　　　　　　　　　　'.$vsysml007; ?></td>
	     </tr>
		  <tr><td colspan="2" align="center"><?php echo '　　　　　　　　　　'.$vsysml003; ?></td>
	     </tr>
		  <tr><td colspan="2" align="center"><?php echo '　　　　　　　　　　'.$vsysml012; ?></td>
	     </tr>
		  <tr><td colspan="2" align="center"><?php echo '　　　　　　　　　　'.$vsysml009; ?></td>
	     </tr>
	        <tr><td colspan="2" align="center"><?php echo '　　　　　　　　　　'; ?></td>
	     </tr>
		   <?php // $date=date("Y/m/d");$date1=(int)substr($date,0,4)-1911;$date2=substr($date,4,6);$date3=$date1.$date2;  ?>
		   
		  <!-- 往下一行 -->
		
		  
		   <tr>
		       <?php // $vea025= mb_substr($results[0]->ea025,0,5,"big5"); ?>
		      <td width="55%" colspan="3" style="font-size:10px" align="left" valign="top"><b>　　　　　　　　　　</b><?php // echo wordwrap($vea025,10,"<br />\n",TRUE); ?></td>
			 <td width="25%" align="left" valign="top"></td>
			  <td width="20%" align="left" valign="top"><b></b></td>
		  </tr>
		  <tr>
		      <td width="55%" align="left" valign="top"><b><?php echo ''.$row->td002.'   '.$row->mv009 ?>　　　　　　　</b></td>
			  <td width="15%" align="left" valign="top"><?php echo '' ?>　</td>
			  <td width="30%" align="left" valign="top"><?php echo '' ?></td>
		  </tr>
		
		  <tr>
		      <td width="55%" align="left"  valign="top"><b>　　　　　　　　　　</b><?php echo $row->mv017 ?></td>
			  <td width="15%" align="left" valign="top">　</td>
			   <td width="30%" align="left" valign="top"><b>　　　　　　</b></td>
		  </tr>
		    <tr>
		      <td width="55%" align="left" valign="top"><b><?php echo ''.$dateo.' '.$row->td047.' '.$row->td037.' '.$row->td047-$row->td047 ?>　　　　　　　</b></td>
			  <td width="15%" align="left" valign="top"><?php echo '' ?>　</td>
			  <td width="30%" align="left" valign="top"><?php echo '' ?></td>
		  </tr>
		   <tr>
		      <td width="55%" align="left" valign="top"><b><?php echo ''.$datec ?>　　　　　　　</b></td>
			  <td width="15%" align="left" valign="top"><?php echo '' ?>　</td>
			  <td width="30%" align="left" valign="top"><?php echo '' ?></td>
		  </tr>
		  <tr>
		      <td width="50%" align="left" valign="top"><b>　　　　　　　　　　　</b></td>
			  <td width="30%" align="left"  valign="top"><b>　　　</b></td>
			  <td width="20%" align="left" valign="top"><b></b><?php // echo $results[0]->tc035 ?></td>
		  </tr>
		   <tr>
		      <td width="40%" align="left" valign="top"><b>　　　　　　　　　</b></td>
			  <td width="15%" align="left" valign="top"><b>　　　　　　　　　</b></td>
			  <td width="45%" align="left" valign="top"><b>　　　　</b></td>
			 
		  </tr>
		   <tr>
		      <td width="40%" align="left" valign="top"><b>　　　　　　　　　</b></td>
			  <td width="15%" align="left" valign="top"><b>　　　　　　　　　</b></td>
			  <td width="45%" align="left" valign="top"><b>　　　　</b></td>
			 
		  </tr>
	</table>
			  
			
		  <tr>
					  <td colspan="9" align="left"><br><br>
						<b></b>						
					  </td>
					</tr>
		 
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>