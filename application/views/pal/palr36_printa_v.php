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
	   <tr> <?php echo $br ; ?><td align="left">發薪年月:&nbsp;<?php echo $dateo; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp; 　　　　　　　　　　　　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp; 　　　　　　　　　　&nbsp;
			特休未休轉薪資月報表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="13%" align="left">部門代號</td>
	    <td width="13%" align="left">部門名稱</td>
		<td width="13%" align="left">員工代號</td>
	    <td width="13%" align="left">員工姓名</td>
	    <td width="12%" align="right">離職日期</td>
	    <td width="12%" align="right">日全薪</td>
		<td width="12%" align="right">特休未休天數</td>
	    <td width="12%" align="right">應發未休金額</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	    <?php $i=1;$vtd040=0;$vtd041=0; ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
		 <td width="13%" align="left"><?php echo  $row->mv004;?></td>
	     <td width="13%" align="left"><?php echo  $row->me002;?></td>
		 <td width="13%" align="left"><?php echo  $row->mv001;?></td>
	     <td width="13%" align="left"><?php echo  $row->mv002;?></td>
	  
		 <td width="12%" align="right"><?php echo  $row->mv022;?></td>
		 <td width="12%" align="right"><?php echo  $row->dayamt;?></td>
		 <td width="12%" align="right"><?php echo  $row->vmv305;?></td>
		 <td width="12%" align="right"><?php echo  round($row->dayamt*$row->vmv305);?></td>
		
       		
        </tr>		
		 <?php $pagenum +=1;$prow=1;$i++;$pagenum1=$pagenum;$vtd040=$vtd040+round($row->dayamt*$row->vmv305);$mv013bk=$mv013bk; ?> 
	      
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"> <?php echo $br ; ?><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr> <?php echo $br ; ?><td align="left">發薪年月:&nbsp;<?php echo $dateo; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp; 　　　　　　　　　　　　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp; 　　　　　　　　　　&nbsp;
			特休未休轉薪資月報表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
	  <tr>
	    <td width="13%" align="left">部門代號</td>
	    <td width="13%" align="left">部門名稱</td>
		<td width="13%" align="left">員工代號</td>
	    <td width="13%" align="left">員工姓名</td>
	    <td width="12%" align="right">離職日期</td>
	    <td width="12%" align="right">日全薪</td>
		<td width="12%" align="right">特休未休天數</td>
	    <td width="12%" align="right">應發未休金額</td>
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
	  	  <td width="1100" align="right"><b>合計轉帳金額：<?php echo number_format($vtd040, 0, '.' ,','); ?></b></td>
          <td width="300" align="right"><b>合計支領現金：<?php echo number_format($vtd041, 0, '.' ,','); ?></b></td>			  
			</tr>
	 </table> -->