<script>
/****POS系統****/
/*****
**主要分為畫面、主架構、全域方法、Gridview等區域
**可以直接用搜尋方便指向
*****/
</script>
<div id="head" name="head" style="overflow:auto;">
<div style="float:left;">
<!-- <img src="<?php echo base_url()?>assets/images/poslogo.png" /> -->
</div>
<div style="float:left;padding:10px;">
	<font size="6" color="wheat">POS系統</font>
</div>
<div style="float:right;">
	<font size="6" color="red">銷售門市 ： <?echo $setting->mk022;?>　<?echo $setting->mk002;?></font>
</div>
</div>
<div id="work_area" name="work_area">
<font size="3">
	<div id="head_func" name="head_func">		
		<div id="head_line_1" style="width:1266px;overflow:auto;">
			<div style="width:300px;float:left;">
				收銀人員　<input id="sales" name="sales" value="<?echo $setting->mk023;?>" style="width:120px" readonly="readonly" /><?if($setting->mf002=="無此使用者"){?><font color="red" ><?echo "　".$setting->mf002;?></font><?}else{echo "　".$setting->mf002;}?>
			</div>
			<div style="width:320px;float:left;">
				會　　員(W)<input id="member" name="member" class="pro_ipt" value="" style="width:120px" />
			</div>
			<div style="width:400px;float:left;">
				現　金　<input id="cash" name="cash" class="pro_ipt" value="0" style="width:80px;text-align:right;" tabindex="1" disabled="disabled" /> 元 <input id="auto_correct" name="auto_correct" type="checkbox" checked />現金自動補整
			</div>
			<div style="width:200px;float:left;" id="totle_block">總　計：<span id="show_totle">0</span>元</div>
		</div>
		<div id="head_line_2" style="width:1266px;overflow:auto;">
			<div style="width:300px;float:left;">
				發票號碼　<input id="receipt" name="receipt" value="" style="width:120px" readonly="readonly" />
				<input id="print_voice" name="print_voice" type="checkbox" checked />列印發票
			</div>
			<div style="width:320px;height:20px;float:left;">
				<font color="blue">
				<span id="member_title" name="member_title"></span>
				</font>
			</div>
			<div style="width:400px;float:left;">
				信用卡　<input id="creadit" name="creadit" class="pro_ipt" value="0" style="width:80px;text-align:right;" tabindex="2" disabled="disabled" /> 元
			</div>
			<div style="width:200px;float:left;" id="discount_block">總折讓：<span id="show_discount">0</span>元</div>
		</div>
		<div id="head_line_3" style="width:1266px;overflow:auto;">
			<div style="width:300px;float:left;">
				統　　編　<input id="EIN" name="EIN" class="pro_ipt" value="" style="width:120px" tabindex="3" />
			</div>
			<div style="width:320px;height:20px;float:left;">
				<font color="blue">
				<span id="member_detail" name="member_detail"> </span>
				</font>
			</div>
			<div style="width:400px;float:left;">
				找　零：<span id="show_change">0</span>元
			</div>
			<div style="float:left;">
				<font size="4"><input id="btn_checkout" type="button" value="結帳" style="width:100px;display:none;" onclick="checkout();" /></font>
			</div>
			<div style="float:right;">
				<font color="red"><span id="msg_block"></span></font>
			</div>
		</div>
			
	</div>
	<div id="pro_detail" name="pro_detail">
		<div id="con_line_1" name="con_line_1" style="overflow:auto;padding:2px 0px;">
			<div style="width:200px;float:left;">
				條碼(F1)<input id="barcode" name="barcode" class="pro_ipt" style="width:120px" onkeypress="value=value.replace(/[^\d]/g,'');" onkeyup="check_data(value);" onchange="value=value.replace(/[^\d]/g,'');" tabindex="4" />
			</div>
			<div style="width:200px;float:left;">
				品號 <input id="number" name="number" class="pro_ipt" style="width:150px" readonly="readonly" />
			</div>
			<div style="width:200px;float:left;">
				品名 <input id="name" name="name" class="pro_ipt" style="width:150px" readonly="readonly" />
			</div>
			<div style="width:150px;float:left;">
				尺寸 <input id="size" name="size" class="pro_ipt" style="width:100px" readonly="readonly" />
			</div>
			<div style="width:150px;float:left;">
				顏色 <input id="color" name="color" class="pro_ipt" style="width:75px" readonly="readonly" />
			</div>
			<div style="width:120px;float:left;">
				　<input style="display:none;" id="btn_end_view" name="btn_end_view" type="button" value="結束瀏覽" onclick="end_view();" tabindex="9" />
			</div>
			<div style="width:120px;float:left;">
				　<input style="display:none;" id="btn_refound" name="btn_refound" type="button" value="銷退此筆" onclick="refound();" tabindex="9" />
			</div>
		</div>
		<div id="con_line_2" name="con_line_2" style="overflow:auto;padding:2px 0px;">
			<div style="width:200px;float:left;">
				單價(F2)<input id="price" name="price" class="pro_ipt" style="width:120px" tabindex="5" />
				<input id="true_price" name="true_price" style="display:none;" />
				<input id="spec_price" name="spec_price" style="display:none;" />
				<input id="member_price" name="member_price" style="display:none;" />
				<input id="spec_price_no" name="spec_price_no" style="display:none;" />
			</div>
			<div style="width:200px;float:left;">
				數量(F3)<input id="amt" name="amt" class="pro_ipt" style="width:60px" onchange="value=value.replace(/[^\d]/g,'');" tabindex="6" />
			</div>
			<div style="width:200px;float:left;">
				贈品(F5)<input id="gift" name="gift" class="pro_ipt" value="" style="width:50px" onchange="value=value.replace(/[^\d]/g,'');" tabindex="7" />
			</div>
			<div style="width:150px;float:left;">
				折　　讓　<input id="discount" name="discount" class="pro_ipt" style="width:40px" tabindex="8" />%
			</div>
			<div style="width:150px;float:left;">
				小計 <input id="totle" name="totle" class="pro_ipt" style="width:75px" readonly="readonly" />元
			</div>
			<div style="width:120px;float:left;">
				　<input id="add" name="add" type="button" value="加入一筆" onclick="add_list();" tabindex="9" />
			</div>
			<div style="width:180px;float:left;">
				　<font color="red"><span id="show_promo" name="show_promo" ></span></font>
			</div>
		</div>
	</div>
	<div id="pro_list" name="pro_list" style="overflow-x:hidden;overflow-y:auto;">
		<table id="goods">
			<tr class="goods_title" style="text-align:center;">
				<td class="barcode" colspan="2">
					<font size="4">條碼</font>
				</td>
				<td class="number">
					<font size="4">貨號</font>
				</td>
				<td class="name">
					<font size="4">品名</font>
				</td>
				<td class="color">
					<font size="4">顏色</font>
				</td>
				<td class="size">
					<font size="4">尺寸</font>
				</td>
				<td class="amt">
					<font size="4">數量</font>
				</td>
				<td class="gift">
					<font size="4">贈送數目</font>
				</td>
				<td class="price">
					<font size="4">單價</font>
				</td>
				<td class="discount">
					<font size="4">折讓</font>
				</td>
				<td class="totle">
					<font size="4">小計</font>
				</td>
			</tr>
		</table>
	</div>
	
</font>
</div>
<div id="bot_func" name="bot_func" style="overflow:auto;">
	<div id="bot_left" style="float:left;"><!--功能表-->
		<div id="bot_line_1" name="bot_line_1" style="width:700px;overflow:auto;">
			<div style="float:left;text-align:center;">
				<font size="6"><input style="width:288px;" type="button" value="交易取消" onclick="cancel_deal();" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input style="width:144px;" type="button" value="日報表" onclick="daily_report();" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="發票號碼" onclick="receipt_setting();" /></font>
			</div>
		</div>
		<div id="bot_line_2" name="bot_line_2" style="width:700px;overflow:auto;">
			<div style="float:left;">
				<font size="6"><input type="button" value="發票作廢" onclick="receipt_refound();" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="會員資料" onclick="member_data();" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="產品查詢" onclick="search_product();" /></font>
			</div>
			<div style="float:left;text-align:center;">
				<font size="6"><input style="width:144px;" type="button" value="開錢櫃" /></font>
			</div>
		</div>
		<div id="bot_line_3" name="bot_line_3" style="width:750px;overflow:auto;">
			<div style="float:left;">
				<font size="6"><input type="button" value="盤點作業" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="進貨作業" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="促銷活動" onclick="promotion_data();" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="交易紀錄" onclick="record_data();" /></font>
			</div>
			<div style="float:left;">
				<font size="6"><input type="button" value="系統參數" /></font>
			</div>
		</div>
		<div id="bot_line_4" name="bot_line_4" style="width:750px;overflow:auto;">
			<div style="float:left;">
				<font size="6"><input type="button" value="人員交班" onclick="relief();" /></font>
			</div>
		</div>
	</div>
	<div id="bot_right" style="float:left;"><!--數字盤-->
		<div id="num_div" name="num_div" style="width:450px;overflow:auto;" >
			<div style="width:450px;overflow:auto;">
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="7" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="8" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="9" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="-" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="←" onclick="num_div_func(this.value);" /></font>
				</div>
			</div>
			<div style="width:450px;overflow:auto;">
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="4" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="5" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="6" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:160px;float:left;">
					<font size="6"><input style="width:160px;" type="button" value="X" onclick="num_div_func(this.value);" /></font>
				</div>
			</div>
			<div style="width:450px;overflow:auto;">
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="1" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="2" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="3" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:160px;float:left;">
					<font size="6"><input style="width:160px;height:43px;" type="button" value="輸入" onclick="num_div_func(this.value);" /></font>
				</div>
			</div>
			<div style="width:450px;overflow:auto;">
				<div style="width:160px;float:left;">
					<font size="6"><input style="width:160px;" type="button" value="0" onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:80px;float:left;">
					<font size="6"><input style="width:80px;" type="button" value="." onclick="num_div_func(this.value);" /></font>
				</div>
				<div style="width:160px;float:left;">
					<font size="6"><input style="width:160px;height:43px;" type="button" value="結算" onclick="billing();" /></font>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="footer_msg" name="footer_msg" >
系統訊息:欲使用快捷鍵功能，請按住Alt鍵並加上該快捷鍵。<br/>
按下Alt+A即可快速加入一筆，Alt+Enter則可進行結算。按下F11即可開啟/關閉全螢幕。
</div>
<script>
var sys_status = "normal";
var member_no = "";
<?if($setting->mf002=="無此使用者"){?>
	sys_status = "user_error";
	alert("請先進行人員交班後再進行作業。");
<?}?>
var current_list = 0;
setInterval(function(){
	console.log("System status:"+sys_status);
},5000);

