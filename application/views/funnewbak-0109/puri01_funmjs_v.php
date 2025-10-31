<script type="text/javascript"> 	
//查詢供應商開視窗puri01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showpuri01disp").click(function() {
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
		message: $('#divFpuri01'),
		onOverlayClick: clear_puri01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#puri01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#puri01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/pur/puri01/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#puri01').val(ui.item.value1);
				$('#puri01disp').text(ui.item.value2);
				$('#puri01disp').val(ui.item.value2);
				$('#puri01').focus();
				//console.log($('#puri01').val());
				return false;
			}else{
				$('#puri01disp').text("查無資料");
				$('#puri01').focus();
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addpuri01disp(smb001,smb002){
	
	$('#puri01').val(smb001);
	$('#puri01disp').text(smb002);
	$('#puri01disp').val(smb002);
	$('#puri01').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function clear_puri01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_puri01(row_obj){
	var sme001= $('#puri01').val();
	if(!sme001){$('#puri01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/pur/puri01/lookup_check/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#puri01').val("");
					$('#puri01disp').text("查無資料");
				}
				$('#puri01').val(sme001);
				$('#puri01disp').text(data.message[0].value2);
				$('#puri01disp').val(data.message[0].value2);
				$('#puri01').focus();
			}else{
				$('#puri01').val(sme001);
				$('#puri01disp').text("查無資料");
				$('#puri01').focus();
			}
		}
	});
}
</script>	   
<div id="divFpuri01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/pur/puri01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

