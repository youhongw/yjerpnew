<div id="container"> <!-- div-1 -->
<div id="header"> <!-- div-2 -->
<div class="div1">
  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
	<div class="div3">
		<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
		<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	</div>
</div>
<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
	<div class="heading">
		<h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /><?php echo $systitle; ?></h1>
	</div>
	
	<div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm" name="form" action="<?php echo base_url()?>index.php/<?php echo $process_class; ?>/<?php echo $process; ?>/save_print_format" method="post" enctype="multipart/form-data" > 
		<div id="tab-general"> <!-- div-6 -->
		<?php
			$col_count = count($col_array);
			$usecol_count = count($usecol_array);
			/*echo "<pre>";
			//var_dump($col_array);
			//var_dump($col_count);
			var_dump($usecol_array);
			var_dump($usecol_count);
			echo "</pre>";*/
		?>
		<table class="form14">
		  <tr><b>請選擇欲顯示的欄位</b></tr>
		<?php 
			foreach($col_array as $key=>$val){
				if($key==$data_title->tb007) {$detail_table=$key;}
				echo "<tr><th colspan='2'>".$key;
				echo "<input id='".$key."_detail_check' class='detail_check ".$key."_detail' style='width:30px;' type='checkbox' onclick='show_detail(this);' ";
				if($key==$data_title->tb007) {echo "checked='checked' ";}elseif($data_title->tb007 && $key!=$data_title->tb007){echo "disabled='disabled' ";}
				echo " />是否為細項Table</th>";
				echo "<td colspan='2'>細項間距<input id='".$key."_detail_input' name='".$key."_detail_input' class='".$key."_detail' size='3' value='".$data_title->tb008."' onchange='show_detail(this);' ";
				if($key!=$data_title->tb007) {echo "disabled='disabled' ";}
				echo " />px 重複個數<input id='".$key."_detail_count' name='".$key."_detail_count' class='".$key."_detail' size='2' value='8' onchange='show_detail(this);' ";
				if($key!=$data_title->tb007) {echo "disabled='disabled' ";}
				echo " />";
				echo "</td>";
				
				echo "<td colspan='2' ></td>";
				echo "</tr>";
				$i = 0;
				foreach($val as $k=>$v){
					if($i%3==0){echo "<tr class='check'>";}
					$i++;
					echo "<td class='center items_check'>";
					echo "<input id='".$key."_".$v->MD003."_check' name='items_check[".$key."_".$v->MD003."]' class='".$key."_check' value='".$v->MD003."' style='width:30px;' type='checkbox' onclick='check_items();' ";
					if(isset($usecol_array[$key."_".$v->MD003])){echo "checked='checked'";}
					echo " />";
					echo "</td>";
					
					echo "<td style='border-style:solid;border-width:0px 2px 0px 0px;'>";
					echo $v->MD003.":".$v->MD004;
					echo "<div style='float:right;'>座標:<input id='".$key."_".$v->MD003."_input' name='items_input[".$key."_".$v->MD003."]' class='".$key."_input' value='";
					if(isset($usecol_array[$key."_".$v->MD003])&&$usecol_array[$key."_".$v->MD003]->tc006!=""){echo $usecol_array[$key."_".$v->MD003]->tc006;}//插入value
					echo "' size='7' onchange='set_position_by_value(this);' /></div>";
					echo "</td>";
					if($i%3==0){echo "</tr>";}
				}
				echo "<tr><th colspan='2' style='border-style:solid;border-width:0px 2px 0px 0px;'>&nbsp;</th></tr>";
				
			}
		?>
		</table>
		<table class="form14" id="other_table" >
			<tr><th colspan="3">other　固定值區域</th><th><input type="button" value="新增一固定值" onclick="add_other_item();" /><input type="button" value="清空固定值物件" onclick="clear_other_item();" /></th></tr>
		</table>
		<table class="form14" id="func_table" >
			<tr><th colspan="3">func　參數值區域</th><th><input type="button" value="新增一參數值" onclick="add_func_item();" /><input type="button" value="清空參數值物件" onclick="clear_func_item();" /></th></tr>
		</table>
		<table class="form14">
			<tr>
				<td>智慧化對齊X軸<input id='auto_match_x_option' style="width:18px;height:18px;" type='checkbox' checked="checked" />
				對齊接近值(px)<input id='auto_match_x_value' size="2" value="10" >px</td>
				<td>智慧化對齊Y軸<input id='auto_match_y_option' style="width:18px;height:18px;" type='checkbox' checked="checked" />
				對齊接近值(px)<input id='auto_match_y_value' size="2" value="10" >px</td>
			
			</tr>
		</table>
		<style>
		.items{
			display: inline-block;
			border-width: 1px;border-style: solid;
			//position: absolute;
			float: left;
		}
		.pre_items{
			display: inline-block;
			//border-width: 1px;
			//border-style: solid;
			position: absolute;
			float: left;
		}
		</style>
		<b>請直接拖曳變更欲顯示的欄位排序</b>
		<div id="canvas" style="background-image:url('<?php echo base_url()?>assets/image/seti02/moci03.png');
			background-size: 100%;background-repeat: no-repeat;width: 850px;
			border-width: 1px;border-style: solid;"
			ondrop='set_position(event);'
			ondragover='print_position(event);'
			>
			<img src="<?php echo base_url()?>assets/image/seti02/moci03.png" style="visibility: hidden;width:100%;" />
		</div>
		<script>
			var grap_item_id = "";
			function drag_item(ev) {
				console.log("drag");
				/*origin = $(ev.target).parent()[0].id;
				tran_item = ev.target.id;
				ev.dataTransfer.setData("text", ev.target.id);*/
				grap_item_id = ev.target.id;
			}
			function set_position(ev) {
				//console.log("pageX: " + ev.pageX + ", pageY: " + ev.pageY );
				$('#'+grap_item_id).offset({top: Math.round(ev.pageY-$('#'+grap_item_id).height()/2),left:Math.round(ev.pageX-$('#'+grap_item_id).width()/2)})
				
				if($('#auto_match_x_option:checked').get(0)){
					auto_match_x();
				}
				if($('#auto_match_y_option:checked').get(0)){
					auto_match_y();
				}
				var true_x = $('#'+grap_item_id).position().left-$('#canvas').position().left;
				var true_y = $('#'+grap_item_id).position().top-$('#canvas').position().top;
				var x_border = $('#canvas').width();
				var y_border = $('#canvas').height();
				console.log("set:"+true_x+","+true_y);
				console.log("border:"+x_border+","+y_border);
				if(true_x <= x_border&&true_y <= y_border){
					$('#'+grap_item_id+"_input").val(true_x+","+true_y);
				}
				if($('.detail_check:checked').get(0)){
					console.log('auto');
					set_sub_position(grap_item_id);
				}
				grap_item_id = "";
			}
			function print_position(ev){
				target = ev.target.id;
				//console.log("pageX: " + ev.pageX + ", pageY: " + ev.pageY );
				ev.preventDefault();
				//set_position(ev);
				//auto_match_x();auto_match_y();
			}
			function auto_match_x(){
				var gap = "";var x_set_gap = $('#auto_match_x_value').val();
				$('.items:not(.sub_items)').each(function(){
					if(grap_item_id!=$(this).id){
						gap = $('#'+grap_item_id).position().left-$( this ).position().left;
						if(gap*gap<x_set_gap*x_set_gap && gap != 0){
							console.log(grap_item_id+"&"+this.id+":"+gap);
							$('#'+grap_item_id).offset({left:$( this ).position().left});
						}
					}
				});
			}
			function auto_match_y(){
				var gap = "";var y_set_gap = $('#auto_match_y_value').val();
				$('.items:not(.sub_items)').each(function(){
					if(grap_item_id!=$(this).id){
						gap = $('#'+grap_item_id).position().top-$( this ).position().top;
						if(gap*gap<y_set_gap*y_set_gap && gap != 0){
							console.log(grap_item_id+"&"+this.id+":"+gap);
							$('#'+grap_item_id).offset({top:$( this ).position().top});
						}
					}
				});
			}
			function set_position_by_value(item) {
				var temp_posi = item.value.split(',');
				var x = temp_posi[0]*1+$('#canvas').position().left;
				var y = temp_posi[1]*1+$('#canvas').position().top;
				var temp = item.id.split('_');
				var table = temp[0];var id = temp[1];
				console.log(table+"_"+id+":("+x+","+y+")");
				$("#"+table+"_"+id).offset({top:y,left:x});
			}
		</script>
		<table class="form14">
			<tr>
				<td>單別<input id='preview_ta001' size="5" value="5101" >
				單號<input id='preview_ta002' size="10" value="20150918004" >
				<input id='preview_button' type="button" value="預覽" onclick="preview();" /><span id="preview_show"></span></td>
			</tr>
		</table>
		<div id="preview" style="background-image:url('<?php echo base_url()?>assets/image/seti02/moci03.png');
			background-size: 100%;background-repeat: no-repeat;width: 850px;
			border-width: 1px;border-style: solid;"
			>
			<img src="<?php echo base_url()?>assets/image/seti02/moci03.png" style="visibility: hidden;width:100%;" />
		</div>
		<div id="hidden_value" style="display:none;" >
			<input id="canvas_width" name="canvas_width" />
			<input id="canvas_height" name="canvas_height" />
		</div>
		<div class="buttons" style="clear:both;margin:30px 0px;" >
			<a accesskey="s" tabIndex="97" onKeyPress="keyFunction()" id='save' name='save' href="javascript:check_items();$('#commentForm').submit();" class="button" ><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></a>
			<a accesskey="x" tabIndex="98" onKeyPress="keyFunction()" id='exit' name='exit' href="<?php echo site_url(substr($process,0,3).'/'.$process.'/display');?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
		</div>
			
		</div> <!-- div-6 -->
	</form>
	</div> <!-- div-5 -->
  </div> <!-- div-4 -->
	<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
		'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?>
	</div>
	<?php } ?>
