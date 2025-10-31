<?php
$origin_num = 0;
if(!@$result[0]->ms001){
	echo "<script>alert('無資料');history.go(-1);</script>";
}
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

<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 國定假日建立作業 - 修改  年份：<?php echo $result[0]->ms001?>年</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<table class="form14 holilist">   <!-- 表格 -->
	<?php foreach($result as $key => $val){ $origin_num++; ?>
		<tr id='holiday_line_<?php echo $origin_num;?>' class='holiday_line' >
		<td class='start14' style="width:120px;">年份：</td>
		<td class='normal14'><input tabIndex='3' id='ms001_<?php echo $origin_num;?>' type='text' class='ipt_ms001' onKeyPress='keyFunction()' type='text' name='ms001[]' value='<?php echo $result[0]->ms001?>' size='20' disabled='disabled' /></td>
		<td class='start14' style="width:120px;">國定假日名稱：</td>
		<td class='normal14' style="width:150px;"><input tabIndex='3' id='ms003_<?php echo $origin_num;?>' type='text' class='ipt_ms003' onKeyPress='keyFunction()' name='ms003[]' value='<?php echo $val->ms003?>' size='20' disabled='disabled' /></td>
		<td class='start14' style="width:120px;">日期：</td>
		<td class='normal14' style="width:150px;"><input style="display:none;" id='ms002_<?php echo $origin_num;?>' type='text' class='ipt_ms002' name='ms002[]' value='<?php echo $val->ms002?>' disabled='disabled' /><?php echo $val->ms002?></td>
		<td class='normal14' style="width:150px;"><!--<input type="button" onclick="del_holiday(<?php echo $origin_num;?>);" value="刪除" disabled='disabled' />--></td>
		<td class='normal14'></td>
		</tr>
	<?php }?> 
    </table>
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="normal14"><!--<a accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='add' name='add' href="javascript:add_holiday();" class="button" disabled='disabled' ><span>新增假日</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>--></td>
	    <td class="normal14"></td>
	    <td class="normal14"></td>
	  </tr>
    </table>
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;儲存Alt&nbsp;' disabled='disabled'><span>儲存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
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