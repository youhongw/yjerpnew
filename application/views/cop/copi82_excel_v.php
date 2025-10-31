<div id="container">
  <div id="header">
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	</div>-->
	<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">
  <?php
     $mm001c=$this->input->post('mm001c');
     $mm002c=$this->input->post('mm002c');
   
   //$this->load->helper('url');	
  ?>
 <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 業務訪問建立作業 - 轉Excel　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mm001c').focus();" tabIndex="5" type='submit'  accesskey="l"  name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp; 
	      <a  accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
    </div>
    <div class="content">
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi82/write"  method="post"  enctype="multipart/form-data" > 
	<!-- <div id="htabs" class="htabs14"><span>轉Excel-明細檔xls</span></div> -->
	<div id="tab-general">
	<?php
	  $mm001c=$this->input->post('mm001c');
	  $mm002c=$this->input->post('mm002c');
	    $mm003c=$this->input->post('mm003c');
	  $mm004c=$this->input->post('mm004c');
	  $mm005c=$this->input->post('mm005c');
	  $mm006c=$this->input->post('mm006c');
	 
	//$this->load->helper('url');	
	?>
	<table class="form14">
      <tr>
	    <td class="normal14y" width="11%">起始訪問日期：</td>
        <td class="normal14a" width="39%">
		 <input tabIndex="1" id="mm001c" onKeyPress="keyFunction()" type="text" name="mm001c"  value="<?php echo $mm001c; ?>"   minlength="1" required /></td>
	    <td class="normal14y" width="11%">結束訪問日期：</td>
        <td class="normal14a" width="39%">
	     <input tabIndex="1" id="mm002c" onKeyPress="keyFunction()" type="text" name="mm002c"  value="<?php echo $mm002c; ?>"   minlength="1" required /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始業務代號：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="mm003c" onKeyPress="keyFunction()" type="text" name="mm003c"  value="<?php echo $mm003c; ?>"   minlength="1" required /></td>
	    <td class="normal14z" >結束業務代號：</td>
        <td class="normal14a">
	     <input tabIndex="1" id="mm004c" onKeyPress="keyFunction()" type="text" name="mm004c"  value="<?php echo $mm004c; ?>"   minlength="1" required /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >起始級別區分：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="mm005" onKeyPress="keyFunction()" type="text" name="mm005c"  value="<?php echo $mm005c; ?>"   minlength="1" required /></td>
	    <td class="normal14z" >結束級別區分：</td>
        <td class="normal14a">
	     <input tabIndex="1" id="mm006" onKeyPress="keyFunction()" type="text" name="mm006c"  value="<?php echo $mm006c; ?>"   minlength="1" required /></td>
	  </tr>
	
		 
        </table>
		
	  <!--  <div class="buttons">
	      <button tabIndex="5" type='submit'  accesskey="l"  name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
		
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> 
  </div>
</div>
     </div>
  </div>
</div>
