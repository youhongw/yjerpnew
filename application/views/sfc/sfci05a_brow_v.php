<div class="box2">
  <!-- div-1 -->
  <div class="heading">
    <h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 移轉單建立作業-瀏覽　　　</h1>

    <div style="float:left; ">
      <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci05a/clear_sql_term'" style="float:left" accesskey="a" class="button"><span>重新整理 a </span><img height="12" width="12" src="<?php echo base_url() ?>assets/image/delete2.png" /></a>
      <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci05/addform'" style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url() ?>assets/image/png/add.png" /></a>
      <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url() ?>assets/image/png/del.png" /></a>
      <a onclick="location = '<?php echo base_url() ?>index.php/main/index'" style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url() ?>assets/image/png/close.png" /></a>
      <?php
      if ($message != '資料瀏覽成功!') {
        $message = '<span><font color="red">' . $message . '</font></span>';
        echo $message;
      }
      ?>
    </div>
  </div>
  <?php
  $title_array = array(
    'edit' => array('sort_name' => "", 'name' => "修改管理", 'width' => "4%", 'align' => "center"),
    'rowid' => array('sort_name' => "TB001", 'name' => "序號", 'width' => "2%", 'align' => "center", 'use' => "disable"),
    'TB001' => array('sort_name' => "TB001", 'name' => "移轉單別", 'width' => "10%", 'align' => "center"),
    'TB002' => array('sort_name' => "TB002", 'name' => "移轉單號", 'width' => "10%", 'align' => "center"),
    'TB015' => array('sort_name' => "TB015", 'name' => "單據日期", 'width' => "10%", 'align' => "center"),
    'TB004' => array('sort_name' => "TB004", 'name' => "移出類別", 'width' => "10%", 'align' => "center"),
    'TB005' => array('sort_name' => "TB005", 'name' => "移出部門", 'width' => "10%", 'align' => "center"),
    'TB007' => array('sort_name' => "TB007", 'name' => "移入類別", 'width' => "10%", 'align' => "center"),
    'TB008' => array('sort_name' => "TB008", 'name' => "移入部門", 'width' => "10%", 'align' => "center"),

  );
  ?>


  <div class="content">
    <!-- div-2 -->
    <form action="<?php echo base_url() ?>index.php/sfc/sfci05a/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <!-- 表格開始 The [attribute*=value] selector selects each element with a specific attribute, with a value containing a string.-->
        <thead>
          <tr>
            <!-- 表格表頭 attribute和property都可以翻译为属性，为了以示区别，通常把这两个单词翻译为属性与特性-->
            <td width="1%" style="text-align: center;">
              <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
            </td>
            <?php
            foreach ($title_array as $key => $val) {
              echo "<td width=" . $val['width'] . " class='" . $val['align'] . "'>";
              echo $val['name'];
              if (isset($val['use'])) {
                if ($val['use'] == "disable") {
                  echo "</td>";
                  continue;
                }
              }
              if ($val['sort_name'] == "") {
                echo "</td>";
                continue;
              }

              $str = " <img src='" . base_url() . "assets/image/ascw.png' />";
              echo anchor("sfc/sfci05a/display_search/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " asc", $str);

              $str = " <img src='" . base_url() . "assets/image/descw.png' />";
              echo anchor("sfc/sfci05a/display_search/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " desc", $str);
              echo "</td>";
            }
            ?>
          </tr>
        </thead>
        <?php
        $filter_array = array(
          'rowid' => array('filter_name' => "", 'name' => "序號", 'size' => "12", 'align' => "left", 'use' => "disable"),
          'TB001' => array('filter_name' => "TB001", 'name' => "移轉單別", 'size' => "14", 'align' => "center"),
          'TB002' => array('filter_name' => "TB002", 'name' => "移轉單號", 'size' => "14", 'align' => "center"),
          'TB015' => array('filter_name' => "TB015", 'name' => "單據日期", 'size' => "10", 'align' => "center", 'placeholder' => "yyyyMMdd"),
          'TB004' => array('filter_name' => "", 'name' => "移出類別", 'size' => "10", 'align' => "center"),
          'TB005' => array('filter_name' => "TB005", 'name' => "移出部門", 'size' => "10", 'align' => "center", 'onkeyup' => "max"),
          'TB007' => array('filter_name' => "", 'name' => "移入類別", 'size' => "10", 'align' => "center"),
          'TB008' => array('filter_name' => "TB008", 'name' => "移入部門", 'size' => "10", 'align' => "center", 'onkeyup' => "max"),
        );
        ?>
        <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
        <?php $filter_TB001 = '';
        $filter_TB002 = '';
        $filter_TB015 = '';
        $filter_TB004 = '';
        $filter_TB005 = '';
        $filter_create = ''; ?>
        <tr class="filter">
          <td class="left"></td>
          <td align="center"><a onclick="filter();" accesskey="q" class="button">篩選 q</a></td>
          <?php
          foreach ($filter_array as $key => $val) {
            echo "<td class='" . $val['align'] . "'>";
            if ($val['filter_name'] == "") {
              echo "</td>";
              continue;
            } //filter_name = "" 為沒有使用

            echo "<div class='button-search'></div>";

            $ipt_str = "";
            $ipt_str .= "<input type='text' id='" . $val['filter_name'] . "' name='" . $val['filter_name'] . "' class='filter_ipt' ";
            if (isset($val['size'])) {
              $ipt_str .= "size='" . $val['size'] . "' ";
            }
            if (isset($val['placeholder'])) {
              $ipt_str .= "placeholder='" . $val['placeholder'] . "' ";
              $ipt_str .= ' oninput="if(this.value.length>8)this.value=this.value.slice(0,8)" ';
              $ipt_str .= ' onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'' . '\');" ';
            }
            if (isset($val['onkeyup'])) {
              if ($val['onkeyup'] == 'num') {
                $ipt_str .= ' onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'' . '\');this.value=this.value.toUpperCase();" ';
              } else if ($val['onkeyup'] == 'max') {
                $ipt_str .= ' onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,\'' . '\');this.value=this.value.toUpperCase();" ';
              }
            }
            if (isset($val['value'])) {
              $ipt_str .= "value='" . $val['value'] . "' ";
            }
            if (isset($val['color'])) {
              $ipt_str .= "style='background-color:" . $val['color'] . ";' ";
            }
            $ipt_str .= "/>";
            echo $ipt_str;
            echo "</td>";
          }
          ?>


          <!-- <td align="center"><a onclick="filtera();" accesskey="w" class="button">篩選 OR w</a></td> -->
        </tr>
        <tbody>
          <?php $chkval = 1; ?>
          <?php foreach ($results as $row) : ?>
            <tr style="line-height: 30px;">
              <td style="text-align: center;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->TB001) . "/" . trim($row->TB002); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                <td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('sfc/sfci05/updform/' . trim($row->TB001) . "/" . trim($row->TB002) . "/") ?>">修改</td>
              </div>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->TB001 . ':' . mb_convert_encoding($row->MQ002, "utf-8", "big-5"); ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->TB002; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo date('Y/m/d', strtotime($row->TB015)); ?></td>
              <td style="text-align: center;vertical-align: middle;">
                <?php
                if ($row->TB004 == '1') {
                  echo '1.生產線別';
                } else if ($row->TB004 == '2') {
                  echo '2.加工廠商';
                } else {
                  echo '3.庫別';
                }
                ?>
              </td>
              <td style="text-align: center;vertical-align: middle;"><?php echo $row->TB005 . ':' . mb_convert_encoding($row->TB006, "utf-8", "big-5"); ?></td>
              <td style="text-align: center;vertical-align: middle;">
                <?php
                if ($row->TB007 == '1') {
                  echo '1.生產線別';
                } else if ($row->TB007 == '2') {
                  echo '2.加工廠商';
                } else {
                  echo '3.庫別';
                }
                ?>
              </td>
              <td style="text-align: center;vertical-align: middle;"><?php echo $row->TB008 . ':' . mb_convert_encoding($row->TB009, "utf-8", "big-5"); ?></td>

            </tr>
            <?php $chkval += 1; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
      <!-- 修改時 留在原來那一筆資料使用 -->
      <?php $this->session->set_userdata('search', $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6, 0));  ?>
      <div class="pagination">
        <div class="results"><?php echo $pagination; ?></div>
      </div>
      <div class="success">
        <?php
        $message = '<font color="blue">' . $message . '</font>';
        ?>
        <?php echo date("Y/m/d") . '  提示訊息：' . $message . '<span>' . '</span>' .
          '◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] ' . '&nbsp&nbsp&nbsp&nbsp&nbsp 總數:' . ceil(($curpage + 1) / $limit) . '/' . ceil($page) . ' 頁, ' . $numrow . ' 筆' ?><br>
        <?php echo '快速鍵使用： Chrome、IE、Safari、Opera 15+ 等請使用[Alt] + [key] ； Firefox 請使用[Alt] + [Shift] + [key]' ?>
      </div>
    </form>
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.button-search').bind('click', function() {
      return true;
    });
  });

  //改寫function filter 為and搜尋
  function filter() {
    var where_str = "";
    var key = "";
    var val = "";
    $('.filter_ipt').each(function() {
      //$( this ).id()
      if ($(this).val()) {
        if (key != "") {
          key += ",";
        }
        key += this.id;
        if (val != "") {
          val += ",";
        }
        val += $(this).val();

      }
    });
    url = '<?php echo base_url() ?>index.php/sfc/sfci05a/display_search/0/and_where?key=' + encodeURIComponent(key) +
      '&val=' + encodeURIComponent(val);
    location = url;
  }

  function filtera() {
    var where_str = "";
    var key = "";
    var val = "";
    $('.filter_ipt').each(function() {
      //$( this ).id()
      if ($(this).val()) {
        if (key != "") {
          key += ",";
        }
        key += this.id;
        if (val != "") {
          val += ",";
        }
        val += $(this).val();

      }
    });
    url = '<?php echo base_url() ?>index.php/sfc/sfci05a/display_search/0/or_where?key=' + encodeURIComponent(key) +
      '&val=' + encodeURIComponent(val);
    location = url;
  }
</script>