</div> <!-- div-3 -->
</div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php //include("./application/views/fun/report_funjs_v.php"); ?>
<script>
$(document).ready(function(){
	check_items();reset_by_value();
	$('#canvas_width').val($('#canvas').width());
	$('#canvas_height').val($('#canvas').height());
	<?php //有選擇細項Table 載入時帶入
	if(isset($detail_table)){
		echo "$('.".$detail_table."_items').each(function(){
			show_detail_view(this);
			set_sub_position(this.id);
		});";
	} ?>
	console.log(func_col_array);
	console.log(other_col_array);
	set_other_by_value();
	set_func_by_value();
});
</script>
<script>
//細項處理區域
var use_ary = [];var nouse_ary = [];
function show_detail(this_obj){
	if($('.detail_check:checked').get(0)){
		var use_id = $('.detail_check:checked').get(0).id;
		var temp_use = use_id.split('_');
		var table_use = temp_use[0];
		$('.'+table_use+'_detail').removeAttr('disabled');
		$('.detail_check:unchecked').attr('disabled', 'disabled');
		$('.detail_check:unchecked').each(function(){
			var temp_nouse = this.id.split('_');
			$('.'+temp_nouse[0]+'_detail').attr('disabled', true);
		});
		var temp = this_obj.id.split('_');
		var table = temp[0];var id = temp[1];
		if(table_use != table){return;}
		$('.sub_items').remove();
		$('.'+table+"_items").each(function(){
			show_detail_view(this);
			set_sub_position(this.id);
		});
	}else{
		$('.detail_check:unchecked').each(function(){
			var temp_nouse = this.id.split('_');
			$('.'+temp_nouse[0]+'_detail').attr('disabled', true);
		});
		$('.detail_check:unchecked').attr('disabled', false);
		$('.sub_items').remove();
	}
}
function show_detail_view(this_obj){
	var temp = this_obj.id.split('_');
	var table = temp[0];var id = temp[1];
	var true_x = $('#'+this_obj.id).position().left-$('#canvas').position().left;
	var true_y = $('#'+this_obj.id).position().top-$('#canvas').position().top;
	var x_border = $('#canvas').width();
	var y_border = $('#canvas').height();
	console.log("set:"+true_x+","+true_y);
	console.log("border:"+x_border+","+y_border);
	var detail_gap = $('#'+table+'_detail_input').val();
	var times = $('#'+table+'_detail_count').val();
	console.log("個數:"+times);
	for(var i=1;i<=times;i++){
		var item_append_str = "<div id='"+table+"_"+id+"_sub_"+i+"' class='items sub_items "+table+"_"+id+"_sub_items'>sub_"+col_array[table][id]['MD003']+"</div>";
		$('#canvas').append(item_append_str);
	}
}
function set_sub_position(this_id){
	var temp = this_id.split('_');
	var table = temp[0];var id = temp[1];
	$('.'+table+"_"+id+"_sub_items").each(function(){
		var temp = this.id.split('_');
		var count = temp[3];
		console.log(temp);
		var true_x = $('#'+this_id).position().left;
		var true_y = $('#'+this_id).position().top+count*$('#'+table+'_detail_input').val();
		$(this).offset({top:true_y,left:true_x});
	});
}
</script>
<script>
var col_array = <?php echo json_encode($col_array); ?>;
var func_col_array = <?php echo json_encode($func_col_array); ?>;
var other_col_array = <?php echo json_encode($other_col_array); ?>;
console.log(col_array);
function check_items(){
	use_ary = [];nouse_ary = [];
	
	$('.items_check :checkbox:checked').each(function(){
		use_ary.push(this.id);
	});
	$('.items_check :checkbox:unchecked').each(function(){
		nouse_ary.push(this.id);
	});
	
	for(var key in use_ary){
		var item_append_str = "";
		var val = use_ary[key];
		var temp = val.split('_');
		var table = temp[0];var id = temp[1];
			//console.log($('#'+table+"_"+id).get(0));
		if(!$('#'+table+"_"+id).get(0)){
			item_append_str += "<div id='"+table+"_"+id+"' class='items "+table+"_items' draggable='true' ondragstart='drag_item(event)'>"+col_array[table][id]['MD003']+"</div>";
			$('#canvas').append(item_append_str);
		}
	}
	for(var key in nouse_ary){
		var val = nouse_ary[key];
		var temp = val.split('_');
		var table = temp[0];var id = temp[1];
		$('#'+table+"_"+id+"_input").val("");
		$('#'+table+"_"+id).remove();
	}
}

