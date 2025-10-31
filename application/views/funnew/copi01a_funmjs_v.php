<script type="text/javascript"> 	
//查詢客戶開視窗copi01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcopi01disp").click(function() {
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
		message: $('#divFcopi01'),
		onOverlayClick: clear_copi01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#copi01').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#copi01').val();
			$('#copi01').attr('onchange','');
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
				$('#copi01').val(ui.item.value1);
				$('#copi01disp').text(ui.item.value2);
				$('#cmsi05').val(ui.item.value3);
	            $('#cmsi09').val(ui.item.value4);
	            $('#cmsi06').val(ui.item.value5);
	            $('#pricec').val(ui.item.value6);
	            $('#cmsi21').val(ui.item.value7);
	            $('#taxes').val(ui.item.value8);
                $('#cmsi05disp').text(ui.item.value9);
                $('#cmsi09disp').text(ui.item.value10);
                $('#cmsi06disp').text(ui.item.value11);
                $('#cmsi21disp').text(ui.item.value12);				
				//console.log($('#copi01').val());
				return false;
			}else{
				$('#copi01disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#copi01').attr('onchange','check_copi01(this)');
			check_copi01($('#copi01').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});

//客戶回傳多欄 品號1,品名2,部門代號15,業務人員16,交易幣別14,價格條件30,付款條件31,課稅別38
function addcopi01disp(smb001,smb002,smb003,smb003disp,smb004,smb004disp,smb005,smb005disp,smb006,smb007,smb007disp,smb008){
	//alert('test2');
	$('#copi01').val(smb001);
	$('#copi01disp').text(smb002);
	$('#cmsi05').val(smb003);
	$('#cmsi05disp').text(smb003disp);
	$('#cmsi09').val(smb004);
	$('#cmsi09disp').text(smb004disp);
	$('#cmsi06').val(smb005);
	$('#cmsi06disp').text(smb005disp);
	$('#pricec').val(smb006);
	$('#cmsi21').val(smb007);
	$('#cmsi21disp').text(smb007disp);
	$('#taxes').val(smb008);
	$('#copi01').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi01/cleara_sql"
	});
}
function clear_copi01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi01/cleara_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_copi01(row_obj){
	var smb001= $('#copi01').val();
	if(!smb001){$('#copi01disp').text("");return;}
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
					$('#copi01').val("");
					$('#copi01disp').text("查無資料");
				}
				$('#copi01').val(data.message[0].value1);
				$('#copi01disp').text(data.message[0].value2);
				$('#cmsi05').val(data.message[0].value3);
				$('#cmsi05disp').text(data.message[0].value4);
	            $('#cmsi09').val(data.message[0].value5);
				$('#cmsi09disp').text(data.message[0].value6);
	            $('#cmsi06').val(data.message[0].value7);
				$('#cmsi06disp').text(data.message[0].value8);
	            $('#pricec').val(data.message[0].value9);
	            $('#cmsi21').val(data.message[0].value10);
				$('#cmsi21disp').text(data.message[0].value11);
	            $('#taxes').val(data.message[0].value12);
			}else{
				$('#copi01').val(smb001);
				$('#copi01disp').text("查無資料");
			}
		}
	});
}
//ondblclick 按2下開視窗
function search_copi01_window() {
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
<iframe src="<?php echo base_url()?>index.php/cop/copi01/displaya_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

