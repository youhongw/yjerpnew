<script type="text/javascript">
	//查詢品號開視窗invi02  //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02disp").click(function() {
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '70%',
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
		//autoFocus: true 改 false 1060704
		// $('#invi02').catcomplete({
		// $('#mf004').autocomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#invi02').val();
		// 		//	$('#invi02').attr('onchange','');
		// 		var smb001 = $('#mf004').val();
		// 		$('#mf004').attr('onchange', '');
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd_invi02/' + encodeURIComponent(smb001),
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
		// 			$('#invi02').val(ui.item.value1);

		// 			$('#mf004').val(ui.item.value1);
		// 			$('#mf006').val(ui.item.value2);
		// 			$('#mf007').val(ui.item.value3);
		// 			$('#mf008').val(ui.item.value4);

		// 			$('#invi02disp').text(ui.item.value2);
		// 			$('#mc001disp').text(ui.item.value2);
		// 			$('#mc001disp1').text(ui.item.value3);
		// 			$('#mc002').text(ui.item.value4);
		// 			$('#mc003').text(ui.item.value5);
		// 			$('#mc001disp4').text(ui.item.value6);

		// 			$('#tf004disp').val(ui.item.value2); //bomi06
		// 			$('#tf004disp1').val(ui.item.value3);
		// 			$('#tf005').val(ui.item.value4);
		// 			//console.log($('#invi02').val());
		// 			return false;
		// 		} else {
		// 			//$('#invi02disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	change: function(event, ui) {
		// 		//$('#invi02').attr('onchange','check_invi02(this)');
		// 		//check_invi02($('#invi02').val());
		// 		event.preventDefault();
		// 		// $('#mf004').val()=$("#mf004").val(ui.item.value);

		// 		$('#mf004').attr('onchange', 'check_invi02(this)');
		// 		check_invi02($('#mf004').val());

		// 		return false;
		// 	}
		// 	//focus: function(event, ui) {
		// 	//	return false;
		// 	//}
		// });
	});

	$(document).ready(function() {
		$("#order1").click(function() {
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '70%',
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

	function addinvi02disp(smb001, smb002, smb003, smb004, smb005) {
		//alert('test2');
		var paragraph = document.querySelector('#invi02disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#invi02').val(smb001);
		$('#invi02disp').text(smb002);
		$('#mc001disp').val(smb002);
		$('#mc001disp1').val(smb003);
		$('#mc002').val(smb004);
		if (document.getElementById("mc002"))
			$('#mc002').focus();

		$('#cmsi03').val(smb005);



		if (document.getElementById("ta017")) {
			remove_row();
			$('#ta017').val('');
			$('#ta029').val('');
			$('#ta017').focus();
		}

		// $('#mc003').val(smb005);
		// $('#mc001disp4').val(smb006);

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
		//$('#tb006').val(smb002);  //sfci05
		// $('#invi02').focus();
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
	//不更新網頁 輸入直接跳出中文
	function check_invi02(row_obj) {
		var smb001 = $('#invi02').val();
		// var smb001 = $('#mf004').val();
		var paragraph = document.querySelector('#invi02disp'); //改變顏色用
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
	//ondblclick 按2下開視窗
	function search_invi02_window() {
		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '70%',
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
	}
</script>
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childe" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>