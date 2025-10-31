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
				$mq001 = $this->input->post('mq001');
				$mq002 = $this->input->post('mq002');

				$process = $this->input->post('process');

				if (isset($copies)) {
					$copies = $this->input->post('copies');
				} else {
					$copies = '1';
				}



				?>
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="<?php echo base_url() ?>index.php/sfc/sfci03/printc" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

							<div class="form-group form-inline"><label for="mq001" class="col-sm-1 control-label">製令單別</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" onchange="check_pnoa(this)" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='4' onKeyPress="keyFunction()" name="mq001" value="<?php echo $mq001; ?>" id="mq001" class="form-control" required />
									<a href="javascript:;">
										<span id="Showmoci01disp" class="glyphicon glyphicon-search"></span>
									</a>

									<span id="mq001_disp"> </span>
								</div>
							</div>

							<div class="form-group form-inline"><label for="mq002" class="col-sm-1 control-label">製令單號</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="2" style="width: 300px" onblur="check_pnob(this)" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='11' onKeyPress="keyFunction()" name="mq002" value="<?php echo $mq002; ?>" id="mq002" class="form-control" required />
									<span id="mq002_disp"> </span>
								</div>
							</div>


							<div class="form-group form-inline"><label for="process" class="col-sm-1 control-label">工序</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="3" style="width: 300px" onblur="check_sfcta(this)" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='4' onKeyPress=" keyFunction()" name="process" value="<?php echo $process; ?>" id="process" class="form-control" />
									<span id="process_disp"> </span>
								</div>
							</div>

							<div class="form-group form-inline"><label for="copies" class="col-sm-1 control-label">列印份數</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="4" style="width: 300px" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='4' onKeyPress=" keyFunction()" name="copies" value="<?php echo $copies; ?>" id="copies" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-11">
									<div class="btn-group">

										<button type="submit" class="btn btn-primary btn-flat">列印</button>
										<!-- <a href="<?php echo base_url() ?>index.php/scm/admi00/display_sql" class="btn btn-warning btn-flat">上一頁</a> -->
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
<script type="text/javascript">
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