<?php include_once './application/views/head_brow_v.php'; ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<small><?php echo $systitle; ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
			<li class="active"><?php echo $systitle; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row ">
			<div class="col-12 col-xs-12 col-sm-12">

				<!-- /.box -->

				<div class="box">
					<div class="box-header">
						<!--  <h3 class="box-title"></h3>-->
						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
						</div>
					</div>
					<!-- /.box-header -->

					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">

										<th>序號</th>
										<th>單別</th>
										<th>單據名稱</th>
										<th>選擇</th>
									</tr>
								</thead>
								<tbody>
									<?php $chkval = 1; ?>
									<?php foreach ($results as $row) : ?>
										<tr ondblclick="javascript:send_back_new_moci01('<?php echo $row->MQ001; ?>','<?php echo $row->MQ001; ?>');">
											<td class="center"><?php echo  $chkval . '　'; ?></td>
											<td class="center"><?php echo  $row->MQ001; ?></td>
											<td class="center"><?php echo  mb_convert_encoding($row->MQ002, "utf-8", "big-5"); ?></td>
											<td class="center"><a href="javascript:send_back_new_moci01('<?php echo $row->MQ001; ?>','<?php echo $row->MQ001; ?>');">[ 選擇</a><img src="<?php echo base_url() ?>assets/image/png/ok.png" />]</td>
										</tr>
										<?php $chkval += 1; ?>
									<?php endforeach; ?>

								</tbody>

							</table>
						</div>
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