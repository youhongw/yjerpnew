<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci06/printdetail';location = url; </script> 
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
	//$pur_date = substr($value->tc024,0,4).'/'.substr($value->tc024,4,2).'/'.substr($value->tc024,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->			  
	<div>
	<table class="store">    <!-- 跳頁用 -->
			<tr><td colspan="6" style="text-align:center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
			
			<tr>
	      <!--<td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			退料單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<td width="33%">製表日期：<?php echo date("Y/m/d") ?></td><td width="34%" style="text-align:center">託外進貨單明細表</td><td width="33%" style="text-align:right">頁次：<?php echo $page."/".$totle_page ?></td>
			
			<!--<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>-->
			</tr>
	</table>
	</div>
	
	<?php
	function objectToArray($object)
	{
    if(is_object($object))
        $array = get_object_vars($object);
    return $array;
	}
	?>
	
	<table class="thead">    <!-- 列表頭 -->
	<?php
		
		foreach($results as $a=>$b){
			extract(objectToArray($b));
		}
	?>
		<tr>
			<div >
				<tr style="border:2px">					
					<td width="25%"  align="left" style="border-bottom:0px;border-right:0px"  >進貨單別：<?php echo $th001." ".$puri04disp;?></td>
					<td width="15%"  align="left" style="border-bottom:0px;border-left:0px;border-right:0px">廠別：<?php echo $th004." ".$cmsi02disp; ?></td>
					<td width="15%"  align="left" style="border-left:0px;border-bottom:0px;border-right:0px">加工廠商：<?php echo $th005." ".$puri01disp; ?></td>
					<td width="15%" style="border-right:0px;border-bottom:0px;border-left:0px"></td>
					<td width="15%" style="border-bottom:0px;border-left:0px;border-right:0px">課稅別<?php echo $th015; ?></td>
					<td width="15%" style="border-bottom:0px;border-left:0px"></td>
				</tr>
				<tr>
					<td width="25%" align="left" style="border-top:0px;border-right:0px;border-bottom:0px"  >進貨單號：<?php echo $th002 ?></td>
					<td width="15%" align="left" style="border:0;border-left:0px;border-right:0px">件數:<?php echo $th009; ?></td>
					<td width="15%" align="left" style="border-top:0px;border-left:0px;border-bottom:0px;border-right:0px">廠商單號：<?php echo $th006 ?></td>
					<td width="15%" style="border:0"></td>
					<td width="15%" style="border-left:0;border-top:0px;border-bottom:0px;border-right:0px">扣抵區分：<?php echo $th016; ?></td>
					<td width="15%" style="border-top:0px;border-left:0px;border-bottom:0px"></td>
				</tr>
				<tr>
					<td width="25%" align="left" style="border-top:0px;border-right:0px;border-bottom:0px"  >進貨日期：<?php echo $th003; ?></td>
					<td width="15%" align="left" style="border:0;border-left:0px;border-right:0px">備註:<?php echo $th010; ?></td>
					<td width="15%" align="left" style="border-top:0px;border-left:0px;border-right:0px"></td>
					<td width="15%" style="border:0"></td>
					<td width="15%" style="border-left:0;border-top:0px;border-bottom:0px;border-right:0px">確認碼：<?php echo $th023; ?></td>
					<td width="15%" style="border-top:0px;border-left:0px"></td>
				</tr>
			</div>
		</tr>
		<tr>
	    <div>
	    <td width="20%" align="left"><b>品號</b><br/><b>品名</b><br/><b>規格</b></td>   
		<td width="15%" align="left"><b>進貨數量</b><br/><b>已交數量</b></td>
		<td width="15%" align="left"><b>驗收數量</b><br/><b>計價數量</b><br/><b>驗退數量</b></td>
		<td width="15%" align="left"><b>單位/計價單位</b><br><b>驗收日期</b><br/><b>進貨費用</b></td>
		<td width="15%" align="left"><b>加工單價</b><br/><b>加工金額</b><br/><b>扣款金額</b></td>
		<td width="15%" align="left"><b>進貨庫別</b><br/><b>庫別名稱</b><br/><div style="text-align:right"><b>製令單號/製程</b></div></td>
		</div>
		</tr>


     <!-- 列明細 -->
	      <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					  <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr> 
	   	<td width="25%" align="left"><b><?php echo  $val->ti004;?></b><br/><b><?php echo  $val->ti005;?></b><br/><b><?php echo $val->ti006; ?></b></td>
		<td width="15%" align="left"><b><?php echo  $val->ti007;?></b><br/><b><?php echo  $val->ti020;?></b></td>	
		<td width="15%" align="left"><b><?php echo  $val->ti019;?></b><br/><b><?php echo  $val->ti020;?></b><br/><b><?php echo $val->ti022;?></b></td>	
		<td width="15%" align="left"><b><?php echo  $val->ti023;?></b><br/><b><?php echo $val->ti018; ?></b><br/><b><?php echo $val->ti027; ?></b></td>
        <td width="15%" align="left"><b><?php echo  $val->ti024;?></b><br/><b><?php echo  $val->ti025;?></b><br/><b><?php echo $val->ti026; ?></b></td>
        <td width="15%" align="left"><b><?php echo  $val->ti009;?></b><br/><b><?php echo  $val->ti009disp;?></b><br/><div style="text-align:right"><b><?php echo $val->ti014.'/'.$val->ti015; ?></b></div></td>
			
              </tr>
	     <!--<?php $rownum++;$rownum1++;$vqty=$vqty+$val->td008;$vamt=$vamt+$val->td011; ?>-->
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td width="20%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/><b>&nbsp;</b></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/><b>&nbsp;</b></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/><b>&nbsp;</b></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/><b>&nbsp;</b></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/><b>&nbsp;</b></td>					  
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/><b>&nbsp;</b></td>					  
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
        <?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td width="20%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>					  
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>						 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td width="20%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>					  
					  <td width="16%" align="left"><b>&nbsp;</b><br/><b>&nbsp;</b><br/></td>					 
					</tr>
					<?php } ?> <?php } ?>   
	                <!--<tr>
					  <td colspan="10" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo $vqty;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo $vamt;} ?>  <?php echo '';} ?> 
						<?php if ($totle_page > $page ) { ?>
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
						<b>合計金額：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>-->
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
	
