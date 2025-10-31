<!-- 不更新網頁  -->
<script type="text/javascript">
	//檢查資料重複
	function check_key(oInput) {
		var mc001 = $('#invi02').val();
		var paragraph = document.querySelector('#invi02disp'); //改變顏色用

		if (!oInput.value) {
			paragraph.style.color = "red"; //改變顏色用
			$("#invi02disp").text("不可空白.");
			$('#mc001disp1').val('');
			$('#mc002').val('');
			return $('#invi02').focus();
		}


		// console.log(mc001);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/bom/bomi02b/check_key",
			dataType: 'json',
			data: {
				mc001: mc001
			},
			success: function(data) {
				if (data.response) {
					paragraph.style.color = "black"; //改變顏色用
					// $('#cmsi05').val(sme001);
					// $('#cmsi05disp').text(data.message[0].value2);
					$("#invi02disp").text(data.mc001disp);
					$('#mc001disp').val(data.mc001disp);
					$('#mc001disp1').val(data.mc001disp1);
					$('#mc002').val(data.mc002);
					paragraph.style.color = "black"; //改變顏色用
					return $('#mc002').focus();
				} else {
					// console.log('keydisp:' + data.mc001disp);
					$("#invi02disp").text(data.mc001disp);
					$('#mc001disp').val('');
					$('#mc001disp1').val('');
					$('#mc002').val('');
					paragraph.style.color = "red"; //改變顏色用
					return $('#invi02').focus();
				}
			}
		});
	}
