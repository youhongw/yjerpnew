<div id="container"> <!-- div-1 -->
	<div id="header"> <!-- div-2 -->
		<div class="div1">
			<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
				<div class="div3">
				<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
				<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
				<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
				</div>
		</div>
	</div>
	
	<?php 
	if(!isset($puri04)) { $puri04=$this->input->post('puri04'); }
	if(!isset($puri04disp)) { $puri04disp=$this->input->post('puri04disp'); }
	if(!isset($tk002)) { $tk002=$this->input->post('tk002'); }
	if(!isset($puri01)) { $puri01=$this->input->post('puri01'); }
	if(!isset($puri01disp)) { $puri01disp=$this->input->post('puri01disp'); }
	if(!isset($cmsi02)) { $cmsi02=$this->input->post('cmsi02'); }
	if(!isset($cmsi02disp)) { $cmsi02disp=$this->input->post('cmsi02disp'); }
	if(!isset($tk018)) { $tk018=$this->input->post('tk018'); }
	if(!isset($tk009)) { $tk009=$this->input->post('tk009'); }
	if(!isset($tk010)) { $tk010=$this->input->post('tk010'); }
	if(!isset($tk013)) { $tk013=$this->input->post('tk013'); }
	if(!isset($tk026)) { $tk026=$this->input->post('tk026'); }
	if(!isset($tk029)) { $tk029=$this->input->post('tk029'); }
	if(!isset($tk012)) { $tk012=$this->input->post('tk012'); }
	if(!isset($cmsi06)) { $cmsi06=$this->input->post('cmsi06'); }
	if(!isset($cmsi06disp)) { $cmsi06disp=$this->input->post('cmsi06disp'); }
	if(!isset($cmsi07)) { $cmsi06disp=$this->input->post('cmsi07'); }
	if(!isset($tk008)) { $tk008=$this->input->post('tk008'); }
	if(!isset($cmsi21)) { $cmsi21=$this->input->post('cmsi21'); }
	if(!isset($cmsi21disp)) { $cmsi21disp=$this->input->post('cmsi21disp'); }

	
	?>
  
	<div id="content"> <!-- div-3 --> 
		<div class="box"> <!-- div-4 -->
			<div class="heading">
				<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 託外退貨單建立作業 - 新增</h1>
				<div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci07/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
			</div>
		<div class="content"> <!-- div-5 -->
			<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci07/addsave" >	
			<div id="tab-general"> <!-- div-6 -->
				<table class="form14"  >     <!-- 頭部表格 -->
					<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
					<tr>
						<td class="start14a"  width="10%"><span class="required">託外退貨單別：</span> </td>
						<td class="normal14a"  width="22%">
							<input tabIndex="1" id="puri04" name="puri04" onKeyPress="keyFunction()"  value="<?php echo $puri04; ?>" onChange="check_puri04(this);check_title_no();" type="text" required />
							<a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
							<span id="puri04disp"><?php echo $puri04disp ?></span>
						</td>
			
						<td class="normal14a" width="10%" >單據日期： </td>
						<td class="normal14a"  width="24%" >
							<input tabIndex="2" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);check_title_no();" id="Ddate" onKeyPress="keyFunction()"  name="Ddate"  value="<?php echo date("Y/m/d"); ?>"  size="12" type="text" style="background-color:#E7EFEF"  />
						</td>
			
						<td class="normal14a" width="10%" ><span class="required">託外退貨單號：</span> </td>
						<td class="normal14a"  width="24%" >
							<input tabIndex="3" id="tk002" onKeyPress="keyFunction()" name="tk002" value="<?php echo $tk002; ?>" size="20" type="text" required />
						</td>
					</tr>		
		  
					<tr>
						<td class="normal14" >加工廠商：</td>
						<td class="normal14" >
							<input   tabIndex="4" id="puri01" onKeyPress="keyFunction()" onchange="check_puri01(this)" name="puri01" value="<?php echo $puri01; ?>"  type="text" required />
							<a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
							<span id="puri01disp"><?php echo $puri01disp; ?></span>
						</td>
		
						<td class="normal14" >廠別：</td>
						<td class="normal14a" >
							<input tabIndex="5" id="cmsi02" onKeyPress="keyFunction()"  name="cmsi02" onchange="check_cmsi02(this)"  value="<?php echo $cmsi02; ?>"  type="text" required/>
							<a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
							<span id="cmsi02disp"><?php echo $cmsi02disp; ?></span>
						</td>
		
						<td class="normal14">列印次數：</td>
						<td  class="normal14"  >
							<input tabIndex="9" id="tk018" name="tk018" value="<?php echo $tk018; ?>" size="10" onKeyPress="keyFunction()" onchange="" type="text" />
						</td>
					</tr>
			
					<tr>
						<td class="normal14" >託外退貨日期：</td>
						<td class="normal14"  >
							<input type="text" tabIndex="7" onKeyPress="keyFunction()" name="tk003" value="<?php echo date("Y/m/d");?>" style="background-color:#E7EFEF" readonly="readonly"/>
						</td>
		
						<td class="normal14">簽核狀態：</td>
						<td  class="normal14"  >
							<select id="tk035" tabIndex="8"  onKeyPress="keyFunction()" name="tk035"   style="background-color:#EBEBE4" >
								<option value='N'>N.不執行電子簽核</option>                                                                        
								<option value='0'>0.待處理</option>
								<option value='1'>1.簽核中</option>
								<option value='2'>2.退件</option>
								<option value='3'>3.已核准</option>	
								<option value='4'>4.取消確認中</option>	
								<option value='5'>5.作廢中</option>	
								<option value='6'>6.取消作廢中</option>				
							</select>
						</td>
						
						<td class="normal14" >確認碼：</td>
						<td class="normal14" >
							<select tabIndex="13" id="tk021" name="tk021" onKeyPress="keyFunction()">
							<option value='Y'>Y確認</option>                                                                        
							<option value='N'>N取消確認</option>
							<option value='V'>V作廢</option>
							</select>
							<span id="approved" ></span>
						</td>
					</tr>
			
					<tr>
						<td class="normal14a" >備註：</td>
						<td class="normal14a" >
							<input  tabIndex="12"  id="tk009" onKeyPress="keyFunction()"   name="tk009" value="<?php echo $tk009; ?>" type="text"     />
						</td> 
					</tr>
				</table>
				
				<div class="abgne_tab"> <!--div-6-->
					<ul class="tabs">
						<li><a href="#tab1" accesskey="a">發票資料</a></li>
						<li><a href="#tab2" accesskey="a">其他資料</a></li>
					</ul>
				

					<div class="tab_container">
						<div id="tab1" class="tab_content">
							<table class="form14">   
								<tr>
									<td class="normal14a"  width="10%">統一編號：</td>
									<td class="normal14a"  width="22%">
										<input tabIndex="1" id="tk010" name="tk010" onKeyPress="keyFunction()"  value="<?php echo $tk010; ?>" onChange="" type="text"/>
									</td>
			
									<td class="normal14a" width="10%" >發票號碼： </td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="1" id="tk013" name="tk013" onKeyPress="keyFunction()"  value="<?php echo $tk013; ?>" onChange="" type="text"/>
									</td>
			
									<td class="normal14a" width="10%" >申報年月：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="3" id="tk026" onKeyPress="keyFunction()" name="tk026" value="<?php echo $tk026; ?>" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" type="text" style="background-color:#E7EFEF" />
									</td>
								</tr>
								
								<tr>
									<td class="normal14a"  width="10%">發票聯數：</td>
									<td class="normal14a"  width="22%">
										<select id="tk011" name="tk011" tabindex="13" onKeyPress="keyFunction()">
											<option value='1'>1.二聯式</option>
											<option value='2'>2.三聯式</option>
											<option value='3'>3.二聯式收銀機發票</option>
											<option value='4'>4.三聯式收銀機發票</option>
											<option value='5'>5.電子計算機發票</option>
											<option value='6'>6.免用統一發票</option>
										</select>
									</td>
									<script>$('#tk011').val('2');</script>
			
									<td class="normal14a" width="10%" >課稅別： </td>
									<td class="normal14a"  width="24%" >
										<select id="tk014" name="tk014" tabindex="13" onKeyPress="keyFunction()" onchange="exchange_tax2()" />
											<option value='1'>1.應稅內含</option>
											<option value='2'>2.應稅外加</option>
											<option value='3'>3.零稅率</option>
											<option value='4'>4.免稅</option>
											<option value='9'>9.不計稅</option>
										</select>
									</td>
									<script>$('#tk014').val('2');</script>
			
									<td class="normal14a" width="10%" >營業稅率：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="3" id="tk029" onKeyPress="keyFunction()" name="tk029" value="<?php if($tk029 != ""){echo $tk029;}else{echo $this->session->userdata('sysma004');}; ?>" size="20" type="text" />
									</td>
								</tr>
								<tr>
									<td class="normal14a"  width="10%">發票日期：</td>
									<td class="normal14a"  width="22%">
										<input tabIndex="1" id="tk012" name="tk012" value="<?php echo $tk012; ?>"  onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" type="text" style="background-color:#E7EFEF"/>
									</td>
			
									<td class="normal14a" width="10%" >扣抵區分： </td>
									<td class="normal14a"  width="24%" >
										<select name="tk015" id="tk015" onKeyPress="keyFunction()">
											<option value="1">1.可扣抵進貨及費用</option>
											<option value="2">2.可扣抵固定資產</option>
											<option value="3">3.不可扣抵進貨及費用</option>
											<option value="4">4.不可扣抵固定資產</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						
						<div id="tab2" class="tab_content">
							<table class="form14">
								<tr>
									<td class="normal14a"  width="10%">幣別：</td>
									<td class="normal14a"  width="24%">
										<input tabIndex="1" id="cmsi06" name="cmsi06" onKeyPress="keyFunction()"  value="<?php if($cmsi06 != ""){echo $cmsi06;}else{echo "NTD";}; ?>" onchange="check_cmsi06(this);check_cmsi07(this);" onblur="exchange_tax2();" type="text"  />
										<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
										<span id="cmsi06disp"></span>
									</td>
			
									<td class="normal14a" width="10%" >匯率： </td>
									<td class="normal14a"  width="22%" >
										<input tabIndex="1" id="cmsi07" name="cmsi07" onKeyPress="keyFunction()"  value="" onchange="" type="text" style="background-color:#EBEBE4" readonly="readonly" />
										<span id="cmsi07disp"></span>
									</td>
			
									<td class="normal14a" width="10%" >件數：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="3" id="tk008" onKeyPress="keyFunction()" name="tk008" value="<?php echo $tk008; ?>" size="20" type="text" />
									</td>									
								</tr>
								
								<tr>
									<td class="normal14a"  width="10%">付款條件代號：</td>
									<td class="normal14a"  width="24%">
										<input tabIndex="1" id="cmsi21" name="cmsi21" onKeyPress="keyFunction()"  value="" onChange="check_cmsi21(this);" type="text"/>
										<a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
										<span id="cmsi21disp"></span>
									</td>
									
								</tr>
								
								
								<tr>
									<td class="normal14a" width="10%" >自動扣料：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="10" id="tk023" name="tk023" value="Y" onKeyPress="keyFunction()" type="checkbox" />
									</td>
									
									<td class="normal14a" width="10%" >廠供料自動扣料：</td>
									<td class="normal14a"  width="22%" >
										<input tabIndex="10" id="tk034" name="tk034" value="Y" onKeyPress="keyFunction()" type="checkbox" />
									</td>
								</tr>
							</table>
						</div>
					</div>
		

				<div style="width:100%; overflow-x: auto;  ">
					<table style="width:100%;" id="order_product" class="list1">
						<thead>
						<tr>
							<td width="3%"></td>
								<?php foreach($usecol_array as $key => $val){
									echo "<td ";
								if(isset($val['width'])){
									echo "width='".$val['width']."' ";}
								if(isset($val['title_class'])){
									echo "class='".$val['title_class']."' ";}
								//if(isset($val['style'])){
									//echo "style='".$val['style']."' ";}
									echo " >";
									echo $val['name'];
									echo "</td>";
								}?>
						</tr>
						</thead>
						
						<?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 ?>
						<tfoot>
							<tr>
								<td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
								<td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			
			<!-- 合計-->
			<tr>
				<td class="right" valign="top"><b style="color: #003A88;">　製令單別：</b></td>
				<td ><input type='text' id="ta001" name='ta001' size="4" onchange="check_moci06();" value="" style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　製令單號：</b></td>
				<td ><input type='text' id="ta002" name='ta002' size="12" onchange="check_moci06();" value="" style="background-color:#EBEBE4" /></td>
				<td class="center" valign="top">
					<span id="moci02_disp">　　　　　　</span>
				</td>
				<td class="left" valign="top">
					<a accesskey="" onKeyPress="keyFunction()" id='import' name='import' href="javascript:import_moci06()" class="button" ><span>匯入製令明細</span></a>
				</td>
			</tr>
			<div style="margin:30px"></div>
			<tr>
                <td class="center" valign="top"></td>
				<td colspan="2" class="right"><span></span></td>
				
			<!--<td class="right" valign="top"><b style="color: #003A88;">　原幣加工金額：</b></td>
				<td ><input type='text' readonly="value" name='tl012_sum' id="tl012_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>-->
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_total"></span></b></td>  -->
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅金額：</b></td>
				<td ><input type='text' readonly="value" name='tl031_sum' id="tl031_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tax"></span></b></td> -->
				<td class="right" valign="top"><b style="color: #003A88;">　　原未稅款金額：</b></td>
				<td ><input type='text' readonly="value" name="tl029_sum" id="tl029_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			<!--<td class="right" valign="top"><b style="color: #003A88;">　　原幣扣款金額：</b></td>
				<td ><input type='text' readonly="value" name='ti026_sum' id="ti026_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>-->
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tl032_sum' id="tl032_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='tl030_sum' id="tl030_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			<!--<td class="right" valign="top"><b style="color: #003A88;">　　本幣進貨費用：</b></td>
				<td ><input type='text' readonly="value" name='ti027_sum' id="ti027_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>-->
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣金額合計：</b></td>
				<td ><input type='text' readonly="value" name='sum_1' id="sum_1" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣金額合計：</b></td>
				<td ><input type='text' readonly="value" name='sum_2' id="sum_2" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　數量合計：</b></td>
				<td ><input type='text' readonly="value" name='tl009_sum' id="tl009_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			<!-- 合計-->
		</div> <!-- div-8 -->
	
		<div class="buttons">
			<button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
			<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;　　　　
		</div> 

			</form>
	  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
	
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->

