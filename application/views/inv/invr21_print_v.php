<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品項列印 - 列印　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#barcode_1').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/102'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invr21/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($barcode)) { $barcode=''; } else {  $barcode=$this->input->post('barcode'); }
	  if(!isset($invq03a22disp)) { $invq03a22disp=''; } else {  $invq03a22disp=$this->input->post('invq03a22disp'); }
	  if(!isset($count)) { $count=''; } else {  $count=$this->input->post('count'); }
	  $tc009p='1';
	?>
       
	<table class="form14 barlist">   <!-- 表格 -->
	  <tr id="barcode_line_1" class="barcode_line" >
	    <td class="normal14y">條碼號碼：</td>
	    <td class="normal14"><input tabIndex="3" id="barcode_1" type='number' class="ipt_barcode" onKeyPress="keyFunction()" type="text" name="barcode[]"  value=""  size="20" maxlength="12" /></td>
		<tr>
		</tr>
		<td class="normal14z">起始張數：</td>
	    <td class="normal14"><input tabIndex="3" id="start_1" type='number' class="ipt_str" onKeyPress="keyFunction()" type="text" name="start[]"  value="1"  size="20" onchange="check_count();" maxlength="12" /></td>
		<tr>
		</tr>
		<td class="normal14z">結束張數：</td>
	    <td class="normal14"><input tabIndex="3" id="end_1" type='number' class="ipt_end" onKeyPress="keyFunction()" type="text" name="end[]"  value="1"  size="20" onchange="check_count();" maxlength="12" /></td>
		<tr>
		</tr>
		<td class="normal14z">張數：</td>
	    <td class="normal14"><span tabIndex="3" id="totle_1" type='number' class="ipt_totle" onKeyPress="keyFunction()" type="text" name="totle[]"  value="1"  size="20" maxlength="12" ></span></td>
	  </tr>
    </table>
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14" style="width:150px;">選擇列印條碼長度：</td>
	    <td class="normal14"><select id="tc009p" onKeyPress="keyFunction()" name="tc009p"  tabIndex="5">
            <option <?php if($tc009p == '1') echo 'selected="selected"';?> value='1'>1. 9碼(一般使用Code-128)</option>
		    <option <?php if($tc009p == '2') echo 'selected="selected"';?> value='2'>2. 13碼(國際標準EAN-13)最後一碼為檢查碼，故只需輸入12碼</option>
		  </select>　　最多75張</td>
	    <td class="normal14"><a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='add' name='add' href="javascript:add_barcode();" class="button" ><span>新增條碼</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a></td>
	  </tr>
    </table>
	  <!--  <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/102'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
		
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include_once("./application/views/fun/report_funjs_v.php"); ?>
<script>
var current_line = 1;
function add_barcode(){
	current_line ++;
	var line = 
	"<tr id='barcode_line_"+current_line+"' class='barcode_line' >"+
	"<td class='start14'>條碼號碼：</td>"+
	"<td class='normal14'><input tabIndex='3' id='barcode_"+current_line+"' type='number' class='ipt_barcode' onKeyPress='keyFunction()' type='text' name='barcode[]' value='' size='20' /></td>"+
	"<td class='start14'>起始張數：</td>"+
	"<td class='normal14'><input tabIndex='3' id='start_"+current_line+"' type='number' class='ipt_str' onKeyPress='keyFunction()' type='text' name='start[]' value='' size='20' onchange='check_count();' /></td>"+
	"<td class='start14'>結束張數：</td>"+
	"<td class='normal14'><input tabIndex='3' id='end_"+current_line+"' type='number' class='ipt_end' onKeyPress='keyFunction()' type='text' name='end[]' value='' size='20' onchange='check_count();' /></td>"+
	"<td class='start14'>張數：</td>"+
	"<td class='normal14'><span tabIndex='3' id='totle_"+current_line+"' type='number' class='ipt_totle' onKeyPress='keyFunction()' type='text' name='totle[]' value='' size='20' ></span></td>"+
	"</tr>";
	
	$('.form14.barlist').append(line);check_count();
}

function check_count(){
	var current_max = 1;
	var current_min = 1;
	
	if(!$('#start_1').val() || $('#start_1').val() == 0) {
		$('#start_1').val(1);
	}
	if(!$('#end_1').val() || $('#end_1').val() == 0) {
		$('#end_1').val(1);
	}
	for(var i=1;i<=current_line;i++){
		if($('#start_'+i).val()*1 < $('#end_'+(i-1)).val()*1){
			$('#start_'+i).val(($('#end_'+(i-1)).val()*1)+1);
		}
		if($('#end_'+i).val()*1 < $('#start_'+i).val()*1){
			$('#end_'+i).val($('#start_'+i).val()*1);
		}
			
		if(($('#end_'+i).val()*1) > current_max) {
			current_max = $('#end_'+i).val();
		}
		console.log("str:"+$('#start_'+i).val()+"end:"+$('#end_'+i).val());
	}
}

$('.ipt_str').change(function(){
	check_count();
});
$('.ipt_end').change(function(){
	check_count();	
});
</script>










