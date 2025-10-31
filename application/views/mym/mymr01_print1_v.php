<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	    </div>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 銷 貨 單 列 印</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/mym/mymr01/printc"  method="post"  enctype="multipart/form-data" > 
	<div id="htabs" class="htabs14"><span>列印項目-銷貨單</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $ta001o=$this->input->post('ta001o');
	  $ta002o=$this->input->post('ta002o');
	  $ta001o='150419265320003';
	  $ta002o='150201265320001';
	?>
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14" width="11%">訂 單 編 號：</td>
	    <td class="normal14" width="39%"><input tabIndex="1" id="ta001o" onKeyPress="keyFunction()" type="text" name="ta001o"  value="<?php echo $ta001o; ?>"  size="30" /></td>
        <td class="start14" width="11%"></td>
	    <td class="normal14" width="39%"></td>
	  </tr>	
		
	 
    </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>&nbsp;A4&nbsp;列 印 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('mym/mymr01/display'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->