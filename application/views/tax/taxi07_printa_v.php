<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/not/noti08/printdetail';location = url; </script> 
<?php exit;} ?>
  <!--   頁直行數44 橫行28  -->
<?php if($paper9=="1")  {$vaa=44; $vbb=$vaa-1;} else 
		  {$vaa=28; $vbb=$vaa-1;} ?>	
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vamt=0;$vqty=0; 
$page = 1;  //預設第一頁
$page_limit = $vaa;  //每頁筆數
$page_data;  //先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	}
	//$pur_date = substr($value->tj039,0,4).'/'.substr($value->tj039,4,2).'/'.substr($value->tj039,6,2);
	//$pur_date =stringtodate("Y/m/d",$value->tj039);
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
	   <tr><td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1") 
			  {echo "　　　　　　　　　　　　　　　　　　　　";} else {echo "　　　　　　　　　　　　　　　　　　　　";} ?>
			客戶訂單明細表<?php {echo "　　　　　　　　　　　　　　　　　";} ?>
			<?php if($paper9=="1")  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="6%" align="left">訂單單別</td>
	    <td width="8%" align="left">訂單單號</td>
	    <td width="8%" align="left">訂單日期</td>
	    <td width="8%" align="left">客戶代號</td>	  
        <td width="10%" align="left">客戶名稱</td>	
		<td width="6%" align="left">序號</td>
		<td width="8%" align="left">品號</td>
		<td width="12%" align="left">品名</td>
		<td width="12%" align="left">規格</td>
		<td width="4%" align="left">單位</td>
		<td width="6%" align="right">數量</td>
		<td width="6%" align="right">單價</td>
		<td width="6%" align="right">金額</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	
	   <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
	   <?php foreach($page_data[$key] as $k=>$val){?>
	  <tr>
	    <td width="6%" align="left"><?php echo  $val->tj001;?></td>
		<td width="8%" align="left"><?php echo  $val->tj002;?></td>
	<!--<td width="8%" align="left"><?php // echo  substr($val->tj039,0,4).'/'.substr($val->tj039,4,2).'/'.substr($val->tj039,6,2);?></td> -->
        <td width="8%" align="left"><?php echo  stringtodate("Y/m/d",$val->tj002) ;?></td>
		<td width="8%" align="left"><?php echo  $val->tj004;?></td>	
        <td width="10%" align="left"><?php echo  $val->tj003disp;?></td>			
		<td width="6%" align="left"><?php echo  $val->to003;?></td>
		<td width="8%" align="left"><?php echo  $val->to004;?></td>
		<td width="12%" align="left"><?php echo  $val->to005;?></td>
		<td width="12%" align="left"><?php echo  $val->to006;?></td>
		<td width="4%" align="left"><?php echo  $val->to007;?></td>
		<td width="6%" align="right"><?php echo  $val->to008;?></td>
		<td width="6%" align="right"><?php echo  $val->to006;?></td>
		<td width="6%" align="right"><?php echo  $val->to007;?></td>
      </tr>
	    <?php $rownum++;$rownum1++;$vqty=$vqty+$val->to005;$vamt=$vamt+$val->to005; ?>
					
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
		  <td align="left"><b>&nbsp;</b></td>
		  <td align="left"><b>&nbsp;</b></td>
		  <td align="right"><b>&nbsp;</b></td>
		  <td align="right"><b>&nbsp;</b></td>	
          <td align="right"><b>&nbsp;</b></td>						  
		</tr>					 
		<?php } ?> <?php } ?> 
		<?php  } ?>  <!-- end 明細 --> 
		
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
					<b>合計數量：</b> <?php if ($tprint=='Y') { echo $vqty;} ?><?php echo '　　　　　　　　　　'; ?> 
					<b>合計金額：</b> <?php if ($tprint=='Y') { echo $vamt;} ?>  <?php echo '';} ?> 
				<?php if ($totle_page > $page ) { ?>
					<b>合計數量：</b> <?php if ($tprint=='Y') { echo '';} ?><?php echo '　　　　　　　　　　'; ?>
					<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
			  </td>
			</tr>
	      </table>
		
	    <div style="page-break-before: always;"></div>
		<?php $page++; } ?> 
	