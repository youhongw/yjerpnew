
<div id="container">
  <div id="header">
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>  
    </div>

<div id="content"> 
  <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mf001').focus();" type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('adm/admi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content">
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/adm/admi10/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">
	<?php
	  $date=date("Ymd");
	  if(!isset($mf001)) {$mf001=$this->input->post('mf001');} else { $mf001=''; }
	  $mf002=$this->input->post('mf002');
	  $mf003=$this->input->post('mf003');
	  $mf004=$this->input->post('mf004');	 
	  $mf004disp=$this->input->post('mf004disp');
	  if(!isset($mf005)) {$mf005='N';} else { $mf005='Y'; }
	  $mf006=$this->input->post('mf006');
	  $mf007=$this->input->post('mf007');
	  $mf007disp=$this->input->post('mf007disp');
	  if(!isset($admq04adisp)) {$admq04adisp=$this->input->post('mf004');} else { $admq04adisp=''; }
	  if(!isset($cmsq05adisp)) {$cmsq05adisp=$this->input->post('mf007');} else { $cmsq05adisp=''; }
	?>
   
	<table class="form14">     <!-- 表格 -->
		  
	  <tr>
	    <td class="normal14y" width="11%"><span class="required">使用者代號：</span> </td>
            <td class="normal14a" width="89%" ><input   tabIndex="1" id="mf001" onKeyPress="keyFunction()" onblur="check_key(this);checkspace(this);"  name="mf001" value="<?php echo $mf001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z">使用者名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mf002" onKeyPress="keyFunction()" name="mf002"   value="<?php echo  $mf002; ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >使用者密碼：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mf003" onKeyPress="keyFunction()" name="mf003"   value="<?php echo  $mf003; ?>"   /></td>
		
	  </tr>
	   <tr>
	    <td class="normal14z" >群組代號：</td>
		  <td class="normal14"  ><input  type="text"  tabIndex="4" id="admi04" ondblclick="search_admi04_window()" class="admi04" onKeyPress="keyFunction()" name="mf004"  onchange="check_admi04(this)"  value="<?php echo  $mf004; ?>"  style="background-color:#FFFFE4"  />
		 <a href="javascript:;"><img id="Showadmi04disp" src="<?php echo base_url()?>assets/image/png/group.png" alt="" align="top"/></a>
         <span id="admi04disp"><?php  echo $mf004disp; ?></span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >超級使用者：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="mf005" onKeyPress="keyFunction()" name="mf005"   value="<?php echo  strtoupper($mf005); ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >部門代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" ondblclick="search_cmsi05_window()" onKeyPress="keyFunction()" id="cmsi05"  name="mf007"  onblur="check_cmsi05(this)"    value="<?php echo  $mf007; ?>"  style="background-color:#FFFFE4"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $mf007disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >備  註：</td>
		<td class="normal14"  ><input type="text" tabIndex="7" id="mf006" onKeyPress="keyFunction()" name="mf006"   value="<?php echo  $mf006; ?>"   /></td>
		
	  </tr>
	</table>
	   		  
	<!--<div class="buttons">
	<button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('adm/admi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
  
    </div> 
  </div>
</div>

    </div> 
  </div> 
   </div> 
 
 <?php //include("./application/views/fun/admi10_funjs_v.php"); ?> 
 <?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/admi04_funmjs_v.php"); ?> <!-- 群組 -->
 <?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
 <?php  include_once("./application/views/funnew/admi10_funjs_v.php"); ?>  <!-- 本身判斷資料重複 -->