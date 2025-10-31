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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購單資料作業 - 列印呈核表請購單　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ta001o').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo base_url()?>index.php/main" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri06/printc"  method="post"  enctype="multipart/form-data" > 
	 <!-- <div id="htabs" class="htabs14"><span>列印項目-請購單</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $ta001o=$this->input->post('ta001o');
	  $ta002o=$this->input->post('ta002o');
	  $ta003o=$this->input->post('ta003o');
	  $ta004o=$this->input->post('ta004o');
	 // $ta001o='3111';
	 // $ta002o='20160414002';
	  	  $tl009p='1';
	?>
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="12%">請購單別：</td>
	    <td class="normal14" width="38%"><input tabIndex="1" id="ta001o" onKeyPress="keyFunction()" type="text" name="ta001o"  value="<?php echo $ta001o; ?>"  size="20" /></td>
        <td class="normal14y" width="10%">請購單號：</td>
	    <td class="normal14" width="40%"><input tabIndex="2" id="ta002o" onKeyPress="keyFunction()" type="text" name="ta002o"  value="<?php echo $ta002o; ?>"  size="20" /></td>
	  </tr>	
	   <tr>
	    <td class="normal14y" width="12%">請購序號(起)：</td>
	    <td class="normal14" width="38%"><input tabIndex="1" id="ta003o" onKeyPress="keyFunction()" type="text" name="ta003o"  value="<?php echo $ta003o; ?>"  size="20" /></td>
        <td class="normal14y" width="12%">請購序號(迄)：</td>
	    <td class="normal14" width="40%"><input tabIndex="2" id="ta004o" onKeyPress="keyFunction()" type="text" name="ta004o"  value="<?php echo $ta004o; ?>"  size="20" /></td>
	  </tr>	
		<tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tl009p" onKeyPress="keyFunction()" name="tl009p"  tabIndex="5">
            <option <?php if($tl009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tl009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>	
	  
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('pur/puri06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
        </form>
		<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->