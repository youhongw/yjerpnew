<script type="text/javascript">
	//查詢業務人員開視窗cmsi09 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi09disp").click(function() {
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
				message: $('#divFcmsi09'),
				onOverlayClick: clear_cmsi09disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#cmsi09').catcomplete({
		// 	autoFocus: false,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#cmsi09').val();
		// 		$('#cmsi09').attr('onchange', '');
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/' + encodeURIComponent(smb001),
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
		// 		if (ui.item.value != "查無資料") {
		// 			$('#cmsi09').val(ui.item.value1);
		// 			$('#cmsi09disp').text(ui.item.value2);
		// 			//console.log($('#cmsi09a').val());  debug
		// 			return false;
		// 		} else {
		// 			$('#cmsi09disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	change: function(event, ui) {
		// 		$('#cmsi09').attr('onchange', 'check_cmsi09(this)');
		// 		check_cmsi09($('#cmsi09').val());
		// 		return false;
		// 	}
		// 	//focus: function(event, ui) {
		// 	//	return false;
		// 	//}
		// });
	});
</script>
<script type="text/javascript">
	//查詢計劃人員開視窗cmsi09a //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi09adisp").click(function() {
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
				message: $('#divFcmsi09a'),
				onOverlayClick: clear_cmsi09disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#cmsi09a').catcomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#cmsi09a').val();
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/' + encodeURIComponent(smb001),
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
		// 		if (ui.item.value != "查無資料") {
		// 			$('#cmsi09a').val(ui.item.value1);
		// 			$('#cmsi09adisp').text(ui.item.value2);
		// 			//console.log($('#cmsi09a').val());
		// 			return false;
		// 		} else {
		// 			$('#cmsi09adisp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	focus: function(event, ui) {
		// 		return false;
		// 	}
		// });
	});
	//查詢採購人員開視窗cmsi09b //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi09bdisp").click(function() {
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
				message: $('#divFcmsi09b'),
				onOverlayClick: clear_cmsi09disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#cmsi09b').catcomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#cmsi09b').val();
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/' + encodeURIComponent(smb001),
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
		// 		if (ui.item.value != "查無資料") {
		// 			$('#cmsi09b').val(ui.item.value1);
		// 			$('#cmsi09bdisp').text(ui.item.value2);
		// 			//console.log($('#cmsi09a').val());
		// 			return false;
		// 		} else {
		// 			$('#cmsi09bdisp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	focus: function(event, ui) {
		// 		return false;
		// 	}
		// });
	});

	function addcmsi09disp(smb001, smb002) {

		$('#cmsi09').val(smb001);
		$('#cmsi09disp').text(smb002);
		$('#cmsi09').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
		});
	}

	function addcmsi09adisp(smb001, smb002) {

		$('#cmsi09a').val(smb001);
		$('#cmsi09adisp').text(smb002);
		$('#cmsi09a').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
		});
	}

	function addcmsi09bdisp(smb001, smb002) {

		$('#cmsi09b').val(smb001);
		$('#cmsi09bdisp').text(smb002);
		$('#cmsi09b').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
		});
	}

	function clear_cmsi09disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_cmsi09(row_obj) {
		var smb001 = $('#cmsi09').val();
		if (!smb001) {
			$('#cmsi09disp').text("");
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup2_cmsi09/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				mb001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					if (data.message[0].value == "查無資料") {
						$('#cmsi09').val("");
						$('#cmsi09disp').text("查無資料");
					}
					$('#cmsi09').val(smb001);
					$('#cmsi09disp').text(data.message[0].value2);
				} else {
					$('#cmsi09').val(smb001);
					$('#cmsi09disp').text("查無資料");
				}
			}
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_cmsi09a(row_obj) {
		var smb001 = $('#cmsi09a').val();
		if (!smb001) {
			$('#cmsi09adisp').text("");
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup2_cmsi09/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				mb001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					if (data.message[0].value == "查無資料") {
						$('#cmsi09a').val("");
						$('#cmsi09adisp').text("查無資料");
					}
					$('#cmsi09a').val(smb001);
					$('#cmsi09adisp').text(data.message[0].value2);
				} else {
					$('#cmsi09a').val(smb001);
					$('#cmsi09adisp').text("查無資料");
				}
			}
		});
	}
