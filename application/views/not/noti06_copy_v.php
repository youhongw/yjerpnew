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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 票據單據性質建立作業 - 複製　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#mq001c').focus();" tabIndex="5" type='submit' accesskey="c" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>&nbsp;複 製Alt+c&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('not/noti06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti06/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $mq001c=$this->input->post('mq001c');
	  $mq002c=$this->input->post('mq002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="11%">原始單別代號：</td>
        <td class="normal14a" width="39%">
		 <input tabIndex="1" id="mq001" onKeyPress="keyFunction()" type="text" name="mq001c"  value="<?php echo $mq001c; ?>"   minlength="1" required /></td>
	    <td class="normal14y" width="11%">複製單別代號：</td>
        <td class="normal14a" width="39%">
	     <input tabIndex="1" id="mq002" onKeyPress="keyFunction()" type="text" name="mq002c"  value="<?php echo $mq002c; ?>"   minlength="1" required /></td>
	  </tr>
	 
	
    </table>
		
	  <!-- <div class="buttons">
	   <button tabIndex="5" type='submit'  name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>&nbsp;複 製 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('not/noti06/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   --> 
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
    
    </div> <!-- div-6 --> 
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

      </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->