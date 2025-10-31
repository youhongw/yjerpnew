 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/tax/taxr02/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=14; $vbb=$vaa-1;} else 
		  {$vaa=14; $vbb=$vaa-1;} ?>	  
	  
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
	$pur_date = substr($value->mc007,0,4).'/'.substr($value->mc007,4,2).'/'.substr($value->mc007,6,2);
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
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
		     　　　　　　　　　
			銷項憑證明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	     <td width="7%" align="left">格式</td>
	    <td width="7%" align="left">稅籍編號</td>
	    <td width="7%" align="left">流水號</td>
	    <td width="7%" align="right">申報年月</td>
		<td width="8%" align="right">發票日期</td>
		<td width="8%" align="right">發票號碼</td>
		<td width="8%" align="right">買方統編</td>
		<td width="8%" align="right">賣方統編</td>
	    <td width="8%" align="right">課稅別</td>
		<td width="8%" align="right">扣抵代號</td>
		<td width="8%" align="right">銷售金額</td>
		<td width="8%" align="right">營業稅額</td>
		<td width="8%" align="right">備註</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	       <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	     <td width="7%" align="center"><?php echo  $val->mc004;?></td>
		<td width="7%" align="center"><?php echo  $val->mc005;?></td>
        <td width="7%" align="right"><?php echo   $val->mc006;?></td>		
        <td width="7%" align="right"><?php echo   $val->mc002;?></td> 
		<td width="8%" align="right"><?php echo   $val->mc007;?></td>
		<td width="8%" align="right"><?php echo   $val->mc010;?></td>
		<td width="8%" align="right"><?php echo   $val->mc008;?></td>
		<td width="8%" align="right"><?php echo   $val->mc009;?></td>
		<td width="8%" align="right"><?php echo   $val->mc012;?></td>
		<td width="8%" align="right"><?php echo   $val->mc014;?></td>
       	<td width="8%" align="right"><?php echo   $val->mc011;?></td>
        <td width="8%" align="right"><?php echo   $val->mc013;?></td>
       	<td width="8%" align="right"><?php echo   $val->mc008;?></td>			
       		
        </tr>		
		 <?php $rownum++;$rownum1++;$vamt=$vamt+$val->mc011; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					    <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
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
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
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
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	 
					</tr>
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="13" align="left">
						<?php if ($totle_page == $page  ) { ?>
							<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $vamt;} ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b></b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 