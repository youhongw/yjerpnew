<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#tk002').val("");
	var noti06 = $('#noti06').val();
	var tk005 = $('#tk005').val();
	//alert(copi03);
	console.log(noti06);
	console.log(tk005);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti09/check_title_no",
		data: {
			noti06: noti06, 
			tk005: tk005
		}
	})
	.done(function( msg ) {
		if($('#noti06disp').text()!=""&&$('#noti06disp').text()!="查無資料")
		$('#tk002').val(msg);
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
				$('#order_product\\['+row+'\\]\\[td010\\]').val(ui.item.value4);
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
	$('input[name=\'order_product[' + row + '][td008]\'],input[name=\'order_product[' + row + '][td011]\'],input[name=\'order_product[' + row + '][td026]\'],input[name=\'order_product[' + row + '][td030]\'],input[name=\'order_product[' + row + '][td031]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;
        var input_3=$('input[name=\'order_product[' + n + '][td026]\']').val()/100; 		
		var get_total=input_1*input_2*input_3;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 
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
	$('input[name=\'order_product[' + row + '][td011]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	//預設預交日期
	$('input[name=\'order_product[' + row + '][td013]\']').focus(function() {
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
		if ($('input[name=\'order_product[' + n + '][td013]\']').val()=='') {
		$('input[name=\'order_product[' + n + '][td013]\']').val(today); }
	});
	//單身品號圖1視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#copi01').val());
		if($('#copi01').val()=='') {alert('請先選擇客戶代號!');return;}
		
		$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#copi01").val() );
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
}
//開圖1視窗(客戶單價計價檔copi02)回傳值
function addcopi02disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[td005\\]').val(me002); //品名
	$('#order_product\\['+selected_row+'\\]\\[td006\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[td010\\]').val(me004); //單位
	$('#order_product\\['+selected_row+'\\]\\[td011\\]').val(me005); //單價
	$('#order_product\\['+selected_row+'\\]\\[td007\\]').val(me006); //庫別
	$('#order_product\\['+selected_row+'\\]\\[td007disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[td004\\]').focus();
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
	//訂單金額 tc029
    $(".total_price").each(function(index, element) {
			price=$('input[name=\'order_product[' + index1 + '][td012]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			//   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][td012]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][td012]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		 $('#tc029').val(sumamt);
		//  console.log(sumamt);
    //end 訂單金額合計
	
	//稅金 tc030
	tax=$('input[name=\'tc041\']').val();
	$('#tc030').val(Math.round(sumamt*tax));
	var sumTax =Math.round(sumamt*tax);
	var vtax=1+parseFloat(tax);
//	if ($('select[name=\'tc016\']').val()=='1') {$('#tc029').val()=Math.round(sumamt/parseFloat(vtax));$('#tc030').val()=Math.round(sumamt-$('#tc029').val());}
    if ($('select[name=\'tc016\']').val()=='1') {$('#tc029').val(Math.round(sumamt/parseFloat(vtax)));temp1=Math.round(sumamt-$('#tc029').val());$('#tc030').val(temp1);}
	var sumtot =Math.round(sumamt+sumTax);
	$('#tc029').val(sumamt);
	$('#tc030').val(sumTax);
	$('#tc2930').val(Math.round(sumtot));  //合計金額
	  //  console.log(sumtot);
	   //數量合計 tc031
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
		 $('#tc031').val(sumQty);
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
		url: "<?php echo base_url() ?>index.php/cop/copi06/del_detail_ajax",
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

function find_noti06(){
	var find_noti06 = $('#noti06').val();
	return find_noti06;
}
//查詢借款批號視窗
function search_noti09d_window(row_obj,noti06){
	
	if(!noti06){
		noti06 = "0";
	}
	
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	
	$('#iframenoti09d').attr('src',"<?php echo base_url()?>index.php/not/noti09/display_child2/"+noti06);

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
		message: $('#divFnoti09d'),
		onOverlayClick: clear_noti09disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addnoti09ddisp(tj001, tl011, tl012){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl005\\]').val(tj001);
	$('#order_product\\['+selected_row+'\\]\\[tl011\\]').val(tl011);
	$('#order_product\\['+selected_row+'\\]\\[tl012\\]').val(tl012);
	$('#order_product\\['+selected_row+'\\]\\[tl005\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti09/clear_sql2"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[td004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[td005\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[td006\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[td010\\]').val(mb004);
	$('#order_product\\['+current_count+'\\]\\[td007\\]').val(mb005);
	$('#order_product\\['+current_count+'\\]\\[td007disp\\]').val(mb006);
	addItem();
}
function clear_noti09disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti09/clear_sql"
	});
}
//
//查詢銀行代號視窗
function search_noti01_body_window(row_obj){
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
		message: $('#divFnoti01_body'),
		onOverlayClick: clear_noti01_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addnoti01_body(mb001, mb002, mb003){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl009\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tl009disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tl009\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti01/clear_body_sql"
	});
}
function clear_noti01_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti01/clear_body_sql"
	});
}

