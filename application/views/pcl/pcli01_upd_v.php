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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> CNC檢查表 - 修改　　　</h1>

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
							<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('pcl/pcli01/updform/' . $prev_str); ?>" class="button"><span>上一筆Alt+< </span><img src="<?php echo base_url() ?>assets/image/png/pre.png" /></a>
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
							<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('pcl/pcli01/updform/' . $next_str); ?>" class="button"><span>下一筆Alt+> </span><img src="<?php echo base_url() ?>assets/image/png/next.png" /></a>
						<?php } ?>

						<a accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pcl/pcli01/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/pcl/pcli01/updsave">

						<?php
						foreach ($result as $row) {
							// 頭部表格  isset 檢查變數
							$bh001 = trim($row->bh001);
							$bh001 = date('Y/m/d', strtotime($bh001));
							$bh002 = trim($row->bh002);
							$bh003 = trim($row->bh003);
							$bh004 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bh004), 'utf-8', 'big-5'), ENT_QUOTES));

							$MX003 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MX003), 'utf-8', 'big-5'), ENT_QUOTES));
							$MB002 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB002), 'utf-8', 'big-5'), ENT_QUOTES));
							$MB003 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->MB003), 'utf-8', 'big-5'), ENT_QUOTES));

							$flag = trim($row->flag);

							if (!isset($bj001disp)) {
								$bj001disp = '';
								// $bj001disp = 'C:　　　Si:　　　';
							}
						}

						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="normal14a" width="8%">日　　期： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" onblur="dateformat_ymd(this);" id="bh001" onKeyPress="keyFunction()" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="bh001" value="<?php echo $bh001; ?>" size="12" type="text" style="background-color:#EBEBE4" required readonly="true" />
								</td>
							</tr>
							<tr>
								<td class="normal14a" width="8%">機台代號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="bh003" onKeyPress="keyFunction()" onchange="check_cmsi03d(this);" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='6' name=" bh003" value="<?php echo $bh003; ?>" size="12" type="text" style="background-color:#EBEBE4" required />
								</td>
								<td class="normal14a" width="8%">機台名稱： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="MX003" onKeyPress="keyFunction()" name=" MX003" value="<?php echo $MX003; ?>" size="12" type="text" readonly="true" style="width: 90%;background-color:#EBEBE4" />
								</td>

							</tr>
							<tr>
								<td class="normal14a" width="8%">品　　號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="bh002" onKeyPress="keyFunction()" onchange="check_invi02(this);" style="width: 50%;background-color:#EBEBE4;" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='20' name=" bh002" value="<?php echo $bh002; ?>" size="12" type="text" required readonly="true" />
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

								<td class="normal14a" width="8%">備　　註</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="bh004" onKeyPress="keyFunction()" style="width: 90%;" name="bh004" value="<?php echo $bh004; ?>" size="12" type="text" />
								</td>

							</tr>


							<div style="width:100%; overflow-x: auto;  ">
								<table style="width:100%;" id="order_product" class="list1">
									軸承孔
									<thead>
										<tr>
											<td width="3%" class="center">三點量測軸承孔</td>
											<td width="6%" class="center">班別</td>
											<td width="6%" class="center">班別分類</td>
											<td width="8%" class="center">A面</td>
											<td width="8%" class="center">B面</td>
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
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail(\"" . trim($row->bi001) . "\",\"" . trim($row->bi002) . "\",\"" . trim($row->bi003) . "\",\"" . trim($row->bi004) . "\",\"" . $i . "\");' " ?> /></td>
												<input type="hidden" name="order_product[<?php echo $i ?>][bi001]" value="<?php echo trim($row->bi001); ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][bi002]" value="<?php echo trim($row->bi002); ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][bi003]" value="<?php echo trim($row->bi003); ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][bi004]" value="<?php echo trim($row->bi004); ?>" />

												<td class="center" style="text-align:center;">
													<select id="order_product[<?php echo $i ?>][bi005]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi005]" value="<?php echo trim($row->bi005); ?>">
														<option <?php if (trim($row->bi005) == '1') echo 'selected="selected"'; ?> value="1">早班</option>
														<option <?php if (trim($row->bi005) == '2') echo 'selected="selected"'; ?> value="2">晚班</option>
													</select>
												</td>
												<td class="center" style="text-align:center;">
													<select id="order_product[<?php echo $i ?>][bi006]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi006]" value="<?php echo trim($row->bi006); ?>">
														<option <?php if (trim($row->bi006) == '1') echo 'selected="selected"'; ?> value="1">上半</option>
														<option <?php if (trim($row->bi006) == '2') echo 'selected="selected"'; ?> value="2">下半</option>
													</select>
												</td>
												<td class="center"><input type="text" id="order_product[<?php echo $i ?>][bi007]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi007]" value="<?php echo trim($row->bi007); ?>" size="10" style="text-align:center;" maxlength="8" /></td>
												<td class="center"><input type="text" id="order_product[<?php echo $i ?>][bi008]" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi008]" value="<?php echo trim($row->bi008); ?>" size="10" style="text-align:center;" maxlength="8" /></td>

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

								<table style="width:100%;" id="order_product1" class="list1">
									<thead>
										<tr>
											<td width="3%" class="center">換線首樣</td>
											<td width="6%" class="center">樣別</td>
											<td width="8%" class="center">A面</td>
											<td width="8%" class="center">B面</td>
										</tr>

									</thead>
									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->

									<?php
									$current_product_count1 = 0;
									foreach ($result2 as $j => $row) {
										$current_product_count1++;
									?>
										<tbody <?php echo    "id=product1_row_" . $j ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail1(\"" . trim($row->bj001) . "\",\"" . trim($row->bj002) . "\",\"" . trim($row->bj003) . "\",\"" . trim($row->bj004) . "\",\"" . $j . "\");' " ?> /></td>
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj001]" value="<?php echo trim($row->bj001); ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj002]" value="<?php echo trim($row->bj002); ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj003]" value="<?php echo trim($row->bj003); ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj004]" value="<?php echo trim($row->bj004); ?>" />

												<td class="center" style="text-align:center;">
													<select id="order_product1[<?php echo $j ?>][bj005]" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][bj005]" value="<?php echo trim($row->bj005); ?>">
														<option <?php if (trim($row->bj005) == '1') echo 'selected="selected"'; ?> value="1">輪寬</option>
														<option <?php if (trim($row->bj005) == '2') echo 'selected="selected"'; ?> value="2">軸承孔</option>
													</select>
												</td>
												<td class="center"><input type="text" id="order_product1[<?php echo $j ?>][bj006]" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][bj006]" value="<?php echo trim($row->bj006); ?>" size="10" style="text-align:center;" maxlength='8' /></td>
												<td class="center"><input type="text" id="order_product1[<?php echo $j ?>][bj007]" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][bj007]" value="<?php echo trim($row->bj007); ?>" size="10" style="text-align:center;" maxlength='8' /></td>

											</tr>
										</tbody>

									<?php } ?>
									<!-- javascrit 0 -->
									<!-- 頁尾群組  -->
									<tfoot>

										<tr>

											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem1();" /></td>
											<!-- <td class="left" colspan="<?php echo count($usecol_array); ?>"></td> -->
										</tr>

									</tfoot>
								</table>

								<table style="width:100%;" id="order_product2" class="list1">
									<thead>
										<tr>
											<td width="3%" class="center">換刀</td>
											<td width="6%" class="center">刀具名稱</td>
											<td width="6%" class="center">樣別</td>
											<td width="8%" class="center">A面</td>
											<td width="8%" class="center">B面</td>
										</tr>
									</thead>
									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->

									<?php
									$current_product_count2 = 0;
									foreach ($result3 as $k => $row) {
										$current_product_count2++;
									?>
										<tbody <?php echo    "id=product2_row_" . $k ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail2(\"" . trim($row->bk001) . "\",\"" . trim($row->bk002) . "\",\"" . trim($row->bk003) . "\",\"" . trim($row->bk004) . "\",\"" . $k . "\");' " ?> /></td>
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk001]" value="<?php echo trim($row->bk001); ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk002]" value="<?php echo trim($row->bk002); ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk003]" value="<?php echo trim($row->bk003); ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk004]" value="<?php echo trim($row->bk004); ?>" />

												<td class="center"><input type="text" id="bk005" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk005]" value="<?php echo trim($row->bk005) ?>" size="10" style="text-align:center;width: 60%;" maxlength='20' /></td>
												<td class="center" style="text-align:center;">
													<select id="order_product2[<?php echo $k ?>][bk006]" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk006]" value="<?php echo trim($row->bk006); ?>">
														<option <?php if (trim($row->bk006) == '1') echo 'selected="selected"'; ?> value="1">邊寬</option>
														<option <?php if (trim($row->bk006) == '2') echo 'selected="selected"'; ?> value="2">軸承孔</option>
													</select>
												</td>

												<td class="center"><input type="text" id="order_product2[<?php echo $k ?>][bk007]" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk007]" value="<?php echo trim($row->bk007); ?>" size="10" style="text-align:center;" maxlength='8' /></td>
												<td class="center"><input type="text" id="order_product2[<?php echo $k ?>][bk008]" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk008]" value="<?php echo trim($row->bk008); ?>" size="10" style="text-align:center;" maxlength='8' /></td>

											</tr>
										</tbody>

									<?php } ?>
									<!-- javascrit 0 -->
									<!-- 頁尾群組  -->
									<tfoot>

										<tr>

											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem2();" /></td>
											<!-- <td class="left" colspan="<?php echo count($usecol_array); ?>"></td> -->
										</tr>

									</tfoot>
								</table>

								<table style="width:100%;" id="order_product3" class="list1">
									端面粗糙度
									<thead>
										<tr>
											<td width="3%" class="center">換班</td>
											<td width="6%" class="center">班別</td>
											<td width="6%" class="center">班別分類</td>
											<td width="8%" class="center">A面</td>
											<td width="8%" class="center">B面</td>
										</tr>
									</thead>
									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->

									<?php
									$current_product_count3 = 0;
									foreach ($result4 as $l => $row) {
										$current_product_count3++;
									?>
										<tbody <?php echo    "id=product3_row_" . $l ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail3(\"" . trim($row->bl001) . "\",\"" . trim($row->bl002) . "\",\"" . trim($row->bl003) . "\",\"" . trim($row->bl004) . "\",\"" . $l . "\");' " ?> /></td>
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl001]" value="<?php echo trim($row->bl001); ?>" />
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl002]" value="<?php echo trim($row->bl002); ?>" />
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl003]" value="<?php echo trim($row->bl003); ?>" />
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl004]" value="<?php echo trim($row->bl004); ?>" />

												<td class="center" style="text-align:center;">
													<select id="order_product3[<?php echo $l ?>][bl005]" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl005]" value="<?php echo trim($row->bl005); ?>">
														<option <?php if (trim($row->bl005) == '1') echo 'selected="selected"'; ?> value="1">早班</option>
														<option <?php if (trim($row->bl005) == '2') echo 'selected="selected"'; ?> value="2">晚班</option>
													</select>
												</td>
												<td class="center" style="text-align:center;">
													<select id="order_product3[<?php echo $l ?>][bl006]" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl006]" value="<?php echo trim($row->bl006); ?>">
														<option <?php if (trim($row->bl006) == '1') echo 'selected="selected"'; ?> value="1">外端面</option>
														<option <?php if (trim($row->bl006) == '2') echo 'selected="selected"'; ?> value="2">中端面</option>
													</select>
												</td>
												<td class="center"><input type="text" id="order_product3[<?php echo $l ?>][bl007]" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl007]" value="<?php echo trim($row->bl007); ?>" size="10" style="text-align:center;" maxlength="8" /></td>
												<td class="center"><input type="text" id="order_product3[<?php echo $l ?>][bl008]" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl008]" value="<?php echo trim($row->bl008); ?>" size="10" style="text-align:center;" maxlength="8" /></td>

											</tr>
										</tbody>

									<?php } ?>
									<!-- javascrit 0 -->
									<!-- 頁尾群組  -->
									<tfoot>

										<tr>

											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem3();" /></td>
											<!-- <td class="left" colspan="<?php echo count($usecol_array); ?>"></td> -->
										</tr>

									</tfoot>
								</table>

								<table style="width:100%;" id="order_product4" class="list1">
									<thead>
										<tr>
											<td width="3%" class="center">換線首樣</td>
											<td width="6%" class="center">樣別</td>
											<td width="8%" class="center">A面</td>
											<td width="8%" class="center">B面</td>
										</tr>

									</thead>
									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->

									<?php
									$current_product_count4 = 0;
									foreach ($result5 as $m => $row) {
										$current_product_count4++;
									?>
										<tbody <?php echo    "id=product4_row_" . $m ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail4(\"" . trim($row->bm001) . "\",\"" . trim($row->bm002) . "\",\"" . trim($row->bm003) . "\",\"" . trim($row->bm004) . "\",\"" . $m . "\");' " ?> /></td>
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm001]" value="<?php echo trim($row->bm001); ?>" />
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm002]" value="<?php echo trim($row->bm002); ?>" />
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm003]" value="<?php echo trim($row->bm003); ?>" />
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm004]" value="<?php echo trim($row->bm004); ?>" />

												<td class="center" style="text-align:center;">
													<select id="order_product4[<?php echo $m ?>][bm005]" onKeyPress="keyFunction()" name="order_product4[<?php echo $m ?>][bm005]" value="<?php echo trim($row->bm005); ?>">
														<option <?php if (trim($row->bm005) == '1') echo 'selected="selected"'; ?> value="1">外端面</option>
														<option <?php if (trim($row->bm005) == '2') echo 'selected="selected"'; ?> value="2">中端面</option>
													</select>
												</td>
												<td class="center"><input type="text" id="order_product4[<?php echo $m ?>][bm006]" onKeyPress="keyFunction()" name="order_product4[<?php echo $m ?>][bm006]" value="<?php echo trim($row->bm006); ?>" size="10" style="text-align:center;" maxlength='8' /></td>
												<td class="center"><input type="text" id="order_product4[<?php echo $m ?>][bm007]" onKeyPress="keyFunction()" name="order_product4[<?php echo $m ?>][bm007]" value="<?php echo trim($row->bm007); ?>" size="10" style="text-align:center;" maxlength='8' /></td>

											</tr>
										</tbody>

									<?php } ?>
									<!-- javascrit 0 -->
									<!-- 頁尾群組  -->
									<tfoot>

										<tr>

											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem4();" /></td>
											<!-- <td class="left" colspan="<?php echo count($usecol_array); ?>"></td> -->
										</tr>

									</tfoot>
								</table>

								<table style="width:100%;" id="order_product5" class="list1">
									<thead>
										<tr>
											<td width="3%" class="center">換刀</td>
											<td width="6%" class="center">樣別</td>
											<td width="8%" class="center">A面</td>
											<td width="8%" class="center">B面</td>
										</tr>

									</thead>
									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->

									<?php
									$current_product_count5 = 0;
									foreach ($result6 as $n => $row) {
										$current_product_count5++;
									?>
										<tbody <?php echo    "id=product5_row_" . $n ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="刪除資料" <?php echo "onclick='del_detail5(\"" . trim($row->bn001) . "\",\"" . trim($row->bn002) . "\",\"" . trim($row->bn003) . "\",\"" . trim($row->bn004) . "\",\"" . $n . "\");' " ?> /></td>
												<input type="hidden" name="order_product5[<?php echo $n ?>][bn001]" value="<?php echo trim($row->bn001); ?>" />
												<input type="hidden" name="order_product5[<?php echo $n ?>][bn002]" value="<?php echo trim($row->bn002); ?>" />
												<input type="hidden" name="order_product5[<?php echo $n ?>][bn003]" value="<?php echo trim($row->bn003); ?>" />
												<input type="hidden" name="order_product5[<?php echo $n ?>][bn004]" value="<?php echo trim($row->bn004); ?>" />

												<td class="center" style="text-align:center;">
													<select id="order_product5[<?php echo $n ?>][bn005]" onKeyPress="keyFunction()" name="order_product5[<?php echo $n ?>][bn005]" value="<?php echo trim($row->bn005); ?>">
														<option <?php if (trim($row->bn005) == '1') echo 'selected="selected"'; ?> value="1">外端面</option>
														<option <?php if (trim($row->bn005) == '2') echo 'selected="selected"'; ?> value="2">中端面</option>
													</select>
												</td>
												<td class="center"><input type="text" id="order_product5[<?php echo $n ?>][bn006]" onKeyPress="keyFunction()" name="order_product5[<?php echo $n ?>][bn006]" value="<?php echo trim($row->bn006); ?>" size="10" style="text-align:center;" maxlength='8' /></td>
												<td class="center"><input type="text" id="order_product5[<?php echo $n ?>][bn007]" onKeyPress="keyFunction()" name="order_product5[<?php echo $n ?>][bn007]" value="<?php echo trim($row->bn007); ?>" size="10" style="text-align:center;" maxlength='8' /></td>

											</tr>
										</tbody>

									<?php } ?>
									<!-- javascrit 0 -->
									<!-- 頁尾群組  -->
									<tfoot>

										<tr>

											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem5();" /></td>
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
<?php include("./application/views/funnew/pcli01_funjs_v.php"); ?>