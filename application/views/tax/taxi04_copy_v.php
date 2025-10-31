<div id="container"> <!-- div-1 -->
<div id="header"> <!-- div-2 -->
  <div class="div1">
   <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
    <div class="div3">
	<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>　
    </div>-->
	<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
  </div>
  
<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 營業稅申報資料 - 複製　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#me001o').focus();" tabIndex="5" type='submit'  name='submit' accesskey="c" class="button"  value='複 製 Alt+c'><span>複 製 Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/tax/taxi04/copysave" method="post" enctype="multipart/form-data" id="form">
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $me001o=$this->input->post('me001o');
	  $me001c=$this->input->post('me001c');
	   $me002o=$this->input->post('me002o');
	  $me002c=$this->input->post('me002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="8%">原始申報公司：</td>           
		<td class="normal14a"  width="42%"><input tabIndex="1" id="me001o"  onKeyPress="keyFunction()"   name="me001o" value="<?php echo strtoupper($me001o); ?>" size="20" type="text" required />
		  <span id="me001dispo" ></span></td>
	    <td class="normal14y" width="8%">複製申報公司：</td>
	    <td class="normal14a"  width="42%"><input tabIndex="2" id="me001c"  onKeyPress="keyFunction()"   name="me001c" value="<?php echo strtoupper($me001c); ?>" size="20" type="text" required />
		  <span id="me001dispc" ></span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >原始起始年月：</td>           
		<td class="normal14a"  ><input tabIndex="1" id="me002o"  onKeyPress="keyFunction()"   name="me002o" value="<?php echo $me002o; ?>" size="20" type="text" required />
		  <span id="me001dispo" ></span></td>
	    <td class="normal14z" >複製起始年月：</td>
	    <td class="normal14a"  ><input tabIndex="2" id="me002c"  onKeyPress="keyFunction()"   name="me002c" value="<?php echo $me002c; ?>" size="20" type="text" required />
		  <span id="me001dispc" ></span></td>
	  </tr>
    </table>
		
	 <!--  <div class="buttons">
	   <button tabIndex="5" type='submit'  name='submit' accesskey="c" class="button"  value='複 製 Alt+c'><span>複 製 Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   -->
        </form>
		 <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp;&nbsp;'.'</span>'.
'◎操作說明:[ 按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

      </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->