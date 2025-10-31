<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci10/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=28; $vbb=$vaa-1;} else 
		  {$vaa=28; $vbb=$vaa-1;} ?>	  
  
	  
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
	$pur_date = substr($value->tm003,0,4).'/'.substr($value->tm003,4,2).'/'.substr($value->tm003,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->			  
	
	<table class="store">    <!-- 跳頁用 --> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	  <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
		    　　　　　　　　　
			　　&nbsp;核價單明細表
			　　　　　　　　　　　
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo  $page."/".$totle_page ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="6%" align="center">核價單別</td>
	    <td width="8%" align="center">核價單號</td>
	    <td width="8%" align="left">核價日期</td>
	    <td width="8%" align="left">廠商代號</td>	  
        <td width="10%" align="left">廠商名稱</td>	
		<td width="6%" align="center">序號</td>
		<td width="8%" align="center">品號</td>
		<td width="16%" align="center">品名</td>
		<td width="16%" align="center">規格</td>
		<td width="6%" align="center">單位</td>
		<td width="8%" align="center">單價</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	       <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	      	<td width="6%" align="center"><?php echo  $val->tm001;?></td>
		    <td width="8%" align="center"><?php echo  $val->tm002;?></td>
		    <td width="8%" align="left"><?php echo  substr($val->tm003,0,4).'/'.substr($val->tm003,4,2).'/'.substr($val->tm003,6,2);?></td>
		    <td width="8%" align="left"><?php echo  $val->tm004;?></td>
            <td width="10%" align="left"><?php echo  $val->tm004disp;?></td>	
			<td width="6%" align="left"><?php echo  $val->tn003;?></td>
            <td width="8%" align="left"><?php echo  $val->tn004;?></td>
            <td width="16%" align="left"><?php echo  $val->tn005;?></td>
            <td width="16%" align="left"><?php echo  $val->tn006;?></td>
            <td width="6%" align="left"><?php echo  $val->tn008;?></td>
            <td width="8%" align="left"><?php echo  $val->tn009;?></td>			
         </tr>
	   <?php $rownum++;$rownum1++;?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
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
					  <td align="left"><b>&nbsp;</b></td>
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
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	
                      <td align="right"><b>&nbsp;</b></td>						 
					</tr>
					<?php } ?> <?php } ?>   
	               
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
	