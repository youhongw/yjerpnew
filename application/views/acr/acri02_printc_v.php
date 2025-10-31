<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>結 帳 單</title>
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
		<?php $pagerow=15;$page=1;$pagetot=1;$ta029amt=0; $ta030amt=0; $ta031amt=0;?>	
       <?php foreach($results as $row ) : ?>
		      <?php  $ta001 = $row->ta001.' '.$row->ta001disp; ?>
			  <?php  $ta002 = $row->ta002; ?>
              <?php  $ta038 = substr($row->ta038,0,4).'/'.substr($row->ta038,4,2).'/'.substr($row->ta038,6,2); ?>	
              <?php  $ta004 = $row->ta004.' '.$row->ta004disp; ?>
			  <?php  $ta005 = $row->ta005.' '.$row->ta005disp; ?>
			  <?php  $ta006 = $row->ta006.' '.$row->ta006disp; ?>
			  <?php  $ta009 = $row->ta009.' '.$row->ta009disp; ?>
			  <?php  $ta040 = $row->ta040; ?>
			  
			  <?php  $ta029 = $row->ta029; ?>
			  <?php  $ta030 = $row->ta030; ?>
			  <?php  $ta031 = $row->ta031; ?>
			  <?php  $ta041 = $row->ta041; ?>
			  <?php  $ta042 = $row->ta042; ?>
			  
			  <?php  $ta022 = $row->ta022; ?>
			  <?php  $ta043 = $row->ta043.' '.$row->ta043disp; ?>
			  <?php  $tb001[] = $row->tb001; ?>
			  <?php  $tb002[] = $row->tb002.'-'.$row->tb003; ?>
			  <?php  $tb003[] = $row->tb003; ?>
		      <?php  $tb004[] = $row->tb004; ?>
			  <?php  $tb005[] = $row->tb005; ?>
			  <?php  $tb006[] = $row->tb006; ?>
			  <?php  $tb007[] = $row->tb007; ?>
			  <?php  $tb008[] = $row->tb008; ?>
			  <?php  $tb009[] = $row->tb009; ?>
			  <?php  $tb010[] = $row->tb010; ?>
			  <?php  $tb011[] = $row->tb011; ?>
			  <?php  $tb012[] = $row->tb012; ?>
			  <?php  $tb013[] = $row->tb013; ?>
			  <?php  $tb013disp[] = $row->tb013disp; ?>
			  <?php  $tb021[] = $row->tb021; ?>
			  <?php  $tb021disp[] = $row->tb021disp; ?>
			  <?php  $tb009[] = round($row->tb009,0); ?>
			  <?php  $tb010[] = round($row->tb010,0); ?>
			  
			 <?php $rowtot++;$ta029amt=$ta029amt+round($row->ta029,0);$ta030amt=$ta030amt+round($row->ta030,0);$ta031amt=$ta031amt+round($row->ta031,0); ?>
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
		  
			<tr><td class="title" align="center" valign="top">結帳單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>憑單單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta038 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta022 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>憑單單號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>營業稅率</b><span><?php echo $ta040 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $ta043 ?></td>
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
					  <td align="left" width="10%"><b>憑證單別</b><br><b>憑證單號</b></td>
					  <td align="left" width="10%"><b>來源</b><br><b>憑證日期</b></td>
					  <td align="left" width="10%"><b>科目代號</b><br><b>科目名稱</b></td>
					  <td align="right" width="8%"><b>應收金額</b><br><b>差    額</b></td>
					  <td align="right" width="12%"><b>備註</b><br><b>確認碼</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
				
					<tr>					 
					 
					  <td align="left"><? echo $tb001[$rownum];?><br><? echo $tb002[$rownum];?></td>
					  <td align="left"><? echo $tb004[$rownum];?><br><? echo $tb008[$rownum];?></td>
					  <td align="left"><? echo $tb013[$rownum];?><br><? echo $tb013disp[$rownum];?></td>
					  <td align="right"><? echo $tb009[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb011[$rownum];?><br><? echo $tb012[$rownum];?></td>
					 		 
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
						<b>應收未稅：</b><span><? echo $ta029;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>營業稅額：</b><span><? echo $ta030;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>已收金額：</b><span><? echo $ta031;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>應收金額：</b><span><? echo $ta029+$ta030;?></span> 
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
			<tr><td class="title" align="center" valign="top">結帳單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>憑單單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta038 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta022 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>憑單單號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>營業稅率</b><span><?php echo $ta040 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $ta043 ?></td>
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
					  <td align="left" width="10%"><b>憑證單別</b><br><b>憑證單號</b></td>
					  <td align="left" width="10%"><b>來源</b><br><b>憑證日期</b></td>
					  <td align="left" width="10%"><b>科目代號</b><br><b>科目名稱</b></td>
					  <td align="right" width="8%"><b>應收金額</b><br><b>差    額</b></td>
					  <td align="right" width="12%"><b>備註</b><br><b>確認碼</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					
					<tr>					 
					  <td align="left"><? echo $tb001[$rownum];?><br><? echo $tb002[$rownum];?></td>
					  <td align="left"><? echo $tb004[$rownum];?><br><? echo $tb008[$rownum];?></td>
					  <td align="right"><? echo $tb013[$rownum];?><br><? echo $tb013disp[$rownum];?></td>
					  <td align="right"><? echo $tb009[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb011[$rownum];?><br><? echo $tb012[$rownum];?></td>
					 		 
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
						<b>應收未稅：</b><span><? echo $ta029;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>營業稅額：</b><span><? echo $ta030;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>已收金額：</b><span><? echo $ta031;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>應收金額：</b><span><? echo $ta029+$ta030;?></span> 
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
			
			<tr><td class="title" align="center" valign="top">結帳單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>憑單單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta038 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta022 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>憑單單號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>營業稅率</b><span><?php echo $ta040 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $ta043 ?></td>
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
					  <td align="left" width="10%"><b>憑證單別</b><br><b>憑證單號</b></td>
					  <td align="left" width="10%"><b>來源</b><br><b>憑證日期</b></td>
					  <td align="left" width="10%"><b>科目代號</b><br><b>科目名稱</b></td>
					  <td align="right" width="8%"><b>應收金額</b><br><b>差    額</b></td>
					  <td align="right" width="12%"><b>備註</b><br><b>確認碼</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb001[$rownum];?><br><? echo $tb002[$rownum];?></td>
					  <td align="left"><? echo $tb004[$rownum];?><br><? echo $tb008[$rownum];?></td>
					  <td align="right"><? echo $tb013[$rownum];?><br><? echo $tb013disp[$rownum];?></td>
					  <td align="right"><? echo $tb009[$rownum];?><br><? echo $tb010[$rownum];?></td>
					  <td align="right"><? echo $tb011[$rownum];?><br><? echo $tb012[$rownum];?></td>
					 		 
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
						<b>應收未稅：</b><span><? echo $ta029;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>營業稅額：</b><span><? echo $ta030;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>已收金額：</b><span><? echo $ta031;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>應收金額：</b><span><? echo $ta029+$ta030;?></span> 
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
