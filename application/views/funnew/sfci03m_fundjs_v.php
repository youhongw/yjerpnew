<!--<script type="text/javascript" src="<?php echo base_url() ?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
<link type="text/css" href="<?php echo base_url() ?>assets/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url() ?>assets/javascript/jquery/ui/jquery-ui.css" rel="stylesheet" />
-->
<script type="text/javascript">
	//檢查最新編號
	function check_title_no() {
		$('#td002').val("");
		var sfci01 = $('#sfci01').val();
		var td008 = $('#td008').val();
		//alert(sfci01);
		// console.log(sfci01);
		// console.log(td008);
		$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/sfc/sfci03/check_title_no",
				data: {
					sfci01: sfci01,
					td008: td008
				}
			})
			.done(function(msg) {
				$('#td003').val(td008);
				// console.log("check_title_no:" + msg);
				if ($('#sfci01disp').text() != "查無資料")
					$('#td002').val(msg);
			});
	}
// 檢查同一員工代號的時段是否重疊
	function check_hhmm(row_obj) {
		//var row = row_obj.name.replace(/order_product\[(\d+)].*/, '$1');
		//var current_emp = $('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val().trim();
	// 檢查同一員工代號的時段是否重疊1141217
       // 1) 先抓同一筆資料的容器（div row / table row 都適用）
  var $row = $(row_obj).parents().filter(function () {
    return $(this).find('input[name$="[cmsi09d]"]').length > 0;
  }).first();

  // 2) 取得 row index（很多舊程式後面還會用到 row，所以一定要定義）
  var row = '';
  var objName = (row_obj && row_obj.name) ? row_obj.name : '';
  var m = objName.match(/order_product\[(\d+)\]/);
  if (m) {
    row = m[1];
  } else {
    // 如果觸發的欄位沒有 name，就從同列的 cmsi09d 的 name 推回 row
    var cmsName = $row.find('input[name$="[cmsi09d]"]').attr('name') || '';
    var m2 = cmsName.match(/order_product\[(\d+)\]/);
    if (m2) row = m2[1];
  }

  // 3) 取得員工代號（從同一列容器內抓，不用猜 row_item class）
  var current_emp = ($row.length ? $row.find('input[name$="[cmsi09d]"]').val() : '').trim();

		// 如果員工代號為空，不檢查
		if (current_emp == '' || current_emp == '查無資料') {
			//return;
			return true;
		}
	//1141218 add 
 // ★新增：同列的 製令單別/製令單號/工序
  var current_te006 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val().trim();
  var current_te007 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val().trim();
  var current_te008 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val().trim();

  // ★避免欄位尚未選完就誤判：TE006/TE007/TE008 任一空就先不檢查
  if (current_te006 === '' || current_te007 === '' || current_te008 === '') {
    return true;
  }	
		// 收集當前行的時段數據
		var current_te022 = $('#order_product\\[' + row + '\\]\\[TE022\\]').val().trim();
		var current_te023 = $('#order_product\\[' + row + '\\]\\[TE023\\]').val().trim();
		var current_te024 = $('#order_product\\[' + row + '\\]\\[TE024\\]').val().trim();
		var current_te025 = $('#order_product\\[' + row + '\\]\\[TE025\\]').val().trim();
		var current_te026 = $('#order_product\\[' + row + '\\]\\[TE026\\]').val().trim();
		var current_te027 = $('#order_product\\[' + row + '\\]\\[TE027\\]').val().trim();
		
		// 將當前行的時段轉換為秒數區間陣列
		var current_periods = [];
		if (current_te022 && current_te023) {
			current_periods.push(convertTimeRangeToSeconds(current_te022, current_te023));
		}
		if (current_te024 && current_te025) {
			current_periods.push(convertTimeRangeToSeconds(current_te024, current_te025));
		}
		if (current_te026 && current_te027) {
			current_periods.push(convertTimeRangeToSeconds(current_te026, current_te027));
		}
		
		// 檢查所有行
		var has_overlap = false;
		var overlap_rows = [];
		
		for (var i = 1; i <= current_count; i++) {
			// 跳過當前行自己
			if (i == row) continue;
			
			// 取得該行的員工代號
			var other_emp = $('#order_product\\[' + i + '\\]\\[cmsi09d\\]').val();
			//1141218  add 
			// ★改成：同一員工 + 製令單別 + 製令單號 + 工序 才檢查時段
var other_te006 = $('#order_product\\[' + i + '\\]\\[TE006\\]').val();
var other_te007 = $('#order_product\\[' + i + '\\]\\[TE007\\]').val();
var other_te008 = $('#order_product\\[' + i + '\\]\\[TE008\\]').val();

if (
  other_emp && other_emp.trim() === current_emp &&
  (other_te006 || '').trim() === current_te006 &&
  (other_te007 || '').trim() === current_te007 &&
  (other_te008 || '').trim() === current_te008
) {
			//if (!other_emp) continue;
			
			// 如果員工代號相同，檢查時段是否重疊 mark 1141218
			//if (other_emp.trim() == current_emp) {
				var other_te022 = $('#order_product\\[' + i + '\\]\\[TE022\\]').val().trim();
				var other_te023 = $('#order_product\\[' + i + '\\]\\[TE023\\]').val().trim();
				var other_te024 = $('#order_product\\[' + i + '\\]\\[TE024\\]').val().trim();
				var other_te025 = $('#order_product\\[' + i + '\\]\\[TE025\\]').val().trim();
				var other_te026 = $('#order_product\\[' + i + '\\]\\[TE026\\]').val().trim();
				var other_te027 = $('#order_product\\[' + i + '\\]\\[TE027\\]').val().trim();
				
				// 建立其他行的時段區間
				var other_periods = [];
				if (other_te022 && other_te023) {
					other_periods.push(convertTimeRangeToSeconds(other_te022, other_te023));
				}
				if (other_te024 && other_te025) {
					other_periods.push(convertTimeRangeToSeconds(other_te024, other_te025));
				}
				if (other_te026 && other_te027) {
					other_periods.push(convertTimeRangeToSeconds(other_te026, other_te027));
				}
				
				// 檢查兩個時段陣列是否有重疊
				for (var j = 0; j < current_periods.length; j++) {
					for (var k = 0; k < other_periods.length; k++) {
						if (isTimeOverlap(current_periods[j], other_periods[k])) {
							has_overlap = true;
							overlap_rows.push(i);
							break;
						}
					}
					if (has_overlap) break;
				}
			}
		}
		
		// 清除所有紅色標示（同一員工的所有行）
		for (var i = 1; i <= current_count; i++) {
			//var emp = $('#order_product\\[' + i + '\\]\\[cmsi09d\\]').val();
			//if (emp && emp.trim() == current_emp) {
		//1141218 add 
        var emp  = $('#order_product\\[' + i + '\\]\\[cmsi09d\\]').val();
var te006 = $('#order_product\\[' + i + '\\]\\[TE006\\]').val();
var te007 = $('#order_product\\[' + i + '\\]\\[TE007\\]').val();
var te008 = $('#order_product\\[' + i + '\\]\\[TE008\\]').val();

if (
  emp && emp.trim() === current_emp &&
  (te006 || '').trim() === current_te006 &&
  (te007 || '').trim() === current_te007 &&
  (te008 || '').trim() === current_te008
) {		
				
				$('#order_product\\[' + i + '\\]\\[TE022\\]').css('background-color', '#FFFFE4');
				$('#order_product\\[' + i + '\\]\\[TE023\\]').css('background-color', '#FFFFE4');
				$('#order_product\\[' + i + '\\]\\[TE024\\]').css('background-color', '#FFFFE4');
				$('#order_product\\[' + i + '\\]\\[TE025\\]').css('background-color', '#FFFFE4');
				$('#order_product\\[' + i + '\\]\\[TE026\\]').css('background-color', '#FFFFE4');
				$('#order_product\\[' + i + '\\]\\[TE027\\]').css('background-color', '#FFFFE4');
			   // $('#message').text('修改正確,可存檔.');
			}
		}
		
		// 如果有重疊，標示紅色並提示
		if (has_overlap) {
			// 標示當前行為紅色
			$('#order_product\\[' + row + '\\]\\[TE022\\]').css('background-color', '#FFB6C1');
			$('#order_product\\[' + row + '\\]\\[TE023\\]').css('background-color', '#FFB6C1');
			$('#order_product\\[' + row + '\\]\\[TE024\\]').css('background-color', '#FFB6C1');
			$('#order_product\\[' + row + '\\]\\[TE025\\]').css('background-color', '#FFB6C1');
			$('#order_product\\[' + row + '\\]\\[TE026\\]').css('background-color', '#FFB6C1');
			$('#order_product\\[' + row + '\\]\\[TE027\\]').css('background-color', '#FFB6C1');
			
			// 標示重疊的其他行為紅色
			for (var i = 0; i < overlap_rows.length; i++) {
				var overlap_row = overlap_rows[i];
				$('#order_product\\[' + overlap_row + '\\]\\[TE022\\]').css('background-color', '#FFB6C1');
				$('#order_product\\[' + overlap_row + '\\]\\[TE023\\]').css('background-color', '#FFB6C1');
				$('#order_product\\[' + overlap_row + '\\]\\[TE024\\]').css('background-color', '#FFB6C1');
				$('#order_product\\[' + overlap_row + '\\]\\[TE025\\]').css('background-color', '#FFB6C1');
				$('#order_product\\[' + overlap_row + '\\]\\[TE026\\]').css('background-color', '#FFB6C1');
				$('#order_product\\[' + overlap_row + '\\]\\[TE027\\]').css('background-color', '#FFB6C1');
			}
			
// 在檢查到重疊時

    // var msg = '員工代號 [' + current_emp + '] 的第工時段有重疊!\n請檢查第 ' + overlap_msg;
        
        // 使用 setTimeout 確保 alert 關閉後才執行後續動作
        setTimeout(function() {
           // alert('警告：員工代號 [' + current_emp + '] 的報工時段有重疊！\n請檢查第 ' + row + ' 行與第 ' + overlap_rows.join(', ') + ' 行的時段設定。');
		//	$('#message').text('警告：員工代號 [' + current_emp + '] 的報工時段有重疊！\n請檢查第 ' + row + ' 行與第 ' + overlap_rows.join(', ') + ' 行的時段設定。否則無法存檔');
			$('#message').text(
  '警告：員工[' + current_emp + '] 製令[' + current_te006 + '-' + current_te007 + '] 工序[' + current_te008 + '] 的報工時段有重疊！\n' +
  '請檢查第 ' + row + ' 行與第 ' + overlap_rows.join(', ') + ' 行的時段設定。否則無法存檔'
);
			// row_obj.focus();
        }, 10);
        
        return false;  // 👈 重要:返回 false
   
    
   
			/*  setTimeout(function() {
			  
			alert('警告：員工代號 [' + current_emp + '] 的報工時段有重疊！\n請檢查第 ' + row + ' 行與第 ' + overlap_rows.join(', ') + ' 行的時段設定。');
			 row_obj.focus();			
			 
        }, 10);*/
			 
   
		}
		return true;
	}
