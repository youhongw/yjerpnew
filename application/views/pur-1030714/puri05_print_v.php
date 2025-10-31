<div id="container">
  <div id="header">
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	</div>
    </div>
	
<div id="content">
 <div class="box">
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業</h1>
    </div>
	
	<div class="content">
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pur/puri05/printa"  method="post"  enctype="multipart/form-data" > 
	<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>
	<div id="tab-general">
	<?php
  	  $ta001o=$this->input->post('ta001o');
	  $ta001c=$this->input->post('ta001c');
	  $ta002o=$this->input->post('ta002o');
	  $ta002c=$this->input->post('ta002c');
	
	//$this->load->helper('url');	
	?>
       
	<table class="form12">   <!-- 表格 -->
          <tr>
	    <td class="start12" width="20%">&nbsp;&nbsp;起始請購單別：</td>
	        <td class="normal12" width="30%"><input tabIndex="1" id="ta001o" onKeyPress="keyFunction()" type="text" name="ta001o"  value="<?php echo $ta001o; ?>"  size="20" /></td>
	     </td>
             <td class="start12" width="20%">&nbsp;&nbsp;結束請購單別：</td>
		     <td class="normal12" width="30%"><input tabIndex="2" id="ta001c" onKeyPress="keyFunction()" type="text" name="ta001c"  value="<?php echo $ta001c; ?>"  size="20" /></td>
	      </td>
	  </tr>
		   <tr>
	    <td class="start12" width="20%">&nbsp;&nbsp;起始請購單號：</td>
	        <td class="normal12" width="30%"><input tabIndex="3" id="ta002o" onKeyPress="keyFunction()" type="text" name="ta002o"  value="<?php echo $ta002o; ?>"  size="20" /></td>
	     </td>
             <td class="start12" width="20%">&nbsp;&nbsp;結束請購單號：</td>
		     <td class="normal12" width="30%"><input tabIndex="4" id="ta002c" onKeyPress="keyFunction()" type="text" name="ta002c"  value="<?php echo $ta002c; ?>"  size="20" /></td>
	      </td>
	  </tr>
		   
	 
		
	  <tr>
	    <td><span class="required"></span></td>
            <td><input type="hidden" name="test3"  value=" " size="20"/></td>
	    <td>&nbsp;&nbsp;</td>
            <td></td>
	  </tr>
        </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="s" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>&nbsp;列 印 F8&nbsp;</span></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>取 消&nbsp;F9</span></a>
	    </div>
        </form>
    </div> 
  </div>
</div>
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>
  </div>
</div>