<?php //include("./application/views/fun/moci06_funjs_v.php"); ?> 

<script type="text/javascript">
$(document).ready(function(){
	$("#Showpuri04disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri04'),
		onOverlayClick: clear_puri04disp_sql
	});
	});
    $('#puri04').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#puri04').val();
			$('#puri04').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci07/lookup_puri04/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#puri04').val(ui.item.value1);
				$('#puri04disp').text(ui.item.value2);
				return false;
			}else{
				$('#puri04disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#puri04').attr('onchange','check_puri04(this)');
			check_puri04($('#puri04').val());
			return false;
		}
	});
});

function addpuri04disp(mb001,mb002){
	$('#puri04').val(mb001);
	$('#puri04disp').text(mb002);
	check_title_no();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri04/clear_sql"
	});
}

function clear_puri04disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri04/clear_sql"
	});
}

function check_puri04(row_obj){
	var smb001= $('#puri04').val();
	if(!smb001){$('#puri04disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci07/lookup2_puri04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#puri04').val("");
					$('#puri04disp').text("查無資料");
				}
				$('#puri04').val(smb001);
				$('#puri04disp').text(data.message[0].value2);
				check_title_no();
			}else{
				$('#puri04').val(smb001);
				$('#puri04disp').text("查無資料");
			}
		}
	});
}
</script>
<div id="divFpuri04" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pur/puri04/display_child/0/or_where?key=mq001,mq001&val=59,''" allowTransparency="false" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢廠別視窗
$(document).ready(function(){
	$("#Showpuri01disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri01'),
		onOverlayClick: clear_puri01disp_sql
	});
	}); 
    $('#puri01').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#puri01').val();
			$('#puri01').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup_puri01/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#puri01').val(ui.item.value1);
				$('#puri01disp').text(ui.item.value2);
				return false;
			}else{
				$('#puri01disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#puri01').attr('onchange','check_puri01(this)');
			check_puri01($('#puri01').val());
			console.log($('#puri01').val());
			return false;
		}
	});
});
function addpuri01disp(mb001,mb002){
	$('#puri01').val(mb001);
	$('#puri01disp').text(mb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function clear_puri01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function check_puri01(row_obj){
	var smb001= $('#puri01').val();
	console.log(row_obj);
	if(!smb001){$('#puri01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup2_puri01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#puri01').val("");
					$('#puri01disp').text("查無資料");
				}
				console.log(data.response);
				$('#puri01').val(smb001);
				$('#puri01disp').text(data.message[0].value2);
			}else{
				$('#puri01').val(smb001);
				$('#puri01disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFpuri01" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pur/puri01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢生產線視窗
$(document).ready(function(){
	$("#Showcmsi02disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi02'),
		onOverlayClick: clear_cmsi02disp_sql
	});
	});

    $('#cmsi02').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi02').val();
			$('#cmsi02').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup_cmsi02/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#cmsi02').val(ui.item.value1);
				$('#cmsi02disp').text(ui.item.value2);
				console.log($('#cmsi02').val());
				return false;
			}else{
				$('#cmsi02disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi02').attr('onchange','check_cmsi02(this)');
			check_cmsi02($('#cmsi02').val());
			console.log($('#cmsi02').val());
			return false;
		}
	});
});
function addcmsi02disp(md001,md002){
	$('#cmsi02').val(md001);
	$('#cmsi02disp').text(md002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi02/clear_sql"
	});
}
function clear_cmsi02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi02/clear_sql"
	});
}
function check_cmsi02(row_obj){
	var smb001= $('#cmsi02').val();
	if(!smb001){$('#cmsi02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup2_cmsi02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi02').val("");
					$('#cmsi02disp').text("查無資料");
				}
				$('#cmsi02').val(smb001);
				$('#cmsi02disp').text(data.message[0].value2);
			}else{
				$('#cmsi02').val(smb001);
				$('#cmsi02disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi02" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/cms/cmsi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢廠商視窗
$(document).ready(function(){
	$("#Showpuri01disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri01'),
		onOverlayClick: clear_puri01disp_sql
	});
	});
    $('#puri01').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#puri01').val();
			$('#puri01').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci07/lookup_puri01/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
			console.log(req);
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#puri01').val(ui.item.value1);
				$('#puri01disp').text(ui.item.value2);
				tk014_change(ui.item.value3);
				console.log(ui.item.value3);
				return false;
			}else{
				$('#puri01disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#puri01').attr('onchange','check_puri01(this)');
			check_puri01($('#puri01').val());
			return false;
		}
	});
});
function addpuri01disp(ma001,ma002){
	$('#puri01').val(ma001);
	$('#puri01disp').text(ma002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function clear_puri01disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function check_puri01(row_obj){
	var smb001= $('#puri01').val();
	if(!smb001){$('#puri01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci07/lookup2_puri01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ma001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#puri01').val("");
					$('#puri01disp').text("查無資料");
				}
				$('#puri01').val(smb001);
				$('#puri01disp').text(data.message[0].value2);
				tk014_change(data.message[0].value3);
			}else{
				$('#puri01').val(smb001);
				$('#puri01disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFpuri01" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pur/puri01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢產品視窗
function search_invi02_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	console.log(sma001,sma002);
	var sma001 = $('#order_product\\['+row+'\\]\\[tl015\\]').val();
	var sma002 = $('#order_product\\['+row+'\\]\\[tl016\\]').val();
	if(sma001 !="" && sma002!=""){
		$('#ifmain1').attr('src',"<?php echo base_url();?>index.php/inv/invi02/display_child3/0/or_where?key=ta001,ta002&val="+sma001+','+sma002);
	}else{
		$('#ifmain1').attr('src',"<?php echo base_url();?>index.php/inv/invi02/display_child3/0/or_where?key=ta001,ta002&val='',''");
	};
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFinvi02'),
		onOverlayClick: clear_invi02disp_sql
	});
}
function addinvi02disp(mb001, mb002, mb003, mb004, mb017, mc002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl004\\]').val(mb001); //品號
	$('#order_product\\['+selected_row+'\\]\\[tl005\\]').val(mb002); //品名
	$('#order_product\\['+selected_row+'\\]\\[tl006\\]').val(mb003); //規格
	$('#order_product\\['+selected_row+'\\]\\[tl008\\]').val(mb004); //單位
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').val(mb017); //庫別
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mc002); //庫別名稱
	$('#order_product\\['+selected_row+'\\]\\[tl004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function clear_invi02disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function check_invi02(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tl004\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_invi02_3/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tl005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tl006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[tl008\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[tl004\\]').val("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
<iframe src="" allowTransparency="flase" id="ifmain1" name="ifmain1" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢庫別視窗
function search_cmsi03_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFcmsi03'),
		onOverlayClick: clear_cmsi03disp_sql
	});
	  $('.close').click($.unblockUI);
}
function addcmsi03disp(mb001, mb002){
	clear_row(selected_row);
	console.log(mb001);
	console.log(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
function clear_cmsi03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
//庫別
function check_cmsi03(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[tl013\\]').val();
	console.log(smb001);
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tl013\\]').val("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi03/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>



<script>      
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');	
				currentCategory = item.category;
			}
			self._renderItem(ul, item);
		});
	}
});

