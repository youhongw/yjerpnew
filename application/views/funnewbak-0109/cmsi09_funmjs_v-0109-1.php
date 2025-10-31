<script type="text/javascript"> 	
//查詢業務人員開視窗cmsi09 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09disp").click(function() {
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
		message: $('#divFcmsi09'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09').val();
			$('#cmsi09').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
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
				$('#cmsi09').val(ui.item.value1);
				$('#cmsi09disp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());  debug
				return false;
			}else{
				$('#cmsi09disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi09').attr('onchange','check_cmsi09(this)');
			check_cmsi09($('#cmsi09').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
</script>
<script type="text/javascript"> 	
//查詢計劃人員開視窗cmsi09a //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09adisp").click(function() {
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
		message: $('#divFcmsi09a'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09a').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09a').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
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
				$('#cmsi09a').val(ui.item.value1);
				$('#cmsi09adisp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09adisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
//查詢採購人員開視窗cmsi09b //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09bdisp").click(function() {
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
		message: $('#divFcmsi09b'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09b').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09b').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
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
				$('#cmsi09b').val(ui.item.value1);
				$('#cmsi09bdisp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09bdisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});

function addcmsi09disp(smb001,smb002){
	
	$('#cmsi09').val(smb001);
	$('#cmsi09disp').text(smb002);
	$('#cmsi09').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function addcmsi09adisp(smb001,smb002){
	
	$('#cmsi09a').val(smb001);
	$('#cmsi09adisp').text(smb002);
	$('#cmsi09a').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function addcmsi09bdisp(smb001,smb002){
	
	$('#cmsi09b').val(smb001);
	$('#cmsi09bdisp').text(smb002);
	$('#cmsi09b').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function clear_cmsi09disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi09(row_obj){
	var smb001= $('#cmsi09').val();
	if(!smb001){$('#cmsi09disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup2_cmsi09/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi09').val("");
					$('#cmsi09disp').text("查無資料");
				}
				$('#cmsi09').val(smb001);
				$('#cmsi09disp').text(data.message[0].value2);
			}else{
				$('#cmsi09').val(smb001);
				$('#cmsi09disp').text("查無資料");
			}
		}
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi09a(row_obj){
	var smb001= $('#cmsi09a').val();
	if(!smb001){$('#cmsi09adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup2_cmsi09/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi09a').val("");
					$('#cmsi09adisp').text("查無資料");
				}
				$('#cmsi09a').val(smb001);
				$('#cmsi09adisp').text(data.message[0].value2);
			}else{
				$('#cmsi09a').val(smb001);
				$('#cmsi09adisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi09" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi09a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/displaya_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi09b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
