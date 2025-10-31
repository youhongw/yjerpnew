<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/ast/asti06/printdetail';location = url; </script> 
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
$totle_page = 0;
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	}
	//$pur_date = substr($value->tc039,0,4).'/'.substr($value->tc039,4,2).'/'.substr($value->tc039,6,2);
	$pur_date =stringtodate("Y/m/d",$value->tc027);
	$totle_page ++;
}
?>
<?php  //開始分頁印
$page = 0;//第一頁開始
$abc = 0;
foreach($page_data as $key=>$value){
	//echo "<pre>";var_dump($value);exit;
	foreach($value as $key2=>$value2){
		$abc += 1;
		$page += 1;
	extract((array)$value2);
?>    	
	 <!-- 開始列印 -->	
	<table class="store">    <!-- 跳頁用 --> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr>
			<td width="33%"></td>
			<td align="center" width="34%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td width="33%"></td></tr>
			
	   <tr>
			<td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?></td>
			<td align="center"><?php if($paper9=="1"){echo "";} else {echo "";} ?>資產改良明細表</td>
			<td align="center"><?php {echo "";} ?><?php if($paper9=="1")  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
		<td width="50%" align="left" style="border-right:0px">單別：<?php echo $tc001."  ".$tc001disp; ?></td>
		<td width="50%" align="left" style="border-left:0px">改良成本：<?php echo $tc007; ?></td>
	  </tr>
	  
	  <tr>
		<td align="left" style="border-right:0px">單號：<?php echo $tc002; ?></td>
		<td align="left" style="border-left:0px">增減年限：<?php echo $tc009."    月"; ?></font></td>
	  </tr>
	  
	  <tr>
		<td align="left" style="border-right:0px">單據日期：<?php echo $tc027; ?></td>
		<td align="left" style="border-left:0px">增減殘值：<?php echo $tc010; ?></td>
	  </tr>
	  
	  <tr>
		<td align="left" style="border-right:0px">資產編號：<?php echo $tc004; ?></td>
		<td align="left" style="border-left:0px">應付編號：<?php echo "  -  "; ?></td>
	  </tr>
	  
	  <tr>
		<td align="left" style="border-right:0px">資產名稱：<?php echo $tc004disp; ?></td>
		<td align="left" style="border-left:0px">傳票編號：<?php echo "  -  "; ?></td>
	  </tr>
	  
	  <tr>
		<td align="left" style="border-right:0px">規格：<?php echo $tc004disp2; ?></td>
		<td align="left" style="border-left:0px">確認碼：<?php echo $tc015; ?></td>
	  </tr>
	  
	  <tr>
		<td style="border-right:0px">備註：<?php echo $tc013; ?></td>
		<td style="border-left:0px"></font></td>
	  </tr>
	</table>
	<br/>
	<?php 
		if($abc > 3){
			$abc = 0;
			echo " <div style=\"page-break-before: always;\"></div>";
		}
	}
}?>
	