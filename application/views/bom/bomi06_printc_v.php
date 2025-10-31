<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>拆  解  單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/bom/bomi06/printdetailc';location = url; </script> 
  <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=10;$page=1;$pagetot=1;$tg007qty=0; $tg019amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		    <?php  $tf002 = $row->tf001.'-'.$row->tf002; ?>
              <?php  $tf012 = substr($row->tf012,0,4).'/'.substr($row->tf012,4,2).'/'.substr($row->tf012,6,2); ?>	
              <?php  $tf004 = $row->tf004; ?>
			  <?php  $tf004disp = $row->tf004disp; ?>
			   <?php  $tf004disp1 = $row->tf004disp1; ?>
			  <?php  $tf005 = $row->tf005; ?>
			  <?php  $tf007 = $row->tf007; ?>
			  <?php  $tf008 = $row->tf008; ?>
			  <?php  $tf008disp = $row->tf008disp; ?>
			  
			  <?php  $tg003[] = $row->tg003; ?>
			  <?php  $tg004[] = $row->tg004; ?>
			  <?php  $tg004disp[] = $row->tg004disp; ?>
			   <?php  $tg004disp1[] = $row->tg004disp1; ?>
			     <?php  $tg005[] = $row->tg005; ?>
			      <?php  $tg007[] = $row->tg007; ?>
			     <?php  $tg007disp[] = $row->tg007disp; ?>
		      <?php  $tg008[] = round($row->tg008,0); ?>
			
			  <?php  $tg009[] = $row->tg009; ?>
			
			  <?php  $tg011[] = $row->tg011; ?>
			  <?php  $tg012[] = $row->tg012; ?>
			  <?php $rowtot++;$tg007qty=$tg007qty+round($row->tg008,0);$tg019amt=$tg019amt+round($row->tg008,0); ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/10); ?>
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
		  
			<tr><td class="title" align="center" valign="top">拆  解  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>拆解單號：</b><span><?php echo $tf002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tf012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>成品數量：</b><?php echo $tf007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>成品品號：</b><span><?php echo $tf004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
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
							  <td width="600" align="left" valign="top"><b>出庫庫別：</b><?php echo $tf008.' '.$tf008disp ?></td>
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
					  <td align="center" width="15%"><b>品號</b><br><b>品名</b></td>
					  <td align="center" width="15%"><b>規格</b><br><b>單位</b></td>
					  <td align="right" width="8%"><b>入庫庫別</b><br><b>庫別名稱</b></td>
					  <td align="right" width="8%"><b>元件用量</b></td>
					  <td align="right" width="10%"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tg004[$rownum];?><br><? echo $tg004disp[$rownum];?></td>
					  <td align="left"><? echo $tg004disp1[$rownum];?><br><? echo $tg005[$rownum];?></td>
					  <td align="right"><? echo $tg007[$rownum];?><br><? echo $tg007disp[$rownum];?></td>
					  <td align="right"><? echo $tg008[$rownum];?></td>
					  <td align="right"><? echo $tg009[$rownum];?></td>
					 		 
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
				<!--	<tr>
					  <td colspan="5" align="left">
						<b>數量合計：</b><span><? echo $tf026;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>進貨金額：</b><span><? echo $tf028;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅額：</b><span><? echo $tf019;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><span><? echo $tf028+$tf019;?></span>
					  </td>
					</tr> -->
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
		<tr><td class="title" align="center" valign="top">拆  解  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>拆解單號：</b><span><?php echo $tf002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tf012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>成品數量：</b><?php echo $tf007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>成品品號：</b><span><?php echo $tf004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
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
							  <td width="600" align="left" valign="top"><b>出庫庫別：</b><?php echo $tf008.' '.$tf008disp ?></td>
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
					  <td align="center" width="15%"><b>品號</b><br><b>品名</b></td>
					  <td align="center" width="15%"><b>規格</b><br><b>單位</b></td>
					  <td align="right" width="8%"><b>入庫庫別</b><br><b>庫別名稱</b></td>
					  <td align="right" width="8%"><b>元件用量</b></td>
					  <td align="right" width="10%"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tg004[$rownum];?><br><? echo $tg004disp[$rownum];?></td>
					  <td align="left"><? echo $tg004disp1[$rownum];?><br><? echo $tg005[$rownum];?></td>
					  <td align="right"><? echo $tg007[$rownum];?><br><? echo $tg007disp[$rownum];?></td>
					  <td align="right"><? echo $tg008[$rownum];?></td>
					  <td align="right"><? echo $tg009[$rownum];?></td>
					 		 
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
				<!--	<tr>
					  <td colspan="5" align="left">
						<b>數量合計：</b><span><? echo $tf026;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>進貨金額：</b><span><? echo $tf028;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅額：</b><span><? echo $tf019;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><span><? echo $tf028+$tf019;?></span>
					  </td>
					</tr>
				</table>
			</td></tr> -->
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
			
			<tr><td class="title" align="center" valign="top">拆  解  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>拆解單號：</b><span><?php echo $tf002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tf012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>成品數量：</b><?php echo $tf007 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>成品品號：</b><span><?php echo $tf004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b></b></td>
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
							  <td width="600" align="left" valign="top"><b>出庫庫別：</b><?php echo $tf008.' '.$tf008disp ?></td>
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
					  <td align="center" width="15%"><b>品號</b><br><b>品名</b></td>
					  <td align="center" width="15%"><b>規格</b><br><b>單位</b></td>
					  <td align="right" width="8%"><b>入庫庫別</b><br><b>庫別名稱</b></td>
					  <td align="right" width="8%"><b>元件用量</b></td>
					  <td align="right" width="10%"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tg004[$rownum];?><br><? echo $tg004disp[$rownum];?></td>
					  <td align="left"><? echo $tg004disp1[$rownum];?><br><? echo $tg005[$rownum];?></td>
					  <td align="right"><? echo $tg007[$rownum];?><br><? echo $tg007disp[$rownum];?></td>
					  <td align="right"><? echo $tg008[$rownum];?></td>
					  <td align="right"><? echo $tg009[$rownum];?></td>
					 		 
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
				<!--	<tr>
					  <td colspan="5" align="left">
						<b>數量合計：</b><span><? echo $tf026;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>進貨金額：</b><span><? echo $tf028;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅額：</b><span><? echo $tf019;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><span><? echo $tf028+$tf019;?></span>
					  </td>
					</tr> -->
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