$('#commentForm').on('submit', function(e){
  $('#message').text('');   // 清掉舊訊息（可留可不留）

  var ok = true;

  // 逐列檢查：用 cmsi09d 找到每一列的員工欄位當作 row_obj 傳入
  $('input[name$="[cmsi09d]"]').each(function(){
    if (check_hhmm(this) === false) {
      ok = false;
      return false; // break each
    }
  });

  if (!ok) {
    e.preventDefault();  // ✅ 擋住送出
    // 可選：捲到訊息或第一個紅色欄位
    // $('html,body').animate({scrollTop: $('#message').offset().top - 50}, 200);
  }
});
	// 將時分 HHMM 轉換為秒數區間 {start: xxx, end: xxx}
	function convertTimeRangeToSeconds(start_hhmm, end_hhmm) {
		var start_str = String(start_hhmm).padStart(4, '0');
		var end_str = String(end_hhmm).padStart(4, '0');
		
		var start_hour = parseInt(start_str.substring(0, 2));
		var start_min = parseInt(start_str.substring(2, 4));
		var start_sec = start_hour * 3600 + start_min * 60;
		
		var end_hour = parseInt(end_str.substring(0, 2));
		var end_min = parseInt(end_str.substring(2, 4));
		var end_sec = end_hour * 3600 + end_min * 60;
		
		// 跨日處理：如果結束時間小於開始時間，結束時間加一天
		if (end_sec < start_sec) {
			end_sec += 86400;
		}
		
		return {start: start_sec, end: end_sec};
	}

	// 判斷兩個時段區間是否重疊
	function isTimeOverlap(period1, period2) {
		// 區間重疊判斷：period1.start < period2.end AND period1.end > period2.start
		return (period1.start < period2.end && period1.end > period2.start);
	}

	
	function chang_line() {
		var vsfc01 = $('#sfci01').val();
		if (vsfc01.length >= 2) {
			vsfc01 = vsfc01.substr(0, 2);
			remove_row()
		}
	}

	function remove_row() {
		// var table = document.getElementById("order_product");
		// var tbodyRowCount = document.getElementById("order_product").rows.length - 2;
		// console.log('有幾列：' + current_count);

		for (var i = current_count; i >= 1; i--) {
			// console.log('移除_' + i + ":" + i);
			$("#product_row_" + i).remove();
		}
	}

	//查詢品名規格開視窗 copi06 //下拉選單$('.close').click($.unblockUI);
	// function set_catcomplete(row) {
	// 	$('#order_product\\[' + row + '\\]\\[tc004\\]').catcomplete({
	// 		autoFocus: false,
	// 		delay: 1000,
	// 		minLength: 1,
	// 		source: function(req, add) {
	// 			var smb001 = $('#order_product\\[' + row + '\\]\\[tc004\\]').val();
	// 			$('#order_product\\[' + row + '\\]\\[tg004\\]').attr('onchange', '');
	// 			console.log(smb001);
	// 			$.ajax({
	// 				url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd_invi02/' + encodeURIComponent(smb001),
	// 				cache: false,
	// 				dataType: 'json',
	// 				type: 'POST',
	// 				data: req,
	// 				success: function(data) {
	// 					if (data.response == "true") {
	// 						add(data.message);
	// 					}
	// 				}
	// 			});
	// 		},
	// 		select: function(event, ui) {
	// 			clear_row(row);
	// 			console.log(ui.item.value);
	// 			if (ui.item.value != "查無資料") {
	// 				$('#order_product\\[' + row + '\\]\\[tc004\\]').val(ui.item.value1);
	// 				$('#order_product\\[' + row + '\\]\\[tc005\\]').val(ui.item.value2);
	// 				$('#order_product\\[' + row + '\\]\\[tc006\\]').val(ui.item.value3);
	// 				$('#order_product\\[' + row + '\\]\\[tc010\\]').val(ui.item.value4);
	// 				$('#order_product\\[' + row + '\\]\\[tc007\\]').val(ui.item.value5);
	// 				$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(ui.item.value6);
	// 			}
	// 			return false;
	// 		},

	// 		change: function(event, ui) {
	// 			$('#order_product\\[' + row + '\\]\\[tc004\\]').attr('onchange', 'check_invi02d(this)');
	// 			check_invi02d(row); //1060713 新增
	// 			//check_invi02d($('#order_product\\['+row+'\\]\\[tc004\\]').val());
	// 			return false;
	// 		}
	// 		//focus: function(event, ui) {
	// 		//	return false;
	// 		//}
	// 	});

	// 	//明細計算
	// 	$('input[name=\'order_product[' + row + '][tc008]\'],input[name=\'order_product[' + row + '][tc011]\'],input[name=\'order_product[' + row + '][tc026]\'],input[name=\'order_product[' + row + '][tc030]\'],input[name=\'order_product[' + row + '][tc031]\']').focusout(function() {
	// 		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
	// 		var input_1 = $('input[name=\'order_product[' + n + '][tc008]\']').val() * 1;
	// 		var input_2 = $('input[name=\'order_product[' + n + '][tc011]\']').val() * 1;
	// 		var input_3 = $('input[name=\'order_product[' + n + '][tc026]\']').val() / 100;
	// 		var get_total = input_1 * input_2 * input_3;
	// 		$('input[name=\'order_product[' + n + '][tc012]\']').val(get_total);
	// 		//合計資料
	// 		totalSum();

	// 	});
	// 	//數量游標停在 0 之後 
	// 	$('input[name=\'order_product[' + row + '][tc008]\']').focus(function() {
	// 		var real_value = $(this)[0].defaultValue;
	// 		if ($(this).val() == real_value)
	// 			$(this).val(real_value);
	// 		if ($(this).val() == '0')
	// 			$(this).val('');
	// 	});

	// 	//單價  游標停在 0 之後
	// 	$('input[name=\'order_product[' + row + '][tc011]\']').focus(function() {
	// 		var real_value = $(this)[0].defaultValue;
	// 		if ($(this).val() == real_value)
	// 			$(this).val(real_value);
	// 		if ($(this).val() == '0')
	// 			$(this).val('');
	// 	});
	// 	//預設預交日期
	// 	$('input[name=\'order_product[' + row + '][tc013]\']').focus(function() {
	// 		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
	// 		var today = new Date();
	// 		var dd = today.getDate();
	// 		var mm = today.getMonth() + 1; //January is 0!
	// 		var yyyy = today.getFullYear();
	// 		if (dd < 10) {
	// 			dd = '0' + dd
	// 		}

	// 		if (mm < 10) {
	// 			mm = '0' + mm
	// 		}

	// 		today = yyyy + '/' + mm + '/' + dd;
	// 		if ($('input[name=\'order_product[' + n + '][tc013]\']').val() == '') {
	// 			$('input[name=\'order_product[' + n + '][tc013]\']').val(today);
	// 		}
	// 	});
	// 	//單身品號圖1視窗 (客戶單價計價檔copi02) 12, 取12 0-11字 product_row_1 取1開始
	// 	//以blockUI Demo 為例，但呈現方式並不像blockUI使用的是同層級的處理，主要overlay的部份為 parent 視窗，而內容頁面為children頁面
	// 	$('#order' + row).click(function() {
	// 		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
	// 		selected_row = row;
	// 		console.log($('#copi01').val());
	// 		if ($('#copi01').val() == '') {
	// 			alert('請先選擇客戶代號!');
	// 			return;
	// 		}

	// 		$('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cop/copi02/display_child/" + $("#copi01").val());
	// 		$.blockUI({
	// 			css: {
	// 				top: '15%',
	// 				left: '25%',
	// 				height: '75%',
	// 				width: '75%',
	// 				overflow: 'auto',
	// 				'-webkit-border-radius': '10px',
	// 				'-moz-border-radius': '10px',
	// 				'-khtml-border-radius': '10px',
	// 				'border-radius': '10px',
	// 			},
	// 			message: $('#divFcopi02'),
	// 			onOverlayClick: clear_copi02disp_sql
	// 		});
	// 		$('.close').click($.unblockUI);
	// 	});
	// }
	//開圖1視窗(客戶單價計價檔copi02)回傳值
	function addcopi02disp(me001, me002, me003, me004, me005, me006, me007) {
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').val(me001); //品號
		$('#order_product\\[' + selected_row + '\\]\\[tc005\\]').val(me002); //品名
		$('#order_product\\[' + selected_row + '\\]\\[tc006\\]').val(me003); //規格
		$('#order_product\\[' + selected_row + '\\]\\[tc010\\]').val(me004); //單位
		$('#order_product\\[' + selected_row + '\\]\\[tc011\\]').val(me005); //單價
		$('#order_product\\[' + selected_row + '\\]\\[tc007\\]').val(me006); //庫別
		$('#order_product\\[' + selected_row + '\\]\\[tc007disp\\]').val(me007); //庫別名稱

		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
		});
	}

	function clear_copi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cop/copi02/clear_sql"
		});
	}
	//查詢庫別下拉選單
	// function set_catcomplete2(row) {
	// 	console.log(row);
	// 	$('#order_product\\[' + row + '\\]\\[tc007\\]').catcomplete({
	// 		autoFocus: false,
	// 		delay: 1000,
	// 		minLength: 1,
	// 		source: function(req, add) {
	// 			var smb002 = $('#order_product\\[' + row + '\\]\\[tc007\\]').val();
	// 			$('#order_product\\[' + row + '\\]\\[tc007\\]').attr('onchange', '');
	// 			$.ajax({
	// 				url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb002),
	// 				cache: false,
	// 				dataType: 'json',
	// 				type: 'POST',
	// 				data: req,
	// 				success: function(data) {
	// 					if (data.response == "true") {
	// 						add(data.message);
	// 					}
	// 				}
	// 			});
	// 		},
	// 		select: function(event, ui) {
	// 			clear_row(row);
	// 			if (ui.item.value != "查無資料") {
	// 				$('#order_product\\[' + row + '\\]\\[tc007\\]').val(ui.item.value1);
	// 				$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(ui.item.value2);
	// 			}
	// 			return false;
	// 		},
	// 		change: function(event, ui) {
	// 			$('#cmsi03').attr('onchange', 'check_cmsi03d(this)');
	// 			check_cmsi03d(row); //1060713 新增
	// 			//check_cmsi03d($('#order_product\\['+row+'\\]\\[tc007\\]').val());
	// 			return false;
	// 		}
	// 		//focus: function(event, ui) {
	// 		//	return false;
	// 		//}
	// 	});
	// }
</script>
<script type="text/javascript">
	// <!--  //合計金額

	function totalSum() {

		var sumTotal = 0;
		var sumQty = 0;
		sumQty1 = 0;
		sumQty2 = 0;
		var product_row = 0;
		var sumamt = 0;
		sumTax = 0;
		tax = 0.00;
		vtax = 0.00;
		var index1 = 0;
		index2 = 0;
		index3 = 0;
		index4 = 0;
		var price = 0;
		qty = 0;
		qty1 = 0;
		qty2 = 0;
		temp1 = 0;
		//訂單金額 tb029
		$(".total_price").each(function(index, element) {
			price = $('input[name=\'order_product[' + index1 + '][tc012]\']').val();
			index1 = index1 + 1;
			if (isNaN(price)) {
				price = 0;
			}
			sumamt += parseFloat(price);
			//   console.log(sumamt);
		});
		if (typeof($('input[name=\'order_product[' + index1 + '][tc012]\']').val()) == 'undefined') {
			price = 0;
		} else {
			price = $('input[name=\'order_product[' + index1 + '][tc012]\']').val();
		}
		if (isNaN(price) || price == null || price == '') {
			price = 0;
		}
		sumamt += parseFloat(price);
		$('#tb029').val(sumamt);
		//  console.log(sumamt);
		//end 訂單金額合計

		//稅金 tb030
		tax = $('input[name=\'tb041\']').val();
		$('#tb030').val(Math.round(sumamt * tax));
		var sumTax = Math.round(sumamt * tax);
		var vtax = 1 + parseFloat(tax);
		//	if ($('select[name=\'tb016\']').val()=='1') {$('#tb029').val()=Math.round(sumamt/parseFloat(vtax));$('#tb030').val()=Math.round(sumamt-$('#tb029').val());}
		if ($('select[name=\'tb016\']').val() == '1') {
			$('#tb029').val(Math.round(sumamt / parseFloat(vtax)));
			temp1 = Math.round(sumamt - $('#tb029').val());
			$('#tb030').val(temp1);
		}
		var sumtot = Math.round(sumamt + sumTax);
		$('#tb029').val(sumamt);
		$('#tb030').val(sumTax);
		$('#tc2930').val(Math.round(sumtot)); //合計金額
		//  console.log(sumtot);
		//數量合計 tb031
		$(".total_qty").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index2 + '][tc008]\']').val())) {
				qty = 0;
			} else {
				qty = $('input[name=\'order_product[' + index2 + '][tc008]\']').val();
			}
			index2 = index2 + 1;
			if (isNaN(qty) || qty == null || qty == '') {
				qty = 0;
			}
			sumQty += parseFloat(qty);
			// console.log(sumQty);
		});
		if (typeof($('input[name=\'order_product[' + index2 + '][tc008]\']').val()) == 'undefined') {
			qty = 0;
		} else {
			qty = $('input[name=\'order_product[' + index2 + '][tc008]\']').val();
		}
		if (isNaN(qty) || qty == null || qty == '') {
			qty = 0;
		}
		sumQty += parseFloat(qty);
		$('#tb031').val(sumQty);
		// console.log(sumQty);
		//end 數量合計

		//總毛重合計 tb043
		$(".total_qty1").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index3 + '][tc030]\']').val())) {
				qty1 = 0;
			} else {
				qty1 = $('input[name=\'order_product[' + index3 + '][tc030]\']').val();
			}
			index3 = index3 + 1;
			if (isNaN(qty1) || qty1 == null || qty1 == '') {
				qty1 = 0;
			}
			sumQty1 += parseFloat(qty1);
			//  console.log(sumQty1);
		});
		if (typeof($('input[name=\'order_product[' + index3 + '][tc030]\']').val()) == 'undefined') {
			qty1 = 0;
		} else {
			qty1 = $('input[name=\'order_product[' + index3 + '][tc030]\']').val();
		}
		if (isNaN(qty1) || qty1 == null || qty1 == '') {
			qty1 = 0;
		}
		sumQty1 += parseFloat(qty1);
		$('#tb043').val(sumQty1);
		// console.log(sumQty1);
		//end 總毛重合計

		//總材積合計 tb044
		$(".total_qty2").each(function(index, element) {
			if (isNaN($('input[name=\'order_product[' + index4 + '][tc031]\']').val())) {
				qty2 = 0;
			} else {
				qty2 = $('input[name=\'order_product[' + index4 + '][tc031]\']').val();
			}
			index4 = index4 + 1;
			if (isNaN(qty2) || qty2 == null || qty2 == '') {
				qty2 = 0;
			}
			sumQty2 += parseFloat(qty2);
			//   console.log(sumQty2);
		});
		if (typeof($('input[name=\'order_product[' + index4 + '][tc031]\']').val()) == 'undefined') {
			qty2 = 0;
		} else {
			qty2 = $('input[name=\'order_product[' + index4 + '][tc031]\']').val();
		}
		if (isNaN(qty2) || qty2 == null || qty2 == '') {
			qty2 = 0;
		}
		sumQty2 += parseFloat(qty2);
		$('#tb044').val(sumQty2);
		// console.log(sumQty2);
		//end 總材積合計

	}
	//-->
