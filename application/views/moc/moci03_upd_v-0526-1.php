<?php 
//echo "<pre>";var_dump($result);exit;
/***先行處理一下資料***/
//title通常只會有一筆
$title_data = $result['title_data'][0];
foreach($title_data as $key=>$val){
	$$key = $val;
	if($key == 'tc003' || $key == 'tc014'){
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
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>
  </div>

  <div id="content"> <!-- div-3 --> 
	<div class="box"> <!-- div-4 -->
		<div class="heading">
		  <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 領料單建立作業 - 修改</h1>
		  <div style="float:right;margin:6px 0px;"><a id='set_detail_view' name='set_detail_view' href="<?php echo site_url('moc/moci03/set_detail_view'); ?>" class="button" ><span>變更明細檢視設定</span></a></div>
		</div>
		
		<div class="content"> <!-- div-5 -->
		<form class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/moc/moci03/updsave" >
		<div id="tab-general"> <!-- div-6 -->
		<table class="form14" > <!-- 頭部表格 -->
			<tr style='display:none;'><td><input name="flag" value="<?php echo $flag;?>" /></td></tr>
		  <tr>
			<td class="normal14" width="10%"><span class="required">領料單別：</span></td>
			<td class="normal14" width="40%">
				<input tabIndex="1" id="tc001" name="tc001" value="<?php echo strtoupper($tc001); ?>" size="12" onKeyPress="keyFunction()" onChange="startpurq04a33(this)" type="text" readonly="readonly" required />
				<!--<a href="javascript:;"><img id="Showtc001disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>-->
				<span id="tc001disp"><?php echo $tc001disp; ?></span>
			</td>
			<td class="normal14" width="10%" >廠別代號：</td>
			<td class="normal14" width="40%" >
				<input tabIndex="7" id="tc004" name="tc004" value="<?php echo $tc004;?>" size="12" onfocus="" onchange="check_tc004(this)" onKeyPress="keyFunction()" type="text" />
				<a href="javascript:;"><img id="Showtc004disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
				<span id="tc004disp"><?php echo $tc004disp; ?></span>
			</td>
		  </tr>	
		  <tr>
			<td class="normal14a" ><span class="required">領料單號：</span></td>
			<td class="normal14a" >
				<input tabIndex="2" id="tc002" name="tc002" value="<?php echo $tc002;?>" size="12" onKeyPress="keyFunction()" type="text" readonly="readonly" required />
			</td>
			<td class="normal14a" >生產線別：</td>
			<td class="normal14" >
				<input tabIndex="8" id="tc005" name="tc005" value="<?php echo $tc005; ?>" size="10" onKeyPress="keyFunction()" onchange="check_tc005(this)" type="text" />
				<a href="javascript:;"><img id="Showtc005disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
				<span id="tc005disp"><?php echo $tc005disp;?></span>
			</td>
		  </tr>
		  <tr>
			<td class="normal14a" >單據日期：</td>
			<td class="normal14" >
				<input tabIndex="3" id="tc014" name="tc014" value="<?php echo $tc014; ?>" size="10" onKeyPress="keyFunction()" type="text" readonly="readonly" />
			</td> 
			<td class="normal14a" >加工廠商：</td>
			<td class="normal14" >
				<input tabIndex="9" id="tc006" name="tc006" value="<?php echo $tc006; ?>" size="10" onKeyPress="keyFunction()" onchange="check_tc006(this)" type="text" />
				<a href="javascript:;"><img id="Showtc006disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
				<span id="tc006disp"><?php echo $tc006disp;?></span>
			</td>
		  </tr>
		  <tr>
			<td class="normal14a" >領料日期：</td>
			<td class="normal14" >
				<input tabIndex="3" id="tc003" name="tc003" value="<?php echo $tc003; ?>" size="10" onKeyPress="keyFunction()" onchange="dateformat_ymd(this)" type="text" />
			</td> 
			<td class="normal14a" >單據性質：</td>
			<td class="normal14" >
				<select tabIndex="9" id="tc008" name="tc008" onKeyPress="keyFunction()">
					<option <?php if($tc008 == '54') echo 'selected="selected"';?> value='54'>54.廠內領料</option>                                                                        
					<option <?php if($tc008 == '55') echo 'selected="selected"';?> value='55'>55.託外領料</option>
					<option <?php if($tc008 == '56') echo 'selected="selected"';?> value='56'>56.廠內退料</option>
					<option <?php if($tc008 == '57') echo 'selected="selected"';?> value='57'>57.託外退料</option>
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="normal14a" >備註：</td>
			<td class="normal14" >
				<input tabIndex="4" id="tc007" name="tc007" value="<?php echo $tc007; ?>" size="50" onKeyPress="keyFunction()" type="text" />
			</td>
			<td class="normal14a" >產生分錄：
				<input tabIndex="10" id="tc011" name="tc011" value="Y" onKeyPress="keyFunction()" type="checkbox" <?php if($tc011 == 'Y') echo 'checked';?> />
			</td>
			<td class="normal14" >庫存不足照領：
				<input tabIndex="11" id="tc013" name="tc013" value="Y" onKeyPress="keyFunction()" type="checkbox" <?php if($tc013 == 'Y') echo 'checked';?> />
			</td>
		  </tr>
		  <tr>
			<td class="normal14a" ></td>
			<td class="normal14" ></td> 
			<td class="normal14a" >產生依序：</td>
			<td class="normal14" >
				<select tabIndex="12" id="tc012" name="tc012" onKeyPress="keyFunction()">
					<option <?php if($tc012 == '1') echo 'selected="selected"';?> value='1'>1:依製令單號</option>                                                                        
					<option <?php if($tc012 == '2') echo 'selected="selected"';?> value='2'>2:依材料品號</option>
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="normal14a" >確認者：</td>
			<td class="normal14a" >
				<input tabIndex="6" id="tc015" name="tc015" value="<?php echo $tc015;?>" size="10" onKeyPress="keyFunction()" type="text" readonly="readonly" />
			</td>
			<td class="normal14" >確認碼：</td>
			<td class="normal14" >
				<select tabIndex="13" id="tc009" name="tc009" onKeyPress="keyFunction()">
					<option <?php if($tc009 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
					<option <?php if($tc009 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
					<option <?php if($tc009 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
				</select><span id="approved" ></span>
			</td> 
		  </tr>
		</table>
		
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
					if(isset($val['style'])){
						echo "style='".$val['style']."' ";}
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
			  </tr>
			</thead>
			<?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 ?>
			<?php foreach($body_data as $key => $val){
				$current_product_count++;
				echo "<tbody id='product_row_".$current_product_count."' class='product_row' >";
				echo "<tr>";
				echo "<td class='center'><img src='".base_url()."assets/image/delete2.png' title='刪除資料' onclick='del_detail(\"".$val->te001."\",\"".$val->te002."\",\"".$val->te003."\",\"".$current_product_count."\");' /></td>";
				foreach($usecol_array as $k => $v){
					if(isset($v['type'])){$type = $v['type'];}else{$type = "text";}
					
					echo "<td ";
					if(isset($v['data_class'])){echo "class='".$v['data_class']."'";}
					echo ">";
					
					if($type == "text"){
						echo "<input type='".$type."' id='order_product[".$current_product_count."][".$k."]' name='order_product[".$current_product_count."][".$k."]' class='order_product_".$k."' value='".$val->$k."' onKeyPress='keyFunction()' ";
						if(isset($v['size'])){echo "size='".$v['size']."' ";}
						if(isset($v['onclick'])){echo "onclick=\"".$v['onclick']."\" ";}
						if(isset($v['ondblclick'])){echo "ondblclick=\"".$v['ondblclick']."\" ";}
						if(isset($v['onchange'])){echo "onchange=\"".$v['onchange']."\" ";}
						if(isset($v['style'])){echo "style='".$v['style']."' ";}
						if(isset($v['readonly'])){echo "readonly='".$v['readonly']."' ";}
						if(isset($v['disable'])){echo "disable='".$v['disable']."' ";}
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
					echo "</td>";
				}
				
				
				
				
				echo "</tr>";
				echo "</tbody>";
			}?>
			   <tfoot>
				<tr>
				 <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
				 <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
				</tr>
				  
				</tfoot>
			  </table>
			</div>
		</div>
		 
		 <!-- 合計     -->
				 <tr>
					<td class="right" valign="top"><b style="color: #003A88;">　製令單別：</b></td>
					<td ><input type='text' id="tb001" name='tb001' size="4" onchange="check_moci02();" value="" style="background-color:#EBEBE4" /></td>
					<td class="right" valign="top"><b style="color: #003A88;">　製令單號：</b></td>
					<td ><input type='text' id="tb002" name='tb002' size="12" onchange="check_moci02();" value="" style="background-color:#EBEBE4" /></td>
					<td class="center" valign="top">
						<span id="moci02_disp"></span>
					</td>
					<td class="left" valign="top">
						<a accesskey="" onKeyPress="keyFunction()" id='import' name='import' href="javascript:import_moci02()" class="button" ><span>匯入製令明細</span></a>
					</td>
				  </tr>
			<!-- 合計     -->	
		</div> <!-- div-8 -->
		
			<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		<div class="buttons">
			<button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
			<a accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('moc/moci03/'.$this->session->userdata('moci03_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;　　　　　　　　　　
		<!--<a  accesskey="y" onKeyPress="keyFunction()" id='yes' name='yes' href="<?php echo site_url('moc/moci03/yescal'); ?>" class="button" ><span>確 認 y </span><img src="<?php echo base_url()?>assets/image/png/appr.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a  accesskey="n" onKeyPress="keyFunction()" id='no' name='no' href="<?php echo site_url('moc/moci03/nocal'); ?>" class="button" ><span>取消確認 n </span><img src="<?php echo base_url()?>assets/image/png/unappr.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a  accesskey="i" onKeyPress="keyFunction()" id='inva' name='inva' href="<?php echo site_url('moc/moci03/incal'); ?>" class="button" ><span>作 廢 i </span><img src="<?php echo base_url()?>assets/image/png/invalid.png" /></a> -->
		</div> 
		
		</form>
		<?php if ($message!=' ') { ?>
		<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
			'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
		</div> <!-- div-6 -->
	</div> <!-- div-5 -->
</div> <!-- div-4 -->
<?php //include_once("./application/views/fun/moci03_funjsupd_v.php"); ?>
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
		url: "<?php echo base_url() ?>index.php/moc/moci03/check_moci02",
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
		url: "<?php echo base_url() ?>index.php/moc/moci03/import_moci02",
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
					$('#order_product\\['+current_count+'\\]\\[te005\\]').val(val['tb004']-val['tb005']);
					$('#order_product\\['+current_count+'\\]\\[te009\\]').val(val['tb006']);
					$('#order_product\\['+current_count+'\\]\\[te006\\]').val(val['tb007']);
					$('#order_product\\['+current_count+'\\]\\[te008\\]').val(val['tb009']);
					$('#order_product\\['+current_count+'\\]\\[te016\\]').val(val['tb011']);
					$('#order_product\\['+current_count+'\\]\\[te017\\]').val(val['tb012']);
					$('#order_product\\['+current_count+'\\]\\[te018\\]').val(val['tb013']);
					$('#order_product\\['+current_count+'\\]\\[te021\\]').val(val['tb019']-val['tb020']);
					$('#order_product\\['+current_count+'\\]\\[te022\\]').val(val['tb021']);
					$('#order_product\\['+current_count+'\\]\\[te011\\]').val(tb001);
					$('#order_product\\['+current_count+'\\]\\[te012\\]').val(tb002);
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
		append_str += "</td>";
	}
	
	append_str += "</tr>";
	append_str += "</tbody>";
	$('#order_product tfoot').before(append_str);
	
	//以下為需要各表各自設定部分(即為快速查詢功能設定)//
	//品號查詢品名規格
	set_catcomplete(current_count);
}
function set_catcomplete(row){
    $('#order_product\\['+row+'\\]\\[te004\\]').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#order_product\\['+row+'\\]\\[te004\\]').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_invi02/'+encodeURIComponent(smb001), 
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
				$('#order_product\\['+row+'\\]\\[te004\\]').val(ui.item.value1);
				$('#order_product\\['+row+'\\]\\[te017\\]').val(ui.item.value2);
				$('#order_product\\['+row+'\\]\\[te018\\]').val(ui.item.value3);
				$('#order_product\\['+row+'\\]\\[te006\\]').val(ui.item.value4);
				$('#order_product\\['+row+'\\]\\[te022\\]').val(ui.item.value5);
			}
			return false;
		},
		focus: function(event, ui) {
			return false;
		}
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
		url: "<?php echo base_url() ?>index.php/moc/moci03/del_detail_ajax",
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
		$('#product_row_'+row+' input.order_product_te00'+k).val("");
		$('#product_row_'+row+' input.order_product_te0'+k).val("");
		$('#product_row_'+row+' input.order_product_te'+k).val("");
	}
}
</script>
<script>
//以下為需要各表各自設定部分(即為開視窗功能設定)//
</script>

<script>
//查詢廠別視窗
$(document).ready(function(){
	$("#Showtc004disp").click(function() {
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
		onOverlayClick: clear_tc004disp_sql
	});
	});
    $('#tc004').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#tc004').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_cmsi02/'+encodeURIComponent(smb001), 
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
				$('#tc004').val(ui.item.value1);
				$('#tc004disp').text(ui.item.value2);
				console.log($('#tc004').val());
				return false;
			}else{
				$('#tc004disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addtc004disp(mb001,mb002){
	$('#tc004').val(mb001);
	$('#tc004disp').text(mb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi02/clear_sql"
	});
}
function clear_tc004disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi02/clear_sql"
	});
}
function check_tc004(row_obj){
	var smb001= $('#tc004').val();
	if(!smb001){$('#tc004disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_cmsi02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#tc004').val("");
					$('#tc004disp').text("查無資料");
				}
				$('#tc004').val(data.message[0].value1);
				$('#tc004disp').text(data.message[0].value2);
			}else{
				$('#tc004').val("");
				$('#tc004disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFcmsi02" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/cms/cmsi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script>
//查詢生產線視窗
$(document).ready(function(){
	$("#Showtc005disp").click(function() {
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
		onOverlayClick: clear_tc005disp_sql
	});
	});
    $('#tc005').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#tc005').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_cmsi04/'+encodeURIComponent(smb001), 
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
				$('#tc005').val(ui.item.value1);
				$('#tc005disp').text(ui.item.value2);
				console.log($('#tc005').val());
				return false;
			}else{
				$('#tc005disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addtc005disp(md001,md002){
	$('#tc005').val(md001);
	$('#tc005disp').text(md002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
	});
}
function clear_tc005disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi04/clear_sql"
	});
}
function check_tc005(row_obj){
	var smb001= $('#tc005').val();
	if(!smb001){$('#tc005disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_cmsi04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#tc005').val("");
					$('#tc005disp').text("查無資料");
				}
				$('#tc005').val(data.message[0].value1);
				$('#tc005disp').text(data.message[0].value2);
			}else{
				$('#tc005').val("");
				$('#tc005disp').text("查無資料");
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
$(document).ready(function(){
	$("#Showtc006disp").click(function() {
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
		onOverlayClick: clear_tc006disp_sql
	});
	});
    $('#tc006').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#tc006').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri01/'+encodeURIComponent(smb001), 
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
				$('#tc006').val(ui.item.value1);
				$('#tc006disp').text(ui.item.value2);
				console.log($('#tc006').val());
				return false;
			}else{
				$('#tc006disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addtc006disp(ma001,ma002){
	$('#tc006').val(ma001);
	$('#tc006disp').text(ma002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function clear_tc006disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri01/clear_sql"
	});
}
function check_tc006(row_obj){
	var smb001= $('#tc006').val();
	if(!smb001){$('#tc006disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {ma001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#tc006').val("");
					$('#tc006disp').text("查無資料");
				}
				$('#tc006').val(data.message[0].value1);
				$('#tc006disp').text(data.message[0].value2);
			}else{
				$('#tc006').val("");
				$('#tc006disp').text("查無資料");
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
function search_te004_window(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
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
		message: $('#divFinvi02'),
		onOverlayClick: clear_te004disp_sql
	});
}
function addte004disp(mb001,mb002,mb003,mb004,mb090){
	clear_row(selected_row);
	$('#order_product\\['+selected_row+'\\]\\[te004\\]').val(mb001);
	$('#order_product\\['+selected_row+'\\]\\[te017\\]').val(mb002);
	$('#order_product\\['+selected_row+'\\]\\[te018\\]').val(mb003);
	$('#order_product\\['+selected_row+'\\]\\[te006\\]').val(mb004);
	$('#order_product\\['+selected_row+'\\]\\[te022\\]').val(mb090);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function mult_addte004disp(mb001,mb002,mb003,mb004,mb090){
	$('#order_product\\['+current_count+'\\]\\[te004\\]').val(mb001);
	$('#order_product\\['+current_count+'\\]\\[te017\\]').val(mb002);
	$('#order_product\\['+current_count+'\\]\\[te018\\]').val(mb003);
	$('#order_product\\['+current_count+'\\]\\[te006\\]').val(mb004);
	$('#order_product\\['+current_count+'\\]\\[te022\\]').val(mb090);
	addItem();
}
function clear_te004disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi02/clear_sql"
	});
}
function check_te004(row_obj){
	if($.isNumeric(row_obj)){row = row_obj;}
	else{var row = $(row_obj).parent().parent().parent()[0].id.substr(12);}
	var smb001 = $('#order_product\\['+row+'\\]\\[te004\\]').val();
	if(!smb001){clear_row(row);return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_invi02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response =="true"){
				$('#order_product\\['+row+'\\]\\[te004\\]').val(data.message[0].value1);
				$('#order_product\\['+row+'\\]\\[te017\\]').val(data.message[0].value2);
				$('#order_product\\['+row+'\\]\\[te018\\]').val(data.message[0].value3);
				$('#order_product\\['+row+'\\]\\[te006\\]').val(data.message[0].value4);
				$('#order_product\\['+row+'\\]\\[te022\\]').val(data.message[0].value5);
			}else{
				$('#order_product\\['+row+'\\]\\[te017\\]').val("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFinvi02" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/inv/invi02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>


















