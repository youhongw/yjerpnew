   <?php
	//echo "<pre>";var_dump($result);exit;
	/***先行處理一下資料***/
	//title通常只會有一筆
	$title_data = $result['title_data'][0];
	foreach ($title_data as $key => $val) {
		$$key = $val;
		if ($key == 'mc003' || $key == 'mc010') {
			//$$key = stringtodate("Y/m/d",$val);   //自訂函數 main_head_v
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
   					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 隱藏版-材料BOM建立作業 - 修改　　　</h1>
   					<div style="float:left;padding-top: 5px; ">
   						<button style="cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
   						<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('bom/bomi02b/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>

   					</div>
   				</div>
   				<div class="content">
   					<!-- div-5 -->
   					<form class="cmxform" id="commentForm" name="form" style="width: 90%;" action="<?php echo base_url() ?>index.php/bom/bomi02b/updsave" method="post" enctype="multipart/form-data">
   						<div id="tab-general">
   							<!-- div-6 -->
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
   									<td class="normal14y" width="10%"><span class="required">主件品號：</span> </td>
   									<td class="normal14a" width="22%">
   										<input tabIndex="1" id="invi02" onKeyPress="keyFunction()" maxlength='20' onkeyup="this.value=this.value.replace(/[^A-Z0-9\-]/gi,'');this.value=this.value.toLocaleUpperCase();" onblur="check_key(this);" ondblclick="search_invi02_window();" name="mc001" value="<?php echo $mc001; ?>" size="12" type="hidden" style="width: 130px;background-color:#FFFFE4" required />
   										<?php echo $mc001; ?>
   										<!-- <a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a>
   										<span id="invi02disp"></span> -->
   									</td>
   									<td class="normal14y" width="10%">品名： </td>
   									<td class="normal14a" width="24%"><input type="text" tabIndex="2" readonly="value" onKeyPress="keyFunction()" id="mc001disp" name="mc001disp" size="30" value="<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($mc001disp), 'utf-8', 'big-5'), ENT_QUOTES)); ?>" style="background-color:#F5F5F5;width: 50%;" /></td>

   								</tr>
   								<tr>
   									<td class="normal14y" width="10%">規格： </td>
   									<td class="normal14a" width="24%"><input type="text" tabIndex="3" readonly="value" onKeyPress="keyFunction()" id="mc001disp1" name="mc001disp1" value="<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($mc001disp1), 'utf-8', 'big-5'), ENT_QUOTES)); ?>" style="background-color:#F5F5F5;width: 50%;" /></td>
   									<td class="normal14z">單位：</td>
   									<td class="normal14"><input tabIndex="4" maxlength='4' id="mc002" onKeyPress="keyFunction()" name="mc002" value="<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($mc002), 'utf-8', 'big-5'), ENT_QUOTES)); ?>" type="text" required /></td>

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
														if (trim($val->me001) == trim($mc009))
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
																if (trim($val->me001) == trim($mc009))
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

   									<!--   明細0  -->
   									<!--  依照資料庫紀錄的明細先列一遍 原0會由1加  -->
   									<?php $current_product_count = 0; ?>
   									<?php foreach ($body_data as $key => $val) {
											$current_product_count++;
											echo "<tbody id='product_row_" . $current_product_count . "' class='product_row' >";
											echo "<tr>";
											echo "<td class='center'><img src='" . base_url() . "assets/image/delete.png' title='刪除資料' onclick='del_detail(\"" . trim($mc001) . "\",\"" . trim($val->md002) . "\",\"" . trim($val->md003) . "\",\"" . trim($current_product_count) . "\");' /></td>";
											foreach ($usecol_array as $k => $v) {
												if ($k == "md014") {
													// $s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
													$s = stringtodate("Y/m/d", $val->$k);
												} else {
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
												if ($v['name'] == '品號圖示2') {
													echo "<a href=javascript:";
													echo "/>";

													echo "<img name='order" . $current_product_count . "' id='order" . $current_product_count . "' alt='客戶計價查詢' align='top' src=";
													echo base_url() . "assets/image/png/seek.png";
													echo " />";
												}
												if ($v['name'] == '品號圖示2') {
													echo "<a href=javascript:";
													echo "/>";

													echo "<img name='ordera" . $current_product_count . "' id='ordera" . $current_product_count . "' alt='客戶計價查詢' align='top' src=";
													echo base_url() . "assets/image/png/seek1.png";
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

   							<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />

   					</form>

   				</div> <!-- div-6 -->

   			</div> <!-- div-5 -->
   			<br>
   			<?php if ($message != ' ') { ?>
   				<?php
					if ($message == '查詢一筆修改資料!' || $message == '修改資料成功!') {
						$message = '<b><font color="blue">' . $message . '</font></b><br>';
					} else {
						$message = '<font color="red">' . $message . '</font><br>';
					}
					?>
   				<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
											'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div> <?php } ?>
   		</div> <!-- div-4 -->


   	</div> <!-- div-3 -->
   </div> <!-- div-2 -->
   </div> <!-- div-1 -->
   <form action="<?php echo base_url() ?>index.php/bom/bomi02b/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
   	<input id="del_md001" name="del_md001" />
   	<input id="del_md002" name="del_md002" />
   	<input id="del_md003" name="del_md003" />
   </form>
   <?php include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>
   <!-- 主件品號 -->
   <!-- <?php include_once("./application/views/funnew/moci01a_funmjs_v.php"); ?> -->
   <!-- 製令單別51 -->

   <?php include_once './application/views/funnew/admi04_funmjs_v.php'; ?>

   <?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>
   <!-- 全域變數 -->
   <?php include_once("./application/views/funnew/bomi02b_fundjs_v.php"); ?>
   <!-- 明細開視窗 -->