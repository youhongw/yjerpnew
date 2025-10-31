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

				$ra004s = date("Y/m");
				$ra004d = $ra004s;
				$ra001 = '';
				$ra001disp = '';
				?>
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="<?php echo base_url() ?>index.php/inv/invr19a/write" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

							<!-- <div class="form-group form-inline">
								<label for="mq001" class="col-sm-1 control-label">製令單別</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" onchange="check_pnoa(this)" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='4' onKeyPress="keyFunction()" name="mq001" value="<?php echo $mq001; ?>" id="mq001" class="form-control" required />
									<a href="javascript:;">
										<span id="Showmoci01disp" class="glyphicon glyphicon-search"></span>
									</a>

									<span id="mq001_disp"> </span>
								</div>
							</div>

							<div class="form-group form-inline">
								<label for="mq002" class="col-sm-1 control-label">製令單號</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="2" style="width: 300px" onblur="check_pnob(this)" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='11' onKeyPress="keyFunction()" name="mq002" value="<?php echo $mq002; ?>" id="mq002" class="form-control" required />
									<span id="mq002_disp"> </span>
								</div>
							</div> -->


							<div class="form-group form-inline">
								<label for="process" class="col-sm-1 control-label">生產日期起</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" placeholder='yyyy/mm' onblur="dateformat_ym(this);" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" maxlength='7' onKeyPress=" keyFunction()" value="<?php echo $ra004s; ?>" id="ra004s" name="ra004s" class="form-control" />
									<!--	<img onclick="fPopCalendar(event,ra004s,ra004s);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" /> -->
								</div>
							</div>

							<div class="form-group form-inline">
								<label for="copies" class="col-sm-1 control-label">生產日期訖</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" placeholder='yyyy/mm' onblur="dateformat_ym(this);" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" maxlength='7' onKeyPress=" keyFunction()" value="<?php echo $ra004d; ?>" id="ra004d" name="ra004d" class="form-control" />
									<!-- <img onclick="scwShow(ra004d,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" /> -->
								</div>
							</div>

							<div class="form-group form-inline">
								<label for="copies" class="col-sm-1 control-label">配料品號</label>
								<div class="col-sm-11">
									<input tabIndex="1" id="invi02" style="width: 300px" onKeyPress="keyFunction()" name="ra001" onkeyup="this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='30' ondblclick="search_invi02i_window();" onblur="check_invi02i(this);" value="<?php echo $ra001; ?>" size="12" type="text" />
									<a href="javascript:;">
										<img id="Showinvi02idisp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" />
									</a>
									<span id="invi02disp">
										<?php echo $ra001disp; ?>
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-11">
									<div class="btn-group">

										<button type="submit" class="btn btn-primary btn-flat">匯出excel</button>
										<button type="submit" class="btn btn-primary btn-flat" name='action' value='exceletc' style="background-color: #9951e1;">匯出明細excel</button>
										<a href="<?php echo base_url() ?>index.php/inv/invr19a/displaym" class="btn btn-warning btn-flat">上一頁</a>
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
<?php include_once("./application/views/funnew/invi02v_funmjs_v.php"); ?>

<!-- 開視年月 -->
<script type="text/javascript">
	//function dateym(oInput){<!-- 
	$(function() {
		$('.date-picker').datepicker({
			showOn: 'button',
			buttonImageOnly: true,
			buttonImage: '<?php echo base_url() ?>assets/image/png/calendar.gif',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'yy/MM',
			monthNames: ['01', '02', '03', '04', '05', '06',
				'07', '08', '09', '10', '11', '12'
			],
			monthNamesShort: ['01', '02', '03', '04', '05', '06',
				'07', '08', '09', '10', '11', '12'
			],
			onClose: function(dateText, inst) {
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1));
			}
		});
	});
	//-->
</script>
<style>
	.ui-datepicker-calendar {
		display: none;
	}
</style>
<script type="text/javascript">
	//<!--  
	$(document).ready(function() {
		$(function() {
			$("input[id^='datepicker']").datepicker({
				showButtonPanel: true,
				dateFormat: 'yymmdd'
			});
		});
	});
	//-->
</script>



<script>
	function dateformat_ymd(oInput) { //年月日日期自動跳轉
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

	function dateformat_ym(oInput) { //年月日期自動跳轉
		temp = oInput.value.replace(/[^0-9]/g, "");
		if (!temp) {
			oInput.value = "";
			return;
		}
		var Today = new Date();
		var first = "2000";
		var mid = "  ";
		if (temp.substring(0, 4)) {
			first = temp.substring(0, 4);
		}
		if (temp.substring(4, 6)) {
			mid = temp.substring(4, 6);
		}
		if (first < 1900 && first > 0) {
			first = Today.getFullYear();
		}
		if (mid < 10 && mid > 0) {
			mid = "0" + (mid * 1);
		} else if (mid > 12) {
			mid = 12;
		} else if (mid <= 0) {
			mid = "01";
		}
		oInput.value = first + '/' + mid;
	}

	function dateformat_ymdtw(oInput) { //民國年月日日期自動跳轉
		temp = oInput.value.replace(/[^0-9]/g, "");
		var Today = new Date();
		var first = "020";
		var mid = "  ";
		var last = "  ";
		if (temp.substring(0, 3)) {
			first = temp.substring(0, 3);
		}
		if (temp.substring(3, 5)) {
			mid = temp.substring(3, 5);
		}
		if (temp.substring(5, 7)) {
			last = temp.substring(5, 7);
		}
		if (mid > 20) {
			last = temp.substring(4, 6);
		}
		if (first < '019' && first > 0) {
			first = Today.getFullYear() - 1911;
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
		if (first > 0) {
			oInput.value = first + '/' + mid + '/' + last;
		}
	}

	function dateformat_ymtw(oInput) { //民國年月日期自動跳轉
		temp = oInput.value.replace(/[^0-9]/g, "");
		var Today = new Date();
		var first = "2000";
		var mid = "  ";
		if (temp.substring(0, 3)) {
			first = temp.substring(0, 3);
		}
		if (temp.substring(3, 5)) {
			mid = temp.substring(3, 5);
		}
		if (first < 1900 && first > 0) {
			first = Today.getFullYear();
		}
		if (mid < 10 && mid > 0) {
			mid = "0" + (mid * 1);
		} else if (mid > 12) {
			mid = 12;
		} else if (mid <= 0) {
			mid = "01";
		}
		oInput.value = first + '/' + mid;
	}
</script>


</body>

</html>