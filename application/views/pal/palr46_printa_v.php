<?php 
$data = array();//先分裝組別
$company_ary = array(
	'1'=>"得貹",
	'2'=>"祐德",
	'3'=>"高盛",
	'4'=>"祐貹",
	'5'=>"承德"
);
foreach($results as $key => $val){
	if($val->td001=="67001"||$val->td001=="67002"){
		$val->td030_1 = 48200;
		$val->td030_2 = 48200;
	}
	$val->ml008 = $val->ml008.":".$company_ary[$val->ml008];
	$data[$val->ml008][] = $val;
}

$num_each_page = 30;$total_page = 0;
$page_data = array();
foreach($data as $key => $val){
	foreach($val as $k => $v){
		if($k%$num_each_page==0){
			$total_page++;
		}
		$page_data[$total_page][] = $v;
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
			<td align="center" width="33%">二代健保代扣明細</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $key .'/'.$total_page; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="6%" align="left">公司別</td>
		<td width="8%" align="left">薪資年月</td>
		<td width="8%" align="left">員工代號</td>
	    <td width="8%" align="left">員工姓名</td>
	    <td width="8%" align="left">部門名稱</td>
	    <td width="8%" align="left">身份証號</td>
	    <td width="8%" align="right">應稅所得公式</td>
	    <td width="8%" align="right">健保投保額</td>
		<td width="8%" align="right">應領薪資</td>
	    <td width="8%" align="right">個人代扣</td>
	    <td width="8%" align="right">免稅加班費</td>
		<td width="8%" align="right">報稅所得</td>
	    <td width="14%" align="right">免稅伙食津貼</td>
      </tr>
	</table>
	<table class="list">
	<?php foreach($val as $k => $v){ ?>
	  <tr>
		<td width="6%" align="left"><?php echo $v->ml008;?></td>
	    <td width="8%" align="left"><?php echo $v->td005;?></td>
	    <td width="8%" align="left"><?php echo $v->td001;?></td>
		<td width="8%" align="left"><?php echo $v->td002;?></td>
		<td width="8%" align="left"><?php echo $v->td004;?></td>
	    <td width="8%" align="left"><?php echo $v->mv009;?></td>
	    <td width="8%" align="right"><?php echo $v->td030_1;?></td>
		<td width="8%" align="right"><?php echo $v->ml007;?></td>
		<td width="8%" align="right"><?php echo $v->td030;?></td>
		<td width="8%" align="right"><?php echo $v->td035;?></td>
		<td width="8%" align="right"><?php echo $v->td044;?></td>
		<td width="8%" align="right"><?php echo $v->td030_2;?></td>
		<td width="14%" align="right"><?php echo $v->td011;?></td>
      </tr>
	<?php } ?>
	</table>
	<div style="page-break-before: always;"></div>
<?php	
	}
?>