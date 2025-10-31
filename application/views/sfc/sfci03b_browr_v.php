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
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfci03b/displayr" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfci03b/exceldetailr"><i class="fa fa-file"></i> 匯出excel</a></li>
 							</div>
 							<!-- <div class="btn-group" role="group" aria-label="Five group">
 								<?php echo $this->session->userdata('mes1') ?>
 							</div> -->
 						</div>
 					</div>

 					<div class="box-body">
 						<!-- <form action="<?php echo base_url() ?>index.php/sfc/sfci03b/delete" method="post" enctype="multipart/form-data" id="form"> -->
 						<div class="table-responsive">
 							<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 								<thead>
 									<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 										<!-- <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td> -->
 										<!-- <th style="text-align: center;vertical-align: middle;">編輯</th> -->
 										<th style="text-align: center;vertical-align: middle;">序號</th>
 										<th style="text-align: center;vertical-align: middle;">生產日期</th>
 										<th style="text-align: center;vertical-align: middle;">機台</th>
 										<th style="text-align: center;vertical-align: middle;">作業員</th>
 										<th style="text-align: center;vertical-align: middle;">作業人數</th>
 										<th style="text-align: center;vertical-align: middle;">共同合作</th>
 										<th style="text-align: center;vertical-align: middle;">產品</th>
 										<th style="text-align: center;vertical-align: middle;">產品品名</th>
 										<th style="text-align: center;vertical-align: middle;">工序</th>
 										<th style="text-align: center;vertical-align: middle;">機台檥式</th>
 										<!-- <th style="text-align: center;vertical-align: middle;">生產起訖時間</th>
 										<th style="text-align: center;vertical-align: middle;">生產用時</th>
 										<th style="text-align: center;vertical-align: middle;">生產數量</th>
 										<th style="text-align: center;vertical-align: middle;">工令數量</th>
 										<th style="text-align: center;vertical-align: middle;">累計生產數量</th> -->
 										<th style="text-align: center;vertical-align: middle;">合格數量</th>
 										<!-- <th style="text-align: center;vertical-align: middle;">不良數量</th>
 										<th style="text-align: center;vertical-align: middle;">可返修數量</th>
 										<th style="text-align: center;vertical-align: middle;">報廢品數量</th>
 										<th style="text-align: center;vertical-align: middle;">穴數(產能)</th>
 										<th style="text-align: center;vertical-align: middle;">衝次(分)</th> -->
 										<th style="text-align: center;vertical-align: middle;">產能85%</th>
 										<!-- <th style="text-align: center;vertical-align: middle;">生產效率</th> -->
 										<th style="text-align: center;vertical-align: middle;">工價</th>
 										<!-- <th style="text-align: center;vertical-align: middle;">生產線</th>
 										<th style="text-align: center;vertical-align: middle;">機台名稱</th>
 										
 										<th style="text-align: center;vertical-align: middle;">產品規格</th> -->
 									</tr>
 								</thead>
 								<tbody>
 									<?php $chkval = 1; ?>
 									<?php foreach ($results as $row) : ?>
 										<tr>
 											<!-- <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->TD001) . "/" . trim($row->TD002); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td> -->

 											<!-- <div class="btn-group btn-group-sm" role="group" aria-label="First group">
 												<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('sfc/sfci03b/updform/' . trim($row->TD001) . '/' . trim($row->TD002) . '/') ?>" </a>修改</td>
 											</div> -->
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TD008; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->MX001; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE004disp; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE030disp; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE030dispN; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE017 ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->TE018, "utf-8", "big-5"); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->MW001 . '<br>' . mb_convert_encoding($row->TE009disp, "utf-8", "big-5"); ?></td>
 											<!-- <td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE012disp; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE013; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE011; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TA015; ?></td>-->
 											<td style="text-align: center;vertical-align: middle;"><?php
																									if ($row->TE029 == '1')
																										echo "單衝(手動)";
																									else
																										echo  "連續"; ?>
 											</td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE0312; ?></td>
 											<!-- <td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE0311; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE028; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE031; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->da005; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->da004; ?></td> -->
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->da0051; ?></td>
 											<!-- <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da0052; ?></td> -->
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->MD013m; ?></td>
 											<!-- 											
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->MD001 . '<br>' . mb_convert_encoding($row->MD002, "utf-8", "big-5"); ?></td>

 											<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->TE005disp, "utf-8", "big-5"); ?></td>
 											
 											<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->TE019, "utf-8", "big-5"); ?></td> -->
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