$(document).ready(function(){
	$.ajaxPrefilter(function( options, originalOptions, jqXHR ) { //解決ajax的問題
		options.async = true;
	});
	set_num_div();
	$('#barcode').focus();
	check_receipt_number();
<?if($setting->mf002=="無此使用者"){?>
	relief();
<?}?>
	$.datepicker.regional['zh-TW']={
	   dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
	   dayNamesMin:["日","一","二","三","四","五","六"],
	   monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
	   monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
	   prevText:"上月",
	   nextText:"次月",
	   weekHeader:"週"
	};
	//將預設語系設定為中文
	$.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
	$('#record_str_date').datepicker({dateFormat: 'yy/mm/dd'});
	$('#record_end_date').datepicker({dateFormat: 'yy/mm/dd'});
	$('#promotion_str_date').datepicker({dateFormat: 'yy/mm/dd'});
	$('#promotion_end_date').datepicker({dateFormat: 'yy/mm/dd'});
});

/*****以下資料導入處理  Talence Editor*****/
/*****以下條碼輸入處理  Talence Editor*****/
$("#barcode").change(function(){
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	if($("#barcode").val()){
	jQuery.ajax({
	url : '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=select_goods&where='+$("#barcode").val()+'&where_col=mb013&rows=1&page=1',
	type : 'GET',
	dataType: "json",
	success : function(rsdata){
		var data = rsdata.rows[0];
		if(data){
			$('#barcode').val(data['mb013']);
			$('#number').val(data['mb001']);
			$('#name').val(data['mb002']);
			$('#color').val(data['mb004']);
			$('#size').val(data['mb003']);
			$('#price').val(data['mb051']);
			$('#amt').val(1);
			//$('#gift').val(data['gd_gift']);
			if(data['td002']){ $('#spec_price_no').val(data['td002']); }
			$('#true_price').val(data['mb051']);
			if(data['td009']){ $('#price').val(data['td009']); $('#spec_price').val(data['td009']);}
			if(data['td010'] && member_no) {$('#price').val(data['td010']);}
			else if(data['td010'] && !member_no) {$('#member_price').val(data['td010']);}
			if(data['td009'] || data['td010']){
				if(!data['td009']) data['td009'] == '無';
				if(!data['td010']) data['td010'] == '無';
				$('#show_promo').text('特價:'+data['td009']+'元 會員價:'+data['td010']+'元');
			}else{
				$('#show_promo').text('');
			}
			$('#discount').val(100);
			$('#amt').select();
			count_current_totle();
			$('#msg_block').text("");
		}
		else{
			$('#msg_block').text("無此商品!!!")
			$('#show_promo').text('');
			$('#spec_price').val("");
			$('#member_price').val("");
			$('.pro_ipt').val('');
			$('#barcode').focus();
		}
	}});
	}
	
	if(sys_status == 'deal done'){
		auto_clear_all();
	}
});
function check_data(barcode){
	if(barcode){
		jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=select_goods&where='+$("#barcode").val()+'&where_col=mb013&rows=1&page=1',
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var data = rsdata.rows[0];
			if(data){
				//$('#barcode').val(data['mb013']);
				$('#number').val(data['mb001']);
				$('#name').val(data['mb002']);
				$('#color').val(data['mb004']);
				$('#size').val(data['mb003']);
				$('#price').val(data['mb051']);
				$('#amt').val(1);
				//$('#gift').val(data['gd_gift']);
				$('#true_price').val(data['mb051']);
				if(data['td002']){ $('#spec_price_no').val(data['td002']); }
				if(data['td009']){ $('#price').val(data['td009']); $('#spec_price').val(data['td009']);}
				if(data['td010'] && member_no) {$('#price').val(data['td010']);$('#member_price').val(data['td010']);}
				else if(data['td010'] && !member_no) {$('#member_price').val(data['td010']);}
				if(data['td009'] || data['td010']){
					if(!data['td009']) data['td009'] == '無';
					if(!data['td010']) data['td010'] == '無';
					$('#show_promo').text('特價:'+data['td009']+'元 會員價:'+data['td010']+'元');
				}else{
					$('#show_promo').text('');
				}
				$('#discount').val(100);
				count_current_totle();
				$('#msg_block').text("");
			}else{
				$('#show_promo').text('');
				$('#number').val("");
				$('#name').val("");
				$('#color').val("");
				$('#size').val("");
				$('#price').val("");
				$('#amt').val("");
				$('#spec_price').val("");
				$('#member_price').val("");
				//$('#gift').val(data['gd_gift']);
				$('#discount').val("");
			}
		}});
	}
}
function auto_add(add_ary){
	var error_col = "";
	for(var key in add_ary){
		var Data =  $("#pro_gridview").getRowData(add_ary[key]);console.log(add_ary[key]);
		if(Data.mb013 && Data.mb013!=0){
			jQuery.ajax({
			url : '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=select_goods&where='+Data.mb013+'&where_col=mb013&rows=1&page=1',
			type : 'GET',
			dataType: "json",
			success : function(rsdata){
				var data = rsdata.rows[0];
				if(data){
					current_list++;
					count_current_totle();
					var temp_price = data['mb051'];
					if(data['td009']){temp_price = data['td009'];}
					if(member_no && data['td010']) {temp_price = data['td010'];}
					var product_str = '<tr class="goods_list" '+
					'style="text-align:center;" id="goods_list_'+current_list+'" ondblclick="inline_edit('+current_list+')">'+
					'<td class="list_del"><input class="btn_del" type="button" onclick="$(\'#goods_list_'+current_list+'\').remove();count_totle();" value="X" /></td>'+
					'<td class="list_barcode">'+data['mb013']+'</td>'+
					'<td class="list_number">'+data['mb001']+'</td>'+
					'<td class="list_name">'+data['mb002']+'</td>'+
					'<td class="list_color">'+data['mb004']+'</td>'+
					'<td class="list_size">'+data['mb003']+'</td>'+
					'<td class="list_amt"><span id="show_amt_'+current_list+
					'">1</span><input class="pro_ipt" style="width:50px;display:none;text-align:right;" id="inline_amt_'+current_list+
					'" value="1" /></td>'+
					
					'<td class="list_gift"><span id="show_gift_'+current_list+
					'"></span><input class="pro_ipt" style="width:50px;display:none;text-align:right;" id="inline_gift_'+current_list+
					'" value="" /></td>'+
					
					'<td class="list_price"><span id="show_price_'+current_list+'">'+temp_price+
					'</span><span id="true_price_'+current_list+'" style="display:none;">'+data['mb051']+
					'</span><span id="spec_price_'+current_list+'" style="display:none;">'+data['td009']+
					'</span><span id="member_price_'+current_list+'" style="display:none;">'+data['td010']+
					'</span><span id="spec_price_no_'+current_list+'" style="display:none;">'+data['td002']+
					'</span><input class="pro_ipt" style="width:50px;display:none;text-align:right;" id="inline_price_'+current_list+
					'" value="'+temp_price+'" /></td>'+
					
					'<td class="list_discount"><span id="show_discountc_'+current_list+'">0</span>(<span id="show_discount_'+current_list+
					'">100</span><input class="pro_ipt" style="width:30px;display:none;text-align:right;" id="inline_discount_'+current_list+
					'" value="100" />%)</td>'+
					
					'<td class="list_totle"><span id="show_totle_'+current_list+'">'+temp_price+'</span>'+
					'<span id="inline_func_'+current_list+'" style="display:none;"><a href="javascript:inline_save('+current_list+')" style="float:right;"><img style="width:20px;height:20px;" src="<?php echo base_url()?>assets/images/posok.png" /></a>　'+
					'<a href="javascript:inline_cancel('+current_list+')" style="float:right;" ><img style="width:20px;height:20px;" src="<?php echo base_url()?>assets/images/poscancel.png" /></a></span></td></tr>';
					
					$('#pro_detail .pro_ipt').val('');
					$('#msg_block').text("");
					$("#goods").append(product_str);
					set_num_div();
					count_totle();
					sys_status = "working";
				}
				else{
					console.log(Data.mb013+"無此商品!!!")
				}
			}});
		}
		else{
			error_col += add_ary[key]+" ";
		}
	}
	if(error_col){
		alert("第 "+error_col+"項沒有條碼，無法加入。");
	}
}
function add_list(){
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	if($('#barcode').val() && $('#number').val() && $('#name').val() && $('#price').val() && $('#amt').val()){
		current_list++;
		count_current_totle()
		var temp_discount = 0;
		temp_discount = ($('#price').val()*$('#amt').val()-$('#totle').val()).toFixed(0);
		if($('#discount').val()>=100)
			temp_discount = 0;
		var product_str = '<tr class="goods_list" '+
		'style="text-align:center;" id="goods_list_'+current_list+'" ondblclick="inline_edit('+current_list+')">'+
		'<td class="list_del"><input class="btn_del" type="button" onclick="if(sys_status == \'working\'){$(\'#goods_list_'+current_list+'\').remove();count_totle();}" value="X" /></td>'+
		'<td class="list_barcode">'+$('#barcode').val()+'</td>'+
		'<td class="list_number">'+$('#number').val()+'</td>'+
		'<td class="list_name">'+$('#name').val()+'</td>'+
		'<td class="list_color">'+$('#color').val()+'</td>'+
		'<td class="list_size">'+$('#size').val()+'</td>'+
		'<td class="list_amt"><span id="show_amt_'+current_list+'">'+$('#amt').val()+
		'</span><input class="pro_ipt" style="width:50px;display:none;text-align:right;" id="inline_amt_'+current_list+
		'" value="'+$('#amt').val()+'" /></td>'+
		
		'<td class="list_gift"><span id="show_gift_'+current_list+'">'+$('#gift').val()+
		'</span><input class="pro_ipt" style="width:50px;display:none;text-align:right;" id="inline_gift_'+current_list+
		'" value="'+$('#gift').val()+'" /></td>'+
		
		'<td class="list_price"><span id="show_price_'+current_list+'">'+$('#price').val()+
		'</span><span id="true_price_'+current_list+'" style="display:none;">'+$('#true_price').val()+
		'</span><span id="spec_price_'+current_list+'" style="display:none;">'+$('#spec_price').val()+
		'</span><span id="member_price_'+current_list+'" style="display:none;">'+$('#member_price').val()+
		'</span><span id="spec_price_no_'+current_list+'" style="display:none;">'+$('#spec_price_no').val()+
		'</span><input class="pro_ipt" style="width:50px;display:none;text-align:right;" id="inline_price_'+current_list+
		'" value="'+$('#price').val()+'" /></td>'+
		
		'<td class="list_discount"><span id="show_discountc_'+current_list+'">'+temp_discount+'</span>(<span id="show_discount_'+current_list+
		'">'+$('#discount').val()+'</span><input class="pro_ipt" style="width:30px;display:none;text-align:right;" id="inline_discount_'+current_list+
		'" value="'+$('#discount').val()+'" />%)</td>'+
		
		'<td class="list_totle"><span id="show_totle_'+current_list+'">'+$('#totle').val()+'</span>'+
		'<span id="inline_func_'+current_list+'" style="display:none;"><a href="javascript:inline_save('+current_list+')" style="float:right;"><img style="width:20px;height:20px;" src="<?php echo base_url()?>assets/images/posok.png" /></a>　'+
		'<a href="javascript:inline_cancel('+current_list+')" style="float:right;" ><img style="width:20px;height:20px;" src="<?php echo base_url()?>assets/images/poscancel.png" /></a></span></td></tr>';
		
		$('#pro_detail .pro_ipt').val('');
		$('#msg_block').text("");
		$("#goods").append(product_str);
		set_num_div();
		count_totle();
		sys_status = "working";
	}
	else{
		$('#msg_block').text("無商品資料!!!")
		$('#pro_detail .pro_ipt').val('');
	}
	$('#barcode').focus();
}
/***inline edit***/
var edit_line = 0;
function inline_edit(line){
	if(sys_status == "working"){
		$('#show_amt_'+line).hide();
		$('#show_gift_'+line).hide();
		$('#show_price_'+line).hide();
		$('#show_discount_'+line).hide();
		$('#inline_amt_'+line).show();
		$('#inline_gift_'+line).show();
		$('#inline_price_'+line).show();
		$('#inline_discount_'+line).show();
		$('#inline_func_'+line).show();
		$('#inline_amt_'+line).focus();
		$('.btn_del').attr('disabled','disabled');
		$('#pro_detail .pro_ipt').attr('disabled','disabled');
		sys_status = "inline";
		edit_line = line;
	}
}
function inline_save(line){
	$('#show_amt_'+line).show();
	$('#show_gift_'+line).show();
	$('#show_price_'+line).show();
	$('#show_discount_'+line).show();
	$('#inline_amt_'+line).hide();
	$('#show_amt_'+line).text($('#inline_amt_'+line).val());
	$('#inline_price_'+line).hide();
	$('#show_price_'+line).text($('#inline_price_'+line).val());
	$('#inline_gift_'+line).hide();
	$('#show_gift_'+line).text($('#inline_gift_'+line).val());
	$('#inline_func_'+line).hide();
	$('#inline_discount_'+line).hide();
	$('#show_discount_'+line).text($('#inline_discount_'+line).val());
	inline_count(line);
	$('#pro_detail .pro_ipt').removeAttr('disabled');
	$('.btn_del').removeAttr('disabled');
	count_totle();
	sys_status = "working";
}
function inline_cancel(line){
	$('#show_amt_'+line).show();
	$('#show_gift_'+line).show();
	$('#show_price_'+line).show();
	$('#show_discount_'+line).show();
	$('#inline_amt_'+line).hide();
	$('#inline_amt_'+line).val($('#show_amt_'+line).text());
	$('#inline_price_'+line).hide();
	$('#inline_price_'+line).val($('#show_price_'+line).text());
	$('#inline_gift_'+line).hide();
	$('#inline_gift_'+line).val($('#show_gift_'+line).text());
	$('#inline_func_'+line).hide();
	$('#inline_discount_'+line).hide();
	$('#inline_discount_'+line).text($('#show_discount_'+line).val());
	$('#pro_detail .pro_ipt').removeAttr('disabled');
	$('.btn_del').removeAttr('disabled');
	sys_status = "working";
}
function inline_count(line){
	$('#show_totle_'+line).text(($('#inline_amt_'+line).val()*$('#inline_price_'+line).val()*$('#inline_discount_'+line).val()/100).toFixed(0))
	if($('#inline_discount_'+line).val()>100){
		$('#inline_discount_'+line).val(100);
		$('#show_discount_'+line).text(100);
	}
	if($('#inline_discount_'+line).val()<100){
		$('#show_discountc_'+line).text((($('#inline_amt_'+line).val()*$('#inline_price_'+line).val()).toFixed(0)-(($('#inline_amt_'+line).val()*$('#inline_price_'+line).val()*$('#inline_discount_'+line).val()/100).toFixed(0))).toFixed(0));
	}
		
}		

