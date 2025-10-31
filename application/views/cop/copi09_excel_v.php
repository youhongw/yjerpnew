<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></a></div>
        <div class="div3">
	  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	</div>-->
	<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶銷退單資料建立作業 - 轉Excel</h1>
    　<div style="float:left;padding-top: 5px; ">
	　 <button style= "cursor:pointer" form="commentForm" onfocus="$('#ti001o').focus();" type='submit' tabIndex="98" accesskey="l" name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp; 
	    <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
  　</div>
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi09/write"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>轉Excel-明細檔xls</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $ti001o=$this->input->post('ti001o');
	  $ti001c=$this->input->post('ti001c');
	  $ti002o=$this->input->post('ti002o');
	  $ti002c=$this->input->post('ti002c');
	?>
	<table class="form14">
      <tr>
	    <td class="normal14y" width="11%">起始銷退單別：</td>
	    <td class="normal14a" width="39%"><input tabIndex="1" id="ti001o" onKeyPress="keyFunction()" type="text" name="ti001o"  value="<?php echo $ti001o; ?>"  size="20" /></td>
        <td class="normal14y" width="11%">結束銷退單別：</td>
		<td class="normal14a" width="39%"><input tabIndex="2" id="ti001c" onKeyPress="keyFunction()" type="text" name="ti001c"  value="<?php echo $ti001c; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始銷退單號：</td>
	    <td class="normal14" ><input tabIndex="3" id="ti002o" onKeyPress="keyFunction()" type="text" name="ti002o"  value="<?php echo $ti002o; ?>"  size="20" /></td>
        <td class="normal14z" >結束銷退單號：</td>
		<td class="normal14" ><input tabIndex="4" id="ti002c" onKeyPress="keyFunction()" type="text" name="ti002c"  value="<?php echo $ti002c; ?>"  size="20" /></td>
	  </tr>
	 
		 
    </table>
		
	   <!-- <div class="buttons">
	    <button  type='submit' tabIndex="98" accesskey="l" name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;  
	    <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
		
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

     </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->