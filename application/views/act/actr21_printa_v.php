    <?php $numrow1 =1;$mbb007k=0;$th013ak=0;$th013bk=0;  ?>
	<?php $vmbb016=0;$vmbb017=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=1;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=45;$tot=$paperal-3;} else { $paperal=45;$tot=$paperal-3;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <?php echo $br ; ?><td align="left">　　　　　　　　　　　　　　　　　
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　";} else 
		  {echo "　　　　　　　　　";} ?>		    
						損  益  表　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $vdate; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="30%" align="center">科目編號</td>
	    <td width="38%" align="center">科目名稱</td>
		<td width="16%" align="right">本期金額</td>
	    <td width="16%%" align="right">累計金額</td>
		
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
		  
		<?php  if ($row->mbb016==0) {$mbb016='-';} else {$mbb016=number_format($row->mbb016, 2, '.' ,',');} ?>
		<?php  if ($row->mbb017==0) {$mbb017='-';} else {$mbb017=number_format($row->mbb017, 2, '.' ,',');} ?> 
		
		 <?php // if ($row->mbb003=='5999' or $row->mbb003=='6999' or $row->mbb003=='7999') { ?>
	<!--	<td width="30%" align="center"><?php echo  $row->mbb004;?></td>	
		<td width="38%" align="center"><?php echo  '';?></td>	
		<td width="16%" align="right"><?php echo  $mbb016;?></td> 
		 <td width="16%" align="right"><?php echo  $mbb017;?></td>  --> <?php // ;} ?>
		 
		  <?php // if ($row->mbb003!='5999' and $row->mbb003!='6999' and $row->mbb003!='7999') { ?>
	    <td width="30%" align="center"><?php echo  $row->mbb003;?></td>
		<td width="38%" align="center"><?php echo  $row->mbb004;?></td>	
		<td width="16%" align="right"><?php echo  $mbb016;?></td> 
		 <td width="16%" align="right"><?php echo  $mbb017;?></td>  <?php // ;} ?>
		 
		 
		 
        </tr>		
		 <?php $pagenum +=1;$prow=1;$pagenum1=$pagenum; ?> 
	       <?php $vmbb016=$vmbb016+round($row->mbb016);$vmbb017=$vmbb017+round($row->mbb017); ?> 		  
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		  <tr><?php echo $br ; ?><td align="left">　　　　　　　　　　　　　　　　　
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　";} else 
		  {echo "　　　　　　　　　";} ?>		    
						損  益  表　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $vdate; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	  <tr>
	     <td width="30%" align="center">科目編號</td>
	    <td width="38%" align="center">科目名稱</td>
		<td width="16%" align="right">本期金額</td>
	    <td width="16%%" align="right">累計金額</td>
		
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
	<!-- <table >
			<tr>
			  <td width="28%" align="right"><b><?php echo '本期損益:'; ?></b></td>
			  <td width="100" align="right"><b><?php echo round($vmbb016); ?></b></td>
			  <td width="28%" align="right"><b><?php echo '累計損益:'; ?></b></td>
			  <td width="100" align="right"><b><?php echo round($vmbb017); ?></b></td>
			 
			</tr>
	 </table> -->