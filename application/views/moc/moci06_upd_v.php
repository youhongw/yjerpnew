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

<?php
if(!isset($puri04)) { $puri04=$this->input->post('puri04'); }
if(!isset($puri04disp)) { $puri04disp=$this->input->post('puri04disp'); }
if(!isset($th002)) { $th002=$this->input->post('th002'); }
if(!isset($puri01)) { $puri01=$this->input->post('puri01'); }
if(!isset($puri01disp)) { $puri01disp=$this->input->post('puri01disp'); }
if(!isset($cmsi02)) { $cmsi02=$this->input->post('cmsi02'); }
if(!isset($cmsi02disp)) { $cmsi02disp=$this->input->post('cmsi02disp'); }
if(!isset($th025)) { $th025=$this->input->post('th025'); }
if(!isset($th010)) { $th010=$this->input->post('th010'); }
if(!isset($th011)) { $th011=$this->input->post('th011'); }
if(!isset($th014)) { $th014=$this->input->post('th014'); }
if(!isset($th028)) { $th028=$this->input->post('th028'); }
if(!isset($th030)) { $th030=$this->input->post('th030'); }
if(!isset($th013)) { $th013=$this->input->post('th013'); }
if(!isset($cmsi06)) { $cmsi06=$this->input->post('cmsi06'); }
if(!isset($cmsi06disp)) { $cmsi06disp=$this->input->post('cmsi06disp'); }
if(!isset($cmsi07)) { $cmsi06disp=$this->input->post('cmsi07'); }
if(!isset($th009)) { $th009=$this->input->post('th009'); }
if(!isset($th006)) { $th006=$this->input->post('th006'); }
if(!isset($cmsi21)) { $cmsi21=$this->input->post('cmsi21'); }
if(!isset($cmsi21disp)) { $cmsi21disp=$this->input->post('cmsi21disp'); }
if(!isset($th026)) { $th026=$this->input->post('th026'); }
if(!isset($th035)) { $th035=$this->input->post('th035'); }
 ?>
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
				<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 託外進貨單建立作業 - 修改　　　</h1>
				<div style="float:left;padding-top: 5px; ">
				<button style= "cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type="submit" accesskey="s" name="submit" class="button" onKeyPress="keyFunction()" onclick="addItem();" value="&nbsp;儲存F8&nbsp;"><span>儲存Alt+s</span><img src="<?php echo base_url()?>/assets/image/png/save.png" /></button>&nbsp;&nbsp;
				<a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('moc/moci06/'.$this->session->userdata('moci05_search')); ?>" class="button"><span>返回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;
				
				</div>
				<div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci06/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
			</div>
	
		<div class="content"> <!-- div-5 -->
			<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci06/updsave" >	
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
										<span id="cmsi06disp"><?php echo $cmsi06disp; ?></span>
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
					<table id="order_product" class="list1">
						<thead>
							<tr>
								<td width="3%"></td>
						
								<?php
								foreach($usecol_array as $key => $val){
									echo "<td ";
									if(isset($val['width'])){
										echo "width='".$val['width']."' ";
									}
									if(isset($val['title_class'])){
										echo "class='".$val['title_class']."' ";
									}
									//if(isset($val['style'])){
										//echo "style='".val['style']."' ";
									//}
									echo " >";
									echo $val['name'];
									echo "</td>";
								}
								?>
							</tr>
						</thead>
						<?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍?>
						<?php 
						
						foreach($body_data as $key => $val){
							$current_product_count++;
							echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
							echo "<tr>";
							echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->ti001."\",\"".$val->ti002."\",\"".$val->ti003."\",\"".$current_product_count."\");'/></td>";
							foreach($usecol_array as $k => $v){
								if($k=="ti011" || $k=="ti012" || $k=="ti018"){
									$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
								}else{
									$s = $val->$k;
								}
								
								if(isset($v['type'])){
									$type = $v['type'];
								}else{
									$type = "text";
								}
							
								echo "<td nowrap='value' ";
								if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
								echo ">";
							
								if($type == "text"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$s."' onKeyPress='keyFunction()' ";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "style='".$v['style']."' ";}
									if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
									if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
									if(isset($v['value'])){echo "value='".$v['value']."' ";}
									echo " />";
								}
								
								if($type == "select" && isset($v['option'])){
									echo "<select id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
									if(isset($v['size'])){echo "size='".$v['size']."' ";}
									if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
									if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
									if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
									if(isset($v['style'])){echo "style='".$v['style']."' ";}
									if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
									if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
									echo " >";
									foreach($v['option'] as $op_k => $op_v){
										echo "<option ";
										if($val->$k == $op_k){echo "selected='selected' ";}
										echo "value='".$op_k ."'>";
										echo $op_k.".".$op_v;
										echo "</option>";
									}
									echo "</select>";
								}
								
								if($type == "checkbox"){
									echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
									echo " />";
								}
								
								if($v['name'] == '品號'){
									echo "<a href=javascript:";
									echo "/>";
									
									echo "<img name='order".$current_product_count."' id='order".$current_product_count."' alt='' align='top' src=";
									echo base_url()."assets/image/png/invoice.png";
									echo " />";
								}
								echo "</td>";
								
								
									
									
								
								
							}
							echo "</tr>";
							echo "</tbody>";
				
						}?>
					
						<tfoot>
							<tr>
								<td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor:pointer;" onclick="addItem();" /></td>
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
			</div><!-- div-8 -->
			
			<input type="hidden" name="flag" id="flag" value="<?php echo $flag; ?>" />
			
			<!--<div class="buttons">
				<button type="submit" accesskey="s" name="submit" class="button" onKeyPress="keyFunction()" onclick="addItem();" value="&nbsp;儲存F8&nbsp;"><span>儲存Alt+s</span><img src="<?php echo base_url()?>/assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
				<a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('moc/moci06/'.$this->session->userdata('moci05_search')); ?>" class="button"><span>返回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>-->
			
			</form>
			<?php if ($message!=' ') { ?>
			<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->
			
			
<?php //include_once("./application/views/fun/moci05_funjsupd_v.php"); ?>
<!-- 不更新網頁 自動提示方框資料前置小工具 --> 
<script type="text/javascript"><!--       
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
//--></script>
<script>
var no_col = "<?php echo $no_col; ?>";	//序號欄位
var col_array = <?php echo json_encode($col_array); ?>;
var usecol_array = <?php echo json_encode($usecol_array); ?>;
var current_count = <?php echo $current_product_count; ?>;
var selected_row = 0;
$(document).ready(function(){
	for(var i=1;i<=current_count;i++){
		set_catcomplete(i);
		set_catcomplete2(i);
		set_catcomplete3(i);
	}
});
</script>
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
					$('#order_product\\['+current_count+'\\]\\[ti004\\]').val(val['ta006']); //品號
					$('#order_product\\['+current_count+'\\]\\[ti005\\]').val(val['mb002']); //品名
					$('#order_product\\['+current_count+'\\]\\[ti006\\]').val(val['mb003']); //規格
					$('#order_product\\['+current_count+'\\]\\[ti008\\]').val(val['mb004']); //單位
					$('#order_product\\['+current_count+'\\]\\[ti009\\]').val(val['mb017']); //庫別
					$('#order_product\\['+current_count+'\\]\\[mc002\\]').val(val['mc002']); //庫別名稱
					$('#order_product\\['+current_count+'\\]\\[ti013\\]').val(val['ta001']); //製令單別
					$('#order_product\\['+current_count+'\\]\\[ti014\\]').val(val['ta002']); //製令單號
				}
				
			}
		}
		
	});
}

