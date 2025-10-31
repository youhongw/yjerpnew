<script type="text/javascript">
	function chang_line() {
		var vsfc01 = $('#sfci01m').val();
		if (vsfc01.length >= 2) {
			vsfc01 = vsfc01.substr(0, 2);
			cleara();
			clearb();
			remove_row();

			if (vsfc01 == 'D1') {
				$('#TB004').val('3');
				$('#TB007').val('1');
			} else if (vsfc01 == 'D2') {
				$('#TB004').val('1');
				$('#TB007').val('1');
			} else if (vsfc01 == 'D3') {
				$('#TB004').val('1');
				$('#TB007').val('3');
			}
		}
	}

	function cleara() {
		$('#cmsi05').val('');
		$('#cmsi05disp').text('');
		$('#TB006').val('');
	}

	function clearb() {
		$('#cmsi05a').val('');
		$('#cmsi05adisp').text('');
		$('#TB009').val('');
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

	function clearitems() {
		for (var i = current_count; i >= 1; i--) {
			// console.log('移除_' + i + ":" + i);
			$('#order_product\\[' + i + '\\]\\[TC004\\]').val('');
			$('#order_product\\[' + i + '\\]\\[TC005\\]').val('');
		}

	}

	//檢查最新編號
	function check_title_no() {
		$('#TB002').val("");
		var sfci01m = $('#sfci01m').val();
		var TB015 = $('#TB015').val();
		//alert(sfci01);
		// console.log(sfci01m);
		// console.log(TB015);
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/sfc/sfci05/check_title_no",
				data: {
					sfci01m: sfci01m,
					TB015: TB015
				}
			})
			.done(function(msg) {
				$('#TB003').val(TB015);
				if ($('#sfci01mdisp').text() != "" && $('#sfci01mdisp').text() != "查無資料")
					$('#TB002').val(msg);
			});
	}


	//查詢品名規格開視窗 copi06 //下拉選單$('.close').click($.unblockUI);
	function set_catcomplete(row) {
		$('#order_product\\[' + row + '\\]\\[TC004\\]').catcomplete({
			autoFocus: false,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#order_product\\[' + row + '\\]\\[TC004\\]').val();
				$('#order_product\\[' + row + '\\]\\[tg004\\]').attr('onchange', '');
				// console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd_invi02/' + encodeURIComponent(smb001),
					cache: false,
					dataType: 'json',
					type: 'POST',
					data: req,
					success: function(data) {
						if (data.response == "true") {
							add(data.message);
						}
					}
				});
			},
			select: function(event, ui) {
				clear_row(row);
				// console.log(ui.item.value);
				if (ui.item.value != "查無資料") {
					$('#order_product\\[' + row + '\\]\\[TC004\\]').val(ui.item.value1);
					$('#order_product\\[' + row + '\\]\\[TC005\\]').val(ui.item.value2);
					$('#order_product\\[' + row + '\\]\\[TC006\\]').val(ui.item.value3);
					$('#order_product\\[' + row + '\\]\\[TC010\\]').val(ui.item.value4);
					$('#order_product\\[' + row + '\\]\\[TC007\\]').val(ui.item.value5);
					$('#order_product\\[' + row + '\\]\\[TC007disp\\]').val(ui.item.value6);
				}
				return false;
			},

			change: function(event, ui) {
				$('#order_product\\[' + row + '\\]\\[TC004\\]').attr('onchange', 'check_invi02d(this)');
				check_invi02d(row); //1060713 新增
				//check_invi02d($('#order_product\\['+row+'\\]\\[TC004\\]').val());
				return false;
			}
			//focus: function(event, ui) {
			//	return false;
			//}
		});

		//明細計算
		$('input[name=\'order_product[' + row + '][TC008]\'],input[name=\'order_product[' + row + '][TC011]\'],input[name=\'order_product[' + row + '][TC026]\'],input[name=\'order_product[' + row + '][TC030]\'],input[name=\'order_product[' + row + '][TC031]\']').focusout(function() {
			var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
			var input_1 = $('input[name=\'order_product[' + n + '][TC008]\']').val() * 1;
			var input_2 = $('input[name=\'order_product[' + n + '][TC011]\']').val() * 1;
			var input_3 = $('input[name=\'order_product[' + n + '][TC026]\']').val() / 100;
			var get_total = input_1 * input_2 * input_3;
			$('input[name=\'order_product[' + n + '][TC012]\']').val(get_total);
			//合計資料
			// totalSum();

		});
		//數量游標停在 0 之後 
		$('input[name=\'order_product[' + row + '][TC008]\']').focus(function() {
			var real_value = $(this)[0].defaultValue;
			if ($(this).val() == real_value)
				$(this).val(real_value);
			if ($(this).val() == '0')
				$(this).val('');
		});

		//單價  游標停在 0 之後
		$('input[name=\'order_product[' + row + '][TC011]\']').focus(function() {
			var real_value = $(this)[0].defaultValue;
			if ($(this).val() == real_value)
				$(this).val(real_value);
			if ($(this).val() == '0')
				$(this).val('');
		});
		//預設預交日期
		$('input[name=\'order_product[' + row + '][TC013]\']').focus(function() {
			var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth() + 1; //January is 0!
			var yyyy = today.getFullYear();
			if (dd < 10) {
				dd = '0' + dd
			}

			if (mm < 10) {
				mm = '0' + mm
			}

			today = yyyy + '/' + mm + '/' + dd;
			if ($('input[name=\'order_product[' + n + '][TC013]\']').val() == '') {
				$('input[name=\'order_product[' + n + '][TC013]\']').val(today);
			}
		});
		//單身品號圖1視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
		//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
		$('#order' + row).click(function() {
			var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
			selected_row = row;
			// console.log($('#copi01').val());
			if ($('#copi01').val() == '') {
				alert('請先選擇客戶代號!');
				return;
			}

			$('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cop/copi02/display_child/" + $("#copi01").val());
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '75%',
					overflow: 'auto',
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
	function addcopi02disp(me001, me002, me003, me004, me005, me006, me007) {
		clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[TC004\\]').val(me001); //品號
		$('#order_product\\[' + selected_row + '\\]\\[TC005\\]').val(me002); //品名
		$('#order_product\\[' + selected_row + '\\]\\[TC006\\]').val(me003); //規格
		$('#order_product\\[' + selected_row + '\\]\\[TC010\\]').val(me004); //單位
		$('#order_product\\[' + selected_row + '\\]\\[TC011\\]').val(me005); //單價
		$('#order_product\\[' + selected_row + '\\]\\[TC007\\]').val(me006); //庫別
		$('#order_product\\[' + selected_row + '\\]\\[TC007disp\\]').val(me007); //庫別名稱

		$('#order_product\\[' + selected_row + '\\]\\[TC004\\]').focus();
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
	function set_catcomplete2(row) {
		// console.log(row);
		$('#order_product\\[' + row + '\\]\\[TC007\\]').catcomplete({
			autoFocus: false,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb002 = $('#order_product\\[' + row + '\\]\\[TC007\\]').val();
				$('#order_product\\[' + row + '\\]\\[TC007\\]').attr('onchange', '');
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb002),
					cache: false,
					dataType: 'json',
					type: 'POST',
					data: req,
					success: function(data) {
						if (data.response == "true") {
							add(data.message);
						}
					}
				});
			},
			select: function(event, ui) {
				clear_row(row);
				if (ui.item.value != "查無資料") {
					$('#order_product\\[' + row + '\\]\\[TC007\\]').val(ui.item.value1);
					$('#order_product\\[' + row + '\\]\\[TC007disp\\]').val(ui.item.value2);
				}
				return false;
			},
			change: function(event, ui) {
				$('#cmsi03').attr('onchange', 'check_cmsi03d(this)');
				check_cmsi03d(row); //1060713 新增
				//check_cmsi03d($('#order_product\\['+row+'\\]\\[TC007\\]').val());
				return false;
			}
			//focus: function(event, ui) {
			//	return false;
			//}
		});
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
		//訂單金額 TB029
		$(".total_price").each(function(index, element) {
			price = $('input[name=\'order_product[' + index1 + '][TC012]\']').val();
			index1 = index1 + 1;
			if (isNaN(price)) {
				price = 0;
			}
			sumamt += parseFloat(price);
			//   console.log(sumamt);
		});
		if (typeof($('input[name=\'order_product[' + index1 + '][TC012]\']').val()) == 'undefined') {
			price = 0;
		} else {
			price = $('input[name=\'order_product[' + index1 + '][TC012]\']').val();
		}
		if (isNaN(price) || price == null || price == '') {
			price = 0;
		}
		sumamt += parseFloat(price);
		$('#TB029').val(sumamt);
		//  console.log(sumamt);
		//end 訂單金額合計

		//稅金 TB030
		tax = $('input[name=\'TB041\']').val();
		$('#TB030').val(Math.round(sumamt * tax));
		var sumTax = Math.round(sumamt * tax);
		var vtax = 1 + parseFloat(tax);
		//	if ($('select[name=\'TB016\']').val()=='1') {$('#TB029').val()=Math.round(sumamt/parseFloat(vtax));$('#TB030').val()=Math.round(sumamt-$('#TB029').val());}
		if ($('select[name=\'TB016\']').val() == '1') {
			$('#TB029').val(Math.round(sumamt / parseFloat(vtax)));
			temp1 = Math.round(sumamt - $('#TB029').val());
			$('#TB030').val(temp1);
		}
		var sumtot = Math.round(sumamt + sumTax);
		$('#TB029').val(sumamt);
		$('#TB030').val(sumTax);
		$('#tc2930').val(Math.round(sumtot)); //合計金額
		//  console.log(sumtot);
		//數量合計 TB031
		$(".total_qty").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index2 + '][TC008]\']').val())) {
				qty = 0;
			} else {
				qty = $('input[name=\'order_product[' + index2 + '][TC008]\']').val();
			}
			index2 = index2 + 1;
			if (isNaN(qty) || qty == null || qty == '') {
				qty = 0;
			}
			sumQty += parseFloat(qty);
			// console.log(sumQty);
		});
		if (typeof($('input[name=\'order_product[' + index2 + '][TC008]\']').val()) == 'undefined') {
			qty = 0;
		} else {
			qty = $('input[name=\'order_product[' + index2 + '][TC008]\']').val();
		}
		if (isNaN(qty) || qty == null || qty == '') {
			qty = 0;
		}
		sumQty += parseFloat(qty);
		$('#TB031').val(sumQty);
		// console.log(sumQty);
		//end 數量合計

		//總毛重合計 TB043
		$(".total_qty1").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index3 + '][TC030]\']').val())) {
				qty1 = 0;
			} else {
				qty1 = $('input[name=\'order_product[' + index3 + '][TC030]\']').val();
			}
			index3 = index3 + 1;
			if (isNaN(qty1) || qty1 == null || qty1 == '') {
				qty1 = 0;
			}
			sumQty1 += parseFloat(qty1);
			//  console.log(sumQty1);
		});
		if (typeof($('input[name=\'order_product[' + index3 + '][TC030]\']').val()) == 'undefined') {
			qty1 = 0;
		} else {
			qty1 = $('input[name=\'order_product[' + index3 + '][TC030]\']').val();
		}
		if (isNaN(qty1) || qty1 == null || qty1 == '') {
			qty1 = 0;
		}
		sumQty1 += parseFloat(qty1);
		$('#TB043').val(sumQty1);
		// console.log(sumQty1);
		//end 總毛重合計

		//總材積合計 TB044
		$(".total_qty2").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index4 + '][TC031]\']').val())) {
				qty2 = 0;
			} else {
				qty2 = $('input[name=\'order_product[' + index4 + '][TC031]\']').val();
			}
			index4 = index4 + 1;
			if (isNaN(qty2) || qty2 == null || qty2 == '') {
				qty2 = 0;
			}
			sumQty2 += parseFloat(qty2);
			//   console.log(sumQty2);
		});
		if (typeof($('input[name=\'order_product[' + index4 + '][TC031]\']').val()) == 'undefined') {
			qty2 = 0;
		} else {
			qty2 = $('input[name=\'order_product[' + index4 + '][TC031]\']').val();
		}
		if (isNaN(qty2) || qty2 == null || qty2 == '') {
			qty2 = 0;
		}
		sumQty2 += parseFloat(qty2);
		$('#TB044').val(sumQty2);
		// console.log(sumQty2);
		//end 總材積合計

	}
	//
	
