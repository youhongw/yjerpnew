<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#mc006').val("");
	var cmsi11 = $('#cmsi11').val();
	var mc002 = $('#mc002').val();
	//alert(copi03);
	console.log(cmsi11);
	console.log(mc002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi03/check_title_no",
		data: {
			cmsi11: cmsi11, 
			mc002: mc002
		}
	})
	.done(function( msg ) {
		if($('#cmsi11disp').text()!=""&&$('#cmsi11disp').text()!="查無資料")
		$('#mc006').val(msg);
	});
}
//檢查發票號碼
function check_vno(){
	$('#mc214').val("");
	var cmsi11 = $('#cmsi11').val();
	var mc216 = $('#mc216').val();
	//alert(copi03);
	console.log(cmsi11);
	console.log(mc216);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi06/check_vno",
		data: {
			cmsi11: cmsi11, 
			mc216: mc216
		}
	})
	.done(function( msg ) {
		// if($('#cmsi11disp').text()!=""&&$('#cmsi11disp').text()!="查無資料")
			var str=(msg.split(";",2));
		  $('#mc214').val(str[0]);
		  $('#mc028').val(str[1]);
		  
		 // kk=$('#mc214').val(str[0]);
		 // console.log($(kk);
	    // $('#mc214').val($result[0]->mb210+1);
	});
}

//檢查發票號碼
function check_vnosave(){
	$('#mc214').val("");
	var cmsi11 = $('#cmsi11').val();
	var mc216 = $('#mc216').val();
	var mc028 = $('#mc028').val();
	//alert(copi03);
	console.log(cmsi11);
	console.log('test');
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi06/check_vnosave",
		data: {
			cmsi11: cmsi11, 
			mc216: mc216,
			mc028: mc028
		}
	})
	.done(function( msg ) {
		// if($('#cmsi11disp').text()!=""&&$('#cmsi11disp').text()!="查無資料")
		//$('#mc214').val(msg);
	});
}
//查詢品名規格開視窗 copi06 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[md005\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[md005\\]').val();
			//$('#order_product\\['+row+'\\]\\[tg004\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[md005\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[md006\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[md007\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[md008\\]').val(ui.item.value4);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[md005\\]').attr('onchange','check_invi02d(this)');
			check_invi02d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[md004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算
	$('input[name=\'order_product[' + row + '][md009]\'],input[name=\'order_product[' + row + '][md010]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][md009]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][md010]\']').val()*1;		
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][md011]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][md009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	 //單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][md010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
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
			price=$('input[name=\'order_product[' + index1 + '][md011]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			//   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][md011]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][md011]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		 $('#tc217').val(sumamt);
		//  console.log(sumamt);
    //end 訂單金額合計
	
	//稅金 mc218 稅率:mc226
	tax=$('input[name=\'mc226\']').val();
	$('#mc218').val(Math.round(sumamt*tax));
	var sumTax =Math.round(sumamt*tax);
	var vtax=1+parseFloat(tax);
//	if ($('select[name=\'tc016\']').val()=='1') {$('#tc029').val()=Math.round(sumamt/parseFloat(vtax));$('#tc030').val()=Math.round(sumamt-$('#tc029').val());}
    if ($('select[name=\'mc210\']').val()=='1') {$('#mc217').val(Math.round(sumamt/parseFloat(vtax)));temp1=Math.round(sumamt-$('#mc217').val());$('#mc218').val(temp1);}
	var sumtot =Math.round(sumamt+sumTax);
	$('#mc217').val(sumamt);
	$('#mc218').val(sumTax);
	$('#mc219').val(Math.round(sumtot));  //合計金額
	  //  console.log(sumtot);
	
}
//--></script>

<script>
function del_detail(md001,md002,md003,row){
	if(confirm("確定刪除細項:"+md001+"-"+md002+"-"+md003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/tax/taxi06/del_detail_ajax",
		data: { 
			md001: md001, 
			md002: md002,
			md003: md003
		}
	})
	.done(function( msg ) {
		if(msg){
		//	alert( "刪除細項:"+md001+"-"+md002+"-"+md003+" 成功!");
			$("#product_row_"+row).remove();
			totalSum();
		//	current_count -=1;
		//	addItem();
		}
		else{  alert ( "刪除細項:"+md001+"-"+md002+"-"+md003+" 失敗!");}
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
			$('input[name=\'order_product[1][md004]\']').focus();
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
	$('#order_product\\['+selected_row+'\\]\\[md005\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[md006\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[md007\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[md008\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[md005\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[md005\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[md006\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[md007\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[md008\\]').val(mb004);
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

//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
function check_invi02d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[md005\\]').val();
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
				$('#order_product\\['+row+'\\]\\[md005\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[md006\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[md007\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[md008\\]').val(data.message[0].value4);
			}else{
				$('#order_product\\['+row+'\\]\\[md005\\]').val("查無資料");
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