/*****以下小計處理  Talence Editor*****/
function count_current_totle(){
	var regexp = /[0-9]{1,}\.[0-9]{1,2}/g;
	$('#price').val($('#price').val()+".00")
	$('#price').val(regexp.exec($('#price').val()));
	if($('#price').val() && $('#amt').val()){
		$('#totle').val(($('#price').val()*$('#amt').val()).toFixed(0));
	}
	if($('#discount').val()*1){
		$('#totle').val(($('#totle').val()*$('#discount').val()/100).toFixed(0));
	}
	if(!$('#price').val()){
		$('#price').focus();
	}
}
$("#price").change(function(){
	count_current_totle();
});
$("#amt").change(function(){
	count_current_totle();
});
$("#discount").change(function(){
	count_current_totle();
});
/*****結算、結帳*****/
function count_totle(){
	var i = 0;
	var totle = 0;
	var discount = 0;
	for(i=1;i<=current_list;i++){
		totle = totle + ($('#show_totle_'+i).text()*1);
		discount = discount + ($('#show_discountc_'+i).text()*1);
	}
	$('#show_totle').text(totle);
	$('#show_discount').text(discount);
	
	
	return totle;
}

function billing(){
	if(sys_status == "inline"){
		alert('請先結束行內編輯。');
		$('#msg_block').text("請先結束行內編輯。");
		$('#inline_amt_'+edit_line).focus();
	}
	else{
		if(check_system_status()){
			alert(check_system_status());
			return;	
		}
		else if(sys_status != "working"){
			alert('請先開始一筆新的交易。');
			$('#msg_block').text("請先開始一筆新的交易。");
			$('#barcode').focus();
		}
		else{
			$('#pro_detail .pro_ipt').val('');
			$('#cash').removeAttr('disabled');
			$('#creadit').removeAttr('disabled');
			var temp_count = 0;
			for(i=1;i<=current_list;i++){
					if($('#goods_list_'+i+' .list_barcode').text()){
						temp_count = temp_count+1;
					}
			}
			if(temp_count != 0){
				$('#pro_detail .pro_ipt').attr('disabled','disabled');
				count_totle();
				$('#btn_checkout').show();
				$('#btn_checkout').removeAttr('disabled');
				$('#add').attr('disabled','disabled');
				sys_status = "bill done";
				$('#cash').select();
			}
			else{
				alert('無交易商品資料，無法進行結算。');
				$('#msg_block').text("無交易商品資料，無法進行結算。");
				sys_status = "normal";
				$('#barcode').focus();
			}
		}
	}
}

function checkout(){
	if(sys_status == "bill done"){
		$('#btn_checkout').attr('disabled','disabled');
		var change = ($('#cash').val()*1+$('#creadit').val()*1)-$('#show_totle').text();
		if($("#auto_correct").prop('checked')){
			if(change<0){
				$('#cash').val($('#show_totle').text()*1-$('#creadit').val());
				change = $('#cash').val($('#show_totle').text()*1-$('#creadit').val());
				if($('#cash').val($('#show_totle').text()*1-$('#creadit').val())>0)
					change = 0;
			}else{
				$('#show_change').text(change);
			}
		}else{
			if(change<0){
				$('#msg_block').text("不足"+($('#show_totle').text()-$('#cash').val())+"元")
				$('#cash').select();
				return;
			}else{
				$('#show_change').text(change);
				$('#msg_block').text("");
			}
		}		
		
		var totle_list_count = current_list;
		var data_title = {};
		var data_body = {};
		data_title['ta001'] = 1;  //1銷貨  2銷退
		data_title['ta002'] = "";  //銷貨單號，由系統內部給訂
		data_title['ta003'] = "<?echo date('Ymd');?>";
		data_title['ta004'] = "<?echo date('H:i:s');?>";
		data_title['ta005'] = "";  //作廢日期
		data_title['ta006'] = "";  //作廢時間
		data_title['ta007'] = 1;  //1正常 2異常
		data_title['ta008'] = $('#sales').val();  //作業人員代號
		data_title['ta009'] = member_no;  //會員編號
		if($("#print_voice").prop("checked")){
			data_title['ta010'] = $('#receipt').val();  //發票號碼
		}else{
			data_title['ta010'] = "DDDDDDDDDD"; //如不印發票則列成DDDDDDDDDD
		}
		data_title['ta011'] = 1;  //發票張數
		data_title['ta012'] = $('#show_totle').text();  //合計金額
		data_title['ta013'] = $('#show_discount').text();  //折讓金額
		data_title['ta014'] = 0;  //紅利折扣
		data_title['ta015'] = $('#cash').val();  //現金收款金額
		data_title['ta016'] = $('#creadit').val();  //信用卡收款金額
		data_title['ta017'] = $('#EIN').val();
		data_title['ta018'] = 1;  //機台編號
		data_title['ta019'] = $('#show_change').text();;  //找零
		
		var body_count = 0;
		for(i=1;i<=current_list;i++){
			if($('#goods_list_'+i+' .list_barcode').text()){
				body_count = body_count+1;
				data_body[body_count] = {};
				data_body[body_count]['tb001'] = 1;
				data_body[body_count]['tb003'] = body_count;
				data_body[body_count]['tb004'] = $('#goods_list_'+i+' .list_barcode').text();
				data_body[body_count]['tb005'] = $('#goods_list_'+i+' .list_number').text();
				data_body[body_count]['tb006'] = $('#goods_list_'+i+' .list_name').text();
				data_body[body_count]['tb007'] = $('#goods_list_'+i+' .list_size').text();
				data_body[body_count]['tb008'] = $('#goods_list_'+i+' .list_color').text();
				data_body[body_count]['tb009'] = $('#goods_list_'+i+' .list_size').text();
				data_body[body_count]['tb010'] = $('#show_amt_'+i).text();
				data_body[body_count]['tb011'] = $('#show_gift_'+i).text();
				data_body[body_count]['tb012'] = $('#show_discount_'+i).text();
				data_body[body_count]['tb013'] = $('#spec_price_no_'+i).text();
				data_body[body_count]['tb014'] = $('#spec_price_'+i).text();
				if(member_no) data_body[body_count]['tb014'] = $('#member_price_'+i).text();
				data_body[body_count]['tb015'] = $('#show_price_'+i).text();
				data_body[body_count]['tb016'] = $('#show_totle_'+i).text();
			}
		}
		
		url = '<?php echo base_url()?>index.php/pos/posi05/sales?mod=sales&cmd=save_sales';
		$.ajax({
			type : 'POST',
			url : url,
			cache : false,
			data : {
				data_title : data_title, 
				data_cont : data_body
			},
			datatype : 'html',
			success : function(response){
				if(response){
					alert('交易成功!!銷貨編號:'+response);
					$('#msg_block').text("交易完成，銷貨編號:"+response);
					$('#barcode').removeAttr('disabled');
					$('#barcode').focus();
					sys_status = "deal done";
					print_receipt();
				}else{
					alert('系統發生錯誤!!');
					console.log(response);
					$('#msg_block').text("系統發生錯誤!!");
					$('#barcode').removeAttr('disabled');
					$('#barcode').focus();
					sys_status = "deal done";
				}
				
				
			}
		});
		
	}
	else if(sys_status == 'deal done'){
		alert("請重新開始一筆新的交易。");
		$('#barcode').focus();
	}
	else{
		alert("請先進行結算後才結帳。");
		$('#barcode').focus();
	}
}

