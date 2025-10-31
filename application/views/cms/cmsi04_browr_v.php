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
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/cms/cmsi04/addform" role="button"><i class="fa fa-plus"></i>新增</a>
 							</div> -->
 							<!-- <div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" onclick="$('form').submit();" role="button"><i class="fa fa-minus"></i>刪除</a>
 							</div> -->

 							<div class="btn-group mr-2" role="group" aria-label="First group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/cms/cmsi04/displayr" role="button"><i class="fa fa-refresh"></i> 重整</a>
 							</div>
 							<!-- <div class="btn-group mr-2" role="group" aria-label="Five group">
 								<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/cms/cmsi04/exceldetailr"><i class="fa fa-file"></i> 匯出excel</a></li>
 							</div>
 							<div class="btn-group" role="group" aria-label="Five group">
 								<?php echo $this->session->userdata('mes1') ?>
 							</div> -->
 						</div>
 					</div>

 					<div class="box-body">
 						<!-- <form action="<?php echo base_url() ?>index.php/cms/cmsi04/delete" method="post" enctype="multipart/form-data" id="form"> -->
 						<div class="table-responsive">
 							<table id="example1" class="table table-bordered table-striped" style="width: 100%;">
 								<thead>
 									<tr style="background-color: #3C8DBC;cursor:pointer;color:#FFFFFF;">
 										<!-- <td style="text-align: center;vertical-align: middle;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td> -->
 										<!-- <th style="text-align: center;vertical-align: middle;">編輯</th> -->
 										<th style="text-align: center;vertical-align: middle;">序號</th>
 										<th style="text-align: center;vertical-align: middle;">線別代號</th>
 										<th style="text-align: center;vertical-align: middle;">線別名稱</th>
 										<th style="text-align: center;vertical-align: middle;">時薪</th>
										<th style="text-align: center;vertical-align: middle;">生效日期</th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php $chkval = 1; ?>
 									<?php foreach ($results as $row) : ?>
 										<tr>
 											<!-- <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->TD001) . "/" . trim($row->TD002); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td> -->

 											<!-- <div class="btn-group btn-group-sm" role="group" aria-label="First group">
 												<td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('cms/cmsi04/updform/' . trim($row->TD001) . '/' . trim($row->TD002) . '/') ?>" </a>修改</td>
 											</div> -->
 											<td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  trim($row->MD001); ?></td>
 											<td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding(trim($row->MD002), "utf-8", "big-5"); ?></td>
 											<td style="text-align: center;vertical-align: middle;">
 												<input type="text" tabIndex="1" id="MD013" onfoucs="this.select" style="align-content: center;text-align: center;" maxlength='8' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1')" name="MD013" value="<?php echo $row->MD013; ?>" onchange="chgit(this,'<?php echo  trim($row->MD001); ?>')" />
 											</td>
                                               <td style="text-align: center;vertical-align: middle;">
 												<input type="text" tabIndex="1" id="MD011" onfoucs="this.select" style="align-content: center;text-align: center;" maxlength='8' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1')" name="MD011" value="<?php echo $row->MD011; ?>" onchange="chgita(this,'<?php echo  trim($row->MD001); ?>')" />
 											</td>
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
 <script language="javascript">
 	var xmlHttp;

 	function createXMLHttpRequest() { //不更新網頁 判斷適用各種流覽器 共用 (全域)
 		if (window.ActiveXObject)
 			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
 		else if (window.XMLHttpRequest)
 			xmlHttp = new XMLHttpRequest();
 	}

 	// <!--不更新網頁(數量, 代號)-- >
 	function chgit(oInput, mtc2) {
 		//首先判斷是否有輸入，沒有輸入直接返回，並提示
 		//  alert(mtc2);
 		// alert(mtc3);
		kk=oInput.value;
			if (kk=='') kk='y';
 		createXMLHttpRequest();
 		var sUrl = "<?php echo base_url() ?>index.php/cms/cmsi04/dataupdate/" + encodeURIComponent(kk) + "/" + mtc2;
 		var QueryString = encodeURIComponent(kk);

 		xmlHttp.open("POST", sUrl);
 		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 		xmlHttp.send(QueryString);

 		xmlHttp.onreadystatechange = function() {
 			if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
 				showupdate(xmlHttp.responseText); //顯示服務器結果		
 		}
 		//xmlHttp.send(null);
 	}
	function chgita(oInput, mtc2) {
 		//首先判斷是否有輸入，沒有輸入直接返回，並提示
 		//  alert(mtc2);
 		// alert(mtc3);
		    kk=oInput.value;
			if (kk=='') kk='z';
 		createXMLHttpRequest();
 		var sUrl = "<?php echo base_url() ?>index.php/cms/cmsi04/dataupdatea/" + encodeURIComponent(kk) + "/" + mtc2;
 		var QueryString = encodeURIComponent(kk);

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