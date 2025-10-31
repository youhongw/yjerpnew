	<?php
		$num_results = count($results);
		$pages = round(($num_results/19)+1,0);  //每頁十筆
		$mb057v=0;$mb058v=0;$mb059v=0;$mb060v=0;$totlev=0;  //各項統計
	?>
	<style>
	.thead td{
		border:0px;
		border-top:2px solid ;
		border-bottom:2px solid ;
	}
	.list td{
		border:0px;
		border-bottom:1px solid ;
	}
	</style>
	<?php
	for($i=1;$i<=$pages;$i++){
	?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
			<td align="left" width="33%">製表日期:&nbsp;<?php echo date("Y/m/d")?></td>
			<td align="center" width="33%">尾階材料用途清單</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i.'/'.$pages ?> 
			<br>查詢品號:&nbsp;<?php echo $invq02a; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="9%" align="left" valign="top">元件品號</td>
		<td width="8%" align="left" valign="top">主件品號</td>
	    <td width="20%" align="left" valign="top">品　　名<br>規　　格</td>
	    <td width="5%" align="left" valign="top">單位<br>小單位</td>
		<td width="5%" align="left" valign="top">屬性<br>材料型態</td>
		<td width="5%" align="right" valign="top">標準批量<br>投料時距</td>
	    <td width="5%" align="right" valign="top">組成用量<br>實際用量</td>
		<td width="5%" align="right" valign="top">損耗率%</td>
      </tr>
	</table>
    <table class="list">
	<?php if($i<=1){?>
	<tr><!-- 表身 物料 -->
	    <td width="9%" align="left" valign="top"><?php echo $results[0]['md003'];?></td>
		<td width="8%" align="left" valign="top"></td>
	    <td width="20%" align="left" valign="top"><?php echo $results[0]['mb002'];?><br><?php echo $results[0]['mb003'];?></td>
	    <td width="5%" align="left" valign="top"></td>
		<td width="5%" align="left" valign="top"></td>
		<td width="5%" align="right" valign="top"></td>
	    <td width="5%" align="right" valign="top"> </td>
		<td width="5%" align="right" valign="top"></td>
    </tr>
	<?php }?>
	<?php
	$num_each_page = $i*19;
	if($i==$pages)
		$num_each_page = $num_results%19+($i-1)*19;
	
	for($j=$i*19-19;$j<$num_each_page;$j++){
		if($j!=0){
	?>
	  <tr><!-- 表身  主件-->
	    <td width="9%" align="left" valign="top"></td>
		<td width="8%" align="left" valign="top"><?php echo $results[$j]['md001'];?></td>
	    <td width="20%" align="left" valign="top"><?php echo $results[$j]['mb002'];?><br><?php echo $results[$j]['mb003'];?></td>
	    <td width="5%" align="left" valign="top"><?php echo $results[$j]['md004'];?><br><?php echo $results[$j]['md005'];?></td>
		<td width="5%" align="left" valign="top"><?php echo $results[$j]['mb025'];?></td>
		<td width="5%" align="right" valign="top"><br><?php echo $results[$j]['md006'];?></td>
	    <td width="5%" align="right" valign="top"><?php echo $results[$j]['md006'];?><br><?php echo $results[$j]['md006'];?></td>
		<td width="5%" align="right" valign="top"><?php echo $results[$j]['md008'];?></td>
      </tr>
		<?php }
	}?>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
