<div class="box2" style="height:95%"> <!-- div-1 -->
<div id="content" style="min-width: 0px;">  <!-- div-3 -->
 <div class="box">  <!-- div-4 --> 
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 人事行事曆維護作業 - 新增</h1>
    </div>
	
    <div class="content">  <!-- div-5 --> 
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali29/addsave" method="post" enctype="multipart/form-data" >
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
		<input tabIndex="1" id="mt001" onKeyPress="keyFunction()" name="mt001" size="3" value="<?php echo (isset($mt001)) ? $mt001 : ""; ?>" onchange="check_mt001();" type="text" required />
		<span ><img id="Showmt001disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></span>
		<span id="mt001disp" ><?php echo (isset($mt001disp)) ? $mt001disp : ""; ?></span>
		</td>
	    <td class="normal14" width="10%">員工：</td>
		<td class="normal14" width="40%">
		<input tabIndex="2" id="mt002" onKeyPress="keyFuncti on()" name="mt002" size="6" value="" onchange="check_mt002();" />
		<span ><img id="Showmt002disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></span>
		<span id="mt002disp"></span>
		</td>
	  </tr>
	  <tr>
	    <td class="normal14" >日期：</td>
		<td class="normal14" >
		<input tabIndex="3" id="mt003" onKeyPress="keyFunction()" name="mt003" onchange="dateformat_ymd(this);check_mt004();" value="<?php echo (isset($mt003)) ? stringtodate("Y/m/d",$mt003) : ""; ?>" /></td>
	    <td class="normal14" >星期：</td>
		<td class="normal14" >
		<input tabIndex="4" id="mt004" onKeyPress="keyFunction()" name="mt004" size="2" value="<?php echo (isset($mt004)) ? $mt004 : ""; ?>" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >事件名稱：</td>
		<td class="normal14" >
		<input tabIndex="5" id="mt006" onKeyPress="keyFunction()" name="mt006" value=""  /></td>
	    <td class="normal14" >新加班星期：</td>
		<td class="normal14" >
		<select tabIndex="6" id="mt008" onKeyPress="keyFunction()" name="mt008" value="" >
		    <option value="0" >0:星期日</option>
			<option value="1" >1:星期一</option>
			<option value="2" >2:星期二</option>
			<option value="3" >3:星期三</option>
			<option value="4" >4:星期四</option>
			<option value="5" >5:星期五</option>
			<option value="6" >6:星期六</option>
		</select>
		</td>
	  </tr>
	  <tr>
	   
	    <td class="normal14" >狀態：</td>
		<td class="normal14" >
		<select tabIndex="6" id="mt005" onKeyPress="keyFunction()" name="mt005" value="<?php echo $mt005; ?>" >
			<option <?php if($mt005=="N"){echo "selected='selected'";} ?> value="N" >N:正常上班</option>
			<!--<option <?php if($mt005=="H"){echo "selected='selected'";} ?> value="H" >H:半天班</option>-->
			<option <?php if($mt005=="L"){echo "selected='selected'";} ?> value="L" >L:休假</option>
		</select>
		</td>
		 <td class="normal14" ></td>
		<td class="normal14" ></td>
	  </tr>
	  <tr>
	    <td class="normal14" >事件內容：</td>
		<td class="normal14" colspan="3" >
			<textarea tabIndex="7" id="mt007" onKeyPress="keyFunction()" name="mt007" style="width:70%;height:200px;" ></textarea>
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
<!-- 不更新網頁 自動提示方框資料前置小工具 --> 
<script type="text/javascript"><!--       
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');	
				currentCategory = item.category;
			}
			self._renderItem(ul, item);
		});
	}
});
//--></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.button-search').bind('click', function() {
	    return true;
	});
});
</script>

<script>
//查詢人事視窗
$(document).ready(function(){
	$("#Showmt001disp").click(function() {
	$.blockUI({
		css: {
			top: '10%',
			left: '10%',
			height: '80%',
			width: '80%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpali16'),
		onOverlayClick: clear_mt001disp_sql
	});
	});
});
function addmt001disp(mo001,mo002){
	$('#mt001').val(mo001);
	$('#mt001disp').text(mo002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pal/pali16/clear_sql"
	});
}
function clear_mt001disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pal/pali16/clear_sql"
	});
}
function check_mt001(){
	var smb001= $('#mt001').val();
	if(!smb001){$('#mt001disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/pal/pali29/lookup_pali16/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {},
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
}
</script>	   
<div id="divFpali16" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pal/pali16/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢人員視窗
$(document).ready(function(){
	$("#Showmt002disp").click(function() {
	$.blockUI({
		css: {
			top: '10%',
			left: '10%',
			height: '80%',
			width: '80%',
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
    /* 取消註解即可使用  但會有版面上的問題
	$('#mt002').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#mt002').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/pal/pali29/lookup_pali01/'+encodeURIComponent(smb001), 
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
	*/
});
function addmt002disp(mv001,mv002){
	$('#mt002').val(mv001);
	$('#mt002disp').text(mv002);
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
function check_mt002(){
	var smb001= $('#mt002').val();
	if(!smb001){$('#mt002disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/pal/pali29/lookup_pali01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {},
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