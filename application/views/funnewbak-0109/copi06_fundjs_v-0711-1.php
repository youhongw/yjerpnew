<script type="text/javascript"> 	
//查詢品名規格開視窗 copi06 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[td004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[td004\\]').val();
			$('#order_product\\['+row+'\\]\\[tg004\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd_invi02/'+encodeURIComponent(smb001), 
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
			clear_row(row);
			console.log(ui.item.value);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[td004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[td005\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[td006\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[td010\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[td007\\]').val(ui.item.value5);
				$('#order_product\\['+row+'\\]\\[td007disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[td004\\]').attr('onchange','check_invi02d(this)');
			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
}
//檢查最新編號
function check_title_no(){
	$('#tc002').val("");
	var tc001 = $('#tc001').val();
	var tc014 = $('#tc039').val();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi06/check_title_no",
		data: {
			tc001: tc001, 
			tc039: tc039
		}
	})
	.done(function( msg ) {
		if($('#tc001disp').text()!=""&&$('#tc001disp').text()!="查無資料")
		$('#tc002').val(msg);
	});
}
//查詢庫別下拉選單
function set_catcomplete2(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[td007\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[td007\\]').val();
			$('#order_product\\['+row+'\\]\\[td007\\]').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/'+encodeURIComponent(smb002), 
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
			clear_row(row);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[td007\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[td007disp\\]').val(ui.item.value2);
			}
			return false;
		},
		change: function(event, ui) {
			$('#cmsi03').attr('onchange','check_cmsi03d(this)');
			//check_cmsi03d($('#order_product\\['+row+'\\]\\[td007\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
}

</script>
<script>
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_tg00'+k).val("");
		$('#product-row'+row+' input.order_product_tg0'+k).val("");
		$('#product-row'+row+' input.order_product_tg'+k).val("");
	}
}
</script>
<script>
//查詢產品視窗
function search_invi02d_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
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
		message: $('#divFinvi02d'),
		onOverlayClick: clear_invi02disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td005\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[td010\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(mb005);
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(mb006);
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
//
//查詢庫別視窗
function search_cmsi03d_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
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
		message: $('#divFcmsi03d'),
		onOverlayClick: clear_cmsi03disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addcmsi03ddisp(mb001, mb002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(mb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
function clear_cmsi03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_invi02d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[td004\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd2_invi02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[td004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[td005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[td006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[td010\\]').val(data.message[0].value4);
			}else{
				$('#order_product\\['+row+'\\]\\[td004\\]').val("查無資料");
			}
		}
	});
}
//庫別
function check_cmsi03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[td007\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[td007\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[td007disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[td007\\]').val("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi03/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>