/*****以下鍵盤按鍵處理  Talence Editor*****/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(sys_status == "normal" || sys_status == "working"){
		if(event.altKey && (keycode == '87')){  //會員
			$('#member').focus();
		}
		if(event.altKey && (keycode == '81')){  //交易取消
			cancel_deal();
		}
		if(event.altKey && (keycode == '112')){  //條碼
			$('#barcode').focus();
		}
		if(event.altKey && (keycode == '113')){  //價格
			$('#price').focus();
		}
		if(event.altKey && (keycode == '114')){  //數量
			$('#amt').focus();
		}
		if(event.altKey && (keycode == '65')){  //加入一筆
			add_list();
		}
		if(event.altKey && (keycode == '13')){  //加入一筆
			billing();
		}
	}
	else if(sys_status == "inline"){
		if(keycode == '13'){
			inline_save(edit_line);
		}
		if(keycode == '27'){
			inline_cancel(edit_line);
		}
	}
});

$('#price').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		$('#amt').select();
	}
});
$('#amt').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		$('#gift').select();
	}
});
$('#gift').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		$('#discount').select();
	}
});
$('#discount').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		$('#add').focus();
	}
});

$('#cash').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		var temp_change = ($('#cash').val()*1+$('#creadit').val()*1)-$('#show_totle').text();
			if(temp_change<0){
				temp_change = 0;
			}
			else
				$('#show_change').text(temp_change);
		$('#btn_checkout').focus();
	}
});
$('#creadit').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		var temp_change = ($('#cash').val()*1+$('#creadit').val()*1)-$('#show_totle').text();
			if(temp_change<0){
				temp_change = 0;
			}
			else
				$('#show_change').text(temp_change);
		$('#btn_checkout').focus();
	}
});
/*****以下數字盤處理  Talence Editor*****/
var select_dom=$('#Talence Editor');
function set_num_div(){
	$('.pro_ipt').focus(function(){
		if(select_dom.attr('id')=='barcode'){
			if(select_dom.attr('id') != $('.pro_ipt:focus').attr('id')){
				$('#barcode').change();
			}
		}
		select_dom = $('.pro_ipt:focus');
	});
}
function num_div_func(input){
	if( select_dom.attr('id')=="number" || select_dom.attr('id')=="name" || select_dom.attr('id')=="size" || select_dom.attr('id')=="color"  || select_dom.attr('id')=="totle"){}
	else{
	var temp = select_dom.val();
	if(input>=0 && input<=9){
		temp += input;
		select_dom.val(temp);
	}
	else if(input == "." && select_dom.attr('id')!='barcode' && select_dom.attr('id')!='amt' && select_dom.attr('id')!='discount'){
		temp += '.';
		select_dom.val(temp);
	}
	else if(input == "←"){
		select_dom.val(temp.slice(0,-1));
	}
	else if(input == "輸入"){
		if(select_dom.attr('id')=='barcode')
			$('#amt').focus();
		else if(select_dom.attr('id')=='amt')
			add_list();
		else{
			count_current_totle();
		}
	}
	}
}
/*****Bot Function*****/
function cancel_deal(){
	//初始化各參數
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	if(confirm('確定要將交易取消?')){
		clear_all();
	}
}

function daily_report(){  //日報表
	var daily_report_src = "<?php echo base_url()?>index.php/fun/posr01a/display";
	$('#daily_report_ifm').attr('src',daily_report_src);
	$( "#daily_report_div" ).dialog({
		title : "日報表",
		width : 1450,
		height : "auto"
	});
}

function receipt_setting(){  //發票號碼
	$( "#receipt_div" ).dialog({
		title : "發票號碼列表",
		width : 1000,
		height : "auto"
	});
	list_receipt_gridview();
}

function search_product(){  //產品查詢
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	$( "#pro_div" ).dialog({
		title : "產品列表",
		width : 1200,
		height : "auto"
	});
	list_pro_gridview();
}

function receipt_refound(){
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	$( "#receipt_refound_div").dialog({
		title : "發票作廢",
		width : 300,
		height : 180
	});
}

function print_receipt(){
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	if(!$("#print_voice").prop("checked")){
		return;
	}
	var print_src = "<?php echo base_url()?>index.php/pos/posi05/printr?invoice="+$('#receipt').val()+"&date=<?php echo date('Ym');?>";
	$('#print_ifm').attr('src',print_src);
	/*$( "#receipt_print_div").dialog({
		title : "列印發票",
		width : 400,
		height : 800
	});
	$('#receipt_print_div').dialog('close');*/
}

function member_data(){  //會員資料
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	$( '#member_div' ).dialog({
		title : "會員資料",
		width : 1200,
		height : "auto"
	});
	list_member_gridview();
}

function promotion_data(){  //促銷活動
	if(check_system_status()){
		alert(check_system_status());
		return;	
	}
	$( '#promotion_div' ).dialog({
		title : "促銷活動",
		width : 1200,
		height : "auto"
	});
	list_promotion_gridview();
}

function record_data(){  //交易紀錄
	if(check_system_status()){
		alert(check_system_status());
		return;
	}
	$( '#record_div' ).dialog({
		title : "交易紀錄",
		width : 1200,
		height : "auto"
	});
	list_record_gridview();
}

function relief(){  //人員交班
	$( "#relief_div" ).dialog({
		title : "人員交班",
		width : 300,
		height : 200
	});
}

function change_employee(){
	var id = $('#ipt_epyid').val();
	var pwd = $('#ipt_epypwd').val();
	jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/setting?mod=setting&cmd=change_employee&mf001='+id+'&mf002='+pwd,
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var result = rsdata;
			if(result){
				if(result.ret=="success"){
					alert(result.response);
					location.reload();
				}else{
					alert(result.response);
				}
			}
			else{
				alert('交班失敗，請重新開始。')
			}
		}
	});
}
/*****全域方法*****/
function clear_all(){
	//初始化各參數
	current_list = 0;
	sys_status = "normal";
	select_dom=$('#Talence Editor');
	$('#msg_block').text('');
	$('#member').val('');
	$('#EIN').val('');
	$('#show_totle').text('0');
	$('#show_discount').text('0');
	$('#show_change').text('0');
	$('#cash').val('0');
	$('#creadit').val('0');
	$('#btn_checkout').css('display','none');
	$('.pro_ipt').removeAttr('disabled');
	$('#cash').attr('disabled','disabled');
	$('#creadit').attr('disabled','disabled');
	$('#add').removeAttr('disabled');
	$('#pro_detail .pro_ipt').val('');
	$('.goods_list').remove();
	$('#add').show();
	$('#btn_refound').hide();
	$('#btn_end_view').hide();
	$('#member_title').text("");
	$('#member_detail').text("");
	$('#show_promo').text('');
	member_no = "";
	$('#EIN').val("");
	check_receipt_number();
}
function auto_clear_all(){
	//初始化各參數
	current_list = 0;
	sys_status = "normal";
	select_dom=$('#Talence Editor');
	$('#msg_block').text('');
	$('#member').val('');
	$('#EIN').val('');
	$('#show_totle').text('0');
	$('#show_discount').text('0');
	$('#show_change').text('0');
	$('#cash').val('0');
	$('#creadit').val('0');
	$('#btn_checkout').css('display','none');
	$('.pro_ipt').removeAttr('disabled');
	$('#cash').attr('disabled','disabled');
	$('#creadit').attr('disabled','disabled');
	$('#add').removeAttr('disabled');
	$('#pro_detail .pro_ipt').val('');
	$('.goods_list').remove();
	$('#add').show();
	$('#btn_refound').hide();
	$('#btn_end_view').hide();
	$('#member_title').text("");
	$('#member_detail').text("");
	$('#show_promo').text('');
	member_no = "";
	$('#EIN').val("");
	check_receipt_number();
}
function check_receipt_number(){
	jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/receipt?mod=receipt&cmd=get_current_receipt',
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var data = rsdata;
			if(data){
				$('#receipt').val(data);
			}
			else{
				alert('發票號碼設定錯誤，請聯絡資訊人員或檢查發票號碼設定。')
			}
		}});
}
function check_system_status(){
	if(sys_status == "user_error" || sys_status == "receipt_error" ){
		if(sys_status == "user_error"){
			return "請先人員交班成功後再進行作業。";
		}
		if(sys_status == "receipt_error"){
			return "發票號碼設定錯誤，請聯絡資訊人員或檢查發票號碼設定。";
		}
		return "系統發生錯誤。";
	}
	else if(sys_status == "look_up"){
		$('#btn_end_view').focus();
		return "請先結束瀏覽紀錄明細功能再繼續。";
	}else{
		return false;
	}
}

function read_only(){
	$('.pro_ipt').attr('disabled', 'disabled');
	$('#add').hide();

}
/*****觸發事件方法*****/
$("#member").change(function(){
	if($('.goods_list').text() || ($('#barcode').val() && $('#number').val())){
		alert("請先清除商品後再輸入會員。");
		$('#member').val("");
		member_no = "";
		console.log($('.goods_list').text());
	}
	if($("#member").val()){
	jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/member?cmd=select_member&where_col=all&where='+$("#member").val(),
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var data = rsdata;
			if(data && data != "nodata"){
				$('#member_title').text("編號:"+data.mc001+"　姓名:"+data.mc002+"　到期日:"+data.mc019);
				$('#member_detail').text("行動:"+data.mc005+"　家用:"+data.mc006);
				member_no = data.mc001;
				$('#EIN').val(data.mc014);
				$('#member').attr('disabled','disabled');
				$('#barcode').focus();
			}
			else if(data == "nodata"){
				$('#member').select();
				$('#member').val("");
				$('#member_title').text("無相關會員資料!!!");
				$('#member_detail').text("");
				member_no = "";
				$('#EIN').val("");
			}
		}
	});
	}
});
</script>