//查詢會計科目視窗
function search_acti03_body_window(row_obj){
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
		message: $('#divFacti03_body'),
		onOverlayClick: clear_acti03_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addacti03_body(mb001, mb002, mb003){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tl013disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_body_sql"
	});
}
function clear_acti03_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti03/clear_body_sql"
	});
}

//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_noti09d(row_obj,noti06){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}

	var smb001 = $('#order_product\\['+row+'\\]\\[tl005\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti09/lookupd2_noti09/'+encodeURIComponent(smb001)+'/'+noti06, 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl005\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tl011\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tl012\\]').val(data.message[0].value3);
			}else{
				$('#order_product\\['+row+'\\]\\[tl005\\]').val("查無資料");
			}
		}
	});
}
//檢查銀行代號(單身)
function check_noti01_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tl009\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti01/lookupd_noti01_body/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl009\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tl009disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tl009\\]').val("查無資料");
			}
		}
	});
}

//應付票據單號(單身)
function check_noti03_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tl010\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti03/lookupd_noti03_body/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl010\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tl011\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(data.message[0].value3);
			}else{
				$('#order_product\\['+row+'\\]\\[tl010\\]').val("查無資料");
			}
		}
	});
}

//應收票據單號(單身)
function check_noti04_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tl010\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti04/lookupd_noti04_body/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl010\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tl011\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(data.message[0].value3);
			}else{
				$('#order_product\\['+row+'\\]\\[tl010\\]').val("查無資料");
			}
		}
	});
}

//會計科目(單身)
function check_acti03_body(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tl013\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/act/acti03/lookupd_acti03_body/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tl013disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tl013\\]').val("查無資料");
			}
		}
	});
}


</script>	   

<script>
function turn_tl008(){
	var temp_noti06 = ($('#noti06').val()).substr(0,2);
	if(temp_noti06 == "84" || temp_noti06 == "86"){
		$('.order_product_tl008').each(function(index,element){
			var temp2 = (element.id).substr(14,3);
			var temp3 = temp2.match(/\d+/)[0];
			
			console.log(temp3);
			
			$('#order_product\\['+temp3+'\\]\\[tl008\\] option').remove();
			$('#order_product\\['+temp3+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "1").text("1.現金"));
			$('#order_product\\['+temp3+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "2").text("2.轉帳"));
			
			$('#order_product\\['+temp3+'\\]\\[tl009\\]').attr("readonly","value");
			$('#order_product\\['+temp3+'\\]\\[tl010\\]').attr("readonly","value");
			$('#order_product\\['+temp3+'\\]\\[tl009\\]').attr("style","background-color:#F0F0F0");
			$('#order_product\\['+temp3+'\\]\\[tl010\\]').attr("style","background-color:#F0F0F0");
		});
	}else{
		$('.order_product_tl008').each(function(index,element){
			var temp2 = (element.id).substr(14,3);
			var temp3 = temp2.match(/\d+/);
			
			$('#order_product\\['+temp3+'\\]\\[tl008\\] option').remove();
			$('#order_product\\['+temp3+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "1").text("1.現金"));
			$('#order_product\\['+temp3+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "2").text("2.轉帳"));
			$('#order_product\\['+temp3+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "3").text("3.應付票據"));
			$('#order_product\\['+temp3+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "4").text("4.應收票據"));
			
			$('#order_product\\['+temp3+'\\]\\[tl009\\]').attr("readonly","value");
			$('#order_product\\['+temp3+'\\]\\[tl010\\]').attr("readonly","value");
			$('#order_product\\['+temp3+'\\]\\[tl009\\]').attr("style","background-color:#F0F0F0");
			$('#order_product\\['+temp3+'\\]\\[tl010\\]').attr("style","background-color:#F0F0F0");
		});
	}
}
</script>

