<script type="text/javascript"> 	
//檢查最新編號
function check_title_no(){
	$('#tc002').val("");
	var asti01_asti03 = $('#asti01_asti03').val();
	var tc014 = $('#tc014').val();
	//alert(copi03);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti03/check_title_no",
		data: {
			asti01_asti03: asti01_asti03, 
			tc014: tc014
		}
	})
	.done(function( msg ) {
		if($('#asti01_asti03disp').text()!=""&&$('#asti01_asti03disp').text()!="查無資料")
		$('#tc002').val(msg);
	});
}


</script>

<script>
//計算金額總和
function totalSum(){
	var index1 = 0; var index2 = 0;
	var num1 = 0; var num2 = 0; 
	var sum1 = 0; var sum2 = 0; 
	//投保金額合計
	$(".data_class").each(function(index, element) {
		index1 = index+1;
		sum1 = 0;
		console.log(index1);
    });	
		
		if(index1 >=1){
			for(i = 1; i<=index1; i++){
				while (typeof($('input[name=\'order_product[' + num1 + '][tb003]\']').val()) == 'undefined'){
					num1++;	
				}
				if(!($('input[name=\'order_product[' + num1 + '][tb003]\']').val())){
					sum1 +=0;
					num1++;
				}else{
					sum1 += parseFloat($('input[name=\'order_product[' + num1 + '][tb003]\']').val());
					num1++;	
				}
			}
		}
		
		if(isNaN(sum1)){sum1=0}
		$('#ta006').val(sum1);
		num1 = 0;
		 
	//end 投保金額合計
	
	//保險費金額合計	 
	$(".data_class").each(function(index, element) {
		    index2 = index+1;
			sum2 = 0;
    });	
		
		if(index2 >=1){
			for(i = 1; i<=index2; i++){
				while (typeof($('input[name=\'order_product[' + num2 + '][tb004]\']').val()) == 'undefined'){
					num2++;	
				}
				if(!($('input[name=\'order_product[' + num2 + '][tb004]\']').val())){
					sum2 +=0;
					num2++;
				}else{
					sum2 += parseFloat($('input[name=\'order_product[' + num2 + '][tb004]\']').val());
					num2++;	
				}
			}
		}
		
		if(isNaN(sum2)){sum2=0}
		$('#ta007').val(sum2);
		num2 = 0;
	//end 保險費金額合計	
}
</script>

<script>
function del_detail(tb001,tb002,tb003,row){
	if(confirm("確定刪除細項:"+tb001+"-"+tb002+"-"+tb003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/ast/asti04/del_detail_ajax",
		data: { 
			tb001: tb001, 
			tb002: tb002,
			tb003: tb003
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
		else{  alert ( "刪除細項:"+tb001+"-"+tb002+"-"+tb003+" 失敗!");}
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

function check_body_repeat(body){
	
	var body_num = body.id.substr(13,3).match(/\d+/)[0];
	var body_value1 = $('#order_product\\['+body_num+'\\]\\[cmsi05\\]').val();
	var body_value2 = $('#order_product\\['+body_num+'\\]\\[cmsi09_asti02\\]').val();
	
	
	var repeat_num = 0;
	
	$(".check_repeat").each(function(index, element) {	
		temp_num = element.lastChild.id.substr(13,3).match(/\d+/)[0];
				
		if(body_value1 == $('#order_product\\['+temp_num+'\\]\\[cmsi05\\]').val() && body_value1 != '' && body_value2 == $('#order_product\\['+temp_num+'\\]\\[cmsi09_asti02\\]').val() && body_value2 != ''){
			repeat_num += 1;
			console.log(element.lastChild.value);
		}
		console.log(repeat_num);
			
		if(repeat_num >= 2 && body_value1 != '' && body_value2 !=''){
			$('#order_product\\['+body_num+'\\]\\[cmsi05\\]').val('');
			$('#order_product\\['+body_num+'\\]\\[cmsi05_me002\\]').val('');
			$('#order_product\\['+body_num+'\\]\\[cmsi09_asti02\\]').val('');
			$('#order_product\\['+body_num+'\\]\\[cmsi09_asti02_mv002\\]').val('');
			check_asti02_body(body);
			alert('輸入的部門代號及保管人已經存在，請重新輸入');
			return;
		}
		
    });
	repeat_num = 0;	
}
</script>
