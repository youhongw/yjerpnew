<script type="text/javascript">
	//檢查最新編號
	function check_title_no() {
		$('#td002').val("");
		var sfci01 = $('#sfci01').val();
		var td008 = $('#td008').val();
		//alert(sfci01);
		// console.log(sfci01);
		// console.log(td008);
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/sfc/sfci03/check_title_no",
				data: {
					sfci01: sfci01,
					td008: td008
				}
			})
			.done(function(msg) {
				$('#td003').val(td008);
				// console.log("check_title_no:" + msg);
				if ($('#sfci01disp').text() != "查無資料")
					$('#td002').val(msg);
			});
	}

	function chang_line() {
		var vsfc01 = $('#sfci01').val();
		if (vsfc01.length >= 2) {
			vsfc01 = vsfc01.substr(0, 2);
			remove_row()
		}
	}

	function remove_row() {
		// var table = document.getElementById("order_product");
		// var tbodyRowCount = document.getElementById("order_product").rows.length - 2;
		// console.log('有幾列：' + current_count);

		for (var i = current_count; i >= 1; i--) {
			// console.log('移除_' + i + ":" + i);
			$("#product_row_" + i).remove();
		}
	}

	//查詢品名規格開視窗 copi06 //下拉選單$('.close').click($.unblockUI);
	// function set_catcomplete(row) {
	// 	$('#order_product\\[' + row + '\\]\\[tc004\\]').catcomplete({
	// 		autoFocus: false,
	// 		delay: 1000,
	// 		minLength: 1,
	// 		source: function(req, add) {
	// 			var smb001 = $('#order_product\\[' + row + '\\]\\[tc004\\]').val();
	// 			$('#order_product\\[' + row + '\\]\\[tg004\\]').attr('onchange', '');
	// 			console.log(smb001);
	// 			$.ajax({
	// 				url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd_invi02/' + encodeURIComponent(smb001),
	// 				cache: false,
	// 				dataType: 'json',
	// 				type: 'POST',
	// 				data: req,
	// 				success: function(data) {
	// 					if (data.response == "true") {
	// 						add(data.message);
	// 					}
	// 				}
	// 			});
	// 		},
	// 		select: function(event, ui) {
	// 			clear_row(row);
	// 			console.log(ui.item.value);
	// 			if (ui.item.value != "查無資料") {
	// 				$('#order_product\\[' + row + '\\]\\[tc004\\]').val(ui.item.value1);
	// 				$('#order_product\\[' + row + '\\]\\[tc005\\]').val(ui.item.value2);
	// 				$('#order_product\\[' + row + '\\]\\[tc006\\]').val(ui.item.value3);
	// 				$('#order_product\\[' + row + '\\]\\[tc010\\]').val(ui.item.value4);
	// 				$('#order_product\\[' + row + '\\]\\[tc007\\]').val(ui.item.value5);
	// 				$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(ui.item.value6);
	// 			}
	// 			return false;
	// 		},

	// 		change: function(event, ui) {
	// 			$('#order_product\\[' + row + '\\]\\[tc004\\]').attr('onchange', 'check_invi02d(this)');
	// 			check_invi02d(row); //1060713 新增
	// 			//check_invi02d($('#order_product\\['+row+'\\]\\[tc004\\]').val());
	// 			return false;
	// 		}
	// 		//focus: function(event, ui) {
	// 		//	return false;
	// 		//}
	// 	});

	// 	//明細計算
	// 	$('input[name=\'order_product[' + row + '][tc008]\'],input[name=\'order_product[' + row + '][tc011]\'],input[name=\'order_product[' + row + '][tc026]\'],input[name=\'order_product[' + row + '][tc030]\'],input[name=\'order_product[' + row + '][tc031]\']').focusout(function() {
	// 		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
	// 		var input_1 = $('input[name=\'order_product[' + n + '][tc008]\']').val() * 1;
	// 		var input_2 = $('input[name=\'order_product[' + n + '][tc011]\']').val() * 1;
	// 		var input_3 = $('input[name=\'order_product[' + n + '][tc026]\']').val() / 100;
	// 		var get_total = input_1 * input_2 * input_3;
	// 		$('input[name=\'order_product[' + n + '][tc012]\']').val(get_total);
	// 		//合計資料
	// 		totalSum();

	// 	});
	// 	//數量游標停在 0 之後 
	// 	$('input[name=\'order_product[' + row + '][tc008]\']').focus(function() {
	// 		var real_value = $(this)[0].defaultValue;
	// 		if ($(this).val() == real_value)
	// 			$(this).val(real_value);
	// 		if ($(this).val() == '0')
	// 			$(this).val('');
	// 	});

	// 	//單價  游標停在 0 之後
	// 	$('input[name=\'order_product[' + row + '][tc011]\']').focus(function() {
	// 		var real_value = $(this)[0].defaultValue;
	// 		if ($(this).val() == real_value)
	// 			$(this).val(real_value);
	// 		if ($(this).val() == '0')
	// 			$(this).val('');
	// 	});
	// 	//預設預交日期
	// 	$('input[name=\'order_product[' + row + '][tc013]\']').focus(function() {
	// 		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
	// 		var today = new Date();
	// 		var dd = today.getDate();
	// 		var mm = today.getMonth() + 1; //January is 0!
	// 		var yyyy = today.getFullYear();
	// 		if (dd < 10) {
	// 			dd = '0' + dd
	// 		}

	// 		if (mm < 10) {
	// 			mm = '0' + mm
	// 		}

	// 		today = yyyy + '/' + mm + '/' + dd;
	// 		if ($('input[name=\'order_product[' + n + '][tc013]\']').val() == '') {
	// 			$('input[name=\'order_product[' + n + '][tc013]\']').val(today);
	// 		}
	// 	});
	// 	//單身品號圖1視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	// 	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	// 	$('#order' + row).click(function() {
	// 		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
	// 		selected_row = row;
	// 		console.log($('#copi01').val());
	// 		if ($('#copi01').val() == '') {
	// 			alert('請先選擇客戶代號!');
	// 			return;
	// 		}

	// 		$('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cop/copi02/display_child/" + $("#copi01").val());
	// 		$.blockUI({
	// 			css: {
	// 				top: '15%',
	// 				left: '25%',
	// 				height: '75%',
	// 				width: '75%',
	// 				overflow: 'auto',
	// 				'-webkit-border-radius': '10px',
	// 				'-moz-border-radius': '10px',
	// 				'-khtml-border-radius': '10px',
	// 				'border-radius': '10px',
	// 			},
	// 			message: $('#divFcopi02'),
	// 			onOverlayClick: clear_copi02disp_sql
	// 		});
	// 		$('.close').click($.unblockUI);
	// 	});
	// }
	//開圖1視窗(客戶單價計價檔copi02)回傳值
	function addcopi02disp(me001, me002, me003, me004, me005, me006, me007) {
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').val(me001); //品號
		$('#order_product\\[' + selected_row + '\\]\\[tc005\\]').val(me002); //品名
		$('#order_product\\[' + selected_row + '\\]\\[tc006\\]').val(me003); //規格
		$('#order_product\\[' + selected_row + '\\]\\[tc010\\]').val(me004); //單位
		$('#order_product\\[' + selected_row + '\\]\\[tc011\\]').val(me005); //單價
		$('#order_product\\[' + selected_row + '\\]\\[tc007\\]').val(me006); //庫別
		$('#order_product\\[' + selected_row + '\\]\\[tc007disp\\]').val(me007); //庫別名稱

		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
		});
	}

	function clear_copi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
		});
	}
	//查詢庫別下拉選單
	// function set_catcomplete2(row) {
	// 	console.log(row);
	// 	$('#order_product\\[' + row + '\\]\\[tc007\\]').catcomplete({
	// 		autoFocus: false,
	// 		delay: 1000,
	// 		minLength: 1,
	// 		source: function(req, add) {
	// 			var smb002 = $('#order_product\\[' + row + '\\]\\[tc007\\]').val();
	// 			$('#order_product\\[' + row + '\\]\\[tc007\\]').attr('onchange', '');
	// 			$.ajax({
	// 				url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb002),
	// 				cache: false,
	// 				dataType: 'json',
	// 				type: 'POST',
	// 				data: req,
	// 				success: function(data) {
	// 					if (data.response == "true") {
	// 						add(data.message);
	// 					}
	// 				}
	// 			});
	// 		},
	// 		select: function(event, ui) {
	// 			clear_row(row);
	// 			if (ui.item.value != "查無資料") {
	// 				$('#order_product\\[' + row + '\\]\\[tc007\\]').val(ui.item.value1);
	// 				$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(ui.item.value2);
	// 			}
	// 			return false;
	// 		},
	// 		change: function(event, ui) {
	// 			$('#cmsi03').attr('onchange', 'check_cmsi03d(this)');
	// 			check_cmsi03d(row); //1060713 新增
	// 			//check_cmsi03d($('#order_product\\['+row+'\\]\\[tc007\\]').val());
	// 			return false;
	// 		}
	// 		//focus: function(event, ui) {
	// 		//	return false;
	// 		//}
	// 	});
	// }
