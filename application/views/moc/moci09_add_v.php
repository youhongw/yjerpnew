<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加工計價資料建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" tabIndex="12" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="13" id='cancel' name='cancel' href="<?php echo site_url('moc/moci09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/moc/moci09/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $ma001=$this->input->post('ma001');
	  $invq02a=$this->input->post('ma001');
	  $invq02adisp=$this->input->post('ma001');
	  $invq02adisp1=$this->input->post('ma001');
	  $ma002=$this->input->post('ma002');

	  
	  $cmsq02a=$this->input->post('cmsq02a');
	  $cmsq02adisp=$this->input->post('cmsq02a');
	  
	  $ma004=$this->input->post('ma004');
	  $ma005=$this->input->post('ma005');
	  $ma006=$this->input->post('ma006');
      $ma007=$this->input->post('ma007');
	  $ma008=$this->input->post('ma008');
	  $ma009=$this->input->post('ma009');
	  if (!isset($ma010)) {$ma010='';} else {$ma010=$this->input->post('ma010');}
	  
	  if(!isset($cmsq06a)) { $cmsq06a=$this->session->userdata('sysma003'); }
	  if(!isset($cmsq06adisp)) { $cmsq06adisp=$this->input->post('ma005'); }
	  $ma011=$this->input->post('ma011');
	  $ma012=$this->input->post('ma012');
	  $ma013=$this->input->post('ma013');
	  $ma014=$this->input->post('ma014');
	  
	 
	  /*if (($mc004!="1") && ($mc004!="2") ) { $mc004="1" ;}
	  if (($mc005!="Y") && ($mc005!="N") ) { $mc005="Y" ;}
	  if (($mc006!="Y") && ($mc006!="N") ) { $mc006="Y" ;}*/
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="10%"><span class="required">品號：</span></td>
        <td class="normal14a" width="40%" ><input   tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" required /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span><span id="invq02adisp1"> <?php    echo $invq02adisp1; ?> </span></td>
	    
		<td class="normal14y" width="10%">幣別：</td>
        <td class="normal14a" width="40%"><input tabIndex="5" id="ma005" onKeyPress="keyFunction()"  onfocus="this.select()" name="cmsq06a" onchange="startcmsq06a(this)"  value="<?php echo $cmsq06a; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14a" >品名：</td>
        <td class="normal14a"  > <input  readonly="value"  id="mb002" onKeyPress="keyFunction()"  name="mb002"   value="<?php ?>"    type="text" style="background-color:#EBEBE4">
		
		<td class="normal14a" >計價單位：</td>
        <td class="normal14a"  > <input   id="ma004" onKeyPress="keyFunction()"  name="ma004"   value="<?php echo  $ma004; ?>" required="required"  type="text" >
	  </tr>
		
	  <tr>
	    <td class="normal14a" >規格：</td>
        <td class="normal14a"  > <input  readonly="value"  id="mb003" onKeyPress="keyFunction()"  name="mb003"   value="<?php ?>"    type="text" style="background-color:#EBEBE4">
		
		<td  class="normal14" >含稅：</td>
        <td  class="normal14"  ><input type="hidden" name="ma011" value="N" />		  
		  <input  type='checkbox' id="ma011" onKeyPress="keyFunction()"   name="ma011" <?php if($ma011 == 'Y' ) echo 'checked';  ?>  <?php if($ma011 != 'N' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14a" >製程代號：</td>
        <td class="normal14a"  > <input  tabIndex="2" id="ma002" onKeyPress="keyFunction()"  name="ma002"   value="<?php echo  $ma002; ?>"    type="text" required="required">
		
		<td class="normal14a" >加工單價：</td>
        <td class="normal14a"  > <input  tabIndex="4" id="ma005" onKeyPress="keyFunction()"  name="ma005"   value="<?php echo  $ma005; ?>"    type="text" >
	  </tr>
	  
	  <tr>
	    <td class="normal14a" >加工廠商：</td>
        <td  class="normal14"  ><input type="text" tabIndex="3" onKeyPress="keyFunction()" id="ma003"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"  required="required"   /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		
		<td class="normal14a" >損壞扣款：</td>
        <td class="normal14a"  > <input  tabIndex="5" id="ma006" onKeyPress="keyFunction()"  name="ma006"   value="<?php echo  $ma006; ?>"    type="text" >
	  </tr>
	  
	  <tr>
	    <td class="normal14a" >核價日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="6" id="ma007"  ondblclick="scwShow(this,event);" onchange="dataymd1(this)"     onKeyPress="keyFunction()"    name="ma007" value="<?php echo $ma007; ?>" style="background-color:#E7EFEF" /></td>		
		<td class="normal14a" >生效日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="7" id="ma012"  ondblclick="scwShow(this,event);" onchange="dataymd2(this)"     onKeyPress="keyFunction()"    name="ma012" value="<?php echo $ma012; ?>" style="background-color:#E7EFEF" required="required"/></td>		
	 </tr>
      <tr>	 
		<td class="normal14a" >失效日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="8" id="ma013"  ondblclick="scwShow(this,event);" onchange="dataymd3(this)"     onKeyPress="keyFunction()"    name="ma013" value="<?php echo $ma013; ?>" style="background-color:#E7EFEF" /></td>	  
	  
	    <td class="normal14a" >初次加工日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="9" id="ma008"  ondblclick="scwShow(this,event);" onchange="dataymd4(this)"     onKeyPress="keyFunction()"    name="ma008" value="<?php echo $ma008; ?>" style="background-color:#E7EFEF" /></td>		
		</tr>
		<tr>
		<td class="normal14a" >上次加工日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="10" id="ma009"  ondblclick="scwShow(this,event);" onchange="dataymd5(this)"     onKeyPress="keyFunction()"    name="ma009" value="<?php echo $ma009; ?>" style="background-color:#E7EFEF" /></td>		
		<td class="normal14a" >備註：</td>
        <td class="normal14a"  > <input  tabIndex="11" id="ma014" onKeyPress="keyFunction()"  name="ma014"   value="<?php echo  $ma014; ?>"    type="text" >
	  </tr>
	</table>
	   <input type="hidden" name="ma010" class="ma010"  value="" />
		  
	<!--<div class="buttons">
	<button tabIndex="12" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="13" id='cancel' name='cancel' href="<?php echo site_url('moc/moci09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/moci09_funjs_v.php"); ?> 
	 
 