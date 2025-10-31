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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工加保建立作業 - 請購單</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali27/printc"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-請購單</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $ti001o=$this->input->post('ti001o');
	  $ti002o=$this->input->post('ti002o');
	  $ti001o='3131';
	  $ti002o='20140905001';
	?>
	<table class="form12">   <!-- 表格 -->
      <tr>
	    <td class="start12" width="20%">&nbsp;&nbsp;請購單別：</td>
	    <td class="normal12" width="30%"><input tabIndex="1" id="ti001o" onKeyPress="keyFunction()" type="text" name="ti001o"  value="<?php echo $ti001o; ?>"  size="20" /></td>
        <td class="start12" width="20%">&nbsp;&nbsp;請購單號：</td>
	    <td class="normal12" width="30%"><input tabIndex="2" id="ti002o" onKeyPress="keyFunction()" type="text" name="ti002o"  value="<?php echo $ti002o; ?>"  size="20" /></td>
	  </tr>	
		
	  <tr>
	    <td><span class="required"></span></td>
        <td><input type="hidden" name="test3"  value=" " size="20"/></td>
	    <td>&nbsp;&nbsp;</td>
        <td></td>
	  </tr>
    </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pal/pali27/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->