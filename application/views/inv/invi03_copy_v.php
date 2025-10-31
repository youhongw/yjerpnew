<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
    <div class="div3">
	  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>　
	</div>
  </div>
  
<div id="content">
  <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號類別資料建立作業</h1>
    </div>
    <div class="content">
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi03/copysave" method="post" enctype="multipart/form-data" id="form">
	<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>
	<div id="tab-general">
	<?php
	$ma001c=$this->input->post('ma001c');
	$ma002c=$this->input->post('ma002c');
	$ma003c=$this->input->post('ma003c');
	$ma004c=$this->input->post('ma004c');
	$this->load->helper('url');	
	?>
	
	<table class="form14">    <!-- 表格開始 -->
       <tr>
	      <td class="normal14a" width="20%">原始分類方式：</td>
          <td class="normal14a" width="30%">
		      <select id="ma001" onKeyPress="keyFunction()"  tabIndex="1" name="ma001c">
               	<option <?php if($ma001c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
				<option <?php if($ma001c == '2') echo 'selected="selected"';?> value='2'>商品</option>
                <option <?php if($ma001c == '3') echo 'selected="selected"';?> value='3'>類別</option>
                <option <?php if($ma001c == '4') echo 'selected="selected"';?> value='4'>生管</option>
			  </select>
		   </td>
		   
		   <td class="normal14a" width="20%">複製分類方式：</td>
           <td class="normal14a" width="30%">
		   <select id="ma003" onKeyPress="keyFunction()"  tabIndex="1" name="ma003c">
              <option <?php if($ma003c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
			  <option <?php if($ma003c == '2') echo 'selected="selected"';?> value='2'>商品</option>
              <option <?php if($ma003c == '3') echo 'selected="selected"';?> value='3'>類別</option>
              <option <?php if($ma003c == '4') echo 'selected="selected"';?> value='4'>生管</option>
		   </select>
		   </td>
	  </tr>
	  
	  <tr>
		 <td ><span class="required"></span> </td>
         <td ><input type="hidden" name="test1"  value=" "  size="06" /></td>
		 <td>&nbsp;&nbsp;</td>
         <td><input type="hidden" name="test2"   value=" "  size="12" /></td>
	 </tr>
	 
	 <tr>
		<td class="start14" width="20%"><span class="required">*</span> 原始品號類別代號：</td>
        <td class="normal14" width="30%">
		    <input tabIndex="3" id="ma002" onKeyPress="keyFunction()" type="text" name="ma002c"  value="<?php echo $ma002c; ?>"  size="06" minlength="1" required /></td>
		<td class="start14" width="20%"><span class="required">*</span> 複製品號類別代號：</td>
        <td class="normal14" width="30%">
		    <input tabIndex="4" id="ma004" onKeyPress="keyFunction()" type="text" name="ma004c"  value="<?php echo $ma004c; ?>"  size="06" minlength="1" required /></td>
	 </tr>
	 
	 <tr>
		<td><span class="required"></span></td>
        <td><input type="hidden" name="test3"  value=" " size="20"/></td>
		<td>&nbsp;&nbsp;</td>
        <td></td>
	 </tr>
		 
    </table>
		<input type='hidden' name='company' id='company' value='DERSHENG' />
		<input type='hidden' name='creator' id='creator' value='89044' />
		<input type='hidden' name='usr_group' id='usr_group' value='test' />
		<input type='hidden' name='create_date' id='create_date' value="<?php $date; ?>" />
		<input type='hidden' name='modifier' id='modifier' value='' />
		<input type='hidden' name='modi_date' id='modi_date' value='' />
		<input type='hidden' name='flag' id='flag' value=0 />
		<div class="buttons">
	    <button tabIndex="5" type='submit'  name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('inv/invi03/display'); ?>" class="button" ><span>取 消&nbsp;F9</span></a></div>
	   
    </form>
	</div> 
  </div>
</div>

 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ]' ?> </div> <?php } ?>
</div>
</div>
</div>