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
        foreach ($result as $row) {
          $pk001 = trim($row->pk001);
          $pk002 = round($row->pk002, 2);
		  $pk003 = round($row->pk003, 3);
		  $pk004 = round($row->pk004, 4);
           $pk005 = round($row->pk005, 2);
		   $pk006 = round($row->pk006, 2);
            $pk007 = $row->pk007;
          $pk009 = round($row->pk009, 4);
          $pk008 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->pk008), 'utf-8', 'big-5'), ENT_QUOTES));
          $pk001dis = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->pk001dis), 'utf-8', 'big-5'), ENT_QUOTES));
          $flag = $row->flag;
		  $pk004dis ='';
		  if ($pk004=='1') {$pk004dis ='1:半自動';}
		  if ($pk004=='2') {$pk004dis ='2:全自動';}
        }
        ?>
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">使用者 - 修改</h3>-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url() ?>index.php/sfc/sfcp03ka/updsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

              <div class="form-group form-inline"><label for="pk001" class="col-sm-1 control-label">產品品號</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" maxlength='20' onKeyPress="keyFunction()" name="pk001" value="<?php echo $pk001; ?>" id="pk001" class="form-control" required />
                  <?php echo $pk001; ?>
                  <span id="pk001_disp"><?php echo $pk001dis; ?> </span>
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
              <div class="form-group form-inline"><label for="pk004" class="col-sm-1 control-label">計價基準(1半自動2全自動)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pk004" value="<?php echo $pk004; ?>" id="pk004" class="form-control" />
                <span id="pk004_disp"><?php echo $pk004dis; ?> </span>
				</div>
              </div>
             <div class="form-group form-inline"><label for="pk005" class="col-sm-1 control-label">生產稼動率%</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onfocus="amt1()" maxlength='11' onKeyPress=" keyFunction()" name="pk005" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pk005; ?>" id="pk005" class="form-control" />
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

                  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
                  <div class="success">
                    <?php
                    if ($message == '查詢一筆修改資料!' || $message == '模具-修改成功!') {
                      $message = '<b><font color="blue">' . $message . '</font></b><br>';
                    } else {
                      $message = '<font color="red">' . $message . '</font><br>';
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
    $('#pk001').focus();
  });

 /* function count04() {
    var pk004 = Math.round(60 / $('#pk010').val() * 10) / 10;
    if ($('#pk010').val()) {
      return $('#pk004').val(pk004);
    }

  }*/
  function amt1() {
    var pk005 = Math.round($('#pk004').val() / $('#pk002').val());
   
      return roundTo($('#pk005').val(pk005),2);

  }
   function amt2() {
    var pk006 = Math.round($('#pk003').val()*$('#pk009').val() / $('#pk002').val()*$('#pk005').val());
   
      return roundTo($('#pk006').val(pk006),2);

  }
</script>