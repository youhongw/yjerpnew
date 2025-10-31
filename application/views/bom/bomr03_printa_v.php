    <?php $numrow1 =1;$mc007k=0;$th013ak=0;$th013bk=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=2;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=33;$tot=$paperal-3;} else { $paperal=35;$tot=$paperal-3;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <?php echo $br ; ?><td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			尾階材料用量清單&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>起迄品號:&nbsp;<?php echo $invq02a.' 至 '.$invq02a1; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">主件品號</td>
		<td width="10%" align="left">序號</td>
	    <td width="10%" align="left">元件品號</td>
	    <td width="30%" align="left">品  名<br>規  格</td>
		<td width="10%" align="left">單位<br>取替代件</td>
		<td width="10%" align="left">屬性<br>材料型態</td>
	    <td width="10%" align="right">標準批量<br>組成用量</td>
		<td width="10%" align="right">底數<br>損耗率%</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	    <?php $ii=1; ?>
		<?php  foreach($results as $row ) : ?>
	      <tr>
		    <?php  if ($ii==1) { echo '<td width="10%" align="left">'.$row->mc001 ;} ?></td> 
			<?php  if ($ii==1) { echo '<td width="10%" align="left">' ;} ?></td>
			<?php  if ($ii==1) { echo '<td width="10%" align="left">' ;} ?></td>
			<?php  if ($ii==1) { echo '<td width="30%" align="left">'.$row->mc001disp.'<br>'.$row->mc001disp1 ;} ?></td>
			<?php  if ($ii==1) { echo '<td width="10%" align="left">'.$row->mc002 ;} ?></td>
			<?php  if ($ii==1) { echo '<td width="10%" align="left">'.$row->mc001disp2 ;} ?></td>
			<?php  if ($ii==1) { echo '<td width="10%" align="right">'.$row->mc004 ;} ?></td>
			<?php  if ($ii==1) { echo '<td width="10%" align="right">' ;} ?></td>
			<?php    $ii++; ?>
		  <tr>
		   <?php endforeach;?> 
		 
		 
	   <?php foreach($results as $row ) : ?>
	      <tr>
		<td width="10%" align="left"></td>
		<td width="10%" align="left"><?php echo  $row->md002;?></td>
		<td width="10%" align="left"><?php echo  $row->md003;?></td>
	    	
		<td width="30%" align="left"><?php if ($row->md003disp!='') {  echo wordwrap($row->md003disp,75,"<br />\n",TRUE);} else {echo "_";}?> 
		  <br><?php  if ($row->md003disp1!='') {echo wordwrap($row->md003disp1,75,"<br />\n",TRUE);}  else {echo "_";} ?>
		  <!--  上不能加 /td  -->
	    <td width="10%" align="left"><?php  echo  $row->md004;?><br><?php echo  $row->md010;?></td>
		<td width="10%" align="left"><?php echo  $row->md003disp2;?><br><?php echo  $row->md017;?></td>
		<td width="10%" align="right"><?php echo  round($row->mc004);?><br><?php echo  round($row->md006);?></td> 
		<td width="10%" align="right"><?php echo  round($row->md007);?><br><?php echo  round($row->md008,4);?></td> 
        </tr>		
		 <?php $pagenum +=2;$prow=1;$pagenum1=$pagenum;$mc007k=$mc007k+$row->md006; ?> 
	      
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		   <tr> <?php echo $br ; ?><td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			尾階材料用量清單&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>起迄品號:&nbsp;<?php echo $invq02a.' 至 '.$invq02a1; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	   <tr>
	    <td width="10%" align="left">主件品號</td>
		<td width="10%" align="left">序號</td>
	    <td width="10%" align="left">元件品號</td>
	    <td width="30%" align="left">品  名<br>規  格</td>
		<td width="10%" align="left">單位<br>取替代件</td>
		<td width="10%" align="left">屬性<br>材料型態</td>
	    <td width="10%" align="right">標準批量<br>組成用量</td>
		<td width="10%" align="right">底數<br>損耗率%</td>
      </tr>
	
      </tr>
	
      </tr>
	        </table>
			<?php  $pagenum=4;  ?>	   
		   
	<table class="list">
	     <?php if($pagenum1==33 ) { $pagenum2=1;} ?>  <!-- 29,31,1 ok -->
	     <?php if($pagenum1==34 ) { $pagenum3=1;} ?>  <!-- 29,31,1 ok -->
		<?php  if($pagenum1==33 and $pagenum1==34 ) { $pagenum4=1;} ?>  <!-- 29,31,1 ok -->
	     <?php   } ?>
	  <?php endforeach;?>
	</table>
    </table>
	 <table >
			<tr>
			<!--  <td width="900" align="right"><b>銷貨金額：<?php echo $mc007k ?></b></td>-->
			</tr>
	 </table>