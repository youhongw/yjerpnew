<script type="text/javascript"> 	
//查詢幣別開視窗cmsi07 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi07disp").click(function() {
		var sma001 = $('#cmsi06').val();
		var sma002 = '';
		console.log(sma001);
		if(sma001 != ""){
			$('#ifmain2').attr('src',"<?php echo base_url();?>index.php/cms/cmsi07/display_child/0/or_where?key=mg001&val="+sma001);
		}else{
			$('#ifmain2').attr('src',"<?php echo base_url();?>index.php/cms/cmsi07/display_child/0/or_where?key=mg001&val=''");
		}
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
		message: $('#divFcmsi07'),
		onOverlayClick: clear_cmsi07disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi07').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi07').val();
			//$('#cmsi07').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi07/lookup1_cmsi07/'+encodeURIComponent(smb001), 
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
				$('#cmsi07').val(ui.item.value1);
				$('#cmsi07disp').text(ui.item.value2);
				//console.log($('#cmsi07').val());
				return false;
			}else{
				$('#cmsi07disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			//$('#cmsi07').attr('onchange','check_cmsi07(this)');
			//check_cmsi07($('#cmsi07').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi07disp(smb001,smb002){
	//alert('test2');
	$('#cmsi07').val(smb001);
	$('#cmsi07disp').text(smb002);
	$('#cmsi07').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi07/clear_sql"
	});
}
function clear_cmsi07disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi07/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi07(row_obj){
	var smb001= $('#cmsi06').val();
	console.log('asdgdasgasd');
	if(!smb001){$('#cmsi07disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi07/lookup2_cmsi07/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi07').val("");
					$('#cmsi07disp').text("查無資料");
				}
				$('#cmsi07').val(data.message[0].value2);
				$('#cmsi07disp').text(smb001);
			}else{
				$('#cmsi07').val('');
				$('#cmsi07disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi07" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="" allowTransparency="flase" name="ifmain2" id="ifmain2" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

