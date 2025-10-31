<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>銷 貨 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi08/printdetailc';location = url; </script> 
  <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
		  <?php $paper9='1';$tprint='Y'; ?>
		  <?php if($paper9=="1")  { $tot=6;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;$rowtot1=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1; $th008qty=0; $th013amt=0; ?>
		
        <?php foreach($results1 as $row ) : ?>
		    <!-- //公司簡稱 公司全稱 電話 傳真 地址 E-MAIL 備註 -->
			 <?php  $ml002sys[]=$row->ml002;  ?>
			 <?php $ml003sys[]=$row->ml003;   ?>
			 <?php $ml005sys[]=$row->ml005;  ?>
			 <?php $ml006sys[]=$row->ml006;   ?>
			 <?php $ml012sys[]=$row->ml012;  ?> 
			 <?php $ml010sys[]=$row->ml010;   ?> 
			 <?php $ml011sys[]=$row->ml011;   ?> 
        <?php endforeach;?>
		     <?php    $vsysml002=$ml002sys[0];  ?>
			 <?php    $vsysml003=$ml003sys[0];  ?>
		     <?php    $vsysml005=$ml005sys[0];  ?>
			 <?php    $vsysml006=$ml006sys[0];  ?>
			 <?php    $vsysml012=$ml012sys[0];  ?>
			 <?php    $vsysml010=$ml010sys[0];  ?>
			 <?php    $vsysml011=$ml011sys[0];  ?>
        <?php foreach($results as $row ) : ?>
		      <?php  $tg002 = $row->tg001.'-'.$row->tg002; ?>
              <?php  $tg042 = substr($row->tg042,0,4).'/'.substr($row->tg042,4,2).'/'.substr($row->tg042,6,2); ?>	
              <?php  $tg004 = $row->tg004; ?>
			  <?php  $tg004disp = $row->tg004disp; ?>
			  <?php  $tg004disp1 = $row->tg004disp1; ?>
			  <?php  $tg004disp2 = $row->tg004disp2; ?>
			  <?php  $tg004disp3 = $row->tg004disp3; ?>
			  <?php  $tg005 = $row->tg005; ?>
			  <?php  $tg005disp = $row->tg005disp; ?>
			  <?php  $tg006 = $row->tg006; ?>
			  <?php  $tg006disp = $row->tg006disp; ?>
			  <?php  $tg008 = $row->tg008; ?>
			   <?php  $tg009 = $row->tg009; ?>
			   <?php  $tg045 = $row->tg045; ?>
			    <?php  $tg046 = $row->tg046; ?>
			  <?php  $tg047 = $row->tg047; ?>
			  <?php  $tg047disp = $row->tg047disp; ?>
			  <?php  $tg020 = $row->tg020; ?>
			  <?php  $th003[] = $row->th003; ?>
		      <?php  $th004[] = $row->th004; ?>
			  <?php  $th005[] = $row->th005; ?>
			  <?php  $th006[] = $row->th006; ?>
			  <?php  $th007[] = $row->th007; ?>
		      <?php  $th007disp[] = $row->th007disp; ?>
		      <?php  $th008[] = $row->th008; ?>
			  <?php  $th009[] = $row->th009; ?>
			  <?php  $th012[] = round($row->th012,2); ?>
			  <?php  $th013[] = $row->th013; ?>
			 
			  <?php  $th017[] = $row->th017; ?>
			   <?php  $th018[] = $row->th018; ?>
			   <?php  $th019[] = $row->th019; ?>
			  
			  <?php $rowtot++;$rowtot1++;$th008qty=$th008qty+round($row->th008,0);$th013amt=$th013amt+round($row->th013,0); ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/6); ?>
        <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		{$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
				 
		<table class="store">
		  <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">銷  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="300" align="left" valign="top"><b>銷貨單號：</b><span><?php echo $tg002 ?></span></td>
							  <td width="300" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $tg004.' '.$tg004disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="300" align="left" valign="top"><b>單據日期：</b><?php echo $tg042 ?></td>
							   <td width="300" align="left" valign="top"><b>連 絡 人：</b><?php echo $tg004disp3 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" colspan="2" valign="top"><b>送貨地址：</b><?php echo $tg008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" colspan="2" valign="top"><b>帳單地址：</b><?php echo $tg009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
				
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $tg004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $tg004disp2 ?></td>
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
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>單位</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $th004[$rownum];?></td>
					  <td align="left"><? echo $th005[$rownum];?></td>
					  <td align="left"><? echo $th006[$rownum];?></td>
					  <td align="left"><? echo $th009[$rownum];?></td>
					  <td align="right"><? echo $th008[$rownum];?></td>
					   <?php if ($tprint=='Y') { ?>
					  <td align="right"><? echo $th012[$rownum];?></td>
					  <td align="right"><? echo $th013[$rownum];?></td>
					   <?php } else { ?>
					    <td align="right"><? echo '';?></td>
					    <td align="right"><? echo '';?></td>
					 	 <?php }  ?>	 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $tg020;?>						
					  </td>
					</tr>
					<tr>
					  <td colspan="7" align="left">
						
						<?php if ($rowtot1 <= $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?>  <?php echo '';} ?> 
						<?php if ($rowtot1 > $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
				<tr>
			  <td width="250" align="left"><b>核  准：</b></td>
			  <td width="250" align="left"><b>倉  管：</b></td>
			  <td width="250" align="left"><b>送  貨：</b></td>
			  <td width="250" align="left"><b>製  單：</b></td>
			  <td width="250" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		<!--  <br/>   -->
		  
		  <!-- 第二頁 -->
	
		   <?php if($rownum>=6 and $rowtot1 > 6 ) { ?> <div style="page-break-before: always;"></div>
		  <?php $page +=1; ?> 
          <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		     {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;$rownum=7;}  ?>
		  <table class="store">
			 <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
			<tr><td class="title" align="center" valign="top">銷  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨單號：</b><span><?php echo $tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tg042 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $tg008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>帳單地址：</b><?php echo $tg009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $tg004.' '.$tg004disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><span><?php echo $tg047.' '.$tg047disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tg006.' '.$tg006disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $tg004disp3 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $tg004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $tg004disp2 ?></td>
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
				<table class="product" border=1 cellspacing=0 cellpadding=0>
						<tr class="heading">
					   <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>單位</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					
					</tr>
					  <?php $rownum=6;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $th004[$rownum];?></td>
					  <td align="left"><? echo $th005[$rownum];?></td>
					  <td align="left"><? echo $th006[$rownum];?></td>
					  <td align="left"><? echo $th009[$rownum];?></td>
					  <td align="right"><? echo $th008[$rownum];?></td>
					   <?php if ($tprint=='Y') { ?>
					  <td align="right"><? echo $th012[$rownum];?></td>
					  <td align="right"><? echo $th013[$rownum];?></td>
					   <?php } else { ?>
					    <td align="right"><? echo '';?></td>
					    <td align="right"><? echo '';?></td>
					 	 <?php }  ?>	 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $tg020;?>						
					  </td>
					</tr>
					<tr>
					  <td colspan="7" align="left">
					<!--	<b>數量合計：</b><? echo $th008qty;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						&nbsp;&nbsp;&nbsp; -->
				<!--		<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?> -->
                        	<?php if ($rowtot1 <= $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?>  <?php echo '';} ?> 
						<?php if ($rowtot1 > $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 					 
					 </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
				<tr>
			  <td width="250" align="left"><b>核  准：</b></td>
			  <td width="250" align="left"><b>倉  管：</b></td>
			  <td width="250" align="left"><b>送  貨：</b></td>
			  <td width="250" align="left"><b>製  單：</b></td>
			  <td width="250" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php } ?> 
		 
		<!-- 第三頁 -->
		 <?php if($rownum>=12 and $rowtot1 > 12  ) { ?> <div style="page-break-after: always;"></div>
		 <?php $page +=1; ?> 
         <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		   {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;$rownum=13;}  ?>
		 <table class="store">
		    <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
			
			<tr><td class="title" align="center" valign="top">銷  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨單號：</b><span><?php echo $tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tg042 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $tg008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>帳單地址：</b><?php echo $tg009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $tg004.' '.$tg004disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><span><?php echo $tg047.' '.$tg047disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tg006.' '.$tg006disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $tg004disp3 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $tg004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $tg004disp2 ?></td>
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
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>單位</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					
					</tr>
					  <?php $rownum=12;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $th004[$rownum];?></td>
					  <td align="left"><? echo $th005[$rownum];?></td>
					  <td align="left"><? echo $th006[$rownum];?></td>
					  <td align="left"><? echo $th009[$rownum];?></td>
					  <td align="right"><? echo $th008[$rownum];?></td>
					   <?php if ($tprint=='Y') { ?>
					  <td align="right"><? echo $th012[$rownum];?></td>
					  <td align="right"><? echo $th013[$rownum];?></td>
					   <?php } else { ?>
					    <td align="right"><? echo '';?></td>
					    <td align="right"><? echo '';?></td>
					 	 <?php }  ?>	 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $tg020;?>						
					  </td>
					</tr>
					<tr>
					  <td colspan="7" align="left">
					<!--	<b>數量合計：</b><? echo $th008qty;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						&nbsp;&nbsp;&nbsp; -->
						  	<?php if ($rowtot1 <= $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?>  <?php echo '';} ?> 
						<?php if ($rowtot1 > $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 	
                      					 
					 </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
				<tr>
			  <td width="250" align="left"><b>核  准：</b></td>
			  <td width="250" align="left"><b>倉  管：</b></td>
			  <td width="250" align="left"><b>送  貨：</b></td>
			  <td width="250" align="left"><b>製  單：</b></td>
			  <td width="250" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php } ?>  
		 
		 <!-- 第四頁 -->
		 <?php if($rownum>=18 and $rowtot1 > 18  ) { ?> <div style="page-break-after: always;"></div>
		 <?php $page +=1; ?> 
         <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		   {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;$rownum=19;}  ?>
		 <table class="store">
		     <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
			
			<tr><td class="title" align="center" valign="top">銷  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨單號：</b><span><?php echo $tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tg042 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $tg008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>帳單地址：</b><?php echo $tg009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $tg004.' '.$tg004disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><span><?php echo $tg047.' '.$tg047disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tg006.' '.$tg006disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $tg004disp3 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $tg004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $tg004disp2 ?></td>
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
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>單位</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					
					</tr>
					  <?php $rownum=18;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $th004[$rownum];?></td>
					  <td align="left"><? echo $th005[$rownum];?></td>
					  <td align="left"><? echo $th006[$rownum];?></td>
					  <td align="left"><? echo $th009[$rownum];?></td>
					  <td align="right"><? echo $th008[$rownum];?></td>
					   <?php if ($tprint=='Y') { ?>
					  <td align="right"><? echo $th012[$rownum];?></td>
					  <td align="right"><? echo $th013[$rownum];?></td>
					   <?php } else { ?>
					    <td align="right"><? echo '';?></td>
					    <td align="right"><? echo '';?></td>
					 	 <?php }  ?>	 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $tg020;?>						
					  </td>
					</tr>
					<tr>
					  <td colspan="7" align="left">
					<!--	<b>數量合計：</b><? echo $th008qty;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						&nbsp;&nbsp;&nbsp; -->
						  	<?php if ($rowtot1 <= $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?>  <?php echo '';} ?> 
						<?php if ($rowtot1 > $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 	
                      					 
					 </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
				<tr>
			  <td width="250" align="left"><b>核  准：</b></td>
			  <td width="250" align="left"><b>倉  管：</b></td>
			  <td width="250" align="left"><b>送  貨：</b></td>
			  <td width="250" align="left"><b>製  單：</b></td>
			  <td width="250" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php } ?>  
		 <!-- 第五頁 -->
		 <?php if($rownum>=24 and $rowtot1 > 24  ) { ?> <div style="page-break-after: always;"></div>
		 <?php $page +=1; ?> 
         <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		   {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;$rownum=25;}  ?>
		 <table class="store">
		    <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
			
			<tr><td class="title" align="center" valign="top">銷  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨單號：</b><span><?php echo $tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tg042 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $tg008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>帳單地址：</b><?php echo $tg009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $tg004.' '.$tg004disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><span><?php echo $tg047.' '.$tg047disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tg006.' '.$tg006disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $tg004disp3 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $tg004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $tg004disp2 ?></td>
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
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>單位</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					
					</tr>
					  <?php $rownum=24;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $th004[$rownum];?></td>
					  <td align="left"><? echo $th005[$rownum];?></td>
					  <td align="left"><? echo $th006[$rownum];?></td>
					  <td align="left"><? echo $th009[$rownum];?></td>
					  <td align="right"><? echo $th008[$rownum];?></td>
					   <?php if ($tprint=='Y') { ?>
					  <td align="right"><? echo $th012[$rownum];?></td>
					  <td align="right"><? echo $th013[$rownum];?></td>
					   <?php } else { ?>
					    <td align="right"><? echo '';?></td>
					    <td align="right"><? echo '';?></td>
					 	 <?php }  ?>	 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $tg020;?>						
					  </td>
					</tr>
					<tr>
					  <td colspan="7" align="left">
					<!--	<b>數量合計：</b><? echo $th008qty;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						&nbsp;&nbsp;&nbsp; -->
						  	<?php if ($rowtot1 <= $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?>  <?php echo '';} ?> 
						<?php if ($rowtot1 > $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 	
                      					 
					 </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
				<tr>
			  <td width="250" align="left"><b>核  准：</b></td>
			  <td width="250" align="left"><b>倉  管：</b></td>
			  <td width="250" align="left"><b>送  貨：</b></td>
			  <td width="250" align="left"><b>製  單：</b></td>
			  <td width="250" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php } ?>  
		 <!-- 第六頁 -->
		 <?php if($rownum>=30 and $rowtot1 > 30  ) { ?> <div style="page-break-after: always;"></div>
		 <?php $page +=1; ?> 
         <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		   {$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;$rownum=31;}  ?>
		 <table class="store">
		     <tr>
			<td class="logo1" align="center" valign="top">
			<?php  echo $vsysml003; ?>   
			</td>
			 </tr>
			 <tr>
			<td class="logo" align="center" valign="top">
			<?php  echo $vsysml012; ?> <br/>
		    <?php echo 'Tel:'.$vsysml005; ?>
			<?php echo 'Fax:'.$vsysml006; ?>
			</td>
		  </tr>
			
			<tr><td class="title" align="center" valign="top">銷  貨  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>銷貨單號：</b><span><?php echo $tg002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $tg042 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>送貨地址：</b><?php echo $tg008 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>                                      
							  <td width="600" align="left" valign="top"><b>帳單地址：</b><?php echo $tg009 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="35%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶名稱：</b><span><?php echo $tg004.' '.$tg004disp ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>付款條件：</b><span><?php echo $tg047.' '.$tg047disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>業務人員：</b><span><?php echo $tg006.' '.$tg006disp ?></span></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>連 絡 人：</b><?php echo $tg004disp3 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶電話：</b><?php echo $tg004disp1 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>客戶傳真：</b><?php echo $tg004disp2 ?></td>
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
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="left" width="10%"><b>品號</b></td>
					  <td align="left" width="35%"><b>品名</b></td>
					  <td align="left" width="17%"><b>規格</b></td>
					  <td align="left" width="8%"><b>單位</b></td>
					  <td align="right" width="10%"><b>數量</b></td>
					  <td align="right" width="10%"><b>單價</b></td>
					  <td align="right" width="10%"><b>金額</b></td>
					
					</tr>
					  <?php $rownum=30;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $th004[$rownum];?></td>
					  <td align="left"><? echo $th005[$rownum];?></td>
					  <td align="left"><? echo $th006[$rownum];?></td>
					  <td align="left"><? echo $th009[$rownum];?></td>
					  <td align="right"><? echo $th008[$rownum];?></td>
					   <?php if ($tprint=='Y') { ?>
					  <td align="right"><? echo $th012[$rownum];?></td>
					  <td align="right"><? echo $th013[$rownum];?></td>
					   <?php } else { ?>
					    <td align="right"><? echo '';?></td>
					    <td align="right"><? echo '';?></td>
					 	 <?php }  ?>	 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備  註：</b><? echo $tg020;?>						
					  </td>
					</tr>
					<tr>
					  <td colspan="7" align="left">
					<!--	<b>數量合計：</b><? echo $th008qty;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						&nbsp;&nbsp;&nbsp; -->
						  	<?php if ($rowtot1 <= $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo $tg045;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo $tg046;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $tg045+$tg046;} ?>  <?php echo '';} ?> 
						<?php if ($rowtot1 > $rownum ) { ?>
						<b>未稅金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>稅　　額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 	
                      					 
					 </td>
					</tr>
				</table>
			</td></tr>
		</table>
		  <table >
				<tr>
			  <td width="250" align="left"><b>核  准：</b></td>
			  <td width="250" align="left"><b>倉  管：</b></td>
			  <td width="250" align="left"><b>送  貨：</b></td>
			  <td width="250" align="left"><b>製  單：</b></td>
			  <td width="250" align="left"><b>客戶簽名：</b></td>
			</tr>
		  </table>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php } ?>  
</body>
</html>
