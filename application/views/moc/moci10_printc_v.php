<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>加 工 核 價 單</title>
<base href="http://ci.youhongwang.com/" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 
  <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
 <?php exit;} ?>
  <!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=6; $vbb=$vaa-1;} else 
		  {$vaa=6; $vbb=$vaa-1;} ?>	
<body onLoad="window.print()">
        <!-- 第一頁 -->
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=23;$page=1;$pagetot=1;$td009qty=0; $td030amt=0; ?>

        <?php foreach($results as $row ) : ?>
		      <?php  $tm002 = $row->tm001.'-'.$row->tm002; ?>
              <?php  $tm010 = substr($row->tm010,0,4).'/'.substr($row->tm010,4,2).'/'.substr($row->tm010,6,2); ?>	
              <?php  $tm004 = $row->tm004; ?>
			  <?php  $tm004disp = $row->tm004disp; ?>
              <?php  $tm005 = $row->tm005; ?>
              <?php  $tm007 = $row->tm007; ?>
		      <?php  $tn004[] = $row->tn004; ?>
			  <?php  $tn005[] = $row->tn005; ?>
			  <?php  $tn006[] = $row->tn006; ?>
			  <?php  $tn008[] = $row->tn008; ?>
			  <?php  $tn009[] = $row->tn009; ?>
			  <?php  $tn011[] = $row->tn011; ?>
			  <?php  $tn013[] = $row->tn013; ?>
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
			<tr><td class="title" align="center" valign="top">加  工  核  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="60%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>加工核價單號：</b><span><?php echo $tm002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tm010 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $tm005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="40%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>加工廠商：</b><?php echo $tm004.' '.$tm004disp ?></td>
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
					 
					 <td align="center" width="110"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b></td>
					  <td align="center" width="250"><b>規格</b></td>
					  <td align="left" width="40"><b>單位</b></td>
					  <td align="right" width="60"><b>生效日期</b></td>
					  <td align="right" width="40"><b>單價</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><?php echo $tn004[$rownum];?></td>
					  <td align="left"><?php echo $tn005[$rownum];?></td>
					  <td align="left"><?php echo $tn006[$rownum];?></td>
					  <td align="left"><?php echo $tn008[$rownum];?></td>
					  <td align="right"><?php echo $tn011[$rownum];?></td>
					  <td align="right"><?php echo $tn009[$rownum];?></td>
					  <td align="right"><?php echo $tn013[$rownum];?></td>					 
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
						<b>備　　註：<?php echo $tm007 ?></b>
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
			<tr><td class="title" align="center" valign="top">加  工  核  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="60%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>加工核價單號：</b><span><?php echo $tm002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tm010 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $tm005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="40%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>加工廠商：</b><?php echo $tm004.' '.$tm004disp ?></td>
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
					 
					 <td align="center" width="110"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b></td>
					  <td align="center" width="250"><b>規格</b></td>
					  <td align="left" width="40"><b>單位</b></td>
					  <td align="right" width="60"><b>生效日期</b></td>
					  <td align="right" width="40"><b>單價</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><?php echo $tn004[$rownum];?></td>
					  <td align="left"><?php echo $tn005[$rownum];?></td>
					  <td align="left"><?php echo $tn006[$rownum];?></td>
					  <td align="left"><?php echo $tn008[$rownum];?></td>
					  <td align="right"><?php echo $tn011[$rownum];?></td>
					  <td align="right"><?php echo $tn009[$rownum];?></td>
					  <td align="right"><?php echo $tn013[$rownum];?></td>					 
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
						<b>備　　註：<?php echo $tm007 ?></b>
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
			<tr><td class="title" align="center" valign="top">加  工  核  價  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="60%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>加工核價單號：</b><span><?php echo $tm002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tm010 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>幣別：</b><?php echo $tm005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="40%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>供應廠商：</b><?php echo $tm004.' '.$tm004disp ?></td>
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
					 
					  <td align="center" width="110"><b>品號</b></td>
					  <td align="center" width="250"><b>品名</b></td>
					  <td align="center" width="250"><b>規格</b></td>
					  <td align="left" width="40"><b>單位</b></td>
					  <td align="right" width="60"><b>生效日期</b></td>
					  <td align="right" width="40"><b>單價</b></td>
					  <td align="right" width="60"><b>備註</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tn004[$rownum];?></td>
					  <td align="left"><? echo $tn005[$rownum];?></td>
					  <td align="left"><? echo $tn006[$rownum];?></td>
					  <td align="left"><? echo $tn008[$rownum];?></td>
					  <td align="right"><? echo $tn011[$rownum];?></td>
					  <td align="right"><? echo $tn009[$rownum];?></td>
					  <td align="right"><? echo $tn013[$rownum];?></td>					 
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
						<b>備　　註：<?php echo $tm007 ?></b>
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
