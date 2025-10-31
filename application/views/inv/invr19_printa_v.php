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
	   <tr> <?php echo $br ; ?><td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			進銷存明細表&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>起迄品號:&nbsp;<?php echo $invq02a.' 至 '.$invq02a1; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="center">庫別代號<br>庫別名稱</td>
	    <td width="10%" align="center">品  號</td>
	    <td width="30%" align="left">品  名<br>規  格</td>
		<td width="10%" align="right">單位<br>庫存年月</td>
	    <td width="10%" align="right">月初數量</td>
		<td width="10%" align="right">入庫數量<br>出庫數量</td>
		<td width="10%" align="right">銷貨數量<br>出庫數量</td>
		<td width="10%" align="right">本月庫存數量</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="10%" align="center"><?php echo  $row->lc003;?><br><?php echo  $row->lc003disp;?></td>
		<td width="10%" align="center"><?php echo  $row->lc001;?></td>		
		<td width="30%" align="left"><? if ($row->mb002!='') {  echo wordwrap($row->mb002,75,"<br />\n",TRUE);} else {echo "_";}?> 
		  <br><?  if ($row->mb003!='') {echo wordwrap($row->mb003,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
		<td width="10%" align="right"><?php echo  $row->mb004;?><br><?php echo  $row->lc002;?></td>
		<td width="10%" align="right"><?php echo  round($row->lc004);?></td> 
       	<td width="10%" align="right"><?php echo  round($row->lc006);?><br><?php echo  round($row->lc016);?></td> 
        <td width="10%" align="right"><?php echo  round($row->lc008);?><br><?php echo  round($row->lc018);?></td>
        <td width="10%" align="right"><?php echo  round($row->qty);?></td>		
        </tr>		
		 <?php $pagenum +=2;$prow=1;$pagenum1=$pagenum;$mc007k=$mc007k+$row->mc007; ?> 
	      
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
			進銷存明細表&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?>
			<br>起迄品號:&nbsp;<?php echo $invq02a.' 至 '.$invq02a1; ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	    <tr>
	    <td width="10%" align="center">庫別代號<br>庫別名稱</td>
	    <td width="10%" align="center">品  號</td>
	    <td width="40%" align="left">品  名<br>規  格</td>
		<td width="10%" align="right">單位</td>
	    <td width="10%" align="right">庫存數量</td>
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
			  <td width="900" align="right"><b>銷貨金額：<?php echo $mc007k ?></b></td>
			</tr>
	 </table>