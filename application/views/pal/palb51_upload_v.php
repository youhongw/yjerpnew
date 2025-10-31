<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
 <!--   <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
    </div>  -->
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 刷卡文字檔txt上傳資料 - 作業</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pal/palb51/do_upload"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>上傳項目-excel檔.xlsx</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $userfile=$this->input->post('userfile');
	  
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14" width="15%">選擇上傳檔案.txt：</td>
	    <td class="normal14" width="35%"><input type="file" name="userfile" tabIndex="1" id="ta001o" onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="20" /></td>
        <td class="start14" width="15%">&nbsp;&nbsp;</td>
		<td class="normal14" width="35%"></td>
	  </tr>
	
	  
    </table>
	     <input type="hidden" name="site_url" value="<?=site_url()?>">
	    <div class="buttons">	      
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;導入F8&nbsp;'><span>導  入Alt+s</span><img src="<?=base_url()?>assets/image/png/ok.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo base_url()?>index.php/main/index/111" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
		
       </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.' '?> </div>
	<?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->