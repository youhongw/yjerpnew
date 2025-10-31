<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 業務訪問建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mm001').focus();" tabIndex="8" type='submit'  accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	   
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/cop/copi82/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mm001=substr($row->mm001,0,4).'/'.substr($row->mm001,4,2).'/'.substr($row->mm001,6,2);?>
          <?php   $cmsq09a3=$row->mm002;?>
          <?php   $copq81a=$row->mm003;?>
          <?php   $mm004=$row->mm004;?>
          <?php   $mm005=$row->mm005;?>
		  <?php   $cmsq09a3disp=$row->mm002disp;?>
		  <?php   $copq81adisp=$row->mm003disp;?>
		  <?php   $mm006=$row->mm006;?>
		  <?php   $mm007=$row->mm007;?>
		  <?php   $mm008=$row->mm008;?>
		   <?php   $mm009=$row->mm009;?>
		    <?php   $mm010=$row->mm010;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
       <tr>
	    <td class="normal14y" width="10%"><span class="required">訪問日期：</span></td>
        <td class="normal14a" width="23%" >
         <input  tabIndex="1" id="mm001" onKeyPress="keyFunction()"  onclick="scwShow(this,event);" onchange="dataymd1(this)" name="mm001"   value="<?php echo  $mm001; ?>"    type="text" required style="background-color:#E7EFEF" />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="10%" >業務員代號：</td>
        <td class="normal14" width="23%" ><input   tabIndex="2" id="mm002" onKeyPress="keyFunction()" onchange="startcmsq09a3(this)" name="cmsq09a3" value="<?php echo $cmsq09a3; ?>"  type="text" required /><img id="Showcmsq09a3" src="<?=base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
		<td class="normal14y" width="10%">&nbsp;&nbsp;</td>
        <td class="normal14a" width="24%"></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >客戶代號：</td>
        <td class="normal14" ><input   tabIndex="3" id="mm003" onKeyPress="keyFunction()" onchange="startcopq81a(this)" name="copq81a" value="<?php echo $copq81a; ?>"  type="text" required /><img id="Showcopq81a" src="<?=base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
         <span id="copq81adisp"> <?php    echo $copq81adisp; ?> </span></td>
		<td class="normal14z" >級別區分：</td>
		<td  class="normal14"  ><input type="text" tabIndex="4" id="mm004" onKeyPress="keyFunction()" name="mm004"   value="<?php echo $mm004; ?>"  size="4"  /></td>	
         <td class="normal14z">客戶類別</td>
        <td class="normal14"><input type="text" tabIndex="4" id="mm008" onKeyPress="keyFunction()" name="mm008"   value="<?php echo $mm008; ?>"  size="10"  /></td>	 
	 </tr>
		
	  <tr>
	    <td colspan="1" class="normal14z" >內容描述：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="5" rows="8" cols="50" name="mm005"   id="mm005"  Wrap="Physical"  > <?php echo $mm005; ?></textarea></td>	  
	     <td class="normal14"></td>
         <td  class="normal14"  ></td>
	  </tr>		
        </table>
		<input type='hidden' name='mm006' id='mm006' value="<?php echo $mm006; ?>" />
		<input type='hidden' name='mm007' id='mm007' value="<?php echo $mm007; ?>" />
		<input type='hidden' name='mm009' id='mm009' value="<?php echo $mm009; ?>" />
		<input type='hidden' name='mm010' id='mm010' value="<?php echo $mm010; ?>" />
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	 <!-- <div class="buttons">
	    <button tabIndex="8" type='submit'  accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
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

 <?php include("./application/views/fun/copi82_funjs_v.php"); ?> 