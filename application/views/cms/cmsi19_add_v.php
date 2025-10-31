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
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製程代號建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mw001').focus();" tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a   accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi19/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi19/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mw001=$this->input->post('mw001');
	  $mw002=$this->input->post('mw002');
	  $mw003=$this->input->post('mw003');
	  $mw004=$this->input->post('mw004');
	 $cmsq04a=$this->input->post('cmsq04a');
	 $cmsq04adisp=$this->input->post('cmsq04adisp');
	  $mw006=$this->input->post('mw006');
      $palq01a=$this->input->post('palq01a');
	   $palq01adisp=$this->input->post('palq01adisp');
	   $mw008=$this->input->post('mw008');
	  if (($mw004!="1") && ($mw004!="2") ) { $mw004="1" ;}
	 
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="9%"><span class="required">製程代號：</span></td>
        <td class="normal14a" width="41%" >
         <input  tabIndex="1" id="mw001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mw001"   value="<?php echo  $mw001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="9%">製程名稱：</td>
        <td class="normal14a"  width="41%"> <input  tabIndex="2" id="mw002" onKeyPress="keyFunction()"  name="mw002"   value="<?php echo  $mw002; ?>"    type="text"  /></td>
		
	  </tr>	
	   <tr>
	    <td class="normal14z" >製程敘述： </td>
        <td class="normal14" ><input  tabIndex="3" id="mw003" onKeyPress="keyFunction()"  name="mw003"   value="<?php echo  $mw003; ?>"    type="text"  /></td>
		<td class="normal14z" >性質：</td>
		<td class="normal14">
			   <input type="radio" tabIndex="4" name="mw004" <?php if (isset($mw004) && $mw004=="1") echo "checked";?> value="1" />廠內製程&nbsp;&nbsp;&nbsp; 
               <input type="radio" tabIndex="5" name="mw004" <?php if (isset($mw004) && $mw004=="2") echo "checked";?> value="2" />託外製程
        </td>
	  </tr>	  
	  <tr>
	    <td class="normal14z" >線別代號： </td>
        <td class="normal14" ><input   tabIndex="6" id="mw005" onKeyPress="keyFunction()" onchange="startcmsq04a(this)" name="cmsq04a" value="<?php echo $cmsq04a; ?>"  type="text" /><img id="Showcmsq04a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq04adisp"> <?php    echo $cmsq04adisp; ?> </span></td>
		<td class="normal14z" >線別名稱：</td>
		<td class="normal14"><input  tabIndex="7" id="mw006" onKeyPress="keyFunction()"  name="mw006"   value="<?php echo  $mw006; ?>"    type="text"  /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >發包人員：</td>
        <td  class="normal14"  ><input   tabIndex="8" id="mw007" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text"  /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="palq01adisp"> <?php    echo $palq01adisp; ?> </span></td>	  
	    <td class="normal14z"> 備註：</td>
        <td class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="mw008" name="mw008"  value="<?php echo $mw008; ?>"  type="text" size="50" /></td>	
	  </tr>
		
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a   accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi19/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/cmsi19_funjs_v.php"); ?> 
	 
 