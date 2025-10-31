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

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶商品計價建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mb002').focus();" tabIndex=-1 type='submit' accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img  src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	  <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cop/copi02/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	 
	  $invq02a=$this->input->post('mb002');
	  $invq02adisp=$this->input->post('mb002');
	  $invq02adisp1=$this->input->post('mb002');
	 
	  $copq01a=$this->input->post('mb001');
	  $copq01adisp=$this->input->post('mb001');
	  $mb003=$this->input->post('mb003');
	  $cmsq06a=$this->input->post('mb004');
      $cmsq06adisp=$this->input->post('mb004');
	 
	  $mb005=$this->input->post('mb005');
     
      $mb008=$this->input->post('mb008');	
     
      $mb010=$this->input->post('mb010');
      $mb011=$this->input->post('mb011');
      $mb012=$this->input->post('mb012');
      $mb013=$this->input->post('mb013');
      $mb014=$this->input->post('mb014');
      $mb015=$this->input->post('mb015');		
	  $mb016=$this->input->post('mb016');
	  $mb018=$this->input->post('mb018');
	  if (!isset($mb009)) { $mb009=date("Y/m/d");}
	  if (!isset($mb017)) { $mb017=date("Y/m/d");}
	  if (!isset($mb007)) { $mb007="N";}
	  if (!isset($mb013)) { $mb013="N";}
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="8%"><span class="required">品號：</span></td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mb002" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" required /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span><span id="invq02adisp1"> <?php    echo $invq02adisp1; ?> </span></td>
	    <td class="normal14y" width="10%">客戶代號：</td>
        <td class="normal14a"  width="40%"> <input   tabIndex="2" id="mb001" onKeyPress="keyFunction()" onchange="startcopq01a(this)" name="copq01a" value="<?php echo $invq02a; ?>"  type="text" required /><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
         <span id="copq01adisp"> <?php    echo $copq01adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >幣別： </td>
        <td class="normal14" ><input   tabIndex="3" id="mb004" onKeyPress="keyFunction()" onchange="startcmsq06a(this)" name="cmsq06a" value="<?php echo $cmsq06a; ?>"  type="text" required /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
         <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span></td>
		<td class="normal14z" >佣金單價：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" id="mb015" name="mb015"  value="<?php echo $mb015; ?>"  type="text"  /></td>	
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >核價日：</td>
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mb009"  value="<?php echo $mb009; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mb009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	  
	    <td class="normal14z">生效日：</td>		
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb017" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mb017"  value="<?php echo $mb017; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mb017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >失效日：</td>
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb018" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mb018"  value="<?php echo $mb018; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mb018,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	  
	    <td class="normal14z">計價單價：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="mb008"      onKeyPress="keyFunction()"    name="mb008" value="<?php echo $mb008; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >初次交易：</td>
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb014" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mb014"  value="<?php echo $mb014; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mb014,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	  
	    <td class="normal14z" >上次銷貨日：</td>		
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mb010" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mb010"  value="<?php echo $mb010; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mb010,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >計價單位：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="mb003"      onKeyPress="keyFunction()"    name="mb003" value="<?php echo $mb003; ?>" required  /></td>	  
	    <td class="normal14z">備註：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="mb012"      onKeyPress="keyFunction()"    name="mb012" value="<?php echo $mb012; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >分量計價：</td>
        <td  class="normal14"  ><input type="hidden" name="mb007" class="mb007"  value="N" />
		  <input  type='checkbox' id="mb007" tabIndex="13" onKeyPress="keyFunction()" name="mb007" <?php if($mb010 == 'Y' ) echo 'checked'; ?>  <?php if($mb007 != 'Y' ) echo 'check'; ?> value="Y" size="1"   />
        </td>	  
	    <td class="normal14z" >含稅：</td>		
        <td  class="normal14"  ><input type="hidden" name="mb013" class="mb013"  value="N" />
		  <input  type='checkbox' id="mb013" tabIndex="14" onKeyPress="keyFunction()" name="mb013" <?php if($mb013 == 'Y' ) echo 'checked'; ?>  <?php if($mb013 != 'Y' ) echo 'check'; ?> value="Y" size="1"  />
        </td>
	  </tr>
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit' accesskey="+"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>  -->
	
    </form>
	 <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
  
</div> <!-- div-4 -->

  <?php //	if ($message!=' ') { ?>
<!--	<div class="success"><?php // echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php// } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/copi02_funjs_v.php"); ?> 

 