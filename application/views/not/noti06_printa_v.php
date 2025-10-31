
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=38) { $pagetot = ceil($numrow/38); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=38) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			票據單據明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">單據代號</td>
	    <td width="17%" align="center">單據名稱</td>
	    <td width="10%" align="right">單據性質</td>
	    <td width="10%" align="right">編碼方式</td>
	    <td width="10%" align="right" >年碼數</td>
	    <td width="30%" align="right">單據全名</td>
          </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	       	<td width="15%" align="center"><?php echo  $row->mq001;?></td>
		<td width="17%" align="center"><?php echo  $row->mq002;?></td>
		<td width="10%" align="right"><?php echo  $row->mq003;?></td>
		<td width="10%" align="right"><?php echo  $row->mq004;?></td>
		<td width="10%" align="right" ><?php echo  $row->mq005;?></td>
		<td width="30%" align="right"><?php echo  $row->mq034;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=38) {?> <tr></tr><?php $page=$page+1; ?> 
			 <div style="page-break-before: always;"></div>
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			票據單據明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	    <td width="15%" align="center">單據代號</td>
	    <td width="17%" align="center">單據名稱</td>
	    <td width="10%" align="right">單據性質</td>
	    <td width="10%" align="right">編碼方式</td>
	    <td width="10%" align="right" >年碼數</td>
	    <td width="30%" align="right">單據全名</td>
          </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