</script>

<script>
	function del_detail(tc001, tc002, tc003, row) {
		if (confirm("確定刪除細項:" + tc001 + "-" + tc002 + "-" + tc003 + "?")) {
			$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>index.php/sfc/sfci03/del_detail_ajax",
					data: {
						tc001: tc001,
						tc002: tc002,
						tc003: tc003
					}
				})
				.done(function(msg) {
					if (msg) {
						// alert("刪除細項:" + tc001 + "-" + tc002 + "-" + tc003 + " 成功!" + msg);
						$("#product_row_" + row).remove();
						// totalSum();
						//	current_count -=1;
						//	addItem();
					} else {
						alert("刪除細項:" + tc001 + "-" + tc002 + "-" + tc003 + " 失敗!");
					}
				});
		}
	}

	function clear_row(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log("clear_row_in");
		// for (var k = 1; k <= 10; k++) { //k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		// 	// $('#product-row' + row + ' input.order_product_TE00' + k).val("");
		// 	// $('#product-row' + row + ' input.order_product_TE0' + k).val("");
		// 	// $('#product-row' + row + ' input.order_product_td' + k).val("");
		// 	$('#order_product\\[' + k + '\\]\\[TE005\\]').val("");
		// 	$('#order_product\\[' + k + '\\]\\[TE005disp\\]').val("");
		// }
	}

	function tagscheck(a) {
		var lng = document.getElementsByTagName("tr").length;

		for (i = 0; i < lng; i++) {
			var temp = document.getElementsByTagName("tr")[i];
			if (a == temp) {
				//选中的标签样式
				temp.style.background = "#f3bf4d";

			} else {
				//恢复原状
				temp.style.background = "";
			}
		}

	}
