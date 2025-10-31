<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>報 價 單</title>
<base href="http://ci.youhongwang.com/" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>

  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi05/printdetailc';location = url; </script> 
  <?php exit;} ?>
 
<body onLoad="window.print()">
        <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=22;$page=1;$pagetot=1;$td009qty=0; $td030amt=0; ?>
        <?php foreach($results as $row ) : ?>
		      <?php  $ta001 = $row->ta001.' '.$row->ta001disp; ?>
			  <?php  $ta002 = $row->ta002; ?>
			 
              <?php  $ta003 = substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2); ?>	
              <?php  $ta004 = $row->ta004; ?>
			  <?php  $ta004disp = $row->ta004disp; ?>
              <?php  $ta005 = $row->ta005.' '.$row->ta005disp; ?>
              <?php  $ta007 = $row->ta007.' '.$row->ta007disp; ?>
			  <?php  $ta009 = $row->ta009; ?>
			  <?php  $ta010 = $row->ta010; ?>
			  <?php  $ta011 = $row->ta011; ?>
			  <?php  $ta012 = $row->ta012; ?>
			  <?php  $ta014 = $row->ta014; ?>
			  <?php  $ta022 = $row->ta022; ?>
			  <?php  $ta020 = $row->ta020; ?>
			  <?php  $ta023 = $row->ta023; ?>
			  <?php  $ta025 = $row->ta025; ?>
			
		      <?php  $tb004[] = $row->tb004; ?>
			  <?php  $tb005[] = $row->tb005; ?>
			  <?php  $tb006[] = $row->tb006; ?>
			  <?php  $tb007[] = $row->tb007; ?>
			   <?php  $tb008[] = $row->tb008; ?>
			  <?php  $tb009[] = round($row->tb009,2); ?>
			   <?php  $tb010[] = round($row->tb010,0); ?>
		      <?php  $tb012[] = $row->tb012; ?>
			  <?php  $tb016[] = $row->tb016; ?>
			  <?php  $tb017[] = $row->tb017; ?>
			  <?php $rowtot++; ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/$pagerow); ?>
        <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		{$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
		
        <?php if ($ta022=='1') {$ta022disp='內含稅額';} elseif ($ta022=='2') {$ta022disp='外加稅額';}
		elseif ($ta022=='3') {$ta022disp='零稅率';} elseif ($ta022=='4') {$ta022disp='免額';}
		elseif ($ta022=='9') {$ta022disp='不計稅';} else {$ta022disp='';} ?>		
		<table class="store">
		<tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml012'); ?><br>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			</td>
		  </tr>
			<tr><td class="title" align="center" valign="top">報  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $ta007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $ta022.$ta022disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交 貨 日：</b><?php echo '訂貨日起 '.$ta014.' 日內' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $ta004.' '.$ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $ta010 ?></td>
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
				<table >
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
					  <td align="center" width="110"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="50"><b>數量</b><br><b>單價</b></td>
					   <td align="right" width="50"><b>單位</b><br><b>金額</b></td>
					  <td align="right" width="60"><b>生效日</b><br><b>失效日</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb006[$rownum];?></td>
					  <td align="left"><? echo $tb007[$rownum];?><br><? echo $tb009[$rownum];?></td>
					   <td align="left"><? echo $tb008[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb016[$rownum];?><br><? echo $tb017[$rownum];?></td>
					  <td align="right"><? echo $tb012[$rownum];?></td>					 
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
								 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="6" align="left">
						<b>數量合計：<?php echo $ta025 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo $ta009 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $ta023 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $ta009+$ta023 ?></b>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		  <br>
		  <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
		  <br/>
		  
		   <!-- 第二頁 -->
		  <?php if($rowtot-$pagerow>=0) { ?> <div style="page-break-after: always;"></div>
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
			<tr><td class="title" align="center" valign="top">報  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $ta007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $ta022.$ta022disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交 貨 日：</b><?php echo '訂貨日起 '.$ta014.' 日內' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $ta004.' '.$ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $ta010 ?></td>
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
				<table >
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
					  <td align="center" width="110"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="50"><b>數量</b><br><b>單價</b></td>
					   <td align="right" width="50"><b>單位</b><br><b>金額</b></td>
					  <td align="right" width="60"><b>生效日</b><br><b>失效日</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb006[$rownum];?></td>
					  <td align="left"><? echo $tb007[$rownum];?><br><? echo $tb009[$rownum];?></td>
					   <td align="left"><? echo $tb008[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb016[$rownum];?><br><? echo $tb017[$rownum];?></td>
					  <td align="right"><? echo $tb012[$rownum];?></td>					 
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
								 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="6" align="left">
						<b>數量合計：<?php echo $ta025 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo $ta009 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $ta023 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $ta009+$ta023 ?></b>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		  <br>
		  <table>
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
			<tr><td class="title" align="center" valign="top">報  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $ta007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><?php echo $ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>報價單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課稅別：</b><?php echo $ta022.$ta022disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交 貨 日：</b><?php echo '訂貨日起 '.$ta014.' 日內' ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $ta004.' '.$ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>價格條件：</b><?php echo $ta010 ?></td>
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
				<table >
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
					  <td align="center" width="110"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="50"><b>數量</b><br><b>單價</b></td>
					   <td align="right" width="50"><b>單位</b><br><b>金額</b></td>
					  <td align="right" width="60"><b>生效日</b><br><b>失效日</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb006[$rownum];?></td>
					  <td align="left"><? echo $tb007[$rownum];?><br><? echo $tb009[$rownum];?></td>
					   <td align="left"><? echo $tb008[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb016[$rownum];?><br><? echo $tb017[$rownum];?></td>
					  <td align="right"><? echo $tb012[$rownum];?></td>					 
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
								 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="6" align="left">
						<b>數量合計：<?php echo $ta025 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;報價金額：<?php echo $ta009 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;稅額：<?php echo $ta023 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $ta009+$ta023 ?></b>
					  </td>
					</tr>
				</table>
			</td></tr>
		  </table>
		  <br>
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
