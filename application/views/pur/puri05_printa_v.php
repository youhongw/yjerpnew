	<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri05/printdetail';location = url; </script> 
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
	$pur_date = substr($value->ta003,0,4).'/'.substr($value->ta003,4,2).'/'.substr($value->ta003,6,2);
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
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請購單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">請購單別<br>請購單號</td>	  
	    <td width="10%" align="left">請購日期<br>採購人員</td>	 
	    <td width="10%" align="left">請購部門<br>部門名稱</td>
		<td width="6%" align="left">序號</td>
		<td width="10%" align="left"><b>品號</b></td>
		<td width="30%" align="left"><b>品名</b><br><b>規格</b></td>
		<td width="6%" align="left"><b>單位</b></td>
		<td width="6%" align="right" ><b>數量</b></td>
		<td width="6%" align="right" ><b>單價</b></td>
		<td width="6%" align="right" ><b>金額</b></td>
          </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	       <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="10%" align="left"><?php echo  $val->ta001;?><br><?php echo  $val->ta002;?></td>
		<td width="10%" align="left"><?php echo  substr($val->ta003,0,4).'/'.substr($val->ta003,4,2).'/'.substr($val->ta003,6,2);?><br><?php echo  $val->ta012;?></td>
		<td width="10%" align="left"><?php echo  $val->ta004;?><br><?php echo  $val->ta004disp;?></td>		
	
		 <td width="6%" align="left"><?php echo  $val->tb003;?></td>		
        <td width="10%" align="left"><?php echo  $val->tb004;?></td>
		<td width="30%" align="left"><?php if ($val->tb005!='') {  echo wordwrap($val->tb005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($val->tb006!='') {echo wordwrap($val->tb006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="6%" align="left"><?php echo  $val->tb007;?></td>	
        <td width="6%" align="right"><?php echo  round($val->tb009);?></td>	
        <td width="6%" align="right"><?php echo  round($val->tb017);?></td>	
        <td width="6%" align="right"><?php echo  round($val->tb018);?></td>	
              </tr>
	   <?php $rownum++;$rownum1++;$vqty=$vqty+round($val->tb009);$vamt=$vamt+round($val->tb018); ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
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
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>								 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
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
	