var no_col = "<?php echo $no_col; ?>";	//序號欄位
var col_array = <?php echo json_encode($col_array); ?>;
var usecol_array = <?php echo json_encode($usecol_array); ?>;
var current_count = 0;
var selected_row = 0;
$(document).ready(function(){
	for(var i=1;i<=current_count;i++){
		set_catcomplete(i);
		set_catcomplete2(i);
		set_catcomplete3(i);
	}
});

function get_max_no(){
	var max_no = 1000;
	$('.product_row .order_product_'+no_col).each(function(){
		if($( this ).val() > max_no){
			max_no = $( this ).val();
		}
	});
	return max_no;
}
</script>
<script>
function addItem(){
	//current_count = 0;
	var max_no = get_max_no();
	//$(".data_class").each(function(index, element) {
	//	current_count +=1;
   // });
	current_count++;
	var append_str = "";
	var type = "";
	append_str += "<tbody id='product_row_"+current_count+"' class='product_row' >";
	append_str += "<tr>";
	append_str += "<td class='center'><img src='<?php echo base_url()?>assets/image/delete2.png' title='刪除資料' onclick='$(\"#product_row_"+current_count+"\").remove();totalSum();' /></td>";
	for(var key in usecol_array){
		var val = usecol_array[key];
		if(val['type']){type = val['type'];}else{type = "text";}
			append_str += "<td nowrap='value'";
		if(val['data_class']){append_str += "class='"+val['data_class']+"' ";}
			append_str += ">";
		if(type == "text"){


			append_str += "<input type='"+type+"' id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' ";
			if(key == no_col){append_str += "value='"+(max_no*1+10)+"'"}
			if(val['size']){append_str += "size='"+val['size']+"' ";}
			if(val['onclick']){append_str += "onclick='"+val['onclick']+"' ";}
			if(val['ondblclick']){append_str += "ondblclick='"+val['ondblclick']+"' ";}
			if(val['onchange']){append_str += "onchange='"+val['onchange']+"' ";}
			if(val['style']){append_str += "style='"+val['style']+"' ";}
			if(val['readonly']){append_str += "readonly='"+val['readonly']+"' ";}
			if(val['disable']){append_str += "disable='"+val['disable']+"' ";}
			if(val['value']){append_str += "value='"+val['value']+"' ";}
			if(val['required']){append_str += "required='"+val['required']+"' ";}
			append_str += " />";
		}
		
		if(type == "select" && val['option']){
			append_str += "<select id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' ";
			if(val['size']){append_str += "size='"+val['size']+"' ";}
			if(val['onclick']){append_str += "onclick='"+val['onclick']+"' ";}
			if(val['ondblclick']){append_str += "ondblclick='"+val['ondblclick']+"' ";}
			if(val['onchange']){append_str += "onchange='"+val['onchange']+"' ";}
			if(val['style']){append_str += "style='"+val['style']+"' ";}
			if(val['readonly']){append_str += "readonly='"+val['readonly']+"' ";}
			if(val['disable']){append_str += "disable='"+val['disable']+"' ";}
			append_str += " >";
			for(var k in val['option']){
				var v = val['option'][k];
				append_str += "<option ";
				append_str += "value='"+k+"'>";
				append_str += k+"."+v;
				append_str += "</option>";
			}
			append_str += "</select>";
		}
		
		if(type == "checkbox"){
			append_str += "<input type='"+type+"' id='order_product["+current_count+"]["+key+"]' name='order_product["+current_count+"]["+key+"]' class='order_product_"+key+"' onKeyPress='keyFunction()' value='Y' ";
		}
		if(val['name'] == '品號'){append_str += "<a href='javascript:;'><img name='order"+current_count+"' id='order"+current_count+"' src='<?php echo base_url()?>assets/image/png/invoice.png' alt='' align='top'/>" };
		append_str += "</td>";
	}
	append_str += "</tr>";
	append_str += "</tbody>";
	$('#order_product tfoot').before(append_str);
	
	//以下為需要各表各自設定部分(即為快速查詢功能設定)//
	//品號查詢品名規格
	set_catcomplete(current_count);
	//製令單別查詢
	set_catcomplete2(current_count);
	set_catcomplete3(current_count);
}

