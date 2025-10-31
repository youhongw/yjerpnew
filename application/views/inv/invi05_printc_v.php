<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>庫 存 異 動 單</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
  <?php } ?>
<body onLoad="window.print()">
        <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=7;$page=1;$pagetot=1;$tb009a=0; $tb011a=0; ?>
        <?php foreach($results as $row ) : ?>
		    <?php  $ta001 = $row->ta001.' '.$row->ta001disp; ?>
			  <?php  $ta002 = $row->ta002; ?>
			 
              <?php  $ta003 = substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2); ?>	
              <?php  $ta004 = $row->ta004.' '.$row->ta004disp; ?>
              <?php  $ta005 = $row->ta005.' '.$row->ta005disp; ?>
              <?php  $ta007 = $row->ta007; ?>
			  <?php  $ta008 = $row->ta008; ?>
			  <?php  $ta009 = $row->ta009; ?>
			  <?php  $ta010 = $row->ta010; ?>
			  <?php  $ta011 = $row->ta011; ?>
			  <?php  $ta012 = $row->ta012; ?>
			  <?php  $ta014 = substr($row->ta014,0,4).'/'.substr($row->ta014,4,2).'/'.substr($row->ta014,6,2); ?>
			  <?php  $ta015 = $row->ta015; ?>
			
		      <?php  $tb004[] = $row->tb004; ?>
			  <?php  $tb005[] = $row->tb005; ?>
			  <?php  $tb006[] = $row->tb006; ?>
		     
			  <?php  $tb008[] = $row->tb008; ?>
			  <?php  $tb009[] = $row->tb009; ?>
		      <?php  $tb010[] = $row->tb010; ?>
		      <?php  $tb011[] = $row->tb011; ?>
			  <?php  $tb012[] = $row->tb012; ?>
			  <?php  $tb012disp[] = $row->tb012disp; ?>
		      <?php  $tb017[] = $row->tb017; ?>
			  <?php  $tb020[] = $row->tb020; ?>
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
			<tr><td class="title" align="center" valign="top">庫  存  異  動  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>異動單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>總數量：</b><?php echo $ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>總金額：</b><?php echo $ta012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><?php echo $ta004 ?></td>
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
					  <td align="center" width="15%"><b>品  號</b></td>
					  <td align="center" width="35%"><b>品  名</b><br><b>規  格</b></td>
					   <td align="right" width="15%"><b>單位</b><br><b>成本單價</b></td>
					  <td align="right" width="15%"><b>庫別</b><br><b>庫別名稱</b></td>
					   <td align="right" width="10%"><b>數量</b><br><b>金額</b></td>
					  <td align="right" width="10%"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;$tb007a=0;$tb016a=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb006[$rownum];?></td>
					   <td align="right"><? echo $tb008[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb012[$rownum];?><br><? echo $tb012disp[$rownum];?></td>
					   <td align="right"><? echo $tb011[$rownum];?><br><? echo $tb012[$rownum];?></td>
					  <td align="right"><? echo $tb017[$rownum];?></td>					 
					</tr>
					   <?php $tb009a=$tb009a+$tb009[$rownum];$tb011a=$tb011a+$tb011[$rownum];$rownum++; ?>
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
						<b>數量合計：<?php echo $tb009a ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $tb011a ?></b>
						
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
			<tr><td class="title" align="center" valign="top">庫  存  異  動  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>異動單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>總數量：</b><?php echo $ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>總金額：</b><?php echo $ta012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><?php echo $ta004 ?></td>
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
					  <td align="center" width="15%"><b>品  號</b></td>
					  <td align="center" width="35%"><b>品  名</b><br><b>規  格</b></td>
					   <td align="right" width="15%"><b>單位</b><br><b>成本單價</b></td>
					  <td align="right" width="15%"><b>庫別</b><br><b>庫別名稱</b></td>
					   <td align="right" width="10%"><b>數量</b><br><b>金額</b></td>
					  <td align="right" width="10%"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;$tb007a=0;$tb016a=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb006[$rownum];?></td>
					   <td align="right"><? echo $tb008[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb012[$rownum];?><br><? echo $tb012disp[$rownum];?></td>
					   <td align="right"><? echo $tb011[$rownum];?><br><? echo $tb012[$rownum];?></td>
					  <td align="right"><? echo $tb017[$rownum];?></td>					 
					</tr>
					   <?php $tb009a=$tb009a+$tb009[$rownum];$tb011a=$tb011a+$tb011[$rownum];$rownum++; ?>
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
						<b>數量合計：<?php echo $tb007a ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $tb016a ?></b>
						
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
		<tr><td class="title" align="center" valign="top">庫  存  異  動  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>異動單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>開帳單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>總數量：</b><?php echo $ta011 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
							<tr>
							  <td width="600" align="left" valign="top"><b>總金額：</b><?php echo $ta012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					    <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><?php echo $ta004 ?></td>
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
					 <td align="center" width="15%"><b>品  號</b></td>
					  <td align="center" width="35%"><b>品  名</b><br><b>規  格</b></td>
					   <td align="right" width="15%"><b>單位</b><br><b>成本單價</b></td>
					  <td align="right" width="15%"><b>庫別</b><br><b>庫別名稱</b></td>
					   <td align="right" width="10%"><b>數量</b><br><b>金額</b></td>
					  <td align="right" width="10%"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;$tb007a=0;$tb016a=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb006[$rownum];?></td>
					   <td align="right"><? echo $tb008[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb012[$rownum];?><br><? echo $tb012disp[$rownum];?></td>
					   <td align="right"><? echo $tb011[$rownum];?><br><? echo $tb012[$rownum];?></td>
					  <td align="right"><? echo $tb017[$rownum];?></td>					 
					</tr>
					   <?php $tb009a=$tb009a+$tb009[$rownum];$tb011a=$tb011a+$tb011[$rownum];$rownum++; ?>
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
						<b>數量合計：<?php echo $tb007a ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金額合計：<?php echo $tb016a ?></b>
						
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
