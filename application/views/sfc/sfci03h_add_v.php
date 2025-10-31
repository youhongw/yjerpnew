<div id="container">
	<!-- div-1 -->
	<div id="header">
		<!-- div-2 -->
		<div class="div1">
			<!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main"><span>&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 緊固件 - 生產日報單 - 新增　　　</h1>
					<div style="float:left;padding-top: 5px;">
						<button type='submit' tabIndex="98" style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" onfocus="$('#sfci01m').focus();" accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
						<a accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('sfc/sfci03h/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/sfc/sfci03h/addsave">
						<?php
						// 頭部表格  isset 檢查變數 存檔後可保留值
						//預設稅率,廠別,幣別
						$stax_rate = $this->session->userdata('sysma004');
						$sysma200 = $this->session->userdata('sysma200');

						if (!isset($td001)) {
							$td001 = $this->input->post('td001');
						}
						if (!isset($td001disp)) {
							$td001disp = $this->input->post('td001disp');
						}

						if (!isset($td002)) {
							$td002 = $this->input->post('td002');
						}
						if (!isset($td003)) {
							$td003 = date("Y/m/d");
						}
						if (!isset($td004)) {
							$td004 = 'FW001';
						}
						if (!isset($td004disp)) {
							$td004disp = '緊固件開料線';
						}
						if (!isset($td005)) {
							$td005 = $this->input->post('td005');
						}
						if (!isset($td006)) {
							$td006 = $this->input->post('td006');
						}
						//  $td025=$this->input->post('td025');  一筆存檔清空白
						if (!isset($td007)) {
							$td007 = 0;
						}
						if (!isset($td008)) {
							$td008 = date("Y/m/d");
						}
						if (!isset($td009)) {
							$td009 = $username;
						}
						if (!isset($td010)) {
							$td010 = "N";
						}
						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="start14a" width="9%"><span class="required">報工單別：</span></td>
								<!--onchange="startsfci01(this);check_title_no();"    -->
								<td class="normal14a" width="25%">
									<!-- <input tabIndex="1" id="sfci01" onKeyPress="keyFunction()" name="td001" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='4' onblur="check_sfci01(this);check_title_no();" onchange="chang_line()" value="<?php echo $td001; ?>" size="12" type="text" required />
									<a href="javascript:;">
										<img id="Showsfci01disp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" />
									</a>
									<span id="sfci01disp">
										<?php echo $td001disp; ?>
									</span> -->
									<select id="sfci01" onKeyPress="keyFunction()" name="td001" onfocus="check_title_no()" tabIndex="1" style="background-color:#EEF1CE">
										<option selected="selected" value='D408'>D408:緊固件報工 </option>
										<option value='D508'>D508:緊固件報工手動</option>
									</select>
								</td>
								<td class="normal14a" width="8%">單據日期： </td> <!-- dateformat_ymd(this); -->
								<td class="normal14a" width="25%">
									<input tabIndex="2" ondblclick="scwShow(this,event);" id="td008" onKeyPress="keyFunction()" onblur="dateformat_ymd(this);check_title_no();" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" name="td008" value="<?php echo $td008; ?>" size="12" type="text" maxlength='10' style="background-color:#FFFFE4" />
									<img onclick="scwShow(td008,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
								</td>
								<td class="start14a" width="8%"><span class="required">報工單號：</span></td>
								<td class="normal14a" width="25%"><input tabIndex="3" id="td002" onKeyPress="keyFunction()" readonly="value" name="td002" onfocus="check_title_no()" value="<?php echo $td002; ?>" size="12" type="text" /></td>
							</tr>

							<tr>
								<td class="normal14a"><span class="required">生產線別：</span></td>
								<td class="normal14">
									<input type="text" tabIndex="4" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" id="cmsi04" onfocus="check_title_no();" onblur="check_cmsi04(this);check_title_no();clear_row(this);" name="td004" value="<?php echo  $td004; ?>" size="12" required />
									<a href="javascript:;"><img id="Showcmsi04disp" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
									<span id="cmsi04disp"> <?php echo $td004disp; ?> </span>
								</td>
								<td class="normal14">備註：</td>
								<td class="normal14"><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="td006" name="td006" value="<?php echo $td006; ?>" size="30" /></td>
								<td class="normal14">確認碼：</td>
								<td class="normal14">
									<select id="verify" onKeyPress="keyFunction()" name="td005" onChange="selverify(this)" tabIndex="6" style="background-color:#EEF1CE">
										<option <?php if ($td005 == 'Y') echo 'selected="selected"'; ?> value='Y'>Y確認</option>
										<option <?php if ($td005 == 'N') echo 'selected="selected"'; ?> value='N'>N取消確認</option>
										<option <?php if ($td005 == 'V') echo 'selected="selected"'; ?> value='V'>V作廢</option>
									</select><span id="approved"></span>
								</td>
							</tr>

							<tr>
								<td class="normal14a">生產日期：</td>
								<td class="normal14"><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="td003" name="td003" value="<?php echo $td003; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>
								<td class="normal14">列印次數：</td>
								<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="td007" name="td007" value="<?php echo $td007; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>
								<td class="normal14">簽核狀態：</td>
								<td class="normal14">
									<select id="td010" tabIndex="9" readonly="value" onKeyPress="keyFunction()" name="td010" style="background-color:#EEF1CE">
										<option <?php if ($td010 == 'N') echo 'selected="selected"'; ?> value='N'>N.不執行電子簽核</option>
										<option <?php if ($td010 == '0') echo 'selected="selected"'; ?> value='0'>0.待處理</option>
										<option <?php if ($td010 == '1') echo 'selected="selected"'; ?> value='1'>1.簽核中</option>
										<option <?php if ($td010 == '2') echo 'selected="selected"'; ?> value='2'>2.退件</option>
										<option <?php if ($td010 == '3') echo 'selected="selected"'; ?> value='3'>3.已核准</option>
										<option <?php if ($td010 == '4') echo 'selected="selected"'; ?> value='4'>4.取消確認中</option>
										<option <?php if ($td010 == '5') echo 'selected="selected"'; ?> value='5'>5.作廢中</option>
										<option <?php if ($td010 == '6') echo 'selected="selected"'; ?> value='6'>6.取消作廢中</option>
									</select>
								</td>
							</tr>

							<tr>
								<td class="normal14">確認者：</td>
								<td class="normal14"><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="td009" name="td009" value="<?php echo $td009; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>
								<td class="normal14"></td>
								<td class="normal14"></td>
								<td class="normal14"></td>
								<td class="normal14"></td>
							</tr>
						</table>



						<!-- 明細表頭  -->
						<div style="width:100%; overflow-x: auto;  ">
							<table style="width:100%;" id="order_product" class="list1">
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


				</div> <!-- end 頁標籤 -->
				</form>
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

			</div> <!-- div-6 -->
		</div> <!-- div-5 -->
	</div> <!-- div-4 -->

</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php include_once("./application/views/funnew/sfci01_funmjs_v.php"); ?>
<!-- 報工單別 -->
<?php include_once("./application/views/funnew/cmsi04_funmjs_v.php"); ?>
<!-- 生產線別 -->
<?php include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>
<!-- 人員 -->

<?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>
<!-- 全域變數 -->
<?php include_once("./application/views/funnew/sfci03_fundjs_v.php"); ?>
<!-- 明細開視窗 -->
<script type="text/javascript">
	//存檔游標focus
	$(document).ready(function() {
		$('#sfci01').focus();
	});


	function keyFunction() {
		$("input").not($(":button")).keypress(function(evt) {
			if (evt.keyCode == 13) {
				if ($(this).attr("type") !== 'submit') {
					var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio');
					var index = fields.index(this);
					if (index > -1 && (index + 1) < fields.length) {
						fields.eq(index + 1).focus();
					}
					$(this).blur();
					return false;
				}
			}
		});
	}
</script>