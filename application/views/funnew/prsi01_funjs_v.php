<script type="text/javascript">
	var current_count = <?php echo $current_product_count; ?>;
	var current_count1 = <?php echo $current_product_count1; ?>;
	var current_count2 = <?php echo $current_product_count2; ?>;
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
			append_str += '<input type="hidden" name="order_product[' + current_count + '][db001]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][db002]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][db011]" value="' + current_count + '" / > ';

			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db003]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db003]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" maxlength="4" placeholder="HHMM" required /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db004]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db004]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db005]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db005]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db006]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db006]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db007]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db007]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db008]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db008]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db009]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db009]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][db010]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][db010]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';


			append_str += '</tr>';
			append_str += '</tbody>';

			// console.log(append_str);
			$('#order_product tfoot').before(append_str);

			$('#order_product\\[' + current_count + '\\]\\[db003\\]').focus();
		}
		current_count++;
		first = true;
	}

	function addItem1() {

		// if (current_count1){
		var append_str = "";
		var type = "";
		append_str += "<tbody id='product1_row_" + current_count1 + "' class='product1_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product1_row_' + current_count1 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][dc001]" value="" />';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][dc002]" value="" />';
		append_str += '<input type="hidden" name="order_product1[' + current_count1 + '][dc008]" value="' + current_count1 + '" />';

		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][dc003]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][dc003]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8" required /></td>';
		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][dc004]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][dc004]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][dc005]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][dc005]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][dc006]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][dc006]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product1[' + current_count1 + '][dc007]" onKeyPress="keyFunction()" name="order_product1[' + current_count1 + '][dc007]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';


		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product1 tfoot').before(append_str);
		$('#order_product1\\[' + current_count1 + '\\]\\[dc003\\]').focus();
		// }
		current_count1++;
	}

	function addItem2() {

		// if (current_count2){
		var append_str = "";
		var type = "";
		append_str += "<tbody id='product2_row_" + current_count2 + "' class='product2_row' >";
		append_str += "<tr>";
		append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product2_row_' + current_count2 + '\').remove();" /></td>';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][dd001]" value="" />';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][dd002]" value="" />';
		append_str += '<input type="hidden" name="order_product2[' + current_count2 + '][dd008]" value="' + current_count2 + '" />';

		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][dd003]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][dd003]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" maxlength="4" placeholder="HHMM" required  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][dd004]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][dd004]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][dd005]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][dd005]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][dd006]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][dd006]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';
		append_str += '<td class="center"><input type="text" id="order_product2[' + current_count2 + '][dd007]" onKeyPress="keyFunction()" name="order_product2[' + current_count2 + '][dd007]" value="" size="10" style="text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,\'\');" maxlength="8"  /></td>';


		append_str += '</tr>';
		append_str += '</tbody>';

		// console.log(append_str);
		$('#order_product2 tfoot').before(append_str);
		$('#order_product2\\[' + current_count2 + '\\]\\[dd003\\]').focus();
		// }
		current_count2++;
	}

	function electricity(el001) {
		es = $('#da007').val();
		ed = $('#da008').val();
		$('#da009').val(ed - es);
	}
</script>


<script>
	function del_detail(db001, db002, db003, row) {
		if (confirm("確定刪除細項:" + db001 + "-" + db002 + "-" + db003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/prs/prsi01/del_detail_ajax",
					data: {
						db001: db001,
						db002: db002,
						db003: db003
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + db001 + "-" + db002 + "-" + db003 + " 成功!" + msg);
						$("#product_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + db001 + "-" + db002 + "-" + db003 + " 失敗!");
					}
				});
		}
	}

	function del_detail1(dc001, dc002, dc003, row) {
		if (confirm("確定刪除細項:" + dc001 + "-" + dc002 + "-" + dc003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/prs/prsi01/del_detail_ajax1",
					data: {
						dc001: dc001,
						dc002: dc002,
						dc003: dc003
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + dc001 + "-" + dc002 + "-" + dc003 + " 成功!" + msg + "row:"+row);
						$("#product1_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + dc001 + "-" + dc002 + "-" + dc003 + " 失敗!");
					}
				});
		}
	}

	function del_detail2(dd001, dd002, dd003, row) {
		if (confirm("確定刪除細項:" + dd001 + "-" + dd002 + "-" + dd003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/prs/prsi01/del_detail_ajax2",
					data: {
						dd001: dd001,
						dd002: dd002,
						dd003: dd003
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + dd001 + "-" + dd002 + "-" + dd003 + " 成功!" + msg+ "row:"+row);
						$("#product2_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + dd001 + "-" + dd002 + "-" + dd003 + " 失敗!");
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
		if (event.altKey && (keycode == '40')) { //新增一筆明細 altKey+↓
			addItem2();
		}
		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.ctrlKey && (keycode == '40')) { //新增一筆明細 ctrlKey+↓
			addItem();
		}

		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.shiftKey && (keycode == '40')) { //新增一筆明細 shiftKey+↓
			addItem1();
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