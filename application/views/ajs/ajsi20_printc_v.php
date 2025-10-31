<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>轉 帳 傳 票</title>
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
		<?php $pagerow=15;$page=1;$pagetot=1;$tb071amt=0; $tb072amt=0; ?>	
        <?php foreach($results as $row ) : ?>
		       <?php  $ta001 = $row->ta001.' '.$row->ta001disp; ?>
			  <?php  $ta002 = $row->ta002; ?>
              <?php  $ta003 = substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2); ?>	
             
			  <?php  $ta009 = $row->ta009; ?>
			  
		<!--	 <? if ($row->mb002!='') {  echo wordwrap($row->mb002,75,"<br />\n",TRUE);} else {echo "_";}?>  -->
			  
			  <?php  $tb001[] = $row->tb001; ?>
			  <?php  $tb002[] = $row->tb002.'-'.$row->tb003; ?>
			  <?php  $tb003[] = $row->tb003; ?>
		      <?php  $tb004[] = $row->tb004; ?>
			  <?php  $tb005[] = $row->tb005; ?>
			  <?php  $tb005disp[] = $row->tb005disp; ?>
			  <?php  $tb006[] = $row->tb006; ?>
		      <?php  $tb010[] = $row->tb010; ?>
			  <?php  $tb006disp[] = $row->tb006disp; ?>
			  <?php if ($row->tb004=='1')	{$tb071[] = round($row->tb007,2);$tb071amt=$tb071amt+round($row->tb007,2);$tb072[] =0;} else {$tb072[] = round($row->tb007,2);$tb072amt=$tb072amt+round($row->tb007,2);$tb071[] =0;} ?>
			  
			  <?php  $tb007[] = $row->tb007; ?>
			  
			  
			 <?php $rowtot++; ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/$pagerow); ?>
        <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		{$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
				 
		<table class="store">
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml003'); ?> <br>
			
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">轉  帳  傳  票</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票日期：</b><?php echo $ta003 ?></td>
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
					  <td align="center" width="8%"><b>會 計 科 目</b><br><b>會 計 名 稱</b></td>
					  <td align="center" width="18%"><b>摘    要</b></td>
					  <td align="center" width="6%"><b>部門代號</b><br><b>部門名稱</b></td>
					  <td align="right" width="6%"><b>借方金額</b></td>
					  <td align="right" width="6%"><b>貸方金額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					  <?php // if ($row->tb004==1)	{$tb0041='借';} else   {$tb0041='貸';} ?>					
					  
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb005disp[$rownum];?></td>
					  <td align="left"><? echo $tb010[$rownum];?></td>
					  <td align="left"><? echo $tb006[$rownum];?><br><? echo $tb006disp[$rownum];?></td>
					  <td align="right"><? if ($tb071[$rownum]>0) {echo $tb071[$rownum];}?></td>
					  <td align="right"><?  if ($tb072[$rownum]>0) {echo $tb072[$rownum];}?></td>
					 		 
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
					  <td colspan="5" align="right">
						<b>借 方 金 額：</b><? echo $tb071amt;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>貸 方 金 額：</b><? echo $tb072amt;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
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
			<tr><td class="title" align="center" valign="top">轉  帳  傳  票</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票日期：</b><?php echo $ta003 ?></td>
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
					  <td align="center" width="8%"><b>會 計 科 目</b><br><b>會 計 名 稱</b></td>
					  <td align="center" width="18%"><b>摘    要</b></td>
					  <td align="center" width="6%"><b>部門代號</b><br><b>部門名稱</b></td>
					  <td align="right" width="6%"><b>借方金額</b></td>
					  <td align="right" width="6%"><b>貸方金額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					  <?php // if ($row->tb004==1)	{$tb0041='借';} else   {$tb0041='貸';} ?>					
					  
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb005disp[$rownum];?></td>
					  <td align="left"><? echo $tb010[$rownum];?></td>
					  <td align="left"><? echo $tb006[$rownum];?><br><? echo $tb006disp[$rownum];?></td>
					  <td align="right"><? echo $tb071[$rownum];?></td>
					  <td align="right"><? echo $tb072[$rownum];?></td>
					 		 
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
					  <td colspan="2" align="left">
						<b>借 方 金 額：</b><? echo $ta007;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>貸 方 金 額：</b><? echo $ta008;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
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
			
			<tr><td class="title" align="center" valign="top">轉  帳  傳  票</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單別：</b><span><?php echo $ta001 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票單號：</b><?php echo $ta002 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>備註：</b><?php echo $ta009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>傳票日期：</b><?php echo $ta003 ?></td>
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
					  <td align="center" width="8%"><b>會 計 科 目</b><br><b>會 計 名 稱</b></td>
					  <td align="center" width="18%"><b>摘    要</b></td>
					  <td align="center" width="6%"><b>部門代號</b><br><b>部門名稱</b></td>
					  <td align="right" width="6%"><b>借方金額</b></td>
					  <td align="right" width="6%"><b>貸方金額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					 
					<tr>					 
					  <?php // if ($row->tb004==1)	{$tb0041='借';} else   {$tb0041='貸';} ?>					
					  
					  <td align="left"><? echo $tb005[$rownum];?><br><? echo $tb005disp[$rownum];?></td>
					  <td align="left"><? echo $tb010[$rownum];?></td>
					  <td align="left"><? echo $tb006[$rownum];?><br><? echo $tb006disp[$rownum];?></td>
					  <td align="right"><? echo $tb071[$rownum];?></td>
					  <td align="right"><? echo $tb072[$rownum];?></td>
					 		 
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
					  <td colspan="2" align="left">
						<b>借 方 金 額：</b><? echo $ta007;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>貸 方 金 額：</b><? echo $ta008;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
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
