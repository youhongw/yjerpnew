<script type="text/javascript">
	function keyFunction() {
		$("input").not($(":button")).keypress(function(evt) {
			if (evt.keyCode == 13) {
				if ($(this).attr("type") !== 'submit') {
					var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio');
					var index = fields.index(this);
					if (index > -1 && (index + 1) < fields.length) {
						fields.eq(index + 1).focus();
					}
					$(this).blur();
					return false;
				}
			}
		});
	}
	$(function() {
		// setup enter to next input element function
		setupEnterToNext();
	});
	// enter to next input element function
	function setupEnterToNext() {
		// add keydown event for all inputs
		$(':input').keydown(function(e) {
			if (e.keyCode == 13 /*Enter*/ ) {
				// focus next input elements
				$(':input:visible:enabled:eq(' + ($(':input:visible:enabled').index(this) + 1) + ')').focus();
				e.preventDefault();
			}
		});
	}
	//檢查最新編號
	function check_title_no() {
		$('#ta002').val("");
		var moci01 = $('#moci01').val();
		var ta003 = $('#ta003').val();
		var ta003 = ta003.substr(0, 4) + ta003.substr(5, 2) + ta003.substr(8, 2);
		//alert(moci01);
		// console.log(moci01);
		// console.log(ta003);
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/moc/moci02a/check_title_no",
				data: {
					moci01: moci01,
					ta003: ta003
				}
			})
			.done(function(msg) {
				$('#ta002').val(msg);
				// if ($('#moci01disp').text() != "" && $('#moci01disp').text() != "查無資料")
				// 	$('#ta002').val(msg);
			});
	}



	$("#Showsfci04").click(function() {
		//	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		selected_row = row;
		// console.log($('#invi02').val());
		$('#hpa_ifmain').attr('src', "<?php echo base_url() ?>index.php/bom/bomi07/editb_child/" + $("#TA006").val() + '/' + $("#TA001").val() + '/');

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '35%',
				left: '25%',
				height: '50%',
				width: '35%',
				overflow: 'auto',
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


	function remove_row() {
		// var table = document.getElementById("order_product");
		// var tbodyRowCount = document.getElementById("order_product").rows.length - 2;
		// console.log('有幾列：' + current_count);

		for (var i = 10; i >= 1; i--) {
			// console.log('移除_' + i + ":" + i);
			$("#product_row_" + i).remove();
		}
	}

	function sum_row() {
		var sum_total = 0;
		for (var i = current_count; i >= 1; i--) {
			if ($('#order_product\\[' + i + '\\]\\[tb005\\]').val() != '' && $('#order_product\\[' + i + '\\]\\[tb005\\]').val() != undefined)
				sum_total += Number($('#order_product\\[' + i + '\\]\\[tb005\\]').val());
		}
		$('#ta016').val(sum_total);


	}


	//匯入明細圖2 
	function import_bomi07(me001, me002, me003, me004) {
		// console.log('me001');
		// console.log(me001);
		$.ajax({
				method: "POST",
				dataType: "json",
				url: "<?php echo base_url() ?>index.php/moc/moci02a/import_bomi07",
				data: {
					me001: me001,
					me002: me002,
					me003: me003,
					me004: me004
				}
			})
			.done(function(msg) {

				if (msg == 0) {
					alert("無資料可匯入!");
				} else {
					// console.log(msg);
					//if(confirm("共計"+msg.length+"筆，是否匯入?")){
					remove_row();
					current_count = 0;
					for (var key in msg) {
						var val = msg[key];
						addItem();
						// console.log('TK003:' + val['TK003']);
						$('#order_product\\[' + current_count + '\\]\\[TK003\\]').val(val['TK003']);
						$('#order_product\\[' + current_count + '\\]\\[TK004\\]').val(val['TK004']);
						$('#order_product\\[' + current_count + '\\]\\[TK004disp\\]').val(val['TK004disp']);
						$('#order_product\\[' + current_count + '\\]\\[TK024\\]').val(val['TK024']);
						$('#order_product\\[' + current_count + '\\]\\[TK005\\]').val(val['TK005']);
						$('#order_product\\[' + current_count + '\\]\\[TK006\\]').val(val['TK006']);
						$('#order_product\\[' + current_count + '\\]\\[TK007\\]').val(val['TK007']);
						$('#order_product\\[' + current_count + '\\]\\[TK008\\]').val(val['TK008']);
						$('#order_product\\[' + current_count + '\\]\\[TK009\\]').val(val['TK009']);
						$('#order_product\\[' + current_count + '\\]\\[TK010\\]').val(val['TK010']);
						$('#order_product\\[' + current_count + '\\]\\[TK011\\]').val(val['TK011']);
						$('#order_product\\[' + current_count + '\\]\\[TK012\\]').val(val['TK012']);
						$('#order_product\\[' + current_count + '\\]\\[TK013\\]').val(val['TK013']);
						$('#order_product\\[' + current_count + '\\]\\[TK014\\]').val(val['TK014']);
						$('#order_product\\[' + current_count + '\\]\\[TK015\\]').val(val['TK015']);
						$('#order_product\\[' + current_count + '\\]\\[TK016\\]').val(val['TK016']);
						$('#order_product\\[' + current_count + '\\]\\[TK017\\]').val(val['TK017']);
						$('#order_product\\[' + current_count + '\\]\\[TK018\\]').val(val['TK018']);
						$('#order_product\\[' + current_count + '\\]\\[TK019\\]').val(val['TK019']);
						$('#order_product\\[' + current_count + '\\]\\[TK020\\]').val(val['TK020']);
						$('#order_product\\[' + current_count + '\\]\\[TK021\\]').val(val['TK021']);
						$('#order_product\\[' + current_count + '\\]\\[TK025\\]').val(val['TK025']);
						$('#order_product\\[' + current_count + '\\]\\[TK028\\]').val(val['TK028']);
						$('#order_product\\[' + current_count + '\\]\\[TK030\\]').val(val['TK030']);
						$('#order_product\\[' + current_count + '\\]\\[TK031\\]').val(val['TK031']);
						$('#order_product\\[' + current_count + '\\]\\[TK032\\]').val(val['TK032']);
						$('#order_product\\[' + current_count + '\\]\\[TK034\\]').val(val['TK034']);
						// addItem();
					}

					//}
				}

			});
	}



	function addItem() {

		current_count++;

		var append_str = "";
		var type = "";
		append_str += "<tbody id='product_row_" + current_count + "' class='product_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product[' + current_count + '][TK001]" value="" />';
		append_str += '<input type="hidden" name="order_product[' + current_count + '][TK002]" value="" />';
		append_str += '<td class="left"><input type="text" onKeyPress="keyFunction()" id="order_product[' + current_count + '][TK003]" name="order_product[' + current_count + '][TK003]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><input type="text" id="order_product[' + current_count + '][TK004]" name="order_product[' + current_count + '][TK004]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><input type="text" onKeyPress="keyFunction()" id="order_product[' + current_count + '][TK004disp]" name="order_product[' + current_count + '][TK004disp]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><input type="text" onKeyPress="keyFunction()" id="order_product[' + current_count + '][TK024]" name="order_product[' + current_count + '][TK024]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><select id="order_product[' + current_count + '][TK005s]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK005s]" tyle="background-color:#EBEBE4" disabled="true" >';
		append_str += '<option value="1">1:廠內</option><option value="2">2:託外</option></select></td>';
		append_str += '<td class="left"><input type="text" id="order_product[' + current_count + '][TK006]" name="order_product[' + current_count + '][TK006]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><input type="text" onKeyPress="keyFunction()" id="order_product[' + current_count + '][TK007]" name="order_product[' + current_count + '][TK007]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><input type="text" onKeyPress="keyFunction()" id="order_product[' + current_count + '][TK008]" name="order_product[' + current_count + '][TK008]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="left"><input type="text" onKeyPress="keyFunction()" id="order_product[' + current_count + '][TK009]" name="order_product[' + current_count + '][TK009]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK010]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK010]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK011]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK011]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK012]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK012]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK013]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK013]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK014]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK014]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK015]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK015]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK016]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK016]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK017]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK017]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';

		append_str += '<input type="hidden" id="order_product[' + current_count + '][TK018]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK018]" value="" size="10"  />';
		append_str += '<input type="hidden" id="order_product[' + current_count + '][TK019]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK019]" value="" size="10"  />';
		append_str += '<input type="hidden" id="order_product[' + current_count + '][TK005]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK005]" value="" size="10"  />';

		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK020]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK020]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK021]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK021]" value="" size="10" style="text-align:right;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" required /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK025]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK025]" value="" size="10" style="text-align:right;" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" required /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK028]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK028]" value="" size="10" style="text-align:right;" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" required /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK030]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK030]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK031]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK031]" value="" size="10" style="background-color:#EBEBE4" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK032]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK032]" value="" size="10" style="text-align:right;background-color:#EBEBE4;" readonly="readonly" /></td>';
		append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][TK034]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][TK034]" value="" size="10" style="text-align:left;" /></td>';

		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product tfoot').before(append_str);
	}
	//開圖1視窗(廠商單價計價檔puri02)回傳值
	function addpuri02disp(me001, me002, me003, me004, me005, me006, me007) {
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tb006\\]').val(me001); //品號
		$('#order_product\\[' + selected_row + '\\]\\[tb005\\]').val(me002); //品名
		$('#order_product\\[' + selected_row + '\\]\\[tb006\\]').val(me003); //規格
		$('#order_product\\[' + selected_row + '\\]\\[tb009\\]').val(me004); //單位
		$('#order_product\\[' + selected_row + '\\]\\[tb010\\]').val(me005); //單價
		$('#order_product\\[' + selected_row + '\\]\\[tb007\\]').val(me006); //庫別
		$('#order_product\\[' + selected_row + '\\]\\[tb007disp\\]').val(me007); //庫別名稱

		$('#order_product\\[' + selected_row + '\\]\\[tb006\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/pur/puri02/clear_sql"
		});
	}

	function clear_copi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/bom/bomi07/clear_sql"
		});
	}

	function clear_puri02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/pur/puri02/clear_sql"
		});
	}
	//查詢庫別下拉選單
	function set_catcomplete2(row) {
		// console.log(row);
		// $('#order_product\\[' + row + '\\]\\[tb009\\]').catcomplete({
		// 	autoFocus: false,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb002 = $('#order_product\\[' + row + '\\]\\[tb009\\]').val();
		// 		$('#order_product\\[' + row + '\\]\\[tb009\\]').attr('onchange', '');
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb002),
		// 			cache: false,
		// 			dataType: 'json',
		// 			type: 'POST',
		// 			data: req,
		// 			success: function(data) {
		// 				if (data.response == "true") {
		// 					add(data.message);
		// 				}
		// 			}
		// 		});
		// 	},
		// 	select: function(event, ui) {
		// 		clear_row(row);
		// 		if (ui.item.value != "查無資料") {
		// 			$('#order_product\\[' + row + '\\]\\[tb009\\]').val(ui.item.value1);
		// 			$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val(ui.item.value2);
		// 		}
		// 		return false;
		// 	},
		// 	change: function(event, ui) {
		// 		$('#cmsi03').attr('onchange', 'check_cmsi03d(this)');
		// 		check_cmsi03d(row); //1060713 新增
		// 		//check_cmsi03d($('#order_product\\['+row+'\\]\\[tb007\\]').val());
		// 		return false;
		// 	}
		// 	//focus: function(event, ui) {
		// 	//	return false;
		// 	//}
		// });
	}
