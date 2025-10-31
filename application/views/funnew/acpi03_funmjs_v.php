<script type="text/javascript"> 	
//查詢科目開視窗acpi03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacpi03disp").click(function() {
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
		message: $('#divFacpi03'),
		onOverlayClick: clear_acpi03disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#acpi03').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acpi03').val();
			$('#acpi03').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup1_acpi03/'+encodeURIComponent(smb001), 
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
				$('#acpi03').val(ui.item.value1);
				$('#acpi03disp').text(ui.item.value2);
				//console.log($('#acpi03').val());
				return false;
			}else{
				$('#acpi03disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#acpi03').attr('onchange','check_acpi03(this)');
			check_acpi03($('#acpi03').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addacpi03disp(smb001,smb002,smb003){
	//alert('test2');
	$('#acpi03').val(smb001);
	$('#acpi03disp').text(smb002);
	$('#acpi03disp2').val(smb002);
	$('#acpi03disp3').val(smb003);
	$('#acpi03').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acp/acpi03/clear_sql"
	});
}
function clear_acpi03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acp/acpi03/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_acpi03(row_obj){
	var smb001= $('#acpi03').val();
	if(!smb001){$('#acpi03disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookup2_acpi03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#acpi03').val("");
					$('#acpi03disp').text("查無資料");
				}
				$('#acpi03').val(smb001);
				$('#acpi03disp').text(data.message[0].value2);
			}else{
				$('#acpi03').val(smb001);
				$('#acpi03disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFacpi03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/acp/acpi03/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