</script>
<script>
	/***Talence 更新自動focus***/
	$(document).keydown(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (event.altKey && (keycode == '65')) { //tab1 a
			setTimeout(function() {
				$('input[name="cmsi05"]').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '66')) { //tab2 b
			setTimeout(function() {
				$('#tb010').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '67')) { //tab3 c
			setTimeout(function() {
				$('#mv032').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '71')) { //tab4 g
			setTimeout(function() {
				$('#mv048').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '72')) { //tab5 h
			setTimeout(function() {
				$('#mv048').focus();
			}, 100);
		}
		if (event.altKey && (keycode == '73')) { //tab6 i
			setTimeout(function() {
				$('#mv049').focus();
			}, 100);
		}
		//跳明細
		if (event.altKey && (keycode == '89')) { //tab6 y
			setTimeout(function() {
				$('input[name=\'order_product[1][tc004]\']').focus();
			}, 100);
		}
		//新增一筆明細 alt+w keycode == '87' || keycode == '119'
		if (event.altKey && (keycode == '40' || keycode == '45')) {
			addItem();
		}
	});
	//-->
</script>
<script>
	//查詢產品視窗
	function search_invi02d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;
		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '70%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFinvi02d'),
			onOverlayClick: clear_invi02disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		// clear_row(selected_row);
		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[tc005\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[tc006\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[tc010\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[tc007\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[tc007disp\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[tc004\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function mult_addinvi02ddisp(mb001, mb002, mb003, mb004, mb005, mb006) {
		// console.log(mb001);
		// console.log(current_count);
		$('#order_product\\[' + current_count + '\\]\\[tc004\\]').val(mb001);
		$('#order_product\\[' + current_count + '\\]\\[tc005\\]').val(mb002);
		$('#order_product\\[' + current_count + '\\]\\[tc006\\]').val(mb003);
		$('#order_product\\[' + current_count + '\\]\\[tc010\\]').val(mb004);
		$('#order_product\\[' + current_count + '\\]\\[tc007\\]').val(mb005);
		$('#order_product\\[' + current_count + '\\]\\[tc007disp\\]').val(mb006);
		addItem();
	}

	function clear_invi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	//查詢製令性質開視窗moci01
	//查詢製令性質開視窗moci01 //下拉選單$('.close').click($.unblockUI);
	$(document).ready(function() {
		$("#Showmoci01disp").click(function() {
			// console.log('comein');
			$.blockUI({
				theme: true,
				themedCSS: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '30%',
					overflow: 'hidden',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					'-khtml-border-radius': '10px',
					'border-radius': '10px',
				},
				message: $('#divFmoci01'),
				onOverlayClick: clear_moci01disp_sql
			});
			$('.close').click($.unblockUI);
			// console.log('end');
		});
	});

	function search_sfci03a_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		// console.log(row);
		selected_row = row;
		$.blockUI({
			//theme: true,
			message: $('#divFmoci01'),
			//themedCSS: {
				css: {
				top: '15%',
				left: '50%',
				height: '75%',
				width: '30%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
				'.ui-dialog .ui-dialog-content': '100%'
			},
			onOverlayClick: clear_moci01disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function clear_moci01disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/moc/moci01/clear_sql1"
		});
	}

	function addmoci01disp(MQ001, MQ002) {
		// alert(MQ002);
		// $('#mq001').val(MQ001);
		// $('#mq001_disp').text(MQ002);
		$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(MQ001);
		// $('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]').val(MQ002);
		$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').focus();

		if (!$('#mq002').val()) {
			$('#mq002').val(<?php echo date("Ymd") . '001'; ?>);
		}

		$('#mq002').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/printdetailc"
		});
	}


	//查詢製令製程視窗 1141204
	function search_sfci03_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);

		$('#moci01_disp').attr('src', "<?php echo base_url() ?>index.php/sfc/sfci03m/display_child/0/0/" + te006 + "/" + te007 + "/");

		$.blockUI({
			//theme: true,
			//themedCSS: {
			    css: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '80%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFsfci03'),
			onOverlayClick: clear_sfci03disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addsfci03disp(mb001, mb002, mb003, mb004, mb005, mb006, mb007, mb008, mb009) {
		// clear_row(selected_row);
		// console.log('reback---------');
		$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE008\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[TE018\\]').val(mb007);
		$('#order_product\\[' + selected_row + '\\]\\[TE019\\]').val(mb008);
		$('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb009);
		$('#order_product\\[' + selected_row + '\\]\\[TE029\\]').focus();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03/clear_sql_sfcta"
		});
	}
     function addsfci03mdisp(mb001, mb002, mb003, mb004, mb005, mb006, mb007, mb008, mb009) {
		// clear_row(selected_row);
		// console.log('reback---------');
		$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE008\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val(mb006);
		$('#order_product\\[' + selected_row + '\\]\\[TE018\\]').val(mb007);
		$('#order_product\\[' + selected_row + '\\]\\[TE019\\]').val(mb008);
		$('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb009);
		$('#order_product\\[' + selected_row + '\\]\\[TE029\\]').focus();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03m/clear_sql_sfcta"
		});
	}
	function clear_sfci03disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/sfc/sfci03m/clear_sql_sfcta"
		});
	}

	//直接輸入跳出 實際模穴數
	function check_sfci17(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE017\\]').val();
		var smb002 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		var smb003 = $('#order_product\\[' + row + '\\]\\[TE029\\]').val();

		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');

			return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
		}

		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/sfc/sfci17/lookup_body_check/' + encodeURIComponent(smb001) + "/" + encodeURIComponent(smb002) + "/" + encodeURIComponent(smb003) + "/",
				data: {
					mb001: smb001,
					mb002: smb002,
					mb003: smb003
				}
			})
			.done(function(msg) {
				// console.log('check_sfci17 output:' + msg);
				//回傳值顯示處理
				$('#order_product\\[' + row + '\\]\\[TE032\\]').val(msg);
				// return $('#order_product\\[' + row + '\\]\\[TE032\\]').focus();
			});
	}

	function check_sfcta(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE007\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE008\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE018\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE006\\]').focus();
		}

		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/moc/moci01/check_sfci_no/' + encodeURIComponent(smb001),
				data: {
					mb001: smb001,
				}
			})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TE006\\]').val('');
					return $('#order_product\\[' + row + '\\]\\[TE006\\]').focus();
				} else {
					return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
				}

			});
	}
	//---------------------------------------
	//查詢製程代號視窗
	function search_cmsi19_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		// te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		// te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}

		//查詢此ID是否存在 注塑使用
		/*if (document.getElementById('order_product[' + selected_row + '][TE032]')) {
			if ($('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val() == '') {
				alert('請先選擇產品品號!');
				return setTimeout(function() { //focus跳不回去時使用
					$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').focus();
				}, 100);
			}
		}*/


		$('#cmsi19_disp').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi19/displaynew_child/0/0/" + $("#cmsi04").val());

		$.blockUI({
			//theme: true,
			//themedCSS: {
				css: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '70%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi19'),
			onOverlayClick: clear_cmsi19disp_sql
		});
		$('.close').click($.unblockUI);
	}
    //查詢製程代號視窗 1141225 new 
	function search_cmsi19new_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		// te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		// te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}

		//查詢此ID是否存在 注塑使用
		/*if (document.getElementById('order_product[' + selected_row + '][TE032]')) {
			if ($('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val() == '') {
				alert('請先選擇產品品號!');
				return setTimeout(function() { //focus跳不回去時使用
					$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').focus();
				}, 100);
			}
		}*/
		var smb002 = ($('#cmsi04').val() || '').toString().trim();
          var smb001 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		var ste006 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		var ste007 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		var ste008 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		console.log(ste007);
      //  alert('請先選擇產1111品品號!');
		//$('#cmsi19_disp').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi19/displaynew_child/0/0/" + $("#cmsi04").val());
		//$('#cmsi19new_disp').attr('src', '<?php echo base_url() ?>index.php/cms/cmsi19new/displaynew_child/' + encodeURIComponent(smb001) + '/' ...
		$('#cmsi19new_disp').attr('src', '<?php echo base_url() ?>index.php/cms/cmsi19new/displaynew_child/'+ encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/'
			+ encodeURIComponent(ste006) + '/' + encodeURIComponent(ste007) + '/'
			+ encodeURIComponent(ste008) + '/');
		$.blockUI({
			//theme: true,
			//themedCSS: {
				css: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '70%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi19new'),
			onOverlayClick: clear_cmsi19newdisp_sql
		});
		$('.close').click($.unblockUI);
	}
	 //查詢工序視窗 1141226 new 
	function search_cmsi19d8_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}

		var smb002 = ($('#cmsi04').val() || '').toString().trim();
          var smb001 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		var ste006 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		var ste007 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		var ste008 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		var ste009 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		
      //  alert('請先選擇產1111品品號!');
		//$('#cmsi19_disp').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi19/displaynew_child/0/0/" + $("#cmsi04").val());
		//$('#cmsi19new_disp').attr('src', '<?php echo base_url() ?>index.php/cms/cmsi19new/displaynew_child/' + encodeURIComponent(smb001) + '/' ...
		$('#cmsi19new_disp').attr('src', '<?php echo base_url() ?>index.php/cms/cmsi19d8/display19d8_child/'+ encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/'
			+ encodeURIComponent(ste006) + '/' + encodeURIComponent(ste007) + '/'
			+ encodeURIComponent(ste008) + '/');
		$.blockUI({
			//theme: true,
			//themedCSS: {
				css: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '70%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi19new'),
			onOverlayClick: clear_cmsi19newdisp_sql
		});
		$('.close').click($.unblockUI);
	}
	function addcmsi19disp(mb001, mb002) {
		// clear_row(selected_row);
		// console.log('reback---------');
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE029\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql_term"
		});
	}
	//製程視窗
    function addcmsi19newdisp(mb001, mb002, mb003, mb004, mb005) {
		// clear_row(selected_row);
		 console.log(mb005);
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE008\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb003);
	//	$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(mb004);
	//	$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').focus();
		$.ajax({
			method: "POST",
			//url: "<?php echo base_url() ?>index.php/cms/cmsi19new/clear_sql_term"
		});
	}
	 function addcmsi19d8disp(mb001, mb002, mb003,mb004,mb005) {
		// clear_row(selected_row);
		// console.log('reback---------');
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE008\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE009disp\\]').val(mb003);
		//$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val(mb004);
		//$('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val(mb005);
		$('#order_product\\[' + selected_row + '\\]\\[TE008\\]').focus();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19d8/clear_sql_term"
		});
	}
	function clear_cmsi19disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19/clear_sql_term"
		});
	}
	function clear_cmsi19newdisp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi19new/clear_sql_term"
		});
	}

	function check_cmsi19(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var smb001 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
		}

		var smb002 = $('#cmsi04').val();
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE009disp\\]'); //改變顏色用
		$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi19/check_cmsi04',
				data: {
					mb001: smb001,
					mb002: smb002,
				}
			})
			.done(function(msg) {
				// console.log('output_check_cmsi19:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('查無資料');
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE029\\]').focus();
				}

			});
	}
	//---------------------------------------
	//查詢品號類別開視窗invi02
	function search_invi02_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;

		// te006 = $('#order_product\\[' + selected_row + '\\]\\[TE006\\]').val();
		// te007 = $('#order_product\\[' + selected_row + '\\]\\[TE007\\]').val();
		// console.log("row:" + row);
		// console.log("te006:" + te006);
		// console.log("te007:" + te007);
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}

		$('#invi02_disp').attr('src', "<?php echo base_url() ?>index.php/inv/invi02/display_childa/0/0/" + $("#cmsi04").val());

		$.blockUI({
			theme: true,
			themedCSS: {
				top: '15%',
				left: '15%',
				height: '75%',
				width: '80%',
				overflow: 'auto',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFinvi02'),
			onOverlayClick: clear_invi02disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addinvi02adisp(mb001, mb002, mb003, mb004) {
		// clear_row(selected_row);
		// console.log('reback---------');
		// var paragraph = document.querySelector('#da001_disp');
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE018\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE017\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE018\\]').val(mb002);
		$('#order_product\\[' + selected_row + '\\]\\[TE019\\]').val(mb003);
		$('#order_product\\[' + selected_row + '\\]\\[TE020\\]').val(mb004);
		$('#order_product\\[' + selected_row + '\\]\\[TE030\\]').focus();

		//查詢此ID是否存在 注塑使用
		if (document.getElementById('order_product[' + selected_row + '][TE032]')) {
			if ($('#sfci01').val() == 'D504') {
				return setTimeout(function() { //focus跳不回去時使用
					$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').focus();
				}, 100);
			}
		}


		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function clear_invi02disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
		});
	}

	function check_invi02(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var smb001 = $('#order_product\\[' + row + '\\]\\[TE017\\]').val();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE018\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE017\\]').focus();
		}

		var smb002 = $('#cmsi04').val();
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE018\\]'); //改變顏色用
		$.ajax({
			method: "POST",
			url: '<?php echo base_url(); ?>index.php/inv/invi02/checkkey2',
			dataType: 'json',
			data: {
				mb001: smb001
			},
			success: function(data) {
				if (data.response) {
					paragraph.style.color = "black"; //改變顏色用
					// $('#cmsi05').val(sme001);
					// $('#cmsi05disp').text(data.message[0].value2);

					$('#order_product\\[' + row + '\\]\\[TE017\\]').val(data.MB001);
					$('#order_product\\[' + row + '\\]\\[TE018\\]').val(data.MB002);
					$('#order_product\\[' + row + '\\]\\[TE019\\]').val(data.MB003);
					$('#order_product\\[' + row + '\\]\\[TE020\\]').val(data.MB004);
					paragraph.style.color = "black"; //改變顏色用

					//查詢此ID是否存在 注塑使用
					if (document.getElementById('order_product[' + row + '][TE032]')) {
						if ($('#sfci01').val() == 'D504') {
							return setTimeout(function() { //focus跳不回去時使用
								$('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
							}, 100);
						}
					}

					return $('#order_product\\[' + row + '\\]\\[TE030\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE018\\]').val('查無品號');
					$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE017\\]').focus();
				}
			}
		});
		// .done(function(msg) {
		// 	// console.log('output_check_invi02:' + msg);
		// 	//回傳值顯示處理
		// 	if (msg == 'N') {
		// 		$('#order_product\\[' + row + '\\]\\[TE017\\]').val('');
		// 		$('#order_product\\[' + row + '\\]\\[TE018\\]').val('查無品號');
		// 		$('#order_product\\[' + row + '\\]\\[TE019\\]').val('');
		// 		$('#order_product\\[' + row + '\\]\\[TE020\\]').val('');
		// 		paragraph.style.color = "red"; //改變顏色用
		// 		return $('#order_product\\[' + row + '\\]\\[TE017\\]').focus();
		// 	} else {
		// 		// var str = (msg.split("_"));

		// 		$('#order_product\\[' + row + '\\]\\[TE017\\]').val(str[0]);
		// 		$('#order_product\\[' + row + '\\]\\[TE018\\]').val(str[1]);
		// 		$('#order_product\\[' + row + '\\]\\[TE019\\]').val(str[2]);
		// 		$('#order_product\\[' + row + '\\]\\[TE020\\]').val(str[3]);
		// 		paragraph.style.color = "black"; //改變顏色用
		// 		return $('#order_product\\[' + row + '\\]\\[TE030\\]').focus();
		// 	}

		// }
		// );
	}
	//---------------------------------------
	function count_pcs(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}
		var rb = $('#order_product\\[' + row + '\\]\\[TE028\\]').val();
		var bd = $('#order_product\\[' + row + '\\]\\[TE031\\]').val();
		var all = $('#order_product\\[' + row + '\\]\\[TE011\\]').val();

		$('#order_product\\[' + row + '\\]\\[TE0311\\]').val(parseInt(rb) + parseInt(bd));
		$('#order_product\\[' + row + '\\]\\[TE0312\\]').val(parseInt(all) - (parseInt(rb) + parseInt(bd)));

	}

	function count_moldca(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}
		var rm = $('#order_product\\[' + row + '\\]\\[TE032\\]').val(); //實際模穴數
		var ms = $('#order_product\\[' + row + '\\]\\[TE033\\]').val(); //起始模數
		var md = $('#order_product\\[' + row + '\\]\\[TE034\\]').val(); //結束模數

		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE0111\\]'); //改變顏色用
		paragraph.style.color = "red"; //改變顏色用

		if (!rm) { //實際模穴數			
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('實際模穴數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE032\\]').focus();
			}, 100);

		}
		if (!ms) { //起始模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('起始模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE033\\]').focus();
			}, 100);
		}
		if (!md) { //結束模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		}

		var moldca = parseInt(md) - parseInt(ms);

		if (moldca <= 0) {
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數小於起始模數');
			// $('input[name=order_product\\[' + row + '\\]\\[TE0111\\]]').val('結束模數小於起始模數');

			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		} else {
			paragraph.style.color = "black"; //改變顏色用
			var Qcount = parseInt(rm) * moldca;

			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val(moldca);
			$('#order_product\\[' + row + '\\]\\[TE0312\\]').val(Qcount);
		}

	}

	function Qcount(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}
		var rm = $('#order_product\\[' + row + '\\]\\[TE032\\]').val(); //實際模穴數
		var ms = $('#order_product\\[' + row + '\\]\\[TE033\\]').val(); //起始模數
		var md = $('#order_product\\[' + row + '\\]\\[TE034\\]').val(); //結束模數


		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE0111\\]'); //改變顏色用
		paragraph.style.color = "red"; //改變顏色用

		if (!rm) { //實際模穴數			
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('實際模穴數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE032\\]').focus();
			}, 100);

		}
		if (!ms) { //起始模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('起始模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE033\\]').focus();
			}, 100);
		}
		if (!md) { //結束模數
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		}


		var moldca = parseInt(md) - parseInt(ms);

		if (moldca <= 0) {
			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val('結束模數小於起始模數');
			// $('input[name=order_product\\[' + row + '\\]\\[TE0111\\]]').val('結束模數小於起始模數');

			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE034\\]').focus();
			}, 100);
		} else {
			paragraph.style.color = "black"; //改變顏色用
			var Qcount = parseInt(rm) * moldca;

			// var badc = $('#order_product\\[' + row + '\\]\\[TE035\\]').val(); //不良總數
			// var canc = $('#order_product\\[' + row + '\\]\\[TE036\\]').val(); //可粉碎量
			// var waic = $('#order_product\\[' + row + '\\]\\[TE037\\]').val(); //待粉碎量
			// var notc = $('#order_product\\[' + row + '\\]\\[TE038\\]').val(); //不可粉碎

			$('#order_product\\[' + row + '\\]\\[TE0111\\]').val(moldca); //模次數

			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE040\\]').focus();
			}, 100);


			// if (!badc) { //不良總數		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE035\\]').focus();
			// 	}, 100);
			// }
			// if (!canc) { //可粉碎量		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE036\\]').focus();
			// 	}, 100);
			// }
			// if (!waic) { //待粉碎量		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE037\\]').focus();
			// 	}, 100);

			// }
			// if (!notc) { //不可粉碎		
			// 	$('#order_product\\[' + row + '\\]\\[TE0312\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE038\\]').focus();
			// 	}, 100);
			// }

			// if (Qcount - badc <= 0) {
			// 	$('#order_product\\[' + row + '\\]\\[TE035\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE035\\]').focus();
			// 	}, 100);
			// } else if (Qcount - badc - waic <= 0) {
			// 	$('#order_product\\[' + row + '\\]\\[TE037\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE037\\]').focus();
			// 	}, 100);
			// } else if (Qcount - badc - waic - notc <= 0) {
			// 	$('#order_product\\[' + row + '\\]\\[TE038\\]').val('');
			// 	return setTimeout(function() {
			// 		$('#order_product\\[' + row + '\\]\\[TE038\\]').focus();
			// 	}, 100);
			// }

			// $('#order_product\\[' + row + '\\]\\[TE0312\\]').val(Qcount - badc - waic - notc);
		}

	}

	function sumQ(var_count) {
		if ($.isNumeric(var_count)) {
			row = var_count;
		} else {
			var row = $(var_count).parent().parent().parent()[0].id.substr(12);
		}

		var ok = $('#order_product\\[' + row + '\\]\\[TE040\\]').val(); //合格數量
		var bad = $('#order_product\\[' + row + '\\]\\[TE035\\]').val(); //不良數量

		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE0333\\]'); //改變顏色用
		paragraph.style.color = "red"; //改變顏色用

		if (!ok) { //合格數量
			$('#order_product\\[' + row + '\\]\\[TE0333\\]').val('合格數量必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE040\\]').focus();
			}, 100);
		}
		if (!bad) { //不良數量
			$('#order_product\\[' + row + '\\]\\[TE0333\\]').val('不良數量必填');
			return setTimeout(function() {
				$('#order_product\\[' + row + '\\]\\[TE035\\]').focus();
			}, 100);
		}

		$('#order_product\\[' + row + '\\]\\[TE0333\\]').val(parseInt(ok) + parseInt(bad)); //生產數量
		paragraph.style.color = "black"; //改變顏色用

		return setTimeout(function() {
			$('#order_product\\[' + row + '\\]\\[TE036\\]').focus();
		}, 100);
	}




	function PrefixInteger(num, length) {
		return (Array(length).join('0') + num).slice(-length);
	}
