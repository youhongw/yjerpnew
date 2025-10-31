
<script type="text/javascript"> 	
//查詢品號開視窗invi02  //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showinvi02disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '70%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFinvi02'),
		onOverlayClick: clear_invi02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#invi02').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#invi02').val();
			$('#invi02').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#invi02').val(ui.item.value1);
				$('#invi02disp').text(ui.item.value2);
				$('#invi02disp1').text(ui.item.value3);
				$('#invi02disp2').text(ui.item.value4);
				$('#mc001disp').text(ui.item.value2);
				$('#mc001disp1').text(ui.item.value3);
				$('#mc002').text(ui.item.value4);
				$('#mc003').text(ui.item.value5);
				$('#mc001disp4').text(ui.item.value6);
				
				$('#tf004disp').val(ui.item.value2);   //bomi06
				$('#tf004disp1').val(ui.item.value3);
				$('#tf005').val(ui.item.value4);
				//console.log($('#invi02').val());
				return false;
			}else{
				$('#invi02disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#invi02').attr('onchange','check_invi02(this)');
			check_invi02($('#invi02').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addinvi02disp(smb001,smb002,smb003,smb004,smb005,smb006){
	//alert('test2');
	$('#invi02').val(smb001);
	$('#invi02disp').text(smb002);
	$('#invi02disp1').text(smb003);
	$('#invi02disp2').text(smb004);
	$('#mc001disp').val(smb002);
	$('#mc001disp1').val(smb003);
	$('#mc002').val(smb004);
	$('#mc003').val(smb005);
	$('#mc001disp4').val(smb006);
	
	$('#td004disp').val(smb002);   //bomi05
	$('#td004disp1').val(smb003);
	$('#td005').val(smb004);
	
	$('#tf004disp').val(smb002);   //bomi06
	$('#tf004disp1').val(smb003);
	$('#tf005').val(smb004);
	
	$('#ta034').val(smb002);
	$('#ta035').val(smb003);
	$('#ta007').val(smb004);
	//$('#tb006').val(smb002);  //sfci05
	$('#invi02').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	}); 
}
function clear_invi02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_invi02(row_obj){
	var smb001= $('#invi02').val();
	if(!smb001){$('#invi02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#invi02').val("");
					$('#invi02disp').text("查無資料");
				}
				$('#invi02').val(smb001);
				$('#invi02disp').text(data.message[0].value2);
				$('#mc001disp').val(data.message[0].value2);
				$('#mc001disp1').val(data.message[0].value3);
				$('#mc002').val(data.message[0].value4);
				$('#mc003').val(data.message[0].value5);
				$('#mc001disp4').val(data.message[0].value6);
				
				$('#tf004disp').val(data.message[0].value2); //bomi06
				$('#tf004disp1').val(data.message[0].value3);
				$('#tf005').val(data.message[0].value4);
			}else{
				$('#invi02').val(smb001);
				$('#invi02disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_invi02_window() {
$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '70%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFinvi02'),
		onOverlayClick: clear_invi02disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi02/display_childe" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>