<script type="text/javascript">
	//查詢廠別開視窗cmsi02 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showcmsi02disp").click(function() {
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '50%',
					width: '30%',
					overflow: 'hidden',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFcmsi02'),
				onOverlayClick: clear_cmsi02disp_sql
			});
			$('.close').click($.unblockUI);
		});
		//autoFocus: true 改 false 1060704
		// $('#cmsi02').catcomplete({
		//     autoFocus: false,
		// 	delay: 1000,
		//     minLength: 1,  		
		// 	source:
		// 	function(req, add){
		// 		var smb001= $('#cmsi02').val();
		// 		$('#cmsi02').attr('onchange','');
		// 		console.log(smb001);
		//         $.ajax({
		//             url: '<?php echo base_url(); ?>index.php/cms/cmsi02/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
		// 			$('#cmsi02').val(ui.item.value1);
		// 			$('#cmsi02disp').text(ui.item.value2);
		// 			//console.log($('#cmsi02').val());
		// 			return false;
		// 		}else{
		// 			$('#cmsi02disp').text("查無資料");
		// 			return false;
		// 		}

		// 	},
		// 	change: function(event, ui) {
		// 		$('#cmsi02').attr('onchange','check_cmsi02(this)');
		// 		check_cmsi02($('#cmsi02').val());
		// 		return false;
		// 	}
		// 	//focus: function(event, ui) {
		// 	//	return false;
		// 	//}
		// });
	});

	function addcmsi02disp(smb001, smb002) {
		//alert('test2');
		$('#cmsi02').val(smb001);
		$('#cmsi02disp').text(smb002);
		$('#cmsi05').focus();
		var paragraph = document.querySelector('#cmsi02disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi02/clear_sql"
		});
	}

	function clear_cmsi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi02/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_cmsi02(row_obj) {
		var smb001 = $('#cmsi02').val();
		if (!smb001) {
			$('#cmsi02disp').text("");
			return;
		}
		var paragraph = document.querySelector('#cmsi02disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$.ajax({
				url: '<?php echo base_url(); ?>index.php/cms/cmsi02/lookup2_cmsi02/' + encodeURIComponent(smb001),
				// cache: false,
				// dataType: 'json',
				// type: 'POST',
				method: "POST",
				data: {
					mb001: row_obj.value
				}
				// ,
				// success: function(data) {
				// 	if (data.response == "true") {
				// 		if (data.message[0].value == "查無資料") {
				// 			$('#cmsi02').val("");
				// 			$('#cmsi02disp').text("查無資料");
				// 		}
				// 		$('#cmsi02').val(smb001);
				// 		$('#cmsi02disp').text(data.message[0].value2);
				// 	} else {
				// 		$('#cmsi02').val(smb001);
				// 		$('#cmsi02disp').text("查無資料");
				// 	}
				// }
			})
			.done(function(msg) {
				console.log(msg);
				//回傳值顯示處理
				if (msg == '查無資料') {
					$('#cmsi02disp').text('查無資料');
					$('#cmsi02').val("");
					paragraph.style.color = "red"; //改變顏色用
					return $('#cmsi02').focus();
				} else {
					$('#cmsi02disp').text(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#cmsi05').focus();
				}

			});
	}
	//ondblclick 按2下開視窗
	function search_cmsi02_window() {
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
			message: $('#divFcmsi02'),
			onOverlayClick: clear_cmsi02disp_sql
		});
		$('.close').click($.unblockUI);
	}
</script>
<div id="divFcmsi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/cms/cmsi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>