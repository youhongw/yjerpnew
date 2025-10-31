<script type="text/javascript"> 	
//查詢銀行代號開視窗noti13 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Shownoti13disp").click(function() {
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
		message: $('#divFnoti13'),
		onOverlayClick: clear_noti13disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#noti13').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#noti13').val();
			$('#noti13').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/not/noti13/lookup1_noti13/'+encodeURIComponent(smb001), 
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
				$('#noti13').val(ui.item.value1);
				$('#noti13disp').text(ui.item.value2);
				//console.log($('#noti13').val());
				return false;
			}else{
				$('#noti13disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#noti13').attr('onchange','check_noti13(this)');
			check_noti13($('#noti13').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addnoti13disp(smb001,smb002){
	//alert('test2');
	$('#noti13').val(smb001);
	$('#noti13disp').text(smb002);
	$('#noti13').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti13/clear_sql"
	});
}
function clear_noti13disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti13/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_noti13(row_obj){
	var smb001= $('#noti13').val();
	if(!smb001){$('#noti13disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti13/lookup2_noti13/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#noti13').val("");
					$('#noti13disp').text("查無資料");
				}
				$('#noti13').val(smb001);
				$('#noti13disp').text(data.message[0].value2);
			}else{
				$('#noti13').val(smb001);
				$('#noti13disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFnoti13" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti13/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

