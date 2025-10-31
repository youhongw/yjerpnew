<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#tc002').val("");
	var acri01 = $('#acri01').val();
	var tc017 = $('#tc017').val();
	//alert(acri01);
	console.log(acri01);
	console.log(tc017);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri03/check_title_no",
		data: {
			acri01: acri01, 
			tc017: tc017
		}
	})
	.done(function( msg ) {
		if($('#acri01disp').text()!=""&&$('#acri01disp').text()!="查無資料")
		$('#tc002').val(msg);
	});
}

//查詢結帳單開視窗 acri02 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[td006\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[td006\\]').val();
			$('#order_product\\['+row+'\\]\\[td006\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookupd_acri02/'+encodeURIComponent(smb001), 
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
				$('#order_product\\['+row+'\\]\\[td006\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[td007\\]').val(ui.item.value2);
			//	$('#order_product\\['+row+'\\]\\[td007\\]').val(row);
			//	$('#order_product\\['+row+'\\]\\[td008\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[td012\\]').val(ui.item.value6);
				$('#order_product\\['+row+'\\]\\[td013\\]').val(ui.item.value6-ui.item.value7);
			//	$('#order_product\\['+row+'\\]\\[td016\\]').val(ui.item.value8);
			//	$('#order_product\\['+row+'\\]\\[td017\\]').val(ui.item.value9);
			//	$('#order_product\\['+row+'\\]\\[td018\\]').val(ui.item.value10);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[td005\\]').attr('onchange','check_acri021d(this)');
			check_acri02d(row);  //1060713 新增
			//check_acri02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算
	$('input[name=\'order_product[' + row + '][td011]\'],input[name=\'order_product[' + row + '][td014]\'],input[name=\'order_product[' + row + '][td015]\'],input[name=\'order_product[' + row + '][td017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 		
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td015]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][td014]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	 //單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][td015]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//備註
	$('input[name=\'order_product[' + row + '][td017]\']').focus(function() {
		
		$('input[name=\'order_product[' + n + '][td004]\']').val(); 
	});
	//單身品號圖1視窗 (廠商單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#copi01a').val());
		if($('#copi01a').val()=='') {alert('請先選擇廠商代號!');return;}
		
		$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/acr/acri02/display_child/"+$("#copi01a").val() );
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
		message: $('#divFacri02'),
		onOverlayClick: clear_acri02disp_sql
	});
	 $('.close').click($.unblockUI);
	});
}
//開圖1視窗(廠商單價計價檔copi02)回傳值
function addacri02disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(me002); //品名
	/*$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[td010\\]').val(me004); //單位
	$('#order_product\\['+selected_row+'\\]\\[td011\\]').val(me005); //單價
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(me006); //庫別
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(me007); //庫別名稱 */
	
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri02/clear_sql"
	});
}