function reset_by_value(){
	$('.items_check :checkbox:checked').each(function(){
		var temp = this.id.split('_');
		var table = temp[0];var id = temp[1];
		var item = $('#'+table+"_"+id+"_input");
		
		var temp_posi = item.val().split(',');
		
		var x = temp_posi[0]*1+$('#canvas').position().left;
		var y = temp_posi[1]*1+$('#canvas').position().top;
		
		console.log(table+"_"+id+":("+x+","+y+")");
		$("#"+table+"_"+id).offset({top:y,left:x});
	});
}
</script>
<script>
//處理other項目區域
function set_other_by_value(){
	for(var key in other_col_array){
		var val = other_col_array[key];
		var temp = key.split('_');
		var table = temp[0];var id = temp[1];var list_order = id.substr(2,3)*1;
		var order_append = "<tr id='other_"+id+"_row' class='other_row' >";
		order_append += "<td>"+id+":other"+list_order+"</td>";
		order_append += "<td>數值:<input id='other_"+id+"_value' name='items_otherv[other_"+id+"]' size='10' value='"+val['tc007']+"' class='other_value' /></td>";
		order_append += "<td>座標:<input id='other_"+id+"_input' name='items_other[other_"+id+"]' size='7' value='"+val['tc006']+"' class='other_input' /></td>";
		order_append += "<td><input type='button' value='刪除此項' onclick='del_other_item(\"other_"+id+"\");' /></td>";
		order_append += "</tr>";
		 
		$('#other_table').append(order_append);
		
		var order_item = "<div id='other_"+id+"' class='items other_items' draggable='true' ondragstart='drag_item(event)'>"+id+"</div>"
		$('#canvas').append(order_item);
		
		var item = $('#other_'+id+"_input");
		
		var temp_posi = item.val().split(',');
		
		var x = temp_posi[0]*1+$('#canvas').position().left;
		var y = temp_posi[1]*1+$('#canvas').position().top;
		
		$("#other_"+id).offset({top:y,left:x});
	}
}
function add_other_item(){
	var itme_name = "other_";var mid_name = "OT00";
	var list_order = 1;
	var current_item = $('#'+itme_name+mid_name+list_order+"_row").get(0);
	var slice_per = 10;
	while(typeof current_item != "undefined"){
		console.log($('#'+itme_name+mid_name+list_order+"_row").get(0));
		list_order++;
		if(list_order%slice_per==0){mid_name = mid_name.slice(0,-1);slice_per = slice_per*10;};
		current_item = $('#'+itme_name+mid_name+list_order+"_row").get(0);
	}
	//console.log(list_order);
	var id = mid_name+list_order;
	var order_append = "<tr id='other_"+id+"_row' class='other_row' >";
	order_append += "<td>"+id+":other"+list_order+"</td>";
	order_append += "<td>數值:<input id='other_"+id+"_value' name='items_otherv[other_"+id+"]' size='10'class='other_value' /></td>";
	order_append += "<td>座標:<input id='other_"+id+"_input' name='items_other[other_"+id+"]' size='7' class='other_input' /></td>";
	order_append += "<td><input type='button' value='刪除此項' onclick='del_other_item(\"other_"+id+"\");' /></td>";
	order_append += "</tr>";
	$('#other_table').append(order_append);
	
	var order_item = "<div id='other_"+id+"' class='items other_items' draggable='true' ondragstart='drag_item(event)'>"+id+"</div>"
	$('#canvas').append(order_item);
}
//<div id='other_OT001' class='items other_items' draggable='true' ondragstart='drag_item(event)'>OT001</div>
function del_other_item(id){
	$('.other_items#'+id).remove();$('#'+id+"_row").remove();
}