</script>
<script>
function addItem(){
	var max_no = get_max_no();
	current_count++;
	var append_str = "";
	var type = "";
	append_str += "<tbody id='product_row_"+current_count+"' class='product_row' >";
	append_str += "<tr>";
	append_str += "<td class='center'><img src='<?php echo base_url()?>assets/image/delete2.png' title='刪除資料' onclick='$(\"#product_row_"+current_count+"\").remove();' /></td>";
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
			append_str += " />";
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
	set_catcomplete2(current_count);
	set_catcomplete3(current_count);
}
function set_catcomplete(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[ti004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[ti004\\]').val();
			var smb002= $('#order_product\\['+row+'\\]\\[ti013\\]').val();
			var smb003= $('#order_product\\['+row+'\\]\\[ti014\\]').val();
			$('#order_product\\['+row+'\\]\\[ti004\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[ti004\\]').val(ui.item.value1); //品號
				$('#order_product\\['+row+'\\]\\[ti005\\]').val(ui.item.value2); //品名
				$('#order_product\\['+row+'\\]\\[ti006\\]').val(ui.item.value3); //規格
				$('#order_product\\['+row+'\\]\\[ti008\\]').val(ui.item.value4); //單位
				$('#order_product\\['+row+'\\]\\[ti009\\]').val(ui.item.value5); //庫別
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value6); //庫別名稱
				//$('#order_product\\['+row+'\\]\\[tg011\\]').val(ui.item.value7); //入庫數量
				//$('#order_product\\['+row+'\\]\\[tg012\\]').val(ui.item.value8); //報廢數量
				$('#order_product\\['+row+'\\]\\[ti013\\]').val(ui.item.value9); //製令單別
				$('#order_product\\['+row+'\\]\\[ti014\\]').val(ui.item.value10); //製令單號
			}
			return false;
		},
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[ti004\\]').attr('onchange','check_invi02(this)');
			check_invi02(row);
			return false;
		}
	});
	//明細計算
	$('input[name=\'order_product[' + row + '][ti019]\'],input[name=\'order_product[' + row + '][ti021]\'],input[name=\'order_product[' + row + '][ti022]\'],input[name=\'order_product[' + row + '][ti020]\'],input[name=\'order_product[' + row + '][ti024]\'],input[name=\'order_product[' + row + '][ti025]\'],input[name=\'order_product[' + row + '][ti026]\'],input[name=\'order_product[' + row + '][ti027]\'],input[name=\'order_product[' + row + '][ti044]\'],input[name=\'order_product[' + row + '][ti045]\'],input[name=\'order_product[' + row + '][ti046]\'],input[name=\'order_product[' + row + '][ti047]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		//var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		//var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		//var get_total=input_1*input_2;  
		//$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 
       //合計資料
	   console.log('test');
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
	$('#order_product\\['+selected_row+'\\]\\[ti004\\]').val(ta006); //品號
	$('#order_product\\['+selected_row+'\\]\\[ti005\\]').val(mb002); //品名
	$('#order_product\\['+selected_row+'\\]\\[ti006\\]').val(mb003); //規格
	$('#order_product\\['+selected_row+'\\]\\[ti008\\]').val(mb004); //單位
	$('#order_product\\['+selected_row+'\\]\\[ti009\\]').val(mb017); //庫別
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mc002); //庫別名稱
	$('#order_product\\['+selected_row+'\\]\\[ti013\\]').val(ta001); //庫別名稱
	$('#order_product\\['+selected_row+'\\]\\[ti014\\]').val(ta002); //庫別名稱
	$('#order_product\\['+selected_row+'\\]\\[ti004\\]').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci05/clear_sql"
	});
}


