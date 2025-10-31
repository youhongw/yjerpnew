<div class="box2" style="height:95%">
	<!-- div-1 -->
	<div class="heading">
		<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" />製令製程查詢作業 - 瀏覽　　　</h1>
		<a onclick="location = '<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta'" style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url() ?>assets/image/delete2.png" /></a>
	</div>
	<?php
	/* title欄位設定區域 */
	$title_array = array(
		'rowid' => array('sort_name' => "TA001", 'name' => "序號", 'width' => "", 'align' => "center", 'use' => "disable"),
		'TA001' => array('sort_name' => "TA001", 'name' => "製令單別", 'width' => "", 'align' => "center"),
		'TA002' => array('sort_name' => "TA002", 'name' => "製令單號", 'width' => "", 'align' => "center"),
		'TA003' => array('sort_name' => "TA003", 'name' => "加工順序", 'width' => "", 'align' => "center"),
		'TA006' => array('sort_name' => "TA006", 'name' => "產品品號", 'width' => "", 'align' => "center"),
		'MB002' => array('sort_name' => "MB002", 'name' => "產品品名", 'width' => "", 'align' => "center"),
		'MB003' => array('sort_name' => "MB003", 'name' => "產品規格", 'width' => "", 'align' => "center"),
		'TA004' => array('sort_name' => "TA004", 'name' => "製程代號", 'width' => "", 'align' => "center"),
		'MW003' => array('sort_name' => "MW003", 'name' => "製程名稱", 'width' => "", 'align' => "center"),
		'TA015' => array('sort_name' => "TA015", 'name' => "預計產量", 'width' => "", 'align' => "center"),
		'TA0101' => array('sort_name' => "TA0101", 'name' => "再製數量", 'width' => "", 'align' => "center"),
		'TA008' => array('sort_name' => "TA008", 'name' => "預計開工日", 'width' => "", 'align' => "center"),
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

							// $str = "<img src='" . base_url() . "assets/image/asc.png' />";
							// echo anchor("sfc/sfci03/display_child/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " asc", $str);

							// $str = "<img src='" . base_url() . "assets/image/desc.png' />";
							// echo anchor("sfc/sfci03/display_child/" . $this->uri->segment(4, 0) . "/order?val=" . $val['sort_name'] . " desc", $str);

							echo "</td>";
						}
						?>
					</tr>
				</thead>
				<?php
				/* filter欄位設定區域 */
				$filter_array = array(
					'rowid' => array('filter_name' => "", 'name' => "序號", 'size' => "12", 'align' => "center", 'use' => "disable"),
					'TA001' => array('filter_name' => "a.TA001", 'name' => "製令單別", 'size' => "8", 'align' => "center"),
					'TA002' => array('filter_name' => "a.TA002", 'name' => "製令單號", 'size' => "12", 'align' => "center"),
					'TA003' => array('filter_name' => "a.TA003", 'name' => "加工順序", 'size' => "8", 'align' => "center"),
					'TA006' => array('filter_name' => "b.TA006", 'name' => "產品品號", 'size' => "12", 'align' => "center"),
					'MB002' => array('filter_name' => "MB002", 'name' => "產品品名", 'size' => "12", 'align' => "center", 'disabled' => "disabled"),
					'MB003' => array('filter_name' => "MB003", 'name' => "產品規格", 'size' => "12", 'align' => "center", 'disabled' => "disabled"),
					'TA004' => array('filter_name' => "TA004", 'name' => "製程代號", 'size' => "8", 'align' => "center", 'disabled' => "disabled"),
					'MW003' => array('filter_name' => "MW003", 'name' => "製程名稱", 'size' => "12", 'align' => "center", 'disabled' => "disabled"),
					'TA015' => array('filter_name' => "TA015", 'name' => "預計產量", 'size' => "8", 'align' => "center", 'disabled' => "disabled"),
					'TA0101' => array('filter_name' => "TA0101", 'name' => "再製數量", 'size' => "8", 'align' => "center", 'disabled' => "disabled"),
					'TA008' => array('filter_name' => "TA008", 'name' => "預計開工日", 'size' => "8", 'align' => "center", 'disabled' => "disabled"),
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
							if (isset($val['disabled'])) {
								$ipt_str .= "disabled='" . $val['disabled'] . "' ";
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
		<?php $this->session->unset_userdata('TA002'); ?> -->
					<?php $chkval = 1; ?>

					<?php
					if ($num_results > 0) {
						foreach ($results as $row) : ?>
							<tr ondblclick="javascript:send_back_sfci03('<?php echo trim($row->TA001); ?>','<?php echo trim($row->TA002); ?>','<?php echo trim($row->TA003); ?>','<?php echo trim($row->TA004); ?>','<?php echo mb_convert_encoding(trim($row->MW003), 'utf-8', 'big-5'); ?>','<?php echo trim($row->TA006); ?>','<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES)); ?>','<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES)); ?>','<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB004), 'utf-8', 'big-5'), ENT_QUOTES)); ?>');">
								<td class="center"><?php echo $chkval; ?></td>
								<td class="center"><?php echo trim($row->TA001); ?></td>
								<input id='TA001_<?php echo $chkval ?>' value='<?php echo trim($row->TA001); ?>' style='display:none;' />
								<td class="center"><?php echo trim($row->TA002); ?></td>
								<input id='TA002_<?php echo $chkval ?>' value='<?php echo trim($row->TA002); ?>' style='display:none;' />
								<td class="center"><?php echo trim($row->TA003); ?></td>
								<input id='TA003_<?php echo $chkval ?>' value='<?php echo trim($row->TA003); ?>' style='display:none;' />
								<td class="center"><?php echo trim($row->TA006); ?></td>
								<input id='TA006_<?php echo $chkval ?>' value='<?php echo trim($row->TA006); ?>' style='display:none;' />
								<td class="center"><?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), "utf-8", "big-5"), ENT_QUOTES));; ?></td>
								<input id='MB002_<?php echo $chkval ?>' value='<?php echo mb_convert_encoding(trim($row->MB002), "utf-8", "big-5"); ?>' style='display:none;' />
								<td class="center"><?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), "utf-8", "big-5"), ENT_QUOTES));; ?></td>
								<input id='MB003_<?php echo $chkval ?>' value='<?php echo mb_convert_encoding(trim($row->MB003), "utf-8", "big-5"); ?>' style='display:none;' />
								<td class="center"><?php echo trim($row->TA004); ?></td>
								<input id='TA004_<?php echo $chkval ?>' value='<?php echo trim($row->TA004); ?>' style='display:none;' />
								<td class="center"><?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MW003), "utf-8", "big-5"), ENT_QUOTES));; ?></td>
								<input id='MW003_<?php echo $chkval ?>' value='<?php echo mb_convert_encoding(trim($row->MW003), "utf-8", "big-5"); ?>' style='display:none;' />
								<td class="right"><?php echo number_format($row->TA015); ?></td>
								<input id='TA015_<?php echo $chkval ?>' value='<?php echo number_format($row->TA015); ?>' style='display:none;' />
								<td class="right"><?php echo number_format($row->TA0101); ?></td>
								<input id='TA0101_<?php echo $chkval ?>' value='<?php echo number_format($row->TA0101); ?>' style='display:none;' />
								<td class="center"><?php echo date('Y/m/d', strtotime($row->TA008)); ?></td>
								<input id='TA008_<?php echo $chkval ?>' value='<?php echo trim($row->TA008); ?>' style='display:none;' />

								<td class="center">
									<!--	<a href="javascript:send_back_sfci03('<?php echo trim($row->TA001); ?>','<?php echo trim($row->TA002); ?>','<?php echo trim($row->TA003); ?>','<?php echo trim($row->TA004); ?>','<?php echo mb_convert_encoding(trim($row->MW003), 'utf-8', 'big-5'); ?>','<?php echo trim($row->TA006); ?>','<?php echo mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'); ?>','<?php echo addslashes(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5')); ?>','<?php echo mb_convert_encoding(trim($row->MB004), 'utf-8', 'big-5'); ?>');">[ 選擇</a><img src="<?php echo base_url() ?>assets/image/png/ok.png" />] -->
									<a href="javascript:send_back_sfci03('<?php echo trim($row->TA001); ?>','<?php echo trim($row->TA002); ?>','<?php echo trim($row->TA003); ?>','<?php echo trim($row->TA004); ?>','<?php echo mb_convert_encoding(trim($row->MW003), 'utf-8', 'big-5'); ?>','<?php echo trim($row->TA006); ?>','<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES)); ?>','<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES)); ?>','<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB004), 'utf-8', 'big-5'), ENT_QUOTES)); ?>');">[ 選擇</a><img src="<?php echo base_url() ?>assets/image/png/ok.png" />]
								</td>
							</tr>
							<?php $chkval += 1; ?>
					<?php endforeach;
					} ?>
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

	function send_back_sfci03(TA001, TA002, TA003, TA004, MW003, TA006, MB002, MB003, MB004) {

		window.parent.$.unblockUI();
		if (window.parent.addsfci03disp) { //以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			window.parent.addsfci03disp(TA001, TA002, TA003, TA004, MW003, TA006, MB002, MB003, MB004);
			$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta"
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
		url = '<?php echo base_url() ?>index.php/sfc/sfci03/display_child/0/and_where?key=' + encodeURIComponent(key) +
			'&val=' + encodeURIComponent(val);
		location = url;
	}
</script>