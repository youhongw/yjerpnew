<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/inv/invi05/printdetail';location = url; </script> 
  <?php } ?>

	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vqty=0;$vamt=0; 
$page = 1;//預設第一頁
$page_limit = 16;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%16==15){
		if(@$results[$page*16]){
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
	
	<table class="store">    <!-- 跳頁用 --> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	  <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　";} else {echo "　　　　　";} ?>
			　　　　　　　　　　　　促銷單明細表
			　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="6%" align="center">門市代號</td>
	    <td width="8%" align="center">促銷單號</td>
	    <td width="8%" align="left">單據日期</td>
        <td width="8%" align="left">開始日期</td>	
		<td width="6%" align="center">序號</td>
		<td width="12%" align="center">品號</td>
		<td width="30%" align="center">品名<br>規格</td>
		<td width="4%" align="center">單位</td>
		<td width="6%" align="right">原售價</td>
		<td width="6%" align="right">特價</td>
		<td width="6%" align="right">會員特價</td>	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	  <?php  $rownum=15;$rownum1=0;$rownum2=16;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	      	<td width="6%" align="center"><?php echo  $val->tc001;?></td>
		    <td width="8%" align="center"><?php echo  $val->tc002;?></td>
		    <td width="8%" align="left"><?php echo  substr($val->tc003,0,4).'/'.substr($val->tc003,4,2).'/'.substr($val->tc003,6,2);?></td>
            <td width="8%" align="left"><?php echo  $val->tc004;?></td>
			<td width="6%" align="left"><?php echo  $val->td003;?></td>
            <td width="12%" align="left"><?php echo  $val->td004;?></td>
           	 <td width="30%" align="left"><?php if ($val->td005!='') {  echo wordwrap($val->td005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($val->td006!='') {echo wordwrap($val->td006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
		    <td width="4%" align="left"><?php echo  $val->td007;?></td>
		    <td width="6%" align="right"><?php echo  $val->td008;?></td>
            <td width="6%" align="right"><?php echo  $val->td009;?></td>
            <td width="6%" align="right"><?php echo  $val->td010;?></td>			
         </tr>
	  <?php $rownum++;$rownum1++;$vamt=$vamt+$val->td010;$vqty=$vqty+$val->td009; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=16 ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>						  
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					
	                 	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=16 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>						 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=16 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>								 
					</tr>
					<?php } ?> <?php } ?>   
	            <!--    <tr>
					  <td colspan="11" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $vamt;} ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr> -->
	        </table>
		
	         <div style="page-break-before: always;"></div>
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php $page++; } ?> 
	