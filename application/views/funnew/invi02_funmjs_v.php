<script language="javascript">
	//不更新網頁, 帶出資料按enter 自動找到名稱
	var xmlHttp;

	function createXMLHttpRequest() { //不更新網頁 判斷適用各種流覽器 共用 (全域)
		if (window.ActiveXObject)
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		else if (window.XMLHttpRequest)
			xmlHttp = new XMLHttpRequest();
	}

	function showinvi02a(sText) { //不更新網頁 2  品號類別 
		var oSpan = document.getElementById("invi02adisp");
		oSpan.innerHTML = "<span style='color:black'>" + sText + "</span>";
		if (!sText) {
			var invi02a = document.getElementById("invi02a");
			startinvi02a(invi02a);
		}
		if (sText == '') {
			oSpan.innerHTML = "<span style='color:red'>無此資料!</span>";
		}
	}

	function showinvi02b(sText) { //不更新網頁 2  品號類別 
		var oSpan = document.getElementById("invi02bdisp");
		oSpan.innerHTML = "<span style='color:black'>" + sText + "</span>";
		if (!sText) {
			var invi02b = document.getElementById("invi02b");
			startinvi02b(invi02b);
		}
		if (sText == '') {
			oSpan.innerHTML = "<span style='color:red'>無此資料!</span>";
		}
	}

	function showinvi02c(sText) { //不更新網頁 3  品號類別 
		var oSpan = document.getElementById("invi02cdisp");
		oSpan.innerHTML = "<span style='color:black'>" + sText + "</span>";
		if (!sText) {
			var invi02c = document.getElementById("invi02c");
			startinvi02c(invi02c);
		}
		if (sText == '') {
			oSpan.innerHTML = "<span style='color:red'>無此資料!</span>";
		}
	}

	function showinvi02d(sText) { //不更新網頁 4  品號類別 
		var oSpan = document.getElementById("invi02ddisp");
		oSpan.innerHTML = "<span style='color:black'>" + sText + "</span>";
		if (!sText) {
			var invi02d = document.getElementById("invi02d");
			startinvi02d(invi02d);
		}
		if (sText == '') {
			oSpan.innerHTML = "<span style='color:red'>無此資料!</span>";
		}
	}

	function startinvi02a(oInput) { //不更新網頁 1 品號會計類別
		//建立非同步請求

		createXMLHttpRequest();
		var sUrl = "<?php echo base_url() ?>index.php/inv/invi02/checkinvi02/" + encodeURIComponent(oInput.value) + "/" + new Date().getTime();
		var QueryString = encodeURIComponent(oInput.value);

		//xmlHttp.open("GET",sUrl,true);	
		xmlHttp.open("POST", sUrl);
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.send(QueryString);

		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				showinvi02a(xmlHttp.responseText);
			} //顯示服務器結果	
		}
		//xmlHttp.send(null);
	}

	function startinvi02b(oInput) { //不更新網頁 2 品號類別
		//建立非同步請求

		createXMLHttpRequest();
		var sUrl = "<?php echo base_url() ?>index.php/inv/invi02/checkinvi02/" + encodeURIComponent(oInput.value) + "/" + new Date().getTime();
		var QueryString = encodeURIComponent(oInput.value);

		//xmlHttp.open("GET",sUrl,true);	
		xmlHttp.open("POST", sUrl);
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.send(QueryString);

		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				showinvi02b(xmlHttp.responseText);
			} //顯示服務器結果	
		}
		//xmlHttp.send(null);
	}

	function startinvi02c(oInput) { //不更新網頁 3 品號類別
		//建立非同步請求

		createXMLHttpRequest();
		var sUrl = "<?php echo base_url() ?>index.php/inv/invi02/checkinvi02/" + encodeURIComponent(oInput.value) + "/" + new Date().getTime();
		var QueryString = encodeURIComponent(oInput.value);

		//xmlHttp.open("GET",sUrl,true);	
		xmlHttp.open("POST", sUrl);
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.send(QueryString);

		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				showinvi02c(xmlHttp.responseText);
			} //顯示服務器結果	
		}
		//xmlHttp.send(null);
	}

	function startinvi02d(oInput) { //不更新網頁 4 品號類別
		//建立非同步請求

		createXMLHttpRequest();
		var sUrl = "<?php echo base_url() ?>index.php/inv/invi02/checkinvi02/" + encodeURIComponent(oInput.value) + "/" + new Date().getTime();
		var QueryString = encodeURIComponent(oInput.value);

		//xmlHttp.open("GET",sUrl,true);	
		xmlHttp.open("POST", sUrl);
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.send(QueryString);

		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				showinvi02d(xmlHttp.responseText);
			} //顯示服務器結果	
		}
		//xmlHttp.send(null);
	}
</script>

