<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>薪 資 條</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/palr45/printdetail';location = url; </script> 
  <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
		  <?php $paper9='1';$tprint='Y'; ?>
		  <?php if($paper9=="1")  { $tot=6;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1; $th008qty=0; $th013amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		    
		<table class="store">
		  <tr>
			<td class="logo1" align="center" valign="top">
		    	<?php echo $this->session->userdata('sysml003'); ?>
			</td>
			 </tr>
			 <tr>
			
		  </tr>
			  <tr><td  align="left" valign="top" style="border-bottom: 1px solid #000000" ><span><?php echo '員工代號：'.$row->td001 ?></span>　　　　　　　　　　
			  薪  資  條 　　　　　　<?php echo '年月：'.$row->td005 ?></td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>姓　　名</b></td>
							  </tr>
							  <tr>
							  <td style="border: 1px solid #000000;height:20px" width="100" align="center" valign="top"><b><span><?php echo $row->td002 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							  <tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="right" valign="top"><b>本　　薪</b></td>
							  </tr>
							  <tr>
							  <td style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td008 ?></span></b></td>
							 
							</tr>
							<tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>延班時數</b></td>
							  </tr>
							<tr>
							   <td style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td017+$row->td019 ?></span></b></td>
							  
							</tr>
							<tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>借支扣款</b></td>
							  </tr>
							<tr>
							   <td style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td017+$row->td019 ?></span></b></td>
							
							</tr>
							<tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
					<!--		<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px"  colspan="9" align="right" valign="top"><b>備註：<?php echo $row->td031 ?></b></td>
							  </tr>
							
							<tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr> -->
							
							
							</tr>
						</table>
					  </td>
		
			          <!--  第二行  -->
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>天　　數</b></td>
							   <tr>
							  <td style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td006 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>職務津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td009 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>延班津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td018+$row->td020 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>勞 保 費</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:20px;" width="100" align="right" valign="top"><b><span><?php echo $row->td033 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>遲　　到</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc004 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>主管津貼</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td010 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>週六津貼</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td021+$row->td023 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>健 保 費：</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td034 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>事　　假</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc006 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>伙食津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td011 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>週六津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td022+$row->td024 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>所 得 稅</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td037 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>病　　假</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc007 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>全勤獎金</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td012 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>週日延班</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td025+$row->td027 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>伙 食 費</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td036 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  <td align="right" valign="top"></td>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>無 薪 假</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc010 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>特別津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td013 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>週日津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td026+$row->td028 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>其他扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td038 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>補正次數</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc005 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" idth="600" align="center" valign="top"><b>業務津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td014 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>其　　他</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td029 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>請假扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td032 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="right" valign="top"><b>　　</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>執照津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td015 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="right" valign="top"><b>　　</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>補充保費</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td035 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>日　　薪</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td007 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>資歷津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td016 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>應領薪資</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td030 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><b>實領津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td039 ?></span></td>
							  </tr>
							  <tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr>
							 
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		  <tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $row->td042;?>						
					  </td>
					</tr>
		 <tr><td valign="top">
				<table class="address">
					<tr>
					  <td width="100%" align="right" valign="top">
						<table width="100%">
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>