</script>
<script type="text/javascript">
	// <!--  //合計金額

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
		//訂單金額 tb029
		$(".total_price").each(function(index, element) {
			price = $('input[name=\'order_product[' + index1 + '][tc012]\']').val();
			index1 = index1 + 1;
			if (isNaN(price)) {
				price = 0;
			}
			sumamt += parseFloat(price);
			//   console.log(sumamt);
		});
		if (typeof($('input[name=\'order_product[' + index1 + '][tc012]\']').val()) == 'undefined') {
			price = 0;
		} else {
			price = $('input[name=\'order_product[' + index1 + '][tc012]\']').val();
		}
		if (isNaN(price) || price == null || price == '') {
			price = 0;
		}
		sumamt += parseFloat(price);
		$('#tb029').val(sumamt);
		//  console.log(sumamt);
		//end 訂單金額合計

		//稅金 tb030
		tax = $('input[name=\'tb041\']').val();
		$('#tb030').val(Math.round(sumamt * tax));
		var sumTax = Math.round(sumamt * tax);
		var vtax = 1 + parseFloat(tax);
		//	if ($('select[name=\'tb016\']').val()=='1') {$('#tb029').val()=Math.round(sumamt/parseFloat(vtax));$('#tb030').val()=Math.round(sumamt-$('#tb029').val());}
		if ($('select[name=\'tb016\']').val() == '1') {
			$('#tb029').val(Math.round(sumamt / parseFloat(vtax)));
			temp1 = Math.round(sumamt - $('#tb029').val());
			$('#tb030').val(temp1);
		}
		var sumtot = Math.round(sumamt + sumTax);
		$('#tb029').val(sumamt);
		$('#tb030').val(sumTax);
		$('#tc2930').val(Math.round(sumtot)); //合計金額
		//  console.log(sumtot);
		//數量合計 tb031
		$(".total_qty").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index2 + '][tc008]\']').val())) {
				qty = 0;
			} else {
				qty = $('input[name=\'order_product[' + index2 + '][tc008]\']').val();
			}
			index2 = index2 + 1;
			if (isNaN(qty) || qty == null || qty == '') {
				qty = 0;
			}
			sumQty += parseFloat(qty);
			// console.log(sumQty);
		});
		if (typeof($('input[name=\'order_product[' + index2 + '][tc008]\']').val()) == 'undefined') {
			qty = 0;
		} else {
			qty = $('input[name=\'order_product[' + index2 + '][tc008]\']').val();
		}
		if (isNaN(qty) || qty == null || qty == '') {
			qty = 0;
		}
		sumQty += parseFloat(qty);
		$('#tb031').val(sumQty);
		// console.log(sumQty);
		//end 數量合計

		//總毛重合計 tb043
		$(".total_qty1").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index3 + '][tc030]\']').val())) {
				qty1 = 0;
			} else {
				qty1 = $('input[name=\'order_product[' + index3 + '][tc030]\']').val();
			}
			index3 = index3 + 1;
			if (isNaN(qty1) || qty1 == null || qty1 == '') {
				qty1 = 0;
			}
			sumQty1 += parseFloat(qty1);
			//  console.log(sumQty1);
		});
		if (typeof($('input[name=\'order_product[' + index3 + '][tc030]\']').val()) == 'undefined') {
			qty1 = 0;
		} else {
			qty1 = $('input[name=\'order_product[' + index3 + '][tc030]\']').val();
		}
		if (isNaN(qty1) || qty1 == null || qty1 == '') {
			qty1 = 0;
		}
		sumQty1 += parseFloat(qty1);
		$('#tb043').val(sumQty1);
		// console.log(sumQty1);
		//end 總毛重合計

		//總材積合計 tb044
		$(".total_qty2").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index4 + '][tc031]\']').val())) {
				qty2 = 0;
			} else {
				qty2 = $('input[name=\'order_product[' + index4 + '][tc031]\']').val();
			}
			index4 = index4 + 1;
			if (isNaN(qty2) || qty2 == null || qty2 == '') {
				qty2 = 0;
			}
			sumQty2 += parseFloat(qty2);
			//   console.log(sumQty2);
		});
		if (typeof($('input[name=\'order_product[' + index4 + '][tc031]\']').val()) == 'undefined') {
			qty2 = 0;
		} else {
			qty2 = $('input[name=\'order_product[' + index4 + '][tc031]\']').val();
		}
		if (isNaN(qty2) || qty2 == null || qty2 == '') {
			qty2 = 0;
		}
		sumQty2 += parseFloat(qty2);
		$('#tb044').val(sumQty2);
		// console.log(sumQty2);
		//end 總材積合計

	}
	//-->
