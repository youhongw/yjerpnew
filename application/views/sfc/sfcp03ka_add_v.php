  <?php include_once './application/views/head_v.php'; ?>

  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<h1>
  			<small><small><?php echo $systitle; ?></small></small>
  		</h1>
  		<ol class="breadcrumb">
  			<li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
  			<li class="active"><?php echo $systitle; ?></li>
  		</ol>
  	</section>



  	<!-- Main content -->
  	<section class="content">
  		<div class="row">
  			<div class="col-xs-12">

  				<!-- /.box -->
  				<?php
					$pk001 = $this->input->post('pk001');
					$pk002 = $this->input->post('pk002');
					$pk003 = $this->input->post('pk003');
					$pk004 = $this->input->post('pk004');
					$pk005 = $this->input->post('pk005');
					$pk006 = $this->input->post('pk006');
					$pk007 = $this->input->post('pk007');
					$pk009 = $this->input->post('pk009');
					$pk004dis ='1';
		  if ($pk004=='1') {$pk004dis ='1:半自動';}
		  if ($pk004=='2') {$pk004dis ='2:全自動';}
                     if(!isset($pk008)) { $pk008=date("Y/m/d"); }  
					?>
  				<div class="box">
  					<div class="box-header">
  						<!-- <h3 class="box-title">使用者 - 修改</h3>-->
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form action="<?php echo base_url() ?>index.php/sfc/sfcp03ka/addsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

  							<div class="form-group form-inline"><label for="pk001" class="col-sm-1 control-label">產品品號</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" maxlength='20' onchange="check_invi02(this)" onKeyPress="keyFunction()" name="da001" value="<?php echo $pk001; ?>" id="da001" class="form-control" required />
  									<a href="javascript:;">
  										<span id="Showinvi02disp" class="glyphicon glyphicon-search"></span>
  									</a>
  									<span id="da001_disp"> </span>
  								</div>
  							</div>
 <div class="form-group form-inline"><label for="pk004" class="col-sm-1 control-label">計價基準</label>
                <div class="col-sm-11">
                   <select tabIndex="1" id="pk004" onKeyPress="keyFunction()" onfocus="selapp(this);" onChange="selapp(this);" name="pk004" >
            <option <?php if($pk004 == '1') echo 'selected="selected"';?> value='1'>半自動　　　　　　 </option>                                                                        
		    <option <?php if($pk004 == '2') echo 'selected="selected"';?> value='2'>全自動　　　　　　 </option>           
		  </select>
				</div>
              </div>
  							 <div class="form-group form-inline"><label for="pk002" class="col-sm-1 control-label">模具穴數</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress="keyFunction()" name="pk002" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1');" value="<?php echo $pk002; ?>" id="pk002" class="form-control" />
                </div>
              </div>


              <div class="form-group form-inline"><label for="pk003" class="col-sm-1 control-label">生產週期(秒)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pk003" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk003; ?>" id="pk003" class="form-control" />
                </div>
              </div>
           <!--   <div class="form-group form-inline"><label for="pk004" class="col-sm-1 control-label">計價基準</label>
                <div class="col-sm-11">
                   <select tabIndex="1" id="pk004" onKeyPress="keyFunction()" onfocus="selapp(this);" onChange="selapp(this);" name="pk004" >
            <option <?php if($pk004 == '1') echo 'selected="selected"';?> value='1'>半自動　　　　　　 </option>                                                                        
		    <option <?php if($pk004 == '2') echo 'selected="selected"';?> value='2'>全自動　　　　　　 </option>           
		  </select>
				</div>
              </div> -->
             <div class="form-group form-inline"><label for="pk005" class="col-sm-1 control-label">生產稼動率%</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onfocus="amt1(this)" maxlength='11' onKeyPress=" keyFunction()" name="pk005" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk005; ?>" id="pk005" class="form-control" />
                </div>
              </div>
			  <div class="form-group form-inline"><label for="pk006" class="col-sm-1 control-label">工價小計</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onfocus="amt2()" maxlength='11' onKeyPress=" keyFunction()" name="pk006" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk006; ?>" id="pk006" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="pk007" class="col-sm-1 control-label">備註</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onKeyPress=" keyFunction()" name="pk007" value="<?php echo $pk007; ?>" id="pk007" class="form-control" />
                </div>
              </div>
			  
			  <div class="form-group form-inline"><label for="pk008" class="col-sm-1 control-label">生效日期</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onKeyPress=" keyFunction()" name="pk008" value="<?php echo $pk008; ?>" id="pk008" class="form-control" />
                  <img  onclick="scwShow(pk008,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
				</div>
              </div>
               <div class="form-group form-inline"><label for="pk009" class="col-sm-1 control-label">計算基準</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" id="pk009" maxlength='11' onKeyPress=" keyFunction()" name="pk009" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk009; ?>" id="pk009" class="form-control" />
                </div>
              </div>

  							<div class="form-group">
  								<div class="col-sm-offset-2 col-sm-11">
  									<div class="btn-group">

  										<button type="submit" class="btn btn-primary btn-flat">存檔</button>
  										<a href="<?php echo base_url() ?>index.php/sfc/sfcp03ka/display" class="btn btn-warning btn-flat">上一頁</a>
  										<a href="<?php echo base_url() ?>index.php/main" class="btn btn-default btn-flat">首頁</a>

  									</div>

  									<div class="success">
  										<?php
											if ($message != '') {
												$message = '<b><font color="red">' . $message . '</font></b><br>';
											} else {
												$message = '<font color="blue">' . $message . '</font><br>';
											}
											?>
  										<?php echo  '  提示訊息：' . $message ?>
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

  <?php include_once './application/views/foot_open_v.php'; ?>
  <!-- 產品品號 開窗 -->
  <?php include_once './application/views/funnew/invi02v_funmjs_v.php'; ?>

  </body>

  </html>
  <!-- 品號 -->
  <script type="text/javascript">
  	$(document).ready(function() {
  		$('#pk004').focus();
  	});
	function amt1() {
    var pk005 =$('#pk009').val() / $('#pk002').val()*100/100;
       
	   console.log(pk005);
      return $('#pk005').val(pk005);

  }
   function amt2() {
    var pk006 = $('#pk003').val()*$('#pk009').val() / $('#pk002').val()*$('#pk005').val()*0.001;
      console.log(pk006);
      return $('#pk006').val(pk006);

  }
  function selapp(pk004){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//  var selval = document.getElementById('pk004').selectedIndex;
	  selval = pk004.value;
	  console.log(selval);
	  $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/sfc/sfcp03ka/check_title_no/"+selval,
		data: {
			selval: selval, 
			ta013: selval
		}
	})
	.done(function( msg ) {
		console.log(msg);
		$('#pk009').val(msg);
	});
	  
  }
  </script>