/*function addtitle(){
	$('#order_product\\['+current_count+'\\]\\[te001\\]').val($('#puri04').val());
	$('#order_product\\['+current_count+'\\]\\[te002\\]').val($('#tc002').val());
}*/

function set_catcomplete(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[tl004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[tl004\\]').val();
			var smb002= $('#order_product\\['+row+'\\]\\[tl015\\]').val();
			var smb003= $('#order_product\\['+row+'\\]\\[tl016\\]').val();
			$('#order_product\\['+row+'\\]\\[tl004\\]').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci04/lookup_invi04/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002)+'/'+encodeURIComponent(smb003),
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			clear_row(row);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[tl004\\]').val(ui.item.value1); //品號
				$('#order_product\\['+row+'\\]\\[tl005\\]').val(ui.item.value2); //品名
				$('#order_product\\['+row+'\\]\\[tl006\\]').val(ui.item.value3); //規格
				$('#order_product\\['+row+'\\]\\[tl008\\]').val(ui.item.value4); //單位
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(ui.item.value5); //庫別
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value6); //庫別名稱
				//$('#order_product\\['+row+'\\]\\[tg011\\]').val(ui.item.value7); //入庫數量
				//$('#order_product\\['+row+'\\]\\[tg012\\]').val(ui.item.value8); //報廢數量
				$('#order_product\\['+row+'\\]\\[tl015\\]').val(ui.item.value9); //製令單別
				$('#order_product\\['+row+'\\]\\[tl016\\]').val(ui.item.value10); //製令單號
			}
			return false;
		},
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[tl004\\]').attr('onchange','check_invi02(this)');
			check_invi02(row);
			return false;
		}
	});
	//明細計算
	$('input[name=\'order_product[' + row + '][tl007]\'],input[name=\'order_product[' + row + '][tl009]\'],input[name=\'order_product[' + row + '][tl011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		//var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		//var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		//var get_total=input_1*input_2;  
		//$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 
       //合計資料
	   check_tl007(this);check_tl009(this);check_tl011(this);
		exchange_tax(this);
		totalSum();
	
	});
	
	//單身材料品號視窗
	$('#order'+row).click(function(){
		var row = $(this).parent().parent().parent().parent()[0].id.substr(12);
		var sql_where;
		sql_where = $('#puri01').val();
		selected_row = row;
		
		$('#ifmain3').attr('src','<?php echo base_url()?>'+'index.php/moc/moci05/display_child/'+sql_where)
		
		$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFmoci05'),
		onOverlayClick: clear_puri01disp_sql
	});
	})
}

