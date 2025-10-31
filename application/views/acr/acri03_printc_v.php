<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>收 款 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
 <?php exit;} ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=15;$page=1;$pagetot=1;$td009qty=0; $td030amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		       <?php  $tc001 = $row->tc001.' '.$row->tc001disp; ?>
			  <?php  $tc002 = $row->tc002; ?>
              <?php  $tc003 = substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2); ?>	
              <?php  $tc004 = $row->tc004.' '.$row->tc004disp; ?>
			  <?php  $tc008 = $row->tc008 ?>
			  <?php  $tc010 = $row->tc010.' '.$row->tc010disp; ?>
			  <?php  $tc005 = $row->tc005; ?>
			  <?php  $tc007 = $row->tc007; ?>
			  <?php  $tc008 = $row->tc008; ?>
			  <?php  $tc011 = $row->tc011; ?>
			  <?php  $tc012 = $row->tc012; ?>
			  <?php  $tc013 = $row->tc013; ?>
			  <?php  $tc014 = $row->tc014; ?>
			  
			  <?php  $td001[] = $row->td001; ?>
			  <?php  $td002[] = $row->td002.'-'.$row->td003; ?>
			  <?php  $td003[] = $row->td003; ?>
		      <?php  $td004[] = $row->td004; ?>
			  <?php  $td005[] = $row->td005; ?>
			  <?php  $td006[] = $row->td006; ?>
			  <?php  $td007[] = $row->td007; ?>
			  <?php  $td008[] = $row->td008; ?>
			  <?php  $td008disp[] = $row->td008disp; ?>
			 
			  <?php  $td010[] = $row->td010; ?>
			  <?php  $td011[] = $row->td011; ?>
			  <?php  $td012[] = round($row->td012,0); ?>
			  <?php  $td013[] = round($row->td013,0); ?>
			  <?php  $td014[] = round($row->td014,0); ?>
			  <?php  $td015[] = round($row->td015,0); ?>
			  <?php  $td016[] = $row->td016; ?>
			  <?php  $td017[] = $row->td017; ?>
			  <?php  $td019[] = $row->td019; ?>
			  
			 <?php $rowtot++;$td009qty=$td009qty+round($row->td014,0);$td030amt=$td030amt+round($row->td015,0); ?>
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
		  
			<tr><td class="title" align="center" valign="top">收  款  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>收款單別：</b><span><?php echo $tc001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>收款單號：</b><?php echo $tc002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $tc007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>收款日期：</b><span><?php echo $tc003 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱</b><span><?php echo $tc004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別</b><span><?php echo $tc010  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>確認：</b><?php echo $tc008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
			
		<!--	<tr><td valign="top">
				<table class="address">
					<tr>
					  <td width="50%" align="left" valign="top">
						<table width="100%">
						</table>
					  </td>
					  <td width="50%" align="left" valign="top">
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>  -->
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="10%"><b>借/貸</b><br><b>類別</b></td>
					  <td align="center" width="10%"><b>來源單別</b><br><b>科目代號</b><br><b>科目名稱</b></td>
					  <td align="right" width="10%"><b>立帳金額</b><br><b>立帳餘額</b></td>
					  <td align="right" width="8%"><b>原幣金額</b><br><b>本幣金額</b></td>
					  <td align="right" width="12%"><b>採購單號</b><br><b>備  註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					  <?php if ($row->td004==1)	{$td0041='借';} else   {$td0041='貸';} ?>					
					  <?php if ($row->td005=='1')	{$td0051='一般';} elseif ($row->td005=='2') {$td0051='票據';}  elseif ($row->td005=='3') {$td0051='待抵';}
		   elseif ($row->td005=='4') {$td0051='沖帳';}  elseif ($row->td005=='5') {$td0051='溢收';}  elseif ($row->td0051=='6') {$td0051='差額';} else   {$td0051='折讓';} ?>
					  <td align="left"><? echo $td004[$rownum].' '.$td0041;?><br><? echo $td005[$rownum].' '.$td0051;?></td>
					  <td align="left"><? echo $td006[$rownum];?><br><? echo $td008[$rownum];?><br><? echo $td008disp[$rownum];?></td>
					  <td align="right"><? echo $td012[$rownum];?><br><? echo $td013[$rownum];?></td>
					  <td align="right"><? echo $td014[$rownum];?><br><? echo $td015[$rownum];?></td>
					  <td align="right"><? echo $td019[$rownum];?><br><? echo $td017[$rownum];?></td>
					 		 
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
						<b>原幣借方金額：</b><? echo $tc011;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>原幣貸方金額：</b><? echo $tc012;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>差    額：</b><? echo $tc011-$tc012;?><br>
						<b>本幣借方金額：</b><? echo $tc013;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>本幣貸方金額：</b><? echo $tc014;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>差    額：</b><? echo $tc013-$tc014;?><br>
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
		  <?php if($rowtot>=11) { ?> <div style="page-break-after: always;"></div>
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
			<tr><td class="title" align="center" valign="top">收  款  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>收款單別：</b><span><?php echo $tc001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>收款單號：</b><?php echo $tc002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $tc007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>收款日期：</b><span><?php echo $tc003 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱</b><span><?php echo $tc004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別</b><span><?php echo $tc010  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>確認：</b><?php echo $tc008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
			
	<!--		<tr><td valign="top">
				<table class="address">
					<tr>
					  <td width="50%" align="left" valign="top">
						<table width="100%">
						</table>
					  </td>
					  <td width="50%" align="left" valign="top">
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>  -->
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="10%"><b>借/貸</b><br><b>類別</b></td>
					  <td align="center" width="10%"><b>來源單別</b><br><b>科目代號</b><br><b>科目名稱</b></td>
					  <td align="right" width="10%"><b>立帳金額</b><br><b>立帳餘額</b></td>
					  <td align="right" width="8%"><b>原幣金額</b><br><b>本幣金額</b></td>
					  <td align="right" width="12%"><b>採購單號</b><br><b>備  註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					  <?php if ($row->td004==1)	{$td0041='借';} else   {$td0041='貸';} ?>					
					  <?php if ($row->td005=='1')	{$td0051='一般';} elseif ($row->td005=='2') {$td0051='票據';}  elseif ($row->td005=='3') {$td0051='待抵';}
		   elseif ($row->td005=='4') {$td0051='沖帳';}  elseif ($row->td005=='5') {$td0051='溢收';}  elseif ($row->td0051=='6') {$td0051='差額';} else   {$td0051='折讓';} ?>
					  <td align="left"><? echo $td004[$rownum].' '.$td0041;?><br><? echo $td005[$rownum].' '.$td0051;?></td>
					  <td align="left"><? echo $td006[$rownum];?><br><? echo $td008[$rownum];?><br><? echo $td008disp[$rownum];?></td>
					  <td align="right"><? echo $td012[$rownum];?><br><? echo $td013[$rownum];?></td>
					  <td align="right"><? echo $td014[$rownum];?><br><? echo $td015[$rownum];?></td>
					  <td align="right"><? echo $td019[$rownum];?><br><? echo $td017[$rownum];?></td>
					 		 
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
						<b>原幣借方金額：</b><? echo $tc011;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>原幣貸方金額：</b><? echo $tc012;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>差    額：</b><? echo $tc011-$tc012;?><br>
						<b>本幣借方金額：</b><? echo $tc013;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>本幣貸方金額：</b><? echo $tc014;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>差    額：</b><? echo $tc013-$tc014;?><br>
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
		 <?php if($rowtot>=11) { ?> <div style="page-break-after: always;"></div>
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
			
			<tr><td class="title" align="center" valign="top">收  款  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>收款單別：</b><span><?php echo $tc001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>收款單號：</b><?php echo $tc002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $tc007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>收款日期：</b><span><?php echo $tc003 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱</b><span><?php echo $tc004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別</b><span><?php echo $tc010  ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>確認：</b><?php echo $tc008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
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
			
	<!--		<tr><td valign="top">
				<table class="address">
					<tr>
					  <td width="50%" align="left" valign="top">
						<table width="100%">
						</table>
					  </td>
					  <td width="50%" align="left" valign="top">
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>  -->
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="10%"><b>借/貸</b><br><b>類別</b></td>
					  <td align="center" width="10%"><b>來源單別</b><br><b>科目代號</b><br><b>科目名稱</b></td>
					  <td align="right" width="10%"><b>立帳金額</b><br><b>立帳餘額</b></td>
					  <td align="right" width="8%"><b>原幣金額</b><br><b>本幣金額</b></td>
					  <td align="right" width="12%"><b>採購單號</b><br><b>備  註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					  <?php if ($row->td004==1)	{$td0041='借';} else   {$td0041='貸';} ?>					
					  <?php if ($row->td005=='1')	{$td0051='一般';} elseif ($row->td005=='2') {$td0051='票據';}  elseif ($row->td005=='3') {$td0051='待抵';}
		   elseif ($row->td005=='4') {$td0051='沖帳';}  elseif ($row->td005=='5') {$td0051='溢收';}  elseif ($row->td0051=='6') {$td0051='差額';} else   {$td0051='折讓';} ?>
					  <td align="left"><? echo $td004[$rownum].' '.$td0041;?><br><? echo $td005[$rownum].' '.$td0051;?></td>
					  <td align="left"><? echo $td006[$rownum];?><br><? echo $td008[$rownum];?><br><? echo $td008disp[$rownum];?></td>
					  <td align="right"><? echo $td012[$rownum];?><br><? echo $td013[$rownum];?></td>
					  <td align="right"><? echo $td014[$rownum];?><br><? echo $td015[$rownum];?></td>
					  <td align="right"><? echo $td019[$rownum];?><br><? echo $td017[$rownum];?></td>
					 		 
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
						<b>原幣借方金額：</b><? echo $tc011;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>原幣貸方金額：</b><? echo $tc012;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>差    額：</b><? echo $tc011-$tc012;?><br>
						<b>本幣借方金額：</b><? echo $tc013;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>本幣貸方金額：</b><? echo $tc014;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>差    額：</b><? echo $tc013-$tc014;?><br>
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