<script>
/*****以下gridview****/
/******
*	主要有以下幾個gridview
*   發票號碼
*	商品
*	日報表
*	交易紀錄
*	會員資料
******/
/*****發票號碼*****/
//全域參數區
var receipt_list_url = '<?php echo base_url()?>index.php/pos/posi05/receipt?cmd=list_receipt';
var receipt_lastSelection = 0;
var receipt_current_url = '<?php echo base_url()?>index.php/pos/posi05/receipt?cmd=list_receipt';
//全域參數區
function list_receipt_gridview(){
	$("#receipt_gridview").jqGrid({
		url: receipt_list_url,
		mtype: 'GET',
		datatype: 'json',
		autowidth: true,
		height: 'auto',
		loadonce: false,
		ajaxGridOprion: {cache:false},
		altRows: true,  //不同列不同底色
		gridview: true,
		viewrecords: true,  //顯示總筆數
		hidegrid: false,  //右上角的收合按鈕
		multiSort: true,
		rowNum: 10,  //設定一頁顯示的筆數(可直接設定，資料庫端由JSON自動處理)
		pager: 'receipt_gridview_pager',  //設定pager的div
		caption: '發票號碼列表',  //標題
		colNames:[/*"Edit Actions",*/'起始年月','截止年月','起始編號','截止編號','已用編號','發票聯數','備註','管理'],  //設定欄位標題
		colModel:[
		//設定個欄位數值
			{name:'mb002',index:'mb002',width:100,align:'center'},
			{name:'mb003',index:'mb003',width:100,align:'center'},
			{name:'mb006',index:'mb006',width:100,align:'center'},
			{name:'mb007',index:'mb007',width:100,align:'center'},
			{name:'mb008',index:'mb008',width:100,align:'center'},
			{name:'mb004_str',index:'mb004',width:100,align:'center'},
			{name:'mb009',index:'mb009',width:100,align:'center'},
			{name:'btn',align:'center',width:70,sortable:false,formatter:function(cellvalue,options,row_obj){
				var rowid = options.rowId;
				var ret = '';
				ret += "<input type='button' onclick='javascript:set_current_receipt("+ row_obj.mb002 +")'title='修改已用編號' value='修改已用編號' />";
				return ret;
				}
			}
		],
		onSelectRow : function(id) {},  //當選取一列時事件
		//ondblClickRow: editRow,	 //雙擊事件 inline 編輯
		onPaging : function() {
		},
		loadComplete: function(data){  //載入完畢觸發事件
			$("#receipt_gridview").focus();
			$("#receipt_gridview").setSelection(receipt_lastSelection);
		}
	});
}

function sch_receipt(){
	var grid = $("#receipt_gridview");
	var receipt_sch_url = '<?php echo base_url()?>index.php/pos/posi05/receipt?mod=receipt&cmd=list_receipt&mode=wild';//&where='+temp_barcode+'&where_col=mb013&rows=1&page=1';
	var sch_col = $('#slt_receipt_sch').val();
	var sch_str = $('#ipt_receipt_sch').val();
	var receipt_current_url = receipt_sch_url+"&where="+sch_str+"&where_col="+sch_col;
	if(sch_str){
		var url = receipt_sch_url+"&where="+sch_str+"&where_col="+sch_col;
		grid.jqGrid('setGridParam', {
			url : url,
			page : 1,
			loadComplete: function(data){  //載入完畢觸發事件
				$("#ipt_sch").focus();
				$("#receipt_gridview").setSelection(lastSelection);
				receipt_current_page = $("#receipt_gridview").getGridParam("page");
			}
		}).trigger('reloadGrid');
	}else{
		var url = receipt_list_url;		
		grid.jqGrid('setGridParam', {
			url : url,
			page : receipt_current_page,
			loadComplete: function(data){  //載入完畢觸發事件
				$("#ipt_receipt_sch").focus();
				$("#receipt_gridview").setSelection(lastSelection);
				receipt_current_page = $("#receipt_gridview").getGridParam("page");
			}
		}).trigger('reloadGrid');
	}
}

function clear_sch_receipt(){
	var grid = $("#receipt_gridview");
	$('#ipt_receipt_sch').val("");
	var url = receipt_list_url;		
	grid.jqGrid('setGridParam', {
		url : url,
		page : 1
	}).trigger('reloadGrid');
}
var str_date = "";
function set_current_receipt(temp_str_date){
	str_date = temp_str_date;
	$( "#set_receipt_div" ).dialog({
		title : str_date+"已用編號設定",
		width : 300,
		height : "auto"
	});
}
function do_set_current_receipt(){
	jQuery.ajax({
	url : '<?php echo base_url()?>index.php/pos/posi05/receipt?mod=receipt&cmd=set_current_receipt&str_date='+str_date+'&used_receipt='+$('#ipt_used_receipt').val(),
	type : 'GET',
	dataType: "json",
	success : function(rsdata){
		alert(rsdata);
		if(rsdata=="設定成功。"){
			$('#set_receipt_div').dialog('close');
			var grid = $("#receipt_gridview");
			var url = receipt_list_url;		
			grid.jqGrid('setGridParam', {
				url : url,
				page : 1
			}).trigger('reloadGrid');
			check_receipt_number()
		}
	}});
}
/*****商品列表*****/
//全域參數區
var goods_list_url = '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=list_goods';
var lastSelection = 0;
var goods_current_page = 1;
var goods_current_url = '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=list_goods';
//全域參數區
function list_pro_gridview(){
	$("#pro_gridview").jqGrid({
		url: goods_list_url,
		mtype: 'GET',
		datatype: 'json',
		autowidth: true,
		height: 'auto',
		loadonce: false,
		ajaxGridOprion: {cache:false},
		altRows: true,  //不同列不同底色
		gridview: true,
		viewrecords: true,  //顯示總筆數
		hidegrid: false,  //右上角的收合按鈕
        multiselect: true,
		multiSort: true,
		rowNum: 10,  //設定一頁顯示的筆數(可直接設定，資料庫端由JSON自動處理)
		pager: 'pro_gridview_pager',  //設定pager的div
		caption: '產品列表',  //標題
		colNames:[/*"Edit Actions",*/'條碼','貨號','品名','規格','顏色','零售價','庫存','功能'],  //設定欄位標題
		colModel:[
		//設定個欄位數值
			{name:'mb013',index:'mb013',width:80,align:'center',
				editable: true,edittype: "text"
			},
			{name:'mb001',index:'mb001',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mb002',index:'mb002',width:120,align:'center', 
				editable: true,edittype: "text"
			},
			{name:'mb003',index:'mb003',width:90,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mb004',index:'mb004',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mb051',index:'mb004',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mb064',index:'mb004',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'btn',align:'center',width:70,sortable:false,formatter:function(cellvalue,options,row_obj){
				var rowid = options.rowId;
				var ret = '';
				ret += "<input type='button' onclick='javascript:add_single_pro("+ row_obj.mb013 +")'title='加入購物清單' value='加入購物清單' />";
				return ret;
				}
			}
		],
		onSelectRow : function(id) {},  //當選取一列時事件
		//ondblClickRow: editRow,	 //雙擊事件 inline 編輯
		onPaging : function() {
		},
		loadComplete: function(data){  //載入完畢觸發事件
			$("#pro_gridview").focus();
			$("#pro_gridview").setSelection(lastSelection);
			goods_current_page = $("#pro_gridview").getGridParam("page");
		}
	});
}
function add_single_pro(temp_barcode){
	if(sys_status != "normal" && sys_status != "working"){
		return;
	}
	if(temp_barcode){
		jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=select_goods&where='+temp_barcode+'&where_col=mb013&rows=1&page=1',
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var data = rsdata.rows[0];
			if(data){
				$('#barcode').val(data['mb013']);
				$('#number').val(data['mb001']);
				$('#name').val(data['mb002']);
				$('#color').val(data['mb004']);
				$('#size').val(data['mb003']);
				$('#price').val(data['mb051']);
				$('#amt').val(1);
				//$('#gift').val(data['gd_gift']););
				$('#true_price').val(data['mb051']);
				if(data['td009']){ $('#price').val(data['td009']); $('#spec_price').val(data['td009']);}
				if(data['td010'] && member_no) {$('#price').val(data['td010']);$('#member_price').val(data['td010']);}
				else if(data['td010'] && !member_no) {$('#member_price').val(data['td010']);}
				if(data['td009'] || data['td010']){
					if(!data['td009']) data['td009'] == '無';
					if(!data['td010']) data['td010'] == '無';
					$('#show_promo').text('特價:'+data['td009']+'元 會員價:'+data['td010']+'元');
				}else{
					$('#show_promo').text('');
				}
				$('#discount').val(100);
				$('#amt').select();
				count_current_totle();
				$('#msg_block').text("");
			}
			else{
				$('#spec_price').val("");
				$('#member_price').val("");
				$('#msg_block').text("參數錯誤，請重新操作!!!")
				$('.pro_ipt').val('');
				$('#barcode').focus();
			}
		}});
	}else{
		alert("選擇之商品沒有條碼。");
	}
}

function add_mult_pro() {
	if(sys_status != "normal" && sys_status != "working"){
		return;
	}
	var grid = $("#pro_gridview");
	var rowKey = grid.getGridParam("selrow");
	if (!rowKey)
		alert("沒有選擇商品!!!");
	else {
		var result = grid.getGridParam("selarrrow");

		auto_add(result);
	}
}

function clear_select(){
	var grid = $("#pro_gridview");
	var url = goods_list_url;		
	grid.jqGrid('setGridParam', {
		page : goods_current_page
	}).trigger('reloadGrid');
}