</script>
<script type="text/javascript">
	//檢查最新編號
	function check_title_no() {
		//$('#mc002').val("");
		var invi02 = $('#invi02').val();
		//alert(invi02);
		console.log('test');
		console.log(invi02);
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/bom/bomi02b/check_title_no",
				data: {
					invi02: invi02
				}
			})
			.done(function(msg) {
				//if($('#invi02disp').text()!=""&&$('#invi02disp').text()!="查無資料")
				// console.log(msg);
				//  console.log($('#mc001disp').val(msg));
				$('#mc001disp').val(msg);
			});
	}

	//查詢品名規格開視窗 copi05 //下拉選單$('.close').click($.unblockUI);
	function set_catcomplete(row) {
		$('#order_product\\[' + row + '\\]\\[md003\\]').catcomplete({
			autoFocus: false,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#order_product\\[' + row + '\\]\\[md003\\]').val();
				$('#order_product\\[' + row + '\\]\\[md003\\]').attr('onchange', '');
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
				console.log(ui.item.value);
				//品號,品名,規格,單位,單價,庫別,庫別名稱
				if (ui.item.value != "查無資料") {
					$('#order_product\\[' + row + '\\]\\[md003\\]').val(ui.item.value1);
					$('#order_product\\[' + row + '\\]\\[md003disp\\]').val(ui.item.value2);
					$('#order_product\\[' + row + '\\]\\[md003disp1\\]').val(ui.item.value3);
					$('#order_product\\[' + row + '\\]\\[md004\\]').val(ui.item.value4);
					//$('#order_product\\['+row+'\\]\\[md007\\]').val(ui.item.value5);
					//$('#order_product\\['+row+'\\]\\[md007disp\\]').val(ui.item.value6);
				}
				return false;
			},

			change: function(event, ui) {
				$('#order_product\\[' + row + '\\]\\[md003\\]').attr('onchange', 'check_invi02d(this)');
				check_invi02d(row); //1060713 新增
				check_invi02d($('#order_product\\[' + row + '\\]\\[md003\\]').val());
				return false;
			}
			//focus: function(event, ui) {
			//	return false;
			//}
		});

		//明細計算 8改7數量, 11改9 單價, 折扣率26 改1 , 金額12改10
		$('input[name=\'order_product[' + row + '][md006]\'],input[name=\'order_product[' + row + '][md007]\'],input[name=\'order_product[' + row + '][md011]\']').focusout(function() {
			var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
			var input_1 = $('input[name=\'order_product[' + n + '][md006]\']').val() * 1;
			//  var input_3=$('input[name=\'order_product[' + n + '][md026]\']').val()/100; 
			var input_3 = 1;
			var get_total = input_1;
			$('input[name=\'order_product[' + n + '][md006]\']').val(get_total);
			//合計資料
			//totalSum();		

		});

		//組成用量  游標停在 0 之後
		$('input[name=\'order_product[' + row + '][md006]\']').focus(function() {
			var real_value = $(this)[0].defaultValue;
			if ($(this).val() == real_value)
				$(this).val(real_value);
			if ($(this).val() == '0')
				$(this).val('');
		});
		//底數  游標停在 0 之後
		$('input[name=\'order_product[' + row + '][md007]\']').focus(function() {
			var real_value = $(this)[0].defaultValue;
			if ($(this).val() == real_value)
				$(this).val(real_value);
			if ($(this).val() == '0')
				$(this).val('');
		});
		//預設預交日期13 改16生效日期
		$('input[name=\'order_product[' + row + '][md011]\']').focus(function() {
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
			if ($('input[name=\'order_product[' + n + '][md011]\']').val() == '') {
				$('input[name=\'order_product[' + n + '][md011]\']').val(today);
			}
		});
		//單身品號圖1視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
		//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
		$('#order' + row).click(function() {
			var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
			selected_row = row;
			console.log($('#puri01').val());
			if ($('#puri01').val() == '') {
				alert('請先選擇客戶代號!');
				return;
			}

			$('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cop/copi02/display_child/" + $("#puri01").val());
			$.blockUI({
				css: {
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
		//單身品號圖2視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
		//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
		$('#ordera' + row).click(function() {
			var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
			selected_row = row;
			console.log($('#puri01').val());

			$('#hpa_ifmain').attr('src', "<?php echo base_url() ?>index.php/bom/bomi02b/edit_child/" + $("#puri01").val());
			$.blockUI({
				css: {
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
				message: $('#divFcopi02a'),
				onOverlayClick: clear_copi02disp_sql
			});
			$('.close').click($.unblockUI);
		});
	}
	//匯入明細圖2 
	function import_copi05(mz001, mz002, mz003, mz004) {
		console.log('mz001');
		console.log(mz001);
		$.ajax({
				method: "POST",
				dataType: "json",
				url: "<?php echo base_url() ?>index.php/bom/bomi02b/import_bomi02b",
				data: {
					mz001: mz001,
					mz002: mz002,
					mz003: mz003,
					mz004: mz004
				}
			})
			.done(function(msg) {
				if (msg == 0) {
					alert("無資料可匯入!");
				} else {
					console.log(msg);
					//if(confirm("共計"+msg.length+"筆，是否匯入?")){
					for (var key in msg) {
						var val = msg[key];
						//addItem();
						$('#order_product\\[' + current_count + '\\]\\[md003\\]').val(val['md003']);
						$('#order_product\\[' + current_count + '\\]\\[md003disp\\]').val(val['mb002']);
						$('#order_product\\[' + current_count + '\\]\\[md003disp1\\]').val(val['mb003']);
						$('#order_product\\[' + current_count + '\\]\\[md004\\]').val(val['md004']);
						//$('#order_product\\['+current_count+'\\]\\[md007\\]').val(val['md006']*mz002);
						addItem();
					}

					//}
				}

			});
	}
	//開圖1視窗(客戶單價計價檔copi02)回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
	function addcopi02disp(me001, me002, me003, me004, me005, me006, me007) {
		clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[md003\\]').val(me001); //品號
		$('#order_product\\[' + selected_row + '\\]\\[md003disp\\]').val(me002); //品名
		$('#order_product\\[' + selected_row + '\\]\\[md003disp1\\]').val(me003); //規格
		$('#order_product\\[' + selected_row + '\\]\\[md004\\]').val(me004); //單位
		//	$('#order_product\\['+selected_row+'\\]\\[md009\\]').val(me005); //單價
		//	$('#order_product\\['+selected_row+'\\]\\[md007\\]').val(me006); //庫別
		//	$('#order_product\\['+selected_row+'\\]\\[md007disp\\]').val(me007); //庫別名稱

		$('#order_product\\[' + selected_row + '\\]\\[md004\\]').focus();
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
	//查詢庫別下拉選單 set_catcomplete2 暫modi 222
	function set_catcomplete2(row) {}

	function set_catcomplete222(row) {
		console.log(row);
		$('#order_product\\[' + row + '\\]\\[md007\\]').catcomplete({
			autoFocus: false,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb002 = $('#order_product\\[' + row + '\\]\\[md007\\]').val();
				$('#order_product\\[' + row + '\\]\\[md007\\]').attr('onchange', '');
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
					$('#order_product\\[' + row + '\\]\\[md007\\]').val(ui.item.value1);
					$('#order_product\\[' + row + '\\]\\[md007disp\\]').val(ui.item.value2);
				}
				return false;
			},
			change: function(event, ui) {
				$('#cmsi03').attr('onchange', 'check_cmsi03d(this)');
				check_cmsi03d(row); //1060713 新增
				//check_cmsi03d($('#order_product\\['+row+'\\]\\[md007\\]').val());
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
		//訂單金額 mc029 modi mc009
		$(".total_price").each(function(index, element) {
			price = $('input[name=\'order_product[' + index1 + '][md010]\']').val();
			index1 = index1 + 1;
			if (isNaN(price)) {
				price = 0;
			}
			sumamt += parseFloat(price);
			//   console.log(sumamt);
		});
		if (typeof($('input[name=\'order_product[' + index1 + '][md010]\']').val()) == 'undefined') {
			price = 0;
		} else {
			price = $('input[name=\'order_product[' + index1 + '][md010]\']').val();
		}
		if (isNaN(price) || price == null || price == '') {
			price = 0;
		}
		sumamt += parseFloat(price);
		$('#mc009').val(sumamt);
		//  console.log(sumamt);
		//end 訂單金額合計

		//稅金 mc030 modi mc023  41稅率modi 24  課稅別16 modi 22
		tax = $('input[name=\'mc024\']').val();
		$('#mc023').val(Math.round(sumamt * tax));
		var sumTax = Math.round(sumamt * tax);
		var vtax = 1 + parseFloat(tax);
		//	if ($('select[name=\'mc016\']').val()=='1') {$('#mc029').val()=Math.round(sumamt/parseFloat(vtax));$('#mc030').val()=Math.round(sumamt-$('#mc029').val());}
		if ($('select[name=\'mc022\']').val() == '1') {
			$('#mc009').val(Math.round(sumamt / parseFloat(vtax)));
			temp1 = Math.round(sumamt - $('#mc009').val());
			$('#mc023').val(temp1);
		}
		var sumtot = Math.round(sumamt + sumTax);
		$('#mc009').val(sumamt);
		$('#mc023').val(sumTax);
		$('#mc0923').val(Math.round(sumtot)); //合計金額
		//  console.log(sumtot);
		//數量合計 mc031 modi 25   數量8modi 7
		$(".total_qty").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index2 + '][md007]\']').val())) {
				qty = 0;
			} else {
				qty = $('input[name=\'order_product[' + index2 + '][md007]\']').val();
			}
			index2 = index2 + 1;
			if (isNaN(qty) || qty == null || qty == '') {
				qty = 0;
			}
			sumQty += parseFloat(qty);
			console.log(sumQty);
		});
		if (typeof($('input[name=\'order_product[' + index2 + '][md007]\']').val()) == 'undefined') {
			qty = 0;
		} else {
			qty = $('input[name=\'order_product[' + index2 + '][md007]\']').val();
		}
		if (isNaN(qty) || qty == null || qty == '') {
			qty = 0;
		}
		sumQty += parseFloat(qty);
		$('#mc025').val(sumQty);
		console.log(sumQty);
		//end 數量合計

		//總毛重合計 mc043 modi 27 毛重30 modi 20
		$(".total_qty1").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index3 + '][md020]\']').val())) {
				qty1 = 0;
			} else {
				qty1 = $('input[name=\'order_product[' + index3 + '][md020]\']').val();
			}
			index3 = index3 + 1;
			if (isNaN(qty1) || qty1 == null || qty1 == '') {
				qty1 = 0;
			}
			sumQty1 += parseFloat(qty1);
			//  console.log(sumQty1);
		});
		if (typeof($('input[name=\'order_product[' + index3 + '][md020]\']').val()) == 'undefined') {
			qty1 = 0;
		} else {
			qty1 = $('input[name=\'order_product[' + index3 + '][md020]\']').val();
		}
		if (isNaN(qty1) || qty1 == null || qty1 == '') {
			qty1 = 0;
		}
		sumQty1 += parseFloat(qty1);
		$('#mc027').val(sumQty1);
		// console.log(sumQty1);
		//end 總毛重合計

		//總材積合計 mc044 modi 28 31 modi 21
		$(".total_qty2").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index4 + '][md021]\']').val())) {
				qty2 = 0;
			} else {
				qty2 = $('input[name=\'order_product[' + index4 + '][md021]\']').val();
			}
			index4 = index4 + 1;
			if (isNaN(qty2) || qty2 == null || qty2 == '') {
				qty2 = 0;
			}
			sumQty2 += parseFloat(qty2);
			//   console.log(sumQty2);
		});
		if (typeof($('input[name=\'order_product[' + index4 + '][md021]\']').val()) == 'undefined') {
			qty2 = 0;
		} else {
			qty2 = $('input[name=\'order_product[' + index4 + '][md021]\']').val();
		}
		if (isNaN(qty2) || qty2 == null || qty2 == '') {
			qty2 = 0;
		}
		sumQty2 += parseFloat(qty2);
		$('#mc028').val(sumQty2);
		// console.log(sumQty2);
		//end 總材積合計

	}
	//
	
