	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=49) { $pagetot = ceil($numrow/49); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	<style type="text/css"> body {size:landscape;} </style>	
	<style type="text/css"> body {size:11.69in 8.27in;} 
		tr{
			border:1px;
			border-bottom-style:solid;border-color:black;
		}
		td{
			border:1px;
			height:35px;border-color:black;
		}
		.td_right td{
			border:1px;
			border-right-style:solid;
		}
		.tr_nobot{
			border-bottom-style:hidden;
		}
	</style>
	<div id="top_div" name="top_div">
		<div style="text-align:center;"><font size="4"><b><?php echo $this->session->userdata('sysml003'); ?></b></font></div>
	<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
	</div>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="text-align:left;width:30%;">
			日&nbsp;&nbsp;&nbsp;&nbsp;期 : <span id="pur_date" name="pur_date"><?php echo date("Y/m/d")?></span>
			</td>
			<td style="text-align:center;width:40%;">
			<font size="5">請&nbsp;&nbsp;購&nbsp;&nbsp;明&nbsp;&nbsp;細&nbsp;&nbsp;表</font>
			</td>
			<td style="text-align:right;width:30%;">
			<!--頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"><?php echo $page.'/'.$pagetot ?></span>
			因單筆所以砍掉頁次-->
			</td>
			
			
		</tr>
	</table>	
	
	<!--<table class="store">     跳頁用 portrait
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請  購  明  細  表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
       </tr>
	</table>-->
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="text-align:left;width:60%;" colspan="3">
			<div>請購單別:<span id="" name=""><?php echo $results[0]->tb001 ?></span></div>
			<div>請購人員:<span id="" name=""><?php echo $results[0]->ta012 ?></span></div>
			</td>
			<td style="text-align:left;width:28%;" colspan="4">
			<div>請購單號:<span id="" name=""><?php echo $results[0]->tb002 ?></span></div>
			<div>製造單位:<span id="" name=""><?php echo $results[0]->ta004 ?></span></div>
			</td>
			<td style="text-align:left;width:12%;" colspan="3">
			<div>請購日期:<span id="" name="">20160309</span></div>
			<div>用&nbsp;&nbsp;&nbsp;&nbsp;途:<span id="" name=""></span></div>
			</td>
		</tr>
		<tr>
			<td style="width:5%">序號</td><td style="width:10%">品號</td><td style="width:15%">品名</td><td style="width:12%">規格</td><td>請購數量</td><td>庫存數量</td><td>月用量</td><td>單位</td><td>急料</td><td>需求日期</td>
		</tr>
		<tr>
			<td style="width:5%"><?php echo $results[0]->tb003?></td><td style="width:10%"><?php echo $results[0]->tb004?></td><td style="width:15%"><?php echo $results[0]->tb005?></td><td style="width:10%"><?php echo $results[0]->tb006?></td><td style="text-align:center;"><?php echo $results[0]->tb009?></td><td style="text-align:center;"></td><td style="text-align:center;"></td><td><?php echo $results[0]->tb007?></td><td><?php echo $results[0]->tb032?></td><td><?php echo $results[0]->tb011?></td>
		</tr>
	</table>
	
	<!--<table class="thead">     列表頭 
	  <tr>
	    <td width="15%" align="center">請購品號</td>
	    <td width="17%" align="center">品名</td>
	    <td width="17%" align="left">規格</td>
	    <td width="17%" align="left">單位</td>
	    <td width="17%" align="left" >請購數量</td>
	    
      </tr>
	</table>-->
	
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="border-right-style:solid;text-align:center;" colspan="2">請購核決</td><td colspan="4" style="border-right-style:solid;">核准:</td><td colspan="4" style="border-right-style:solid;">審查:</td><td colspan="5">經辦:</td>
		</tr>
		<tr class="td_right" style="text-align:center;vertical-align:middle;">
			<td rowspan="4" width="2%">採購欄</td><td width="8%">廠商名稱</td><td width="5%">單價</td><td width="5%">議價</td><td width="12%">備&nbsp;&nbsp;註</td><td width="8%">廠商名稱</td><td width="6%">單價</td><td width="6%">議價</td><td width="10%">備&nbsp;&nbsp註</td><td rowspan="4" width="2%">採購紀錄</td><td>進貨日期</td><td>廠商名稱</td><td width="6%">數量</td><td width="5%">單位</td><td width="5%">單價</td>
		</tr>
		<?php //foreach(@$results_hp as $row_hp) : ?>
		<tr class="td_right" style="text-align:center;vertical-align:middle;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><!--留白-->
			<?php IF(@$results_hp[0]):?>
			<td><?php echo $results_hp[0]->th014?></td>
			<td><?php echo $results_hp[0]->tg005?></td>
			<td><?php echo $results_hp[0]->th015?></td>
			<td><?php echo $results_hp[0]->th008?></td>
			<td><?php echo $results_hp[0]->th018?></td>
			<?php ELSE : ?><td></td><td></td><td></td><td></td><td></td>
			<?php ENDIF;?>
		</tr>
		<tr class="td_right" style="text-align:center;vertical-align:middle;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<?php IF(@$results_hp[1]):?>
			<td><?php echo $results_hp[1]->th014?></td>
			<td><?php echo $results_hp[1]->tg005?></td>
			<td><?php echo $results_hp[1]->th015?></td>
			<td><?php echo $results_hp[1]->th008?></td>
			<td><?php echo $results_hp[1]->th018?></td>
			<?php ELSE : ?><td></td><td></td><td></td><td></td><td></td>
			<?php ENDIF;?>
		</tr>
		<tr class="td_right" style="text-align:center;vertical-align:middle;">
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<?php IF(@$results_hp[2]):?>
			<td><?php echo $results_hp[2]->th014?></td>
			<td><?php echo $results_hp[2]->tg005?></td>
			<td><?php echo $results_hp[2]->th015?></td>
			<td><?php echo $results_hp[2]->th008?></td>
			<td><?php echo $results_hp[2]->th018?></td>
			<?php ELSE : ?><td></td><td></td><td></td><td></td><td></td>
			<?php ENDIF;?>
		</tr>
		<?php //endforeach;?>
		<tr class="tr_nobot">
			<td rowspan="5" width="2%" style="border-right-style:solid;">採購意見</td>
			<td>1.擬向#</td><td colspan="4" style="text-align:right;">購買</td><td colspan="9"></td>
		</tr>
		<tr class="tr_nobot">
			<td>2.訂價後</td><td colspan="4" style="text-align:right;">天交貨.</td><td>(</td><td>年</td><td>月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日)</td><td colspan="6"></td>
		</tr>
		<tr class="tr_nobot">
			<td colspan="3">3.報價</td><td>月</td><td style="text-align:right;">日有效.</td><td colspan="9"></td>
		</tr>
		<tr class="tr_nobot">
			<td></td>
		</tr>
		<tr>
			<td colspan="14"></td>
		</tr>
		<tr>
			<td style="border-right-style:solid;">呈核</td><td colspan="4" style="padding-left: 12px;border-right-style:solid;">總&nbsp;經&nbsp;理:</td><td colspan="4" style="border-right-style:solid;">協&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;理:</td><td colspan="3" style="border-right-style:solid;">總副理:</td><td colspan="3" style="border-right-style:solid;">主辦:</td>
		</tr>
	</table>
    
	<!--<table class="list">      列明細 
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	  <tr>
	    <td width="15%" align="center"><?php echo  $row->tb004;?></td>
		<td width="17%" align="center"><?php echo  $row->tb005;?></td>
		<td width="17%" align="left"><?php echo  $row->tb006;?></td>
		<td width="17%" align="left"><?php echo  $row->tb007;?></td>
		<td width="17%" align="left" ><?php echo  $row->tb009;?></td>
	
     </tr>
	 <?php $pagenum +=1; ?> 
     <?php if($pagenum>=49) {?> <tr></tr><?php $page=$page+1; ?> 
	-->	
	<!--<table class="store">    跳頁用 
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	請  購  明  細  表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
       </tr>
	</table>
	-->
	<!--<table class="thead">    列表頭 
	  <tr>
	      <td width="15%" align="center">請購品號</td>
	    <td width="17%" align="center">品名</td>
	    <td width="17%" align="left">規格</td>
	    <td width="17%" align="left">單位</td>
	    <td width="17%" align="left" >請購數量</td>
      </tr>
	</table>
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
	-->