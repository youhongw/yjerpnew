<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>薪 資 條</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<style>
td{
	//height : 28px;
}
.company td{
	height : 55px;
}
.border_title{
	border: 1px solid #000000;background-color:#F0F0F0;
}
.border_title{
	border: 1px solid #000000;background-color:#F0F0F0;
}
</style>
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/palr45/printdetail';location = url; </script> 
  <?php } ?>
<?
if($mv032==3){//菲律賓
?>
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
				<td align="left" width="33%">Employee Number：&nbsp;<?php echo $row->td001;?></td>
				<td align="center" width="33%">Employee Payroll</td>
				<td align="right" width="33%">Year/Month：&nbsp;<?php echo substr($row->td005,0,4)."/".substr($row->td005,4,2); ?> 
				<br>Print date：&nbsp;<?php echo date("Y/m/d"); ?></td>
			</tr><!--
			  <tr><td  align="left" valign="top" style="border-bottom: 1px solid #000000" colspan="3" ><span><?php echo 'Employee Number：'.$row->td001 ?></span>　　　　　　　　　　
			  <span>Employee Payroll</span> 　　　　　　<?php echo 'Year/Month：'.$row->td005 ?></td></tr>-->
			<tr><td valign="top" colspan="3">
				<table class="order">
					<tr>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Name<br><br>姓　　名</b></td>
							  </tr>
							  <tr>
							  <td style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td002 ?></span></td>
							  </tr>
							  
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Base<br>Pay<br><br>本　　薪</b></td>
							  </tr>
							  <tr>
							  <td style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td008 ?></span></b></td>
							</tr>
							
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Overtime<br>Hours<br><br>延班時數</b></td>
							  </tr>
							<tr>
							   <td style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td017+$row->td019 ?></span></b></td>
							  
							</tr>
							
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Debt<br><br>借支扣款</b></td>
							  </tr>
							<tr>
							   <td style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td031 ?></span></b></td>
							
							</tr>
						<!--<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;"  colspan="9" align="right" valign="top"><b>備註：<?php echo $row->td031 ?></b></td>
							  </tr>
							
							 -->
							</tr>
						</table>
					  </td>
		
			          <!--  第二行  -->
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Days<br><br>天　　數</b></td>
							   <tr>
							  <td style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td006 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Position<br>Allowance<br><br>職務津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td009 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Overtime<br>Allowance<br><br>延班津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td018+$row->td020 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Labor Insurance<br>勞 保 費</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td033 ?></span></td>
							  </tr>
							  
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Lateness<br><br>遲　　到</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc004 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Chief<br>Allowance<br><br>主管津貼</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td010 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Saturday Overtime Allowance<br>週六津貼</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td021+$row->td023 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Health Insurance<br>健 保 費</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td034 ?></span></td>
							  </tr>
							  
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Leave Absence<br>事　　假</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc006 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Meals<br>Allowance<br><br>伙食津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td011 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Saturday Overtime Allowance<br>週六津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td022+$row->td024 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Tax<br><br>所 得 稅</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td037 ?></span></td>
							  </tr>
							  
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Sick Leave<br><br>病　　假</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc007 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Attendance Allowance<br><br>全勤獎金</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td012 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Overtime Hours for Sunday<br>國日延班</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td025+$row->td027 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Expenses for Food<br>伙 食 費</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td036 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Day Off<br><br>無 薪 假</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc010 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Special<br>Allowance<br><br>特別津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td013 ?></span></td>
							  </tr>
							  
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Sunday Overtime Allowance<br>國日津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td026+$row->td028 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Others Deduction<br>其他扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td038 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Add Counts<br><br>補正次數</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc005 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" idth="600" align="center" valign="top"><b>Efficiency<br>Bouns<br><br>業務津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td014 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Others<br>Pay<br><br>其　　他</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td029-$row->ta013 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Absense Deduction<br>請假扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td032 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b> <br>　　</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Licensse<br>Allowance<br><br>執照津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td015 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Performance<br>Bonus<br><br>績效獎金</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->ta013 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Add Insurance<br>補充保費</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td035 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr>
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Salary Perday<br>日　　薪</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td007 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Work Exerience Allowance<br>資歷津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td016 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Total<br><br><br>應領薪資</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td030 ?></span></td>
							  </tr>
							</tr>
							<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Real Pay<br><br>實領津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td039 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
<?}?>
<?
if($mv032==4){//越南
?>
<style>
table.order tr.title {
	height : 62px;
}
</style>
<body onLoad="window.print()">
          <!-- 第一頁 -->
		  <?php $paper9='1';$tprint='Y'; ?>
		  <?php if($paper9=="1")  { $tot=6;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1; $th008qty=0; $th013amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		    
		<table class="store">
		  <tr>
			<td class="logo1" align="center" valign="top" colspan="3" >
		    	<?php echo $this->session->userdata('sysml003'); ?>
			</td>
			 </tr>
			 <tr>
			
		  </tr>
			<tr>
				<td align="left" width="33%">Employee Number：&nbsp;<?php echo $row->td001;?></td>
				<td align="center" width="33%">Employee Payroll</td>
				<td align="right" width="33%">Year/Month：&nbsp;<?php echo substr($row->td005,0,4)."/".substr($row->td005,4,2); ?> 
				<br>Print date：&nbsp;<?php echo date("Y/m/d"); ?></td>
			</tr>
			  <!--<tr><td  align="left" valign="top" style="border-bottom: 1px solid #000000" ><span><?php echo 'Employee Number：'.$row->td001 ?></span>　　　　　　　　　　
			  <span>Employee Payroll</span> 　　　　　　<?php echo 'Year/Month：'.$row->td005 ?></td></tr>-->
			<tr><td valign="top" colspan="3">
				<table class="order">
					<tr>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Họ tên<br><br>姓　　名</b></td>
							  </tr>
							  <tr>
							  <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td002 ?></span></td>
							  </tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Lương cơ bản<br>本　　薪</b></td>
							  </tr>
							  <tr>
							  <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td008 ?></span></b></td>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Thời gian làm thêm giờ<br>延班時數</b></td>
							  </tr>
							<tr>
							   <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td017+$row->td019 ?></span></b></td>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trừ tiền Khoản vay<br>借支扣款</b></td>
							  </tr>
							<tr>
							   <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td031 ?></span></b></td>
							</tr>
						<!--<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;"  colspan="9" align="right" valign="top"><b>備註：<?php echo $row->td031 ?></b></td>
							 </tr>-->
							</tr>
						</table>
					  </td>
			          <!--  第二行  -->
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Số ngày<br><br>天　　數</b></td>
							   <tr>
							  <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td006 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp làm việc<br>職務津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td009 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp làm thêm giờ<br><br>延班津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td018+$row->td020 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Phí Bảo hiểm lao động<br>勞 保 費</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td033 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Đi muộn<br><br>遲　　到</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc004 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp chức vụ<br>主管津貼</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td010 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Làm thêm ngày thứ 7<br><br>週六延班</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td021+$row->td023 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Phí bảo hiểm Y tế<br>健 保 費</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td034 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Nghỉ phép<br><br>事　　假</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc006 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp tiền ăn<br>伙食津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td011 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp làm them ngày thứ 7<br>週六津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td022+$row->td024 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Thuế thu nhập<br>所 得 稅</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td037 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Nghỉ ốm<br><br>病　　假</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc007 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Thưởng chuyên cần<br>全勤獎金</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td012 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Làm them chủ nhật<br><br>週日延班</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td025+$row->td027 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Phí ăn ở<br><br>伙 食 費</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td036 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Nghỉ không lương<br>無 薪 假</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc010 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp đặc biệt<br>特別津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td013 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp làm thêm chủ nhật<br>週日津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td026+$row->td028 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Các khoản trừ khác<br>其他扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td038 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Số lần bù<br><br>補正次數</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc005 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" idth="600" align="center" valign="top"><b>Trợ cấp nghiệp vụ<br>業務津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td014 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Các khoản khác<br><br>其　　他</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td029-$row->ta013 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trừ tiền nghỉ phép<br>請假扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td032 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b> <br>　　</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp bằng cấp<br>執照津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td015 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>hiệu suất thưởng<br><br>績效獎金</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->ta013 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Bổ xung phí bảo hiểm<br>補充保費</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td035 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Ngày lương<br><br>日　　薪</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td007 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Trợ cấp kinh nghiệm<br>資歷津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td016 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Tổng tiền lương làm trong tháng<br>應領薪資</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td030 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Tổng lương thực lĩnh<br>實領津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td039 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  
		<div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
<?}?>
<?
if($mv032==5){//印尼
?>
<style>
table.order tr.title {
	height : 73px;
}
</style>
<body onLoad="window.print()">
          <!-- 第一頁 -->
		  <?php $paper9='1';$tprint='Y'; ?>
		  <?php if($paper9=="1")  { $tot=6;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1; $th008qty=0; $th013amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		    
		<table class="store">
		  <tr>
			<td class="logo1" align="center" valign="top" colspan="3" >
		    	<?php echo $this->session->userdata('sysml003'); ?>
			</td>
			 </tr>
			 <tr>
			
		  </tr>
			<tr>
				<td align="left" width="33%">Nomor pekerja：&nbsp;<?php echo $row->td001;?></td>
				<td align="center" width="33%">Công ty TNHH Cổ phần Der Sheng</td>
				<td align="right" width="33%">Tháng/ Năm：&nbsp;<?php echo substr($row->td005,0,4)."/".substr($row->td005,4,2); ?> 
				<br>Tanggal cetak：&nbsp;<?php echo date("Y/m/d"); ?></td>
			</tr>
			  <!--<tr><td  align="left" valign="top" style="border-bottom: 1px solid #000000" ><span><?php echo 'Employee Number：'.$row->td001 ?></span>　　　　　　　　　　
			  <span>Employee Payroll</span> 　　　　　　<?php echo 'Year/Month：'.$row->td005 ?></td></tr>-->
			<tr><td valign="top" colspan="3">
				<table class="order">
					<tr>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>nama<br><br><br>姓　　名</b></td>
							  <tr>
							  <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td002 ?></span></td>
							  </tr>
							 </tr>
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>gaji pokok<br><br><br>本　　薪</b></td>
							  <tr>
							  <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td008 ?></span></b></td>
								</tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>jumlah jam kerja yang digeser<br><br>延班時數</b></td>
							  <tr>
							   <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td017+$row->td019 ?></span></b></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>potongan pinjaman<br><br>借支扣款</b></td>
						      <tr>
							   <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td031 ?></span></b></td>
							  </tr>
							</tr>
						<!--<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;"  colspan="9" align="right" valign="top"><b>備註：<?php echo $row->td031 ?></b></td>
							 </tr>-->
							</tr>
						</table>
					  </td>
			          <!--  第二行  -->
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>jumah hari<br><br><br>天　　數</b></td>
							   <tr>
							  <td style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td006 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tunjangan jabatan<br><br>職務津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td009 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tunjangan geser jam kerja<br><br>延班津貼</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td018+$row->td020 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>asuransi tenaga kerja<br>勞 保 費</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px;" width="100" align="center" valign="top"><b><span><?php echo $row->td033 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>terlambat<br><br><br>遲　　到</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc004 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tunjangan pimpinan<br><br>主管津貼</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td010 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>perpanjang kerja<br><br><br>週六延班</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td021+$row->td023 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>asuransi kesehatan<br><br>健 保 費</b></td>
							  	   <tr>
							   <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td034 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>izin<br><br><br>事　　假</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc006 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tunjangan makan<br><br>伙食津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td011 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tunjangan hari sabtu<br><br><br>週六津貼</b></td>
							  	   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td022+$row->td024 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>pajak penghasilan<br><br>所 得 稅</b></td>
							   <tr>
							  <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td037 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					  <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>izin sakit<br><br><br>病　　假</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc007 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>bonus kehadiran<br><br>全勤獎金</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td012 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>Làm them chủ nhật<br><br><br>週日延班</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td025+$row->td027 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>biaya makan<br><br>伙 食 費</b></td>
							   <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td036 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>libur tanpa gaji<br><br>無 薪 假</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc010 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tunjangan khusus<br><br>特別津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td013 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>pergeseran shift kerja di hariminggu<br>週日津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td026+$row->td028 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>potongan lainnya<br><br>其他扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td038 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>koreksi<br><br><br>補正次數</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->tc005 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" idth="600" align="center" valign="top"><b>bonuskerja<br><br><br>業務津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td014 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>lain-lain<br><br><br><br>其　　他</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td029-$row->ta013 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>potong gaji karena izin kerja<br>請假扣款</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td032 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>bonus prestasi<br><br>績效獎金</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->ta013 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>bonus izin profesi<br><br>執照津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td015 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>  <br> <br>　</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo '0' ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>tambahan asuransi<br><br>補充保費</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td035 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="right" valign="top" >
						<table class="company">
							<tr style="height:55px;">
							  <td style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>gaji harian<br><br><br>日　　薪</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td007 ?></span></td>
							  </tr>
							</tr>
							<tr style="height:55px;">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>bonus senior<br><br><br>資歷津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td016 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>jumlah yang seharusnyaditerima<br><br><br>應領薪資</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td030 ?></span></td>
							  </tr>
							</tr>
							<tr class="title">
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;" width="100" align="center" valign="top"><b>jumlah gaji yang<br>di terima<br><br>實領津貼</b></td>
							  <tr>
							    <td  style="border: 1px solid #000000;height:15px" width="100" align="center" valign="top"><b><span><?php echo $row->td039 ?></span></td>
							  </tr>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>

		<div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
<?}?>
</body>
</html>