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
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/prs/prsi01/addform" role="button"><i class="fa fa-plus"></i>新增</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
 							</div>

 							<div class="btn-group" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/prs/prsi01/clear_sql_term" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group" role="group" aria-label="Five group">
 								<!-- <?php echo $this->session->userdata('mes1') ?> -->
 							</div>
 						</div>
 					</div>

 					<div class="box-body">
 						<form action="<?php echo base_url() ?>index.php/prs/prsi01/delete" method="post" enctype="multipart/form-data" id="form">
 							<div class="table-responsive">
 								<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 									<thead>
 										<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 											<td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
 											<th style="text-align: center;vertical-align: middle;">編輯</th>
 											<th style="text-align: center;vertical-align: middle;">序號</th>
 											<th style="text-align: center;vertical-align: middle;">日期</th>
 											<th style="text-align: center;vertical-align: middle;">爐次</th>
 											<th style="text-align: center;vertical-align: middle;">材質</th>
 											<th style="text-align: center;vertical-align: middle;">CE值</th>
 											<th style="text-align: center;vertical-align: middle;">產品名稱</th>
 											<th style="text-align: center;vertical-align: middle;">出爐溫度(℃)</th>
 											<th class="sum" style="text-align: center;vertical-align: middle;">生鐵(鋼水)</th>
 											<th class="sum1" style="text-align: center;vertical-align: middle;">廢鋼</th>
 											<th class="sum2" style="text-align: center;vertical-align: middle;">回爐料</th>
 											<th class="sum3" style="text-align: center;vertical-align: middle;">增碳劑</th>
 											<th class="sum4" style="text-align: center;vertical-align: middle;">矽鐵</th>
 											<th class="sum5" style="text-align: center;vertical-align: middle;">錳鐵</th>
 											<th class="sum6" style="text-align: center;vertical-align: middle;">硫化鐵</th>
 											<th style="text-align: center;vertical-align: middle;">電力(開始)</th>
 											<th style="text-align: center;vertical-align: middle;">電力(結束)</th>
 											<th style="text-align: center;vertical-align: middle;">電力(耗電)</th>
 											<th style="text-align: center;vertical-align: middle;">故障記錄</th>
 											<th style="text-align: center;vertical-align: middle;">備註</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php $chkval = 1; ?>
 										<?php foreach ($results as $row) : ?>
 											<tr>
 												<td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->da001) . "/" . trim($row->da002); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>

 												<div class="btn-group btn-group-sm" role="group" aria-label="First group">
 													<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('prs/prsi01/updform/' . trim($row->da001) . '/' . trim($row->da002) . '/') ?>" </a>修改</td>
 												</div>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

 												<td style="text-align: center;vertical-align: middle;"><?php echo  date('Y/m/d', strtotime($row->da001)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da002); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da003); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da004); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->da005), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da006); ?></td>

 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->db004); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->db005); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->edb006); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->db007); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->db008); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->db009); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->db010); ?></td>

 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da007); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da008); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->da009); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->da010), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 												<td style="text-align: center;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->da011), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 											</tr>
 											<?php $chkval += 1; ?>
 										<?php endforeach; ?>
 									</tbody>
 									<tfoot>
 										<tr>
 											<th colspan="9">合計數量:</th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 											<th class="Int" style="text-align: center;vertical-align: middle;"></th>
 										</tr>
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