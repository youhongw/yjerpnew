   <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/inv/invr20/printdetail';location = url; </script> 
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
			<div style="text-align:center;"><font size="5">庫&nbsp;&nbsp;存&nbsp;&nbsp;狀&nbsp;&nbsp;況&nbsp;&nbsp;查&nbsp;&nbsp;詢</font></div><br>
			<div style="text-align:center;display:inline"><font size="4">品號:&nbsp;<?php echo $invq02a;?></font></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div style="text-align:center;display:inline"><font size="4">品名/規格:&nbsp;<?php echo iconv("big-5","utf-8//IGNORE",$results1[0]->MB002) .'/'.iconv("big-5","utf-8//IGNORE",$results1[0]->MB003);?></font></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div style="text-align:Right;display:inline"><font size="4">總數量:&nbsp;<?php echo $results1[0]->QTY ;?></font></div>
		</div><br>
	</table>
	<table width="100%" style="border-collapse:collapse;">    <!-- 列表頭 -->
	  <tr class="narrow">
	    <td width="12%" align="center"><font size="4"><br>日期<br><br></font></td>
		<td width="16%" align="center"><font size="4">單別-單號-序號</font></td>
		<td width="10%" align="center"><font size="4">庫別/庫別名稱</font></td>
	    <td width="12%" align="center"><font size="4">入出別</font></td>
	    <td width="10%" align="left"><font size="4">異動數量</font></td>
		<td width="10%" align="right"><font size="4">單位成本</font></td>
	    <td width="10%" align="right"><font size="4">異動金額</font></td>
		<td width="20%" align="right"><font size="4">備註</font></td>
      </tr>
	
		<tr>
		 <?php foreach($results as $k=>$val){?>
	    <td width="12%" align="center"><?php echo  substr($val->LA004,0,4).'/'.substr($val->LA004,4,2).'/'.substr($val->LA004,6,8);?></td>
		<td width="16%" align="center"><?php echo  $val->LA006.'-'.$val->LA007.'-'.$val->LA008 ;?></td>
		<td width="10%" align="center"><?php echo  $val->LA009.'/'.iconv("big-5","utf-8//IGNORE",$val->MC002);?></td>
        <td width="12%" align="center"><?php if($val->LA005 == 1){ echo '入庫';} else {echo '出庫';}   ;?></td>		
		<td width="10%" align="left"><?php echo  round($val->LA011,3); ?></td>
		<td width="10%" align="right"><?php echo round($val->LA012,2);?></td>
		<td width="10%" align="right"><?php echo  round($val->LA013);?></td> 
		<td width="20%" align="right"><?php echo  iconv("big-5","utf-8//IGNORE",$val->LA010);?></td> 
       		
        </tr>		
		<?php } ?> 


	        </table>
		

		<!--  <br/>   -->
		 <!--  <br/>   -->

	