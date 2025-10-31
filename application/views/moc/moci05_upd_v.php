<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tf003' || $key == 'tf012'){
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

<div id="container"> <!-- div-1 -->
	<div id="header"> <!-- div-2 -->
		<div class="div1">
		<!--	<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
			<div class="div3">
				<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
				<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
				<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
			</div>
		</div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
	</div>
		
	<div id="content"> <!-- div-3 --> 
		<div class="box"> <!-- div-4 --><span>　　　　　　</span>
			<div class="heading">
				<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 生產入庫單建立作業 - 修改　　　</h1>
				<div style="float:left;padding-top: 5px; ">
				<button style= "cursor:pointer" form="commentForm" onfocus="$('#puri04').focus();" type="submit" accesskey="s" name="submit" class="button" onKeyPress="keyFunction()" onclick="addItem();" value="&nbsp;儲存F8&nbsp;"><span>儲存Alt+s</span><img src="<?php echo base_url()?>/assets/image/png/save.png" /></button>&nbsp;&nbsp;
				<a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('moc/moci05/'.$this->session->userdata('moci05_search')); ?>" class="button"><span>返回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
				
				</div>
				<div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci05/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
			</div>
	
			<div class="content"> <!-- div-5 -->
				<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/moc/moci05/updsave" method="post" enctype="multipart/form-data" >
				<div id="tab-general"> <!-- div-6 -->
					<table class="form14"  >     <!-- 頭部表格 -->
					<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
					<tr>
						<td class="normal14y"  width="10%"><span class="required">入庫單別：</span> </td>
						<td class="normal14a"  width="22%">
							<input tabIndex="1" id="puri04" name="puri04" onKeyPress="keyFunction()"  value="<?php echo strtoupper($tf001);?>" onChange="check_puri04(this);check_title_no();" type="text" readonly="readonly" style="background-color:#EBEBE4" required />
							<!--<a href="javascript:;"><img id="Showpuri04disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>-->
							<span id="puri04disp"><?php echo $tf001disp; ?></span>
						</td>
			
						<td class="normal14y" width="10%" >單據日期： </td>
						<td class="normal14a"  width="24%" >
							<input tabIndex="2" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);check_title_no();" id="Ddate" onKeyPress="keyFunction()"  name="Ddate"  value="<?php echo $tf012; ?>"  size="12" type="text" style="background-color:#E7EFEF"  />
						</td>
			
						<td class="normal14y" width="10%" >
							<span class="required">入庫單號：</span> 
						</td>
        
						<td class="normal14a"  width="24%" >
							<input tabIndex="3" id="tf002" onKeyPress="keyFunction()" name="tf002" value="<?php echo $tf002; ?>" size="20" type="text" readonly="readonly" style="background-color:#EBEBE4" required />
						</td>
					</tr>		
		  
					<tr>
						<td class="normal14z" >
							廠別代號：
						</td>
			  
						<td class="normal14" >
							<input   tabIndex="4" id="cmsi02" onKeyPress="keyFunction()" onchange="check_cmsi02(this)" name="cmsi02" value="<?php echo $tf004; ?>"  type="text" required />
							<a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
							<span id="cmsi02disp"><?php echo $tf004disp; ?></span>
						</td>
		
						<td class="normal14z" >生產線別：</td>
						<td class="normal14a" >
							<input tabIndex="5" id="cmsi04" onKeyPress="keyFunction()"  name="cmsi04" onchange="check_cmsi04(this)"  value="<?php echo $tf011; ?>"  type="text" />
							<a href="javascript:;"><img id="Showcmsi04disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
							<span id="cmsi04disp"><?php echo $tf011disp; ?></span>
						</td>
		
						<td class="normal14z">簽核狀態：</td>
						<td  class="normal14"  >
							<select id="tf014" tabIndex="8" readonly="value" onKeyPress="keyFunction()" name="tf014"   style="background-color:#EBEBE4" >
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
					</tr>
			
					<tr>
						<td class="normal14z" >入庫日期：</td>
						<td class="normal14"  >
							<input type="text" tabIndex="7" onKeyPress="keyFunction()"   name="tf003" value="<?php echo $tf003;?>" style="background-color:#E7EFEF" readonly="readonly"/>
						</td>
		
						
			  
						<td class="normal14z" >列印次數：</td>						
						<td  class="normal14"  >
							<input type="text" tabIndex="9"  readonly="value"  onKeyPress="keyFunction()" id="tf008" name="tf008" size="5"  value="<?php echo $tf008; ?>" style="background-color:#EBEBE4" />
						</td>
						
						<td class="normal14z" >備註：</td>
						<td class="normal14a" >
							<input  tabIndex="12"  id="tf005" onKeyPress="keyFunction()"   name="tf005" value="<?php echo $tf005;?>" type="text"     />
						</td> 
					</tr>
			
					<tr>
						<td class="normal14z">確認者：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tf013" readonly="value" onKeyPress="keyFunction()"  name="tf013" value="<?php echo $tf013; ?>" size="10" type="text" style="background-color:#EBEBE4"  />
						</td>
		
						<td class="normal14z" >確認碼：</td>
						<td class="normal14" >
							<select tabIndex="13" id="tf006" name="tf006" onKeyPress="keyFunction()">
							<option value='Y'>Y確認</option>                                                                        
							<option value='N'>N取消確認</option>
							<option value='V'>V作廢</option>
							</select>
							<span id="approved" ></span>
						</td>
		 
						
					</tr>
	   
					<tr>
						<td class="normal14z">產生分錄：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tf010" name="tf010" value="Y" onKeyPress="keyFunction()" type="checkbox" />
						</td>
						
						<td class="normal14z">自動扣料：</td>
						<td  class="normal14"  >
							<input tabIndex="10" id="tf009" name="tf009" value="Y" onKeyPress="keyFunction()" type="checkbox" />
						</td>
						
					</tr>
				</table>
	
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
							echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->tg001."\",\"".$val->tg002."\",\"".$val->tg003."\",\"".$current_product_count."\");'/></td>";
							foreach($usecol_array as $k => $v){
								if($k=="tg018" || $k=="tg019"){
									$s = substr($val->$k,0,4)."/".substr($val->$k,4,2)."/".substr($val->$k,6,2);
								}else{
									$s = $val->$k;
								}
								
								if(isset($v['type'])){
									$type = $v['type'];
								}else{
									$type = "text";
								}
							
								echo "<td ";
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
				<td ><input type='text' id="ta001" name='ta001' size="4" onchange="check_moci05();" value="" style="background-color:#EBEBE4" /></td>
				<td class="right" valign="top"><b style="color: #003A88;">　製令單號：</b></td>
				<td ><input type='text' id="ta002" name='ta002' size="12" onchange="check_moci05();" value="" style="background-color:#EBEBE4" /></td>
				<td class="center" valign="top">
					<span id="moci02_disp">　　　　　　</span>
				</td>
				<td class="left" valign="top">
					<a accesskey="" onKeyPress="keyFunction()" id='import' name='import' href="javascript:import_moci05()" class="button" ><span>匯入製令明細</span></a>
				</td>
			</tr>
			<!-- 合計-->
			</div><!-- div-8 -->
			
			<input type="hidden" name="flag" id="flag" value="<?php echo $flag; ?>" />
			
			<!--<div class="buttons">
				<button type="submit" accesskey="s" name="submit" class="button" onKeyPress="keyFunction()" onclick="addItem();" value="&nbsp;儲存F8&nbsp;"><span>儲存Alt+s</span><img src="<?php echo base_url()?>/assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
				<a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('moc/moci05/'.$this->session->userdata('moci05_search')); ?>" class="button"><span>返回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
				
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
function check_moci02(){
	var tb001 = $('#tb001').val();
	var tb002 = $('#tb002').val();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci05/check_moci02",
		data: {
			tb001: tb001, 
			tb002: tb002
		}
	})
	.done(function( msg ) {
		$('#moci02_disp').text("明細共計:"+msg+"筆資料");
	});
}
function import_moci02(){
	var tb001 = $('#tb001').val();
	var tb002 = $('#tb002').val();
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url() ?>index.php/moc/moci05/import_moci02",
		data: {
			tb001: tb001, 
			tb002: tb002
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
					addItem();
					$('#order_product\\['+current_count+'\\]\\[te004\\]').val(val['tb003']);
					$('#order_product\\['+current_count+'\\]\\[te005\\]').val(val['tb005']);
					$('#order_product\\['+current_count+'\\]\\[te009\\]').val(val['tb006']);
					$('#order_product\\['+current_count+'\\]\\[te006\\]').val(val['tb007']);
					$('#order_product\\['+current_count+'\\]\\[te008\\]').val(val['tb009']);
					$('#order_product\\['+current_count+'\\]\\[te016\\]').val(val['tb011']);
					$('#order_product\\['+current_count+'\\]\\[te017\\]').val(val['tb012']);
					$('#order_product\\['+current_count+'\\]\\[te018\\]').val(val['tb013']);
					$('#order_product\\['+current_count+'\\]\\[te021\\]').val(val['tb020']);
					$('#order_product\\['+current_count+'\\]\\[te022\\]').val(val['tb021']);
					$('#order_product\\['+current_count+'\\]\\[te011\\]').val(tb001);
					$('#order_product\\['+current_count+'\\]\\[te012\\]').val(tb002);
					$('#order_product\\['+current_count+'\\]\\[tb004\\]').val(val['tb004']);
					$('#order_product\\['+current_count+'\\]\\[tb005\\]').val(val['tb005']);
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
			append_str += "<td ";
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
    $('#order_product\\['+row+'\\]\\[tg004\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[tg004\\]').val();
			var smb002= $('#order_product\\['+row+'\\]\\[tg014\\]').val();
			var smb003= $('#order_product\\['+row+'\\]\\[tg015\\]').val();
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
			console.log(ui.item.value);
			if(ui.item.value!="查無資料"){
				$('#order_product\\['+row+'\\]\\[tg004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tg005\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[tg006\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[tg007\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[tg010\\]').val(ui.item.value5);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value6);
				$('#order_product\\['+row+'\\]\\[tg011\\]').val(ui.item.value7);
				$('#order_product\\['+row+'\\]\\[tg012\\]').val(ui.item.value8);
				$('#order_product\\['+row+'\\]\\[tg014\\]').val(ui.item.value9);
				$('#order_product\\['+row+'\\]\\[tg015\\]').val(ui.item.value10);
			}
			return false;
		},
		change: function(event, ui) {
			$('#order_product\\['+row+'\\]\\[tg004\\]').attr('onchange','check_invi02(this)');
			check_invi02(row);
			return false;
		}
	});
}

