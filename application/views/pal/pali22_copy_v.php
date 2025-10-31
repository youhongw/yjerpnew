<div id="container">   <!-- div-1 -->
<div id="header">      <!-- div-2 -->
  <div class="div1">
    <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
    <div class="div3">
	<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>　
    </div>
  </div>
  
<div id="content">    <!-- div-3 -->
  <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 列印別資料建立作業 - 複製</h1>
    </div>
    
    <div class="content">  <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali22/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general">   <!-- div-6 -->
	<?php
	  $mm001c=$this->input->post('mm001c');
	  $mm002c=$this->input->post('mm002c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
	    
	 <tr>
	   <td class="start14a" width="14%">原始列印別代號：</td>
       <td class="normal14a" width="86%">
	      <input type="text" tabIndex="1" id="mm001" onKeyPress="keyFunction()"  name="mm001c"  value="<?php echo $mm001c; ?>"   /></td>
	  
	 
	 <tr>
	   <td class="normal14a" >複製列印別代號：</td>
       <td class="normal14" >
	     <input type="text"  tabIndex="2" id="mm002" onKeyPress="keyFunction()"  name="mm002c"  value="<?php echo $mm002c; ?>"   minlength="1" required /></td>
	 
	 </tr>
    </table>
		
	   <div class="buttons">
	   <button   type='submit'   accesskey="c" name='submit' class="button"  value='&nbsp;複 製F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a   accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pal/pali22/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
     </form>
    </div>   <!-- div-6 -->
  </div>    <!-- div-5 -->
</div>     <!-- div-4 -->

      <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
    </div>   <!-- div-3 -->
  </div>    <!-- div-2 -->
</div>      <!-- div-1 -->