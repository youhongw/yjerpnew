<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>銷 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
 <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=13;$page=1;$pagetot=1;$ta033qty=0; $ta035amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		      <?php  $ta001 = $row->ta001; ?>
			  <?php  $ta002 = $row->ta002; ?>
              <?php  $ta003 = $row->ta003; ?>
              <?php  $ta004 = $row->ta004; ?>
			  <?php  $ta005 = $row->ta005; ?>
			  <?php  $ta006 = $row->ta006; ?>
              <?php  $ta007 = $row->ta007; ?>
              <?php  $ta008 = $row->ta008; ?>
			  <?php  $ta009 = $row->ta009; ?>
			  <?php  $ta010 = $row->ta010; ?>
			  <?php  $ta011 = $row->ta011; ?>
			  <?php  $ta012 = $row->ta012; ?>
			  <?php  $ta013 = $row->ta013; ?>
			  <?php  $ta014 = $row->ta014; ?>
			  <?php  $ta015 = $row->ta015; ?>
			  <?php  $ta016 = $row->ta016; ?>
			  <?php  $ta017 = $row->ta017; ?>
			  <?php  $ta018 = $row->ta018; ?>
			  <?php  $ta019 = $row->ta019; ?>
			  <?php  $ta020 = $row->ta020; ?>
			  <?php  $ta021 = $row->ta021; ?>
			  <?php  $ta022 = $row->ta022; ?>
			  <?php  $ta023 = $row->ta023; ?>
			  <?php  $ta024 = $row->ta024; ?>
			  <?php  $ta025 = $row->ta025; ?>
			  <?php  $ta026 = $row->ta026; ?>
			  <?php  $ta027 = $row->ta027; ?>
			  <?php  $ta028 = $row->ta028; ?>
			  <?php  $ta029 = $row->ta029; ?>
			  
			  <?php  $ta030[] = $row->ta030; ?>
			  <?php  $ta031[] = $row->ta031; ?>
			  <?php  $ta032[] = $row->ta032; ?>
			  <?php  $ta033[] = $row->ta033; ?>
			  <?php  $ta034[] = $row->ta034; ?>
			  <?php  $ta035[] = $row->ta035; ?>
			  
			  
			 <?php $rowtot++;$ta009qty=$ta033qty+round($row->ta033,0);$ta035amt=$ta035amt+round($row->ta035,0); ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/$pagerow); ?>
        <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		{$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
				 
		<table class="store">
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml003'); ?> <br>
			<?php echo $this->session->userdata('sysml012'); ?><br>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">銷 貨 單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					   <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>訂單編號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人姓名：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>發票抬頭：</b><?php echo $ta013 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>收件人姓名：</b><?php echo $ta008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
						</td>
									  
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨日期：</b><?php echo $ta001 ?></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人電話：</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>統一編號：</b><span><?php echo $ta014  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>收件人電話：</b><span><?php echo $ta009  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>入帳日期：</b><?php echo substr($ta001,0,10) ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人手機：</b><span><?php echo $ta005 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr> 
							<tr>
							  <td width="600" align="left" valign="top"><b>收件人手機：</b><span><?php echo $ta010 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr> 
							
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $page.'/'.$pagetot ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
			    
			<tr><td valign="top">
				<table class="company" >
					<tr>
					  <td width="100%" align="left" valign="top"><b>購置人地址：</b><?php echo $ta006 ?>
					  </td>
					  </tr>
					   <tr>
					  <td width="100%" align="left" valign="top"><b>送貨人地址：</b><?php echo $ta006 ?>				   
					  </td>
					</tr>
				</table>
			</td></tr>  
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="10%"><b>商品編號</b></td>
					  <td align="center" width="40%"><b>訂單商品</b><br><b>訂單規格</b></td>
					  <td align="right" width="10%"><b>數  量</b></td>
					  <td align="right" width="8%"><b>單  價</b></td>
					  <td align="right" width="12%"><b>金  額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					 
					  <td align="left"><? echo $ta031[$rownum];?></td>
					  <td align="left"><? echo $ta030[$rownum];?><br><? echo $ta032[$rownum];?></td>
					  <td align="right"><? echo $ta033[$rownum];?></td>
					  <td align="right"><? echo $ta034[$rownum];?></td>
					  <td align="right"><? echo $ta035[$rownum];?></td>
					 		 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="5" align="left">
						<b>購買備註：</b><? echo $ta028;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>商品總額：</b><? echo $ta035amt;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>折後金額：</b><? echo $ta020;?><br>
						<b>訂單備註：</b><? echo $ta029;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>優惠折扣：</b><? echo ' ';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>運    費：</b><? echo $ta018;?><br>
						<b>預計到貨：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>促銷活動：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>應收總額：</b><? echo $ta021;?><br>
						<b>付款方式：</b><? echo trim($ta015);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>配送方式：</b><? echo trim($ta016);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>託 運 單：</b><? echo trim($ta026);?><br>
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
	<!--	  <table class="footer">  -->
		  <table >
		     <br>
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		  <br/>
		  
		  <!-- 第二頁 -->
		  <?php if($rowtot>=13) { ?> <div style="page-break-after: always;"></div>
		  <?php $page +=1; ?> 
          <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		     {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
		  <table class="store">
			<tr>
			  <td class="logo" align="center" valign="top">
				<?php echo $this->session->userdata('sysml003'); ?> <br>
				<?php echo $this->session->userdata('sysml012'); ?><br>
				<?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
				<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			  </td>
			</tr>
				<tr><td class="title" align="center" valign="top">銷 貨 單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					   <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>訂單編號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人姓名：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>發票抬頭：</b><?php echo $ta013 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>收件人姓名：</b><?php echo $ta008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
						</td>
									  
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨日期：</b><?php echo $ta001 ?></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人電話：</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>統一編號：</b><span><?php echo $ta014  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>收件人電話：</b><span><?php echo $ta009  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>入帳日期：</b><?php echo substr($ta001,0,10) ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人手機：</b><span><?php echo $ta005 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr> 
							<tr>
							  <td width="600" align="left" valign="top"><b>收件人手機：</b><span><?php echo $ta010 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr> 
							
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $page.'/'.$pagetot ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
			    
			<tr><td valign="top">
				<table class="company" >
					<tr>
					  <td width="100%" align="left" valign="top"><b>購置人地址：</b><?php echo $ta006 ?>
					  </td>
					  </tr>
					   <tr>
					  <td width="100%" align="left" valign="top"><b>送貨人地址：</b><?php echo $ta006 ?>				   
					  </td>
					</tr>
				</table>
			</td></tr>  
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="10%"><b>商品編號</b></td>
					  <td align="center" width="40%"><b>訂單商品</b><br><b>訂單規格</b></td>
					  <td align="right" width="10%"><b>數  量</b></td>
					  <td align="right" width="8%"><b>單  價</b></td>
					  <td align="right" width="12%"><b>金  額</b></td>
					</tr>
					  <?php // $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					 
					  <td align="left"><? echo $ta031[$rownum];?></td>
					  <td align="left"><? echo $ta030[$rownum];?><br><? echo $ta032[$rownum];?></td>
					  <td align="right"><? echo $ta033[$rownum];?></td>
					  <td align="right"><? echo $ta034[$rownum];?></td>
					  <td align="right"><? echo $ta035[$rownum];?></td>
					 		 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					 <td colspan="5" align="left">
						<b>購買備註：</b><? echo $ta028;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>商品總額：</b><? echo $ta035amt;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>折後金額：</b><? echo $ta020;?><br>
						<b>訂單備註：</b><? echo $ta029;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>優惠折扣：</b><? echo ' ';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>運    費：</b><? echo $ta018;?><br>
						<b>預計到貨：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>促銷活動：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>應收總額：</b><? echo $ta021;?><br>
						<b>付款方式：</b><? echo trim($ta015);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>配送方式：</b><? echo trim($ta016);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>託 運 單：</b><? echo trim($ta026);?><br>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		  <table class="footer">
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		  <br/>
		 <?php } ?> 
		 
		<!-- 第三頁 -->
		 <?php if($rowtot>=13) { ?> <div style="page-break-after: always;"></div>
		 <?php $page +=1; ?> 
         <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		   {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
		 <table class="store">
		    <tr>
			  <td class="logo" align="center" valign="top">
			  <?php echo $this->session->userdata('sysml003'); ?> <br>
			  <?php echo $this->session->userdata('sysml012'); ?><br>
			  <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			  <?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			  </td>
			</tr>
			
				<tr><td class="title" align="center" valign="top">銷 貨 單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					   <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>訂單編號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人姓名：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>發票抬頭：</b><?php echo $ta013 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>收件人姓名：</b><?php echo $ta008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
						</td>
									  
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨日期：</b><?php echo $ta001 ?></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人電話：</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>統一編號：</b><span><?php echo $ta014  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>收件人電話：</b><span><?php echo $ta009  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>入帳日期：</b><?php echo substr($ta001,0,10) ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>購買人手機：</b><span><?php echo $ta005 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr> 
							<tr>
							  <td width="600" align="left" valign="top"><b>收件人手機：</b><span><?php echo $ta010 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr> 
							
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $page.'/'.$pagetot ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
			    
			<tr><td valign="top">
				<table class="company" >
					<tr>
					  <td width="100%" align="left" valign="top"><b>購置人地址：</b><?php echo $ta006 ?>
					  </td>
					  </tr>
					   <tr>
					  <td width="100%" align="left" valign="top"><b>送貨人地址：</b><?php echo $ta006 ?>				   
					  </td>
					</tr>
				</table>
			</td></tr>  
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="10%"><b>商品編號</b></td>
					  <td align="center" width="40%"><b>訂單商品</b><br><b>訂單規格</b></td>
					  <td align="right" width="10%"><b>數  量</b></td>
					  <td align="right" width="8%"><b>單  價</b></td>
					  <td align="right" width="12%"><b>金  額</b></td>
					</tr>
					  <?php // $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					 
					  <td align="left"><? echo $ta031[$rownum];?></td>
					  <td align="left"><? echo $ta030[$rownum];?><br><? echo $ta032[$rownum];?></td>
					  <td align="right"><? echo $ta033[$rownum];?></td>
					  <td align="right"><? echo $ta034[$rownum];?></td>
					  <td align="right"><? echo $ta035[$rownum];?></td>
					 		 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>
					 
					 <?php } ?>
					<tr>
					  <td colspan="5" align="left">
						<b>購買備註：</b><? echo $ta028;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>商品總額：</b><? echo $ta035amt;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>折後金額：</b><? echo $ta020;?><br>
						<b>訂單備註：</b><? echo $ta029;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>優惠折扣：</b><? echo ' ';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>運    費：</b><? echo $ta018;?><br>
						<b>預計到貨：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>促銷活動：</b><? echo '';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>應收總額：</b><? echo $ta021;?><br>
						<b>付款方式：</b><? echo trim($ta015);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>配送方式：</b><? echo trim($ta016);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>託 運 單：</b><? echo trim($ta026);?><br>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		<!--  <table class="footer">  -->
		  <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		  <br/>
		 <?php } ?>  
</body>
</html>
