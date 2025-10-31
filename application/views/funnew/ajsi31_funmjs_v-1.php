<script type="text/javascript"> 	
//查詢來源摘要-借方開視窗ajsi31 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showajsi31disp").click(function() {
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
		message: $('#divFajsi31'),
		onOverlayClick: clear_ajsi31disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#ajsi31').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#ajsi31').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ajs/ajsi31/lookup1_ajsi31/'+encodeURIComponent(smb001), 
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
				$('#ajsi31').val(ui.item.value1);
				$('#ajsi31disp').text(ui.item.value2);
				//console.log($('#ajsi31').val());
				return false;
			}else{
				$('#ajsi31disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addajsi31disp(smb001,smb002){
	$('#ajsi31').val(smb001);
	$('#ajsi31disp').text(smb002);
	$('#ajsi31').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ajs/ajsi31/clear_sql"
	});
}
function clear_ajsi31disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ajs/ajsi31/clear_sql"
	});
}

//查詢來源摘要-貸方開視窗ajsi31 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showajsi31adisp").click(function() {
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
		message: $('#divFajsi31a'),
		onOverlayClick: clear_ajsi31adisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#ajsi31a').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#ajsi31a').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ajs/ajsi31/lookup1_ajsi31a/'+encodeURIComponent(smb001), 
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
				$('#ajsi31a').val(ui.item.value1);
				$('#ajsi31adisp').text(ui.item.value2);
				//console.log($('#ajsi31').val());
				return false;
			}else{
				$('#ajsi31adisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addajsi31adisp(smb001,smb002){
	$('#ajsi31a').val(smb001);
	$('#ajsi31adisp').text(smb002);
	$('#ajsi31a).focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ajs/ajsi31/cleara_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_ajsi31(row_obj){
	var sme001= $('#ajsi31').val();
	if(!sme001){$('#ajsi31disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ajs/ajsi31/lookup2_ajsi31/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#ajsi31').val("");
					$('#ajsi31disp').text("查無資料");
				}
				$('#ajsi31').val(sme001);
				$('#ajsi31disp').text(data.message[0].value2);
			}else{
				$('#ajsi31').val(sme001);
				$('#ajsi31disp').text("查無資料");
			}
		}
	});
}
//不更新網頁 輸入直接跳出中文
function check_ajsi31a(row_obj){
	var sme001= $('#ajsi31a').val();
	if(!sme001){$('#ajsi31adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ajs/ajsi31/lookup2_ajsi31a/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#ajsi31a').val("");
					$('#ajsi31adisp').text("查無資料");
				}
				$('#ajsi31a').val(sme001);
				$('#ajsi31adisp').text(data.message[0].value2);
			}else{
				$('#ajsi31a').val(sme001);
				$('#ajsi31adisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFajsi31a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ajs/ajsi31/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

