<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri01/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=28; $vbb=$vaa-1;} else 
		  {$vaa=28; $vbb=$vaa-1;} ?>	  
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
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
	$pur_date = substr($value->ma023,0,4).'/'.substr($value->ma023,4,2).'/'.substr($value->ma023,6,2);
}
$totle_page = $page;

?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->	
	
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	  <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	  <tr>
	    <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  　　　　　　　　　　
			廠商明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
      </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="14%" align="left">廠商代號</td>
	    <td width="14%" align="left">廠商簡稱</td>
	    <td width="14%" align="left">電話</td>
	    <td width="14%" align="left">傳真</td>	   
	    <td width="14%" align="left">連絡人</td>
		<td width="30%" align="left">地址</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	  <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	   <tr>
	   	<td width="14%" align="left"><?php echo  $val->ma001;?></td>
		<td width="14%" align="left"><?php echo  $val->ma002;?></td>
		<td width="14%" align="left"><?php echo  $val->ma008;?></td>
		<td width="14%" align="left"><?php echo  $val->ma010;?></td>		
		<td width="14%" align="left"><?php echo  substr($val->ma013,0,18);?></td>
		<td width="30%" align="left"><?php echo  $val->ma048;?></td>
       </tr>
	 <?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa) ) { ?>
				         <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
		          <tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
						  <td align="left"><b>&nbsp;</b></td>		 
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>	
                        <td align="left"><b>&nbsp;</b></td>					   
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
					     <td align="left"><b>&nbsp;</b></td>
					</tr>
					<?php } ?> <?php } ?>   			
	  </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
    
