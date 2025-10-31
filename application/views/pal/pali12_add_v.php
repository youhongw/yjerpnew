<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 獎懲條例建立作業 - 新增</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali12/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mu001=$this->input->post('mu001');
	  $mu002=$this->input->post('mu002');
	  $mu003=$this->input->post('mu003');
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a"  width="11%" ><span class="required">獎懲條例代號：</span> </td>
        <td class="normal14"  width="39%"><input   tabIndex="1" id="mu001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mu001" value="<?php echo $mu001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14" ></td>
        <td class="normal14"  ></td>
	  </tr>
	  <tr>
	    <td class="normal14" >獎懲條例名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mu002" onKeyPress="keyFunction()" name="mu002" size="120"  value="<?php echo  $mu002; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >備  註：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mu003" onKeyPress="keyFunction()" name="mu003"   value="<?php echo  $mu003; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  
	</table>
	   		  
	<div class="buttons">
	  <button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('pal/pali12/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
    </form>
	
    </div>  <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>   <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php include("./application/views/fun/admu01_funjs_v.php"); ?> 