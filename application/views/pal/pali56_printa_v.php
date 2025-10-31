<?php 
//echo "<pre>";var_dump($results);exit;
//echo $slice_func;
$data = array();//先分裝組別
if($slice_func==2){
	foreach($results as $key => $val){
		foreach($val as $k => $v){	
			$data[$v->mv002][$key] = $v;
		}
	}
}
else{
	$data = $results;
}
$num_each_page = 36;$total_page = 0;$num_count=0;
$page_data = array();
foreach($data as $key => $val){
	foreach($val as $k => $v){
		if($num_count%$num_each_page==0){
			$total_page++;
		}
		$page_data[$total_page][] = $v;
		$num_count++;
	}$total_page++;$num_count=0;
}
?>
<?php
	foreach($page_data as $d_key => $val){
?>
	<table class="store">
	    <tr>
			<td align="left" width="40%"></td>
			<td align="center" width="20%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="40%"></td>
	    </tr>
		<tr>
			<td align="left" width="40%">查詢員編區間:&nbsp;<?php echo $epyo;echo "~";echo $epyc;?><br>
			查詢日期區間:&nbsp;<?php echo substr($dateo,0,4).'/'.substr($dateo,4,2).'/'.substr($dateo,6,2)."~".substr($datec,0,4).'/'.substr($datec,4,2).'/'.substr($datec,6,2);?>
			</td>
			<td align="center" width="20%">出勤資料表</td>
			<td align="right" width="40%">頁次:&nbsp;<?php echo $d_key .'/'.$total_page; ?> 
			<br>製表日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">部門名稱</td>
		<td width="8%" align="left">刷卡日期</td>
		<td width="8%" align="left">員工代號</td>
	    <td width="9%" align="left">員工姓名</td>
	    <td width="30%" align="left">刷卡時間</td>
	    <td width="20%" align="left">狀態</td>
      </tr>
	<?php foreach($val as $key => $row){ ?>
	  <tr>
		<td width="8%" class="left"><?php echo $row->me002;?></td>
		<td width="8%" class="left"><?php echo substr($row->te002,0,4).'/'.substr($row->te002,4,2).'/'.substr($row->te002,6,2);?></td>
		<td width="8%" class="left"><?php if($row->te001){echo $row->te001;}else{echo $row->te004;}?></td>
		<td width="8%" class="left"><?php echo $row->mv002;?></td>
		<td width="30%" class="left" id="td_<?php echo $row->te002."_".$row->te001; ?>" >
			<?php if(@$row->te003){
					foreach($row->te003 as $k => $v){
						$div_str = "<div ";					//Start
						
						$div_str .= "class='time_".$row->te002."_".$row->te001."' ";//加入前墜
						$div_str .= "style='float:left;margin:2px; '";
						$div_str .= "id='div_".$row->te002."_".$row->te001."_".$v."' ";
						$div_str .= " >";
						
						$div_str .= "<span ";				//Start
						$div_str .= "class='span_".$row->te002."_".$row->te001."_".$v."'";//加入前墜
						$div_str .= "style='float:left;' ";
						$div_str .= "id='disp_".$row->te002."_".$row->te001."_".$v."'";
						$div_str .= " >";
						$div_str .= $v;
						$div_str .= "</span>";				//結尾
						
						$div_str .= "</div>";				//結尾
						echo $div_str;
					}
				}?>
		  </td>
		  <td width="20%" class="left">
			<?php foreach($row->status as $status_key => $status_val){
					if($status_key == "error"){
						echo "<font color='red'>".$status_val."</font> ";
					}
					if($status_key == "late"){
						echo "<font color='gray'>".$status_val."</font> ";
					}
					if($status_key == "absenteeism"){
						echo "<font color='orange'>".$status_val."</font> ";
					}
					if($status_key == "leave"){
						echo "<font color='blue'>".$status_val."</font> ";
					}
				}
		?>
		</td>
      </tr>
	<?php } ?>
	</table>
	<div style="page-break-before: always;"></div>
<?php	
	}
?>