function addmoci05disp(ta006, mb002, mb003, mb004, mb017, mc002, ta001, ta002){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[tl004\\]').val(ta006); //品號
	$('#order_product\\['+selected_row+'\\]\\[tl005\\]').val(mb002); //品名
	$('#order_product\\['+selected_row+'\\]\\[tl006\\]').val(mb003); //規格
	$('#order_product\\['+selected_row+'\\]\\[tl008\\]').val(mb004); //單位
	$('#order_product\\['+selected_row+'\\]\\[tl013\\]').val(mb017); //庫別
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mc002); //庫別名稱
	$('#order_product\\['+selected_row+'\\]\\[tl015\\]').val(ta001); //製令單別
	$('#order_product\\['+selected_row+'\\]\\[tl016\\]').val(ta002); //製令單號
	$('#order_product\\['+selected_row+'\\]\\[tl004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci05/clear_sql"
	});
}


function set_catcomplete2(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[tl015\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tl015\\]').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup_moci05_3/'+encodeURIComponent(smb002), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			clear_row(row);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[tl004\\]').val(ui.item.value1); //品號
				$('#order_product\\['+row+'\\]\\[tl005\\]').val(ui.item.value2); //品名
				$('#order_product\\['+row+'\\]\\[tl006\\]').val(ui.item.value3); //規格
				$('#order_product\\['+row+'\\]\\[tl008\\]').val(ui.item.value4); //單位
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(ui.item.value5); //庫別
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value6); //庫別名稱
				//$('#order_product\\['+row+'\\]\\[tg011\\]').val(ui.item.value7); //入庫數量
				//$('#order_product\\['+row+'\\]\\[tg012\\]').val(ui.item.value8); //報廢數量
				$('#order_product\\['+row+'\\]\\[tl015\\]').val(ui.item.value9); //製令單別
				$('#order_product\\['+row+'\\]\\[tl016\\]').val(ui.item.value10); //製令單號
			}
			return false;
		},
		focus: function(event, ui) {
			return false;
		}
	});
}

