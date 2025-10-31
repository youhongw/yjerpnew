<script type="text/javascript"> 	
//查詢部門開視窗cmsi11 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi11disp").click(function() {
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
		message: $('#divFcmsi11'),
		onOverlayClick: clear_cmsi11disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#cmsi11').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var sma001= $('#cmsi11').val();
			$('#cmsi11').attr('onchange','');
			console.log(sma001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi11/lookup1_cmsi11/'+encodeURIComponent(sma001), 
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
				$('#cmsi11').val(ui.item.value1);
				$('#cmsi11disp').text(ui.item.value2);
				//console.log($('#cmsi11').val());
				return false;
			}else{
				$('#cmsi11disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi11').attr('onchange','check_cmsi11(this)');
			check_cmsi11($('#cmsi11').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addcmsi11disp(sma001,sma002){
	//alert('test2');
	$('#cmsi11').val(sma001);
	$('#cmsi11disp').text(sma002);
	$('#cmsi11').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi11/clear_sql"
	});
}
function clear_cmsi11disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi11/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_cmsi11(row_obj){
	var sma001= $('#cmsi11').val();
	if(!sma001){$('#cmsi11disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi11/lookup2_cmsi11/'+encodeURIComponent(sma001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ma001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi11').val("");
					$('#cmsi11disp').text("查無資料");
				}
				$('#cmsi11').val(sma001);
				$('#cmsi11disp').text(data.message[0].value2);
			}else{
				$('#cmsi11').val(sma001);
				$('#cmsi11disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi11" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi11/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

