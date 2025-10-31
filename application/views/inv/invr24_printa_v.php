   <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/inv/invr24/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=24; $vbb=$vaa-1;} else 
		  {$vaa=24; $vbb=$vaa-1;} ?>	
<style>
	table{
		border-collapse:collapse;
		border:1px solid black;
		height:20px;
	}
	tr{
		border:1px;
		border-bottom-style:solid;border-color:black;
	}
	td{
		border:1px;
		height:45px;
		border-color:black;
		text-align:center;
	}
	.td_right td{
		border:1px;
		border-right-style:solid;
	}
	.narrow td{
		height:20px;
	}
	.td_nobot{
		border-bottom-style:hidden;
	}
	.tr_nobot{
		border-bottom-style:hidden;
	}
</style>
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vqty=0;$vamt=0; 
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

?>

			
	 <!-- 開始列印 -->	
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	<div STYLE="page-break-after: always;">
		<div id="top_div" name="top_div">
			<div style="text-align:center;"><font size="4"><b><?php echo iconv("big-5","utf-8//IGNORE",$this->session->userdata('sysml003')); ?></b></font></div>
		<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
			<div style="text-align:center;"><font size="5">品&nbsp;&nbsp;號&nbsp;&nbsp;請&nbsp;&nbsp;購&nbsp;&nbsp;/&nbsp;&nbsp;採&nbsp;&nbsp;購&nbsp;&nbsp;/&nbsp;&nbsp;進&nbsp;&nbsp;貨&nbsp;&nbsp;數&nbsp;&nbsp;量&nbsp;&nbsp;查&nbsp;&nbsp;詢</font></div><br>
			<div style="text-align:center;display:inline"><font size="4">品號:&nbsp;<?php echo $invq02a;?></font></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div style="text-align:center;display:inline"><font size="4">品名/規格:&nbsp;<?php echo iconv("big-5","utf-8//IGNORE",$results1[0]->MB002) .'/'.iconv("big-5","utf-8//IGNORE",$results1[0]->MB003);?></font></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div><br>
	</table>
	<table width="100%" style="border-collapse:collapse;">    <!-- 列表頭 -->
	  <tr class="narrow">
	    <td width="12%" align="center"><font size="4">已請購量</font></td>
		<td width="16%" align="center"><font size="4">已採購量</font></td>
		<td width="10%" align="center"><font size="4">已進貨量</font></td>
	    <td width="12%" align="center"><font size="4">託外進貨量</font></td>
	    <td width="10%" align="left"><font size="4">已採未交量</font></td>
      </tr>
	
		<tr>
		 <?php foreach($results as $k=>$val){?>
	    <td width="12%" align="center"><?php echo  round($val->QTY3,2);?></td>
		<td width="16%" align="center"><?php echo  round($val->QTY1,2);?></td>
		<td width="10%" align="center"><?php echo  round($val->QTY4,2);?></td>
        <td width="12%" align="center"><?php echo round($val->QTY5,2);?></td>		
		<td width="10%" align="left"><?php echo  round($val->QTY2,2); ?></td>
        </tr>		
		<?php } ?> 


	        </table>
		

		<!--  <br/>   -->
		 <!--  <br/>   -->

	