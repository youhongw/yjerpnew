<?php 
//echo "<pre>";var_dump($results);exit;
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
			<td align="left" width="33%">生日年月:&nbsp;<?php echo $dateo;?></td>
			<td align="center" width="33%">生日名冊</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $key .'/'.$total_page; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
		<td width="15%" align="left">部門名稱</td>
	    <td width="17%" align="left">員工代號</td>
		<td width="17%" align="left">員工姓名</td>
	    <td width="17%" align="left">生日</td>
	    <td width="17%" align="left">到職日</td>
	    <td width="17%" align="left">離職日</td>
      </tr>
	</table>
	<table class="list">
	<?php foreach($val as $k => $v){ ?>
	  <tr>
		<td width="15%" align="left"><?php echo $v->me002; ?></td>
	    <td width="17%" align="left"><?php echo $v->mv001; ?></td>
	    <td width="17%" align="left"><?php echo $v->mv002; ?></td>
		<td width="17%" align="left"><?php echo substr($v->mv008,0,4)."/".substr($v->mv008,4,2)."/".substr($v->mv008,6,2); ?></td>
		<td width="17%" align="left"><?php echo substr($v->mv021,0,4)."/".substr($v->mv021,4,2)."/".substr($v->mv021,6,2); ?></td>
		<td width="17%" align="left"><?php if(@$v->mv022){echo substr($v->mv022,0,4)."/".substr($v->mv022,4,2)."/".substr($v->mv022,6,2);} ?></td>
      </tr>
	<?php } ?>
	<?php if($key==$total_page){ ?>
	  <tr>
	     <td align="right" colspan="6" >合計:<?php echo $total_people;?>人</td>
      </tr>
	<?php } ?>
	</table>
	<div style="page-break-before: always;"></div>
<?php	
	}
?>