function set_catcomplete3(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[tl013\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tl013\\]').val();
			$('#order_product\\['+row+'\\]\\[tl013\\]').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookupd_cmsi03/'+encodeURIComponent(smb002), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			clear_row(row);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[tl013\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value2);
			}
			return false;
		},
		change: function(event, ui) {
			$('#cmsi03').attr('onchange','check_cmsi03(this)');
			check_cmsi03(row);
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
}
</script>

<div id="divFmoci05" style="display:none;width:100%;height:100%;">
<iframe src="" allowTransparency="flase" id="ifmain3" name="ifmain3" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


<script>
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product-row'+row+' input.order_product_ti00'+k).val("");
		$('#product-row'+row+' input.order_product_ti0'+k).val("");
		$('#product-row'+row+' input.order_product_ti'+k).val("");
	}
}

function check_title_no(){
	$('#tk002').val("");
	var puri04 = $('#puri04').val();
	var Ddate = $('#Ddate').val();
	console.log(puri04);
	console.log(Ddate);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci07/check_title_no",
		data: {
			puri04: puri04, 
			Ddate: Ddate
		}
	})
	.done(function( msg ) {
		//if($('#puri04disp').text()!=""&&$('#puri04disp').text()!="查無資料")
		$('#tk002').val(msg);
		for(i=0;i<=current_count;i++){
			$('#order_product\\['+i+'\\]\\[tl002\\]').val(msg);
		}
	});
}

function del_detail(te001,te002,te003,row){
	if(confirm("確定刪除細項:"+te001+"-"+te002+"-"+te003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci07/del_detail_ajax",
		data: { 
			te001: te001, 
			te002: te002,
			te003: te003
		}
	})
	.done(function( msg ) {
		if(msg){
			alert( "刪除細項:"+te001+"-"+te002+"-"+te003+" 成功!");
			$("#product_row_"+row).remove();
		}
		else{alert( "刪除細項:"+te001+"-"+te002+"-"+te003+" 失敗!");}
	});
	}
}
//--></script>


<script>
//匯入製令明細
function check_moci06(){
	var ta001 = $('#ta001').val();
	var ta002 = $('#ta002').val();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci06/check_moci06",
		data: {
			ta001: ta001, 
			ta002: ta002
		}
	})
	.done(function( msg ) {
		$('#moci02_disp').text("明細共計:"+msg+"筆資料");
	});
}
function import_moci06(){
	var ta001 = $('#ta001').val();
	var ta002 = $('#ta002').val();
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/moc/moci06/import_moci06",
		data: {
			ta001: ta001, 
			ta002: ta002
		}
	})
	.done(function( msg ) {
		if(msg==0){
			alert("無資料可匯入!");
		}else{
			console.log(msg);
			if(confirm("共計"+msg.length+"筆，是否匯入?")){
				for(var key in msg){
					var val = msg[key];
					console.log(val);
					addItem();
					$('#order_product\\['+current_count+'\\]\\[tl004\\]').val(val['ta006']); //品號
					$('#order_product\\['+current_count+'\\]\\[tl005\\]').val(val['mb002']); //品名
					$('#order_product\\['+current_count+'\\]\\[tl006\\]').val(val['mb003']); //規格
					$('#order_product\\['+current_count+'\\]\\[tl008\\]').val(val['mb004']); //單位
					$('#order_product\\['+current_count+'\\]\\[tl013\\]').val(val['mb017']); //庫別
					$('#order_product\\['+current_count+'\\]\\[mc002\\]').val(val['mc002']); //庫別名稱
					$('#order_product\\['+current_count+'\\]\\[tl015\\]').val(val['ta001']); //製令單別
					$('#order_product\\['+current_count+'\\]\\[tl016\\]').val(val['ta002']); //製令單號
				}
				
			}
		}
		
	});
}

</script>

<script>
//單身數量處理
//退貨數量
function check_tl007(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var tl007 = $('#order_product\\['+row+'\\]\\[tl007\\]').val();
	
	$('#order_product\\['+row+'\\]\\[tl009\\]').val(tl007);

	totalSum();
}

//計價數量
function check_tl009(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}

	totalSum();
}

//加工單價
function check_tl011(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var tl011 = $('#order_product\\['+row+'\\]\\[tl011\\]').val();
	var tl009 = $('#order_product\\['+row+'\\]\\[tl009\\]').val();
	
	
	$('#order_product\\['+row+'\\]\\[tl012\\]').val(tl009 * tl011);
	totalSum();
}

