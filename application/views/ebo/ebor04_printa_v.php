   
	<?php $numrow1 =1;$mc007k=0;$th013ak=0;$th013bk=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=2;  ?> 
	  <?php endforeach;?>
	  
	 
	 <?php if   ( $numrow1 <= 15 )
	  {echo "<script>alert('查無資料!!');history.back();</script>";
	exit;}  ?>
	  
	  
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=33;$tot=$paperal-3;} else { $paperal=35;$tot=$paperal-3;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0; 
	  $pages = round(($num_results/9)+1,0);  //每頁十筆
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
	   <tr> <?php echo $br ; ?><td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
			<td align="left" width="33%">製表日期:&nbsp;<?php echo date("Y/m/d")?></td>
			<td align="center" width="33%">E-BOM尾階標準成本表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i.'/'.$pages ?> 
			<br>查詢品號:&nbsp;<?php echo $invq02a; ?></td>
           </tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="12%" align="left" valign="top">主件品號</td>
		<td width="5%" align="left" valign="top">序號</td>
	    <td width="20%" align="left" valign="top">元件品號<br>品　　名<br>規　　格</td>
	    <td width="6%" align="left" valign="top">單位<br>小單位</td>
		<td width="5%" align="left" valign="top">屬性</td>
		<td width="8%" align="right" valign="top">標準批量<br>標準用量</td>
	    <td width="8%" align="right" valign="top">標準材料</td>
		<td width="8%" align="right" valign="top">標準人工</td>
		<td width="8%" align="right" valign="top">標準製費</td>
		<td width="8%" align="right" valign="top">標準加工</td>
		<td width="8%" align="right" valign="top">標準成本</td>
      </tr>
	</table>
    <table class="list">
	<?php if($i<=1){?>
	<tr><!-- 表身 主件 -->
	    <td width="12%" align="left" valign="top"><?php echo $results['mc001'];?></td>
		<td width="5%" align="left" valign="top"></td>
	    <td width="20%" align="left" valign="top"><br><?php echo $results['c_mb002'];?><br><?php echo $results['c_mb003'];?></td>
	    <td width="6%" align="left" valign="top"><?php echo $results['mc002'];?><br><?php echo $results['mc003'];?></td>
		<td width="5%" align="left" valign="top"><?php echo $results['c_mb025'];?></td>
		<td width="8%" align="right" valign="top"><?php echo $results['mc004'];?><br></td>
	    <td width="8%" align="right" valign="top"></td>
		<td width="8%" align="right" valign="top"></td>
		<td width="8%" align="right" valign="top"></td>
		<td width="8%" align="right" valign="top"></td>
		<td width="8%" align="right" valign="top"></td>
    </tr>
	<?php }?>
	<?php
	$mb057v=0;
	$mb058v=0;
	$mb059v=0;
	$mb060v=0;
	$totlev=0;
	$num_each_page = $i*9;
	if($i==$pages)
		$num_each_page = $num_results%9+($i-1)*9;
	
	for($j=$i*9-9;$j<$num_each_page;$j++){
	?>
	  <tr><!-- 表身 物料 -->
	    <td width="12%" align="left" valign="top"></td>
		<td width="5%" align="left" valign="top"><?php echo $results['bom_list'][$j]['md002'];?></td>
	    <td width="20%" align="left" valign="top"><?php echo $results['bom_list'][$j]['mb001'];?><br><?php echo $results['bom_list'][$j]['mb002'];?><br><?php echo $results['bom_list'][$j]['mb003'];?></td>
	    <td width="6%" align="left" valign="top"><?php echo $results['bom_list'][$j]['md004'];?><br><?php echo $results['bom_list'][$j]['md005'];?></td>
		<td width="5%" align="left" valign="top"><?php echo $results['bom_list'][$j]['mb025'];?></td>
		<td width="8%" align="right" valign="top"><br><?php echo $results['bom_list'][$j]['md006'];?></td>
	    <td width="8%" align="right" valign="top"><?php echo number_format($results['bom_list'][$j]['mb057']*$results['bom_list'][$j]['md006'],4);?></td>
		<td width="8%" align="right" valign="top"><?php echo number_format($results['bom_list'][$j]['mb058']*$results['bom_list'][$j]['md006'],4);?></td>
		<td width="8%" align="right" valign="top"><?php echo number_format($results['bom_list'][$j]['mb059']*$results['bom_list'][$j]['md006'],4);?></td>
		<td width="8%" align="right" valign="top"><?php echo number_format($results['bom_list'][$j]['mb060']*$results['bom_list'][$j]['md006'],4);?></td>
		<td width="8%" align="right" valign="top"><?php echo number_format(($results['bom_list'][$j]['mb057']+$results['bom_list'][$j]['mb058']+$results['bom_list'][$j]['mb059']+$results['bom_list'][$j]['mb060'])*$results['bom_list'][$j]['md006'],4);?></td>
      </tr>
	<?php 
	   // if !isset($results['bom_list'][$j]['mb057']) {exit; }
		$mb057v += $results['bom_list'][$j]['mb057']*$results['bom_list'][$j]['md006'];
		$mb058v += $results['bom_list'][$j]['mb058']*$results['bom_list'][$j]['md006'];
		$mb059v += $results['bom_list'][$j]['mb059']*$results['bom_list'][$j]['md006'];
		$mb060v += $results['bom_list'][$j]['mb060']*$results['bom_list'][$j]['md006'];
		$totlev += ($results['bom_list'][$j]['mb057']+$results['bom_list'][$j]['mb058']+$results['bom_list'][$j]['mb059']+$results['bom_list'][$j]['mb060'])*$results['bom_list'][$j]['md006'];
	}?>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
	<table style="border-bottom:2px solid;width:100%;font-size: 10pt;" >
		<tr><td><br></td></tr>
		<tr>
		<td width="17%" style="border:0px;">&nbsp;</td>
		<td width="20%">合計標準成本</td>
		<td width="11%" style="border:0px;">&nbsp;</td>
		<td width="8%" style="border:0px;">&nbsp;</td>
		<td width="8%" align="right" style="border:0px;"><?php echo number_format($mb057v,4);?></td>
		<td width="8%" align="right" style="border:0px;"><?php echo number_format($mb058v,4);?></td>
		<td width="8%" align="right" style="border:0px;"><?php echo number_format($mb059v,4);?></td>
		<td width="8%" align="right" style="border:0px;"><?php echo number_format($mb060v,4);?></td>
		<td width="8%" align="right" style="border:0px;"><?php echo number_format($totlev,4);?></td>
		</tr>
	</table>
