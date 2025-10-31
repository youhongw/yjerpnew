<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci04/printdetail';location = url; </script> 
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
			<tr><td width="20%" colspan="5" style="text-align:center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
			
			<tr>
	      <!--<td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			退料單明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<td width="20%" colspan="2">製表日期：<?php echo date("Y/m/d") ?></td><td width="20%" style="text-align:center" colspan="2">退料單明細表</td><td width="20%" style="text-align:right">頁次：<?php echo $page."/".$totle_page ?></td>
			
			<!--<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>-->
			</tr>
	</table>
	
	
	<table class="thead">    <!-- 列表頭 -->
	<?php
		
		foreach($results as $a=>$b){
			$tc001 = $b->tc001;
			$tc002 = $b->tc002;
			$tc014 = $b->tc014;
			$tc004 = $b->tc004;
			$tc005 = $b->tc005;
			$tc006 = $b->tc006;
			$tc007 = $b->tc007;
			$tc015 = $b->tc015;
			//echo "<pre>";var_dump($val);
		}
	?>
		<tr>
			<div >
				<tr style="border:2px">					
					<td width="20%" align="left" style="border-bottom:0px;border-right:0px" >退料單別：<?php echo $tc001 ?></td><td width="20%" align="left" style="border-bottom:0px;border-left:0px;border-right:0px"></td><td width="20%" align="left" style="border-left:0px;border-bottom:0px;border-right:0px">廠別：<?php echo $tc004 ?></td><td width="20%" style="border-right:0px;border-bottom:0px;border-left:0px"></td><td width="20%" style="border-bottom:0px;border-left:0px">備註：<?php echo $tc007 ?></td>
				</tr>
				<tr>
					<td width="20%" align="left" style="border-top:0px;border-right:0px;border-bottom:0px" >退料單號：<?php echo $tc002 ?></td><td width="20%" align="left" style="border:0;border-left:0px"></td><td width="20%" align="left" style="border:0;border-top:0px">生產線別:<?php echo $tc005 ?></td><td width="20%" style="border:0"></td><td width="20%" style="border-left:0;border-top:0px;border-bottom:0px">確認：<?php echo $tc015 ?></td>
				</tr>
				<tr>
					<td width="20%" align="left" style="border-top:0px;border-right:0px">單據日期：<?php echo $tc014 ?></td><td width="20%" align="left" style="border-left:0px;border-top:0px;border-right:0px"></td><td width="20%" align="left" style="border-top:0px;border-right:0px;border-left:0px">加工廠商：<?php echo $tc006 ?></td><td width="20%" style="border-top:0px;border-left:0px;border-right:0px"></td><td width="20%" style="border-left:0px;border-top:0px"></td>
				</tr>
			</div>
		</tr>
		<tr>
	    <div>
	    <td width="20%" align="left"><b>材料品號</b><br/><b>品名</b><br/><b>規格</b></td>   
		<td width="20%" align="left"><b>單位</b></td>
		<td width="20%" align="left"><div style="text-align:right"><b>退料數量</b></div><b>庫別</b><br/><b>庫別名稱</b></td>
		<td width="20%" align="left"><b>製令編號</b><br><b>製程</b><br/><b>儲位</b></td>
		<td width="20%" align="left" ><b>批號</b><br/><b>退料說明</b><br/><b>備註</b></td>
		</div>
		</tr>
	</table>
   
	<table class="list">     <!-- 列明細 -->
	      <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
					  <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	   	<td width="20%" align="left"><b><?php echo  $val->te004;?></b><br><b><?php echo  $val->te017;?></b><br/><b><?php echo $val->te018 ?></b></td>
		<td width="20%" align="left"><b><?php echo  $val->te006;?></b></td>	
		<td width="20%" align="left"><div style="text-align:right"><b><?php echo  $val->te005;?></b></div><b><?php echo  $val->te008;?></b><br/><b><?php echo $val->mc002disp?></b></td>	
		<td width="20%" align="left"><b><?php echo  $val->te011."-".$val->te012;?></b><br/><b><?php echo $val->te009 ?></b><br/><b><?php echo $val->mc003 ?></b></td>
        <td width="20%" align="left"><b><?php echo  $val->te010;?></b><br><b><?php echo  $val->te013;?></b><br/><b><?php echo $val->te014 ?></b></td>
			
              </tr>
	     <!--<?php $rownum++;$rownum1++;$vqty=$vqty+$val->td008;$vamt=$vamt+$val->td011; ?>-->
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b><br/><b>&nbsp;<br/></td>					  
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
        <?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b><br/><b>&nbsp;<br/></td>						 
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br/></td>
					  <td align="left"><b>&nbsp;</b><br/><b>&nbsp;<br/></td>					 
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
	