<script>
//查詢票號視窗 (應付票據)
function search_noti03_body_window(row_obj){
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
		message: $('#divFnoti03_body'),
		onOverlayClick: clear_noti03_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addnoti03_body(mb001, mb002 , mb003){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl010\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tl011\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[tl010\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti03/clear_body_sql"
	});
}
function clear_noti03_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti03/clear_body_sql"
	});
}
</script>

<script>
//查詢票號視窗  (應收票據)
function search_noti04_body_window(row_obj){
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
		message: $('#divFnoti04_body'),
		onOverlayClick: clear_noti04_body_sql
	});
	  $('.close').click($.unblockUI);
}
function addnoti04_body(mb001, mb002, mb003){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl010\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tl011\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tl010\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti04/clear_body_sql"
	});
}
function clear_noti04_body_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti04/clear_body_sql"
	});
}
</script>


<script>
function addItem2(){
	//current_count = 0;
	var max_no = get_max_no();
	//$(".total_qty").each(function(index, element) {    //欄位要有一欄data_class 是 total_qty 才可以相加
	//	current_count +=1;
    //});
	current_count++;
	
	console.log(current_count);
	
	var append_str = "";
	var type = "";
	append_str += "<tbody id='product_row_"+current_count+"' class='product_row' >";
	append_str += "<tr>";
	append_str += "<td class='center'><img src='<?php echo base_url()?>assets/image/delete2.png' title='刪除資料' onclick='$(\"#product_row_"+current_count+"\").remove();totalSum();' /></td>";
	for(var key in usecol_array){
		var val = usecol_array[key];
		if(val['type']){type = val['type'];}else{type = "text";}
			append_str += "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
		if(val['data_class']){append_str += "class='"+val['data_class']+"' ";}
			append_str += ">";
		if(type == "text"){
			append_str += "<input type='"+type+"' id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"'  onKeyPress='keyFunction()' ";
			if(key == no_col){append_str += "value='"+(max_no*1+10)+"'"}
			if(val['size']){append_str += "size='"+val['size']+"' ";}
			if(val['id']){append_str += "id='"+val['id']+"' ";}
			if(val['class']){append_str += "class='"+val['class']+"' ";}
			if(val['onclick']){append_str += "onclick='"+val['onclick']+"' ";}
			if(val['onfocus']){append_str += "onfocus='"+val['onfocus']+"' ";}
			if(val['ondblclick']){append_str += "ondblclick='"+val['ondblclick']+"' ";}
			if(val['onchange']){append_str += "onchange='"+val['onchange']+"' ";}
			if(val['style']){append_str += "style='"+val['style']+"' ";}
			if(val['readonly']){append_str += "readonly='"+val['readonly']+"' ";}
			if(val['disable']){append_str += "disable='"+val['disable']+"' ";}
			if(val['value']){append_str += "value='"+val['value']+"' ";}
			if(val['required']){append_str += "required='"+val['required']+"' ";}
			append_str += " />";
		}
		
		if(type == "select"){
			append_str += "<select id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' ";
			if(val['size']){append_str += "size='"+val['size']+"' ";}
			if(val['onclick']){append_str += "onclick='"+val['onclick']+"' ";}
			if(val['ondblclick']){append_str += "ondblclick='"+val['ondblclick']+"' ";}
			if(val['onchange']){append_str += "onchange='"+val['onchange']+"' ";}
			if(val['style']){append_str += "style='"+val['style']+"' ";}
			if(val['readonly']){append_str += "readonly='"+val['readonly']+"' ";}
			if(val['disable']){append_str += "disable='"+val['disable']+"' ";}
			append_str += ">";
			append_str += "</select>";
		}
		
		if(type == "checkbox"){
			append_str += "<input type='"+type+"' id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' ";
			if(val['disable']){append_str += val['disable'];}
			append_str += " />";
		}
		if(val['name'] == '品號圖示1'){append_str += "<a href='javascript:;'><img name='order"+current_count+"' id='order"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek.png' alt='' align='top'/>" };
		if(val['name'] == '品號圖示2'){append_str += "<a href='javascript:;'><img name='ordera"+current_count+"' id='ordera"+current_count+"' src='<?php echo base_url()?>assets/image/png/seek.png' alt='' align='top'/>" };
		if(val['name'] == '折扣率%'){ append_str +=  "<span name='orderd"+current_count+"' id='orderd"+current_count+"'  align='top' >%</span>" };			
									
		append_str += "</td>";
	}
	
	append_str += "</tr>";
	append_str += "</tbody>";
	$('#order_product tfoot').before(append_str);
	
	//判斷借/還款單別 顯示應該出現的方式(tl008)
	var temp1 = $('#noti06').val();
	
	if(temp1.substr(0,2) == '84' || temp1.substr(0,2) == '86'){
		$('#order_product\\['+current_count+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "1").text("1.現金"));
		$('#order_product\\['+current_count+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "2").text("2.轉帳"));
	}else{
		$('#order_product\\['+current_count+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "1").text("1.現金"));
		$('#order_product\\['+current_count+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "2").text("2.轉帳"));
		$('#order_product\\['+current_count+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "3").text("3.應付票據"));
		$('#order_product\\['+current_count+'\\]\\[tl008\\]').append($("<option></option>").attr("value", "4").text("4.應收票據"));
	}
	
	
	//以下為需要各表各自設定部分(即為快速查詢功能設定)//
	//品號查詢品名規格, 庫別2
	set_catcomplete(current_count);
	set_catcomplete2(current_count);
}
</script>
<script>
function change_tl008(tl008){
	//console.log(tl008.id);
	var temp = (tl008.id).substr(14,3);
	var current_number = temp.match(/\d+/)[0];
	
	var tl008_val = $('#order_product\\['+current_number+'\\]\\[tl008\\]').val();
	
	if(tl008_val == '1'){
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').removeAttr('ondblclick');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('ondblclick');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').removeAttr('onchange');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('onchange');
		
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('readonly','value');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('readonly','value');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('style','background-color:#F0F0F0');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('style','background-color:#F0F0F0');

	}else if(tl008_val == '2'){
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('ondblclick','search_noti01_body_window(this)');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').removeAttr('ondblclick');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('onchange','check_noti01_body(this)');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').removeAttr('onchange');
		
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('readonly');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('readonly','value');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('style','background-color:#FFFFE4');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('style','background-color:#F0F0F0');
	}else if(tl008_val == '3'){
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('ondblclick','search_noti03_body_window(this)');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('ondblclick');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('onchange','check_noti03_body(this)');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('onchange');
		
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').removeAttr('readonly');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('readonly','value');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('style','background-color:#FFFFE4');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('style','background-color:#F0F0F0');
	}else{
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('ondblclick','search_noti04_body_window(this)');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('ondblclick');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('onchange','check_noti04_body(this)');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').removeAttr('onchange');
		
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').removeAttr('readonly');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('readonly','value');
		$('#order_product\\['+current_number+'\\]\\[tl010\\]').attr('style','background-color:#FFFFE4');
		$('#order_product\\['+current_number+'\\]\\[tl009\\]').attr('style','background-color:#F0F0F0');
	}
		
	$('#order_product\\['+current_number+'\\]\\[tl009\\]').val("");
	$('#order_product\\['+current_number+'\\]\\[tl009disp\\]').val("");
	$('#order_product\\['+current_number+'\\]\\[tl010\\]').val("");
	$('#order_product\\['+current_number+'\\]\\[tl011\\]').val("");
	$('#order_product\\['+current_number+'\\]\\[tl012\\]').val("");
	$('#order_product\\['+current_number+'\\]\\[tl013\\]').val("");
	$('#order_product\\['+current_number+'\\]\\[tl013disp\\]').val("");

	//order_product[1][tl009]
}
</script>



<!--開視窗 品號品名    -->
<div id="divFnoti09d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="iframenoti09d" name="iframenoti09d" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 銀行代號    -->
<div id="divFnoti01_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti01/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 票號(應付票據)    -->
<div id="divFnoti03_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti03/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 票號(應收票據)    -->
<div id="divFnoti04_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti04/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗 票號(應收票據)    -->
<div id="divFacti03_body" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/act/acti03/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<!--開視窗圖1客戶計價 copi02 有屬性不必下 src   -->
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>