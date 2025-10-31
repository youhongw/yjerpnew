  <?php include_once './application/views/head_v.php'; ?>

  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<h1>
  			<small><small><?php echo $systitle; ?></small></small>
  		</h1>
  		<ol class="breadcrumb">
  			<li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
  			<li class="active"><?php echo $systitle; ?></li>
  		</ol>
  	</section>



  	<!-- Main content -->
  	<section class="content">
  		<div class="row">
  			<div class="col-xs-12">

  				<!-- /.box -->
  				<?php
					$pk001 = $this->input->post('pk001');
					$pk002 = $this->input->post('pk002');
					$pk003 = $this->input->post('pk003');
					$pk004 = $this->input->post('pk004');
					$pk005 = $this->input->post('pk005');
					$pk006 = $this->input->post('pk006');
                     if(!isset($pk006)) { $pk006=date("Y/m/d"); }  
					?>
  				<div class="box">
  					<div class="box-header">
  						<!-- <h3 class="box-title">使用者 - 修改</h3>-->
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form action="<?php echo base_url() ?>index.php/sfc/sfcp03k/addsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

  							<div class="form-group form-inline"><label for="pk001" class="col-sm-1 control-label">產品品號</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" maxlength='20' onchange="check_invi02(this)" onKeyPress="keyFunction()" name="da001" value="<?php echo $pk001; ?>" id="da001" class="form-control" required />
  									<a href="javascript:;">
  										<span id="Showinvi02disp" class="glyphicon glyphicon-search"></span>
  									</a>
  									<span id="da001_disp"> </span>
  								</div>
  							</div>

  							<div class="form-group form-inline"><label for="pk002" class="col-sm-1 control-label">工價</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress="keyFunction()" name="pk002" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk002; ?>" id="pk002" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group form-inline"><label for="pk003" class="col-sm-1 control-label">每人每小時數量</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pk003" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk003; ?>" id="pk003" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pk004" class="col-sm-1 control-label">每顆時間/分</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pk004" value="<?php echo $pk004; ?>" id="pk004" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group form-inline"><label for="pk005" class="col-sm-1 control-label">備註</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" onKeyPress=" keyFunction()" name="pk005" value="<?php echo $pk005; ?>" id="pk005" class="form-control" />
  								</div>
  							</div>
                            <div class="form-group form-inline"><label for="pk006" class="col-sm-1 control-label">生效日期</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onchange="dateformat_ymd(this);" onKeyPress=" keyFunction()" name="pk006" value="<?php echo $pk006; ?>" id="pk006" class="form-control" />
                  <img  onclick="scwShow(pk006,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
				</div>
              </div>

  							<div class="form-group">
  								<div class="col-sm-offset-2 col-sm-11">
  									<div class="btn-group">

  										<button type="submit" class="btn btn-primary btn-flat">存檔</button>
  										<a href="<?php echo base_url() ?>index.php/sfc/sfcp03k/display" class="btn btn-warning btn-flat">上一頁</a>
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
  <!-- 產品品號 開窗 -->
  <?php include_once './application/views/funnew/invi02v_funmjs_v.php'; ?>



  <!-- 品號 -->
  <script type="text/javascript">
  	$(document).ready(function() {
  		$('#pk001').focus();
  	});
  </script>

  </body>

  </html>