</script>
<div id="divFcmsi09" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi09/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<div id="divFcmsi09a" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi09/displaya_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<div id="divFcmsi09b" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi09/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>


<script>
	//以下為單身function
	// function set_catcomplete(row) {
	// 	$('#order_product\\[' + row + '\\]\\[cmsi09\\]').catcomplete({
	// 		autoFocus: false,
	// 		delay: 1000,
	// 		minLength: 1,
	// 		source: function(req, add) {
	// 			var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi09\\]').val();
	// 			$('#order_product\\[' + row + '\\]\\[cmsi09\\]').attr('onchange', '');
	// 			console.log(smb001);
	// 			$.ajax({
	// 				url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup_body_catcomplete/' + encodeURIComponent(smb001),
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
	// 				$('#order_product\\[' + row + '\\]\\[cmsi09\\]').val(ui.item.value1);
	// 				$('#order_product\\[' + row + '\\]\\[cmsi09_mv002\\]').val(ui.item.value2);
	// 			}
	// 			return false;
	// 		},

	// 		change: function(event, ui) {
	// 			$('#order_product\\[' + row + '\\]\\[cmsi09\\]').attr('onchange', 'check_cmsi09_body(this)');
	// 			check_cmsi09_body(row); //1060713 新增
	// 			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
	// 			return false;
	// 		},
	// 		focus: function(event, ui) {
	// 			return false;
	// 		}
	// 	});

	// 	$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').catcomplete({
	// 		autoFocus: false,
	// 		delay: 1000,
	// 		minLength: 1,
	// 		source: function(req, add) {
	// 			var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').val();
	// 			var smb002 = $('#order_product\\[' + row + '\\]\\[cmsi05\\]').val();
	// 			$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').attr('onchange', '');
	// 			console.log(smb001);
	// 			$.ajax({
	// 				url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup_body_catcomplete_asti02/' + encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002),
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
	// 				$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').val(ui.item.value1);
	// 				$('#order_product\\[' + row + '\\]\\[cmsi09_asti02_mv002\\]').val(ui.item.value2);
	// 			}
	// 			return false;
	// 		},

	// 		change: function(event, ui) {
	// 			$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').attr('onchange', 'check_cmsi09_asti02_body(this)');
	// 			check_cmsi09_asti02_body(row); //1060713 新增
	// 			//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
	// 			return false;
	// 		},
	// 		focus: function(event, ui) {
	// 			return false;
	// 		}
	// 	});
	// }
</script>


<script>
	//查詢員工視窗
	function search_cmsi09_body_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		console.log(row);
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
			message: $('#divFcmsi09_body'),
			onOverlayClick: clear_cmsi09_body_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi09_body(mv001, mv002) {
		clear_row(selected_row);

		$('#order_product\\[' + selected_row + '\\]\\[cmsi09\\]').val(mv001);
		$('#order_product\\[' + selected_row + '\\]\\[cmsi09_mv002\\]').val(mv002);

		$('#order_product\\[' + selected_row + '\\]\\[cmsi09\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_sql"
		});
	}

	function clear_cmsi09_body_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_sql"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_cmsi09_body(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi09\\]').val();

		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[cmsi09\\]').val('');
			$('#order_product\\[' + row + '\\]\\[cmsi09_mv002\\]').val('');
			clear_row(row);
			return;
		}
		console.log('work id:' + smb001);
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup_body_check/' + encodeURIComponent(smb001),
				data: {
					me001: row_obj.value,
				}
			})
			.done(function(msg) {
				console.log(msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[cmsi09\\]').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[cmsi09\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[cmsi09_mv002\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[cmsi09\\]').focus();
				}
			});

	}
</script>
<div id="divFcmsi09_body" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi09/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>


