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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請假單資料建立作業 - 轉Excel</h1>
    </div>
  
    <div class="content">
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali54/write"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>轉Excel-明細檔xls</span></div>-->
	<div id="tab-general">
	<?php
	 $tg001o=$this->input->post('tg001o');
	  $tg001c=$this->input->post('tg001c');
	  $tg002o=$this->input->post('tg002o');
	  $tg002c=$this->input->post('tg002c');
	 
	//$this->load->helper('url');	
	?>
	<table class="form14">
         <tr>
	    <td class="start14a" width="11%">起始員工代號：</td>
        <td class="normal14a" width="39%">
		 <input tabIndex="1" id="tg001" onKeyPress="keyFunction()" type="text" name="tg001o"  value="<?php echo $tg001o; ?>"    /></td>
	    <td class="normal14a" width="11%">結束員工代號：</td>
        <td class="normal14a" width="39%">
	     <input tabIndex="1" id="tg002" onKeyPress="keyFunction()" type="text" name="tg001c"  value="<?php echo $tg001c; ?>"   minlength="1" required /></td>
	  </tr>
	  <tr>
	    <td class="start14a" >起始請假日期：</td>
        <td class="normal14a" >
		 <input tabIndex="1" id="tg002o" onKeyPress="keyFunction()" type="text" name="tg002o" class="date-picker" value="<?php echo $tg002o; ?>"  style="background-color:#E7EFEF" /></td>
	    <td class="normal14a" >結束請假日期：</td>
        <td class="normal14a" >
	     <input tabIndex="1" id="tg002c" onKeyPress="keyFunction()" type="text" name="tg002c" class="date-picker" value="<?php echo $tg002c; ?>"   minlength="1" required style="background-color:#E7EFEF"/></td>
	  </tr>
		
		 
        </table>
		
	    <div class="buttons">
	      <button tabIndex="5" type='submit' accesskey="l"  name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('pal/pali54/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
		
        </form>
    </div> 
  </div>
</div>
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>
  </div>
</div>
 <?php include("./application/views/fun/report_funjs_v.php"); ?> 