</script>
<!--<script type="text/javascript">
	  //合計金額
	function totalSum() {

		var sumTotal = 0;
		var sumQty = 0;
		sumQty1 = 0;
		sumQty2 = 0;
		var product_row = 0;
		var sumamt = 0;
		sumTax = 0;
		tax = 0.00;
		vtax = 0.00;
		var index1 = 0;
		index2 = 0;
		index3 = 0;
		index4 = 0;
		var price = 0;
		qty = 0;
		qty1 = 0;
		qty2 = 0;
		temp1 = 0;
		//採購單金額 ta019
		$(".total_price").each(function(index, element) {
			price = $('input[name=\'order_product[' + index1 + '][tb011]\']').val();
			index1 = index1 + 1;
			if (isNaN(price)) {
				price = 0;
			}
			sumamt += parseFloat(price);
			//   console.log(sumamt);
		});
		if (typeof($('input[name=\'order_product[' + index1 + '][tb011]\']').val()) == 'undefined') {
			price = 0;
		} else {
			price = $('input[name=\'order_product[' + index1 + '][tb011]\']').val();
		}
		if (isNaN(price) || price == null || price == '') {
			price = 0;
		}
		sumamt += parseFloat(price);
		$('#ta019').val(sumamt);
		//  console.log(sumamt);
		//end 訂單金額合計

		//稅金 ta020
		tax = $('input[name=\'ta026\']').val();
		$('#ta020').val(Math.round(sumamt * tax));
		var sumTax = Math.round(sumamt * tax);
		var vtax = 1 + parseFloat(tax);
		//	if ($('select[name=\'ta016\']').val()=='1') {$('#ta029').val()=Math.round(sumamt/parseFloat(vtax));$('#ta030').val()=Math.round(sumamt-$('#ta029').val());}
		if ($('select[name=\'ta018\']').val() == '1') {
			$('#ta019').val(Math.round(sumamt / parseFloat(vtax)));
			temp1 = Math.round(sumamt - $('#ta019').val());
			$('#ta030').val(temp1);
		}
		var sumtot = Math.round(sumamt + sumTax);
		$('#ta019').val(sumamt);
		$('#ta020').val(sumTax);
		$('#tc1920').val(Math.round(sumtot)); //合計金額
		//  console.log(sumtot);
		//數量合計 ta023
		$(".total_qty").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index2 + '][tb008]\']').val())) {
				qty = 0;
			} else {
				qty = $('input[name=\'order_product[' + index2 + '][tb008]\']').val();
			}
			index2 = index2 + 1;
			if (isNaN(qty) || qty == null || qty == '') {
				qty = 0;
			}
			sumQty += parseFloat(qty);
			// console.log(sumQty);
		});
		if (typeof($('input[name=\'order_product[' + index2 + '][tb008]\']').val()) == 'undefined') {
			qty = 0;
		} else {
			qty = $('input[name=\'order_product[' + index2 + '][tb008]\']').val();
		}
		if (isNaN(qty) || qty == null || qty == '') {
			qty = 0;
		}
		sumQty += parseFloat(qty);
		$('#ta023').val(sumQty);
		// console.log(sumQty);
		//end 數量合計

		//總毛重合計 ta043
		$(".total_qty1").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index3 + '][tb030]\']').val())) {
				qty1 = 0;
			} else {
				qty1 = $('input[name=\'order_product[' + index3 + '][tb030]\']').val();
			}
			index3 = index3 + 1;
			if (isNaN(qty1) || qty1 == null || qty1 == '') {
				qty1 = 0;
			}
			sumQty1 += parseFloat(qty1);
			//  console.log(sumQty1);
		});
		if (typeof($('input[name=\'order_product[' + index3 + '][tb030]\']').val()) == 'undefined') {
			qty1 = 0;
		} else {
			qty1 = $('input[name=\'order_product[' + index3 + '][tb030]\']').val();
		}
		if (isNaN(qty1) || qty1 == null || qty1 == '') {
			qty1 = 0;
		}
		sumQty1 += parseFloat(qty1);
		$('#ta043').val(sumQty1);
		// console.log(sumQty1);
		//end 總毛重合計

		//總材積合計 ta044
		$(".total_qty2").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index4 + '][tb031]\']').val())) {
				qty2 = 0;
			} else {
				qty2 = $('input[name=\'order_product[' + index4 + '][tb031]\']').val();
			}
			index4 = index4 + 1;
			if (isNaN(qty2) || qty2 == null || qty2 == '') {
				qty2 = 0;
			}
			sumQty2 += parseFloat(qty2);
			//   console.log(sumQty2);
		});
		if (typeof($('input[name=\'order_product[' + index4 + '][tb031]\']').val()) == 'undefined') {
			qty2 = 0;
		} else {
			qty2 = $('input[name=\'order_product[' + index4 + '][tb031]\']').val();
		}
		if (isNaN(qty2) || qty2 == null || qty2 == '') {
			qty2 = 0;
		}
		sumQty2 += parseFloat(qty2);
		$('#ta044').val(sumQty2);
		// console.log(sumQty2);
		//end 總材積合計

	}
	//
	
