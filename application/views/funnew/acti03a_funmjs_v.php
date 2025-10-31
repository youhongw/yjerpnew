<script type="text/javascript"> 	
//查詢科目開視窗acti03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacti03adisp").click(function() {
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
		message: $('#divFacti03a'),
		onOverlayClick: clear_acti03disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#acti03a').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acti03a').val();
			$('#acti03a').attr('onchange','');
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
				$('#acti03a').val(ui.item.value1);
				$('#acti03adisp').text(ui.item.value2);
				//console.log($('#acti03').val());
				return false;
			}else{
				$('#acti03adisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#acti03a').attr('onchange','check_acti03a(this)');
			check_acti03($('#acti03a').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addacti03adisp(smb001,smb002){
	//alert('test2');
	$('#acti03a').val(smb001);
	$('#acti03adisp').text(smb002);
	$('#acti03a').focus();
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
function check_acti03a(row_obj){
	var smb001= $('#acti03a').val();
	if(!smb001){$('#acti03adisp').text("");return;}
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
					$('#acti03a').val("");
					$('#acti03adisp').text("查無資料");
				}
				$('#acti03a').val(smb001);
				$('#acti03adisp').text(data.message[0].value2);
			}else{
				$('#acti03a').val(smb001);
				$('#acti03adisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFacti03a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/act/acti03/display_child2" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>