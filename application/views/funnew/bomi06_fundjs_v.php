<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#tf002').val("");
	var bomi03 = $('#bomi03').val();
	var tf012 = $('#tf012').val();
	var tf012 = tf012.substr(0,4)+tf012.substr(5,2)+tf012.substr(8,2);
	//alert(bomi03);
	console.log(bomi03);
	console.log(tf012);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/bom/bomi06/check_title_no",
		data: {
			bomi03: bomi03, 
			tf012: tf012
		}
	})
	.done(function( msg ) {
		if($('#bomi03disp').text()!=""&&$('#bomi03disp').text()!="查無資料")
		$('#tf002').val(msg);
	});
}

//查詢品名規格開視窗 copi05 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[tg004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[tg004\\]').val();
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
			//品號,品名,規格,單位,單價,庫別,庫別名稱
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[tg004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tg004disp\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[tg004disp\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[tg005\\]').val(ui.item.value4);
				//$('#order_product\\['+row+'\\]\\[tg007\\]').val(ui.item.value5);
				//$('#order_product\\['+row+'\\]\\[tg007disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[tg004\\]').attr('onchange','check_invi02d(this)');
			check_invi02d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[tg004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算 8改7數量, 11改9 單價, 折扣率26 改1 , 金額12改10
	$('input[name=\'order_product[' + row + '][tg008]\'],input[name=\'order_product[' + row + '][tg011]\'],input[name=\'order_product[' + row + '][tg012]\'],input[name=\'order_product[' + row + '][tg200]\'],input[name=\'order_product[' + row + '][tg201]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1; 
        var input_3=$('input[name=\'order_product[' + n + '][tg200]\']').val()*1; 
        	  
		var get_total=input_1*input_3;  
		$('input[name=\'order_product[' + n + '][tg201]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	
	 //單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tg008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tg200]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	//單身品號圖1視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#puri01').val());
		if($('#puri01').val()=='') {alert('請先選擇客戶代號!');return;}
		
		$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#puri01").val() );
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
		message: $('#divFcopi02'),
		onOverlayClick: clear_copi02disp_sql
	});
	 $('.close').click($.unblockUI);
	});
   //單身品號圖2視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#ordera'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#puri01').val());
		
		$('#hpa_ifmain').attr('src',"<?php echo base_url()?>index.php/bom/bomi02/edit_child/"+$("#puri01").val() );
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
		message: $('#divFcopi02a'),
		onOverlayClick: clear_copi02disp_sql
	});
	 $('.close').click($.unblockUI);
	});
}
$(document).ready(function(){
	$("#Showbomc02a").click(function() {
	//	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#invi02').val());
		if($('#invi02').val()=='') {alert('請先選擇產品代號!');return;}
		
		$('#hpa_ifmain').attr('src',"<?php echo base_url()?>index.php/bom/bomi02/editb_child/"+$("#invi02").val()+'/'+$('#tf007').val() );
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
		message: $('#divFcopi02a'),
		onOverlayClick: clear_copi02disp_sql
	});
	 $('.close').click($.unblockUI);
	});
	});	

//匯入明細圖2 固定 moci02 函數
function import_moci02(mz001,mz002,mz003,mz004,mz006,mz006disp){
	console.log('mz001');
	console.log(mz001);
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/bom/bomi06/import_bomi02",
		data: {
			mz001: mz001,
            mz002: mz002,
            mz003: mz003,			
			mz004: mz004,
			mz006: mz006
		}
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無資料可匯入!");
		}else{
			console.log('test9');
		//	if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					//addItem();
					$('#order_product\\['+current_count+'\\]\\[tg004\\]').val(val['md003']);
					$('#order_product\\['+current_count+'\\]\\[tg004disp\\]').val(val['mb002']);
					$('#order_product\\['+current_count+'\\]\\[tg004disp\\]').val(val['mb003']);
					$('#order_product\\['+current_count+'\\]\\[tg005\\]').val(val['md004']);
					$('#order_product\\['+current_count+'\\]\\[tg008\\]').val(val['md006']*mz002);
					$('#order_product\\['+current_count+'\\]\\[tg007\\]').val(mz006);
					$('#order_product\\['+current_count+'\\]\\[tg007disp\\]').val(mz006disp);
				    addItem();
				}
				
		//	}
		}
		
	});
}
//開圖1視窗(客戶單價計價檔copi02)回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
function addcopi02disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tg004\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[tg004disp\\]').val(me002); //品名
	$('#order_product\\['+selected_row+'\\]\\[tg004disp1\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[tg005\\]').val(me004); //單位
