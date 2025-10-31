    <?php $numrow1 =1;$mbc007k=0;$th013ak=0;$th013bk=0;  ?>
	<?php $vmbc006=0;$vmbc010=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=1;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=48;$tot=$paperal-3;} else { $paperal=50;$tot=$paperal-3;}  ?>
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
						資 產 負 債 表　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $vdate; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="left">科目編號</td>
	    <td width="23%" align="left">科目名稱</td>
		<td width="12%" align="right">金額</td>
	    <td width="15%" align="left">科目編號</td>
	    <td width="23%" align="left">科目名稱</td>
		<td width="12%" align="right">金額</td>
		
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
		<?php  if ($row->mbc003<='1999') {$vmbc003=$row->mbc003;} ?>
		<?php  if ($row->mbc003>'1999') {$vmbc003='';} ?>
		<?php  if ($row->mbc007>='2') {$vmbc007=$row->mbc007;} ?>
		<?php  if ($row->mbc007<'2') {$vmbc007='';} ?>
		
		<?php  if ($row->mbc006==0) {$vmbc006='-';} else {$vmbc006=number_format($row->mbc006, 2, '.' ,',');} ?>
		<?php  if ($row->mbc010==0) {$vmbc010='-';} else {$vmbc010=number_format($row->mbc010, 2, '.' ,',');} ?> 
		
	    <td width="15%" align="left"><?php echo  $vmbc003.' ';?></td>
		<td width="23%" align="left"><?php echo  $row->mbc004;?></td>	
		<td width="12%" align="right"><?php echo  $vmbc006;?></td> 
		<td width="15%" align="left"><?php echo  $vmbc007;?></td>
		<td width="23%" align="left"><?php echo  $row->mbc008;?></td>	
		<td width="12%" align="right"><?php echo  $vmbc010;?></td> 
	
       		
        </tr>		
		 <?php $pagenum +=1;$prow=1;$pagenum1=$pagenum; ?> 
	       <?php $vmbc006=$vmbc006+round($row->mbc006);$vmbc010=$vmbc010+round($row->mbc010); ?> 		  
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		  <tr> <?php echo $br ; ?><td align="left">　　　　　　　　　　　　　　　　　
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　";} else 
		  {echo "　　　　　　　　　";} ?>		    
						資 產 負 債 表　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $vdate; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	 <tr>
	    <td width="15%" align="left">科目編號</td>
	    <td width="23%" align="left">科目名稱</td>
		<td width="12%" align="right">金額</td>
	    <td width="15%" align="left">科目編號</td>
	    <td width="23%" align="left">科目名稱</td>
		<td width="12%" align="right">金額</td>
		
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
<!--	 <table >
			<tr>
			  <td width="28%" align="right"><b><?php echo '本期損益:'; ?></b></td>
			  <td width="100" align="right"><b><?php echo round($vmbc016); ?></b></td>
			  <td width="28%" align="right"><b><?php echo '累計損益:'; ?></b></td>
			  <td width="100" align="right"><b><?php echo round($vmbc017); ?></b></td>
			 
			</tr>
	 </table>  -->