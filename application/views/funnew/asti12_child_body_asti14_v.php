<div class="box2" style="height:95%"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產移轉建立作業 - 瀏覽</h1>
      <a id="go_clear_sql" onclick=""  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
	</div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name'=>"tf001",'name'=>"序號",'width'=>"8%",'align'=>"left",'use'=>"disable"),
		'tf001' => array('sort_name'=>"tf001",'name'=>"單別",'width'=>"8%",'align'=>"left"),
		'tf002' => array('sort_name'=>"tf002",'name'=>"單號",'width'=>"8%",'align'=>"left"),
		'te008' => array('sort_name'=>"te008",'name'=>"日期",'width'=>"8%",'align'=>"left"),
		'tf003' => array('sort_name'=>"tf003",'name'=>"資產編號",'width'=>"8%",'align'=>"left"),
	//	'tf004' => array('sort_name'=>"tf004",'name'=>"部門代號",'width'=>"8%",'align'=>"left"),
		'tf005' => array('sort_name'=>"tf005",'name'=>"保管人",'width'=>"8%",'align'=>"left"),
		'tf006' => array('sort_name'=>"tf006",'name'=>"外送數量",'width'=>"8%",'align'=>"left"),
		'tf008' => array('sort_name'=>"tf008",'name'=>"收回數量",'width'=>"8%",'align'=>"left"),
		'select' => array('sort_name'=>"",'name'=>"",'width'=>"8%",'align'=>"center")
	);
?>
	
  <div class="content"> <!-- div-2 -->
    <form method="post" enctype="multipart/form-data" id="form">
        <table class="list"> <!-- 表格開始 -->
        <thead>
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
				echo anchor("ast/asti12/display_child_body_asti14/".$this->uri->segment(4,0)."/".$this->uri->segment(5,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("ast/asti12/display_child_body_asti14/".$this->uri->segment(4,0)."/".$this->uri->segment(5,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
        </tr>
        </thead>
<?php 
/* filter欄位設定區域 */
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"8",'align'=>"left",'use'=>"disable"),
		'tf001' => array('filter_name'=>"tf001",'name'=>"單別",'size'=>"8",'align'=>"left"),
		'tf002' => array('filter_name'=>"tf002",'name'=>"單號",'size'=>"8",'align'=>"left"),
		'te008' => array('filter_name'=>"te008",'name'=>"日期",'size'=>"8",'align'=>"left"),
		'tf003' => array('filter_name'=>"tf003",'name'=>"資產編號",'size'=>"9",'align'=>"left"),
		//'tf004' => array('filter_name'=>"tf004",'name'=>"部門代號",'size'=>"9",'align'=>"left"),
		'tf005' => array('filter_name'=>"tf005",'name'=>"保管人",'size'=>"8",'align'=>"left"),
		'tf006' => array('filter_name'=>"tf006",'name'=>"外送數量",'size'=>"9",'align'=>"left"),
		'tf008' => array('filter_name'=>"tf008",'name'=>"收回數量",'size'=>"9",'align'=>"left")
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
	    <!-- <button type='submit' name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
      </tr>
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('tf001'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
		
		<script>
		//宣告clear_sql回傳值(只有在單身有引用條件下)
		$(document).ready(function(){
			var temp_location = <?php echo $row->tf001; ?>;
			$('#go_clear_sql').attr('onclick','location='+"\'"+'<?php echo base_url()?>index.php/ast/asti12/clear_body_sql_asti14/'+temp_location+"/'");
		});
		</script>
        
		<tr onclick="parent.addasti12_asti14_body('<?php echo $row->tf001;?>','<?php echo $row->tf002;?>','<?php echo $row->tf003;?>','<?php echo $row->mb002;?>','<?php echo $row->mb003;?>','<?php echo $row->tf004;?>','<?php echo $row->me002;?>','<?php echo $row->tf005;?>','<?php echo $row->mv002;?>','<?php echo $row->tf006;?>','<?php echo $row->tf008;?>');parent.$.unblockUI();" >
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->tf001;?></td>
		  <input id='tf001_<?php echo $chkval?>' value='<?php echo $row->tf001;?>' style='display:none;' />
		  <td class="left"><?php echo $row->tf002;?></td>
		  <input id='tf002_<?php echo $chkval?>' value='<?php echo $row->tf002;?>' style='display:none;' />
		  <td class="left"><?php echo $row->te008;?></td>
		  <input id='te008_<?php echo $chkval?>' value='<?php echo $row->te008;?>' style='display:none;' />
		  <td class="left"><?php echo $row->tf003;?></td>
		  <input id='tf003_<?php echo $chkval?>' value='<?php echo $row->tf003;?>' style='display:none;' />
	<!--	  <td class="left"><?php echo $row->tf004;?></td>
		  <input id='tf004_<?php echo $chkval?>' value='<?php echo $row->tf004;?>' style='display:none;' /> -->
	 	  <td class="left"><?php echo $row->tf005;?></td>
		  <input id='tf005_<?php echo $chkval?>' value='<?php echo $row->tf005;?>' style='display:none;' />
		  <td class="left"><?php echo $row->tf006;?></td>
		  <input id='tf006_<?php echo $chkval?>' value='<?php echo $row->tf006;?>' style='display:none;' />
		  <td class="left"><?php echo $row->tf008;?></td>
		  <input id='tf008_<?php echo $chkval?>' value='<?php echo $row->tf008;?>' style='display:none;' />		  
		  
		  <input id='smb002' value='<?php echo $row->tf001;?>' style='display:none;' />
		<!--  <td class="center"><a href="javascript:send_back_cmsi09('<?php echo $row->tf001;?>','<?php echo $row->tf002;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td> -->
		   <td class="center"><a href="javascript:send_back_asti12_asti14('<?php echo $row->tf001;?>','<?php echo $row->tf002;?>','<?php echo $row->tf003;?>','<?php echo $row->mb002;?>','<?php echo $row->mb003;?>','<?php echo $row->tf004;?>','<?php echo $row->me002;?>','<?php echo $row->tf005;?>','<?php echo $row->mv002;?>','<?php echo $row->tf006;?>','<?php echo $row->tf008;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
		</tr>
		<?php $chkval += 1; ?>
		<?php endforeach;?>
        </tbody>		 
        </table>
		<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料. ] '.'&nbsp&nbsp&nbsp&nbsp&nbsp 總數:'.ceil(($curpage+1)/$limit).'/'.ceil($page).' 頁, '.$numrow.' 筆'.'&nbsp&nbsp&nbsp&nbsp&nbsp　　　　　' ?> </div>	
	
	</form>
	
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});

function send_back_asti12_asti14(tf001, tf002, tf003, mb002, mb003, tf004, me002, tf005, mv002, tf006, tf008){
	window.parent.$.unblockUI();
	if(window.parent.addasti12_asti14_body){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
	  
		window.parent.addasti12_asti14_body(tf001, tf002, tf003, mb002, mb003, tf004, me002, tf005, mv002, tf006, tf008);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/ast/asti12/clear_body_sql_asti14"
		});
	}
}
//改寫function filter 為and搜尋
function filter() {
	var where_str = "";
	var key = "";
	var val = "";
	$('.filter_ipt').each(function(){
		//$( this ).id()
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

	url = '<?php echo base_url() ?>index.php/ast/asti12/display_child_body_asti14/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>