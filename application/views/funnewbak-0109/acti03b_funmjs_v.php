<script type="text/javascript"> 	
//查詢科目開視窗acti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacti03bdisp").click(function() {
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
		message: $('#divFacti03b'),
		onOverlayClick: clear_acti03disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#acti03b').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acti03b').val();
			$('#acti03b').attr('onchange','');
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
				$('#acti03b').val(ui.item.value1);
				$('#acti03bdisp').text(ui.item.value2);
				//console.log($('#acti03').val());
				return false;
			}else{
				$('#acti03bdisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#acti03b').attr('onchange','check_acti03b(this)');
			check_acti03($('#acti03b').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addacti03bdisp(smb001,smb002){
	//alert('test2');
	$('#acti03b').val(smb001);
	$('#acti03bdisp').text(smb002);
	$('#acti03b').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
function clear_acti03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_acti03b(row_obj){
	var smb001= $('#acti03b').val();
	if(!smb001){$('#acti03bdisp').text("");return;}
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
					$('#acti03b').val("");
					$('#acti03bdisp').text("查無資料");
				}
				$('#acti03b').val(smb001);
				$('#acti03bdisp').text(data.message[0].value2);
			}else{
				$('#acti03b').val(smb001);
				$('#acti03bdisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFacti03b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/act/acti03/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>