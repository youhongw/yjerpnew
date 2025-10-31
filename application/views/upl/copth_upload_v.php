<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
  <!--  <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/upload"><?php echo '' ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo '89044' ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
    </div> -->
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> copth Excel檔.xlsx上傳資料 - myslq作業</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/upl/copth/do_upload"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>上傳項目-excel檔.xlsx</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $userfile=$this->input->post('userfile');
	  $ta002o=$this->input->post('ta002o');
	  $ta002c=$this->input->post('ta002c');
	  $ta003o=$this->input->post('ta003o');
	  $ta002o='150131265320003';
	  $ta002c='150201265320001';
	  $ta009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14" width="15%">選擇上傳檔案.xlsx：</td>
	    <td class="normal14" width="35%"><input type="file" name="userfile" tabIndex="1" id="ta001o" onKeyPress="keyFunction()"  value="<?php echo $userfile; ?>"  size="20" /></td>
        <td class="start14" width="15%">&nbsp;&nbsp;</td>
		<td class="normal14" width="35%"></td>
	  </tr>
	<!--  <tr>
	    <td class="start14" >&nbsp;&nbsp;</td>
	    <td class="normal14" ></td>
	    <td class="start14" >刪除起始訂單號碼：</td>
	    <td class="normal14" ><input tabIndex="2" id="ta002o"   onKeyPress="keyFunction()"  name="ta002o" value="<?php echo $ta002o; ?>" size="30" type="text" /></td>
      <a onclick="location = '<?=base_url()?>index.php/mym/myth01/delform/'.$ta002o" class="button"><span>刪除&nbsp</span><img src="<?=base_url()?>assets/image/png/del.png" />已上傳重新上傳時先刪除資料</a></td> 
		
	  </tr>
	   <tr>
	    <td class="start14" >&nbsp;&nbsp;</td>
	    <td class="normal14" ></td>
	    <td class="start14" >刪除結束訂單號碼：</td>
	    <td class="normal14" ><input tabIndex="3" id="ta002c"  onKeyPress="keyFunction()"  name="ta002c" value="<?php echo $ta002c; ?>" size="30" type="text"  /></td>
       
	  </tr>
	    <tr>
		<td class="start14" >&nbsp;&nbsp;</td>
	    <td class="normal14" ></td>
	    <td class="start14" ><a href="<?php echo site_url('mym/myth01/do_del/'.$ta002o."/".$ta002c)?>" class="button"><span>刪除&nbsp</span><img src="<?=base_url()?>assets/image/png/del.png" /></a></td>
	    <td class="normal14" ><span >[ 已上傳資料要重新上傳, 請先刪除, 以免重複</span>]</td>
		
	  </tr>  -->
	  
    </table>
	     <input type="hidden" name="site_url" value="<?=site_url()?>">
	    <div class="buttons">	      
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;導入F8&nbsp;'><span>導  入Alt+s</span><img src="<?=base_url()?>assets/image/png/ok.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('upload'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
		
       </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.' '.$message1.' '?> </div>
	<?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->