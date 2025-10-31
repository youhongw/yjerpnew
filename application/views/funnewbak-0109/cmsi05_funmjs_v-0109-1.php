<script type="text/javascript"> 	
//查詢部門開視窗cmsi05 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi05disp").click(function() {
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
		message: $('#divFcmsi05'),
		onOverlayClick: clear_cmsi05disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi05').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var sme001= $('#cmsi05').val();
			$('#cmsi05').attr('onchange','');
			console.log(sme001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup1_cmsi05/'+encodeURIComponent(sme001), 
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
				$('#cmsi05').val(ui.item.value1);
				$('#cmsi05disp').text(ui.item.value2);
				//console.log($('#cmsi05').val());
				return false;
			}else{
				$('#cmsi05disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi05').attr('onchange','check_cmsi05(this)');
			check_cmsi05($('#cmsi05').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi05disp(sme001,sme002){
	//alert('test2');
	$('#cmsi05').val(sme001);
	$('#cmsi05disp').text(sme002);
	$('#cmsi05').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql"
	});
}
function clear_cmsi05disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi05(row_obj){
	var sme001= $('#cmsi05').val();
	if(!sme001){$('#cmsi05disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup2_cmsi05/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi05').val("");
					$('#cmsi05disp').text("查無資料");
				}
				$('#cmsi05').val(sme001);
				$('#cmsi05disp').text(data.message[0].value2);
			}else{
				$('#cmsi05').val(sme001);
				$('#cmsi05disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi05" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi05/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

