<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 產品預計生產表 - 列印明細表　　　</h1>
      <button style= "cursor:pointer" form="commentForm" onfocus="$('#purq01a').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/108'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/moc/mocr21/printa"  method="post"  enctype="multipart/form-data" > 
	<!-- <div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($purq01a)) { $purq01a=''; } else {  $purq01a=$this->input->post('purq01a'); }
	  if(!isset($purq01adisp)) { $purq01adisp=''; } else {  $purq01adisp=$this->input->post('purq01adisp'); }
	  if(!isset($purq01a1)) { $purq01a1=''; } else {  $purq01a1=$this->input->post('purq01a1'); }
	  if(!isset($purq01a1disp)) { $purq01a1disp=''; } else {  $purq01a1disp=$this->input->post('purq01a1disp'); }
	  
	   if(!isset($cmsq03a2)) { $cmsq03a2=''; } else {  $cmsq03a2=$this->input->post('cmsq03a2'); }
	  if(!isset($cmsq03a2disp)) { $cmsq03a2disp=''; } else {  $cmsq03a2disp=$this->input->post('cmsq03a2disp'); }
	  if(!isset($cmsq03a3)) { $cmsq03a3=''; } else {  $cmsq03a3=$this->input->post('cmsq03a3'); }
	  if(!isset($cmsq03a3disp)) { $cmsq03a3disp=''; } else {  $cmsq03a3disp=$this->input->post('cmsq03a3disp'); }
	  
	    if(!isset($cmsq04a)) { $cmsq04a=''; } else {  $cmsq04a=$this->input->post('cmsq04a'); }
	  if(!isset($cmsq04adisp)) { $cmsq04adisp=''; } else {  $cmsq04adisp=$this->input->post('cmsq04adisp'); }
	  if(!isset($cmsq04a1)) { $cmsq04a1=''; } else {  $cmsq04a1=$this->input->post('cmsq04a1'); }
	  if(!isset($cmsq04a1disp)) { $cmsq04a1disp=''; } else {  $cmsq04a1disp=$this->input->post('cmsq04a1disp'); }
	 
        if(!isset($cmsq02a)) { $cmsq02a=''; } else {  $cmsq02a=$this->input->post('cmsq02a'); }
	  if(!isset($cmsq02adisp)) { $cmsq02adisp=''; } else {  $cmsq02adisp=$this->input->post('cmsq02adisp'); }
	  
	  if(!isset($dateo)) { $dateo=''; }
	  if(!isset($datec)) { $datec=date("Y/m/d"); }
	  if(!isset($dateo1)) { $dateo1=''; }
	  if(!isset($datec1)) { $datec1=date("Y/m/d"); }
	 
	  if(!isset($copq03a22)) { $copq03a22=''; } else {  $copq03a22=$this->input->post('copq03a22'); }
	  if(!isset($copq03a22disp)) { $copq03a22disp=''; } else {  $copq03a22disp=$this->input->post('copq03a22disp'); }
	  if(!isset($copq03a221)) { $copq03a221='zzzzzzzz'; } else {  $copq03a221=$this->input->post('copq03a221'); }
	  if(!isset($copq03a221disp)) { $copq03a221disp=''; } else {  $copq03a221disp=$this->input->post('copq03a221disp'); }
	   
	  if(!isset($tc002)) { $tc002=''; } else {  $tc002=$this->input->post('tc002'); }
	  if(!isset($tc0021)) { $tc0021='zzzzzzzzz'; } else {  $tc0021=$this->input->post('tc0021'); }
	  if(!isset($td016)) { $td016='N'; }  else {  $td016=$this->input->post('td016'); }
	  
	   if(!isset($tc001c)) { $tc001c=''; } else {  $tc001c=$this->input->post('tc001c'); }
	   if(!isset($tc001o)) { $tc001o=''; } else {  $tc001o=$this->input->post('tc001o'); }
	   if(!isset($tc002c)) { $tc002c=''; } else {  $tc002c=$this->input->post('tc002c'); }
	   if(!isset($tc002o)) { $tc002o=''; } else {  $tc002o=$this->input->post('tc002o'); }
	   if(!isset($tc003c)) { $tc003c=''; } else {  $tc003c=$this->input->post('tc003c'); }
	   if(!isset($tc003o)) { $tc003o=''; } else {  $tc003o=$this->input->post('tc003o'); }
	   if(!isset($tc004c)) { $tc004c=''; } else {  $tc004c=$this->input->post('tc004c'); }
	   if(!isset($tc004o)) { $tc004o=''; } else {  $tc004o=$this->input->post('tc004o'); }
	   if(!isset($tc005c)) { $tc005c=''; } else {  $tc005c=$this->input->post('tc005c'); }
	   if(!isset($tc005o)) { $tc005o=''; } else {  $tc005o=$this->input->post('tc005o'); }
	  
	  $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">起始品號：</td>
	    <td class="normal14" width="39%"><input tabIndex="4" id="tc001c" name="tc001c" onKeyPress="keyFunction()"   value="<?php echo $tc001c; ?>" size="10" type="text"  />
		</td>
        <td class="normal14y" width="11%">結束品號：</td>
		<td class="normal14" width="39%"><input tabIndex="4" id="tc001o"  name="tc001o" onKeyPress="keyFunction()"  value="<?php echo $tc001o; ?>" size="10" type="text" required />
		</td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始庫別：</td>
	    <td class="normal14" ><input tabIndex="5" id="tc002c" onKeyPress="keyFunction()" name="cmsq03a2" onchange="startcmsq03a2(this)"  value="<?php echo $cmsq03a2; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq03a2" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="cmsq03a2disp"> <?php    echo $cmsq03a2disp; ?> </span></td>
        <td class="normal14z" >結束庫別：</td>
		<td class="normal14" ><input tabIndex="5" id="tc002o" onKeyPress="keyFunction()" name="cmsq03a3" onchange="startcmsq03a3(this)"  value="<?php echo $cmsq03a3; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq03a3" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="cmsq03a3disp"> <?php    echo $cmsq03a3disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始開工日期：</td>
	    <td class="normal14" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc003c" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc003c"  value="<?php echo $tc003c; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tc003c,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
        <td class="normal14z" >結束開工日期：</td>
	    <td class="normal14" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tc039" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tc003o"  value="<?php echo $tc003o; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tc003o,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  
	   <tr>
	    <td class="normal14z" >廠別：</td>
	    <td class="normal14" ><input tabIndex="5" id="tc005c" onKeyPress="keyFunction()" name="cmsq02a" onchange="startcmsq02a(this)"  value="<?php echo $cmsq02a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
        <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
        <td class="normal14z" >製令狀態：</td>
	    <td class="normal14" ><select id="tc005o" onKeyPress="keyFunction()" name="tc005o"  tabIndex="5">
            <option <?php if($tc005o == '0') echo 'selected="selected"';?> value='0'>全部</option>                                                                        
		    <option <?php if($tc005o == '1') echo 'selected="selected"';?> value='1'>未生產</option>
			<option <?php if($tc005o == '2') echo 'selected="selected"';?> value='2'>已領料</option>
			<option <?php if($tc005o == '3') echo 'selected="selected"';?> value='3'>生產中</option>
			<option <?php if($tc005o == '4') echo 'selected="selected"';?> value='4'>已完工</option>
		  </select></td> 
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>       
	  </tr>	
	 
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/108'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include_once("./application/views/fun/mocr21_funjs_v.php"); ?> 