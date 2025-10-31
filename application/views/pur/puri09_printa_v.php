<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri09/printdetail';location = url; </script> 
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
	$pur_date = substr($value->tg003,0,4).'/'.substr($value->tg003,4,2).'/'.substr($value->tg003,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->			  
	
	<table class="store">    <!-- 跳頁用 a4橫式-->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			進貨單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">進貨單號</td>
	    <td width="8%" align="left">進貨日期</td>
	    <td width="8%" align="left">供應廠商</td>
		<td width="8%" align="left">序號</td>
		<td width="10%" align="left">品號</td>
		<td width="28%" align="left">品名<br>規格</td>
		<td width="6%" align="left">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單價</td>
		<td width="6%" align="right">金額</td>
	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	     <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		  <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="8%" align="center"><?php echo  $val->tg001;?></td>
		<td width="8%" align="center"><?php echo  $val->tg002;?></td>
		<td width="8%" align="left"><?php echo  substr($val->tg003,0,4).'/'.substr($val->tg003,4,2).'/'.substr($val->tg003,6,2);?></td>
		<td width="8%" align="left"><?php echo  $val->tg005;?></td>	
        <td width="8%" align="left"><?php echo  $val->th003;?></td>		
        <td width="10%" align="left"><?php echo  $val->th004;?></td>	
       
        <td width="28%" align="left"><?php if ($val->th005!='') {  echo wordwrap($val->th005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($val->th006!='') {echo wordwrap($val->th006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
        <td width="6%" align="left"><?php echo  $val->th008;?></td>	
        <td width="6%" align="right"><?php echo  $val->th007;?></td>	
        <td width="6%" align="right"><?php echo  $val->th018;?></td>	
        <td width="6%" align="right"><?php echo  $val->th045;?></td>	
       		
              </tr>
	  <?php $rownum++;$rownum1++;$vqty=$vqty+$val->th007;$vamt=$vamt+$val->th045; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
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
				 <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>								 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
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
					  <td colspan="11" align="left">
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
	

