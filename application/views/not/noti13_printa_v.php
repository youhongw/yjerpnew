	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=46) { $pagetot = ceil($numrow/46); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=46) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;
			　　　　　　　　　　融資種類明細表　　　　　　　&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="30%" align="left">融資種類</td>
	    <td width="30%" align="left">融資名稱</td>
	    <td width="40%" align="left">融資性質</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	       	<td width="30%" align="left"><?php echo  $row->mc001;?></td>
		    <td width="30%" align="left"><?php echo  $row->mc002;?></td>
		    <td width="40%" align="left"><?php echo  $row->mc003;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=46) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			融資種類明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
		 <td width="10%" align="left">融資種類</td>
	    <td width="10%" align="left">融資名稱</td>
	    <td width="15%" align="left">融資性質</td>
                  </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
