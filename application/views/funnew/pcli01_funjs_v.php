<script type="text/javascript">
	var current_count = <?php echo $current_product_count; ?>;
	var current_count1 = <?php echo $current_product_count1; ?>;
	var current_count2 = <?php echo $current_product_count2; ?>;
	var current_count3 = <?php echo $current_product_count3; ?>;
	var current_count4 = <?php echo $current_product_count4; ?>;
	var current_count5 = <?php echo $current_product_count5; ?>;
	var first = false;

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




	function remove_row() {
		// var table = document.getElementById("order_product");
		// var tbodyRowCount = document.getElementById("order_product").rows.length - 2;
		// console.log('有幾列：' + current_count);

		for (var i = 10; i >= 1; i--) {
			// console.log('移除_' + i + ":" + i);
			$("#product_row_" + i).remove();
		}
	}


	function addItem() {

		if (first) {
			var append_str = "";
			var type = "";
			append_str += "<tbody id='product_row_" + current_count + "' class='product_row' >";
			append_str += "<tr>";
			append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product_row_' + current_count + '\').remove();" /></td>';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][bi001]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][bi002]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][bi003]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][bi004]" value="' + current_count + '" />';

			append_str += '<td class="left" style="text-align:center;"><select id="order_product[' + current_count + '][bi005]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][bi005]" >';
			append_str += '<option value="1">早班</option><option value="2">晚班</option></select></td>';
			append_str += '<td class="left" style="text-align:center;"><select id="order_product[' + current_count + '][bi006]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][bi006]" >';
			append_str += '<option value="1">上半</option><option value="2">下半</option></select></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][bi007]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][bi007]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][bi008]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][bi008]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';



			append_str += '</tr>';
			append_str += '</tbody>';

			// console.log(append_str);
			$('#order_product tfoot').before(append_str);

			$('#order_product\\[' + current_count + '\\]\\[bi005\\]').focus();
		}
		current_count++;
		first = true;

	}

	function addItem1() {
		current_count1++;
		// if (current_count1){
		var append_str = "";
		var type = "";
		append_str += "<tbody id='product1_row_" + current_count1 + "' class='product1_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product1_row_' + current_count1 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][bj001]" value="" />';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][bj002]" value="" />';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][bj003]" value="" />';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][bj004]" value="' + current_count1 + '" />';

		append_str += '<td class="left" style="text-align:center;"><select id="order_product1[' + current_count1 + '][bj005]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][bj005]" >';
		append_str += '<option value="1">輪寬</option><option value="2">軸承孔</option></select></td>';
		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][bj006]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][bj006]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][bj007]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][bj007]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';



		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product1 tfoot').before(append_str);
		$('#order_product1\\[' + current_count1 + '\\]\\[bj005\\]').focus();
		// }

	}

	function addItem2() {
		current_count2++;
		// if (current_count2){
		var append_str = "";
		var type = "";
		append_str += "<tbody id='product2_row_" + current_count2 + "' class='product2_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product2_row_' + current_count2 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][bk001]" value="" />';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][bk002]" value="" />';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][bk003]" value="" />';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][bk004]" value="' + current_count2 + '" />';

		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][bk005]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][bk005]" value="" size="10" style="text-align:center;width: 60%;" maxlength="20" required  /></td>';
		append_str += '<td class="left" style="text-align:center;"><select id="order_product2[' + current_count2 + '][bk006]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][bk006]" >';
		append_str += '<option value="1">邊寬</option><option value="2">軸承孔</option></select></td>';
		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][bk007]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][bk007]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][bk008]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][bk008]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';


		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product2 tfoot').before(append_str);
		$('#order_product2\\[' + current_count2 + '\\]\\[bk005\\]').focus();
		// }

	}

	function addItem3() {
		current_count3++;

		var append_str = "";
		var type = "";
		append_str += "<tbody id='product3_row_" + current_count3 + "' class='product3_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product3_row_' + current_count3 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product3[' + current_count3 + '][bl001]" value="" />';
		append_str += '<input type="hidden" name="order_product3[' + current_count3 + '][bl002]" value="" />';
		append_str += '<input type="hidden" name="order_product3[' + current_count3 + '][bl003]" value="" />';
		append_str += '<input type="hidden" name="order_product3[' + current_count3 + '][bl004]" value="' + current_count3 + '" />';

		append_str += '<td class="left" style="text-align:center;"><select id="order_product3[' + current_count3 + '][bl005]" onKeyPress="keyFunction()" name="order_product3[' + current_count3 + '][bl005]" >';
		append_str += '<option value="1">早班</option><option value="2">晚班</option></select></td>';
		append_str += '<td class="left" style="text-align:center;"><select id="order_product3[' + current_count3 + '][bl006]" onKeyPress="keyFunction()" name="order_product3[' + current_count3 + '][bl006]" >';
		append_str += '<option value="1">外端面</option><option value="2">中端面</option></select></td>';
		append_str += '<td class="center"><input type="text" id="order_product3[' + current_count3 + '][bl007]" onKeyPress="keyFunction()" name="order_product3[' + current_count3 + '][bl007]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product3[' + current_count3 + '][bl008]" onKeyPress="keyFunction()" name="order_product3[' + current_count3 + '][bl008]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';



		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product3 tfoot').before(append_str);
		$('#order_product3\\[' + current_count + '\\]\\[bl005\\]').focus();
	}

	function addItem4() {
		current_count4++;
		// if (current_count4){
		var append_str = "";
		var type = "";
		append_str += "<tbody id='product4_row_" + current_count4 + "' class='product4_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product4_row_' + current_count4 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product4[' + current_count4 + '][bm001]" value="" />';
		append_str += '<input type="hidden" name="order_product4[' + current_count4 + '][bm002]" value="" />';
		append_str += '<input type="hidden" name="order_product4[' + current_count4 + '][bm003]" value="" />';
		append_str += '<input type="hidden" name="order_product4[' + current_count4 + '][bm004]" value="' + current_count4 + '" />';

		append_str += '<td class="left" style="text-align:center;"><select id="order_product4[' + current_count4 + '][bm005]" onKeyPress="keyFunction()" name="order_product4[' + current_count4 + '][bm005]" >';
		append_str += '<option value="1">外端面</option><option value="2">中端面</option></select></td>';
		append_str += '<td class="center"><input type="text" id="order_product4[' + current_count4 + '][bm006]" onKeyPress="keyFunction()" name="order_product4[' + current_count4 + '][bm006]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product4[' + current_count4 + '][bm007]" onKeyPress="keyFunction()" name="order_product4[' + current_count4 + '][bm007]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';



		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product4 tfoot').before(append_str);
		$('#order_product4\\[' + current_count4 + '\\]\\[bm005\\]').focus();
		// }

	}

	function addItem5() {
		current_count5++;
		// if (current_count5){
		var append_str = "";
		var type = "";
		append_str += "<tbody id='product5_row_" + current_count5 + "' class='product5_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product5_row_' + current_count5 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product5[' + current_count5 + '][bn001]" value="" />';
		append_str += '<input type="hidden" name="order_product5[' + current_count5 + '][bn002]" value="" />';
		append_str += '<input type="hidden" name="order_product5[' + current_count5 + '][bn003]" value="" />';
		append_str += '<input type="hidden" name="order_product5[' + current_count5 + '][bn004]" value="' + current_count5 + '" />';

		append_str += '<td class="left" style="text-align:center;"><select id="order_product5[' + current_count5 + '][bn005]" onKeyPress="keyFunction()" name="order_product5[' + current_count5 + '][bn005]" >';
		append_str += '<option value="1">外端面</option><option value="2">中端面</option></select></td>';
		append_str += '<td class="center"><input type="text" id="order_product5[' + current_count5 + '][bn006]" onKeyPress="keyFunction()" name="order_product5[' + current_count5 + '][bn006]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product5[' + current_count5 + '][bn007]" onKeyPress="keyFunction()" name="order_product5[' + current_count5 + '][bn007]" value="" size="10" style="text-align:center;" maxlength="8"  /></td>';



		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product5 tfoot').before(append_str);
		$('#order_product5\\[' + current_count5 + '\\]\\[bn005\\]').focus();
		// }

	}

	function electricity(el001) {
		es = $('#da007').val();
		ed = $('#da008').val();
		$('#da009').val(ed - es);
	}
