    <?php php $numrow1 =1; $numrow2 =1;$th013a=0;$tg044a=0;  ?>
	<?php php   $ta004key ='';$vfirst=0;  ?>   
	<?php  php foreach($results as $row ) : ?>
	     
	      <?php  $ta004kv=$row->ta004.' '.$row->ta004disp;?>
	      <?php  $ta004k=$row->ta004.' '.$row->ta004disp;?>
		  <?php  $tb021k=$row->tb021.' '.$row->tb021disp;?>
		  <?php  $ma027k=$row->ma027;?>
		  <?php  $ma006k=$row->ma006;?>
		  <?php  $ma008k=$row->ma008;?>
      <?php php $numrow1 +=2;$numrow2 +=1;  ?> 
	  <?php php endforeach;  ?>  
	  <!-- 表頭3行   -->
       <?php php $numrow1 +=4;  ?> 
	<?php php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php php if($paper9=="1")  { $paperal=30;$tot=$paperal-0;} else { $paperal=32;$tot=$paperal-0;}  ?>
	<?php php if($numrow1>=$paperal) { $pagetot = ceil($numrow1/$paperal); } else {$pagetot=1; } ?>  
	<?php php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php php } ?>
	  <?php php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	  <!-- <tr><td align="center"><?php php echo $br ; ?><?php php echo $this->session->userdata('sysml003'); ?></td></tr> -->
	   
	   <br><tr> <td align="left">帳款期間:&nbsp;<?php php echo $dateo1.' 至 '.$datec1; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php php echo date("Y/m/d")?><?php php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			客 戶 對 帳 單&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	  <table class="footer">   <!-- 底線 -->
		<tr><td></td></tr>	
	  </table>
	<table >    <!-- 列表頭 -->
	<!--  <tr>
	    <td width="8%" align="left">客戶代號: <?php php echo $ta004k; ?></td>
		<td width="3%" align="left">　部門: <?php php echo $tb021k ?></td>
      </tr>
	   <tr>
	    <td width="8%" align="left">客戶電話: <?php php echo $ma006k ?></td>
		<td width="3%" align="left">　客戶傳真: <?php php echo $ma008k ?></td>
      </tr>
	   <tr>
	    <td width="8%" align="left">送貨地址: <?php php echo $ma027k ?></td>
      </tr> -->
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">發票號碼</td>
		<td width="8%" align="center">來源</td>
		<td width="8%" align="center">日期</td>
	    <td width="8%" align="center">單據號碼</td>
	    <td width="44%" align="left">品  名<br>規  格</td>
	    <td width="8%" align="right">數量</td>
		<td width="8%" align="right">單價</td>
		<td width="8%" align="right">金額</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31  客戶key-->
	       
	   <?php php foreach($results as $row ) : ?>
	      <tr>
		   <!-- 檢查跳頁 -->
	      <?php php if($row->ta004 != $ta004key and $vfirst == 1 ) {?>  
               <table >
			<tr>
			  <td width="300" align="left"><b>本期應收：<?php php echo round($th013a) ?></b></td>
			  <td width="300" align="left"><b>本期稅額：<?php php echo round($th013a*$tg044a) ?></b></td>
			  <td width="300" align="left"><b>合計應收：<?php php echo round($th013a+($th013a*$tg044a)) ?></b></td>
			</tr>
			<?php php $th013a=0;$tg044a=0; ?>
	 </table>         
		 
		     <P STYLE="page-break-after:always; text-align:left"> </p>
			  
		    
		<table class="store">   <!-- 跳頁用 -->		   
		 <br><tr> <td align="left">帳款期間:&nbsp;<?php php echo $dateo1.' 至 '.$datec1; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php php echo date("Y/m/d")?><?php php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			客 戶 對 帳 單&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	  <table class="footer">   <!-- 底線 -->
		<tr><td></td></tr>	
	  </table>
	<table >    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">客戶代號: <?php php echo $row->ta004.$row->ta004disp; ?></td>
		<td width="3%" align="left">　部門: <?php php echo $tb021k ?></td>
      </tr>
	   <tr>
	    <td width="8%" align="left">客戶電話: <?php php echo $ma006k ?></td>
		<td width="3%" align="left">　客戶傳真: <?php php echo $ma008k ?></td>
      </tr>
	   <tr>
	    <td width="8%" align="left">送貨地址: <?php php echo $ma027k ?></td>
      </tr>
	</table>
		
	 <table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">發票號碼</td>
		<td width="8%" align="center">來源</td>
		<td width="8%" align="center">日期</td>
	    <td width="8%" align="center">單據號碼</td>
	    <td width="44%" align="left">品  名<br>規  格</td>
	    <td width="8%" align="right">數量</td>
		<td width="8%" align="right">單價</td>
		<td width="8%" align="right">金額</td>
      </tr>
	</table>
	
    <table class="list">
		
		  
		  <?php php  $pagenum=4; } ?>  <!-- 頁頭到此 -->
		  
	    <td width="8%" align="center"><?php php echo $row->ta015.$row->ta004;?></td>
		<?php  if ($row->tb004=='1') {$tb004v='1:銷貨';} else if ($row->tb004=='2') {$tb004v='2:銷退';} else {$tb004v='9:其他';} ?>
		<td width="8%" align="center"><?php php echo $tb004v;?></td>
		<td width="8%" align="center"><?php php echo $row->tg003;?></td>
		<td width="8%" align="center"><?php php echo $row->tg002;?></td>		
		<td width="44%" align="left"><?php  if ($row->th005!='') {  echo wordwrap($row->th005,75,"<br />\n",TRUE);} else {echo "_";}?><br>
		<?php   if ($row->th006!='') {echo wordwrap($row->th006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
		<td width="8%" align="right"><?php php echo $row->th008;?></td>	
        <td width="8%" align="right"><?php php echo $row->th012;?></td>		
        <td width="8%" align="right"><?php php echo $row->th013;?></td> 
       		
        </tr>		
		 <?php php $pagenum +=2;$prow=1;$pagenum1=$pagenum;$th013a=$th013a+$row->th013;$tg044a=$row->tg044; ?> 
		 
		 
		  
           <?php php if($pagenum>=$paperal) {?> <tr></tr><?php php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php php } ?>
			
		    
		<table class="store">   <!-- 跳頁用 -->		   
		 <br><tr> <td align="left">帳款期間:&nbsp;<?php php echo $dateo1.' 至 '.$datec1; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php php echo date("Y/m/d")?><?php php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			客 戶 對 帳 單&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	  <table class="footer">   <!-- 底線 -->
		<tr><td></td></tr>	
	  </table>
	<table >    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">客戶代號: <?php php echo $row->ta004.$row->ta004disp; ?></td>
		<td width="3%" align="left">　部門: <?php php echo $tb021k ?></td>
      </tr>
	   <tr>
	    <td width="8%" align="left">客戶電話: <?php php echo $ma006k ?></td>
		<td width="3%" align="left">　客戶傳真: <?php php echo $ma008k ?></td>
      </tr>
	   <tr>
	    <td width="8%" align="left">送貨地址: <?php php echo $ma027k ?></td>
      </tr>
	</table>
		
	 <table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">發票號碼</td>
		<td width="8%" align="center">來源</td>
		<td width="8%" align="center">日期</td>
	    <td width="8%" align="center">單據號碼</td>
	    <td width="44%" align="left">品  名<br>規  格</td>
	    <td width="8%" align="right">數量</td>
		<td width="8%" align="right">單價</td>
		<td width="8%" align="right">金額</td>
      </tr>
	</table>
	
    
			<?php php  $pagenum=4;  ?>	   
		    
	<table class="list">
	<!--     <?php php if($pagenum1==33 ) { $pagenum2=1;} ?>  <!-- 29,31,1 ok -->
	     <?php php if($pagenum1==34 ) { $pagenum3=1;} ?>  <!-- 29,31,1 ok -->
		<?php php  if($pagenum1==33 and $pagenum1==34 ) { $pagenum4=1;} ?>  <!-- 29,31,1 ok -->
	     <?php php   } ?>  
		 
		   <?php php   $ta004key =$row->ta004;$vfirst=1;  ?>  
		  
	  <?php php endforeach;?>
	</table>
    </table>
	 <table >
			<tr>
			  <td width="300" align="left"><b>本期應收：<?php php echo round($th013a) ?></b></td>
			  <td width="300" align="left"><b>本期稅額：<?php php echo round($th013a*$tg044a) ?></b></td>
			  <td width="300" align="left"><b>合計應收：<?php php echo round($th013a+($th013a*$tg044a)) ?></b></td>
			</tr>
	 </table>