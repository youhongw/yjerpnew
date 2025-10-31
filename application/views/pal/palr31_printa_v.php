<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>薪 資 條</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<style>
.company td{
	font-size:14px;
	
}

</style>
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/palr31/printdetail';location = url; </script> 
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
			<td class="logo1" align="center" valign="center">
		    	<?php echo $this->session->userdata('sysml003'); ?>
			</td>
			 </tr>
			 <tr>
			
		  </tr>
			  <tr><td  align="left" valign="center" style="border-bottom: 1px solid #000000" ><span><?php echo '員工代號：'.$row->yh002 ?></span>　　　　　　　　　　
			  一０七年度年終獎金明細 　　　　　　<?php echo '年度：'.$row->yh001 ?></td></tr>
			<tr><td valign="center">
				<table class="order">
					<tr>
					  <td width="10%" align="center" valign="center">  
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>部　　門</b></td>
							  </tr>
							  <tr>
							  <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh006 ?></span></td>
							  </tr>
							 
							  
							  <tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>年度全勤</b></td>
							  </tr>
							  <tr>
							  <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh019 ?></span></b></td>
							  </tr>
							
							  
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>扣繳5%稅率</b></td>
							  </tr>
							<tr>
							   <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh052 ?></span></b></td>
							  
							</tr>
							
							  
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  </tr>
							<tr>
							   <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></b></td>
							
							</tr>
							</tr>
							  
					<!--		<tr>
							  <td  style="border: 1px solid #000000;background-color:#F0F0F0;height:35px"  colspan="9" align="center" valign="center"><b>備註：<?php echo $row->td031 ?></b></td>
							  </tr>
							
							<tr>
							  <td width="90" align="center" valign="center"><b>　</b></td>
							  </tr> -->
						</table>
					  </td>  
		
			          <!--  第二行  -->
					  <td width="10%" align="center" valign="center">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>職　　稱</b></td>
							   <tr>
							  <td style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh007 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>核發天數</b></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh037 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>扣繳稅額</b></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php if ($row->yh053 > 0) { echo $row->yh053; } ?><?php if ($row->yh053 <= 0) { echo "0"; } ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							 
							 
							</tr>
						</table>
					  </td>
					  <td width="10%" align="center" valign="center">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>姓　　名</b></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh005 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>日　　薪</b></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh025 ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>扣健保2%</b></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh054 ?></span></td>
							  </tr>
							
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  	   <tr>
							   <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							
							
							</tr>
						</table>
					  </td>
					  <td width="10%" align="center" valign="center">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>遲到天數</b></td>
							  	   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh015 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>年終獎金</b></td>
							  	   <tr>
								   
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php if ($row->yh046=="2")  {echo $row->yh051-$row->yh034;}   ?><?php if ($row->yh046=="1")  {echo $row->yh051;}   ?></span></td>

							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>現金發放</b></td>
							  	   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh056  ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							   <tr>
							  <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							 
							 
							</tr>
						</table>
					  </td>
					  <td width="10%" align="center" valign="center">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>病假(日)</b></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh016 ?></span></td>
							  </tr>
							
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>免稅獎金</b></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php if ($row->yh046=='2') { echo $row->yh034;}  ?><?php if ($row->yh046=="1")  {echo '0';}   ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>轉帳發放</b></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh057 ?></span></td>
							  </tr>
							
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							   <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							
							  <td align="center" valign="center"></td>
							</tr>
						</table>
					  </td>
					   <td width="10%" align="center" valign="center">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>事(曠)假日</b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh017 ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							 
							  
							</tr>
							<tr>
							  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							
							
							</tr>
						</table>
					  </td>
					   <td width="10%" align="center" valign="center">
						<table class="company">
							<tr>
							  <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b>功過加減日</b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh018 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" idth="600" align="center" valign="center"><b>應領獎金</b></td>
							  <tr>
							    
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo $row->yh051 ?></span></td>
							  </tr>
							
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
							  </tr>
							 
							 
							</tr>
							<tr>
							  <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;background-color:#F0F0F0;height:35px" width="90" align="center" valign="center"><b></b></td>
							  <tr>
							    <td  style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 2px solid #000000;height:35px" width="90" align="center" valign="center"><b><span><?php echo '' ?></span></td>
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
						<b>備  註：</b><? echo $row->yh044;?>						
					  </td>
					</tr>
		 <tr><td valign="center">
				<table class="address" border=0 cellspacing=0 cellpadding=0 >
					<tr>
					 <td style="border: 0px solid #000000;" width="100%" align="center" valign="center"></td>
					</tr>
				</table>
			</td></tr>
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>