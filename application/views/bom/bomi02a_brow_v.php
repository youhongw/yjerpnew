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
			<div class="col-xs-12 col-sm-12">

				<!-- /.box -->

				<div class="box">
					<div class="box-header">
						<!--  <h3 class="box-title"></h3>-->
						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

							<div class="btn-group mr-2" role="group" aria-label="First group">
								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/bom/bomi02a/addform" role="button"><i class="fa fa-plus"></i>新增</a>
							</div>
							<div class="btn-group mr-2" role="group" aria-label="First group">
								<a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
							</div>

							<div class="btn-group" role="group" aria-label="Five group">
								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/bom/bomi02a/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
							</div>

						</div>
					</div>
					<!-- /.box-header -->

					<div class="box-body">
						<form action="<?php echo base_url() ?>index.php/bom/bomi02a/delete" method="post" enctype="multipart/form-data" id="form">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
									<thead>
										<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
											<td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
											<th style="text-align: center;vertical-align: middle;">編輯</th>
											<th style="text-align: center;vertical-align: middle;">序號</th>
											<th style="text-align: center;vertical-align: middle;">主件品號</th>
											<th style="text-align: center;vertical-align: middle;">主件品名</th>
											<th style="text-align: center;vertical-align: middle;">主件規格</th>
											<th style="text-align: center;vertical-align: middle;">單位</th>
											<th style="text-align: center;vertical-align: middle;">群組</th>
											<th style="text-align: center;vertical-align: middle;">標準批量</th>
											<th style="text-align: center;vertical-align: middle;">備註</th>
										</tr>
									</thead>
									<tbody>
										<?php $chkval = 1; ?>
										<?php foreach ($results as $row) : ?>
											<tr>
												<td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->mc001) . "/" . trim($row->mc002) ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

												<div class="btn-group btn-group-sm" role="group" aria-label="First group">
													<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('bom/bomi02a/updform/' . trim($row->mc001) . '/') ?>">修改</td>
												</div>
												<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mc001); ?></td>
												<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->mc01disp), "utf-8", "big-5"); ?></td>
												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->mc01disp1), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
												<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->mc002), "utf-8", "big-5"); ?></td>

												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mc009) . ':' . mb_convert_encoding(trim($row->mc009disp), "utf-8", "big-5"); ?></td>
												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->mc004); ?></td>
												<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->mc010), "utf-8", "big-5"); ?></td>

											</tr>
											<?php $chkval += 1; ?>
										<?php endforeach; ?>
									</tbody>
									<tfoot>

								</table>
							</div>
						</form>
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
<?php include_once './application/views/foot_brow_new_v.php'; ?>