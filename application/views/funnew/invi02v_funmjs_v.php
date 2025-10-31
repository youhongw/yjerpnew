<script type="text/javascript">
	//查詢品號類別開視窗invi02  4//下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02disp").click(function() {
			// $.blockUI({
			// 	theme: true,
			// 	themedCSS: {
			// 		top: '15%',
			// 		left: '25%',
			// 		height: '75%',
			// 		width: '50%',
			// 		overflow: 'hidden',
			// 		'-webkit-border-radius': '10px',
			// 		'-moz-border-radius': '10px',
			// 		'-khtml-border-radius': '10px',
			// 		'border-radius': '10px',
			// 	},
			// 	message: $('#divFinvi02'),
			// 	onOverlayClick: clear_invi02disp_sql
			// });
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
				message: $('#divFinvi02'),
				onOverlayClick: clear_invi02disp_sql
			});
			$('.close').click($.unblockUI);
		});
	});

	function addinvi02adisp(smb001, smb002, smb003, smb004) {
		// $('#invi02').val(smb001);
		// $('#invi02disp').text(smb002);
		var paragraph = document.querySelector('#da001_disp');
		paragraph.style.color = "black";
		// console.log('da001:' + smb001);
		// console.log('da001_disp:' + smb002);
		$('#da001').val(smb001);
		$('#da001_disp').text(smb002);
		$('#da013').focus();
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
		var smb001 = $('#da001').val();
		var paragraph = document.querySelector('#da001_disp');

		if (!smb001) {
			$('#da001_disp').text('必填');
			paragraph.style.color = "red";
			return $('#da001').focus();
		}

		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/inv/invi02/check_key/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				// console.log(msg);
				if (msg == 'N') {
					$('#da001_disp').text('找不到產品品號');
					paragraph.style.color = "red";
					return $('#da001').focus();
				} else if (msg == 'E') {
					$('#da001_disp').text('必填');
					paragraph.style.color = "red";
					return $('#da001').focus();
				} else {
					$('#da001_disp').text(msg);
					paragraph.style.color = "black";
					return $('#da002').focus();
				}

			});
	}

	//查詢配料品號類別開視窗invi02  4//下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02idisp").click(function() {
			// $.blockUI({
			// 	theme: true,
			// 	themedCSS: {
			// 		top: '15%',
			// 		left: '25%',
			// 		height: '75%',
			// 		width: '50%',
			// 		overflow: 'hidden',
			// 		'-webkit-border-radius': '10px',
			// 		'-moz-border-radius': '10px',
			// 		'-khtml-border-radius': '10px',
			// 		'border-radius': '10px',
			// 	},
			// 	message: $('#divFinvi02'),
			// 	onOverlayClick: clear_invi02disp_sql
			// });
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
				message: $('#divFinvi02i'),
				onOverlayClick: clear_invi02disp_sql
			});
			$('.close').click($.unblockUI);
		});
	});

	function addinvi02iadisp(smb001, smb002, smb003, smb004) {
		// $('#invi02').val(smb001);
		// $('#invi02disp').text(smb002);
		if (document.getElementById("da016_disp")) {
			var paragraph = document.querySelector('#da016_disp');
			paragraph.style.color = "black";
		}
		if (document.getElementById("invi02disp")) {
			var paragraph1 = document.querySelector('#invi02disp');
			paragraph1.style.color = "black";
		}

		// console.log('da001:' + smb001);
		// console.log('da001_disp:' + smb002);
		$('#mc001disp').val(smb002);
		$('#mc001disp1').val(smb003);
		$('#mc002').val(smb004);

		$('#da016').val(smb001);
		$('#da016_disp').text(smb002);
		$('#invi02').val(smb001);
		$('#invi02disp').text(smb002);

		$('#mf004').val(smb001);
		$('#mf006').val(smb002);
		$('#mf007').val(smb003);
		$('#mf008').val(smb004);
		//$('#mf002').val(smb007);
		//$('#mf003').val(smb008);

		$('#td004disp').val(smb002); //bomi05
		$('#td004disp1').val(smb003);
		$('#td005').val(smb004);

		$('#tf004disp').val(smb002); //bomi06
		$('#tf004disp1').val(smb003);
		$('#tf005').val(smb004);

		$('#ta034').val(smb002);
		$('#ta035').val(smb003);
		$('#ta007').val(smb004);
		// $('#da013').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}


	function check_invi02i(row_obj) {

		if (document.getElementById("da016_disp")) {
			var paragraph = document.querySelector('#da016_disp');
			paragraph.style.color = "black";

			var smb001 = $('#da016').val();

			if (!smb001) {
				paragraph.style.color = "red"; //改變顏色用

				$('#invi02disp').text("不可空白");
				$('#ta034').val('');
				$('#ta035').val('');
				$('#ta017').val('');
				$('#ta029').val('');
				remove_row();
				return $('#invi02').focus();
			}
		}

		if (document.getElementById("invi02disp")) {
			var paragraph = document.querySelector('#invi02disp');
			paragraph.style.color = "black";

			var smb001 = $('#invi02').val();

			if (!smb001) {
				$('#invi02disp').text("不可空白");
				$('#ta034').val('');
				$('#ta035').val('');
				$('#ta017').val('');
				$('#ta029').val('');
				remove_row();
				return $('#invi02').focus();
			}
		}



		$.ajax({
			url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup_check/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				mb001: row_obj.value
			},
			success: function(data) {
				remove_row();
				if (data.response) {
					paragraph.style.color = "black"; //改變顏色用
					//if(data.message[0].value=="查無資料"){
					//	$('#invi02').val("");
					//	$('#invi02disp').text("查無資料");
					//}
					$('#invi02').val(smb001);
					$('#mf004').val(smb001);
					$('#mf006').val(data.invi02disp);
					$('#mf007').val(data.ta035);
					$('#mf008').val(data.ta007);

					//	$('#mf002').val(data.message[0].value7);
					//	$('#mf003').val(data.message[0].value8);
					$('#invi02disp').text(data.invi02disp);
					$('#mc001disp').val(data.invi02disp);
					$('#mc001disp1').val(data.ta035);
					$('#mc002').val(data.ta007);
					// $('#mc003').val(data.message[0].value5);
					// $('#mc001disp4').val(data.message[0].value6);

					$('#tf004disp').val(data.invi02disp); //bomi06
					$('#tf004disp1').val(data.ta035);
					$('#tf005').val(data.ta007);

					$('#ta034').val(data.invi02disp);
					$('#ta035').val(data.ta035);
					$('#ta007').val(data.ta007);
					$('#cmsi03').val(data.cmsi03);


					if (document.getElementById("ta017")) //查詢此ID是否存在
					{
						$('#ta017').val('');
						$('#ta029').val('');
						return $('#ta017').focus();
					}


				} else {
					paragraph.style.color = "red"; //改變顏色用
					$('#invi02disp').text(data.invi02disp);
					$('#ta034').val('');
					$('#ta035').val('');
					$('#ta007').val('');
					$('#ta017').val('');
					$('#ta029').val('');
					$('#cmsi03').val('');
					return $('#invi02').focus();
					//$('#invi02').val(smb001);
					//$('#invi02disp').text("查無資料");
				}
			}
		});
	}
</script>
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
<div id="divFinvi02i" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childi" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>