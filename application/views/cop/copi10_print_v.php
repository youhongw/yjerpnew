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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> pos客戶銷貨單建立作業 - 列印明細表　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tg001o').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi10/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $tg001o=$this->input->post('tg001o');
	  $tg001c='zzz';
	  $dateo=$this->input->post('dateo');
	  $datec='';
	 if(!isset($copq01a)) { $copq01a=''; } else {  $copq01a=$this->input->post('copq01a'); }
	  if(!isset($copq01adisp)) { $copq01adisp=''; } else {  $copq01adisp=$this->input->post('copq01adisp'); }
	  if(!isset($copq01a1)) { $copq01a1=''; } else {  $copq01a1=$this->input->post('copq01a1'); }
	   if($copq01a1=='') { $copq01a1='zz'; }
	  if(!isset($copq01a1disp)) { $copq01a1disp=''; } else {  $copq01a1disp=$this->input->post('copq01a1disp'); }
	//   if(!isset($tg003o)) { $tg003o=''; }
	//   if(!isset($tg003c)) { $tg003c='zzz'; }
	   
	//   if(!isset($tg004o)) { $tg004o=''; }
	//   if(!isset($tg004c)) { $tg004c='zzz'; }
	    if(!isset($invq02a)) { $invq02a=''; } else {  $invq02a=$this->input->post('invq02a'); }
	  if(!isset($invq02adisp)) { $invq02adisp=''; } else {  $invq02adisp=$this->input->post('invq02adisp'); }
	  if(!isset($invq02a1)) { $invq02a1=''; } else {  $invq02a1=$this->input->post('invq02a1'); }
	   if($invq02a1=='') { $invq02a1='zz'; } 
	  if(!isset($invq02a1disp)) { $invq02a1disp=''; } else {  $invq02a1disp=$this->input->post('invq02a1disp'); }
	  $tg009p='1';
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
	    <td class="normal14" ><input tabIndex="3" id="dateo" ondblclick="scwShow(this,event);" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
        <td class="normal14z" >結束日期：</td>
	    <td class="normal14" ><input tabIndex="4" id="datec" ondblclick="scwShow(this,event);" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >起始客戶代號：</td>
	    <td class="normal14" ><input tabIndex="1" id="copq01a" onKeyPress="keyFunction()"  onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>"  type="text"  /><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php   echo $copq01adisp; ?> </span></td>
        <td class="normal14z" >結束客戶代號：</td>
	    <td class="normal14" ><input tabIndex="2" id="copq01a1" onKeyPress="keyFunction()"  onchange="startcopq01a1(this)" name="copq01a1" value="<?php echo $copq01a1; ?>"  type="text"  /><img id="Showcopq01a1" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01a1disp"> <?php   echo $copq01a1disp; ?> </span></td>
	  </tr>
	    <tr>
	    <td class="normal14z" >起始品號：</td>
	    <td class="normal14" ><input tabIndex="5" id="invq02a" onKeyPress="keyFunction()"  onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text"  /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
        <span id="invq02adisp"> <?php   echo $invq02adisp; ?> </span></td>
        <td class="normal14z" >結束品號：</td>
	    <td class="normal14" ><input tabIndex="6" id="invq02a1" onKeyPress="keyFunction()"  onchange="startinvq02a1(this)" name="invq02a1" value="<?php echo $invq02a1; ?>"  type="text"  /><img id="Showinvq02a1" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
        <span id="invq02a1disp"> <?php   echo $invq02a1disp; ?> </span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="5">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>	
	 
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('cop/copi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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