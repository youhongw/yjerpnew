<script type="text/javascript"> 	
//查詢客戶計價檔開視窗copi02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcopi02disp").click(function() {
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
		message: $('#divFcopi02'),
		onOverlayClick: clear_copi02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#copi02').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var sme001= $('#copi02').val();
			$('#copi02').attr('onchange','');
			console.log(sme001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cop/copi02/lookup1_copi02/'+encodeURIComponent(sme001), 
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
				$('#copi02').val(ui.item.value1);
				$('#copi02disp').text(ui.item.value2);
				//console.log($('#copi02').val());
				return false;
			}else{
				$('#copi02disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#copi02').attr('onchange','check_copi02(this)');
			check_copi02($('#copi02').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcopi02disp(sme001,sme002,smb003,smb004,smb005,smb006){
	//alert('test2');
	$('#copi02').val(sme001);
	$('#copi02disp').text(sme002);
	$('#copi02disp').text(sme003.replace('!', '"'));
	$('#copi02').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
	});
}
function clear_copi02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_copi02(row_obj){
	var sme001= $('#copi02').val();
	if(!sme001){$('#copi02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cop/copi02/lookup2_copi02/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#copi02').val("");
					$('#copi02disp').text("查無資料");
				}
				$('#copi02').val(sme001);
				$('#copi02disp').text(data.message[0].value2);
			}else{
				$('#copi02').val(sme001);
				$('#copi02disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cop/copi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

