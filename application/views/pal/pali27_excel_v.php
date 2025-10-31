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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工加保建立作業 - 明細檔xls</h1>
    </div>
  
    <div class="content"> <!-- div-5 -->
	<form class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali27/write"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>轉Excel-明細檔xls</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $ti001o=$this->input->post('ti001o');
	  $ti001c=$this->input->post('ti001c');
	  $td005=$this->input->post('td005');
	?>
	<table class="form14">
      <tr>
	    <td class="start14a" width="20%">起始員工代號：</td>
	    <td class="normal14a" width="30%"><input tabIndex="1" id="ti001o" onKeyPress="keyFunction()" type="text" name="ti001o"  value="<?php echo $ti001o; ?>"  size="20" /></td>
        <td class="normal14a" width="20%">結束員工代號：</td>
		<td class="normal14a" width="30%"><input tabIndex="2" id="ti001c" onKeyPress="keyFunction()" type="text" name="ti001c"  value="<?php echo $ti001c; ?>"  size="20" /></td>
	  </tr>
      <tr>
	    <td class="start14a" width="20%">查詢薪資年月：(若留白則抓取最新勞健保費)</td>
	    <td class="normal14a" width="30%"><input tabIndex="3" id="td005" onKeyPress="keyFunction()" type="text" name="td005"  value="<?php echo $td005; ?>" onchange="dateformat_ym(this);" size="20" /></td>
        <td class="normal14a" width="20%"></td>
		<td class="normal14a" width="30%"></td>
	  </tr>
    </table>
		
	    <div class="buttons">
	    <button  type='submit' tabIndex="98" accesskey="l" name='submit' class="button"  target="_new" value='轉excel檔F8'><span>excel檔Alt+l</span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;  
	    <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pal/pali27/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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