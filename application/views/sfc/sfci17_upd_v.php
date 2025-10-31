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
          $da001 = trim($row->da001);
          $da002 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->da002), 'utf-8', 'big-5'), ENT_QUOTES));

          $da003 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->da003), 'utf-8', 'big-5'), ENT_QUOTES));

          $da004 = trim($row->da004);
          $da005 = trim($row->da005);
          $da006 = trim($row->da006);
          $da007 = trim($row->da007);
          $da008 = trim($row->da008);
          $da009 = trim($row->da009);
          $da010 = trim($row->da010);
          $da011 = trim($row->da011);
          $da012 = mb_convert_encoding(trim($row->da012), "utf-8", "big-5");
          $da013 = trim($row->da013);
          $da013dis = trim($row->da013dis);
          $da014 = trim($row->da014);
          $da015 = trim($row->da015);
          $da016 = trim($row->da016);
          $da017 = trim($row->da017);
          $da018 = trim($row->da018);
          $flag = $row->flag;
        }
        ?>
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">使用者 - 修改</h3>-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url() ?>index.php/sfc/sfci17/updsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

              <div class="form-group form-inline"><label for="da001" class="col-sm-1 control-label">產品品號</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9\-]/gi,'');this.value=this.value.toUpperCase();" maxlength='20' onblur="dupl(this)" onKeyPress="keyFunction()" name="da001" value="<?php echo $da001; ?>" id="da001" class="form-control" required />
                  <?php echo $da001; ?>
                  <span id="da001_disp"> </span>
                </div>
              </div>

              <div class="form-group form-inline"><label for="da013" class="col-sm-1 control-label">製程代號</label>
                <div class="col-sm-11">
                  <input type='hidden' tabIndex="1" style="width: 300px" maxlength='4' onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" maxlength='20' onchange="check_cmsi19(this)" onKeyPress="keyFunction()" name="da013" value="<?php echo $da013; ?>" id="da013" class="form-control" required />
                  <?php echo $da013 . ' ' . trim(mb_convert_encoding($da013dis, 'utf-8', 'big-5')); ?>
                  <span id="da013_disp"> </span>
                </div>
              </div>

              <div class="form-group form-inline"><label for="da014" class="col-sm-1 control-label">機台樣式</label>
                <div class="col-sm-11">
                  <input type="hidden" name="da014" value="<?php echo $da014; ?>" id="da014" class="form-control" />
                  <select id="verify" onKeyPress="keyFunction()" name="da014" onChange="selverify(this)" style="height: 27px;" tabIndex="1" disabled="disabled">
                    <option <?php if ($da014 == '1') echo 'selected="selected"'; ?> value='1'>1.單衝(手動)</option>
                    <option <?php if ($da014 == '2') echo 'selected="selected"'; ?> value='2'>2.連續</option>
                  </select>
                </div>
              </div>

              <div class="form-group form-inline"><label for="da002" class="col-sm-1 control-label">模具名稱</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='50' onKeyPress="keyFunction()" name="da002" value="<?php echo $da002; ?>" id="da002" class="form-control" />
                </div>
              </div>


              <div class="form-group form-inline"><label for="da003" class="col-sm-1 control-label">規格</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='50' onKeyPress=" keyFunction()" name="da003" value="<?php echo $da003; ?>" id="da003" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="da010" class="col-sm-1 control-label">生產週期(時/分)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" placeholder='mm' maxlength='4' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" onchange="count04()" onKeyPress=" keyFunction()" name="da010" value="<?php echo $da010; ?>" id="da010" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="da004" class="col-sm-1 control-label">衝次(產能)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='10' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1')" onKeyPress=" keyFunction()" name="da004" value="<?php echo $da004; ?>" id="da004" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="da005" class="col-sm-1 control-label">穴數</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='5' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1')" onKeyPress=" keyFunction()" name="da005" value="<?php echo $da005; ?>" id="da005" class="form-control" />
                </div>
              </div>


              <div class="form-group form-inline"><label for="da006" class="col-sm-1 control-label">每模毛重(g)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='10' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="da006" value="<?php echo $da006; ?>" id="da006" class="form-control" />
                  鑄造（KG）
                </div>
              </div>


              <div class="form-group form-inline"><label for="da007" class="col-sm-1 control-label">每模淨重(g)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='10' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="da007" value="<?php echo $da007; ?>" id="da007" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="da008" class="col-sm-1 control-label">單毛重(g)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='10' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="da008" value="<?php echo $da008; ?>" id="da008" class="form-control" />
                  鑄造（KG）
                </div>
              </div>
              <div class="form-group form-inline"><label for="da009" class="col-sm-1 control-label">單淨重(g)</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='10' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="da009" value="<?php echo $da009; ?>" id="da009" class="form-control" />
                </div>
              </div>
              <div class="form-group form-inline"><label for="da015" class="col-sm-1 control-label">作業人數</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='6' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1')" onKeyPress=" keyFunction()" name="da015" value="<?php echo $da015; ?>" id="da015" class="form-control" required />
                </div>
              </div>

              <div class="form-group form-inline"><label for="da011" class="col-sm-1 control-label">報廢日期</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" placeholder='yyyymmdd' maxlength='8' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" onKeyPress=" keyFunction()" name="da011" value="<?php echo $da011; ?>" id="da011" class="form-control" />
                </div>
              </div>


              <div class="form-group form-inline"><label for="da016" class="col-sm-1 control-label">配料品號</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toUpperCase();" maxlength='7' onchange="check_invi02i(this)" onKeyPress="keyFunction()" name="da016" value="<?php echo $da016; ?>" id="da016" class="form-control" />
                  <a href="javascript:;">
                    <span id="Showinvi02idisp" class="glyphicon glyphicon-search"></span>
                  </a>
                  <span id="da016_disp"> </span>
                </div>
              </div>

              <div class="form-group form-inline"><label for="da017" class="col-sm-1 control-label">溫度</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" maxlength='10' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress=" keyFunction()" name="da017" value="<?php echo $da017; ?>" id="da017" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="da018" class="col-sm-1 control-label" style="color:red;">版本日期</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" placeholder='yyyymmdd' maxlength='8' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" onKeyPress=" keyFunction()" name="da018" value="<?php echo $da018; ?>" id="da018" class="form-control" />
                </div>
              </div>

              <div class="form-group form-inline"><label for="da012" class="col-sm-1 control-label">備註</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="1" style="width: 300px" onKeyPress=" keyFunction()" name="da012" value="<?php echo $da012; ?>" id="da012" class="form-control" />
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-11">
                  <div class="btn-group">

                    <button type="submit" class="btn btn-primary btn-flat">存檔</button>
                    <a href="<?php echo base_url() ?>index.php/sfc/sfci17a/display_sql" class="btn btn-warning btn-flat">上一頁</a>
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
    $('#da001').focus();
  });

  function count04() {
    var da004 = Math.round(60 / $('#da010').val() * 10) / 10;
    if ($('#da010').val()) {
      return $('#da004').val(da004);
    }

  }


  // function dupl() {
  //   var vda001 = $('#da001').val();
  //   console.log("keyin:" + vda001);


  //   $.ajax({
  //       method: "POST",
  //       url: "<?php echo base_url() ?>index.php/sfc/sfci17/check_key/" + encodeURIComponent(vda001),
  //       data: {
  //         da001: vda001,
  //       }
  //     })
  //     .done(function(msg) {
  //       // console.log("out:" + msg);
  //       if (msg == 'N') {
  //         $('#da001_disp').text('模具品號重複');
  //         return $('#da001').focus();
  //       } else if (msg == 'E') {
  //         $('#da001_disp').text('必填');
  //         return $('#da001').focus();
  //       } else {
  //         $('#da001_disp').text('ok');
  //         return $('#da002').focus();
  //       }
  //     });


  // }
</script>

</body>

</html>