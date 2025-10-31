<script>
//以下為單身function

function search_asti12_asti14_body_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;

	
	$("#iframe_asti12_asti14").attr('src','<?php echo base_url()?>index.php/ast/asti12/display_child_body_asti14/');

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
		message: $('#divFasti12_asti14_body'),
		onOverlayClick: clear_asti12_asti14_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addasti12_asti12_body(tf001, tf002, tf003, mb002, mb003, tf004, me002, tf005, mv002, tf006, tf008){
	clear_row(selected_row);
	console.log(tf002);
	$('#order_product\\['+selected_row+'\\]\\[th003\\]').val(tf001);
	$('#order_product\\['+selected_row+'\\]\\[th004\\]').val(tf002);
	$('#order_product\\['+selected_row+'\\]\\[th005\\]').val(tf003);
	$('#order_product\\['+selected_row+'\\]\\[th005_mb002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[th005_mb003\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[th006\\]').val(tf004);
	$('#order_product\\['+selected_row+'\\]\\[th006disp\\]').val(me002);
	$('#order_product\\['+selected_row+'\\]\\[th007\\]').val(tf005);
	$('#order_product\\['+selected_row+'\\]\\[th007_mv002\\]').val(mv002);
	$('#order_product\\['+selected_row+'\\]\\[th008\\]').val(tf006);
	$('#order_product\\['+selected_row+'\\]\\[th009\\]').val(tf008);
	
	
	$('#order_product\\['+selected_row+'\\]\\[th003\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti12/clear_body_sql_asti14"
	});
}
function clear_asti12_asti14_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti12/clear_body_sql_asti14"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_asti12_asti14_body1070815(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[th003\\]').val();
	console.log(smb001);
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[th003\\]').val('');
		$('#order_product\\['+row+'\\]\\[th004\\]').val('');
		$('#order_product\\['+row+'\\]\\[th005\\]').val('');
		$('#order_product\\['+row+'\\]\\[th005_mb002\\]').val('');
		$('#order_product\\['+row+'\\]\\[th005_mb003\\]').val('');
		$('#order_product\\['+row+'\\]\\[th006\\]').val('');
		$('#order_product\\['+row+'\\]\\[th006disp\\]').val('');
		$('#order_product\\['+row+'\\]\\[th007\\]').val('');
		$('#order_product\\['+row+'\\]\\[th007_mv002\\]').val('');
		$('#order_product\\['+row+'\\]\\[th008\\]').val('');
		$('#order_product\\['+row+'\\]\\[th009\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/ast/asti12/lookup_body_check_asti14/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[th003\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[th004\\]').val('');
				$('#order_product\\['+row+'\\]\\[th005\\]').val('');
				$('#order_product\\['+row+'\\]\\[th005_mb002\\]').val('');
				$('#order_product\\['+row+'\\]\\[th005_mb003\\]').val('');
				$('#order_product\\['+row+'\\]\\[th006\\]').val('');
				$('#order_product\\['+row+'\\]\\[th006disp\\]').val('');
				$('#order_product\\['+row+'\\]\\[th007\\]').val('');
				$('#order_product\\['+row+'\\]\\[th007_mv002\\]').val('');
				$('#order_product\\['+row+'\\]\\[th008\\]').val('');
				$('#order_product\\['+row+'\\]\\[th009\\]').val('');
				$('#order_product\\['+row+'\\]\\[th003\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[th003\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[th003\\]').focus();
			}
		}
	});
}
</script>
<div id="divFasti12_asti14_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframe_asti12_asti14" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>