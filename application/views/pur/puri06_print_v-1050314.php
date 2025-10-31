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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購資料維護作業 - 列印請購明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri06/print_pdf" target="_blank" method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-請購明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $tb001c=$this->input->post('tb001c');
	  $tb002c=$this->input->post('tb002c');
	  $tb003c=$this->input->post('tb003c');
	  $tb004c=$this->input->post('tb004c');
	  
	  if (!$this->input->post('tb001c')) {$tb001c='3133';}
	  if (!$this->input->post('tb002c')) {$tb002c='20140717001';}
	  if (!$this->input->post('tb003c')) {$tb003c='1000';}
	  if (!$this->input->post('tb004c')) {$tb004c='2200';}
	?>
       
	<table class="form14">   <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="8%">請購單別：</td>
        <td class="normal14a" width="42%"><input tabIndex="1" id="tb001c" onKeyPress="keyFunction()" type="text" name="tb001c"  value="<?php echo $tb001c; ?>"  /></td>
	    <td class="normal14a" width="8%"></td>
        <td class="normal14a" width="42%"></td>
	  </tr>
      <tr>
	    <td class="start14a">請購單號：</td>
        <td class="normal14" ><input tabIndex="2" id="tb002c" onKeyPress="keyFunction()" type="text" name="tb002c"  value="<?php echo $tb002c; ?>"  /></td>
	    <td class="normal14" ></td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="start14" >起始序號：</td>
        <td class="normal14" ><input tabIndex="3" id="tb003c" onKeyPress="keyFunction()" type="text" name="tb003c"  value="<?php echo $tb003c; ?>"   /></td>
	    <td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
	    
	    <td class="normal14" >結束序號：</td>
        <td class="normal14" ><input tabIndex="4" id="tb004c" onKeyPress="keyFunction()" type="text" name="tb004c"  value="<?php echo $tb004c; ?>"   /></td>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  
	  
    </table>
	
	    <div class="buttons">
	      <button type='submit' tabIndex="98" accesskey="p" name='submit'  class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/pdf.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pur/puri06/display'); ?>" class="button" >返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	    </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->