<script type="text/javascript">
	//查詢品號類別開視窗invi02 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02adisp").click(function() {
			console.log('inv01a');
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '70%',
					overflow: 'auto',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFinvi02a'),
				onOverlayClick: clear_invi02adisp_sql
			});
			$('.close').click($.unblockUI);
		});
		$('#invi02a').catcomplete({
			autoFocus: true,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#invi02a').val();
				//console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup1_invi02a/' + encodeURIComponent(smb001),
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
					$('#invi02a').val(ui.item.value1);
					$('#invi02adisp').text(ui.item.value2);
					//	$('#invi02a').focus();
					//console.log($('#invi02').val());
					return false;
				} else {
					$('#invi02adisp').text("查無資料");
					return false;
				}

			},
			focus: function(event, ui) {
				//   $('#invi02a').focus();
				return false;
			}
		});
	});

	function addinvi02adisp(smb001, smb002, smb003, smb004) {
		$('#invi02a').val(smb001);
		$('#invi02adisp').text(smb002);
		$('#mb001disp').val(smb002);
		$('#mb001disp1').val(smb003);
		$('#mb002').val(smb004);
		$('#invi02a').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function clear_invi02adisp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}
	//不更新網頁 輸入直接跳出中文a
	function check_invi02a(row_obj) {
		var sme001 = $('#invi02a').val();
		if (!sme001) {
			$('#invi02adisp').text("");
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup2_invi02a/' + encodeURIComponent(sme001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				me001: row_obj.value
			},
			success:
				//  console.log(sme001);		
				function(data) {
					if (data.response == "true") {
						if (data.message[0].value == "查無資料") {
							$('#invi02a').val("");
							$('#invi02adisp').text("查無資料");
						}
						console.log(sme001);
						$('#invi02a').val(sme001);
						$('#invi02adisp').text(data.message[0].value2);
					} else {
						$('#invi02a').val(sme001);
						$('#invi02adisp').text("查無資料");
					}
				}
		});
	}
</script>
<div id="divFinvi02a" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<script type="text/javascript">
	//查詢品號類別開視窗invi02  2//下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02bdisp").click(function() {
			console.log('inv01b');
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
				message: $('#divFinvi02b'),
				onOverlayClick: clear_invi02bdisp_sql
			});
			$('.close').click($.unblockUI);
		});
		$('#invi02b').catcomplete({
			autoFocus: true,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#invi02b').val();
				console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup1_invi02b/' + encodeURIComponent(smb001),
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
					$('#invi02b').val(ui.item.value1);
					$('#invi02bdisp').text(ui.item.value2);
					//console.log($('#invi02').val());
					return false;
				} else {
					$('#invi02bdisp').text("查無資料");
					return false;
				}

			},
			focus: function(event, ui) {
				return false;
			}
		});
	});

	function addinvi02bdisp(smb001, smb002) {
		$('#invi02b').val(smb001);
		$('#invi02bdisp').text(smb002);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function clear_invi02bdisp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}
</script>
<div id="divFinvi02b" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<script type="text/javascript">
	//查詢品號類別開視窗invi02  3//下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02cdisp").click(function() {
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
				message: $('#divFinvi02c'),
				onOverlayClick: clear_invi02cdisp_sql
			});
			$('.close').click($.unblockUI);
		});
		$('#invi02c').catcomplete({
			autoFocus: true,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#invi02c').val();
				console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup1_invi02c/' + encodeURIComponent(smb001),
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
					$('#invi02c').val(ui.item.value1);
					$('#invi02cdisp').text(ui.item.value2);
					//console.log($('#invi02').val());
					return false;
				} else {
					$('#invi02cdisp').text("查無資料");
					return false;
				}

			},
			focus: function(event, ui) {
				return false;
			}
		});
	});

	function addinvi02cdisp(smb001, smb002) {
		$('#invi02c').val(smb001);
		$('#invi02cdisp').text(smb002);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function clear_invi02cdisp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}
</script>
<div id="divFinvi02c" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/displayc_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<script type="text/javascript">
	//查詢品號類別開視窗invi02  4//下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showinvi02ddisp").click(function() {
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
				message: $('#divFinvi02d'),
				onOverlayClick: clear_invi02cdisp_sql
			});
			$('.close').click($.unblockUI);
		});
		$('#invi02d').catcomplete({
			autoFocus: true,
			delay: 1000,
			minLength: 1,
			source: function(req, add) {
				var smb001 = $('#invi02d').val();
				console.log(smb001);
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/inv/invi02/lookup1_invi02d/' + encodeURIComponent(smb001),
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
					$('#invi02d').val(ui.item.value1);
					$('#invi02ddisp').text(ui.item.value2);
					//console.log($('#invi02').val());
					return false;
				} else {
					$('#invi02ddisp').text("查無資料");
					return false;
				}

			},
			focus: function(event, ui) {
				return false;
			}
		});
	});

	function addinvi02ddisp(smb001, smb002) {
		$('#invi02d').val(smb001);
		$('#invi02ddisp').text(smb002);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function clear_invi02ddisp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}
</script>
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>