//	$('#order_product\\['+selected_row+'\\]\\[tg009\\]').val(me005); //單價
//	$('#order_product\\['+selected_row+'\\]\\[tg007\\]').val(me006); //庫別
//	$('#order_product\\['+selected_row+'\\]\\[tg007disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[tg004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
	});
}

function clear_copi02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
	});
}
//查詢庫別下拉選單 set_catcomplete2 暫modi 222
function set_catcomplete2(row){ } 
function set_catcomplete222(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[tg007\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tg007\\]').val();
			$('#order_product\\['+row+'\\]\\[tg007\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[tg007\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tg007disp\\]').val(ui.item.value2);
			}
			return false;
		},
		change: function(event, ui) {
			$('#cmsi03').attr('onchange','check_cmsi03d(this)');
			check_cmsi03d(row);  //1060713 新增
			//check_cmsi03d($('#order_product\\['+row+'\\]\\[tg007\\]').val());
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
	var index1=0;index2=0;index3=0;index4=0;
	var price=0;qty=0;qty1=0;qty2=0;temp1=0;
	//成本金額 td201 
    $(".total_price").each(function(index, element) {
			price=$('input[name=\'order_product[' + index1 + '][tg201]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][tg201]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][tg201]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		 $('#td201').val(sumamt);
		 var vtf007 = $('#tf007').val();
		 sumamt1 = sumamt/parseFloat(vtf007);
		 $('#td200').val(sumamt1);
		  console.log(sumamt);
    //end 訂單金額合計
	
	
	
   
	
}
//--></script>

<script>
function del_detail(tg001,tg002,tg003,row){
	if(confirm("確定刪除細項:"+tg001+"-"+tg002+"-"+tg003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/bom/bomi06/del_detail_ajax",
		data: { 
			tg001: tg001, 
			tg002: tg002,
			tg003: tg003
		}
	})
	.done(function( msg ) {
		if(msg){
		//	alert( "刪除細項:"+tg001+"-"+tg002+"-"+tg003+" 成功!");
			$("#product_row_"+row).remove();
			totalSum();
		//	current_count -=1;
		//	addItem();
		}
		else{  alert ( "刪除細項:"+tg001+"-"+tg002+"-"+tg003+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_tg00'+k).val("");
		$('#product-row'+row+' input.order_product_tg0'+k).val("");
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
			$('#tf010').focus();
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
			$('input[name=\'order_product[1][tg004]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>
<script>
//查詢產品視窗 invi02d_child_v 多筆單筆皆可
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
//回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
function addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tg004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tg004disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tg004disp1\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[tg005\\]').val(mb004);
	//$('#order_product\\['+selected_row+'\\]\\[tg007\\]').val(mb005);
	//$('#order_product\\['+selected_row+'\\]\\[tg007disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[tg004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[tg004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[tg004disp\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[tg004disp1\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[tg005\\]').val(mb004);
	//$('#order_product\\['+current_count+'\\]\\[tg007\\]').val(mb005);
	//$('#order_product\\['+current_count+'\\]\\[tg007disp\\]').val(mb006);
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
	$('#order_product\\['+selected_row+'\\]\\[tg007\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tg007disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tg007\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[tg004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tg004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tg004disp\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tg004disp\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[tg005\\]').val(data.message[0].value4);
			//	$('#order_product\\['+row+'\\]\\[tg007\\]').val(data.message[0].value5);
			//	$('#order_product\\['+row+'\\]\\[tg007disp\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[tg004\\]').val("查無資料");
			}
		}
	});
}
//庫別
function check_cmsi03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tg007\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tg007\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tg007disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tg007\\]').val("查無資料");
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
<!-- <iframe src="<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>
<!--開視窗圖2整套展開 copi02 有屬性不必下 src   -->
<div id="divFcopi02a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hpa_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>