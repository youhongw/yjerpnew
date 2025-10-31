<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	</div>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 採購單資料建立作業 - 轉Excel</h1>
    </div>
  
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri07/write"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>轉Excel-明細檔xls</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $tc001o=$this->input->post('tc001o');
	  $tc001c=$this->input->post('tc001c');
	  $tc002o=$this->input->post('tc002o');
	  $tc002c=$this->input->post('tc002c');
	?>
	<table class="form14">
      <tr>
	    <td class="start14" width="11%">起始採購單別：</td>
	    <td class="normal14" width="39%"><input tabIndex="1" id="tc001o" onKeyPress="keyFunction()" type="text" name="tc001o"  value="<?php echo $tc001o; ?>"  size="20" /></td>
        <td class="normal14" width="11%">結束採購單別：</td>
		<td class="normal14" width="39%"><input tabIndex="2" id="tc001c" onKeyPress="keyFunction()" type="text" name="tc001c"  value="<?php echo $tc001c; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="start14" >起始採購單號：</td>
	    <td class="normal14" ><input tabIndex="3" id="tc002o" onKeyPress="keyFunction()" type="text" name="tc002o"  value="<?php echo $tc002o; ?>"  size="20" /></td>
        <td class="normal14" >結束採購單號：</td>
		<td class="normal14" ><input tabIndex="4" id="tc002c" onKeyPress="keyFunction()" type="text" name="tc002c"  value="<?php echo $tc002c; ?>"  size="20" /></td>
	  </tr>
	 
		 
    </table>
		
	    <div class="buttons">
	    <button  type='submit' tabIndex="98" accesskey="l" name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;  
	    <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pur/puri07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
		
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->