    <?php $numrow1 =1;  ?>
	<?php $vmb1004=0;$vmb1005=0;$vmb1006=0;$vmb1007=0;$vmb1009=0;$vmb1010=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=1;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=30;$tot=$paperal-3;} else { $paperal=30;$tot=$paperal-3;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php // if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php // } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <td align="left">　　　　　　　　　　　　　　　　　　　　　　　　　　　
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　　";} else 
		  {echo "　　　　　　　　　　";} ?>		    
			　　　　　　　　　
			日 計 表　　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>起迄日期:&nbsp;<?php echo $bdate.'至'.$edate; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">日期</td>
	    <td width="8%" align="center">科目代號</td>
		<td width="14%" align="center">科目名稱</td>
		<td width="8%" align="right">本幣借方金額</td>
	    <td width="8%" align="right">本幣貸方金額</td>
		<td width="8%" align="right">借方筆數</td>
	    <td width="8%" align="right">貸方筆數</td>
		<td width="8%" align="right">原幣借方金額</td>
	    <td width="8%" align="right">原幣貸方金額</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><?php echo $row->mb1002;?></td>
		<td width="8%" align="center"><?php echo $row->mb1001;?></td>	
		<td width="14%" align="center"><?php echo $row->mb1003;?></td>	
		<td width="8%" align="right"><?php echo round($row->mb1004);?></td> 
		<td width="8%" align="right"><?php echo round($row->mb1005);?></td> 
		<td width="8%" align="right"><?php echo round($row->mb1006);?></td> 
		<td width="8%" align="right"><?php echo round($row->mb1007);?></td> 
		<td width="8%" align="right"><?php echo round($row->mb1009);?></td> 
		<td width="8%" align="right"><?php echo round($row->mb1010);?></td>
       		
        </tr>		
		 <?php $pagenum +=1;$prow=1;$pagenum1=$pagenum; ?> 
	       <?php $vmb1004=$vmb1004+round($row->mb1004);$vmb1005=$vmb1005+round($row->mb1005);$vmb1006=$vmb1006+round($row->mb1006); ?> 
		   <?php $vmb1007=$vmb1007+round($row->mb1007);$vmb1009=$vmb1009+round($row->mb1009);$vmb1010=$vmb1010+round($row->mb1010); ?>
           
		   <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php  if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		 <!--   <div style="page-break-before: always;"></div>-->
		    
		<table class="store">   <!-- 跳頁用 -->
		   <br><br><br>
		  <tr> <?php echo "" ; ?><td align="left">　　　　　　　　　　　　　　　　　　　　　　　　　　　
	   　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　　　　　　";} else 
		  {echo "　　　　　　　　　　";} ?>		    
			　　　　　　　　　
			日 計 表　　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>起迄日期:&nbsp;<?php echo $bdate.'至'.$edate; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	   <tr>
	    <td width="8%" align="center">日期</td>
	    <td width="8%" align="center">科目代號</td>
		<td width="14%" align="center">科目名稱</td>
		<td width="8%" align="right">本幣借<br/>方金額</td>
	    <td width="8%" align="right">本幣貸<br/>方金額</td>
		<td width="8%" align="right">借方筆數</td>
	    <td width="8%" align="right">貸方筆數</td>
		<td width="8%" align="right">原幣借<br/>方金額</td>
	    <td width="8%" align="right">原幣貸<br/>方金額</td>
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
	 <table  class="list">
			<tr >
			  <td colspan="3" width="30%" align="right"><b><?php echo '合  計:'; ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmb1004); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmb1005); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmb1006); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmb1007); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmb1009); ?></b></td>
			  <td width="8%" align="right"><b><?php echo round($vmb1010); ?></b></td>
			</tr>
	 </table>