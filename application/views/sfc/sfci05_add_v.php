<div id="container">
	<!-- div-1 -->
	<div id="header">
		<!-- div-2 -->
		<div class="div1">
			<!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 移轉單建立作業 - 新增　　　</h1>
					<div style="float:left;padding-top: 5px;">
						<button type='submit' tabIndex="98" style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" onfocus="$('#sfci01').focus();" accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
						<a accesskey="x" tabIndex="97" id='cancel' name='cancel' href="<?php echo site_url('sfc/sfci05a/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/sfc/sfci05/addsave">
						<?php
						// 頭部表格  isset 檢查變數 存檔後可保留值
						//預設稅率,廠別,幣別
						$stax_rate = $this->session->userdata('sysma004');
						$sysma200 = $this->session->userdata('sysma200');

						if (!isset($TB010)) {
							$TB007 = $sysma200;
						} else {
							$TB010 = $this->input->post('TB010');
						}
						if (!isset($TB016)) {
							$TB016 = $this->session->userdata('manager');
						} else {
							$TB016 = $this->input->post('TB016');
						}

						if (!isset($TB001)) {
							$TB001 = $this->input->post('sfci01m');
						}
						if (!isset($TB001disp)) {
							$TB001disp = $this->input->post('TB001disp');
						}

						if (!isset($TB002)) {
							$TB002 = $this->input->post('TB002');
						}
						if (!isset($TB003)) {
							$TB003 = date("Y/m/d");
						}
						if (!isset($TB004)) {
							$TB004 = $this->input->post('TB004');
						}
						if (!isset($TB005)) {
							$TB005 = $this->input->post('TB005');
						}
						if (!isset($TB005disp)) {
							$TB005disp = $this->input->post('TB005disp');
						}

						if (!isset($TB006)) {
							$TB006 = $this->input->post('TB006');
						}
						if (!isset($TB007)) {
							$TB007 = $this->input->post('TB007');
						}
						if (!isset($TB008)) {
							$TB008 = $this->input->post('TB008');
						}
						if (!isset($TB008disp)) {
							$TB008disp = $this->input->post('TB008disp');
						}
						if (!isset($TB009)) {
							$TB009 = $this->input->post('TB009');
						}
						if (!isset($TB010)) {
							$TB010 = $this->input->post('TB010');
							$TB010 = 'DY';
						}
						if (!isset($TB010disp)) {
							$TB010disp = $this->input->post('TB010disp');
							$TB010disp = '陽江得貹';
						}

						if (!isset($TB011)) {
							$TB011 = 0;
						}
						if (!isset($TB012)) {
							$TB012 = $this->input->post('TB012');
						}
						if (!isset($TB013)) {
							$TB013 = 'Y';
						}
						if (!isset($TB014)) {
							$TB014 = $this->input->post('TB014');
						}
						//  $TB025=$this->input->post('TB025');  一筆存檔清空白
						if (!isset($TB015)) {
							$TB015 = date("Y/m/d");
						}
						if (!isset($TB016)) {
							$TB016 = $username;
						}
						if (!isset($TB017)) {
							$TB017 = "N";
						}
						?>

						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="start14a" width="9%"><span class="required">移轉單別：</span></td>
								<!--onchange="startsfci01m(this);check_title_no();"    -->
								<td class="normal14a" width="25%"><input tabIndex="1" id="sfci01m" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='4' name="TB001" onblur="check_sfci01m(this);check_title_no();" onchange="chang_line()" value="<?php echo $TB001; ?>" size="12" type="text" required />
									<a href="javascript:;"><img id="Showsfci01mdisp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a>
									<span id="sfci01mdisp"> <?php echo $TB001disp; ?> </span>
								</td>
								<td class="normal14a" width="8%">單據日期： </td> <!-- dateformat_ymd(this); -->
								<td class="normal14a" width="25%"><input tabIndex="2" ondblclick="scwShow(this,event);" id="TB015" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" maxlength='10' onchange="dateformat_ymd(this);check_title_no();" name="TB015" value="<?php echo $TB015; ?>" size="12" type="text" style="background-color:#FFFFE4" />
									<img onclick="scwShow(TB015,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
								</td>
								<td class="start14a" width="8%"><span class="required">移轉單號：</span></td>
								<td class="normal14a" width="25%"><input tabIndex="3" id="TB002" readonly="value" onfocus="check_title_no()" name="TB002" onfocus="check_title_no();" value="<?php echo $TB002; ?>" size="12" type="text" /></td>
							</tr>

							<tr>
								<td class="normal14a">廠別代號：</td>
								<td class="normal14"><input type="text" tabIndex="4" id="cmsi02" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" onfocus="check_title_no();" maxlength='4' onblur="check_cmsi02(this)" name="TB010" value="<?php echo  $TB010; ?>" size="12" required />
									<a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url() ?>assets/image/png/store.png" alt="" align="top" /></a>
									<span id="cmsi02disp"> <?php echo $TB010disp; ?> </span>
								</td>
								<td class="normal14">更新碼：</td>
								<td class="normal14"> <input type="hidden" name="TB012" class="TB012" value="N" />
									<input tabIndex="5" id="TB012" name="TB012" <?php if ($TB012 == 'Y') echo 'checked';  ?> <?php if ($TB012 != 'Y') echo 'check'; ?> value="Y" size="1" type='checkbox' />
								</td>
								<td class="normal14">備註：</td>
								<td class="normal14"><input type="text" tabIndex="6" id="TB014" name="TB014" value="<?php echo $TB014; ?>" size="30" /></td>
							</tr>
							<tr>
								<td class="normal14">移出類別：</td>
								<td class="normal14"><select id="TB004" name="TB004" tabIndex="7" style="background-color:#EEF1CE">
										<option <?php if ($TB004 == '1') echo 'selected="selected"'; ?> value='1'>1生產線別</option>
										<!-- <option <?php if ($TB004 == '2') echo 'selected="selected"'; ?> value='2'>2加工廠商</option> -->
										<option <?php if ($TB004 == '3') echo 'selected="selected"'; ?> value='3'>3庫別</option>
									</select></td>
								<td class="normal14"><span class="required">移出部門：</span></td>
								<td class="normal14"><input type="text" tabIndex="8" id="cmsi05" name="TB005" onblur="check_cmsi05(this);" onfocus="check_title_no();" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='10' value="<?php echo  $TB005; ?>" size="12" required />
									<a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
									<span id="cmsi05disp"> <?php echo $TB005disp; ?> </span>
								</td>
								<td class="normal14">移出部門名稱：</td>
								<td class="normal14"><input type="text" tabIndex="9" readonly="value" id="TB006" name="TB006" value="<?php echo $TB006; ?>" size="12" style="background-color:#F0F0F0" /></td>
							</tr>
							<tr>
								<td class="normal14">移入類別：</td>
								<td class="normal14"><select id="TB007" name="TB007" tabIndex="10" style="background-color:#EEF1CE" onchange="clearb()">
										<option <?php if ($TB007 == '1') echo 'selected="selected"'; ?> value='1'>1生產線別</option>
										<!-- <option <?php if ($TB007 == '2') echo 'selected="selected"'; ?> value='2'>2加工廠商</option> -->
										<option <?php if ($TB007 == '3') echo 'selected="selected"'; ?> value='3'>3庫別</option>
									</select></td>
								<td class="normal14"><span class="required">移入部門：</span></td>
								<td class="normal14"><input type="text" tabIndex="11" id="cmsi05a" name="TB008" onblur="check_cmsi05a(this);" onfocus="check_title_no();" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" maxlength='10' value="<?php echo  $TB008; ?>" size="12" required />
									<a href="javascript:;"><img id="Showcmsi05adisp" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
									<span id="cmsi05adisp"> <?php echo $TB008disp; ?> </span>
								</td>
								<td class="normal14">移入部門名稱：</td>
								<td class="normal14"><input type="text" tabIndex="12" readonly="value" id="TB009" name="TB009" value="<?php echo $TB009; ?>" size="12" style="background-color:#F0F0F0" /></td>
							</tr>
							<tr>
								<td class="normal14">簽核狀態：</td>
								<td class="normal14"><select id="TB017" tabIndex="13" disabled='ture' name="TB017" style="background-color:#F0F0F0">
										<option <?php if ($TB017 == 'N') echo 'selected="selected"'; ?> value='N'>N.不執行電子簽核</option>
										<option <?php if ($TB017 == '0') echo 'selected="selected"'; ?> value='0'>0.待處理</option>
										<option <?php if ($TB017 == '1') echo 'selected="selected"'; ?> value='1'>1.簽核中</option>
										<option <?php if ($TB017 == '2') echo 'selected="selected"'; ?> value='2'>2.退件</option>
										<option <?php if ($TB017 == '3') echo 'selected="selected"'; ?> value='3'>3.已核准</option>
										<option <?php if ($TB017 == '4') echo 'selected="selected"'; ?> value='4'>4.取消確認中</option>
										<option <?php if ($TB017 == '5') echo 'selected="selected"'; ?> value='5'>5.作廢中</option>
										<option <?php if ($TB017 == '6') echo 'selected="selected"'; ?> value='6'>6.取消作廢中</option>
									</select></td>
								<td class="normal14">確認者：</td>
								<td class="normal14"><input type="text" tabIndex="14" readonly="value" id="TB016" name="TB016" value="<?php echo $TB016; ?>" style="background-color:#F0F0F0" size="12" /></td>
								<td class="normal14">移轉日期：</td>
								<td class="normal14"><input tabIndex="15" readonly="value" id="TB003" name="TB003" value="<?php echo $TB003; ?>" size="12" type="text" style="background-color:#F0F0F0" />
								</td>
							</tr>
							<tr>

							<tr>
								<td class="normal14">列印次數：</td>
								<td class="normal14"><input type="text" tabIndex="16" readonly="value" id="TB011" name="TB011" value="<?php echo $TB011; ?>" size="12" style="background-color:#F0F0F0" /></td>
								<td class="normal14">確認碼：</td>
								<td class="normal14"><select id="verify" name="TB013" onChange="selverify(this)" tabIndex="17" style="background-color:#EEF1CE" style="background-color:#EEF1CE">
										<option <?php if ($TB013 == 'Y') echo 'selected="selected"'; ?> value='Y'>Y確認</option>
										<option <?php if ($TB013 == 'N') echo 'selected="selected"'; ?> value='N'>N取消確認</option>
										<option <?php if ($TB013 == 'V') echo 'selected="selected"'; ?> value='V'>V作廢</option>
									</select><span id="approved"></span></td>
								<td class="normal14"></td>
								<td class="normal14"></td>
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

											if ($TB001 != 'D310') {
												echo " value='1' ";
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
						<!-- 合計     -->
						<!--    <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　訂單金額：</b></td>
				<td ><input type='text' readonly="value" name='TB029' id="TB029" size="8" value="<?php echo $TB029; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　稅額：</b></td>
				<td ><input type='text' readonly="value" name='TB030' id="TB030" size="8" value="<?php echo $TB030; ?>"  style="background-color:#F0F0F0" /></td>
			
				<td class="right" valign="top"><b style="color: #003A88;">　　合計金額：</b></td>
				<td ><input type='text' readonly="value" name="tc2930" id="tc2930" size="8" value="<?php echo $TB029 + $TB030; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總數量：</b></td>
				<td ><input type='text' readonly="value" name='TB031' id="TB031" size="8" value="<?php echo $TB031; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總毛重：</b></td>
				<td ><input type='text' readonly="value" name='TB043' id="TB043" size="8" value="<?php echo $TB043; ?>"  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　總材積：</b></td>
				<td ><input type='text' readonly="value" name='TB044' id="TB044" size="8" value="<?php echo $TB044; ?>"  style="background-color:#F0F0F0" /></td>
			
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		合計     -->

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
<!-- 訂單單別 -->
<?php include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>
<!-- 廠別 -->

<!-- 部門 -->

<?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>
<!-- 全域變數 -->
<?php include_once("./application/views/funnew/sfci05_fundjs_v.php"); ?>
<!-- 明細開視窗 -->
<script type="text/javascript">
	//存檔游標focus
	$(document).ready(function() {
		$('#sfci01m').focus();
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

	$(function() {
		// setup enter to next input element function
		setupEnterToNext();
	});
	// enter to next input element function
	function setupEnterToNext() {
		// add keydown event for all inputs
		$(':input').keydown(function(e) {
			if (e.keyCode == 13 /*Enter*/ ) {
				// focus next input elements
				$(':input:visible:enabled:eq(' + ($(':input:visible:enabled').index(this) + 1) + ')').focus();
				e.preventDefault();
			}
		});
	}
</script>