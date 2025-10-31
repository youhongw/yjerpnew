<div class="box2" style="height:95%">
	<!-- div-1 -->
	<div class="heading">
		<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 人員查詢作業 - 瀏覽　　　</h1>
		<a onclick="location = '<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_ch'" style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url() ?>assets/image/delete2.png" /></a>
		<div class="mult_add"><input id="btn_mult_add" type="button" style="float:center;" value="多筆選取" onclick="send_mult_back_cmsi09();" /></div>
	</div>
	<?php
	/* title欄位設定區域 */
	$title_array = array(
		'chkbx' => array('sort_name' => "mv001", 'name' => "選擇", 'width' => "", 'align' => "center", 'use' => "disable"),
		'rowid' => array('sort_name' => "mv001", 'name' => "序號", 'width' => "", 'align' => "center", 'use' => "disable"),
		'mv001' => array('sort_name' => "mv001", 'name' => "人員代號", 'width' => "", 'align' => "center"),
		'mv002' => array('sort_name' => "mv002", 'name' => "人員名稱", 'width' => "", 'align' => "center"),
		'mv004' => array('sort_name' => "mv004", 'name' => "部門", 'width' => "", 'align' => "center"),
		'select' => array('sort_name' => "", 'name' => "選擇", 'width' => "", 'align' => "center")
	);
	?>

	<div class="content">
		<!-- div-2 -->
		<form method="post" enctype="multipart/form-data" id="form">
			<table class="list">
				<!-- 表格開始 -->
				<thead>
					<tr>
						<!-- 表格表頭 -->
						<!-- <td width="1%" style="text-align: center;">
							<input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
						</td> -->
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

							// $str = "<img src='" . base_url() . "assets/image/asc.png' />";
							// echo anchor("cms/cmsi09/display_child_body/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " asc", $str);

							// $str = "<img src='" . base_url() . "assets/image/desc.png' />";
							// echo anchor("cms/cmsi09/display_child_body/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " desc", $str);

							echo "</td>";
						}
						?>
					</tr>
				</thead>
				<?php
				/* filter欄位設定區域 */
				$filter_array = array(
					// 'chkbx' => array('filter_name' => "chkbx", 'name' => "選擇", 'size' => "1", 'align' => "center", 'use' => "disable"),
					'rowid' => array('filter_name' => "", 'name' => "序號", 'size' => "12", 'align' => "center", 'use' => "disable"),
					'mv001' => array('filter_name' => "mv001", 'name' => "人員代號", 'size' => "8", 'align' => "center", 'onkeyup' => "onkeyup"),
					'mv002' => array('filter_name' => "mv002", 'name' => "人員名稱", 'size' => "12", 'align' => "center", 'disabled' => "disabled"),
					'mv004' => array('filter_name' => "mv004", 'name' => "部門", 'size' => "12", 'align' => "center")
				);
				?>

				<tbody>
					<!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
					<tr class="filter">
						<!-- <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /> -->
						<?php
						echo "<td class='" . $val['align'] . "'>";
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
						<td align="center"><a onclick="filter();" class="button">篩選</a></td>
						<!-- <button type='submit' name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
					</tr>
					<!--session 變數取消 	  
		<?php $this->session->unset_userdata('mv002'); ?> -->
					<?php $chkval = 1; ?>
					<?php foreach ($results as $row) : ?>
						<tr class="row_<?php echo $chkval; ?>" ondblclick="javascript:send_back_cmsi09('<?php echo trim($row->mv001); ?>','<?php echo trim($row->mv002); ?>');">
							<td class="center"><input id="chk_<?php echo $chkval; ?>" type="checkbox" class="row_chkbx" /></td>
							<td class="center"><?php echo $chkval; ?></td>
							<td class="center mv001"><?php echo $row->mv001; ?></td>
							<input id='mv001_<?php echo $chkval ?>' value='<?php echo $row->mv001; ?>' style='display:none;' />
							<td class="center mv002"><?php echo trim($row->mv002); ?></td>
							<input id='mv002_<?php echo $chkval ?>' value='<?php echo trim($row->mv002); ?>' style='display:none;' />
							<td class="center mv004"><?php echo trim($row->mv004) . ':' . trim($row->me002); ?></td>
							<input id='mv004_<?php echo $chkval ?>' value='<?php echo trim($row->mv002); ?>' style='display:none;' />
							<td class="center"><a href="javascript:send_back_cmsi09('<?php echo trim($row->mv001); ?>','<?php echo trim($row->mv002); ?>');">[ 選擇</a><img src="<?php echo base_url() ?>assets/image/png/ok.png" />]</td>
						</tr>
						<?php $chkval += 1; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="mult_add"><input id="btn_mult_add" type="button" style="float:left;" value="多筆選取" onclick="send_mult_back_cmsi09();" /></div>
			<div class="pagination">
				<div class="results"><?php echo $pagination; ?></div>
			</div>
			<div class="success"><?php echo date("Y/m/d") . '  提示訊息：' . $message . '<span>' . '</span>' .
										'◎操作說明:[ 選欄位名稱自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料. ] ' . '&nbsp&nbsp&nbsp&nbsp&nbsp 總數:' . ceil(($curpage + 1) / $limit) . '/' . ceil($page) . ' 頁, ' . $numrow . ' 筆' . '&nbsp&nbsp&nbsp&nbsp&nbsp　　　　　' ?> </div>

		</form>

	</div> <!-- div-2 -->
</div> <!-- div-1 -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.button-search').bind('click', function() {
			return true;
		});
	});

	function send_back_cmsi09(mv001, mv002) {
		window.parent.$.unblockUI();
		var sendback = '';
		if (window.parent.addcmsi09ch_body) { //以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			console.log('mv001:' + mv001);
			sendback = mv001 + ';'
			window.parent.addcmsi09ch_body(sendback, mv002);
			$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_ch"
			});
		}
	}

	function send_mult_back_cmsi09() {
		window.parent.$.unblockUI();
		var sendback = '';
		$('.row_chkbx:checked').each(function() {
			temp = this.id.split("_");
			// console.log('temp:' + temp);
			var row_num = temp[1];
			var mv001 = $('.row_' + row_num + ' .mv001').text();

			// if (sendback != '') {
			// 	sendback = sendback + ';'
			// }
			// sendback = sendback + mv001.trim();
			// console.log('mv001:' + mv001);
			sendback = sendback + mv001.trim() + ';';

		});
		// console.log('sendback:' + sendback);
		if (window.parent.addcmsi09ch_body) { //以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			console.log('sendback:' + sendback);
			window.parent.addcmsi09ch_body(sendback);
			$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_body_ch"
			});
		}
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
		url = '<?php echo base_url() ?>index.php/cms/cmsi09/display_child_ch/0/and_where?key=' + encodeURIComponent(key) +
			'&val=' + encodeURIComponent(val);
		location = url;
	}
</script>