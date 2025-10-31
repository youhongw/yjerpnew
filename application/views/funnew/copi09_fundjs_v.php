<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#ti002').val("");
	var copi03 = $('#copi03').val();
	var ti034 = $('#ti034').val();
	//alert(copi03);
	console.log(copi03);
	console.log(ti034);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi09/check_title_no",
		data: {
			ti001: copi03, 
			ti034: ti034
		}
	})
	.done(function( msg ) {
		if($('#copi03disp').text()!=""&&$('#copi03disp').text()!="查無資料")
		$('#ti002').val(msg);
	});
}

//查詢品名規格開視窗 copi09 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[tj004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[tj004\\]').val();
			$('#order_product\\['+row+'\\]\\[tj004\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[tj004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tj005\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[tj006\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[tj009\\]').val(ui.item.value4);
				//$('#order_product\\['+row+'\\]\\[tb007\\]').val(ui.item.value5);
				//$('#order_product\\['+row+'\\]\\[tb007disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[tj004\\]').attr('onchange','check_invi02d(this)');
			check_invi02d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[tb004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算 8改7數量, 11改9 單價, 折扣率26 改1 , 金額12改10
	$('input[name=\'order_product[' + row + '][tj007]\'],input[name=\'order_product[' + row + '][tj011]\'],input[name=\'order_product[' + row + '][tj012]\'],input[name=\'order_product[' + row + '][tj031]\'],input[name=\'order_product[' + row + '][tj032]\'],input[name=\'order_product[' + row + '][tj033]\'],input[name=\'order_product[' + row + '][tj034]\']').focusout(function() { 
		
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tj007]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tj011]\']').val()*1;
      //  var input_3=$('input[name=\'order_product[' + n + '][tj026]\']').val()/100; 
        var input_3=1;	  
		var get_total=input_1*input_2*input_3;  
		$('input[name=\'order_product[' + n + '][tj012]\']').val(get_total); 
       //合計資料
		totalSum();		
	
	});
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + row + '][tj007]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	
	 //單價  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tj011]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});   
	 //原幣金額  游標停在 0 之後 稅額,課稅別
	$('input[name=\'order_product[' + row + '][tj031]\']').focus(function(){
		var amt_0=$('input[name=\'order_product[' + row + '][tj012]\']').val()*1;
		tax=$('input[name=\'ti036\']').val();
		$('input[name=\'order_product[' + row + '][tj031]\']').val(Math.round(amt_0));
	    var sumTax =Math.round(amt_0*tax);
	    var vtax=1+parseFloat(tax);
		if ($('select[name=\'ti013\']').val()=='1') {$('input[name=\'order_product[' + row + '][tj031]\']').val(Math.round(amt_0-sumTax));
		temp1=Math.round(sumTax);$('input[name=\'order_product[' + row + '][tj032]\']').val(temp1);}
	
		/*var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val(''); */
	});  
	//原幣稅額  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tj032]\']').focus(function(){
		var amt_0=$('input[name=\'order_product[' + row + '][tj012]\']').val()*1;
		tax=$('input[name=\'ti036\']').val();
	    var sumTax =Math.round(amt_0*tax);
		$('input[name=\'order_product[' + row + '][tj032]\']').val(Math.round(sumTax));
		
		if ($('select[name=\'ti013\']').val()=='1') {$('input[name=\'order_product[' + row + '][tj031]\']').val(Math.round(amt_0-sumTax));
		temp1=Math.round(sumTax);$('input[name=\'order_product[' + row + '][tj032]\']').val(temp1);}
			
	});  
	//本幣金額  游標停在 0 之後 匯率
	$('input[name=\'order_product[' + row + '][tj033]\']').focus(function(){
		var amt_0=$('input[name=\'order_product[' + row + '][tj031]\']').val()*1;
		tax=$('input[name=\'ti009\']').val();
		var sumTax =Math.round(amt_0*tax);
		$('input[name=\'order_product[' + row + '][tj033]\']').val(Math.round(sumTax));
	});  
	//本幣稅額  游標停在 0 之後
	$('input[name=\'order_product[' + row + '][tj034]\']').focus(function(){
		var amt_0=$('input[name=\'order_product[' + row + '][tj032]\']').val()*1;
		tax=$('input[name=\'ti009\']').val();
		var sumTax =Math.round(amt_0*tax);
		$('input[name=\'order_product[' + row + '][tj034]\']').val(Math.round(sumTax));
	});  
	//訂單 游標停在 0 之後
	//$('input[name=\'order_product[' + row + '][tj014]\']').focus(function(){
	//	totalSum();	
	//});  
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
   //單身品號圖2視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#ordera'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#copi01').val());
		
		$('#hpa_ifmain').attr('src',"<?php echo base_url()?>index.php/bom/bomi02/edit_child/"+$("#copi01").val() );
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
//匯入明細圖2 
function import_copi09(mz001,mz002,mz003,mz004){
	console.log('mz001');
	console.log(mz001);
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/cop/copi09/import_bomi02",
		data: {
			mz001: mz001,
            mz002: mz002,
            mz003: mz003,			
			mz004: mz004
		}
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無資料可匯入!");
		}else{
			console.log(msg);
			//if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					//addItem();
					$('#order_product\\['+current_count+'\\]\\[tj004\\]').val(val['md003']);
					$('#order_product\\['+current_count+'\\]\\[tj005\\]').val(val['mb002']);
					$('#order_product\\['+current_count+'\\]\\[tj006\\]').val(val['mb003']);
					$('#order_product\\['+current_count+'\\]\\[tj009\\]').val(val['md004']);
					$('#order_product\\['+current_count+'\\]\\[tj008\\]').val(val['md006']*mz002);
				    addItem();
				}
				
			//}
		}
		
	});
}
//開圖1視窗(客戶單價計價檔copi02)回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
function addcopi02disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tj004\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[tj005\\]').val(me002); //品名
	$('#order_product\\['+selected_row+'\\]\\[tj006\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[tj009\\]').val(me004); //單位
	$('#order_product\\['+selected_row+'\\]\\[tb012\\]').val(me005); //單價
	$('#order_product\\['+selected_row+'\\]\\[tb013\\]').val(me006); //庫別
	$('#order_product\\['+selected_row+'\\]\\[tb013disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[tj004\\]').focus();
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
    $('#order_product\\['+row+'\\]\\[tj013\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tj013\\]').val();
			$('#order_product\\['+row+'\\]\\[tj013\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[tj013\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tj013disp\\]').val(ui.item.value2);
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
	var sumQty = 0;sumQty1 = 0;sumQty2 = 0;sumQty3 = 0;sumQty4 = 0;
	var product_row = 0; 
	var sumamt=0;sumTax =0;tax =0.00;vtax=0.00; 
	var index1=0;index2=0;index3=0;index4=0;index5=0;index6=0;
	var price=0;qty=0;qty1=0;qty2=0;qty3=0;qty4=0;qty5=0;qty6=0;temp1=0;
	//訂單金額 ti029 modi ti009
    $(".total_price").each(function(index, element) {
			price=$('input[name=\'order_product[' + index1 + '][tj012]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			//   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][tj012]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][tj012]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		// $('#ti013').val(sumamt);
		//  console.log(sumamt);
    //end 訂單金額合計
	
	//稅金 ti030 modi ti025  41稅率modi 44  課稅別16 modi 17
	tax=$('input[name=\'ti036\']').val();
	//$('#ti025').val(Math.round(sumamt*tax));
	var sumTax =Math.round(sumamt*tax);
	var vtax=1+parseFloat(tax);

	   //數量合計 ti031 modi 25   數量8modi 7
	$(".total_qty").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][tj007]\']').val()) ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][tj007]\']').val(); }
			index2=index2+1;
			if ( isNaN(qty)  ||   qty == null || qty=='' ) {qty=0;}
			   sumQty +=parseFloat(qty);			
			   console.log(sumQty);
    });
		if (typeof($('input[name=\'order_product[' + index2 + '][tj007]\']').val()) == 'undefined' ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][tj007]\']').val(); }
		if (isNaN(qty) ||   qty == null || qty=='' ) {qty=0;}
			 sumQty +=parseFloat(qty);
		 $('#ti029').val(sumQty);
		 console.log(sumQty);
    //end 數量合計
	
   //原幣金額 ti043 modi 27 毛重30 modi 20 1071231 本金額
	$(".total_qty1").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index3 + '][tj031]\']').val()) ) {qty1=0;} else 
		    { qty1=$('input[name=\'order_product[' + index3 + '][tj031]\']').val(); }
			index3=index3+1;
			if ( isNaN(qty1)  ||   qty1 == null || qty1=='' ) {qty1=0;}
			   sumQty1 +=parseFloat(qty1);			
			 //  console.log(sumQty1);
    });
		if (typeof($('input[name=\'order_product[' + index3 + '][tj031]\']').val()) == 'undefined' ) {qty1=0;} else 
		    { qty1=$('input[name=\'order_product[' + index3 + '][tj031]\']').val(); }
		if (isNaN(qty1) ||   qty1 == null || qty1=='' ) {qty1=0;}
			 sumQty1 +=parseFloat(qty1);
		 $('#ti010').val(sumQty1);
		// console.log(sumQty1);
    //end 總毛重合計
	
	//原幣稅額 ti044 modi 28 31 modi 21
	$(".total_qty2").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index4 + '][tj032]\']').val()) ) {qty2=0;} else 
		    { qty2=$('input[name=\'order_product[' + index4 + '][tj032]\']').val(); }
			index4=index4+1;
			if ( isNaN(qty2)  ||   qty2 == null || qty2=='' ) {qty2=0;}
			   sumQty2 +=parseFloat(qty2);			
			//   console.log(sumQty2);
    });
		if (typeof($('input[name=\'order_product[' + index4 + '][tj032]\']').val()) == 'undefined' ) {qty2=0;} else 
		    { qty2=$('input[name=\'order_product[' + index4 + '][tj032]\']').val(); }
		if (isNaN(qty2) ||   qty2 == null || qty2=='' ) {qty2=0;}
			 sumQty2 +=parseFloat(qty2);
		 $('#ti011').val(sumQty2);
		// console.log(sumQty2);
    //end 總材積合計
	var sumtot =Math.round(sumQty1+sumQty2);
	$('#ti010').val(sumQty1);
	$('#ti011').val(sumQty2);
	$('#ti1011').val(Math.round(sumtot));  //合計金額
	//var sumtot =Math.round($('#ti013').val(sumQty1)+$('#ti025').val(sumQty2));
	//$('#sum_tot').val(Math.round(sumtot));  //合計金額
	
	//本幣金額 ti043 modi 27 毛重30 modi 20 1071231 本金額
	$(".total_qty3").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index5 + '][tj033]\']').val()) ) {qty3=0;} else 
		    { qty3=$('input[name=\'order_product[' + index5 + '][tj033]\']').val(); }
			index5=index5+1;
			if ( isNaN(qty3)  ||   qty3 == null || qty3=='' ) {qty3=0;}
			   sumQty3 +=parseFloat(qty3);			
			 //  console.log(sumqty3);
    });
		if (typeof($('input[name=\'order_product[' + index5 + '][tj033]\']').val()) == 'undefined' ) {qty3=0;} else 
		    { qty3=$('input[name=\'order_product[' + index5 + '][tj033]\']').val(); }
		if (isNaN(qty3) ||   qty3 == null || qty3=='' ) {qty3=0;}
			 sumQty3 +=parseFloat(qty3);
		 $('#ti037').val(sumQty3);
		// console.log(sumqty3);
    //end 總毛重合計
	
	//本幣稅額 ti044 modi 28 31 modi 21
	$(".total_qty4").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index6 + '][tj034]\']').val()) ) {qty4=0;} else 
		    { qty4=$('input[name=\'order_product[' + index6 + '][tj034]\']').val(); }
			index6=index6+1;
			if ( isNaN(qty4)  ||   qty4 == null || qty4=='' ) {qty4=0;}
			   sumQty4 +=parseFloat(qty4);			
			//   console.log(sumqty4);
    });
		if (typeof($('input[name=\'order_product[' + index6 + '][tj034]\']').val()) == 'undefined' ) {qty4=0;} else 
		    { qty4=$('input[name=\'order_product[' + index6 + '][tj034]\']').val(); }
		if (isNaN(qty4) ||   qty4 == null || qty4=='' ) {qty4=0;}
			 sumQty4 +=parseFloat(qty4);
		 $('#ti038').val(sumQty4);
		// console.log(sumqty4);
    //end 總材積合計
	var sumtot1 =Math.round(sumQty3+sumQty4);
	$('#ti037').val(sumQty3);
	$('#ti038').val(sumQty4);
	$('#ti3738').val(Math.round(sumtot1));  //合計金額
	//var sumtot1 =Math.round($('#ti045').val(sumQty1)+$('#ti046').val(sumQty2));
	//$('#sum_tot1').val(Math.round(sumtot1));  //合計金額
	//$('#tg4546').val(Math.round(sumtot1));  //合計金額
}
//--></script>

