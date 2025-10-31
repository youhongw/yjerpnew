<script type="text/javascript"> 	
//查詢付款條件開視窗cmsi21 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi21disp").click(function() {    //銷售2
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi21'),
		onOverlayClick: clear_cmsi21disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	
	$("#Showcmsi21adisp").click(function() {  //採購1
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi21a'),
		onOverlayClick: clear_cmsi21disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi21').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi21').val();
			$('#cmsi21').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi21/lookup1_cmsi21/'+encodeURIComponent(smb001), 
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
				$('#cmsi21').val(ui.item.value1);
				$('#cmsi21disp').text(ui.item.value2);
				//console.log($('#cmsi21').val());
				return false;
			}else{
				$('#cmsi21disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi21').attr('onchange','check_cmsi21(this)');
			check_cmsi21($('#cmsi21').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi21disp(smb001,smb002){
	//alert('test2');
	$('#cmsi21').val(smb001);
	$('#cmsi21disp').text(smb002);
	$('#cmsi21').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi21/clear_sql"
	});
}
function clear_cmsi21disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi21/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi21(row_obj){
	var smb001= $('#cmsi21').val();
	console.log(smb001);
	if(!smb001){$('#cmsi21disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi21/lookup2_cmsi21/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi21').val("");
					$('#cmsi21disp').text("查無資料");
				}
				$('#cmsi21').val(smb001);
				$('#cmsi21disp').text(data.message[0].value2);
			}else{
				$('#cmsi21').val(smb001);
				$('#cmsi21disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi21" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi21/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi21a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi21/displaya_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
