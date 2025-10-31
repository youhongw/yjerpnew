<div class="box2" style="height:95%"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 途程品號建立作業 - 瀏覽</h1>
      <a onclick="location = '<?php echo base_url()?>index.php/bom/bomi07/clear_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
	</div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name'=>"mf001",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'mf001' => array('sort_name'=>"mf001",'name'=>"途程品號",'width'=>"",'align'=>"left"),
		'mb002' => array('sort_name'=>"mb002",'name'=>"途程名稱",'width'=>"",'align'=>"left"),
		'mb003' => array('sort_name'=>"mb003",'name'=>"途程規格",'width'=>"",'align'=>"left"),
		'mf002' => array('sort_name'=>"mf002",'name'=>"途程代號",'width'=>"",'align'=>"left"),
		'me003' => array('sort_name'=>"me003",'name'=>"途程名稱",'width'=>"",'align'=>"left"),
		'select' => array('sort_name'=>"",'name'=>"",'width'=>"",'align'=>"center")
	);
?>
	
  <div class="content"> <!-- div-2 -->
    <form method="post" enctype="multipart/form-data" id="form">
        <table class="list"> <!-- 表格開始 -->
        <thead>              <!-- 群組表頭 -->
          <tr>
		  <?php
			foreach($title_array as $key => $val){
				echo "<td width='".$val['width']."' class='".$val['align']."'>";
				echo $val['name'];
				if(isset($val['use'])){
					if($val['use'] == "disable"){
						echo "</td>";continue;
					}
				}
				if($val['sort_name'] == ""){
					echo "</td>";continue;
				}
				
				$str = "<img src='".base_url()."assets/image/asc.png' />";
				echo anchor("bom/bomi07/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("bom/bomi07/display_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
        </tr>
        </thead>
<?php 
/* filter欄位設定區域 */
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'mf001' => array('filter_name'=>"mf001",'name'=>"品號",'size'=>"8",'align'=>"left"),
		'mb002' => array('filter_name'=>"mb002",'name'=>"品名",'size'=>"12",'align'=>"left"),
		'mb003' => array('filter_name'=>"mb003",'name'=>"規格",'size'=>"12",'align'=>"left"),
		'mf002' => array('filter_name'=>"mf002",'name'=>"途程代號",'size'=>"12",'align'=>"left"),
		'me003' => array('filter_name'=>"me003",'name'=>"途程名稱",'size'=>"12",'align'=>"left")
	);
?>
		  
        <tbody> <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
	     <tr class="filter">
			<?php
			foreach($filter_array as $key => $val){
				echo "<td class='".$val['align']."'>";
				if($val['filter_name']==""){echo "</td>";continue;}//filter_name = "" 為沒有使用
				
				echo "<div class='button-search'></div>";
				$ipt_str = "";
				$ipt_str .= "<input type='text' id='".$val['filter_name']."' name='".$val['filter_name']."' class='filter_ipt' ";
				if(isset($val['size'])){$ipt_str .= "size='".$val['size']."' ";}
				if(isset($val['value'])){$ipt_str .= "value='".$val['value']."' ";}
				if(isset($val['color'])){$ipt_str .= "style='background-color:".$val['color'].";' ";}
				$ipt_str .= "/>";
				echo $ipt_str;
				echo "</td>";
			}
			?>
			<td  align="center"><a onclick="filter();" class="button">篩選</a></td>
      </tr>
		
	    <?php $chkval=1;$temp1=""; ?>               
	    <?php foreach($results as $row ) : ?>
         <tr onclick="parent.addbomi07disp('<?php echo $row->mf001;?>','<?php echo str_replace('"','!',$row->mb002);?>','<?php echo str_replace('"','!',$row->mb003);?>','<?php echo $row->mf002;?>','<?php echo $row->me003;?>');parent.$.unblockUI();" >
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->mf001;?></td>
		  <input id='mf001_<?php echo $chkval?>' value='<?php echo $row->mf001;?>' style='display:none;' />
		  <td class="left"><?php echo $row->mb002;?></td>
		  <input id='mb002_<?php echo $chkval?>' value='<?php echo $row->mb002;?>' style='display:none;' />
		   <td class="left"><?php echo $row->mb003;?></td>
		   <!-- 處理特殊字元 5吋""    先以 !取代父表再取代吋
		   <?php // preg_match_all('/\d/S',$row->mb003, $matches);?>  
		   <?php//  $temp1 = implode('',$matches[0]);?>   -->
		    <?php    $temp1=str_replace('"','',$row->mb003) ?>  
		  <input id='mb003_<?php echo $chkval?>' value='<?php echo $row->mb003;?>' style='display:none;' />
		  <td class="left"><?php echo $row->mf002;?></td>
		  <input id='mf002_<?php echo $chkval?>' value='<?php echo $row->mf002;?>' style='display:none;' />
		  <td class="left"><?php echo $row->me003;?></td>
		  <input id='me003_<?php echo $chkval?>' value='<?php echo $row->me003;?>' style='display:none;' />   <!--replaceSepcialSymbol($temp, $sArray)  -->
		<!--  <td class="center"><a href="javascript:send_back_bomi07('<?php echo $row->md001;?>','<?php echo $row->md002;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td> -->
		   <td class="center"><a href="javascript:send_back_bomi07('<?php echo $row->mf001;?>','<?php echo str_replace('"','!',$row->mb002);?>','<?php echo str_replace('"','!',$row->mb003);?>','<?php echo $row->mf002;?>','<?php echo $row->me003;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>		 
        </table>
		<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆' ?> </div>	
	</form>
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function send_back_bomi07(mc001, mc002, mc003, mc004, mc005){
	window.parent.$.unblockUI();
	if(window.parent.addbomi07disp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addbomi07disp(mc001,mc002,mc003,mc004,mc005);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/bom/bomi07/clear_sql"
		});
	}
}
//改寫function filter 為and搜尋
function filter() {
	var where_str = "";
	var key = "";
	var val = "";
	$('.filter_ipt').each(function(){
		if($( this ).val()){
			if(key != ""){
				key += ",";
			}
			key += this.id;
			if(val != ""){
				val += ",";
			}
			val += $( this ).val();
			
		}
	});
	url = '<?php echo base_url() ?>index.php/bom/bomi07/display_child/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}

</script>