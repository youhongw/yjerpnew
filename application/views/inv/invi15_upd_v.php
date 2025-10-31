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

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 實盤資料建立作業 - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#tc001').focus();" tabIndex="8" type='submit'  accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a   accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi15/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi15/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php    $tc001=$row->tc001;?>
          <?php    $tc002=$row->tc002;?>
		   <?php   $invq02a=$row->tc003;?>
	      <?php    $invq02adisp=$row->tc003disp.$row->tc003disp1.$row->tc003disp2;?>
          <?php    $cmsq03a=$row->tc004;?>
		  <?php    $cmsq03adisp=$row->tc004disp;?>
          <?php    $tc005=$row->tc005;?>
		  <?php    $tc006=$row->tc006;?>
		  <?php    $tc008=$row->tc008;?>
		  <?php    $tc009=substr($row->tc009,0,4).'/'.substr($row->tc009,4,2).'/'.substr($row->tc009,6,2);?>
          <?php    $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="11%"><span class="required">盤點底稿編號：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="tc001" onKeyPress="keyFunction()" onchange="startkey(this)" name="tc001"   value="<?php echo  $tc001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="10%">盤點底稿序號：</td>
        <td class="normal14a"  width="40%"> <input  tabIndex="2"  id="tc002" onKeyPress="keyFunction()"  name="tc002"   value="<?php echo  $tc002; ?>"    type="text" style="background-color:#E7EFEF"  />
		
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >庫別代號： </td>
        <td class="normal14" ><input   tabIndex="3" id="tc003" onKeyPress="keyFunction()" onchange="startcmsq03a(this)" name="cmsq03a" value="<?php echo $cmsq03a; ?>"  type="text" /><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
		<td class="normal14z" >儲位：</td>
		<td class="normal14">
			   <input  tabIndex="4" id="tc005" onKeyPress="keyFunction()"  name="tc005"   value="<?php echo  $tc005; ?>"    type="text"  />
        </td>
	  </tr>
	   <tr>
	    <td class="normal14z" >品號： </td>
        <td class="normal14" ><input   tabIndex="5" id="tc003" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span></td>
		<td class="normal14z" >實盤數量：</td>
		<td class="normal14"><input  tabIndex="6" id="tc008" onKeyPress="keyFunction()"  name="tc008"   value="<?php echo  $tc008; ?>"    type="text"  /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >盤點日期：</td>
        <td class="normal14a" > <input  tabIndex="7" onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="tc009" onKeyPress="keyFunction()"  name="tc009"   value="<?php echo  $tc009; ?>"    type="text" style="background-color:#E7EFEF"  />
		<td class="normal14" ></td>
		<td class="normal14"></td>
	  </tr>
        </table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	 <!-- <div class="buttons">
	    <button tabIndex="8" type='submit'  accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a   accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi15/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

 <?php include("./application/views/fun/invi15_funjs_v.php"); ?> 