//1141208-v3
function count_time(row_obj) {
    if ($.isNumeric(row_obj)) {
        row = row_obj;
    } else {
        var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
    }

    // ==========================================
    // 關鍵修正：判斷當前觸發的欄位
    // ==========================================
    var current_field_name = '';
    if (typeof row_obj === 'object') {
        current_field_name = $(row_obj).attr('name') || '';
        // 從 name 屬性提取欄位名稱，例如: order_product[0][TE023] -> TE023
        var field_match = current_field_name.match(/\[([^\]]+)\]$/);
        if (field_match) {
            current_field_name = field_match[1];
        }
    }

    var count1 = 0;
    var count2 = 0;
    var count3 = 0;
    var resulst_sum;
    var resulst_sum1;

    // 取得欄位值
    var time_start1 = $('#order_product\\[' + row + '\\]\\[TE022\\]').val();
    var time_end1   = $('#order_product\\[' + row + '\\]\\[TE023\\]').val();
    var time_start2 = $('#order_product\\[' + row + '\\]\\[TE024\\]').val();
    var time_end2   = $('#order_product\\[' + row + '\\]\\[TE025\\]').val();
    var time_start3 = $('#order_product\\[' + row + '\\]\\[TE026\\]').val();
    var time_end3   = $('#order_product\\[' + row + '\\]\\[TE027\\]').val();
    var time_check  = $('#order_product\\[' + row + '\\]\\[TE049\\]').val();

    // ==========================================
    // 判斷是否為跨日 (結束時間在凌晨，開始時間在晚上)
    // ==========================================
    function isOvernight(start, end) {
        if (!start || !end) return false;
        var startInt = parseInt(start);
        var endInt = parseInt(end);
        // 結束時間在 0000-0600，且開始時間在 1800-2359
        return (endInt >= 0 && endInt <= 600) && (startInt >= 1800 && startInt <= 2359);
    }

    // ==========================================
    // 只在「結束時間欄位」觸發時才檢查
    // ==========================================

    // 1. 檢查時段1訖 (TE023) - 只在輸入 TE023 時檢查
    if (current_field_name === 'TE023' && time_start1 != "" && time_end1 != "") {
        if (isOvernight(time_start1, time_end1)) {
            var confirm_msg = "時段1：結束時間(0030)小於起始時間(2330)\n" +
                            "是否為隔日時間(自動加24小時)?\n\n" +
                            "按「確定」：視為隔日並計算\n" +
                            "按「取消」：清空結束時間";
            $('#message').text("時段1：結束時間(0030)小於起始時間(2330)\n" +
                            "為隔日時間(自動加24小時)?\n\n");
			time_end1 = String(parseInt(time_end1) + 2400);
          /*  if (confirm(confirm_msg)) {
                time_end1 = String(parseInt(time_end1) + 2400);
            } else {
                $('#order_product\\[' + row + '\\]\\[TE023\\]').val('');
                $('#order_product\\[' + row + '\\]\\[TE023\\]').focus();
                return;
            }*/
			//1150121 大於等於, modi >
        } else if (parseInt(time_start1) >= parseInt(time_end1)) {
           // alert("輸入錯誤！\n時段1結束時間(" + time_end1 + ") 必須大於 起始時間(" + time_start1 + ")");
            $('#message').text("輸入錯誤！\n時段1結束時間(" + time_end1 + ") 必須大於 起始時間(" + time_start1 + ")");
			$('#order_product\\[' + row + '\\]\\[TE023\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE023\\]').focus();
            return;
        }
    }

    // 2. 檢查時段2起 (TE024) - 必須大於時段1訖 1150121 modi >=
    if (current_field_name === 'TE024' && time_start2 != "" && time_end1 != "") {
        var end1_value = parseInt(time_end1) > 2400 ? parseInt(time_end1) - 2400 : parseInt(time_end1);
        //1150121 modi 先mark 輸入錯誤 1150201
		//if (parseInt(time_start2) <= end1_value) {
			//if (parseInt(time_start2) < end1_value and end1_value<>'2400' ) {
           // alert("輸入錯誤！\n時段2起始(" + time_start2 + ") 必須大於 時段1結束(" + end1_value + ")");
        if ( time_start2.toString().padStart(4, '0') > time_start1.toString().padStart(4, '0') && time_end1.toString().padStart(4, '0') == "2400"  )  {               
		   $('#message').text("輸入錯誤！\n時段2起始(" + time_start2 + ") 必須大於 時段1結束(" + end1_value + ")");           
		   $('#order_product\\[' + row + '\\]\\[TE024\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE024\\]').focus();
            return;
        }
		//}
    }

    // 3. 檢查時段2訖 (TE025) - 只在輸入 TE025 時檢查
    if (current_field_name === 'TE025' && time_start2 != "" && time_end2 != "") {
        if (isOvernight(time_start2, time_end2)) {
            var confirm_msg = "時段2：結束時間(" + time_end2 + ")小於起始時間(" + time_start2 + ")\n" +
                            "為隔日時間(自動加24小時)\n\n" ;
            $('#message').text("時段2：結束時間(" + time_end2 + ")小於起始時間(" + time_start2 + ")\n" +
                            "為隔日時間(自動加24小時)\n\n");
				time_end2 = String(parseInt(time_end2) + 2400);
           /* if (confirm(confirm_msg)) {
                time_end2 = String(parseInt(time_end2) + 2400);
            } else {
                $('#order_product\\[' + row + '\\]\\[TE025\\]').val('');
                $('#order_product\\[' + row + '\\]\\[TE025\\]').focus();
                return; 1150201 >=
            } */
        } else if (parseInt(time_start2) > parseInt(time_end2) ) {
           // alert("輸入錯誤！\n時段2結束時間(" + time_end2 + ") 必須大於 起始時間(" + time_start2 + ")");
            $('#message').text("輸入錯誤！\n時段2結束時間(" + time_end2 + ") 必須大於 起始時間(" + time_start2 + ")"); 
			$('#order_product\\[' + row + '\\]\\[TE025\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE025\\]').focus();
            return;
        }
		 else if (time_end1.toString().padStart(4, '0') > time_end2.toString().padStart(4, '0') && time_end1.toString().padStart(4, '0') != "2400" ) {
           // alert("輸入錯誤！\n時段2結束時間(" + time_end2 + ") 必須大於 起始時間(" + time_start2 + ")");
            $('#message').text("輸入錯誤！\n時段2結束時間(" + time_end2 + ") 必須小於 結束時間(" + time_end1 + ")"); 
			$('#order_product\\[' + row + '\\]\\[TE025\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE025\\]').focus();
            return;
        }
    }

    // 4. 檢查時段3起 (TE026) - 必須大於時段2訖
    if (current_field_name === 'TE026' && time_start3 != "" && time_end2 != "") {
        var end2_value = parseInt(time_end2) > 2400 ? parseInt(time_end2) - 2400 : parseInt(time_end2);
        //1150121 mark 
		//if (parseInt(time_start3) <= end2_value) {
          //  alert("輸入錯誤！\n時段3起始(" + time_start3 + ") 必須大於 時段2結束(" + end2_value + ")");
		  if ( time_start3.toString().padStart(4, '0') > time_end2.toString().padStart(4, '0') && time_end2.toString().padStart(4, '0') == "2400"  )  {  	
			$('#message').text("輸入錯誤！\n時段3起始(" + time_start3 + ") 必須大於 時段2結束(" + end2_value + ")");
            $('#order_product\\[' + row + '\\]\\[TE026\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE026\\]').focus();
            return;
        }
    }

    // 5. 檢查時段3訖 (TE027) - 只在輸入 TE027 時檢查
    if (current_field_name === 'TE027' && time_start3 != "" && time_end3 != "") {
        if (isOvernight(time_start3, time_end3)) {
            var confirm_msg = "時段3：結束時間(" + time_end3 + ")小於起始時間(" + time_start3 + ")\n" +
                            "是否為隔日時間(自動加24小時)\n\n" +
                            "按「確定」：視為隔日並計算\n" +
                            "按「取消」：清空結束時間";
            $('#message').text("時段3：結束時間(" + time_end3 + ")小於起始時間(" + time_start3 + ")\n" +
                            "為隔日時間(自動加24小時)\n\n" );
			time_end3 = String(parseInt(time_end3) + 2400);
          /*  if (confirm(confirm_msg)) {
                time_end3 = String(parseInt(time_end3) + 2400);
            } else {
                $('#order_product\\[' + row + '\\]\\[TE027\\]').val('');
                $('#order_product\\[' + row + '\\]\\[TE027\\]').focus();
                return;
            }*/
        } else if (parseInt(time_start3) >= parseInt(time_end3)) {
           // alert("輸入錯誤！\n時段3結束時間(" + time_end3 + ") 必須大於 起始時間(" + time_start3 + ")");
            $('#message').text("輸入錯誤！\n時段3結束時間(" + time_end3 + ") 必須大於 起始時間(" + time_start3 + ")");
			$('#order_product\\[' + row + '\\]\\[TE027\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE027\\]').focus();
            return;
        }
		else if (time_end2.toString().padStart(4, '0') > time_end3.toString().padStart(4, '0') && time_end2 != "2400" ) {
           // alert("輸入錯誤！\n時段2結束時間(" + time_end2 + ") 必須大於 起始時間(" + time_start2 + ")");
            $('#message').text("輸入錯誤！\n時段3結束時間(" + time_end3 + ") 必須小於 結束時間(" + time_end2 + ")"); 
			$('#order_product\\[' + row + '\\]\\[TE027\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE027\\]').focus();
            return;
        }
		
    }

    // ==========================================
    // 計算時間差異
    // ==========================================

    count1 = time_abs(time_start1, time_end1);
    count2 = time_abs(time_start2, time_end2);
    count3 = time_abs(time_start3, time_end3);

    resulst_sum = timeDis(count1 + count2 + count3);
    if ($('#sfci01').val() == 'D404') {
        resulst_sum1 = resulst_sum;
    } else if (time_check == 2) {
        resulst_sum1 = timeDis(count1 + count2 + count3 - 30 * 60);
    } else {
        resulst_sum1 = resulst_sum;
    }
    
    $('#order_product\\[' + row + '\\]\\[TE012\\]').val(resulst_sum);
    $('#order_product\\[' + row + '\\]\\[TE013\\]').val(resulst_sum1);
    
    // 自動跳到下一個欄位
    var current_field = $(row_obj).attr('data-field') || $(row_obj).attr('name');
    if (current_field) {
        var next_input = $(row_obj).closest('td').next('td').find('input:first');
        if (next_input.length) {
            next_input.focus();
        }
    }
}	
	
