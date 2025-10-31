<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#ta002').val("");
	var invi04 = $('#invi04').val();
	var ta014 = $('#ta014').val();
	var ta014 = ta014.substr(0,4)+ta014.substr(5,2)+ta014.substr(8,2);
	//alert(invi04);
	console.log(invi04);
	console.log(ta014);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi08/check_title_no",
		data: {
			invi04: invi04, 
			ta014: ta014
		}
	})
	.done(function( msg ) {
		if($('#invi04disp').text()!=""&&$('#invi04disp').text()!="查無資料")
		$('#ta002').val(msg);
	});
}

//查詢品名規格開視窗 copi06 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[tb004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[tb004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tb005\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[tb006\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[tb008\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[tb012\\]').val(ui.item.value5);
				$('#order_product\\['+row+'\\]\\[tb012disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[tb004\\]').attr('onchange','check_invi02d(this)');
			check_invi02d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[tb004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算
	$('input[name=\'order_product[' + row + '][tb007]\'],input[name=\'order_product[' + row + '][tb010]\'],input[name=\'order_product[' + row + '][tb011]\'],input[name=\'order_product[' + row + '][tb012]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb007]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb010]\']').val()*1;
      //  var input_3=$('input[name=\'order_product[' + n + '][tb026]\']').val()/100; 		
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb011]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][tb007]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	 //單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tb010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	$('input[name=\'order_product[' + row + '][tb011]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//單身品號圖1視窗 (廠商單價計價檔puri02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#puri01').val());
		if($('#puri01').val()=='') {alert('請先選擇廠商代號!');return;}
		
		$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/pur/puri02/display_child/"+$("#puri01").val() );
		$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '75%',
			overflow:'auto',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri02'),
		onOverlayClick: clear_puri02disp_sql
	});
	 $('.close').click($.unblockUI);
	});
}
//開圖1視窗(廠商單價計價檔puri02)回傳值
function addpuri02disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tb004\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[tb005\\]').val(me002); //品名
	$('#order_product\\['+selected_row+'\\]\\[tb006\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[tb008\\]').val(me004); //單位
	$('#order_product\\['+selected_row+'\\]\\[tb010\\]').val(me005); //單價
	$('#order_product\\['+selected_row+'\\]\\[tb012\\]').val(me006); //庫別
	$('#order_product\\['+selected_row+'\\]\\[tb012disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[tb004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri02/clear_sql"
	});
}

function clear_puri02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri02/clear_sql"
	});
}
//查詢庫別下拉選單
function set_catcomplete2(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[tb012\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tb012\\]').val();
			$('#order_product\\['+row+'\\]\\[tb012\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[tb012\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tb012disp\\]').val(ui.item.value2);
			}
			return false;
		},
		change: function(event, ui) {
			$('#cmsi03').attr('onchange','check_cmsi03d(this)');
			check_cmsi03d(row);  //1060713 新增
			//check_cmsi03d($('#order_product\\['+row+'\\]\\[tb007\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
}

</script>
<script type="text/javascript"><!--  //合計金額

function totalSum() {

    var sumTotal = 0;
	var sumQty = 0;sumQty1 = 0;sumQty2 = 0;
	var product_row = 0; 
	var sumamt=0;sumTax =0;tax =0.00;vtax=0.00; 
	var index1=0;index2=0;index3=0;index4=0;
	var price=0;qty=0;qty1=0;qty2=0;temp1=0;
	//採購單金額 ta019
    $(".total_price").each(function(index, element) {
			price=$('input[name=\'order_product[' + index1 + '][tb011]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			//   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][tb011]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][tb011]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		 $('#ta012').val(sumamt);
		//  console.log(sumamt);
    //end 訂單金額合計
	
	
	   //數量合計 ta023
	$(".total_qty").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][tb007]\']').val()) ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][tb007]\']').val(); }
			index2=index2+1;
			if ( isNaN(qty)  ||   qty == null || qty=='' ) {qty=0;}
			   sumQty +=parseFloat(qty);			
			  // console.log(sumQty);
    });
		if (typeof($('input[name=\'order_product[' + index2 + '][tb007]\']').val()) == 'undefined' ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][tb007]\']').val(); }
		if (isNaN(qty) ||   qty == null || qty=='' ) {qty=0;}
			 sumQty +=parseFloat(qty);
		 $('#ta011').val(sumQty);
		// console.log(sumQty);
    //end 數量合計
	
  
}
//--></script>

<script>
function del_detail(tb001,tb002,tb003,row){
	if(confirm("確定刪除細項:"+tb001+"-"+tb002+"-"+tb003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi08/del_detail_ajax",
		data: { 
			tb001: tb001, 
			tb002: tb002,
			tb003: tb003
		}
	})
	.done(function( msg ) {
		if(msg){
		//	alert( "刪除細項:"+tb001+"-"+tb002+"-"+tb003+" 成功!");
			$("#product_row_"+row).remove();
			totalSum();
		//	current_count -=1;
		//	addItem();
		}
		else{  alert ( "刪除細項:"+tb001+"-"+tb002+"-"+tb003+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_tb00'+k).val("");
		$('#product-row'+row+' input.order_product_tb0'+k).val("");
		$('#product-row'+row+' input.order_product_td'+k).val("");
	}
}
</script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1 a
		setTimeout(function() {
			$('input[name="cmsi05"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#ta010').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3 c
		setTimeout(function() {
			$('#mv032').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4 g
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '72')){  //tab5 h
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '73')){  //tab6 i
		setTimeout(function() {
			$('#mv049').focus();
		}, 100);	
	}
	//跳明細
	if(event.altKey && (keycode == '89')){  //tab6 y
		setTimeout(function() {
			$('input[name=\'order_product[1][tb004]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>
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
			height: '75%',
			width: '70%',
			overflow:'auto',
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
	$('#order_product\\['+selected_row+'\\]\\[tb004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tb005\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tb006\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[tb008\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[tb012\\]').val(mb005);
	$('#order_product\\['+selected_row+'\\]\\[tb012disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[tb004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[tb004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[tb005\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[tb006\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[tb008\\]').val(mb004);
	$('#order_product\\['+current_count+'\\]\\[tb012\\]').val(mb005);
	$('#order_product\\['+current_count+'\\]\\[tb012disp\\]').val(mb006);
	addItem();
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
			height: '75%',
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
	$('#order_product\\['+selected_row+'\\]\\[tb012\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tb012disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tb012\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
//查詢入庫別視窗
function search_cmsi03d1_window(row_obj){
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
		message: $('#divFcmsi03d1'),
		onOverlayClick: clear_cmsi03disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addcmsi03d1disp(mb001, mb002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tb013\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tb013disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tb013\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[tb004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tb005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tb006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[tb008\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[tb012\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[tb012disp\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[tb004\\]').val("查無資料");
			}
		}
	});
}
//庫別
function check_cmsi03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tb012\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb012\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tb012disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tb012\\]').val("查無資料");
			}
		}
	});
}
//入庫別
function check_cmsi03d1(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tb013\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb013\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tb013disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tb013\\]').val("查無資料");
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
<!--開視窗 入庫別    -->
<div id="divFcmsi03d1" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi03/displaye_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗圖1廠商計價 puri02 有屬性不必下 src   -->
<div id="divFpuri02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/pur/puri02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>