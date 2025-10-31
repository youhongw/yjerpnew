  <div class="box2">
  	<!-- div-1 -->
  	<div class="heading">
  		<h1><img src="<?php echo base_url() ?>assets/image/order.png" onclick="location = '<?php echo base_url() ?>index.php/pal/pali56/display_bak?dateo=<?php echo $dateo; ?>&datec=<?php echo $datec; ?>&epyo=<?php echo $epyo; ?>&epyc=<?php echo $epyc; ?>&type=<?php echo $type; ?>'" alt="" /> 出勤資料管理作業 - 瀏覽</h1>
  		<!--  <div class="buttons"> -->
  		<div style="float:right; ">
  			<div style="float:left;" class="button">
  				日常<input id="type" name="type" type="radio" style="height:14px;" value="A" onclick="change_date();" <? if (@$type == "A") {
																															echo "checked";
																														} ?> />
  				異常(包含已請)<input id="type" name="type" type="radio" style="height:14px;" value="B" onclick="change_date();" <? if (@$type == "B") {
																																echo "checked";
																															} ?> />
  				異常(未請假)<input id="type" name="type" type="radio" style="height:14px;" value="C" onclick="change_date();" <? if (@$type == "C") {
																																echo "checked";
																															} ?> />
  			</div>
  			<div style="float:left;" class="button">起始員編：
  				<input id="epyo" maxlength='10' onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');" name=" epyo" style="height:14px;" value="<?php if (@$epyo) {
																																							echo $epyo;
																																						} else {
																																							echo "";
																																						} ?>" size="10" />
  			</div>
  			<div style="float:left;" class="button">終止員編：
  				<input id="epyc" maxlength='10' onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');" name=" epyc" style="height:14px;" value="<?php if (@$epyc) {
																																							echo $epyc;
																																						} else {
																																							echo "";
																																						} ?>" size="10" />
  			</div>
  			<div style="float:left;" class="button">起始日期：
  				<input id="dateo" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="dateo" style="height:14px;" value="<?php if (@$dateo && strlen($dateo) == 8) {
																																								echo substr($dateo, 0, 4) . "-" . substr($dateo, 4, 2) . "-" . substr($dateo, 6, 2);
																																							} else {
																																								echo date("Y-m-d");
																																							} ?>" size="10" onclick="scwShow(this,event);" />
  			</div>
  			<div style="float:left;" class="button">終止日期：
  				<input id="datec" maxlength='10' onkeyup="this.value=this.value.replace(/[^0-9\/\-\.]/gi,'');" name="datec" style="height:14px;" value="<?php if (@$datec && strlen($dateo) == 8) {
																																								echo substr($datec, 0, 4) . "-" . substr($datec, 4, 2) . "-" . substr($datec, 6, 2);
																																							} else {
																																								echo date("Y-m-d");
																																							} ?>" size="10" onclick="scwShow(this,event);" />
  			</div>
  			<div style="float:left;" class="button">部門：
  				<select name="dep" id="dep">
  					<option value="*">全選</option>
  					<option value="DS001">总经理室</option>
  					<option value="DS002">協理室</option>
  					<option value="DS003">财务部</option>
  					<option value="DS004">营销部</option>
  					<option value="DS005" selected>管理部</option>
  					<option value="DS006">研发部</option>
  					<option value="DS007">品保部</option>
  					<option value="DS008">生产部(生管)</option>
  					<option value="DS009">采购部</option>
  					<option value="DS010">仓储部</option>
  					<option value="DS011">模具车间</option>
  					<option value="DS012">铸造车间</option>
  					<option value="DS013">橡胶车间</option>
  					<option value="DS014">注塑车间</option>
  					<option value="DS015">PU车间</option>
  					<option value="DS016">冲压车间</option>
  					<option value="DS017">緊固件车间</option>
  					<option value="DS018">装配车间</option>
  				</select>
  			</div>
  			<?PHP if (substr($this->session->userdata('sysmg006'), 0, 1) == 'Y') { ?>
  				<!--<a onclick="location = '<?php echo base_url() ?>index.php/pal/pali56/beforeadd'" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url() ?>assets/image/png/add.png" /></a>-->
  			<?PHP } ?>
  			<?PHP if (substr($this->session->userdata('sysmg006'), 9, 1) == 'Y') { ?>
  				<!--<a onclick="location = '<?php echo base_url() ?>index.php/pal/pali56/copyform'"  style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url() ?>assets/image/png/copy.png" /></a>-->
  			<?PHP } ?>
  			<?PHP if (substr($this->session->userdata('sysmg006'), 1, 1) == 'Y') { ?>
  				<!--<a onclick="location = '<?php echo base_url() ?>index.php/pal/pali56/findform'"  style="float:left" accesskey="k" class="button"><span>進階查詢 k </span><img src="<?php echo base_url() ?>assets/image/png/find.png" /></a>-->
  			<?PHP } ?>
  			<?PHP if (substr($this->session->userdata('sysmg006'), 3, 1) == 'Y') { ?>
  				<!--<a onclick="$('form').submit();"  style="float:left" accesskey="-" class="button"><span>選取刪除</span><img src="<?php echo base_url() ?>assets/image/png/del.png" /></a>-->
  			<?PHP } ?>
  			<?PHP if (substr($this->session->userdata('sysmg006'), 6, 1) == 'Y') { ?>
  				<a onclick="open_winprint();" style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url() ?>assets/image/png/print.png" /></a>
  			<?PHP } ?>
  			<?PHP if (substr($this->session->userdata('sysmg006'), 10, 1) == 'Y') { ?>
  				<!--<a onclick="open_winexcel();"    style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url() ?>assets/image/png/excel.png" /></a> -->
  			<?PHP } ?>
  			<!-- <a onclick="location = '<?php echo base_url() ?>index.php/pal/pali56/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url() ?>index.php/pal/pali56/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
  			<a onclick="location = '<?php echo base_url() ?>index.php/main/index/113'" style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url() ?>assets/image/png/close.png" /></a>
  		</div>
  	</div>
  	<style>
  		.list tbody td {
  			background-color: inherit;
  		}
  	</style>
  	<div class="content">
  		<!-- div-2 -->
  		<form action="<?php echo base_url() ?>index.php/pal/pali56/delete" method="post" enctype="multipart/form-data" id="form">
  			<table class="list">
  				<!-- 表格開始 -->
  				<thead>
  					<tr>
  						<!-- 表格表頭 -->
  						<td width="1%" style="text-align: center;">
  							<input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
  						</td><!-- 表格表頭 -->
  						<td width="1.5%" style="text-align: center;">
  							序號
  						</td>
  						<td width="6%" class="left">
  							<!-- <?php echo anchor("pal/pali56/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc'), '部門名稱'); ?>
  							<?php if ($sort_order == 'asc') { ?> <img src="<?php echo base_url() ?>assets/image/desc.png" /> <?php } else { ?>
  								<img src="<?php echo base_url() ?>assets/image/asc.png" /> <?php }  ?> -->
  							部門名稱
  						</td>
  						<td width="6%" class="left">
  							<!-- <?php echo anchor("pal/pali56/display/count_count/" . (($sort_order == 'asc' && $sort_by == 'count_count') ? 'desc' : 'asc'), '刷卡日期'); ?>
  							<?php if ($sort_order == 'asc') { ?> <img src="<?php echo base_url() ?>assets/image/desc.png" /> <?php } else { ?>
  								<img src="<?php echo base_url() ?>assets/image/asc.png" /> <?php }  ?> -->
  							刷卡日期
  						</td>
  						<td width="5%" class="left">
  							<!-- <?php echo anchor("pal/pali56/display/tf002/" . (($sort_order == 'asc' && $sort_by == 'tf002') ? 'desc' : 'asc'), '員工編號'); ?>
  							<?php if ($sort_order == 'asc') { ?> <img src="<?php echo base_url() ?>assets/image/desc.png" /> <?php } else { ?>
  								<img src="<?php echo base_url() ?>assets/image/asc.png" /> <?php }  ?> -->
  							員工編號
  						</td>
  						<td width="5%" class="left">
  							<!-- <?php echo anchor("pal/pali56/display/c.me002/" . (($sort_order == 'asc' && $sort_by == 'c.me002') ? 'desc' : 'asc'), '員工姓名'); ?>
  							<?php if ($sort_order == 'asc') { ?> <img src="<?php echo base_url() ?>assets/image/desc.png" /> <?php } else { ?>
  								<img src="<?php echo base_url() ?>assets/image/asc.png" /> <?php }  ?> -->
  							員工姓名
  						</td>
  						<td width="25%" class="left">
  							<!-- <?php echo anchor("pal/pali56/display/creator/" . (($sort_order == 'asc' && $sort_by == 'creator') ? 'desc' : 'asc'), '刷卡時間'); ?>
  							<?php if ($sort_order == 'asc') { ?> <img src="<?php echo base_url() ?>assets/image/desc.png" /> <?php } else { ?>
  								<img src="<?php echo base_url() ?>assets/image/asc.png" /> <?php }  ?> -->
  							刷卡時間
  						</td>
  						<td width="25%" class="left">
  							<!-- <?php echo anchor("pal/pali56/display/modi_date/" . (($sort_order == 'asc' && $sort_by == 'modi_date') ? 'desc' : 'asc'), '狀態'); ?>
  							<?php if ($sort_order == 'asc') { ?> <img src="<?php echo base_url() ?>assets/image/desc.png" /> <?php } else { ?>
  								<img src="<?php echo base_url() ?>assets/image/asc.png" /> <?php }  ?> -->
  							狀態
  							<span style="float:right;">應刷卡員工人數:<?php echo $total_num; ?>人</span>
  						</td>
  						<!--<td width="18%" class="center"></td>
          <td width="18%" class="center">&nbsp修改管理&nbsp </td>-->
  					</tr>
  				</thead>

  				<tbody>
  					<!-- 表格內容輸入篩選查詢 第一,二欄 刪除選項及序號空白 -->
  					<?php $filter_tf002 = '';
						$filter_me002 = '';
						$filter_tf002 = '';
						$filter_tf003 = '';
						$filter_tf004 = '';
						$filter_tf005 = '';
						$filter_tf007 = ''; ?>
  					<tr class="filter">
  						<td class="left"></td>
  						<td class="left"></td>
  						<td align="left">
  							<div class="button-search"></div>
  							<input type="text" id="filter_tf002" name="filter_tf002" value="" size="8" disabled />
  	</div>
  	</td>
  	<td align="left">
  		<div class="button-search"></div>
  		<input type="text" id="filter_tf002" name="filter_tf002" value="" size="8" disabled />
  </div>
  </td>
  <td class="left">
  	<div class="button-search"></div>
  	<input type="text" id="filter_me002" name="filter_me002" value="" size="10" disabled />
  </td>

  <td class="left">
  	<div class="button-search"></div>
  	<input type="text" id="filter_count_count" name="filter_count_count" value="" size="10" disabled />
  </td>

  <td class="left">
  	<div class="button-search"></div>
  	<input type="text" id="filter_creator" name="filter_creator" value="" size="12" disabled />
  	<div style="float:right;background-color:rgba(37, 70, 250, 0.15);width:16px;">補卡</div>
  	</div>
  </td>
  <td class="left">
  	<div class="button-search"></div>
  	<input type="text" name="filter_modi_date" value="" size="12" disabled />
  	<div style="float:right;background-color:rgba(255, 0, 0, 0.15);width:16px;">復原</div>
  	</div>
  </td>
  <!--<td  align="center"><a onclick="filter();" class="button">篩選▲</a></td>		
	      <td  align="center"><a onclick="filtera();" class="button">篩選▼</a></td>-->
  <!-- <button type='submit'  name='buttonfilter' onclick="filter();" class="button" value='篩選1'><span>篩選1</span></button>  -->
  </tr>

  <!--session 變數取消 	  
		<?php $this->session->unset_userdata('tf002'); ?> -->
  <?php $chkval = 1;
	//echo "<pre>";var_dump($results);exit;
	?>
  <?php if (count(@$results) != 0 && is_array(@$results)) {
		foreach ($results as $day_data) {
			$num = 0;
			echo "<tr style='border:2px;border-style:solid;' ><td colspan='7'></td></tr>";
			foreach ($day_data as $row) {
				$num++; ?>
  			<tr>
  				<td style="text-align: center;"> <input type="checkbox" name="selected[]" id="cbbox" value="<?php echo $row->te002 . "/" . $row->te001 ?>" onclick="$('input[name=\'selected\']').attr('checked', this.checked);" /></td>
  				<td class="left"><?php echo $num; ?></td>
  				<td class="left"><?php echo $row->me002; ?></td>
  				<td class="left"><?php echo substr($row->te002, 0, 4) . '/' . substr($row->te002, 4, 2) . '/' . substr($row->te002, 6, 2); ?></td>
  				<td class="left"><?php if ($row->te001) {
										echo $row->te001;
									} else {
										echo $row->te004;
									} ?></td>
  				<td class="left"><?php echo $row->mv002; ?></td>
  				<td class="left" id="td_<?php echo $row->te002 . "_" . $row->te001; ?>">
  					<?php if (@$row->te003) {
							foreach ($row->te003 as $k => $v) {
								$div_str = "<div ";					//Start

								$div_str .= "class='time_" . $row->te002 . "_" . $row->te001 . "' "; //加入前墜
								$div_str .= "style='float:left;margin:2px; '";
								$div_str .= "id='div_" . $row->te002 . "_" . $row->te001 . "_" . $v . "' ";
								$div_str .= " >";

								$div_str .= "<span ";				//Start
								$div_str .= "class='span_" . $row->te002 . "_" . $row->te001 . "_" . $v . "'"; //加入前墜
								$div_str .= "style='float:left;' ";
								$div_str .= "id='disp_" . $row->te002 . "_" . $row->te001 . "_" . $v . "'";
								if (substr($this->session->userdata('sysmg006'), 2, 1) == 'Y') {
									$div_str .= "ondblclick='edit_time(\"" . $row->te002 . "\",\"" . $row->te001 . "\",\"" . $v . "\")'";
								}
								$div_str .= " >";
								$div_str .= $v;
								$div_str .= "</span>";				//結尾

								$div_str .= "<span ";				//Start
								$div_str .= "class='span_" . $row->te002 . "_" . $row->te001 . "_" . $v . "' "; //加入前墜
								$div_str .= "style='float:left;' ";
								$div_str .= "id='form_" . $row->te002 . "_" . $row->te001 . "_" . $v . "' ";
								$div_str .= " >";
								$div_str .= "<input ";				//Start
								$div_str .= "class='ipt_" . $row->te002 . "_" . $row->te001 . "' "; //加入前墜
								$div_str .= "id='ipt_" . $row->te002 . "_" . $row->te001 . "_" . $v . "' ";
								$div_str .= "style='float:left;height:14px;text-align:center;display:none;' ";
								$div_str .= "size='4' value='" . $v . "' maxlength='4'";
								$div_str .= ' onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'' . '\');" />';					//結尾
								$div_str .= "<input ";				//Start
								$div_str .= "id='del_" . $row->te002 . "_" . $row->te001 . "_" . $v . "' ";
								$div_str .= "style='float:left;width:20px;height:20px;text-align:center;display:none;margin:0px;padding:0px;' ";
								$div_str .= "type='button' size='4' value='x' ";
								if (substr($this->session->userdata('sysmg006'), 3, 1) == 'Y') {
									$div_str .= "onclick='del_time(\"" . $row->te002 . "\",\"" . $row->te001 . "\",\"" . $v . "\")'";
								}
								$div_str .= " />";					//結尾
								$div_str .= "</span>";				//結尾

								$div_str .= "</div>";				//結尾
								echo $div_str;
							}
						} ?>
  					<?php if (substr($this->session->userdata('sysmg006'), 0, 1) == 'Y') { ?><div style="float:right;background-color:rgba(37, 70, 250, 0.15);width:10px;height:14px;" ondblclick='add_time("<?php echo $row->te002; ?>","<?php echo $row->te001; ?>");'></div><?php } ?>
  				</td>
  				<td class="left">
  					<?php if (substr($this->session->userdata('sysmg006'), 0, 1) == 'Y') { ?><div style="float:right;background-color:rgba(255, 0, 0, 0.15);width:10px;height:14px;margin:3px 0px 3px 8px;" ondblclick='reconstruction("<?php echo $row->te002; ?>","<?php echo $row->te001; ?>");'></div><?php } ?>

  					<?php if (substr($this->session->userdata('sysmg006'), 0, 1) == 'Y') { ?>
  						<div style="float:right;">
  							<input type="button" value="請假" <?php if (@$row->status["leave"] == '') { ?>onclick="window.open('<?php echo base_url() ?>index.php/pal/pali54/addform?tg001=<?php echo $row->te001; ?>&tg002=<?php echo $row->me001; ?>&tg003=<?php echo $row->te002; ?>')" <?php } ?> <?php if (@$row->status["leave"] != '') { ?>onclick="window.open('<?php echo base_url() ?>index.php/pal/pali54/updform/<?php echo $row->te001; ?>/<?php echo $row->te002; ?>')" <?php } ?> />
  							<!-- <input type="button" value="補卡" style="background-color: aquamarine;" <?php { ?>onclick="window.open('<?php echo base_url() ?>index.php/pal/pali52/addform?te001=<?php echo $row->te001; ?>&te002=<?php echo $row->te002; ?>&te004=<?php echo $row->mv028; ?>')" <?php } ?> /> -->

  						</div>
  					<?php } ?>
  					<?php foreach ($row->status as $status_key => $status_val) {
							if ($status_key == "error") {
								echo "<font color='red'>" . $status_val . "</font> ";
							}
							if ($status_key == "late") {
								echo "<font color='red'>" . $status_val . "</font> ";
							}
							if ($status_key == "absenteeism") {
								echo "<font color='orange'>" . $status_val . "</font> ";
							}
							if ($status_key == "leave") {
								echo "<font color='blue'>" . $status_val . "</font> ";
							}
							if ($status_key == "forgot") {
								echo "<font color='firebrick'>" . $status_val . "</font> ";
							}
							if ($status_key == "over") {
								echo "<font color='green'>" . $status_val . "</font> ";
							}
						}
						?>
  				</td>
  				<!-- <td class="center"> <a onclick="return CheckForm();" href="<?php echo site_url('pal/pali56/del/' . $row->tf001 . "/" . trim($row->tf003)) ?>" id="delete1"  >[ 刪除 ]</a></td>  -->
  				<!--<td class="center"></td>
          <?PHP if (substr($this->session->userdata('sysmg006'), 2, 1) == 'Y') { ?>                 
		  <td class="center"><a href="javascript:edit_time(<?php echo $row->te002 . "," . $row->te001 ?>)">[ 修改 </a><img src="<?php echo base_url() ?>assets/image/png/modi.png" />]</td>
	      <?PHP } ?>-->
  			</tr>
  			<?php $chkval += 1; ?>
  <?php }
			echo "<tr style='border:1px;border-style:solid;' ><td colspan='7'></td></tr>";
		}
	} else {
		echo "<font color='red' size='6'>無刷卡資料!!!</font>";
	} ?>
  </tbody>
  </table>
  <!-- 修改時 留在原來那一筆資料使用 -->
  <?php $this->session->set_userdata('search', $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6, 0));  ?>
  <!--    <?php echo $this->pagination->create_links(); ?>	
			    <?php echo $this->session->userdata('find05');
				$find05; ?><?php echo $this->session->userdata('find07');
							$find07;  ?> -->
  <div class="success">
  	<?php
		if ($message != '資料瀏覽成功!') {
			$message = '<b><font color="red">' . $message . '</font></b><br>';
		} else {
			$message = '<font color="blue">' . $message . '</font><br>';
		}
		?>
  	<?php echo date("Y/m/d") . '  提示訊息：' . $message . '<span>' . '</span>' .
			'◎操作說明:[ 雙擊刷卡時間可修改或刪除刷卡時間,可雙擊有顏色方塊有功能使用, 列印可自設網址列資訊不印. ] ' ?><br>
  	<?php echo '快速鍵使用： Chrome、IE、Safari、Opera 15+ 等請使用[Alt] + [key] ； Firefox 請使用[Alt] + [Shift] + [key]' ?>
  </div>
  </form>

  </div> <!-- div-2 -->
  </div> <!-- div-1 -->
  </div> <!-- div-0 -->

  <script>
  	// <!--列印及轉excel 開新視窗    	-->
  	function
  	open_winprint() {
  		//
  		// window.open('/index.php/pal/pali56/printdetail')
  		window.location = '<?php echo base_url() ?>index.php/pal/pali56/printdetail?dateo=' + $('#dateo').val() + '&datec=' + $('#datec').val() + '&epyo=' + $('#epyo').val() + '&epyc=' + $('#epyc').val() + '&type=' + $('input[name=type]:checked').val();
  	}

  	function
  	open_winexcel() {
  		//
  		window.open('/index.php/pal/pali56/exceldetail')
  		window.location = "<?php echo base_url() ?>index.php/pal/pali56/exceldetail";
  	}
  </script>

  <script type="text/javascript">
  	$(document).ready(function() {
  		$('.button-search').bind('click', function() {
  			return true;
  		});
  	});
  	//參數區
  	var system_status = "normal";
  	var editing_data = new Array(3);

  	function add_time(date, epy_no) {
  		console.log(date + ":" + epy_no);
  		if (system_status != "normal") {
  			if (system_status == "editing") {
  				console.log("請解除其他欄位的編輯狀態後再進行編輯。");
  				date = editing_data[0];
  				epy_no = editing_data[1];
  				time = editing_data[2];
  				$('#ipt_' + date + '_' + epy_no + '_' + time).select();
  			}
  			if (system_status == "adding") {
  				console.log("請解除新增欄位後再進行編輯。");
  				$('#ipt_' + date + '_' + epy_no + '_new').select();
  			}
  		} else {
  			system_status = "adding";
  			editing_data[0] = date;
  			editing_data[1] = epy_no;
  			editing_data[2] = "new";

  			var new_str = "<div ";
  			new_str += "class='time_" + date + "_" + epy_no + "' "; //加入前墜
  			new_str += "style='float:left;margin:2px; '";
  			new_str += "id='div_" + date + "_" + epy_no + "_new' ";
  			new_str += " >";
  			new_str += "<span ";
  			new_str += "style='float:left;' ";
  			new_str += "id='form_" + date + "_" + epy_no + "_new' ";
  			new_str += " >";
  			new_str += "<input ";
  			new_str += "class='ipt_" + date + "_" + epy_no + "' "; //加入前墜
  			new_str += "id='ipt_" + date + "_" + epy_no + "_new' ";
  			new_str += "style='float:left;height:14px;text-align:center;' maxlength='4'";
  			new_str += "size='4' value='' ";
  			new_str += 'onkeyup="this.value=this.value.replace(/[^0-9]/gi,\'' + '\');" />';
  			new_str += "</span>";
  			new_str += "</div>";

  			$('#td_' + date + '_' + epy_no).append(new_str);
  			$('#ipt_' + date + '_' + epy_no + '_new').select();

  		}
  	}

  	function edit_time(date, epy_no, time) {
  		if (system_status != "normal") {
  			if (system_status == "editing") {
  				console.log("請解除其他欄位的編輯狀態後再進行編輯。")
  			}
  			if (system_status == "adding") {
  				console.log("請解除新增欄位後再進行編輯。")
  			}
  		} else {
  			system_status = "editing";
  			editing_data[0] = date;
  			editing_data[1] = epy_no;
  			editing_data[2] = time;
  			$('#del_' + date + '_' + epy_no + '_' + time).show();
  			$('#ipt_' + date + '_' + epy_no + '_' + time).show();
  			$('#ipt_' + date + '_' + epy_no + '_' + time).select();
  			$('#disp_' + date + '_' + epy_no + '_' + time).hide();

  		}

  	}

  	function save_time() {
  		var date = editing_data[0];
  		var epy_no = editing_data[1];
  		var old_time = editing_data[2];
  		if (system_status == "editing") {
  			var new_time = $('#ipt_' + date + '_' + epy_no + '_' + old_time).val();
  			if (new_time.length != 4) {
  				alert('字串長度有誤');
  			} else {
  				$.ajax({
  						method: "POST",
  						url: "<?php echo base_url() ?>index.php/pal/pali56/save_ajax",
  						data: {
  							date: date,
  							epy_no: epy_no,
  							new_time: new_time,
  							old_time: old_time
  						}
  					})
  					.done(function(msg) {
  						console.log(date + "-" + epy_no + "-" + old_time + ":" + msg);
  						if (msg == 'success') {
  							console.log("成功");
  							editing_data = new Array(3);
  							system_status = "normal";
  							location.reload();
  						} else {
  							alert("儲存失敗，請向資訊人員確認。");
  						}
  					});
  			}
  		}

  		if (system_status == "adding") {
  			var new_time = $('#ipt_' + date + '_' + epy_no + '_' + old_time).val();
  			console.log(editing_data);
  			if (new_time.length != 4) {
  				alert('字串長度有誤');
  			} else {
  				$.ajax({
  						method: "POST",
  						url: "<?php echo base_url() ?>index.php/pal/pali56/save_ajax",
  						data: {
  							date: date,
  							epy_no: epy_no,
  							new_time: new_time,
  							old_time: old_time
  						}
  					})
  					.done(function(msg) {
  						console.log(date + "-" + epy_no + "-" + old_time + ":" + msg);
  						if (msg == 'success') {
  							console.log("成功");
  							editing_data = new Array(3);
  							system_status = "normal";
  							location.reload();
  						} else {
  							alert("儲存失敗，請向資訊人員確認。");
  						}
  					});
  			}
  		}
  	}

  	function recover_time() {
  		console.log("recover");
  		if (editing_data[0] && system_status == "editing") {
  			console.log(editing_data);
  			var date = editing_data[0];
  			var epy_no = editing_data[1];
  			var time = editing_data[2];
  			$('#ipt_' + date + '_' + epy_no + '_' + time).val(time);
  			$('#del_' + date + '_' + epy_no + '_' + time).hide();
  			$('#ipt_' + date + '_' + epy_no + '_' + time).hide();
  			$('#disp_' + date + '_' + epy_no + '_' + time).show();

  			editing_data = new Array(3);
  			system_status = "normal";
  		}
  		if (editing_data[0] && system_status == "adding") {
  			console.log(editing_data);
  			var date = editing_data[0];
  			var epy_no = editing_data[1];
  			var time = editing_data[2];
  			$('#div_' + date + '_' + epy_no + '_' + time).remove();

  			editing_data = new Array(3);
  			system_status = "normal";
  		}
  	}

  	function del_time(date, epy_no, time) {
  		if (confirm('確定是否刪除?')) {
  			console.log("刪除" + date + " " + epy_no + " " + time);
  			$.ajax({
  					method: "POST",
  					url: "<?php echo base_url() ?>index.php/pal/pali56/del_ajax",
  					data: {
  						date: date,
  						epy_no: epy_no,
  						time: time
  					}
  				})
  				.done(function(msg) {
  					if (msg == '刪除資料成功!') {
  						alert(date + "-" + epy_no + "-" + time + ":" + msg);
  						location.reload();
  					} else {
  						alert(msg + "請聯絡資訊人員。");
  					}
  					//location.reload();
  				});
  		}
  	}

  	function reconstruction(date, epy_no) {
  		if (confirm('確定是否復原備份資料?')) {
  			console.log("復原" + date + " " + epy_no);
  			$.ajax({
  					method: "POST",
  					url: "<?php echo base_url() ?>index.php/pal/pali56/re_ajax",
  					data: {
  						date: date,
  						epy_no: epy_no
  					}
  				})
  				.done(function(msg) {
  					if (msg == '復原資料失敗!') {
  						alert(msg + "請聯絡資訊人員。");
  					} else {
  						alert(date + "-" + epy_no + ":" + msg);
  						location.reload();
  					}
  					//location.reload();
  				});
  		}
  	}

  	$(document).keyup(function(e) {
  		if (e.keyCode == 27) {
  			if (system_status != "normal") {
  				recover_time();
  			}
  		}
  		if (e.keyCode == 13) {
  			if (system_status != "normal") {
  				save_time();
  			}
  		}

  	});


  	function change_date() {
  		url = '<?php echo base_url() ?>index.php/pal/pali56/display?dateo=' + $('#dateo').val() + '&datec=' + $('#datec').val() + '&epyo=' + $('#epyo').val() + '&epyc=' + $('#epyc').val() + '&type=' + $('input[name=type]:checked').val();
  		location = url;
  	}

  	$('#epyo').keyup(function(e) {
  		if (e.keyCode == 13) {
  			console.log("HAHA!");
  			change_date();
  		}

  	});
  	$('#epyc').keyup(function(e) {
  		if (e.keyCode == 13) {
  			console.log("ㄏㄏ!");
  			change_date();
  		}

  	});
  	$('#dateo').keyup(function(e) {
  		if (e.keyCode == 13) {
  			console.log("ㄎㄧㄤㄎㄧㄤ!");
  			change_date();
  		}

  	});
  	$('#datec').keyup(function(e) {
  		if (e.keyCode == 13) {
  			console.log("夯夯!");
  			change_date();
  		}

  	});
  </script>