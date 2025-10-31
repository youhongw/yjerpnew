<div id="container">
	<!-- div-1 -->
	<div id="header">
		<!-- div-2 -->
		<div class="div1">
			<!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main"><?php echo $systitle ?></a></div> -->
			<!-- <div class="div3">
	     <img src="<?php echo base_url() ?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url() ?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url() ?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url() ?>index.php">退出系統</a>
	    </div> -->
			<!-- //上面橫版資訊 已登入 回主目錄 退出系統 -->
			<?php include_once("./application/views/funnew/fun_head_icon.html"); ?>
		</div>


		<div id="content">
			<!-- div-3 -->
			<div class="box">
				<!-- div-4 -->
				<span>　　　　　　</span>
				<div class="heading">
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 製令製程建立作業 - 查看　　　</h1>

					<form class="cmxform" id="commentForm" name="form" action="<?php echo base_url() ?>index.php/sfc/sfci04/display" method="post" enctype="multipart/form-data">

						<div style="float:left;padding-top: 5px;">
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
								<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('sfc/sfci04/see/' . $prev_str); ?>" class="button"><span>上一筆Alt+< </span><img src="<?php echo base_url() ?>assets/image/png/pre.png" /></a>
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
								<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('sfc/sfci04/see/' . $next_str); ?>" class="button"><span>下一筆Alt+> </span><img src="<?php echo base_url() ?>assets/image/png/next.png" /></a>
							<?php } ?>
							<!-- <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;  -->
							<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('sfc/sfci04/display'); ?>" class="button"><span>返 回Alt+x</span></a>
						</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
					<div id="tab-general">
						<!-- div-6 -->
						<?php $i = 0; ?>
						<?php $ii = 0; ?>
						<?php foreach ($result as $row) {
							$mocq01a51 = trim($row->TA001);
							$mocq01a51disp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA001disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA002 = trim($row->TA002);

							if (trim($row->TA003) == '') {
								$TA003 = trim($row->TA003);
							} else {
								$TA003 = date('Y/m/d', strtotime(trim($row->TA003)));
							}
							if (trim($row->TA004) == '') {
								$TA004 = trim($row->TA004);
							} else {
								$TA004 = date('Y/m/d', strtotime(trim($row->TA004)));
							}

							$TA005 = trim($row->TA005);
							$invq02a1 = trim($row->TA006);
							$invq02a1disp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA034), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA007 = trim($row->TA007);
							$TA008 = trim($row->TA008);
							if (trim($row->TA009) == '') {
								$TA009 = trim($row->TA009);
							} else {
								$TA009 = date('Y/m/d', strtotime(trim($row->TA009)));
							}
							if (trim($row->TA010) == '') {
								$TA010 = trim($row->TA010);
							} else {
								$TA010 = date('Y/m/d', strtotime(trim($row->TA010)));
							}
							$TA011 = $row->TA011;
							if (trim($row->TA012) == '') {
								$TA012 = trim($row->TA012);
							} else {
								$TA012 = date('Y/m/d', strtotime(trim($row->TA012)));
							}
							$TA013 = $row->TA013;
							if (trim($row->TA014) == '') {
								$TA014 = trim($row->TA014);
							} else {
								$TA014 = date('Y/m/d', strtotime(trim($row->TA014)));
							}
							$TA015 = round(trim($row->TA015), 0);
							$TA016 = round(trim($row->TA016), 0);
							$TA017 = round(trim($row->TA017), 0);
							$TA018 = round(trim($row->TA018), 0);
							$cmsq02a = trim($row->TA019);
							$cmsq02adisp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA019disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$cmsq03a = trim($row->TA020);
							$cmsq03adisp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA020disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$cmsq04a = trim($row->TA021);
							$cmsq04adisp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA021disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA022 = round(trim($row->TA022), 3);
							$TA023 = round(trim($row->TA023), 0);
							$TA024 = trim($row->TA024);
							$TA025 = trim($row->TA025);
							$copq06a = trim($row->TA026);
							$copq06adisp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA026disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA027 = trim($row->TA027);
							$TA028 = trim($row->TA028);
							$TA029 = trim($row->TA029);
							$TA030 = trim($row->TA030);
							$TA031 = trim($row->TA031);
							$purq01a = trim($row->TA032);
							$purq01adisp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA032disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA033 = trim($row->TA033);
							$TA034 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA034), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA035 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA035), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA036 = trim($row->TA036);
							$TA037 = trim($row->TA037);
							$TA038 = trim($row->TA038);
							$TA039 = trim($row->TA039);
							if (trim($row->TA014) == '') {
								$TA040 = trim($row->TA040);
							} else {
								$TA040 = date('Y/m/d', strtotime(trim($row->TA040)));
							}

							$TA041 = trim($row->TA041);
							$cmsq06a = trim($row->TA042);
							$cmsq06adisp = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TA042disp), 'utf-8', 'big-5'), ENT_QUOTES));
							$TA043 = round(trim($row->TA043), 3);
							$TA044 = trim($row->TA044);
							$TA045 = trim($row->TA045);
							$TA046 = trim($row->TA046);
							$TA047 = trim($row->TA047);
							$TA048 = trim($row->TA048);
							$TA049 = trim($row->TA049);

							$FLAG = $row->FLAG;

							// <!-- 明細 -->
							$TK001[] = trim($row->TK001);
							$TK002[] = trim($row->TK002);
							$TK003[] = trim($row->TK003);
							$TK004[] = trim($row->TK004);
							$TK004disp[] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TK004disp), 'utf-8', 'big-5'), ENT_QUOTES));

							$TK005[] = trim($row->TK005);

							$TK006[] = trim($row->TK006);
							$TK007[] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TK007), 'utf-8', 'big-5'), ENT_QUOTES));
							if (trim($row->TK008) == '') {
								$TK008[] = trim($row->TK008);
							} else {
								$TK008[] = date('Y/m/d', strtotime(trim($row->TK008)));
							}
							if (trim($row->TK009) == '') {
								$TK009[] = trim($row->TK009);
							} else {
								$TK009[] = date('Y/m/d', strtotime(trim($row->TK009)));
							}


							$TK010[] = round(trim($row->TK010), 0);
							$TK011[] = round(trim($row->TK011), 0);
							$TK012[] = round(trim($row->TK012), 0);
							$TK013[] = round(trim($row->TK013), 0);

							$TK014[] = round(trim($row->TK014), 0);

							$TK015[] = round(trim($row->TK015), 0);



							$TK016[] = round(trim($row->TK016), 0);
							$TK017[] = round(trim($row->TK017), 0);
							$TK018[] = trim($row->TK018);
							$TK019[] = trim($row->TK019);
							$TK020[] = trim($row->TK020);
							$TK021[] = round(trim($row->TK021), 0);
							$TK024[] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->TK024), 'utf-8', 'big-5'), ENT_QUOTES));
							$TK025[] = trim($row->TK025);

							$TK028[] = trim($row->TK028);
							$TK030[] = trim($row->TK030);
							$TK031[] = trim($row->TK031);
							$TK032[] = trim($row->TK032);
							$TK034[] = trim($row->TK034);


							$mb991 = ' ';
							$mb992 = ' ';
							$mb999 = ' ';
							if (trim($row->TK001))
								$ii = $ii + 1;
						}

						if (!isset($sysma200)) {
							$sysma200 = $this->session->userdata('sysma200');
						}
						if (!isset($sysma201)) {
							$sysma201 = $this->session->userdata('sysma201');
						}  ?>
						<table class="form14">
							<!-- 頭部表格 -->
							<tr>
								<td class="start14a" width="8%"><span class="required">製令單別：</span> </td>
								<td class="normal14a" width="25%"><input tabIndex="1" id="TA001" onKeyPress="keyFunction()" onfocus="selappr()" onChange="startmocq01a51(this)" name="mocq01a51" value="<?php echo strtoupper($mocq01a51); ?>" type="text" required style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showmocq01a51" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" style="background-color:#E7EFEF" /></a>
									<span id="mocq01a51disp"> <?php echo $mocq01a51disp; ?> </span>
								</td>
								<td class="normal14a" width="8%">開單日期： </td>
								<td class="normal14a" width="25%"><input tabIndex="2" onclick="scwShow(this,event);" onfocus="selappr()" id="TA003" onKeyPress="keyFunction()" onchange="chkno1(this)" name="TA003" value="<?php echo $TA003; ?>" size="12" type="text" style="background-color:#E7EFEF" disabled="disabled" /></td>
								<td class="start14a" width="9%"><span class="required">製令單號：</span></td>
								<td class="normal14a" width="25%"><input tabIndex="3" id="TA002" onKeyPress="keyFunction()" onfocus="chkno1(this)" name="TA002" value="<?php echo $TA002; ?>" size="30" type="text" required disabled="disabled" style="background-color:#E7EFEF" /><span id="TA002disp"></span></td>
							</tr>
							<tr>
								<td class="normal14a">產品品號：</td>
								<td class="normal14"><input tabIndex="4" id="TA006" onKeyPress="keyFunction()" onfocus="chkno1(this)" onchange="startinvq02a1(this)" name="invq02a1" value="<?php echo $invq02a1; ?>" size="20" type="text" disabled="disabled" style="background-color:#E7EFEF" /><img id="Showinvq02a1" src="<?php echo base_url() ?>assets/image/png/distance.png" alt="" align="top" /></a>
									<span id="invq02a1disp"> <?php echo $invq02a1disp; ?> </span>
								</td>
								<td class="normal14a">品名：</td>
								<td class="normal14a"><input tabIndex="5" id="TA034" onKeyPress="keyFunction()" name="TA034" value="<?php echo $TA034; ?>" size="30" type="text" style="background-color:#E7EFEF" disabled="disabled" /></td>
								<td class="normal14a">規格：</td>
								<td class="normal14a"><input tabIndex="6" id="TA035" onKeyPress="keyFunction()" name="TA035" value="<?php echo $TA035; ?>" size="30" type="text" style="background-color:#E7EFEF" disabled="disabled" /></td>
							</tr>

							<tr>
								<td class="normal14a">單位：</td>
								<td class="normal14a"><input tabIndex="7" id="TA007" onKeyPress="keyFunction()" name="TA007" value="<?php echo $TA007; ?>" size="10" type="text" style="background-color:#E7EFEF" disabled="disabled" /></td>
								<td class="normal14">性質：</td>
								<td class="normal14"><select id="TA030" onKeyPress="keyFunction()" name="TA030" tabIndex="8" disabled="disabled" style="background-color:#E7EFEF">
										<option <?php if ($TA030 == '1') echo 'selected="selected"'; ?> value='1'>1廠內製令</option>
										<option <?php if ($TA030 == '2') echo 'selected="selected"'; ?> value='2'>2託外製令</option>
									</select></td>
								<td class="normal14">狀態碼：</td>
								<td class="normal14"><select id="TA011" onKeyPress="keyFunction()" name="TA011" tabIndex="9" disabled="disabled" style="background-color:#E7EFEF">
										<option <?php if ($TA011 == '1') echo 'selected="selected"'; ?> value='1'>1未生產</option>
										<option <?php if ($TA011 == '2') echo 'selected="selected"'; ?> value='2'>2已發料</option>
										<option <?php if ($TA011 == '3') echo 'selected="selected"'; ?> value='3'>3生產中</option>
										<option <?php if ($TA011 == 'Y') echo 'selected="selected"'; ?> value='Y'>Y已完工</option>
										<option <?php if ($TA011 == 'y') echo 'selected="selected"'; ?> value='y'>y指定完工</option>
									</select></td>
							</tr>
							<tr>
								<td class="normal14">急料：</td>
								<td class="normal14"><input type="hidden" name="TA044" value="N" />
									<input type='checkbox' tabIndex="10" id="TA044" onKeyPress="keyFunction()" name="TA044" <?php if ($TA044 == 'Y') echo 'checked'; ?> <?php if ($TA044 !== 'Y') echo 'check'; ?> value="Y" size="1" disabled="disabled" style="background-color:#E7EFEF" />
								</td>
								<td class="normal14">確認碼：</td>
								<td class="normal14"><select id="TA013" onKeyPress="keyFunction()" name="TA013" onChange="selappr(this)" tabIndex="6" disabled="disabled" style="background-color:#E7EFEF">
										<option <?php if ($TA013 == 'Y') echo 'selected="selected"'; ?> value='Y'>Y確認</option>
										<option <?php if ($TA013 == 'N') echo 'selected="selected"'; ?> value='N'>N取消確認</option>
										<option <?php if ($TA013 == 'V') echo 'selected="selected"'; ?> value='V'>V作廢</option>
									</select><span id="approved"></span></td>
								<td class="normal14a">列印：</td>
								<td class="normal14a"><input tabIndex="12" id="TA031" onKeyPress="keyFunction()" name="TA031" value="<?php echo $TA031; ?>" size="10" type="text" style="background-color:#E7EFEF" disabled="disabled" style="background-color:#E7EFEF" /></td>
								<td class="start14"><input type='hidden' name='sysma200' id='sysma200' value="<?php echo $sysma200; ?>" /></td>
								<td class="normal14"><input type='hidden' name='sysma201' id='sysma201' value="<?php echo $sysma201; ?>" /></td>
							</tr>

						</table>

						<div class="abgne_tab">
							<!-- div-7 -->
							<ul class="tabs">
								<li><a href="#tab1">時程產量</a></li>
								<li><a href="#tab2">廠內託外</a></li>
								<li><a href="#tab3">進階資料</a></li>
							</ul>

							<div class="tab_container">
								<!-- div-8 -->

								<!--   基本資料 -->
								<div id="tab1" class="tab_content">
									<table class="form14">
										<!-- 表格 -->
										<tr>
											<td class="normal14a" width="8%"> 預計開工：</td>
											<td class="normal14a" width="25%"><input type="text" tabIndex="14" id="TA009" onclick="scwShow(this,event);" onKeyPress="keyFunction()" name="TA009" value="<?php echo $TA009; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a" width="8%"> 預計產量：</td>
											<td class="normal14a" width="25%"><input type="text" tabIndex="13" id="TA015" onKeyPress="keyFunction()" name="TA015" value="<?php echo $TA015; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a" width="9%"> BOM日期：</td>
											<td class="normal14a" width="25"><input type="text" tabIndex="15" id="TA004" onclick="scwShow(this,event);" onKeyPress="keyFunction()" name="TA004" value="<?php echo $TA004; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>
										<tr>
											<td class="normal14a"> 預計完工：</td>
											<td class="normal14a"><input type="text" tabIndex="17" id="TA010" onclick="scwShow(this,event);" onKeyPress="keyFunction()" name="TA010" value="<?php echo $TA010; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a"> 已領套數：</td>
											<td class="normal14a"><input type="text" tabIndex="16" id="TA016" onKeyPress="keyFunction()" name="TA016" value="<?php echo $TA016; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>

											<td class="normal14a"> 確認日：</td>
											<td class="normal14a"><input type="text" tabIndex="18" id="TA040" onKeyPress="keyFunction()" name="TA040" value="<?php echo $TA040; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>
										<tr>
											<td class="normal14a"> 實際開工：</td>
											<td class="normal14a"><input type="text" tabIndex="20" id="TA012" onclick="scwShow(this,event);" onKeyPress="keyFunction()" name="TA012" value="<?php echo $TA012; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a"> 已生產數：</td>
											<td class="normal14a"><input type="text" tabIndex="19" id="TA017" onKeyPress="keyFunction()" name="TA017" value="<?php echo $TA017; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>

											<td class="normal14a"> 確認者：</td>
											<td class="normal14a"><input type="text" tabIndex="21" id="TA041" onKeyPress="keyFunction()" name="TA041" value="<?php echo $TA041; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>
										<tr>
											<td class="normal14a"> 實際完工：</td>
											<td class="normal14a"><input type="text" tabIndex="23" id="TA014" onclick="scwShow(this,event);" onKeyPress="keyFunction()" name="TA014" value="<?php echo $TA014; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a"> 報廢數量：</td>
											<td class="normal14a"><input type="text" tabIndex="22" id="TA018" onKeyPress="keyFunction()" name="TA018" value="<?php echo $TA018; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>

											<td class="normal14">簽核狀態：</td>
											<td class="normal14"><select id="TA049" tabIndex="24" readonly="value" onKeyPress="keyFunction()" name="TA049" style="background-color:#E7EFEF" disabled="disabled">
													<option <?php if ($TA049 == 'N') echo 'selected="selected"'; ?> value='N'>N.不執行電子簽核</option>
													<option <?php if ($TA049 == '0') echo 'selected="selected"'; ?> value='0'> 0.待處理</option>
													<option <?php if ($TA049 == '1') echo 'selected="selected"'; ?> value='1'>1.簽核中</option>
													<option <?php if ($TA049 == '2') echo 'selected="selected"'; ?> value='2'>2.退件</option>
													<option <?php if ($TA049 == '3') echo 'selected="selected"'; ?> value='3'>3.已核准</option>
													<option <?php if ($TA049 == '4') echo 'selected="selected"'; ?> value='4'>4.取消確認中</option>
													<option <?php if ($TA049 == '5') echo 'selected="selected"'; ?> value='5'>5.作廢中</option>
													<option <?php if ($TA049 == '6') echo 'selected="selected"'; ?> value='6'>6.取消作廢中</option>
												</select></td>
										</tr>


									</table>
								</div>

								<!--  發票資料 -->
								<div id="tab2" class="tab_content">
									<!-- div-8 -->


									<table class="form14">
										<!-- 表格 -->
										<tr>
											<td class="normal14a" width="10%">生產廠別：</td>
											<td class="normal14a" width="40%"><input type="text" tabIndex="25" onKeyPress="keyFunction()" id="TA019" onchange="startcmsq02a(this)" name="cmsq02a" value="<?php echo  $cmsq02a; ?>" style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url() ?>assets/image/png/store.png" alt="" align="top" /></a>
												<span id="cmsq02adisp"> <?php echo $cmsq02adisp; ?> </span>
											</td>
											<td class="normal14a" width="10%">幣別：</td>
											<td class="normal14a" width="40%"><input tabIndex="26" id="TA042" onKeyPress="keyFunction()" name="cmsq06a" onchange="startcmsq06a(this)" value="<?php echo $cmsq06a; ?>" type="text" style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url() ?>assets/image/png/currency.png" alt="" align="top" /></a>
												<span id="cmsq06adisp"> <?php echo $cmsq06adisp; ?> </span>
											</td>
										</tr>
										<tr>
											<td class="normal14">入庫庫別：</td>
											<td class="normal14"><input tabIndex="27" id="TA020" onKeyPress="keyFunction()" name="cmsq03a" onchange="startcmsq03a(this)" value="<?php echo $cmsq03a; ?>" type="text" style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showcmsq03a" src="<?php echo base_url() ?>assets/image/png/store.png" alt="" align="top" /></a>
												<span id="cmsq03adisp"> <?php echo $cmsq03adisp; ?> </span>
											</td>
											<td class="normal14">匯率：</td>
											<td class="normal14"><input type="text" tabIndex="28" id="TA043" onKeyPress="keyFunction()" name="TA043" value="<?php echo $TA043; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>
										<tr>
											<td class="normal14">生產線別：</td>
											<td class="normal14"><input tabIndex="29" id="TA021" onKeyPress="keyFunction()" name="cmsq04a" onchange="startcmsq04a(this)" value="<?php echo $cmsq04a; ?>" type="text" style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showcmsq04a" src="<?php echo base_url() ?>assets/image/png/linedo.png" alt="" align="top" /></a>
												<span id="cmsq04adisp"> <?php echo $cmsq04adisp; ?> </span>
											</td>
											<td class="normal14">加工單價：</td>
											<td class="normal14"><input type="text" tabIndex="30" id="TA022" onKeyPress="keyFunction()" name="TA022" value="<?php echo $TA022; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>
										<tr>
											<td class="normal14">加工廠商：</td>
											<td class="normal14"><input tabIndex="31" id="TA032" onKeyPress="keyFunction()" name="purq01a" onchange="startpurq01a(this)" value="<?php echo $purq01a; ?>" type="text" style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showpurq01a" src="<?php echo base_url() ?>assets/image/png/factory.png" alt="" align="top" /></a>
												<span id="purq01adisp"> <?php echo $purq01adisp; ?> </span>
											</td>
											<td class="normal14">加工單位：</td>
											<td class="normal14"><input type="text" tabIndex="32" id="TA023" onKeyPress="keyFunction()" name="TA023" value="<?php echo $TA023; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>

									</table>

								</div>
								<!--  訂金資料 -->
								<div id="tab3" class="tab_content">
									<!-- div-8 -->

									<table class="form14">
										<!-- 表格 -->
										<tr>
											<td class="normal14a" width="10%">母製令單別：</td>
											<td class="normal14a" width="24%"><input type="text" tabIndex="33" onKeyPress="keyFunction()" id="TA024" name="TA024" value="<?php echo $TA024; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a" width="10%">母製令單號：</td>
											<td class="normal14a" width="24%"><input type="text" tabIndex="34" onKeyPress="keyFunction()" id="TA025" name="TA025" value="<?php echo $TA025; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a" width="8%"></td>
											<td class="normal14a" width="24%"></td>
										</tr>
										<tr>
											<td class="normal14">訂單單別：</td>
											<td class="normal14"><input tabIndex="35" id="TA026" onKeyPress="keyFunction()" name="copq06a" onchange="startcopq06a(this)" value="<?php echo $copq06a; ?>" type="text" style="background-color:#E7EFEF" disabled="disabled" /><a href="javascript:;"><img id="Showcopq06a" src="<?php echo base_url() ?>assets/image/png/invoice.png" alt="" align="top" /></a>
												<span id="copq06adisp"> <?php echo $copq06adisp; ?> </span>
											</td>
											<td class="normal14">訂單單號：</td>
											<td class="normal14"><input type="text" tabIndex="36" onKeyPress="keyFunction()" id="TA027" name="TA027" value="<?php echo $TA027; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14">訂單序號：</td>
											<td class="normal14"><input type="text" tabIndex="37" onKeyPress="keyFunction()" id="TA028" name="TA028" value="<?php echo $TA028; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
										</tr>
										<tr>
											<td class="normal14">計劃批號：</td>
											<td class="normal14"><input type="text" tabIndex="38" id="TA033" onKeyPress="keyFunction()" name="TA033" value="<?php echo $TA033; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14">備註：</td>
											<td class="normal14"><input type="text" tabIndex="39" id="TA029" onKeyPress="keyFunction()" name="TA029" value="<?php echo $TA029; ?>" style="background-color:#E7EFEF" disabled="disabled" /></td>
											<td class="normal14a"></td>
											<td class="normal14a"></td>
										</tr>


									</table>

								</div>


							</div> <!-- </div>div-8 -->
						</div>
						<!--</div>  div-7 -->

						<div style="width:100%; overflow-x: auto;  ">
							<table style="width:100%;" id="order_product" class="list1">
								<thead>
									<tr>
										<td width="3%"></td>
										<td width="6%" class="center">加工順序</td>
										<td width="8%" class="center">製程代號</td>
										<td width="8%" class="left">製程名稱</td>
										<td width="8%" class="left">製程敘述</td>
										<td width="6%" class="center">性質</td>

										<td width="6%" class="left">線別代號</td>
										<td width="6%" class="left">線別名稱</td>
										<td width="6%" class="center">預計開工日</td>
										<td width="6%" class="right">預計完工日</td>
										<td width="6%" class="right">投入數量</td>
										<td width="6%" class="center">完成數量</td>
										<td width="6%" class="right">報廢數量</td>
										<td width="6%" class="right">重工投入</td>
										<td width="6%" class="center">重工完成</td>
										<td width="6%" class="right">撥轉數量</td>
										<td width="6%" class="right">盤盈虧量</td>
										<td width="6%" class="right">待轉數量</td>
										<td width="6%" class="right">計價單位</td>
										<td width="6%" class="right">加工單價</td>
										<td width="6%" class="right">移轉批量</td>
										<td width="6%" class="right">工時批量</td>
										<td width="6%" class="right">實際開工日</td>
										<td width="6%" class="right">實際完工日</td>
										<td width="6%" class="right">完工碼</td>
										<td width="6%" class="right">備註</td>

									</tr>
								</thead>

								<!--   明細0  -->
								<?php $i = 0;
								$mproduct_row = 0;
								$product_row = '0'; ?>
								<input id="row_count" name="row_count" value="0" style="display:none;" />
								<?php while ($i < $ii) { ?>
									<tbody <?php echo    "id=product_row_" . $product_row ?>>
										<tr>
											<td class="center"><img src="<?php echo base_url() ?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>
											<!-- <td class="center"></td> -->
											<input type="hidden" name="order_product[<?php echo $i ?>][TK001]" value="<?php echo $TK001[$i]; ?>" />
											<input type="hidden" name="order_product[<?php echo $i ?>][TK002]" value="<?php echo $TK002[$i]; ?>" />

											<td class="left"><input type="text" onKeyPress="keyFunction()" id="TK003" name="order_product[<?php echo $i ?>][TK003]" value="<?php echo $TK003[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>

											<td class="left"><input type="text" id="TK004" onchange="startinvq02a(this,product_row)" name="order_product[<?php echo $i ?>][TK004]" value="<?php echo $TK004[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="left"><input type="text" onKeyPress="keyFunction()" id="TK004disp" name="order_product[<?php echo $i ?>][TK004disp]" value="<?php echo $TK004disp[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="left"><input type="text" onKeyPress="keyFunction()" id="TK024" name="order_product[<?php echo $i ?>][TK024]" value="<?php echo $TK024[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="left">
												<!-- <input type="text" onKeyPress="keyFunction()" id="TK005" name="order_product[<?php echo $i ?>][TK005]" value="<?php echo $TK005[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /> -->
												<select id="TK005" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK005]" tyle="background-color:#EBEBE4" disabled="disabled">
													<option <?php if ($TK005[$i] == '1') echo 'selected="selected"'; ?> value='1'>1:廠內</option>
													<option <?php if ($TK005[$i] == '2') echo 'selected="selected"'; ?> value='2'>2:託外</option>
												</select>
											</td>

											<td class="left"><input type="text" id="TK006" onchange="startcmsq03a(this,product_row)" name="order_product[<?php echo $i ?>][TK006]" value="<?php echo $TK006[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="left"><input type="text" onKeyPress="keyFunction()" id="TK007" name="order_product[<?php echo $i ?>][TK007]" value="<?php echo $TK007[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="left"><input type="text" onKeyPress="keyFunction()" onclick="scwShow(this,event);" id="TK008" name="order_product[<?php echo $i ?>][TK008]" value="<?php echo $TK008[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="left"><input type="text" onKeyPress="keyFunction()" onclick="scwShow(this,event);" id="TK009" name="order_product[<?php echo $i ?>][TK009]" value="<?php echo $TK009[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK010" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK010]" value="<?php echo $TK010[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK011" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK011]" value="<?php echo $TK011[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK012" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK012]" value="<?php echo $TK012[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK013" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK013]" value="<?php echo $TK013[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK014" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK014]" value="<?php echo $TK014[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK015" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK015]" value="<?php echo $TK015[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK016" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK016]" value="<?php echo $TK016[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK017" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK017]" value="<?php echo $TK017[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>

											<td class="center"><input type="text" id="TK020" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK020]" value="<?php echo $TK020[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK021" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK021]" value="<?php echo $TK021[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK025" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK025]" value="<?php echo $TK025[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK028" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK028]" value="<?php echo $TK028[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK030" onKeyPress="keyFunction()" onclick="scwShow(this,event);" name="order_product[<?php echo $i ?>][TK030]" value="<?php echo $TK030[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK031" onKeyPress="keyFunction()" onclick="scwShow(this,event);" name="order_product[<?php echo $i ?>][TK031]" value="<?php echo $TK031[$i]; ?>" size="10" style="background-color:#EBEBE4" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK032" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK032]" value="<?php echo $TK032[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>
											<td class="center"><input type="text" id="TK034" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][TK034]" value="<?php echo $TK034[$i]; ?>" size="10" style="text-align:right;background-color:#EBEBE4;" disabled="disabled" /></td>

										</tr>
									</tbody>
									<script>
										function del_detail(del_md001, del_md002, del_md003) {
											if (confirm('是否刪除此筆資料，單別:' + del_md001 + '單號:' + del_md002 + '序號:' + del_md003)) {
												$('#del_md001').val(del_md001);
												$('#del_md002').val(del_md002);
												$('#del_md003').val(del_md003);
												$('#del_form').submit();
											}
										}
									</script>
									<?php $i++;
									$mproduct_row = (int) $product_row + 1;
									$product_row = (string)$mproduct_row;
									echo "<script>$('#row_count').val(" . $product_row . ")</script>"; ?>

								<?php } ?>
								<!-- javascrit 0 -->



								<tfoot>
									<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->
									<!-- <tr>
										<td class="center" valign="top"><img src="<?php echo base_url() ?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
										<td class="left" colspan="25"></td>
									</tr> -->

								</tfoot>
							</table>
						</div>

					</div>
				</div>
				<br>
				<?php
				if ($message == '查看一筆資料!') {
					$message = '<font color="blue">' . $message . '</font><br>';
				} else {
					$message = '<b><font color="red">' . $message . '</font></b><br>';
				}
				if ($message != ' ') {
				?>

					<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' . ' ' ?> </div> <?php } ?>

				</form>
			</div> <!-- div-6 -->
		</div> <!-- div-5 -->
	</div> <!-- div-4 -->


</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->