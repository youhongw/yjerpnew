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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 會計期間設定作業 - 複製　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button  style= "cursor:pointer" form="commentForm" onfocus="$('#mg001o').focus();" type='submit'  accesskey="c" onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('act/acti07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/act/acti07/copysave" method="post" enctype="multipart/form-data" id="form">
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-複製</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $mg001o=$this->input->post('mg001o');
	  $mg001c=$this->input->post('mg001c');
	  $mg002o=$this->input->post('mg002o');
	  $mg002c=$this->input->post('mg002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="10%">原始年度：</td>           
		<td class="normal14a"  width="40%"><input tabIndex="1" id="mg001o"  onKeyPress="keyFunction()"   name="mg001o" value="<?php echo strtoupper($mg001o); ?>"  type="text" required /></td>
	    <td class="normal14y" width="10%">複製年度：</td>
	    <td class="normal14a"  width="40%"><input tabIndex="2" id="mg001c"  onKeyPress="keyFunction()"   name="mg001c" value="<?php echo strtoupper($mg001c); ?>"  type="text" required /></td>
		 
	  </tr>
	 
	  <tr>
	    <td><span class="required"></span></td>
        <td><input type="hidden" name="test3"  value=" " size="20"/></td>
	    <td>&nbsp;&nbsp;</td>
        <td></td>
	  </tr>
    </table>
		
	 <!--  <div class="buttons">
	   <button  type='submit'  accesskey="c" onKeyPress="keyFunction()" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('act/acti07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   -->
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->