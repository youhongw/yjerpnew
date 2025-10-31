<?php include_once './application/views/head_v.php'; ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<small><small><?php echo $systitle; ?></small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
			<!--  <li><a href="<?php echo base_url() ?>assets/admin/groups">進貨入庫單</a></li> -->
			<li class="active"><?php echo $systitle; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">

				<!-- /.box -->
				<?php
				$TD008s = date("Y/m/d");
				$TD008d = $TD008s;
				$td001 = '';
				$td001disp = '';
				?>
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="<?php echo base_url() ?>index.php/sfc/sfci03/writer_dnew" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

							<div class="form-group form-inline">
								<label for="process" class="col-sm-1 control-label">生產日期起</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" onblur="dateformat_ymd(this);" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" maxlength='10' onKeyPress=" keyFunction()" value="<?php echo $TD008s; ?>" id="TD008s" name="TD008s" class="form-control" />
									<img onclick="scwShow(TD008s,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
								</div>
							</div>

							<div class="form-group form-inline">
								<label for="copies" class="col-sm-1 control-label">生產日期訖</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" onblur="dateformat_ymd(this);" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" maxlength='10' onKeyPress=" keyFunction()" value="<?php echo $TD008d; ?>" id="TD008d" name="TD008d" class="form-control" />
									<img onclick="scwShow(TD008d,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
								</div>
							</div>

							<div class="form-group form-inline">
								<label for="copies" class="col-sm-1 control-label">日報單別</label>
								<div class="col-sm-11">
									<input tabIndex="1" id="sfci01" style="width: 300px;background-color: #d5cece;" onKeyPress="keyFunction()" name="td001" onkeyup="this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='30' value="D404;D504;" size="12" type="text" readonly="readonly" />
									<!-- <a href="javascript:;">
										<img id="Showsfci01ddisp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" />
									</a>
									<span id="sfci01disp">
										<?php echo $td001disp; ?>
									</span> -->
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-11">
									<div class="btn-group">

										<button type="submit" class="btn btn-primary btn-flat">匯出excel</button>
										<a href="<?php echo base_url() ?>index.php/sfc/sfci03d/displayr" class="btn btn-warning btn-flat">上一頁</a>
										<a href="<?php echo base_url() ?>index.php/main" class="btn btn-default btn-flat">首頁</a>

									</div>

									<div class="success">
										<?php
										if ($message != '') {
											$message = '<b><font color="red">' . $message . '</font></b><br>';
										} else {
											$message = '<font color="blue">' . $message . '</font><br>';
										}
										?>
										<?php echo  '  提示訊息：' . $message ?>
									</div>

									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
							<!-- /.col -->
					</div>
					<!-- /.row -->
	</section>
	<!-- /.content -->
</div>

<?php include_once './application/views/foot_open_v.php'; ?>
<?php include_once './application/views/funnew/moci01b_funmjs_v.php'; ?>
<?php include_once("./application/views/funnew/sfci01_funmjs_v.php"); ?>
<script type="text/javascript">
	function dateformat_ymd(oInput) { //年月日日期自動跳轉
		console.log("dateformat_ymd:" + oInput);
		temp = oInput.value.replace(/[^0-9]/g, "");
		var Today = new Date();
		var first = "2000";
		var mid = "  ";
		var last = "  ";
		if (temp.substring(0, 4)) {
			first = temp.substring(0, 4);
		}
		if (temp.substring(4, 6)) {
			mid = temp.substring(4, 6);
		}
		if (temp.substring(6, 8)) {
			last = temp.substring(6, 8);
		}
		if (mid > 20) {
			last = temp.substring(5, 7);
		}
		if (first < 1900 && first > 0) {
			first = Today.getFullYear();
		}
		if (mid < 10 && mid > 0) {
			mid = "0" + (mid * 1);
		} else if (mid > 12) {
			mid = "0" + Math.floor(mid / 10);
		} else if (mid <= 0) {
			mid = "01";
		}
		var days = new Date(first, mid, 0).getDate();
		if (last < 10 && last > 0) {
			last = "0" + (last * 1);
		} else if (last <= 0) {
			last = "01";
		} else if (last > days) {
			last = days;
		}
		oInput.value = first + '/' + mid + '/' + last;
	}

	function check_pnoa(oinput) {
		var pnoa = $('#mq001').val();
		var pnoa = oinput.value;
		var paragraph = document.querySelector('#mq001_disp');
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/moc/moci01/check_pnoa/" + encodeURIComponent(pnoa),
				data: {
					mq001: pnoa
				}
			})
			.done(function(msg) {
				// console.log(msg);
				// console.log(msg == '查無品號');
				if (msg == '查無單別') {
					$('#mq001_disp').text(msg);
					paragraph.style.color = "red";
					return $('#mq001').focus();
				} else {
					$('#mq001_disp').text(msg);
					paragraph.style.color = "black";
					const words = msg.split(';');
					if (!$('#mq002').val()) {
						$('#mq002').val(<?php echo date("Ymd") . '001'; ?>);
					}
				}


			});
	}

	function check_pnob(oinput) {
		var mq001 = $('#mq001').val();
		var pnob = $('#mq002').val();
		var pnob = oinput.value;
		var paragraph = document.querySelector('#mq002_disp');
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/sfc/sfci04/check_pnob/" + encodeURIComponent(mq001) + "/" + encodeURIComponent(pnob),
				data: {
					mq001: $('#mq001').val(),
					mq002: pnob
				}
			})
			.done(function(msg) {
				// console.log(msg);
				// console.log(msg == '查無品號');
				if (msg == '查無單號') {
					$('#mq002_disp').text(msg);
					paragraph.style.color = "red";
					return $('#mq002').focus();
				} else if (msg == '單別錯誤') {
					$('#mq002_disp').text(msg);
					paragraph.style.color = "red";
					return $('#mq001').focus();
				} else {
					$('#mq002_disp').text('ok');
					paragraph.style.color = "black";
					return $('#mq003').focus();
				}


			});
	}

	function check_sfcta(oinput) {

		var mq001 = $('#mq001').val();
		var mq002 = $('#mq002').val();
		var ta003 = $('#process').val();
		var paragraph = document.querySelector('#process_disp');
		if (oinput.value != '') {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/sfc/sfci04/check_sfcta/" + encodeURIComponent(mq001) + "/" + encodeURIComponent(mq002) + "/" + encodeURIComponent(ta003),
					data: {
						mq001: $('#mq001').val(),
						mq002: $('#mq002').val(),
						ta003: $('#process').val()
					}
				})
				.done(function(msg) {
					// console.log(msg);
					// console.log(msg == '查無品號');
					if (msg == '查無工序') {
						$('#process_disp').text(msg);
						paragraph.style.color = "red";
						return $('#process').focus();
					} else {
						$('#process_disp').text('ok');
						paragraph.style.color = "black";
						return $('#copies').focus();
					}

				});
		} else {
			$('#process_disp').text('');
		}
	}
</script>


</body>

</html>