function count_time_old1141208(row_obj) {
    if ($.isNumeric(row_obj)) {
        row = row_obj;
    } else {
        var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
    }

    var count1 = 0; //第1段
    var count2 = 0; //第2段
    var count3 = 0; //第3段
    var resulst_sum;
    var resulst_sum1;

    // 取得欄位值
    var time_start1 = $('#order_product\\[' + row + '\\]\\[TE022\\]').val(); //時段1起
    var time_end1   = $('#order_product\\[' + row + '\\]\\[TE023\\]').val(); //時段1訖
    var time_start2 = $('#order_product\\[' + row + '\\]\\[TE024\\]').val(); //時段2起
    var time_end2   = $('#order_product\\[' + row + '\\]\\[TE025\\]').val(); //時段2訖
    var time_start3 = $('#order_product\\[' + row + '\\]\\[TE026\\]').val(); //時段3起
    var time_end3   = $('#order_product\\[' + row + '\\]\\[TE027\\]').val(); //時段3訖
    var time_check  = $('#order_product\\[' + row + '\\]\\[TE049\\]').val();

    // ==========================================
    // 時間邏輯判斷 (含隔天處理)
    // ==========================================

    // 1. 檢查時段1：起 vs 訖
    if (time_start1 != "" && time_end1 != "") {
        if (parseInt(time_start1) >= parseInt(time_end1)) {
            var confirm_msg = "時段1：結束時間(" + time_end1 + ")小於起始時間(" + time_start1 + ")\n" +
                            "是否為隔日時間(自動加24小時)?\n\n" +
                            "按「確定」: 視為隔日並計算\n" +
                            "按「取消」: 清空結束時間";
            
            if (confirm(confirm_msg)) {
                // 確認為隔日,time_end1 加 24 小時 (2400)
                time_end1 = String(parseInt(time_end1) + 2400);
            } else {
                // 取消，清空錯誤欄位
                $('#order_product\\[' + row + '\\]\\[TE023\\]').val('');
                $('#order_product\\[' + row + '\\]\\[TE023\\]').focus();
                return;
            }
        }
    }

    // 2. 檢查 TE024 > TE023 (時段2起 > 時段1訖)
    if (time_start2 != "" && time_end1 != "") {
        var end1_value = parseInt(time_end1) > 2400 ? parseInt(time_end1) - 2400 : parseInt(time_end1);
        if (parseInt(time_start2) <= end1_value) {
            alert("輸入錯誤！\n時段2起始(" + time_start2 + ") 必須大於 時段1結束(" + end1_value + ")");
            $('#order_product\\[' + row + '\\]\\[TE024\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE024\\]').focus();
            return;
        }
    }

    // 3. 檢查時段2：起 vs 訖
    if (time_start2 != "" && time_end2 != "") {
        if (parseInt(time_start2) >= parseInt(time_end2)) {
            var confirm_msg = "時段2：結束時間(" + time_end2 + ")小於起始時間(" + time_start2 + ")\n" +
                            "是否為隔日時間(自動加24小時)?\n\n" +
                            "按「確定」: 視為隔日並計算\n" +
                            "按「取消」: 清空結束時間";
            
            if (confirm(confirm_msg)) {
                time_end2 = String(parseInt(time_end2) + 2400);
            } else {
                $('#order_product\\[' + row + '\\]\\[TE025\\]').val('');
                $('#order_product\\[' + row + '\\]\\[TE025\\]').focus();
                return;
            }
        }
    }

    // 4. 檢查 TE026 > TE025 (時段3起 > 時段2訖)
    if (time_start3 != "" && time_end2 != "") {
        var end2_value = parseInt(time_end2) > 2400 ? parseInt(time_end2) - 2400 : parseInt(time_end2);
        if (parseInt(time_start3) <= end2_value) {
            alert("輸入錯誤！\n時段3起始(" + time_start3 + ") 必須大於 時段2結束(" + end2_value + ")");
            $('#order_product\\[' + row + '\\]\\[TE026\\]').val('');
            $('#order_product\\[' + row + '\\]\\[TE026\\]').focus();
            return;
        }
    }

    // 5. 檢查時段3：起 vs 訖
    if (time_start3 != "" && time_end3 != "") {
        if (parseInt(time_start3) >= parseInt(time_end3)) {
            var confirm_msg = "時段3：結束時間(" + time_end3 + ")小於起始時間(" + time_start3 + ")\n" +
                            "是否為隔日時間(自動加24小時)?\n\n" +
                            "按「確定」: 視為隔日並計算\n" +
                            "按「取消」: 清空結束時間";
            
            if (confirm(confirm_msg)) {
                time_end3 = String(parseInt(time_end3) + 2400);
            } else {
                $('#order_product\\[' + row + '\\]\\[TE027\\]').val('');
                $('#order_product\\[' + row + '\\]\\[TE027\\]').focus();
                return;
            }
        }
    }

    // ==========================================
    // 計算時間差異
    // ==========================================

    count1 = time_abs(time_start1, time_end1);
    count2 = time_abs(time_start2, time_end2);
    count3 = time_abs(time_start3, time_end3);

    resulst_sum = timeDis(count1 + count2 + count3);
    if ($('#sfci01').val() == 'D404') {
        resulst_sum1 = resulst_sum;
    } else if (time_check == 2) {
        resulst_sum1 = timeDis(count1 + count2 + count3 - 30 * 60); //換30分鐘
    } else {
        resulst_sum1 = resulst_sum;
    }
    
    // 填入人時TE012和機時TE013 (格式: HHMM)
    $('#order_product\\[' + row + '\\]\\[TE012\\]').val(resulst_sum);
    $('#order_product\\[' + row + '\\]\\[TE013\\]').val(resulst_sum1);
    
    // 按確定後自動跳到下一個欄位
    var current_field = $(row_obj).attr('data-field') || $(row_obj).attr('name');
    if (current_field) {
        var next_input = $(row_obj).closest('td').next('td').find('input:first');
        if (next_input.length) {
            next_input.focus();
        }
    }
}


	//1141123
	// 請在 sfci03m_fundjs_v.php 找到此函數並修改
function count_time_1141204a(row_obj) {
    if ($.isNumeric(row_obj)) {
        row = row_obj;
    } else {
        var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
    }

    var count1 = 0; //第1段
    var count2 = 0; //第2段
    var count3 = 0; //第3段
    var resulst_sum;
    var resulst_sum1;

    // 取得欄位值
    var time_start1 = $('#order_product\\[' + row + '\\]\\[TE022\\]').val(); //時段1起
    var time_end1   = $('#order_product\\[' + row + '\\]\\[TE023\\]').val(); //時段1訖
    var time_start2 = $('#order_product\\[' + row + '\\]\\[TE024\\]').val(); //時段2起
    var time_end2   = $('#order_product\\[' + row + '\\]\\[TE025\\]').val(); //時段2訖
    var time_start3 = $('#order_product\\[' + row + '\\]\\[TE026\\]').val(); //時段3起
    var time_end3   = $('#order_product\\[' + row + '\\]\\[TE027\\]').val(); //時段3訖
    var time_check  = $('#order_product\\[' + row + '\\]\\[TE049\\]').val();

    // ==========================================
    // 1141123 新增：時間邏輯判斷 (防呆機制)
    // ==========================================

    // 1. 檢查 TE022 < TE023 (時段1：起 < 訖)
    if (time_start1 != "" && time_end1 != "") {
        if (parseInt(time_start1) >= parseInt(time_end1)) {
            alert("輸入錯誤！\n時段1：起始(" + time_start1 + ") 不可大於等於 結束(" + time_end1 + ")");
            $('#order_product\\[' + row + '\\]\\[TE023\\]').val(''); // 清空錯誤欄位
            return; // 中斷程式，不往下計算
        }
    }

    // 2. 檢查 TE024 > TE023 (時段2起 > 時段1訖)
    if (time_start2 != "" && time_end1 != "") {
        if (parseInt(time_start2) <= parseInt(time_end1)) {
            alert("輸入錯誤！\n時段2起始(" + time_start2 + ") 必須大於 時段1結束(" + time_end1 + ")");
            $('#order_product\\[' + row + '\\]\\[TE024\\]').val('');
            return;
        }
    }

    // (補充) 檢查 TE024 < TE025 (時段2：起 < 訖) - 雖然您沒特別提，但這也是必須的邏輯
    if (time_start2 != "" && time_end2 != "") {
        if (parseInt(time_start2) >= parseInt(time_end2)) {
            alert("輸入錯誤！\n時段2：起始(" + time_start2 + ") 不可大於等於 結束(" + time_end2 + ")");
            $('#order_product\\[' + row + '\\]\\[TE025\\]').val('');
            return;
        }
    }

    // 3. 檢查 TE026 > TE025 (時段3起 > 時段2訖)
    if (time_start3 != "" && time_end2 != "") {
        if (parseInt(time_start3) <= parseInt(time_end2)) {
            alert("輸入錯誤！\n時段3起始(" + time_start3 + ") 必須大於 時段2結束(" + time_end2 + ")");
            $('#order_product\\[' + row + '\\]\\[TE026\\]').val('');
            return;
        }
    }
    
    // (補充) 檢查 TE026 < TE027 (時段3：起 < 訖)
    if (time_start3 != "" && time_end3 != "") {
        if (parseInt(time_start3) >= parseInt(time_end3)) {
             alert("輸入錯誤！\n時段3：起始(" + time_start3 + ") 不可大於等於 結束(" + time_end3 + ")");
             $('#order_product\\[' + row + '\\]\\[TE027\\]').val('');
             return;
        }
    }

    // ==========================================
    // 邏輯判斷結束，以下為原有的計算程式
    // ==========================================

    count1 = time_abs(time_start1, time_end1);
    count2 = time_abs(time_start2, time_end2);
    count3 = time_abs(time_start3, time_end3);

    resulst_sum = timeDis(count1 + count2 + count3);
    if ($('#sfci01').val() == 'D404') {
        resulst_sum1 = resulst_sum;
    } else if (time_check == 2) {
        resulst_sum1 = timeDis(count1 + count2 + count3 - 30 * 60); //換30分鐘
    } else {
        resulst_sum1 = resulst_sum;
    }
    //  console.log('resulst_sum');
    //  console.log(resulst_sum);
    $('#order_product\\[' + row + '\\]\\[TE012\\]').val(resulst_sum);
    $('#order_product\\[' + row + '\\]\\[TE013\\]').val(resulst_sum1);
}

	function count_time_1141123(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}

		var count1 = 0; //第1段
		var count2 = 0; //第2段
		var count3 = 0; //第3段
		var resulst_sum;
		var resulst_sum1;
		var time_start1 = $('#order_product\\[' + row + '\\]\\[TE022\\]').val();
		var time_end1 = $('#order_product\\[' + row + '\\]\\[TE023\\]').val();
		var time_start2 = $('#order_product\\[' + row + '\\]\\[TE024\\]').val();
		var time_end2 = $('#order_product\\[' + row + '\\]\\[TE025\\]').val();
		var time_start3 = $('#order_product\\[' + row + '\\]\\[TE026\\]').val();
		var time_end3 = $('#order_product\\[' + row + '\\]\\[TE027\\]').val();
		var time_check = $('#order_product\\[' + row + '\\]\\[TE049\\]').val();
		count1 = time_abs(time_start1, time_end1);
		count2 = time_abs(time_start2, time_end2);
		count3 = time_abs(time_start3, time_end3);



		resulst_sum = timeDis(count1 + count2 + count3);
		if ($('#sfci01').val() == 'D404') {
			resulst_sum1 = resulst_sum;
		} else if (time_check == 2) {
			resulst_sum1 = timeDis(count1 + count2 + count3 - 30 * 60); //換30分鐘
		} else {
			resulst_sum1 = resulst_sum;
		}
       //  console.log('resulst_sum');
       //  console.log(resulst_sum);
		$('#order_product\\[' + row + '\\]\\[TE012\\]').val(resulst_sum);
		$('#order_product\\[' + row + '\\]\\[TE013\\]').val(resulst_sum1);
	}

	function time_abs(seq1, seq2) {
		var diff;
		if (seq1 >= seq2 || seq1 == "" || seq2 == "") {
			return 0;
		}

		// diff = timeSpan(PrefixInteger(seq2, 6)) - timeSpan(PrefixInteger(seq1, 6));
		diff = timeSpan(PrefixInteger(seq2, 4)) - timeSpan(PrefixInteger(seq1, 4));

		return diff;
	}

	function timeSpan(seq1) {
		// var resulst = parseInt(seq1.substring(0, 2) * 3600) + parseInt(seq1.substring(2, 4) * 60) + parseInt(seq1.substring(4, 6));
		var resulst = parseInt(seq1.substring(0, 2) * 3600) + parseInt(seq1.substring(2, 4) * 60);
		return resulst;
	}

	function timeDis(seq1) {
		var diff = seq1;
		var leftHours = Math.floor(diff / 3600);
		if (leftHours > 0) diff = diff - (leftHours * 3600);

		var leftMins = Math.floor(diff / 60);
		if (leftMins > 0) diff = diff - (leftMins * 60);

		var leftSecs = diff;

		// var resulst = PrefixInteger(leftHours, 2) + PrefixInteger(leftMins, 2) + PrefixInteger(leftSecs, 2);
		var resulst = PrefixInteger(leftHours, 2) + PrefixInteger(leftMins, 2);
		return resulst;
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

	//查詢機台視窗
	function search_cmsi03d_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		// console.log(row);
		selected_row = row;
		// console.log($('#cmsi04').val());
		if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		}
		$('#hp_ifmain').attr('src', "<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child/" + $("#cmsi04").val());
		$.blockUI({
			//theme: true,
			//themedCSS: {
				css: {
				top: '15%',
				left: '25%',
				height: '75%',
				width: '70%',
				overflow: 'hidden',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFcmsi03d'),
			onOverlayClick: clear_cmsi03disp_sql
		});
		$('.close').click($.unblockUI);
	}

	function addcmsi03ddisp(mb001, mb002) {
		// clear_row(selected_row);
		var paragraph = document.querySelector('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]'); //改變顏色用
		paragraph.style.color = "black"; //改變顏色用
		$('#order_product\\[' + selected_row + '\\]\\[TE005\\]').val(mb001);
		$('#order_product\\[' + selected_row + '\\]\\[TE005disp\\]').val(mb002);

		var vsfc01 = $('#sfci01').val();
		if (vsfc01.length >= 2) {
			vsfc01 = vsfc01.substr(0, 2);
			if (vsfc01 == 'D5') {
				$('#order_product\\[' + selected_row + '\\]\\[TE009\\]').focus();
			} else if (vsfc01 == 'D4') {
				$('#order_product\\[' + selected_row + '\\]\\[TE006\\]').focus();
			}
		}
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql_gt"
		});
	}

	function clear_cmsi03disp_sql() {
		$.unblockUI();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql_gt"
		});
	}
	//直接輸入跳出中文 id.substr(12) 看几個欄位13 序號不算
	function check_invi02d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = $('#order_product\\[' + row + '\\]\\[tc004\\]').val();
		if (!smb001) {
			// clear_row(row);
			return;
		}
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/inv/invi02/lookupd2_invi02/' + encodeURIComponent(smb001),
			cache: false,
			dataType: 'json',
			type: 'POST',
			data: {
				mb001: row_obj.value
			},
			success: function(data) {
				if (data.response == "true") {
					$('#order_product\\[' + row + '\\]\\[tc004\\]').val(data.message[0].value1);
					$('#order_product\\[' + row + '\\]\\[tc005\\]').val(data.message[0].value2);
					$('#order_product\\[' + row + '\\]\\[tc006\\]').val(data.message[0].value3);
					$('#order_product\\[' + row + '\\]\\[tc010\\]').val(data.message[0].value4);
					$('#order_product\\[' + row + '\\]\\[tc007\\]').val(data.message[0].value5);
					$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(data.message[0].value6);
				} else {
					$('#order_product\\[' + row + '\\]\\[tc004\\]').val("查無資料");
				}
			}
		});
	}
	//1141221 down windows
	
	//1141221 - ADD-NEW 
	// 機台代號：輸入即下拉
