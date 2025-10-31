<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>應收帳款結款單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results) { ?>
 <script> alert("無資料可列印!");history.go(-1); </script> 
   <!-- <script> alert("無資料可列印!");history.back(1);history.go(-1); </script> -->
 <?php exit;} ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
		 
		  <?php if($paper9=="1")  { $tot=8;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1;$th008qty=0; $th013amt=0; ?>	
        <?php foreach($results as $row ) : ?>
	
		     <?php   $ta004 = $row->ta004.' '.$row->ta004disp; ?>
              <?php  $tb021 = $row->tb021.' '.$row->tb021disp; ?>
              <?php  $ma004 = $row->ma004; ?>
			  <?php  $ma005 = $row->ma005; ?>
			  <?php  $ma006 = $row->ma006; ?>
			  <?php  $ma008 = $row->ma008; ?>
			  <?php  $ma016 = $row->ma016.' '.$row->ma016disp; ?>
			  <?php  $ma027 = $row->ma027; ?>
			  
			  <?php  $ta029[] = $row->ta029; ?>
		      <?php  $ta030[] = $row->ta030; ?>
			  <?php  $ta031[] = $row->ta031; ?>
			  <?php  $ta031disp[] = $row->ta031disp; ?>
			 
			  
			  <?php $rowtot++;$th008qty=$th008qty+round($row->ta029,0);$th013amt=$th013amt+round($row->ta030,0); ?>
        <?php endforeach;?>  
		         
        <?php $pagetot=ceil($rowtot/$tot); ?>
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
		  
			<tr><td class="title" align="center" valign="top">應收帳款結款單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $ma006 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $ma005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>負 責 人：</b><span><?php echo $ma004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>電話傳真：</b><span><?php echo $ma008 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $ma016 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><span><?php echo $tb021 ?></span></td>
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
						<table width="100%"><b>送貨地址：</b><?php echo $ma027 ?>
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
					  <td align="right" width="10%"><b>上月結欠</b></td>
					  <td align="right" width="10%"><b>本月銷售</b></td>
					  <td align="right" width="10%"><b>本月稅額</b></td>
					  <td align="right" width="10%"><b>己收金額</b></td>
					  <td align="right" width="10%"><b>應收帳款</b></td>
					  <td align="right" width="10%"><b>現金</b></td>
					  <td align="right" width="10%"><b>支票</b></td>
					   <td align="right" width="10%"><b>折讓</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo $ta029[$rownum];?></td>
					  <td align="right"><?php echo $ta030[$rownum];?></td>
					  <td align="right"><?php echo $ta031[$rownum];?></td>
					  <td align="right"><?php echo $ta031disp[$rownum];?></td>
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo '';?></td>
					 		 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
				<!--	<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>  -->
					 
					<?php } ?>
					
				</table>
			</td></tr>
			<br>
			       <tr>
			           <td width="100" align="left"><b>&nbsp;&nbsp;&nbsp;付款銀行：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>帳  號：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>票  號：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <td width="100" align="left"><b>到 期 日：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>備  註：</b></td>
			        </tr>
					<br><br><span>1.</span>
					<br><br><span>2.</span>
					<br><br><span>3.</span><br><br>
		</table>
		
		  	
				<table class="footer">
					<tr>
					 <td>
						
					  </td>
					 
					</tr>
				</table>
			
			
		  <table >
		     <br>
			<tr>
			  <td width="200" align="left"><b>核  准：</b></td>
			  <td width="200" align="left"><b>會  計：</b></td>
			  <td width="200" align="left"><b>主  管：</b></td>
			  <td width="200" align="left"><b>收 款 人：</b></td>
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
			<tr><td class="title" align="center" valign="top">應收帳款結款單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $ma006 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $ma005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>負 責 人：</b><span><?php echo $ma004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>電話傳真：</b><span><?php echo $ma008 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $ma016 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><span><?php echo $tb021 ?></span></td>
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
						<table width="100%"><b>送貨地址：</b><?php echo $ma025 ?>
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
					  <td align="right" width="10%"><b>上月結欠</b></td>
					  <td align="right" width="10%"><b>本月銷售</b></td>
					  <td align="right" width="10%"><b>本月稅額</b></td>
					  <td align="right" width="10%"><b>己收金額</b></td>
					  <td align="right" width="10%"><b>應收帳款</b></td>
					  <td align="right" width="10%"><b>現金</b></td>
					  <td align="right" width="10%"><b>支票</b></td>
					   <td align="right" width="10%"><b>折讓</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo $ta029[$rownum];?></td>
					  <td align="right"><?php echo $ta030[$rownum];?></td>
					  <td align="right"><?php echo $ta031[$rownum];?></td>
					  <td align="right"><?php echo $ta031disp[$rownum];?></td>
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo '';?></td>
					 		 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
				<!--	<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>  -->
					 
					<?php } ?>
						</table>
			</td></tr>
			<br>
			       <tr>
			           <td width="100" align="left"><b>&nbsp;&nbsp;&nbsp;付款銀行：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>帳  號：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>票  號：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <td width="100" align="left"><b>到 期 日：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>備  註：</b></td>
			        </tr>
					<br><br><span>1.</span>
					<br><br><span>2.</span>
					<br><br><span>3.</span><br><br>
		</table>
		
		  	
				<table class="footer">
					<tr>
					 <td>
						
					  </td>
					 
					</tr>
				</table>
			
			
		  <table >
		     <br>
			<tr>
			  <td width="200" align="left"><b>核  准：</b></td>
			  <td width="200" align="left"><b>會  計：</b></td>
			  <td width="200" align="left"><b>主  管：</b></td>
			  <td width="200" align="left"><b>收 款 人：</b></td>
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
			
			<tr><td class="title" align="center" valign="top">應收帳款結款單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶代號：</b><span><?php echo $ta004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $ma006 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $ma005 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>負 責 人：</b><span><?php echo $ma004 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>電話傳真：</b><span><?php echo $ma008 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $ma016 ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>部門代號：</b><span><?php echo $tb021 ?></span></td>
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
						<table width="100%"><b>送貨地址：</b><?php echo $ma025 ?>
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
					  <td align="right" width="10%"><b>上月結欠</b></td>
					  <td align="right" width="10%"><b>本月銷售</b></td>
					  <td align="right" width="10%"><b>本月稅額</b></td>
					  <td align="right" width="10%"><b>己收金額</b></td>
					  <td align="right" width="10%"><b>應收帳款</b></td>
					  <td align="right" width="10%"><b>現金</b></td>
					  <td align="right" width="10%"><b>支票</b></td>
					   <td align="right" width="10%"><b>折讓</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo $ta029[$rownum];?></td>
					  <td align="right"><?php echo $ta030[$rownum];?></td>
					  <td align="right"><?php echo $ta031[$rownum];?></td>
					  <td align="right"><?php echo $ta031disp[$rownum];?></td>
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo '';?></td>
					  <td align="right"><?php echo '';?></td>
					 		 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
				<!--	<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>				 
					</tr>  -->
					 
					<?php } ?>
						</table>
			</td></tr>
			<br>
			       <tr>
			           <td width="100" align="left"><b>&nbsp;&nbsp;&nbsp;付款銀行：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>帳  號：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>票  號：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <td width="100" align="left"><b>到 期 日：</b></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			           <td width="100" align="left"><b>備  註：</b></td>
			        </tr>
					<br><br><span>1.</span>
					<br><br><span>2.</span>
					<br><br><span>3.</span><br><br>
		</table>
		
		  	
				<table class="footer">
					<tr>
					 <td>
						
					  </td>
					 
					</tr>
				</table>
			
			
		  <table >
		     <br>
			<tr>
			  <td width="200" align="left"><b>核  准：</b></td>
			  <td width="200" align="left"><b>會  計：</b></td>
			  <td width="200" align="left"><b>主  管：</b></td>
			  <td width="200" align="left"><b>收 款 人：</b></td>
			</tr>
		  </table>
		  <br/>
		 <?php } ?>  
</body>
</html>
