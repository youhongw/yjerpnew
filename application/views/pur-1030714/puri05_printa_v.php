
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=49) { $pagetot = ceil($numrow/49); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請購單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">請購單別</td>
	    <td width="15%" align="center">請購單號</td>
	    <td width="25%" align="left">請購日期</td>
	    <td width="25%" align="left">請購部門</td>	   
	    <td width="20%" align="center">採購人員</td>
          </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	       	<td width="15%" align="center"><? echo $row->ta001;?></td>
		<td width="15%" align="center"><? echo $row->ta002;?></td>
		<td width="25%" align="left"><? echo substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
		<td width="25%" align="left"><? echo $row->ta004;?></td>		
		<td width="20%" align="center"><? echo substr($row->ta012,0,10);?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=49) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請購單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
		 <td width="15%" align="center">請購單別</td>
	    <td width="15%" align="center">請購單號</td>
	    <td width="25%" align="left">請購日期</td>
	    <td width="25%" align="left">請購部門</td>	   
	    <td width="20%" align="center">採購人員</td>
                  </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
