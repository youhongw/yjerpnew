<div class="box2" style="height:95%"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號類別建立作業 - 瀏覽</h1>
      <a onclick="location = '<?php echo base_url()?>index.php/inv/invi01/clear_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>
	</div>
<?php 
/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name'=>"ma001",'name'=>"序號",'width'=>"",'align'=>"left",'use'=>"disable"),
		'ma002' => array('sort_name'=>"ma002",'name'=>"類別代號",'width'=>"",'align'=>"left"),
		'ma003' => array('sort_name'=>"ma003",'name'=>"類別名稱",'width'=>"",'align'=>"left"),
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
				echo anchor("inv/invi01/displayd_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." asc",$str);
				
				$str = "<img src='".base_url()."assets/image/desc.png' />";
				echo anchor("inv/invi01/displayd_child/".$this->uri->segment(4,0)."/order?val=".$val['sort_name']." desc",$str);
				
				echo "</td>";
			}
		  ?>
        </tr>
        </thead>
<?php 
/* filter欄位設定區域 */
	$filter_array = array(
		'rowid' => array('filter_name'=>"",'name'=>"序號",'size'=>"12",'align'=>"left",'use'=>"disable"),
		'ma002' => array('filter_name'=>"ma002",'name'=>"類別代號",'size'=>"8",'align'=>"left"),
		'ma003' => array('filter_name'=>"ma003",'name'=>"類別名稱",'size'=>"12",'align'=>"left")
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
		<?php $this->session->unset_userdata('ma002'); ?> -->
	    <?php $chkval=1; ?>               
	    <?php foreach($results as $row ) : ?>
        <tr>
          <td class="left"><?php echo $chkval;?></td>
		  <td class="left"><?php echo $row->ma002;?></td>
		  <input id='ma002_<?php echo $chkval?>' value='<?php echo $row->ma002;?>' style='display:none;' />
		  <td class="left"><?php echo $row->ma003;?></td>
		  <input id='ma003_<?php echo $chkval?>' value='<?php echo $row->ma003;?>' style='display:none;' />
		<!--  <td class="center"><a href="javascript:send_back_invi01('<?php echo $row->ma001;?>','<?php echo $row->ma002;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td> -->
		   <td class="center"><a href="javascript:send_back_invi01d('<?php echo $row->ma002;?>','<?php echo $row->ma003;?>');">[ 選擇</a><img src="<?php echo base_url()?>assets/image/png/eye.png" />]</td>
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

function send_back_invi01d(ma002, ma003){
	
	window.parent.$.unblockUI();
	if(window.parent.addinvi01ddisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addinvi01ddisp(ma002,ma003);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
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
	url = '<?php echo base_url() ?>index.php/inv/invi01/displayd_child/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script>