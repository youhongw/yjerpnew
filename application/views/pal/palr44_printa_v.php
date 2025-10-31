<?php 
$data = array();//先分裝組別
foreach($results as $key => $val){
	$data["A"][] = $val;
}

$num_each_page = 45;$total_page = 0;
$total_trans_money = 0;$total_cash_money = 0;$total_people = 0;
$page_data = array();
foreach($data as $key => $val){
	foreach($val as $k => $v){
		if($k%$num_each_page==0){
			$total_page++;
		}
		$total_trans_money += $v->td040;
		$total_cash_money += $v->td041;
		$page_data[$total_page][] = $v;$total_people++;
	}
}

?>
<?php
	foreach($page_data as $key => $val){
?>
	<table class="store">
	    <tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
	    </tr>
		<tr>
			<td align="left" width="33%">發薪年月:&nbsp;<?php echo $dateo;?></td>
			<td align="center" width="33%">銀行轉帳薪資表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $key .'/'.$total_page; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="20%" align="left">員工代號</td>
		<td width="20%" align="left">員工姓名</td>
		<td width="20%" align="left">銀行帳號</td>
	    <td width="20%" align="left">轉帳金額</td>
	    <td width="20%" align="left">支領現金</td>
      </tr>
	</table>
	<table class="list">
	<?php foreach($val as $k => $v){ ?>
	  <tr>
		 <td width="20%" align="left"><?php echo  $v->td001;?></td>
	     <td width="20%" align="left"><?php echo  $v->td002;?></td>
	     <td width="20%" align="left"><?php echo  $v->mv036;?></td>
		 <td width="20%" align="right"><?php echo  $v->td040;?></td>
		 <td width="20%" align="right"><?php echo  $v->td041;?></td>
      </tr>
	<?php } ?>
	<?php if($key==$total_page){ ?>
	  <tr>
		 <td width="20%" align="left">合計:</td>
	     <td width="20%" align="left"><?php echo $total_people;?>人</td>
	     <td width="20%" align="left"></td>
		 <td width="20%" align="right"><?php echo $total_trans_money;?></td>
		 <td width="20%" align="right"><?php echo $total_cash_money;?></td>
      </tr>
	<?php } ?>
	</table>
	<div style="page-break-before: always;"></div>
<?php	
	}
?>