function set_catcomplete2(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[ti013\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[ti013\\]').val();
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
				$('#order_product\\['+row+'\\]\\[ti004\\]').val(ui.item.value1); //品號
				$('#order_product\\['+row+'\\]\\[ti005\\]').val(ui.item.value2); //品名
				$('#order_product\\['+row+'\\]\\[ti006\\]').val(ui.item.value3); //規格
				$('#order_product\\['+row+'\\]\\[ti008\\]').val(ui.item.value4); //單位
				$('#order_product\\['+row+'\\]\\[ti009\\]').val(ui.item.value5); //庫別
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value6); //庫別名稱
				//$('#order_product\\['+row+'\\]\\[tg011\\]').val(ui.item.value7); //入庫數量
				//$('#order_product\\['+row+'\\]\\[tg012\\]').val(ui.item.value8); //報廢數量
				$('#order_product\\['+row+'\\]\\[ti013\\]').val(ui.item.value9); //製令單別
				$('#order_product\\['+row+'\\]\\[ti014\\]').val(ui.item.value10); //製令單號
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
    $('#order_product\\['+row+'\\]\\[ti009\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[ti009\\]').val();
			$('#order_product\\['+row+'\\]\\[ti009\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[ti009\\]').val(ui.item.value1);
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
function get_max_no(){
	var max_no = 1000;
	$('.product_row .order_product_'+no_col).each(function(){
		if($( this ).val() > max_no){
			max_no = $( this ).val();
		}
	});
	return max_no;
}
function del_detail(ti001,ti002,ti003,row){
	if(confirm("確定刪除細項:"+ti001+"-"+ti002+"-"+ti003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci06/del_detail_ajax",
		data: { 
			ti001: ti001, 
			ti002: ti002,
			ti003: ti003
		}
	})
	.done(function( msg ) {
		if(msg){
			alert( "刪除細項:"+ti001+"-"+ti002+"-"+ti003+" 成功!");
			$("#product_row_"+row).remove();
		}
		else{alert( "刪除細項:"+ti001+"-"+ti002+"-"+ti003+" 失敗!");}
	});
	}
}
function clear_row(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	for(var k=4;k<=22;k++){//k的最大值請依照實際情況去調整，通常設為欄位數字最大者(即最後一個欄位)
		$('#product_row'+row+' input.order_product_te00'+k).val("");
		$('#product_row'+row+' input.order_product_te0'+k).val("");
		$('#product_row'+row+' input.order_product_te'+k).val("");
	}
}
</script>
<script>
//以下為需要各表各自設定部分(即為開視窗功能設定)//
</script>

