<div id="container"> <!-- div-1 -->
<div id="header"> <!-- div-2 -->
  <div class="div1">
    <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
    <div class="div3">
	<img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	<img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	<img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>　
    </div>
  </div>
  
<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 付款單資料建立作業</h1>
    </div>
    
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/acp/acpi03/copysave" method="post" enctype="multipart/form-data" id="form">
	<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $tc001o=$this->input->post('tc001o');
	  $tc001c=$this->input->post('tc001c');
	  $tc002o=$this->input->post('tc002o');
	  $tc002c=$this->input->post('tc002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14a" width="20%">&nbsp;&nbsp;原始付款單別：</td>           
		<td class="normal14a"  width="30%"><input tabIndex="1" id="tc001o"  onKeyPress="keyFunction()"   name="tc001o" value="<?php echo strtoupper($tc001o); ?>" size="20" type="text" required />
		 <span id="tc001dispo" ></span></td>
	    <td class="normal14a" width="20%">&nbsp;&nbsp;複製付款單別：</td>
	    <td class="normal14a"  width="30%"><input tabIndex="2" id="tc001c"  onKeyPress="keyFunction()"   name="tc001c" value="<?php echo strtoupper($tc001c); ?>" size="20" type="text" required />
		 <span id="tc001dispc" ></span></td>
	  </tr>
	  <tr>
	    <td class="normal14a" >&nbsp;&nbsp;原始付款單號：</td>           
		<td class="normal14a"  ><input tabIndex="3" id="tc002o"  onKeyPress="keyFunction()"   name="tc002o" value="<?php echo strtoupper($tc002o); ?>" size="20" type="text" required />
		 <span id="tc002dispo" ></span></td>
	    <td class="normal14a" >&nbsp;&nbsp;複製付款單號：</td>
	    <td class="normal14a"  ><input tabIndex="4" id="tc002c"  onKeyPress="keyFunction()"   name="tc002c" value="<?php echo strtoupper($tc002c); ?>" size="20" type="text" required />
		 <span id="tc002dispc" ></span></td>
	  </tr>
	  <tr>
	    <td ><span class="required"></span> </td>
        <td ><input type="hidden" name="test1"  value=" "  size="06" /></td>
	    <td>&nbsp;&nbsp;</td>
        <td><input type="hidden" name="test2"   value=" "  size="12" /></td>
	  </tr>
	  <tr>
	    <td><span class="required"></span></td>
        <td><input type="hidden" name="test3"  value=" " size="20"/></td>
	    <td>&nbsp;&nbsp;</td>
        <td></td>
	  </tr>
    </table>
		
	   <div class="buttons">
	   <button  type='submit'  accesskey="s" onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>&nbsp;複 製 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('acp/acpi03/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a></div>
	   
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

      <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->