<div id="container">
	<!-- div-1 -->
	<div id="header">
		<!-- div-2 -->
		<div class="div1">
			<!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url() ?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url() ?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url() ?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php">退出系統</a>
	    </div> -->
			<?php include_once("./application/views/funnew/fun_head_icon.html"); ?>
		</div>

		<?php
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$gro = trim($this->session->userdata('sysgroup'));
		?>

		<div id="content">
			<!-- div-3 -->
			<div class="box">
				<!-- div-4 -->
				<div class="heading">
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 材料BOM建立作業 - 新增　　　</h1>
					<div style="float:left;padding-top: 5px; ">
						<button style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
						<a accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi02a/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>

					</div>
				</div>
				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 90%;" action="<?php echo base_url() ?>index.php/bom/bomi02a/addsave">
						<?php
						// 頭部表格  isset 檢查變數
						$date = date("Y/m/d");
						$mc001 = $this->input->post('mc001');
						$mc001disp = $this->input->post('mc001disp');
						$mc001disp1 = $this->input->post('mc001disp1');
						$mc001disp2 = $this->input->post('mc001disp2');
						$mc001disp3 = $this->input->post('mc001disp3');
						$mc001disp4 = $this->input->post('mc001disp4');
						$mc002 = $this->input->post('mc002');
						$mc003 = $this->input->post('mc003');
						if (!isset($create_date)) {
							$create_date = date("Y/m/d");
						}
						if (!isset($mc004)) {
							$mc004 = 1;
						}
						$mc005 = $this->input->post('mc005');
						$mc005disp = $this->input->post('mc005');

						$mc010 = $this->input->post('mc010');
						$modi_date = $date;
						$mc006 = $this->input->post('mc006');
						$mc007 = $this->input->post('mc007');
						$mc008 = $this->input->post('mc008');
						$mc009 = $this->input->post('mc009');
						if (!isset($mc009disp)) {
							$mc009disp = "";
						}


						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="normal14y" width="10%"><span class="required">主件品號：</span> </td>
								<td class="normal14a" width="22%">
									<input tabIndex="1" id="invi02" onKeyPress="keyFunction()" maxlength='20' onkeyup="this.value=this.value.replace(/[^A-Z0-9\-]/gi,'');this.value=this.value.toLocaleUpperCase();" onblur="check_key(this);" ondblclick="search_invi02_window();" name="mc001" value="<?php echo $mc001; ?>" size="12" type="text" style="width: 130px;background-color:#FFFFE4" required />
									<a href="javascript:;"><img id="Showinvi02idisp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a>
									<span id="invi02disp"></span>
								</td>
								<td class="normal14y" width="10%">品名： </td>
								<td class="normal14a" width="24%"><input type="text" tabIndex="2" readonly="value" onKeyPress="keyFunction()" id="mc001disp" name="mc001disp" size="30" value="<?php echo $mc001disp; ?>" style="background-color:#F5F5F5;width: 50%;" /></td>

							</tr>
							<tr>
								<td class="normal14y" width="10%">規格： </td>
								<td class="normal14a" width="24%"><input type="text" tabIndex="3" readonly="value" onKeyPress="keyFunction()" id="mc001disp1" name="mc001disp1" value="<?php echo $mc001disp1; ?>" style="background-color:#F5F5F5;width: 50%;" /></td>
								<td class="normal14z">單位：</td>
								<td class="normal14"><input tabIndex="4" maxlength='4' id="mc002" onKeyPress="keyFunction()" name="mc002" value="<?php echo $mc002; ?>" type="text" required /></td>

								<!-- <td class="normal14z">小單位：</td>
								<td class="normal14a"><input tabIndex="5" id="mc003" onKeyPress="keyFunction()" name="mc003" value="<?php echo $mc003; ?>" type="text" style="background-color:#F5F5F5" /></td>
								<td class="normal14z">屬性：</td>
								<td class="normal14a"><input tabIndex="6" id="mc001disp4" onKeyPress="keyFunction()" name="mc001disp4" value="<?php echo $mc001disp4; ?>" type="text" style="background-color:#F5F5F5" /></td> -->

							</tr>
							<tr>
								<td class="normal14z">標準批量︰</td>
								<td class="normal14a"><input tabIndex="5" id="mc004" maxlength='15' onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress="keyFunction()" name="mc004" value="<?php echo  $mc004; ?>" type="text" /></td>
								<td class="normal14z">群組：</td>
								<td class="normal14">
									<?php if ($super == 'Y') { ?>
										<select id="admi04" onKeyPress="keyFunction()" name="mc009" tabIndex="6" style="background-color:#EEF1CE">
											<?php
											foreach ($group as $key => $val) {
												if ($key == 0)
													echo '<option ' . ' selected="selected" ' . ' value="' . trim($val->me001) . '">' . mb_convert_encoding(trim($val->me002), 'utf-8', 'big-5') . '</option>';
												else
													echo '<option  value="' . trim($val->me001) . '">' . mb_convert_encoding(trim($val->me002), 'utf-8', 'big-5') . '</option>';
											}
											?>
										</select>
									<?php } else { ?>
										<select id="mc009" onKeyPress="keyFunction()" name="mc009" tabIndex="6" style="background-color:#EEF1CE">
											<?php
											$arr = explode(";", $gro);
											$count_gro = ($arr[count($arr) - 1]) ? count($arr) : count($arr) - 1;
											for ($i = 0; $i < $count_gro; $i++) {
												foreach ($group as $key => $val) {
													if (trim($val->me001) == trim($arr[$i])) {
														if ($i == 0)
															echo '<option ' . ' selected="selected" ' . ' value="' . trim($val->me001) . '">' . mb_convert_encoding(trim($val->me002), 'utf-8', 'big-5') . '</option>';
														else
															echo '<option  value="' . trim($val->me001) . '">' . mb_convert_encoding(trim($val->me002), 'utf-8', 'big-5') . '</option>';
													}
												}
											}
											?>
										</select>
									<?php } ?>
								</td>

							</tr>
							<tr>
								<td class="normal14z">備註：</td>
								<td class="normal14a"><input tabIndex="7" id="mc010" onKeyPress="keyFunction()" name="mc010" value="<?php echo  $mc010; ?>" type="text" style="width: 50%;" /></td>
							</tr>


						</table>


						<div>
							<table id="order_product" class="list1">
								<thead>
									<tr>
										<td width="3%"></td>
										<?php foreach ($usecol_array as $key => $val) {
											echo "<td ";
											if (isset($val['width'])) {
												echo "width='" . $val['width'] . "' ";
											}
											if (isset($val['title_class'])) {
												echo "class='" . $val['title_class'] . "' ";
											}
											echo " >";
											echo $val['name'];
											echo "</td>";
										} ?>
									</tr>
								</thead>
								<?php $current_product_count = 0; //依照資料庫紀錄的明細先列一遍 新增只給初值 
								?>
								<tfoot>

									<tr>
										<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
										<td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
									</tr>
								</tfoot>
							</table>
						</div>

					</form>
				</div> <!-- div-6 -->
				<br>
				<?php if ($message != ' ') { ?>
					<?php
					if ($message != '新增成功!') {
						$message = '<b><font color="red">' . $message . '</font></b><br>';
					} else {
						$message = '<font color="blue">' . $message . '</font><br>';
					}
					?>
					<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
												'◎操作說明:[ 欄位淡黃色按2下開視窗查詢,淡青色為下拉選項,按Enter鍵或Tab鍵跳下一個欄位, Alt + ↓ 新增一筆明細. ] ' ?> </div> <?php } ?>
			</div> <!-- div-5 -->
		</div> <!-- div-4 -->


	</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include_once("./application/views/funnew/invi02v_funmjs_v.php"); ?>
<!-- 主件品號 -->
<!-- <?php include_once("./application/views/funnew/moci01a_funmjs_v.php"); ?> -->
<!-- 製令單別51 -->

<?php include_once './application/views/funnew/admi04_funmjs_v.php'; ?>

<?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>
<!-- 全域變數 -->
<?php include_once("./application/views/funnew/bomi02a_fundjs_v.php"); ?>
<!-- 明細開視窗 -->
<script type="text/javascript">
	//存檔游標focus
	$(document).ready(function() {
		$('#invi02').focus();
	});
</script>