function set_catcomplete2(row){
	console.log(row);
    $('#order_product\\['+row+'\\]\\[tg014\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tg014\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tg004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[tg005\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[tg006\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[tg007\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[tg010\\]').val(ui.item.value5);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value6);
				$('#order_product\\['+row+'\\]\\[tg011\\]').val(ui.item.value7);
				$('#order_product\\['+row+'\\]\\[tg012\\]').val(ui.item.value8);
				$('#order_product\\['+row+'\\]\\[tg014\\]').val(ui.item.value9);
				$('#order_product\\['+row+'\\]\\[tg015\\]').val(ui.item.value10);
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
    $('#order_product\\['+row+'\\]\\[tg010\\]').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb002= $('#order_product\\['+row+'\\]\\[tg010\\]').val();
			$('#order_product\\['+row+'\\]\\[tg010\\]').attr('onchange','');
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
				$('#order_product\\['+row+'\\]\\[tg010\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(ui.item.value2);
			}
			return false;
		},
		change: function(event, ui) {
			$('#cmsi03').attr('onchange','check_cmsi03d(this)');
			check_cmsi03d($('#order_product\\['+row+'\\]\\[td007\\]').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
}
</script>
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
function del_detail(te001,te002,te003,row){
	if(confirm("確定刪除細項:"+te001+"-"+te002+"-"+te003+"?")){
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/moc/moci05/del_detail_ajax",
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
                url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup_puri04/'+encodeURIComponent(smb001), 
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
		url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup2_puri04/'+encodeURIComponent(smb001), 
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
                url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup_cmsi04/'+encodeURIComponent(smb001), 
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
		url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup2_cmsi04/'+encodeURIComponent(smb001), 
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
//查詢廠商視窗
/*
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
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#puri01').val();
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
				console.log($('#puri01').val());
				return false;
			}else{
				$('#puri01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
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
		url: '<?php echo base_url(); ?>index.php/moc/moci05/lookup_puri01/'+encodeURIComponent(smb001), 
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
				$('#puri01').val(data.message[0].value1);
				$('#puri01disp').text(data.message[0].value2);
			}else{
				$('#puri01').val("");
				$('#puri01disp').text("查無資料");
			}
		}
	});
}
*/
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
	var sma001 = $('#order_product\\['+row+'\\]\\[tg014\\]').val();
	var sma002 = $('#order_product\\['+row+'\\]\\[tg015\\]').val();
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
	$('#order_product\\['+selected_row+'\\]\\[tg004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[tg005\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tg006\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[tg007\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[tg010\\]').val(mb017);
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mc002);
	$('#order_product\\['+selected_row+'\\]\\[tg004\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[tg004\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tg004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[tg005\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[tg006\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[tg007\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[tg010\\]').val(data.message[0].value5);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(data.message[0].value5);
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
	$('#order_product\\['+selected_row+'\\]\\[tg010\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[mc002\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[tg010\\]').focus();
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
	var smb001 = $('#order_product\\['+row+'\\]\\[tg010\\]').val();
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
				$('#order_product\\['+row+'\\]\\[tg010\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[mc002\\]').val(data.message[0].value2);
			}else{
				$('#order_product\\['+row+'\\]\\[tg010\\]').val("查無資料");
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
		url: "<?php echo base_url() ?>index.php/moc/moci05/check_moci05",
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
		url: "<?php echo base_url() ?>index.php/moc/moci05/import_moci05",
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














			
			
			
			
			
			
			
			
		