<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <title><?php echo $this->session->userdata('sysml011'); ?></title>-->
  <title>ERP WEB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" name="viewport">
  <link href="<?php echo base_url() ?>assets/image/icon.png" rel="icon" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url() ?>index.php/main" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?php echo mb_convert_encoding($this->session->userdata('sysml011'), "utf-8", "big-5"); ?></b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less 80911-->
      <nav class="navbar navbar-static-top">
        <?php include("top_banner.php") ?>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo iconv("big-5", "utf-8", $this->session->userdata('sysusername')); ?></p>
            <!-- <p>王大同 研發 工程師</p> -->
            <a href="#"><i class="fa fa-circle text-success"></i> 上線</a>
          </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php include 'memu.php'; ?>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          PDA
          <small>功能 面板</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-PDA"></i> 首頁</a></li>
          <li class="active">PDA</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- solid sales graph -->
        <div class="box box-solid bg-teal-gradient">
          <div class="box-header">
            <i class="fa fa-th"></i>

            <h3 class="box-title">線上功能選單</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus">展開</i>
              </button>

              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-times">結束</i>
              </button>
            </div>
          </div>
          <div class="box-body border-radius-none">
            <div>
              <?php
              $user = trim($this->session->userdata('sysuser'));
              $super = trim($this->session->userdata('syssuper'));
              $rms = trim($this->session->userdata('sysuserrms'));
              ?>
              <!--<button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/pur/puri06/printdetailc'">請購明細表查詢</button>  -->
              <!--   <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admr02/printdetail'">新開發客戶查詢</button> -->
              <!--  <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admr03/printdetail'">逾期未收帳款查詢</button> -->
              <!--   			  <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admi04/display'">客戶上次售價查詢</button> -->
              <!--			  <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admi05/display'">客戶基本資料查詢</button> -->

              <?php if ($super == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admi00/display'">權限管理</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 7, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admi04/display'">群組建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 8, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03y/display'">報工單建立作業</button>
              <?php } ?>
			  <?php if ($super == 'Y' or  substr($rms, 8, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admr01/printdetail'">製令工時產生作業</button>
              <?php } ?>
			  
              <?php if ($super == 'Y' or  substr($rms, 21, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/scm/admi13/display'">不良原因建立作業</button>
              <?php } ?> 
              <?php if ($super == 'Y' or  substr($rms, 8, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/bom/bomi02a/display'">材料BOM建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 40, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/bom/bomi02b/display'">隱藏版-材料BOM建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 9, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/moc/moci02a/display'">配料單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 0, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03/printdetailc'">工票單列印</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 1, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci17a/display'">模具建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 2, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03/display'">生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 22, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci04/display'">製令製程建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 3, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03/exceldetail'">生產日報單轉excel</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 24, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/prs/prsi01/display'">溶解生產記錄表</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 25, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/pcl/pcli01/display'">CNC檢查表</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 26, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/pcl/pcli02/display'">拋丸粗糙度測量表</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 10, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03a/display'">鑄造-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 11, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03b/display'">鑄造機加工-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 12, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03c/display'">橡膠-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 39, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03c1/display'">橡膠-萬馬力-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 41, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03l/display'">橡膠-壓框-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 13, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03d/display'">注塑-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 14, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03e/display'">PU-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 15, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03f/display'">噴漆-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 16, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03g/display'">衝壓-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 17, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03h/display'">緊固件-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 18, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03i/display'">電焊-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 19, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03j/display'">鉚合-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 20, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03k/display'">裝配-生產日報單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 6, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci05a/display'">移轉單建立作業</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 5, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/cms/cmsi04/displayr'">線別時薪設定</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 38, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfcp03k/display'">裝配-工價設定</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 43, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfcp03g/display'">沖壓䤝合-工價設定</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 4, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03/displayr'">生產工價報表</button>
              <?php } ?>


              <?php if ($super == 'Y' or  substr($rms, 27, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03a/displayr'">鑄造-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 28, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03b/displayr'">鑄造機加工-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 29, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03c/displayr'">橡膠-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 30, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03d/displayr'">注塑-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 31, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03e/displayr'">PU-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 32, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03f/displayr'">噴漆-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 33, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03g/displayrd'">衝壓-生產工價報表</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 44, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03gj/displayr'">衝壓鉚合-入庫工價報表</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 34, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03h/displayr'">緊固件-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 35, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03i/displayr'">電焊-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 36, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03j/displayr'">鉚合-生產工價報表</button>
              <?php } ?>
              <?php if ($super == 'Y' or  substr($rms, 37, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/sfc/sfci03k/displayr'">裝配-生產工價報表</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 23, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo base_url() ?>index.php/inv/invr19a/displaym'">配料-進耗存查詢</button>
              <?php } ?>




              <?php if ($super == 'Y' or  substr($rms, 42, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo "http://192.168.100.223/"; ?>report/normal/YJ01.html'">YJ託外製令及託外進貨數量</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 45, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo "http://192.168.100.223/"; ?>report/normal/YJ02.html'">DS每月折讓金額</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 46, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo "http://192.168.100.223/"; ?>report/normal/YJ03.html'">DS國貿營收</button>
              <?php } ?>

              <?php if ($super == 'Y' or  substr($rms, 47, 1) == 'Y') { ?>
                <button type="button" class="btn btn-block btn-success btn-lg" onclick="javascript:location.href='<?php echo "http://192.168.100.223/"; ?>report/normal/YJ04.html'">LS上海辦銷售月報</button>
              <?php } ?>

            </div>
          </div>
          <!-- /.box-body -->

          <!-- /.box-footer -->
        </div>

    </div>
  </div>
  <!-- /.box -->



  </section>
  <!-- right col -->
  </div>
  <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 3.1.10
    </div>
    <strong>Copyright &copy; 2022
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- 首頁 tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE PDA demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() ?>assets/dist/js/pages/PDA.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
</body>

</html>

<script>
  //無此權限!
  var rms = '<?php echo trim($this->session->userdata('rms')); ?>';
  if (rms == 'N') {
    <?php unset($_SESSION['rms']); ?>
    alert("無此權限!");
  }
</script>