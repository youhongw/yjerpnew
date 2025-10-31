<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#ta002').val("");
	var acti02 = $('#acti02').val();
	var ta003 = $('#ta003').val();
	//alert(acti02);
	console.log(acti02);
	console.log(ta003);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti10/check_title_no",
		data: {
			acti02: acti02, 
			ta003: ta003
		}
	})
	.done(function( msg ) {
		if($('#acti02disp').text()!=""&&$('#acti02disp').text()!="查無資料")
		$('#ta002').val(msg);
	});
}
     
 function checkbalance(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	 var vta007=$('input[name=\'ta007\']').val();
	 var vta008=$('input[name=\'ta008\']').val();
	 //  alert(selval);
	 if (vta007==vta008) {
	     return true;}
     else
		{ alert('借貸不平衡');return false;}
}


//查詢會計科目開視窗 acti03 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[tb005\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[tb005\\]').val();
			$('#order_product\\['+row+'\\]\\[tb005\\]').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/act/acti03/lookupd_acti03/'+encodeURIComponent(smb001), 
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
			//品號,品名,規格,單位,單價,庫別,庫別名稱
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[tb005\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tb005disp\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[tb013\\]').val(ui.item.value3);
				//$('#order_product\\['+row+'\\]\\[tb008\\]').val(ui.item.value4);
				//$('#order_product\\['+row+'\\]\\[tb006\\]').val(ui.item.value5);
				//$('#order_product\\['+row+'\\]\\[tb006disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[tb005\\]').attr('onchange','check_acti03d(this)');
			check_acti03d(row);  //1060713 新增
			//check_acti03d($('#order_product\\['+row+'\\]\\[tb004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算 15,7 原幣,本幣
	$('input[name=\'order_product[' + row + '][tb007]\'],input[name=\'order_product[' + row + '][tb015]\'],input[name=\'order_product[' + row + '][tb014]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb007]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb015]\']').val()*1;
        var input_3=$('input[name=\'order_product[' + n + '][tb014]\']').val()*1;	  
		var get_total=input_2*input_3;  
		$('input[name=\'order_product[' + n + '][tb007]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	
	
	 //本幣金額  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tb015]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//原幣金額游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][tb007]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	 //匯率  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tb014]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//摘要
	$('input[name=\'order_product[' + row + '][tb010]\']').focus(function(){
		totalSum();	
	});  
	
	//單身品號圖1視窗 (客戶單價計價檔acti03) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
			$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/act/acti03/displayd_child" );	
		//$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/act/acti03/displayd_child/"+$("#acti02").val() );
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
		message: $('#divFacti03'),
		onOverlayClick: clear_acti03disp_sql
	});
	 $('.close').click($.unblockUI);
	});
  }
//開圖1視窗(客戶單價計價檔acti03)回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
function addacti03disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tb005\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[tb005disp\\]').val(me002); //品名
	//$('#order_product\\['+selected_row+'\\]\\[tb006\\]').val(me003); //規格
	//$('#order_product\\['+selected_row+'\\]\\[tb008\\]').val(me004); //單位
	//$('#order_product\\['+selected_row+'\\]\\[tb009\\]').val(me005); //單價
//	$('#order_product\\['+selected_row+'\\]\\[tb006\\]').val(me006); //庫別
//	$('#order_product\\['+selected_row+'\\]\\[tb006disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[tb005\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}

function clear_acti03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
//查詢庫別下拉選單 set_catcomplete2 暫modi 222
function set_catcomplete2(row){ 
console.log(row);
    $('#order_product\\['+row+'\\]\\[tb006\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tb006\\]').val();
			$('#order_product\\['+row+'\\]\\[tb006\\]').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookupd_cmsi05/'+encodeURIComponent(smb002), 
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
				$('#order_product\\['+row+'\\]\\[tb006\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tb006disp\\]').val(ui.item.value2);
			}
			return false;
		},
		change: function(event, ui) {
			$('#cmsi05').attr('onchange','check_cmsi05d(this)');
			check_cmsi05d(row);  //1060713 新增
			//check_cmsi05d($('#order_product\\['+row+'\\]\\[tb006\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
}


