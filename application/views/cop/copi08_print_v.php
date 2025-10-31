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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶銷貨單建立作業 - 列印明細表　　　</h1>
    　<div style="float:left;padding-top: 5px; ">
	　<button style= "cursor:pointer" form="commentForm" onfocus="$('#tg001o').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	       <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tg001o').focus();"　type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;
		  <?PHP } ?>
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi08/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $tg001o=$this->input->post('tg001o');
	  $tg001c='zzz';
	  $dateo=$this->input->post('dateo');
	  $datec='';
	  
	  $tg002o=$this->input->post('tg002o');
	  if(!isset($tg002c)) { $tg002c='zzz'; } else {$tg002c=$this->input->post('tg002c');}
	  $tg003o=$this->input->post('tg003o');
	  if(!isset($tg003c)) { $tg003c='zzz'; } else {$tg003c=$this->input->post('tg003c');}
	  
	 if(!isset($copq01a)) { $copq01a=''; } else {  $copq01a=$this->input->post('copq01a'); }
	  if(!isset($copq01adisp)) { $copq01adisp=''; } else {  $copq01adisp=$this->input->post('copq01adisp'); }
	  
	  if(!isset($copi01)) { $copi01=''; } else {  $copi01=$this->input->post('copi01'); }
	  if(!isset($copi01disp)) { $copi01disp=''; } else {  $copi01disp=$this->input->post('copi01disp'); }
	 if(!isset($tg004)) { $tg004=''; } else {  $tg004=$this->input->post('tg004'); }
	  if(!isset($tg004disp)) { $tg004disp=''; } else {  $tg004disp=$this->input->post('tg004disp'); }
	 if(!isset($tg004a)) { $tg004a=''; } else {  $tg004a=$this->input->post('tg004a'); }
	  if(!isset($tg004adisp)) { $tg004adisp=''; } else {  $tg004adisp=$this->input->post('tg004adisp'); }
	 
	  
	  if(!isset($copq01a1)) { $copq01a1=''; } else {  $copq01a1=$this->input->post('copq01a1'); }
	   if($copq01a1=='') { $copq01a1='zz'; }
	  if(!isset($copq01a1disp)) { $copq01a1disp=''; } else {  $copq01a1disp=$this->input->post('copq01a1disp'); }
	//   if(!isset($tg003o)) { $tg003o=''; }
	//   if(!isset($tg003c)) { $tg003c='zzz'; }
	   
	//   if(!isset($tg004o)) { $tg004o=''; }
	//   if(!isset($tg004c)) { $tg004c='zzz'; }
	    if(!isset($invi02a)) { $invi02a=''; } else {  $invi02a=$this->input->post('invi02a'); }
	  if(!isset($invi02adisp)) { $invi02adisp=''; } else {  $invi02adisp=$this->input->post('invi02adisp'); }
	    if(!isset($invi02)) { $invi02=''; } else {  $invi02=$this->input->post('invi02'); }
	  if(!isset($invi02disp)) { $invi02disp=''; } else {  $invi02disp=$this->input->post('invi02disp'); }
	  
	  
	  if(!isset($invq02a1)) { $invq02a1=''; } else {  $invq02a1=$this->input->post('invq02a1'); }
	   if($invq02a1=='') { $invq02a1='zz'; } 
	  if(!isset($invq02a1disp)) { $invq02a1disp=''; } else {  $invq02a1disp=$this->input->post('invq02a1disp'); }
	  $singing1=$this->session->userdata('singing1');
	  $singing2=$this->session->userdata('singing2');
	  $tg009p='2';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">起始銷貨單別：</td>
	    <td class="normal14a" width="39%"><input tabIndex="1" id="tg001o"  onKeyPress="keyFunction()" type="text" name="tg001o"  value="<?php echo $tg001o; ?>"  size="20" /></td>
        <td class="normal14y" width="11%">結束銷貨單別：</td>
		<td class="normal14a" width="39%"><input tabIndex="2" id="tg001c"  onKeyPress="keyFunction()" type="text" name="tg001c"  value="<?php echo $tg001c; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始日期：</td>
	    <td class="normal14" ><input tabIndex="3"  ondblclick="scwShow(this,event);"   id="dateo" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="dateo"  value="<?php echo $dateo; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(dateo,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" >結束日期：</td>
	    <td class="normal14" ><input tabIndex="3"  ondblclick="scwShow(this,event);"   id="datec" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="datec"  value="<?php echo $datec; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(datec,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td></tr>
	   <tr>
	    <td class="normal14z" >起始客戶代號：</td>
	    <td class="normal14" ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()" ondblclick="search_copi01_window()"  onchange="check_copi01(this)" name="tg002o" value="<?php echo $tg002o; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $tg004disp; ?> </span></td>
        <td class="normal14z" >結束客戶代號：</td>
	    <td class="normal14" ><input tabIndex="4" id="copi01e" onKeyPress="keyFunction()" ondblclick="search_copi01e_window()"  onchange="check_copi01e(this)" name="tg002c" value="<?php echo $tg002c; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01edisp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01edisp"> <?php   echo $tg004adisp; ?> </span></td>
	  </tr>
	    <tr>
	    <td class="normal14z" >起始品號：</td>
	    <td class="normal14" ><input tabIndex="4" id="invi02a" onKeyPress="keyFunction()" ondblclick="search_invi02a_window()"  onchange="check_invi02a(this)" name="tg003o" value="<?php echo $tg003o; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showinvi02adisp" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
          <span id="invi02adisp"> <?php   echo $invi02adisp; ?> </span></td>
        <td class="normal14z" >結束品號：</td>
	    <td class="normal14" ><input tabIndex="4" id="invi02" onKeyPress="keyFunction()" ondblclick="search_invi02_window()"  onchange="check_invi02(this)" name="tg003c" value="<?php echo $tg003c; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
          <span id="invi02disp"> <?php   echo $invi02disp; ?> </span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="5">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.A4(橫式))</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >簽核(直式)：</td>
        <td class="normal14" colspan="3" >
	      <input tabIndex="4" id="singing1" onKeyPress="keyFunction()" type="text" name="singing1"  value="<?php echo $singing1; ?>"  size="120" /></td>
	    <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >簽核(橫式)：</td>
        <td class="normal14" colspan="3" >
	      <input tabIndex="5" id="singing2" onKeyPress="keyFunction()" type="text" name="singing2"  value="<?php echo $singing2; ?>"  size="120"   /></td>
	    <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>
    </table>
	
	    <!--<div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	       <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>
		  <?PHP } ?>
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
<?php  include_once("./application/views/funnew/copi01_funmjs_v.php"); ?>  <!-- 起客戶 -->
<?php  include_once("./application/views/funnew/copi01e_funmjs_v.php"); ?>  <!-- 迄客戶 -->
<?php  include_once("./application/views/funnew/invi02_funmjs_v.php"); ?>  <!-- 起品號 -->
<?php  include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>  <!-- 起品號 -->
<?php // include_once("./application/views/fun/report_funjs_v.php"); ?> 