</script>-->

<script>
	function del_detail(TC001, TC002, TC003, row, TC047) {
		if (confirm("確定刪除細項:" + TC001 + "-" + TC002 + "-" + TC003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/sfc/sfci05/del_detail_ajax",
					data: {
						TC001: TC001,
						TC002: TC002,
						TC003: TC003,
						TC047: TC047
					}
				})
				.done(function(msg) {
					if (msg) {
						//	alert( "刪除細項:"+TC001+"-"+TC002+"-"+TC003+" 成功!");
						$("#product_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + TC001 + "-" + TC002 + "-" + TC003 + " 失敗!");
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
		for (var k = 4; k <= 22; k++) { //k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
			$('#product-row' + row + ' input.order_product_TC00' + k).val("");
			$('#product-row' + row + ' input.order_product_TC0' + k).val("");
			$('#product-row' + row + ' input.order_product_td' + k).val("");
		}
		console.log("clear_row_in");
		for (var k = 1; k <= 10; k++) { //k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
			// $('#product-row' + row + ' input.order_product_TE00' + k).val("");
			// $('#product-row' + row + ' input.order_product_TE0' + k).val("");
			// $('#product-row' + row + ' input.order_product_td' + k).val("");
			$('#order_product\\[' + k + '\\]\\[TC005\\]').val("");
		}
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
				$('#TB010').focus();
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
				$('input[name=\'order_product[1][TC004]\']').focus();
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
	var outclick = '';
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
		clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[TC004\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TC005\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TC006\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[TC010\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[TC007\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[TC007disp\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[TC004\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		// console.log(mb001);
		// console.log(current_count);
		$('#order_product\\[' + current_count + '\\]\\[TC004\\]').val(mb001);
		$('#order_product\\[' + current_count + '\\]\\[TC005\\]').val(mb002);
		$('#order_product\\[' + current_count + '\\]\\[TC006\\]').val(mb003);
		$('#order_product\\[' + current_count + '\\]\\[TC010\\]').val(mb004);
		$('#order_product\\[' + current_count + '\\]\\[TC007\\]').val(mb005);
		$('#order_product\\[' + current_count + '\\]\\[TC007disp\\]').val(mb006);
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
		clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[TC007\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TC007disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TC007\\]').focus();
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
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_invi02d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[TC004\\]').val();
		if (!smb001) {
			clear_row(row);
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
					$('#order_product\\[' + row + '\\]\\[TC004\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[TC005\\]').val(data.message[0].value2);
					$('#order_product\\[' + row + '\\]\\[TC006\\]').val(data.message[0].value3);
					$('#order_product\\[' + row + '\\]\\[TC010\\]').val(data.message[0].value4);
					$('#order_product\\[' + row + '\\]\\[TC007\\]').val(data.message[0].value5);
					$('#order_product\\[' + row + '\\]\\[TC007disp\\]').val(data.message[0].value6);
				} else {
					$('#order_product\\[' + row + '\\]\\[TC004\\]').val("查無資料");
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
		var smb001 = $('#order_product\\[' + row + '\\]\\[TC007\\]').val();
		if (!smb001) {
			clear_row(row);
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				mb001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					$('#order_product\\[' + row + '\\]\\[TC007\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[TC007disp\\]').val(data.message[0].value2);
				} else {
					$('#order_product\\[' + row + '\\]\\[TC007\\]').val("查無資料");
				}
			}
		});
	}

	//製令單別 開窗
	function search_sfci03a_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		// 單別 sfci01m 是否有填
		if (!$('#sfci01m').val()) {
			var paragraph = document.querySelector('#sfci01mdisp'); //改變顏色用
			paragraph.style.color = "red"; //改變顏色用
			$('#sfci01mdisp').text('請輸入單別！');
			return $('#sfci01m').focus();
		}

		// 移出部門 cmsi05 是否有填
		if (!$('#cmsi05').val()) {
			var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
			paragraph.style.color = "red"; //改變顏色用
			$('#cmsi05disp').text('請輸入移出部門 ！');
			return $('#cmsi05').focus();
		}

		// 移入部門 cmsi05a 是否有填
		if (!$('#cmsi05a').val()) {
			var paragraph = document.querySelector('#cmsi05adisp'); //改變顏色用
			paragraph.style.color = "red"; //改變顏色用
			$('#cmsi05adisp').text('請輸入移入部門！');
			return $('#cmsi05a').focus();
		}
		var var_input = '';
		//選定 出入部門 以找出製令單別
		var dep = $('#sfci01m').val();
		if (dep) {
			if (dep.substr(0, 2) == 'D1') {
				$('#op_main').attr('src', "<?php echo base_url() ?>index.php/moc/moci01/display_childa/" + $('#cmsi05a').val());
			} else {
				$('#op_main').attr('src', "<?php echo base_url() ?>index.php/moc/moci01/display_childa/" + $('#cmsi05').val());
			}
		}

		// console.log(row);
		selected_row = row;
		$.blockUI({
			theme: true,
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
			},
			message: $('#divFmoci01'),
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

	function addmoci01disp(MQ001) {
		// alert(MQ001);
		// $('#mq001').val(MQ001);
		// $('#mq001_disp').text(MQ002);
		$('#order_product\\[' + selected_row + '\\]\\[TC004\\]').val(MQ001);
		// $('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]').val(MQ002);
		$('#order_product\\[' + selected_row + '\\]\\[TC005\\]').focus();



		// $('#mq002').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sqla"
		});
	}

	function check_sfcta(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		// 單別 sfci01m 是否有填
		if (!$('#sfci01m').val()) {
			var paragraph = document.querySelector('#sfci01mdisp'); //改變顏色用
			paragraph.style.color = "red"; //改變顏色用
			$('#sfci01mdisp').text('請輸入單別！');
			$('#order_product\\[' + row + '\\]\\[TC004\\]').val('');
			return $('#sfci01m').focus();
		}

		// 移出部門 cmsi05 是否有填
		if (!$('#cmsi05').val()) {
			var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
			paragraph.style.color = "red"; //改變顏色用
			$('#cmsi05disp').text('請輸入移出部門 ！');
			$('#order_product\\[' + row + '\\]\\[TC004\\]').val('');
			return $('#cmsi05').focus();
		}

		// 移入部門 cmsi05a 是否有填
		if (!$('#cmsi05a').val()) {
			var paragraph = document.querySelector('#cmsi05adisp'); //改變顏色用
			paragraph.style.color = "red"; //改變顏色用
			$('#cmsi05adisp').text('請輸入移入部門！');
			$('#order_product\\[' + row + '\\]\\[TC004\\]').val('');
			return $('#cmsi05a').focus();
		}
		var var_input = '';
		//選定 出入部門 以找出製令單別
		var dep = $('#sfci01m').val();
		var smb001 = $('#cmsi05').val();

		if (dep.substr(0, 2) == 'D1') {
			smb001 = $('#cmsi05a').val();
		}

		var smb002 = $('#order_product\\[' + row + '\\]\\[TC004\\]').val();
		if (!smb002) {
			$('#order_product\\[' + row + '\\]\\[TC005\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC047\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC048\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC049\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC010\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC006\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC007\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC007disp\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC007disp1\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC008\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC009\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC009disp\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TC009disp1\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TC004\\]').focus();
		}
		// console.log('smb001:' + smb001);
		// console.log('smb002:' + smb002);
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/moc/moci01/check_sfcb_no/' + encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002),
				data: {
					mb001: smb001,
					mb002: smb002
				}
			})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TC004\\]').val('');
					return $('#order_product\\[' + row + '\\]\\[TC004\\]').focus();
				} else {
					return $('#order_product\\[' + row + '\\]\\[TE005\\]').focus();
				}

			});
	}

	//查詢製令製程視窗
	function search_sfci03_window(row_obj, seq = '') {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		outclick = seq;
		// console.log(row);
		selected_row = row;

		TC004 = $('#order_product\\[' + selected_row + '\\]\\[TC004\\]').val();
		TC005 = $('#order_product\\[' + selected_row + '\\]\\[TC005\\]').val();
		if (TC004 == '') {
			return $('#order_product\\[' + row + '\\]\\[TC004\\]').focus();
		}

		sfci01m = $('#sfci01m').val();

		if (TC005 == '') {
			TC005 = 'a';
		}

		$('#moci01_disp').attr('src', "<?php echo base_url() ?>index.php/sfc/sfci03/display_childa/0/0/" + TC004 + "/" + TC005 + "/" + sfci01m);

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

	function addsfci03disp(mb001, mb002, mb003, mb004, mb005, mb006, mb007, mb008, mb009, mb010) {
		// clear_row(selected_row);
		// console.log('reback---------');

		$('#order_product\\[' + selected_row + '\\]\\[TC004\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TC005\\]').val(mb002);

		var dep = $('#sfci01m').val();

		if (dep.substr(0, 2) == 'D1') {
			$('#order_product\\[' + selected_row + '\\]\\[TC008\\]').val(mb003);
			$('#order_product\\[' + selected_row + '\\]\\[TC009\\]').val(mb004);
			$('#order_product\\[' + selected_row + '\\]\\[TC009disp\\]').val(mb005);
		} else if (dep.substr(0, 2) == 'D2' && outclick != '') {
			$('#order_product\\[' + selected_row + '\\]\\[TC008\\]').val(mb003);
			$('#order_product\\[' + selected_row + '\\]\\[TC009\\]').val(mb004);
			$('#order_product\\[' + selected_row + '\\]\\[TC009disp\\]').val(mb005);
		} else {
			$('#order_product\\[' + selected_row + '\\]\\[TC006\\]').val(mb003);
			$('#order_product\\[' + selected_row + '\\]\\[TC007\\]').val(mb004);
			$('#order_product\\[' + selected_row + '\\]\\[TC007disp\\]').val(mb005);
		}

		$('#order_product\\[' + selected_row + '\\]\\[TC047\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[TC048\\]').val(mb007);
		$('#order_product\\[' + selected_row + '\\]\\[TC049\\]').val(mb008);
		$('#order_product\\[' + selected_row + '\\]\\[TC010\\]').val(mb009);
		if (dep.substr(0, 2) == 'D1') {
			$('#order_product\\[' + selected_row + '\\]\\[TC036\\]').focus();
		} else if (dep.substr(0, 2) == 'D2' && outclick != '') {
			$('#order_product\\[' + selected_row + '\\]\\[TC036\\]').focus();
		} else if (dep.substr(0, 2) == 'D2') {
			$('#order_product\\[' + selected_row + '\\]\\[TC008\\]').val('');
			$('#order_product\\[' + selected_row + '\\]\\[TC009\\]').val('');
			$('#order_product\\[' + selected_row + '\\]\\[TC009disp\\]').val('');
			$('#order_product\\[' + selected_row + '\\]\\[TC008\\]').focus();
		} else {
			$('#order_product\\[' + selected_row + '\\]\\[TC036\\]').focus();
		}
		if (!(dep.substr(0, 2) == 'D2' && outclick != '')) {
			if (mb010 <= 0) {
				$('#order_product\\[' + selected_row + '\\]\\[TC036\\]').val('0');
				$('#order_product\\[' + selected_row + '\\]\\[TC014\\]').val('0');
			} else {
				$('#order_product\\[' + selected_row + '\\]\\[TC036\\]').val(mb010);
				$('#order_product\\[' + selected_row + '\\]\\[TC014\\]').val(mb010);
			}
		}

		$('#order_product\\[' + selected_row + '\\]\\[TC038\\]').val(getTodayDate());


		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta"
		});
	}

	function getTodayDate() {
		var fullDate = new Date();
		var yyyy = fullDate.getFullYear();
		var MM = (fullDate.getMonth() + 1) >= 10 ? (fullDate.getMonth() + 1) : ("0" + (fullDate.getMonth() + 1));
		var dd = fullDate.getDate() < 10 ? ("0" + fullDate.getDate()) : fullDate.getDate();
		var today = yyyy + "/" + MM + "/" + dd;
		return today;
	}

	function clear_sfci03disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta"
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

	function count_pre(var_seq, var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}

		var TC036 = parseInt($('#order_product\\[' + row + '\\]\\[TC036\\]').val());
		var TC014 = parseInt($('#order_product\\[' + row + '\\]\\[TC014\\]').val());
		var TC016 = parseInt($('#order_product\\[' + row + '\\]\\[TC016\\]').val());
		var TC037 = parseInt($('#order_product\\[' + row + '\\]\\[TC037\\]').val());

		if (var_seq === 1) {
			$('#order_product\\[' + row + '\\]\\[TC014\\]').val(TC036);
			$('#order_product\\[' + row + '\\]\\[TC016\\]').val('0');
			$('#order_product\\[' + row + '\\]\\[TC037\\]').val('0');
		} else if (var_seq === 2) {
			if (TC014 >= TC036) {
				$('#order_product\\[' + row + '\\]\\[TC014\\]').val(TC036);
				$('#order_product\\[' + row + '\\]\\[TC016\\]').val('0');
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val('0');
			} else if ((TC016 + TC014) >= TC036) {
				TC014 = TC036 - TC016;
				$('#order_product\\[' + row + '\\]\\[TC014\\]').val(TC014);
				TC037 = TC036 - TC014 - TC016;
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val(TC037);
			} else {
				TC037 = TC036 - TC014 - TC016;
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val(TC037);
			}
		} else if (var_seq === 3) {
			if (TC016 >= TC036) {
				$('#order_product\\[' + row + '\\]\\[TC014\\]').val('0');
				$('#order_product\\[' + row + '\\]\\[TC016\\]').val(TC036);
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val('0');
			} else if ((TC016 + TC014) >= TC036) {
				TC016 = TC036 - TC014;
				$('#order_product\\[' + row + '\\]\\[TC016\\]').val(TC016);
				TC037 = TC036 - TC014 - TC016;
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val(TC037);
			} else {
				TC037 = TC036 - TC014 - TC016;
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val(TC037);
			}
		} else if (var_seq === 4) {
			if (TC037 >= TC036) {
				$('#order_product\\[' + row + '\\]\\[TC014\\]').val('0');
				$('#order_product\\[' + row + '\\]\\[TC016\\]').val('0');
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val(TC036);
			} else {
				TC037 = TC036 - TC014 - TC016;
				$('#order_product\\[' + row + '\\]\\[TC037\\]').val(TC037);
			}
		}

	}
