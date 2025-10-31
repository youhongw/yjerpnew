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
			組合單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">組合單號</td>
	    <td width="8%" align="left">單據日期</td>
	    <td width="8%" align="left">入庫庫別</td>
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
	    <td width="8%" align="center"><?php echo  $row->td001;?></td>
		<td width="8%" align="center"><?php echo  $row->td002;?></td>
		<td width="8%" align="left"><?php echo  substr($row->td014,0,4).'/'.substr($row->td014,4,2).'/'.substr($row->td014,6,2);?></td>
		<td width="8%" align="left"><?php echo  $row->td010;?></td>	
		<td width="8%" align="left"><?php echo  $row->td004;?></td>	
		<td width="8%" align="left"><?php echo  $row->td007;?></td>	
       
    <!--    <td width="28%" align="left"><?php if ($row->td006disp!='') {  echo wordwrap($row->td006disp,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->td006disp1!='') {echo wordwrap($row->td006disp1,75,"<br />\n",TRUE);}  else {echo "_";} ?></td> -->
        <td width="8%" align="left"><?php echo  $row->te003;?></td>		
        <td width="10%" align="left"><?php echo  $row->te004;?></td>	
       
        <td width="20%" align="left"><?php if ($row->te004disp!='') {  echo wordwrap($row->te004disp,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->te004disp1!='') {echo wordwrap($row->te004disp1,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="6%" align="left"><?php echo  $row->te005;?></td>	
        <td width="10%" align="right"><?php echo  $row->te008;?></td>
       
       		
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
			組合單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
	 <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">組合單號</td>
	    <td width="8%" align="left">單據日期</td>
	    <td width="8%" align="left">入庫庫別</td>
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
    