//計算加工金額總和
function totalSum(){
	var index1 = 0; var index2 = 0; var index3 = 0; var index4 = 0; var index5 = 0;
	var index6 = 0; var index7 = 0; var index8 = 0; var index9 = 0; var index10 = 0;
	var num1 = 0; var num2 = 0; var num3 = 0; var num4 = 0; var num5 = 0;
	var num6 = 0; var num7 = 0; var num8 = 0; var num9 = 0; var num10 = 0;
	var sum1 = 0; var sum2 = 0; var sum3 = 0; var sum4 = 0; var sum5 = 0;
	var sum6 = 0; var sum7 = 0; var sum8 = 0; var sum9 = 0; var sum10 = 0;
	/*原幣加工金額合計
	$(".data_class").each(function(index, element) {
		index1 = index+1;
		sum1 = 0;
    });	
		
		if(index1 >=1){
			for(i = 1; i<=index1; i++){
				while (typeof($('input[name=\'order_product[' + num1 + '][tl012]\']').val()) == 'undefined'){
					num1++;	
				}
				if(!($('input[name=\'order_product[' + num1 + '][tl012]\']').val())){
					sum1 +=0;
					num1++;
				}else{
					sum1 += parseFloat($('input[name=\'order_product[' + num1 + '][tl012]\']').val());
					num1++;	
				}
			}
		}
		
		if(isNaN(sum1)){sum1=0}
		$('#tl012_sum').val(sum1);
		num1 = 0;
		 
	end 原幣加工金額合計*/
	
	//本幣未稅金額合計	 
	$(".data_class").each(function(index, element) {
		    index2 = index+1;
    });	
		
		if(index2 >=1){
			for(i = 1; i<=index2; i++){
				while (typeof($('input[name=\'order_product[' + num2 + '][tl031]\']').val()) == 'undefined'){
					num2++;	
				}
				if(!($('input[name=\'order_product[' + num2 + '][tl031]\']').val())){
					sum2 +=0;
					num2++;
				}else{
					sum2 += parseFloat($('input[name=\'order_product[' + num2 + '][tl031]\']').val());
					num2++;	
				}
			}
		}
		
		if(isNaN(sum2)){sum2=0}
		$('#tl031_sum').val(sum2);
		num2 = 0;
	//end 本幣未稅金額合計
	
	//原未稅款金額合計	 
	$(".data_class").each(function(index, element) {
		    index3 = index+1;
    });	
		
		if(index3 >=1){
			for(i = 1; i<=index3; i++){
				while (typeof($('input[name=\'order_product[' + num3 + '][tl029]\']').val()) == 'undefined'){
					num3++;	
				}
				if(!($('input[name=\'order_product[' + num3 + '][tl029]\']').val())){
					sum3 +=0;
					num3++;
				}else{
					sum3 += parseFloat($('input[name=\'order_product[' + num3 + '][tl029]\']').val());
					num3++;	
				}
			}
		}
		if(isNaN(sum3)){sum3=0}
		$('#tl029_sum').val(sum3);
		num3 = 0;
	//end 原未稅款金額合計
	
	/*原幣扣款金額:	 
	$(".data_class").each(function(index, element) {
		index4 = index+1;
    });	
		
		if(index4 >=1){
			for(i = 1; i<=index4; i++){
				while (typeof($('input[name=\'order_product[' + num4 + '][ti026]\']').val()) == 'undefined'){
					num4++;	
				}
				if(!($('input[name=\'order_product[' + num4 + '][ti026]\']').val())){
					sum4 +=0;
					num4++;
				}else{
					sum4 += parseFloat($('input[name=\'order_product[' + num4 + '][ti026]\']').val());
					num4++;	
				}
			}
		}
		if(isNaN(sum4)){sum4=0}
		$('#ti026_sum').val(sum4);
		num4 = 0;
	end 原幣扣款金額*/
	
	//本幣稅額
	$(".data_class").each(function(index, element) {
		    index5 = index+1;
    });	
		
		if(index5 >=1){
			for(i = 1; i<=index5; i++){
				while (typeof($('input[name=\'order_product[' + num5 + '][tl032]\']').val()) == 'undefined'){
					num5++;	
				}
				if(!($('input[name=\'order_product[' + num5 + '][tl032]\']').val())){
					sum5 +=0;
					num5++;
				}else{
					sum5 += parseFloat($('input[name=\'order_product[' + num5 + '][tl032]\']').val());
					num5++;	
				}
			}
		}
		if(isNaN(sum5)){sum5=0}
		$('#tl032_sum').val(sum5);
		num5 = 0;
	//end 本幣稅額
	
	//原幣稅額
	$(".data_class").each(function(index, element) {
		index6 = index+1;
    });	
		
		if(index6 >=1){
			for(i = 1; i<=index6; i++){
				while (typeof($('input[name=\'order_product[' + num6 + '][tl030]\']').val()) == 'undefined'){
					num6++;	
				}
				if(!($('input[name=\'order_product[' + num6 + '][tl030]\']').val())){
					sum6 +=0;
					num6++;
				}else{
					sum6 += parseFloat($('input[name=\'order_product[' + num6 + '][tl030]\']').val());
					num6++;	
				}
			}
		}
		if(isNaN(sum6)){sum6=0}
		$('#tl030_sum').val(sum6);
		num6 = 0;
	//end 原幣稅額
	
	/*本幣進貨費用
	$(".data_class").each(function(index, element) {
		index7 = index+1;
    });	
		
		if(index7 >=1){
			for(i = 1; i<=index7; i++){
				while (typeof($('input[name=\'order_product[' + num7 + '][ti027]\']').val()) == 'undefined'){
					num7++;	
				}
				if(!($('input[name=\'order_product[' + num7 + '][ti027]\']').val())){
					sum7 +=0;
					num7++;
				}else{
					sum7 += parseFloat($('input[name=\'order_product[' + num7 + '][ti027]\']').val());
					num7++;	
				}
			}
		}
		if(isNaN(sum7)){sum7=0}
		$('#ti027_sum').val(sum7);
		num7 = 0;
	end 本幣進貨費用*/
	
	//本幣金額合計
	sum8 =  parseFloat($('#tl031_sum').val()) + parseFloat($('#tl032_sum').val());
	if(isNaN($('#sum_1').val())){$('#sum_1').val()=0};
	$('#sum_1').val(sum8);
	//end 本幣金額合計
	
	//原幣金額合計
	sum9 = parseFloat($('#tl029_sum').val()) + parseFloat($('#tl030_sum').val());
	if(isNaN($('#sum_2').val())){$('#sum_2').val()=0};
	$('#sum_2').val(sum9);
	//end 原幣金額合計
	
	//數量合計
	$(".data_class").each(function(index, element) {
		index10 = index+1;
    });	
		
		if(index10 >=1){
			for(i = 1; i<=index10; i++){
				while (typeof($('input[name=\'order_product[' + num10 + '][tl009]\']').val()) == 'undefined'){
					num10++;	
				}
				if(!($('input[name=\'order_product[' + num10 + '][tl009]\']').val())){
					sum10 +=0;
					num10++;
				}else{
					sum10 += parseFloat($('input[name=\'order_product[' + num10 + '][tl009]\']').val());
					num10++;	
				}
			}
		}
		if(isNaN(sum10)){sum10=0}
		$('#tl009_sum').val(sum10);
		num10 = 0;
	//end 數量合計
}
</script>
<script>
//網頁準備好直接匯入NTD做預設幣別
$(document).ready(function(){
	check_cmsi07($('#cmsi06').val());
	totalSum();
})			
</script>

