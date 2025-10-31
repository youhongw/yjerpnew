<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">    <!-- div-3 -->
  <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 常用摘要資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mm002').focus();" type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi12/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi12/addsave" >	
	<!-- <div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mm001=$this->input->post('mm001');
	  $mm002=$this->input->post('mm002');
	  $mm003=$this->input->post('mm003');
	  $mm001=$this->session->userdata('manager');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="10%"><span class="required">代號：</span> </td>
        <td class="normal14a" width="40%"><input   tabIndex="1" id="mm002" onKeyPress="keyFunction()" onchange="startkey(this)" name="mm002" value="<?php echo $mm002; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14a" width="10%"></td>
        <td class="normal14a" width="40%" ></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >使用者代碼：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mm001" onKeyPress="keyFunction()" name="mm001"   value="<?php echo  $mm001; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >摘  要：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mm003" onKeyPress="keyFunction()" name="mm003" size="30"  value="<?php echo  $mm003; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	 
	</table>
	   		  
	<!--<div class="buttons">
	  <button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi12/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   	
    </div>  <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>   <!-- div-4 -->

   </div> <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php include("./application/views/fun/cmsi12_funjs_v.php"); ?> 