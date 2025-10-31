<script type="text/javascript">
	//查詢庫別開視窗cmsi03 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi03disp").click(function() {
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
				message: $('#divFcmsi03'),
				onOverlayClick: clear_cmsi03disp_sql
			});
			$('.close').click($.unblockUI);
		});
		$('#cmsi03').catcomplete({
			autoFocus: true,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#cmsi03').val();
				console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookup1_cmsi03/' + encodeURIComponent(smb001),
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
				if (ui.item.value != "查無資料") {
					$('#cmsi03').val(ui.item.value1);
					$('#cmsi03disp').text(ui.item.value2);
					//console.log($('#cmsi03').val());
					return false;
				} else {
					$('#cmsi03disp').text("查無資料");
					return false;
				}

			},
			focus: function(event, ui) {
				return false;
			}
		});
	});

	function addcmsi03disp(smb001, smb002) {
		$('#cmsi03').val(smb001);
		$('#cmsi03disp').text(smb002);
		$('#cmsi03').focus();
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
	//不更新網頁 輸入直接跳出中文
	function check_cmsi03(row_obj) {
		var sme001 = $('#cmsi03').val();
		if (!sme001) {
			$('#cmsi03disp').text("");
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookup2_cmsi03/' + encodeURIComponent(sme001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				me001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					if (data.message[0].value == "查無資料") {
						$('#cmsi03').val("");
						$('#cmsi03disp').text("查無資料");
					}
					$('#cmsi03').val(sme001);
					$('#cmsi03disp').text(data.message[0].value2);
				} else {
					$('#cmsi03').val(sme001);
					$('#cmsi03disp').text("查無資料");
				}
			}
		});
	}
	//ondblclick 按2下開視窗
	function search_cmsi03_window() {
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
			message: $('#divFcmsi03'),
			onOverlayClick: clear_cmsi03disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
<div id="divFcmsi03" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>