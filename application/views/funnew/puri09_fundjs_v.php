<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#tg002').val("");
	var puri04 = $('#puri04').val();
	var tg014 = $('#tg014').val();
	//alert(puri04);
	console.log(puri04);
	console.log(tg014);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri09/check_title_no",
		data: {
			tg001: puri04, 
			tg014: tg014
		}
	})
	.done(function( msg ) {
		if($('#puri04disp').text()!=""&&$('#puri04disp').text()!="查無資料")
		$('#tg002').val(msg);
	});
}

//查詢品名規格開視窗 puri09 //下拉選單$('.close').click($.unblockUI);
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[th004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[th004\\]').val();
			$('#order_product\\['+row+'\\]\\[th004\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[th004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[th005\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[th006\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[th008\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[tb009\\]').val(ui.item.value5);
				$('#order_product\\['+row+'\\]\\[tb009disp\\]').val(ui.item.value6);
			}
			return false;
		},
		
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[th004\\]').attr('onchange','check_invi02d(this)');
			check_invi02d(row);  //1060713 新增
			//check_invi02d($('#order_product\\['+row+'\\]\\[tb004\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
	
	//明細計算 8改7數量, 11改9 單價, 折扣率26 改1 , 金額12改10
	
	$('input[name=\'order_product[' + row + '][th016]\'],input[name=\'order_product[' + row + '][th018]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vrow;
		var input_1=$('input[name=\'order_product[' + n + '][th016]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][th018]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][th019]\']').val(get_total); 
        
		//稅額
		 var taxp=0;amt1=0;
	    var taxp=$('input[name=\'tg030\']').val();  //稅率
		var amt1=get_total;
		var taxamt1=Math.round(amt1*taxp);
		
		$('input[name=\'order_product[' + n + '][th045]\']').val(amt1);
		$('input[name=\'order_product[' + n + '][th046]\']').val(taxamt1);
		
		var taxamt11=Math.round(amt1/(1+parseFloat(taxp))); //內含稅
		if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th045]\']').val(taxamt11);}
		var amt2=amt1-taxamt11;   //內含稅
		
		//本幣金額稅額
	   if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th046]\']').val(amt2);}
	   
	    var rate=$('input[name=\'tg008\']').val();  //匯率		
		var rateamt1=Math.round(amt1*rate);     //本幣金額 內含稅
		$('input[name=\'order_product[' + n + '][th047]\']').val(rateamt1);
		var ratetaxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		
		var ratetaxamt11=Math.round(rateamt1/(1+parseFloat(taxp)));  //本幣稅額內含稅
		$('input[name=\'order_product[' + n + '][th048]\']').val(ratetaxamt1);	
		if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th047]\']').val(ratetaxamt11);}
		//外加稅
		if ($('select[name=\'tg010\']').val()>='2') {$('input[name=\'order_product[' + n + '][th047]\']').val(rateamt1);}
		
		var amt3=rateamt1-ratetaxamt11;   //內含稅
	   if ($('select[name=\'tg010\']').val()=='1') {$('input[name=\'order_product[' + n + '][th048]\']').val(amt3);}
	    if ($('select[name=\'tg010\']').val()=='2') {$('input[name=\'order_product[' + n + '][th048]\']').val(taxamt1);}
		 if ($('select[name=\'tg010\']').val()>='3') {$('input[name=\'order_product[' + n + '][th048]\']').val(0);}
		
		totalSum();
	});
		   //驗收日期
	$('input[name=\'order_product[' + row + '][th014]\']').focus(function(){
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
		if ($('input[name=\'order_product[' + n + '][th014]\']').val()=='') {
		$('input[name=\'order_product[' + n + '][th014]\']').val(today); }
	});
	
	//進貨數量
	$('input[name=\'order_product[' + row + '][th007]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	//進貨數量
	$('input[name=\'order_product[' + row + '][th007]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
	  	if ($(this).val()==real_value)
		     $(this).val(real_value);
			 if ($(this).val()=='')
		   	  $(this).val('0');
	});
	
	//進貨數量copy 驗收數量
	$('input[name=\'order_product[' + row + '][th015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][th007]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][th015]\']').val(input_1); 
	});
	   //計價數量
	$('input[name=\'order_product[' + row + '][th016]\']').focus(function(){
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_3=$('input[name=\'order_product[' + n + '][th015]\']').val()*1;  
		var input_4=$('input[name=\'order_product[' + n + '][th017]\']').val()*1;  
		var get_total1=input_3-input_4;  
		$('input[name=\'order_product[' + n + '][th016]\']').val(get_total1); 		
	});  
	
	   //單價  
	$('input[name=\'order_product[' + row + '][th018]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	 //單價  
	$('input[name=\'order_product[' + row + '][th018]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
			 if ($(this).val()=='')
		   	  $(this).val('0');
	});

	
	//採購單別
	$('input[name=\'order_product[' + row + '][th011]\']').focus(function(){
		totalSum();
	});
	//訂單 游標停在 0 之後
	//$('input[name=\'order_product[' + row + '][th014]\']').focus(function(){
	//	totalSum();	
	//});  
	//單身品號圖1視窗 (廠商單價計價檔puri02) 12, 取12 0-11字 product_row_1 取1開始
	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		console.log($('#puri01').val());
		if($('#puri01').val()=='') {alert('請先選擇廠商代號!');return;}
		
		$('#hp_ifmain').attr('src',"<?php echo base_url()?>index.php/pur/puri02/display_child/"+$("#copi01").val() );
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
   //單身品號圖2視窗 (廠商單價計價檔puri02) 12, 取12 0-11字 product_row_1 取1開始
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
		message: $('#divFpuri02a'),
		onOverlayClick: clear_puri02disp_sql
	});
	 $('.close').click($.unblockUI);
	});
}
//匯入明細圖2 
function import_puri09(mz001,mz002,mz003,mz004){
	console.log('mz001');
	console.log(mz001);
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/pur/puri09/import_bomi02",
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
					$('#order_product\\['+current_count+'\\]\\[th004\\]').val(val['md003']);
					$('#order_product\\['+current_count+'\\]\\[th005\\]').val(val['mb002']);
					$('#order_product\\['+current_count+'\\]\\[th006\\]').val(val['mb003']);
					$('#order_product\\['+current_count+'\\]\\[th008\\]').val(val['md004']);
					$('#order_product\\['+current_count+'\\]\\[th009\\]').val(val['md006']*mz002);
				    addItem();
				}
				
			//}
		}
		
	});
}
//開圖1視窗(廠商單價計價檔puri02)回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
function addpuri02disp(me001, me002, me003, me004, me005, me006, me007){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[th004\\]').val(me001); //品號
	$('#order_product\\['+selected_row+'\\]\\[th005\\]').val(me002); //品名
	$('#order_product\\['+selected_row+'\\]\\[th006\\]').val(me003); //規格
	$('#order_product\\['+selected_row+'\\]\\[th008\\]').val(me004); //單位
	$('#order_product\\['+selected_row+'\\]\\[tb009\\]').val(me005); //單價
//	$('#order_product\\['+selected_row+'\\]\\[tb007\\]').val(me006); //庫別
//	$('#order_product\\['+selected_row+'\\]\\[tb007disp\\]').val(me007); //庫別名稱
	
	$('#order_product\\['+selected_row+'\\]\\[th004\\]').focus();
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
//查詢庫別下拉選單 set_catcomplete2 暫modi 222
function set_catcomplete2(row){ } 
function set_catcomplete222(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[th009\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[th009\\]').val();
			$('#order_product\\['+row+'\\]\\[th009\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[th009\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[th009disp\\]').val(ui.item.value2);
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
	//進貨金額 tg029 modi tg019
    $(".total_price").each(function(index, element) {
			price=$('input[name=\'order_product[' + index1 + '][th019]\']').val();
			index1=index1+1;
			if (isNaN(price)) {price=0;}
			   sumamt +=parseFloat(price);			
			//   console.log(sumamt);
    });
		if (typeof($('input[name=\'order_product[' + index1 + '][th019]\']').val()) == 'undefined' ) {price=0;} else 
		    { price=$('input[name=\'order_product[' + index1 + '][th019]\']').val(); }
		if (isNaN(price) ||   price == null || price=='' ) {price=0;}
			 sumamt +=parseFloat(price);
		// $('#tg013').val(sumamt);
		//  console.log(sumamt);
    //end 訂單金額合計
	
	//稅金 tg030 modi tg025  41稅率modi 30  課稅別16 modi 17
	tax=$('input[name=\'tg030\']').val();
	//$('#tg025').val(Math.round(sumamt*tax));
	var sumTax =Math.round(sumamt*tax);
	var vtax=1+parseFloat(tax);

	   //數量合計 tg031 modi 26   數量8modi 7
	$(".total_qty").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index2 + '][th016]\']').val()) ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][th016]\']').val(); }
			index2=index2+1;
			if ( isNaN(qty)  ||   qty == null || qty=='' ) {qty=0;}
			   sumQty +=parseFloat(qty);			
			   console.log(sumQty);
    });
		if (typeof($('input[name=\'order_product[' + index2 + '][th016]\']').val()) == 'undefined' ) {qty=0;} else 
		    { qty=$('input[name=\'order_product[' + index2 + '][th016]\']').val(); }
		if (isNaN(qty) ||   qty == null || qty=='' ) {qty=0;}
			 sumQty +=parseFloat(qty);
		 $('#tg026').val(sumQty);
		 console.log(sumQty);
    //end 數量合計
	
   //原幣金額 tg043 modi 28 毛重30 modi 20 1071231 本金額
	$(".total_qty1").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index3 + '][th045]\']').val()) ) {qty1=0;} else 
		    { qty1=$('input[name=\'order_product[' + index3 + '][th045]\']').val(); }
			index3=index3+1;
			if ( isNaN(qty1)  ||   qty1 == null || qty1=='' ) {qty1=0;}
			   sumQty1 +=parseFloat(qty1);			
			 //  console.log(sumQty1);
    });
		if (typeof($('input[name=\'order_product[' + index3 + '][th045]\']').val()) == 'undefined' ) {qty1=0;} else 
		    { qty1=$('input[name=\'order_product[' + index3 + '][th045]\']').val(); }
		if (isNaN(qty1) ||   qty1 == null || qty1=='' ) {qty1=0;}
			 sumQty1 +=parseFloat(qty1);
		 $('#tg028').val(sumQty1);
		// console.log(sumQty1);
    //end 總毛重合計
	
	//原幣稅額 tg044 modi 19 31 modi 21
	$(".total_qty2").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index4 + '][th046]\']').val()) ) {qty2=0;} else 
		    { qty2=$('input[name=\'order_product[' + index4 + '][th046]\']').val(); }
			index4=index4+1;
			if ( isNaN(qty2)  ||   qty2 == null || qty2=='' ) {qty2=0;}
			   sumQty2 +=parseFloat(qty2);			
			//   console.log(sumQty2);
    });
		if (typeof($('input[name=\'order_product[' + index4 + '][th046]\']').val()) == 'undefined' ) {qty2=0;} else 
		    { qty2=$('input[name=\'order_product[' + index4 + '][th046]\']').val(); }
		if (isNaN(qty2) ||   qty2 == null || qty2=='' ) {qty2=0;}
			 sumQty2 +=parseFloat(qty2);
		 $('#tg019').val(sumQty2);
		// console.log(sumQty2);
    //end 總材積合計
	var sumtot =Math.round(sumQty1+sumQty2);
	$('#tg028').val(sumQty1);
	$('#tg019').val(sumQty2);
	$('#tg2819').val(Math.round(sumtot));  //合計金額
	//var sumtot =Math.round($('#tg013').val(sumQty1)+$('#tg025').val(sumQty2));
	//$('#sum_tot').val(Math.round(sumtot));  //合計金額
	
	//本幣金額 tg043 modi 27 毛重30 modi 20 1071231 本金額
	$(".total_qty3").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index5 + '][th047]\']').val()) ) {qty3=0;} else 
		    { qty3=$('input[name=\'order_product[' + index5 + '][th047]\']').val(); }
			index5=index5+1;
			if ( isNaN(qty3)  ||   qty3 == null || qty3=='' ) {qty3=0;}
			   sumQty3 +=parseFloat(qty3);			
			 //  console.log(sumqty3);
    });
		if (typeof($('input[name=\'order_product[' + index5 + '][th047]\']').val()) == 'undefined' ) {qty3=0;} else 
		    { qty3=$('input[name=\'order_product[' + index5 + '][th047]\']').val(); }
		if (isNaN(qty3) ||   qty3 == null || qty3=='' ) {qty3=0;}
			 sumQty3 +=parseFloat(qty3);
		 $('#tg031').val(sumQty3);
		// console.log(sumqty3);
    //end 總毛重合計
	
	//本幣稅額 tg044 modi 32 31 modi 21
	$(".total_qty4").each(function(index, element) {
		    if (isNaN($('input[name=\'order_product[' + index6 + '][th048]\']').val()) ) {qty4=0;} else 
		    { qty4=$('input[name=\'order_product[' + index6 + '][th048]\']').val(); }
			index6=index6+1;
			if ( isNaN(qty4)  ||   qty4 == null || qty4=='' ) {qty4=0;}
			   sumQty4 +=parseFloat(qty4);			
			//   console.log(sumqty4);
    });
		if (typeof($('input[name=\'order_product[' + index6 + '][th048]\']').val()) == 'undefined' ) {qty4=0;} else 
		    { qty4=$('input[name=\'order_product[' + index6 + '][th048]\']').val(); }
		if (isNaN(qty4) ||   qty4 == null || qty4=='' ) {qty4=0;}
			 sumQty4 +=parseFloat(qty4);
		 $('#tg032').val(sumQty4);
		// console.log(sumqty4);
    //end 總材積合計
	var sumtot1 =Math.round(sumQty3+sumQty4);
	$('#tg031').val(sumQty3);
	$('#tg032').val(sumQty4);
	$('#tg3132').val(Math.round(sumtot1));  //合計金額
	//var sumtot1 =Math.round($('#tg045').val(sumQty1)+$('#tg046').val(sumQty2));
	//$('#sum_tot1').val(Math.round(sumtot1));  //合計金額
	//$('#tg4546').val(Math.round(sumtot1));  //合計金額
}
//--></script>

