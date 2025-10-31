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
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 固定津貼建立作業 - 基本薪資調整</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $md001o=$this->input->post('md001o');
	  $md001c=$this->input->post('md001c');
	  $md002o=$this->input->post('md002o');
	  $md002c=$this->input->post('md002c');
	  $tl009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
       <tr>
	    <td class="start14a" width="11%">原始基本薪資：</td>
        <td class="normal14a" width="39%">
		 <input tabIndex="1" id="old_base_salary" onKeyPress="keyFunction()" type="text" name="old_base_salary"  value="<?php echo $md001o; ?>" onchange="initialize();" minlength="5" required /></td>
	    <td class="normal14a" width="11%">新制基本薪資：</td>
        <td class="normal14a" width="39%">
	     <input tabIndex="2" id="new_base_salary" onKeyPress="keyFunction()" type="text" name="new_base_salary"  value="<?php echo $md001c; ?>" onchange="initialize();" minlength="5" required /></td>
	   </tr>
    </table>
    <table id='edit_ret' class="form14">
	<th colspan="3" style="text-align:left;" ><font color = "red">預計修改員工:<span id="rows_count" ></span></font></th>
    </table>
    <table id='non_edit_ret' class="form14">
	<th colspan="3" style="text-align:left;" ><font color = "red">合計薪資低於新制基本薪資員工:(需手動修改)<span id="lower_rows_count" ></span></font></th>
    </table>
	    <div class="buttons">
		  <button tabIndex="4" accesskey="c" class="button" target="_new" onclick="check_update_ajax();" value='檢 查Alt+c'><span>檢 查Alt+c</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <button tabIndex="5" accesskey="s" class="button" target="_new" onclick="confirm_update();" value='更 新Alt+s'><span>更 新Alt+s</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('pal/pali23/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<script>
$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
	//options.async = true;
});
var batching = 0;
var global_edit_data = null;
var global_lower_data = null;
function initialize(){//初始化
	$('.edit_tr').remove();		//初始化列表
	$('.lower_tr').remove();
	$('#rows_count').text("總計:0人");
	$('#lower_rows_count').text("總計:0人");
	global_edit_data=null;
	global_lower_data=null;
}
</script>
<script language="javascript">
function check_update_ajax(){
	var old_salary = $('#old_base_salary').val();
	var new_salary = $('#new_base_salary').val();
	$.ajax({
		method: "POST",
		dataType:"json",
		url: "<?php echo base_url()?>index.php/pal/pali23/check_update_ajax",
		data: {
		  old_salary : old_salary,
		  new_salary : new_salary
		}
	})
	.done(function( msg ) { //送出成功後會觸發的事件
		if(typeof(msg) === "object"){
			console.log(msg);//將結果送到console顯示
			show_ready_edit(msg);
		}else{
			console.log(msg);
		}
	});
}
function confirm_update(){
	if(!global_edit_data || !global_lower_data){
		alert("請先進行檢查後再執行自動更新。")
		return;
	}
	if(confirm("確定以這樣的資料進行自動更新?(自動更新的員工與手動修改的員工都將在備註欄位新增說明)")){
		auto_update_ajax();
	}
	else{
	}
}
function auto_update_ajax(){
	var old_salary = $('#old_base_salary').val();
	var new_salary = $('#new_base_salary').val();
	if(batching==0){
		batching = 1;
		block();
		$.ajax({
			method: "POST",
			dataType:"json",
			url: "<?php echo base_url()?>index.php/pal/pali23/auto_update_ajax",
			data: {
			  old_salary : old_salary,
			  new_salary : new_salary
			}
		})
		.done(function( msg ) {
			batching = 0;
			alert("更新完成");
			unblock();
			if(typeof(msg) === "object"){
				console.log(msg);
				alert("自動更新:"+msg.edit_affected+"位，需手動更新:"+msg.non_edit_affected+"位");
			}else{
				console.log(msg);
			}
		});
	}else{
		alert("更新中，請稍候。");
	}
}
function block(msg){
	if(!msg){msg = "資料更新中，請稍後......";}
	$.blockUI({ 
		message: msg,
		css: {
			border: 'none',
			padding: '15px',
			backgroundColor: '#000',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		} 
	});
}
function unblock(){
	$.unblockUI();
}

function show_ready_edit(data){
	initialize();
	var edit_data = data.rows;//預計修改員工
	var edit_data_count = data.rows_count;
	global_edit_data = edit_data;
	$('#rows_count').text("總計:"+edit_data_count+"人");
	
	var lower_data = data.lower_rows;//預計手動修改員工
	var lower_data_count = data.lower_rows_count;
	global_lower_data = lower_data;
	$('#lower_rows_count').text("總計:"+lower_data_count+"人");
	
	for(var key in edit_data){
		$('#edit_ret').append("<tr class='edit_tr' ><td>"+edit_data[key].md001+" "+edit_data[key].mv002+":</td>"+
		"<td>本薪:"+edit_data[key].md004+"</td>"+
		"<td>合計薪:"+edit_data[key].md013+"</td>"+
		"</tr>");
	}
	for(var key in lower_data){
		$('#non_edit_ret').append("<tr class='lower_tr' ><td>"+lower_data[key].md001+" "+lower_data[key].mv002+":</td>"+
		"<td>本薪:"+lower_data[key].md004+"</td>"+
		"<td>合計薪:"+lower_data[key].md013+"</td>"+
		"</tr>");
	}
}
</script>