</script>-->

<script>
	function del_detail(tb001, tb002, tb003, row, tb005) {
		if (confirm("確定刪除細項:" + tb001 + "-" + tb002 + "-" + tb003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/moc/moci02a/del_detail_ajax/" + tb001 + "/" + tb002 + "/" + tb003 + "/" + tb005 + "/",
					data: {
						tb001: tb001,
						tb002: tb002,
						tb003: tb003,
						tb005: tb005
					}
				})
				.done(function(msg) {
					// console.log('msg:' + msg);
					if (msg == 1) {
						//	alert( "刪除細項:"+tb001+"-"+tb002+"-"+tb003+" 成功!");
						$("#product_row_" + row).remove();
						sum_row();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + tb001 + "-" + tb002 + "-" + tb003 + " 失敗!");
					}
				});
		}
	}

	function clear_row(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// for (var k = 4; k <= 22; k++) { //k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		// 	$('#product-row' + row + ' input.order_product_tb00' + k).val("");
		// 	$('#product-row' + row + ' input.order_product_tb0' + k).val("");
		// 	$('#product-row' + row + ' input.order_product_td' + k).val("");
		// }
		// for (var k = 1; k <= 10; k++) { //k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		// 	$('#order_product\\[' + k + '\\]\\[tb012\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[tb013\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[tb007\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[tb009\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[tb009disp\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[tb005\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[tb017\\]').val("");
		// }

		$('#order_product\\[' + row + '\\]\\[tb012\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb013\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb007\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb009\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb005\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb017\\]').val("");
	}
