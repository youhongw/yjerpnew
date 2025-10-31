<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>退 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri11/printdetailc';location = url; </script> 
 <?php exit;} ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=15;$page=1;$pagetot=1;$tj009qty=0; $tj030amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		     <?php  $ti002 = $row->ti001.'-'.$row->ti002; ?>
              <?php  $ti014 = substr($row->ti014,0,4).'/'.substr($row->ti014,4,2).'/'.substr($row->ti014,6,2); ?>	
              <?php  $ti004 = $row->ti004; ?>
			  <?php  $ti004disp = $row->ti004disp; ?>
			  <?php  $ti021 = $row->ti021; ?>
			  <?php  $ti012 = $row->ti012; ?>
			  <?php  $ti022 = $row->ti022; ?>
			  <?php  $ti011 = $row->ti011; ?>
			  <?php  $ti015 = $row->ti015; ?>
			  <?php  $tj003[] = $row->tj003; ?>
		      <?php  $tj004[] = $row->tj004; ?>
			  <?php  $tj005[] = $row->tj005; ?>
			  <?php  $tj006[] = $row->tj006; ?>
			  <?php  $tj007[] = $row->tj007; ?>
			  <?php  $tj008[] = $row->tj008; ?>
			  <?php  $tj009[] = $row->tj009; ?>
			  <?php  $tj010[] = $row->tj010; ?>
			  <?php  $tj011[] = $row->tj011; ?>
			  <?php  $tj017[] = $row->tj017; ?>
			  <?php  $tj009[] = round($row->tj009,0); ?>
			  <?php  $tj008[] = round($row->tj008,2); ?>
			  <?php  $tj010[] = round($row->tj010,0); ?>
			  <?php  $tj019[] = $row->tj019; ?>
			 
			  
			 <?php $rowtot++;$tj009qty=$tj009qty+round($row->tj009,0);$tj030amt=$tj030amt+round($row->tj030,0); ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/15); ?>
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
		  
			<tr><td class="title" align="center" valign="top">退  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>退貨單號：</b><span><?php echo $ti002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ti014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ti012 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>件數：</b><span><?php echo $ti021 ?></span></td>
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
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $ti004.' '.$ti004disp ?></td>
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
					  <td align="left" width="8%"><b>品號</b><br><b>單位</b></td>
					  <td align="left" width="22%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="8%"><b>採購單號</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單位價格</b><br><b>退貨金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>庫別</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><?php echo $tj004[$rownum];?><br><?php echo $tj007[$rownum];?></td>
					  <td align="left"><?php echo $tj005[$rownum];?><br><?php echo $tj006[$rownum];?></td>
					  <td align="right"><?php echo $tj017[$rownum];?><br><?php echo $tj009[$rownum];?></td>
					  <td align="right"><?php echo $tj011[$rownum];?><br><?php echo $tj008[$rownum];?></td>
					  <td align="right"><?php echo $tj019[$rownum];?><br><?php echo $tj010[$rownum];?></td>
					 		 
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
						<b>數量合計：</b><span><?php echo $ti022;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>退貨金額：</b><span><?php echo $ti011;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅額：</b><span><?php echo $ti015;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><span><?php echo $ti011+$ti015;?></span>
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
		  <?php if($rowtot>=17) { ?> <div style="page-break-after: always;"></div>
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
			<tr><td class="title" align="center" valign="top">退  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>退貨單號：</b><span><?php echo $ti002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ti014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ti016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商單號：</b><span><?php echo $ti006 ?></span></td>
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
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $ti005.' '.$ti005disp ?></td>
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
					  <td align="left" width="8%"><b>品號</b><br><b>單位</b></td>
					  <td align="left" width="22%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="8%"><b>採購單號</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單位價格</b><br><b>退貨金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>庫別</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tj004[$rownum];?><br><? echo $tj007[$rownum];?></td>
					  <td align="left"><? echo $tj005[$rownum];?><br><? echo $tj006[$rownum];?></td>
					  <td align="right"><? echo $tj017[$rownum];?><br><? echo $tj009[$rownum];?></td>
					  <td align="right"><? echo $tj011[$rownum];?><br><? echo $tj008[$rownum];?></td>
					  <td align="right"><? echo $tj019[$rownum];?><br><? echo $tj010[$rownum];?></td>
					 		 
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
						<b>數量合計：</b><span><? echo $ti026;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>退貨金額：</b><span><? echo $ti028;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅額：</b><span><? echo $ti019;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><span><? echo $ti028+$ti019;?></span>
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
			
			<tr><td class="title" align="center" valign="top">退  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>退貨單號：</b><span><?php echo $ti002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ti014 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ti016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>廠商單號：</b><span><?php echo $ti006 ?></span></td>
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
							  <td width="600" align="left" valign="top"><b>廠商代號：</b><?php echo $ti005.' '.$ti005disp ?></td>
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
					  <td align="left" width="8%"><b>品號</b><br><b>單位</b></td>
					  <td align="left" width="22%"><b>品名</b><br><b>規格</b></td>
					  <td align="right" width="8%"><b>採購單號</b><br><b>數量</b></td>
					  <td align="right" width="8%"><b>單位價格</b><br><b>退貨金額</b></td>
					  <td align="right" width="10%"><b>備註</b><br><b>庫別</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tj004[$rownum];?><br><? echo $tj007[$rownum];?></td>
					  <td align="left"><? echo $tj005[$rownum];?><br><? echo $tj006[$rownum];?></td>
					  <td align="right"><? echo $tj017[$rownum];?><br><? echo $tj009[$rownum];?></td>
					  <td align="right"><? echo $tj011[$rownum];?><br><? echo $tj008[$rownum];?></td>
					  <td align="right"><? echo $tj019[$rownum];?><br><? echo $tj010[$rownum];?></td>
					 		 
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
						<b>數量合計：</b><span><? echo $ti026;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>退貨金額：</b><span><? echo $ti028;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅額：</b><span><? echo $ti019;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>金額合計：</b><span><? echo $ti028+$ti019;?></span>
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