<script>
//查詢廠別視窗
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
                url: '<?php echo base_url(); ?>index.php/moc/moci06/lookup_cmsi02/'+encodeURIComponent(smb001), 
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
			return false;
		}
	});
});
function addcmsi02disp(mb001,mb002){
	$('#cmsi02').val(mb001);
	$('#cmsi02disp').text(mb002);
	$('#cmsi02').focus();
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
		url: '<?php echo base_url(); ?>index.php/moc/moci06/lookup2_cmsi02/'+encodeURIComponent(smb001), 
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

<script type="text/javascript">
//查詢單別視窗
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
                url: '<?php echo base_url(); ?>index.php/moc/moci06/lookup_puri04/'+encodeURIComponent(smb001), 
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
				var i =0
				for(i=0;i<=current_count;i++){
					$('#order_product\\['+i+'\\]\\[te001\\]').val(ui.item.value1);
				}
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
	$('#puri04').focus();
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
		url: '<?php echo base_url(); ?>index.php/moc/moci06/lookup2_puri04/'+encodeURIComponent(smb001), 
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
<iframe src="<?php echo base_url()?>index.php/pur/puri04/display_child/0/or_where?key=mq001,mq001&val=58,''" allowTransparency="false" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢生產線視窗
$(document).ready(function(){
	$("#Showcmsi04disp").click(function() {
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
		message: $('#divFcmsi04'),
		onOverlayClick: clear_cmsi04disp_sql
	});
	});

    $('#cmsi04').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi04').val();
			$('#cmsi04').attr('onchange','');
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci06/lookup_cmsi04/'+encodeURIComponent(smb001), 
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
				$('#cmsi04').val(ui.item.value1);
				$('#cmsi04disp').text(ui.item.value2);
				console.log($('#cmsi04').val());
				return false;
			}else{
				$('#cmsi04disp').text("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#cmsi04').attr('onchange','check_cmsi04(this)');
			check_cmsi04($('#cmsi04').val());
			return false;
		}
	});
});
function addcmsi04disp(md001,md002){
	$('#cmsi04').val(md001);
	$('#cmsi04disp').text(md002);
	$('#cmsi04').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
	});
}
function clear_cmsi04disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
	});
}
function check_cmsi04(row_obj){
	var smb001= $('#cmsi04').val();
	if(!smb001){$('#cmsi04disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci06/lookup2_cmsi04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#cmsi04').val("");
					$('#cmsi04disp').text("查無資料");
				}
				$('#cmsi04').val(smb001);
				$('#cmsi04disp').text(data.message[0].value2);
			}else{
				$('#cmsi04').val(smb001);
				$('#cmsi04disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi04" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/cms/cmsi04/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
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
//查詢產品視窗
function search_invi02_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	console.log(row);
	selected_row = row;
	console.log(sma001,sma002);
	var sma001 = $('#order_product\\['+row+'\\]\\[ti013\\]').val();
	var sma002 = $('#order_product\\['+row+'\\]\\[ti014\\]').val();
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
	$('#order_product\\['+selected_row+'\\]\\[ti004\\]').val(mb001); //品號
	$('#order_product\\['+selected_row+'\\]\\[ti005\\]').val(mb002); //品名
	$('#order_product\\['+selected_row+'\\]\\[ti006\\]').val(mb003); //規格
	$('#order_product\\['+selected_row+'\\]\\[ti008\\]').val(mb004); //單位
	$('#order_product\\['+selected_row+'\\]\\[ti009\\]').val(mb017); //庫別
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mc002); //庫別名稱
	$('#order_product\\['+selected_row+'\\]\\[ti004\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[ti004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[ti004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[ti005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[ti006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[ti008\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[ti009\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(data.message[0].value6);
			}else{
				$('#order_product\\['+row+'\\]\\[tg004\\]').val("查無資料");
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
	$('#order_product\\['+selected_row+'\\]\\[ti009\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[ti009\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[ti009\\]').val();
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
				$('#order_product\\['+row+'\\]\\[ti009\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[ti009\\]').val("查無資料");
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
//匯入製令明細
function check_moci05(){
	var ta001 = $('#ta001').val();
	var ta002 = $('#ta002').val();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci06/check_moci05",
		data: {
			ta001: ta001, 
			ta002: ta002
		}
	})
	.done(function( msg ) {
		$('#moci02_disp').text("明細共計:"+msg+"筆資料");
	});
}
function import_moci05(){
	var ta001 = $('#ta001').val();
	var ta002 = $('#ta002').val();
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/moc/moci06/import_moci05",
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
					$('#order_product\\['+current_count+'\\]\\[tg004\\]').val(val['ta006']);
					$('#order_product\\['+current_count+'\\]\\[tg005\\]').val(val['mb002']);
					$('#order_product\\['+current_count+'\\]\\[tg006\\]').val(val['mb003']);
					$('#order_product\\['+current_count+'\\]\\[tg007\\]').val(val['mb004']);
					$('#order_product\\['+current_count+'\\]\\[tg010\\]').val(val['mb017']);
					$('#order_product\\['+current_count+'\\]\\[mc002\\]').val(val['mc002']);
					$('#order_product\\['+current_count+'\\]\\[tg011\\]').val(val['ta017']);
					$('#order_product\\['+current_count+'\\]\\[tg012\\]').val(val['ta018']);
					$('#order_product\\['+current_count+'\\]\\[tg014\\]').val(val['ta001']);
					$('#order_product\\['+current_count+'\\]\\[tg015\\]').val(val['ta002']);
				}
				
			}
		}
		
	});
}
</script>

