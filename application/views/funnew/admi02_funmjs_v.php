<script type="text/javascript"> 	
//查詢部門開視窗admi02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showadmi02disp").click(function() {
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
		message: $('#divFadmi02'),
		onOverlayClick: clear_admi02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#admi02').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var sme001= $('#admi02').val();
			$('#admi02').attr('onchange','');
			console.log(sme001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/adm/admi02/lookup_catcomplete/'+encodeURIComponent(sme001), 
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
				$('#admi02').val(ui.item.value1);
				$('#admi02disp').text(ui.item.value2);
				//console.log($('#admi02').val());
				return false;
			}else{
				$('#admi02disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#admi02').attr('onchange','check_admi02(this)');
			check_admi02($('#admi02').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addadmi02disp(sme001,sme002){
	//alert('test2');
	$('#admi02').val(sme001);
	$('#admi02disp').text(sme002);
	$('#admi02').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi02/clear_sql"
	});
}
function clear_admi02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi02/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文
function check_admi02(row_obj){
	var sme001= $('#admi02').val();
	if(!sme001){$('#admi02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/adm/admi02/lookup_check/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#admi02').val("");
					$('#admi02disp').text("查無資料");
				}
				$('#admi02').val(sme001);
				$('#admi02disp').text(data.message[0].value2);
			}else{
				$('#admi02').val(sme001);
				$('#admi02disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFadmi02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/adm/admi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script>
//以下為單身function
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[admi02\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[admi02\\]').val();
			$('#order_product\\['+row+'\\]\\[admi02\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/adm/admi02/lookup_body_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#order_product\\['+row+'\\]\\[admi02\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[admi02_mb002\\]').val(ui.item.value2);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[admi02\\]').attr('onchange','check_admi02_body(this)');
			check_admi02_body(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		},
		focus: function(event, ui) {
			return false;
		}
	});
}
//查詢部門代號視窗
function search_admi02_body_window(row_obj){
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
		message: $('#divFadmi02_body'),
		onOverlayClick: clear_admi02_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addadmi02_body(me001, me002){
	clear_row(selected_row);
	
	$('#order_product\\['+selected_row+'\\]\\[admi02\\]').val(me001);
	$('#order_product\\['+selected_row+'\\]\\[admi02_mb002\\]').val(me002);
	
	$('#order_product\\['+selected_row+'\\]\\[admi02\\]').focus();
	
	if(window.check_admi09_asti02_body){
	check_admi09_asti02_body($('#order_product\\['+selected_row+'\\]\\[admi02\\]'));
	}
	
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi02/clear_body_sql"
	});
}
function clear_admi02_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/adm/admi02/clear_body_sql"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_admi02_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[admi02\\]').val();
	
	if(!smb001){
		$('#order_product\\['+row+'\\]\\[admi02\\]').val('');
		$('#order_product\\['+row+'\\]\\[admi02_mb002\\]').val('');
		clear_row(row);return;
		}
	
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/adm/admi02/lookup_body_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[admi02\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[admi02_mb002\\]').val(data.message[0].value2);

				$('#order_product\\['+row+'\\]\\[admi02\\]').focus();
			}else{
				$('#order_product\\['+row+'\\]\\[admi02\\]').val("查無資料");
				$('#order_product\\['+row+'\\]\\[admi02\\]').focus();
			}
		}
	});
}
</script>
<div id="divFadmi02_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/adm/admi02/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

