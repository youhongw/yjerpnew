<ul class="sidebar-menu" data-widget="tree">
  <li class="header">功能選單</li>
  <li>
    <a href="<?php echo base_url() ?>index.php/main">
      <i class="glyphicon glyphicon-bell"></i> <span>首頁</span>
      <span class="pull-right-container">
        <small class="label pull-right bg-green"></small>
      </span>
    </a>
  </li>

  <!--  <li class="active treeview"> -->



  <?php
  $user = trim($this->session->userdata('sysuser'));
  $super = trim($this->session->userdata('syssuper'));
  $rms = trim($this->session->userdata('sysuserrms'));
  ?>

  <?php if ($super == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/scm/admi00/display">
        <i class="fa fa-th"></i> <span>權限管理</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 7, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/scm/admi04/display">
        <i class="fa fa-th"></i> <span>組群建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 21, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/scm/admi13/display">
        <i class="fa fa-th"></i> <span>不良原因建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 8, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/bom/bomi02a/display">
        <i class="fa fa-th"></i> <span>材料BOM建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 40, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/bom/bomi02b/display">
        <i class="fa fa-th"></i> <span>隱藏版-材料BOM建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 8, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/moc/moci02a/display">
        <i class="fa fa-th"></i> <span>配料單建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 0, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/sfc/sfci03/printdetailc">
        <i class="fa fa-th"></i> <span>工票單列印</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 1, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/sfc/sfci17a/display">
        <i class="fa fa-th"></i> <span>模具建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 22, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/sfc/sfci04/display">
        <i class="fa fa-th"></i> <span>製令製程建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>

  <!--                                第2個開始，共有2個選單 -->
  <?php if (
    $super == 'Y' or  (strpos(substr($rms, 2, 2), 'Y') !== false) or (strpos(substr($rms, 10, 11), 'Y') !== false) or (strpos(substr($rms, 24, 3), 'Y') !== false)
    or (strpos(substr($rms, 39, 1), 'Y') !== false) or (strpos(substr($rms, 41, 1), 'Y') !== false)
  ) { ?>
    <li class="treeview">
      <a>
        <i class="glyphicon glyphicon-tasks"></i><span>生產日報單</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        <?php if ($super == 'Y' or  substr($rms, 2, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03/display"><i class="fa fa-circle-o"></i>生產日報單建立作業</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 3, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03/exceldetail"><i class="fa fa-circle-o"></i>生產日報單轉excel</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 24, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/prs/prsi01/display"><i class="fa fa-circle-o"></i>溶解生產記錄表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 25, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/pcl/pcli01/display"><i class="fa fa-circle-o"></i>CNC檢查表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 26, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/pcl/pcli02/display"><i class="fa fa-circle-o"></i>拋丸粗糙度測量表</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 10, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03a/display"><i class="fa fa-circle-o"></i>鑄造-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 11, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03b/display"><i class="fa fa-circle-o"></i>鑄造機加工-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 12, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03c/display"><i class="fa fa-circle-o"></i>橡膠-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 39, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03c1/display"><i class="fa fa-circle-o"></i>橡膠-萬馬力-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 41, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03l/display"><i class="fa fa-circle-o"></i>橡膠-壓框-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 13, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03d/display"><i class="fa fa-circle-o"></i>注塑-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 14, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03e/display"><i class="fa fa-circle-o"></i>PU-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 15, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03f/display"><i class="fa fa-circle-o"></i>噴漆-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 16, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03g/display"><i class="fa fa-circle-o"></i>衝壓-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 17, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03h/display"><i class="fa fa-circle-o"></i>緊固件-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 18, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03i/display"><i class="fa fa-circle-o"></i>電焊-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 19, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03j/display"><i class="fa fa-circle-o"></i>鉚合-生產日報單建立作業</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 20, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03k/display"><i class="fa fa-circle-o"></i>裝配-生產日報單建立作業</a></li>
        <?php } ?>

      </ul>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  substr($rms, 6, 1) == 'Y') { ?>
    <li>
      <a href="<?php echo base_url() ?>index.php/sfc/sfci05a/display">
        <i class="fa fa-th"></i> <span>移轉單建立作業</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
  <?php } ?>


  <!--                                     第4個開始，共有1個選單 -->
  <?php if (
    $super == 'Y' or  (strpos(substr($rms, 4, 2), 'Y') !== false) or  (strpos(substr($rms, 27, 12), 'Y') !== false)
    or  (strpos(substr($rms, 43, 2), 'Y') !== false)
  ) { ?>
    <li class="treeview">
      <a>
        <i class="glyphicon glyphicon-tasks"></i><span>工價計算</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        <?php if ($super == 'Y' or  substr($rms, 5, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/cms/cmsi04/displayr"><i class="fa fa-circle-o"></i>線別時薪設定</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 38, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfcp03k/display"><i class="fa fa-circle-o"></i>裝配-工價設定</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 43, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfcp03g/display"><i class="fa fa-circle-o"></i>沖壓䤝合-工價設定</a></li>
        <?php } ?>
		  <?php if ($super == 'Y' or  substr($rms, 38, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfcp03ka/display"><i class="fa fa-circle-o"></i>注塑-工價設定</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 4, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03/displayr"><i class="fa fa-circle-o"></i>生產工價報表</a></li>
        <?php } ?>


        <?php if ($super == 'Y' or  substr($rms, 27, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03a/displayr"><i class="fa fa-circle-o"></i>鑄造-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 28, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03b/displayr"><i class="fa fa-circle-o"></i>鑄造機加工-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 29, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03c/displayr"><i class="fa fa-circle-o"></i>橡膠-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 30, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03d/displayr"><i class="fa fa-circle-o"></i>注塑-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 31, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03e/displayr"><i class="fa fa-circle-o"></i>PU-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 32, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03f/displayr"><i class="fa fa-circle-o"></i>噴漆-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 33, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03g/displayrd"><i class="fa fa-circle-o"></i>衝壓-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 44, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03gj/displayr"><i class="fa fa-circle-o"></i>衝壓鉚合-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 34, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03h/displayr"><i class="fa fa-circle-o"></i>緊固件-生產工價報表</a></li>
        <?php } ?>
        <?php if ($super == 'Y' or  substr($rms, 35, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03i/displayr"><i class="fa fa-circle-o"></i>電焊-生產工價報表</a></li>
        <?php } ?>
		
        <!--<?php if ($super == 'Y' or  substr($rms, 36, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03j/displayr"><i class="fa fa-circle-o"></i>鉚合-生產工價報表</a></li>
        <?php } ?>-->
		
        <!--<?php if ($super == 'Y' or  substr($rms, 37, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03k/displayr"><i class="fa fa-circle-o"></i>裝配-生產工價報表</a></li>
        <?php } ?>-->
		
        <?php if ($super == 'Y' or  substr($rms, 37, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03k/displayrnew"><i class="fa fa-circle-o"></i>裝配-生產工價報表new</a></li>
        <?php } ?>

      </ul>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  (strpos(substr($rms, 23, 1), 'Y') !== false)) { ?>
    <li class="treeview">
      <a>
        <i class="glyphicon glyphicon-tasks"></i><span>進耗存查詢</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        <?php if ($super == 'Y' or  substr($rms, 23, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/inv/invr19a/displaym"><i class="fa fa-circle-o"></i>配料-進耗存查詢</a></li>
        <?php } ?>

        <!-- <?php if ($super == 'Y' or  substr($rms, 4, 1) == 'Y') { ?>
          <li class=""><a href="<?php echo base_url() ?>index.php/sfc/sfci03/displayr"><i class="fa fa-circle-o"></i>生產工價報表</a></li>
        <?php } ?> -->

      </ul>
    </li>
  <?php } ?>

  <?php if ($super == 'Y' or  (strpos(substr($rms, 42, 1), 'Y') !== false) or  (strpos(substr($rms, 45, 3), 'Y') !== false)) { ?>
    <li class="treeview">
      <a>
        <i class="glyphicon glyphicon-tasks"></i><span>報表查詢</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        <?php if ($super == 'Y' or  substr($rms, 42, 1) == 'Y') { ?>
          <li class=""><a href="http://192.168.100.223/report/normal/YJ01.html"><i class="fa fa-circle-o"></i>YJ託外製令及託外進貨數量</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 45, 1) == 'Y') { ?>
          <li class=""><a href="http://192.168.100.223/report/normal/YJ02.html"><i class="fa fa-circle-o"></i>DS每月折讓金額</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 46, 1) == 'Y') { ?>
          <li class=""><a href="http://192.168.100.223/report/normal/YJ03.html"><i class="fa fa-circle-o"></i>DS國貿營收</a></li>
        <?php } ?>

        <?php if ($super == 'Y' or  substr($rms, 47, 1) == 'Y') { ?>
          <li class=""><a href="http://192.168.100.223/report/normal/YJ04.html"><i class="fa fa-circle-o"></i>LS上海辦銷售月報</a></li>
        <?php } ?>



      </ul>
    </li>
  <?php } ?>


</ul>