</script>

<script>
	function del_detail(tc001, tc002, tc003, row) {
		if (confirm("確定刪除細項:" + tc001 + "-" + tc002 + "-" + tc003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/sfc/sfci03/del_detail_ajax",
					data: {
						tc001: tc001,
						tc002: tc002,
						tc003: tc003
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + tc001 + "-" + tc002 + "-" + tc003 + " 成功!" + msg);
						$("#product_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + tc001 + "-" + tc002 + "-" + tc003 + " 失敗!");
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
		// console.log("clear_row_in");
		// for (var k = 1; k <= 10; k++) { //k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		// 	// $('#product-row' + row + ' input.order_product_TE00' + k).val("");
		// 	// $('#product-row' + row + ' input.order_product_TE0' + k).val("");
		// 	// $('#product-row' + row + ' input.order_product_td' + k).val("");
		// 	$('#order_product\\[' + k + '\\]\\[TE005\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[TE005disp\\]').val("");
		// }
	}

	function tagscheck(a) {
		var lng = document.getElementsByTagName("tr").length;

		for (i = 0; i < lng; i++) {
			var temp = document.getElementsByTagName("tr")[i];
			if (a == temp) {
				//选中的标签样式
				temp.style.background = "#f3bf4d";

			} else {
				//恢复原状
				temp.style.background = "";
			}
		}

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
				$('#tb010').focus();
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
				$('input[name=\'order_product[1][tc004]\']').focus();
			}, 100);
		}
		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.altKey && (keycode == '40' || keycode == '45')) {
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

	function addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[tc005\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[tc006\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[tc010\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[tc007\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[tc007disp\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		// console.log(mb001);
		// console.log(current_count);
		$('#order_product\\[' + current_count + '\\]\\[tc004\\]').val(mb001);
		$('#order_product\\[' + current_count + '\\]\\[tc005\\]').val(mb002);
		$('#order_product\\[' + current_count + '\\]\\[tc006\\]').val(mb003);
		$('#order_product\\[' + current_count + '\\]\\[tc010\\]').val(mb004);
		$('#order_product\\[' + current_count + '\\]\\[tc007\\]').val(mb005);
		$('#order_product\\[' + current_count + '\\]\\[tc007disp\\]').val(mb006);
		addItem();
	}

	function clear_invi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	//查詢製令性質開視窗moci01
	//查詢製令性質開視窗moci01 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showmoci01disp").click(function() {
			// console.log('comein');
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '30%',
					overflow: 'hidden',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFmoci01'),
				onOverlayClick: clear_moci01disp_sql
			});
			$('.close').click($.unblockUI);
			// console.log('end');
		});
	});

	function search_sfci03a_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		// console.log(row);
		selected_row = row;
		$.blockUI({
			theme: true,
			message: $('#divFmoci01'),
			themedCSS: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '30%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
				'.ui-dialog .ui-dialog-content': '100%'
			},
			onOverlayClick: clear_moci01disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function clear_moci01disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql1"
		});
	}

	function addmoci01disp(MQ001, MQ002) {
		// alert(MQ002);
		// $('#mq001').val(MQ001);
		// $('#mq001_disp').text(MQ002);
		$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(MQ001);
		// $('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]').val(MQ002);
		$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').focus();

		if (!$('#mq002').val()) {
			$('#mq002').val(<?php echo date("Ymd") . '001'; ?>);
		}

		$('#mq002').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/printdetailc"
		});
	}


	//查詢製令製程視窗
	function search_sfci03_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);

		$('#moci01_disp').attr('src', "<?php echo base_url() ?>index.php/sfc/sfci03/display_child/0/0/" + te006 + "/" + te007 + "/");

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '80%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFsfci03'),
			onOverlayClick: clear_sfci03disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addsfci03disp(mb001, mb002, mb003, mb004, mb005, mb006, mb007, mb008, mb009) {
		// clear_row(selected_row);
		// console.log('reback---------');
		$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE008\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[TE018\\]').val(mb007);
		$('#order_product\\[' + selected_row + '\\]\\[TE019\\]').val(mb008);
		$('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb009);
		$('#order_product\\[' + selected_row + '\\]\\[TE029\\]').focus();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta"
		});
	}

	function clear_sfci03disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta"
		});
	}

	//直接輸入跳出 實際模穴數
	function check_sfci17(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE017\\]').val();
		var smb002 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		var smb003 = $('#order_product\\[' + row + '\\]\\[TE029\\]').val();

		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');

			return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
		}

		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/sfc/sfci17/lookup_body_check/' + encodeURIComponent(smb001) + "/" + encodeURIComponent(smb002) + "/" + encodeURIComponent(smb003) + "/",
				data: {
					mb001: smb001,
					mb002: smb002,
					mb003: smb003
				}
			})
			.done(function(msg) {
				// console.log('check_sfci17 output:' + msg);
				//回傳值顯示處理
				$('#order_product\\[' + row + '\\]\\[TE032\\]').val(msg);
				// return $('#order_product\\[' + row + '\\]\\[TE032\\]').focus();
			});
	}

	function check_sfcta(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE007\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE008\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE018\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE006\\]').focus();
		}

		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/moc/moci01/check_sfci_no/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TE006\\]').val('');
					return $('#order_product\\[' + row + '\\]\\[TE006\\]').focus();
				} else {
					return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
				}

			});
	}
	//---------------------------------------
	//查詢製程代號視窗
	function search_cmsi19_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		// te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		// te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}

		//查詢此ID是否存在 注塑使用
		if (document.getElementById('order_product[' + selected_row + '][TE032]')) {
			if ($('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val() == '') {
				alert('請先選擇產品品號!');
				return setTimeout(function() { //focus跳不回去時使用
					$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').focus();
				}, 100);
			}
		}


		$('#cmsi19_disp').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi19/display_child/0/0/" + $("#cmsi04").val());

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '80%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi19'),
			onOverlayClick: clear_cmsi19disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi19disp(mb001, mb002) {
		// clear_row(selected_row);
		// console.log('reback---------');
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE029\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql_term"
		});
	}

	function clear_cmsi19disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql_term"
		});
	}

	function check_cmsi19(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var smb001 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
		}

		var smb002 = $('#cmsi04').val();
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE009disp\\]'); //改變顏色用
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi19/check_cmsi04',
				data: {
					mb001: smb001,
					mb002: smb002,
				}
			})
			.done(function(msg) {
				// console.log('output_check_cmsi19:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('查無資料');
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE029\\]').focus();
				}

			});
	}
	//---------------------------------------
	//查詢品號類別開視窗invi02
	function search_invi02_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		// te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		// te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}

		$('#invi02_disp').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_childa/0/0/" + $("#cmsi04").val());

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '80%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFinvi02'),
			onOverlayClick: clear_invi02disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addinvi02adisp(mb001, mb002, mb003, mb004) {
		// clear_row(selected_row);
		// console.log('reback---------');
		// var paragraph = document.querySelector('#da001_disp');
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE018\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE018\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE019\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[TE030\\]').focus();

		//查詢此ID是否存在 注塑使用
		if (document.getElementById('order_product[' + selected_row + '][TE032]')) {
			if ($('#sfci01').val() == 'D504') {
				return setTimeout(function() { //focus跳不回去時使用
					$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').focus();
				}, 100);
			}
		}


		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function clear_invi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function check_invi02(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var smb001 = $('#order_product\\[' + row + '\\]\\[TE017\\]').val();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE018\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE017\\]').focus();
		}

		var smb002 = $('#cmsi04').val();
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE018\\]'); //改變顏色用
		$.ajax({
			method: "POST",
			url: '<?php echo base_url(); ?>index.php/inv/invi02/checkkey2',
			dataType: 'json',
			data: {
				mb001: smb001
			},
			success: function(data) {
				if (data.response) {
					paragraph.style.color = "black"; //改變顏色用
					// $('#cmsi05').val(sme001);
					// $('#cmsi05disp').text(data.message[0].value2);

					$('#order_product\\[' + row + '\\]\\[TE017\\]').val(data.MB001);
					$('#order_product\\[' + row + '\\]\\[TE018\\]').val(data.MB002);
					$('#order_product\\[' + row + '\\]\\[TE019\\]').val(data.MB003);
					$('#order_product\\[' + row + '\\]\\[TE020\\]').val(data.MB004);
					paragraph.style.color = "black"; //改變顏色用

					//查詢此ID是否存在 注塑使用
					if (document.getElementById('order_product[' + row + '][TE032]')) {
						if ($('#sfci01').val() == 'D504') {
							return setTimeout(function() { //focus跳不回去時使用
								$('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
							}, 100);
						}
					}

					return $('#order_product\\[' + row + '\\]\\[TE030\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE018\\]').val('查無品號');
					$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE017\\]').focus();
				}
			}
		});
		// .done(function(msg) {
		// 	// console.log('output_check_invi02:' + msg);
		// 	//回傳值顯示處理
		// 	if (msg == 'N') {
		// 		$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
		// 		$('#order_product\\[' + row + '\\]\\[TE018\\]').val('查無品號');
		// 		$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
		// 		$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
		// 		paragraph.style.color = "red"; //改變顏色用
		// 		return $('#order_product\\[' + row + '\\]\\[TE017\\]').focus();
		// 	} else {
		// 		// var str = (msg.split("_"));

		// 		$('#order_product\\[' + row + '\\]\\[TE017\\]').val(str[0]);
		// 		$('#order_product\\[' + row + '\\]\\[TE018\\]').val(str[1]);
		// 		$('#order_product\\[' + row + '\\]\\[TE019\\]').val(str[2]);
		// 		$('#order_product\\[' + row + '\\]\\[TE020\\]').val(str[3]);
		// 		paragraph.style.color = "black"; //改變顏色用
		// 		return $('#order_product\\[' + row + '\\]\\[TE030\\]').focus();
		// 	}

		// }
		// );
	}
	//---------------------------------------
	function count_pcs(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}
		var rb = $('#order_product\\[' + row + '\\]\\[TE028\\]').val();
		var bd = $('#order_product\\[' + row + '\\]\\[TE031\\]').val();
		var all = $('#order_product\\[' + row + '\\]\\[TE011\\]').val();

		$('#order_product\\[' + row + '\\]\\[TE0311\\]').val(parseInt(rb) + parseInt(bd));
		$('#order_product\\[' + row + '\\]\\[TE0312\\]').val(parseInt(all) - (parseInt(rb) + parseInt(bd)));

	}

	function count_moldca(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}
		var rm = $('#order_product\\[' + row + '\\]\\[TE032\\]').val(); //實際模穴數
		var ms = $('#order_product\\[' + row + '\\]\\[TE033\\]').val(); //起始模數
		var md = $('#order_product\\[' + row + '\\]\\[TE034\\]').val(); //結束模數

		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE0111\\]'); //改變顏色用
		paragraph.style.color = "red"; //改變顏色用

		if (!rm) { //實際模穴數			
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('實際模穴數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE032\\]').focus();
			}, 100);

		}
		if (!ms) { //起始模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('起始模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE033\\]').focus();
			}, 100);
		}
		if (!md) { //結束模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		}

		var moldca = parseInt(md) - parseInt(ms);

		if (moldca <= 0) {
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數小於起始模數');
			// $('input[name=order_product\\[' + row + '\\]\\[TE0111\\]]').val('結束模數小於起始模數');

			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		} else {
			paragraph.style.color = "black"; //改變顏色用
			var Qcount = parseInt(rm) * moldca;

			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val(moldca);
			$('#order_product\\[' + row + '\\]\\[TE0312\\]').val(Qcount);
		}

	}

	function Qcount(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}
		var rm = $('#order_product\\[' + row + '\\]\\[TE032\\]').val(); //實際模穴數
		var ms = $('#order_product\\[' + row + '\\]\\[TE033\\]').val(); //起始模數
		var md = $('#order_product\\[' + row + '\\]\\[TE034\\]').val(); //結束模數


		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE0111\\]'); //改變顏色用
		paragraph.style.color = "red"; //改變顏色用

		if (!rm) { //實際模穴數			
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('實際模穴數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE032\\]').focus();
			}, 100);

		}
		if (!ms) { //起始模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('起始模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE033\\]').focus();
			}, 100);
		}
		if (!md) { //結束模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		}


		var moldca = parseInt(md) - parseInt(ms);

		if (moldca <= 0) {
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數小於起始模數');
			// $('input[name=order_product\\[' + row + '\\]\\[TE0111\\]]').val('結束模數小於起始模數');

			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		} else {
			paragraph.style.color = "black"; //改變顏色用
			var Qcount = parseInt(rm) * moldca;

			// var badc = $('#order_product\\[' + row + '\\]\\[TE035\\]').val(); //不良總數
			// var canc = $('#order_product\\[' + row + '\\]\\[TE036\\]').val(); //可粉碎量
			// var waic = $('#order_product\\[' + row + '\\]\\[TE037\\]').val(); //待粉碎量
			// var notc = $('#order_product\\[' + row + '\\]\\[TE038\\]').val(); //不可粉碎

			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val(moldca); //模次數

			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE040\\]').focus();
			}, 100);


			// if (!badc) { //不良總數		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE035\\]').focus();
			// 	}, 100);
			// }
			// if (!canc) { //可粉碎量		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE036\\]').focus();
			// 	}, 100);
			// }
			// if (!waic) { //待粉碎量		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE037\\]').focus();
			// 	}, 100);

			// }
			// if (!notc) { //不可粉碎		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE038\\]').focus();
			// 	}, 100);
			// }

			// if (Qcount - badc <= 0) {
			// 	$('#order_product\\[' + row + '\\]\\[TE035\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE035\\]').focus();
			// 	}, 100);
			// } else if (Qcount - badc - waic <= 0) {
			// 	$('#order_product\\[' + row + '\\]\\[TE037\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE037\\]').focus();
			// 	}, 100);
			// } else if (Qcount - badc - waic - notc <= 0) {
			// 	$('#order_product\\[' + row + '\\]\\[TE038\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE038\\]').focus();
			// 	}, 100);
			// }

			// $('#order_product\\[' + row + '\\]\\[TE0312\\]').val(Qcount - badc - waic - notc);
		}

	}

	function sumQ(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}

		var ok = $('#order_product\\[' + row + '\\]\\[TE040\\]').val(); //合格數量
		var bad = $('#order_product\\[' + row + '\\]\\[TE035\\]').val(); //不良數量

		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE0333\\]'); //改變顏色用
		paragraph.style.color = "red"; //改變顏色用

		if (!ok) { //合格數量
			$('#order_product\\[' + row + '\\]\\[TE0333\\]').val('合格數量必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE040\\]').focus();
			}, 100);
		}
		if (!bad) { //不良數量
			$('#order_product\\[' + row + '\\]\\[TE0333\\]').val('不良數量必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE035\\]').focus();
			}, 100);
		}

		$('#order_product\\[' + row + '\\]\\[TE0333\\]').val(parseInt(ok) + parseInt(bad)); //生產數量
		paragraph.style.color = "black"; //改變顏色用

		return setTimeout(function() {
			$('#order_product\\[' + row + '\\]\\[TE036\\]').focus();
		}, 100);
	}




	function PrefixInteger(num, length) {
		return (Array(length).join('0') + num).slice(-length);
	}

	function count_time(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var count1 = 0; //第1段
		var count2 = 0; //第2段
		var count3 = 0; //第3段
		var resulst_sum;
		var resulst_sum1;
		var time_start1 = $('#order_product\\[' + row + '\\]\\[TE022\\]').val();
		var time_end1 = $('#order_product\\[' + row + '\\]\\[TE023\\]').val();
		var time_start2 = $('#order_product\\[' + row + '\\]\\[TE024\\]').val();
		var time_end2 = $('#order_product\\[' + row + '\\]\\[TE025\\]').val();
		var time_start3 = $('#order_product\\[' + row + '\\]\\[TE026\\]').val();
		var time_end3 = $('#order_product\\[' + row + '\\]\\[TE027\\]').val();
		var time_check = $('#order_product\\[' + row + '\\]\\[TE049\\]').val();
		count1 = time_abs(time_start1, time_end1);
		count2 = time_abs(time_start2, time_end2);
		count3 = time_abs(time_start3, time_end3);



		resulst_sum = timeDis(count1 + count2 + count3);
		if ($('#sfci01').val() == 'D404') {
			resulst_sum1 = resulst_sum;
		} else if (time_check == 2) {
			resulst_sum1 = timeDis(count1 + count2 + count3 - 30 * 60); //換30分鐘
		} else {
			resulst_sum1 = resulst_sum;
		}


		$('#order_product\\[' + row + '\\]\\[TE012\\]').val(resulst_sum);
		$('#order_product\\[' + row + '\\]\\[TE013\\]').val(resulst_sum1);
	}

	function time_abs(seq1, seq2) {
		var diff;
		if (seq1 >= seq2 || seq1 == "" || seq2 == "") {
			return 0;
		}

		// diff = timeSpan(PrefixInteger(seq2, 6)) - timeSpan(PrefixInteger(seq1, 6));
		diff = timeSpan(PrefixInteger(seq2, 4)) - timeSpan(PrefixInteger(seq1, 4));

		return diff;
	}

	function timeSpan(seq1) {
		// var resulst = parseInt(seq1.substring(0, 2) * 3600) + parseInt(seq1.substring(2, 4) * 60) + parseInt(seq1.substring(4, 6));
		var resulst = parseInt(seq1.substring(0, 2) * 3600) + parseInt(seq1.substring(2, 4) * 60);
		return resulst;
	}

	function timeDis(seq1) {
		var diff = seq1;
		var leftHours = Math.floor(diff / 3600);
		if (leftHours > 0) diff = diff - (leftHours * 3600);

		var leftMins = Math.floor(diff / 60);
		if (leftMins > 0) diff = diff - (leftMins * 60);

		var leftSecs = diff;

		// var resulst = PrefixInteger(leftHours, 2) + PrefixInteger(leftMins, 2) + PrefixInteger(leftSecs, 2);
		var resulst = PrefixInteger(leftHours, 2) + PrefixInteger(leftMins, 2);
		return resulst;
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

	//查詢機台視窗
	function search_cmsi03d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;
		// console.log($('#cmsi04').val());
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}
		$('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child/" + $("#cmsi04").val());
		$.blockUI({
			theme: true,
			themedCSS: {
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
		// clear_row(selected_row);
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE005\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]').val(mb002);

		var vsfc01 = $('#sfci01').val();
		if (vsfc01.length >= 2) {
			vsfc01 = vsfc01.substr(0, 2);
			if (vsfc01 == 'D5') {
				$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').focus();
			} else if (vsfc01 == 'D4') {
				$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').focus();
			}
		}
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql_gt"
		});
	}

	function clear_cmsi03disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql_gt"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_invi02d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[tc004\\]').val();
		if (!smb001) {
			// clear_row(row);
			return;
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
				if (data.response == "true") {
					$('#order_product\\[' + row + '\\]\\[tc004\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[tc005\\]').val(data.message[0].value2);
					$('#order_product\\[' + row + '\\]\\[tc006\\]').val(data.message[0].value3);
					$('#order_product\\[' + row + '\\]\\[tc010\\]').val(data.message[0].value4);
					$('#order_product\\[' + row + '\\]\\[tc007\\]').val(data.message[0].value5);
					$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(data.message[0].value6);
				} else {
					$('#order_product\\[' + row + '\\]\\[tc004\\]').val("查無資料");
				}
			}
		});
	}
	//機台
	function check_cmsi03d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE005\\]').val().trim();
		var smb002 = $('#cmsi04').val().trim();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE005\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE005disp\\]').val('');
			// clear_row(row);
			return;
		}
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE005disp\\]'); //改變顏色用
		// $.ajax({
		// 	url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb001),
		// 	cache: false,
		// 	dataType: 'json',
		// 	type: 'POST',
		// 	data: {
		// 		mb001: row_obj.value
		// 	},
		// 	success: function(data) {
		// 		if (data.response == "true") {
		// 			$('#order_product\\[' + row + '\\]\\[tc007\\]').val(data.message[0].value1);
		// 			$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(data.message[0].value2);
		// 		} else {
		// 			$('#order_product\\[' + row + '\\]\\[tc007\\]').val("查無資料");
		// 		}
		// 	}
		// });
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/',
				data: {
					mb001: row_obj.value,
					mb002: smb002
				}
			})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TE005\\]').val("");
					$('#order_product\\[' + row + '\\]\\[TE005disp\\]').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE005\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[TE005disp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用

					var vsfc01 = $('#sfci01').val();
					if (vsfc01.length >= 2) {
						vsfc01 = vsfc01.substr(0, 2);
						if (vsfc01 == 'D5') {
							return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
						} else if (vsfc01 == 'D4') {
							return $('#order_product\\[' + row + '\\]\\[TE006\\]').focus();
						}
					}


				}
			});
	}
</script>
<!--開視窗 品號品名    -->
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!--開視窗 製令製程    -->
<div id="divFsfci03" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="moci01_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/sfc/sfci03/display_child/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!--開視窗 機台    -->
<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child"+$("#cmsi04").val() allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>


<!--開視窗圖1客戶計價 copi02 有屬性不必下 src   -->
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain1" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- //查詢製令性質開視窗moci01 -->
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/moc/moci01/display_child1_moci01" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!-- //查詢製程代號開視窗cmsi19 -->
<div id="divFcmsi19" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="cmsi19_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi19/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- 查詢品號類別開視窗invi02 -->
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>