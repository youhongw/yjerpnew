	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=46) { $pagetot = ceil($numrow/46); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=46) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			銀行存提款明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">存提單別</td>
	    <td width="15%" align="left">存提單號</td>
	    <td width="10%" align="left">銀行代號</td>
	    <td width="15%" align="left">銀行簡稱</td>
	    <td width="15%" align="right">銀行存提科目</td>	   
	    <td width="15%" align="right">存提日期</td>
		<td width="10%" align="right">確認者</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	       	<td width="10%" align="left"><?php echo  $row->tf001;?></td>
		    <td width="15%" align="left"><?php echo  $row->tf002;?></td>
		    <td width="10%" align="left"><?php echo  $row->tf004;?></td>
		    <td width="15%" align="right"><?php echo  $row->ma002;?></td>
		    <td width="15%" align="right"><?php echo  $row->ma005;?></td>
            <td width="15%" align="right"><?php echo  $row->tf003;?></td>
            <td width="10%" align="right"><?php echo  $row->tf012;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=46) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			銀行存提款明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
			 <td width="10%" align="left">存提單別</td>
			<td width="15%" align="left">存提單號</td>
			<td width="10%" align="left">銀行代號</td>
			<td width="15%" align="left">銀行簡稱</td>
			<td width="15%" align="right">銀行存提科目</td>	   
			<td width="15%" align="right">存提日期</td>
			<td width="10%" align="right">確認者</td>
             </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
