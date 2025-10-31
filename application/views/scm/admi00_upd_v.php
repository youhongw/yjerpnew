<?php include_once './application/views/head_v.php'; ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <small><small><?php echo $systitle; ?></small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>index.php/main"><i class="fa fa-dashboard"></i> 首頁</a></li>
      <!--  <li><a href="<?php echo base_url() ?>assets/admin/groups">進貨入庫單</a></li> -->
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
          $mf001 = trim($row->mf001);
          $mf002 = mb_convert_encoding(trim($row->mf002), "utf-8", "big-5");
          $mf003 = trim($row->mf003);
          $mf004 = trim($row->mf004);
          $mf005 = trim($row->mf005);
          $mf006 = 'N';
          $mf007 = trim($row->mf007);
          $flag = trim($row->flag);
          $mf0061 = 'N';
          if (isset($row->mf006)) {
            $mf611 = substr($row->mf006, 0, 1);
            $mf612 = substr($row->mf006, 1, 1);
            $mf613 = substr($row->mf006, 2, 1);
            $mf614 = substr($row->mf006, 3, 1);
            $mf615 = substr($row->mf006, 4, 1);
            $mf616 = substr($row->mf006, 5, 1);
            $mf617 = substr($row->mf006, 6, 1);
            $mf618 = substr($row->mf006, 7, 1);
            $mf619 = substr($row->mf006, 8, 1);
            $mf620 = substr($row->mf006, 9, 1);
            $mf621 = substr($row->mf006, 10, 1);
            $mf622 = substr($row->mf006, 11, 1);
            $mf623 = substr($row->mf006, 12, 1);
            $mf624 = substr($row->mf006, 13, 1);
            $mf625 = substr($row->mf006, 14, 1);
            $mf626 = substr($row->mf006, 15, 1);
            $mf627 = substr($row->mf006, 16, 1);
            $mf628 = substr($row->mf006, 17, 1);
            $mf629 = substr($row->mf006, 18, 1);
            $mf630 = substr($row->mf006, 19, 1);
            $mf631 = substr($row->mf006, 20, 1);
            $mf632 = substr($row->mf006, 21, 1);
            $mf633 = substr($row->mf006, 22, 1);
            $mf634 = substr($row->mf006, 23, 1);
            $mf635 = substr($row->mf006, 24, 1);
            $mf636 = substr($row->mf006, 25, 1);
            $mf637 = substr($row->mf006, 26, 1);
            $mf638 = substr($row->mf006, 27, 1);
            $mf639 = substr($row->mf006, 28, 1);
            $mf640 = substr($row->mf006, 29, 1);
            $mf641 = substr($row->mf006, 30, 1);
            $mf642 = substr($row->mf006, 31, 1);
            $mf643 = substr($row->mf006, 32, 1);
            $mf644 = substr($row->mf006, 33, 1);
            $mf645 = substr($row->mf006, 34, 1);
            $mf646 = substr($row->mf006, 35, 1);
            $mf647 = substr($row->mf006, 36, 1);
            $mf648 = substr($row->mf006, 37, 1);
            $mf649 = substr($row->mf006, 38, 1);
            $mf650 = substr($row->mf006, 39, 1);
            $mf651 = substr($row->mf006, 40, 1);
            $mf652 = substr($row->mf006, 41, 1);
            $mf653 = substr($row->mf006, 42, 1);
            $mf654 = substr($row->mf006, 43, 1);
            $mf655 = substr($row->mf006, 44, 1);
            $mf656 = substr($row->mf006, 45, 1);
            $mf657 = substr($row->mf006, 46, 1);
            $mf658 = substr($row->mf006, 47, 1);
          } else {
            $mf611 = 'N';
            $mf612 = 'N';
            $mf613 = 'N';
            $mf614 = 'N';
            $mf615 = 'N';
            $mf616 = 'N';
            $mf617 = 'N';
            $mf618 = 'N';
            $mf619 = 'N';
            $mf620 = 'N';
            $mf621 = 'N';
            $mf622 = 'N';
            $mf623 = 'N';
            $mf624 = 'N';
            $mf625 = 'N';
            $mf626 = 'N';
            $mf627 = 'N';
            $mf628 = 'N';
            $mf629 = 'N';
            $mf630 = 'N';
            $mf631 = 'N';
            $mf632 = 'N';
            $mf633 = 'N';
            $mf634 = 'N';
            $mf635 = 'N';
            $mf636 = 'N';
            $mf637 = 'N';
            $mf638 = 'N';
            $mf639 = 'N';
            $mf640 = 'N';
            $mf641 = 'N';
            $mf642 = 'N';
            $mf643 = 'N';
            $mf644 = 'N';
            $mf645 = 'N';
            $mf646 = 'N';
            $mf647 = 'N';
            $mf648 = 'N';
            $mf649 = 'N';
            $mf650 = 'N';
            $mf651 = 'N';
            $mf652 = 'N';
            $mf653 = 'N';
            $mf654 = 'N';
            $mf655 = 'N';
            $mf656 = 'N';
            $mf657 = 'N';
            $mf658 = 'N';
          }


          // 	$mf007 = $this->input->post('mf007');

        }
        ?>
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">使用者 - 修改</h3>-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo base_url() ?>index.php/scm/admi00/updsave" class="form-horizontal" id="form-edit_group" method="post" accept-charset="utf-8">

              <div class="form-group form-inline"><label for="mf001" class="col-sm-1 control-label">使用者代號</label>
                <div class="col-sm-11" style="height: 27px;">
                  <input type='hidden' tabIndex="1" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');" maxlength='10' onblur="dupl(this)" onKeyPress="keyFunction()" name="mf001" value="<?php echo $mf001; ?>" id="mf001" class="form-control" />
                  <?php echo $mf001; ?>
                  <!-- <span id="mf001_disp"> </span> -->
                </div>
              </div>

              <div class="form-group form-inline"><label for="mf002" class="col-sm-1 control-label">使用者名稱</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="2" style="width: 300px" maxlength='10' onKeyPress="keyFunction()" name="mf002" value="<?php echo $mf002; ?>" id="mf002" class="form-control" />
                </div>
              </div>


              <div class="form-group form-inline"><label for="mf003" class="col-sm-1 control-label">使用者密碼</label>
                <div class="col-sm-11">
                  <input type="password" tabIndex="3" style="width: 300px" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');" maxlength='10' onKeyPress=" keyFunction()" name="mf003" value="<?php echo $mf003; ?>" id="mf003" class="form-control" required />
                </div>
              </div>

              <div class="form-group form-inline"><label for="mf004" class="col-sm-1 control-label">群組代號</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="4" style="width: 300px" maxlength='20' onchange="check_admi04(this)" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" onKeyPress=" keyFunction()" name="admi04" value="<?php echo $mf004; ?>" id="admi04" class="form-control" />
                  <a href="javascript:;">
                    <span id="Showadmi04disp" class="glyphicon glyphicon-search"></span>
                  </a>
                  <span id="admi04disp"> </span>
                </div>
              </div>

              <div class="form-group form-inline"><label for="mf005" class="col-sm-1 control-label">超級使用者</label>
                <div class="col-sm-11" style="height: 27px;">
                  <input type="hidden" name="mf005" class="mf005" value="N" />
                  <input tabIndex="4" style="vertical-align:-moz-middle-with-baseline;" id="mf005" onKeyPress="keyFunction()" name="mf005" <?php if ($mf005 == 'Y') echo 'checked'; ?> <?php if ($mf005 != 'Y') echo 'check'; ?> value="Y" size="1" type='checkbox' />
                </div>
              </div>

              <div class="form-group form-inline"><label for="mf007" class="col-sm-1 control-label">部門代號</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="6" style="width: 300px" maxlength='4' onchange="check_cmsi05(this)" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" onKeyPress=" keyFunction()" name="cmsi05" value="<?php echo $mf007; ?>" id="cmsi05" class="form-control" />
                  <a href="javascript:;">
                    <span id="Showcmsi05disp" class="glyphicon glyphicon-search"></span>
                  </a>
                  <span id="cmsi05disp"> </span>
                </div>
              </div>


              <div class="form-group form-inline"><label for="mf006" class="col-sm-1 control-label">權限管理</label>
                <div class="col-sm-11">

                  <div>
                    <input type="hidden" name="mf611" class="mf611" value="N" />
                    <input type="checkbox" name="mf611" id="mf611" <?php if ($mf611 == 'Y') echo 'checked'; ?> <?php if ($mf611 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>0.工票單列印</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf612" class="mf612" value="N" />
                    <input type="checkbox" name="mf612" id="mf612" <?php if ($mf612 == 'Y') echo 'checked'; ?> <?php if ($mf612 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>1.模具建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf613" class="mf613" value="N" />
                    <input type="checkbox" name="mf613" id="mf613" <?php if ($mf613 == 'Y') echo 'checked'; ?> <?php if ($mf613 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>2.生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf614" class="mf614" value="N" />
                    <input type="checkbox" name="mf614" id="mf614" <?php if ($mf614 == 'Y') echo 'checked'; ?> <?php if ($mf614 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>3.生產日報單轉excel</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf615" class="mf615" value="N" />
                    <input type="checkbox" name="mf615" id="mf615" <?php if ($mf615 == 'Y') echo 'checked'; ?> <?php if ($mf615 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>4.生產工價報表</span>
                  </div>


                  <div>
                    <input type="hidden" name="mf616" class="mf616" value="N" />
                    <input type="checkbox" name="mf616" id="mf616" <?php if ($mf616 == 'Y') echo 'checked'; ?> <?php if ($mf616 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>5.線別時薪設定</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf617" class="mf617" value="N" />
                    <input type="checkbox" name="mf617" id="mf617" <?php if ($mf617 == 'Y') echo 'checked'; ?> <?php if ($mf617 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>6.移轉單建立作業</span>
                    <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
                  </div>

                  <div>
                    <input type="hidden" name="mf618" class="mf618" value="N" />
                    <input type="checkbox" name="mf618" id="mf618" <?php if ($mf618 == 'Y') echo 'checked'; ?> <?php if ($mf618 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>7.群組建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf619" class="mf619" value="N" />
                    <input type="checkbox" name="mf619" id="mf619" <?php if ($mf619 == 'Y') echo 'checked'; ?> <?php if ($mf619 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>8.材料BOM建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf620" class="mf620" value="N" />
                    <input type="checkbox" name="mf620" id="mf620" <?php if ($mf620 == 'Y') echo 'checked'; ?> <?php if ($mf620 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>9.配料單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf621" class="mf621" value="N" />
                    <input type="checkbox" name="mf621" id="mf621" <?php if ($mf621 == 'Y') echo 'checked'; ?> <?php if ($mf621 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>10.鑄造-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf622" class="mf622" value="N" />
                    <input type="checkbox" name="mf622" id="mf622" <?php if ($mf622 == 'Y') echo 'checked'; ?> <?php if ($mf622 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>11.鑄造機加工-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf623" class="mf623" value="N" />
                    <input type="checkbox" name="mf623" id="mf623" <?php if ($mf623 == 'Y') echo 'checked'; ?> <?php if ($mf623 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>12.橡膠-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf624" class="mf624" value="N" />
                    <input type="checkbox" name="mf624" id="mf624" <?php if ($mf624 == 'Y') echo 'checked'; ?> <?php if ($mf624 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>13.注塑-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf625" class="mf625" value="N" />
                    <input type="checkbox" name="mf625" id="mf625" <?php if ($mf625 == 'Y') echo 'checked'; ?> <?php if ($mf625 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>14.PU-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf626" class="mf626" value="N" />
                    <input type="checkbox" name="mf626" id="mf626" <?php if ($mf626 == 'Y') echo 'checked'; ?> <?php if ($mf626 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>15.噴漆-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf627" class="mf627" value="N" />
                    <input type="checkbox" name="mf627" id="mf627" <?php if ($mf627 == 'Y') echo 'checked'; ?> <?php if ($mf627 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>16.衝壓-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf628" class="mf628" value="N" />
                    <input type="checkbox" name="mf628" id="mf628" <?php if ($mf628 == 'Y') echo 'checked'; ?> <?php if ($mf628 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>17.緊固件-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf629" class="mf629" value="N" />
                    <input type="checkbox" name="mf629" id="mf629" <?php if ($mf629 == 'Y') echo 'checked'; ?> <?php if ($mf629 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>18.電焊-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf630" class="mf630" value="N" />
                    <input type="checkbox" name="mf630" id="mf630" <?php if ($mf630 == 'Y') echo 'checked'; ?> <?php if ($mf630 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>19.鉚合-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf631" class="mf631" value="N" />
                    <input type="checkbox" name="mf631" id="mf631" <?php if ($mf631 == 'Y') echo 'checked'; ?> <?php if ($mf631 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>20.裝配-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf632" class="mf632" value="N" />
                    <input type="checkbox" name="mf632" id="mf632" <?php if ($mf632 == 'Y') echo 'checked'; ?> <?php if ($mf632 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>21.不良原因建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf633" class="mf633" value="N" />
                    <input type="checkbox" name="mf633" id="mf633" <?php if ($mf633 == 'Y') echo 'checked'; ?> <?php if ($mf633 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>22.製令製程建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf634" class="mf634" value="N" />
                    <input type="checkbox" name="mf634" id="mf634" <?php if ($mf634 == 'Y') echo 'checked'; ?> <?php if ($mf634 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>23.配料-進耗存查詢</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf635" class="mf635" value="N" />
                    <input type="checkbox" name="mf635" id="mf635" <?php if ($mf635 == 'Y') echo 'checked'; ?> <?php if ($mf635 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>24.溶解生產記錄表</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf636" class="mf636" value="N" />
                    <input type="checkbox" name="mf636" id="mf636" <?php if ($mf636 == 'Y') echo 'checked'; ?> <?php if ($mf636 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>25.CNC檢查表</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf637" class="mf637" value="N" />
                    <input type="checkbox" name="mf637" id="mf637" <?php if ($mf637 == 'Y') echo 'checked'; ?> <?php if ($mf637 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>26.拋丸粗糙度測量表</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf638" class="mf638" value="N" />
                    <input type="checkbox" name="mf638" id="mf638" <?php if ($mf638 == 'Y') echo 'checked'; ?> <?php if ($mf638 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>27.鑄造-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf639" class="mf639" value="N" />
                    <input type="checkbox" name="mf639" id="mf639" <?php if ($mf639 == 'Y') echo 'checked'; ?> <?php if ($mf639 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>28.鑄造機加工-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf640" class="mf640" value="N" />
                    <input type="checkbox" name="mf640" id="mf640" <?php if ($mf640 == 'Y') echo 'checked'; ?> <?php if ($mf640 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>29.橡膠-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf641" class="mf641" value="N" />
                    <input type="checkbox" name="mf641" id="mf641" <?php if ($mf641 == 'Y') echo 'checked'; ?> <?php if ($mf641 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>30.注塑-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf642" class="mf642" value="N" />
                    <input type="checkbox" name="mf642" id="mf642" <?php if ($mf642 == 'Y') echo 'checked'; ?> <?php if ($mf642 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>31.PU-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf643" class="mf643" value="N" />
                    <input type="checkbox" name="mf643" id="mf643" <?php if ($mf643 == 'Y') echo 'checked'; ?> <?php if ($mf643 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>32.噴漆-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf644" class="mf644" value="N" />
                    <input type="checkbox" name="mf644" id="mf644" <?php if ($mf644 == 'Y') echo 'checked'; ?> <?php if ($mf644 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>33.衝壓-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf645" class="mf645" value="N" />
                    <input type="checkbox" name="mf645" id="mf645" <?php if ($mf645 == 'Y') echo 'checked'; ?> <?php if ($mf645 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>34.緊固件-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf646" class="mf646" value="N" />
                    <input type="checkbox" name="mf646" id="mf646" <?php if ($mf646 == 'Y') echo 'checked'; ?> <?php if ($mf646 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>35.電焊-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf647" class="mf647" value="N" />
                    <input type="checkbox" name="mf647" id="mf647" <?php if ($mf647 == 'Y') echo 'checked'; ?> <?php if ($mf647 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>36.鉚合-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf648" class="mf648" value="N" />
                    <input type="checkbox" name="mf648" id="mf648" <?php if ($mf648 == 'Y') echo 'checked'; ?> <?php if ($mf648 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>37.裝配-生產工價報表</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf649" class="mf649" value="N" />
                    <input type="checkbox" name="mf649" id="mf649" <?php if ($mf649 == 'Y') echo 'checked'; ?> <?php if ($mf649 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>38.裝配-工價設定</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf650" class="mf650" value="N" />
                    <input type="checkbox" name="mf650" id="mf650" <?php if ($mf650 == 'Y') echo 'checked'; ?> <?php if ($mf650 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>39.橡膠-萬馬力-生產日報單建立作業</span>
                  </div>
                  <div>
                    <input type="hidden" name="mf651" class="mf651" value="N" />
                    <input type="checkbox" name="mf651" id="mf651" <?php if ($mf651 == 'Y') echo 'checked'; ?> <?php if ($mf651 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>40.隱藏版-材料BOM建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf652" class="mf652" value="N" />
                    <input type="checkbox" name="mf652" id="mf652" <?php if ($mf652 == 'Y') echo 'checked'; ?> <?php if ($mf652 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>41.橡膠-壓框-生產日報單建立作業</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf654" class="mf654" value="N" />
                    <input type="checkbox" name="mf654" id="mf654" <?php if ($mf654 == 'Y') echo 'checked'; ?> <?php if ($mf654 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>43.沖壓䤝合-工價設定</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf655" class="mf655" value="N" />
                    <input type="checkbox" name="mf655" id="mf655" <?php if ($mf655 == 'Y') echo 'checked'; ?> <?php if ($mf655 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>44.衝壓䤝合-入庫工價查詢</span>
                  </div>


                  報表-------------------------------
                  <div>
                    <input type="hidden" name="mf653" class="mf653" value="N" />
                    <input type="checkbox" name="mf653" id="mf653" <?php if ($mf653 == 'Y') echo 'checked'; ?> <?php if ($mf653 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>42.YJ託外製令及託外進貨數量</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf656" class="mf656" value="N" />
                    <input type="checkbox" name="mf656" id="mf656" <?php if ($mf656 == 'Y') echo 'checked'; ?> <?php if ($mf656 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>45.DS每月折讓金額</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf657" class="mf657" value="N" />
                    <input type="checkbox" name="mf657" id="mf657" <?php if ($mf657 == 'Y') echo 'checked'; ?> <?php if ($mf657 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>46.DS國貿營收</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf658" class="mf658" value="N" />
                    <input type="checkbox" name="mf658" id="mf658" <?php if ($mf658 == 'Y') echo 'checked'; ?> <?php if ($mf658 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>47.LS上海辦銷售月報</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf006" value="N" />
                    <input type="checkbox" name="mf006" id="mf006" onclick="check_mf006y();" onKeyPress="keyFunction()" <?php if ($mf006 == 'Y') echo 'checked'; ?> <?php if ($mf006 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>全選</span>
                  </div>

                  <div>
                    <input type="hidden" name="mf0061" value="N" />
                    <input type="checkbox" name="mf0061" id="mf0061" onclick="check_mf006n();" onKeyPress="keyFunction()" <?php if ($mf0061 == 'Y') echo 'checked'; ?> <?php if ($mf0061 !== 'Y') echo 'check'; ?> value="Y" />　
                    <span>全不選</span>
                  </div>

                </div>
              </div>

              <!-- <div class="form-group form-inline"><label for="mf007" class="col-sm-1 control-label">部門代號</label>
                <div class="col-sm-11">
                  <input type="text" tabIndex="3" style="width: 300px" maxlength='10' onKeyPress=" keyFunction()" name="mf007" value="<?php $mf007; ?>" id="mf004" class="form-control" />
                </div>
              </div> -->


              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-11">
                  <div class="btn-group">

                    <button type="submit" class="btn btn-primary btn-flat">存檔</button>
                    <a href="<?php echo base_url() ?>index.php/scm/admi00/display_sql" class="btn btn-warning btn-flat">上一頁</a>
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
<?php include_once './application/views/funnew/cmsi05_funmjs_v.php'; ?>
<!-- 品號 -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#mf001').focus();
  });


  function dupl() {
    var vmf001 = $('#mf001').val();
    console.log("keyin:" + vmf001);

    $.ajax({
        method: "POST",
        url: "<?php echo base_url() ?>index.php/scm/admi00/check_key/" + encodeURIComponent(vmf001),
        data: {
          mf001: vmf001,
        }
      })
      .done(function(msg) {
        console.log("out:" + msg);
        if (msg == 'N') {
          $('#mf001_disp').text('使用者代號重複');
          return $('#mf001').focus();
        }
      });
  }
</script>
<script type="text/javascript">
  function check_mf006y() {
    var checky = "Y";

    console.log(checky);
    document.getElementById("mf0061").checked = false;

    document.getElementById("mf611").checked = true;
    document.getElementById("mf612").checked = true;
    document.getElementById("mf613").checked = true;
    document.getElementById("mf614").checked = true;
    document.getElementById("mf615").checked = true;
    document.getElementById("mf616").checked = true;
    document.getElementById("mf617").checked = true;
    document.getElementById("mf618").checked = true;
    document.getElementById("mf619").checked = true;
    document.getElementById("mf620").checked = true;
    document.getElementById("mf621").checked = true;
    document.getElementById("mf622").checked = true;
    document.getElementById("mf623").checked = true;
    document.getElementById("mf624").checked = true;
    document.getElementById("mf625").checked = true;
    document.getElementById("mf626").checked = true;
    document.getElementById("mf627").checked = true;
    document.getElementById("mf628").checked = true;
    document.getElementById("mf629").checked = true;
    document.getElementById("mf630").checked = true;
    document.getElementById("mf631").checked = true;
    document.getElementById("mf632").checked = true;
    document.getElementById("mf633").checked = true;
    document.getElementById("mf634").checked = true;
    document.getElementById("mf635").checked = true;
    document.getElementById("mf636").checked = true;
    document.getElementById("mf637").checked = true;
    document.getElementById("mf638").checked = true;
    document.getElementById("mf639").checked = true;
    document.getElementById("mf640").checked = true;
    document.getElementById("mf641").checked = true;
    document.getElementById("mf642").checked = true;
    document.getElementById("mf643").checked = true;
    document.getElementById("mf644").checked = true;
    document.getElementById("mf645").checked = true;
    document.getElementById("mf646").checked = true;
    document.getElementById("mf647").checked = true;
    document.getElementById("mf648").checked = true;
    document.getElementById("mf649").checked = true;
    document.getElementById("mf650").checked = true;
    document.getElementById("mf651").checked = true;
    document.getElementById("mf652").checked = true;
    document.getElementById("mf653").checked = true;
    document.getElementById("mf654").checked = true;
    document.getElementById("mf655").checked = true;
    document.getElementById("mf656").checked = true;
    document.getElementById("mf657").checked = true;
    document.getElementById("mf658").checked = true;
  }

  function check_mf006n() {
    var checky = "N";

    console.log(checky);
    document.getElementById("mf006").checked = false;

    document.getElementById("mf611").checked = false;
    document.getElementById("mf612").checked = false;
    document.getElementById("mf613").checked = false;
    document.getElementById("mf614").checked = false;
    document.getElementById("mf615").checked = false;
    document.getElementById("mf616").checked = false;
    document.getElementById("mf617").checked = false;
    document.getElementById("mf618").checked = false;
    document.getElementById("mf619").checked = false;
    document.getElementById("mf620").checked = false;
    document.getElementById("mf621").checked = false;
    document.getElementById("mf622").checked = false;
    document.getElementById("mf623").checked = false;
    document.getElementById("mf624").checked = false;
    document.getElementById("mf625").checked = false;
    document.getElementById("mf626").checked = false;
    document.getElementById("mf627").checked = false;
    document.getElementById("mf628").checked = false;
    document.getElementById("mf629").checked = false;
    document.getElementById("mf630").checked = false;
    document.getElementById("mf631").checked = false;
    document.getElementById("mf632").checked = false;
    document.getElementById("mf633").checked = false;
    document.getElementById("mf634").checked = false;
    document.getElementById("mf635").checked = false;
    document.getElementById("mf636").checked = false;
    document.getElementById("mf637").checked = false;
    document.getElementById("mf638").checked = false;
    document.getElementById("mf639").checked = false;
    document.getElementById("mf640").checked = false;
    document.getElementById("mf641").checked = false;
    document.getElementById("mf642").checked = false;
    document.getElementById("mf643").checked = false;
    document.getElementById("mf644").checked = false;
    document.getElementById("mf645").checked = false;
    document.getElementById("mf646").checked = false;
    document.getElementById("mf647").checked = false;
    document.getElementById("mf648").checked = false;
    document.getElementById("mf649").checked = false;
    document.getElementById("mf650").checked = false;
    document.getElementById("mf651").checked = false;
    document.getElementById("mf652").checked = false;
    document.getElementById("mf653").checked = false;
    document.getElementById("mf654").checked = false;
    document.getElementById("mf655").checked = false;
    document.getElementById("mf656").checked = false;
    document.getElementById("mf657").checked = false;
    document.getElementById("mf658").checked = false;
  }
</script>
</body>

</html>