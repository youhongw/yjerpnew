<script type="text/javascript">
	var current_count = <?php echo $current_product_count; ?>;
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
			append_str += '<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product_row_' + current_count + '\').remove();sum_num();" /></td>';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][sb001]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][sb002]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][sb003]" value="" />';
			append_str += '<input type="hidden" name="order_product[' + current_count + '][sb004]" value="' + current_count + '" />';

			append_str += '<td class="center"><input type="text" onchange="sum_num()" id="order_product[' + current_count + '][sb005]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][sb005]" value="" size="10" style="text-align:center;" maxlength="8" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" required /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][sb006]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][sb006]" value="" size="10" style="text-align:center;" maxlength="8" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" required /></td>';
			append_str += '<td class="center"><input type="text" id="order_product[' + current_count + '][sb007]" onKeyPress="keyFunction()" name="order_product[' + current_count + '][sb007]" value="" size="10" style="text-align:center;" maxlength="8" onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'\');" /></td>';

			append_str += '</tr>';
			append_str += '</tbody>';

			console.log(append_str);
			$('#order_product tfoot').before(append_str);

			$('#order_product\\[' + current_count + '\\]\\[sb005\\]').focus();
		}
		current_count++;
		first = true;

	}

	function count_time() {
		startTime = $('#sa004').val();
		endTime = $('#sa005').val();
		startDate = new Date(0, 0, 0, startTime.substr(0, 2), startTime.substr(2, 2), 0);
		endDate = new Date(0, 0, 0, endTime.substr(0, 2), endTime.substr(2, 2), 0);
		diff = endDate.getTime() - startDate.getTime();
		hours = Math.floor(diff / 1000 / 60 / 60 * 10) / 10;
		if (startTime <= 1200 && endTime >= 1300) {
			$('#sa006').val(hours - 1);
		} else {
			$('#sa006').val(hours);
		}
	}
</script>


<script>
	function del_detail(sb001, sb002, sb003, sb004, row) {
		if (confirm("確定刪除細項:" + sb001 + "-" + sb002 + "-" + sb004 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/pcl/pcli02/del_detail_ajax",
					data: {
						sb001: sb001,
						sb002: sb002,
						sb003: sb003,
						sb004: sb004
					}
				})
				.done(function(msg) {

					if (msg) {
						// alert("刪除細項:" + sb001 + "-" + sb002 + "-" + sb003 + " 成功!" + msg);
						$("#product_row_" + row).remove();
						sum_num();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + sb001 + "-" + sb002 + "-" + sb004 + " 失敗!");
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

	function sum_num() {
		var sum = 0;
		for (let i = 0; i < 20; i++) {
			sum = sum + roughScale($('#order_product\\[' + i + '\\]\\[sb005\\]').val());
		}
		$('#sb005sum').val(sum);

	}

	function roughScale(x) {
		const parsed = parseInt(x);
		if (isNaN(parsed)) {
			return 0;
		}
		return parsed;
	}


	//機台
	function check_cmsi03d(row_obj) {

		var smb001 = $('#sa003').val().trim();
		if (!smb001) {
			$('#sa003').val('');
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
					$('#sa003').val("");
					$('#MX003').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#sa003').focus();
				} else {
					$('#MX003').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#sa004').focus();
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
		$('#sa003').val(mb001);
		$('#MX003').val(mb002);
		return $('#sa004').focus();
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

		var smb001 = $('#sa002').val();
		if (!smb001) {
			$('#MB002').val('');
			$('#MB003').val('');
			// $('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
			return $('#sa002').focus();
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

					$('#sa002').val(data.MB001);
					$('#MB002').val(data.MB002);
					$('#MB003').val(data.MB003);
					// $('#order_product\\[' + row + '\\]\\[TE020\\]').val(data.MB004);
					paragraph.style.color = "black"; //改變顏色用

					return $('#sa003').focus();
				} else {
					// $('#sa002').val('');
					$('#MB002').val('查無品號');
					$('#MB003').val('');
					// $('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
					paragraph.style.color = "red"; //改變顏色用
					return $('#sa002').focus();
				}
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
		$('#sa002').val(mb001);
		$('#MB002').val(mb002);
		$('#MB003').val(mb003);
		// $('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb004);
		$('#sa003').focus();

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
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child/CR002/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
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
			addItem();
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