</script>-->

<script>
	function del_detail(md001, md002, md003, row) {
		// if (confirm("確定刪除細項:" + md001 + "-" + md002 + "-" + md003 + "?")) {
		if (confirm("確定刪除細項:" + md002 + "-" + md003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/bom/bomi02b/del_detail_ajax",
					data: {
						md001: md001,
						md002: md002,
						md003: md003
					}
				})
				.done(function(msg) {
					if (msg) {
						//	alert( "刪除細項:"+md001+"-"+md002+"-"+md003+" 成功!");
						$("#product_row_" + row).remove();
						totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + md001 + "-" + md002 + "-" + md003 + " 失敗!");
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
			// $('#product-row' + row + ' input.order_product_md00' + k).val("");
			// $('#product-row' + row + ' input.order_product_md0' + k).val("");
			// $('#product-row' + row + ' input.order_product_td' + k).val("");
			$('#order_product\\[' + row + '\\]\\[md003disp\\]').val("");
			$('#order_product\\[' + row + '\\]\\[md003disp1\\]').val("");
			$('#order_product\\[' + row + '\\]\\[md004\\]').val("");
		}
	}
</script>
<script>
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
				$('#mc010').focus();
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
				$('input[name=\'order_product[1][md004]\']').focus();
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
	//查詢產品視窗 invi02d_child_v 多筆單筆皆可
	function search_invi02d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		vmd003 = $('#order_product\\[' + selected_row + '\\]\\[md003\\]').val();

		if (vmd003 == undefined) {
			$('#hpi_ifmain').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_child/");
		} else {
			$('#hpi_ifmain').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_child/0/0/" + vmd003 + "/");
		}


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
	//回傳值, 品號,品名,規格,10modi8單位,11modi9單價,庫別,庫別名稱
	function addinvi02adisp(mb001, mb002, mb003, mb004) {
		// clear_row(selected_row);		

		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[md003disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[md003\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[md003disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[md003disp1\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[md004\\]').val(mb004);
		//$('#order_product\\['+selected_row+'\\]\\[md007\\]').val(mb005);
		//$('#order_product\\['+selected_row+'\\]\\[md007disp\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[md006\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		// console.log(mb001);
		// console.log(current_count);
		$('#order_product\\[' + current_count + '\\]\\[md003\\]').val(mb001);
		$('#order_product\\[' + current_count + '\\]\\[md003disp\\]').val(mb002);
		$('#order_product\\[' + current_count + '\\]\\[md003disp1\\]').val(mb003);
		$('#order_product\\[' + current_count + '\\]\\[md004\\]').val(mb004);
		//$('#order_product\\['+current_count+'\\]\\[md007\\]').val(mb005);
		//$('#order_product\\['+current_count+'\\]\\[md007disp\\]').val(mb006);
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
			message: $('#divFcmsi03d'),
			onOverlayClick: clear_cmsi03disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi03ddisp(mb001, mb002) {
		clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[md007\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[md007disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[md007\\]').focus();
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
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[md003disp\\]'); //改變顏色用
		var smb001 = $('#order_product\\[' + row + '\\]\\[md003\\]').val();

		if (!smb001) {
			clear_row(row);
			paragraph.style.color = "red"; //改變顏色用
			$('#order_product\\[' + row + '\\]\\[md003disp\\]').val("不可空白");

			return $('#order_product\\[' + row + '\\]\\[md003\\]').focus();
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

					$('#order_product\\[' + row + '\\]\\[md003disp\\]').val(data.mc001disp);
					$('#order_product\\[' + row + '\\]\\[md003disp1\\]').val(data.mc001disp1);
					$('#order_product\\[' + row + '\\]\\[md004\\]').val(data.mc002);
					return $('#order_product\\[' + row + '\\]\\[md006\\]').focus();
				} else {
					clear_row(row);
					paragraph.style.color = "red"; //改變顏色用
					$('#order_product\\[' + row + '\\]\\[md003\\]').val(smb001);
					$('#order_product\\[' + row + '\\]\\[md003disp\\]').val("查無資料");

					return $('#order_product\\[' + row + '\\]\\[md003\\]').focus();
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
		var smb001 = $('#order_product\\[' + row + '\\]\\[md007\\]').val();
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
					$('#order_product\\[' + row + '\\]\\[md007\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[md007disp\\]').val(data.message[0].value2);
				} else {
					$('#order_product\\[' + row + '\\]\\[md007\\]').val("查無資料");
				}
			}
		});
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

<!--開視窗圖1客戶計價 copi02 有屬性不必下 src   -->
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cop/copi02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<!--開視窗圖2整套展開 copi02 有屬性不必下 src   -->
<div id="divFcopi02a" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hpa_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cop/copi02/display_child/"+$("#puri01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>