<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

  <span class="sr-only"> </span>

</a>
<span class="header" style="float:left;color:white;padding-top:13px"> </span>
<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->

    <!--   <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"> 4 訊息(mail)</li>
              <li>
                <!-- inner menu: contains the actual data -->
    <!--   <ul class="menu">
                  <li><!-- start message -->
    <!--     <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        eric
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>去大陸出差?</p>
                    </a>
                  </li>
                  <!-- end message -->
    <!--   <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        測試科技
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>回復相關訊息</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        研發
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>會議通知</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        產線
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>專案進度查詢</p>
                    </a>
                  </li>
                 
                </ul>
              </li>
              <li class="footer"><a href="#">全部訊息</a></li>
            </ul>
          </li> -->
    <!-- Notifications: style can be found in dropdown.less -->
    <!--  <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">10 通知</li>
              <li>
                <!-- inner menu: contains the actual data -->
    <!--      <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 未簽核
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> 主管交辦
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 訊息未回
                    </a>
                  </li>
                 
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> 登入次數
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">所有項目</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
    <li class="dropdown tasks-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- <i class="fa fa-flag-o"></i> -->
        <i class="fa fa-bell-o"></i>
        <?php if ($this->session->userdata('yjerp_onlinenum') <= 5) { ?>
          <span class="label label-success"><?php echo $this->session->userdata('yjerp_onlinenum'); ?></span>
        <?php } else if ($this->session->userdata('yjerp_onlinenum') <= 10) { ?>
          <span class="label label-warning"><?php echo $this->session->userdata('yjerp_onlinenum'); ?></span>
        <?php } else { ?>
          <span class="label label-danger"><?php echo $this->session->userdata('yjerp_onlinenum'); ?></span>
        <?php } ?>
      </a>
      <ul class="dropdown-menu">
        <li class="header"><i class="fa fa-user text-red"></i>　<span id="keydispnum">在線人數︰<?php echo $this->session->userdata('yjerp_onlinenum'); ?></li>
        <!-- <li>
          <ul class="menu">
            <li>
              <a href="#">
                <h3>
                  打電話
                  <small class="pull-right">20%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="#">
                <h3>
                  去開會
                  <small class="pull-right">40%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">40% Complete</span>
                  </div>
                </div>
              </a>
            </li>

            <li>
              <a href="#">
                <h3>
                  寫程式
                  <small class="pull-right">60%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">60% Complete</span>
                  </div>
                </div>
              </a>
            </li>

            <li>
              <a href="#">
                <h3>
                  客戶來訪
                  <small class="pull-right">80%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">80% Complete</span>
                  </div>
                </div>
              </a>
            </li>

          </ul>
        </li>
        <li class="footer">
          <a href="#">所有工作</a>
        </li> -->
      </ul>
    </li>
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="user-image" alt="User Image">
        <!-- 設定是否輸出錯誤資訊 -->
        <?php ini_set('display_errors', "off"); ?>
        <span class="hidden-xs"><?php echo iconv("big-5", "utf-8", $this->session->userdata('sysusername')) . '(名片)'; ?></span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="<?php echo base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">


          <p><?php echo iconv("big-5", "utf-8", $this->session->userdata('sysusername')); ?></p>
          <!-- <small>1987/3/1 出生日期 </small>
				  <img src="../phpqrcode/temp/test.png" class="img-circle" alt="User Image2"><bR>-->
          <!--  <br> -->
          <!-- 設定是否輸出錯誤資訊 -->
          <?php ini_set('display_errors', "on"); ?>
        </li>

        <!-- Menu Body -->
        <li class="user-body">
          <div class="pull-left">
            <a href="<?php echo base_url() ?>index.php/scm/admi00/selfupdform" class="btn btn-default btn-flat">修改密碼</a>
          </div>
          <div class="pull-right">
            <a href="<?php echo base_url() ?>index.php/login" class="btn btn-default btn-flat">登出</a>
          </div>
          <!-- /.row -->
        </li>
        <!-- Menu Footer-->

        <!--   <li class="user-footer">
                <div class="pull-left">
				<p>
                    客戶服務: caes@gmail.com
				</p>
                </div> 
              </li> -->
        <!--  <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">個人履歷</a>
                </div> 
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>index.php/login" class="btn btn-default btn-flat">登出</a>
                </div>
              </li> -->
      </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->

  </ul>
</div>
<script>
  var xmlHttp;

  function createXMLHttpRequest() { //不更新網頁 判斷適用各種流覽器 共用 (全域)
    if (window.ActiveXObject)
      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    else if (window.XMLHttpRequest)
      xmlHttp = new XMLHttpRequest();
  }

  //閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 288
  function Msg() {
    alert("閒置超時，系統強制登出!"); //設定60分鐘沒動作時強制登 改8小時
    location = "<?php echo base_url() ?>index.php/login/";
  }
  window.setInterval("Msg()", 28800000);
</script>
<script>
  function updtime1() {
    $.ajax({
        method: "POST",
        url: "<?php echo base_url() ?>index.php/main/onlinenum/",
        data: {
          userid: '<?php echo $this->session->userdata('manager'); ?>',
        }
      })
      .done(function(msg) {
        // console.log('msg:' + msg);
        console.log('onlinenum_man:' + '<?php echo $this->session->userdata('yjerp_onlinenum'); ?>');
        console.log('impact_man:' + '<?php echo $this->session->userdata('yjerp_impact'); ?>');
        $("#keydispnum").html("在線人數︰" + "<?php echo $this->session->userdata('yjerp_onlinenum'); ?>");
        if ('<?php echo $this->session->userdata('yjerp_impact'); ?>' == '0' || '<?php echo $this->session->userdata('yjerp_impact'); ?>' == '') {
          alert('請登入系統！！！');
          location = "<?php echo base_url() ?>index.php/login/";
        }
        if ('<?php echo $this->session->userdata('yjerp_onlinenum'); ?>' > 100) {
          alert('登入人數超過限制！！！');
          location = "<?php echo base_url() ?>index.php/login/";
        }
      });
  }
  window.setInterval("updtime1()", 3000); //3秒刷新一次登入人數
</script>