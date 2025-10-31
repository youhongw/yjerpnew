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
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/palr41/printdetail';location = url; </script> 
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
			<td class="logo1" align="center" valign="top" colspan="3">
		    	<?php echo $this->session->userdata('sysml003'); ?>
			</td>
			 </tr>
			 <tr>
			
		  </tr>
			<tr>
				<td align="left" width="33%">
				部　　門：&nbsp;<?php echo $row->me002;?>
				<br>員工代號：&nbsp;<?php echo $row->td001;?></td>
				<td align="center" width="33%">薪  資  條 </td>
				<td align="right" width="33%">年　　月：&nbsp;<?php echo substr($row->td005,0,4)."/".substr($row->td005,4,2)."　"; ?> 
				<br>列印日期：&nbsp;<?php echo date("Y/m/d"); ?></td>
			</tr>
			  
			<tr><td valign="top" colspan="3">
				<table class="order">
					<tr>
					  <td width="10%" align="right" valign="top">  
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>姓　　名</b><br><br></td>
							  </tr>
							  <tr>
							  <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="center" valign="top"><b><span><?php echo $row->mv002 ?></span></td>
							  </tr>
							 
							  
							  <tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>本　　薪</b><br><br></td>
							  </tr>
							  <tr>
							  <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td008 ?></span></b></td>
							  </tr>
							
							  
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>延班時數</b><br><br></td>
							  </tr>
							<tr>
							   <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td017+$row->td019 ?></span></b><br></td>
							  
							</tr>
							
							  
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>借支扣款</b><br><br></td>
							  </tr>
							<tr>
							   <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td031 ?></span></b></td>
							
							</tr>
							</tr>
							  
					<!--		<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px"  colspan="9" align="right" valign="top"><b>備註：<?php echo $row->td031 ?></b></td>
							  </tr>
							
							<tr>
							  <td width="100" align="right" valign="top"><b>　</b></td>
							  </tr> -->
						</table>
					  </td>  
		
			          <!--  第二行  -->
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>天　　數</b><br><br></td>
							   <tr>
							  <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td006 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>職務津貼</b><br><br></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td009 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>延班津貼</b><br><br></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td018+$row->td020 ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>勞 保 費</b><br><br></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td033 ?></span></td>
							  </tr>
							 
							 
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>遲　　到</b><br><br></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc004 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>主管津貼</b><br><br></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td010 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>週六津貼</b><br><br></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td021+$row->td023 ?></span></td>
							  </tr>
							
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>健 保 費</b><br><br></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td034 ?></span></td>
							  </tr>
							
							
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>事　　假</b><br><br></td>
							  	   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc006 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>伙食津貼</b><br><br></td>
							  	   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td011 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>週六津貼</b><br><br></td>
							  	   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td022+$row->td024 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>所 得 稅</b><br><br></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td037 ?></span></td>
							  </tr>
							 
							 
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>病　　假</b><br><br></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc007 ?></span></td>
							  </tr>
							
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>全勤獎金</b><br><br></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td012 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>國日延班</b><br><br></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td025+$row->td027 ?></span></td>
							  </tr>
							
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>伙 食 費</b><br><br></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td036 ?></span></td>
							  </tr>
							
							  <td align="right" valign="top"></td>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>無 薪 假</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc010 ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>特別津貼</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td013 ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>國日津貼</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td026+$row->td028 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>其他扣款</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td038 ?></span></td>
							  </tr>
							
							
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>補正次數</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->tc005 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" idth="600" align="center" valign="top"><br><b>業務津貼</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td014 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>其　　他</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td029 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>請假扣款</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td032 ?></span></td>
							  </tr>
							
							  
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="right" valign="top"><br><b>　　</b><br><br></td>
							  <tr>
							    <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>執照津貼</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td015 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="right" valign="top"><br><b>　　</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>補充保費</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td035 ?></span></td>
							  </tr>
							
							 
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top">
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>日　　薪</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td007 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>資歷津貼</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" align="right" valign="top"><b><span><?php echo $row->td016 ?></span></td>
							  </tr>
							 
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>應領薪資</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td030 ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:20px" width="100" align="center" valign="top"><br><b>實領津貼</b><br><br></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:20px" width="100" align="right" valign="top"><b><span><?php echo $row->td039 ?></span></td>
							  </tr>
							
							 
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		  <tr>
					  <td colspan="9" align="left"><br><br>
						<b>備  註：</b><? echo trim($row->td042).'  '.trim($row->tc023);?>						
					  </td>
					</tr>
		 <tr><td valign="top">
				<table class="address" border=0 cellspacing=0 cellpadding=0 >
					<tr>
					 <td style="border: 0px solid #000000;" width="100%" align="right" valign="top"></td>
					</tr>
				</table>
			</td></tr>
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>