<script>
function del_detail(tj001,tj002,tj003,row){
	if(confirm("確定刪除細項:"+tj001+"-"+tj002+"-"+tj003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi09/del_detail_ajax",
		data: { 
			tj001: tj001, 
			tj002: tj002,
			tj003: tj003
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
		else{  alert ( "刪除細項:"+tj001+"-"+tj002+"-"+tj003+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_tj00'+k).val("");
		$('#product-row'+row+' input.order_product_tj0'+k).val("");
		$('#product-row'+row+' input.order_product_th'+k).val("");
	}
}
</script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1 a
		setTimeout(function() {
			$('input[name="ti010"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#ti015').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3 c
		setTimeout(function() {
			$('#ti035').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4 g
		setTimeout(function() {
			$('#ti048').focus();
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
			$('input[name=\'order_product[1][tj004]\']').focus();
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
	$('#order_product\\['+selected_row+'\\]\\[tj004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tj005\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tj006\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[tj009\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[tj013\\]').val(mb005);
	$('#order_product\\['+selected_row+'\\]\\[tj013disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[tj004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[tj004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[tj005\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[tj006\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[tj009\\]').val(mb004);
	//$('#order_product\\['+current_count+'\\]\\[tj013\\]').val(mb005);
	//$('#order_product\\['+current_count+'\\]\\[tj013disp\\]').val(mb006);
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
	$('#order_product\\['+selected_row+'\\]\\[tj013\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tj013disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tj013\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[tj004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tj004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tj005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tj006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[tj009\\]').val(data.message[0].value4);
			//	$('#order_product\\['+row+'\\]\\[tj007\\]').val(data.message[0].value5);
			//	$('#order_product\\['+row+'\\]\\[tj007disp\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[tj004\\]').val("查無資料");
			}
		}
	});
}
//庫別
function check_cmsi03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tj007\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tj007\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tj007disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tj007\\]').val("查無資料");
			}
		}
	});
}

