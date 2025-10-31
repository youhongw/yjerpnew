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

				$mq003 = $this->input->post('mq003');

				$copies = $this->input->post('copies');

				?>
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="<?php echo base_url() ?>index.php/scm/admi00/addsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

							<div class="form-group form-inline"><label for="mq001" class="col-sm-1 control-label">製令單別</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='4' onKeyPress="keyFunction()" name="mq001" value="<?php echo $mq001; ?>" id="mq001" class="form-control" required />
									<a href="javascript:;">
										<span id="Showmoci01disp" class="glyphicon glyphicon-search"></span>
									</a>
									<span id="mq001_disp"> </span>
								</div>
							</div>

							<div class="form-group form-inline"><label for="mq002" class="col-sm-1 control-label">製令單號</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="2" style="width: 300px" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='11' onKeyPress="keyFunction()" name="mq002" value="<?php echo $mq002; ?>" id="mq002" class="form-control" required />
								</div>
							</div>


							<div class="form-group form-inline"><label for="mq003" class="col-sm-1 control-label">工序</label>
								<div class="col-sm-11">
									<input type="text" tabIndex="3" style="width: 300px" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='4' onKeyPress=" keyFunction()" name="mq003" value="<?php echo $mq003; ?>" id="mq003" class="form-control" />
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


<!-- 共用函數 -->
<!-- 不更新網頁 自動提示方框資料google 提示前置小工具 
<script type="text/javascript">
	$.widget('custom.catcomplete', $.ui.autocomplete, {
		_renderMenu: function(ul, items) {
			var self = this,
				currentCategory = '';

			$.each(items, function(index, item) {
				if (item.category != currentCategory) {
					ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');

					currentCategory = item.category;
				}

				self._renderItem(ul, item);
			});
		}
	});
</script>-->
<?php //include_once './application/views/foot_brow_new_v.php'; ?>

<!-- 品號 -->
<script type="text/javascript">
	
     $(document).ready(function(){  
	 alert('test');
	$("#Showmoci01disp").click(function() {
		$.blockUI({ 	   
	css: { 	   
	top: '10%', 	   
	left: '15%', 	   
	height: '75%', 	   
	width: '75%', 	   
	overflow:'auto',  	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFormcopc08a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 
		
	});

	function clear_moci01disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql_new"
		});
	}
	
	}); 
</script>
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/moc/moci01/display_child_new_moci01" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
</body>

</html>