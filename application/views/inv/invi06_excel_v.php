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
  <?php
     $td1001c=$this->input->post('td1001c');
     $td1002c=$this->input->post('td1002c');
   
   //$this->load->helper('url');	
  ?>
 <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 實盤資料建立作業 - 轉Excel</h1>
    </div>
  
    <div class="content">
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi06/write"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>轉Excel-明細檔xls</span></div> -->
	<div id="tab-general">
	<?php
	  $td1001c=$this->input->post('td1001c');
	  $td1002c=$this->input->post('td1002c');
	   $td1003c=$this->input->post('td1003c');
	    $td1004c=$this->input->post('td1004c');
	//$this->load->helper('url');	
	?>
	<table class="form14">
          <tr>
	    <td class="start14a" width="11%">盤點底稿代號：</td>
            <td class="normal14a" width="39%">
		<input tabIndex="1" id="td1001c" onKeyPress="keyFunction()" type="text" name="td1001c"  value="<?php echo $td1001c; ?>"   /></td>
	    </td>
            <td class="normal14a" width="11%">庫別代號：</td>
            <td class="normal14a" width="39%">
		  <input tabIndex="2" id="td1002c" onKeyPress="keyFunction()" type="text" name="td1002c"  value="<?php echo $td1002c; ?>"   /></td>
	    </td>
	  </tr>
		 <tr>
	    <td class="start14a" >起始儲位代號：</td>
        <td class="normal14a" >
		 <input tabIndex="3" id="td1003" onKeyPress="keyFunction()" type="text" name="td1003c"  value="<?php echo $td1003c; ?>"   minlength="1" required /></td>
	    <td class="normal14a" >截止儲位代號：</td>
        <td class="normal14a" ><input tabIndex="4" id="td1004" onKeyPress="keyFunction()" type="text" name="td1004c"  value="<?php echo $td1004c; ?>"   minlength="1" required /></td>
	  </tr>
	  </tr>
	   
		 
        </table>
		
	    <div class="buttons">
	      <button tabIndex="5" type='submit'  accesskey="l"  name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x"  tabIndex="6" id='cancel' name='cancel' href="<?php echo site_url('inv/invi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
