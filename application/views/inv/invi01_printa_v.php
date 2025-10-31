	<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/inv/invi01/printdetail';location = url; </script> 
  <?php exit;} ?>

	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y'; 
$page = 1;//預設第一頁
$page_limit = 42;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%42==41){
		if(@$results[$page*42]){
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
	<table class="store">     <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			品號類別明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">分類方式</td>
	    <td width="17%" align="center">品號類別代號</td>
	    <td width="17%" align="left">品號類別名稱</td>
	    <td width="17%" align="left">存貨會計科目</td>
	    <td width="17%" align="left" >銷貨收入科目</td>
	    <td width="17%" align="center">銷貨退回科目</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	    <?php  $rownum=45;$rownum1=0;$rownum2=42;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	  <tr>
	    <td width="15%" align="center"><?php echo  $val->ma001;?></td>
		<td width="17%" align="center"><?php echo  $val->ma002;?></td>
		<td width="17%" align="left"><?php echo  $val->ma003;?></td>
		<td width="17%" align="left"><?php echo  $val->ma004;?></td>
		<td width="17%" align="left" ><?php echo  $val->ma005;?></td>
		<td width="17%" align="center"><?php echo  $val->ma006;?></td>
     </tr>
	<?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=42 ) ) { ?>
				         <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
								 
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					
	                 	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=42 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>	
                       <td align="left"><b>&nbsp;</b></td>					  
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=42 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				 <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>	
                        <td align="left"><b>&nbsp;</b></td>						  
					</tr>
					<?php } ?> <?php } ?>   			
	  </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
    
