 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cop/copr28/printdetail';location = url; </script> 
  <?php exit;} ?>
  
	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$paper9='1';$tprint='Y';$vamt=0;$vqty=0;$vnoqty=0; 
$page = 1;//預設第一頁
$page_limit = 6;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
$temp_ary = Array();
foreach($results as $key => $val){
	$temp_ary[][$key] = $val;
}
$results = $temp_ary;
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%16==15){
		if(@$results[$page*6]){
			$page++;
		}
	}
}
$totle_page = $page;
if(!@$dateo){
	$dateo = "";
}
if(!@$datec){
	$datec = "";
}
$str_y = substr($dateo,0,4);$str_m = substr($dateo,4,2);
$end_y = substr($datec,0,4);$end_m = substr($datec,4,2);
$current_year = $str_y;
$current_month = $str_m;
$month_count = ((int)$end_y-(int)$str_y)*12+((int)$end_m-(int)$str_m)+1;
$trans_m_ary = Array(
	"01" => "一月","02" => "二月","03" => "三月","04" => "四月","05" => "五月","06" => "六月",
	"07" => "七月","08" => "八月","09" => "九月","10" => "十月","11" => "十一月","12" => "十二月",	
	"1" => "一月","2" => "二月","3" => "三月","4" => "四月","5" => "五月","6" => "六月",
	"7" => "七月","8" => "八月","9" => "九月"
);
$totle_money = 0;
$month_account = Array();
function date_compute($tmp_date){
	$tmp_date_y = substr($tmp_date,0,4);$tmp_date_m = substr($tmp_date,4,2);
	while($tmp_date_m>12){
		$tmp_date_m = $tmp_date_m-12;
		$tmp_date_y++;
	}
	return (string)($tmp_date_y+$tmp_date_m);
}
//var_dump($page_data[$page]);
//echo "<pre>"; var_dump($page_data);exit;
//echo "<pre>"; var_dump(((int)$end_y-(int)$str_y)*12+(int)$end_m-(int)$str_m+1);exit;
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
	 <!-- 開始列印 -->			  
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       <tr>
	      <td align="left" width="33%">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>
			</td>
			<td align="center" width="33%">品號年月銷售數量統計表</td>
			<td align="right">查詢區間: <?php echo $str_y."/".$str_m."~".$end_y."/".$end_m?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	   
		<td width="10%" align="center">客代:品號</td>
	    <td width="8%" align="center">品　名</td>
	    <td width="8%" align="center">規　格</td>
	    <td width="4%" align="center">單　位</td>
		<?php
		for($i=0;$i<$month_count;$i++){
		?>
			<td width="3%" align="left"><?php if($str_m+$i>12){echo $trans_m_ary[($str_m+$i-12)];} else {echo $trans_m_ary[$str_m+$i];}?></td>
		<?php 
		}
		?>
		<td width="3%" align="right">合計數量</td>
	
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	 
	       <?php  $rownum=15;$rownum1=0;$rownum2=16;  ?>
		   <?php foreach($page_data[$key] as $k=>$val){
					foreach($val as $t_k=>$t_v){
																?>
				  <tr>
					
					<td width="10%" align="center"><?php echo $t_k;?></td>
					<td width="8%" align="center"><?php echo $t_v['name'];?></td>
					<td width="8%" align="center"><?php echo $t_v['th006'];?></td>
					<td width="4%" align="center"><?php echo $t_v['th009'];?></td>
					<?php
					$item_totle_money = 0;
					for($i=0;$i<$month_count;$i++){?>
						<td width="3%" align="right">
							<?php						//處理各年月的銷售額
							if($str_m+$i<=12){
								$temp = $str_m+$i;
								if($temp<10) $temp = "0".$temp;
								if(!@$t_v['record'][$current_year.$temp]){
									$t_v['record'][$current_year.$temp] = 0;
									echo $t_v['record'][$current_year.$temp];
								}else{
									echo $t_v['record'][$current_year.$temp];
									$item_totle_money = $item_totle_money+$t_v['record'][$current_year.$temp];
								}
								if(!@$month_account[$current_year.$temp]) $month_account[$current_year.$temp] = 0;
								$month_account[$current_year.$temp] = $month_account[$current_year.$temp]+$t_v['record'][$current_year.$temp];
							}else{
								$temp = $str_m+$i-12;
								if($temp<10) $temp = "0".$temp;
								if(!@$t_v['record'][($current_year+1).$temp]){
									$t_v['record'][($current_year+1).$temp] = 0;
									echo $t_v['record'][($current_year+1).$temp];
								}else{
									echo $t_v['record'][($current_year+1).$temp];
									$item_totle_money = $item_totle_money+$t_v['record'][($current_year+1).$temp];
								}
								if(!@$month_account[($current_year+1).$temp]) $month_account[($current_year+1).$temp] = 0;
								$month_account[($current_year+1).$temp] = $month_account[($current_year+1).$temp]+$t_v['record'][($current_year+1).$temp];
							}
							?>
						</td>
					<?php
					}?>
					<td width="3%" align="right"><?php echo $item_totle_money;$totle_money = $totle_money+$item_totle_money;?></td>
				  </tr>		
					<?php }$rownum++;$rownum1++; ?>
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=16 ) ) { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					 
					  <?php for($j=0;$j<$month_count;$j++){?>
					  <td align="right"><b>&nbsp;</b></td>
					  <?php }?>
					  <td align="right"><b>&nbsp;</b></td>
					</tr>					 
					<?php } ?> <?php } ?> 
					<?php  } ?>
		
		   	<?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=16 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					 
					  <?php for($j=0;$j<$month_count;$j++){?>
					  <td align="right"><b>&nbsp;</b></td>
					  <?php }?>
					  <td align="right"><b>&nbsp;</b></td>
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=16 ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
					 <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					
					  <?php for($j=0;$j<$month_count;$j++){?>
					  <td align="right"><b>&nbsp;</b></td>
					  <?php }?>
					  <td align="right"><b>&nbsp;</b></td>				 
					</tr>
					<?php } ?> <?php } ?>
					<tr>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
					  <td align="left"><b>&nbsp;</b></td>
				      <td align="right"><b>&nbsp;</b></td>
					 
					  <?php for($k=0;$k<$month_count;$k++){?>
				      <td align="right">
						<?php						//處理各年月的銷售額
							if($str_m+$k<=12){
								$temp = $str_m+$k;
								if($temp<10) $temp = "0".$temp;
								echo $month_account[$current_year.$temp];
							}else{
								$temp = $str_m+$k-12;
								if($temp<10) $temp = "0".$temp;
								echo $month_account[($current_year+1).$temp];
							}
							?>
					  </td>
					  <?php }?>
				      <td align="right"><?php if ($tprint=='Y') { echo $totle_money;} ?>  <?php echo '';?></td>
					</tr>
	                <tr style="display:none;">
					  <td colspan="<?php echo 5+$month_count;?>" align="left">
						<?php if ($totle_page == $page  ) { ?>
						<b>選取商品之數量：</b> <?php if ($tprint=='Y') { echo $num_results;} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span style="float:right;"><b>合計數量：</b> <?php if ($tprint=='Y') { echo $totle_money;} ?>  <?php echo '';} ?></span>
						<?php if ($totle_page > $page ) { ?>
						<b>商品數量：</b> <?php if ($tprint=='Y') { echo '';} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b>合計數量：</b> <?php if ($tprint=='Y') { echo '　　　　　　';} ?>  <?php echo '續下頁..';} ?> 
						
					  </td>
					</tr>
	        </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 