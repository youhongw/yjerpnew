   <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copr07/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=44; $vbb=$vaa-1;} else 
		  {$vaa=24; $vbb=$vaa-1;} ?>
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
	$pur_date = '';
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
	   <tr><td align="left">銷貨期間:&nbsp;<?php echo $dateo.' 至 '.$datec; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			產品銷售排行榜&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="center">排行序號</td>
		<td width="10%" align="center">產品代號</td>
	    <td width="30%" align="center">產品名稱</td>
	    <td width="30%" align="center">產品規格</td>
	    <td width="10%" align="center">單位</td>
	    <td width="10%" align="right">銷貨數量</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	    <?php $i=1; ?>
	    <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
		 <td width="10%" align="center"><?php echo  $i;?></td>
	    <td width="10%" align="center"><?php echo  $val->th004;?></td>
	     <td width="30%" align="center"><?php echo  $val->th005;?></td>
		 <td width="30%" align="center"><?php echo  $val->th006;?></td>
		   <td width="10%" align="center"><?php echo  $val->th009;?></td>
        <td width="10%" align="right"><?php echo  round($val->th008);?></td> 
		
       		
        </tr>		
		 <?php $rownum++;$rownum1++;$vqty=$vqty+round($val->th008);$i++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
		
		   	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				     <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td>	 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b></td> 
					</tr>
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="6" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>合計銷貨數量：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>合計銷貨數量：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
	