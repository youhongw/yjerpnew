<div class="box2" style="height:95%"> <!-- div-1 -->
<div id="content" style="min-width: 0px;">  <!-- div-3 -->
 <div class="box">  <!-- div-4 --> 
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 人事行事曆維護作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 --> 
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali29/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>--> 
	<div id="tab-general">  <!-- div-6 --> 
	<?php 
	if($result){
		foreach($result as $row) {
			foreach($row as $key => $val){
				$$key = $val;
			}
		}
	?>
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td class="normal14" width="10%"><span class="required">人事：</span> </td>
        <td class="normal14" width="40%">
		<input tabIndex="1" id="mt001" onKeyPress="keyFunction()" name="mt001" size="3" value="<?php echo $mt001; ?>" type="text" readonly="readonly" required />
		<span id="Showmt001disp" ></span>
		<span id="mt001disp" ><?php echo $mt001disp; ?></span>
		</td>
	    <td class="normal14" width="10%">員工：</td>
		<td class="normal14" width="40%">
		<input tabIndex="2" id="mt002" onKeyPress="keyFuncti on()" name="mt002" size="6" value="<?php echo $mt002; ?>" readonly="readonly" />
		<span style="display:none;"><img id="Showmt002disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></span>
		<span id="mt002disp"><?php echo $mt002disp; ?></span>
		</td>
	  </tr>
	  <tr>
	    <td class="normal14" >日期：</td>
		<td class="normal14" >
		<input tabIndex="3" id="mt003" onKeyPress="keyFunction()" name="mt003" onchange="dateformat_ymd(this)" value="<?php echo stringtodate("Y/m/d",$mt003); ?>" readonly="readonly" /></td>
	    <td class="normal14" >星期：</td>
		<td class="normal14" >
		<input tabIndex="4" id="mt004" onKeyPress="keyFunction()" name="mt004" size="2" value="<?php echo $mt004; ?>" readonly="readonly" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >事件名稱：</td>
		<td class="normal14" >
		<input tabIndex="5" id="mt006" onKeyPress="keyFunction()" name="mt006" value="<?php echo $mt006; ?>" /></td>
	    <td class="normal14" >狀態：</td>
		<td class="normal14" >
		<select tabIndex="6" id="mt005" onKeyPress="keyFunction()" name="mt005" value="<?php echo $mt005; ?>" >
			<option <?php if($mt005=="N"){echo "selected='selected'";} ?> value="N" >N:正常上班</option>
			<!--<option <?php if($mt005=="H"){echo "selected='selected'";} ?> value="H" >H:半天班</option>-->
			<option <?php if($mt005=="L"){echo "selected='selected'";} ?> value="L" >L:休假</option>
		</select>
		</td>
	  </tr>
	  <tr>
	    <td class="normal14" >事件內容：</td>
		<td class="normal14" colspan="3" >
			<textarea tabIndex="7" id="mt007" onKeyPress="keyFunction()" name="mt007" style="width:70%;height:200px;" ><?php echo $mt007; ?></textarea>
		</td>
	  </tr>
    </table>
	<div class="buttons">
	   <button type='submit' accesskey="s" name="submit" class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="javascript:parent.$.unblockUI();" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	<?php 
	}
	?>
	
    </form>
    </div>  <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>     <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>
</div>  <!-- div-1 -->
<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});
function send_back(md001, md002){
	window.parent.$.unblockUI();
	if(window.parent.addtc005disp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addtc005disp(md001,md002);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
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
	url = '<?php echo base_url() ?>index.php/cms/cmsi04/display_child/0/and_where?key=' + encodeURIComponent(key) + 
	'&val=' + encodeURIComponent(val);
	location = url;
}
</script> 
<script>
//查詢廠商視窗
/*$(document).ready(function(){
	$("#Showmt001disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri01'),
		onOverlayClick: clear_mt001disp_sql
	});
	});
    $('#mt001').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#mt001').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri01/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#mt001').val(ui.item.value1);
				$('#mt001disp').text(ui.item.value2);
				console.log($('#mt001').val());
				return false;
			}else{
				$('#mt001disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmt001disp(ma001,ma002){
	$('#mt001').val(ma001);
	$('#mt001disp').text(ma002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function clear_mt001disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function check_mt001(row_obj){
	var smb001= $('#mt001').val();
	if(!smb001){$('#mt001disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ma001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#mt001').val("");
					$('#mt001disp').text("查無資料");
				}
				$('#mt001').val(data.message[0].value1);
				$('#mt001disp').text(data.message[0].value2);
			}else{
				$('#mt001').val("");
				$('#mt001disp').text("查無資料");
			}
		}
	});
}*/
</script>	   
<div id="divFpuri01" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pur/puri01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
<script>
//查詢人員視窗
$(document).ready(function(){
	$("#Showmt002disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpali01'),
		onOverlayClick: clear_mt002disp_sql
	});
	});
    $('#mt002').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#mt002').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/pal/pali01/lookup_pali01/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#mt002').val(ui.item.value1);
				$('#mt002disp').text(ui.item.value2);
				console.log($('#mt002').val());
				return false;
			}else{
				$('#mt002disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addmt002disp(ma001,ma002){
	$('#mt002').val(ma001);
	$('#mt002disp').text(ma002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pal/pali01/clear_sql"
	});
}
function clear_mt002disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pal/pali01/clear_sql"
	});
}
function check_mt002(row_obj){
	var smb001= $('#mt002').val();
	if(!smb001){$('#mt002disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_pali01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ma001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#mt002').val("");
					$('#mt002disp').text("查無資料");
				}
				$('#mt002').val(data.message[0].value1);
				$('#mt002disp').text(data.message[0].value2);
			}else{
				$('#mt002').val("");
				$('#mt002disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFpali01" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pal/pali01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>