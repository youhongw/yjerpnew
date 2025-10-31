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

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號廠商建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button tabIndex="8" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri02/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $invq02a=$row->mb001;?>
		  <?php   $invq02adisp=$row->mb001disp;?>
		  <?php   $invq02adisp1=$row->mb001disp1;?>
          <?php   $purq01a=$row->mb002;?>
		  <?php   $purq01adisp=$row->mb002disp;?>
          <?php   $cmsq06a=$row->mb003;?>
		  <?php   $cmsq06adisp=$row->mb003disp;?>
          <?php   $mb004=$row->mb004;?>
		  
          <?php   $mb005=$row->mb005;?>
		  <?php   $mb007=$row->mb007;?>
		  <?php   $mb008=$row->mb008;?>
		  <?php   $mb009=$row->mb009;?>
		  <?php   $mb010=$row->mb010;?>
		  <?php   $mb011=round($row->mb011,2);?>
		  <?php   $mb012=$row->mb012;?>
		  <?php   $mb013=$row->mb013;?>
		   <?php  if ($row->mb005>'0') {$mb005=substr($row->mb005,0,4).'/'.substr($row->mb005,4,2).'/'.substr($row->mb005,6,2);} else {$mb005='';} ?>
		    <?php  if ($row->mb008>'0') {$mb008=substr($row->mb008,0,4).'/'.substr($row->mb008,4,2).'/'.substr($row->mb008,6,2);} else {$mb008='';} ?>
			 <?php  if ($row->mb009>'0') {$mb009=substr($row->mb009,0,4).'/'.substr($row->mb009,4,2).'/'.substr($row->mb009,6,2);} else {$mb009='';} ?>
		  <?php  if ($row->mb014>'0') {$mb014=substr($row->mb014,0,4).'/'.substr($row->mb014,4,2).'/'.substr($row->mb014,6,2);} else {$mb014='';} ?>
		 <?php  if ($row->mb015>'0') {$mb015=substr($row->mb015,0,4).'/'.substr($row->mb015,4,2).'/'.substr($row->mb015,6,2);} else {$mb015='';} ?>
		
		 
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
       <tr>
	    <td class="normal14y" width="8%"><span class="required">品號：</span></td>
        <td class="normal14a" width="42%" ><input readonly="value"  tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" required /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span><span id="invq02adisp1"> <?php    echo $invq02adisp1; ?> </span></td>
	    <td class="normal14y" width="10%"><span class="required">廠商代號：</span></td>
        <td class="normal14a"  width="40%"> <input readonly="value"  tabIndex="2" id="mb002" onKeyPress="keyFunction()" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>"  type="text" required /><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
         <span id="purq01adisp"> <?php    echo $purq01adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" ><span class="required">幣別：</span> </td>
        <td class="normal14" ><input readonly="value"  tabIndex="3" id="mb003" onKeyPress="keyFunction()" onchange="startcmsq06a(this)" name="cmsq06a" value="<?php echo $cmsq06a; ?>"  type="text" required /><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
         <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span> </td>
		<td class="normal14z" >廠商品號：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" id="mb007" name="mb007"  value="<?php echo $mb007; ?>"  type="text"  /></td>	
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >核價日：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="mb008"  ondblclick="scwShow(this,event);"     onKeyPress="keyFunction()"    name="mb008" value="<?php echo $mb008; ?>" style="background-color:#E7EFEF" /></td>	  
	    <td class="normal14z">生效日：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="mb014"  ondblclick="scwShow(this,event);"      onKeyPress="keyFunction()"    name="mb014" value="<?php echo $mb014; ?>" style="background-color:#E7EFEF" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >失效日：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="mb015"  ondblclick="scwShow(this,event);"   onchange="dataymd1(this)"     onKeyPress="keyFunction()"    name="mb015" value="<?php echo $mb015; ?>" style="background-color:#E7EFEF" /></td>	  
	    <td class="normal14z">採購單價：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="mb011"      onKeyPress="keyFunction()"    name="mb011" value="<?php echo $mb011; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >初次交易：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="mb005"  ondblclick="scwShow(this,event);"   onchange="dataymd2(this)"    onKeyPress="keyFunction()"    name="mb005" value="<?php echo $mb005; ?>" style="background-color:#E7EFEF" /></td>	  
	    <td class="normal14z">上次進貨日：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="mb009"  ondblclick="scwShow(this,event);"   onchange="dataymd3(this)"    onKeyPress="keyFunction()"    name="mb009" value="<?php echo $mb009; ?>" style="background-color:#E7EFEF" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >計價單位：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="mb004"      onKeyPress="keyFunction()"    name="mb004" value="<?php echo $mb004; ?>"  /></td>	  
	    <td class="normal14z">備註：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="mb012"      onKeyPress="keyFunction()"    name="mb012" value="<?php echo $mb012; ?>"  /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >分量計價：</td>
        <td  class="normal14"  ><input type="hidden" name="mb010" class="mb010"  value="N" />
		  <input tabIndex="13" type='checkbox' id="mb010"  onKeyPress="keyFunction()" name="mb010" <?php if($mb010 == 'Y' ) echo 'checked'; ?>  <?php if($mb010 != 'Y' ) echo 'check'; ?> value="Y" size="1"   />
        </td>	  
	    <td class="normal14z">含稅：</td>		
        <td  class="normal14"  ><input type="hidden" name="mb013" class="mb013"  value="N" />
		  <input tabIndex="14" type='checkbox' id="mb013"  onKeyPress="keyFunction()" name="mb013" <?php if($mb013 == 'Y' ) echo 'checked'; ?>  <?php if($mb013 != 'Y' ) echo 'check'; ?> value="Y" size="1"  />
        </td>
	  </tr>
        </table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	  <!--<div class="buttons">
	    <button tabIndex="8" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   </div>-->
	   
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

     </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

 <?php include("./application/views/fun/puri02_funjs_v.php"); ?> 
