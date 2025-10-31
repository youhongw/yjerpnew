<script type="text/javascript">
	//查詢訂單性質開視窗sfci01 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showsfci01disp").click(function() {
			// console.log('comein');
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '30%',
					overflow: 'hidden',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFsfci01'),
				onOverlayClick: clear_sfci01disp_sql
			});
			$('.close').click($.unblockUI);
		});
	});

	function addsfci01disp(smb001, smb002) {
		var paragraph = document.querySelector('#sfci01disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用

		$('#sfci01').val(smb001);
		$('#sfci01disp').text(smb002);

		<?php
		$rms = trim($this->session->userdata('sysuserrms'));
		$super = trim($this->session->userdata('syssuper'));

		$prom10 = substr($rms, 10, 1);	// 10.鑄造-生產日報單建立作業
		$prom11 = substr($rms, 11, 1);	// 11.鑄造機加工-生產日報單建立作業 5.6.8.
		$prom12 = substr($rms, 12, 1);	// 12.橡膠-生產日報單建立作業 9.10.
		$prom13 = substr($rms, 13, 1);	// 13.注塑-生產日報單建立作業
		$prom14 = substr($rms, 14, 1);	// 14.PU-生產日報單建立作業
		$prom15 = substr($rms, 15, 1);	// 15.噴漆-生產日報單建立作業
		$prom16 = substr($rms, 16, 1);	// 16.衝壓-生產日報單建立作業
		$prom17 = substr($rms, 17, 1);	// 17.緊固件-生產日報單建立作業
		$prom18 = substr($rms, 18, 1);	// 18.電焊-生產日報單建立作業
		$prom19 = substr($rms, 19, 1);	// 19.鉚合-生產日報單建立作業
		$prom20 = substr($rms, 20, 1);	// 20.裝配-生產日報單建立作業
		$prom39 = substr($rms, 39, 1);	// 39.橡膠-萬馬力-生產日報單建立作業

		$prom24 = substr($rms, 24, 1); 	// 24.溶解生產記錄表; 1.
		$prom25 = substr($rms, 25, 1); 	// 25.CNC檢查表; 2.4.				

		$prom26 = substr($rms, 26, 1);	// 26.拋丸粗糙度測量表 7.
		?>
		vsuper = '<?php echo $super; ?>';

		if ((smb001 == 'D401' || smb001 == 'D501') && vsuper != 'Y') {
			vprom = '<?php echo $prom10; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D402' || smb001 == 'D502') && vsuper != 'Y') {
			vprom = '<?php echo $prom11; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if (smb001 == 'D403' && vsuper != 'Y') {
			vprom = '<?php echo $prom12; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D404' || smb001 == 'D504') && vsuper != 'Y') {
			vprom = '<?php echo $prom13; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D405' || smb001 == 'D505') && vsuper != 'Y') {
			vprom = '<?php echo $prom14; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D406' || smb001 == 'D506') && vsuper != 'Y') {
			vprom = '<?php echo $prom15; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D407' || smb001 == 'D507') && vsuper != 'Y') {
			vprom = '<?php echo $prom16; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D408' || smb001 == 'D508') && vsuper != 'Y') {
			vprom = '<?php echo $prom17; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D409' || smb001 == 'D509') && vsuper != 'Y') {
			vprom = '<?php echo $prom18; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D410' || smb001 == 'D510') && vsuper != 'Y') {
			vprom = '<?php echo $prom19; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if ((smb001 == 'D411' || smb001 == 'D511') && vsuper != 'Y') {
			vprom = '<?php echo $prom20; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		} else if (smb001 == 'D503' && vsuper != 'Y') {
			vprom = '<?php echo $prom39; ?>';
			if (vprom != 'Y') {
				paragraph.style.color = "red"; //改變顏色用
				$('#sfci01').val('');
				$('#sfci01disp').text('無此權限');
			}
		}



		$('#sfci01').focus();
		$('#cmsi04').val('');
		$('#cmsi04disp').text('');
		//check_sfci01(smb001);
		//console.log(smb001);
		chang_line();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci01/clear_sql"
		});
	}

	function clear_sfci01disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci01/clear_sql"
		});
	}

	//ondblclick 按2下開視窗
	function search_invi01_window() {
		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '30%',
				overflow: 'hidden',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFsfci01'),
			onOverlayClick: clear_sfci01disp_sql
		});
		$('.close').click($.unblockUI);
	}

	//不更新網頁 輸入直接跳出中文
	function check_sfci01(row_obj) {
		var smb001 = $('#sfci01').val();

		if (!smb001) {
			$('#sfci01disp').text("");
			return;
		}
		var paragraph = document.querySelector('#sfci01disp'); //改變顏色用
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/sfc/sfci01/lookup2_sfci01/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				// console.log("check_sfci01:" + msg);
				$('#sfci01disp').text(msg);
				paragraph.style.color = "black"; //改變顏色用

				if (msg == "查無資料") {
					paragraph.style.color = "red"; //改變顏色用
					$('#sfci01').val("");
					return $('#sfci01').focus();
				}
				<?php
				$rms = trim($this->session->userdata('sysuserrms'));
				$super = trim($this->session->userdata('syssuper'));

				$prom10 = substr($rms, 10, 1);	// 10.鑄造-生產日報單建立作業
				$prom11 = substr($rms, 11, 1);	// 11.鑄造機加工-生產日報單建立作業 5.6.8.
				$prom12 = substr($rms, 12, 1);	// 12.橡膠-生產日報單建立作業 9.10.
				$prom13 = substr($rms, 13, 1);	// 13.注塑-生產日報單建立作業
				$prom14 = substr($rms, 14, 1);	// 14.PU-生產日報單建立作業
				$prom15 = substr($rms, 15, 1);	// 15.噴漆-生產日報單建立作業
				$prom16 = substr($rms, 16, 1);	// 16.衝壓-生產日報單建立作業
				$prom17 = substr($rms, 17, 1);	// 17.緊固件-生產日報單建立作業
				$prom18 = substr($rms, 18, 1);	// 18.電焊-生產日報單建立作業
				$prom19 = substr($rms, 19, 1);	// 19.鉚合-生產日報單建立作業
				$prom20 = substr($rms, 20, 1);	// 20.裝配-生產日報單建立作業
				$prom39 = substr($rms, 39, 1);	// 39.橡膠-萬馬力-生產日報單建立作業

				$prom24 = substr($rms, 24, 1); 	// 24.溶解生產記錄表; 1.
				$prom25 = substr($rms, 25, 1); 	// 25.CNC檢查表; 2.4.				

				$prom26 = substr($rms, 26, 1);	// 26.拋丸粗糙度測量表 7.
				?>
				vsuper = '<?php echo $super; ?>';

				if ((smb001 == 'D401' || smb001 == 'D501') && vsuper != 'Y') {
					vprom = '<?php echo $prom10; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D402' || smb001 == 'D502') && vsuper != 'Y') {
					vprom = '<?php echo $prom11; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if (smb001 == 'D403' && vsuper != 'Y') {
					vprom = '<?php echo $prom12; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D404' || smb001 == 'D504') && vsuper != 'Y') {
					vprom = '<?php echo $prom13; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D405' || smb001 == 'D505') && vsuper != 'Y') {
					vprom = '<?php echo $prom14; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D406' || smb001 == 'D506') && vsuper != 'Y') {
					vprom = '<?php echo $prom15; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D407' || smb001 == 'D507') && vsuper != 'Y') {
					vprom = '<?php echo $prom16; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D408' || smb001 == 'D508') && vsuper != 'Y') {
					vprom = '<?php echo $prom17; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D409' || smb001 == 'D509') && vsuper != 'Y') {
					vprom = '<?php echo $prom18; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D410' || smb001 == 'D510') && vsuper != 'Y') {
					vprom = '<?php echo $prom19; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if ((smb001 == 'D411' || smb001 == 'D511') && vsuper != 'Y') {
					vprom = '<?php echo $prom20; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				} else if (smb001 == 'D503' && vsuper != 'Y') {
					vprom = '<?php echo $prom39; ?>';
					if (vprom != 'Y') {
						paragraph.style.color = "red"; //改變顏色用
						$('#sfci01').val('');
						$('#sfci01disp').text('無此權限');
					}
				}



				return $('#td008').focus();

			});
	}

	//新增多選開窗====================================================
	//查詢訂單性質開視窗sfci01 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showsfci01ddisp").click(function() {
			// console.log('comein');
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '30%',
					overflow: 'hidden',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFsfci01d'),
				onOverlayClick: clear_sfci01disp_sql
			});
			$('.close').click($.unblockUI);
		});
	});

	function addsfci01ddisp(smb001, smb002) {
		var paragraph = document.querySelector('#sfci01disp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#sfci01').val(smb001);
		$('#sfci01disp').text(smb002);
		$('#sfci01').focus();
		$('#cmsi04').val('');
		$('#cmsi04disp').text('');
		//check_sfci01(smb001);
		//console.log(smb001);
		chang_line();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci01/clear_sql"
		});
	}


	//ondblclick 按2下開視窗
	function search_invi01d_window() {
		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '30%',
				overflow: 'hidden',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFsfci01d'),
			onOverlayClick: clear_sfci01disp_sql
		});
		$('.close').click($.unblockUI);
	}

	//不更新網頁 輸入直接跳出中文
	function check_sfci01d(row_obj) {
		var smb001 = $('#sfci01').val();

		if (!smb001) {
			$('#sfci01disp').text("");
			return;
		}

		//與到有 ;  時就不用判斷
		if (smb001.includes(';')) {
			$('#sfci01disp').text("");
			return;
		}

		var paragraph = document.querySelector('#sfci01disp'); //改變顏色用
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/sfc/sfci01/lookup2_sfci01/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				// console.log("check_sfci01:" + msg);
				$('#sfci01disp').text(msg);
				if (msg == "查無資料") {
					paragraph.style.color = "red"; //改變顏色用
					$('#sfci01').val("");
					return $('#sfci01').focus();
				}
				paragraph.style.color = "black"; //改變顏色用
				return $('#td008').focus();

			});
	}
	/*console.log('sfci01:' + smb001);
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/sfc/sfci01/lookup2_sfci01/' + encodeURIComponent(smb001),
		cache: false,
		dataType: 'json',
		type: 'POST',
		data: {
			mb001: row_obj.value
		},
		success: function(data) {
			console.log('TEST');
			if(data.response == "true"){
			if(data.message[0].value=="查無資料"){
				$('#sfci01').val("");
				$('#sfci01disp').text("查無資料");
			}
			$('#sfci01').val(smb001);
			$('#sfci01dispp').text(data.message[0].value2);
		}else{
			$('#sfci01').val(smb001);
			$('#sfci01disp').text("查無資料");
		} */
	/*	if (data == "查無資料") {
			$('#sfci01').val("");
			$('#sfci01disp').text("查無資料");
		} else {
			//$('#sfci01disp').text(data);
			$('#sfci01disp').text(data.message[0].value2);
		} */
	// if (data.response == "true") {
	// 	if (data.message[0].value == "查無資料") {
	// 		$('#sfci01').val("");
	// 		$('#sfci01disp').text("查無資料");
	// 	}
	// 	$('#sfci01').val(smb001);
	// 	$('#sfci01disp').text(data.message[0].value2);
	// } else {
	// 	$('#sfci01').val(smb001);
	// 	$('#sfci01disp').text("查無資料");
	// }
	//	}
	//});
	//}

	$(document).ready(function() {
		$("#Showsfci01mdisp").click(function() {
			// console.log('comein');
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '30%',
					overflow: 'hidden',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFsfci01m'),
				onOverlayClick: clear_sfci01mdisp_sql
			});
			$('.close').click($.unblockUI);
		});
	});

	function addsfci01mdisp(smb001, smb002) {
		var paragraph = document.querySelector('#sfci01mdisp'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#sfci01m').val(smb001);
		$('#sfci01mdisp').text(smb002);
		$('#TB015').focus();
		$('#cmsi04').val('');
		$('#cmsi04disp').text('');
		//check_sfci01m(smb001);
		// console.log("addsfci01mdisp:" + smb001);
		// console.log("addsfci01mdisp:" + smb001);
		chang_line();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci01/clear_sqlm"
		});
	}

	function clear_sfci01mdisp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci01/clear_sqlm"
		});
	}
	//不更新網頁 輸入直接跳出中文
	function check_sfci01m(row_obj) {
		var smb001 = $('#sfci01m').val();

		if (!smb001) {
			$('#sfci01mdisp').text("");
			return;
		}
		var paragraph = document.querySelector('#sfci01mdisp'); //改變顏色用
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/sfc/sfci01/lookup2_sfci01m/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				console.log("check_sfci01m:" + msg);
				$('#sfci01mdisp').text(msg);
				if (msg == "查無資料") {
					paragraph.style.color = "red"; //改變顏色用
					$('#sfci01m').val("");
					return $('#sfci01m').focus();
				}
				paragraph.style.color = "black"; //改變顏色用
				return $('#TB015').focus();

			});
	}
</script>
<div id="divFsfci01" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/sfc/sfci01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
<div id="divFsfci01d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/sfc/sfci01/display_childd" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
<div id="divFsfci01m" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/sfc/sfci01/display_childm" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>