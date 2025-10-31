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
					$mm001 = $this->input->post('mm001');

					$mm002 = $this->input->post('mm002');

					$mm003 = $this->input->post('mm003');

					$mm004 = $this->input->post('mm004');

					$mm005 = $this->input->post('mm005');

					$mm006 = $this->input->post('mm006');

					$mm007 = $this->input->post('mm007');

					?>
  				<div class="box">
  					<div class="box-header">
  						<!-- <h3 class="box-title">群組 - 修改</h3>-->
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form action="<?php echo base_url() ?>index.php/scm/admi13/addsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

  							<div class="form-group form-inline"><label for="mm001" class="col-sm-1 control-label">不良原因代號</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='4' onblur="dupl(this)" onKeyPress="keyFunction()" name="mm001" value="<?php echo $mm001; ?>" id="mm001" class="form-control" required />
  									<span id="mm001_disp"> </span>
  								</div>
  							</div>

  							<div class="form-group form-inline"><label for="mm002" class="col-sm-1 control-label">不良原因名稱</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="2" style="width: 300px" maxlength='15' onKeyPress="keyFunction()" name="mm002" value="<?php echo $mm002; ?>" id="mm002" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group form-inline"><label for="mm003" class="col-sm-1 control-label">備註</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="3" style="width: 300px" onKeyPress=" keyFunction()" name="mm003" value="<?php echo $mm003; ?>" id="mm003" class="form-control" />
  								</div>
  							</div>




  							<div class="form-group">
  								<div class="col-sm-offset-2 col-sm-11">
  									<div class="btn-group">

  										<button type="submit" class="btn btn-primary btn-flat">存檔</button>
  										<a href="<?php echo base_url() ?>index.php/scm/admi13/display" class="btn btn-warning btn-flat">上一頁</a>
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
  <?php include_once './application/views/foot_open_v.php'; ?>
  <?php include_once './application/views/funnew/admi13_funmjs_v.php'; ?>
  </body>

  </html>

  <script>
  	$(document).ready(function() {
  		$('#mm001').focus();
  	});
  </script>