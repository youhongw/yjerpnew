<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#tc002').val("");
	var puri04 = $('#puri04').val();
	var tc024 = $('#tc024').val();
	var tc024 = tc024.substr(0,4)+tc024.substr(5,2)+tc024.substr(8,2);
	//alert(puri04);
	console.log(puri04);
	console.log(tc024);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri07/check_title_no",
		data: {
			puri04: puri04, 
			tc024: tc024
		}
	})
	.done(function( msg ) {
		if($('#puri04disp').text()!=""&&$('#puri04disp').text()!="查無資料")
		$('#tc002').val(msg);
	});
}

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
				$('#order_product\\['+row+'\\]\\[td009\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[td007\\]').val(ui.item.value5);
				$('#order_product\\['+row+'\\]\\[td007disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[td004\\]').attr('onchange','check_invi02d(this)');
			check_invi02d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算
	$('input[name=\'order_product[' + row + '][td008]\'],input[name=\'order_product[' + row + '][td010]\'],input[name=\'order_product[' + row + '][td011]\'],input[name=\'order_product[' + row + '][td012]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td010]\']').val()*1;
      //  var input_3=$('input[name=\'order_product[' + n + '][td026]\']').val()/100; 		
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td011]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][td008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	 //單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][td010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//預設預交日期
	$('input[name=\'order_product[' + row + '][td012]\']').focus(function() {
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) {
           dd = '0'+dd
        } 

       if(mm<10) {
          mm = '0'+mm
        } 

        today =  yyyy + '/' + mm + '/' + dd;
		if ($('input[name=\'order_product[' + n + '][td012]\']').val()=='') {
		$('input[name=\'order_product[' + n + '][td012]\']').val(today); }
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
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[td005\\]').val(me002); //品名
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[td009\\]').val(me004); //單位
	$('#order_product\\['+selected_row+'\\]\\[td010\\]').val(me005); //單價
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(me006); //庫別
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').focus();
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
			check_cmsi03d(row);  //1060713 新增
			//check_cmsi03d($('#order_product\\['+row+'\\]\\[td007\\]').val());
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
	//採購單金額 tc019
    $(".total_price").each(function(index, element) {
			price=$('input[name=\'order_product[' + index1 + '][td011]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			//   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][td011]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][td011]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		 $('#tc019').val(sumamt);
		//  console.log(sumamt);
    //end 訂單金額合計
	
	//稅金 tc020
	tax=$('input[name=\'tc026\']').val();
	$('#tc020').val(Math.round(sumamt*tax));
	var sumTax =Math.round(sumamt*tax);
	var vtax=1+parseFloat(tax);
//	if ($('select[name=\'tc016\']').val()=='1') {$('#tc029').val()=Math.round(sumamt/parseFloat(vtax));$('#tc030').val()=Math.round(sumamt-$('#tc029').val());}
    if ($('select[name=\'tc018\']').val()=='1') {$('#tc019').val(Math.round(sumamt/parseFloat(vtax)));temp1=Math.round(sumamt-$('#tc019').val());$('#tc030').val(temp1);}
	var sumtot =Math.round(sumamt+sumTax);
	$('#tc019').val(sumamt);
	$('#tc020').val(sumTax);
	$('#tc1920').val(Math.round(sumtot));  //合計金額
	  //  console.log(sumtot);
	   //數量合計 tc023
	$(".total_qty").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][td008]\']').val()) ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][td008]\']').val(); }
			index2=index2+1;
			if ( isNaN(qty)  ||   qty == null || qty=='' ) {qty=0;}
			   sumQty +=parseFloat(qty);			
			  // console.log(sumQty);
    });
		if (typeof($('input[name=\'order_product[' + index2 + '][td008]\']').val()) == 'undefined' ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][td008]\']').val(); }
		if (isNaN(qty) ||   qty == null || qty=='' ) {qty=0;}
			 sumQty +=parseFloat(qty);
		 $('#tc023').val(sumQty);
		// console.log(sumQty);
    //end 數量合計
	
   //總毛重合計 tc043
	$(".total_qty1").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index3 + '][td030]\']').val()) ) {qty1=0;} else 
		    { qty1=$('input[name=\'order_product[' + index3 + '][td030]\']').val(); }
			index3=index3+1;
			if ( isNaN(qty1)  ||   qty1 == null || qty1=='' ) {qty1=0;}
			   sumQty1 +=parseFloat(qty1);			
			 //  console.log(sumQty1);
    });
		if (typeof($('input[name=\'order_product[' + index3 + '][td030]\']').val()) == 'undefined' ) {qty1=0;} else 
		    { qty1=$('input[name=\'order_product[' + index3 + '][td030]\']').val(); }
		if (isNaN(qty1) ||   qty1 == null || qty1=='' ) {qty1=0;}
			 sumQty1 +=parseFloat(qty1);
		 $('#tc043').val(sumQty1);
		// console.log(sumQty1);
    //end 總毛重合計
	
	//總材積合計 tc044
	$(".total_qty2").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index4 + '][td031]\']').val()) ) {qty2=0;} else 
		    { qty2=$('input[name=\'order_product[' + index4 + '][td031]\']').val(); }
			index4=index4+1;
			if ( isNaN(qty2)  ||   qty2 == null || qty2=='' ) {qty2=0;}
			   sumQty2 +=parseFloat(qty2);			
			//   console.log(sumQty2);
    });
		if (typeof($('input[name=\'order_product[' + index4 + '][td031]\']').val()) == 'undefined' ) {qty2=0;} else 
		    { qty2=$('input[name=\'order_product[' + index4 + '][td031]\']').val(); }
		if (isNaN(qty2) ||   qty2 == null || qty2=='' ) {qty2=0;}
			 sumQty2 +=parseFloat(qty2);
		 $('#tc044').val(sumQty2);
		// console.log(sumQty2);
    //end 總材積合計
	
}
//--></script>

<script>
function del_detail(td001,td002,td003,row){
	if(confirm("確定刪除細項:"+td001+"-"+td002+"-"+td003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri07/del_detail_ajax",
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
			$('input[name="cmsi05"]').focus();
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
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td005\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[td009\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(mb005);
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[td004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[td005\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[td006\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[td009\\]').val(mb004);
	$('#order_product\\['+current_count+'\\]\\[td007\\]').val(mb005);
	$('#order_product\\['+current_count+'\\]\\[td007disp\\]').val(mb006);
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
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').focus();
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
				$('#order_product\\['+row+'\\]\\[td009\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[td007\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[td007disp\\]').val(data.message[0].value6);
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

<!--開視窗圖1廠商計價 puri02 有屬性不必下 src   -->
<div id="divFpuri02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/pur/puri02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>