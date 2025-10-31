<div id="container">
	<div id="header">
		<?php
		$date = date("Ymd");

		if (!isset($ME001)) {
			$ME001 = $this->input->post('ME001');
		} else {
			$ME001 = '';
		}
		if (!isset($ME001disp)) {
			$ME001disp = $this->input->post('ME001');
		} else {
			$ME001disp = '';
		}
		$ME002 = $this->input->post('ME002');
		$ME003 = date("Y/m/d");
		$ME004 = 'Y';
		$ME004disp = $this->input->post('ME004disp');
		if (!isset($ME005)) {
			$ME005 = 'N';
		} else {
			$ME005 = 'Y';
		}
		$ME006 = $this->input->post('ME006');
		$ME006disp = $this->input->post('ME006');
		$ME007 = $this->input->post('ME007');
		$ME007disp = $this->input->post('ME007disp');
		if (!isset($admq04adisp)) {
			$admq04adisp = $this->input->post('ME004');
		} else {
			$admq04adisp = '';
		}
		if (!isset($cmsq05adisp)) {
			$cmsq05adisp = $this->input->post('ME007');
		} else {
			$cmsq05adisp = '';
		}
		$ME001 = $seq1;
		if ($seq2 == '5111') {
			$ME002 = '4001';
		} else if ($seq2 == '5101') {
			$ME002 = '3001';
		} else if ($seq2 == '5103') {
			$ME002 = '5001';
		} else if ($seq2 == '5104') {
			$ME002 = '2001';
		} else {
			$ME002 = '1001';
		}

		?>

		<div id="content">
			<div class="box">
				<div class="heading">
					<h1><img src="<?php echo base_url() ?>assets/image/order.png" alt="" /> 製令製程作業 - 展開　　　</h1>
					<div style="float:left;padding-top: 5px;">
						<a class="button" href='javascript:send_back_bomi07("<?php echo $ME001; ?>","<?php echo $ME002; ?>","<?php echo $ME003; ?>");'>確 定Alt+s<img src="<?php echo base_url() ?>assets/image/png/save.png" /> </a>
						<button type='button' onclick="window.parent.$.unblockUI();" class="button" accesskey="x" name='cancel' value='&nbsp;取 消&nbsp;'><span>取 消Alt+x</span><img src="<?php echo base_url() ?>assets/image/png/cancle.png" /></button>
					</div>
				</div>


				<div class="content">
					<form class="cmxform" id="commentForm" name="form" method="post" style="width:80%; enctype=" multipart/form-data" action="<?php echo base_url() ?>index.php/bom/bomi02/editbefore">
						<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
						<div id="tab-general">


							<table class="form14">
								<!-- 表格 -->

								<tr>
									<td class="start14a" width="12%"><span class="required">輸入途程品號：</span> </td>
									<td class="normal14a" width="88%">
										<input type="text" tabIndex="1" id="invi02" class="invi02" onKeyPress="keyFunction()" name="ME001" value="<?php echo $ME001; ?>" readonly="readonly" />
										<!--<input type="text" tabIndex="1" id="invi02" class="invi02" onKeyPress="keyFunction()" name="ME001" onchange="check_invi02(this)" value="<?php echo $ME001; ?>" />
										 <img id="Showinvi02disp" src="<?php echo base_url() ?>assets/image/png/distance.png" alt="" align="top" /></a>
										<span id="invi02disp"> <?php echo $ME001disp; ?> </span> -->
									</td>

								</tr>
								<tr>
									<td class="normal14">輸入途程代號：</td>
									<td class="normal14"><input type="text" tabIndex="2" id="ME002" onKeyPress="keyFunction()" name="ME002" value="<?php echo  $ME002; ?>" /></td>

								</tr>
								<tr>
									<td class="normal14">輸入預計開工：</td>
									<td class="normal14"><input tabIndex="3" ondblclick="scwShow(this,event);" id="ME003" onKeyPress="keyFunction()" onchange="dateformat_ymd(this);" name="ME003" value="<?php echo $ME003; ?>" size="12" type="text" style="background-color:#FFFFE4" />
										<img onclick="scwShow(ME003,event);" src="<?php echo base_url() ?>assets/image/png/calendar.png" alt="" align="top" />
									</td>
								</tr>

							</table>



					</form>
				</div>
			</div>
		</div>

		<?php if ($message != ' ') { ?>
			<div class="success"><?php echo '  提示訊息：' . $message . '<span>' . '</span>' .
										'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div> <?php } ?>
	</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#ME002').focus();
	});


	function send_back_bomi07(ME001, ME002, ME003, ME004, ME006, ME006disp) {
		// console.log('ME001_test');
		// console.log(ME001);
		var ME001 = $('input[name=\'ME001\']').attr('value');
		var ME002 = $('input[name=\'ME002\']').attr('value');
		var ME003 = $('input[name=\'ME003\']').attr('value');
		// var ME004 = $('input[name=\'ME004\']').attr('value');
		// var ME006 = $('input[name=\'ME006\']').attr('value');
		// var ME006disp = $('#cmsi03disp').val();
		// console.log(ME003);
		window.parent.$.unblockUI();
		//console.log(window.parent.import_copi05);
		if (window.parent.import_bomi07) { //以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
			window.parent.import_bomi07(ME001, ME002, ME003, ME004, ME006, ME006disp);
			$.ajax({
				method: "POST",
				url: "<?php echo base_url() ?>index.php/bom/bomi02/clear_sql"
			});
		}
	}
</script>