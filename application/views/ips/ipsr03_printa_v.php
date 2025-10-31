 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/ips/ipsr03/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=43; $vbb=$vaa-1;} else 
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
	// $pur_date = substr($value->ma003,0,4).'/'.substr($value->ma003,4,2).'/'.substr($value->ma003,6,2);
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
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;";} ?>		    
		     　　　　　　　　　
			預付購料採購狀況表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>

	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">廠商代號<br>開狀日期</td>
	    <td width="10%" align="left">預付購料單<br>廠別代號</td>
	    <td width="10%" align="left">廠別名稱<br>幣別</td>
	    <td width="10%" align="left">開狀原幣額<br></td>
	    <td width="10%" align="left" >採購單號<br>品號</td>
	    <td width="10%" align="left">品名<br>規格</td>
	    <td width="10%" align="left">單位<br>採購數量</td>
		<td width="10%" align="left"><br>採購單價</td>
	    <td width="10%" align="left">採購金額<br>有效日期</td>
		<td width="10%" align="left">L/C單號<br>開狀匯率</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	       <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    	<td width="10%" align="left"><?php echo  $val->ta005;?><br><?php echo  $val->ta008;?></td>
		    <td width="10%" align="left"><?php echo  $val->ta002;?><br><?php echo  $val->ta036;?></td>
		    <td width="10%" align="left"><?php echo  $val->ta036disp;?><br><?php echo  $val->ta016;?></td>
		    <td width="10%" align="left"><?php echo  $val->ta018;?><br><?php echo  '';?></td>
			<td width="10%" align="left"><?php echo  $val->tb005;?><br><?php echo  $val->tb010;?></td>
		    <td width="10%" align="left"><?php echo  $val->tb011;?><br><?php echo  $val->tb012;?></td>
			<td width="10%" align="left"><?php echo  $val->tb013;?><br><?php echo  $val->tb014;?></td>
		    <td width="10%" align="left"><?php echo  '';?><br><?php echo  $val->tb015;?></td>
		    <td width="10%" align="left"><?php echo  $val->tb016;?><br><?php echo  $val->ta009;?></td>
		    <td width="10%" align="left"><?php echo  $val->ta004;?><br><?php echo  $val->ta017;?></td>
      
        </tr>		
            
		 <?php  $rownum++;$rownum1++;$vqty=$vqty+$val->tb016;$vnoqty=$vnoqty+$val->tb016;$vamt=$vamt+$val->tb016; ?>
		<?php // $rownum++;$rownum1++; ?>			
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
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
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					</tr>			
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					</tr>			
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="10" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計採購金額：</b> <?php if ($tprint=='Y') { echo $vamt;} ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計採購金額</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 