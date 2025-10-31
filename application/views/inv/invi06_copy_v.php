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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 實盤資料建立作業 - 複製</h1>
    </div>
    
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi06/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $td1001c=$this->input->post('td1001c');
	  $td1002c=$this->input->post('td1002c');
	   $td1003c=$this->input->post('td1003c');
	  $td1004c=$this->input->post('td1004c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="start14a" width="14%">原始盤點底稿代號：</td>
        <td class="normal14a" width="36%">
		 <input tabIndex="1" id="td1001" onKeyPress="keyFunction()" type="text" name="td1001c"  value="<?php echo $td1001c; ?>"   minlength="1" required /></td>
	    <td class="normal14a" width="14%">複製盤點底稿代號：</td>
        <td class="normal14a" width="36%">
	     <input tabIndex="1" id="td1002" onKeyPress="keyFunction()" type="text" name="td1002c"  value="<?php echo $td1002c; ?>"   minlength="1" required /></td>
	  </tr>
	 <tr>
	    <td class="start14a" >原始庫別代號：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="td1003" onKeyPress="keyFunction()" type="text" name="td1003c"  value="<?php echo $td1003c; ?>"   minlength="1" required /></td>
	    <td class="normal14a" >複製庫別代號：</td>
        <td class="normal14a" >
	     <input tabIndex="1" id="td1004" onKeyPress="keyFunction()" type="text" name="td1004c"  value="<?php echo $td1004c; ?>"   minlength="1" required /></td>
	  </tr>
	 
    </table>
		
	   <div class="buttons">
	   <button tabIndex="5" type='submit'  accesskey="c"  name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('inv/invi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
        </form>
    </div> <!-- div-6 --> 
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

      <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->