<script type="text/javascript"> 	
//檢查最新編號

//查詢品名規格開視窗 noti08 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[to004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[to004\\]').val();
			$('#order_product\\['+row+'\\]\\[to004\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi06/lookupd_cmsi06/'+encodeURIComponent(smb001), 
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
				$('#order_product\\['+row+'\\]\\[to004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[to004disp\\]').val(ui.item.value2);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[to004\\]').attr('onchange','check_cmsi06d(this)');
			check_cmsi06d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[to004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算
	
	//金額游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][to005]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	
function clear_noti08disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti08/clear_sql"
	});
}

function del_detail(to001,to002,row){
	if(confirm("確定刪除細項:"+to001+"-"+to002+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti08/del_detail_ajax",
		data: { 
			to001: to001, 
			to002: to002
		}
	})
	.done(function( msg ) {
		if(msg){
		//	alert( "刪除細項:"+to001+"-"+to002+"-"+to003+" 成功!");
			$("#product_row_"+row).remove();
			totalSum();
		//	current_count -=1;
		//	addItem();
		}
		else{  alert ( "刪除細項:"+to001+"-"+to002+"-"+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_to00'+k).val("");
		$('#product-row'+row+' input.order_product_to0'+k).val("");
		$('#product-row'+row+' input.order_product_td'+k).val("");
	}
}
</script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	
	//跳明細
	if(event.altKey && (keycode == '89')){  //tab6 y
		setTimeout(function() {
			$('input[name=\'order_product[1][to003]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>
<script>
//查詢幣別視窗
function search_cmsi06d_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '70%',
			overflow:'auto',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi06d'),
		onOverlayClick: clear_cmsi06disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addcmsi06ddisp(mb001, mb002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[to004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[to004disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[to004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql"
	});
}
function mult_addcmsi06ddisp(mb001, mb002){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[to004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[to004disp\\]').val(mb002);
	addItem();
}
function clear_cmsi06disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql"
	});
}

//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_cmsi06d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[to004\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi06/lookupd2_cmsi06/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[to004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[to004disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[to004\\]').val("查無資料");
			}
		}
	});
}

</script>	   
<!--開視窗 品號品名    -->
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 庫別    -->
<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi03/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗圖1客戶計價 copi02 有屬性不必下 src   -->
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>