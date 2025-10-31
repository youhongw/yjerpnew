<script type="text/javascript"> 	
//查詢幣別開視窗cmsi06 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi06disp").click(function() {
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
		message: $('#divFcmsi06'),
		onOverlayClick: clear_cmsi06disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi06').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi06').val();
			$('#cmsi06').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi06/lookup1_cmsi06/'+encodeURIComponent(smb001), 
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
				$('#cmsi06').val(ui.item.value1);
				$('#cmsi06disp').text(ui.item.value2);
				//console.log($('#cmsi06').val());
				return false;
			}else{
				$('#cmsi06disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi06').attr('onchange','check_cmsi06(this)');
			check_cmsi06($('#cmsi06').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi06disp(smb001,smb002){
	//alert('test2');
	$('#cmsi06').val(smb001);
	$('#cmsi06disp').text(smb002);
	$('#cmsi06').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql"
	});
}
function clear_cmsi06disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi06(row_obj){
	var smb001= $('#cmsi06').val();
	if(!smb001){$('#cmsi06disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi06/lookup2_cmsi06/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi06').val("");
					$('#cmsi06disp').text("查無資料");
				}
				$('#cmsi06').val(smb001);
				$('#cmsi06disp').text(data.message[0].value2);
			}else{
				$('#cmsi06').val(smb001);
				$('#cmsi06disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi06" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi06/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

