<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>採 購 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri07/printdetailc';location = url; </script> 
  <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=5;$page=1;$pagetot=1; ?>	
        <?php foreach($results as $row ) : ?>
		      <?php  $tc002 = $row->tc001.'-'.$row->tc002; ?>
              <?php  $tc024 = substr($row->tc024,0,4).'/'.substr($row->tc024,4,2).'/'.substr($row->tc024,6,2); ?>	
              <?php  $tc004 = $row->tc004; ?>
			  <?php  $tc004disp = $row->tc004disp; ?>
			  <?php  $tc004disp1 = $row->tc004disp1; ?>
			  <?php  $tc004disp2 = $row->tc004disp2; ?>
			  <?php  $tc004disp3 = $row->tc004disp3; ?>
			  <?php  $tc004disp4 = $row->tc004disp4; ?>
			  <?php  $tc004disp5 = $row->tc004disp5; ?>
              <?php  $tc005 = $row->tc005; ?>			  
              <?php  $tc005disp = $row->tc005disp; ?>
			   <?php  $tc011 = $row->tc011; ?>	
			  <?php  $tc011disp = $row->tc011disp; ?>
			   <?php  $tc027 = $row->tc027; ?>	
			  <?php  $tc027disp = $row->tc027disp; ?>
			  <?php  $tc018 = $row->tc018; ?>
			  <?php  $tc006 = $row->tc006; ?>
			  <?php  $tc026 = $row->tc026; ?>
			  <?php  $tc017 = $row->tc017; ?>
			  <?php  $tc007 = $row->tc007; ?>
			  <?php  $tc010 = $row->tc010; ?>
			  <?php  $tc009 = $row->tc009; ?>
			  <?php  $tc010disp = $row->tc010disp; ?>
			  <?php  $td003[] = $row->td003; ?>
		      <?php  $td004[] = $row->td004; ?>
			  <?php  $td005[] = $row->td005; ?>
			  <?php  $td006[] = $row->td006; ?>
			  <?php  $td008[] = round($row->td008,0); ?>
			  <?php  $td015[] = $row->td015; ?>
			  <?php  $td016[] = $row->td016; ?>
			  <?php  $td009[] = $row->td009; ?>
			  <?php  $td020[] = $row->td020; ?>
			  <?php  $td027[] = $row->td027; ?>
			  <?php  $td010[] = round($row->td010,2); ?>
			  <?php  $td011[] = round($row->td011,0); ?>
			  <?php  $td012[] = $row->td012; ?>
			  <?php  $td013[] = $row->td013; ?>
			  <?php  $td021[] = $row->td021; ?>
			  <?php  $td022[] = $row->td022; ?>
			  <?php  $td014[] = $row->td014; ?>
			  <?php  $td025[] = $row->td025; ?>
			  <?php  $td017disp[] = $row->td017disp; ?>
			  
			  <?php $rowtot++; ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/5); ?>
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
		  
			<tr><td class="title" align="center" valign="top">採  購  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>採購單號：</b><span><?php echo $tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tc024 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $tc004.' '.$tc004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><span><?php echo $tc005.' '.$tc005disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $tc018 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>採購人員：</b><?php echo $tc011.' '.$tc011disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $tc027.' '.$tc027disp ?></td>
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
					  <td align="center"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b></td>
					  <td align="center" width="180"><b>規格</b></td>
					  <td align="left"><b>單位</b></td>
					  <td align="right" width="40"><b>採購數量</b></td>
					  <td align="right" width="50"><b>採購單價</b></td>
					  <td align="right" width="60"><b>採購金額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $td004[$rownum];?></td>
					  <td align="left"><? echo $td005[$rownum];?></td>
					  <td align="left"><? echo $td006[$rownum];?></td>
					  <td align="left"><? echo $td009[$rownum];?></td>
					  <td align="right"><? echo $td008[$rownum];?></td>
					  <td align="right"><? echo $td010[$rownum];?></td>
					  <td align="right"><? echo $td011[$rownum];?></td>					 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備　　註：</b>
					  </td>
					</tr>
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
		  <br/>
		  
		  <!-- 第二頁 -->
		  <?php if($rowtot>=6) { ?> <div style="page-break-after: always;"></div>
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
			<tr><td class="title" align="center" valign="top">採  購  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>採購單號：</b><span><?php echo $tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tc024 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $tc004.' '.$tc004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><span><?php echo $tc005.' '.$tc005disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $tc018 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>採購人員：</b><?php echo $tc011.' '.$tc011disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $tc027.' '.$tc027disp ?></td>
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
			
			<tr><td valign="top">
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
			</td></tr>
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center"><b>品號</b></td>
					  <td align="center" width="250" ><b>品名</b></td>
					  <td align="center" width="180" ><b>規格</b></td>
					  <td align="left"><b>單位</b></td>
					  <td align="right" width="40"><b>採購數量</b></td>
					  <td align="right" width="50"><b>採購單價</b></td>
					  <td align="right" width="60"><b>採購金額</b></td>
					</tr>
					    <?php $rownum=0;  ?>
						<?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $td004[$rownum];?></td>
					  <td align="left"><? echo $td005[$rownum];?></td>
					  <td align="left"><? echo $td006[$rownum];?></td>
					  <td align="left"><? echo $td009[$rownum];?></td>
					  <td align="right"><? echo $td008[$rownum];?></td>
					  <td align="right"><? echo $td010[$rownum];?></td>
					  <td align="right"><? echo $td011[$rownum];?></td>					 
					</tr>
					<?php $rownum++; ?>
					<?php } ?>
					<?php for ($i=1; $i<=$pagespace; $i++) { ?>
					 <tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備　　註：</b>
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
			
			<tr><td class="title" align="center" valign="top">採  購  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>採購單號：</b><span><?php echo $tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tc024 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $tc004.' '.$tc004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><span><?php echo $tc005.' '.$tc005disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $tc018 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>採購人員：</b><?php echo $tc011.' '.$tc011disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $tc027.' '.$tc027disp ?></td>
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
			
			<tr><td valign="top">
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
			</td></tr>
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b></td>
					  <td align="center" width="180"><b>規格</b></td>
					  <td align="center"><b>單位</b></td>
					  <td align="right" width="40"><b>數量</b></td>
					  <td align="right" width="50"><b>單價</b></td>
					  <td align="right" width="60"><b>金額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $td004[$rownum];?></td>
					  <td align="left"><? echo $td005[$rownum];?></td>
					  <td align="left"><? echo $td006[$rownum];?></td>
					  <td align="left"><? echo $td009[$rownum];?></td>
					  <td align="center"><? echo $td008[$rownum];?></td>
					  <td align="right"><? echo $td010[$rownum];?></td>
					  <td align="right"><? echo $td011[$rownum];?></td>					 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					 <tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					 
					 <?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備　　註：</b>
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
