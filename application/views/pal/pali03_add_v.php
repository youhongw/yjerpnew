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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 國定假日建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali03/addsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">
	<table class="form14 holilist">   <!-- 表格 -->
	  <tr>
	    <td class="start14" style="width:100px;">年份：</td>
		<td class='normal14'><input size="10" id="ms001" name="ms001" value="<?php echo date("Y");?>" /></td>
	  </tr>
    </table>
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14"><a accesskey="a" tabIndex="97" onKeyPress="keyFunction()"  id='add' name='add' href="javascript:add_holiday();" class="button" ><span>新增假日Alt+a</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a></td>
	    <td class="normal14"></td>
	    <td class="normal14"></td>
	  </tr>
    </table>
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>儲存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pal/pali03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
</div> <!-- div-3 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-2 -->
  </div> <!-- div-1 -->
</div> <!-- div-0 -->
 <?php //include("./application/views/fun/pali03_funjs_v.php"); ?>
 
<script>
$(document).ready(function(){
});

var current_line = 1;
function add_holiday(){
	if(!$('#ms001').val() || $('#ms001').val().length<4){
		alert("請填入西元年份");
		$('#ms001').select();
		return;
	}
	var line = 
	"<tr id='holiday_line_"+current_line+"' class='holiday_line' >"+
	"<td class='start14'>年份：</td>"+
	"<td class='normal14'><input tabIndex='3' id='ms001_"+current_line+"' type='text' class='ipt_ms001' onKeyPress='keyFunction()' type='text' name='ms001[]' value='"+$('#ms001').val()+"' size='20' readonly='readonly' /></td>"+
	"<td class='start14'>國定假日名稱：</td>"+
	"<td class='normal14'><input tabIndex='3' id='ms003_"+current_line+"' type='text' class='ipt_ms003' onKeyPress='keyFunction()' type='text' name='ms003[]' value='' size='20' /></td>"+
	"<td class='start14'>日期：</td>"+
	"<td class='normal14'><input tabIndex='3' id='ms002_"+current_line+"' type='text' class='ipt_ms002' onKeyPress='keyFunction()' type='text' name='ms002[]' value='' size='20' /></td>"+
	"<td class='normal14' style='width:150px;'><input type='button' onclick='del_holiday("+current_line+");' value='刪除'/></td>"+
	"</tr>";
	$('.form14.holilist').append(line);
	$('#ms001_'+current_line).focus();
	current_line ++;
}
function del_holiday(no){
	if(confirm('確定是否刪除?')){
		$('#holiday_line_'+no).remove();
	}
}

</script>