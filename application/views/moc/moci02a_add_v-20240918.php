<div id="container">
	<!-- div-1 -->
	<div id="header">
		<!-- div-2 -->
		<div class="div1">
			<!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main"><?php echo $systitle ?></a></div>
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
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 配料單建立作業 - 新增　　　</h1>
					<div style="float:left;padding-top: 5px; ">
						<button style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" onfocus="$('#ta003').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
						<a accesskey="x" tabIndex="96" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci02a/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>
			</div>
			<div class="content">
				<!-- div-5 -->
				<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" style="width: 100%;" action="<?php echo base_url() ?>index.php/moc/moci02a/addsave">

					<?php
					// 頭部表格  isset 檢查變數
					$date = date("Y/m/d");
					if (!isset($ta001)) {
						$ta001 = $this->input->post('ta001');
						$ta001 = "I11";
					}
					if (!isset($ta001disp)) {
						$ta001disp = $this->input->post('ta001');
						$ta001disp = "配料單";
					}

					$ta002 = $this->input->post('ta002');
					if (!isset($ta003)) {
						$ta003 = date("Y/m/d");
					}
					//  $ta003=date("Y/m/d");
					//   $ta004=$this->input->post('ta004');
					if (!isset($ta004)) {
						$ta004 = date("Y/m/d");
					}
					$ta005 = $this->input->post('ta005');
					$ta006 = $this->input->post('ta006');
					$ta006disp = $this->input->post('ta006');

					$ta007 = $this->input->post('ta007');
					//  if(!isset($ta014)) { $ta014=date("Y/m/d"); }
					if (!isset($ta031)) {
						$ta031 = 0;
					}

					if (!isset($ta013)) {
						$ta013 = 'Y';
					}
					if (!isset($ta030)) {
						$ta030 = '1';
					}
					if (!isset($ta011)) {
						$ta011 = '1';
					}
					if (!isset($ta013)) {
						$ta013 = 'Y';
					}

					$ta034 = $this->input->post('ta034');
					$ta035 = $this->input->post('ta035');
					if (!isset($ta044)) {
						$ta044 = 'N';
					}

					?>
					<?php

					// if(!isset($ta007)) { $ta007=0.05; }sysma003 幣別 sysma004 匯率
					//  $cmsq06a=$this->session->userdata('sysma003');
					//  $ta030=$this->session->userdata('sysma004');
					$ta015 = $this->input->post('ta015');
					$ta016 = $this->input->post('ta016');
					$ta017 = $this->input->post('ta017');
					$ta018 = $this->input->post('ta018');

					$ta009 = $this->input->post('ta009');
					$ta010 = $this->input->post('ta010');
					$ta012 = $this->input->post('ta012');
					$ta014 = $this->input->post('ta014');

					if (!isset($ta004)) {
						$ta004 = date("Y/m/d");
					}
					if (!isset($ta013)) {
						$ta013 = 'Y';
					}
					if (!isset($ta040)) {
						$ta040 = date("Y/m/d");
					}
					$ta041 = $this->session->userdata('manager');
					if (!isset($ta049)) {
						$ta049 = 'N';
					}
					// $ta049=$this->input->post('ta049');
					if (!isset($ta013)) {
						$ta013 = 'Y';
					}

					?>
					<?php
					$ta019 = $this->input->post('ta019');
					$ta019disp = $this->input->post('ta019');
					$ta020 = $this->input->post('ta020');
					$ta020disp = $this->input->post('ta020');
					$ta021 = $this->input->post('ta021');
					$ta021disp = $this->input->post('ta021');
					$ta032 = $this->input->post('ta032');
					$ta032disp = $this->input->post('ta032');
					$ta042 = $this->session->userdata('sysma003');
					$ta042disp = $this->session->userdata('sysma003');
					$ta043 = $this->session->userdata('sysma004');

					$ta022 = $this->input->post('ta022');
					$ta023 = $this->input->post('ta023');
					?>
					<?php
					$ta033 = $this->input->post('ta033');
					$ta024 = $this->input->post('ta024');
					$ta025 = $this->input->post('ta025');
					$copq06a = $this->input->post('ta026');
					$copq06adisp = $this->input->post('ta026');
					$ta027 = $this->input->post('ta027');
					$ta028 = $this->input->post('ta028');
					$ta029 = $this->input->post('ta029');

					?>

					<?php
					if (!isset($sysma200)) {
						$sysma200 = $this->session->userdata('sysma200');
					}
					if (!isset($sysma201)) {
						$sysma201 = $this->session->userdata('sysma201');
					}  ?>
					<table class="form14">
						<!-- 頭部表格 -->
						<tr>
							<td class="normal14y" width="8%"><span class="required">單別：</span> </td>
							<td class="normal14a" width="25%"><input tabIndex="1" id="moci01" onKeyPress="keyFunction()" name="ta001" onchange="check_moci01(this);check_title_no();" value="<?php echo $ta001; ?>" size="12" type="text" required readonly="readonly" style="background-color:#F5F5F5;width: 50%;" />
								<!-- <a href="javascript:;"><img id="Showmoci01disp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a> -->
								<span id="moci01disp"> <?php echo $ta001disp; ?> </span>
							</td>
							<td class="normal14y" width="8%">開單日期： </td>
							<td class="normal14a" width="25%"><input tabIndex="2" ondblclick="scwShow(this,event);" id="ta003" onKeyPress="keyFunction()" onfocus="check_title_no();" onchange="dateformat_ymd(this);check_title_no();" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" name="ta003" value="<?php echo $ta003; ?>" size="12" type="text" maxlength='10' style="background-color:#FFFFE4" />
								<img onclick="scwShow(ta003,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
							</td>
							<td class="normal14y" width="9%"><span class="required">配料單號：</span></td>
							<td class="normal14a" width="25%"><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" onfocus="check_title_no();" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" readonly="value" onfocus="check_title_no()" style="background-color:#F5F5F5;width: 50%;" /><span id="ta002disp"></span></td>
						</tr>
						<tr>
							<td class="normal14z">產品品號：</td>
							<td class="normal14">
								<input tabIndex="4" id="invi02" onKeyPress="keyFunction()" maxlength='20' onkeyup="this.value=this.value.replace(/[^A-Z0-9\-]/gi,'');this.value=this.value.toLocaleUpperCase();" onfocus="check_title_no();" ondblclick="search_invi02i_window()" onchange="check_invi02i(this)" name="ta006" value="<?php echo $ta006; ?>" size="12" type="text" style="width: 40%;" required />
								<a href="javascript:;"><img id="Showinvi02idisp" src="<?php echo base_url() ?>assets/image/png/seek.png" alt="" align="top" /></a>
								<span id="invi02disp"> <?php echo $ta006disp; ?> </span>
							</td>
							<td class="normal14z">品名：</td>
							<td class="normal14a"><input tabIndex="5" id="ta034" onKeyPress="keyFunction()" name="ta034" value="<?php echo $ta034; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>
							<td class="normal14z">規格：</td>
							<td class="normal14a"><input tabIndex="6" id="ta035" onKeyPress="keyFunction()" name="ta035" value="<?php echo $ta035; ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>
						</tr>

						<tr>
							<td class="normal14z">單位：</td>
							<td class="normal14a"><input tabIndex="7" id="ta007" onKeyPress="keyFunction()" name="ta007" onfocus="check_title_no();" value="<?php echo $ta007; ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>

							<td class="normal14y" width="8%"> 產量：</td>
							<td class="normal14a" width="25%"><input type="text" tabIndex="8" id="ta017" onfocus="check_title_no();" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1');" onKeyPress="keyFunction()" name="ta017" value="<?php echo $ta017; ?>" required /></td>

							<td class="normal14z">群組：</td>
							<td class="normal14">
								<?php if ($super == 'Y') { ?>
									<select id="admi04" onKeyPress="keyFunction()" name="ta008" tabIndex="9" style="background-color:#EEF1CE">
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
									<select id="ta008" onKeyPress="keyFunction()" name="ta008" tabIndex="9" style="background-color:#EEF1CE">
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

							<input type="hidden" id="cmsi03" class="cmsi03" onKeyPress="keyFunction()" name="ta020" value="<?php echo trim($ta020); ?>" size="10" />
							<input type="hidden" id="ta016" onKeyPress="keyFunction()" name="ta016" value="<?php echo trim($ta016); ?>" />
						</tr>
						<tr>
							<td class="normal14y" width="8%"> 成本：</td>
							<td class="normal14a" width="25%"><input type="text" tabIndex="10" id="ta015" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');" onKeyPress="keyFunction()" name="ta015" value="<?php echo $ta015; ?>" /></td>

							<td class="normal14z">備註：</td>
							<td class="normal14"><input type="text" tabIndex="11" id="ta029" onKeyPress="keyFunction()" name="ta029" value="<?php echo trim($ta029); ?>" /></td>
							<!-- <td class="normal14y" width="8%"> 重量：</td>
							<td class="normal14a" width="25%"><input type="hidden" id="ta016" onKeyPress="keyFunction()" name="ta016" value="<?php echo trim($ta016); ?>" /></td> -->
							<td class="normal14a"></td>

						</tr>

					</table>


					<!--</div>  div-7 -->
					<div style="float:left;padding-top: 5px; ">
						<b style="color: #FF0000;"><span> 材料BOM展開方式 </span><a href="javascript:;"><img id="Showbomc02a" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a>
					</div>
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
					<!-- 合計     -->
					<!--    <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo $ta028; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta019' id="ta019" size="8" value="<?php echo $ta019; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo $ta028 + $ta019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta031' id="ta031" size="8" value="<?php echo $ta031; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta032' id="ta032" size="8" value="<?php echo $ta032; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo $ta031 + $ta032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='ta026' id="ta026" size="8" value="<?php echo $ta026; ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span>  -->
					<!-- 合計     -->

			</div>
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
<!-- <?php include_once("./application/views/funnew/moci01a_funmjs_v.php"); ?> -->
<!-- 製令單別51 -->
<?php include_once("./application/views/funnew/invi02v_funmjs_v.php"); ?>

<?php include_once './application/views/funnew/admi04_funmjs_v.php'; ?>

<!-- 品號 -->
<!-- <?php include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?> -->
<!-- 廠別 -->
<!-- <?php include_once("./application/views/funnew/puri01_funmjs_v.php"); ?> -->
<!-- 廠商回傳多欄 -->
<!-- <?php include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?> -->
<!-- 庫別 -->
<!-- <?php include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?> -->
<!-- 幣別 -->
<!-- <?php include_once("./application/views/funnew/cmsi04_funmjs_v.php"); ?> -->
<!-- 線別 -->

<?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>
<!-- 全域變數 -->
<?php include_once("./application/views/funnew/moci02a_fundjs_v.php"); ?>
<!-- 明細開視窗 -->
<script type="text/javascript">
	//存檔游標focus
	$(document).ready(function() {
		$('#moci01').focus();
	});
</script>