<script>
	//以下為單身function (使用:人員)1070831
	//查詢員工視窗
	function search_cmsi09d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		console.log(row);
		selected_row = row;
		var temp = $('#order_product\\[' + selected_row + '\\]\\[cmsi09\\]').val();

		if (!temp) {
			temp = "";
		}

		$("#iframe_cmsi09d").attr('src', '<?php echo base_url() ?>index.php/cms/cmsi09/display_child_bodyd/' + temp);

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '50%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi09d_body'),
			onOverlayClick: clear_cmsi09d_body_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi09d_body(mv001, mv002) {
		// clear_row(selected_row);
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[cmsi09ddisp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[cmsi09d\\]').val(mv001);
		$('#order_product\\[' + selected_row + '\\]\\[cmsi09ddisp\\]').val(mv002);

		$('#order_product\\[' + selected_row + '\\]\\[TE005\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_sql"
		});
	}

	function clear_cmsi09d_body_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_sql"
		});
	}

	//以下為單身function (使用:人員)1070831;1111;sfsd; 
	//查詢員工視窗 多選
	function search_cmsi09ch_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		selected_row = row;

		$("#iframe_cmsi09ch").attr('src', '<?php echo base_url() ?>index.php/cms/cmsi09/display_child_ch/');

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '50%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi09ch_body'),
			onOverlayClick: clear_cmsi09d_body_ch
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi09ch_body(mv001, mv002) {
		// clear_row(selected_row);
		// console.log('selected_in:' + mv001);
		$('#order_product\\[' + selected_row + '\\]\\[TE030\\]').val(mv001);
		// $('#order_product\\[' + selected_row + '\\]\\[cmsi09ddisp\\]').val(mv002);

		$('#order_product\\[' + selected_row + '\\]\\[TE030\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_ch"
		});
	}


	function clear_cmsi09d_body_ch() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_ch"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算 
	function check_cmsi09d(row_obj) {

		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val();
		var smb002 = $('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val();

		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val('');
			$('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val('');
			// clear_row(row);
			return $('#order_product\\[' + row + '\\]\\[cmsi09d\\]').focus();
		}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]'); //改變顏色用
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup_body_check/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val("");
					$('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[cmsi09d\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE005\\]').focus();
				}

			});
	}
</script>
<div id="divFcmsi09d_body" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe id="iframe_cmsi09d" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>



<div id="divFcmsi09ch_body" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe id="iframe_cmsi09ch" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<script>
	//以下為單身function (asti02使用:人員會因部門影響)
	//查詢員工視窗
	function search_cmsi09_asti02_body_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		console.log(row);
		selected_row = row;
		var temp = $('#order_product\\[' + selected_row + '\\]\\[cmsi05\\]').val();

		if (!temp) {
			temp = "null";
		}

		$("#iframe_cmsi09_asti02").attr('src', '<?php echo base_url() ?>index.php/cms/cmsi09/display_child_body_asti02/' + temp);

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
			message: $('#divFcmsi09_asti02_body'),
			onOverlayClick: clear_cmsi09_asti02_body_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi09_asti02_body(mv001, mv002) {
		clear_row(selected_row);

		$('#order_product\\[' + selected_row + '\\]\\[cmsi09_asti02\\]').val(mv001);
		$('#order_product\\[' + selected_row + '\\]\\[cmsi09_asti02_mv002\\]').val(mv002);

		$('#order_product\\[' + selected_row + '\\]\\[cmsi09_asti02\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_sql_asti02"
		});
	}

	function clear_cmsi09_asti02_body_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_sql_asti02"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_cmsi09_asti02_body(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').val();
		var smb002 = $('#order_product\\[' + row + '\\]\\[cmsi05\\]').val();

		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').val('');
			$('#order_product\\[' + row + '\\]\\[cmsi09_asti02_mv002\\]').val('');
			clear_row(row);
			return;
		}

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup_body_check_asti02/' + encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				me001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[cmsi09_asti02_mv002\\]').val(data.message[0].value2);

					$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').val("查無資料");
					$('#order_product\\[' + row + '\\]\\[cmsi09_asti02\\]').focus();
				}
			}
		});
	}
	//ondblclick 按2下開視窗
	function search_cmsi09_window() {
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
			message: $('#divFcmsi09'),
			onOverlayClick: clear_cmsi09disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
<div id="divFcmsi09_asti02_body" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe id="iframe_cmsi09_asti02" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>