function sch_goods(){
	var grid = $("#pro_gridview");
	var goods_sch_url = '<?php echo base_url()?>index.php/pos/posi05/goods?mod=goods&cmd=select_goods&mode=wild';//&where='+temp_barcode+'&where_col=mb013&rows=1&page=1';
	var sch_col = $('#slt_sch').val();
	var sch_str = $('#ipt_sch').val();
	var goods_current_url = goods_sch_url+"&where="+sch_str+"&where_col="+sch_col;
	if(sch_str){
		var url = goods_sch_url+"&where="+sch_str+"&where_col="+sch_col;
		grid.jqGrid('setGridParam', {
			url : url,
			page : 1,
			loadComplete: function(data){  //載入完畢觸發事件
				$("#ipt_sch").focus();
				$("#pro_gridview").setSelection(lastSelection);
				goods_current_page = $("#pro_gridview").getGridParam("page");
			}
		}).trigger('reloadGrid');
	}else{
		var url = goods_list_url;		
		grid.jqGrid('setGridParam', {
			url : url,
			page : goods_current_page,
			loadComplete: function(data){  //載入完畢觸發事件
				$("#ipt_sch").focus();
				$("#pro_gridview").setSelection(lastSelection);
				goods_current_page = $("#pro_gridview").getGridParam("page");
			}
		}).trigger('reloadGrid');
	}
}

function clear_sch_goods(){
	var grid = $("#pro_gridview");
	$('#ipt_sch').val("");
	var url = goods_list_url;		
	grid.jqGrid('setGridParam', {
		url : url,
		page : 1
	}).trigger('reloadGrid');
}
/*****會員資料*****/
//全域參數區
var member_list_url = '<?php echo base_url()?>index.php/pos/posi05/member?cmd=list_member';
var member_lastSelection = 0;
var member_current_page = 1;
var member_current_url = '<?php echo base_url()?>index.php/pos/posi05/member?cmd=list_member';
//全域參數區
function list_member_gridview(){
	$("#member_gridview").jqGrid({
		url: member_list_url,
		mtype: 'GET',
		datatype: 'json',
		autowidth: true,
		height: 'auto',
		loadonce: false,
		ajaxGridOprion: {cache:false},
		altRows: true,  //不同列不同底色
		gridview: true,
		viewrecords: true,  //顯示總筆數
		hidegrid: false,  //右上角的收合按鈕
		multiSort: true,
		rowNum: 10,  //設定一頁顯示的筆數(可直接設定，資料庫端由JSON自動處理)
		pager: 'member_gridview_pager',  //設定pager的div
		caption: '會員列表',  //標題
		colNames:[/*"Edit Actions",*/'會員編號','姓名','行動電話','市內電話','統一編號','到期日','累積消費額','功能'],  //設定欄位標題
		colModel:[
		//設定個欄位數值
			{name:'mc001',index:'mc001',width:100,align:'center',
				editable: true,edittype: "text"
			},
			{name:'mc002',index:'mc002',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mc005',index:'mc005',width:100,align:'center', 
				editable: true,edittype: "text"
			},
			{name:'mc006',index:'mc006',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mc014',index:'mc014',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mc019',index:'mc019',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'mc021',index:'mc021',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'btn',align:'center',width:70,sortable:false,formatter:function(cellvalue,options,row_obj){
				var rowid = options.rowId;
				var ret = '';
				ret += "<input type='button' onclick='javascript:input_member_data("+ row_obj.mc001 +")'title='加入購物資料' value='加入購物資料' />";
				return ret;
				}
			}
		],
		onSelectRow : function(id) {},  //當選取一列時事件
		//ondblClickRow: editRow,	 //雙擊事件 inline 編輯
		onPaging : function() {
		},
		loadComplete: function(data){  //載入完畢觸發事件
			$("#member_gridview").focus();
			$("#member_gridview").setSelection(member_lastSelection);
			member_current_page = $("#member_gridview").getGridParam("page");
		}
	});
	$("#list").jqGrid('bindKeys', {  //綁定按鍵
		   "onEnter" : function( rowid ) { 
				//editRow(rowid);
			},
			"onLeftKey" : function( rowid ) {
				//$("#prev_list_pager").click();
			},
			"onRightKey" : function( rowid ) {
				//$("#next_list_pager").click();
			}, 
			"onSpace" : function( rowid ) {
			}
			//,scrollingRows : true  還未知的功能
	});
}

function sch_member(){
	var grid = $("#member_gridview");
	var member_sch_url = '<?php echo base_url()?>index.php/pos/posi05/member?mod=member&cmd=list_member&mode=wild';//&where='+temp_barcode+'&where_col=mb013&rows=1&page=1';
	var sch_col = $('#slt_member_sch').val();
	var sch_str = $('#ipt_member_sch').val();
	var member_current_url = member_sch_url+"&where="+sch_str+"&where_col="+sch_col;
	if(sch_str){
		var url = member_sch_url+"&where="+sch_str+"&where_col="+sch_col;
		grid.jqGrid('setGridParam', {
			url : url,
			page : 1,
			loadComplete: function(data){  //載入完畢觸發事件
				$("#ipt_sch").focus();
				$("#member_gridview").setSelection(lastSelection);
				member_current_page = $("#member_gridview").getGridParam("page");
			}
		}).trigger('reloadGrid');
	}else{
		var url = member_list_url;		
		grid.jqGrid('setGridParam', {
			url : url,
			page : member_current_page,
			loadComplete: function(data){  //載入完畢觸發事件
				$("#ipt_member_sch").focus();
				$("#member_gridview").setSelection(lastSelection);
				member_current_page = $("#member_gridview").getGridParam("page");
			}
		}).trigger('reloadGrid');
	}
}

function clear_sch_member(){
	var grid = $("#member_gridview");
	$('#ipt_member_sch').val("");
	var url = member_list_url;		
	grid.jqGrid('setGridParam', {
		url : url,
		page : 1
	}).trigger('reloadGrid');
}

function input_member_data(mc001){
	$('#member').val(mc001);
	$('#member').change();
}
/*****促銷活動*****/
//全域參數區
var promotion_list_url = '<?php echo base_url()?>index.php/pos/posi05/promotion?cmd=list_promotion';
var promotion_lastSelection = 0;
var promotion_current_page = 1;
var promotion_current_url = '<?php echo base_url()?>index.php/pos/posi05/promotion?cmd=list_promotion';
var temp_tc001 = "";
var temp_tc002 = "";
//全域參數區
function list_promotion_gridview(){
	$("#promotion_gridview").jqGrid({
		url: promotion_list_url,
		mtype: 'GET',
		datatype: 'json',
		autowidth: true,
		height: 'auto',
		loadonce: false,
		ajaxGridOprion: {cache:false},
		altRows: true,  //不同列不同底色
		gridview: true,
		viewrecords: true,  //顯示總筆數
		hidegrid: false,  //右上角的收合按鈕
		multiSort: true,
		rowNum: 10,  //設定一頁顯示的筆數(可直接設定，資料庫端由JSON自動處理)
		pager: 'promotion_gridview_pager',  //設定pager的div
		caption: '<?echo $setting->mk002;?> 促銷活動',  //標題
		colNames:[/*"Edit Actions",*/'促銷單號','產品編號','條碼','品名','原售價','特價','會員價','開始日期','結束日期'],  //設定欄位標題
		colModel:[
		//設定個欄位數值
			{name:'tc002',index:'tc002',width:80,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'td004',index:'td004',width:60,align:'center', 
				editable: true,edittype: "text"
			},
			{name:'td011',index:'td011',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'td005',index:'td005',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'td008',index:'td008',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'td009',index:'td009',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'td010',index:'td010',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'tc004',index:'tc004',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'tc006',index:'tc006',width:60,align:'center',  
				editable: true,edittype: "text"
			}
		],
		onSelectRow : function(id) {},  //當選取一列時事件
		//ondblClickRow: editRow,	 //雙擊事件 inline 編輯
		onPaging : function() {
		},
		loadComplete: function(data){  //載入完畢觸發事件
			$("#promotion_gridview").focus();
			$("#promotion_gridview").setSelection(promotion_lastSelection);
			promotion_current_page = $("#promotion_gridview").getGridParam("page");
		}
	});
}

function sch_promotion(){
	var grid = $("#promotion_gridview");
	var promotion_sch_url = '<?php echo base_url()?>index.php/pos/posi05/promotion?cmd=select_promotion&mode=wild';
	var sch_col = $('#slt_promotion_sch').val();
	var sch_str = $('#ipt_promotion_sch').val();
	var str_date = $('#promotion_str_date').val();
	var end_date = $('#promotion_end_date').val();
	//var promotion_current_url = promotion_sch_url+"&where="+sch_str+"&where_col="+sch_col+"&str_date="+str_date+"&end_date="+end_date;
	url = promotion_sch_url;
	url += "&where_col="+sch_col;
	if(sch_str){
		url += "&where="+sch_str;
		page = 1;
	}
	if(str_date || end_date){
		url += "&str_date="+str_date+"&end_date="+end_date;
		page = 1;
	}
	else{
		page = 1;
	}
	if(!sch_str && !str_date && !end_date){
		url = promotion_list_url;
	}
	promotion_current_url = url;
	grid.jqGrid('setGridParam', {
		url : url,
		page : page,
		loadComplete: function(data){  //載入完畢觸發事件
			$("#ipt_promotion_sch").focus();
			$("#promotion_gridview").setSelection(lastSelection);
			promotion_current_page = $("#promotion_gridview").getGridParam("page");
		}
	}).trigger('reloadGrid');
}
function reload_promotion(){
	var grid = $("#promotion_gridview");
	var promotion_sch_url = '<?php echo base_url()?>index.php/pos/posi05/promotion?cmd=select_promotion&mode=wild';
	var sch_col = $('#slt_promotion_sch').val();
	var sch_str = $('#ipt_promotion_sch').val();
	var str_date = $('#promotion_str_date').val();
	var end_date = $('#promotion_end_date').val();
	var page = promotion_current_page;
	//var promotion_current_url = promotion_sch_url+"&where="+sch_str+"&where_col="+sch_col+"&str_date="+str_date+"&end_date="+end_date;
	url = promotion_current_url;
	/*if(sch_str){
		url += "&where="+sch_str+"&where_col="+sch_col;
	}
	if(str_date || end_date){
		url += "&str_date="+str_date+"&end_date="+end_date;
	}
	else{
		page = promotion_current_page;
	}*/
	promotion_current_url = url;
	grid.jqGrid('setGridParam', {
		url : url,
		page : page,
		loadComplete: function(data){  //載入完畢觸發事件
			$("#ipt_promotion_sch").focus();
			$("#promotion_gridview").setSelection(lastSelection);
			promotion_current_page = $("#promotion_gridview").getGridParam("page");
		}
	}).trigger('reloadGrid');
}