function clear_other_item(){
	$('.other_row').remove();
	$('.other_items').remove();
}
</script>
<script>
//處理func項目區域
function set_func_by_value(){
	for(var key in func_col_array){
		var val = func_col_array[key];
		var temp = key.split('_');
		var table = temp[0];var id = temp[1];var list_order = id.substr(2,3)*1;
		
		var order_append = "<tr id='func_"+id+"_row' class='func_row' >";
		order_append += "<td>"+id+":func"+list_order+"</td>";
		order_append += "<td>參數:<input id='func_"+id+"_value' name='items_funcv[func_"+id+"]' size='10' value='"+val['tc008']+"' class='func_value' /></td>";
		order_append += "<td>座標:<input id='func_"+id+"_input' name='items_func[func_"+id+"]' size='7' value='"+val['tc006']+"' class='func_input' /></td>";
		order_append += "<td><input type='button' value='刪除此項' onclick='del_func_item(\"func_"+id+"\");' /></td>";
		order_append += "</tr>";
		$('#func_table').append(order_append);
		 
		var order_item = "<div id='func_"+id+"' class='items func_items' draggable='true' ondragstart='drag_item(event)'>"+id+"</div>"
		$('#canvas').append(order_item);
		
		var item = $('#func_'+id+"_input");
		
		var temp_posi = item.val().split(',');
		
		var x = temp_posi[0]*1+$('#canvas').position().left;
		var y = temp_posi[1]*1+$('#canvas').position().top;
		
		$("#func_"+id).offset({top:y,left:x});
	}
}
function add_func_item(){
	var itme_name = "func_";var mid_name = "FC00";
	var list_order = 1;
	var current_item = $('#'+itme_name+mid_name+list_order+"_row").get(0);
	var slice_per = 10;
	while(typeof current_item != "undefined"){
		console.log($('#'+itme_name+mid_name+list_order+"_row").get(0));
		list_order++;
		if(list_order%slice_per==0){mid_name = mid_name.slice(0,-1);slice_per = slice_per*10;};
		current_item = $('#'+itme_name+mid_name+list_order+"_row").get(0);
	}
	//console.log(list_order);
	var id = mid_name+list_order;
	var order_append = "<tr id='func_"+id+"_row' class='func_row' >";
	order_append += "<td>"+id+":func"+list_order+"</td>";
	order_append += "<td>參數:<input id='func_"+id+"_value' name='items_funcv[func_"+id+"]' size='10' class='func_value' /></td>";
	order_append += "<td>座標:<input id='func_"+id+"_input' name='items_func[func_"+id+"]' size='7' class='func_input' /></td>";
	order_append += "<td><input type='button' value='刪除此項' onclick='del_func_item(\"func_"+id+"\");' /></td>";
	order_append += "</tr>";
	$('#func_table').append(order_append);
	
	var order_item = "<div id='func_"+id+"' class='items func_items' draggable='true' ondragstart='drag_item(event)'>"+id+"</div>"
	$('#canvas').append(order_item);
}
function del_func_item(id){
	$('.func_items#'+id).remove();$('#'+id+"_row").remove();
}

