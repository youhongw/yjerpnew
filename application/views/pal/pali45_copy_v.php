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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 考績分數建立作業 - 複製</h1>
    </div>
    
    <div class="content">  <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali45/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general">   <!-- div-6 -->
	<?php
	  $yf001c=$this->input->post('yf001c');
	  $yf002c=$this->input->post('yf002c');
	  $yf003c=$this->input->post('yf003c');
	  $yf004c=$this->input->post('yf004c');
	?>
	
	<table class="form14">    <!-- 表格開始 -->
	<tr>
	   <td class="start14a" width="11%">原始考績年度：</td>
       <td class="normal14a" width="39%">
	      <input type="text" tabIndex="1" id="yf001" onKeyPress="keyFunction()"  name="yf001c"  value="<?php echo $yf001c; ?>"   /></td>
        <td class="normal14a" width="11%" >複製考績年度：</td>
       <td class="normal14" width="39%" >
	     <input type="text"  tabIndex="2" id="yf002" onKeyPress="keyFunction()"  name="yf002c"  value="<?php echo $yf002c; ?>"   minlength="1" required /></td>
	</tr>
	<tr>
	   <td class="normal14a" >原始員工代號：</td>
       <td class="normal14" >
	     <input type="text"  tabIndex="3" id="yf003" onKeyPress="keyFunction()"  name="yf003c"  value="<?php echo $yf003c; ?>"    /></td>
	   <td class="normal14a" >複製員工代號：</td>
       <td class="normal14" >
	     <input type="text"  tabIndex="4" id="yf004" onKeyPress="keyFunction()"  name="yf004c"  value="<?php echo $yf004c; ?>"   minlength="1" required /></td>
	 </tr>
    </table>
		
	   <div class="buttons">
	   <button   type='submit'   accesskey="c" name='submit' class="button"  value='&nbsp;複 製F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a   accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pal/pali45/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
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