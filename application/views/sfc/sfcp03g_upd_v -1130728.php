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
          $pg001 = trim($row->pg001);
          $pg002 = trim($row->pg002);
          $pg003 = trim($row->pg003);
          // $pg004 = trim($row->pg004);

          $pg005 = round($row->pg005, 3);
          $pg006 = round($row->pg006, 3);
          $pg007 = round($row->pg007, 3);
          $pg008 = round($row->pg008, 3);
          $pg009 = round($row->pg009, 3);
          $pg010 = round($row->pg010, 3);
          $pg011 = round($row->pg011, 3);
          $pg012 = round($row->pg012, 3);
		  $pg019 = round($row->pg019, 3);
		  
		  $pg0051 = round($row->pg0051, 3);
          $pg0061 = round($row->pg0061, 3);
          $pg0071 = round($row->pg0071, 3);
          $pg0081 = round($row->pg0081, 3);
          $pg0091 = round($row->pg0091, 3);
          $pg0101 = round($row->pg0101, 3);
          $pg0111 = round($row->pg0111, 3);
          $pg0121 = round($row->pg0121, 3);
          $pg0131 =$row->pg0131;
		  
          $pg013 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->pg013), 'utf-8', 'big-5'), ENT_QUOTES));
          $pg001dis = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->pg001dis), 'utf-8', 'big-5'), ENT_QUOTES));
          $flag = $row->flag;
        }
        ?>
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">使用者 - 修改</h3>-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url() ?>index.php/sfc/sfcp03g/updsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

              <div class="form-group form-inline"><label for="pg001" class="col-sm-1 control-label">產品品號</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" maxlength='20' onKeyPress="keyFunction()" name="pg001" value="<?php echo $pg001; ?>" id="pg001" class="form-control" required />
                  <?php echo $pg001; ?>
                  <span id="pg001_disp"><?php echo $pg001dis; ?> </span>
                </div>
              </div>

              <div class="form-group form-inline"><label for="pg002" class="col-sm-1 control-label">機台樣式（1.單衝; 2.連續）</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" maxlength='20' onKeyPress="keyFunction()" name="pg002" value="<?php echo $pg002; ?>" id="pg002" class="form-control" required />
                  <?php echo $pg002; ?>
                </div>
              </div>
              <div class="form-group form-inline"><label for="pg003" class="col-sm-1 control-label">系列別</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" maxlength='20' onKeyPress="keyFunction()" name="pg003" value="<?php echo $pg003; ?>" id="pg003" class="form-control" required />
                  <?php echo $pg003; ?>
                </div>
              </div>
              <!-- <div class="form-group form-inline"><label for="pg004" class="col-sm-1 control-label">專用機（1.專用; 2.非專用）</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" maxlength='20' onKeyPress="keyFunction()" name="pg004" value="<?php echo $pg004; ?>" id="pg004" class="form-control" required />
                  <?php echo $pg004; ?>
                </div>
              </div> -->

              <div class="form-group form-inline"><label for="pg019" class="col-sm-1 control-label">工價小計</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' readonly="value" onKeyPress="keyFunction()" name="pg019" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg019; ?>" id="pg019" class="form-control" />
                </div>
              </div>
			  
			  <div class="form-group form-inline">
			    <label for="pg005" class="col-sm-1 control-label">上珠碗/底板波盤</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' readonly="value" onKeyPress="keyFunction()" name="pg005" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg005; ?>" id="pg005" class="form-control" />
               	上珠碗/底板波盤 產量
                <input type="text" tabIndex="1" style="width: 300px" maxlength='11'  onKeyPress="keyFunction()" name="pg0051" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg0051; ?>" id="pg0051" class="form-control" />
                </div>
              </div>
			  
              <div class="form-group form-inline"><label for="pg006" class="col-sm-1 control-label">下珠碗/齒碗</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pg006" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg006; ?>" id="pg006" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="pg007" class="col-sm-1 control-label">剎車踏板彈片</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg007" value="<?php echo $pg007; ?>" id="pg007" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="pg008" class="col-sm-1 control-label">剎車鉚合</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress="keyFunction()" name="pg008" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg008; ?>" id="pg008" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="pg009" class="col-sm-1 control-label">鉚固定座</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pg009" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg009; ?>" id="pg009" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="pg010" class="col-sm-1 control-label">支架鉚合</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="pg010" value="<?php echo $pg010; ?>" id="pg010" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="pg011" class="col-sm-1 control-label">敲銅環</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress="keyFunction()" name="pg011" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg011; ?>" id="pg011" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="pg012" class="col-sm-1 control-label">其他</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='11' onKeyPress=" keyFunction()" name="pg012" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" value="<?php echo $pg012; ?>" id="pg012" class="form-control" />
                </div>
              </div>


              <div class="form-group form-inline"><label for="pg013" class="col-sm-1 control-label">備註</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onKeyPress=" keyFunction()" name="pg013" value="<?php echo $pg013; ?>" id="pg013" class="form-control" />
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-11">
                  <div class="btn-group">

                    <button type="submit" class="btn btn-primary btn-flat">存檔</button>
                    <a href="<?php echo base_url() ?>index.php/sfc/sfcp03g/display" class="btn btn-warning btn-flat">上一頁</a>
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
<!-- 品號 -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#pg001').focus();
  });

  // function count04() {
  //   var pg004 = Math.round(60 / $('#pg010').val() * 10) / 10;
  //   if ($('#pg010').val()) {
  //     return $('#pg004').val(pg004);
  //   }

  // }
</script>

</body>

</html>