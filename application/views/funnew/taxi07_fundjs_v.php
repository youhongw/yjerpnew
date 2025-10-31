<script type="text/javascript"> 
//檢查最新編號
function check_title_no(){
	$('#mc006').val("");
	var cmsi11 = $('#cmsi11').val();
	var mc002 = $('#mc002').val();
	var mc005 = $('#mc005').val();
	//alert(copi03);
	console.log(cmsi11);
	console.log(mc002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi07/check_title_no",
		data: {
			cmsi11: cmsi11, 
			mc002: mc002, 
			mc005: mc005
		}
	})
	.done(function( msg ) {
		if($('#cmsi11disp').text()!=""&&$('#cmsi11disp').text()!="查無資料")
		$('#mc006').val(msg);
	});
}
//查詢品名規格開視窗 taxi07 //下拉選單$('.close').click($.unblockUI);

	//明細計算
	
	//金額游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][md005]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	
function clear_taxi07disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi07/clear_sql"
	});
}

function del_detail(md004,md005,row){
	if(confirm("確定刪除細項:"+md004+"-"+md005+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi07/del_detail_ajax",
		data: { 
			md004: md004, 
			md005: md005
		}
	})
	.done(function( msg ) {
		if(msg){
		//	alert( "刪除細項:"+md001+"-"+md002+"-"+md003+" 成功!");
			$("#product_row_"+row).remove();
		//	totalSum();
		//	current_count -=1;
		//	addItem();
		}
		else{  alert ( "刪除細項:"+md004+"-"+md005+"-"+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_md00'+k).val("");
		$('#product-row'+row+' input.order_product_md0'+k).val("");
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
			$('input[name=\'order_product[1][md003]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>

