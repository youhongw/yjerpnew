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
			<!-- //上面橫版資訊 已登入 回主目錄 退出系統 -->
			<?php include_once("./application/views/funnew/fun_head_icon.html"); ?>
		</div>

		<div id="content">
			<!-- div-3 -->
			<div class="box">
				<!-- div-4 -->
				<span>　　　　　　</span>
				<div class="heading">
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 加班單建立作業 - 新增　　　</h1>
					<div style="float:left;padding-top: 5px; ">
						<button style="border: 0px solid;box-shadow: 1px 1px 1px 2px #88A70E;" form="commentForm" onfocus="$('#tf001').focus();" tabIndex="14" type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s </span><img src="<?php echo base_url() ?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
						<a accesskey="x" tabIndex="15" id='cancel' name='cancel' href="<?php echo site_url('pal/pali53/' . $this->session->userdata('pali53_search')); ?>" class="button"><span>返 回Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></a>
					</div>
				</div>

				<div class="content">
					<!-- div-5 -->
					<form class="cmxform" id="commentForm" name="form" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>index.php/pal/pali53/addsave">
						<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div> -->
						<div id="tab-general">
							<!-- div-6 -->
							<?php
							$date = date("Y/m/d");
							$tf001 = $this->input->post('tf001');
							$palq01a = $this->input->post('palq01a');
							$palq01adisp = $this->input->post('tf001');
							$tf002 = $this->input->post('tf002');

							if ($tf002 > '0') {
								$tf002 = $this->input->post('tf002');
							} else {
								$tf002 = date("Y/m/d");
								// $tf002 = '';
							}
							$palq01a1disp = $tf002;

							if (!isset($tf003)) {
								$tf003 = date("w");
							} else {
								$tf003 = $this->input->post('tf003');
							}
							// $tf003=$this->input->post('tf003');

							/*if (!isset($tf005)) { $tf005='';} else { $tf005=$this->input->post('tf005');}
	   if (!isset($tf006)) { $tf006=0;} else { $tf006=$this->input->post('tf006');}
	   if (!isset($tf007)) { $tf007='';} else { $tf007=$this->input->post('tf007');}*/
							$tf004 = $this->input->post('tf004');
							$tf005 = $this->input->post('tf005');
							$tf006 = $this->input->post('tf006');
							$tf007 = $this->input->post('tf007');
							$tf008 = $this->input->post('tf008');
							$tf009 = $this->input->post('tf009');
							$addtimes = 'N';

							$tf010 = 0;
							$tf011 = 0;
							$tf012 = 0;
							$tf013 = 0;
							$tf014 = 0;
							$tf015 = 0;
							$tf016 = $this->input->post('tf016');

							//  if (!isset($tf014)) { $tf014=date("Y/m/d");}
							?>
							<script>
								$(document).ready(function() {
									$('#tf001').select();
								});
							</script>
							<table class="form14">
								<!-- 表格 -->
								<tr>
									<td class="start14a" width="15%"><span class="required">員工代號：</span></td>
									<td class="normal14a" width="35%">
										<input tabIndex="1" id="tf001" onKeyPress="keyFunction()" oninput="if(this.value.length>10)this.value=this.value.slice(0,10)" onblur="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>" type="text" required /><img id="Showpalq01a" src="<?php echo base_url() ?>assets/image/png/person.png" alt="" align="top" required /></a>
										<span id="palq01adisp"> <?php echo $palq01adisp; ?> </span>
									</td>
									<!-- 表格 check_holiday(this);日期有刷卡才會出現 -->
									<td class="start14a" width="15%"><span class="required">加班日期：</span></td>
									<td class="normal14a" width="35%">
										<input tabIndex="2" placeholder='yyyy/mm/dd' oninput="if(this.value.length>10)this.value=this.value.slice(0,10)" onblur="dateformat_ymd(this);check_holiday(this);startpalq01(this);" id="tf002" onKeyPress="keyFunction()" name="tf002" value="<?php echo $tf002; ?>" size="12" type="text" style="border: 1px solid;background-color:#E7EFEF" required />
										<span id="palq01a1disp"></span>
									</td>

								</tr>

								<tr>
									<td class="start14a">星期：</td>
									<td class="normal14"><input tabIndex="3" onblur="startpalq01(this)" onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" oninput="if(this.value.length>1)this.value=this.value.slice(0,1)" onKeyPress="keyFunction()" onfocus="timeday(this);" id="tf003" name="tf003" value="<?php echo $tf003; ?>" type="text" readonly="readonly" />
										<span id="timedisp"></span>
									</td>
									<td class="normal14">中午加班：</td>
									<td class="normal14">
										<input type="checkbox" name="mf611" id="mf611" onclick="check_mf006y();" check value="N" />
									</td>
								</tr>
								<tr>
									<td class="normal14">起加班時分1：</td>
									<td class="normal14"><input tabIndex="4" onfocus="timeday(this);" onKeyPress="keyFunction()" onchange="count_time(this)" placeholder='HHMM' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" oninput="if(this.value.length>4)this.value=this.value.slice(0,4)" id="tf004" name="tf004" value="<?php echo $tf004; ?>" type="text" /></td>
									<td class="normal14">迄加班時分1：</td>
									<td class="normal14"><input type="text" onfocus="timeday(this);" tabIndex="5" placeholder='HHMM' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" oninput="if(this.value.length>4)this.value=this.value.slice(0,4)" id="tf005" onKeyPress="keyFunction()" onchange="count_time(this)" name="tf005" value="<?php echo $tf005; ?>" /></td>

								</tr>
								<tr>
									<td class="normal14">起加班時分2：</td>
									<td class="normal14"><input type="text" onfocus="timeday(this);" tabIndex="6" placeholder='HHMM' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" oninput="if(this.value.length>4)this.value=this.value.slice(0,4)" id="tf007" onKeyPress="keyFunction()" onchange="count_time(this)" name="tf007" value="<?php echo $tf007; ?>" /></td>
									<td class="normal14">迄加班時分2：</td>
									<td class="normal14"><input type="text" onfocus="timeday(this);" tabIndex="7" placeholder='HHMM' onkeyup="this.value=this.value.replace(/[^0-9]/gi,'');" oninput="if(this.value.length>4)this.value=this.value.slice(0,4)" id="tf008" onchange="count_time(this)" onKeyPress="keyFunction()" name="tf008" value="<?php echo $tf008; ?>" /></td>
								</tr>
								<tr>
									<td class="normal14">扣午休1小時：</td>
									<td class="normal14">
										<input type="checkbox" name="lunch" id="lunch" onclick="check_lunch();" check value="N" />
									</td>
									<td class="normal14">計時：</td>
									<td class="normal14">
										<input type="checkbox" name="counttimes" id="counttimes" onclick="check_counttimes();" check value="N" />
									</td>
								</tr>
								<tr>
									<td class="normal14">計時時數：</td>
									<td class="normal14"><input type="text" tabIndex="8" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf006" onfocus="count_time(this);" onKeyPress="keyFunction()" name="tf006" value="<?php echo $tf006; ?>" readonly="readonly" /></td>

								</tr>
								<!-- <tr>
									<td class="normal14">加班時數1：</td>
									<td class="normal14"><input type="text" tabIndex="8" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf006" onfocus="count_time(this);" onKeyPress="keyFunction()" name="tf006" value="<?php echo $tf006; ?>" readonly="readonly" /></td>

								</tr>
								<tr>
									<td class="normal14">加班時數2：</td>
									<td class="normal14"><input type="text" tabIndex="9" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf009" onfocus="count_time(this);" onKeyPress="keyFunction()" name="tf009" value="<?php echo $tf009; ?>" readonly="readonly" /></td>
								</tr> -->
								<tr>
									<td class="normal14">平時加班：</td>
									<td class="normal14"><input type="text" tabIndex="10" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf010" onKeyPress="keyFunction()" name="tf010" value="<?php echo $tf010; ?>" readonly="readonly" /></td>
									<!-- <td class="normal14">平時加班2時外：</td>
									<td class="normal14"><input type="text" tabIndex="11" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf011" onKeyPress="keyFunction()" name="tf011" value="<?php echo $tf011; ?>" /></td> -->
								</tr>
								<tr>
									<td class="normal14">六日加班：</td>
									<td class="normal14"><input type="text" tabIndex="11" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf012" onKeyPress="keyFunction()" name="tf012" value="<?php echo $tf012; ?>" readonly="readonly" /></td>
									<!-- <td class="normal14">六加班2時外：</td>
									<td class="normal14"><input type="text" tabIndex="13" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf013" onKeyPress="keyFunction()" name="tf013" value="<?php echo $tf013; ?>" /></td> -->
								</tr>
								<tr>
									<td class="normal14">國定假日加班：</td>
									<td class="normal14"><input type="text" tabIndex="12" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf014" onKeyPress="keyFunction()" name="tf014" value="<?php echo $tf014; ?>" readonly="readonly" /></td>
									<!-- <td class="normal14">國日加班8時外：</td>
									<td class="normal14"><input type="text" tabIndex="15" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" id="tf015" onKeyPress="keyFunction()" name="tf015" value="<?php echo $tf015; ?>" /></td> -->
									<td class="normal14">提早上班算加班：</td>
									<td class="normal14">
										<input type="checkbox" name="addtimes" id="addtimes" onclick="disableit();" check value="N" />
									</td>
								</tr>
								<tr id="mt89" style="display: none;">
									<td class="normal14"><span>提早上班小時：</span></td>
									<td class="normal14">
										<input tabIndex="13" id="mt008" onblur="add_time()" onkeyup="this.value=this.value.replace(/[^0-9\.]/gi,'');" maxlength='4' onKeyPress="keyFunction()" name="mt008" value="" />
									</td>
								</tr>

								<tr>
									<td class="normal14">備註：</td>
									<td class="normal14" colspan="3"><input onfocus="timeday(this);" type="text" tabIndex="13" id="tf016" onKeyPress="keyFunction()" name="tf016" value="<?php echo $tf016; ?>" size="60" /></td>
								</tr>

							</table>



					</form>
				</div> <!-- div-6 -->
			</div> <!-- div-5 -->
		</div> <!-- div-4 -->

		<?php if ($message != ' ') { ?>
			<?php
			if ($message != '新增成功!') {
				$message = '<b><font color="red">' . $message . '</font></b><br>';
			} else {
				$message = '<font color="blue">' . $message . '</font><br>';
			}
			?>
			<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
										'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?><br>
				<?php echo '快速鍵使用： Chrome、IE、Safari、Opera 15+ 等請使用[Alt] + [key] ； Firefox 請使用[Alt] + [Shift] + [key]' ?>
			</div> <?php } ?>
	</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include("./application/views/fun/pali53_funjs_v.php"); ?>