</script>
<!--開視窗 品號品名    -->
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!--開視窗 庫別    -->
<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!--開視窗圖1客戶計價 copi02 有屬性不必下 src   -->
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- //查詢製令性質開視窗moci01 -->
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="op_main" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/moc/moci01/display_child1_moci01" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!--開視窗 製令製程    -->
<div id="divFsfci03" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="moci01_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/sfc/sfci03/display_child/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- ----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- ----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- ----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- ----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- ----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<script type="text/javascript">
	//查詢部門開視窗cmsi05  //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi05disp").click(function() {

			var sTB004 = $('#TB004').val();
			// console.log('sTB004:' + sTB004);
			if (sTB004 == '1') {
				$('#hp_ifmain_1').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi04/display_child/");

			} else if (sTB004 == '2') {
				$('#hp_ifmain_2').attr('src', "<?php echo base_url() ?>index.php/pur/puri14/display_child/");
			} else {
				$('#hp_ifmain_3').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi03/display_childa/");
			}


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
				message: $('#divFcmsi05_' + sTB004),
				onOverlayClick: clear_cmsi05disp_sql
			});
			$('.close').click($.unblockUI);
		});

	});

	function addcmsi05disp(sme001, sme002) {
		//alert('test2');

		$('#cmsi05').val(sme001);
		$('#cmsi05disp').text(sme002);
		$('#TB006').val(sme002); //sfci05
		$('#cmsi05').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql"
		});
	}

	function addcmsi04disp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// alert('addcmsi04disp');
		$('#cmsi05').val(sme001);
		$('#cmsi05disp').text(sme002);
		$('#TB006').val(sme002); //sfci05
		$('#cmsi05a').focus();
		// clearitems();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
		});
	}

	function addcmsi03disp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// alert('addcmsi03disp:' + sme001 + ":" + sme002);
		$('#cmsi05').val(sme001);
		$('#cmsi05disp').text(sme002);
		$('#TB006').val(sme002); //sfci05
		$('#cmsi05a').focus();
		// clearitems();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
		});
	}

	function addpuri14disp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// alert('addpuri14disp:' + sme001 + ":" + sme002);
		$('#cmsi05').val(sme001);
		$('#cmsi05disp').text(sme002);
		$('#TB006').val(sme002); //sfci05
		$('#cmsi05a').focus();
		clearitems();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/pur/puri14/clear_sql"
		});
	}

	function clear_cmsi05disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_cmsi05(row_obj) {
		var sme001 = $('#cmsi05').val();
		if (!sme001) {
			$('#cmsi05disp').text("");
			return;
		}

		var sTB004 = $('#TB004').val();
		// console.log('sTB004:' + sTB004);
		var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
		if (sTB004 == '1') {
			$.ajax({
					method: "POST",
					url: '<?php echo base_url(); ?>index.php/cms/cmsi04/check_key/' + encodeURIComponent(sme001),
					data: {
						mb001: sme001,
					}
				})
				.done(function(msg) {
					// console.log(msg);
					//回傳值顯示處理
					if (msg == 'N') {
						$('#cmsi05disp').text('找不到生產線別');
						paragraph.style.color = "red"; //改變顏色用
						$('#cmsi05').val('');
						$('#TB006').val('');
						return $('#cmsi05').focus();
					} else {
						$('#cmsi05disp').text(msg);
						$('#TB006').val(msg);
						paragraph.style.color = "black"; //改變顏色用
						return $('#cmsi05a').focus();
					}

				});

		} else if (sTB004 == '2') {
			$.ajax({
					method: "POST",
					url: '<?php echo base_url(); ?>index.php/pur/puri14/check_key/' + encodeURIComponent(sme001),
					data: {
						mb001: sme001,
					}
				})
				.done(function(msg) {
					// console.log(msg);
					//回傳值顯示處理
					if (msg == 'N') {
						$('#cmsi05disp').text('找不到廠商');
						paragraph.style.color = "red"; //改變顏色用
						$('#cmsi05').val('');
						$('#TB006').val('');
						return $('#cmsi05').focus();
					} else {
						$('#cmsi05disp').text(msg);
						$('#TB006').val(msg);
						paragraph.style.color = "black"; //改變顏色用
						return $('#cmsi05a').focus();
					}

				});
		} else if (sTB004 == '3') {

			$.ajax({
					method: "POST",
					url: '<?php echo base_url(); ?>index.php/cms/cmsi03/check_key/' + encodeURIComponent(sme001),
					data: {
						mb001: sme001,
					}
				})
				.done(function(msg) {
					// console.log(msg);
					//回傳值顯示處理
					if (msg == 'N') {
						$('#cmsi05disp').text('找不到庫別');
						paragraph.style.color = "red"; //改變顏色用
						$('#cmsi05').val('');
						$('#TB006').val('');
						return $('#cmsi05').focus();
					} else {
						$('#cmsi05disp').text(msg);
						$('#TB006').val(msg);
						paragraph.style.color = "black"; //改變顏色用
						return $('#cmsi05a').focus();
					}

				});

		}


	}
