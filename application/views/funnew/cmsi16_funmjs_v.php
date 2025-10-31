<script type="text/javascript"> 	
//查詢廠別開視窗cmsi16 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi16disp").click(function() {
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
		message: $('#divFcmsi16'),
		onOverlayClick: clear_cmsi16disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi16').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi16').val();
			$('#cmsi16').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi16/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#cmsi16').val(ui.item.value1);
				$('#cmsi16disp').text(ui.item.value2);
				//console.log($('#cmsi16').val());
				return false;
			}else{
				$('#cmsi16disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi16').attr('onchange','check_cmsi16(this)');
			check_cmsi16($('#cmsi16').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi16disp(smb001,smb002){
	//alert('test2');
	$('#cmsi16').val(smb001);
	$('#cmsi16disp').text(smb002);
	$('#cmsi16').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi16/clear_sql"
	});
}
function clear_cmsi16disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi16/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi16(row_obj){
	var smb001= $('#cmsi16').val();
	if(!smb001){$('#cmsi16disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi16/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi16').val("");
					$('#cmsi16disp').text("查無資料");
				}
				$('#cmsi16').val(smb001);
				$('#cmsi16disp').text(data.message[0].value2);
			}else{
				$('#cmsi16').val(smb001);
				$('#cmsi16disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi16" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi16/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢廠別開視窗cmsi16a //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi16adisp").click(function() {
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
		message: $('#divFcmsi16a'),
		onOverlayClick: clear_cmsi16adisp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi16a').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi16a').val();
			$('#cmsi16a').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi16/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#cmsi16a').val(ui.item.value1);
				$('#cmsi16adisp').text(ui.item.value2);
				//console.log($('#cmsi16a').val());
				return false;
			}else{
				$('#cmsi16adisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi16a').attr('onchange','check_cmsi16a(this)');
			check_cmsi16a($('#cmsi16a').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi16adisp(smb001,smb002){
	//alert('test2');
	$('#cmsi16a').val(smb001);
	$('#cmsi16adisp').text(smb002);
	$('#cmsi16a').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi16/clear_sql"
	});
}
function clear_cmsi16adisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi16/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi16a(row_obj){
	var smb001= $('#cmsi16a').val();
	if(!smb001){$('#cmsi16adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi16/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi16a').val("");
					$('#cmsi16adisp').text("查無資料");
				}
				$('#cmsi16a').val(smb001);
				$('#cmsi16adisp').text(data.message[0].value2);
			}else{
				$('#cmsi16a').val(smb001);
				$('#cmsi16adisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi16a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi16/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢廠別開視窗cmsi16b //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi16bdisp").click(function() {
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
		message: $('#divFcmsi16b'),
		onOverlayClick: clear_cmsi16bdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi16b').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi16b').val();
			$('#cmsi16b').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi16/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#cmsi16b').val(ui.item.value1);
				$('#cmsi16bdisp').text(ui.item.value2);
				//console.log($('#cmsi16b').val());
				return false;
			}else{
				$('#cmsi16bdisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi16b').attr('onchange','check_cmsi16b(this)');
			check_cmsi16b($('#cmsi16b').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi16bdisp(smb001,smb002){
	//alert('test2');
	$('#cmsi16b').val(smb001);
	$('#cmsi16bdisp').text(smb002);
	$('#cmsi16b').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi16/clear_sql"
	});
}
function clear_cmsi16bdisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi16/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi16b(row_obj){
	var smb001= $('#cmsi16b').val();
	if(!smb001){$('#cmsi16bdisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi16/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi16b').val("");
					$('#cmsi16bdisp').text("查無資料");
				}
				$('#cmsi16b').val(smb001);
				$('#cmsi16bdisp').text(data.message[0].value2);
			}else{
				$('#cmsi16b').val(smb001);
				$('#cmsi16bdisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi16b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi16/display_childb" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>