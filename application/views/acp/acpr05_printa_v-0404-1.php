    <?php $numrow1 =1;$ta028b=0;$ta030a=0;$ta031a=0;$ta009=1;  ?>
	
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=30;$tot=$paperal-3;} else { $paperal=32;$tot=$paperal-3;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	  <!-- <tr><td align="center"><?php echo $br ; ?><?php echo $this->session->userdata('sysml003'); ?></td></tr> -->
	   
	   <tr> <?php echo $br ; ?><td align="left">帳款期間:&nbsp;<?php echo $dateo.' 至 '.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			應付帳款明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	  <table class="footer">   <!-- 底線 -->
		<tr><td></td></tr>	
	  </table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">廠商代號<br>廠商名稱</td>
		<td width="8%" align="center">日期<br>應付憑單</td>
		<td width="8%" align="center">發票號碼<br>幣別</td>
	    <td width="8%" align="center">應付帳號<br>未付帳款</td>
	    <td width="8%" align="left">憑證號碼<br>憑證日期</td>
	    <td width="8%" align="right">原幣未稅<br>原幣稅額</td>
		<td width="8%" align="right">本幣未稅<br>本幣稅額</td>
		<td width="8%" align="right">備註</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="8%" align="center"><? echo $row->ta004;?><br><? echo $row->ta004disp;?></td>
		<td width="8%" align="center"><? echo $row->ta003;?><br><? echo $row->ta001.'-'.$row->ta002;?></td>
		<td width="8%" align="center"><? echo $row->ta014;?><br><? echo $row->ta008.' '.$row->ta008disp;?></td>
		<td width="8%" align="center"><? echo $row->ta028a;?><br><? echo $row->ta030a;?></td>		
		<td width="8%" align="left"><? if ($row->th005!='') {  echo wordwrap($row->th005,75,"<br />\n",TRUE);} else {echo "_";}?><br>
		<?  if ($row->th006!='') {echo wordwrap($row->th006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
		<td width="8%" align="right"><? echo $row->tb005.'-'.$row->tb006.'-'.$row->tb007;?><br><? echo $row->tb008;?></td>
		<td width="8%" align="right"><? echo $row->tb015;?><br><? echo $row->tb016;?></td>	
        <td width="8%" align="right"><? echo $row->tb017;?><br><? echo $row->tb018;?></td>		
        <td width="8%" align="right"><? echo $row->tb011;?></td> 
       		
        </tr>		
		 <?php $pagenum +=2;$prow=1;$pagenum1=$pagenum;$ta028b=$ta028b+$row->ta028a;$ta030a=$ta030a+$row->ta030;$ta031a=$ta031a+$ta028b-$ta030a;$ta009=$row->ta009; ?> 
	      
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->		   
		 <br><tr> <td align="left">帳款期間:&nbsp;<?php echo $dateo1.' 至 '.$datec1; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			應付帳款明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	  <table class="footer">   <!-- 底線 -->
		<tr><td></td></tr>	
	  </table>
	
		
	 <table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">廠商代號<br>廠商名稱</td>
		<td width="8%" align="center">日期<br>應付憑單</td>
		<td width="8%" align="center">發票號碼<br>幣別</td>
	    <td width="8%" align="center">應付帳號<br>未付帳款</td>
	    <td width="8%" align="left">憑證號碼<br>憑證日期</td>
	    <td width="8%" align="right">原幣未稅<br>原幣稅額</td>
		<td width="8%" align="right">本幣未稅<br>本幣稅額</td>
		<td width="8%" align="right">備註</td>
      </tr>
	</table>
	
    
			<?php  $pagenum=4;  ?>	   
		   
	<table class="list">
	<!--     <?php if($pagenum1==33 ) { $pagenum2=1;} ?>  <!-- 29,31,1 ok -->
	     <?php if($pagenum1==34 ) { $pagenum3=1;} ?>  <!-- 29,31,1 ok -->
		<?php  if($pagenum1==33 and $pagenum1==34 ) { $pagenum4=1;} ?>  <!-- 29,31,1 ok -->
	     <?php   } ?>  
	  <?php endforeach;?>
	</table>
    </table>
	 <table >
			<tr>
			  <td width="300" align="left"><b>原幣本期應付：<?php echo round($ta028b) ?></b></td>
			  <td width="300" align="left"><b>本期已付：<?php echo round($ta030a) ?></b></td>
			  <td width="300" align="left"><b>合計應付：<?php echo round($ta031a) ?></b></td>
			</tr>
			<tr>
			  <td width="300" align="left"><b>本幣本期應付：<?php echo round($ta028b*$ta009) ?></b></td>
			  <td width="300" align="left"><b>本期已付：<?php echo round($ta030a*$ta009) ?></b></td>
			  <td width="300" align="left"><b>合計應付：<?php echo round($ta031a*$ta009) ?></b></td>
			</tr>
	 </table>