<div id="container">
	<!-- div-1 -->
	<div id="header">
		<!-- div-2 -->
		<div class="div1">
			<!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main"><?php echo $systitle ?></a></div>
			<div class="div3">
				<img src="<?php echo base_url() ?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
				<img src="<?php echo base_url() ?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main">回主目錄</a>　
				<img src="<?php echo base_url() ?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php">退出系統</a>
			</div> -->
			<?php include_once("./application/views/funnew/fun_head_icon.html"); ?>
		</div>


		<div id="content">
			<!-- div-3 -->
			<div class="box">
				<!-- div-4 -->
				<div class="heading">
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 拋丸粗糙度測量表 - 修改　　　</h1>

					<div style="float:left;padding-top: 5px;">
						<button type='submit' style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" tabIndex="98" accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;

						<?php if (isset($prev)) {
							$prev_str = "";
							$prev_ary = explode('_', $prev);
							foreach ($prev_ary as $k => $v) {
								if ($prev_str) {
									$prev_str .= "/";
								}
								$prev_str .= $v;
							}
						?>
							<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('pcl/pcli02/updform/' . $prev_str); ?>" class="button"><span>上一筆Alt+< </span><img src="<?php echo base_url() ?>assets/image/png/pre.png" /></a>
						<?php } ?>
						<?php if (isset($next)) {
							$next_str = "";
							$next_ary = explode('_', $next);
							foreach ($next_ary as $k => $v) {
								if ($next_str) {
									$next_str .= "/";
								}
								$next_str .= $v;
							}
						?>
							<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('pcl/pcli02/updform/' . $next_str); ?>" class="button"><span>下一筆Alt+> </span><img src="<?php echo base_url() ?>assets/image/png/next.png" /></a>
						<?php } ?>

						<a accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pcl/pcli02/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/pcl/pcli02/updsave">

						<?php
						foreach ($result as $row) {
							// 頭部表格  isset 檢查變數
							if (!isset($sa001)) {
								$sa001 = trim($row->sa001);
								$sa001 = date('Y/m/d', strtotime($sa001));
							}
							if (!isset($sa002)) {
								$sa002 = trim($row->sa002);
							}
							if (!isset($sa003)) {
								$sa003 = trim($row->sa003);
							}

							if (!isset($MX003)) {
								$MX003 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MX003), 'utf-8', 'big-5'), ENT_QUOTES));
							}



							if (!isset($MB002)) {
								$MB002 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES));
							}
							if (!isset($MB003)) {
								$MB003 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES));
							}

							if (!isset($sa004)) {
								$sa004 = trim($row->sa004);
							}
							if (!isset($sa005)) {
								$sa005 = trim($row->sa005);
							}
							if (!isset($sa006)) {
								$sa006 = trim($row->sa006);
							}
							if (!isset($sa007)) {
								$sa007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->sa007), 'utf-8', 'big-5'), ENT_QUOTES));
							}
							if (!isset($sb005sum)) {
								$sb005sum = trim($row->sb005sum);
							}
							if (!isset($sa008)) {
								$sa008 = '1';
							}

							$flag = trim($row->flag);
						}

						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="normal14a" width="8%">日　　期： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" onblur="dateformat_ymd(this);" id="sa001" onKeyPress="keyFunction()" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="sa001" value="<?php echo $sa001; ?>" size="12" type="text" style="background-color:#EBEBE4" required readonly="true" />
								</td>

								<td class="normal14a" width="8%">次　　數： </td>
								<td class="normal14a" width="25%">
									<select id="sa008" onKeyPress="keyFunction()" name="sa008" tabIndex="1" style="background-color:#EBEBE4" disabled='ture'>
										<option selected="selected" value="<?php echo $sa008; ?>"><?php echo $sa008; ?></option>
									</select>
								</td>
							</tr>

							<tr>
								<td class="normal14a" width="8%">品　　號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa002" onKeyPress="keyFunction()" onchange="check_invi02(this);" style="width: 50%;background-color:#EBEBE4;" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='20' name=" sa002" value="<?php echo $sa002; ?>" size="12" type="text" required readonly="true" />
								</td>

								<td class="normal14a" width="8%">品　　名︰ </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="MB002" onKeyPress="keyFunction()" name="MB002" value="<?php echo $MB002; ?>" size="12" type="text" readonly="true" style="width: 90%;background-color:#EBEBE4;" />
								</td>
								<td class="normal14a" width="8%">規　　格： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="MB003" onKeyPress="keyFunction()" name="MB003" value="<?php echo $MB003; ?>" size="12" type="text" readonly="true" style="width: 90%;background-color:#EBEBE4;" />
								</td>
							</tr>

							<tr>
								<td class="normal14a" width="8%">機台代號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa003" onKeyPress="keyFunction()" onchange="check_cmsi03d(this);" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='6' name=" sa003" value="<?php echo $sa003; ?>" size="12" type="text" style="background-color:#EBEBE4" required readonly="true" />
								</td>
								<td class="normal14a" width="8%">機台名稱： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="MX003" onKeyPress="keyFunction()" name=" MX003" value="<?php echo $MX003; ?>" size="12" type="text" readonly="true" style="width: 90%;background-color:#EBEBE4" />
								</td>
							</tr>
							<tr>
								<td class="normal14a" width="8%">生產起(時間)： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa004" onKeyPress="keyFunction()" onchange="count_time();" style="width: 10%;background-color:#FFFFE4;text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='4' name=" sa004" value="<?php echo $sa004; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%">生產迄(時間)︰ </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa005" onKeyPress="keyFunction()" onchange="count_time();" style="width: 10%;background-color:#FFFFE4;text-align:center;" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='4' name=" sa005" value="<?php echo $sa005; ?>" size="12" type="text" required />
								</td>
								<td class="normal14a" width="8%">生產時數： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa006" onKeyPress="keyFunction()" name="sa006" value="<?php echo $sa006; ?>" size="12" type="text" readonly="true" style="width: 15%;background-color:#EBEBE4;text-align:center;" />
								</td>

							</tr>

							<tr>
								<td class="normal14a" width="8%">生產總數： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sb005sum" onKeyPress="keyFunction()" name="sb005sum" value="<?php echo $sb005sum; ?>" size="12" type="text" readonly="true" style="width: 20%;background-color:#EBEBE4;text-align:right;" />
								</td>

								<td class="normal14a" width="8%">備　　註</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa004" onKeyPress="keyFunction()" style="width: 90%;" name="sa004" value="<?php echo $sa004; ?>" size="12" type="text" />
								</td>

							</tr>


							<div style="width:100%; overflow-x: auto;  ">
								<table style="width:100%;" id="order_product" class="list1">
									<thead>
										<tr>
											<td width="3%" class="center">粗度儀量測數據</td>
											<td width="6%" class="center">數量</td>
											<td width="6%" class="center">拋丸時間</td>
											<td width="8%" class="center">粗糙度</td>
										</tr>
									</thead>
									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->

									<?php
									$current_product_count = 0;
									foreach ($result1 as $i => $row) {
										$current_product_count++;
									?>
										<tbody <?php echo    "id=product_row_" . $i ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail(\"" . trim($row->sb001) . "\",\"" . trim($row->sb002) . "\",\"" . trim($row->sb003) . "\",\"" . trim($row->sb004) . "\",\"" . $i . "\");' "  ?> /></td>
												<input type="hidden" name="order_product[<?php echo $i ?>][sb001]" value="<?php echo trim($row->sb001); ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][sb002]" value="<?php echo trim($row->sb002); ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][sb003]" value="<?php echo trim($row->sb003); ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][sb004]" value="<?php echo trim($row->sb004); ?>" />

												<td class="center"><input type="text" id="order_product[<?php echo $i ?>][sb005]" onchange="sum_num()" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][sb005]" value="<?php echo trim($row->sb005); ?>" size="10" style="text-align:center;" maxlength="8" /></td>
												<td class="center"><input type="text" id="order_product[<?php echo $i ?>][sb006]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][sb006]" value="<?php echo trim($row->sb006); ?>" size="10" style="text-align:center;" maxlength="8" /></td>
												<td class="center"><input type="text" id="order_product[<?php echo $i ?>][sb007]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][sb007]" value="<?php echo trim($row->sb007); ?>" size="10" style="text-align:center;" maxlength="8" /></td>

											</tr>
										</tbody>

									<?php } ?>
									<!-- javascrit 0 -->
									<!-- 頁尾群組  -->
									<tfoot>

										<tr>

											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
											<!-- <td class="left" colspan="<?php echo count($usecol_array); ?>"></td> -->
										</tr>

									</tfoot>
								</table>


							</div>


						</table>
						<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />

					</form>
					<?php
					if ($message == '修改資料成功!' || $message == '查詢一筆修改資料!') {
						$message = '<font color="blue">' . $message . '</font><br>';
					} else {
						$message = '<b><font color="red">' . $message . '</font></b><br>';
					}
					if ($message != ' ') { ?>
						<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
													'◎操作說明:[ 欄位淡黃色按2下開視窗查詢,按Shift+Tab鍵跳上一個欄位,Tab鍵跳下一個欄位,新增一筆三點量測軸承孔Ctrl+↓,新增一筆換線首樣Shift+↓,新增一筆出換刀Alt+↓,新增一筆出換刀Alt+↓,新增一筆換班Shift+→,新增一筆換線首樣Ctrl+→,新增一筆出換刀Alt+→. ] ' ?> </div> <?php } ?>

				</div> <!-- div-6 -->

			</div> <!-- div-5 -->

		</div> <!-- div-4 -->



	</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/funnew/pcli02_funjs_v.php"); ?>