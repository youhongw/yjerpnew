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
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/pcl/pcli01/addform" role="button"><i class="fa fa-plus"></i>新增</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
 							</div>

 							<div class="btn-group" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/pcl/pcli01/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group" role="group" aria-label="Five group">
 								<!-- <?php echo $this->session->userdata('mes1') ?> -->
 							</div>
 						</div>
 					</div>

 					<div class="box-body">
 						<form action="<?php echo base_url() ?>index.php/pcl/pcli01/delete" method="post" enctype="multipart/form-data" id="form">
 							<div class="table-responsive">
 								<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 									<thead>
 										<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 											<td style="text-align: center;vertical-align: middle;" rowSpan="2"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">編輯</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">序號</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">測量日期</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">機台代號</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">機台名稱</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">品號</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">品名</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">規格</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="2">三點量測軸承孔</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="2">換線首樣</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="2">換刀</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="2">換班</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="2">換線首樣</th>
 											<th style="text-align: center;vertical-align: middle;" colspan="2">換刀</th>
 											<th style="text-align: center;vertical-align: middle;" rowSpan="2">備註</th>
 										</tr>
 										<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 											<th style="text-align: center;vertical-align: middle;">早班</th>
 											<th style="text-align: center;vertical-align: middle;">晚班</th>
 											<th style="text-align: center;vertical-align: middle;">輪寬</th>
 											<th style="text-align: center;vertical-align: middle;">軸承孔</th>
 											<th style="text-align: center;vertical-align: middle;">邊寬</th>
 											<th style="text-align: center;vertical-align: middle;">軸承孔</th>
 											<th style="text-align: center;vertical-align: middle;">外端面</th>
 											<th style="text-align: center;vertical-align: middle;">中端面</th>
 											<th style="text-align: center;vertical-align: middle;">外端面</th>
 											<th style="text-align: center;vertical-align: middle;">中端面</th>
 											<th style="text-align: center;vertical-align: middle;">外端面</th>
 											<th style="text-align: center;vertical-align: middle;">中端面</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php $chkval = 1; ?>
 										<?php foreach ($results as $row) : ?>
 											<tr>
 												<td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->bh001) . "/" . trim($row->bh002) . '/' . trim($row->bh003); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

 												<div class="btn-group btn-group-sm" role="group" aria-label="First group">
 													<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('pcl/pcli01/updform/' . trim($row->bh001) . '/' . trim($row->bh002) . '/' . trim($row->bh003) . '/') ?>" </a>修改</td>
 												</div>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval; ?></td>

 												<td style="text-align: center;vertical-align: middle;"><?php echo  date('Y/m/d', strtotime($row->bh001)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->bh003); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MX003), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->bh002); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bi005a) == 1) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bi007a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bi008a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bi005b) == 2) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bi007b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bi008b), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bj005a) == 1) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bj006a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bj007a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bj005b) == 2) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bj006b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bj007b), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bk006a) == 1) {
															echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk005a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk007a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk008a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bk006b) == 2) {
															echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk005b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk007b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk008a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bl005a) == 1) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bl007a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bl008a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bl005b) == 2) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bl007b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bl008b), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bm005a) == 1) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bm006a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bm007a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bm005b) == 2) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bm006b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bm007b), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bn005a) == 1) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bn006a), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bn007a), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: left;vertical-align: middle;">
 													<?php
														if (trim($row->bn005b) == 2) {
															echo  'A面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bn006b), 'utf-8', 'big-5'), ENT_QUOTES)) . '<br>' . 'B面:' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bn007b), 'utf-8', 'big-5'), ENT_QUOTES));
														} else {
															echo '';
														}

														?>
 												</td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bh004), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
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