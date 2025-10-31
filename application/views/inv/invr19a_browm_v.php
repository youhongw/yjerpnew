 <?php include_once './application/views/head_v.php'; ?>
 <div class="content-wrapper">
 	<section class="content-header">
 		<h1>
 			<small><?php echo $systitle; ?></small>
 		</h1>
 		<ol class="breadcrumb">
 			<li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
 			<li class="active"><?php echo $systitle; ?></li>
 		</ol>
 	</section>

 	<section class="content">
 		<div class="row ">
 			<div class="col-12 col-xs-12 col-sm-12">

 				<div class="box">
 					<div class="box-header">

 						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
 							<!-- <div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/inv/invr19a/addform" role="button"><i class="fa fa-plus"></i>新增</a>
 							</div> -->
 							<!-- <div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
 							</div> -->

 							<div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/inv/invr19a/displaym" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/inv/invr19a/exceldetail"><i class="fa fa-file"></i> 匯出excel</a></li>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="Five group">
 								<a class="btn btn-warning btn-flat" href="<?php echo base_url() ?>index.php/inv/invr19a/display"><i class="fa fa-genderless"></i> 配料異動明細</a></li>
 							</div>
 							<!-- <div class="btn-group" role="group" aria-label="Five group">
 								<?php echo $this->session->userdata('mes1') ?>
 							</div> -->
 						</div>
 					</div>

 					<div class="box-body">
 						<!-- <form action="<?php echo base_url() ?>index.php/inv/invr19a/delete" method="post" enctype="multipart/form-data" id="form"> -->
 						<div class="table-responsive">
 							<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 								<thead>
 									<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 										<!-- <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td> -->
 										<!-- <th style="text-align: center;vertical-align: middle;">編輯</th> -->
 										<th style="text-align: center;vertical-align: middle;">序號</th>
 										<th style="text-align: center;vertical-align: middle;">生產年月</th>
 										<th style="text-align: center;vertical-align: middle;">品號</th>
 										<th style="text-align: center;vertical-align: middle;width: 22%;">品名</th>

 										<th style="text-align: center;vertical-align: middle;">期初庫存</th>
 										<th style="text-align: center;vertical-align: middle;">本期入庫</th>
 										<th style="text-align: center;vertical-align: middle;">本期耗料</th>
 										<th style="text-align: center;vertical-align: middle;">本期損耗</th>
 										<th style="text-align: center;vertical-align: middle;">本期期末</th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php $chkval = 1; ?>
 									<?php foreach ($results as $row) : ?>
 										<tr>
 											<!-- <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->TD001) . "/" . trim($row->TD002); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td> -->

 											<!-- <div class="btn-group btn-group-sm" role="group" aria-label="First group">
 												<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('inv/invr19a/updform/' . trim($row->TD001) . '/' . trim($row->TD002) . '/') ?>" </a>修改</td>
 											</div> -->
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  date('Y/m', strtotime($row->month . '01')); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->ra019; ?></td>
 											<td style="text-align: left;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->ra019disp), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>

 											<td style="text-align: center;vertical-align: middle;"><?php echo  round($row->r001, 3); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  round($row->r002, 3); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  round($row->r003, 3); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  round($row->r004, 3); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  round($row->r005, 3); ?></td>

 										</tr>
 										<?php $chkval += 1; ?>
 									<?php endforeach; ?>
 								</tbody>
 								<tfoot>

 							</table>
 						</div>
 						<!-- </form> -->
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