<div class="box2" style="height:95%"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產資料建立作業 - 瀏覽</h1>
      <a onclick="location = '<?php echo base_url()?>index.php/ast/asti02/clear_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
	</div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name'=>"mb001",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'mb001' => array('sort_name'=>"mb001",'name'=>"資產編號",'width'=>"",'align'=>"left"),
		'mb002' => array('sort_name'=>"mb002",'name'=>"資產名稱",'width'=>"",'align'=>"left"),
		'mb003' => array('sort_name'=>"mb003",'name'=>"資產規格",'width'=>"",'align'=>"left"),
		'select' => array('sort_name'=>"",'name'=>"",'width'=>"",'align'=>"center")
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
				echo anchor("ast/asti02/display_child1/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("ast/asti02/display_child1/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
        </tr>
        </thead>
<?php 
/* filter欄位設定區域 */
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'mb001' => array('filter_name'=>"mb001",'name'=>"資產編號",'size'=>"8",'align'=>"left"),
		'mb002' => array('filter_name'=>"mb002",'name'=>"資產名稱",'size'=>"12",'align'=>"left"),
		'mb003' => array('filter_name'=>"mb003",'name'=>"資產規格",'size'=>"12",'align'=>"left")
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
			<td  align="center"><a onclick="filter();" class="button">篩選 <img src="<?php echo base_url()?>assets/image/png/find.png" /></a></td>
	    <!-- <button type='submit' name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
      </tr>
		<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mq002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->mb001;?></td>
		  <input id='mb001_<?php echo $chkval?>' value='<?php echo $row->mb001;?>' style='display:none;' />
		  <td class="left"><?php echo $row->mb002;?></td>
		  <input id='mb002_<?php echo $chkval?>' value='<?php echo $row->mb002;?>' style='display:none;' />
		  <td class="left"><?php echo $row->mb003;?></td>
		  <input id='mb003_<?php echo $chkval?>' value='<?php echo $row->mb003;?>' style='display:none;' />

		<!--  <td class="center"><a href="javascript:send_back_asti02('<?php echo $row->mq001;?>','<?php echo $row->mq002;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td> -->
		   <td class="center"><a href="javascript:send_back_asti02a('<?php echo $row->mb001;?>','<?php echo $row->mb002;?>','<?php echo $row->mb003;?>','<?php echo $row->mb011;?>','<?php echo $row->mb012;?>','<?php echo $row->mb020;?>','<?php echo $row->mb021;?>','<?php echo $row->mb029;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/ok.png" />]</td>
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

function send_back_asti02a(mb001, mb002, mb003, mb011, mb012, mb020, mb021, mb029){
	
	window.parent.$.unblockUI();
	if(window.parent.addasti02adisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addasti02adisp(mb001,mb002,mb003,mb011,mb012,mb020,mb021,mb029);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
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
	url = '<?php echo base_url() ?>index.php/ast/asti02/display_child1/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>