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
			製令單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">製令單號</td>
	    <td width="8%" align="left">開單日期</td>
	    <td width="8%" align="left">加工廠商</td>
		<td width="8%" align="left">主件品號</td>
	<!--	<td width="28%" align="left">主件品名<br>主件規格</td> -->
		<td width="8%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="24%" align="left">品名<br>規格</td>
		<td width="6%" align="left">單位</td>
		<td width="6%" align="right">需領用量</td>
	<!--	<td width="6%" align="right">已領用量</td> -->
		<td width="6%" align="right">未領用量</td>
	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><?php echo  $row->ta001;?></td>
		<td width="8%" align="center"><?php echo  $row->ta002;?></td>
		<td width="8%" align="left"><?php echo  substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
		<td width="8%" align="left"><?php echo  $row->ta032;?></td>	
		<td width="8%" align="left"><?php echo  $row->ta006;?></td>	
       
    <!--    <td width="28%" align="left"><?php if ($row->ta006disp!='') {  echo wordwrap($row->ta006disp,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->ta006disp1!='') {echo wordwrap($row->ta006disp1,75,"<br />\n",TRUE);}  else {echo "_";} ?></td> -->
        <td width="8%" align="left"><?php echo  $row->tb008;?></td>		
        <td width="10%" align="left"><?php echo  $row->tb003;?></td>	
       
        <td width="24%" align="left"><?php if ($row->tb012!='') {  echo wordwrap($row->tb012,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->tb013!='') {echo wordwrap($row->tb013,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="6%" align="left"><?php echo  $row->tb007;?></td>	
        <td width="6%" align="right"><?php echo  $row->tb004;?></td>	
    <!--    <td width="6%" align="right"><?php echo  $row->tb005;?></td>	-->
        <td width="6%" align="right"><?php echo  $row->tb016;?></td>	
       		
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
			製令單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		<tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">製令單號</td>
	    <td width="8%" align="left">開單日期</td>
	    <td width="8%" align="left">加工廠商</td>
		<td width="10%" align="left">主件品號</td>
		<td width="28%" align="left">主件品名<br>主件規格</td>
		<td width="8%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="28%" align="left">品名<br>規格</td>
		<td width="6%" align="left">單位</td>
		<td width="6%" align="right">需領用量</td>
		<td width="6%" align="right">已領用量</td>
		<td width="6%" align="right">未領用量</td>
	
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