</script>
<script>
	/***Talence 更新自動focus***/
	$(document).keydown(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (event.altKey && (keycode == '65')) { //tab1 a
			setTimeout(function() {
				$('input[name="cmsi05"]').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '66')) { //tab2 b
			setTimeout(function() {
				$('#ta010').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '67')) { //tab3 c
			setTimeout(function() {
				$('#mv032').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '71')) { //tab4 g
			setTimeout(function() {
				$('#mv048').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '72')) { //tab5 h
			setTimeout(function() {
				$('#mv048').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '73')) { //tab6 i
			setTimeout(function() {
				$('#mv049').focus();
			}, 100);
		}
		//跳明細
		if (event.altKey && (keycode == '89')) { //tab6 y
			setTimeout(function() {
				$('input[name=\'order_product[1][tb006]\']').focus();
			}, 100);
		}
		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.altKey && (keycode == '40' || keycode == '45')) { //新增一筆明細 alt+↓
			addItem();
		}
	});
	//-->
</script>
<script>
	//查詢產品視窗
	function search_invi02d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		var vmz001 = $('#invi02').val();
		if (vmz001 == '') {
			alert('請先選擇產品代號!');
			return $('#invi02').focus();
		}
		var vta017 = $('#ta017').val();
		if (vta017 == '') {
			alert('請先輸入產量!');
			return $('#ta017').focus();
		}

		//1個參數------------------------------------------------------------------------
		vtb003 = $('#order_product\\[' + selected_row + '\\]\\[tb003\\]').val();

		if (vtb003 == undefined) {
			$('#hpi_ifmain').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_child/");
		} else {
			$('#hpi_ifmain').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_child/0/0/" + vtb003 + "/");
		}
		//1個參數------------------------------------------------------------------------end


		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '70%',
				overflow: 'auto',
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

	function addinvi02adisp(mb001, mb002, mb003, mb004, mb005, mb006) {

		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[tb012\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tb003\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[tb012\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[tb013\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[tb007\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[tb009\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[tb009disp\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[tb005\\]').val('');
		$('#order_product\\[' + selected_row + '\\]\\[tb005\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		console.log(mb001);
		console.log(current_count);
		$('#order_product\\[' + current_count + '\\]\\[tb003\\]').val(mb001);
		$('#order_product\\[' + current_count + '\\]\\[tb012\\]').val(mb002);
		$('#order_product\\[' + current_count + '\\]\\[tb013\\]').val(mb003);
		$('#order_product\\[' + current_count + '\\]\\[tb007\\]').val(mb004);
		$('#order_product\\[' + current_count + '\\]\\[tb009\\]').val(mb005);
		$('#order_product\\[' + current_count + '\\]\\[tb009disp\\]').val(mb006);
		addItem();
	}

	function clear_invi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}
	//
	//查詢庫別視窗
	function search_cmsi03d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		// console.log(row);
		selected_row = row;
		$.blockUI({
			css: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '50%',
				overflow: 'hidden',
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

	function addcmsi03ddisp(mb001, mb002) {
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[tb009disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用		
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tb009\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[tb009disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[tb005\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
		});
	}

	function clear_cmsi03disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
		});
	}
	//
	//查詢製程視窗
	function search_cmsi19d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		console.log(row);
		selected_row = row;
		$.blockUI({
			css: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '50%',
				overflow: 'hidden',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi19d'),
			onOverlayClick: clear_cmsi19disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi19ddisp(mb001, mb002) {
		clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tb006\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[tb006disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[tb006\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql"
		});
	}

	function clear_cmsi19disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_invi02d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}


		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[tb012\\]'); //改變顏色用

		var smb001 = $('#order_product\\[' + row + '\\]\\[tb003\\]').val();
		if (!smb001) {
			clear_row(row);
			paragraph.style.color = "red"; //改變顏色用
			$('#order_product\\[' + row + '\\]\\[tb012\\]').val("不可空白");

			return $('#order_product\\[' + row + '\\]\\[tb003\\]').focus();
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd2_invi02/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				mb001: row_obj.value
			},
			success: function(data) {
				if (data.response) {
					paragraph.style.color = "black"; //改變顏色用

					$('#order_product\\[' + row + '\\]\\[tb012\\]').val(data.tb012);
					$('#order_product\\[' + row + '\\]\\[tb013\\]').val(data.tb013);
					$('#order_product\\[' + row + '\\]\\[tb007\\]').val(data.tb007);
					$('#order_product\\[' + row + '\\]\\[tb009\\]').val(data.tb009);
					$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val(data.tb009disp);
					return $('#order_product\\[' + row + '\\]\\[tb017\\]').focus();
				} else {
					clear_row(row);
					paragraph.style.color = "red"; //改變顏色用
					$('#order_product\\[' + row + '\\]\\[tb003\\]').val(smb001);
					$('#order_product\\[' + row + '\\]\\[tb012\\]').val("查無資料!請重新輸入");

					return $('#order_product\\[' + row + '\\]\\[tb003\\]').focus();
				}
			}
		});
	}
	//庫別
	function check_cmsi03d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[tb009disp\\]'); //改變顏色用

		var smb001 = $('#order_product\\[' + row + '\\]\\[tb009\\]').val();
		if (!smb001) {
			paragraph.style.color = "red"; //改變顏色用
			$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val('不可空白');
			return $('#tb009').focus();
		}

		$.ajax({
				url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03d/' + encodeURIComponent(smb001),
				type: 'POST',
				data: {
					mb001: row_obj.value
				}
			})
			.done(function(msg) {
				// console.log(msg);
				//回傳值顯示處理
				if (msg == 'N') {
					paragraph.style.color = "red"; //改變顏色用
					$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val("查無資料");
					return $('#order_product\\[' + row + '\\]\\[tb009\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[tb005\\]').focus();
				}

			});
		// success: function(data) {

		// 	if (data.response) {
		// 		paragraph.style.color = "black"; //改變顏色用
		// 		$('#order_product\\[' + row + '\\]\\[tb009\\]').val(data.message[0].value1);
		// 		$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val(data.message[0].value2);
		// 	} else {
		// 		paragraph.style.color = "red"; //改變顏色用
		// 		$('#order_product\\[' + row + '\\]\\[tb009\\]').val("查無資料");
		// 	}
		// }
		// });
	}
</script>
<!--開視窗 品號品名    -->
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hpi_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!--開視窗 庫別    -->
<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!--開視窗 製程    -->
<div id="divFcmsi19d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi19/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
<!--開視窗圖1廠商計價 puri02 有屬性不必下 src   -->
<div id="divFpuri02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/pur/puri02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<!--開視窗圖2整套展開 copi02 有屬性不必下 src   -->
<div id="divFcopi02a" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hpa_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>