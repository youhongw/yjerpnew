<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'th003' || $key == 'th013' || $key == 'th028' || $key == 'th029'){ //轉換為日期
		$$key = stringtodate("Y/m/d",$val);
	}
}

$body_data = $result['body_data'];
$data_count = count($body_data);
/*echo "<pre>";
//var_dump($col_array);
//var_dump($body_data);
var_dump($usecol_array);
echo "</pre>";*/
?>
<script>
$(document).ready(function(){
	$('input').attr('disabled', 'disabled');
	$('select').attr('disabled', 'disabled');
});
</script>
<div id="container"> <!-- div-1 -->
	<div id="header"> <!-- div-2 -->
		<div class="div1">
		<!--	<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
				<div class="div3">
				<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
				<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
				<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
				</div>
		</div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
	</div>
  
	<div id="content"> <!-- div-3 --> 
		<div class="box"> <!-- div-4 --><span>　　　　　　</span>
			<div class="heading">
				<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 託外進貨單建立作業 - 查看　　　</h1>
				<div style="float:left;padding-top: 5px; ">
				<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci06/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;
				</div>
				<div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci06/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
			</div>
	
		<div class="content"> <!-- div-5 -->
			<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci06/addsave" >	
			<div id="tab-general"> <!-- div-6 -->
				<table class="form14"  >     <!-- 頭部表格 -->
					<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
					<tr>
						<td class="normal14y"  width="12%"><span class="required">託外進貨單別：</span> </td>
						<td class="normal14a"  width="20%">
							<input tabIndex="1" id="puri04" name="puri04" onKeyPress="keyFunction()"  value="<?php echo $th001; ?>" onChange="check_puri04(this);check_title_no();" type="text" required />
							<a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
							<span id="puri04disp"><?php echo $puri04disp; ?></span>
						</td>
			
						<td class="normal14y" width="10%" >單據日期： </td>
						<td class="normal14a"  width="24%" >
							<input tabIndex="2" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);check_title_no();" id="Ddate" onKeyPress="keyFunction()"  name="Ddate"  value="<?php echo $th029; ?>"  size="12" type="text" style="background-color:#E7EFEF"  />
						</td>
			
						<td class="normal14y" width="12%" ><span class="required">託外進貨單號：</span> </td>
						<td class="normal14a"  width="22%" >
							<input tabIndex="3" id="th002" onKeyPress="keyFunction()" name="th002" value="<?php echo $th002; ?>" size="20" type="text" />
						</td>
					</tr>		
		  
					<tr>
						<td class="normal14z" >加工廠商：</td>
						<td class="normal14" >
							<input   tabIndex="4" id="puri01" onKeyPress="keyFunction()" onchange="check_puri01(this)" name="puri01" value="<?php echo $th005; ?>"  type="text" />
							<a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
							<span id="puri01disp"><?php echo $puri01disp; ?></span>
						</td>
		
						<td class="normal14z" >廠別：</td>
						<td class="normal14a" >
							<input tabIndex="5" id="cmsi02" onKeyPress="keyFunction()"  name="cmsi02" onchange="check_cmsi02(this)"  value="<?php echo $th004; ?>"  type="text" required/>
							<a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
							<span id="cmsi02disp"><?php echo $cmsi02disp; ?></span>
						</td>
		
						<td class="normal14z">列印次數：</td>
						<td  class="normal14"  >
							<input tabIndex="9" id="th025" name="th025" value="<?php echo $th025;?>" size="10" onKeyPress="keyFunction()" onchange="" type="text" />
						</td>
					</tr>
			
					<tr>
						<td class="normal14z" >託外進貨日期：</td>
						<td class="normal14"  >
							<input type="text" tabIndex="7" onKeyPress="keyFunction()" name="th003" value="<?php echo date("Y/m/d")?>" style="background-color:#E7EFEF" readonly="readonly"/>
						</td>
		
						<td class="normal14z">簽核狀態：</td>
						<td  class="normal14"  >
							<select id="th036" tabIndex="8"  onKeyPress="keyFunction()" name="th036"   style="background-color:#EBEBE4" >
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
						<script>$('#th036').val(<?php echo $th036; ?>);</script>
						
						<td class="normal14z" >確認碼：</td>
						<td class="normal14" >
							<select tabIndex="13" id="th023" name="th023" onKeyPress="keyFunction()" style="background-color:#EBEBE4"> 
							<option value='Y'>Y確認</option>                                                                        
							<option value='N'>N取消確認</option>
							<option value='V'>V作廢</option>
							</select>
							<span id="approved" ></span>
						</td>
						<script>$('#th023').val(<?php echo $th023; ?>);</script>
					</tr>
			
					<tr>
						<td class="normal14z" >備註：</td>
						<td class="normal14a" >
							<input  tabIndex="12"  id="th010" onKeyPress="keyFunction()"   name="th010" value="<?php echo $th010; ?>" type="text"     />
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
									<td class="normal14y"  width="10%">統一編號：</td>
									<td class="normal14a"  width="22%">
										<input tabIndex="1" id="th011" name="th011" onKeyPress="keyFunction()"  value="<?php echo $th011; ?>" onChange="" type="text"/>
									</td>
			
									<td class="normal14y" width="10%" >發票號碼： </td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="1" id="th014" name="th014" onKeyPress="keyFunction()"  value="<?php echo $th014; ?>" onChange="" type="text"/>
									</td>
			
									<td class="normal14y" width="10%" >申報年月：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="3" id="th028" onKeyPress="keyFunction()" name="th028" ondblclick="scwShow(this,event);" value="<?php echo $th028; ?>" onChange="dateformat_ymd(this);" type="text" style="background-color:#E7EFEF" />
									</td>
								</tr>
								
								<tr>
									<td class="normal14z"  width="10%">發票聯數：</td>
									<td class="normal14a"  width="22%">
										<select id="th012" name="th012" tabindex="13" onKeyPress="keyFunction()" style="background-color:#EBEBE4">
											<option value='1'>1.二聯式</option>
											<option value='2'>2.三聯式</option>
											<option value='3'>3.二聯式收銀機發票</option>
											<option value='4'>4.三聯式收銀機發票</option>
											<option value='5'>5.電子計算機發票</option>
											<option value='6'>6.免用統一發票</option>
										</select>
									</td>
									<script>$('#th012').val(<?php echo $th012; ?>);</script>
			
									<td class="normal14z" width="10%" >課稅別： </td>
									<td class="normal14a"  width="24%" >
										<select id="th015" name="th015" tabindex="13" onKeyPress="keyFunction()" onchange="exchange_tax2()" style="background-color:#EBEBE4" />
											<option value='1'>1.應稅內含</option>
											<option value='2'>2.應稅外加</option>
											<option value='3'>3.零稅率</option>
											<option value='4'>4.免稅</option>
											<option value='9'>9.不計稅</option>
										</select>
									</td>
									<script>$('#th015').val(<?php echo $th015; ?>);</script>
			
									<td class="normal14z" width="10%" >營業稅率：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="3" id="th030" onKeyPress="keyFunction()" name="th030" value="<?php echo $th030; ?>" size="20" type="text" />
									</td>
								</tr>
								
								<tr>
									<td class="normal14z"  width="10%">發票日期：</td>
									<td class="normal14a"  width="22%">
										<input tabIndex="1" id="th013" name="th013" onKeyPress="keyFunction()" value="<?php echo $th013; ?>" ondblclick="scwShow(this,event);" onChange="dateformat_ymd(this);" type="text" style="background-color:#E7EFEF"/>
									</td>
			
									<td class="normal14z" width="10%" >扣抵區分： </td>
									<td class="normal14a"  width="24%" >
										<select name="th016" id="th016" onKeyPress="keyFunction()" style="background-color:#EBEBE4">
											<option value="1">1.可扣抵進貨及費用</option>
											<option value="2">2.可扣抵固定資產</option>
											<option value="3">3.不可扣抵進貨及費用</option>
											<option value="4">4.不可扣抵固定資產</option>
										</select>
									</td>
									<script>$('#th016').val(<?php echo $th016; ?>)</script>
								</tr>
							</table>
						</div>
						
						<div id="tab2" class="tab_content">
							<table class="form14">
								<tr>
									<td class="normal14y"  width="10%">幣別：</td>
									<td class="normal14a"  width="24%">
										<input tabIndex="1" id="cmsi06" name="cmsi06" onKeyPress="keyFunction()"  value="NTD" onchange="check_cmsi06(this);check_cmsi07(this);" type="text"  />
										<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
										<span id="cmsi06disp"><?php echo $cmsi06disp;?></span>
									</td>
			
									<td class="normal14y" width="10%" >匯率： </td>
									<td class="normal14a"  width="22%" >
										<input tabIndex="1" id="cmsi07" name="cmsi07" onKeyPress="keyFunction()"  value="<?php echo $th008; ?>" onchange="" type="text" style="background-color:#EBEBE4" readonly="readonly" />
										<span id="cmsi07disp"></span>
									</td>
			
									<td class="normal14y" width="10%" >件數：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="3" id="th009" onKeyPress="keyFunction()" name="th009" value="<?php echo $th009; ?>" size="20" type="text" />
									</td>									
								</tr>
								
								<tr>
									<td class="normal14z"  width="10%">廠商單號：</td>
									<td class="normal14a"  width="24%">
										<input tabIndex="1" id="th006" name="th006" onKeyPress="keyFunction()"  value="<?php echo $th006; ?>" onChange="" type="text" />
									</td>
		
									<td class="normal14z"  width="10%">付款條件代號：</td>
									<td class="normal14a"  width="24%">
										<input tabIndex="1" id="cmsi21" name="cmsi21" onKeyPress="keyFunction()"  value="<?php echo $th033; ?>" onChange="check_cmsi21(this);" type="text"/>
										<a href="javascript:;"><img id="Showcmsi21disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
										<span id="cmsi21disp"><?php echo $cmsi21disp; ?></span>
									</td>
									
									<td class="normal14z" width="10%" >備註： </td>
									<td class="normal14a"  width="22%" >
										<input tabIndex="1" id="th010" name="th010" onKeyPress="keyFunction()"  value="<?php echo $th010; ?>" onChange="" type="text" />
									</td>
								</tr>
								
								
								<tr>
									<td class="normal14z" width="10%" >自動扣料：</td>
									<td class="normal14a"  width="24%" >
										<input tabIndex="10" id="th026" name="th026" value="Y" onKeyPress="keyFunction()" type="checkbox" />
									</td>
									<script>$('#th026').val(<?php echo $th026; ?>)</script>
									
									<td class="normal14z" width="10%" >廠供料自動扣料：</td>
									<td class="normal14a"  width="22%" >
										<input tabIndex="10" id="th035" name="th035" value="Y" onKeyPress="keyFunction()" type="checkbox" />
									</td>
									<script>$('#th035').val(<?php echo $th035; ?>)</script>
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
						<?php foreach($body_data as $key => $val){
							$current_product_count++;
							echo "<tbody id='product_row_".$current_product_count."' class='product_row'>";
							echo "<tr>";
							echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->ti001."\",\"".$val->ti002."\",\"".$val->ti003."\",\"".$current_product_count."\");' /></td>";
							foreach($usecol_array as $k => $v){
								if($k=="ti011" || $k=="ti012" || $k=="ti018"){
									$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
								}else{
									$s = $val->$k;
								}
								if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
								
								echo "<td ";
								if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
								echo ">";
								
								if($type == "text"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$s."' onKeyPress='keyFunction()' ";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "style=\"".$v['style']."\" ";}
									if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
									if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
									echo "/>";
								}
								
								if($type == "select" && isset($v['option'])){
									echo "<select id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_'>";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondbclick'])){echo "ondbclick=\"".$v['ondbclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "style='".$v['style']."' ";}
									if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
									if(isset($v['disable'])){echo "disable='".$v['disable']." '";}
									echo " >";
									foreach($v['option'] as $op_k => $op_v){
										echo "<option ";
										if($val->$k == $op_k){echo "selected='selected' ";}
										echo "value='".$op_k."'>";
										echo $op_k.".".$op_v;
										echo "</option>";
									}
									echo "</select>";
								}
								echo "</td>";
							}
							
							echo "</tr>";
							echo "</tbody>";
						} ?>
						<tfoot>
							<tr>
								<td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
								<td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div> <!-- div-8 -->
	
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		<!--<div class="buttons">
		
			<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci06/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;　　　　　　　　　
		</div> -->
		
		</form>
		<?php if ($message!=' ') { ?>
		<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
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
				
				<td class="right" valign="top"><b style="color: #003A88;">　原幣加工金額：</b></td>
				<td ><input type='text' readonly="value" name='ti025_sum' id="ti025_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_total"></span></b></td>  -->
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣未稅金額：</b></td>
				<td ><input type='text' readonly="value" name='ti046_sum' id="ti046_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			<!--	<td class="right" valign="top"><b style="color: #003A88;font-size: 14px;">$<span id="sum_tax"></span></b></td> -->
				<td class="right" valign="top"><b style="color: #003A88;">　　原未稅款金額：</b></td>
				<td ><input type='text' readonly="value" name="ti044_sum" id="ti044_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣扣款金額：</b></td>
				<td ><input type='text' readonly="value" name='ti026_sum' id="ti026_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti047_sum' id="ti047_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣稅額：</b></td>
				<td ><input type='text' readonly="value" name='ti045_sum' id="ti045_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣進貨費用：</b></td>
				<td ><input type='text' readonly="value" name='ti027_sum' id="ti027_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　本幣金額合計：</b></td>
				<td ><input type='text' readonly="value" name='sum_1' id="sum_1" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　原幣金額合計：</b></td>
				<td ><input type='text' readonly="value" name='sum_2' id="sum_2" size="8" value=""  style="background-color:#F0F0F0" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　　數量合計：</b></td>
				<td ><input type='text' readonly="value" name='ti020_sum' id="ti020_sum" size="8" value=""  style="background-color:#F0F0F0" /></td>
			
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
			<!-- 合計-->
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->


<script>
$(document).ready(function(){
	totalSum();
});
//計算加工金額總和
function totalSum(){
	var index1 = 0; var index2 = 0; var index3 = 0; var index4 = 0; var index5 = 0;
	var index6 = 0; var index7 = 0; var index8 = 0; var index9 = 0; var index10 = 0;
	var num1 = 0; var num2 = 0; var num3 = 0; var num4 = 0; var num5 = 0;
	var num6 = 0; var num7 = 0; var num8 = 0; var num9 = 0; var num10 = 0;
	var sum1 = 0; var sum2 = 0; var sum3 = 0; var sum4 = 0; var sum5 = 0;
	var sum6 = 0; var sum7 = 0; var sum8 = 0; var sum9 = 0; var sum10 = 0;
	var ti025_sum = 0;
	//原幣加工金額合計
	$(".data_class").each(function(index, element) {
		index1 = index+1;
    });	
		
		if(index1 >=1){
			for(i = 1; i<=index1; i++){
			while (typeof($('input[name=\'order_product[' + num1 + '][ti025]\']').val()) == 'undefined'){
				num1++;	
			}
			sum1 += parseFloat($('input[name=\'order_product[' + num1 + '][ti025]\']').val());
			num1++;	
			}
		}
		if(isNaN(sum1)){sum1=0}
		$('#ti025_sum').val(sum1);
		num1 = 0;
		 
	//end 原幣加工金額合計
	
	//本幣未稅金額合計	 
	$(".data_class").each(function(index, element) {
		    index2 = index+1;
    });	
		
		if(index2 >=1){
			for(i = 1; i<=index2; i++){
			while (typeof($('input[name=\'order_product[' + num2 + '][ti046]\']').val()) == 'undefined'){
				num2++;	
			}
			sum2 += parseFloat($('input[name=\'order_product[' + num2 + '][ti046]\']').val());
			num2++;	
			}
		}
		
		if(isNaN(sum2)){sum2=0}
		$('#ti046_sum').val(sum2);
		num2 = 0;
	//end 本幣未稅金額合計
	
	//原未稅款金額合計	 
	$(".data_class").each(function(index, element) {
		    index3 = index+1;
    });	
		
		if(index3 >=1){
			for(i = 1; i<=index3; i++){
			while (typeof($('input[name=\'order_product[' + num3 + '][ti044]\']').val()) == 'undefined'){
				num3++;	
			}
			sum3 += parseFloat($('input[name=\'order_product[' + num3 + '][ti044]\']').val());
			num3++;	
			}
		}
		if(isNaN(sum3)){sum3=0}
		$('#ti044_sum').val(sum3);
		num3 = 0;
	//end 原未稅款金額合計
	
	//原幣扣款金額:	 
	$(".data_class").each(function(index, element) {
		index4 = index+1;
    });	
		
		if(index4 >=1){
			for(i = 1; i<=index4; i++){
			while (typeof($('input[name=\'order_product[' + num4 + '][ti026]\']').val()) == 'undefined'){
				num4++;	
			}
			sum4 += parseFloat($('input[name=\'order_product[' + num4 + '][ti026]\']').val());
			num4++;	
			}
		}
		if(isNaN(sum4)){sum4=0}
		$('#ti026_sum').val(sum4);
		num4 = 0;
	//end 原幣扣款金額
	
	//本幣稅額
	$(".data_class").each(function(index, element) {
		    index5 = index+1;
    });	
		
		if(index5 >=1){
			for(i = 1; i<=index5; i++){
			while (typeof($('input[name=\'order_product[' + num5 + '][ti047]\']').val()) == 'undefined'){
				num5++;	
			}
			sum5 += parseFloat($('input[name=\'order_product[' + num5 + '][ti047]\']').val());
			num5++;	
			}
		}
		if(isNaN(sum5)){sum5=0}
		$('#ti047_sum').val(sum5);
		num5 = 0;
	//end 本幣稅額
	
	//原幣稅額
	$(".data_class").each(function(index, element) {
		index6 = index+1;
    });	
		
		if(index6 >=1){
			for(i = 1; i<=index6; i++){
			while (typeof($('input[name=\'order_product[' + num6 + '][ti045]\']').val()) == 'undefined'){
				num6++;	
			}
			sum6 += parseFloat($('input[name=\'order_product[' + num6 + '][ti045]\']').val());
			num6++;	
			}
		}
		if(isNaN(sum6)){sum6=0}
		$('#ti045_sum').val(sum6);
		num6 = 0;
	//end 原幣稅額
	
	//本幣進貨費用
	$(".data_class").each(function(index, element) {
		index7 = index+1;
    });	
		
		if(index7 >=1){
			for(i = 1; i<=index7; i++){
			while (typeof($('input[name=\'order_product[' + num7 + '][ti027]\']').val()) == 'undefined'){
				num7++;	
			}
			sum7 += parseFloat($('input[name=\'order_product[' + num7 + '][ti027]\']').val());
			num7++;	
			}
		}
		if(isNaN(sum7)){sum7=0}
		$('#ti027_sum').val(sum7);
		num7 = 0;
	//end 本幣進貨費用
	
	//本幣金額合計
	sum8 =  parseFloat($('#ti046_sum').val()) + parseFloat($('#ti047_sum').val());
	if(isNaN($('#sum_1').val())){$('#sum_1').val()=0};
	$('#sum_1').val(sum8);
	//end 本幣金額合計
	
	//原幣金額合計
	sum9 = parseFloat($('#ti044_sum').val()) + parseFloat($('#ti045_sum').val());
	if(isNaN($('#sum_2').val())){$('#sum_2').val()=0};
	$('#sum_2').val(sum9);
	//end 原幣金額合計
	
	//數量合計
	$(".data_class").each(function(index, element) {
		index10 = index+1;
    });	
		
		if(index10 >=1){
			for(i = 1; i<=index10; i++){
			while (typeof($('input[name=\'order_product[' + num10 + '][ti020]\']').val()) == 'undefined'){
				num10++;	
			}
			sum10 += parseFloat($('input[name=\'order_product[' + num10 + '][ti020]\']').val());
			num10++;	
			}
		}
		if(isNaN(sum10)){sum10=0}
		$('#ti020_sum').val(sum10);
		num10 = 0;
	//end 數量合計
}
</script>


