 <?php
	//echo "<pre>";var_dump($result);exit;
	/***先行處理一下資料***/
	//title通常只會有一筆
	$title_data = $result['title_data'][0];
	foreach ($title_data as $key => $val) {
		$$key = $val;
		if ($key == 'TD003' || $key == 'TD008') {
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
 					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 報工單日結 - 查詢　　　</h1>

 					<div style="float:left;padding-top: 5px;">
 					<!--	<button type='submit' style="border: 0px solid;box-shadow: 2px 0.5px 1px 1px #88A70E;" form="commentForm" accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>-->&nbsp;&nbsp;&nbsp;&nbsp;
 						<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('sfc/sfci03n/display'); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>

 					</div>
 				</div>

 				<div class="content">
 					<!-- div-5 -->
 					<form class="cmxform" id="commentForm" name="form" action="<?php echo base_url() ?>index.php/sfc/sfci03n/updsave" method="post" style="width: 100%;" enctype="multipart/form-data">
 						<div id="tab-general">
 							<!-- div-6 -->

 							<table class="form14">
 								<!-- 頭部表格 -->
 								<tr>
									<!-- 第1列 -->
									 <td class="normal14a">生產日期：</td>
 									<td class="normal14"><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="TD003" name="TD003" value="<?php echo $TD003; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>

 									<td class="normal14">人機代號：</td>
 									<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="TD016" name="TD016" value="<?php echo $TD016; ?>" readonly="readonly" style="background-color:#F0F0F0" />
									<SPAN><?php IF ($UDF03=='1') {echo mb_convert_encoding(trim($MV002), 'utf-8', 'big-5');}?><?php IF ($UDF03=='2') {echo mb_convert_encoding(trim($MX003), 'utf-8', 'big-5');}?></SPAN></td>

									<td class="normal14">確認碼：</td>
 									<td class="normal14">
 										<select id="verify" onKeyPress="keyFunction()" name="TD005" onChange="selverify(this)" tabIndex="6" style="background-color:#EEF1CE">
 											<option <?php if ($TD005 == 'Y') echo 'selected="selected"'; ?> value='Y'>Y確認</option>
 											<option <?php if ($TD005 == 'N') echo 'selected="selected"'; ?> value='N'>N取消確認</option>
 											<option <?php if ($TD005 == 'V') echo 'selected="selected"'; ?> value='V'>V作廢</option>
 										</select><span id="approved"></span>
 									</td>
 								</tr>

 								<tr>
									<!-- 第2列 -->
									 									<td class="normal14a"><span class="required">生產線別：</span></td>
 									<td class="normal14">
 										<input type="text" tabIndex="4" onKeyPress="keyFunction()" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" id="cmsi04" onblur="check_cmsi04(this);check_title_no();clear_row(this);" name="TD004" value="<?php echo  trim($TD004); ?>" size="12" required />
 										<a href="javascript:;"><img id="Showcmsi04disp" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
 										<span id="cmsi04disp"> <?php echo mb_convert_encoding(trim($TD004disp), 'utf-8', 'big-5'); ?> </span>
 									</td>

									<td class="normal14a">起時分：</td>
 									<td class="normal14"><input type="text" tabIndex="7" onKeyPress="keyFunction()" id="UDF01" name="UDF01" value="<?php echo $UDF01; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>

 									<td class="normal14">確認者：</td>
 									<td class="normal14"><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="TD009" name="TD009" value="<?php echo $TD009; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>
 								</tr>

 								<tr>
									<!-- 第3列 -->
									<td class="normal14" style="color:blue;">人機類別：</td>
									<?php if($UDF03=='1') {$KK=':人時';} else {$KK=':機時';}  ?>
 									<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="UDF03" name="UDF03" value="<?php echo $UDF03.$KK; ?>" readonly="readonly" style="background-color:#F0F0F0" />
									</td>

									<td class="normal14">迄時分：</td>
 									<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="UDF02" name="UDF02" value="<?php echo $UDF02; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>
 									<?php $hour = floor((ROUND($UDF06,0) / 3600));
													$min  = ROUND((ROUND($UDF06,0) % 3600) / 60,0);
													$timeStr = sprintf("%02d%02d", $hour, $min);
													$UDF06 = trim($timeStr);
											        $hour1 = floor((ROUND($UDF09,0) / 3600));
													$min1  = ROUND((ROUND($UDF09,0) % 3600) / 60,0);
													$timeStr1 = sprintf("%02d%02d", $hour1, $min1);
													$UDF09 = trim($timeStr1);
													//$UDF06 = str_pad($UDF06, 4, "0", STR_PAD_LEFT);
									?>

									<td class="normal14">簽核狀態：</td>
 									<td class="normal14">
 										<select id="TD010" tabIndex="9" readonly="value" onKeyPress="keyFunction()" name="TD010" style="background-color:#EEF1CE">
 											<option <?php if ($TD010 == 'N') echo 'selected="selected"'; ?> value='N'>N.不執行電子簽核</option>
 											<option <?php if ($TD010 == '0') echo 'selected="selected"'; ?> value='0'>0.待處理</option>
 											<option <?php if ($TD010 == '1') echo 'selected="selected"'; ?> value='1'>1.簽核中</option>
 											<option <?php if ($TD010 == '2') echo 'selected="selected"'; ?> value='2'>2.退件</option>
 											<option <?php if ($TD010 == '3') echo 'selected="selected"'; ?> value='3'>3.已核准</option>
 											<option <?php if ($TD010 == '4') echo 'selected="selected"'; ?> value='4'>4.取消確認中</option>
 											<option <?php if ($TD010 == '5') echo 'selected="selected"'; ?> value='5'>5.作廢中</option>
 											<option <?php if ($TD010 == '6') echo 'selected="selected"'; ?> value='6'>6.取消作廢中</option>
 										</select>
 									</td>
									
 								</tr>
                                <tr>
									<!-- 第4列 -->
									<td class="normal14a" width="8%">單據日期： </td> <!-- dateformat_ymd(this); -->
 									<td class="normal14a" width="25%">
 										<input tabIndex="2" id="TD008" onKeyPress="keyFunction()" onblur="dateformat_ymd(this);check_title_no();" readonly="value" onkeyup="this.value=this.value.replace(/[^0-9\/]/gi,'');" name="TD008" value="<?php echo $TD008; ?>" size="12" type="text" maxlength='10' style="background-color:#F0F0F0" />
 										<!-- <img onclick="scwShow(TD008,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" /> -->
 									</td>

 									<td class="normal14" style="color:blue;">有效時分：</td>
 									<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="UDF06" name="UDF06" value="<?php echo $UDF06; ?>" readonly="readonly" style="background-color:#F0F0F0" />
									</td>					
									
									<td class="start14a" width="9%"><span class="required">報工單別：</span></td>
 									<!--onchange="startsfci01(this);check_title_no();"    -->
 									<td class="normal14a" width="25%">
 										<input tabIndex="1" id="sfci01" onKeyPress="keyFunction()" name="TD001" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();" onblur="check_sfci01(this);check_title_no();" value="<?php echo trim($TD001); ?>" size="12" type="hidden" required />
 										<?php echo trim($TD001); ?>
 										<!-- <a href="javascript:;">
 											<img id="Showsfci01disp" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" />
 										</a> -->
 										<span id="sfci01disp">
 											<?php echo mb_convert_encoding(trim($TD001disp), 'utf-8', 'big-5'); ?>
 										</span>
 									</td>
 								</tr>
 								<tr>
									<!-- 第5列 -->
									 <td class="normal14">備註：</td>
 									<td class="normal14"><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="TD006" name="TD006" value="<?php echo stripslashes(htmlspecialchars(mb_convert_encoding(trim($TD006), 'utf-8', 'big-5'), ENT_QUOTES)); ?>" size="30" /></td>

 									<td class="normal14">報工時分：</td>
 									<td class="normal14"><input type="text" tabIndex="8" onKeyPress="keyFunction()" id="UDF09" name="UDF09" value="<?php echo $UDF09; ?>" readonly="readonly" style="background-color:#F0F0F0" /></td>
 									</td>						
									
									<td class="start14a" width="8%"><span class="required">報工單號：</span></td>
 									<td class="normal14a" width="25%">
 									<input tabIndex="3" id="TD002" onKeyPress="keyFunction()" readonly="value" name="TD002" value="<?php echo trim($TD002); ?>" size="12" type="text" style="background-color:#F0F0F0" required />
 									</td>
 								</tr>
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
											echo "<td class='center'><img src='" . base_url() . "assets/image/delete.png' title='刪除資料' onclick='del_detail(\"" . $val->TE001 . "\",\"" . $val->TE002 . "\",\"" . $val->TE003 . "\",\"" . $current_product_count . "\");' /></td>";
											foreach ($usecol_array as $k => $v) {
												//   $seconds = 4200;   // 1 小時 10 分鐘
            //      $hour = floor($seconds / 3600);    // 轉回時、分
            //   $min  = floor(($seconds % 3600) / 60);
             //$timeStr = sprintf("%02d%02d", $hour, $min);   // 格式化成 4 碼字串，例如 0110
         //   <input type="text" name="TE012" value="<PHP?= htmlspecialchars($timeStr)
         //		 " maxlength="4">
												// 先處理時間轉換欄位
												// 排除 TE012 和 TE013 的 maxlength 限制
if (isset($v['maxlength']) && ($k == 'TE012' OR $k == 'TE013')) {
   // echo "maxlength='" . $v['maxlength'] . "' ";
	//echo "DEBUG RAW TE012 物件值: ";
//var_dump($val->TE012);
//echo " 型態: " . gettype($val->TE012) . "<br>";
}
if ($k == 'TE012') {
	//$original_value = $val->TE012;
   // echo "原始字串長度: " . strlen($original_value) . "<br>";
    $seconds = round($val->$k, 0);
	//echo "DEBUG TE012: 原始={$val->$k}, round後={$seconds}<br>"; // 加入 debug
    $hour = floor($seconds / 3600);
    $min  = ROUND(($seconds % 3600) / 60,0);
    $s = sprintf("%02d%02d", $hour, $min);
} else if ($k == 'TE013') {
    $seconds = round($val->$k, 0);
    $hour = floor($seconds / 3600);
    $min  = ROUND(($seconds % 3600) / 60,0);
    $s = sprintf("%02d%02d", $hour, $min);
} else if ($k == 'TE0311') {
    $s = $val->TE028 + $val->TE031;
} else if ($k == 'TE049') {
    if (isset($val->TE049)) {
        $s = trim($val->TE049);
    } else {
        $s = '1';
        $val->TE049 = '1';
    }
} else if ($k == 'TE0111') {
    $s = $val->TE034 - $val->TE033;
} else if ($k == 'TE0312') {
    if (trim($TD001) == 'D404' || trim($TD001) == 'D504') {
        $s = ($val->TE034 - $val->TE033) * $val->TE032 - $val->TE035 - $val->TE037 - $val->TE038;
    } else {
        $s = $val->TE011 - ($val->TE028 + $val->TE031);
    }
} else if ($k == 'TE0333') {
    $s = $val->TE040 + $val->TE035;
} else if ($k == 'cmsi09ddisp') {
    $s = trim($val->$k);
} else {
    $s = mb_convert_encoding($val->$k, 'utf-8', 'big-5');
}
												//	if($k=="TE024" ){
												//$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
												//$s = stringtodate("Y/m/d",$val->$k);
												//	}else{
												//	if($k!="cmsi09ddisp"&&$k!="TE005disp"&&$k!="TE009disp"){//主鍵不用更改以及其他外來鍵庫別名稱
												// $s = mb_convert_encoding(trim($val->$k), 'utf-8', 'big-5');
												//	}
												//	}


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

													if (isset($v['onclick'])) {
														echo "onclick='" . $v['onclick'] . "' ";
													}
													if (isset($v['onfocus'])) {
														echo "onfocus='" . $v['onfocus'] . "' ";
													}
													if (isset($v['onfocusout'])) {
														echo "onfocusout='" . $v['onfocusout'] . "' ";
													}

													if (isset($v['onchange'])) {
														echo "onchange='" . $v['onchange'] . "' ";
													}


													if (isset($v['disable'])) {
														echo "disable='" . $v['disable'] . "' ";
													}    //see 加disabled

												//	if (isset($v['maxlength'])) {
												//		echo "maxlength='" . $v['maxlength'] . "' ";
												//	}
													if (isset($v['placeholder'])) {
														echo "placeholder='" . $v['placeholder'] . "' ";
													}
													if (isset($v['onkeyup'])) {
														echo "onkeyup=" . '"' . $v['onkeyup'] . '" ';
													}

													if (substr($TD001, 0, 2) == 'D4') {
														if (isset($v['readonly'])) {
															echo "readonly='" . $v['readonly'] . "' ";
														}

														if (isset($v['style'])) {
															echo "style='" . $v['style'] . "' ";
														}
                                                     //1141107 add
														//if (isset($v['required'])) {
														//	echo "required='" . $v['required'] . "' ";
														//}

														if (!($k == 'TE009' || $k == 'TE017')) {
															if (isset($v['onblur'])) {
																echo "onblur='" . $v['onblur'] . "' ";
															}
															if (isset($v['ondblclick'])) {
																echo "ondblclick='" . $v['ondblclick'] . "' ";
															}
														}
													} else if (substr($TD001, 0, 2) == 'D5') {
														if (isset($v['readonly'])) {
															if (!($k == 'TE009' || $k == 'TE017')) {
																echo "readonly='" . $v['readonly'] . "' ";
															}
														} else if ($k == 'TE006' || $k == 'TE007') {
															echo " readonly='true' ";
														}

														if (isset($v['style'])) {
															if ($k == 'TE006' || $k == 'TE007') {
																echo 'style="background-color:#F0F0F0" ';
															} else if ($k == 'TE009' || $k == 'TE017') {
																echo 'style="background-color:#FFFFE4" ';
															} else {
																echo "style='" . $v['style'] . "' ";
															}
														}

														if (!($k == 'TE006' || $k == 'TE007')) {
															if (isset($v['onblur'])) {
																echo "onblur='" . $v['onblur'] . "' ";
															}
															if (isset($v['ondblclick'])) {
																echo "
															ondblclick='" . $v['ondblclick'] . "' ";
															}
														}
														if (!($k == 'TE006' || $k == 'TE007' || $k == 'TE008')) {
															if (isset($v['required'])) {
																echo "required='" . $v['required'] . "' ";
															}
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
 <form action="<?php echo base_url() ?>index.php/sfc/sfci03n/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
 	<input id="del_md001" name="del_md001" />
 	<input id="del_md002" name="del_md002" />
 	<input id="del_md003" name="del_md003" />
 </form>

 <?php include_once("./application/views/funnew/sfci01_funmjs_v.php"); ?>
 <!-- 報工單別 -->
 <?php include_once("./application/views/funnew/cmsi04_funmjs_v.php"); ?>
 <!-- 生產線別 -->
 <?php include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?>
 <!-- 人員 -->
 <?php include_once("./application/views/funnew/admi13_funmjs_v.php"); ?>
 <!-- 不良原因 -->

 <?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>
 <!-- 全域變數 -->
 <?php include_once("./application/views/funnew/sfci03n_fundjs_v.php"); ?>
 <!-- 明細開視窗 -->

 <script type="text/javascript">
 	$(document).ready(function() {
 		$('#cmsi04').focus();
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

 	}
 </script>