function clear_func_item(){
	$('.func_row').remove();
	$('.func_items').remove();
}
</script>
<script>
//preview area
var pre_use_ary = [];
function preview(){
	preview_check_items();preview_reset_by_value();
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo base_url()?>index.php/<?php echo $process_class; ?>/<?php echo $process; ?>/preview_print_format",
		data: { ta001: $('#preview_ta001').val(), ta002: $('#preview_ta002').val(), pre_use_ary: pre_use_ary }
	}).done(function( msg ) {
		$('#preview_show').text(msg['response']);
		if($('.detail_check:checked').get(0)){
			var detail_id = $('.detail_check:checked').get(0).id;
			var detail_use = detail_id.split('_');
			var detail_table = detail_use[0];
		}
		for(var key in msg.data[0]){
			var value = msg.data[0][key];
			$('#pre_'+key).text(value);
		}
		$('.other_value').each(function(){
			var temp = this.id.split('_');
			var table = temp[0];var id = temp[1];
			$('#pre_'+table+"_"+id).text(this.value);
		});
		$('.func_value').each(function(){
			var temp = this.id.split('_');
			var table = temp[0];var id = temp[1];
			$('#pre_'+table+"_"+id).text(this.value);
		});
		//以下列印細項，超過一頁的量就先不預覽了
		/*
			key = 筆數
		*/
		for(var key in msg.data){
			if(key==0){continue;}
			var value = msg.data[key];
			for(var k in value){
				var v = value[k];
				var temp = k.split('_');
				var table = temp[0];var id = temp[1];
				if(detail_table != table){
					continue;
				}
					
				var item_append_str = "<div id='pre_"+table+"_"+id+"_sub_"+key+"' class='pre_items pre_sub_items' >"+v+"</div>";
				
				$('#preview').append(item_append_str);
				
				var base_x = $('#pre_'+table+"_"+id).position().left;
				var set_y = $('#pre_'+table+"_"+id).position().top+key*$('#'+table+'_detail_input').val();
				
				$('#pre_'+table+"_"+id+"_sub_"+key).offset({top:set_y,left:base_x});
				
				console.log(item_append_str);
			}
		}
	});
	
}

