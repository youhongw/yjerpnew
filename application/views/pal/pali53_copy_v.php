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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加班單建立作業 - 複製</h1>
    </div>
    
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali53/copysave" method="post" enctype="multipart/form-data" id="form">
	<!--<div id="htabs" class="htabs14"><span>編輯項目-複製</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $tf001o=$this->input->post('tf001o');
	  $tf001c=$this->input->post('tf001c');
	  $tf002o=$this->input->post('tf002o');
	  $tf002c=$this->input->post('tf002c');
	  $tf003o=$this->input->post('tf003o');
	  $tf003c=$this->input->post('tf003c');
	  
	   if ($tf003o > '0') { $tf003o=$this->input->post('tf003o');} else { $tf003o=date("H:i");}
	   if ($tf003c > '0') { $tf003c=$this->input->post('tf003c');} else { $tf003c=date("H:i");}
	?>
	
	<table class="form14">    <!-- 表格開始 -->
      <tr>
	    <td class="start14a" width="11%">原始員工代號：</td>
        <td class="normal14a" width="39%">
		 <input tabIndex="1" id="tf001o" onKeyPress="keyFunction()" type="text" name="tf001o"  value="<?php echo $tf001o; ?>"    /></td>
	    <td class="normal14a" width="11%">複製員工代號：</td>
        <td class="normal14a" width="39%">
	     <input tabIndex="1" id="tf001c" onKeyPress="keyFunction()" type="text" name="tf001c"  value="<?php echo $tf001c; ?>"   minlength="1" required /></td>
	  </tr>
	  <tr>
	    <td class="start14a" >原始加班日期：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="tf002o" onKeyPress="keyFunction()" type="text" name="tf002o" onclick="scwShow(this,event);" value="<?php echo $tf002o; ?>"  style="background-color:#E7EFEF" /></td>
	    <td class="normal14a" >複製加班日期：</td>
        <td class="normal14a" >
	     <input tabIndex="1" id="tf002c" onKeyPress="keyFunction()" type="text" name="tf002c" onclick="scwShow(this,event);" value="<?php echo $tf002c; ?>"   minlength="1" required style="background-color:#E7EFEF"/></td>
	  </tr>
	 
    </table>
		
	   <div class="buttons">
	   <button tabIndex="5" type='submit' accesskey="c"  name='submit' class="button"  value='&nbsp;儲存F8&nbsp;'><span>複 製Alt+c</span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('pal/pali53/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a></div>
	   
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
 <?php include("./application/views/fun/report_funjs_v.php"); ?> 