<script>
//計算稅額以及匯率
function exchange_tax(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	
	
	var tl012 = Number($('#order_product\\['+row+'\\]\\[tl012\\]').val()); //加工金額
	var tk029 = Number($('#tk029').val()); //稅率
	var cmsi07 = Number($('#cmsi07').val()); //匯率
	switch ($('#tk014').val()){
		case "1":
			$('#order_product\\['+row+'\\]\\[tl029\\]').val(Math.round(tl012 * 1 / (1+tk029)));
			$('#order_product\\['+row+'\\]\\[tl030\\]').val(Math.round(tl012 * tk029 / (1+tk029)));
			$('#order_product\\['+row+'\\]\\[tl031\\]').val(Math.round((tl012 * cmsi07) * 1 / (1+tk029)));
			$('#order_product\\['+row+'\\]\\[tl032\\]').val(Math.round((tl012 * cmsi07) * tk029 / (1+tk029)));
			break;
		case "2":
			$('#order_product\\['+row+'\\]\\[tl029\\]').val(Math.round(tl012));
			$('#order_product\\['+row+'\\]\\[tl030\\]').val(Math.round(tl012 * tk029));
			$('#order_product\\['+row+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
			$('#order_product\\['+row+'\\]\\[tl032\\]').val(Math.round(tl012 * cmsi07 * tk029));
			break;
		case "3":
			$('#order_product\\['+row+'\\]\\[tl029\\]').val(Math.round(tl012));
			$('#order_product\\['+row+'\\]\\[tl030\\]').val(tl012 * tk029);
			$('#order_product\\['+row+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
			$('#order_product\\['+row+'\\]\\[tl032\\]').val(tl012 * tk029);
			break;
		case "4":
			$('#order_product\\['+row+'\\]\\[tl029\\]').val(Math.round(tl012));
			$('#order_product\\['+row+'\\]\\[tl030\\]').val(tl012 * tk029);
			$('#order_product\\['+row+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
			$('#order_product\\['+row+'\\]\\[tl032\\]').val(tl012 * tk029);
			break;
		case "9":
			$('#order_product\\['+row+'\\]\\[tl029\\]').val(Math.round(tl012));
			$('#order_product\\['+row+'\\]\\[tl030\\]').val(tl012 * tk029);
			$('#order_product\\['+row+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
			$('#order_product\\['+row+'\\]\\[tl032\\]').val(tl012 * tk029);
			break;
	}
}
</script>

<script>
//加工廠商決定課稅別
function tk014_change(tax){
	$('#tk014').val(tax);
}
//更改課稅別重新計算以及
function exchange_tax2(){
	var index1 = 0; var num1 = 0; var sum1 = 0;
	console.log('abc');
	
	//改變稅率
	switch($('#tk014').val()){
		case '1':
			$('#tk029').val(<?php echo $this->session->userdata('sysma004'); ?>);
			break;
		case '2':
			$('#tk029').val(<?php echo $this->session->userdata('sysma004'); ?>);
			break;
		case '3':
			$('#tk029').val(0);
			break;
		case '4':
			$('#tk029').val(0);
			break;
		case '9':
			$('#tk029').val(0);
			break;
	}
	
	
	//原幣稅額
	$(".data_class").each(function(index, element) {
		index1 = index+1;
    });	
		
		if(index1 >=1){
			for(i = 1; i<=index1; i++){
				while (typeof($('input[name=\'order_product[' + num1 + '][tl029]\']').val()) == 'undefined'){
					num1++;	
				}
				var tl012 = Number($('#order_product\\['+num1+'\\]\\[tl012\\]').val()); //加工金額
				var tk029 = Number($('#tk029').val()); //稅率
				var cmsi07 = Number($('#cmsi07').val()); //匯率
			
				switch ($('#tk014').val()){
					case "1":
						$('#order_product\\['+num1+'\\]\\[tl029\\]').val(Math.round(tl012 * 1 / (1+tk029)));
						$('#order_product\\['+num1+'\\]\\[tl030\\]').val(Math.round(tl012 * tk029 / (1+tk029)));
						$('#order_product\\['+num1+'\\]\\[tl031\\]').val(Math.round((tl012 * cmsi07) * 1 / (1+tk029)));
						$('#order_product\\['+num1+'\\]\\[tl032\\]').val(Math.round((tl012 * cmsi07) * tk029 / (1+tk029)));
					break;
					case "2":
						$('#order_product\\['+num1+'\\]\\[tl029\\]').val(Math.round(tl012));
						$('#order_product\\['+num1+'\\]\\[tl030\\]').val(Math.round(tl012 * tk029));
						$('#order_product\\['+num1+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[tl032\\]').val(Math.round(tl012 * cmsi07 * tk029));
						break;
					case "3":
						$('#order_product\\['+num1+'\\]\\[tl029\\]').val(Math.round(tl012));
						$('#order_product\\['+num1+'\\]\\[tl030\\]').val(tl012 * tk029);
						$('#order_product\\['+num1+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[tl032\\]').val(tl012 * tk029);
						break;
					case "4":
						$('#order_product\\['+num1+'\\]\\[tl029\\]').val(Math.round(tl012));
						$('#order_product\\['+num1+'\\]\\[tl030\\]').val(tl012 * tk029);
						$('#order_product\\['+num1+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[tl032\\]').val(tl012 * tk029);
						break;
					case "9":
						$('#order_product\\['+num1+'\\]\\[tl029\\]').val(Math.round(tl012));
						$('#order_product\\['+num1+'\\]\\[tl030\\]').val(tl012 * tk029);
						$('#order_product\\['+num1+'\\]\\[tl031\\]').val(Math.round(tl012 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[tl032\\]').val(tl012 * tk029);
						break;
				}
				num1++;	
			}
		}
		num1 = 0;
		totalSum();
	//end 原幣稅額
}
</script>

<script>
//網頁準備好,先做單號出來
$(document).ready(function(){
	check_title_no();
})
</script>
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi07_funmjs_v.php"); ?>  <!-- 匯率 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->
	  