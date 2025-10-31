<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copi08/printdetail';location = url; </script> 
  <?php } ?>
    <?php $numrow1 =1;  ?>
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
	   <tr><td align="center"><?php echo $br ; ?><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			銷貨單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="9%" align="center">銷貨單號</td>
	    <td width="8%" align="left">銷貨日期</td>
	    <td width="8%" align="left">客戶代號<br>客戶名稱</td>
		<td width="6%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="28%" align="left">品名<br>規格</td>
		<td width="5%" align="left">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單價</td>
		<td width="6%" align="right">金額</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><?php echo  $row->tg001;?></td>
		<td width="9%" align="center"><?php echo  $row->tg002;?></td>
		<td width="8%" align="left"><?php echo  substr($row->tg003,0,4).'/'.substr($row->tg003,4,2).'/'.substr($row->tg003,6,2);?></td>
		<td width="8%" align="left"><?php echo  $row->tg004;?><br><?php echo  $row->tg004disp;?></td>	
        <td width="6%" align="left"><?php echo  $row->th003;?></td>		
        <td width="10%" align="left"><?php echo  $row->th004;?></td>        
	  
		<td width="28%" align="left"><?php if ($row->th005!='') {  echo wordwrap($row->th005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($row->th006!='') {echo wordwrap($row->th006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="5%" align="left"><?php echo  $row->th009;?></td>	
        <td width="6%" align="right"><?php echo  $row->th008;?></td>	
        <td width="6%" align="right"><?php echo  $row->th012;?></td>	
        <td width="6%" align="right"><?php echo  $row->th013;?></td>	
       		
        </tr>		
		 <?php $pagenum +=2;$prow=1;$pagenum1=$pagenum; ?> 
	      
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"> <?php echo $br ; ?><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		    <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			銷貨單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	   <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="9%" align="center">銷貨單號</td>
	    <td width="8%" align="left">銷貨日期</td>
	     <td width="8%" align="left">客戶代號<br>客戶名稱</td>
		<td width="6%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="28%" align="left">品名<br>規格</td>
		<td width="5%" align="left">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單價</td>
		<td width="6%" align="right">金額</td>
	
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
	