	<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/acp/acpr12/printdetail';location = url; </script> 
  <?php exit;} ?>
    <?php  $numrow1 =1;$ta031a=0;$td009a=0;$td012a=0;  ?>
	<?php  foreach($results as $row ) : ?>
      <?php  $numrow1 +=2;  ?> 
	  <?php  endforeach;?>
	  <!-- 表頭3行   -->
       <?php  $numrow1 +=4;  ?> 
	<?php  $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php  if($paper9=="1")  { $paperal=50;$tot=$paperal-3;} else { $paperal=53;$tot=$paperal-3;}  ?>
	<?php  if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php  if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php  } ?>
	  <?php  $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   
	    <tr><td align="left">帳款期間:&nbsp;<?php  echo $dateo.' 至 '.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php  echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php  echo date("Y/m/d")?><?php  if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
			廠商未付款統計表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			<?php  if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php  echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="20%" align="left">廠商代號<br>廠商名稱</td>
	    <td width="10%" align="left">年  月</td>	 
	    <td width="10%" align="right">付款條件</td>
		<td width="10%" align="right">幣別</td>
		<td width="10%" align="right">未付金額</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php  foreach($results as $row ) : ?>
	      <tr>
	    <td width="20%" align="left"><?php  echo $row->ta004;?><br><?php  echo $row->ta004disp;?></td>
		<td width="10%" align="left"><?php  echo $row->yymm;?></td>
		<td width="10%" align="right"><?php  echo $row->ma025;?></td>	
        <td width="10%" align="right"><?php  echo $row->ta008;?></td>		
        <td width="10%" align="right"><?php  echo round($row->amt);?></td> 
       		
        </tr>		
		 <?php  $pagenum +=2;$prow=1;$pagenum1=$pagenum;$ta031a=$ta031a+$row->amt; ?> 
	      
           <?php  if($pagenum>=$paperal) {?> <tr></tr><?php  $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php  if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php  if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php  if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php  } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		   <tr> <td align="left">帳款期間:&nbsp;<?php  echo $dateo.' 至 '.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php  echo $this->session->userdata('sysml003'); ?></td></tr>
		     <tr>
	      <td align="left">製表日期:&nbsp;<?php  echo date("Y/m/d")?><?php  if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
			廠商未付款統計表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			<?php  if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php  echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	   <tr>
	    <td width="20%" align="center">廠商代號<br>廠商名稱</td>
	    <td width="10%" align="center">年  月</td>	 
	    <td width="10%" align="right">付款條件</td>
		<td width="10%" align="right">幣別</td>
		<td width="10%" align="right">未付金額</td>
	
      </tr>
	
      </tr>
	
      </tr>
	        </table>
			<?php   $pagenum=4;  ?>	   
		   
	<table class="list">
	     <?php  if($pagenum1==33 ) { $pagenum2=1;} ?>  <!-- 29,31,1 ok -->
	     <?php  if($pagenum1==34 ) { $pagenum3=1;} ?>  <!-- 29,31,1 ok -->
		<?php   if($pagenum1==33 and $pagenum1==34 ) { $pagenum4=1;} ?>  <!-- 29,31,1 ok -->
	     <?php    } ?>
	  <?php  endforeach;?>
	</table>
    </table>
	 <table >
			<tr>
			  <td width="900" align="right"><b>合計金額：<?php  echo round($ta031a) ?></b></td>
			
			</tr>
	 </table>