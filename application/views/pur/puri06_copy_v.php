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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業 - 複製</h1>
    </div>
    
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi01/copysave" method="post" enctype="multipart/form-data" id="form">
	<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $ma001c=$this->input->post('ma001c');
	  $ma002c=$this->input->post('ma002c');
	  $ma003c=$this->input->post('ma003c');
	  $ma004c=$this->input->post('ma004c');
	//$this->load->helper('url');	
	?>
	
	<table class="form14">    <!-- 表格開始 -->
	 <tr>
	   <td class="start14" width="20%">原始品號類別代號：</td>
           <td class="normal14" width="30%">
	      <input tabIndex="1" id="ma002" onKeyPress="keyFunction()" type="text" name="ma002c"  value="<?php echo $ma002c; ?>"  size="06" minlength="1" required /></td>
	   <td class="normal14" width="20%">複製品號類別代號：</td>
           <td class="normal14" width="30%">
	      <input tabIndex="2" id="ma004" onKeyPress="keyFunction()" type="text" name="ma004c"  value="<?php echo $ma004c; ?>"  size="06" minlength="1" required /></td>
	 </tr>
	  
	 
	  <tr>
	    <td class="start14a" width="20%">原始分類方式：</td>
        <td class="normal14a" width="30%">
		  <select tabIndex="3" id="ma001" onKeyPress="keyFunction()"  tabIndex="1" name="ma001c">
            <option <?php if($ma001c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
		    <option <?php if($ma001c == '2') echo 'selected="selected"';?> value='2'>商品</option>
            <option <?php if($ma001c == '3') echo 'selected="selected"';?> value='3'>類別</option>
            <option <?php if($ma001c == '4') echo 'selected="selected"';?> value='4'>生管</option>
		  </select>
	    </td>
	   <td class="normal14a" width="20%">複製分類方式：</td>
       <td class="normal14a" width="30%">
	       <select tabIndex="4" id="ma003" onKeyPress="keyFunction()"  tabIndex="1" name="ma003c">
              <option <?php if($ma003c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
		      <option <?php if($ma003c == '2') echo 'selected="selected"';?> value='2'>商品</option>
              <option <?php if($ma003c == '3') echo 'selected="selected"';?> value='3'>類別</option>
              <option <?php if($ma003c == '4') echo 'selected="selected"';?> value='4'>生管</option>
	       </select>
	   </td>
	  </tr>
	 
	 
    </table>
		
	   <div class="buttons">
	   <button   type='submit'  tabIndex="98" accesskey="s" name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a   accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('inv/invi01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
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