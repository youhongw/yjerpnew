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
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfci03k/displayr" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/sfc/sfci03k/exceldetailr"><i class="fa fa-file"></i> 匯出excel</a></li>
 							</div>
 							<!-- <div class="btn-group" role="group" aria-label="Five group">
 								<?php echo $this->session->userdata('mes1') ?>
 							</div> -->
 						</div>
 					</div>

 					<div class="box-body">
 						<!-- <form action="<?php echo base_url() ?>index.php/sfc/sfci03k/delete" method="post" enctype="multipart/form-data" id="form"> -->
 						<div class="table-responsive">
 							<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 								<thead>
 									<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 										<!-- <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td> -->
 										<!-- <th style="text-align: center;vertical-align: middle;">編輯</th> -->
 										<th style="text-align: center;vertical-align: middle;">序號</th>
 										<th style="text-align: center;vertical-align: middle;">入庫單號</th>
 										<th style="text-align: center;vertical-align: middle;">入庫日期</th>
 										<th style="text-align: center;vertical-align: middle;">製令單號</th>

 										<th style="text-align: center;vertical-align: middle;">品號</th>
 										<th style="text-align: center;vertical-align: middle;">品名</th>
 										<th style="text-align: center;vertical-align: middle;">規格</th>
 										<th style="text-align: center;vertical-align: middle;">機台檥式</th>

 										<th style="text-align: center;vertical-align: middle;">入庫數量</th>
 										<th style="text-align: center;vertical-align: middle;">工價</th>
 										
 									</tr>
 								</thead>
 								<tbody>
 									<?php $chkval = 1; ?>
 									<?php foreach ($results as $row) : ?>
 										<tr>
 								
											
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE001.'-'.$row->TE002; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TD008; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE006.'-'.$row->TE007; ?></td>
 											
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE017; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->TE018, "utf-8", "big-5"); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->TE019, "utf-8", "big-5"); ?></td>
 											
 											<td style="text-align: center;vertical-align: middle;"><?php
																									if ($row->TE029 == '1')
																										echo "單衝(手動)";
																									else
																										echo  "連續"; ?>
 											</td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->TE0312; ?></td>
											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->da005; ?></td>
 											
 											<!--<td style="text-align: center;vertical-align: middle;"><?php echo  $row->MD013m; ?></td>-->
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