    <?php $numrow1 =1;$mba007k=0;$th013ak=0;$th013bk=0;  ?>
	<?php $vmba006=0;$vmba007=0;$vmba008=0;$vmba009=0;$vmba010=0;$vmba011=0;$vmba012=0;$vmba013=0;$vmba014=0;$vmba015=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=1;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=26;$tot=$paperal-3;} else { $paperal=26;$tot=$paperal-3;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <?php echo $br ; ?><td align="left">　　　　　　　　　　　　　　　　　　　　　　　　　　　
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　　";} else 
		  {echo "　　　　　　　　　　";} ?>		    
			　　　　　　　　　
			<?php if($mf001c=="1")  {echo "試  算  表(統制帳戶)";} else {echo "試  算  表(明細帳戶)";} ?>　　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $vdate; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="12%" align="center">科目編號</td>
	    <td width="16%" align="center">科目名稱</td>
		<td width="8%" align="right">期初借<br/>方餘額</td>
	    <td width="8%" align="right">期初貸<br/>方餘額</td>
		<td width="8%" align="right">本期借<br/>方金額</td>
	    <td width="8%" align="right">本期貸<br/>方金額</td>
		<td width="8%" align="right">借方筆數</td>
	    <td width="8%" align="right">貸方筆數</td>
		<td width="8%" align="right">期未借<br/>方餘額</td>
	    <td width="8%" align="right">期未貸<br/>方餘額</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="12%" align="center"><?php echo  $row->mba003;?></td>
		<td width="16%" align="center"><?php echo  $row->ma003;?></td>	
		<?php  if ($row->mba006==0) {$mba006='-';} else {$mba006=number_format($row->mba006, 2, '.' ,',');} ?>
		<?php  if ($row->mba007==0) {$mba007='-';} else {$mba007=number_format($row->mba007, 2, '.' ,',');} ?>
		<?php  if ($row->mba008==0) {$mba008='-';} else {$mba008=number_format($row->mba008, 2, '.' ,',');} ?>
		<?php  if ($row->mba009==0) {$mba009='-';} else {$mba009=number_format($row->mba009, 2, '.' ,',');} ?>
		<?php  if ($row->mba012==0) {$mba012='-';} else {$mba012=number_format($row->mba012, 2, '.' ,',');} ?>
		<?php  if ($row->mba013==0) {$mba013='-';} else {$mba013=number_format($row->mba013, 2, '.' ,',');} ?>
		<?php  if ($row->mba014==0) {$mba014='-';} else {$mba014=number_format($row->mba014, 2, '.' ,',');} ?>
		<?php  if ($row->mba015==0) {$mba015='-';} else {$mba015=number_format($row->mba015, 2, '.' ,',');} ?>
		<td width="8%" align="right"><?php echo  $mba006 ;?></td> 
		<td width="8%" align="right"><?php echo  $mba007;?></td> 
		<td width="8%" align="right"><?php echo  $mba008;?></td> 
		<td width="8%" align="right"><?php echo  $mba009;?></td> 
		<td width="8%" align="right"><?php echo  round($row->mba010);?></td> 
		<td width="8%" align="right"><?php echo  round($row->mba011);?></td> 
		<td width="8%" align="right"><?php echo  $mba014;?></td> 
		<td width="8%" align="right"><?php echo  $mba015;?></td> 
       		
        </tr>		
		 <?php $pagenum +=1;$prow=1;$pagenum1=$pagenum;$mba007k=$mba007k+$row->mba007; ?> 
	       <?php $vmba006=$vmba006+$row->mba006;$vmba007=$vmba007+$row->mba007;$vmba008=$vmba008+$row->mba008;$vmba009=$vmba009+$row->mba009; ?> 
		   <?php $vmba010=$vmba010+round($row->mba010);$vmba011=$vmba011+round($row->mba011);
		   $vmba012=$vmba012+$row->mba012;$vmba013=$vmba013+$row->mba013;$vmba014=$vmba014+$row->mba014;$vmba015=$vmba015+$row->mba015; ?>
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		  <tr> <?php echo $br ; ?><td align="left">　　　　　　　　　　　　　　　　　　　　　　　　　　　
	   　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　　";} else 
		  {echo "　　　　　　　　　　";} ?>		    
			　　　　　　　　　
			<?php if($mf001c=="1")  {echo "試  算  表(統制帳戶)";} else {echo "試  算  表(明細帳戶)";} ?>　　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $vdate; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	  <tr>
	    <td width="12%" align="center">科目編號</td>
	    <td width="16%" align="center">科目名稱</td>
		<td width="8%" align="right">期初借<br/>方餘額</td>
	    <td width="8%" align="right">期初貸<br/>方餘額</td>
		<td width="8%" align="right">本期借<br/>方金額</td>
	    <td width="8%" align="right">本期貸<br/>方金額</td>
		<td width="8%" align="right">借方筆數</td>
	    <td width="8%" align="right">貸方筆數</td>
		<td width="8%" align="right">期未借<br/>方餘額</td>
	    <td width="8%" align="right">期未貸<br/>方餘額</td>
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
	 <table class="list" >
			<tr>
			  <td width="28%" align="right"><b><?php echo '合  計:'; ?></b></td>
			  <td width="8%" align="right"><b><?php echo number_format($vmba006, 2, '.' ,','); ?></b></td>
			  <td width="8%" align="right"><b><?php echo number_format($vmba007, 2, '.' ,','); ?></b></td>
			  <td width="8%" align="right"><b><?php echo number_format($vmba008, 2, '.' ,','); ?></b></td>
			  <td width="8%" align="right"><b><?php echo number_format($vmba009, 2, '.' ,','); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmba010); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmba011); ?></b></td>
			  <td width="8%" align="right"><b><?php echo number_format($vmba014, 2, '.' ,','); ?></b></td>
			  <td width="8%" align="right"><b><?php echo number_format($vmba015, 2, '.' ,','); ?></b></td>
			</tr>
	 </table>