<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/act/acti10/printdetail';location = url; </script> 
		  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=14; $vbb=$vaa-1;$singing=$singing1;} else 
		  {$vaa=14; $vbb=$vaa-1;$singing=$singing2;} ?>	
<!--   頁橫式  -->
<?php if($paper9=="2") { ?>
  
 <style> 
 @page { size: landscape; } 

   @media print {
      .header, .chide {display: none; }
   } 
</style>
  
<?php }  ?>		  
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
	$pur_date = substr($value->ta003,0,4).'/'.substr($value->ta003,4,2).'/'.substr($value->ta003,6,2);
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
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>
		     <?php if($paper9=="1") {echo "　　　　　　　　　";} else {echo "　　　　　　　　　　　　　　　　　　　";} ?>
			會計傳票明細表
			<?php if($paper9=="1")  {echo "　　　　　　　　";} else {echo "　　　　　　　　　　　　　　　　";} ?> 
			頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="center">傳票單別</td>
	    <td width="10%" align="center">傳票單號</td>
	    <td width="10%" align="left">傳票日期</td>
	    <td width="10%" align="right">來源碼</td>
		 <td width="10%" align="right">本幣總額</td>
		<td width="6%" align="left">序號<br><span>借/貸</span></td>
		<td width="12%" align="left">科目編號<br><span>科目名稱</span></td>
		<td width="10%" align="left">部門代號<br><span>部門名稱</span></td>
		<td width="8%" align="left">幣別<br><span>匯率</span></td>
		<td width="8%" align="right">原幣金額</td>
		<td width="8%" align="right">本幣金額</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	  <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	      	<td width="8%" align="center"><?php echo $val->ta001;?></td>
		<td width="10%" align="center"><?php echo $val->ta002;?></td>
		<td width="10%" align="left"><?php echo substr($val->ta003,0,4).'/'.substr($val->ta003,4,2).'/'.substr($val->ta003,6,2);?></td>
		 <?php if ($val->ta006=='1')	{$ta0061='一般';} elseif ($val->ta006=='2') {$ta0061='應計';}  elseif ($val->ta006=='3') {$ta0061='應計回轉';}
		   elseif ($val->ta006=='4') {$ta0061='常用傳票';}  elseif ($val->ta006=='5') {$ta0061='比率分攤';}  elseif ($val->ta006=='6') {$ta0061='迴轉傳票';} else   {$ta0061='其他轉入';}       ?>	
        <td width="10%" align="left"><?php echo $val->ta006;?><br><?php echo $ta0061;?></td>
		<td width="10%" align="center"><?php echo $val->ta008;?></td>
		
        <td width="6%" align="left"><?php echo $val->tb003;?><br><?php echo $val->tb004;?></td>
		<td width="12%" align="left"><?php echo $val->tb005;?><br><?php echo $val->tb005disp;?></td>	
		<td width="10%" align="left"><?php echo $val->tb006;?><br><?php echo $val->tb006disp;?></td>
		<td width="8%" align="left"><?php echo $val->tb013;?><br><?php echo $val->tb014;?></td>
        <td width="8%" align="left"><?php echo $val->tb015;?></td>	
        <td width="8%" align="left"><?php echo $val->tb007;?></td>		
         </tr>
	  <?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				         <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				   <tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					
	                 	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
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
				      <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					</tr>
					<?php } ?> <?php } ?>   			
	  </table>
		      <br/>
			 <td align="left"><b><?php echo $singing ?></b></td>
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
    