</script>	

<!-- 開視窗 copc08a 前置單據copybefore -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcopc08a").click(function() {
	 if($('#copi01').val()=='') {alert('請先選擇客戶代號!');return;}
	 
	 $('#hpb_ifmain').attr('src',"<?php echo base_url()?>index.php/fun/copc08a/display/"+$("#copi03").val()+'/'+$("#ti002").val()+'/'+$("#copi01").val()+'/'+$("#ti034").val() );
	
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'hidden',  	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFormcopc08a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
	<script type="text/javascript"><!--
  function addcopc08a(sma001,sma002,oti001,oti002,oti004,oti034) {
	  
    var oSpan = document.getElementById("ti049");
		oSpan.innerHTML = 'testtesttest';  
		var zti0341=oti034.substring(0,4);
		var zti0342=oti034.substring(5,7);
		var zti0343=oti034.substring(8,10);
		var zti034=zti0341+zti0342+zti0343;
       form.ti048.value=sma001;	
       form.ti049.value=sma002;		
      //    alert(zti034);	   
	url = '<?=base_url() ?>index.php/cop/copi09/copybefore/'+encodeURIComponent(sma001)+'/'+encodeURIComponent(sma002)+'/'+oti001+'/'+oti002+'/'+oti004+'/'+oti034; 
	location = url;
	return true;
}	  
//--></script> 
	<div id="divFormcopc08a" style="display:none;width:100%;height:100%;">   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe  allowTransparency="flase" id="hpb_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!--	<iframe src="<?php echo base_url()?>index.php/fun/copc08a/display/"+$("#copi03").val()+'/'+$("#ti002").val()+'/'+$("#copi01").val()+'/'+$("#ti034").val() allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
	</div>

<!-- 開視窗 copc08a 前置單據 -->
   
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
<!--開視窗圖2整套展開 copi02 有屬性不必下 src   -->
<div id="divFcopi02a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hpa_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>