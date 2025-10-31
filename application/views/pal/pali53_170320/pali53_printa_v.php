
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=52) { $pagetot = ceil($numrow/52); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=52) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			加班單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">員工代號</td>
		<td width="10%" align="left">員工姓名</td>
	    <td width="10%" align="left">部門代號</td>
		<td width="10%" align="left">部門名稱</td>
	    <td width="10%" align="left">加班日期</td>
		<td width="10%" align="left">平時加班2小時內</td>
	    <td width="10%" align="left">平時加班2小時外</td>
	    <td width="30%" align="left">備註</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="10%" align="left"><?php echo  $row->tf001;?></td>
		<td width="10%" align="left"><?php echo  $row->tf001disp;?></td>
		<td width="10%" align="left"><?php echo  $row->tf001disp1;?></td>
		<td width="10%" align="left"><?php echo  $row->tf001disp2;?></td>
		<td width="10%" align="left"><?php echo  $row->tf002;?></td>
		<td width="10%" align="left"><?php echo  $row->tf010;?></td>
		<td width="10%" align="left"><?php echo  $row->tf011;?></td>
		<td width="30%" align="left"><?php echo  $row->tf016;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=52) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			加班單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
	 <tr>
	    <td width="10%" align="left">員工代號</td>
		<td width="10%" align="left">員工姓名</td>
	    <td width="10%" align="left">部門代號</td>
		<td width="10%" align="left">部門名稱</td>
	    <td width="10%" align="left">加班日期</td>
		<td width="10%" align="left">平時加班2小時內</td>
	    <td width="10%" align="left">平時加班2小時外</td>
	    <td width="30%" align="left">備註</td>
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
