<script type="text/javascript"> 	
//查詢應付性質開視窗acpi01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacpi01disp").click(function() {
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
		message: $('#divFacpi01'),
		onOverlayClick: clear_acpi01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#acpi01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acpi01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/acp/acpi01/lookup1_acpi01/'+encodeURIComponent(smb001), 
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
				$('#acpi01').val(ui.item.value1);
				$('#acpi01disp').text(ui.item.value2);
				//console.log($('#acpi01').val(ui.item.value1));
				return false;
			}else{
				$('#acpi01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addacpi01disp(smb001,smb002){
	$('#acpi01').val(smb001);
	$('#acpi01disp').text(smb002);
	$('#acpi01').focus();
	//check_acpi01(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acp/acpi01/clear_sql"
	}); 
}
function clear_acpi01disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acp/acpi01/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_acpi01(row_obj){
	var smb001= $('#acpi01').val();
	if(!smb001){$('#acpi01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/acp/acpi01/lookup1_acpi01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#acpi01').val("");
					$('#acpi01disp').text("查無資料");
				}
				$('#acpi01').val(smb001);
				$('#acpi01disp').text(data.message[0].value2);
			}else{
				$('#acpi01').val(smb001);
				$('#acpi01disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_acpi01_window() {
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
		message: $('#divFacpi01'),
		onOverlayClick: clear_acpi01disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFacpi01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/acp/acpi01/displaya_child/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
