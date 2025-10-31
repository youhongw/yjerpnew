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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 溶解生產記錄表 - 新增　　　</h1>

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
							<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('prs/prsi01/addform/' . $prev_str); ?>" class="button"><span>上一筆Alt+< </span><img src="<?php echo base_url() ?>assets/image/png/pre.png" /></a>
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
							<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('prs/prsi01/addform/' . $next_str); ?>" class="button"><span>下一筆Alt+> </span><img src="<?php echo base_url() ?>assets/image/png/next.png" /></a>
						<?php } ?>

						<a accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('prs/prsi01/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/prs/prsi01/addsave">

						<?php
						// 頭部表格  isset 檢查變數
						if (!isset($da001)) {
							$da001 = date("Y/m/d");
						}
						if (!isset($da002)) {
							$da002 = '';
						}
						if (!isset($da003)) {
							$da003 = 'HT 150';
						}
						if (!isset($da004)) {
							$da004 = '';
						}
						if (!isset($da005)) {
							$da005 = '';
						}
						if (!isset($da006)) {
							$da006 = '';
						}
						if (!isset($dc001disp)) {
							$dc001disp = '';
							// $dc001disp = 'C:　　　Si:　　　';
						}
						if (!isset($da007)) {
							$da007 = '';
						}
						if (!isset($da008)) {
							$da008 = '';
						}
						if (!isset($da009)) {
							$da009 = '';
						}
						if (!isset($da010)) {
							$da010 = '';
						}
						if (!isset($da011)) {
							$da011 = '';
						}

						$current_product_count = 0;
						$current_product_count1 = 0;
						$current_product_count2 = 0;

						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="normal14a" width="8%">日期： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" ondblclick="scwShow(this,event);" onblur="dateformat_ymd(this);" id="da001" onKeyPress="keyFunction()" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="da001" value="<?php echo $da001; ?>" size="12" type="text" style="background-color:#FFFFE4" required />
								</td>
							</tr>
							<tr>
								<td class="normal14a" width="8%">爐次： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da002" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='8' name="da002" value="<?php echo $da002; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%">材質： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da003" onKeyPress="keyFunction()" onkeyup="this.value=this.value=this.value.toUpperCase();" maxlength='8' name="da003" value="<?php echo $da003; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%">CE值： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da004" onKeyPress="keyFunction()" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1');" maxlength='8' name="da004" value="<?php echo $da004; ?>" size="12" type="text" required />
								</td>
							</tr>
							<tr>
								<td class="normal14a" width="8%">產品名稱： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da005" onKeyPress="keyFunction()" style="width: 70%;" name="da005" value="<?php echo $da005; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%">出爐溫度(℃)： </td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da006" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='8' name="da006" value="<?php echo $da006; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%"></td>
								<td class="normal14a" width="25%">
									<span id='dc001disp'><?php echo $dc001disp; ?></span>
								</td>
							</tr>

							<tr>
								<td class="normal14a" width="8%">電力(開始)</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da007" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" onchange='electricity(this);' maxlength='8' name="da007" value="<?php echo $da007; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%">電力(結束)</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da008" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" onchange='electricity(this);' maxlength='8' name="da008" value="<?php echo $da008; ?>" size="12" type="text" required />
								</td>

								<td class="normal14a" width="8%">電力(耗電)</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da009" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" maxlength='8' name="da009" value="<?php echo $da009; ?>" size="12" type="text" required readonly="true" style="background-color:#EBEBE4" />
								</td>
							</tr>

							<tr>
								<td class="normal14a" width="8%">故障記錄</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da010" onKeyPress="keyFunction()" style="width: 90%;" name="da010" value="<?php echo $da010; ?>" size="12" type="text" />
								</td>

								<td class="normal14a" width="8%">備註</td>
								<td class="normal14a" width="25%">
									<input tabIndex="1" id="da011" onKeyPress="keyFunction()" style="width: 90%;" name="da011" value="<?php echo $da011; ?>" size="12" type="text" />
								</td>

							</tr>


							<div style="width:100%; overflow-x: auto;  ">
								<table style="width:100%;" id="order_product" class="list1">
									<thead>
										<tr>
											<td width="3%" class="center">加料記錄</td>
											<td width="6%" class="center">時間</td>
											<td width="8%" class="center">生鐵(鋼水)</td>
											<td width="8%" class="center">廢鋼</td>
											<td width="8%" class="center">回爐料</td>
											<td width="8%" class="center">增碳劑</td>
											<td width="8%" class="center">矽鐵</td>
											<td width="8%" class="center">錳鐵</td>
											<td width="8%" class="center">硫化鐵</td>

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
												<input type="hidden" name="order_product[<?php echo $i ?>][db001]" value="<?php echo $db001[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][db002]" value="<?php echo $db002[$i]; ?>" />
												<input type="hidden" name="order_product[<?php echo $i ?>][db011]" value="<?php echo $db011[$i]; ?>" />

												<td class="center"><input type="text" id="db003" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][db003]" value="<?php echo $db003[$i]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" maxlength='8' /></td>
												<td class="center"><input type="text" id="db004" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][db004]" value="<?php echo $db004[$i]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" maxlength='8' /></td>
												<td class="center"><input type="text" id="db005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][db005]" value="<?php echo $db005[$i]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" maxlength='8' /></td>
												<td class="center"><input type="text" id="db006" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][db006]" value="<?php echo $db006[$i]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" maxlength='8' /></td>
												<td class="center"><input type="text" id="db007" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][db007]" value="<?php echo $db007[$i]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" maxlength='8' /></td>

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
											<td width="3%" class="center">光譜記錄</td>
											<td width="6%" class="center">C</td>
											<td width="8%" class="center">Si</td>
											<td width="8%" class="center">Mn</td>
											<td width="8%" class="center">P</td>
											<td width="8%" class="center">S</td>
										</tr>
										<tr>
											<td width="3%" class="center" style="background-color: #E38C40;">標準</td>
											<td width="6%" class="center" style="background-color: #E38C40;">3.6~3.85</td>
											<td width="8%" class="center" style="background-color: #E38C40;">2.3~2.5</td>
											<td width="8%" class="center" style="background-color: #E38C40;">0.6↓</td>
											<td width="8%" class="center" style="background-color: #E38C40;">0.15↓</td>
											<td width="8%" class="center" style="background-color: #E38C40;">0.05~0.12</td>
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
												<input type="hidden" name="order_product1[<?php echo $j ?>][dc001]" value="<?php echo $dc001[$j]; ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][dc002]" value="<?php echo $dc002[$j]; ?>" />
												<input type="hidden" name="order_product1[<?php echo $j ?>][dc008]" value="<?php echo $dc008[$j]; ?>" />

												<td class="center"><input type="text" id="dc003" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][dc003]" value="<?php echo $dc003[$j]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dc004" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][dc004]" value="<?php echo $dc004[$j]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dc005" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][dc005]" value="<?php echo $dc005[$j]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dc006" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][dc006]" value="<?php echo $dc006[$j]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dc007" onKeyPress="keyFunction()" name="order_product1[<?php echo $j ?>][dc007]" value="<?php echo $dc007[$j]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>

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
											<td width="3%" class="center">出湯記錄</td>
											<td width="6%" class="center">出鐵水時間</td>
											<td width="8%" class="center">出鐵量(kg)</td>
											<td width="8%" class="center">孕育劑</td>
											<td width="8%" class="center">錳鐵</td>
											<td width="8%" class="center">銅</td>
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
												<input type="hidden" name="order_product2[<?php echo $k ?>][dd001]" value="<?php echo $dd001[$k]; ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][dd002]" value="<?php echo $dd002[$k]; ?>" />
												<input type="hidden" name="order_product2[<?php echo $k ?>][dd008]" value="<?php echo $dd008[$k]; ?>" />

												<td class="center"><input type="text" id="dd003" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][dd003]" value="<?php echo $dd003[$k]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dd004" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][dd004]" value="<?php echo $dd004[$k]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dd005" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][dd005]" value="<?php echo $dd005[$k]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dd006" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][dd006]" value="<?php echo $dd006[$k]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>
												<td class="center"><input type="text" id="dd007" onKeyPress="keyFunction()" name="order_product2[<?php echo $k ?>][dd007]" value="<?php echo $dd007[$k]; ?>" size="10" style="background-color:#EBEBE4" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,1})?).*$/g, '$1');" maxlength='8' /></td>

											</tr>
										</tbody>

										<?php $k++;
										$mproduct2_row = (int) $product2_row + 1;
										$product2_row = (string)$mproduct2_row;
										echo "<script>$('#row_count2').val(" . $product2_row . ")</script>"; ?>

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
													'◎操作說明:[ 欄位淡黃色按2下開視窗查詢,按Shift+Tab鍵跳上一個欄位,Tab鍵跳下一個欄位,新增一筆加料記錄Ctrl+↓,新增一筆光譜記錄Shift+↓,新增一筆出湯記錄Alt+↓. ] ' ?> </div> <?php } ?>

				</div> <!-- div-6 -->

			</div> <!-- div-5 -->

		</div> <!-- div-4 -->



	</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/funnew/prsi01_funjs_v.php"); ?>

<script>
	current_count = 0;
	current_count1 = 0;
	current_count2 = 0;
</script>