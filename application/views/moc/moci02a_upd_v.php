 <?php
	//echo "<pre>";var_dump($result);exit;
	/***先行處理一下資料***/
	//title通常只會有一筆
	$title_data = $result['title_data'][0];
	foreach ($title_data as $key => $val) {
		$$key = $val;
		if ($key == 'ta003' || $key == 'ta004' || $key == 'ta012' || $key == 'ta014') {
			$$key = stringtodate("Y/m/d", $val);   //自訂函數 main_head_v
		}
	}
	$body_data = $result['body_data'];
	$data_count = count($body_data);
	/*echo "<pre>";
//var_dump($col_array);
//var_dump($body_data);
var_dump($usecol_array);
echo "</pre>";*/
	//預設稅率,廠別
	$stax_rate = $this->session->userdata('sysma004');
	$sysma200 = $this->session->userdata('sysma200');
	$sysma201 = $this->session->userdata('sysma201');
	?>
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

 		<?php
			$user = trim($this->session->userdata('sysuser'));
			$super = trim($this->session->userdata('syssuper'));
			$rms = trim($this->session->userdata('sysuserrms'));
			$gro = trim($this->session->userdata('sysgroup'));
			?>

 		<div id="content">
 			<!-- div-3 -->
 			<div class="box">
 				<!-- div-4 --><span>　　　　　　</span>
 				<div class="heading">
 					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 配料單建立作業 - 修改　　　</h1>
 					<button style="cursor:pointer" form="commentForm" onfocus="$('#moci01').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
 					<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci02a/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
 				</div>
 			</div>
 			<div class="content">
 				<!-- div-5 -->
 				<form class="cmxform" id="commentForm" name="form" action="<?php echo base_url() ?>index.php/moc/moci02a/updsave" style="width: 100%;" method="post" enctype="multipart/form-data">
 					<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
 					<div id="tab-general">
 						<!-- div-6 -->

 						<?php $this->session->set_userdata('key1', $ta001);
							$this->session->set_userdata('key2', $ta002);
							$ta001disp = mb_convert_encoding(trim($ta001disp), 'utf-8', 'big-5');
							$ta006disp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($ta034), 'utf-8', 'big-5'), ENT_QUOTES));
							$ta034 = $ta006disp;
							$ta035 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($ta035), 'utf-8', 'big-5'), ENT_QUOTES));
							$ta007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($ta007), 'utf-8', 'big-5'), ENT_QUOTES));
							$ta029 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($ta029), 'utf-8', 'big-5'), ENT_QUOTES));
							$ta015 = round($ta015, 3);
							?>
 						<table class="form14">
 							<!-- 頭部表格 -->
 							<tr>
 								<td class="normal14y" width="8%"><span class="required">單別：</span> </td>
 								<td class="normal14a" width="25%"><input tabIndex="1" id="moci01" onKeyPress="keyFunction()" name="ta001" onchange="check_moci01(this);" value="<?php echo trim($ta001); ?>" size="12" type="text" required readonly="readonly" style="background-color:#F5F5F5;width: 50%;" />
 									<!-- <a href="javascript:;"><img id="Showmoci01disp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a> -->
 									<span id="moci01disp"> <?php echo trim($ta001disp); ?> </span>
 								</td>
 								<td class="normal14y" width="8%">開單日期： </td>
 								<td class="normal14a" width="25%"><input tabIndex="2" ondblclick="scwShow(this,event);" id="ta003" onKeyPress="keyFunction()" onchange="dateformat_ymd(this);" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" name="ta003" value="<?php echo trim($ta003); ?>" size="12" type="text" maxlength='10' style="background-color:#FFFFE4" />
 									<img onclick="scwShow(ta003,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
 								</td>
 								<td class="normal14y" width="9%"><span class="required">配料單號：</span></td>
 								<td class="normal14a" width="25%"><input tabIndex="3" id="ta002" onKeyPress="keyFunction()" name="ta002" value="<?php echo trim($ta002); ?>" size="30" type="text" readonly="value" onfocus=" style=" background-color:#F5F5F5;width: 50%;" /><span id="ta002disp"></span></td>
 							</tr>
 							<tr>
 								<td class="normal14z">產品品號：</td>
 								<td class="normal14">
 									<input tabIndex="4" id="invi02" onKeyPress="keyFunction()" maxlength='20' onkeyup="this.value=this.value.replace(/[^A-Z0-9\-]/gi,'');this.value=this.value.toLocaleUpperCase();" ondblclick="search_invi02_window()" onchange="check_invi02(this)" name="ta006" value="<?php echo trim($ta006); ?>" size="12" type="text" style="width: 40%;" required />
 									<a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url() ?>assets/image/png/seek.png" alt="" align="top" /></a>
 									<span id="invi02disp"> <?php echo trim($ta006disp); ?> </span>
 								</td>
 								<td class="normal14z">品名：</td>
 								<td class="normal14a"><input tabIndex="5" id="ta034" onKeyPress="keyFunction()" name="ta034" value="<?php echo trim($ta034); ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>
 								<td class="normal14z">規格：</td>
 								<td class="normal14a"><input tabIndex="6" id="ta035" onKeyPress="keyFunction()" name="ta035" value="<?php echo trim($ta035); ?>" size="30" type="text" style="background-color:#EBEBE4" /></td>
 							</tr>

 							<tr>
 								<td class="normal14z">單位：</td>
 								<td class="normal14a"><input tabIndex="7" id="ta007" onKeyPress="keyFunction()" name="ta007" value="<?php echo trim($ta007); ?>" size="10" type="text" style="background-color:#EBEBE4" /></td>

 								<td class="normal14y" width="8%"> 產量：</td>
 								<td class="normal14a" width="25%"><input type="text" tabIndex="8" id="ta017" onkeyup="value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1');" onKeyPress="keyFunction()" name="ta017" value="<?php echo trim($ta017); ?>" required /></td>

 								<td class="normal14z">群組：</td>
 								<td class="normal14">
 									<?php if ($super == 'Y') { ?>
 										<select id="admi04" onKeyPress="keyFunction()" name="ta008" tabIndex="9" style="background-color:#EEF1CE">
 											<?php
												foreach ($group as $key => $val) {
													if (trim($val->me001) == trim($ta008))
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
															if (trim($val->me001) == trim($ta008))
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

 								<!--   明細0  -->

 								<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
 								<?php $current_product_count = 0; ?>
 								<?php foreach ($body_data as $key => $val) {
										$current_product_count++;
										echo "<tbody id='product_row_" . $current_product_count . "' class='product_row' >";
										echo "<tr>";
										echo "<td class='center'><img src='" . base_url() . "assets/image/delete.png' title='刪除資料' onclick='del_detail(\"" . trim($ta001) . "\",\"" . trim($ta002) . "\",\"" . trim($val->tb008) . "\",\"" . $current_product_count . "\",\"" . trim($val->tb005) . "\");' /></td>";
										foreach ($usecol_array as $k => $v) {
											if ($k == "td013") {
												//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
												$s = stringtodate("Y/m/d", $val->$k);
											} else {
												// $s = $val->$k;
												$s = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->$k), 'utf-8', 'big-5'), ENT_QUOTES));
											}

											if (isset($v['type'])) {
												$type = $v['type'];
											} else {
												$type = "text";
											}

											echo "<td nowrap='value'";  //1060728  加nowrap 圖示在同一行
											if (isset($v['data_class'])) {
												echo "class='" . $v['data_class'] . "'";
											}
											echo ">";

											if ($type == "text") {
												echo "<input type='" . $type . "' id='order_product[" . $current_product_count . "][" . $k . "]' name='order_product[" . $current_product_count . "][" . $k . "]' class='order_product_" . $k . "' value='" . $s . "'  onKeyPress='keyFunction()' ";
												//	if(isset($v['value'])){echo value='".$val->$k."';} value='".$val->$k."'
												if (isset($v['size'])) {
													echo "size='" . $v['size'] . "' ";
												}
												if (isset($v['id'])) {
													echo "id='" . $v['id'] . "' ";
												}
												if (isset($v['onclick'])) {
													echo "onclick=\"" . $v['onclick'] . "\" ";
												}
												if (isset($v['onfocus'])) {
													echo "onfocus=\"" . $v['onfocus'] . "\" ";
												}
												if (isset($v['ondblclick'])) {
													echo "ondblclick=\"" . $v['ondblclick'] . "\" ";
												}
												if (isset($v['onchange'])) {
													echo "onchange=\"" . $v['onchange'] . "\" ";
												}
												if (isset($v['style'])) {
													echo "style='" . $v['style'] . "' ";
												}
												if (isset($v['readonly'])) {
													echo "readonly='" . $v['readonly'] . "' ";
												}
												if (isset($v['disable'])) {
													echo "disable='" . $v['disable'] . "' ";
												}    //see 加disabled

												if (isset($v['maxlength'])) {
													echo "maxlength='" . $v['maxlength'] . "' ";
												}
												if (isset($v['placeholder'])) {
													echo "placeholder='" . $v['placeholder'] . "' ";
												}
												if (isset($v['onkeyup'])) {
													echo "onkeyup=" . '"' . $v['onkeyup'] . '" ';
												}
												if (isset($v['required'])) {
													echo "required='" . $v['required'] . "' ";
												}


												echo " />";
											}

											if ($type == "select" && isset($v['option'])) {
												echo "<select id='order_product[" . $current_product_count . "][" . $k . "]' name='order_product[" . $current_product_count . "][" . $k . "]' class='order_product_" . $k . "' value='" . $val->$k . "' onKeyPress='keyFunction()' ";
												if (isset($v['size'])) {
													echo "size='" . $v['size'] . "' ";
												}
												if (isset($v['onclick'])) {
													echo "onclick=\"" . $v['onclick'] . "\" ";
												}
												if (isset($v['ondblclick'])) {
													echo "ondblclick=\"" . $v['ondblclick'] . "\" ";
												}
												if (isset($v['onchange'])) {
													echo "onchange=\"" . $v['onchange'] . "\" ";
												}
												if (isset($v['style'])) {
													echo "style='" . $v['style'] . "' ";
												}
												if (isset($v['readonly'])) {
													echo "readonly='" . $v['readonly'] . "' ";
												}
												if (isset($v['disable'])) {
													echo "disable='" . $v['disable'] . "' ";
												}
												echo " >";
												foreach ($v['option'] as $op_k => $op_v) {
													echo "<option ";
													if ($val->$k == $op_k) {
														echo "selected='selected' ";
													}
													echo "value='" . $op_k . "'>";
													echo $op_k . "." . $op_v;
													echo "</option>";
												}
												echo "</select>";
											}

											if ($type == "checkbox") {
												echo "<input type='" . $type . "' id='order_product[" . $current_product_count . "][" . $k . "]' name='order_product[" . $current_product_count . "][" . $k . "]' class='order_product_" . $k . "' value='" . $val->$k . "' onKeyPress='keyFunction()' ";
												echo " />";
											}

											if ($v['name'] == '品號圖示1') {
												echo "<a href=javascript:";
												echo "/>";

												echo "<img name='order" . $current_product_count . "' id='order" . $current_product_count . "' alt='客戶計價查詢' align='top' src=";
												echo base_url() . "assets/image/png/seek.png";
												echo " />";
											}

											if ($v['name'] == '折扣率%') {
												echo "<span  name='orderd" . $current_product_count . "' id='orderd" . $current_product_count . "'  align='top' >%</span>";
											}

											echo "</td>";
										}

										echo "</tr>";
										echo "</tbody>";
									} ?>
 								<!-- 頁尾群組  -->

 								<tfoot>
 									<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->
 									<tr>
 										<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
 										<td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
 									</tr>

 								</tfoot>
 							</table>
 						</div>
 					</div>

 					<!-- 合計     -->
 					<!--     <tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span>
				
				</span></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='ta028' id="ta028" size="8" value="<?php echo trim($ta028); ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta019' id="ta019" size="8" value="<?php echo trim($ta019); ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot"><?php echo trim($ta028) + $ta019; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅總額：</b></td>
				<td ><input type='text' readonly="value" name='ta031' id="ta031" size="8" value="<?php echo trim($ta031); ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ta032' id="ta032" size="8" value="<?php echo trim($ta032); ?>"  style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣合計金額：</b></td>
				<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tot1"><?php echo trim($ta031) + $ta032; ?></span></b></td>
				
				<td class="right" valign="top"><b style="color: #003A88;">　　合計數量：</b></td>
				<td ><input type='text' readonly="value" name='ta026' id="ta026" size="8" value="<?php echo trim($ta026); ?>"  style="background-color:#EBEBE4" /></td>
				<td class="left" valign="top"></td>
              </tr>
			  <br><span>&nbsp;</span> 		<!-- 合計     -->


 			</div> <!-- div-8 -->

 			<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />

 		</div> <!-- div-加 -->
 		</form>
 		<?php if ($message != ' ') { ?>
 			<?php
				if ($message == '查詢一筆修改資料!' || $message == '修改資料成功!') {
					$message = '<b><font color="blue">' . $message . '</font></b><br>';
				} else {
					$message = '<font color="red">' . $message . '</font><br>';
				}
				?>
 			<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
										'◎操作說明:[ 欄位淡黃色按2下開視窗查詢,淡青色為下拉選項,按Enter鍵或Tab鍵跳下一個欄位, Alt + ↓ 新增一筆明細. ] ] ' ?> </div> <?php } ?>
 	</div> <!-- div-6 -->
 </div> <!-- div-5 -->
 </div> <!-- div-4 -->


 </div> <!-- div-3 -->
 </div> <!-- div-2 -->
 </div> <!-- div-1 -->
 <form action="<?php echo base_url() ?>index.php/moc/moci02a/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
 	<input id="del_md001" name="del_md001" />
 	<input id="del_md002" name="del_md002" />
 	<input id="del_md003" name="del_md003" />
 </form>
 <!-- <?php include_once("./application/views/funnew/moci01a_funmjs_v.php"); ?> -->
 <!-- 製令單別51 -->
 <?php include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>

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