function clear_acri02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri02/clear_sql"
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
                url: '<?php echo base_url(); ?>index.php/cms/cmsi06/lookupd_cmsi06/'+encodeURIComponent(smb002), 
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
			$('#cmsi06').attr('onchange','check_cmsi06d(this)');
			check_cmsi06d(row);  //1060713 新增
			//check_cmsi06d($('#order_product\\['+row+'\\]\\[td007\\]').val());
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
	var sumamt=0;sumamt1=0;sumTax =0;tax =0.00;vtax=0.00; 
	var index0=1;index1=1;index2=1;index3=0;index4=0;
	var price=0;qty=0;qty1=0;qty2=0;temp1=0;amt=0;sumamt=0;
	//原幣借貸方金額 
	$(".total_price").each(function(index, element) {
		  var acctdc=$('select[name=\'order_product[' + index1 + '][td004]\']').attr('value');
		    console.log(acctdc);
		if( acctdc=='1') {
		    if (isNaN($('input[name=\'order_product[' + index1 + '][td014]\']').val()) ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index1 + '][td014]\']').val(); }
			index1=index1+1;
			if ( isNaN(qty)  ||   qty == null || qty=='' ) {qty=0;}
			   sumQty +=parseFloat(qty);
               $('#tc011').val(sumQty);			   
			   console.log(sumQty);
	      }
		if( acctdc=='-1') {
		    if (isNaN($('input[name=\'order_product[' + index1 + '][td014]\']').val()) ) {qty=0;} else 
		    { qty1=$('input[name=\'order_product[' + index1 + '][td014]\']').val(); }
			index1=index1+1;
			if ( isNaN(qty1)  ||   qty1 == null || qty1=='' ) {qty1=0;}
			   sumQty1 +=parseFloat(qty1);
               $('#tc012').val(sumQty1);			   
			   console.log(sumQty1);
	      }
		//end 原幣差額
	var sumtot =Math.round(sumQty-sumQty1);
	$('#tc1112').val(Math.round(sumtot));  
    });	
	
	//本幣借貸方金額 
	$(".total_qty").each(function(index, element) {
		  var acctdc=$('select[name=\'order_product[' + index2 + '][td004]\']').attr('value');
		    console.log(acctdc);
		if( acctdc=='1') {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][td015]\']').val()) ) {amt=0;} else 
		    { amt=$('input[name=\'order_product[' + index2 + '][td015]\']').val(); }
			index2=index2+1;
			if ( isNaN(amt)  ||   amt == null || amt=='' ) {amt=0;}
			   sumamt +=parseFloat(amt);
               $('#tc013').val(sumamt);			   
			   console.log(sumamt);
	      }
		if( acctdc=='-1') {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][td015]\']').val()) ) {amt=0;} else 
		    { amt1=$('input[name=\'order_product[' + index2 + '][td015]\']').val(); }
			index2=index2+1;
			if ( isNaN(amt1)  ||   amt1 == null || amt1=='' ) {amt1=0;}
			   sumamt1 +=parseFloat(amt1);
               $('#tc014').val(sumamt1);			   
			   console.log(sumamt1);
	      }
		//end 本幣差額
	var sumtot1 =Math.round(sumamt-sumamt1);
	$('#tc1314').val(Math.round(sumtot1));  
    });	
	
	
	
}
//--></script>

<script>
function del_detail(td001,td002,td003,row){
	if(confirm("確定刪除細項:"+td001+"-"+td002+"-"+td003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri03/del_detail_ajax",
		data: { 
			td001: td001, 
			td002: td002,
			td003: td003
		}
	})
	.done(function( msg ) {
		if(msg){
		//	alert( "刪除細項:"+td001+"-"+td002+"-"+td003+" 成功!");
			$("#product_row_"+row).remove();
			totalSum();
		//	current_count -=1;
		//	addItem();
		}
		else{  alert ( "刪除細項:"+td001+"-"+td002+"-"+td003+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_td00'+k).val("");
		$('#product-row'+row+' input.order_product_td0'+k).val("");
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
			$('input[name="cmsi06"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#tc010').focus();
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
			$('input[name=\'order_product[1][td004]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>
<script>
//查詢進貨憑證視窗
function search_acri02d_window(row_obj){
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
		message: $('#divFacri02d'),
		onOverlayClick: clear_acri02disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addacri02ddisp(ta001,ta002,ta038,tg2930,ta029,ta030,ta031){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(ta001);
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(ta002);
	//$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(selected_row);
	//$('#order_product\\['+selected_row+'\\]\\[td008\\]').val(ta014);
	$('#order_product\\['+selected_row+'\\]\\[td012\\]').val(ta2930);
	$('#order_product\\['+selected_row+'\\]\\[td013\\]').val(ta2930-ta031);
	//$('#order_product\\['+selected_row+'\\]\\[td016\\]').val(ta019);
	//$('#order_product\\['+selected_row+'\\]\\[td017\\]').val(ta031);
	//$('#order_product\\['+selected_row+'\\]\\[td018\\]').val(ta032);
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri02/clear_sql"
	});
}
function mult_addacri02ddisp(ta001,ta002,ta038,tg2930,ta029,ta030,ta031){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[td006\\]').val(ta001);
	$('#order_product\\['+current_count+'\\]\\[td007\\]').val(ta002);
	/*$('#order_product\\['+current_count+'\\]\\[td007\\]').val(current_count);
	$('#order_product\\['+current_count+'\\]\\[td008\\]').val(ta014); */
	$('#order_product\\['+selected_row+'\\]\\[td012\\]').val(ta2930);
	$('#order_product\\['+selected_row+'\\]\\[td013\\]').val(ta2930-ta031);
	/*$('#order_product\\['+current_count+'\\]\\[td016\\]').val(ta019);
	$('#order_product\\['+current_count+'\\]\\[td017\\]').val(ta031);
	$('#order_product\\['+current_count+'\\]\\[td018\\]').val(ta032); */
	addItem();
}
function clear_acri02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri02/clear_sql"
	});
}
//
//查詢會計科目視窗 acti03d_child_v 多筆單筆皆可
function search_acti03d_window(row_obj){
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
		message: $('#divFacti03d'),
		onOverlayClick: clear_acti03disp_sql
	});
	  $('.close').click($.unblockUI);
}
//回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
function addacti03ddisp(mb001, mb002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td008\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td008disp\\]').val(mb002);
	//$('#order_product\\['+selected_row+'\\]\\[td013\\]').val(mb003);
	//$('#order_product\\['+selected_row+'\\]\\[td008\\]').val(mb004);
	//$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(mb005);
	//$('#order_product\\['+selected_row+'\\]\\[td006disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[td008\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
