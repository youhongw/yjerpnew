    <?php $numrow1 =1;$mv013k=0;$mv013ak=0;$mv013bk=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=1;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=47;$tot=$paperal;} else { $paperal=49;$tot=$paperal;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <?php echo $br ; ?><td align="left">起迄離職日期:&nbsp;<?php echo $dateo.'至'.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			離職人員明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">部門代號</td>
		<td width="10%" align="left">部門名稱</td>
	    <td width="10%" align="left">員工代號</td>
	    <td width="10%" align="left">員工姓名</td>
	    <td width="10%" align="left">到職日期</td>
	    <td width="10%" align="left">離職日期</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	    <?php $i=1; ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
		 <td width="10%" align="left"><?php echo $row->mv004;?></td>
	     <td width="10%" align="left"><?php echo $row->mv004disp;?></td>
	     <td width="10%" align="left"><?php echo $row->mv001;?></td>
		 <td width="10%" align="left"><?php echo $row->mv002;?></td>
		 <td width="10%" align="left"><?php echo substr($row->mv021,0,4)."/".substr($row->mv021,4,2)."/".substr($row->mv021,6,2); ?></td>
		 <td width="10%" align="left"><?php echo substr($row->mv022,0,4)."/".substr($row->mv022,4,2)."/".substr($row->mv022,6,2);?></td>
		
       		
        </tr>		
		 <?php $pagenum +=1;$prow=1;$i++;$pagenum1=$pagenum;$mv013k=$mv013k;$mv013ak=$mv013ak;$mv013bk=$mv013bk; ?> 
	      
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"> <?php echo $br ; ?><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr> <?php echo $br ; ?><td align="left">起迄離職日期:&nbsp;<?php echo $dateo.'至'.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			新進人員明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">部門代號</td>
		<td width="10%" align="left">部門名稱</td>
	    <td width="10%" align="left">員工代號</td>
	    <td width="10%" align="left">員工姓名</td>
	    <td width="10%" align="left">到職日期</td>
	    <td width="10%" align="left">離職日期</td>
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
	<tr><td colspan="6"><span style="float:right;">共離職: <?php echo $num_results; ?> 人</span></td></tr>
    </table>
	<!-- <table >
			<tr>
	  	  <td width="300" align="left"><b>合計銷貨數量：<?php echo round($mv013k) ?></b></td>			
			</tr>
	 </table> -->