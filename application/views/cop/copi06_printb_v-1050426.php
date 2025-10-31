<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>客 戶 訂 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
 <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=5;$page=1;$pagetot=1; ?>	
        <?php foreach($results as $row ) : ?>
		      <?php  $tc002 = $row->tc001.'-'.$row->tc002; ?>
              <?php  $tc039 = substr($row->tc039,0,4).'/'.substr($row->tc039,4,2).'/'.substr($row->tc039,6,2); ?>	
              <?php  $tc004 = $row->tc004; ?>
			  <?php  $tc004disp = $row->tc004disp; ?>
			 
              <?php  $tc005 = $row->tc005; ?>			  
              <?php  $tc005disp = $row->tc005disp; ?>
			   <?php  $tc006 = $row->tc006; ?>			  
              <?php  $tc006disp = $row->tc006disp; ?>
			   <?php  $tc007 = $row->tc007; ?>	
			  <?php  $tc007disp = $row->tc007disp; ?>
			    <?php  $tc008 = $row->tc008; ?>	
			  <?php  $tc008disp = $row->tc008disp; ?>
			    <?php  $tc014 = $row->tc014; ?>	
			  <?php  $tc014disp = $row->tc014disp; ?>
			  
			  <?php  $tc012 = $row->tc012; ?>
			  <?php  $tc013 = $row->tc013; ?>
			  <?php  $tc016 = $row->tc016; ?>
			  <?php  $tc041 = $row->tc041; ?>
		      <?php  $tc029 = $row->tc029; ?>
			  <?php  $tc030 = $row->tc030; ?>
			  <?php  $tc031 = $row->tc031; ?>
			  <?php  $tc043 = $row->tc043; ?>
			  <?php  $tc044 = $row->tc044; ?>
			 
			  <?php  $td003[] = $row->td003; ?>
		      <?php  $td004[] = $row->td004; ?>
			  <?php  $td005[] = $row->td005; ?>
			  <?php  $td006[] = $row->td006; ?>
			  <?php  $td007[] = $row->td007; ?>
			  <?php  $td007disp[] = $row->td007disp; ?>
			  <?php  $td010[] = $row->td010; ?>
			  <?php  $td013[] = substr($row->td013,0,4).'/'.substr($row->td013,4,2).'/'.substr($row->td013,6,2); ?>
			  <?php  $td008[] = $row->td008; ?>
			  <?php  $td011[] = round($row->td011,2); ?>
			  <?php  $td012[] = round($row->td012,0); ?>
			  <?php  $td020[] = $row->td020; ?>
			  <?php  $td030[] = $row->td030; ?>
			  <?php  $td031[] = $row->td031; ?>
			 
			  
			  <?php $rowtot++; ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/5); ?>
        <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		{$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
				 
		<table class="store">
		  <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml012'); ?> <br/>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>
			</td>
		     </tr>
			 
			<tr><td class="title" align="center" valign="top">客  戶  訂  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>訂單單號：</b><span><?php echo $tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tc039 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $tc004.' '.$tc004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tc006.' '.$tc006disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $tc016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><?php echo $tc008.' '.$tc008disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $tc014.' '.$tc014disp ?></td>
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
					  <td align="center"  width="100"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b><br><b>規格</b></td>
					  <td align="left"  width="80"><b>單位</b><br><b>庫別</b></td>
					  <td align="right" width="50"><b>訂單數量</b></td>
					  <td align="right" width="50"><b>訂單單價</b></td>
					  <td align="right" width="60"><b>訂單金額</b></td>
					   <td align="right"  width="100"><b>毛重</b><br><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $td004[$rownum];?></td>
					  <td align="left"><? echo $td005[$rownum];?><br><? echo $td006[$rownum];?></td>
					  <td align="left"><? echo $td010[$rownum];?><br><? echo $td007[$rownum].' '.$td007disp[$rownum];?></td>
					  <td align="right"><? echo $td008[$rownum];?></td>
					  <td align="right"><? echo $td011[$rownum];?></td>
					  <td align="right"><? echo $td012[$rownum];?></td>
					  <td align="right"><? echo $td030[$rownum];?><br><? echo $td020[$rownum];?></td>					 
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
						<b>訂單金額：<?php echo $tc029 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo $tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo $tc029+$tc030 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo $tc031 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;總毛重(Kg)：<?php echo $tc043 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總材積(CUFT)：<?php echo $tc044 ?></b>
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
			<td class="logo1" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml012'); ?> <br/>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>
			</td>
		     </tr>
			<tr><td class="title" align="center" valign="top">客  戶  訂  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>訂單單號：</b><span><?php echo $tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tc039 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $tc004.' '.$tc004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tc006.' '.$tc006disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $tc016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><?php echo $tc008.' '.$tc008disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $tc014.' '.$tc014disp ?></td>
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
					  <td align="center"  width="100"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b><br><b>規格</b></td>
					  <td align="left"  width="80"><b>單位</b><br><b>庫別</b></td>
					  <td align="right" width="50"><b>訂單數量</b></td>
					  <td align="right" width="50"><b>訂單單價</b></td>
					  <td align="right" width="60"><b>訂單金額</b></td>
					   <td align="right"  width="100"><b>毛重</b><br><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $td004[$rownum];?></td>
					  <td align="left"><? echo $td005[$rownum];?><br><? echo $td006[$rownum];?></td>
					  <td align="left"><? echo $td010[$rownum];?><br><? echo $td007[$rownum].' '.$td007disp[$rownum];?></td>
					  <td align="right"><? echo $td008[$rownum];?></td>
					  <td align="right"><? echo $td011[$rownum];?></td>
					  <td align="right"><? echo $td012[$rownum];?></td>
					  <td align="right"><? echo $td030[$rownum];?><br><? echo $td020[$rownum];?></td>					 
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
						<b>訂單金額：<?php echo $tc029 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo $tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo $tc029+$tc030 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo $tc031 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;總毛重(Kg)：<?php echo $tc043 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總材積(CUFT)：<?php echo $tc044 ?></b>					 
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
			<td class="logo1" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml003'); ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $this->session->userdata('sysml012'); ?> <br/>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>
			</td>
		     </tr>
			
			<tr><td class="title" align="center" valign="top">客  戶  訂  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>訂單單號：</b><span><?php echo $tc002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tc039 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><?php echo $tc004.' '.$tc004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tc006.' '.$tc006disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>課 稅 別：</b><?php echo $tc016 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>交易幣別：</b><?php echo $tc008.' '.$tc008disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><?php echo $tc014.' '.$tc014disp ?></td>
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
					  <td align="center"  width="100"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b><br><b>規格</b></td>
					  <td align="left"  width="80"><b>單位</b><br><b>庫別</b></td>
					  <td align="right" width="50"><b>訂單數量</b></td>
					  <td align="right" width="50"><b>訂單單價</b></td>
					  <td align="right" width="60"><b>訂單金額</b></td>
					   <td align="right"  width="100"><b>毛重</b><br><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $td004[$rownum];?></td>
					  <td align="left"><? echo $td005[$rownum];?><br><? echo $td006[$rownum];?></td>
					  <td align="left"><? echo $td010[$rownum];?><br><? echo $td007[$rownum].' '.$td007disp[$rownum];?></td>
					  <td align="right"><? echo $td008[$rownum];?></td>
					  <td align="right"><? echo $td011[$rownum];?></td>
					  <td align="right"><? echo $td012[$rownum];?></td>
					  <td align="right"><? echo $td030[$rownum];?><br><? echo $td020[$rownum];?></td>					 
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
						<b>訂單金額：<?php echo $tc029 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;訂單稅額：<?php echo $tc030 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;合計金額：<?php echo $tc029+$tc030 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總數量：<?php echo $tc031 ?></b>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;總毛重(Kg)：<?php echo $tc043 ?></b><b>&nbsp;&nbsp;&nbsp;&nbsp;總材積(CUFT)：<?php echo $tc044 ?></b>
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
