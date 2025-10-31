<script type="text/javascript"> 	
//查詢客戶開視窗copi01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcopi01edisp").click(function() {
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
		message: $('#divFcopi01'),
		onOverlayClick: clear_copi01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#copi01e').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#copi01e').val();
			$('#copi01e').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cop/copi01/lookup1_copi01/'+encodeURIComponent(smb001), 
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
				$('#copi01e').val(ui.item.value1);
				$('#copi01edisp').text(ui.item.value2);
				console.log($('#copi01edisp').text(ui.item.value2));
				return false;
			}else{
				$('#copi01edisp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#copi01e').attr('onchange','check_copi01(this)');
			check_copi01($('#copi01e').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcopi01edisp(smb001,smb002){
	//alert('test2');
	$('#copi01e').val(smb001);
	$('#copi01edisp').text(smb002);
	$('#copi01e').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi01/clear_sql"
	});
}
function clear_copi01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi01/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_copi01e(row_obj){
	var smb001= $('#copi01e').val();
	if(!smb001){$('#copi01edisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cop/copi01/lookup2_copi01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#copi01e').val("");
					$('#copi01edisp').text("查無資料");
				}
				$('#copi01e').val(smb001);
				$('#copi01edisp').text(data.message[0].value2);
			}else{
				$('#copi01e').val(smb001);
				$('#copi01edisp').text("查無資料");
			}
		}
	});
}
//ondblclick 按2下開視窗
function search_copi01e_window() {
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
		message: $('#divFcopi01'),
		onOverlayClick: clear_copi01disp_sql
	});
	  $('.close').click($.unblockUI);
}
</script>	   
<div id="divFcopi01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cop/copi01/displaye_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