function preview_check_items(){
	$('.pre_items').remove();
	pre_use_ary = [];pre_nouse_ary = [];
	
	$('.items_check :checkbox:checked').each(function(){
		use_ary.push(this.id);
		var temp = this.id.split('_');
		var table = temp[0];var id = temp[1];
		pre_use_ary.push(table+"_"+id);
	});
	$('.other_input').each(function(){
		use_ary.push(this.id);
		var temp = this.id.split('_');
		var table = temp[0];var id = temp[1];
		pre_use_ary.push(table+"_"+id);
	});
	$('.func_input').each(function(){
		use_ary.push(this.id);
		var temp = this.id.split('_');
		var table = temp[0];var id = temp[1];
		pre_use_ary.push(table+"_"+id);
	});
	console.log(use_ary);
	$('.items_check :checkbox:unchecked').each(function(){
		nouse_ary.push(this.id);
	});
	
	for(var key in use_ary){
		var item_append_str = "";
		var val = use_ary[key];
		var temp = val.split('_');
		var table = temp[0];var id = temp[1];
			//console.log($('#'+table+"_"+id).get(0));
		if(!$('#pre_'+table+"_"+id).get(0)){
			item_append_str += "<div id='pre_"+table+"_"+id+"' class='pre_items pre_"+table+"_items' >";
			if(col_array[table]){
				item_append_str += col_array[table][id]['MD003'];
			}else{
				item_append_str += id;
			}
			
			item_append_str += "</div>";
			$('#preview').append(item_append_str);
		}
	}
	for(var key in nouse_ary){
		var val = nouse_ary[key];
		var temp = val.split('_');
		var table = temp[0];var id = temp[1];
		$('#'+table+"_"+id+"_input").val("");
		$('#pre_'+table+"_"+id).remove();
	}
}
function preview_reset_by_value(){
	$('.pre_items').each(function(){
		var temp = this.id.split('_');
		var table = temp[1];var id = temp[2];
		var item = $('#'+table+"_"+id+"_input");
		
		var temp_posi = item.val().split(',');
		
		var x = temp_posi[0]*1+$('#preview').position().left;
		var y = temp_posi[1]*1+$('#preview').position().top;
		
		console.log(table+"_"+id+":("+x+","+y+")");
		$("#pre_"+table+"_"+id).offset({top:y,left:x});
	});
}
</script>









