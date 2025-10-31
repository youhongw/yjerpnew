<script type="text/javascript">
	//查詢部門開視窗cmsi05  //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi05disp").click(function() {
			$.blockUI({
				theme: true,
				title: 'Can move',
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
				message: $('#divFcmsi05'),
				onOverlayClick: clear_cmsi05disp_sql
			});
			$('.close').click($.unblockUI);
		});
		//autoFocus: true 改 false 1060704
		// $('#cmsi05').catcomplete({
		//     autoFocus: false,
		// 	delay: 1000,
		//     minLength: 1,  		
		// 	source:
		// 	function(req, add){
		// 		var sme001= $('#cmsi05').val();
		// 		$('#cmsi05').attr('onchange','');
		// 		console.log(sme001);
		//         $.ajax({
		//             url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup_catcomplete/'+encodeURIComponent(sme001), 
		//             cache: false, 				
		//             dataType: 'json',  
		//             type: 'POST',  
		//             data: req,
		//             success:      
		// 			function(data){  
		// 				if(data.response =="true"){
		// 					add(data.message);
		// 				}
		// 			}
		// 		});
		// 	},  
		// 	select: function(event, ui) {
		// 		if(ui.item.value!="查無資料"){
		// 			$('#cmsi05').val(ui.item.value1);
		// 			$('#cmsi05disp').text(ui.item.value2);
		// 			//console.log($('#cmsi05').val());
		// 			return false;
		// 		}else{
		// 			$('#cmsi05disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	change: function(event, ui) {
		// 		$('#cmsi05').attr('onchange','check_cmsi05(this)');
		// 		check_cmsi05($('#cmsi05').val());
		// 		return false;
		// 	}
		// 	//focus: function(event, ui) {
		// 	//	return false;
		// 	//}
		// });
	});

	function addcmsi05disp(sme001, sme002) {
		var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		//alert('test2');
		$('#cmsi05').val(sme001);
		$('#cmsi05disp').text(sme002);
		$('#tb006').val(sme002); //sfci05
		$('#cmsi05').focus();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql"
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

		var paragraph = document.querySelector('#cmsi05disp'); //改變顏色用
		// $.ajax({
		// 	url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup_check/' + encodeURIComponent(sme001),
		// 	cache: false,
		// 	dataType: 'json',
		// 	type: 'POST',
		// 	data: {
		// 		me001: row_obj.value
		// 	},
		// 	success: function(data) {
		// 		if (data.response == "true") {
		// 			if (data.message[0].value == "查無資料") {
		// 				$('#cmsi05').val("");
		// 				$('#cmsi05disp').text("查無資料");
		// 			}
		// 			$('#cmsi05').val(sme001);
		// 			$('#cmsi05disp').text(data.message[0].value2);
		// 		} else {
		// 			$('#cmsi05').val(sme001);
		// 			$('#cmsi05disp').text("查無資料");
		// 		}
		// 	}
		// });
		$.ajax({
				method: 'POST',
				url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup_check/' + encodeURIComponent(sme001),
				data: {
					me001: sme001
				}
			})
			.done(function(msg) {
				// console.log('msg:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#cmsi05disp').text('找不到部門');
					paragraph.style.color = "red"; //改變顏色用
					// $('#admi04').val('');
					return $('#cmsi05').focus();
				} else {
					$('#cmsi05disp').text(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#mf611').focus();
				}

			});
	}
