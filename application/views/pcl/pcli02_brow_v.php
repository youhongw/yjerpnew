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
 							<div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/pcl/pcli02/addform" role="button"><i class="fa fa-plus"></i>新增</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
 							</div>

 							<div class="btn-group" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/pcl/pcli02/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group" role="group" aria-label="Five group">
 								<!-- <?php echo $this->session->userdata('mes1') ?> -->
 							</div>
 						</div>
 					</div>

 					<div class="box-body">
 						<form action="<?php echo base_url() ?>index.php/pcl/pcli02/delete" method="post" enctype="multipart/form-data" id="form">
 							<div class="table-responsive">
 								<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 									<thead>
 										<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 											<td style="text-align: center;vertical-align: middle;" rowSpan="2"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">編輯</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">序號</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">生產日期</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">次數</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">品號</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">品名</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">規格</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">機台代號</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">機台名稱</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">生產起~迄時間</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">生產時數(H)</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">生產總數(PCS)</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="3">粗度儀量測數據</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">備註</th>
 										</tr>
 										<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 											<th style="text-align: center;vertical-align: middle;">數量</th>
 											<th style="text-align: center;vertical-align: middle;">拋丸時間</th>
 											<th style="text-align: center;vertical-align: middle;">粗糙度</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php $chkval = 1; ?>
 										<?php foreach ($results as $row) : ?>
 											<tr>
 												<td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->sa001) . "/" . trim($row->sa002) . '/' . trim($row->sa003) . '/' . trim($row->sa008); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

 												<div class="btn-group btn-group-sm" role="group" aria-label="First group">
 													<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('pcl/pcli02/updform/' . trim($row->sa001) . '/' . trim($row->sa002) . '/' . trim($row->sa003) . '/' . trim($row->sa008) . '/') ?>">修改</td>
 												</div>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval; ?></td>

 												<td style="text-align: center;vertical-align: middle;"><?php echo  date('Y/m/d', strtotime($row->sa001)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sa008); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sa002); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sa003); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MX003), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sa004a) . '~' . trim($row->sa005a); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sa006); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sb005sum); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sb005a); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sb006a); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->sb007a); ?></td>

 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->sa007), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 											</tr>
 											<?php $chkval += 1; ?>
 										<?php endforeach; ?>
 									</tbody>
 									<tfoot>
 										<!-- <tr>
 											<th colspan="9">合計數量:</th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 										</tr> -->
 									</tfoot>

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