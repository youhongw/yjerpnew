<div id="container"> <!-- div-1 -->
<div id="header"> <!-- div-2 -->
  <div class="div1">
   <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
    <div class="div3">
	<img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	<img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	<img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>　
    </div> -->
	<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
  </div>
  
<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶商品計價建立作業 - 複製　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	   <button style= "cursor:pointer" form="commentForm" onfocus="$('#mb002').focus();" tabIndex="5" type='submit' accesskey="c"  name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('cop/copi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi02/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $mb002o=$this->input->post('mb002o');
	  $mb002c=$this->input->post('mb002c');
	  $mb001o=$this->input->post('mb001o');
	  $mb001c=$this->input->post('mb001c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="normal14y" width="12%">原始品號代號：</td>
        <td class="normal14a" width="38%">
		 <input tabIndex="1" id="mb002" onKeyPress="keyFunction()" type="text" onchange="copya(this);" name="mb002o"  value="<?php echo $mb002o; ?>"   minlength="1" required /></td>
	    <td class="normal14y" width="12%">複製品號代號：</td>
        <td class="normal14a" width="38%">
	     <input tabIndex="1" id="mb002" onKeyPress="keyFunction()" type="text" name="mb002c"  value="<?php echo $mb002c; ?>"   minlength="1" required /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >原始客戶代號：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="mb001" onKeyPress="keyFunction()" type="text" onchange="copyb(this);" name="mb001o"  value="<?php echo $mb001o; ?>"   minlength="1" required /></td>
	    <td class="normal14z" >複製客戶代號：</td>
        <td class="normal14a" >
	     <input tabIndex="1" id="mb001" onKeyPress="keyFunction()" type="text" name="mb001c"  value="<?php echo $mb001c; ?>"   minlength="1" required /></td>
	  </tr>
	 
    </table>
		
	<!--   <div class="buttons">
	   <button tabIndex="5" type='submit' accesskey="c"  name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('cop/copi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
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
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
<script type="text/javascript" >
   function copya(oInput) {
	   form.mb002c.value=oInput.value;
   }
   function copyb(oInput) {
	   form.mb001c.value=oInput.value;
   }
</script>