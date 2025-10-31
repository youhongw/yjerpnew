	<?php $pagenum=1;$page=1;$vrow=24;  ?>
	<?php if($numrow>=$vrow) { $pagetot = ceil($numrow/$vrow); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$vrow) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;付款單明細表
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="10%" align="center">付款單號</td>
	    <td width="10%" align="left">憑單日期</td>
	    <td width="8%" align="left">供應廠商</td>
		<td width="6%" align="left">序號</td>
		<td width="6%" align="left">惜/貸</td>
		<td width="6%" align="left">來源</td>
		<td width="8%" align="left">憑證單別</td>
		<td width="10%" align="left">憑證單號</td>
		<td width="8%" align="left">到期日</td>
		<td width="8%" align="right">原幣金額</td>
		<td width="8%" align="right">本幣金額</td>
	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><? echo $row->tc001;?></td>
		<td width="10%" align="center"><? echo $row->tc002;?></td>
		<td width="10%" align="left"><? echo substr($row->tc003,0,4).'/'.substr($row->tc003,4,2).'/'.substr($row->tc003,6,2);?></td>
		<td width="8%" align="left"><? echo $row->tc004;?></td>	
        <td width="6%" align="left"><? echo $row->td003;?></td>		
        <td width="6%" align="left"><? echo $row->td004;?></td>	
        <td width="6%" align="left"><? echo $row->td005;?></td>	
        <td width="8%" align="left"><? echo $row->td006;?></td>	
        <td width="10%" align="left"><? echo $row->td007;?></td>	
        <td width="8%" align="right"><? echo $row->td009;?></td>	
        <td width="8%" align="right"><? echo $row->td014;?></td>	
        <td width="8%" align="right"><? echo $row->td015;?></td>	
       		
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=24) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;付款單明細表
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
        </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="10%" align="center">付款單號</td>
	    <td width="10%" align="left">憑單日期</td>
	    <td width="8%" align="left">供應廠商</td>
		<td width="6%" align="left">序號</td>
		<td width="6%" align="left">惜/貸</td>
		<td width="6%" align="left">來源</td>
		<td width="8%" align="left">憑證單別</td>
		<td width="10%" align="left">憑證單號</td>
		<td width="8%" align="left">到期日</td>
		<td width="8%" align="right">原幣金額</td>
		<td width="8%" align="right">本幣金額</td>
	
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
