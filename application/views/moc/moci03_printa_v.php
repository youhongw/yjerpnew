<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/moc/moci03/printdetail';location = url; </script> 
<?php exit;} 
?>
<!-- 頁直行數 -->
<?php 
$total_page = 0;
$page_data = array();
$mid_data = array();
$count = 0;$num_perpage = 20;
foreach($results as $key => $val){
	if(!$val->te004){continue;}
	if($count%$num_perpage==0){$total_page++;}
	$page_data[$total_page][] = $val;
	$count++;
}
//echo "<pre>";var_dump($page_data);exit;

?>
<?php  //開始分頁印
foreach($page_data as $key => $val){
?>       
			
	 <!-- 開始列印 -->			  
	
	<table class="store">    <!-- 跳頁用 -->
		<tr><td align="center" colspan="3"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		<tr>
			<td align="left" width="33%">查詢單別:&nbsp;<?php echo $ta001o;?>~<?php echo $ta001c;?><br>
				查詢單號:&nbsp;<?php echo $ta002o;?>~<?php echo $ta002c;?></td>
			<td align="center" width="33%">領料單明細表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $key .'/'.$total_page; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="12%" align="left">領料單別<br>領料單號</td>
	    <td width="12%" align="left">單據日期</td>
	    <td width="10%" align="left">加工廠商<br>廠商名稱</td>
	    <td width="6%" align="left"><b>序號</b></td>
		<td width="12%" align="left"><b>品號</b></td>
		<td width="20%" align="left"><b>品名</b><br><b>規格</b></td>
		<td width="5%" align="left"><b>單位</b></td>
		<td width="8%" align="right"><b>領料數量</b></td>
		<td width="12%" align="right"><b>製令單別</b><br><b>製令單號</b></td>
      </tr>
	</table>
   
	<table class="list">     <!-- 列明細 -->
	  <?php foreach($val as $k => $v){ ?>
	  <tr>
	   	<td width="12%" align="left"><?php echo $v->tc001; ?><br><?php echo  $v->tc002;?></td>
		<td width="12%" align="left"><?php echo substr($v->tc003,0,4).'/'.substr($v->tc003,4,2).'/'.substr($v->tc003,6,2);?></td>
		<td width="10%" align="left"><?php echo $v->tc006; ?><br><?php echo $v->tc006disp; ?></td>	
		<td width="6%" align="left"><?php echo $v->te003; ?></td>	
		<td width="12%" align="left"><?php echo $v->te004; ?></td>
        <td width="20%" align="left"><?php echo $v->te017; ?><br><?php echo $v->te018; ?></td>
		<td width="5%" align="right"><?php echo $v->te006; ?></td>
        <td width="8%" align="right"><?php echo $v->te005; ?></td>
        <td width="12%" align="right"><?php echo $v->te011; ?><br><?php echo $v->te012; ?></td>
	  </tr>
		<?php } ?> 
		<?php if ($total_page == $key  ) { /* ?>
	  <tr>
		<td colspan="10" align="left">
			<b>合計數量：</b>
		</td>
	  </tr>
		<?php */ } ?> 
	</table>
	
	<div style="page-break-before: always;"></div>
<?php 
} 
?> 
