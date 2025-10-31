<script type="text/javascript"> 	
//以下為單頭function
$(document).ready(function(){
	$("#Showasti02disp").click(function() {
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
		message: $('#divFasti02'),
		onOverlayClick: clear_asti02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#asti02').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#asti02').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#asti02').val(ui.item.value1);
				$('#asti02disp').text(ui.item.value2);
				$('#asti02disp2').val(ui.item.value3);
				//console.log($('#asti02').val(ui.item.value1));
				return false;
			}else{
				$('#asti02').val(ui.item.value1);
				$('#asti02disp2').val(ui.item.value3);
				$('#asti02disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addasti02disp(smb001,smb002,smb003){
	$('#asti02').val(smb001);
	$('#asti02disp').text(smb002);
	$('#asti02disp2').val(smb003);
	$('#asti02').focus();
	//check_asti02(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
	}); 
}
function clear_asti02disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_asti02(row_obj){
	var smb001= $('#asti02').val();
	if(!smb001){$('#asti02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#asti02').val("");
					$('#asti02disp2').val("");
					$('#asti02disp').text("查無資料");
				}else{
					$('#asti02').val(smb001);
					$('#asti02disp2').val(data.message[0].value3);
					$('#asti02disp').text(data.message[0].value2);
				}
			}else{
				$('#asti02').val("");
				$('#asti02disp2').val("");
				$('#asti02disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFasti02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script>
//以下為單身function
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[asti02\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[asti02\\]').val();
			$('#order_product\\['+row+'\\]\\[asti02\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#order_product\\['+row+'\\]\\[asti02\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[asti02_mb002\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[asti02_mb003\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[asti02_mb012\\]').val(ui.item.value12);
				$('#order_product\\['+row+'\\]\\[asti02_mb011\\]').val(ui.item.value11);
				$('#order_product\\['+row+'\\]\\[asti02_mb016\\]').val(ui.item.value16);
				$('#order_product\\['+row+'\\]\\[asti02_mb020\\]').val(ui.item.value20);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[asti02\\]').attr('onchange','check_asti02_body(this)');
			check_asti02_body(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		},
		focus: function(event, ui) {
			return false;
		}
	});
}
//查詢資產編號視窗  (應收票據)
function search_asti02_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;

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
		message: $('#divFasti02_body'),
		onOverlayClick: clear_asti02_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti02_body(mb001, mb002, mb003, mb012, mb011, mb016, mb020){
	clear_row(selected_row);
	
	var date_mb016 = mb016.substr(0,4) + '/' + mb016.substr(4,2) + '/' +mb016.substr(6,2);
	
	$('#order_product\\['+selected_row+'\\]\\[asti02\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb003\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb012\\]').val(mb012);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb011\\]').val(mb011);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb016\\]').val(date_mb016);
	$('#order_product\\['+selected_row+'\\]\\[asti02_mb020\\]').val(mb020);
	$('#order_product\\['+selected_row+'\\]\\[asti02\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql"
	});
}
function clear_asti02_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti02/clear_body_sql"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti02_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[asti02\\]').val();
	
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[asti02\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb002\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb003\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb012\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb011\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb016\\]').val('');
		$('#order_product\\['+row+'\\]\\[asti02_mb020\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti02/lookup_body_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[asti02\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[asti02_mb002\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[asti02_mb003\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[asti02_mb012\\]').val(data.message[0].value12);
				$('#order_product\\['+row+'\\]\\[asti02_mb011\\]').val(data.message[0].value11);
				$('#order_product\\['+row+'\\]\\[asti02_mb016\\]').val(data.message[0].value16);
				$('#order_product\\['+row+'\\]\\[asti02_mb020\\]').val(data.message[0].value20);
				$('#order_product\\['+row+'\\]\\[asti02\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[asti02\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[asti02\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti02_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/ast/asti02/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