<script>
	var holiday = false;
	var lastkalatime = ''; //最後下班時間
	var addworktime = ''; //加班起算時間
	var memotime = ''; //所有刷卡時間
	var offworktime = ''; //下班時間
	var isrest = ''; //是否休息
	var firstkalatime = ''; //第一筆上班時間
	var istwo = ''; //是否跨天
	var onworktime = ''; //上班時間
	var weekkind = ''; //行事曆日別
	var SE = ''; //特殊班
	var time1 = '';
	var time2 = '';
	var total_time = '';

	function count_time(obj) {
		$('#tf006').val("");
		$('#tf010').val("");
		$('#tf011').val("");
		$('#tf012').val("");
		$('#tf013').val("");
		$('#tf014').val("");
		$('#tf015').val("");
		var week = $('#tf003').val();
		var time1_str = $('#tf004').val();
		var time1_end = $('#tf005').val();
		var time2_str = $('#tf007').val();
		var time2_end = $('#tf008').val();
		var last_time = $('#tf016').val();

		var time1_str_hr = time1_str.substr(0, 2);
		var time1_str_mn = (time1_str.substr(2, 2) >= '30') ? '30' : '00';
		var time1_end_hr = time1_end.substr(0, 2);
		var time1_end_mn = (time1_end.substr(2, 2) >= '30') ? '30' : '00';
		var time2_str_hr = time2_str.substr(0, 2);
		var time2_str_mn = (time2_str.substr(2, 2) >= '30') ? '30' : '00';
		var time2_end_hr = time2_end.substr(0, 2);
		var time2_end_mn = (time2_end.substr(2, 2) >= '30') ? '30' : '00';



		if (time1_str.length != 4) {
			if (isrest == 'Y' || SE == 'E') {
				// console.log('firstkalatime');
				$('input[name=\'tf004\']').val(firstkalatime);
				time1_str = firstkalatime;
			} else {
				// console.log('addworktime');
				$('input[name=\'tf004\']').val(addworktime); //lastkalatime ->addworktime
				time1_str = addworktime; //lastkalatime ->addworktime
			}

		}

		if (time1_end.length != 4) {
			$('input[name=\'tf005\']').val(lastkalatime); //addworktime->lastkalatime
			time1_end = lastkalatime; //addworktime->lastkalatime
		}

		if (time2_str.length != 4) {
			$('input[name=\'tf007\']').val('');
			$('input[name=\'tf008\']').val('');
			time2_str = '';
			time2_end = '';
		}

		if (time2_end.length != 4) {
			$('input[name=\'tf008\']').val('');
			time2_end = '';
		}

		if (isrest == 'Y' ||
			SE == 'E' || document.getElementById("counttimes").checked) {
			if (istwo != 'Y') {

				// 最先打卡時間 >= star1加班時間 || star1加班時間 > 下班時間
				if (firstkalatime >= time1_str || time1_str > offworktime) {
					// console.log('onworktime:' + onworktime);

					if (time1_str <= onworktime) {
						$('input[name=\'tf004\']').val(firstkalatime);
						time1_str = firstkalatime;
					} else if (time1_str > lastkalatime) {
						$('input[name=\'tf004\']').val(firstkalatime);
						time1_str = firstkalatime;
					} else if (time1_str <= lastkalatime) {}

					// //最先打卡時間 <= 加班起算時間
					// if (firstkalatime <= addworktime) {
					// 	$('input[name=\'tf004\']').val(firstkalatime);
					// 	time1_str = firstkalatime;
					// } 
					else {
						$('input[name=\'tf004\']').val('');
						$('input[name=\'tf005\']').val('');
						time1_str = '';
						time1_end = '';
					}
				}
			}

		} else {
			// star1加班時間 <= 最後打卡時間 || star1加班時間 > 下班時間
			if (time1_str <= lastkalatime || time1_str > offworktime) {
				// 加班起算時間<= 最後打卡時間
				if (addworktime <= lastkalatime) {
					//star1加班時間 == 下班時間
					if (time1_str == offworktime) {
						$('input[name=\'tf004\']').val(offworktime);
						time1_str = offworktime;
					} else if (time1_str <= lastkalatime && time1_str >= time1_end) {
						$('input[name=\'tf004\']').val(time1_str);
						time1_str = time1_str;
					} else if (time1_str <= lastkalatime && time1_str >= offworktime) {
						$('input[name=\'tf004\']').val(time1_str);
						time1_str = time1_str;
					} else {
						$('input[name=\'tf004\']').val(addworktime); //lastkalatime ->addworktime
						time1_str = addworktime; //lastkalatime ->addworktime
					}
				} else {
					$('input[name=\'tf004\']').val('');
					$('input[name=\'tf005\']').val('');
					time1_str = '';
					time1_end = '';
				}
			}

		}


		if (isrest == 'Y') {
			if (istwo != 'Y') {
				// 最先打卡時間 <= end1加班時間  end1加班時間 < star1加班時間
				if (firstkalatime <= time1_end || time1_end < time1_str) {
					//最先打卡時間 <= 加班起算時間
					if (firstkalatime <= addworktime) {
						if (SE == 'E') {
							if (onworktime > offworktime) {
								if (time1_end <= onworktime) {
									$('input[name=\'tf005\']').val(time1_end);
									time1_end = time1_end;
								} else {
									$('input[name=\'tf005\']').val(onworktime);
									time1_end = onworktime;
								}
							} else {
								if (time1_end <= offworktime) {
									$('input[name=\'tf005\']').val(time1_end);
									time1_end = time1_end;
								} else {
									$('input[name=\'tf005\']').val(offworktime);
									time1_end = offworktime;
								}
							}

						} else if (time1_end < time1_str) { // end1加班時間 < star1加班時間 
							$('input[name=\'tf005\']').val(time1_str);
							time1_end = time1_str;

						} else if (time1_end > lastkalatime) {
							$('input[name=\'tf005\']').val(lastkalatime);
							time1_end = lastkalatime;
						} else {
							$('input[name=\'tf005\']').val(time1_end);
							time1_end = time1_end;
						}

					} else {
						$('input[name=\'tf005\']').val('');
						time1_end = '';
					}
				}
			}

		} else {
			// 加班起算時間 <= end1加班時間  end1加班時間 < star1加班時間
			if (addworktime <= time1_end || time1_end < time1_str) {

				if (SE == 'E') {
					if (onworktime > offworktime) {
						if (time1_end <= onworktime) {
							$('input[name=\'tf005\']').val(time1_end);
							time1_end = time1_end;
						} else {
							$('input[name=\'tf005\']').val(onworktime);
							time1_end = onworktime;
						}
					} else {
						if (time1_end <= offworktime) {
							$('input[name=\'tf005\']').val(time1_end);
							time1_end = time1_end;
						} else {
							$('input[name=\'tf005\']').val(offworktime);
							time1_end = offworktime;
						}
					}

				} else if (addworktime <= lastkalatime) { //加班起算時間 <= 最後打卡時間
					// end1加班時間 > 最後打卡時間 
					if (time1_end > lastkalatime) {
						$('input[name=\'tf005\']').val(lastkalatime);
						time1_end = lastkalatime;
					} else if (time1_end < time1_str) { //end1加班時間<star1加班時間
						$('input[name=\'tf005\']').val(lastkalatime);
						time1_end = lastkalatime;
					} else {
						$('input[name=\'tf005\']').val(time1_end);
						time1_end = time1_end;
					}

				} else {
					$('input[name=\'tf005\']').val('');
					time1_end = '';
				}
			}
		}




		if (!(isrest == 'Y' && istwo == 'Y') || document.getElementById("counttimes").checked) {
			// star2加班時間 < end1加班時間 || star2加班時間 > 最後打卡時間
			if (time2_str < time1_end || time2_str > lastkalatime) {
				$('input[name=\'tf007\']').val('');
				$('input[name=\'tf008\']').val('');
				time2_str = '';
				time2_end = '';
			}

			// end2加班時間 < star2加班時間 || end2加班時間 > 最後打卡時間
			if (time2_end < time2_str || time2_end > lastkalatime) {
				$('input[name=\'tf008\']').val('');
				time2_end = '';
			}

			if (document.getElementById("mf611").checked) {
				$('input[name=\'tf007\']').val('1200');
				$('input[name=\'tf008\']').val('1300');
				time2_str = '1200';
				time2_end = '1300';
			}
		}

		time1 = (time1_end.substr(0, 2) * 1 - time1_str.substr(0, 2) * 1) + (time1_end.substr(2, 2) * 1 - time1_str.substr(2, 2) * 1) / 60;
		// if (time1_str < "1200" && time1_end > "1300") {
		// 	time1 -= 1;
		// }
		time2 = (time2_end.substr(0, 2) * 1 - time2_str.substr(0, 2) * 1) + (time2_end.substr(2, 2) * 1 - time2_str.substr(2, 2) * 1) / 60;
		// if (time2_str < "1200" && time2_end > "1300") {
		// 	time2 -= 1;
		// }
		// $('#tf006').val(time1);
		// $('#tf009').val(time2);
		$('#tf009').val('');
		total_time = time1 + time2;
		if (document.getElementById("lunch").checked) {
			total_time = time1 + time2 - 1;
		}

		if (document.getElementById("counttimes").checked) {
			$('#tf006').val(total_time);
		} else if (weekkind == 1) {
			// if (total_time > 8) {
			// 	$('#tf014').val(8);
			// 	$('#tf015').val(total_time - 8);
			// } else {
			// 	$('#tf014').val(total_time);
			// }
			$('#tf014').val(total_time);
		} else if (weekkind == 2) {
			// if (total_time > 2) {
			// 	$('#tf012').val(2);
			// 	$('#tf013').val(total_time - 2);
			// } else {
			// 	$('#tf012').val(total_time);
			// }
			$('#tf012').val(total_time);
		} else {
			// if (total_time > 2) {
			// 	$('#tf010').val(2);
			// 	$('#tf011').val(total_time - 2);
			// } else {
			// 	$('#tf010').val(total_time);
			// }
			$('#tf010').val(total_time);
		}
	}

	function check_holiday(obj) {
		// console.log(obj.value);
		var date = $('#tf002').val().replace(/\D/g, '');
		console.log('date:' + date);
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/pal/pali53/check_holiday/" + encodeURIComponent(date),
				data: {
					date: obj.value
				}
			})
			.done(function(msg) {
				holiday = msg;
				// console.log("holiday   :" + holiday);
				if (holiday == 1) {
					// console.log("true");
					$('#disp_holiday').remove();
					$('#timedisp').append("<font id='disp_holiday' color='red'>國定假日</font>");
				} else {
					// console.log("false");
					$('#disp_holiday').remove();
				}
				count_time();
			});
	}

	function startpalq01() {
		var palq01a = $('#tf001').val().replace(/\D/g, '');
		var date = $('#tf002').val().replace(/\D/g, '');
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/fun/palq01a/datapalq01/" + encodeURIComponent(palq01a) + "/" + encodeURIComponent(date),
				data: {
					palq01a: palq01a,
					date: date
				}
			})
			.done(function(msg) {
				console.log('msg:' + msg);

				if (msg == '無刷卡資料') {
					$('input[name=\'tf004\']').val('');
					$('input[name=\'tf005\']').val('');
					$('input[name=\'tf016\']').val('無刷卡資料');
				} else {
					var str = (msg.split(";"));
					// console.log(msg);
					lastkalatime = str[0]; //最後下班時間
					addworktime = str[1]; //加班起算時間
					memotime = str[2]; //所有刷卡時間
					offworktime = str[3]; //下班時間
					isrest = str[4]; //是否休息
					firstkalatime = str[5]; //第一筆上班時間
					istwo = str[6]; //是否跨天
					onworktime = str[7]; //上班時間
					weekkind = str[8]; //行事曆日別
					SE = str[9]; //特殊班
					console.log('msg:' + msg);
					console.log('lastkalatime:' + lastkalatime);
					console.log('addworktime:' + addworktime);
					console.log('offworktime:' + offworktime);
					console.log('isrest:' + isrest);
					console.log('firstkalatime:' + firstkalatime);
					console.log('istwo:' + istwo);
					console.log('onworktime:' + onworktime);
					console.log('weekkind:' + weekkind);
					console.log('SE:' + SE);



					if (lastkalatime > addworktime) {
						// console.log('最後下班時間 > 加班起算時間');
						$('input[name=\'tf004\']').val(addworktime);
						$('input[name=\'tf005\']').val(lastkalatime);
					} else {
						// console.log('else');
						$('input[name=\'tf004\']').val('');
						$('input[name=\'tf005\']').val('');
					}

					$('input[name=\'tf016\']').val(memotime);
				}



				// if (holiday) {
				// 	console.log("true");
				// 	$('#disp_holiday').remove();
				// 	$('#timedisp').append("<font id='disp_holiday' color='red'>國定假日</font>");
				// } else {
				// 	console.log("false");
				// 	$('#disp_holiday').remove();
				// }
				count_time();
			});
	}

	function check_mf006y() {
		if (document.getElementById("mf611").checked) {
			$('input[name=\'tf007\']').val('1200');
			$('input[name=\'tf008\']').val('1300');
			time2_str = '1200';
			time2_end = '1300';
		} else {
			$('input[name=\'tf007\']').val('');
			$('input[name=\'tf008\']').val('');
			time2_str = '';
			time2_end = '';
		}
		count_time();
	}

	function check_lunch() {
		if (document.getElementById("lunch").checked) {
			total_time = time1 + time2 - 1;
		} else {
			total_time = time1 + time2;
		}
		count_time();
	}

	function check_counttimes() {
		console.log('check_counttimes:' + document.getElementById("counttimes").checked);
		add_time();
		if (document.getElementById("counttimes").checked) {
			$('#tf006').val(total_time);
		} else if (weekkind == 1) {
			$('#tf014').val(total_time);
		} else if (weekkind == 2) {

			$('#tf012').val(total_time);
		} else {
			$('#tf010').val(total_time);
		}
		count_time();
	}

	function disableit() {

		if (document.getElementById("addtimes").checked == true) {

			document.getElementById("mt89").style.display = "";
		} else {

			document.getElementById("mt89").style.display = "none";
		}
	}

	function add_time() {
		var add = parseFloat($('#mt008').val());
		total_time = time1 + time2 + add;

		console.log('time1' + time1);
		console.log('time2' + time2);
		console.log('add' + add);
		console.log('total_time' + total_time);
		if (document.getElementById("counttimes").checked) {
			$('#tf006').val(total_time);
		} else if (weekkind == 1) {
			$('#tf014').val(total_time);
		} else if (weekkind == 2) {

			$('#tf012').val(total_time);
		} else {
			$('#tf010').val(total_time);
		}
	}
</script>