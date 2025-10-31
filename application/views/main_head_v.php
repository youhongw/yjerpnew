<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<!--<title>雲端ERP企業資源管理系統</title> -->
	<title><?php echo $systitle; ?></title>
	<?php $this->load->helper('url'); ?>
	<?php $this->load->library("session"); ?>
	<link href="<?php echo base_url() ?>assets/image/icon.png" rel="icon" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/stylesheet/stylesheet.css" />
	<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/jquery-1.9.1.js"  ></script>  1040605 test-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
	<link type="text/css" href="<?php echo base_url() ?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/tabs.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/superfish/js/superfish.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/common.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery.blockUI.js"></script>
	<!-- 進度條  -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/circle-progress.js"></script>
	<!-- ckedit  -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/ckeditor/ckeditor.js"></script>
	<!-- 日期開視窗NEW  -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/show_ads.js"></script>

	<!-- 下拉視窗 test 年月 1070331 -->
	<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/Calendar_ym.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/placeholder.js"></script> -->

	<!-- 日期開視窗  -->
	<!-- <link rel="stylesheet"  href="<?php echo base_url() ?>assets/javascript/jquery/ui/themes/base/jquery.ui.datepicker.css" /> -->
	<!-- <script  src="<?php echo base_url() ?>assets/javascript/jquery/ui/i18n/jquery.ui.datepicker-zh-TW.js"></script>  -->

	<!-- 驗證各欄位  -->
	<script src="<?php echo base_url() ?>assets/validate/jquery.validate.js"></script>
	<script src="<?php echo base_url() ?>assets/validate/localization/messages_zh_TW.js"></script>

	<!-- Ajax 批次光棒  -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/javascript/jquery/ui/jquery-ui.css">
	<!-- 開視年月 -->
	<script type="text/javascript">
		//function dateym(oInput){<!-- 
		$(function() {
			$('.date-picker').datepicker({
				showOn: 'button',
				buttonImageOnly: true,
				buttonImage: '<?php echo base_url() ?>assets/image/png/calendar.gif',
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy/MM',
				monthNames: ['01', '02', '03', '04', '05', '06',
					'07', '08', '09', '10', '11', '12'
				],
				monthNamesShort: ['01', '02', '03', '04', '05', '06',
					'07', '08', '09', '10', '11', '12'
				],
				onClose: function(dateText, inst) {
					var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
					var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
					$(this).datepicker('setDate', new Date(year, month, 1));
				}
			});
		});
		//-->
	</script>

	<style>
		.ui-datepicker-calendar {
			display: none;
		}
	</style>
	<script type="text/javascript">
		//<!--  
		$(document).ready(function() {
			$(function() {
				$("input[id^='datepicker']").datepicker({
					showButtonPanel: true,
					dateFormat: 'yymmdd'
				});
			});
		});
		//-->
	</script>


	<script>
		//檢查欄位輸入錯誤
		$().ready(function() {
			// validate the comment form when it is submitted
			$("#commentForm").validate();
			//code to hide topic selection, disable for demo
			var newsletter = $("#newsletter");
			// newsletter topics are optional, hide at first
			var inital = newsletter.is(":checked");
			var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
			var topicInputs = topics.find("input").attr("disabled", !inital);
			// show when newsletter is checked
			newsletter.click(function() {
				topics[this.checked ? "removeClass" : "addClass"]("gray");
				topicInputs.attr("disabled", !this.checked);
			});
		});
	</script>
	<style type="text/css">
		/* <!--欄位輸入錯誤提示   	--> */
		#commentForm {
			width:
				1190px;
		}

		#commentForm label {
			width:
				220px;
		}

		#commentForm label.error,
		#commentForm input.submit {
			margin-left:
				1px;
		}

		#newsletter_topics label.error {
			display:
				none;
			margin-left:
				13px;
		}
	</style>
	<style>
		input:focus {
			background-color: yellow;
			outline: none;
			border: 1px solid;
		}
	</style>
	<!--white yellow欄位游標停留變黃色  -->
	<style>
		label {
			display: block;
		}
	</style>
	<!--欄位標題顯示方框 -->

	<script type="text/javascript">
		//-----------------------------------------
		// Confirm Actions (delete, uninstall)
		//-----------------------------------------
		$(document).ready(function() {
			// Confirm Delete
			$('#form').submit(function() {
				if ($(this).attr('action').indexOf('delete', 1) != -1) {
					if (!confirm('刪除資料後您將不能恢復，確定要刪除嗎?')) {
						return false;
					}
				}
			});

			// Confirm Uninstall
			$('a').click(function() {
				if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
					if (!confirm('刪除或卸載後您將不能恢復，請確定要這麼做嗎?')) {
						return false;
					}
				}
			});

		});
	</script>
	<script language="javascript">
		//閒置超時，系統強制登出  1000毫秒=1秒, 7200000=2小時 8小時 328
		//	function Msg(){
		//		alert("閒置超時，系統強制登出!");
		//		location="<?php echo base_url() ?>";
		//	}
		//	window.setInterval("Msg()",32800000);

		function CheckForm() {
			if (confirm("確認要刪除此筆嗎？") == true)
				return true;
			else
				return false;
		}
		// < !--自動檢查輸入欄位游標停留變黃色-- >
		function setFocus() {
			for (var i = 0; i < document.forms[0].elements.length; i++) {
				var e = document.forms[0].elements[i];
				if (e.type == "text" || e.type) {
					e.focus();
					break;
				}
			}
		}
	</script>

	<script type="text/javascript">
		//標簽欄位切換
		$(function() {
			// 預設顯示第一個 Tab
			var _showTab = 0;
			$('.abgne_tab').each(function() {
				// 目前的頁籤區塊
				var $tab = $(this);

				var $defaultLi = $('ul.tabs li', $tab).eq(_showTab).addClass('active');
				$($defaultLi.find('a').attr('href')).siblings().hide();

				// 當 li 頁籤被點擊時...
				// 若要改成滑鼠移到 li 頁籤就切換時, 把 click 改成 mouseover
				$('ul.tabs li', $tab).click(function() {
					// 找出 li 中的超連結 href(#id)
					var $this = $(this),
						_clickTab = $this.find('a').attr('href');
					// 把目前點擊到的 li 頁籤加上 .active
					// 並把兄弟元素中有 .active 的都移除 class
					$this.addClass('active').siblings('.active').removeClass('active');
					// 淡入相對應的內容並隱藏兄弟元素
					$(_clickTab).stop(false, true).fadeIn().siblings().hide();

					return false;
				}).find('a').focus(function() {
					this.blur();
				});
			});
		});
	</script>

	<script type="text/javascript">
		// <!--
		$(document).ready(function() {
			$('.date').datepicker({
				dateFormat: 'yy/mm/dd'
			});
		});
		//-->
	</script>

	<!-- <script type="text/javascript">
		// enterkey 測試   
		$(document).ready(function() {
			Enterkey();
		});
	</script> -->

	<!-- <script type="text/javascript">
		// enterkey 測試 function Enterkey() { $("input").not($(":button")).keypress(function(evt) { if (evt.keyCode==13) { if ($(this).attr("type") !=='submit' ) { var fields=$(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio'); var index=fields.index(this); if (index> -1 && (index + 1) < fields.length) { fields.eq(index + 1).focus(); } $(this).blur(); return false; } } }); } function keyFunction() { $("input").not($(":button")).keypress(function(evt) { if (evt.keyCode==13) { if ($(this).attr("type") !=='submit' ) { var fields=$(this).parents('form:eq(0),body').find('input, textarea, checkbox, radio'); var index=fields.index(this); if (index> -1 && (index + 1) < fields.length) { fields.eq(index + 1).focus(); } $(this).blur(); return false; } } }); } < /script>

		<
		/head> <
		body onload = "setFocus()" >
			// <	!--rwd-- >
			<
			style >
			@media(max - width: 480 px) {
				#header {
					min - width: 100 % ;
				}

				.div1 {
					width: 1370 px!important;
				}

				.box2 > .heading {
					width: 1384 px!important;
				}

				table {
					width: 1400 px!important;
				}

				#content {
					width: 1370 px!important;
				}

				#footer {
					min - width: 1400 px!important;
				}
			} < /style> <
		style >
			#page.pagination {
				padding: 10 px;
				text - align: left;
			}

			.pagination a {
				margin: 0;
				padding: 3 px 6 px;
				border: 1 px solid #777;
										text-decoration: none;
										}

										.pagination a:hover,
										.pagination a.current {
										border-color: # 000!important;
				background: #ddd;
			}

		#form: focus {

			-webkit - box - shadow: 0 px 0 px 4 px #aaa;

			-
			moz - box - shadow: 0 px 0 px 4 px #aaa;

			box - shadow: 0 px 0 px 4 px #aaa;

		} < /style>
		<?php $this->load->view($menu_v); ?>
		<?php $this->load->view($content_v); ?>
		<?php $this->load->view($foot_v); ?>
			<
			script type = "text/javascript"
		src = "<?php echo base_url() ?>assets/javascript/js/entertab.js" >
	</script> -->
	<script type="text/javascript">
		$(document).ready(function() {
			addItem();
			//一進入程式就執行新增一筆明細
		});
		//-->
	</script>

	<script>
		function dateformat_ymd(oInput) { //年月日日期自動跳轉
			temp = oInput.value.replace(/[^0-9]/g, "");
			var Today = new Date();
			var first = "2000";
			var mid = "  ";
			var last = "  ";
			if (temp.substring(0, 4)) {
				first = temp.substring(0, 4);
			}
			if (temp.substring(4, 6)) {
				mid = temp.substring(4, 6);
			}
			if (temp.substring(6, 8)) {
				last = temp.substring(6, 8);
			}
			if (mid > 20) {
				last = temp.substring(5, 7);
			}
			if (first < 1900 && first > 0) {
				first = Today.getFullYear();
			}
			if (mid < 10 && mid > 0) {
				mid = "0" + (mid * 1);
			} else if (mid > 12) {
				mid = "0" + Math.floor(mid / 10);
			} else if (mid <= 0) {
				mid = "01";
			}
			var days = new Date(first, mid, 0).getDate();
			if (last < 10 && last > 0) {
				last = "0" + (last * 1);
			} else if (last <= 0) {
				last = "01";
			} else if (last > days) {
				last = days;
			}
			oInput.value = first + '/' + mid + '/' + last;
		}

		function dateformat_ym(oInput) { //年月日期自動跳轉
			temp = oInput.value.replace(/[^0-9]/g, "");
			if (!temp) {
				oInput.value = "";
				return;
			}
			var Today = new Date();
			var first = "2000";
			var mid = "  ";
			if (temp.substring(0, 4)) {
				first = temp.substring(0, 4);
			}
			if (temp.substring(4, 6)) {
				mid = temp.substring(4, 6);
			}
			if (first < 1900 && first > 0) {
				first = Today.getFullYear();
			}
			if (mid < 10 && mid > 0) {
				mid = "0" + (mid * 1);
			} else if (mid > 12) {
				mid = 12;
			} else if (mid <= 0) {
				mid = "01";
			}
			oInput.value = first + '/' + mid;
		}

		function dateformat_ymdtw(oInput) { //民國年月日日期自動跳轉
			temp = oInput.value.replace(/[^0-9]/g, "");
			var Today = new Date();
			var first = "020";
			var mid = "  ";
			var last = "  ";
			if (temp.substring(0, 3)) {
				first = temp.substring(0, 3);
			}
			if (temp.substring(3, 5)) {
				mid = temp.substring(3, 5);
			}
			if (temp.substring(5, 7)) {
				last = temp.substring(5, 7);
			}
			if (mid > 20) {
				last = temp.substring(4, 6);
			}
			if (first < '019' && first > 0) {
				first = Today.getFullYear() - 1911;
			}
			if (mid < 10 && mid > 0) {
				mid = "0" + (mid * 1);
			} else if (mid > 12) {
				mid = "0" + Math.floor(mid / 10);
			} else if (mid <= 0) {
				mid = "01";
			}
			var days = new Date(first, mid, 0).getDate();
			if (last < 10 && last > 0) {
				last = "0" + (last * 1);
			} else if (last <= 0) {
				last = "01";
			} else if (last > days) {
				last = days;
			}
			if (first > 0) {
				oInput.value = first + '/' + mid + '/' + last;
			}
		}

		function dateformat_ymtw(oInput) { //民國年月日期自動跳轉
			temp = oInput.value.replace(/[^0-9]/g, "");
			var Today = new Date();
			var first = "2000";
			var mid = "  ";
			if (temp.substring(0, 3)) {
				first = temp.substring(0, 3);
			}
			if (temp.substring(3, 5)) {
				mid = temp.substring(3, 5);
			}
			if (first < 1900 && first > 0) {
				first = Today.getFullYear();
			}
			if (mid < 10 && mid > 0) {
				mid = "0" + (mid * 1);
			} else if (mid > 12) {
				mid = 12;
			} else if (mid <= 0) {
				mid = "01";
			}
			oInput.value = first + '/' + mid;
		}
	</script>
	<?php
	/* PHP公用方法區*/
	//陣列排序方法(自創-等級分數排序法)
	/***
	 *	talence_sort_array function		2017.03.29	Talence Editor
	 *
	 *		talence_sort_array(array1,array2)	return array3;
	 *
	 *		array1=>need sorted data array, array2=>need sorted keys array, array3=>sorted array
	 *		array1 = array('data_key'=>array())
	 *		array2 = array('sort_key'=>"sort_func")
	 *		array3 = array('data_key'=>array())
	 */
	function talence_sort_array($data_ary, $key_ary)
	{
		$level = 0;
		$data_scroe = array();						//裝載每筆資料的各等級分數
		$level_max_score = array();								//各級最高分

		foreach ($key_ary as $key_key => $key_val) {
			$sort_data_ary = array();
			$sort_key_ary = array();
			foreach ($data_ary as $data_key => $data_val) {		//裝好key_ary與data_ary
				if (!isset($data_val[$key_key])) {
					return false;
				}	//如果找不到此key值表示輸入有誤
				$sort_data_ary[] = $data_val[$key_key];
				$sort_key_ary[$data_key] = $data_val[$key_key];
			}

			if ($key_val == "asc") {
				array_multisort($sort_data_ary, SORT_DESC);
			} else {
				array_multisort($sort_data_ary, SORT_ASC);
			}

			$score = 0;
			$score_ary = array(); //初始化分數
			foreach ($sort_data_ary as $sorted_key => $sorted_val) {
				if (!isset($score_ary[$sorted_val])) {
					$score++;
					$score_ary[$sorted_val] = $score;
				} else {
					$score_ary[$sorted_val] = $score;
				}
				$level_max_score[$level] = $score;
			}

			foreach ($sort_key_ary as $key => $val) {
				$data_scroe[$key][$level] = $score_ary[$val];
			}
			$level++;
		}

		$almost_sort = array(); //裝載半成品,以等級->分數裝載

		foreach ($level_max_score as $lv_key => $lv_val) {	//lv_key = level, lv_val = max score
			for ($i = $lv_val; $i >= 1; $i--) {
				foreach ($data_scroe as $key => $val) {		//key = key,val = array(array('level'=>score))
					if ($i == $val[$lv_key]) {
						if (isset($almost_sort[$lv_key][$i])) {
							$almost_sort[$lv_key][$i][] = $key;
						} else {
							$almost_sort[$lv_key][$i][] = $key;
						}
					}
				}
			}
		}

		//echo "<pre>";var_dump($almost_sort);exit;//檢查排序完的結構

		$done_sort = array();

		foreach ($almost_sort[0] as $key => $val) { //key = score, val = each score ary
			if (count($val) > 1) {				//只要有同分數多於一筆
				if (isset($almost_sort[1])) {	//如果有下一階，就對這些進行排序
					$sort_next = get_sort_in_next($almost_sort, $val, 1);
					foreach ($sort_next as $k => $v) {
						$done_sort[] = $v;
					}
				} else {						//沒有就照目前資料輸入
					foreach ($val as $k => $v) {
						$done_sort[] = $v;
					}
				}
			} else {
				$done_sort[] = $val[0];
			}
		}
		$result = array();
		foreach ($done_sort as $key => $val) {
			$result[] = $data_ary[$val];
		}

		return $result;
	}

	function get_sort_in_next($ary, $cur_ary, $level)
	{	//$cur_ary 應只輸入val , key為序號
		$temp_score_ary = array();
		foreach ($cur_ary as $key => $val) {
			//抓取下一級的分數,並用字串key做排序//用數字key會被覆蓋掉
			$temp_score_ary["_" . $val] = get_score_in_level($ary, $level, $val);
		}
		array_multisort($temp_score_ary, SORT_DESC); //按照下一階等級的分數做排序

		$useful_ary = array();	//將"_"去掉
		foreach ($temp_score_ary as $key => $val) {
			$temp_key = explode("_", $key);
			$useful_ary[$temp_key[1]] = $val;
		}

		$same_score = array();
		if (get_same_in_array($useful_ary)) {
			if (isset($ary[$level + 1])) {
				//抓取此等級中有相同分數的資料
				$same_ary = get_same_in_array($useful_ary);
				foreach ($same_ary as $k => $v) {
					$same_score[$k] = $k;		//暫存需要比對下一層的分數//因為該分數有多筆
				}
			}
		}

		$ret_ary = array();
		$done_ary = array();	//done_ary紀錄已經做過的分數
		foreach ($useful_ary as $key => $val) {	//key = key, val = current score
			if (isset($same_score[$val])) {		//如果是有同分數的陣列
				if (!isset($done_ary[$val])) {	//如果這分數的做過same_ary了就別再做了
					if (isset($ary[$level + 1])) {		//如果有下一階排序資料
						$temp_send_ary = array();
						foreach ($same_ary[$val] as $k => $v) {
							$temp_send_ary[] = $k;	//不用考慮key值
						}
						$sort_next = get_sort_in_next($ary, $temp_send_ary, $level + 1);
						foreach ($sort_next as $k => $v) {
							$ret_ary[] = $v;
						}
						$done_ary[$val] = $val;	//紀錄處理過same的分數
					} else {						//沒有下一階就把same印完
						foreach ($same_ary[$val] as $k => $v) {
							$ret_ary[] = $k;
						}
						$done_ary[$val] = $val;	//紀錄處理過same的分數
					}
				}
			} else {								//不是的話就直接裝入
				$ret_ary[] = $key;
			}
		}

		return $ret_ary;	//應該要回傳 val = key
	}

	function get_score_in_level($ary, $level, $data_key)
	{
		$ret = 0;
		if (isset($ary[$level])) {
			foreach ($ary[$level] as $key => $val) {
				foreach ($val as $k => $v) {
					if ($v == $data_key) {
						$ret = $key;
					}
				}
			}
		}
		return $ret;
	}

	function get_same_in_array($array = "")
	{
		$temp_ary = array();
		$same_ary = array();
		if (!is_array($array)) {
			return false;
		}
		foreach ($array as $key => $val) {
			if (isset($temp_ary[$val])) {
				$same_ary[$val][$temp_ary[$val]] = $val;
				$same_ary[$val][$key] = $val;
			} else {
				$temp_ary[$val] = $key;
			}
		}

		if (count($same_ary) > 0) {
			return $same_ary;
		} else {
			return false;
		}
	}
	/***	
	 *	end of talence_sort_array function	2017.03.29	Talence Editor
	 *
	 *
	 */

	//時間格式
	/***
	 *	stringtodate function		2017.04.11	Talence Editor
	 *
	 *		stringtodate("Y/m/d",string1)	return string2;
	 *
	 *		string1 => need format time time 	ex.'20170329'
	 *		string2 => return string 			ex.'2017/03/29'
	 */
	function stringtodate($format, $string)
	{
		$time = strtotime($string);
		$newformat = date($format, $time);

		return $newformat;
	}
	function datetostring($date)
	{
		preg_match_all('/\d/S', $date, $matches);  //處理日期字串
		$newdate = implode('', $matches[0]);
		return $newdate;
	}
	?>
	</body>

</html>