function set_machine_catcomplete(row_obj) {
    var $input = $(row_obj);
    if (!$input.length) return;

    // 避免重複初始化
    if ($input.data('machine_ac_init') === 1) return;
    $input.data('machine_ac_init', 1);

    // 從 input id 解析 row：order_product[3][TE005]
    var row = null;
    var id = $input.attr('id') || '';
    var m = id.match(/order_product\[(\d+)\]\[TE005\]/);
    if (m) row = m[1];

    // 對應的「機台名稱欄位」：order_product[row][TE005disp]
    var $disp = null;
    if (row !== null) {
        $disp = $('#order_product\\[' + row + '\\]\\[TE005disp\\]');
    }

    // 你系統有 catcomplete 就用 catcomplete；沒有就退回 autocomplete
    var acFn = ($.fn.catcomplete) ? 'catcomplete' : 'autocomplete';

    $input[acFn]({
        delay: 200,
        minLength: 1,
        appendTo: "body",   // 避免被 div/表格遮住
        source: function (req, add) {
            var term = ($input.val() || '').trim();
            if (!term) return add([]);

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03_machine/" + encodeURIComponent(term),
                cache: false,
                dataType: "json",
				type: "GET",
               // type: "POST",
               // data: req,
                success: function (data) {
                    if (data && data.response === "true" && Array.isArray(data.message)) {
                        // 轉成 jQuery UI 可吃的格式（同時保留 value1/value2 給 select 用）
                        var items = $.map(data.message, function (it) {
                            return {
                                label: it.value || (it.value1 ? (it.value1 + "," + (it.value2 || "")) : ""),
                                value: it.value1 || it.value || "",
                                value1: it.value1,
                                value2: it.value2,
                                category: it.category || ""
                            };
                        });
                        add(items);
                    } else {
                        add([{ label: "查無資料", value: "", value1: "", value2: "" }]);
                    }
                },
                error: function () {
                    add([{ label: "查詢失敗", value: "", value1: "", value2: "" }]);
                }
            });
        },
        select: function (event, ui) {
            if (!ui || !ui.item) return false;
            if (ui.item.label === "查無資料" || ui.item.label === "查詢失敗") {
                if ($disp && $disp.length) $disp.val(ui.item.label);
                return false;
            }
            // 回填機台代號與名稱
            $input.val(ui.item.value1 || ui.item.value || "");
            if ($disp && $disp.length) $disp.val(ui.item.value2 || "");
            return false;
        },
        change: function () {
            // 使用者沒選下拉，直接離開 → 走你原本單筆檢查
            check_cmsi03d(row_obj);
            return false;
        }
    });

    // z-index（避免選單在視窗/表格後面）
    if (!document.getElementById('machine_ac_css')) {
        var css = document.createElement('style');
        css.id = 'machine_ac_css';
        css.innerHTML = ".ui-autocomplete{z-index:999999 !important;}";
        document.head.appendChild(css);
    }
}

	// 機台代號下拉（輸入即查清單）
function set_machine_catcomplete_1141221(row_obj){
  var row;
  if ($.isNumeric(row_obj)) { row = row_obj; }
  else { row = $(row_obj).parent().parent().parent()[0].id.substr(12); }

  var $code = $('#order_product\\[' + row + '\\]\\[TE005\\]');
  var $name = $('#order_product\\[' + row + '\\]\\[TE005disp\\]');

  // 避免重複初始化
  if ($code.hasClass('ui-autocomplete-input')) return;

  $code.catcomplete({
    autoFocus: false,
    delay: 200,
    minLength: 1,

    source: function(req, add){
      var term = $code.val().trim();
      var line = $('#cmsi04').val().trim();

      if (!line) { return add([]); }  // 沒選線別就不查 + '/' + encodeURIComponent(line)

      $.ajax({
        url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03_machine/'
              + encodeURIComponent(term) ,
        cache: false,
        dataType: 'json',
        type: 'POST',
        data: req,
        success: function(data){
          if (data.response == "true") add(data.message);
          else add([{ label: "查無資料", value: "查無資料", value1: "查無資料", value2: "" }]);
        }
      });
    },

    select: function(event, ui){
      if (ui.item.value != "查無資料") {
        $code.val(ui.item.value1);   // 機台代號
        $name.val(ui.item.value2);   // 機台名稱
      } else {
        $name.val("查無資料");
      }
      return false;
    },

    // 使用者沒選下拉、直接離開欄位時 → 走你原本的單筆檢查
    change: function(event, ui){
      check_cmsi03d(row);
      return false;
    }
  });
}

	//機台 new
	function check_cmsi03d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = ($('#order_product\\[' + row + '\\]\\[TE005\\]').val() || '').toString().trim();
var smb002 = ($('#cmsi04').val() || '').toString().trim();
console.log(smb001);
console.log('test3');
if (!smb001) {
  $('#order_product\\[' + row + '\\]\\[TE005\\]').val('');
  $('#order_product\\[' + row + '\\]\\[TE005disp\\]').val('');
  return;
}
		/*var smb001 = $('#order_product\\[' + row + '\\]\\[TE005\\]').val().trim();
		var smb002 = $('#cmsi04').val().trim();
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE005\\]').val('');
			$('#order_product\\[' + row + '\\]\\[TE005disp\\]').val('');
			// clear_row(row);
			return;
		} */
		/*if ($('#cmsi04').val() == '') {
			alert('請先選擇生產線別!');
			return $('#cmsi04').focus();
		} */
		if (!smb002) {
  alert('請先選擇生產線別!');
  $('#cmsi04').focus();
  return;
}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE005disp\\]'); //改變顏色用
		// $.ajax({
		// 	url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb001),
		// 	cache: false,
		// 	dataType: 'json',
		// 	type: 'POST',
		// 	data: {
		// 		mb001: row_obj.value
		// 	},
		// 	success: function(data) {
		// 		if (data.response == "true") {
		// 			$('#order_product\\[' + row + '\\]\\[tc007\\]').val(data.message[0].value1);
		// 			$('#order_product\\[' + row + '\\]\\[tc007disp\\]').val(data.message[0].value2);
		// 		} else {
		// 			$('#order_product\\[' + row + '\\]\\[tc007\\]').val("查無資料");
		// 		}
		// 	}
		// });
	//1141221 add
	/*	$.ajax({
				method: "POST",
				url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' + encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/',
				data: {
					mb001: row_obj.value,
					mb002: smb002
				}
			}) */
$.ajax({
  method: "POST",
  url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/' 
        + encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/',
  data: {
    mb001: row_obj.value,
    mb002: smb002
  }
})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[TE005\\]').val("");
					$('#order_product\\[' + row + '\\]\\[TE005disp\\]').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[TE005\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[TE005disp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用

					var vsfc01 = $('#sfci01').val();
					if (vsfc01.length >= 2) {
						vsfc01 = vsfc01.substr(0, 2);
						if (vsfc01 == 'D5') {
							return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
						} else if (vsfc01 == 'D4') {
							return $('#order_product\\[' + row + '\\]\\[TE006\\]').focus();
						}
					}


				}
			});
	}
