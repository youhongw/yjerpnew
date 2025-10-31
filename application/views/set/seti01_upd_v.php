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
	<form class="cmxform" id="commentForm" name="form" action="<?php echo base_url()?>index.php/<?php echo $process_class; ?>/<?php echo $process; ?>/save_detail_view" method="post" enctype="multipart/form-data" > 
		<div id="tab-general"> <!-- div-6 -->
		<?php
			$col_count = count($col_array);
			$usecol_count = count($usecol_array);
			/*echo "<pre>";
			var_dump($col_array);
			var_dump($col_count);
			var_dump($usecol_array);
			var_dump($usecol_count);
			echo "</pre>";*/
		?>
		<table class="form14">
		  <tr><b>請選擇欲顯示的欄位</b></tr>
		<?php 
			$i = 0;
			foreach($col_array as $key=>$val){
				if($i%8==0){echo "<tr class='check'>";}
				$i++;
				echo "<td class='center order_check'>";
				echo "<input name='order_check[]' value='".$key."' style='width:30px;' type='checkbox' onclick='change_order_list();' ";
				if(isset($usecol_array[$key])){echo "checked='checked'";}
				if(isset($val['col_require'])){echo "checked='checked' disabled=disabled";}
				echo " />";
				echo $val['name'];
				echo "</td>";
				if($i%8==0){echo "</tr>";}
			}
		?>
		</table>
		
		<b>請直接拖曳變更欲顯示的欄位排序</b>
		<table style="width:100%;height:29px;" id="order_product" class="list1">
			<thead>
			  <tr id="number">
				<?php 
				for($i=1;$i<=$usecol_count;$i++){
					echo "<td class='center order_num'>".$i."</td>";
				}
				?>
			  </tr>
			  <tr id="orders">
				<?php 
				$i = 0;
				foreach($usecol_array as $key=>$val){
					$i++;
					echo "<td class='center order_con' id='order_".$i."' ondrop='drop(event)' ondragover='allowDrop(event)'>";
					echo "<div id='".$key."' class='item' draggable='true' ondragstart='drag(event)'>".$val['name']."</div>";
					echo "</td>";
				}
				?>
			  </tr>
			</thead>
		</table>
		
		<div id="preview">
			
		</div>
		
		<div class="buttons">
			<a accesskey="s" tabIndex="97" onKeyPress="keyFunction()" id='save' name='save' href="javascript:save_detail_view();" class="button" ><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></a>
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
function save_detail_view(){
	var ret_str = "";
	$('.order_con .item').each(function() {
		ret_str += this.id+",";
	});
	console.log(ret_str.slice(0,-1));
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "<?php echo site_url(substr($process,0,3).'/'.$process.'/save_detail_view');?>",
		data: { 
			order: ret_str.slice(0,-1)
		}
	}).done(function( msg ) {
		if(msg){
			alert('儲存成功!'+msg);window.location.reload();
		}else{
			alert('儲存失敗!'+msg);
		}
	});
}
</script>
<script>
var origin = "";
var tran_item = "";
var target = "";
var order_list = [];
var item_count = 0;
function allowDrop(ev) {
	target = ev.target.id;
    ev.preventDefault();
}

function drag(ev) {
	console.log("drag");
	origin = $(ev.target).parent()[0].id;
	tran_item = ev.target.id;
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
	if(ev.target.id.substr(0,5) != "order"){
		$(ev.target).parent()[0].appendChild(document.getElementById(data));
		target = $(ev.target).parent()[0].id;
	}else{
		ev.target.appendChild(document.getElementById(data));
		target = ev.target.id;
	}
	console.log("drop");
	
	check_order_list();
}
</script>
<script>
function check_order_list(){
	item_count = 0
	var duplicate = null;
	var empty = null;
	var temp = null;
	$('.order_con').each(function(key){
		item_count++;
		if($(this).children().size()==0){
			
		}else if($(this).children().size()>1){
			duplicate = $(this).children()[0];
			$(this).children()[0].remove();
		}
	});
	
	$('.order_con').each(function(key){
		if($(this).children().size()==0){
			empty = this;
		}
	});
	
	var origin_slot = (origin.replace(/order_/g, ""))*1;
	var target_slot = (target.replace(/order_/g, ""))*1;
	
	if(target_slot>origin_slot){
		for(var i=target_slot-1;i>=origin_slot;i--){
			if(duplicate){
				$('#order_'+i)[0].appendChild(duplicate);
				duplicate = null;
				if($('#order_'+i).children().size()>1){
					temp = $('#order_'+i).children()[0];
					$('#order_'+i).children()[0].remove();
				}
			}else if(temp){
				$('#order_'+i)[0].appendChild(temp);
				if(i!=origin_slot){
					temp = $('#order_'+i).children()[0];
					$('#order_'+i).children()[0].remove();
				}
			}
		}
	}else if(origin_slot>target_slot){
		for(var i=target_slot*1+1;i<=origin_slot;i++){
			if(duplicate){
				$('#order_'+i)[0].appendChild(duplicate);
				duplicate = null;
				if($('#order_'+i).children().size()>1){
					temp = $('#order_'+i).children()[0];
					$('#order_'+i).children()[0].remove();
				}
			}else if(temp){
				$('#order_'+i)[0].appendChild(temp);
				if(i!=origin_slot){
					temp = $('#order_'+i).children()[0];
					$('#order_'+i).children()[0].remove();
				}
			}
		}
	}
		
} 
</script>
<script>
var col_array = <?php echo json_encode($col_array); ?>;
function change_order_list(){
	
	var use_ary = [];
	$('input[name="order_check[]"]:checked').each(function() {
		use_ary.push(this.value);
	});
	
	var count_use_ary = use_ary.length;
	var num_append_str = "";
	
	for(var i=1;i<=count_use_ary;i++){
		num_append_str += "<td class='center order_num'>"+i+"</td>";
	}
	$('.order_num').remove();
	$('#number').append(num_append_str);
	
	var order_append_str = "";
	for(var key in use_ary){
		order_append_str += "<td class='center order_con' id='order_"+(key*1+1)+"' ondrop='drop(event)' ondragover='allowDrop(event)'>";
		order_append_str += "<div id='"+use_ary[key]+"' class='item' draggable='true' ondragstart='drag(event)'>"+col_array[use_ary[key]]['name']+"</div>";
		order_append_str += "</td>";	
	}
	$('.order_con').remove();
	$('#orders').append(order_append_str);
	
}
</script>



























