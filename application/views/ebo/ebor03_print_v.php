<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 多階材料用途清單 - 列印明細表　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button  style= "cursor:pointer" form="commentForm" onfocus="$('#invq02a').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/129'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ebo/ebor03/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($invq02a)) { $invq02a=''; } else {  $invq02a=$this->input->post('invq02a'); }
	  if(!isset($invq02adisp)) { $invq02adisp=''; } else {  $invq02adisp=$this->input->post('invq02adisp'); }
	  if(!isset($invq02a1)) { $invq02a1=''; } else {  $invq02a1=$this->input->post('invq02a1'); }
	  if(!isset($invq02a1disp)) { $invq02a1disp=''; } else {  $invq02a1disp=$this->input->post('invq02a1disp'); }
	 
	  if(!isset($cmsq03a)) { $cmsq03a='0'; } else {  $cmsq03a=$this->input->post('cmsq03a'); }
	  if(!isset($cmsq03adisp)) { $cmsq03adisp=''; } else {  $cmsq03adisp=$this->input->post('cmsq03adisp'); }
	  if(!isset($cmsq03a1)) { $cmsq03a1='zzzzzzzz'; } else {  $cmsq03a1=$this->input->post('cmsq03a1'); }
	  if(!isset($cmsq03a1disp)) { $cmsq03a1disp=''; } else {  $cmsq03a1disp=$this->input->post('cmsq03a1disp'); }
	   
	  if(!isset($mc003)) { $mc003=''; } else {  $mc003=$this->input->post('mc003'); }
	  if(!isset($mc0031)) { $mc0031='zzzzzzzzz'; } else {  $mc0031=$this->input->post('mc0031'); }
	  if(!isset($td016)) { $td016='N'; }  else {  $td016=$this->input->post('td016'); }
	  $invq02a='11010800102';
	  $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="10%">品  號：</td>
	    <td class="normal14a" width="90%"><input tabIndex="5" id="invq02a" onKeyPress="keyFunction()"  onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text"  /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
        <span id="invq02adisp"> <?php   echo $invq02adisp; ?> </span></td>
        <td class="normal14a" ></td>
		<td class="normal14a" ></td>
	  </tr>
	  
	
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td> 
        <td class="normal14" ></td>		  
		 <td class="normal14" ></td>		 
	  </tr>	
	 
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/129'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include_once("./application/views/fun/report_funjs_v.php"); ?> 