function clear_sch_promotion(){
	var grid = $("#promotion_gridview");
	$('#ipt_promotion_sch').val("");
	$('#promotion_str_date').val("");
	$('#promotion_end_date').val("");
	var url = promotion_list_url;		
	grid.jqGrid('setGridParam', {
		url : url,
		page : 1
	}).trigger('reloadGrid');
}
/*****交易紀錄*****/
//全域參數區
var record_list_url = '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=list_sales&mode=wild&str_date=&end_date=<?php echo date('Y/m/d');?>';
var record_lastSelection = 0;
var record_current_page = 1;
var record_current_url = '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=list_sales';
var temp_ta001 = "";
var temp_ta002 = "";
//全域參數區
function list_record_gridview(){
	$("#record_gridview").jqGrid({
		url: record_list_url,
		mtype: 'GET',
		datatype: 'json',
		autowidth: true,
		height: 'auto',
		loadonce: false,
		ajaxGridOprion: {cache:false},
		altRows: true,  //不同列不同底色
		gridview: true,
		viewrecords: true,  //顯示總筆數
		hidegrid: false,  //右上角的收合按鈕
		multiSort: true,
		rowNum: 10,  //設定一頁顯示的筆數(可直接設定，資料庫端由JSON自動處理)
		pager: 'record_gridview_pager',  //設定pager的div
		caption: '交易紀錄',  //標題
		colNames:[/*"Edit Actions",*/'單別','銷貨單號','發票號碼','統一編號','合計金額','折讓金額','會員編號','作業人員代號','功能'],  //設定欄位標題
		colModel:[
		//設定個欄位數值
			{name:'ta001_str',index:'ta001',width:50,align:'center',
				editable: true,edittype: "text"
			},
			{name:'ta002',index:'ta002',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'ta010',index:'ta010',width:100,align:'center', 
				editable: true,edittype: "text"
			},
			{name:'ta017',index:'ta017',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'ta012',index:'ta012',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'ta013',index:'ta013',width:60,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'ta009',index:'ta009',width:80,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'ta008',index:'ta008',width:100,align:'center',  
				editable: true,edittype: "text"
			},
			{name:'btn',align:'center',width:70,sortable:false,formatter:function(cellvalue,options,row_obj){
				var rowid = options.rowId;
				var ret = '';
				ret += "<input type='button' onclick='javascript:view_record_detail("+row_obj.ta001+","+ row_obj.ta002 +")'title='查看細項' value='查看細項' />";
				return ret;
				}
			}
		],
		onSelectRow : function(id) {},  //當選取一列時事件
		//ondblClickRow: editRow,	 //雙擊事件 inline 編輯
		onPaging : function() {
		},
		loadComplete: function(data){  //載入完畢觸發事件
			$("#record_gridview").focus();
			$("#record_gridview").setSelection(record_lastSelection);
			record_current_page = $("#record_gridview").getGridParam("page");
		}
	});
}

function sch_record(){
	var grid = $("#record_gridview");
	var record_sch_url = '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=list_sales&mode=wild';
	var sch_col = $('#slt_record_sch').val();
	var sch_str = $('#ipt_record_sch').val();
	var str_date = $('#record_str_date').val();
	var end_date = $('#record_end_date').val();
	//var record_current_url = record_sch_url+"&where="+sch_str+"&where_col="+sch_col+"&str_date="+str_date+"&end_date="+end_date;
	url = record_sch_url;
	if(sch_str){
		url += "&where="+sch_str+"&where_col="+sch_col;
		page = 1;
	}
	if(str_date || end_date){
		url += "&str_date="+str_date+"&end_date="+end_date;
		page = 1;
	}
	else{
		url = record_list_url;
		page = record_current_page;
	}
	record_current_url = url;
	grid.jqGrid('setGridParam', {
		url : url,
		page : page,
		loadComplete: function(data){  //載入完畢觸發事件
			$("#ipt_record_sch").focus();
			$("#record_gridview").setSelection(lastSelection);
			record_current_page = $("#record_gridview").getGridParam("page");
		}
	}).trigger('reloadGrid');
}
function reload_record(){
	var grid = $("#record_gridview");
	var record_sch_url = '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=list_sales&mode=wild';
	var sch_col = $('#slt_record_sch').val();
	var sch_str = $('#ipt_record_sch').val();
	var str_date = $('#record_str_date').val();
	var end_date = $('#record_end_date').val();
	var page = record_current_page;
	//var record_current_url = record_sch_url+"&where="+sch_str+"&where_col="+sch_col+"&str_date="+str_date+"&end_date="+end_date;
	url = record_sch_url;
	if(sch_str){
		url += "&where="+sch_str+"&where_col="+sch_col;
	}
	if(str_date || end_date){
		url += "&str_date="+str_date+"&end_date="+end_date;
	}
	else{
		url = record_list_url;
		page = record_current_page;
	}
	record_current_url = url;
	grid.jqGrid('setGridParam', {
		url : url,
		page : page,
		loadComplete: function(data){  //載入完畢觸發事件
			$("#ipt_record_sch").focus();
			$("#record_gridview").setSelection(lastSelection);
			record_current_page = $("#record_gridview").getGridParam("page");
		}
	}).trigger('reloadGrid');
}

function clear_sch_record(){
	var grid = $("#record_gridview");
	$('#ipt_record_sch').val("");
	$('#record_str_date').val("");
	$('#record_end_date').val("<?echo date('Y/m/d');?>");
	var url = record_list_url;		
	grid.jqGrid('setGridParam', {
		url : url,
		page : 1
	}).trigger('reloadGrid');
}
function view_record_detail(ta001,ta002){
	if(sys_status != "normal"){		
		if(confirm('如要觀看紀錄細項，需先將當前交易資料清空，是否繼續?')){
			clear_all();
		}
	}
	if(sys_status == "normal")	{
		sys_status = "look_up";
		jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=select_sales&ta001='+ta001+'&ta002='+ta002,
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var data = rsdata;
			if(data && data!="param_error" && data!="nodata"){
				read_only();
				$('#btn_refound').show();
				$('#btn_end_view').show();
				$('#member').val(data.title.ta009);
				$('#sales').val(data.title.ta008);
				$('#receipt').val(data.title.ta010);
				$('#EIN').val(data.title.ta017);
				$('#cash').val(data.title.ta015);
				$('#creadit').val(data.title.ta016);
				$('#show_change').text(data.title.ta019);
				$('#show_totle').text(data.title.ta012);
				$('#show_discount').text(data.title.ta013);
				if(data.cont != "nodata"){
					for(var key in data.cont){
						add_list_for_view(data.cont[key]);
					}
				}
				if(data.title.ta001 == "2")
					$('#msg_block').text("已銷退  銷貨單號:"+data.title.ta002);
				else
					$('#msg_block').text("銷貨單號:"+data.title.ta002);
				temp_ta001 = data.title.ta001;
				temp_ta002 = data.title.ta002;
			}
			else if(data == "param_error"){
				alert('紀錄瀏覽參數錯誤，請重新操作。')
				sys_status = "normal";
			}
			else if(data == "nodata"){
				alert('查無紀錄資料，請重新操作。')
				sys_status = "normal";
			}
			else{
				alert('紀錄瀏覽資料庫端錯誤，請重新操作。')
				sys_status = "normal";
			}
		}});
	}
}

function refound(){
	if(sys_status == "look_up"){
		if(confirm('是否要銷退此筆交易?')){
			jQuery.ajax({
			url : '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=refound_sales&ta001='+temp_ta001+'&ta002='+temp_ta002,
			type : 'GET',
			dataType: "json",
			success : function(rsdata){
				var data = rsdata;
				if(data && data!="param_error" && data!="nodata" && data!="have_refound"){
					alert('已銷退完成，銷退編號為:'+data);
				}
				else if(data == "param_error"){
					alert('紀錄瀏覽參數錯誤，請重新操作。')
					sys_status = "normal";
					end_view();
				}
				else if(data == "nodata"){
					alert('查無紀錄資料，請重新操作。')
					sys_status = "normal";
					end_view();
				}
				else if(data == "have_refound"){
					alert('此發票已銷退過，請重新操作。')
					sys_status = "normal";
					end_view();
				}
				else{
					alert('銷退失敗，請再操作一次或聯絡資訊人員。')
				}
			}});
		}
	}
}
function receipt_refounding(){
	if(sys_status != "normal"){		
		if(confirm('如要觀看紀錄細項，需先將當前交易資料清空，是否繼續?')){
			clear_all();
		}
	}
	if(sys_status == "normal")	{
		sys_status = "look_up";
		var ta001 = 1;
		var ta010 = $('#ipt_receipt_refound').val();
		jQuery.ajax({
		url : '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=select_refound_sales&ta001='+ta001+'&ta010='+ta010,
		type : 'GET',
		dataType: "json",
		success : function(rsdata){
			var data = rsdata;
			if(data && data!="param_error" && data!="nodata" && data!="have_refound"){
				read_only();
				$('#btn_refound').show();
				$('#btn_end_view').show();
				$('#member').val(data.title.ta009);
				$('#sales').val(data.title.ta008);
				$('#receipt').val(data.title.ta010);
				$('#EIN').val(data.title.ta017);
				$('#cash').val(data.title.ta015);
				$('#creadit').val(data.title.ta016);
				$('#show_change').text(data.title.ta019);
				$('#show_totle').text(data.title.ta012);
				$('#show_discount').text(data.title.ta013);
				for(var key in data.cont){
					add_list_for_view(data.cont[key]);
				}
				$('#msg_block').text("銷貨單號:"+data.title.ta002);
				temp_ta001 = data.title.ta001;
				temp_ta002 = data.title.ta002;
				if(confirm('是否要將此筆交易銷退?')){
					jQuery.ajax({
					url : '<?php echo base_url()?>index.php/pos/posi05/sales?cmd=refound_sales&ta001='+ta001+'&ta010='+ta010,
					type : 'GET',
					dataType: "json",
					success : function(rsdata){
						var data = rsdata;
						if(data){
							if(data && data!="param_error" && data!="nodata" && data!="have_refound"){
								alert('銷退完成，銷退編號為:'+data);
								end_view();
							}
							else if(data == "param_error"){
								alert('紀錄瀏覽參數錯誤，請重新操作。')
								sys_status = "normal";
								end_view();
							}
							else if(data == "nodata"){
								alert('查無紀錄資料，請重新操作。')
								sys_status = "normal";
								end_view();
							}
							else if(data == "have_refound"){
								alert('此發票已銷退過，請重新操作。')
								sys_status = "normal";
								end_view();
							}
						}
						else{
							alert('紀錄瀏覽資料庫端錯誤，請重新操作。')
							console.log("Maybe body error,need check.");
							sys_status = "normal";
							end_view();
						}
					}});
				}else{
					end_view();
				}
			}
			else if(data == "param_error"){
				alert('紀錄瀏覽參數錯誤，請重新操作。')
				sys_status = "normal";
				end_view();
			}
			else if(data == "nodata"){
				alert('查無紀錄資料，請重新操作。')
				sys_status = "normal";
				end_view();
			}
			else if(data == "have_refound"){
				alert('此發票已銷退，請重新操作。')
				sys_status = "normal";
				end_view();
			}
			else{
				alert('紀錄瀏覽資料庫端錯誤，請重新操作。')
				sys_status = "normal";
				end_view();
			}
		}});
	}
}