</script>
<script type="text/javascript"><!--  //合計金額
function totalSum1() {

    var sumTotal = 0;
	var sumTotal1 = 0;
	var sumTotal2 = 0;
	var sumTotal3 = 0;
	var sumQty = 0;
	var product_row1 = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
	
	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value=='1') {		    
			sumTotal += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb015]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!='1') {		    
			sumTotal1 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb015]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value=='1') {		    
			sumTotal2 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb007]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!='1') {		    
			sumTotal3 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb007]\']').val());			
		}
		product_row1++;
    });
   
    form.ta007.value=Math.round(sumTotal2);	  //本幣借方金額
      form.ta008.value=Math.round(sumTotal3);	  //本幣貸方金額
	var sumTot =Math.round(sumTotal-sumTotal1);
  	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal2-sumTotal3);
 	$("#sum_tot1").html(sumTot1.toFixed(1));	

		
}
function totalSum() {

    var sumTotal = 0;
	var sumQty = 0;sumQty1 = 0;sumQty2 = 0;
	var product_row = 0; 
	var sumamt=0;sumTax =0;tax =0.00;vtax=0.00; 
	var index0=1;index1=0;index2=1;index3=0;index4=0;
	var price=0;qty=0;qty1=0;qty2=0;temp1=0;
		
	   //借貸方金額 
	$(".total_qty").each(function(index, element) {
		  var acctdc=$('select[name=\'order_product[' + index2 + '][tb004]\']').attr('value');
		    console.log(acctdc);
		if( acctdc=='1') {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][tb007]\']').val()) ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][tb007]\']').val(); }
			index0=index0+1;
			index2=index2+1;
			if ( isNaN(qty)  ||   qty == null || qty=='' ) {qty=0;}
			   sumQty +=parseFloat(qty);
               $('#ta007').val(sumQty);			   
			   console.log(sumQty);
	      }
		if( acctdc=='-1') {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][tb007]\']').val()) ) {qty=0;} else 
		    { qty1=$('input[name=\'order_product[' + index2 + '][tb007]\']').val(); }
			index0=index0+1;
			index2=index2+1;
			if ( isNaN(qty1)  ||   qty1 == null || qty1=='' ) {qty1=0;}
			   sumQty1 +=parseFloat(qty1);
               $('#ta008').val(sumQty1);			   
			   console.log(sumQty1);
	      }
    });	
}
//--></script>

<script>
function del_detail(tb001,tb002,tb003,row){
	if(confirm("確定刪除細項:"+tb001+"-"+tb002+"-"+tb003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti10/del_detail_ajax",
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
			$('input[name=\'order_product[1][tb005]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w alt+下鍵
	if(event.altKey && (keycode == '87' || keycode == '40')){
		addItem();
	}
});
//--></script>
<script>
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
function addacti03ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tb005\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tb005disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tb013\\]').val(mb003);
	//$('#order_product\\['+selected_row+'\\]\\[tb008\\]').val(mb004);
	//$('#order_product\\['+selected_row+'\\]\\[tb006\\]').val(mb005);
	//$('#order_product\\['+selected_row+'\\]\\[tb006disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[tb004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
function mult_addacti03ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[tb005\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[tb005disp\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[tb013\\]').val(mb003);
	//$('#order_product\\['+current_count+'\\]\\[tb008\\]').val(mb004);
	//$('#order_product\\['+current_count+'\\]\\[tb006\\]').val(mb005);
	//$('#order_product\\['+current_count+'\\]\\[tb006disp\\]').val(mb006);
	addItem();
}
function clear_acti03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_sql"
	});
}
//
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
		onOverlayClick: clear_cmsi05disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addcmsi05ddisp(mb001, mb002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tb006\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tb006disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tb006\\]').focus();
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
function addcmsi06ddisp(mb001, mb002,mb003){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tb013\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tb014\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[tb013\\]').focus();
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
function check_acti03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tb005\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb005\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tb005disp\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tb013\\]').val(data.message[0].value3);
			//	$('#order_product\\['+row+'\\]\\[tb008\\]').val(data.message[0].value4);
			//	$('#order_product\\['+row+'\\]\\[tb006\\]').val(data.message[0].value5);
			//	$('#order_product\\['+row+'\\]\\[tb006disp\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[tb005\\]').val("查無資料");
			}
		}
	}); 
}
//部門
function check_cmsi05d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tb006\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb006\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tb006disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tb006\\]').val("查無資料");
			}
		}
	});
}
//幣別
function check_cmsi06d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tb013\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tb013\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tb014\\]').val(data.message[0].value3);
			}else{
				$('#order_product\\['+row+'\\]\\[tb013\\]').val("查無資料");
			}
		}
	});
}
</script>	   
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

<!--開視窗 幣別    -->
<div id="divFcmsi06d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi06/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗圖1客戶計價 acti03 有屬性不必下 src   -->
<div id="divFacti03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/act/acti03/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>
