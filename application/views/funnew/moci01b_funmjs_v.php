<script type="text/javascript">
	//查詢製令性質開視窗moci01 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showmoci01disp").click(function() {
			// console.log('comein');
			$.blockUI({
				theme: true,
				title: 'Can move',
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
				message: $('#divFmoci01'),
				onOverlayClick: clear_moci01disp_sql
			});
			$('.close').click($.unblockUI);
			// console.log('end');
		});
	});

	function clear_moci01disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql1"
		});
	}

	function addmoci01disp(MQ001, MQ002) {
		// alert(MQ002);
		$('#mq001').val(MQ001);
		$('#mq001_disp').text(MQ002);

		if (!$('#mq002').val()) {
			$('#mq002').val(<?php echo date("Ymd") . '001'; ?>);
		}

		$('#mq002').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/printdetailc"
		});
	}
</script>
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/moc/moci01/display_child1_moci01" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>