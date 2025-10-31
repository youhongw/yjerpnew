<script type="text/javascript">
	//查詢生產線別開視窗cmsi04 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi04disp").click(function() {
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
				message: $('#divFcmsi04'),
				onOverlayClick: clear_cmsi04disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#cmsi04').catcomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#cmsi04').val();
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi04/lookup_catcomplete/' + encodeURIComponent(smb001),
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
		// 			$('#cmsi04').val(ui.item.value1);
		// 			$('#cmsi04disp').text(ui.item.value2);
		// 			//console.log($('#cmsi04').val());
		// 			return false;
		// 		} else {
		// 			$('#cmsi04disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	focus: function(event, ui) {
		// 		return false;
		// 	}
		// });
	});

	function addcmsi04disp(smb001, smb002) {
		$('#cmsi04').val(smb001);
		$('#cmsi04disp').text(smb002);
		$('#cmsi04').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
		});
	}

	function clear_cmsi04disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_cmsi04(row_obj) {
		var sme001 = $('#cmsi04').val();
		if (!sme001) {
			$('#cmsi04disp').text("");
			return;
		}
		// console.log('cmsi04:' + sme001);
		var paragraph = document.querySelector('#cmsi04disp'); //改變顏色用
		$.ajax({
				method: 'POST',
				url: '<?php echo base_url(); ?>index.php/cms/cmsi04/lookup1_cmsi04/' + encodeURIComponent(sme001),
				data: {
					me001: row_obj.value
				}
			})
			.done(function(data) {
				console.log("check_cmsi04:" + data);
				// if (data.response == "true") {
				// 	if (data.message[0].value == "查無資料") {
				// 		$('#cmsi04').val("");
				// 		$('#cmsi04disp').text("查無資料");
				// 	}
				// 	$('#cmsi04').val(sme001);
				// 	$('#cmsi04disp').text(data.message[0].value2.trim());
				// } else {
				// 	$('#cmsi04').val(sme001);
				// 	$('#cmsi04disp').text("查無資料");
				// }
				$('#cmsi04disp').text(data);
				if (data == "查無資料") {
					$('#cmsi04').val("");
					paragraph.style.color = "red"; //改變顏色用
					return $('#cmsi04').focus();
				}
				paragraph.style.color = "black"; //改變顏色用
				return $('#td006').focus();
			});

	}
	//ondblclick 按2下開視窗
	function search_cmsi04_window() {
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
			message: $('#divFcmsi04'),
			onOverlayClick: clear_cmsi04disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
<div id="divFcmsi04" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi04/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>