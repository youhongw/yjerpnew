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
					$pg001 = $this->input->post('pg001');
					$pg002 = '2';
					$pg003 = $this->input->post('pg003');
					// $pg004 = '1';
					$pg005 = 0;
					$pg006 = 0;
					$pg007 = 0;
					$pg008 = 0;
					$pg009 = 0;
					$pg010 = 0;
					$pg011 = 0;
					$pg012 = 0;
					$pg013 = $this->input->post('pg013');

					?>
  				<div class="box">
  					<div class="box-header">
  						<!-- <h3 class="box-title">使用者 - 修改</h3>-->
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form action="<?php echo base_url() ?>index.php/sfc/sfcp03g/addsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

  							<div class="form-group form-inline"><label for="pg001" class="col-sm-1 control-label">產品品號</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" maxlength='20' onchange="check_invi02(this)" onKeyPress="keyFunction()" name="da001" value="<?php echo $pg001; ?>" id="da001" class="form-control" required />
  									<a href="javascript:;">
  										<span id="Showinvi02disp" class="glyphicon glyphicon-search"></span>
  									</a>
  									<span id="da001_disp"> </span>
  								</div>
  							</div>

  							<div class="form-group form-inline"><label for="pg002" class="col-sm-1 control-label">機台樣式（1.單衝; 2.連續）</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='1' onKeyPress="keyFunction()" name="pg002" onkeyup="this.value=this.value.replace(/[^1-2]/gi,'');" value="<?php echo $pg002; ?>" id="pg002" class="form-control" />
  								</div>
  							</div>

  							<div class="form-group form-inline"><label for="pg003" class="col-sm-1 control-label">系列別</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='20' onKeyPress=" keyFunction()" name="pg003" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" value="<?php echo $pg003; ?>" id="pg003" class="form-control" />
  								</div>
  							</div>

  							<!-- <div class="form-group form-inline"><label for="pg004" class="col-sm-1 control-label">專用機（1.專用; 2.非專用）</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="this.value=this.value.replace(/[^1-3]/gi,'');" onKeyPress=" keyFunction()" name="pg004" value="<?php echo $pg004; ?>" id="pg004" class="form-control" />
  								</div>
  							</div> -->



  							<div class="form-group form-inline"><label for="pg005" class="col-sm-1 control-label">上珠碗/底板波盤</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress="keyFunction()" name="pg005" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg005; ?>" id="pg005" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group form-inline"><label for="pg006" class="col-sm-1 control-label">下珠碗/齒碗</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pg006" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg006; ?>" id="pg006" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg007" class="col-sm-1 control-label">剎車踏板彈片</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg007" value="<?php echo $pg007; ?>" id="pg007" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg008" class="col-sm-1 control-label">剎車鉚合</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg008" value="<?php echo $pg008; ?>" id="pg008" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg009" class="col-sm-1 control-label">鉚固定座</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg009" value="<?php echo $pg009; ?>" id="pg009" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg010" class="col-sm-1 control-label">支架鉚合</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg010" value="<?php echo $pg010; ?>" id="pg010" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg011" class="col-sm-1 control-label">敲銅環</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg011" value="<?php echo $pg011; ?>" id="pg011" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg012" class="col-sm-1 control-label">其他</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg012" value="<?php echo $pg012; ?>" id="pg012" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group form-inline"><label for="pg013" class="col-sm-1 control-label">備註</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" onKeyPress=" keyFunction()" name="pg013" value="<?php echo $pg013; ?>" id="pg013" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group">
  								<div class="col-sm-offset-2 col-sm-11">
  									<div class="btn-group">

  										<button type="submit" class="btn btn-primary btn-flat">存檔</button>
  										<a href="<?php echo base_url() ?>index.php/sfc/sfcp03g/display" class="btn btn-warning btn-flat">上一頁</a>
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
  		$('#pg001').focus();
  	});
  </script>

  </body>

  </html>