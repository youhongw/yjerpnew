<script type="text/javascript"> 	
//查詢銀行代號開視窗noti01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Shownoti01disp").click(function() {
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
		message: $('#divFnoti01'),
		onOverlayClick: clear_noti01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#noti01').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#noti01').val();
			$('#noti01').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/not/noti01/lookup1_noti01/'+encodeURIComponent(smb001), 
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
				$('#noti01').val(ui.item.value1);
				$('#noti01disp').val(ui.item.value2);
				$('#noti01disp3').val(ui.item.value3);
				console.log('test8');
				return false;
			}else{
				$('#noti01disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#noti01').attr('onchange','check_noti01(this)');
			check_noti01($('#noti01').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addnoti01disp(smb001,smb002){
	//alert('test2');
	$('#noti01').val(smb001);
	$('#noti01disp').text(smb002);
	$('#noti01').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti01/clear_sql"
	});
}
function clear_noti01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti01/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_noti01(row_obj){
	var smb001= $('#noti01').val();
	if(!smb001){$('#noti01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti01/lookup2_noti01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#noti01').val("");
					$('#noti01disp').text("查無資料");
				}
				$('#noti01').val(smb001);
				$('#noti01disp').text(data.message[0].value2);
				console.log('test9');
			}else{
				$('#noti01').val(smb001);
				$('#noti01disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFnoti01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

