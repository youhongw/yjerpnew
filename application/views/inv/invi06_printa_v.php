
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=46) { $pagetot = ceil($numrow/46); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=46) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　";} else 
		  {echo "　";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			實盤資料明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="12%" align="center">盤點底稿</td>
		<td width="12%" align="center">儲位</td>
	    <td width="12%" align="center">品號</td>
	    <td width="22%" align="left">品名</td>
	    <td width="22%" align="left">規格</td>
		<td width="10%" align="left">單位</td>
		<td width="10%" align="left">實盤數量</td>
		
       </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="12%" align="center"><?php echo  $row->td1001;?></td>
		<td width="12%" align="center"><?php echo  $row->td1004;?></td>
		<td width="12%" align="center"><?php echo  $row->td1005;?></td>
		<td width="22%" align="left"><?php echo  $row->mb002;?></td>
		<td width="22%" align="left"><?php echo  $row->mb003;?></td>
		<td width="10%" align="left"><?php echo  $row->mb004;?></td>
		<td width="10%" align="left"><?php echo  $row->td1006;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=46) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		 <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　";} else 
		  {echo "　";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			實盤資料明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		   <tr>
	    <td width="12%" align="center">盤點底稿</td>
		<td width="12%" align="center">儲位</td>
	    <td width="12%" align="center">品號</td>
	    <td width="22%" align="left">品名</td>
	    <td width="22%" align="left">規格</td>
		<td width="10%" align="left">單位</td>
		<td width="10%" align="left">實盤數量</td>
		
       </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
