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
          $me001 = trim($row->me001);
          $me002 = mb_convert_encoding(trim($row->me002), "utf-8", "big-5");
          $me003 = trim($row->me003);
          $me004 = mb_convert_encoding(trim($row->me004), "utf-8", "big-5");
          $flag = trim($row->flag);
        }
        ?>
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">使用者 - 修改</h3>-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url() ?>index.php/scm/admi04/updsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

              <div class="form-group form-inline"><label for="me001" class="col-sm-1 control-label">群組代號</label>
                <div class="col-sm-11">
                  <input type="hidden" tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='10' onblur="dupl(this)" onKeyPress="keyFunction()" name="me001" value="<?php echo $me001; ?>" id="me001" class="form-control" required />
                  <?php echo $me001; ?>
                  <!-- <span id="me001_disp"> </span> -->
                </div>
              </div>

              <div class="form-group form-inline"><label for="me002" class="col-sm-1 control-label">群組名稱</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="2" style="width: 300px" maxlength='15' onKeyPress="keyFunction()" name="me002" value="<?php echo $me002; ?>" id="me002" class="form-control" />
                </div>
              </div>


              <!-- <div class="form-group form-inline"><label for="me003" class="col-sm-1 control-label">群組權限代碼</label>
  								<div class="col-sm-11">
  									<input type="text" tabIndex="3" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');" maxlength='10' onKeyPress=" keyFunction()" name="me003" value="<?php echo $me003; ?>" id="me003" class="form-control" required />
  								</div>
  							</div> -->

              <div class="form-group form-inline"><label for="me004" class="col-sm-1 control-label">備註</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="4" style="width: 300px" onKeyPress=" keyFunction()" name="me004" value="<?php echo $me004; ?>" id="me004" class="form-control" />
                  <input type="hidden" name="flag" value="<?php echo $flag; ?>" id="flag" class="form-control" />
                </div>
              </div>




              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-11">
                  <div class="btn-group">

                    <button type="submit" class="btn btn-primary btn-flat">存檔</button>
                    <a href="<?php echo base_url() ?>index.php/scm/admi04/display" class="btn btn-warning btn-flat">上一頁</a>
                    <a href="<?php echo base_url() ?>index.php/main" class="btn btn-default btn-flat">首頁</a>

                  </div>

                  <div class="success">
                    <?php
                    if ($message != '查詢一筆修改資料!') {
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


<!-- 共用函數 -->
<!-- 不更新網頁 自動提示方框資料google 提示前置小工具 
<script type="text/javascript">
  $.widget('custom.catcomplete', $.ui.autocomplete, {
    _renderMenu: function(ul, items) {
      var self = this,
        currentCategory = '';

      $.each(items, function(index, item) {
        if (item.category != currentCategory) {
          ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');

          currentCategory = item.category;
        }

        self._renderItem(ul, item);
      });
    }
  });
</script>-->
<?php include_once './application/views/foot_open_v.php'; ?>
<?php include_once './application/views/funnew/admi04_funmjs_v.php'; ?>

</body>

</html>

<script>
  $(document).ready(function() {
    $('#me002').focus();
  });
</script>