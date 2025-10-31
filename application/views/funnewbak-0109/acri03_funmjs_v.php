<script type="text/javascript"> 	
//查詢庫別開視窗acri03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacri03disp").click(function() {
	var sma001= $('#copi01').val();
	$('#acri03frame').attr('src','<?php echo base_url()?>index.php/acr/acri03/display_child/'+sma001);
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
		message: $('#divFacri03'),
		onOverlayClick: clear_acri03disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#acri03').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acri03').val();
			var smb002 = $('#copi01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/acr/acri03/lookup1_acri03/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
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
				$('#acri03').val(ui.item.value1);
				$('#acri03disp').val(ui.item.value2);
				$('#acri03disp2').val(ui.item.value3);
				//console.log($('#acri03').val());
				return false;
			}else{
				$('#acri03disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addacri03disp(smb001,smb002,smb003){
	$('#acri03').val(smb001);
	$('#acri03disp').val(smb002);
	$('#acri03disp2').val(smb003);
	$('#acri03').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri03/clear_sql"
	});
}
function clear_acri03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri03/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_acri03(row_obj){
	var smb001= $('#acri03').val();
	var smb002 = $('#copi01').val();
	if(!smb001){$('#acri03disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/acr/acri03/lookup2_acri03/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#acri03').val("");
					$('#acri03disp').text("查無資料");
				}
				$('#acri03').val(smb001);
				$('#acri03disp').text(data.message[0].value2);
			}else{
				$('#acri03').val(smb001);
				$('#acri03disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFacri03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="acri03frame" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

