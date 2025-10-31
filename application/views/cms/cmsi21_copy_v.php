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
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 付款條件資料建立作業 - 複製　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button  style= "cursor:pointer" form="commentForm" onfocus="$('#na002c').focus();"  type='submit'  tabIndex="98" accesskey="c" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;
	   <a   accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi21/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
	</div>
    </div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi21/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $na001c=$this->input->post('na001c');
	  $na002c=$this->input->post('na002c');
	  $na003c=$this->input->post('na003c');
	  $na004c=$this->input->post('na004c');
	//$this->load->helper('url');	
	?>
	
	<table class="form14">    <!-- 表格開始 -->
	 <tr>
	   <td class="normal14y" width="8%">原始代號：</td>
           <td class="normal14a" width="42%">
	      <input tabIndex="1" id="na002c" onKeyPress="keyFunction()" type="text" name="na002c"  value="<?php echo $na002c; ?>"   minlength="1" required /></td>
	   <td class="normal14y" width="8%">複製代號：</td>
           <td class="normal14a" width="42%">
	      <input tabIndex="2" id="na004c" onKeyPress="keyFunction()" type="text" name="na004c"  value="<?php echo $na004c; ?>"   minlength="1" required /></td>
	 </tr>
	 
	 
	  <tr>
	    <td class="normal14z" >原始類別：</td>
        <td class="normal14a" >
		  <select tabIndex="3" id="na001c" onKeyPress="keyFunction()"  tabIndex="1" name="na001c">
            <option <?php if($na001c == '1') echo 'selected="selected"';?> value='1'>1:採購/託外</option>                                                                        
		    <option <?php if($na001c == '2') echo 'selected="selected"';?> value='2'>2:銷售</option>
		  </select>
	    </td>
	   <td class="normal14z" >複製類別：</td>
       <td class="normal14a" >
	       <select tabIndex="4" id="na003c" onKeyPress="keyFunction()"  tabIndex="1" name="na003c">
              <option <?php if($na003c == '1') echo 'selected="selected"';?> value='1'>1:採購/託外</option>                                                                        
		      <option <?php if($na003c == '2') echo 'selected="selected"';?> value='2'>2:銷售</option>
	       </select>
	   </td>
	  </tr>
    </table>
		
	  <!-- <div class="buttons">
	   <button   type='submit'  tabIndex="98" accesskey="c" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a   accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi21/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
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