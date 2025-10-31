<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP 外掛程式 | ERP 外掛程式系統 </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo base_url() ?>assets/image/icon.png" rel="icon" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <?php
  $username = $this->input->post('username');
  $password = $this->input->post('password');
  $message = ' ';
  ?>
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b style="color:#3C8DBC">陽 江 ERP 外 掛 程 式<b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg" style="font-size:22px">陽 江 ERP 外 掛 程 式</p>

      <form method="post" action="<?php echo site_url('login/check_login'); ?>" enctype="multipart/form-data" id="form">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="User">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group">
          <span class="input-icon">
            <!--  <input type="text" class="form-control" id="captcha" name="captcha" placeholder="驗證碼" style="padding-left:45px"> -->
            <input type="text" name="captcha" value="<?php echo set_value('captcha');  ?>" placeholder="輸入驗證碼" class="h_heighttext " style="width:65%;border:1px; margin-right:0.675em;">
            <span style="size=10px;border:2px solid;background-color:#A1CBD7;;color:red;font-size:22px;text-align:center; ">&nbsp;<?php echo $this->session->userdata('captchaWord'); ?>

              <a href="<?php echo base_url() ?>" target="_self"><img src="<?php echo base_url() ?>assets/image/reload.gif" /></a></span>
            <!--   <img src="<?php echo base_url() ?>assets/image/reload.gif" style="margin-top:-55px; margin-left:4px"> -->
          </span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> 記得我
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">登入</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="social-auth-links text-left">
        <?php

        if ($query != 1) {
          $message = ' 帳號: ' . $this->input->post('username') . '或密碼錯誤!';
        } else {
          $message =  '驗證碼輸入錯誤!';
        }

        if ((!$this->input->post('username')) and (!$this->input->post('password'))) {
          $message = ' ';
        }

        ?>
        <p><?php echo '訊息：' . $message . '<span>' . '</span>' . ' ' ?></p>

      </div>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>