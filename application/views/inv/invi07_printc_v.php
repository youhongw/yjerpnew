<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>成 本 開 帳 單</title>
<base href="http://ci.youhongwang.com/" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
  <?php } ?>
<body onLoad="window.print()">
        <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=7;$page=1;$pagetot=1;$td009qty=0; $td030amt=0; ?>
        <?php foreach($results as $row ) : ?>
		    <?php  $tj001 = $row->tj001.' '.$row->tj001disp; ?>
			  <?php  $tj002 = $row->tj002; ?>
			 
              <?php  $tj003 = substr($row->tj003,0,4).'/'.substr($row->tj003,4,2).'/'.substr($row->tj003,6,2); ?>	
              <?php  $tj004 = $row->tj004.' '.$row->tj004disp; ?>
              <?php  $tj005 = $row->tj005.' '.$row->tj005disp; ?>
              <?php  $tj007 = $row->tj007; ?>
			  <?php  $tj008 = $row->tj008; ?>
			  <?php  $tj009 = $row->tj009; ?>
			  <?php  $tj010 = $row->tj010; ?>
			  <?php  $tj011 = $row->tj011; ?>
			  <?php  $tj012 = substr($row->tj012,0,4).'/'.substr($row->tj012,4,2).'/'.substr($row->tj012,6,2); ?>	
			  <?php  $tj014 = $row->tj014; ?>
			  <?php  $tj015 = $row->tj015; ?>
			
		      <?php  $tk004[] = $row->tk004; ?>
			  <?php  $tk005[] = $row->tk005; ?>
			  <?php  $tk006[] = $row->tk006; ?>
		      <?php  $tk006disp[] = $row->tk006disp; ?>
			  <?php  $tk007[] = $row->tk007; ?>
			  <?php  $tk016[] = $row->tk016; ?>
		      <?php  $tk017[] = $row->tk017; ?>
			  <?php  $tk017disp[] = $row->tk017disp; ?>
		      <?php  $tk019[] = $row->tk019; ?>
			  <?php  $tk022[] = $row->tk022; ?>
			  <?php $rowtot++; ?>
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
			<tr><td class="title" align="center" valign="top">開  帳  調  整  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單別：</b><span><?php echo $tj001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tj012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $tj005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單號：</b><?php echo $tj002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>總數量：</b><?php echo $tj007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>總金額：</b><?php echo $tj008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><?php echo $tj004 ?></td>
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
					  <td align="center" width="110"><b>品  號</b></td>
					  <td align="center" width="250"><b>品  名</b><br><b>規  格</b></td>
					   <td align="right" width="50"><b>單位</b><br><b>有效日期</b></td>
					  <td align="right" width="60"><b>庫別</b><br><b>庫別名稱</b></td>
					   <td align="right" width="50"><b>數量</b><br><b>金額</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;$tk007a=0;$tk016a=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tk004[$rownum];?></td>
					  <td align="left"><? echo $tk005[$rownum];?><br><? echo $tk006[$rownum];?></td>
					   <td align="right"><? echo $tk006disp[$rownum];?><br><? echo $tk019[$rownum];?></td>
					  <td align="right"><? echo $tk017[$rownum];?><br><? echo $tk017disp[$rownum];?></td>
					   <td align="right"><? echo $tk007[$rownum];?><br><? echo $tk016[$rownum];?></td>
					  <td align="right"><? echo $tk022[$rownum];?></td>					 
					</tr>
					   <?php $tk007a=$tk007a+$tk007[$rownum];$tk016a=$tk016a+$tk016[$rownum];$rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="6" align="right">
						<b>數量合計：<?php echo $tk007a ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $tk016a ?></b>
						
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
			<tr><td class="title" align="center" valign="top">開  帳  調  整  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單別：</b><span><?php echo $tj001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tj012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $tj005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單號：</b><?php echo $tj002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>總數量：</b><?php echo $tj007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>總金額：</b><?php echo $tj008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><?php echo $tj004 ?></td>
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
					  <td align="center" width="110"><b>品  號</b></td>
					  <td align="center" width="250"><b>品  名</b><br><b>規  格</b></td>
					   <td align="right" width="50"><b>單位</b><br><b>有效日期</b></td>
					  <td align="right" width="60"><b>庫別</b><br><b>庫別名稱</b></td>
					   <td align="right" width="50"><b>數量</b><br><b>金額</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php // $rownum=0;$tk007a=0;$tk016a=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tk004[$rownum];?></td>
					  <td align="left"><? echo $tk005[$rownum];?><br><? echo $tk006[$rownum];?></td>
					   <td align="right"><? echo $tk006disp[$rownum];?><br><? echo $tk019[$rownum];?></td>
					  <td align="right"><? echo $tk017[$rownum];?><br><? echo $tk017disp[$rownum];?></td>
					   <td align="right"><? echo $tk007[$rownum];?><br><? echo $tk016[$rownum];?></td>
					  <td align="right"><? echo $tk022[$rownum];?></td>					 
					</tr>
					   <?php $tk007a=$tk007a+$tk007[$rownum];$tk016a=$tk016a+$tk016[$rownum];$rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					 <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								 
					</tr>
					 
					<?php } ?>
					<tr>
					   <td colspan="6" align="right">
						<b>數量合計：<?php echo $tk007a ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $tk016a ?></b>
						
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
			<tr><td class="title" align="center" valign="top">開  帳  調  整  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單別：</b><span><?php echo $tj001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tj012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $tj005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單號：</b><?php echo $tj002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>總數量：</b><?php echo $tj007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>總金額：</b><?php echo $tj008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><?php echo $tj004 ?></td>
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
					  <td align="center" width="110"><b>品  號</b></td>
					  <td align="center" width="250"><b>品  名</b><br><b>規  格</b></td>
					   <td align="right" width="50"><b>單位</b><br><b>有效日期</b></td>
					  <td align="right" width="60"><b>庫別</b><br><b>庫別名稱</b></td>
					   <td align="right" width="50"><b>數量</b><br><b>金額</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php // $rownum=0;$tk007a=0;$tk016a=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tk004[$rownum];?></td>
					  <td align="left"><? echo $tk005[$rownum];?><br><? echo $tk006[$rownum];?></td>
					   <td align="right"><? echo $tk006disp[$rownum];?><br><? echo $tk019[$rownum];?></td>
					  <td align="right"><? echo $tk017[$rownum];?><br><? echo $tk017disp[$rownum];?></td>
					   <td align="right"><? echo $tk007[$rownum];?><br><? echo $tk016[$rownum];?></td>
					  <td align="right"><? echo $tk022[$rownum];?></td>					 
					</tr>
					   <?php $tk007a=$tk007a+$tk007[$rownum];$tk016a=$tk016a+$tk016[$rownum];$rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="6" align="right">
						<b>數量合計：<?php echo $tk007a ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $tk016a ?></b>
						
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