//人員
// new
	function check_cmsi09d(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		var smb001 = ($('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val() || '').toString().trim();
var smb002 = ($('#cmsi04').val() || '').toString().trim();
console.log(smb001);
console.log('test1');
if (!smb001) {
  $('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val('');
  $('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val('');
  return;
}
	
		if (!smb002) {
  alert('請先選擇生產線別!');
  $('#cmsi04').focus();
  return;
}
		var paragraph = document.querySelector('#order_product\\[' + row + '\\]\\[TE004disp\\]'); //改變顏色用
		
$.ajax({
  method: "POST",
  url: '<?php echo base_url(); ?>index.php/cms/cmsi09/check_cmsi09d/' 
        + encodeURIComponent(smb001) + '/',
  data: {
    mb001: smb001
  }
})
			.done(function(msg) {
				// console.log('output:' + msg);
				//回傳值顯示處理
				if (msg == 'N') {
					$('#order_product\\[' + row + '\\]\\[cmsi09d\\]').val("");
					$('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val("查無資料");
					paragraph.style.color = "red"; //改變顏色用
					return $('#order_product\\[' + row + '\\]\\[cmsi09d\\]').focus();
				} else {
					$('#order_product\\[' + row + '\\]\\[cmsi09ddisp\\]').val(msg);
					paragraph.style.color = "black"; //改變顏色用
				}
			});
	}
function check_cmsi19d(row_obj) {
	    console.log('========================================');
	    console.log('✅ check_cmsi19d 函数已触发！');
	    console.log('传入参数 row_obj:', row_obj);
	    console.log('row_obj 类型:', typeof row_obj);
		if ($.isNumeric(row_obj)) {
			row = row_obj;
			console.log('使用数字行号: ' + row);
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
			console.log('从元素获取行号: ' + row);
		}
        console.log('✅ 当前行号确认: ' + row);
        console.log('========================================');
        
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		var ste006 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		var ste007 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		var ste008 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		
		console.log('制程代号(TE009): ' + smb001);
		console.log('制令单别(TE006): ' + ste006);
		console.log('制令单号(TE007): ' + ste007);
		console.log('工序(TE008): ' + ste008);
		
		if (!smb001) {
			$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('');
			return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
		}
         console.log('test2');
		var smb002 = $('#cmsi04').val();
		console.log('生产线别(cmsi04): ' + smb002);
		
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		
		// 修正 URL 拼接语法错误
		var ajaxUrl = '<?php echo base_url(); ?>index.php/cms/cmsi19/check_cmsi19d/' 
			+ encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/'
			+ encodeURIComponent(ste006) + '/' + encodeURIComponent(ste007) + '/'
			+ encodeURIComponent(ste008) + '/';
		
		console.log('AJAX URL: ' + ajaxUrl);
		
		$.ajax({
				method: "POST",
				url: ajaxUrl,
				dataType: 'json', // 明确指定返回数据类型为 JSON
				data: {
					mb001: smb001,
					mb002: smb002,
					mb003: ste006,
					mb004: ste007,
					mb005: ste008,
				}
			})
			.done(function(response) {
				console.log('AJAX 请求成功，返回数据:', response);
				
				// 后端返回的是 JSON 格式：{ response: 'true', message: [...] }
				if (response && response.message && response.message.length > 0) {
					var firstMsg = response.message[0];
					
					// 检查是否查无资料
					if (firstMsg.value === '查無資料') {
						console.log('查无资料');
						$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');
						$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('查無資料').css('color', 'red');
						return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
					} else {
						// 有资料，填入各栏位
						console.log('找到资料，开始填入栏位');
						console.log('TE006: ' + firstMsg.value1);
						console.log('TE007: ' + firstMsg.value2);
						console.log('TE008: ' + firstMsg.value3);
						console.log('TE009: ' + firstMsg.value4);
						console.log('TE009disp: ' + firstMsg.value5);
						
						$('#order_product\\['+row+'\\]\\[TE006\\]').val(firstMsg.value1);
						$('#order_product\\['+row+'\\]\\[TE007\\]').val(firstMsg.value2);
						$('#order_product\\['+row+'\\]\\[TE008\\]').val(firstMsg.value3);
						$('#order_product\\['+row+'\\]\\[TE009\\]').val(firstMsg.value4);
						$('#order_product\\['+row+'\\]\\[TE009disp\\]').val(firstMsg.value5).css('color', 'black');
						return $('#order_product\\[' + row + '\\]\\[TE029\\]').focus();
					}
				} else {
					console.log('返回数据格式异常');
					$('#order_product\\[' + row + '\\]\\[TE009\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE009disp\\]').val('查無資料').css('color', 'red');
					return $('#order_product\\[' + row + '\\]\\[TE009\\]').focus();
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.error('❌ AJAX 请求失败:', textStatus, errorThrown);
				console.error('响应状态码:', jqXHR.status);
				console.error('响应内容:', jqXHR.responseText);
				alert('查詢失敗: ' + textStatus);
			});
	}
function check_cmsi19d8(row_obj) {
	    
		if ($.isNumeric(row_obj)) {
			row = row_obj;
			console.log('使用数字行号: ' + row);
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
			console.log('从元素获取行号: ' + row);
		}
               
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		var ste006 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		var ste007 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		var ste009 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		var ste008 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		
		console.log('制程代号(TE009): ' + smb001);
		console.log('制令单别(TE006): ' + ste006);
		console.log('制令单号(TE007): ' + ste007);
		console.log('工序(TE008): ' + ste008);
		
		if (!smb001) {
			return $('#order_product\\[' + row + '\\]\\[TE008\\]').focus();
		}
        
		var smb002 = $('#cmsi04').val();
		console.log('生产线别(cmsi04): ' + smb002);
		
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		
		// 修正 URL 拼接语法错误
		var ajaxUrl = '<?php echo base_url(); ?>index.php/cms/cmsi19d8/check_cmsi19d8/' 
			+ encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/'
			+ encodeURIComponent(ste006) + '/' + encodeURIComponent(ste007) + '/'
			+ encodeURIComponent(ste009) + '/';
		
		console.log('AJAX URL: ' + ajaxUrl);
		
		$.ajax({
				method: "POST",
				url: ajaxUrl,
				dataType: 'json', // 明确指定返回数据类型为 JSON
				data: {
					mb001: smb001,
					mb002: smb002,
					mb003: ste006,
					mb004: ste007,
					mb005: ste009,
				}
			})
			.done(function(response) {
				console.log('AJAX 请求成功，返回数据:', response);
				
				// 后端返回的是 JSON 格式：{ response: 'true', message: [...] }
				if (response && response.message && response.message.length > 0) {
					var firstMsg = response.message[0];
					
					// 检查是否查无资料
					if (firstMsg.value === '查無資料') {
						console.log('查无资料');
					//	$('#order_product\\[' + row + '\\]\\[TE008\\]').val('');
						///$('#order_product\\[' + row + '\\]\\[TE008\\]').val('查無資料').css('color', 'red');
						return $('#order_product\\[' + row + '\\]\\[TE008\\]').focus();
					} else {
						// 有资料，填入各栏位
						console.log('找到资料，开始填入栏位');
						console.log('TE006: ' + firstMsg.value1);
						console.log('TE007: ' + firstMsg.value2);
						console.log('TE008: ' + firstMsg.value3);
						console.log('TE009: ' + firstMsg.value4);
						console.log('TE009disp: ' + firstMsg.value5);
						
						$('#order_product\\['+row+'\\]\\[TE006\\]').val(firstMsg.value1);
						$('#order_product\\['+row+'\\]\\[TE007\\]').val(firstMsg.value2);
						$('#order_product\\['+row+'\\]\\[TE008\\]').val(firstMsg.value3);
						$('#order_product\\['+row+'\\]\\[TE009\\]').val(firstMsg.value4);
						$('#order_product\\['+row+'\\]\\[TE009disp\\]').val(firstMsg.value5).css('color', 'black');
						return $('#order_product\\[' + row + '\\]\\[TE008\\]').focus();
					}
				} else {
					console.log('返回数据格式异常');
					// $('#order_product\\[' + row + '\\]\\[TE008\\]').val('');
					//$('#order_product\\[' + row + '\\]\\[TE008\\]').val('查無資料').css('color', 'red');
					return $('#order_product\\[' + row + '\\]\\[TE008\\]').focus();
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.error('❌ AJAX 请求失败:', textStatus, errorThrown);
				console.error('响应状态码:', jqXHR.status);
				console.error('响应内容:', jqXHR.responseText);
				alert('查詢失敗: ' + textStatus);
			});
	}
	function check_cmsi19d7(row_obj) {
	    
		if ($.isNumeric(row_obj)) {
			row = row_obj;
			console.log('使用数字行号: ' + row);
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
			console.log('从元素获取行号: ' + row);
		}
               
		var smb001 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		var ste006 = $('#order_product\\[' + row + '\\]\\[TE006\\]').val();
		var ste007 = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		var ste009 = $('#order_product\\[' + row + '\\]\\[TE009\\]').val();
		var ste008 = $('#order_product\\[' + row + '\\]\\[TE008\\]').val();
		var ste007old = $('#order_product\\[' + row + '\\]\\[TE007\\]').val();
		
		console.log('制程代号(TE009): ' + smb001);
		console.log('制令单别(TE006): ' + ste006);
		console.log('制令单号(TE007): ' + ste007);
		console.log('工序(TE008): ' + ste008);
		
		if (!smb001) {
			return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
		}
        
		var smb002 = $('#cmsi04').val();
		console.log('生产线别(cmsi04): ' + smb002);
		
		if (!smb002) {
			alert('請先選擇生產線別!');
			return;
		}
		
		// 修正 URL 拼接语法错误
		var ajaxUrl = '<?php echo base_url(); ?>index.php/cms/cmsi19d7/check_cmsi19d7/' 
			+ encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002) + '/'
			+ encodeURIComponent(ste006) + '/' + encodeURIComponent(ste007) + '/'
			+ encodeURIComponent(ste008) + '/';
		
		console.log('AJAX URL: ' + ajaxUrl);
		
		$.ajax({
				method: "POST",
				url: ajaxUrl,
				dataType: 'json', // 明确指定返回数据类型为 JSON
				data: {
					mb001: smb001,
					mb002: smb002,
					mb003: ste006,
					mb004: ste007,
					mb005: ste008,
				}
			})
			.done(function(response) {
				console.log('AJAX 请求成功，返回数据:', response);
				
				// 后端返回的是 JSON 格式：{ response: 'true', message: [...] }
				if (response && response.message && response.message.length > 0) {
					var firstMsg = response.message[0];
					
					// 检查是否查无资料
					if (firstMsg.value === '查無資料') {
						console.log('查无资料');
					//	$('#order_product\\[' + row + '\\]\\[TE007\\]').val('');
						$('#order_product\\[' + row + '\\]\\[TE007\\]').val(smb001).css('color', 'red');
						return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
					} else {
						// 有资料，填入各栏位
						console.log('找到资料，开始填入栏位');
						console.log('TE006: ' + firstMsg.value1);
						console.log('TE007: ' + firstMsg.value2);
						console.log('TE008: ' + firstMsg.value3);
						console.log('TE009: ' + firstMsg.value4);
						console.log('TE009disp: ' + firstMsg.value5);
						
						$('#order_product\\['+row+'\\]\\[TE006\\]').val(firstMsg.value1);
						$('#order_product\\['+row+'\\]\\[TE007\\]').val(firstMsg.value2).css('color', 'black');;
						$('#order_product\\['+row+'\\]\\[TE008\\]').val(firstMsg.value3);
						$('#order_product\\['+row+'\\]\\[TE009\\]').val(firstMsg.value4);
						$('#order_product\\['+row+'\\]\\[TE009disp\\]').val(firstMsg.value5).css('color', 'black');
						$('#order_product\\['+row+'\\]\\[TE017\\]').val(firstMsg.value6);
						$('#order_product\\['+row+'\\]\\[TE018\\]').val(firstMsg.value7);
						$('#order_product\\['+row+'\\]\\[TE019\\]').val(firstMsg.value8);
						$('#order_product\\['+row+'\\]\\[TE020\\]').val(firstMsg.value9);
						return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
					}
				} else {
					console.log('返回数据格式异常');
					// $('#order_product\\[' + row + '\\]\\[TE007\\]').val('');
					$('#order_product\\[' + row + '\\]\\[TE007\\]').val(smb001).css('color', 'red');
					return $('#order_product\\[' + row + '\\]\\[TE007\\]').focus();
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.error('❌ AJAX 请求失败:', textStatus, errorThrown);
				console.error('响应状态码:', jqXHR.status);
				console.error('响应内容:', jqXHR.responseText);
				alert('查詢失敗: ' + textStatus);
			});
	}
	//ondblclick 按2下開視窗
	function search_admi13_window(row_obj) {
		if ($.isNumeric(row_obj)) {
			row = row_obj;
		} else {
			var row = $(row_obj).parent().parent().parent()[0].id.substr(12);
		}
		selected_row = row;

		console.log('sfci01:' + $("#sfci01").val());

		$('#ad013_ifmain').attr('src', "<?php echo base_url() ?>index.php/scm/admi13/display_child/0/" + $("#sfci01").val());

		$.blockUI({
			css: {
					top: '15%',
					left: '25%',
					height: '75%',
					width: '75%',
					overflow: 'auto',
				top: '15%',
				left: '25%',
				height: '80%',
				width: '70%',
				overflow: 'hidden',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				'-khtml-border-radius': '10px',
				'border-radius': '10px',
			},
			message: $('#divFadmi13'),
			onOverlayClick: clear_admi13disp_sql
		});
		$('.close').click($.unblockUI);
	}
// 页面加载完成后输出调试信息
console.log('✅ sfci03m_fundjs_v.php 已加载');
console.log('✅ check_cmsi19d 函数已定义，类型:', typeof check_cmsi19d);
</script>
<div id="divFadmi13" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="ad013_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/scm/admi13/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<!--開視窗 品號品名    -->
<div id="divFinvi02d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!--開視窗 製令製程    -->
<div id="divFsfci03" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="moci01_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/sfc/sfci03/display_child/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!--開視窗 機台    -->
<div id="divFcmsi03d" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi03/displaygt_child"+$("#cmsi04").val() allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>


<!--開視窗圖1客戶計價 copi02 有屬性不必下 src   -->
<div id="divFcopi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="hp_ifmain1" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cop/copi02/display_child/"+$("#copi01").val() allowTransparency="flase" id="hp_ifmain" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- //查詢製令性質開視窗moci01 -->
<div id="divFmoci01" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url() ?>index.php/moc/moci01/display_child1_moci01" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>

<!-- //查詢製程代號開視窗cmsi19 -->
<div id="divFcmsi19" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="cmsi19_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi19/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>
<!-- //查詢製程代號開視窗cmsi19new -->
<div id="divFcmsi19new" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe allowTransparency="flase" id="cmsi19new_disp" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	<!-- <iframe src="<?php echo base_url() ?>index.php/cms/cmsi19/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> -->
</div>

<!-- 查詢品號類別開視窗invi02 -->
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<!--<iframe src="<?php echo base_url() ?>index.php/inv/invi02/display_childa" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
    -->
</div>