</script>
<div id="divFcmsi05_1" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain_1" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>

	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<div id="divFcmsi05_2" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain_2" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>

	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<div id="divFcmsi05_3" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain_3" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>

	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<script type="text/javascript">
	//查詢部門開視窗cmsi05  a //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi05adisp").click(function() {

			var sTB007 = $('#TB007').val();
			// console.log('sTB007:' + sTB007);
			if (sTB007 == '1') {
				$('#hp_ifmain_a1').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi04/display_child1/");

			} else if (sTB007 == '2') {
				$('#hp_ifmain_a2').attr('src', "<?php echo base_url() ?>index.php/pur/puri14/display_child1/");
			} else {
				$('#hp_ifmain_a3').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi03/display_child1/");
			}


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
				message: $('#divFcmsi05a_' + sTB007),
				onOverlayClick: clear_cmsi05disp_sql
			});
			$('.close').click($.unblockUI);
		});

	});

	function addcmsi05adisp(sme001, sme002) {

		//alert('test2');
		$('#cmsi05a').val(sme001);
		$('#cmsi05adisp').text(sme002);
		$('#TB009').val(sme002); //sfci05
		$('#cmsi05a').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql1"
		});
	}

	function addcmsi04adisp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05adisp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// alert('addcmsi04disp');
		$('#cmsi05a').val(sme001);
		$('#cmsi05adisp').text(sme002);
		$('#TB009').val(sme002); //sfci05
		$('#verify').focus();
		clearitems();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql1"
		});
	}

	function addcmsi03adisp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05adisp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// alert('addcmsi03disp:' + sme001 + ":" + sme002);
		$('#cmsi05a').val(sme001);
		$('#cmsi05adisp').text(sme002);
		$('#TB009').val(sme002); //sfci05
		$('#verify').focus();
		clearitems();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql1"
		});
	}

	function addpuri14adisp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05adisp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		// alert('addpuri14adisp:' + sme001 + ":" + sme002);
		$('#cmsi05a').val(sme001);
		$('#cmsi05adisp').text(sme002);
		$('#TB009').val(sme002); //sfci05
		$('#verify').focus();
		clearitems();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/pur/puri14/clear_sql1"
		});
	}

	function clear_cmsi05disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql1"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_cmsi05a(row_obj) {
		var sme001 = $('#cmsi05a').val();
		if (!sme001) {
			$('#cmsi05adisp').text("");
			return;
		}
		var sTB007 = $('#TB007').val();
		var paragraph = document.querySelector('#cmsi05adisp'); //改變顏色用

		if (sTB007 == '1') {
			$.ajax({
					method: "POST",
					url: '<?php echo base_url(); ?>index.php/cms/cmsi04/check_key/' + encodeURIComponent(sme001),
					data: {
						mb001: sme001,
					}
				})
				.done(function(msg) {
					// console.log('sTB007_1:' + msg);
					//回傳值顯示處理
					if (msg == 'N') {
						$('#cmsi05adisp').text('找不到生產線別');
						paragraph.style.color = "red"; //改變顏色用
						$('#cmsi05a').val('');
						$('#TB009').val('');
						return $('#cmsi05a').focus();
					} else {
						$('#cmsi05adisp').text(msg);
						$('#TB009').val(msg);
						paragraph.style.color = "black"; //改變顏色用
						return $('#verify').focus();
					}

				});

		} else if (sTB007 == '2') {
			$.ajax({
					method: "POST",
					url: '<?php echo base_url(); ?>index.php/pur/puri14/check_key/' + encodeURIComponent(sme001),
					data: {
						mb001: sme001,
					}
				})
				.done(function(msg) {
					// console.log('sTB007_2:' + msg);
					//回傳值顯示處理
					if (msg == 'N') {
						$('#cmsi05adisp').text('找不到廠商');
						paragraph.style.color = "red"; //改變顏色用
						$('#cmsi05a').val('');
						$('#TB009').val('');
						return $('#cmsi05a').focus();
					} else {
						$('#cmsi05adisp').text(msg);
						$('#TB009').val(msg);
						paragraph.style.color = "black"; //改變顏色用
						return $('#verify').focus();
					}

				});
		} else if (sTB007 == '3') {
			$.ajax({
					method: "POST",
					url: '<?php echo base_url(); ?>index.php/cms/cmsi03/check_key/' + encodeURIComponent(sme001),
					data: {
						mb001: sme001,
					}
				})
				.done(function(msg) {
					// console.log('sTB007_3:' + msg);
					//回傳值顯示處理
					if (msg == 'N') {
						$('#cmsi05adisp').text('找不到庫別');
						paragraph.style.color = "red"; //改變顏色用
						$('#cmsi05a').val('');
						$('#TB009').val('');
						return $('#cmsi05a').focus();
					} else {
						$('#cmsi05adisp').text(msg);
						$('#TB009').val(msg);
						paragraph.style.color = "black"; //改變顏色用
						return $('#verify').focus();
					}

				});
		}



	}
</script>
<div id="divFcmsi05a_1" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain_a1" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<div id="divFcmsi05a_2" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain_a2" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<div id="divFcmsi05a_3" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain_a3" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- end----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- end----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- end----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- end----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->
<!-- end----------------------------開視窗  移出入類別 控制 移出入部門--------------------------------------- -->