<script>
//單身數量處理
//驗收數量
function check_ti019(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var ti019 = $('#order_product\\['+row+'\\]\\[ti019\\]').val();
	var ti020 = $('#order_product\\['+row+'\\]\\[ti020\\]').val();
	var ti021 = $('#order_product\\['+row+'\\]\\[ti021\\]').val();
	var ti022 = $('#order_product\\['+row+'\\]\\[ti022\\]').val();
	$('#order_product\\['+row+'\\]\\[ti022\\]').val((-ti019)-ti021);
	$('#order_product\\['+row+'\\]\\[ti020\\]').val(ti019);
}
//報廢數量
function check_ti021(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var ti019 = $('#order_product\\['+row+'\\]\\[ti019\\]').val();
	var ti020 = $('#order_product\\['+row+'\\]\\[ti020\\]').val();
	var ti021 = $('#order_product\\['+row+'\\]\\[ti021\\]').val();
	var ti022 = $('#order_product\\['+row+'\\]\\[ti022\\]').val();
	$('#order_product\\['+row+'\\]\\[ti022\\]').val((-ti019)-ti021);
}

//計價數量
function check_ti020(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var ti020 = $('#order_product\\['+row+'\\]\\[ti020\\]').val();
	var ti024 = $('#order_product\\['+row+'\\]\\[ti024\\]').val();
	var ti026 = $('#order_product\\['+row+'\\]\\[ti026\\]').val();
	
	$('#order_product\\['+row+'\\]\\[ti025\\]').val(ti020 * ti024);
	$('#order_product\\['+row+'\\]\\[ti044\\]').val((ti020 * ti024)-ti026);
	$('#order_product\\['+row+'\\]\\[ti046\\]').val((ti020 * ti024)-ti026);
}

