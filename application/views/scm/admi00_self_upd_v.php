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
          <?php foreach ($results as $row) { ?>
            <?php
            $mf001 = $row->mf001;
            $mf002 = $row->mf002;
            $mf003 = $row->mf003;

            $flag = $row->flag;
            ?>
          <?php  } ?>
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url() ?>index.php/scm/admi00/selfupdsave/<?php echo $results[0]->mf001; ?>" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">
                <div class="form-group"><label for="mf001" class="col-sm-2 control-label">使用者代號：</label>
                  <div class="col-sm-10">
                    <input type='hidden' id="mf001" onKeyPress="keyFunction()" name="mf001" value="<?php echo $mf001; ?>" type="text" required />
                    <?php echo $mf001; ?>
                  </div>
                </div>

                <div class="form-group"><label for="mf002" class="col-sm-2 control-label">使用者密碼：</label>
                  <div class="col-sm-10">
                    <input type="password" tabIndex="2" id="mf003" onKeyPress="keyFunction()" name="mf003" value="<?php echo  $mf003; ?>" required />
                  </div>
                </div>

                <div class="form-group form-inline"><label for="mf003new" class="col-sm-2 control-label">輸入新密碼：</label>
                  <div class="col-sm-10">
                    <input type="password" tabIndex="3" id="mf003new" onKeyPress="keyFunction()" name="mf003new" value="" required />
                  </div>
                </div>


                <div class="form-group"><label for="mf003newc" class="col-sm-2 control-label">確認新密碼：</label>
                  <div class="col-sm-10">
                    <input type="password" tabIndex="4" id="mf003newc" onKeyPress="keyFunction()" name="mf003newc" value="" required />
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="btn-group">

                      <button type="submit" class="btn btn-primary btn-flat">存檔</button>
                      <a href="<?php echo base_url() ?>index.php/main" class="btn btn-default btn-flat">取消</a>


                    </div>

                    <div class="success">
                      <?php
                      if ($message != '查詢一筆修改資料!') {
                        $message = '<b><font color="red">' . $message . '</font></b><br>';
                      } else {
                        $message = '<font color="blue">' . $message . '</font><br>';
                      }
                      ?>
                      <?php echo  '  提示訊息：' . $message ?> </div>

                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
                <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
              </form>
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


  </body>

  </html>
  <?php include_once './application/views/foot_brow_new_v.php'; ?>