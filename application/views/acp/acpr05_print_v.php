<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應付帳款明細表 - 列印明細表　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#purq01a').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/105'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/acp/acpr05/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($purq01a)) { $purq01a=''; } else {  $purq01a=$this->input->post('purq01a'); }
	  //if(!isset($purq01adisp)) { $purq01adisp=''; } else {  $purq01adisp=$this->input->post('purq01adisp'); }
	  //if(!isset($purq01a1)) { $purq01a1=''; } else {  $purq01a1=$this->input->post('purq01a1'); }
	  //if(!isset($purq01a1disp)) { $purq01a1disp=''; } else {  $purq01a1disp=$this->input->post('purq01a1disp'); }
	  
	  if(!isset($dateo)) { $dateo=date("Y/m/d"); }
	  if(!isset($datec)) { $datec=date("Y/m/d"); }
	  //if(!isset($dateo1)) { $dateo1=''; }
	  //if(!isset($datec1)) { $datec1=date("Y/m/d"); }
	 
	  if(!isset($cmsq06a)) { $cmsq06a='NTD'; } else {  $cmsq06a=$this->input->post('cmsq06a'); }
	  //if(!isset($cmsq06adisp)) { $cmsq06adisp=''; } else {  $cmsq06adisp=$this->input->post('cmsq06adisp'); }
	
	  //if(!isset($td016)) { $td016='N'; }  else {  $td016=$this->input->post('td016'); }
	  $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">起始廠商代號：</td> 
	    <td class="normal14" width="39%"><input tabIndex="4" id="purq01a" onKeyPress="keyFunction()"   name="purq01a" value="<?php echo $purq01a; ?>"  type="text"  /></td>
        <!--<td class="normal14y" width="11%">結束廠商代號：</td>
		<td class="normal14" width="39%"><input tabIndex="4" id="purq01a1" onKeyPress="keyFunction()"  onchange="startpurq01a1(this)" name="purq01a1" value="<?php //echo $purq01a1; ?>" type="text"  /><img id="Showpurq01a1" src="<?php //echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
        <span id="purq01a1disp"> <?php  // echo $purq01a1disp; ?> </span></td> -->
	  </tr>
	  <tr>
	    <td class="normal14z" >起始帳款日期：</td>
	    <td class="normal14" ><input tabIndex="3" id="dateo" onfocus="this.select();" ondblclick="scwShow(this,event);" onchange="dataymd(this)" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF"/>
			<img  onclick="scwShow(dateo,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
        <td class="normal14z" >結束帳款日期：</td>
	    <td class="normal14" ><input tabIndex="4" id="datec"  onfocus="this.select();" ondblclick="scwShow(this,event);" onchange="dataymd1(this)" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF"/>
			<img  onclick="scwShow(datec,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >幣別：</td>
	    <td class="normal14" ><input tabIndex="14" id="ta008" onKeyPress="keyFunction()" name="cmsq06a"   value="<?php echo $cmsq06a; ?>"  type="text"   /></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>
	 
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>     
          <td class="start14" ></td>
	    <td class="normal14" ></td>		  
	  </tr>	
	  
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/105'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include("./application/views/fun/report_funjs_v.php"); ?> 