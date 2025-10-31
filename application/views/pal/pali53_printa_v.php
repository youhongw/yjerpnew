
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=40) { $pagetot = ceil($numrow/40); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=40) {/*?> <div style="page-break-after: always;"></div>
      	<?php */} ?>
	
	<table class="store">    <!-- 跳頁用 -->
		<tr><td align="center" colspan="3" ><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		<tr>
		<!--
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			加班單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
		-->
			
			<td align="left" width="33%">查詢日期區間:&nbsp;<?php echo substr($tf002o,0,4)."/".substr($tf002o,4,2)."/".substr($tf002o,6,2)."~<br>".substr($tf002c,0,4)."/".substr($tf002c,4,2)."/".substr($tf002c,6,2);?></td>
			<td align="center" width="33%">加班單明細表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $page .'/'.$pagetot; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="7%" align="left">員工代號</td>
		<td width="8%" align="left">員工姓名</td>
	    <td width="10%" align="left">部門名稱</td>
	    <td width="8%" align="left">加班日期</td>
		<td width="10%" align="left">加班時段一</td>
	    <td width="10%" align="left">加班時段二</td>
	    <td width="10%" align="left">加班時段三</td>
	    <td width="15%" align="left">備註</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
		<tr>
	    <td width="7%" align="left"><?php echo $row->tf001;?></td>
		<td width="8%" align="left"><?php echo $row->tf001disp;?></td>
		<td width="10%" align="left"><?php if($row->tf001disp1){echo $row->tf001disp1.":".$row->tf001disp2;} ?></td>
		<td width="8%" align="left"><?php echo $row->tf002;?></td>
		<td width="10%" class="left">
		<?php if($row->tf003!=6&&$row->tf003!=0&&$row->holiday!=1)
				{echo "平2內: ".$row->tf010." HR";}
			else if($row->tf003==6)
				{echo "六2內: ".$row->tf012." HR";}
			else if($row->tf003==0||$row->holiday==1)
				{if($row->tf014!=""){echo "日8內: ".$row->tf014." HR";}}?>
		</td>	
		<td width="10%" class="left">
		<?php if($row->tf003!=6&&$row->tf003!=0&&$row->holiday!=1)
				{echo "平2外: ".$row->tf011." HR";} 
			else if($row->tf003==6)
				{echo "六3~8: ".$row->tf013." HR";}
			else if($row->tf003==0||$row->holiday==1)
				{if($row->tf015!=""){echo "日8外: ".$row->tf015." HR";}}?>
		</td>	
		<td width="10%" class="left">
		<?php if($row->tf003!=6&&$row->tf003!=0&&$row->holiday!=1)
				{echo "";}
			else if($row->tf003==6)
				{echo "六8外: ".$row->tf018." HR";}
			else if($row->tf003==0||$row->holiday==1)
				{if($row->tf019!=""){echo "日10外: ".$row->tf019." HR";}}?>
		</td>
		<td width="15%" align="left"><?php echo  $row->tf016;?></td>
		</tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=40) { echo "</table><div style='page-break-before: always;'></div>"; ?><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		<tr><td align="center" colspan="3" ><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		<tr>
		<!--
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			加班單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
		-->
			
			<td align="left" width="33%">查詢日期區間:&nbsp;<?php echo substr($tf002o,0,4)."/".substr($tf002o,4,2)."/".substr($tf002o,6,2)."~<br>".substr($tf002c,0,4)."/".substr($tf002c,4,2)."/".substr($tf002c,6,2);?></td>
			<td align="center" width="33%">加班單明細表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $page .'/'.$pagetot; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
		</table>
		<table class="thead">    <!-- 列表頭 -->
		  <tr>
			<td width="7%" align="left">員工代號</td>
			<td width="8%" align="left">員工姓名</td>
			<td width="10%" align="left">部門名稱</td>
			<td width="8%" align="left">加班日期</td>
			<td width="10%" align="left">加班時段一</td>
			<td width="10%" align="left">加班時段二</td>
			<td width="10%" align="left">加班時段三</td>
			<td width="15%" align="left">備註</td>
		  </tr>
		</table>
			
		<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
