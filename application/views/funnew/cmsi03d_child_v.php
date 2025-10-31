<div class="box2" style="height:95%">
	<!-- div-1 -->
	<div class="heading">
		<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 庫別資料查詢作業 - 瀏覽　　　</h1>
		<a onclick="location = '<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql'" style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url() ?>assets/image/delete2.png" /></a>
	</div>
	<?php
	/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name' => "MC001", 'name' => "序號", 'width' => "", 'align' => "center", 'use' => "disable"),
		'MC001' => array('sort_name' => "MC001", 'name' => "庫別代號", 'width' => "", 'align' => "center"),
		'MC002' => array('sort_name' => "MC002", 'name' => "庫別名稱", 'width' => "", 'align' => "center"),
		// 'MC003' => array('sort_name' => "MC003", 'name' => "廠別", 'width' => "", 'align' => "center"),
		'select' => array('sort_name' => "", 'name' => "", 'width' => "", 'align' => "center")
	);
	?>

	<div class="content">
		<!-- div-2 -->
		<form method="post" enctype="multipart/form-data" id="form">
			<table class="list">
				<!-- 表格開始 -->
				<thead>
					<tr>
						<?php
						foreach ($title_array as $key => $val) {
							echo "<td width='" . $val['width'] . "' class='" . $val['align'] . "'>";
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

							$str = "<img src='" . base_url() . "assets/image/asc.png' />";
							echo anchor("cms/cmsi03/display_child/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " asc", $str);

							$str = "<img src='" . base_url() . "assets/image/desc.png' />";
							echo anchor("cms/cmsi03/display_child/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " desc", $str);

							echo "</td>";
						}
						?>
					</tr>
				</thead>
				<?php
				/* filter欄位設定區域 */
				$filter_array = array(
					'rowid' => array('filter_name' => "", 'name' => "序號", 'size' => "12", 'align' => "center", 'use' => "disable"),
					'MC001' => array('filter_name' => "MC001", 'name' => "庫別代號", 'size' => "8", 'align' => "center"),
					'MC002' => array('filter_name' => "MC002", 'name' => "庫別名稱", 'size' => "12", 'align' => "center"),
					// 'MC003' => array('filter_name' => "MC003", 'name' => "廠別", 'size' => "12", 'align' => "center")
				);
				?>

				<tbody>
					<!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
					<tr class="filter">
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
						<td align="center"><a onclick="filter();" class="button">篩選</a></td>
						<!-- <button type='submit' name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
					</tr>
					<!--session 變數取消 	  
		<?php $this->session->unset_userdata('MC002'); ?> -->
					<?php $chkval = 1; ?>
					<?php foreach ($results as $row) : ?>
						<tr onclick="parent.addcmsi03ddisp('<?php echo trim($row->MC001); ?>','<?php echo mb_convert_encoding(trim($row->MC002), 'utf-8', 'big-5'); ?>');parent.$.unblockUI();">
							<td class="center"><?php echo $chkval; ?></td>
							<td class="center"><?php echo trim($row->MC001); ?></td>
							<input id='MC001_<?php echo $chkval ?>' value='<?php echo trim($row->MC001); ?>' style='display:none;' />
							<td class="center"><?php echo mb_convert_encoding(trim($row->MC002), 'utf-8', 'big-5'); ?></td>
							<input id='MC002_<?php echo $chkval ?>' value='<?php echo mb_convert_encoding(trim($row->MC002), 'utf-8', 'big-5'); ?>' style='display:none;' />
							<!-- <td class="center"><?php echo trim($row->MC003); ?></td>
							<input id='MC003_<?php echo $chkval ?>' value='<?php echo trim($row->MC003); ?>' style='display:none;' /> -->
							<td class="center"><a href="javascript:send_back_cmsi03d('<?php echo trim($row->MC001); ?>','<?php echo mb_convert_encoding(trim($row->MC002), 'utf-8', 'big-5'); ?>');">[ 選擇</a><img src="<?php echo base_url() ?>assets/image/png/ok.png" />]</td>
						</tr>
						<?php $chkval += 1; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="pagination">
				<div class="results"><?php echo $pagination; ?></div>
			</div>
			<div class="success"><?php echo date("Y/m/d") . '  提示訊息：' . $message . '<span>' . '</span>' .
										'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料. ] ' . '&nbsp&nbsp&nbsp&nbsp&nbsp 總數:' . ceil(($curpage + 1) / $limit) . '/' . ceil($page) . ' 頁, ' . $numrow . ' 筆' ?> </div>
		</form>
	</div> <!-- div-2 -->
</div> <!-- div-1 -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.button-search').bind('click', function() {
			return true;
		});
	});

	function send_back_cmsi03d(MC001, MC002) {

		window.parent.$.unblockUI();
		if (window.parent.addcmsi03ddisp) { //以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			window.parent.addcmsi03ddisp(MC001, MC002);
			$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
			});
		}
	}

	function send_mult_back_cmsi03d() {
		//window.parent.$.unblockUI();
		$('.row_chkbx:checked').each(function() {
			temp = this.id.split("_");
			var row_num = temp[1];
			var MC001 = $('.row_' + row_num + ' .MC001').text();
			var MC002 = $('.row_' + row_num + ' .MC002').text();
			if (window.parent.mult_addcmsi03ddisp) { //以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
				window.parent.mult_addcmsi03ddisp(MC001, MC002);

			}
		});
	}
	//多筆選擇
	$("#chkbx").click(function() {
		check_check_all();
	});

	function check_check_all() {
		if ($("#chkbx").prop("checked")) {
			$(".row_chkbx").each(function() {
				$(this).prop("checked", true);
			});
		} else {
			$(".row_chkbx").each(function() {
				$(this).prop("checked", false);
			});
		}
	}
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
		url = '<?php echo base_url() ?>index.php/cms/cmsi03/display_child/0/and_where?key=' + encodeURIComponent(key) +
			'&val=' + encodeURIComponent(val);
		location = url;
	}
</script>