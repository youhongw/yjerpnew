<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri07/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=14; $vbb=$vaa-1;} else 
		  {$vaa=14; $vbb=$vaa-1;} ?>	  
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vamt=0;$vqty=0; 
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
	$pur_date = substr($value->tc024,0,4).'/'.substr($value->tc024,4,2).'/'.substr($value->tc024,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->			  
	
	<table class="store">    <!-- 跳頁用 -->
	  	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			採購單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">採購單別<br>採購單號</td>
	    <td width="8%" align="left">採購日期</td>
	    <td width="8%" align="left">廠商代號<br>廠商名稱</td>	   
	    <td width="8%" align="left">採購人員<br>人員名稱</td>
		<td width="8%" align="left"><b>品號</b></td>
		<td width="24%"  align="left" ><b>品名</b><br><b>規格</b></td>
		<td width="8%" align="left"><b>單位</b><br><b>已交數量</b></td>
		<td width="8%" align="right" ><b>採購數量</b></td>
		<td width="8%" align="right" ><b>採購單價</b></td>
		<td width="8%" align="right" ><b>採購金額</b></td>
      </tr>
	</table>
   
	<table class="list">     <!-- 列明細 -->
	      <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					  <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	   	<td width="8%" align="left"><?php echo  $val->tc001;?><br><?php echo  $val->tc002;?></td>
		<td width="8%" align="left"><?php echo  substr($val->tc024,0,4).'/'.substr($val->tc024,4,2).'/'.substr($val->tc024,6,2);?></td>
		<td width="8%" align="left"><?php echo  $val->tc004;?><br><?php echo  $val->tc004disp;?></td>	
		<td width="8%" align="left"><?php echo  $val->tc011;?><br><?php echo  $val->tc011disp;?></td>	
		<td width="8%" align="left"><?php echo  $val->td004;?></td>
        <td width="24%" align="left"><?php if ($val->td005!='') {  echo wordwrap($val->td005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($val->td006!='') {echo wordwrap($val->td006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="8%" align="left"><?php echo  $val->td009;?><br><?php echo  $val->td015;?></td>
		<td width="8%" align="right"><?php echo  $val->td008;?></td>
        <td width="8%" align="right"><?php echo  $val->td010;?></td>	
        <td width="8%" align="right"><?php echo  $val->td011;?></td>			
              </tr>
	     <?php $rownum++;$rownum1++;$vqty=$vqty+$val->td008;$vamt=$vamt+$val->td011; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>						  
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
        <?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>						 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>					 
					</tr>
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="10" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $vamt;} ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
	
