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
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi03/printa"  method="post"  enctype="multipart/form-data" > 
	<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>
	<div id="tab-general">
	<?php
  	$ma001c=$this->input->post('ma001c');
	$ma002c=$this->input->post('ma002c');
	$ma003c=$this->input->post('ma003c');
	$ma004c=$this->input->post('ma004c');
	$this->load->helper('url');	
	?>
       
	  <table class="form14">   <!-- 表格 -->
         <tr>
		   <td class="start14a" width="20%">起始分類方式：</td>
           <td class="normal14a" width="30%">
			   <select id="ma001c" onKeyPress="keyFunction()" name="ma001c" tabIndex="1">
                  <option <?php if($ma001c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
				  <option <?php if($ma001c == '2') echo 'selected="selected"';?> value='2'>商品</option>
                  <option <?php if($ma001c == '3') echo 'selected="selected"';?> value='3'>類別</option>
                  <option <?php if($ma001c == '4') echo 'selected="selected"';?> value='4'>生管</option>
			   </select>
		  </td>
		  
		  <td class="start14a" width="20%">結束分類方式：</td>
          <td class="normal14a" width="30%">
			  <select id="ma002c" onKeyPress="keyFunction()" name="ma002c" tabIndex="2">
                 <option <?php if($ma002c == '1') echo 'selected="selected"';?> value='1'>會計</option>                                                                        
			     <option <?php if($ma002c == '2') echo 'selected="selected"';?> value='2'>商品</option>
                 <option <?php if($ma002c == '3') echo 'selected="selected"';?> value='3'>類別</option>
                 <option <?php if($ma002c == '4') echo 'selected="selected"';?> value='4'>生管</option>
			  </select>
		  </td>
		</tr>
		   
		<tr>
		  <td class="normal14" ><span class="required">*</span> 起始品號類別代號：</td>
          <td class="normal14" ><input tabIndex="3" id="ma003c" onKeyPress="keyFunction()" type="text" name="ma003c"  value="<?php echo $ma003c; ?>"  size="06" /></td>
		  <td class="normal14" ><span class="required">*</span> 結束品號類別代號：</td>
          <td class="normal14" ><input tabIndex="4" id="ma003c" onKeyPress="keyFunction()" type="text" name="ma004c"  value="<?php echo $ma004c; ?>"  size="06" /></td>
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
	      <button tabIndex="5" type='submit'  name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>&nbsp;列 印 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp; 
		  <a tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('inv/invi03/display'); ?>" class="button" ><span>取 消&nbsp;F9</span></a>
	    </div>
      </form>
	  </div> 
  </div>
</div>
<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>
  </div>
</div>