//加工單價
function check_ti024(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var ti020 = $('#order_product\\['+row+'\\]\\[ti020\\]').val();
	var ti024 = $('#order_product\\['+row+'\\]\\[ti024\\]').val();
	var ti026 = $('#order_product\\['+row+'\\]\\[ti026\\]').val();
	
	$('#order_product\\['+row+'\\]\\[ti025\\]').val(ti020 * ti024);
	$('#order_product\\['+row+'\\]\\[ti044\\]').val((ti020 * ti024)-ti026);
	$('#order_product\\['+row+'\\]\\[ti046\\]').val((ti020 * ti024)-ti026);
}

//扣款金額
function check_ti026(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var ti025 = $('#order_product\\['+row+'\\]\\[ti025\\]').val();
	var ti026 = $('#order_product\\['+row+'\\]\\[ti026\\]').val();
	
	$('#order_product\\['+row+'\\]\\[ti044\\]').val(ti025-ti026);
	$('#order_product\\['+row+'\\]\\[ti046\\]').val(ti025-ti026);
}

//計算加工金額總和
function totalSum(){
	var index1 = 0; var index2 = 0; var index3 = 0; var index4 = 0; var index5 = 0;
	var index6 = 0; var index7 = 0; var index8 = 0; var index9 = 0; var index10 = 0;
	var num1 = 0; var num2 = 0; var num3 = 0; var num4 = 0; var num5 = 0;
	var num6 = 0; var num7 = 0; var num8 = 0; var num9 = 0; var num10 = 0;
	var sum1 = 0; var sum2 = 0; var sum3 = 0; var sum4 = 0; var sum5 = 0;
	var sum6 = 0; var sum7 = 0; var sum8 = 0; var sum9 = 0; var sum10 = 0;
	
	//原幣加工金額合計
	$(".data_class").each(function(index, element) {
		index1 = index+1;
    });	
		sum1 = 0;
		if(index1 >=1){
			for(i = 1; i<=index1; i++){
				while (typeof($('input[name=\'order_product[' + num1 + '][ti025]\']').val()) == 'undefined'){
					num1++;	
				}
				if(!($('input[name=\'order_product[' + num1 + '][ti025]\']').val())){
					sum1 +=0;
					num1++;
				}else{
					sum1 += parseFloat($('input[name=\'order_product[' + num1 + '][ti025]\']').val());
					num1++;	
				}
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
				if(!($('input[name=\'order_product[' + num2 + '][ti046]\']').val())){
					sum2 +=0;
					num2++;
				}else{
					sum2 += parseFloat($('input[name=\'order_product[' + num2 + '][ti046]\']').val());
					num2++;	
				}
			}
		}
		
		if(isNaN(sum2)){sum2=0}
		$('#ti046_sum').val(sum2);
		sum2 = 0;
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
				if(!($('input[name=\'order_product[' + num3 + '][ti044]\']').val())){
					sum3 +=0;
					num3++;
				}else{
					sum3 += parseFloat($('input[name=\'order_product[' + num3 + '][ti044]\']').val());
					num3++;	
				}
			}
		}
		if(isNaN(sum3)){sum3=0}
		$('#ti044_sum').val(sum3);
		sum3 = 0;
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
				if(!($('input[name=\'order_product[' + num5 + '][ti047]\']').val())){
					sum5 +=0;
					num5++;
				}else{
					sum5 += parseFloat($('input[name=\'order_product[' + num5 + '][ti047]\']').val());
					num5++;	
				}
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
				if(!($('input[name=\'order_product[' + num6 + '][ti045]\']').val())){
					sum6 +=0;
					num6++;
				}else{
					sum6 += parseFloat($('input[name=\'order_product[' + num6 + '][ti045]\']').val());
					num6++;	
				}
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
				if(!($('input[name=\'order_product[' + num10 + '][ti020]\']').val())){
					sum10 +=0;
					num10++;
				}else{
					sum10 += parseFloat($('input[name=\'order_product[' + num10 + '][ti020]\']').val());
					num10++;	
				}
			}
		}
		if(isNaN(sum10)){sum10=0}
		$('#ti020_sum').val(sum10);
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
	
	var ti025 = Number($('#order_product\\['+row+'\\]\\[ti025\\]').val()); //加工金額
	var th030 = Number($('#th030').val()); //稅率
	var cmsi07 = Number($('#cmsi07').val()); //匯率
	switch ($('#th015').val()){
		case "1":
			$('#order_product\\['+row+'\\]\\[ti044\\]').val(Math.round(ti025 * 1 / (1+th030)));
			$('#order_product\\['+row+'\\]\\[ti045\\]').val(Math.round(ti025 * th030 / (1+th030)));
			$('#order_product\\['+row+'\\]\\[ti046\\]').val(Math.round((ti025 * cmsi07) * 1 / (1+th030)));
			$('#order_product\\['+row+'\\]\\[ti047\\]').val(Math.round((ti025 * cmsi07) * th030 / (1+th030)));
			break;
		case "2":
			$('#order_product\\['+row+'\\]\\[ti044\\]').val(Math.round(ti025));
			$('#order_product\\['+row+'\\]\\[ti045\\]').val(Math.round(ti025 * th030));
			$('#order_product\\['+row+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
			$('#order_product\\['+row+'\\]\\[ti047\\]').val(Math.round(ti025 * cmsi07 * th030));
			break;
		case "3":
			$('#order_product\\['+row+'\\]\\[ti044\\]').val(Math.round(ti025));
			$('#order_product\\['+row+'\\]\\[ti045\\]').val(ti025 * th030);
			$('#order_product\\['+row+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
			$('#order_product\\['+row+'\\]\\[ti047\\]').val(ti025 * th030);
			break;
		case "4":
			$('#order_product\\['+row+'\\]\\[ti044\\]').val(Math.round(ti025));
			$('#order_product\\['+row+'\\]\\[ti045\\]').val(ti025 * th030);
			$('#order_product\\['+row+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
			$('#order_product\\['+row+'\\]\\[ti047\\]').val(ti025 * th030);
			break;
		case "9":
			$('#order_product\\['+row+'\\]\\[ti044\\]').val(Math.round(ti025));
			$('#order_product\\['+row+'\\]\\[ti045\\]').val(ti025 * th030);
			$('#order_product\\['+row+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
			$('#order_product\\['+row+'\\]\\[ti047\\]').val(ti025 * th030);
			break;
	}
}
</script>

<script>
//加工廠商決定課稅別
function th015_change(tax){
	$('#th015').val(tax);
}
//更改課稅別重新計算以及
function exchange_tax2(){
	var index1 = 0; var num1 = 0; var sum1 = 0;
	console.log('abc');
	
	//改變稅率
	switch($('#th015').val()){
		case '1':
			$('#th030').val(<?php echo $this->session->userdata('sysma004'); ?>);
			break;
		case '2':
			$('#th030').val(<?php echo $this->session->userdata('sysma004'); ?>);
			break;
		case '3':
			$('#th030').val(0);
			break;
		case '4':
			$('#th030').val(0);
			break;
		case '9':
			$('#th030').val(0);
			break;
	}
	
	
	//原幣稅額
	$(".data_class").each(function(index, element) {
		index1 = index+1;
    });	
		
		if(index1 >=1){
			for(i = 1; i<=index1; i++){
				while (typeof($('input[name=\'order_product[' + num1 + '][ti044]\']').val()) == 'undefined'){
					num1++;	
				}
				var ti025 = Number($('#order_product\\['+num1+'\\]\\[ti025\\]').val()); //加工金額
				var th030 = Number($('#th030').val()); //稅率
				var cmsi07 = Number($('#cmsi07').val()); //匯率
			
				switch($('#th015').val()){
					case '1':
						$('#order_product\\['+num1+'\\]\\[ti044\\]').val(Math.round(ti025 * 1 / (1+th030)));
						$('#order_product\\['+num1+'\\]\\[ti045\\]').val(Math.round(ti025 * th030 / (1+th030)));
						$('#order_product\\['+num1+'\\]\\[ti046\\]').val(Math.round((ti025 * cmsi07) * 1 / (1+th030)));
						$('#order_product\\['+num1+'\\]\\[ti047\\]').val(Math.round((ti025 * cmsi07) * th030 / (1+th030)));
						break;
					case '2':
						$('#order_product\\['+num1+'\\]\\[ti044\\]').val(Math.round(ti025));
						$('#order_product\\['+num1+'\\]\\[ti045\\]').val(Math.round(ti025 * th030));
						$('#order_product\\['+num1+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[ti047\\]').val(Math.round(ti025 * cmsi07 * th030));
						break;
					case '3':
						$('#order_product\\['+num1+'\\]\\[ti044\\]').val(Math.round(ti025));
						$('#order_product\\['+num1+'\\]\\[ti045\\]').val(ti025 * th030);
						$('#order_product\\['+num1+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[ti047\\]').val(ti025 * th030);
						break;
					case '4':
						$('#order_product\\['+num1+'\\]\\[ti044\\]').val(Math.round(ti025));
						$('#order_product\\['+num1+'\\]\\[ti045\\]').val(ti025 * th030);
						$('#order_product\\['+num1+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[ti047\\]').val(ti025 * th030);
						break;
					case '9':
						$('#order_product\\['+num1+'\\]\\[ti044\\]').val(Math.round(ti025));
						$('#order_product\\['+num1+'\\]\\[ti045\\]').val(ti025 * th030);
						$('#order_product\\['+num1+'\\]\\[ti046\\]').val(Math.round(ti025 * cmsi07));
						$('#order_product\\['+num1+'\\]\\[ti047\\]').val(ti025 * th030);
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

<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/cmsi07_funmjs_v.php"); ?>  <!-- 匯率 -->
<?php  include_once("./application/views/funnew/cmsi21_funmjs_v.php"); ?>  <!-- 付款條件 -->



