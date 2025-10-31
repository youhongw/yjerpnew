<div class="box2">
	<!-- div-1 -->
	<div class="heading">
		<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 製令製程建立作業 - 瀏覽　　　</h1>
		<!--  <div class="buttons"> -->
		<div style="float:left; ">
			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 999, 1) == 'Y') { ?>
				<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/addform'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url() ?>assets/image/png/add.png" /></a>
			<?PHP } ?> -->
			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 9999, 1) == 'Y') { ?>
				<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/copyform'" style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url() ?>assets/image/png/copy.png" /></a>
			<?PHP } ?> -->
			<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/clear_sql'" style="float:left" accesskey="d" class="button"><span>重整 d </span><img height="12" width="12" src="<?php echo base_url() ?>assets/image/delete2.png" /></a>
			<!-- <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/findform'" style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url() ?>assets/image/png/find.png" /></a> -->
			<a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url() ?>assets/image/png/del.png" /></a>

			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 1, 1) == 'Y') { ?>
				<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/findform'" style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url() ?>assets/image/png/find.png" /></a>
			<?PHP } ?> -->
			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 3, 1) == 'Y') { ?>
				<a onclick="$('form').submit();" style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url() ?>assets/image/png/del.png" /></a>
			<?PHP } ?> -->
			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 6999, 1) == 'Y') { ?>
				<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/printdetail'" style="float:left" accesskey="p" class="button"><span>列印 p </span><img src="<?php echo base_url() ?>assets/image/png/print.png" /></a>
			<?PHP } ?> -->
			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 69999, 1) == 'Y') { ?>
				<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/printdetailc'" style="float:left" accesskey="o" class="button"><span>印製造命令 o </span><img src="<?php echo base_url() ?>assets/image/png/print1.png" /></a>
			<?PHP } ?> -->
			<!-- <?PHP if (substr($this->session->userdata('sysmg006'), 109999, 1) == 'Y') { ?>
				<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/exceldetail'" style="float:left" accesskey="l" class="button"><span>轉EXCEL檔 l </span><img src="<?php echo base_url() ?>assets/image/png/excel.png" /></a>
			<?PHP } ?> -->
			<!-- <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci04/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->

			<a onclick="location = '<?php echo base_url() ?>index.php/main/'" style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url() ?>assets/image/png/close.png" /></a>

		</div>
	</div>


	<div class="content">
		<!-- div-2 -->
		<form action="<?php echo base_url() ?>index.php/sfc/sfci04/delete" method="post" enctype="multipart/form-data" id="form">
			<table class="list">
				<!-- 表格開始 -->
				<thead>
					<tr>
						<?php
						$title_array = array(
							'rowid' => array('sort_name' => "TA001", 'name' => "序號", 'width' => "2%", 'align' => "center", 'use' => "disable"),
							'TA001' => array('sort_name' => "TA001", 'name' => "製令單別", 'width' => "5%", 'align' => "center"),
							'TA002' => array('sort_name' => "TA002", 'name' => "製令單號", 'width' => "5%", 'align' => "center"),
							'TA003' => array('sort_name' => "TA003", 'name' => "開單日期", 'width' => "5%", 'align' => "center"),
							'TA006' => array('sort_name' => "TA006", 'name' => "品號", 'width' => "5%", 'align' => "center"),
							'MB002' => array('sort_name' => "MB002", 'name' => "品名", 'width' => "15%", 'align' => "center"),
							'MB003' => array('sort_name' => "MB003", 'name' => "規格", 'width' => "18%", 'align' => "center"),
							'TA015' => array('sort_name' => "TA015", 'name' => "預計產量", 'width' => "5%", 'align' => "center"),
							'TA011' => array('sort_name' => "TA011", 'name' => "狀態碼", 'width' => "2%", 'align' => "center"),
							'TA111' => array('sort_name' => "TA111", 'name' => "是否展開", 'width' => "4%", 'align' => "center"),
							'see' => array('sort_name' => "", 'name' => "查看管理", 'width' => "5%", 'align' => "center"),
							'edit' => array('sort_name' => "", 'name' => "修改管理", 'width' => "5%", 'align' => "center"),
							//'print' => array('sort_name'=>"",'name'=>"印客戶訂單",'width'=>"10%",'align'=>"center")
						);
						?>

						<!-- 表格表頭 -->
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

							if ($val['sort_name'] != 'TA011') {
								if ($val['sort_name'] != 'TA111') {
									$str = " <img src='" . base_url() . "assets/image/ascw.png' />";
									echo anchor("sfc/sfci04/display_search/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " asc", $str);

									$str = " <img src='" . base_url() . "assets/image/descw.png' />";
									echo anchor("sfc/sfci04/display_search/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " desc", $str);
								}
							}


							echo "</td>";
						}
						?>
						<!--   <td width="12%" class="center">&nbsp印製造命令&nbsp </td> -->
					</tr>
				</thead>



				<tbody>
					<?php
					$filter_array = array(
						'rowid' => array('filter_name' => "", 'name' => "序號", 'size' => "4", 'align' => "center", 'use' => "disable"),
						'TA001' => array('filter_name' => "TA001", 'name' => "製令單別", 'size' => "12", 'align' => "center"),
						'TA002' => array('filter_name' => "TA002", 'name' => "製令單號", 'size' => "12", 'align' => "center"),
						'TA003' => array('filter_name' => "TA003", 'name' => "開單日期", 'size' => "12", 'align' => "center", 'placeholder' => "yyyymmdd"),
						'TA006' => array('filter_name' => "TA006", 'name' => "品號", 'size' => "16", 'align' => "center"),
						'MB002' => array('filter_name' => "MB002", 'name' => "品名", 'size' => "20", 'align' => "left"),
						'MB003' => array('filter_name' => "MB003", 'name' => "規格", 'size' => "20", 'align' => "left"),
						'TA015' => array('filter_name' => "TA015", 'name' => "預計產量", 'size' => "12", 'align' => "right"),
						'TA011' => array('filter_name' => "TA011", 'name' => "狀態碼", 'size' => "8", 'align' => "center", 'disabled' => "disabled"),
						'TA111' => array('filter_name' => "TA011", 'name' => "是否展開", 'size' => "8", 'align' => "center", 'disabled' => "disabled")
					);
					?>

					<!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
					<tr class="filter">
						<td class="left"></td>
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
							if (isset($val['disabled'])) {
								$ipt_str .= "disabled='" . $val['disabled'] . "' ";
							}
							if (isset($val['placeholder'])) {
								$ipt_str .= "placeholder='" . $val['placeholder'] . "' ";
								$ipt_str .= ' oninput="if(this.value.length>8)this.value=this.value.slice(0,8)" ';
								$ipt_str .= ' onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'' . '\');" ';
							}
							if (isset($val['onkeyup'])) {
								$ipt_str .= ' onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,\'' . '\');this.value=this.value.toUpperCase();" ';
							}
							if (isset($val['color'])) {
								$ipt_str .= "style='background-color:" . $val['color'] . ";' ";
							}
							$ipt_str .= "/>";
							echo $ipt_str;
							echo "</td>";
						}
						?>

						<td align="center"><a onclick="filter();" accesskey="q" class="button">篩選 AND q </td>
						<td align="center"><a onclick="filtera();" accesskey="w" class="button">篩選 OR w </td>
						<!--  <td width="10%" align="center"></td> -->
					</tr>

					<?php $chkval = 1; ?>
					<?php foreach ($results as $row) : ?>
						<tr>
							<td style="text-align: center;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo $row->TA001 . "/" . trim($row->TA002) . "/" . trim($row->TA011) ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
							<td class="center"><?php echo  $chkval; ?></td>
							<td class="center"><?php echo  $row->TA001; ?></td>
							<td class="center"><?php echo  $row->TA002; ?></td>
							<td class="center"><?php echo  date('Y/m/d', strtotime($row->TA003)); ?></td>
							<td class="center"><?php echo  $row->TA006; ?></td>
							<td class="left"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
							<td class="left"><?php echo  stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES)); ?></td>
							<td class="right"><?php echo  $row->TA015; ?></td>
							<td class="center">
								<?php
								switch (trim($row->TA011)) {
									case '1':
										# code...1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
										echo  '未生產';
										break;
									case '2':
										echo  '已發料';
										break;
									case '3':
										echo  '生產中';
										break;
									case 'Y':
										echo  '已完工';
										break;
									case 'y':
										echo  '指定完工';
										break;

									default:
										echo  trim($row->TA011);
										break;
								}
								?>
							</td>
							<td class="center">
								<?php
								if ($row->TA111 > 0) {
									echo  '已展開';
								} else {
									echo  '未展開';
								}
								?>
							</td>

							<td class="center"><a href="<?php echo site_url('sfc/sfci04/see/' . $row->TA001 . '/' . $row->TA002) ?>">[ 查看 </a><img src="<?php echo base_url() ?>assets/image/png/eye.png" />]</td>

							<td class="center"><a href="<?php echo site_url('sfc/sfci04/updform/' . $row->TA001 . '/' . $row->TA002) ?>">[ 修改 </a><img src="<?php echo base_url() ?>assets/image/png/modi.png" />]</td>

							<?PHP if (substr($this->session->userdata('sysmg006'), 699999, 1) == 'Y') { ?>
								<td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('sfc/sfci04/printbb/' . $row->TA001 . "/" . trim($row->TA002)) ?>" id="print1">[ 印單據 </a><img src="<?php echo base_url() ?>assets/image/png/Print1.png" />]</td>
							<?PHP } ?>
							<!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('sfc/sfci04/del/' . $row->TA001 . "/" . trim($row->TA002)) ?>" id="delete1"  >[ 刪除 ]</a></td>   -->
						</tr>
						<?php $chkval += 1; ?>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php $this->session->set_userdata('search', $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6, 0));  ?>
			<?php $this->session->set_userdata('search1', "display/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6, 0));  ?>


			<div class="pagination">
				<div class="results"><?php echo $pagination; ?></div>
			</div>
			<div class="success">
				<?php
				if ($this->session->userdata('msg1') == '已生產不可刪除') {
					$msg1 = '<b><font color="red">' . $this->session->userdata('msg1') . '</font></b>' . ';';
				} else if ($this->session->userdata('msg1')) {
					$msg1 = '<font color="blue">' . $this->session->userdata('msg1') . '</font>' . ';';
				} else {
					$msg1 = '<font color="blue">' . $this->session->userdata('msg1') . '</font>';
				}

				if ($message == '資料流覽成功!' || $message == '刪除資料成功!') {
					$message = '<font color="blue">' . $message . '</font><br>';
				} else {
					$message = '<b><font color="red">' . $message . '</font></b><br>';
				}


				echo date("Y/m/d") . '  提示訊息：' . $msg1  . $message . '<span>' . '</span>' .
					'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] ' . '&nbsp&nbsp&nbsp&nbsp&nbsp 總數:' . ceil(($curpage + 1) / $limit) . '/' . ceil($page) . ' 頁, ' . $numrow . ' 筆' ?> </div>
			<?php $this->session->unset_userdata('msg1'); ?>
		</form>

	</div> <!-- div-2 -->
</div> <!-- div-1 -->
</div> <!-- div-0 -->
<!--列印及轉excel 開新視窗  -->
<script>
	function open_winprint() {
		// window.open('/index.php/sfc/sfci04/printdetail')
		window.location = "<?php echo base_url() ?>index.php/sfc/sfci04/printdetail";
	}

	function open_winprint1() {
		//   window.open('/index.php/sfc/sfci04/printdetailc')
		window.location = "<?php echo base_url() ?>index.php/sfc/sfci04/printdetailc";
	}

	function open_winexcel() {
		//  window.open('/index.php/sfc/sfci04/exceldetail')
		window.location = "<?php echo base_url() ?>index.php/sfc/sfci04/exceldetail";
	}
</script>

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
		url = '<?php echo base_url() ?>index.php/sfc/sfci04/display_search/0/and_where?key=' + encodeURIComponent(key) +
			'&val=' + encodeURIComponent(val);
		location = url;
	}


	//改寫function filter 為or搜尋
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
		url = '<?php echo base_url() ?>index.php/sfc/sfci04/display_search/0/or_where?key=' + encodeURIComponent(key) +
			'&val=' + encodeURIComponent(val);
		location = url;
	}
</script>