  <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/cope05/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=14; $vbb=$vaa-1;} else 
		  {$vaa=24; $vbb=$vaa-1;} ?>
  
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vamt=0;$vqty=0;$vnoqty=0; 
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
	$pur_date ='';
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->			  
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="left">銷貨期間:&nbsp;<?php echo $dateo.' 至 '.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　　　　　　　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			客戶銷售成本表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">客戶代號<br>客戶名稱</td>
	    <td width="10%" align="left">品  號</td>
	    <td width="30%" align="left">品  名<br>規  格</td>
		<td width="10%" align="left">單位</td>
	    <td width="10%" align="right">銷貨數量</td>
	    <td width="10%" align="right">銷貨金額</td>
		<td width="10%" align="right">銷貨成本</td>
		<td width="10%" align="right">銷貨毛利<br>毛利率</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	   <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="10%" align="center"><?php echo  $val->tg004;?><br><?php echo  $val->tg004disp;?></td>
		<td width="10%" align="center"><?php echo  $val->th004;?></td>		
		<td width="30%" align="left"><?php if ($val->th005!='') {  echo wordwrap($val->th005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		  <br><?php  if ($val->th006!='') {echo wordwrap($val->th006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
		<td width="10%" align="right"><?php echo  $val->th009;?></td>	
        <td width="10%" align="right"><?php echo  round($val->th008);?></td>		
        <td width="10%" align="right"><?php echo  round($val->th013);?></td> 
		<? if (round($val->th013)==0) {$th013=1;} else {$th013=round($val->th013);} ?>
		<? if (round($val->th013a)==0) {$th013a=1;} else {$th013a=round($val->th013a);} ?>
		<? if (round($val->th013b)==0) {$th013b=1;} else {$th013b=round($val->th013b);} ?>
		<td width="10%" align="right"><?php echo  round($val->th013a);?></td> 
		<td width="10%" align="right"><?php echo  round($val->th013b);?><br><?php echo  round(($th013b)/round($th013)*100,2).'%';?></td> 
       		
        </tr>		
			      
          <?php $rownum++;$rownum1++;$vqty=$vqty+$val->th013;$vnoqty=$vnoqty+$val->th013a;$vamt=$vamt+$val->th013b; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					   <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					   <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					<td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					   <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					</tr>
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="8" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>銷貨金額：</b> <?php if ($tprint=='Y') { echo round($vqty);} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>銷貨成本：</b> <?php if ($tprint=='Y') { echo round($vnoqty);} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>銷貨毛利：</b> <?php if ($tprint=='Y') { echo round(($vnoqty)/round($vqty)*100,2).'%'; } ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>銷貨金額：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>銷貨成本：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>銷貨毛利：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 	
