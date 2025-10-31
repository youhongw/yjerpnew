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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 拋丸粗糙度測量表 - 新增　　　</h1>

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
							<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('pcl/pcli02/addform/' . $prev_str); ?>" class="button"><span>上一筆Alt+< </span><img src="<?php echo base_url() ?>assets/image/png/pre.png" /></a>
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
							<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('pcl/pcli02/addform/' . $next_str); ?>" class="button"><span>下一筆Alt+> </span><img src="<?php echo base_url() ?>assets/image/png/next.png" /></a>
						<?php } ?>

						<a accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pcl/pcli02/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/pcl/pcli02/addsave">

						<?php
						// 頭部表格  isset 檢查變數
						if (!isset($sa001)) {
							// $sa001 = date("Y/m/d");
							$sa001 = '';
						}

						if (!isset($sa003)) {
							$sa003 = '';
						}
						if (!isset($MX003)) {
							$MX003 = '';
						}
						if (!isset($sa002)) {
							$sa002 = '';
						}
						if (!isset($MB002)) {
							$MB002 = '';
						}
						if (!isset($MB003)) {
							$MB003 = '';
						}

						if (!isset($sa004)) {
							$sa004 = '0800';
						}
						if (!isset($sa005)) {
							$sa005 = '1700';
						}
						if (!isset($sa006)) {
							$sa006 = '8';
						}
						if (!isset($sa007)) {
							$sa007 = '';
						}
						if (!isset($sa008)) {
							$sa008 = '1';
						}
						if (!isset($sb005sum)) {
							$sb005sum = '0';
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
									<input tabIndex="1" ondblclick="scwShow(this,event);" onblur="dateformat_ymd(this);" id="sa001" onKeyPress="keyFunction()" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="sa001" value="<?php echo $sa001; ?>" size="12" type="text" style="background-color:#FFFFE4" required />
								</td>

								<td class="normal14a" width="8%">次　　數： </td>
								<td class="normal14a" width="25%">
									<select id="sa008" onKeyPress="keyFunction()" name="sa008" tabIndex="1" style="background-color:#EEF1CE">
										<option selected="selected" value="1">1</option>
										<option value="2">2</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="normal14a" width="8%">品　　號： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="sa002" onKeyPress="keyFunction()" onchange="check_invi02(this);" ondblclick="search_invi02_window(this);" style="width: 50%;background-color:#FFFFE4;" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='20' name=" sa002" value="<?php echo $sa002; ?>" size="12" type="text" required />
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
									<input tabIndex="1" id="sa003" onKeyPress="keyFunction()" onchange="check_cmsi03d(this);" ondblclick="search_cmsi03d_window(this);" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='6' name=" sa003" value="<?php echo $sa003; ?>" size="12" type="text" style="background-color:#FFFFE4" required />
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
									<input tabIndex="1" id="sa007" onKeyPress="keyFunction()" style="width: 90%;" name="sa007" value="<?php echo $sa007; ?>" size="12" type="text" />
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
									$i = 0;
									$ii = 0;
									while ($i < $ii) { ?>
										<tbody <?php echo    "id=product_row_" . $product_row ?>>
											<tr onclick="tagscheck(this);">
												<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product_row_0\').remove();sum_num();" /></td>
												<input type="hidden" name="order_product[<?php echo $i ?>][sb001]" value="<?php echo $sb001[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][sb002]" value="<?php echo $sb002[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][sb003]" value="<?php echo $sb003[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][sb004]" value="<?php echo $sb004[$i]; ?>" />

												<td class="center"><input type="text" id="sb005" onchange="sum_num()" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][sb005]" value="<?php echo $sb005[$i]; ?>" size="10" maxlength='8' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" required /></td>
												<td class="center"><input type="text" id="sb006" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][sb006]" value="<?php echo $sb006[$i]; ?>" size="10" maxlength='8' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" required /></td>
												<td class="center"><input type="text" id="sb007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][sb007]" value="<?php echo $sb007[$i]; ?>" size="10" maxlength='8' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" /></td>

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
<?php include("./application/views/funnew/pcli02_funjs_v.php"); ?>