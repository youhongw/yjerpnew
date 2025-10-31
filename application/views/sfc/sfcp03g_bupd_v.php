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
					$pg001 = '';
					$pg002 = '';
					$pg003 = '';
					$pg004 = '';
					$pg005 = '';
					$pg006 = '';
					$pg007 = '';
					$pg008 = '';
					$pg009 = '';
					$pg010 = '';
					$pg011 = '';
					$pg012 = '';
					$pg013 = $this->input->post('pg013');

					?>
  				<div class="box">
  					<div class="box-header">
  						<!-- <h3 class="box-title">使用者 - 修改</h3>-->
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form action="<?php echo base_url() ?>index.php/sfc/sfcp03g/bupdsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">



  							<div class="form-group form-inline"><label for="pg003" class="col-sm-1 control-label">系列別</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" maxlength='20' onKeyPress=" keyFunction()" name="pg003" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" value="<?php echo $pg003; ?>" id="pg003" class="form-control" />
  									輸入正確之系列別，並在下列欲更新之工價輸入資料。
  								</div>
  							</div>





  							<div class="form-group form-inline"><label for="pg005" class="col-sm-1 control-label">上珠碗/底板波盤</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onKeyPress="keyFunction()" name="pg005" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg005; ?>" id="pg005" class="form-control" />
  								</div>
  							</div>


  							<div class="form-group form-inline"><label for="pg006" class="col-sm-1 control-label">下珠碗/齒碗</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pg006" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg006; ?>" id="pg003" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg007" class="col-sm-1 control-label">剎車踏板彈片</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg007" value="<?php echo $pg007; ?>" id="pg004" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg008" class="col-sm-1 control-label">剎車鉚合</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg008" value="<?php echo $pg008; ?>" id="pg004" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg009" class="col-sm-1 control-label">鉚固定座</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg009" value="<?php echo $pg009; ?>" id="pg004" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg010" class="col-sm-1 control-label">支架鉚合</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg010" value="<?php echo $pg010; ?>" id="pg004" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg011" class="col-sm-1 control-label">敲銅環</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg011" value="<?php echo $pg011; ?>" id="pg004" class="form-control" />
  								</div>
  							</div>
  							<div class="form-group form-inline"><label for="pg012" class="col-sm-1 control-label">其他</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" placeholder='未輸入值不更新' style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg012" value="<?php echo $pg012; ?>" id="pg004" class="form-control" />
  								</div>
  							</div>





  							<div class="form-group">
  								<div class="col-sm-offset-2 col-sm-11">
  									<div class="btn-group">

  										<button type="submit" class="btn btn-primary btn-flat">批次更新</button>
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
  		$('#pg003').focus();
  	});
  </script>

  </body>

  </html>