<script type="text/javascript">
	//查詢庫別開視窗admi04 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showadmi04disp").click(function() {
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
				message: $('#divFadmi04'),
				onOverlayClick: clear_admi04disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#admi04').catcomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#admi04').val();
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/adm/admi04/lookup1_admi04/' + encodeURIComponent(smb001),
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
		// 			$('#admi04').val(ui.item.value1);
		// 			$('#admi04disp').text(ui.item.value2);
		// 			//console.log($('#admi04').val());
		// 			return false;
		// 		} else {
		// 			$('#admi04disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	focus: function(event, ui) {
		// 		return false;
		// 	}
		// });
	});

	function addadmi04disp(smb001, smb002) {
		var paragraph = document.querySelector('#admi04disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#admi04').val(smb001);
		$('#admi04disp').text(smb002);
		$('#admi04').focus();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/admi04/clear_sql"
		});
	}

	function clear_admi04disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/admi04/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_admi04(row_obj) {
		var sme001 = $('#admi04').val();

		if (!sme001) {
			$('#admi04disp').text("");
			return $('#admi04').focus();
		}

		var paragraph = document.querySelector('#admi04disp'); //改變顏色用

		$.ajax({
				method: 'POST',
				url: '<?php echo base_url(); ?>index.php/scm/admi04/lookup2_admi04/' + encodeURIComponent(sme001),
				data: {
					me001: sme001
				}
			})
			.done(function(msg) {
				// console.log('msg:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#admi04disp').text('找不到群組');
					paragraph.style.color = "red"; //改變顏色用
					// $('#admi04').val('');
					return $('#admi04').focus();
				} else {
					$('#admi04disp').text(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#mf005').focus();
				}

			});
	}

	function dupl() {
		var vme001 = $('#me001').val();
		// console.log("keyin:" + vme001);
		var paragraph = document.querySelector('#me001_disp'); //改變顏色用

		if (!vme001) {
			$('#me001_disp').text('必填');
			paragraph.style.color = "red"; //改變顏色用
			return $('#me001').focus();
		}

		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/scm/admi04/check_key/" + encodeURIComponent(vme001),
				data: {
					me001: vme001,
				}
			})
			.done(function(msg) {
				// console.log("out:" + msg);
				if (msg == 'N') {
					$('#me001_disp').text('群組代號重複');
					paragraph.style.color = "red"; //改變顏色用
					return $('#me001').focus();
				} else if (msg == 'E') {
					$('#me001_disp').text('必填');
					paragraph.style.color = "red"; //改變顏色用
					return $('#me001').focus();
				} else {
					$('#me001_disp').text('ok');
					paragraph.style.color = "black"; //改變顏色用
					return $('#me002').focus();
				}

			});
	}
	//ondblclick 按2下開視窗
	function search_admi04_window() {
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
			message: $('#divFadmi04'),
			onOverlayClick: clear_admi04disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
</script>
<div id="divFadmi04" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/scm/admi04/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>