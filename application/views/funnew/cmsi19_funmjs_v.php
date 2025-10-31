<script type="text/javascript">
	//查詢製程代號開視窗cmsi19  4//下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi19disp").click(function() {
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
				message: $('#divFcmsi19'),
				onOverlayClick: clear_cmsi19disp_sql
			});
			$('.close').click($.unblockUI);
		});
		// $('#cmsi19').catcomplete({
		// 	autoFocus: true,
		// 	delay: 1000,
		// 	minLength: 1,
		// 	source: function(req, add) {
		// 		var smb001 = $('#cmsi19').val();
		// 		console.log(smb001);
		// 		$.ajax({
		// 			url: '<?php echo base_url(); ?>index.php/cms/cmsi19/lookup1_cmsi19/' + encodeURIComponent(smb001),
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
		// 			$('#cmsi19').val(ui.item.value1);
		// 			$('#cmsi19disp').text(ui.item.value2);
		// 			//console.log($('#cmsi19').val());
		// 			return false;
		// 		} else {
		// 			$('#cmsi19disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	focus: function(event, ui) {
		// 		return false;
		// 	}
		// });
	});

	function addcmsi19disp(smb001, smb002) {
		// $('#cmsi19').val(smb001);
		// $('#cmsi19disp').text(smb002);
		// console.log('da013:' + smb001);
		// console.log('da013disp:' + smb002);
		var paragraph = document.querySelector('#da013_disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#da013').val(smb001);
		$('#da013_disp').text(smb002);
		$('#da002').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql_term"
		});
	}

	function clear_cmsi19disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql_term"
		});
	}

	function check_cmsi19(row_obj) {
  		var smb001 = $('#da013').val();
  		var paragraph = document.querySelector('#da013_disp');
  		$('#da013').focus();
  		if (smb001 == "") {
  			$('#da013_disp').text('必填');
  			paragraph.style.color = "red";
  			return $('#da013').focus();
  		}

  		$.ajax({
  				method: "POST",
  				url: '<?php echo base_url(); ?>index.php/cms/cmsi19/check_key/' + encodeURIComponent(smb001),
  				data: {
  					mb001: smb001,
  				}
  			})
  			.done(function(msg) {
  				console.log(msg);
  				if (msg == 'N') {
  					$('#da013_disp').text('找不到製程代號');
  					paragraph.style.color = "red";
  					return $('#da013').focus();
  				} else if (msg == 'E') {
  					$('#da013_disp').text('必填');
  					paragraph.style.color = "red";
  					return $('#da013').focus();
  				} else {
  					$('#da013_disp').text(msg);
  					paragraph.style.color = "black";
  					return $('#da002').focus();
  				}

  			});
  	}
</script>
<div id="divFcmsi19" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi19/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>