function end_view(){
	clear_all();
	sys_status = "normal";
}

function add_list_for_view(data){
	current_list++;
	var product_str = '<tr class="goods_list" '+
	'style="text-align:center;" id="goods_list_'+current_list+'" >'+
	'<td class="list_del"></td>'+
	'<td class="list_barcode">'+data.tb004+'</td>'+
	'<td class="list_number">'+data.tb005+'</td>'+
	'<td class="list_name">'+data.tb006+'</td>'+
	'<td class="list_color">'+data.tb008+'</td>'+
	'<td class="list_size">'+data.tb007+'</td>'+
	'<td class="list_amt"><span id="show_amt_'+current_list+'">'+data.tb010+'</span></td>'+
	'<td class="list_gift"><span id="show_gift_'+current_list+'">'+data.tb011+'</span></td>'+
	'<td class="list_price"><span id="show_price_'+current_list+'">'+data.tb015+'</span></td>'+	
	'<td class="list_discount"><span id="show_discount_'+current_list+'">'+data.tb012+'</span>%</td>'+
	'<td class="list_totle"><span id="show_totle_'+current_list+'">'+data.tb016+'</span>'+'</td></tr>';
	
	$("#goods").append(product_str);
}
/***以下綁定事件***/
</script>
<!--日報表-->
<div id="daily_report_div" name="daily_report_div" style="display:none;width:1000px;height:500px;text-align:center;">
<iframe id="daily_report_ifm" width="1400" height="500">
</iframe>
</div>
<!--發票號碼-->
<div id="receipt_div" name="receipt_div" style="display:none;width:1200px;height:470px;">
<table id="receipt_gridview" name="receipt_gridview" style="width:95%;">
<div id="receipt_gridview_pager" name="receipt_gridview_pager"></div>
</table>
</div>
<div id="set_receipt_div" name="set_receipt_div" style="display:none;width:300px;height:200px;text-align:center;">
<br/><br/>已用編號：<input style="width:150px;" id="ipt_used_receipt" name="ipt_used_receipt" value="" />
<br/><br/><br/><input type="button" style="width:150px;" id="" name="" value="設定編號" onclick="do_set_current_receipt();" />
</div>
<!--產品查詢-->
<div id="pro_div" name="pro_div" style="display:none;width:1200px;height:470px;">
<div style="overflow:auto;">
查詢關鍵字：<input id="ipt_sch" name="ipt_sch" onchange="sch_goods();" onkeyup="sch_goods();" />
<select id="slt_sch" name="slt_sch" onchange="sch_goods();" >
	<option value="all">全部</option>
	<option value="mb013">條碼</option>
	<option value="mb001">貨號</option>
	<option value="mb002">品名</option>
	<option value="mb003">規格</option>
	<option value="mb004">顏色</option>
	<option value="mb051">零售價</option>
	<option value="mb064">庫存</option>
</select>
<input type="button" id="btn_sch" name="btn_sch" value="查詢" onclick="sch_goods();" />
<input type="button" id="btn_clear_sch" name="btn_clear_sch" value="清除條件" onclick="clear_sch_goods();" />
<span id="current_term" name="current_term"></span>
<input type="button" style="float:right;" id="btn_add_mult" name="btn_add_mult" value="加入多筆" onclick="add_mult_pro();" />
<input type="button" style="float:right;" id="btn_clear_select" name="btn_clear_select" value="清除選擇" onclick="clear_select();" />
</div></br>
<div>
<table id="pro_gridview" name="pro_gridview" style="width:95%;">
<div id="pro_gridview_pager" name="pro_gridview_pager"></div>
</table>
</div>
</div>
<!--會員編號-->
<div id="member_div" name="member_div" style="display:none;width:1200px;height:470px;">
<div style="overflow:auto;">
查詢關鍵字：<input id="ipt_member_sch" name="ipt_member_sch" onchange="sch_member();" onkeyup="sch_member();" />
<select id="slt_member_sch" name="slt_member_sch" onchange="sch_member();" >
	<option value="all">全部</option>
	<option value="mc001">編號</option>
	<option value="mc002">姓名</option>
	<option value="mc005">行動電話</option>
	<option value="mc006">市內電話</option>
	<option value="mc014">統一編號</option>
	<option value="mc019">到期日</option>
	<option value="mc021">消費額</option>
</select>
<input type="button" id="btn_sch" name="btn_sch" value="查詢" onclick="sch_member();" />
<input type="button" id="btn_clear_sch" name="btn_clear_sch" value="清除條件" onclick="clear_sch_member();" />
<span id="current_term" name="current_term"></span>
</div></br>
<div>
<table id="member_gridview" name="member_gridview" style="width:95%;">
<div id="member_gridview_pager" name="member_gridview_pager"></div>
</table>
</div>
</div>
<!--促銷活動-->
<div id="promotion_div" name="promotion_div" style="display:none;width:1200px;height:470px;">
<div style="overflow:auto;">
查詢關鍵字：<input style="width:150px;" id="ipt_promotion_sch" name="ipt_promotion_sch" onchange="sch_promotion();" onkeyup="sch_promotion();" />
<select id="slt_promotion_sch" name="slt_promotion_sch" onchange="sch_promotion();" >
	<option value="all">全部</option>
	<option value="td004">產品編號</option>
	<option value="td011">條碼</option>
	<option value="td005">品名</option>
	<option value="td002">促銷單號</option>
</select>
起始日期:<input style="width:110px;" id="promotion_str_date" name="promotionstr_date" value="" onchange="sch_promotion();" />
結束日期:<input style="width:110px;" id="promotion_end_date" name="promotion_end_date" value="" onchange="sch_promotion();" />
<input type="button" id="btn_sch" name="btn_sch" value="查詢" onclick="sch_promotion();" />
<input type="button" id="btn_clear_sch" name="btn_clear_sch" value="清除條件" onclick="clear_sch_promotion();" />
<input type="button" id="btn_reload_sch" name="btn_reload_sch" value="重新整理" onclick="reload_promotion();" >
<span id="current_term" name="current_term"></span>
</div></br>
<div>
<table id="promotion_gridview" name="promotion_gridview" style="width:95%;">
<div id="promotion_gridview_pager" name="promotion_gridview_pager"></div>
</table>
</div></br>
</div>
<div id="promotion_detail_div" name="promotion_detail_div" style="display:none;width:1200px;height:470px;">
<div>
<div>
門市:<span id="show_store" style="width:150px;" >　　</span>單號:<span id="show_promotion_no" style="width:150px;" >　　</span>開始日期:<span id="show_promo_strdate" style="width:150px;">　　</span>結束日期:<span id="show_promo_enddate" style="width:150px;">　　</span>
</div>
<br/>
<table id="promotion_detail_gridview" name="promotion_detail_gridview" style="width:95%;">
<div id="promotion_detail_gridview_pager" name="promotion_detail_gridview_pager"></div>
</table>
</div>
</div>
<!--交易紀錄-->
<div id="record_div" name="record_div" style="display:none;width:1200px;height:470px;">
<div style="overflow:auto;">
查詢關鍵字：<input style="width:150px;" id="ipt_record_sch" name="ipt_record_sch" onchange="sch_record();" onkeyup="sch_record();" />
<select id="slt_record_sch" name="slt_record_sch" onchange="sch_record();" >
	<option value="all">全部</option>
	<option value="ta010">發票號碼</option>
	<option value="ta002">銷貨單號</option>
	<option value="ta008">作業人員代號</option>
	<option value="ta009">會員編號</option>
	<option value="ta017">統一編號</option>
	<option value="ta012">合計金額</option>
</select>
起始日期:<input style="width:110px;" id="record_str_date" name="record_str_date" value="" onchange="sch_record();" />
結束日期:<input style="width:110px;" id="record_end_date" name="record_end_date" value="<?echo date('Y/m/d');?>" onchange="sch_record();" />
<input type="button" id="btn_sch" name="btn_sch" value="查詢" onclick="sch_record();" />
<input type="button" id="btn_clear_sch" name="btn_clear_sch" value="清除條件" onclick="clear_sch_record();" />
<input type="button" id="btn_reload_sch" name="btn_reload_sch" value="重新整理" onclick="reload_record();" >
<span id="current_term" name="current_term"></span>
</div></br>
<div>
<table id="record_gridview" name="record_gridview" style="width:95%;">
<div id="record_gridview_pager" name="record_gridview_pager"></div>
</table>
</div></br>
<div>
<table id="record_detail_gridview" name="record_detail_gridview" style="width:95%;">
<div id="record_detail_gridview_pager" name="record_detail_gridview_pager"></div>
</table>
</div>
</div>
<!--發票作廢-->
<div id="receipt_refound_div" name="receipt_refound_div" style="display:none;width:300px;height:100px;text-align:center;">
發票號碼 ：<input style="width:150px;" id="ipt_receipt_refound" name="ipt_receipt_refound" value="" /><br/><br/><br/>
<font size="5"><input type="button" style="width:200px;" id="" name="" value="確定" onclick="receipt_refounding();" /></font>
</div>
<script>
	$('#ipt_receipt_refound').keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(keycode == '13'){
		receipt_refounding();
	}
});
</script>
<!--人員交班-->
<div id="relief_div" name="relief_div" style="display:none;width:300px;height:200px;text-align:center;">
<font size="3" color="red">銷售門市 ： <?echo $setting->mk022;?>　<?echo $setting->mk002;?></font><br/><br/>
人員代號：<input style="width:100px;" id="ipt_epyid" name="ipt_epyid" value="0001" /><br/>
人員密碼：<input style="width:100px;" id="ipt_epypwd" name="ipt_epypwd" value="0001" /><br/><br/>
<input type="button" style="width:200px;" id="" name="" value="登入" onclick="change_employee();" />
</div>
<!--列印發票-->
<div id="receipt_print_div" name="receipt_print_div" style="display:none;width:400px;height:800px;text-align:center;">
<iframe id="print_ifm" width="400px" height="800px">
</iframe>
</div>











