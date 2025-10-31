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
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/inv/invr19a/display" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<div class="btn-group mr-2" role="group" aria-label="Five group">
 								<a class="btn btn-warning btn-flat" href="<?php echo base_url() ?>index.php/inv/invr19a/displaym"><i class="fa fa-genderless"></i> 上一頁</a></li>
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
 										<th style="text-align: center;vertical-align: middle;">品號</th>
 										<th style="text-align: center;vertical-align: middle;width: 20%;">品名</th>
 										<th style="text-align: center;vertical-align: middle;">生產日期</th>
 										<th style="text-align: center;vertical-align: middle;">入出別</th>
 										<th style="text-align: center;vertical-align: middle;">單據單別</th>
 										<th style="text-align: center;vertical-align: middle;">單據單號</th>
 										<th style="text-align: center;vertical-align: middle;">單據序號</th>
 										<th style="text-align: center;vertical-align: middle;">庫別</th>
 										<th style="text-align: center;vertical-align: middle;">入庫重量</th>
 										<th style="text-align: center;vertical-align: middle;">出庫重量</th>
 										<th style="text-align: center;vertical-align: middle;">異動損耗</th>
 										<th style="text-align: center;vertical-align: middle;">損耗</th>
 										<!-- <th style="text-align: center;vertical-align: middle;">備註</th> -->
 									</tr>
 								</thead>
 								<tbody>
 									<?php $chkval = 1; ?>
 									<?php foreach ($results as $row) : ?>
 										<tr>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>
 											<td style="text-align: letf;vertical-align: middle;"><?php echo  $row->ra001; ?></td>
 											<td style="text-align: left;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->ra001disp), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  date('Y/m/d', strtotime($row->ra004)); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php if ($row->ra005 == 1)
																										echo "入庫";
																									else
																										echo "出庫"; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->ra006; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->ra007; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->ra008; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $row->ra009 . ':' . stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->ra009disp), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
 											<td style="text-align: right;vertical-align: middle;"><?php echo ($row->ra010) ? round($row->ra010, 3) : ''; ?></td>
 											<td style="text-align: right;vertical-align: middle;"><?php echo ($row->ra017dis) ? round($row->ra017dis, 3) : ''; ?></td>
 											<td style="text-align: right;vertical-align: middle;">
 												<input type="text" tabIndex="1" id="ra011" onfoucs="this.select" style="align-content: center;text-align: center;" maxlength='8' onkeyup="this.value=this.value.replace(/[^0-9\-\.]/gi,'');" name="ra011" value="<?php echo $row->ra011; ?>" onchange="chgit(this,'<?php echo  trim($row->ra006); ?>','<?php echo  trim($row->ra007); ?>','<?php echo  trim($row->ra008); ?>')" />
 											</td>
 											<td style="text-align: right;vertical-align: middle;"><?php echo  round($row->ra020 + $row->ra021, 3); ?></td>

 											<!-- <td style="text-align: left;vertical-align: middle;"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->ra016), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td> -->
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
 <script>
 	// <!--不更新網頁(數量, 單別, 單號, 序號)-- >
 	function chgit(oInput, mtc1, mtc2, mtc3) {
 		//首先判斷是否有輸入，沒有輸入直接返回，並提示
 		//  alert(mtc2);
 		// alert(mtc3);
 		createXMLHttpRequest();
 		var sUrl = "<?php echo base_url() ?>index.php/inv/invr19a/dataupdate/" + encodeURIComponent(oInput.value) + "/" + mtc1 + "/" + mtc2 + "/" + mtc3;
 		var QueryString = encodeURIComponent(oInput.value);

 		xmlHttp.open("POST", sUrl);
 		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 		xmlHttp.send(QueryString);

 		xmlHttp.onreadystatechange = function() {
 			if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
 				showupdate(xmlHttp.responseText); //顯示服務器結果		
 		}
 		//xmlHttp.send(null);
 	}
 </script>