<script>
function del_detail(th001,th002,th003,row){
	if(confirm("確定刪除細項:"+th001+"-"+th002+"-"+th003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri09/del_detail_ajax",
		data: { 
			th001: th001, 
			th002: th002,
			th003: th003
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
		else{  alert ( "刪除細項:"+th001+"-"+th002+"-"+th003+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_th00'+k).val("");
		$('#product-row'+row+' input.order_product_th0'+k).val("");
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
			$('input[name="tg010"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#tg015').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3 c
		setTimeout(function() {
			$('#tg035').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4 g
		setTimeout(function() {
			$('#tg048').focus();
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
			$('input[name=\'order_product[1][th004]\']').focus();
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
	$('#order_product\\['+selected_row+'\\]\\[th004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[th005\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[th006\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[th008\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[th009\\]').val(mb005);
	$('#order_product\\['+selected_row+'\\]\\[th009disp\\]').val(mb006);
	$('#order_product\\['+selected_row+'\\]\\[th004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006){
	console.log(mb001);
	console.log(current_count);
	$('#order_product\\['+current_count+'\\]\\[th004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[th005\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[th006\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[th008\\]').val(mb004);
	//$('#order_product\\['+current_count+'\\]\\[th007\\]').val(mb005);
	//$('#order_product\\['+current_count+'\\]\\[th007disp\\]').val(mb006);
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
	$('#order_product\\['+selected_row+'\\]\\[th009\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[th009disp\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[th009\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[th004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[th004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[th005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[th006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[th008\\]').val(data.message[0].value4);
			//	$('#order_product\\['+row+'\\]\\[th007\\]').val(data.message[0].value5);
			//	$('#order_product\\['+row+'\\]\\[th007disp\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[th004\\]').val("查無資料");
			}
		}
	});
}
//庫別
function check_cmsi03d(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[th007\\]').val();
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
				$('#order_product\\['+row+'\\]\\[th009\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[th009disp\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[th009\\]').val("查無資料");
			}
		}
	});
}
</script>	

<!-- 開視窗 purc09a 前置單據copybefore -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpurc09a").click(function() {
	 if($('#puri01').val()=='') {alert('請先選擇廠商代號!');return;}
	 
	 $('#hpb_ifmain').attr('src',"<?php echo base_url()?>index.php/fun/purc09a/display/"+$("#puri04").val()+'/'+$("#tg002").val()+'/'+$("#puri01").val()+'/'+$("#tg014").val() );
	
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
	message: $('#divFormpurc09a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
	<script type="text/javascript"><!--
  function addpurc09a(sma001,sma002,otg001,otg002,otg004,otg042) {
	  
   // var oSpan = document.getElementById("tg035");
	//	oSpan.innerHTML = 'testtesttest';  
		var ztg0421=otg042.substring(0,4);
		var ztg0422=otg042.substring(5,7);
		var ztg0423=otg042.substring(8,10);
		var ztg042=ztg0421+ztg0422+ztg0423;
       form.tg034.value=sma001;	
       form.tg035.value=sma002;		
      //    alert(ztg042);
       console.log(sma002);	  
	url = '<?=base_url() ?>index.php/pur/puri09/copybefore/'+encodeURIComponent(sma001)+'/'+encodeURIComponent(sma002)+'/'+otg001+'/'+otg002+'/'+otg004+'/'+ztg042; 
	location = url;
	return true;
}	  
//--></script> 
	<div id="divFormpurc09a" style="display:none;width:100%;height:100%;">   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe  allowTransparency="flase" id="hpb_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!--	<iframe src="<?php echo base_url()?>index.php/fun/purc09a/display/"+$("#copi03").val()+'/'+$("#tg002").val()+'/'+$("#copi01").val()+'/'+$("#tg042").val() allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
	</div>

<!-- 開視窗 purc09a 前置單據 -->
   
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
<!-- <iframe src="<?php echo base_url()?>index.php/pur/puri02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>
<!--開視窗圖2整套展開 puri02 有屬性不必下 src   -->
<div id="divFpuri02a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe  allowTransparency="flase" id="hpa_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 
<!-- <iframe src="<?php echo base_url()?>index.php/pur/puri02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->	   
</div>