</script>
<div id="divFcmsi05" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
<script type="text/javascript">
	//查詢部門開視窗cmsi05  a //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi05adisp").click(function() {
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
				message: $('#divFcmsi05a'),
				onOverlayClick: clear_cmsi05disp_sql
			});
			$('.close').click($.unblockUI);
		});
		//autoFocus: true 改 false 1060704
		// $('#cmsi05a').catcomplete({
		// 	autoFocus: false,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var sme001 = $('#cmsi05a').val();
		// 		$('#cmsi05a').attr('onchange', '');
		// 		console.log(sme001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookupa_catcomplete/' + encodeURIComponent(sme001),
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
		// 			$('#cmsi05a').val(ui.item.value1);
		// 			$('#cmsi05adisp').text(ui.item.value2);
		// 			//console.log($('#cmsi05').val());
		// 			return false;
		// 		} else {
		// 			$('#cmsi05adisp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	change: function(event, ui) {
		// 		$('#cmsi05a').attr('onchange', 'check_cmsi05a(this)');
		// 		check_cmsi05a($('#cmsi05a').val());
		// 		return false;
		// 	}
		// 	//focus: function(event, ui) {
		// 	//	return false;
		// 	//}
		// });
	});

	function addcmsi05adisp(sme001, sme002) {
		//alert('test2');
		$('#cmsi05a').val(sme001);
		$('#cmsi05adisp').text(sme002);
		$('#tb009').val(sme002); //sfci05
		$('#cmsi05a').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_sql"
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
	function check_cmsi05a(row_obj) {
		var sme001 = $('#cmsi05a').val();
		if (!sme001) {
			$('#cmsi05adisp').text("");
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookupa_check/' + encodeURIComponent(sme001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				me001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					if (data.message[0].value == "查無資料") {
						$('#cmsi05a').val("");
						$('#cmsi05adisp').text("查無資料");
					}
					$('#cmsi05a').val(sme001);
					$('#cmsi05adisp').text(data.message[0].value2);
				} else {
					$('#cmsi05a').val(sme001);
					$('#cmsi05adisp').text("查無資料");
				}
			}
		});
	}
</script>
<div id="divFcmsi05a" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<script>
	//以下為單身function
	function set_catcomplete(row) {
		$('#order_product\\[' + row + '\\]\\[cmsi05\\]').catcomplete({
			autoFocus: false,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi05\\]').val();
				$('#order_product\\[' + row + '\\]\\[cmsi05\\]').attr('onchange', '');
				console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup_body_catcomplete/' + encodeURIComponent(smb001),
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
				if (ui.item.value != "查無資料") {
					$('#order_product\\[' + row + '\\]\\[cmsi05\\]').val(ui.item.value1);
					$('#order_product\\[' + row + '\\]\\[cmsi05_me002\\]').val(ui.item.value2);
				}
				return false;
			},

			change: function(event, ui) {
				$('#order_product\\[' + row + '\\]\\[cmsi05\\]').attr('onchange', 'check_cmsi05_body(this)');
				check_cmsi05_body(row); //1060713 新增
				//check_invi02d($('#order_product\\['+row+'\\]\\[td004\\]').val());
				return false;
			},
			focus: function(event, ui) {
				return false;
			}
		});
	}
	//查詢部門代號視窗
	function search_cmsi05_body_window(row_obj) {
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
			message: $('#divFcmsi05_body'),
			onOverlayClick: clear_cmsi05_body_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi05_body(me001, me002) {
		clear_row(selected_row);

		$('#order_product\\[' + selected_row + '\\]\\[cmsi05\\]').val(me001);
		$('#order_product\\[' + selected_row + '\\]\\[cmsi05_me002\\]').val(me002);

		$('#order_product\\[' + selected_row + '\\]\\[cmsi05\\]').focus();

		if (window.check_cmsi09_asti02_body) {
			check_cmsi09_asti02_body($('#order_product\\[' + selected_row + '\\]\\[cmsi05\\]'));
		}

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_body_sql"
		});
	}

	function clear_cmsi05_body_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi05/clear_body_sql"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_cmsi05_body(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[cmsi05\\]').val();

		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[cmsi05\\]').val('');
			$('#order_product\\[' + row + '\\]\\[cmsi05_me002\\]').val('');
			clear_row(row);
			return;
		}

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi05/lookup_body_check/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				me001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					$('#order_product\\[' + row + '\\]\\[cmsi05\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[cmsi05_me002\\]').val(data.message[0].value2);

					$('#order_product\\[' + row + '\\]\\[cmsi05\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[cmsi05\\]').val("查無資料");
					$('#order_product\\[' + row + '\\]\\[cmsi05\\]').focus();
				}
			}
		});
	}
	//ondblclick 按2下開視窗
	function search_cmsi05_window() {
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
			message: $('#divFcmsi05'),
			onOverlayClick: clear_cmsi05disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
<div id="divFcmsi05_body" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi05/display_child_body" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>