function mult_addacti03ddisp(mb001, mb002 ){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[td008\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[td008disp\\]').val(mb002);
	//$('#order_product\\['+current_count+'\\]\\[td013\\]').val(mb003);
	//$('#order_product\\['+current_count+'\\]\\[td008\\]').val(mb004);
	//$('#order_product\\['+current_count+'\\]\\[td006\\]').val(mb005);
	//$('#order_product\\['+current_count+'\\]\\[td006disp\\]').val(mb006);
	addItem();
}
function clear_acti03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
//查詢部門視窗 
function search_cmsi05d_window(row_obj){
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
		message: $('#divFcmsi05d'),
		onOverlayClick: clear_cmsi06disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addcmsi05ddisp(mb001, mb002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td021\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td021disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[td021\\]').focus();
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
//查詢庫別視窗 改幣別
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
			width: '50%',
			overflow:'hidden',
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
	$('#order_product\\['+selected_row+'\\]\\[td010\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td010disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[td010\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql"
	});
}
function clear_cmsi06disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi06/clear_sql"
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_acri02d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[td006\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/acr/acri02/lookupd2_acri02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[td006\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[td007\\]').val(data.message[0].value2);
			/*	$('#order_product\\['+row+'\\]\\[td008\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[td009\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[td017\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[td018\\]').val(data.message[0].value6);
				$('#order_product\\['+row+'\\]\\[td019\\]').val(data.message[0].value7);
				$('#order_product\\['+row+'\\]\\[td020\\]').val(data.message[0].value8); */
			}else{
				$('#order_product\\['+row+'\\]\\[td005\\]').val("查無資料");
			}
		}
	});
}
//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_acti03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[td008\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/act/acti03/lookupd_acti03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:smb001},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[td008\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[td008disp\\]').val(data.message[0].value2);
			//	$('#order_product\\['+row+'\\]\\[td013\\]').val(data.message[0].value3);
			//	$('#order_product\\['+row+'\\]\\[td008\\]').val(data.message[0].value4);
			//	$('#order_product\\['+row+'\\]\\[td006\\]').val(data.message[0].value5);
			//	$('#order_product\\['+row+'\\]\\[td006disp\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[td008\\]').val("查無資料");
			}
		}
	}); 
}
//部門
function check_cmsi05d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[td021\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookupd_cmsi05/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[td021\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[td021disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[td021\\]').val("查無資料");
			}
		}
	});
}
//幣別
function check_cmsi06d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[td010\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi06/lookupd_cmsi06/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[td010\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[td010disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[td010\\]').val("查無資料");
			}
		}
	});
}
</script>	   
<!--開視窗 結帳單    -->
<div id="divFacri02d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/acr/acri02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
<!--開視窗 科目代號    -->
<div id="divFacti03d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/act/acti03/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 部門代號    -->
<div id="divFcmsi05d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi05/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 幣別代號    -->
<div id="divFcmsi06d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi06/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗圖1廠商計價 copi02 有屬性不必下 src   -->
<div id="divFacri02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/pur/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>