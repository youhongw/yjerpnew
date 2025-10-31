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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> CNC檢查表 - 新增　　　</h1>

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
							<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('pcl/pcli01/addform/' . $prev_str); ?>" class="button"><span>上一筆Alt+< </span><img src="<?php echo base_url() ?>assets/image/png/pre.png" /></a>
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
							<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('pcl/pcli01/addform/' . $next_str); ?>" class="button"><span>下一筆Alt+> </span><img src="<?php echo base_url() ?>assets/image/png/next.png" /></a>
						<?php } ?>

						<a accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pcl/pcli01/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/pcl/pcli01/addsave">

						<?php
						// 頭部表格  isset 檢查變數
						if (!isset($bh001)) {
							// $bh001 = date("Y/m/d");
							$bh001 = '';
						}

						if (!isset($bh003)) {
							$bh003 = '';
						}
						if (!isset($MX003)) {
							$MX003 = '';
						}
						if (!isset($bh002)) {
							$bh002 = '';
						}
						if (!isset($MB002)) {
							$MB002 = '';
						}
						if (!isset($MB003)) {
							$MB003 = '';
						}

						if (!isset($bh004)) {
							$bh004 = '';
						}
						$current_product_count = 0;
						$current_product_count1 = 0;
						$current_product_count2 = 0;
						$current_product_count3 = 0;
						$current_product_count4 = 0;
						$current_product_count5 = 0;


						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="normal14a" width="8%">日　　期： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" ondblclick="scwShow(this,event);" onblur="dateformat_ymd(this);" id="bh001" onKeyPress="keyFunction()" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="bh001" value="<?php echo $bh001; ?>" size="12" type="text" style="background-color:#FFFFE4" required />
								</td>
							</tr>
							<tr>
								<td class="normal14a" width="8%">機台代號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="bh003" onKeyPress="keyFunction()" onchange="check_cmsi03d(this);" ondblclick="search_cmsi03d_window(this);" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='6' name=" bh003" value="<?php echo $bh003; ?>" size="12" type="text" style="background-color:#FFFFE4" required />
								</td>
								<td class="normal14a" width="8%">機台名稱： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="MX003" onKeyPress="keyFunction()" name=" MX003" value="<?php echo $MX003; ?>" size="12" type="text" readonly="true" style="width: 90%;background-color:#EBEBE4" />
								</td>

							</tr>
							<tr>
								<td class="normal14a" width="8%">品　　號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="bh002" onKeyPress="keyFunction()" onchange="check_invi02(this);" ondblclick="search_invi02_window(this);" style="width: 50%;background-color:#FFFFE4;" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='20' name=" bh002" value="<?php echo $bh002; ?>" size="12" type="text" required />
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
									$i = 0;
									$ii = 0;
									while ($i < $ii) { ?>
										<tbody <?php echo    "id=product_row_" . $product_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product_row_0\').remove();" /></td>
												<input type="hidden" name="order_product[<?php echo $i ?>][bi001]" value="<?php echo $bi001[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][bi002]" value="<?php echo $bi002[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][bi003]" value="<?php echo $bi003[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][bi004]" value="<?php echo $bi004[$i]; ?>" />

												<td class="center">
													<select id="bi005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi005]">
														<option <?php if ($bi005 == '1') echo 'selected="selected"'; ?> value='1'>早班</option>
														<option <?php if ($bi005 == '2') echo 'selected="selected"'; ?> value='2'>晚班</option>
													</select>
												</td>
												<td class="center">
													<select id="bi006" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi006]">
														<option <?php if ($bi006 == '1') echo 'selected="selected"'; ?> value='1'>上半</option>
														<option <?php if ($bi006 == '2') echo 'selected="selected"'; ?> value='2'>下半</option>
													</select>
												</td>
												<td class="center"><input type="text" id="bi007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi007]" value="<?php echo $bi007[$i]; ?>" size="10" maxlength='8' /></td>
												<td class="center"><input type="text" id="bi008" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][bi008]" value="<?php echo $bi008[$i]; ?>" size="10" maxlength='8' /></td>

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
									$j = 0;
									$ji = 0;
									while ($j < $ji) { ?>
										<tbody <?php echo    "id=product1_row_" . $product1_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product1_row_0\').remove();" /></td>
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj001]" value="<?php echo $bj001[$j]; ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj002]" value="<?php echo $bj002[$j]; ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj003]" value="<?php echo $bj003[$j]; ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][bj004]" value="<?php echo $bj004[$j]; ?>" />

												<td class="center">
													<select id="bj005" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][bj005]">
														<option <?php if ($bj005 == '1') echo 'selected="selected"'; ?> value='1'>輪寬</option>
														<option <?php if ($bj005 == '2') echo 'selected="selected"'; ?> value='2'>軸承孔</option>
													</select>

												</td>
												<td class="center"><input type="text" id="bj006" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][bj006]" value="<?php echo $bj006[$j]; ?>" size="10" maxlength='8' /></td>
												<td class="center"><input type="text" id="bj007" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][bj007]" value="<?php echo $bj007[$j]; ?>" size="10" maxlength='8' /></td>

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
									$k = 0;
									$ki = 0;
									while ($k < $ki) { ?>
										<tbody <?php echo    "id=product2_row_" . $product2_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product2_row_0\').remove();" /></td>
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk001]" value="<?php echo $bk001[$k]; ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk002]" value="<?php echo $bk002[$k]; ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk003]" value="<?php echo $bk003[$k]; ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][bk004]" value="<?php echo $bk004[$k]; ?>" />

												<td class="center"><input type="text" id="bk005" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk005]" value="<?php echo $bk005[$k]; ?>" size="10" style="background-color:#EBEBE4" maxlength='20' /></td>
												<td class="center">
													<select id="bk006" onKeyPress="keyFunction()" name="order_product2[<?php echo $i ?>][bk006]">
														<option <?php if ($bk006 == '1') echo 'selected="selected"'; ?> value='1'>邊寬</option>
														<option <?php if ($bk006 == '2') echo 'selected="selected"'; ?> value='2'>軸承孔</option>
													</select>

												</td>
												<td class="center"><input type="text" id="bk007" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk007]" value="<?php echo $bk007[$k]; ?>" size="10" style="background-color:#EBEBE4" maxlength='8' /></td>
												<td class="center"><input type="text" id="bk008" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][bk008]" value="<?php echo $bk008[$k]; ?>" size="10" style="background-color:#EBEBE4" maxlength='8' /></td>


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
									$l = 0;
									$li = 0;
									while ($l < $li) { ?>
										<tbody <?php echo    "id=product3_row_" . $product3_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product3_row_0\').remove();" /></td>
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl001]" value="<?php echo $bl001[$l]; ?>" />
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl002]" value="<?php echo $bl002[$l]; ?>" />
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl003]" value="<?php echo $bl003[$l]; ?>" />
												<input type="hidden" name="order_product3[<?php echo $l ?>][bl004]" value="<?php echo $bl004[$l]; ?>" />

												<td class="center">
													<select id="bl005" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl005]">
														<option <?php if ($bl005 == '1') echo 'selected="selected"'; ?> value='1'>早班</option>
														<option <?php if ($bl005 == '2') echo 'selected="selected"'; ?> value='2'>晚班</option>
													</select>
												</td>
												<td class="center">
													<select id="bl006" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl006]">
														<option <?php if ($bl006 == '1') echo 'selected="selected"'; ?> value='1'>外端面</option>
														<option <?php if ($bl006 == '2') echo 'selected="selected"'; ?> value='2'>中端面</option>
													</select>
												</td>
												<td class="center"><input type="text" id="bl007" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl007]" value="<?php echo $bl007[$l]; ?>" size="10" maxlength='8' /></td>
												<td class="center"><input type="text" id="bl008" onKeyPress="keyFunction()" name="order_product3[<?php echo $l ?>][bl008]" value="<?php echo $bl008[$l]; ?>" size="10" maxlength='8' /></td>

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
									$m = 0;
									$mi = 0;
									while ($m < $mi) { ?>
										<tbody <?php echo    "id=product4_row_" . $product4_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product4_row_0\').remove();" /></td>
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm001]" value="<?php echo $bm001[$m]; ?>" />
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm002]" value="<?php echo $bm002[$m]; ?>" />
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm003]" value="<?php echo $bm003[$m]; ?>" />
												<input type="hidden" name="order_product4[<?php echo $m ?>][bm004]" value="<?php echo $bm004[$m]; ?>" />

												<td class="center">
													<select id="bm005" onKeyPress="keyFunction()" name="order_product4[<?php echo $i ?>][bm005]">
														<option <?php if ($bm005 == '1') echo 'selected="selected"'; ?> value='1'>外端面</option>
														<option <?php if ($bm005 == '2') echo 'selected="selected"'; ?> value='2'>中端面</option>
													</select>

												</td>
												<td class="center"><input type="text" id="bm006" onKeyPress="keyFunction()" name="order_product4[<?php echo $m ?>][bm006]" value="<?php echo $bm006[$m]; ?>" size="10" maxlength='8' /></td>
												<td class="center"><input type="text" id="bm007" onKeyPress="keyFunction()" name="order_product4[<?php echo $m ?>][bm007]" value="<?php echo $bm007[$m]; ?>" size="10" maxlength='8' /></td>

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
									$n = 0;
									$ni = 0;
									while ($n < $ni) { ?>
										<tbody <?php echo    "id=product5_row_" . $product5_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product5_row_0\').remove();" /></td>
												<input type="hidden" name="order_product5[<?php echo $n ?>][bm001]" value="<?php echo $bm001[$n]; ?>" />
												<input type="hidden" name="order_product5[<?php echo $n ?>][bm002]" value="<?php echo $bm002[$n]; ?>" />
												<input type="hidden" name="order_product5[<?php echo $n ?>][bm003]" value="<?php echo $bm003[$n]; ?>" />
												<input type="hidden" name="order_product5[<?php echo $n ?>][bm004]" value="<?php echo $bm004[$n]; ?>" />

												<td class="center">
													<select id="bm005" onKeyPress="keyFunction()" name="order_product5[<?php echo $i ?>][bm005]">
														<option <?php if ($bm005 == '1') echo 'selected="selected"'; ?> value='1'>外端面</option>
														<option <?php if ($bm005 == '2') echo 'selected="selected"'; ?> value='2'>中端面</option>
													</select>

												</td>
												<td class="center"><input type="text" id="bm006" onKeyPress="keyFunction()" name="order_product5[<?php echo $n ?>][bm006]" value="<?php echo $bm006[$n]; ?>" size="10" maxlength='8' /></td>
												<td class="center"><input type="text" id="bm007" onKeyPress="keyFunction()" name="order_product5[<?php echo $n ?>][bm007]" value="<?php echo $bm007[$n]; ?>" size="10" maxlength='8' /></td>

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


					</form>
					<?php
					if ($message == '新增成功!') {
						$message = '<font color="blue">' . $message . '</font><br>';
					} else {
						$message = '<b><font color="red">' . $message . '</font></b><br>';
					}
					if ($message != ' ') { ?>
						<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
													'◎操作說明:[ 欄位淡黃色按2下開視窗查詢,按Shift+Tab鍵跳上一個欄位,Tab鍵跳下一個欄位,新增一筆三點量測軸承孔Shift+↓,新增一筆換線首樣Ctrl+↓,新增一筆出換刀Alt+↓,新增一筆換班Shift+→,新增一筆換線首樣Ctrl+→,新增一筆出換刀Alt+→. ] ' ?> </div> <?php } ?>

				</div> <!-- div-6 -->

			</div> <!-- div-5 -->

		</div> <!-- div-4 -->



	</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/funnew/pcli01_funjs_v.php"); ?>