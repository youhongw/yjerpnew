<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/act/acti10/printdetail';location = url; </script> 
  <?php } ?>
	<?php $pagenum=1;$page=1;$vrow=24;  ?>
	<?php if($numrow>=$vrow) { $pagetot = ceil($numrow/$vrow); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$vrow) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;";} else {echo "&nbsp;&nbsp;";} ?>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;會計傳票明細表
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">傳票單別</td>
	    <td width="10%" align="center">傳票單號</td>
	    <td width="10%" align="left">傳票日期</td>
	    <td width="10%" align="right">來源碼</td>
		 <td width="10%" align="right">本幣總額</td>
		<td width="6%" align="left">序號<br><span>借/貸</span></td>
		<td width="8%" align="left">科目編號<br><span>科目名稱</span></td>
		<td width="8%" align="left">部門代號<br><span>部門名稱</span></td>
		<td width="8%" align="left">幣別<br><span>匯率</span></td>
		<td width="8%" align="right">原幣金額</td>
		<td width="8%" align="right">本幣金額</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><?php echo $row->ta001;?></td>
		<td width="10%" align="center"><?php echo $row->ta002;?></td>
		<td width="10%" align="left"><?php echo substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
		 <?php if ($row->ta006=='1')	{$ta0061='一般';} elseif ($row->ta006=='2') {$ta0061='應計';}  elseif ($row->ta006=='3') {$ta0061='應計回轉';}
		   elseif ($row->ta006=='4') {$ta0061='常用傳票';}  elseif ($row->ta006=='5') {$ta0061='比率分攤';}  elseif ($row->ta006=='6') {$ta0061='迴轉傳票';} else   {$ta0061='其他轉入';}       ?>	
        <td width="10%" align="left"><?php echo $row->ta006;?><br><?php echo $ta0061;?></td>
		<td width="10%" align="center"><?php echo $row->ta008;?></td>
		
        <td width="6%" align="left"><?php echo $row->tb003;?><br><?php echo $row->tb004;?></td>
		<td width="8%" align="left"><?php echo $row->tb005;?><br><?php echo $row->tb005disp;?></td>	
		<td width="8%" align="left"><?php echo $row->tb006;?><br><?php echo $row->tb006disp;?></td>
		<td width="8%" align="left"><?php echo $row->tb013;?><br><?php echo $row->tb014;?></td>
        <td width="8%" align="left"><?php echo $row->tb015;?></td>	
        <td width="8%" align="left"><?php echo $row->tb007;?></td>
       		
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=24) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		  <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;";} else {echo "&nbsp;&nbsp;";} ?>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;會計傳票明細表
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
        </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	    <td width="8%" align="center">傳票單別</td>
	    <td width="10%" align="center">傳票單號</td>
	    <td width="10%" align="left">傳票日期</td>
	    <td width="10%" align="right">來源碼</td>
		 <td width="10%" align="right">本幣總額</td>
		<td width="6%" align="left">序號<br><span>借/貸</span></td>
		<td width="8%" align="left">科目編號<br><span>科目名稱</span></td>
		<td width="8%" align="left">部門代號<br><span>部門名稱</span></td>
		<td width="8%" align="left">幣別<br><span>匯率</span></td>
		<td width="8%" align="right">原幣金額</td>
		<td width="8%" align="right">本幣金額</td>
      </tr>
	
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
