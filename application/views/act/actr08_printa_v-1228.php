    <?php $numrow1 =1;$mbc007k=0;$th013ak=0;$th013bk=0;  ?>
	<?php $mvtb071=0;$mvtb072=0;  ?>
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
	   <tr> <?php echo $br ; ?><td align="left">　　　　　　　　　　　　　　　　　
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　";} else 
		  {echo "　　　　　　　　　";} ?>		    
						總 分 類 帳　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $bdate.'-'.$edate; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="center">科目編號</td>
	    <td width="14%" align="center">科目名稱</td>
		<td width="8%" align="right">傳票日期</td>
	    <td width="15%" align="center">傳票號碼</td>
	    <td width="17%" align="center">摘   要</td>
		<td width="8%" align="right">借方金額</td>
		<td width="8%" align="right">貸方金額</td>
		<td width="8%" align="right">餘    額</td>
		<td width="8%" align="right">借/貸餘</td>
		
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	   <?php $vmba017=0;$vvtb071=0;$vvtb072=0;$mvtb071=0;$mvtb072=0;$kvtb004=0; $vvtb004=0;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
		  <?php  $mvtb004=$row->tb004 ?>
		
		<?php  if ($row->tb004==1) {$vtb071=$row->tb0071;$vtb072=0;} else {$vtb072=$row->tb0072;$vtb071=0;} ?>
		
		
		<?php  if ($vvtb004==$mvtb004 ) {$vmba017=$vmba017+$row->mba017;} else {$vmba017=$vmba017-$row->mba017;} ?>
		<!-- 判斷第一筆  -->
		<?php  if ( $kvtb004==0)  {$vmba017=$row->mba017;} ?>
		
		<?php  if ($vmba017>=0) {$vtb004='借餘';} ?>
		<?php  if ($vmba017<0) {$vtb004='貸餘';} ?>
		<?php $vvtb071=$vvtb071+$vtb071; ?>
		<?php $vvtb072=$vvtb072+$vtb072; ?>
		
		<?php  if ($vtb071==0) {$vtb071='-';} else {$vtb071=number_format($vtb071, 2, '.' ,',');} ?>
		<?php  if ($vtb072==0) {$vtb072='-';} else {$vtb072=number_format($vtb072, 2, '.' ,',');} ?> 
		<?php  if ($vmba017==0) {$pvmba017='-';} else {$pvmba017=number_format($vmba017, 2, '.' ,',');} ?> 
	
		
	    <td width="10%" align="center"><?php echo $row->tb005;?></td>
		<td width="14%" align="center"><?php echo $row->tb005disp;?></td>	
		<td width="8%" align="left"><?php echo $row->ta003;?></td> 
		<td width="15%"  align="left"><?php echo $row->tb001.'-'.$row->tb002.'-'.$row->tb003;?></td> 
		<td width="17%" align="left"><?php echo $row->tb010;?></td> 
		<td width="8%" align="right"><?php echo $vtb071;?></td> 
		<td width="8%" align="right"><?php echo $vtb072;?></td> 
		<td width="8%" align="right"><?php echo $vmba017;?></td> 
		<td width="8%" align="center"><?php echo $vtb004;?></td>
       		
        </tr>	
          <?php $vvtb004=$row->tb004;$kvtb004=99; ?>		
		 <?php $pagenum +=2;$prow=1;$pagenum1=$pagenum; ?> 
	       <?php $mvtb071=$mvtb071+round($row->tb0071);$mvtb072=$mvtb072+round($row->tb0072); ?> 		  
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
						總 分 類 帳　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>年月:&nbsp;<?php echo $bdate.'-'.$edate; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	    <tr>
	    <td width="10%" align="center">科目編號</td>
	    <td width="16%" align="center">科目名稱</td>
		<td width="8%" align="right">傳票日期</td>
	    <td width="10%" align="center">傳票號碼</td>
	    <td width="20%" align="center">摘   要</td>
		<td width="8%" align="right">借方金額</td>
		<td width="8%" align="right">貸方金額</td>
		<td width="8%" align="right">餘    額</td>
		<td width="8%" align="right">借/貸餘</td>
		
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
			  <td width="300" align="right"><b><?php echo '合計借方金額:'; ?></b></td>
			  <td width="150" align="right"><b><?php echo round($vvtb071); ?></b></td>
			  <td width="300" align="right"><b><?php echo '合計貸方金額:'; ?></b></td>
			  <td width="150" align="right"><b><?php echo round($vvtb072); ?></b></td>
			 
			</tr>
	 </table>  