 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/acr/acri03/printdetail';location = url; </script> 
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
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收款單明細表
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
        </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">單別</td>
	    <td width="10%" align="center">收款單號</td>
	    <td width="10%" align="left">收款日期</td>
	    <td width="14%" align="left">客戶代號<br><span>客戶名稱</span></td>
		<td width="6%" align="left">序號<br><span>借/貸</span></td>
		<td width="6%" align="left">來源</td>
		<td width="8%" align="left">憑證單別</td>
		<td width="10%" align="left">憑證單號</td>
		<td width="8%" align="left">到期日</td>
		<td width="8%" align="right">原幣金額</td>
		<td width="8%" align="right">本幣金額</td>
	
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	    <?php $i=1; ?>
	       <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	    <td width="8%" align="center"><?php echo $val->tc001;?></td>
		<td width="10%" align="center"><?php echo $val->tc002;?></td>
		<td width="10%" align="left"><?php echo substr($val->tc003,0,4).'/'.substr($val->tc003,4,2).'/'.substr($val->tc003,6,2);?></td>
		<td width="14%" align="left"><?php echo $val->tc004;?><br><?php echo $val->tc004disp;?></td>	
        <td width="6%" align="left"><?php echo $val->td003;?><br><?php echo $val->td004;?></td>
		 <?php if ($val->td005=='1')	{$td0051='一般';} elseif ($val->td005=='2') {$td0051='票據';}  elseif ($val->td005=='3') {$td0051='待抵';}
		   elseif ($val->td005=='4') {$td0051='沖帳';}  elseif ($val->td005=='5') {$td0051='溢收';}  elseif ($val->td005=='6') {$td0051='差額';} else   {$td0051='折讓';}       ?>	
        <td width="6%" align="left"><?php echo $val->td005;?><br><?php echo $td0051;?></td>
        <td width="8%" align="left"><?php echo $val->td006;?></td>	
        <td width="10%" align="left"><?php echo $val->td007;?></td>
         <?php if ($val->td009>'0')	{$td0091=$val->td009;} else {$td0091='';} ?>	
        <td width="8%" align="right"><?php echo $td0091;?></td>	
        <td width="8%" align="right"><?php echo $val->td014;?></td>	
        <td width="8%" align="right"><?php echo $val->td015;?></td>	
       		
              </tr>
	   <?php $rownum++;$rownum1++;$vqty=$vqty+round($val->td015);$i++; ?>
					
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
						<b>合計本幣金額：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>
						  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>合計本幣金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
	