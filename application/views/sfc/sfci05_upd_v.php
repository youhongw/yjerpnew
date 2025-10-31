 <?php
	//echo "<pre>";var_dump($result);exit;
	/***先行處理一下資料***/
	//title通常只會有一筆
	$title_data = $result['title_data'][0];
	foreach ($title_data as $key => $val) {
		$$key = $val;
		if ($key == 'TB003' || $key == 'TB015') {
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
	?>
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
 					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 移轉單建立作業 - 修改　　　</h1>
 					<div style="float:left;padding-top: 5px;">
 						<button type='submit' style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
 						<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('sfc/sfci05a/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>

 					</div>
 				</div>

 				<div class="content">
 					<!-- div-5 -->
 					<form class="cmxform" id="commentForm" name="form" style="width: 100%;" action="<?php echo base_url() ?>index.php/sfc/sfci05/updsave" method="post" enctype="multipart/form-data">
 						<div id="tab-general">
 							<!-- div-6 -->

 							<table class="form14">
 								<!-- 頭部表格 -->
 								<tr>
 									<td class="start14a" width="9%"><span class="required">移轉單別：</span></td>
 									<!--onchange="startsfci01(this);check_title_no();"    -->
 									<td class="normal14a" width="25%">
 										<input tabIndex="1" id="sfci01m" onKeyPress="keyFunction()" name="TB001" onchange="check_sfci01m(this);check_title_no();" value="<?php echo trim($TB001); ?>" size="12" type="hidden" required />
 										<?php echo trim($TB001); ?>
 										<!-- <a href="javascript:;"><img id="Showsfci01disp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a> -->
 										<span id="sfci01mdisp"> <?php echo mb_convert_encoding(trim($TB001disp), 'utf-8', 'big-5'); ?> </span>
 									</td>
 									<td class="normal14a" width="8%">單據日期： </td> <!-- dateformat_ymd(this); -->
 									<td class="normal14a" width="25%">
 										<input tabIndex="2" readonly="value" id="TB015" onKeyPress="keyFunction()" onchange="dateformat_ymd(this);check_title_no();" name="TB015" value="<?php echo trim($TB015); ?>" size="12" type="text" style="background-color:#F0F0F0" />
 										<!-- <img onclick="scwShow(TB015,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" /> -->
 									</td>
 									<td class="start14a" width="8%"><span class="required">移轉單號：</span></td>
 									<td class="normal14a" width="25%"><input tabIndex="3" id="TB002" readonly="value" onKeyPress="keyFunction()" readonly="value" name="TB002" value="<?php echo trim($TB002); ?>" size="12" type="text" style="background-color:#F0F0F0" required /></td>
 								</tr>

 								<tr>
 									<td class="normal14a">廠別代號：</td>
 									<td class="normal14"><input type="text" tabIndex="4" onKeyPress="keyFunction()" id="cmsi02" onblur="check_cmsi02(this)" name="TB010" value="<?php echo  trim($TB010); ?>" size="12" required />
 										<a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url() ?>assets/image/png/store.png" alt="" align="top" /></a>
 										<span id="cmsi02disp"> <?php echo mb_convert_encoding(trim($TB010disp), 'utf-8', 'big-5'); ?> </span>
 									</td>
 									<td class="normal14">更新碼：</td>
 									<td class="normal14"> <input type="hidden" name="TB012" class="TB012" value="N" />
 										<input tabIndex="5" id="TB012" onKeyPress="keyFunction()" name="TB012" <?php if ($TB012 == 'Y') echo 'checked';  ?> <?php if ($TB012 != 'Y') echo 'check'; ?> value="Y" size="1" type='checkbox' />
 									</td>
 									<td class="normal14">備註：</td>
 									<td class="normal14"><input type="text" tabIndex="6" onKeyPress="keyFunction()" id="TB014" name="TB014" value="<?php echo mb_convert_encoding($TB014, 'utf-8', 'big-5'); ?>" size="30" /></td>
 								</tr>
 								<tr>
 									<td class="normal14">移出類別：</td>
 									<td class="normal14"><select id="TB004" onKeyPress="keyFunction()" name="TB004" style="background-color:#EEF1CE" tabIndex="7">
 											<option <?php if ($TB004 == '1') echo 'selected="selected"'; ?> value='1'>1生產線別</option>
 											<!-- <option <?php if ($TB004 == '2') echo 'selected="selected"'; ?> value='2'>2加工廠商</option> -->
 											<option <?php if ($TB004 == '3') echo 'selected="selected"'; ?> value='3'>3庫別</option>
 										</select></td>
 									<td class="normal14"><span class="required">移出部門：</span></td>
 									<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="cmsi05" name="TB005" onblur="check_cmsi05(this);" value="<?php echo trim($TB005); ?>" size="12" />
 										<a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
 										<span id="cmsi05disp"> <?php echo mb_convert_encoding(trim($TB006), 'utf-8', 'big-5'); ?> </span>
 									</td>
 									<td class="normal14">移出部門名稱：</td>
 									<td class="normal14"><input type="text" tabIndex="9" readonly="value" onKeyPress="keyFunction()" id="TB006" name="TB006" value="<?php echo mb_convert_encoding(trim($TB006), 'utf-8', 'big-5'); ?>" size="12" style="background-color:#F0F0F0" /></td>
 								</tr>
 								<tr>
 									<td class="normal14">移入類別：</td>
 									<td class="normal14"><select id="TB007" onKeyPress="keyFunction()" name="TB007" style="background-color:#EEF1CE" tabIndex="10">
 											<option <?php if ($TB007 == '1') echo 'selected="selected"'; ?> value='1'>1生產線別</option>
 											<!-- <option <?php if ($TB007 == '2') echo 'selected="selected"'; ?> value='2'>2加工廠商</option> -->
 											<option <?php if ($TB007 == '3') echo 'selected="selected"'; ?> value='3'>3庫別</option>
 										</select></td>
 									<td class="normal14"><span class="required">移入部門：</span></td>
 									<td class="normal14">
 										<input type="text" tabIndex="11" onKeyPress="keyFunction()" id="cmsi05a" name="TB008" onblur="check_cmsi05a(this);" value="<?php echo trim($TB008); ?>" size="12" />
 										<a href="javascript:;"><img id="Showcmsi05adisp" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
 										<span id="cmsi05adisp"> <?php echo mb_convert_encoding(trim($TB009), 'utf-8', 'big-5'); ?> </span>
 									</td>


 									<td class="normal14">移入部門名稱：</td>
 									<td class="normal14"><input type="text" tabIndex="12" readonly="value" onKeyPress="keyFunction()" id="TB009" name="TB009" value="<?php echo mb_convert_encoding(trim($TB009), 'utf-8', 'big-5'); ?>" size="12" style="background-color:#F0F0F0" /></td>
 								</tr>
 								<tr>
 									<td class="normal14">簽核狀態：</td>
 									<td class="normal14"><select id="TB017" tabIndex="13" disabled='ture' onKeyPress="keyFunction()" name="TB017" style="background-color:#F0F0F0">
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
 									<td class="normal14"><input type="text" tabIndex="14" readonly="value" onKeyPress="keyFunction()" id="TB016" name="TB016" value="<?php echo trim($TB016); ?>" style="background-color:#F0F0F0" size="12" /></td>
 									<td class="normal14">移轉日期：</td>
 									<td class="normal14"><input tabIndex="15" readonly="value" id="TB003" onKeyPress="keyFunction()" onchange="dateformat_ymd(this);" name="TB003" value="<?php echo trim($TB003); ?>" size="12" type="text" style="background-color:#F0F0F0" />
 									</td>
 								</tr>
 								<tr>

 								<tr>
 									<td class="normal14">列印次數：</td>
 									<td class="normal14"><input type="text" tabIndex="16" readonly="value" onKeyPress="keyFunction()" id="TB011" name="TB011" value="<?php echo $TB011; ?>" size="12" style="background-color:#F0F0F0" /></td>
 									<td class="normal14">確認碼：</td>
 									<td class="normal14"><select id="verify" onKeyPress="keyFunction()" name="TB013" onChange="selverify(this)" tabIndex="9" style="background-color:#EEF1CE">
 											<option <?php if ($TB013 == 'Y') echo 'selected="selected"'; ?> value='Y'>Y確認</option>
 											<option <?php if ($TB013 == 'N') echo 'selected="selected"'; ?> value='N'>N取消確認</option>
 											<option <?php if ($TB013 == 'V') echo 'selected="selected"'; ?> value='V'>V作廢</option>
 										</select><span id="approved"></span></td>
 									<td class="normal14"></td>
 									<td class="normal14"></td>
 							</table>

 							<div style="width:100%; overflow-x: auto;  ">
 								<table style="width:100%;" id="order_product" class="list1">
 									<thead>
 										<!--  明細表頭群組 -->
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
 									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
 									<?php $current_product_count = 0; ?>
 									<?php foreach ($body_data as $key => $val) {
											$current_product_count++;
											echo "<tbody id='product_row_" . $current_product_count . "' class='product_row' >";
											echo "<tr onclick='tagscheck(this);'>";
											echo "<td class='center'><img src='" . base_url() . "assets/image/delete.png' title='刪除資料' onclick='del_detail(\"" . $val->TC001 . "\",\"" . $val->TC002 . "\",\"" . $val->TC003 . "\",\"" . $current_product_count . "\");' /></td>";
											foreach ($usecol_array as $k => $v) {
												if ($k == "TC038") {
													//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
													$s = stringtodate("Y/m/d", $val->$k); //自訂函數 main_head_v
												} else {
													$s = mb_convert_encoding(trim($val->$k), 'utf-8', 'big-5');
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
													if (isset($v['class'])) {
														echo "class='" . $v['class'] . "' ";
													}
													if (isset($v['onblur'])) {
														echo "onblur='" . $v['onblur'] . "' ";
													}
													if (isset($v['onclick'])) {
														echo "onclick='" . $v['onclick'] . "' ";
													}
													if (isset($v['onfocus'])) {
														echo "onfocus='" . $v['onfocus'] . "' ";
													}
													if (isset($v['onfocusout'])) {
														echo "onfocusout='" . $v['onfocusout'] . "' ";
													}
													if (isset($v['disable'])) {
														echo "disable='" . $v['disable'] . "' ";
													}    //see 加disabled
													if (isset($v['onchange'])) {
														echo "onchange='" . $v['onchange'] . "' ";
													}
													if (isset($v['readonly'])) {
														echo "readonly='" . $v['readonly'] . "' ";
													}
													if ($TB001 == 'D310') {
														if (isset($v['required'])) {
															echo "required='" . $v['required'] . "' ";
														}
													}

													if (isset($v['maxlength'])) {
														echo "maxlength='" . $v['maxlength'] . "' ";
													}
													if (isset($v['placeholder'])) {
														echo "placeholder='" . $v['placeholder'] . "' ";
													}
													if (isset($v['onkeyup'])) {
														echo "onkeyup=" . '"' . $v['onkeyup'] . '" ';
													}

													if (substr($TB001, 0, 2) == 'D1') {
														if (isset($v['ondblclick'])) {
															if ($k != "TC006") {
																echo "ondblclick='" . $v['ondblclick'] . "' ";
															}
														}
														if (isset($v['style'])) {
															if ($k == "TC006" or $k == "TC016" or $k == "TC045" or $k == "TC032" or $k == "TC033" or $k == "TC034") {
																echo 'style="background-color:#F0F0F0" ';
															} else {
																echo "style='" . $v['style'] . "' ";
															}
														} else if ($k == "TC016") {
															echo 'style="background-color:#F0F0F0" ';
														}

														if ($k == "TC013") {
															echo " disabled='disabled' ";
														}

														if ($k == "TC006" or $k == "TC016" or $k == "TC045" or $k == "TC032" or $k == "TC033" or $k == "TC034") {
															echo " readonly='true' ";
														}

														if ($k == "TC008") {
															echo " required ";
														}
													} else if (substr($TB001, 0, 2) == 'D2') {
														if (isset($v['ondblclick'])) {
															if ($k != "TC033" or $k != "TC034") {
																echo "ondblclick='" . $v['ondblclick'] . "' ";
															}
														}
														if (isset($v['style'])) {
															if ($k == "TC032" or $k == "TC033" or $k == "TC034") {
																echo 'style="background-color:#F0F0F0" ';
															} else {
																echo "style='" . $v['style'] . "' ";
															}
														} else if ($k == "TC032" or $k == "TC033" or $k == "TC034") {
															echo 'style="background-color:#F0F0F0" ';
														}

														if ($k == "TC032" or $k == "TC033" or $k == "TC034") {
															echo " readonly='true' ";
														}


														if ($k == "TC006" or $k == "TC008") {
															echo " required ";
														}
													} else if (substr($TB001, 0, 2) == 'D3') {
														if (isset($v['ondblclick'])) {
															if ($k != "TC008") {
																echo "ondblclick='" . $v['ondblclick'] . "' ";
															}
														}
														if (isset($v['style'])) {
															if ($k == "TC008") {
																echo 'style="background-color:#F0F0F0" ';
															} else {
																if ($TB001 != 'D310') {
																	echo 'style="background-color:#F0F0F0" ';
																} else {
																	echo "style='" . $v['style'] . "' ";
																}
															}
														} else if ($k == "TC008") {
															echo 'style="background-color:#F0F0F0" ';
														}


														if ($k == "TC008") {
															echo " readonly='true' ";
														}
														if ($k == "TC006") {
															echo " required ";
														}
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

													if (isset($v['readonly'])) {
														echo "readonly='" . $v['readonly'] . "' ";
													}
													if (isset($v['disable'])) {
														echo "disable='" . $v['disable'] . "' ";
													}

													if (substr($TB001, 0, 2) == 'D1') {
														if ($k == "TC013") {
															echo " disabled='disabled' ";
														}

														if (isset($v['style'])) {
															if ($k == "TC013") {
																echo 'style="background-color:#F0F0F0" ';
															} else {
																echo "style='" . $v['style'] . "' ";
															}
														}
													} else if (substr($TB001, 0, 2) == 'D2') {
														if (isset($v['style'])) {
															echo "style='" . $v['style'] . "' ";
														}
													} else if (substr($TB001, 0, 2) == 'D3') {
														if (isset($v['style'])) {
															echo "style='" . $v['style'] . "' ";
														}
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

													echo "<img name='order" . $current_product_count . "' id='order" . $current_product_count . "' alt='' align='top' src=";
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

 										<tr>
 											<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
 											<td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
 										</tr>

 									</tfoot>
 								</table>
 							</div>
 						</div>

 						<!-- 合計     -->

 						<!-- 合計     -->
 				</div> <!-- div-8 -->
 				<input type='hidden' name='FLAG' id='FLAG' value="<?php echo $FLAG; ?>" />

 			</div> <!-- div-加 -->
 			</form> <!-- end 表單 -->
 			<?php if ($message != ' ') { ?>
 				<?php
					if ($message == '查詢一筆修改資料!' || $message == '修改資料成功!') {
						$message = '<b><font color="blue">' . $message . '</font></b><br>';
					} else {
						$message = '<font color="red">' . $message . '</font><br>';
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
 <form action="<?php echo base_url() ?>index.php/sfc/sfci05/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
 	<input id="del_md001" name="del_md001" />
 	<input id="del_md002" name="del_md002" />
 	<input id="del_md003" name="del_md003" />
 </form>

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
 		$('#cmsi05').focus();
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