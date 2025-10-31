<div class="box2">
  <!-- div-1 -->
  <div class="heading">
    <h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 模具建立作業-瀏覽　　　</h1>

    <div style="float:left; ">
      <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci17a/clear_sql_term'" style="float:left" accesskey="a" class="button"><span>重新整理 a </span><img height="12" width="12" src="<?php echo base_url() ?>assets/image/delete2.png" /></a>
      <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci17/addform'" style="float:left" accesskey="i" class="button"><span>新增 i </span><img src="<?php echo base_url() ?>assets/image/png/add.png" /></a>
      <a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>刪除 - </span><img src="<?php echo base_url() ?>assets/image/png/del.png" /></a>
      <a onclick="location = '<?php echo base_url() ?>index.php/main/index'" style="float:left" accesskey="x" class="button"><span>關閉 x </span><img src="<?php echo base_url() ?>assets/image/png/close.png" /></a>
    </div>
  </div>
  <?php
  $title_array = array(
    'edit' => array('sort_name' => "", 'name' => "修改管理", 'width' => "13%", 'align' => "center"),
    'rowid' => array('sort_name' => "da001", 'name' => "序號", 'width' => "4%", 'align' => "left", 'use' => "disable"),
    'da001' => array('sort_name' => "da001", 'name' => "產品品號", 'width' => "10%", 'align' => "left"),
    'da002' => array('sort_name' => "da002", 'name' => "模具名稱", 'width' => "10%", 'align' => "left"),
    'da013' => array('sort_name' => "da013", 'name' => "製程資訊", 'width' => "10%", 'align' => "left"),
    'da014' => array('sort_name' => "da014", 'name' => "機台樣式", 'width' => "10%", 'align' => "left"),
    'da003' => array('sort_name' => "da003", 'name' => "規格", 'width' => "10%", 'align' => "left"),
    'da004' => array('sort_name' => "da004", 'name' => "衝次(產能)", 'width' => "10%", 'align' => "left"),
    'da005' => array('sort_name' => "da005", 'name' => "穴數", 'width' => "10%", 'align' => "left"),
    'da006' => array('sort_name' => "da006", 'name' => "每模毛重(g)", 'width' => "10%", 'align' => "left"),
    'da007' => array('sort_name' => "da007", 'name' => "每模淨重(g)", 'width' => "10%", 'align' => "left"),
    'da008' => array('sort_name' => "da008", 'name' => "單毛重(g)", 'width' => "10%", 'align' => "left"),
    'da009' => array('sort_name' => "da009", 'name' => "單淨重(g)", 'width' => "10%", 'align' => "left"),
    'da015' => array('sort_name' => "da015", 'name' => "作業人數", 'width' => "10%", 'align' => "left"),
    'da010' => array('sort_name' => "da010", 'name' => "生產週期", 'width' => "10%", 'align' => "left"),
    'da011' => array('sort_name' => "da011", 'name' => "報廢日期", 'width' => "10%", 'align' => "left"),
    'da016' => array('sort_name' => "da016", 'name' => "配料品號", 'width' => "10%", 'align' => "left"),
    'da017' => array('sort_name' => "da017", 'name' => "溫度", 'width' => "10%", 'align' => "left"),
    'da018' => array('sort_name' => "da018", 'name' => "版本日期", 'width' => "10%", 'align' => "left"),
    'da012' => array('sort_name' => "da012", 'name' => "備註", 'width' => "10%", 'align' => "left")

  );
  ?>



  <div class="content">
    <!-- div-2 -->
    <form action="<?php echo base_url() ?>index.php/sfc/sfci17/delete" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <!-- 表格開始 The [attribute*=value] selector selects each element with a specific attribute, with a value containing a string.-->
        <thead>
          <tr style="line-height: 30px;">
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
              echo anchor("sfc/sfci17a/display_search/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " asc", $str);

              $str = " <img src='" . base_url() . "assets/image/descw.png' />";
              echo anchor("sfc/sfci17a/display_search/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " desc", $str);
              echo "</td>";
            }
            ?>
          </tr>
        </thead>
        <?php
        $filter_array = array(
          'rowid' => array('filter_name' => "", 'name' => "序號", 'size' => "12", 'align' => "left", 'use' => "disable"),
          'da001' => array('filter_name' => "da001", 'name' => "品號", 'size' => "14", 'align' => "center"),
          'da002' => array('filter_name' => "", 'name' => "品名", 'size' => "10", 'align' => "center"),
          'da013' => array('filter_name' => "da013", 'name' => "規格", 'size' => "10", 'align' => "center"),
          'da014' => array('filter_name' => "da014", 'name' => "數量", 'size' => "10", 'align' => "center"),
          'da003' => array('filter_name' => "", 'name' => "規格", 'size' => "10", 'align' => "center"),
          'da004' => array('filter_name' => "da004", 'name' => "衝次(產能)", 'size' => "10", 'align' => "center"),
          'da005' => array('filter_name' => "", 'name' => "穴數", 'size' => "10", 'align' => "center"),
          'da006' => array('filter_name' => "", 'name' => "每模毛重(g)", 'size' => "10", 'align' => "center"),
          'da007' => array('filter_name' => "", 'name' => "每模淨重(g)", 'size' => "10", 'align' => "center"),
          'da008' => array('filter_name' => "", 'name' => "單毛重(g)", 'size' => "10", 'align' => "center"),
          'da009' => array('filter_name' => "", 'name' => "單淨重(g)", 'size' => "10", 'align' => "center"),
          'da015' => array('filter_name' => "", 'name' => "作業人數", 'size' => "10", 'align' => "center"),
          'da010' => array('filter_name' => "", 'name' => "生產週期", 'size' => "10", 'align' => "center"),
          'da011' => array('filter_name' => "", 'name' => "報廢日期", 'size' => "10", 'align' => "center"),
          'da016' => array('filter_name' => "da016", 'name' => "配料品號", 'size' => "10", 'align' => "center"),
          'da017' => array('filter_name' => "", 'name' => "溫度", 'size' => "10", 'align' => "center"),
          'da018' => array('filter_name' => "da018", 'name' => "版本日期", 'size' => "10", 'align' => "center"),
          'da012' => array('filter_name' => "", 'name' => "備註", 'size' => "10", 'align' => "center"),
        );
        ?>
        <!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
        <?php $filter_da001 = '';
        $filter_da002 = '';
        $filter_da013 = '';
        $filter_da014 = '';
        $filter_da003 = '';
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
            <tr>
              <td style="text-align: center;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo trim($row->da001) . "/" . trim($row->da013) . "/" . trim($row->da014); ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
              <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                <td style="text-align: center;vertical-align: middle;"><a class="btn btn-primary btn-sm" href="<?php echo site_url('sfc/sfci17/updform/' . trim($row->da001) . "/" . trim($row->da013) . "/" . trim($row->da014) . '/') ?>">修改</td>
              </div>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $chkval . '　'; ?></td>

              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da001; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->da002, "utf-8", "big-5"); ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo $row->da013 . ':' . mb_convert_encoding($row->da013dis, "utf-8", "big-5"); ?></td>
              <td style="text-align: center;vertical-align: middle;">
                <?php
                if ($row->da014 == '1') {
                  echo "1.單衝(手動)";
                } else if ($row->da014 == '2') {
                  echo "2.連續";
                }
                ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->da003, "utf-8", "big-5"); ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da004; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da005; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da006; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da007; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da008; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da009; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da015; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da010; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da011; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da016; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  $row->da017; ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  date('Y/m/d', strtotime($row->da018)); ?></td>
              <td style="text-align: center;vertical-align: middle;"><?php echo  mb_convert_encoding($row->da012, "utf-8", "big-5"); ?></td>

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
    url = '<?php echo base_url() ?>index.php/sfc/sfci17a/display_search/0/and_where?key=' + encodeURIComponent(key) +
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
    url = '<?php echo base_url() ?>index.php/sfc/sfci17a/display_search/0/or_where?key=' + encodeURIComponent(key) +
      '&val=' + encodeURIComponent(val);
    location = url;
  }
</script>