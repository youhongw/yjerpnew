	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=31) { $pagetot = ceil($numrow/31); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=31) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	  <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	  <tr>
	    <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			潛在客戶明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
      </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">潛在客戶代號</td>
	    <td width="15%" align="center">潛在客戶簡稱</td>
	    <td width="20%" align="left">電話</td> 
		<td width="20%" align="left">業務員</td> 
	    <td width="15%" align="left">等級區分</td>
		<td width="15%" align="left">客戶類別</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	   <tr>
	   	<td width="15%" align="center"><?php echo  $row->ma001;?></td>
		<td width="15%" align="center"><?php echo  $row->ma002;?></td>
		<td width="20%" align="left"><?php echo  $row->ma006;?></td>	
		<td width="20%" align="left"><?php echo  $row->ma016;?></td>
		<td width="15%" align="left"><?php echo  $row->ma028;?></td>
		<td width="15%" align="left"><?php echo  $row->ma201;?></td>
       </tr>
	   <?php $pagenum +=1; ?> 
       <?php if($pagenum>=31) {?> <tr></tr><?php $page=$page+1; ?> 
	</table>	
		<table class="store">   <!-- 跳頁用 -->
		  <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		  <tr>
	    <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			潛在客戶明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
      </tr>
	    </table>
		
	<table class="thead">   <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">潛在客戶代號</td>
	    <td width="15%" align="center">潛在客戶簡稱</td>
	    <td width="20%" align="left">電話</td> 
		<td width="20%" align="left">業務員</td> 
	    <td width="15%" align="left">等級區分</td>
		<td width="15%" align="left">客戶類別</td>
      </tr>
	</table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
