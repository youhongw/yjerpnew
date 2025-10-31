<div id="container">  <!-- div-1 -->
  <div id="header">   <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
      <div class="div3">
	  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	  </div>-->
	  <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
  <?php
     $md001c=$this->input->post('md001c');
     $md002c=$this->input->post('md002c');
     $md003c=$this->input->post('md003c');
     $md004c=$this->input->post('md004c');
   //$this->load->helper('url');	
  ?>
 <div class="box">  <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 借貸摘要來源備註建立 - 轉Excel　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#md001c').focus();" type='submit'  accesskey="l" name='submit'  class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x"  onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi31/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
    </div>
    <div class="content">  <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsi31/write"  method="post"  enctype="multipart/form-data" > 
	<div id="tab-general">  <!-- div-6 -->
	<?php
	  $md001c=$this->input->post('md001c');
	  $md002c=$this->input->post('md002c');
	?>
	<table class="form14">
       
       <tr>
	   <td class="normal14y" width="14%">起始摘要來源代號：</td>
       <td class="normal14a" width="86%">
	      <input tabIndex="1" id="md001" onKeyPress="keyFunction()" type="text" name="md001c"  value="<?php echo $md001c; ?>"  /></td>
	  
	 </tr>
	 
	 <tr>
	   <td class="normal14z" >結束摘要來源代號：</td>
       <td class="normal14" >
	     <input tabIndex="2" id="md002" onKeyPress="keyFunction()" type="text" name="md002c"  value="<?php echo $md002c; ?>"   minlength="1" required /></td>
	  
	 </tr>
		 
    </table>
		
	  <!--  <div class="buttons">
	      <button type='submit'  accesskey="l" name='submit'  class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x"  onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi31/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
		
    </form>
	<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div>  <!-- div-6 -->
  </div>    <!-- div-5 -->
</div>      <!-- div-4 -->

     </div>  <!-- div-3 -->
  </div>    <!-- div-2 -->
</div>     <!-- div-1 -->
