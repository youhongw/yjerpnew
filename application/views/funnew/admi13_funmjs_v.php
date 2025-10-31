<script type="text/javascript">
	//查詢庫別開視窗admi13 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showadmi13disp").click(function() {
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
				message: $('#divFadmi13'),
				onOverlayClick: clear_admi13disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#admi13').catcomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#admi13').val();
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/adm/admi13/lookup1_admi13/' + encodeURIComponent(smb001),
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
		// 			$('#admi13').val(ui.item.value1);
		// 			$('#admi13disp').text(ui.item.value2);
		// 			//console.log($('#admi13').val());
		// 			return false;
		// 		} else {
		// 			$('#admi13disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	focus: function(event, ui) {
		// 		return false;
		// 	}
		// });
	});

	function addadmi13disp(smb001, smb002) {

		$('#order_product\\[' + selected_row + '\\]\\[TE041\\]').val(smb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE041\\]').focus();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/admi13/clear_sql"
		});
	}

	function clear_admi13disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/admi13/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_admi13(row_obj) {
		var smm001 = $('#admi13').val();

		if (!smm001) {
			$('#admi13disp').text("");
			return $('#admi13').focus();
		}

		var paragraph = document.querySelector('#admi13disp'); //改變顏色用

		$.ajax({
				method: 'POST',
				url: '<?php echo base_url(); ?>index.php/scm/admi13/lookup2_admi13/' + encodeURIComponent(smm001),
				data: {
					mm001: smm001
				}
			})
			.done(function(msg) {
				// console.log('msg:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#admi13disp').text('找不到不良原因');
					paragraph.style.color = "red"; //改變顏色用
					// $('#admi13').val('');
					return $('#admi13').focus();
				} else {
					$('#admi13disp').text(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#mf005').focus();
				}

			});
	}

	function dupl() {
		var vmm001 = $('#mm001').val();
		// console.log("keyin:" + vmm001);
		var paragraph = document.querySelector('#mm001_disp'); //改變顏色用

		if (!vmm001) {
			$('#mm001_disp').text('必填');
			paragraph.style.color = "red"; //改變顏色用
			return $('#mm001').focus();
		}

		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/scm/admi13/check_key/" + encodeURIComponent(vmm001),
				data: {
					mm001: vmm001,
				}
			})
			.done(function(msg) {
				// console.log("out:" + msg);
				if (msg == 'N') {
					$('#mm001_disp').text('不良原因代號重複');
					paragraph.style.color = "red"; //改變顏色用
					return $('#mm001').focus();
				} else if (msg == 'E') {
					$('#mm001_disp').text('必填');
					paragraph.style.color = "red"; //改變顏色用
					return $('#mm001').focus();
				} else {
					$('#mm001_disp').text('ok');
					paragraph.style.color = "black"; //改變顏色用
					return $('#mm002').focus();
				}

			});
	}
	//ondblclick 按2下開視窗
	function search_admi13_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		selected_row = row;

		console.log('sfci01:' + $("#sfci01").val());

		$('#ad013_ifmain').attr('src', "<?php echo base_url() ?>index.php/scm/admi13/display_child/0/" + $("#sfci01").val());

		$.blockUI({
			theme: true,
			// title: 'Can move',
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
			message: $('#divFadmi13'),
			onOverlayClick: clear_admi13disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
</script>
<div id="divFadmi13" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="ad013_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/scm/admi13/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>