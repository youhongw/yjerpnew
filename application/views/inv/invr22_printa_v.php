  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/inv/invr22/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=14; $vbb=$vaa-1;} else 
		  {$vaa=14; $vbb=$vaa-1;} ?>	  
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vqty=0;$vamt=0; 
$page = 1;//預設第一頁
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	}
	$pur_date = '';
}
$totle_page = $page;

?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->	
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   　　　　　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 　　進耗存統計表&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　　
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?>
			<br>起迄品號:&nbsp;<?php echo $invq02a.' 至 '.$invq02a1; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			　　　　　　　　　　　　　　　　　　　　&nbsp;庫存年月:&nbsp;<?php echo $vdate ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="9%" align="center">庫別代號<br>庫別名稱</td>
	    <td width="9%" align="center">品  號<br>單位</td>
	    <td width="19%" align="left">品  名<br>規  格</td>
	    <td width="9%" align="right">期初數量<br>進貨數量</td>
		<td width="9%" align="right">銷貨數量<br>領料數量</td>
		<td width="9%" align="right">轉入數量<br>調整數量</td>
		<td width="9%" align="right">出庫數量<br>銷退數量</td>
		<td width="9%" align="right">入庫數量<br>退貨數量</td>
		<td width="9%" align="right">組拆入量<br>組拆出量</td>
		<td width="9%" align="right">期未數量</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="9%" align="center"><?php echo  $val->lc003;?><br><?php echo  $val->lc003disp;?></td>
		<td width="9%" align="center"><?php echo  $val->lc001;?><br><?php echo  $val->lc043;?></td>
		<td width="19%" align="left"><?php echo  addslashes($val->lc001disp);?><br><?php echo  addslashes($val->lc001disp1);?></td>
		<td width="9%" align="center"><?php echo  $val->lc004;?><br><?php echo  $val->lc006;?></td>
		<td width="9%" align="center"><?php echo  $val->lc012;?><br><?php echo  $val->lc010+$val->lc020;?></td>
		<td width="9%" align="center"><?php echo  $val->lc016;?><br><?php echo  $val->lc014+$val->lc024;?></td>
		<td width="9%" align="center"><?php echo  $val->lc018;?><br><?php echo  $val->lc022;?></td>
		<td width="9%" align="center"><?php echo  $val->lc031;?><br><?php echo  $val->lc033;?></td>
		<td width="9%" align="center"><?php echo  $val->lc035;?><br><?php echo  $val->lc037;?></td>
		<td width="9%" align="right"><?php echo  round($val->lc041);?></td> 
       		
        </tr>		
		<?php $rownum++;$rownum1++;$vqty=$vqty+$val->lc041; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					
	                 	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>		 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>						 
					</tr>
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="10" align="right">
						<?php if ($totle_page == $page  ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>
						   <?php echo ' ';} ?> 
						
						<?php if ($totle_page > $page ) { ?>
						   <b>合計數量：</b> <?php if ($tprint=='Y') { echo '';} ?>
						
						  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php $page++; } ?> 
	