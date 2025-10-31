<script type="text/javascript"> 	
//查詢途程品號開視窗bomi07 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showbomi07disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '70%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFbomi07'),
		onOverlayClick: clear_bomi07disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#bomi07').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#bomi07').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup1_bomi07/'+encodeURIComponent(smb001), 
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
				$('#bomi07').val(ui.item.value1);
				$('#bomi07disp').text(ui.item.value2);
				$('#mb011').val(ui.item.value3);
				$('#bomi07adisp').text(ui.item.value4);
				//console.log($('#bomi07').val());
				return false;
			}else{
				$('#bomi07disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addbomi07disp(smb001,smb002,smb003,smb004,smb005){
	$('#bomi07').val(smb001);
	$('#bomi07disp').text(smb002.replace('!', '"'));    //開視窗吋再取代回來特殊符號
	$('#mb011').val(smb004);
	$('#bomi07adisp').text(smb005);
	$('#bomi07').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/bom/bomi07/clear_sql"
	});
}
function clear_bomi07disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/bom/bomi07/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_bomi07(row_obj){
	var sme001= $('#bomi07').val();
	if(!sme001){$('#bomi07disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup2_bomi07/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#bomi07').val("");
					$('#bomi07disp').text("查無資料");
				}
				$('#bomi07').val(sme001);
				$('#bomi07disp').text(data.message[0].value2);
				$('#mb011').val(data.message[0].value3);
				$('#bomi07adisp').text(data.message[0].value4);
			}else{
				$('#bomi07').val(sme001);
				$('#bomi07disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFbomi07" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/bom/bomi07/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

