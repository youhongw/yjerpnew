	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=16) { $pagetot = ceil($numrow/14); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=16) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 a4橫式-->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			拆解單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">拆解單號</td>
	    <td width="8%" align="left">單據日期</td>
	    <td width="8%" align="left">出庫庫別</td>
	     <td width="8%" align="left">成品品號</td>
		<td width="8%" align="left">成品數量</td>
		<td width="8%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="20%" align="left">品名<br>規格</td>
		<td width="6%" align="left">單位</td>
		<td width="10%" align="right">元件用量</td>
	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><?php echo  $row->tf001;?></td>
		<td width="8%" align="center"><?php echo  $row->tf002;?></td>
		<td width="8%" align="left"><?php echo  substr($row->tf012,0,4).'/'.substr($row->tf012,4,2).'/'.substr($row->tf012,6,2);?></td>
		<td width="8%" align="left"><?php echo  $row->tf008;?></td>	
		<td width="8%" align="left"><?php echo  $row->tf004;?></td>	
		<td width="8%" align="left"><?php echo  $row->tf007;?></td>	
       
    <!--    <td width="28%" align="left"><?php if ($row->tf006disp!='') {  echo wordwrap($row->tf006disp,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->tf006disp1!='') {echo wordwrap($row->tf006disp1,75,"<br />\n",TRUE);}  else {echo "_";} ?></td> -->
        <td width="8%" align="left"><?php echo  $row->tg003;?></td>		
        <td width="10%" align="left"><?php echo  $row->tg004;?></td>	
       
        <td width="20%" align="left"><?php if ($row->tg004disp!='') {  echo wordwrap($row->tg004disp,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->tg004disp1!='') {echo wordwrap($row->tg004disp1,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="6%" align="left"><?php echo  $row->tg005;?></td>	
        <td width="10%" align="right"><?php echo  $row->tg008;?></td>
       
       		
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=16) {?> <tr></tr><?php $page=$page+1;  ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <br><br>
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			拆解單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
	 <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">拆解單號</td>
	    <td width="8%" align="left">單據日期</td>
	    <td width="8%" align="left">出庫庫別</td>
	     <td width="8%" align="left">成品品號</td>
		<td width="8%" align="left">成品數量</td>
		<td width="8%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="24%" align="left">品名<br>規格</td>
		<td width="6%" align="left">單位</td>
		<td width="6%" align="right">元件用量</td>
		<td width="6%" align="right">備註</td>
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