</script>


<script>
	function del_detail(bi001, bi002, bi003, bi004, row) {
		if (confirm("確定刪除細項:" + bi001 + "-" + bi002 + "-" + bi004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli01/del_detail_ajax",
					data: {
						bi001: bi001,
						bi002: bi002,
						bi003: bi003,
						bi004: bi004
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + bi001 + "-" + bi002 + "-" + bi003 + " 成功!" + msg);
						$("#product_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + bi001 + "-" + bi002 + "-" + bi004 + " 失敗!");
					}
				});
		}
	}

	function del_detail1(bj001, bj002, bj003, bj004, row) {
		if (confirm("確定刪除細項:" + bj001 + "-" + bj002 + "-" + bj004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli01/del_detail_ajax1",
					data: {
						bj001: bj001,
						bj002: bj002,
						bj003: bj003,
						bj004: bj004
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + bj001 + "-" + bj002 + "-" + bj003 + " 成功!" + msg + "row:"+row);
						$("#product1_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + bj001 + "-" + bj002 + "-" + bj003 + " 失敗!");
					}
				});
		}
	}

	function del_detail2(bk001, bk002, bk003, bk004, row) {
		if (confirm("確定刪除細項:" + bk001 + "-" + bk002 + "-" + bk004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli01/del_detail_ajax2",
					data: {
						bk001: bk001,
						bk002: bk002,
						bk003: bk003,
						bk004: bk004
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + bk001 + "-" + bk002 + "-" + bk003 + " 成功!" + msg+ "row:"+row);
						$("#product2_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + bk001 + "-" + bk002 + "-" + bk004 + " 失敗!");
					}
				});
		}
	}

	function del_detail3(bl001, bl002, bl003, bl004, row) {
		if (confirm("確定刪除細項:" + bl001 + "-" + bl002 + "-" + bl004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli01/del_detail_ajax3",
					data: {
						bl001: bl001,
						bl002: bl002,
						bl003: bl003,
						bl004: bl004
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + bl001 + "-" + bl002 + "-" + bl003 + " 成功!" + msg);
						$("#product3_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + bl001 + "-" + bl002 + "-" + bl004 + " 失敗!");
					}
				});
		}
	}

	function del_detail4(bm001, bm002, bm003, bm004, row) {
		if (confirm("確定刪除細項:" + bm001 + "-" + bm002 + "-" + bm004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli01/del_detail_ajax4",
					data: {
						bm001: bm001,
						bm002: bm002,
						bm003: bm003,
						bm004: bm004
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + bm001 + "-" + bm002 + "-" + bm003 + " 成功!" + msg + "row:"+row);
						$("#product4_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + bm001 + "-" + bm002 + "-" + bm004 + " 失敗!");
					}
				});
		}
	}

	function del_detail5(bn001, bn002, bn003, bn004, row) {
		if (confirm("確定刪除細項:" + bn001 + "-" + bn002 + "-" + bn004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli01/del_detail_ajax5",
					data: {
						bn001: bn001,
						bn002: bn002,
						bn003: bn003,
						bn004: bn004
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + bn001 + "-" + bn002 + "-" + bn003 + " 成功!" + msg + "row:"+row);
						$("#product5_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + bn001 + "-" + bn002 + "-" + bn004 + " 失敗!");
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


		$('#order_product\\[' + row + '\\]\\[tb012\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb013\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb007\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb009\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb009disp\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb005\\]').val("");
		$('#order_product\\[' + row + '\\]\\[tb017\\]').val("");
	}

	//機台
	function check_cmsi03d(row_obj) {

		var smb001 = $('#bh003').val().trim();
		if (!smb001) {
			$('#bh003').val('');
			$('#MX003').val('');
			// clear_row(row);
			return;
		}
		console.log('input:' + smb001);

		var paragraph = document.querySelector('#MX003'); //改變顏色用

		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb001) + '/CR004/',
				data: {
					mb001: row_obj.value,
					mb002: "CR004"
				}
			})
			.done(function(msg) {
				console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#bh003').val("");
					$('#MX003').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#bh003').focus();
				} else {
					$('#MX003').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#bh002').focus();
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
		// console.log("afadsfasfsad");
		selected_row = row;
		// console.log($('#cmsi04').val());

		// $('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child/CR004/");
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
		var paragraph = document.querySelector('#MX003'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#bh003').val(mb001);
		$('#MX003').val(mb002);
		return $('#bh002').focus();
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

	function check_invi02(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var smb001 = $('#bh002').val();
		if (!smb001) {
			$('#MB002').val('');
			$('#MB003').val('');
			// $('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
			return $('#bh002').focus();
		}
		// console.log('smb001:' + smb001);

		var paragraph = document.querySelector('#MB002'); //改變顏色用
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

					$('#bh002').val(data.MB001);
					$('#MB002').val(data.MB002);
					$('#MB003').val(data.MB003);
					// $('#order_product\\[' + row + '\\]\\[TE020\\]').val(data.MB004);
					paragraph.style.color = "black"; //改變顏色用

					return $('#bh004').focus();
				} else {
					// $('#bh002').val('');
					$('#MB002').val('查無品號');
					$('#MB003').val('');
					// $('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
					paragraph.style.color = "red"; //改變顏色用
					return $('#bh002').focus();
				}
			}
		});
		// .done(function(data) {
		// 	//回傳值顯示處理
		// 	if (data.response) {
		// 		paragraph.style.color = "black"; //改變顏色用

		// 		$('#bh002').val(data.MB001);
		// 		$('#MB002').val(data.MB002);
		// 		$('#MB003').val(data.MB003);
		// 		// $('#order_product\\[' + row + '\\]\\[TE020\\]').val(data.MB004);
		// 		paragraph.style.color = "black"; //改變顏色用

		// 		return $('#bh004').focus();
		// 	} else {
		// 		console.log('output.false:');
		// 		$('#bh002').val('');
		// 		$('#MB002').val('查無品號');
		// 		$('#MB003').val('');
		// 		// $('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
		// 		paragraph.style.color = "red"; //改變顏色用
		// 		return $('#bh002').focus();
		// 	}
		// });


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

		// $('#invi02_disp').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_childa/0/0/" + $("#cmsi04").val());

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

		var paragraph = document.querySelector('#MB002'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#bh002').val(mb001);
		$('#MB002').val(mb002);
		$('#MB003').val(mb003);
		// $('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb004);
		$('#bh004').focus();

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
</script>
<!--開視窗 機台    -->
<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<!-- <iframe allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child/CR004/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!-- 查詢品號類別開視窗invi02 -->
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<!-- <iframe allowTransparency="flase" id="invi02_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
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
		if (event.altKey && (keycode == '40')) { //新增一筆明細 altKey+↓
			addItem2();
		}
		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.ctrlKey && (keycode == '40')) { //新增一筆明細 ctrlKey+↓
			addItem1();
		}

		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.shiftKey && (keycode == '40')) { //新增一筆明細 shiftKey+↓
			addItem();
		}

		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.altKey && (keycode == '39')) { //新增一筆明細 altKey+→
			addItem5();
		}
		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.ctrlKey && (keycode == '39')) { //新增一筆明細 ctrlKey+→
			addItem4();
		}

		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.shiftKey && (keycode == '39')) { //新增一筆明細 shiftKey+→
			addItem3();
		}
	});
	$('#product2_row_0').find("tr").click(function() {
		// console.log("color");
		$("#product2_row_0 tr td").css('background-color', '#f3bf4d !important'); //background-color: #f3bf4d !important;
	})

	function changecolor(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		console.log("clear_row_in:" + row);
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

	//-->
</script>