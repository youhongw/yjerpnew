<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/pali36/printdetail';location = url; </script> 
  <?php } ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=24; $vbb=$vaa-1;} else 
		  {$vaa=24; $vbb=$vaa-1;} ?>	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$tprint='Y'; 
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
$totle_money = 0;
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->	
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center" colspan="3"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		<tr>
			<td align="left" width="33%">製表日期：&nbsp;<?php echo date("Y/m/d");?></td>
			<td align="center" width="33%">離職補發薪年月明細表</td>
			<td align="right" width="33%">頁　　次：&nbsp;<?php echo $page."/".$totle_page ?></td>
		</tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">員工代號<br>員工姓名</td>
	    <td width="10%" align="left">部門代號<br>部門名稱</td>
	    <td width="10%" align="right">補發薪年月</td>
	  	<td width="10%" align="right">保留</td>
		<td width="60%" align="right">備註</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="10%" align="left"><?php echo $val->tk001;?><br><?php echo  $val->tk001disp;?></td>
		<td width="10%" align="left"><?php echo $val->tk002;?><br><?php echo  $val->tk002disp;?></td>
		<td width="10%" align="right"><?php echo substr($val->tk003,0,4)."/".substr($val->tk003,4,2);?></td>
		
		<td width="10%" align="right"><?php echo number_format($val->tk004); $totle_money+=$val->tk004; ?></td>
		<td width="60%" align="right"><?php echo $val->tk005;?></td>
              </tr>
	   <?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				         <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				   <tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					</tr>					 
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					
	                 	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					  <tr>					 
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					</tr>				
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					  <tr>					 
					 <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					</tr>				
					<?php } ?> <?php } ?>
					
					<?php if($totle_page == $page){//總計?>
						<tr>
							<td align="left" colspan="3"><b>總計：</b></td>
							<td align="right"><b><?php echo $totle_money; ?>元</b></td>
							<td align="right"><b></b></td>
						</tr>
					<?php } ?>
	  </table>
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
    
