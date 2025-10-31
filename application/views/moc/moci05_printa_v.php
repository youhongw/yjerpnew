<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci05/printdetail';location = url; </script> 
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
	
	<table class="store">    <!-- 跳頁用 -->
			<tr><td colspan="6" style="text-align:center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
			
			<tr>
	      <!--<td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			退料單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<td width="16%" colspan="2">製表日期：<?php echo date("Y/m/d") ?></td><td width="17%" style="text-align:center" colspan="2">生產入庫單明細表</td><td width="17%" style="text-align:right" colspan="2">頁次：<?php echo $page."/".$totle_page ?></td>
			
			<!--<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>-->
			</tr>
	</table>
	
	
	<table class="thead">    <!-- 列表頭 -->
	<?php
		
		foreach($results as $a=>$b){
			$tf001 = $b->tf001;
			$tf001disp = $b->tf001disp;
			$tf002 = $b->tf002;
			$tf003 = $b->tf003;
			$tf004 = $b->tf004;
			$tf004disp = $b->tf004disp;
			$tf005 = $b->tf005;
			$tf006 = $b->tf006;
			$tf012 = $b->tf012;
			//echo "<pre>";var_dump($results);exit;
		}
	?>
		<tr>
			<div >
				<tr style="border:2px">					
					<td width="36%" colspan="2" align="left" style="border-bottom:0px;border-right:0px"  >入庫單別：<?php echo $tf001." ".$tf001disp;?></td><td width="32%" colspan="2" align="left" style="border-bottom:0px;border-left:0px;border-right:0px">入庫日期：<?php echo substr($tf003,0,4)."/".substr($tf003,4,2)."/".substr($tf003,6,2); ?></td><td width="32%" colspan="2" align="left" style="border-left:0px;border-bottom:0px">備註：<?php echo $tf005 ?></td><!--<td width="17%" style="border-right:0px;border-bottom:0px;border-left:0px"></td><td width="17%" style="border-bottom:0px;border-left:0px;border-right:0px"></td><td width="17%" style="border-bottom:0px;border-left:0px"></td>-->
				</tr>
				<tr>
					<td width="36%" colspan="2" align="left" style="border-top:0px;border-right:0px;border-bottom:0px"  >入庫單號：<?php echo $tf002 ?></td><td width="32%" colspan="2" align="left" style="border:0;border-left:0px;border-right:0px">廠別:<?php echo $tf004."  ".$tf004disp; ?></td><td width="32%" colspan="2" align="left" style="border-top:0px;border-left:0px">確認Y：<?php echo $tf006 ?></td><!--<td width="17%" style="border:0"></td><td width="17%" style="border-left:0;border-top:0px;border-bottom:0px;border-right:0px"></td><td width="17%" style="border-top:0px;border-left:0px"></td>-->
				</tr>
			</div>
		</tr>
		<tr>
	    <div>
	    <td width="20%" align="left"><b>產品品號</b><br/><b>品名</b><br/><b>規格</b></td>   
		<td width="16%" align="left"><b>入庫數量</b><br/><b>報廢數量</b><br/><b>驗收數量</b></td>
		<td width="16%" align="left"><b>單位</b><br/><b>入出別</b><br/><b>檢驗狀態</b></td>
		<td width="16%" align="left"><b>庫別代號</b><br><b>庫別名稱</b><br/><b>製令編號</b></td>
		<td width="16%" align="left"><b>批號</b><br/><b>專案代號</b><br/><b>備註</b></td>
		<td width="16%" align="left"><b>有效日期</b><br/><b>複檢日期</b><br/><div style="text-align:right"><b>驗退數量</b></div></td>
		</div>
		</tr>


     <!-- 列明細 -->
	      <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					  <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr> 
	   	<td width="20%" align="left"><b><?php echo  $val->tg004;?></b><br/><b><?php echo  $val->tg005;?></b><br/><b><?php echo $val->tg006; ?></b></td>
		<td width="16%" align="left"><b><?php echo  $val->tg011;?></b><br/><b><?php echo  $val->tg012;?></b><br/><b><?php echo  $val->tg013;?></b></td>	
		<td width="16%" align="left"><b><?php echo  $val->tg007;?></b><br/><b><?php echo  $val->tg009;?></b><br/><b><?php echo $val->tg016;?></b></td>	
		<td width="16%" align="left"><b><?php echo  $val->tg010;?></b><br/><b><?php echo $val->tg010disp; ?></b><br/><b><?php echo $val->tg014."-".$val->tg015; ?></b></td>
        <td width="16%" align="left"><b><?php echo  $val->tg017;?></b><br/><b><?php echo  $val->tg021;?></b><br/><b><?php echo $val->tg020; ?></b></td>
        <td width="16%" align="left"><b><?php echo  $val->tg018;?></b><br/><b><?php echo  $val->tg019;?></b><br/><div style="text-align:right"><b><?php echo $val->tg023; ?></b></div></td>
			
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
	
