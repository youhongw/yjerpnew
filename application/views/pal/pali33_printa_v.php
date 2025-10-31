<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pal/pali33/printdetail';location = url; </script> 
  <?php } ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=16; $vbb=$vaa-1;} else 
		  {$vaa=16; $vbb=$vaa-1;} ?>	  
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
	$pur_date = '';
}
$totle_page = $page;
$totle_num = 0;
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
/*
*/
foreach($page_data as $key=>$value){
?>       
	 <!-- 開始列印 -->	
	<table class="store">    <!-- 跳頁用 -->
		<tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
		</tr>
		<tr>
			<td align="left" width="33%">年月:&nbsp;<?php echo $qry_dateo."~".$qry_datec;?></td>
			<td align="center" width="33%">月出勤資料明細表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $page.'/'.$totle_page; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	   <tr>
	    <td width="10%" align="left">員工代號<br>員工姓名</td>
	    <td width="9%" align="left">刷卡年月<br>部門代號<br>部門名稱</td>
	    <td width="9%" align="right">年遲到<br>遲到早退次<br>補正卡次</td>
	    <td width="9%" align="right">事假時數<br>病假時數<br>特休時數</td>
	    <td width="9%" align="right">曠職天<br>公傷假<br>公假天</td>
	    <td width="9%" align="right">產假天<br>陪產天<br>婚假天</td>
		<td width="9%" align="right">無薪假<br>喪假天<br></td>
		<td width="9%" align="right">平加班<br>平加班2上<br>績效獎金</td>
		<td width="9%" align="right">六加班<br>日加班<br>其他加項</td>
		<td width="9%" align="right">破月伙食<br>外勞減項<br>其他減項</td>
		<td width="9%" align="right">仲介費<br>食宿費<br>水電費</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	    <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
		 <?php foreach($page_data[$key] as $k=>$val){
			 foreach($val as $t_k=>$t_v){if(!$t_v||$t_v=="0"){$val->$t_k="&nbsp;";}}
			 $totle_num++ ?>
	      <tr>
	    <td width="10%" align="left"><?php echo $val->tc001;?><br><?php echo $val->tc001disp;?></td>
		<td width="9%" align="left"><?php echo substr($val->tc003,0,4)."/".substr($val->tc003,4,2);?><br><?php echo $val->tc002;?><br><?php echo $val->tc002disp;?></td>
		<td width="9%" align="right"><?php echo $val->tc004;?><br><?php echo $val->tc004;?><br><?php echo $val->tc005;?></td>
		<td width="9%" align="right"><?php echo $val->tc006;?><br><?php echo $val->tc007;?><br><?php echo $val->tc008;?></td>
		<td width="9%" align="right"><?php echo $val->tc015;?><br><?php echo $val->tc014;?><br><?php echo $val->tc016;?></td>
		<td width="9%" align="right"><?php echo $val->tc011;?><br><?php echo $val->tc012;?><br><?php echo $val->tc013;?></td>
		<td width="9%" align="right"><?php echo $val->tc010;?><br><?php echo $val->tc009;?></td>
		<td width="9%" align="right"><?php echo $val->tc017;?><br><?php echo $val->tc018;?><br><?php echo $val->ta013;?></td>
		<td width="9%" align="right"><?php echo $val->sum_tc019;?><br><?php echo $val->sum_tc021;?><br><?php if($val->sum_ta006+$val->sum_ta0061 != 0){echo number_format($val->sum_ta006+$val->sum_ta0061);}else{echo "&nbsp;";} ?></td>
		<td width="9%" align="right"><?php echo $val->ta011;?><br><?php echo $val->sum_ta010;?><br><?php if($val->ta009+$val->ta0091+$val->ta014+$val->ta015+$val->mv203+$val->td056 != 0){echo $val->ta009+$val->ta0091+$val->ta014+$val->ta015+$val->mv203+$val->td056;}else{echo "&nbsp;";} ?></td>
		<td width="9%" align="right"><?php echo $val->ta005b;?><br><?php echo $val->ta008b;?><br><?php echo $val->ta010b; ?></td>
          </tr>
	   <?php $rownum++;$rownum1++; ?>
					
		<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
		 <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				   <tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					</tr>					 
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
					
	                 	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					 <tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					</tr>						
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					 <tr>					 
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					    <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b><br><b>&nbsp;</b><br><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					</tr>					
					<?php } ?> <?php } ?>   			
	  </table>
	  <?php if (($totle_page == $page) and  ($rownum1 <=$vaa ) )  {?>

		<table class="store">
			<tr>
			<td>人數:<?php echo $totle_num; ?></td>
			<td>核准:</td>
			<td>審核:</td>
			<td>製表:</td>
			</tr>
		</table>
		<?php } ?>
	  <?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  {?>
	  <?php }else{?>
			<div style="page-break-before: always;"></div>
	  <?php } ?>
		 <?php $page++; } ?> 
