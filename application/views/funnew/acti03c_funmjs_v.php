<script type="text/javascript"> 	
//查詢科目開視窗acti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacti03cdisp").click(function() {
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
		message: $('#divFacti03c'),
		onOverlayClick: clear_acti03cdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#acti03c').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acti03c').val();
			$('#acti03c').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/act/acti03/lookup1_acti03/'+encodeURIComponent(smb001), 
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
				$('#acti03c').val(ui.item.value1);
				$('#acti03cdisp').text(ui.item.value2);
				//console.log($('#acti03').val());
				return false;
			}else{
				$('#acti03cdisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#acti03c').attr('onchange','check_acti03c(this)');
			check_acti03c($('#acti03c').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addacti03cdisp(smb001,smb002){
	//alert('test2');
	$('#acti03c').val(smb001);
	$('#acti03cdisp').text(smb002);
	$('#acti03c').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
function clear_acti03cdisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_acti03c(row_obj){
	var smb001= $('#acti03c').val();
	if(!smb001){$('#acti03cdisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/act/acti03/lookup2_acti03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#acti03c').val("");
					$('#acti03cdisp').text("查無資料");
				}
				$('#acti03c').val(smb001);
				$('#acti03cdisp').text(data.message[0].value2);
			}else{
				$('#acti03c').val(smb001);
				$('#acti03cdisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFacti03c" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/act/acti03/display_child4" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

