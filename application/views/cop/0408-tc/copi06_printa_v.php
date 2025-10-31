<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi06/printdetail';location = url; </script> 
  <?php } ?>
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=49) { $pagetot = ceil($numrow/49); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 --> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			客戶訂單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <tr>
	    <td width="6%" align="center">訂單單別</td>
	    <td width="8%" align="center">訂單單號</td>
	    <td width="8%" align="left">訂單日期</td>
	    <td width="8%" align="left">客戶代號</td>	  
        <td width="10%" align="left">客戶名稱</td>	
		<td width="6%" align="center">序號</td>
		<td width="8%" align="center">品號</td>
		<td width="12%" align="center">品名</td>
		<td width="12%" align="center">規格</td>
		<td width="4%" align="center">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單價</td>
		<td width="6%" align="right">金額</td>
      </tr>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="6%" align="center"><?php echo  $row->tc001;?></td>
		<td width="8%" align="center"><?php echo  $row->tc002;?></td>
		<td width="8%" align="left"><?php echo  substr($row->tc039,0,4).'/'.substr($row->tc039,4,2).'/'.substr($row->tc039,6,2);?></td>
		<td width="8%" align="left"><?php echo  $row->tc004;?></td>	
        <td width="10%" align="left"><?php echo  $row->tc004disp;?></td>			
		<td width="6%" align="center"><?php echo  $row->td003;?></td>
		<td width="8%" align="center"><?php echo  $row->td004;?></td>
		<td width="12%" align="center"><?php echo  $row->td005;?></td>
		<td width="12%" align="center"><?php echo  $row->td006;?></td>
		<td width="4%" align="center"><?php echo  $row->td010;?></td>
		<td width="6%" align="right"><?php echo  $row->td008;?></td>
		<td width="6%" align="right"><?php echo  $row->td011;?></td>
		<td width="6%" align="right"><?php echo  $row->td012;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=49) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			客戶訂單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		<tr>
	    <td width="6%" align="center">訂單單別</td>
	    <td width="8%" align="center">訂單單號</td>
	    <td width="8%" align="left">訂單日期</td>
	    <td width="8%" align="left">客戶代號</td>	  
        <td width="10%" align="left">客戶名稱</td>	
		<td width="6%" align="center">序號</td>
		<td width="8%" align="center">品號</td>
		<td width="12%" align="center">品名</td>
		<td width="12%" align="center">規格</td>
		<td width="4%" align="center">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單價</td>
		<td width="6%" align="right">金額</td>
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
