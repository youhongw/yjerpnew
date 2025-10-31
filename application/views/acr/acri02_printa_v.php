 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/acr/acri02/printdetail';location = url; </script> 
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
	
	<table class="store">    <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;";} else {echo "&nbsp;&nbsp;";} ?>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;結帳單明細表
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="8%" align="center">結帳單號</td>
	    <td width="8%" align="left">憑單日期</td>
	    <td width="14%" align="left">客戶代號<br><span>客戶名稱</span></td>
		<td width="6%" align="left">序號<br><span>來源</span></td>
		<td width="8%" align="left">憑證單別</td>
		<td width="10%" align="left">憑證單號</td>
		<td width="6%" align="left">序號</td>
		<td width="10%" align="right">應收金額</td>
		<td width="10%" align="right">未稅金額</td>
		<td width="10%" align="right">稅額</td>
	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	       <?php $i=1; ?>
	       <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="8%" align="center"><?php echo $val->ta001;?></td>
		<td width="8%" align="center"><?php echo $val->ta002;?></td>
		<td width="8%" align="left"><?php echo substr($val->ta003,0,4).'/'.substr($val->ta003,4,2).'/'.substr($val->ta003,6,2);?></td>
		<td width="14%" align="left"><?php echo $val->ta004;?><br><?php echo $val->ta004disp;?></td>	
        <td width="6%" align="left"><?php echo $val->tb003;?><br><?php echo $val->tb004;?></td>	
     
        <td width="8%" align="left"><?php echo $val->tb005;?></td>	
        <td width="10%" align="left"><?php echo $val->tb006;?></td>	
        <td width="6%" align="left"><?php echo $val->tb007;?></td>	
        <td width="10%" align="right"><?php echo $val->tb009;?></td>	
        <td width="10%" align="right"><?php echo $val->tb017;?></td>	
        <td width="10%" align="right"><?php echo $val->tb018;?></td>	
       		<?php // $tb009=$tb009+$val->tb009;$tb017=$tb017+$val->tb017;$tb018=$tb018+$val->tb018;   ?>
              </tr>
	   <?php $rownum++;$rownum1++;$vqty=$vqty+round($val->tb009);$i++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
		
		   	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				       <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>	 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="right"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td> 
					</tr>
					<?php } ?> <?php } ?>   
	                <tr>
					  <td colspan="11" align="right">
						<?php if ($totle_page == $page  ) { ?>
						<b>合計應收金額：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>
						  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>合計應收金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
	