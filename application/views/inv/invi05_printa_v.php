<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/inv/invi05/printdetail';location = url; </script> 
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
	
	<table class="store">    <!-- 跳頁用 --> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	  <tr>
	      <td align="left">製表日期:<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "　　　　　";} else {echo "　　　　　";} ?>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			　　　　　　　　　　異動單明細表
			　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:<?php echo $page."/".$totle_page ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="6%" align="left">異動單別</td>
	    <td width="8%" align="left">異動單號</td>
	    <td width="8%" align="left">單據日期</td>
        <td width="8%" align="left">部門名稱</td>	
		<td width="6%" align="left">序號</td>
		<td width="12%" align="left">品號</td>
		<td width="30%" align="left">品名<br>規格</td>
		<td width="4%" align="left">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單位成本</td>
		<td width="6%" align="right">金額</td>	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	    <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	      	<td width="6%" align="left"><?php echo  $val->ta001;?></td>
		    <td width="8%" align="left"><?php echo  $val->ta002;?></td>
		    <td width="8%" align="left"><?php echo  substr($val->ta003,0,4).'/'.substr($val->ta003,4,2).'/'.substr($val->ta003,6,2);?></td>
		 
            <td width="8%" align="left"><?php echo  $val->ta004disp;?></td>
			<td width="6%" align="left"><?php echo  $val->tb003;?></td>
			
            <td width="12%" align="left"><?php echo  $val->tb004;?></td>
			 <td width="30%" align="left"><?php if ($val->tb005!='') {  echo wordwrap($val->tb005,75,"<br />\n",TRUE);} else {echo "_";}?> 
		      <br><?php  if ($val->tb006!='') {echo wordwrap($val->tb006,75,"<br />\n",TRUE);}  else {echo "_";} ?></td>
		    <td width="4%" align="left"><?php echo  $val->tb008;?></td>
		    <td width="6%" align="right"><?php echo  $val->tb009;?></td>
            <td width="6%" align="right"><?php echo  $val->tb010;?></td>
            <td width="6%" align="right"><?php echo  $val->tb011;?></td>			
         </tr>
	  <?php $rownum++;$rownum1++;$vamt=$vamt+$val->tb011;$vqty=$vqty+$val->tb009; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa) ) { ?>
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
					  <td align="right"><b>&nbsp;</b></td>
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
					  <td align="right"><b>&nbsp;</b></td>
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
		<!--  <br/>   -->
		 <!--  <br/>   -->
		 <?php $page++; } ?> 
	