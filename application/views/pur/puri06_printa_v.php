	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=49) { $pagetot = ceil($numrow/49); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	<style type="text/css"> body {size:landscape;} </style>	
	<style type="text/css"> body {size:11.69in 8.27in;} </style>	
	<table class="store">    <!-- 跳頁用 portrait-->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請  購  明  細  表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">請購品號</td>
	    <td width="17%" align="center">品名</td>
	    <td width="17%" align="left">規格</td>
	    <td width="17%" align="left">單位</td>
	    <td width="17%" align="left" >請購數量</td>
	    
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
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
			
	<table class="store">   <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	請  購  明  細  表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
       </tr>
	</table>
		
	<table class="thead">   <!-- 列表頭 -->
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