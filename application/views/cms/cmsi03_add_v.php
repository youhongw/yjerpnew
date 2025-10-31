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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 庫別資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mc001').focus();" tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi03/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mc001=$this->input->post('mc001');
	  $mc002=$this->input->post('mc002');
	  $cmsq02a=$this->input->post('mc003');
	  $mc004=$this->input->post('mc004');
	  $mc005=$this->input->post('mc005');
	  $mc006=$this->input->post('mc006');
      $mc007=$this->input->post('mc007');		  
	  $cmsq02adisp=$this->input->post('mc003');
	  if (($mc004!="1") && ($mc004!="2") ) { $mc004="1" ;}
	  if (($mc005!="Y") && ($mc005!="N") ) { $mc005="Y" ;}
	  if (($mc006!="Y") && ($mc006!="N") ) { $mc006="Y" ;}
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="11%"><span class="required">庫別代號：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="mc001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mc001"   value="<?php echo  $mc001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="12%">庫別名稱：</td>
        <td class="normal14a"  width="38%"> <input  tabIndex="2" id="mc002" onKeyPress="keyFunction()"  name="mc002"   value="<?php echo  $mc002; ?>"    type="text"  />
		<td class="normal14a">&nbsp;&nbsp;</td>
        <td class="normal14a"></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >廠別代號：</td>
        <td class="normal14" ><input   tabIndex="3" id="mc003" onKeyPress="keyFunction()" onchange="startcmsq02a(this)" name="cmsq02a" value="<?php echo $cmsq02a; ?>"  type="text" required /><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		<td class="normal14z" >庫別性質：</td>
		<td class="normal14">
			   <input type="radio" name="mc004" <?php if (isset($mc004) && $mc004=="1") echo "checked";?> value="1" />存貨庫  &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="mc004" <?php if (isset($mc004) && $mc004=="2") echo "checked";?> value="2" />非存貨庫
        </td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >納入MRP計算：</td>
        <td  class="normal14"  >
		  <input type="hidden" name="mc005" class="mc005"  value="N" />
		  <input tabIndex="5" id="mc005" onKeyPress="keyFunction()"  name="mc005" <?php if($mc005 == 'Y' ) echo 'checked';  ?>  <?php if($mc005 != 'Y' ) echo 'check'; ?>  value="Y" size="1" type='checkbox'  />
        </td>	  
	    <td class="normal14z">庫存不足准出庫：</td>		
        <td  class="normal14"  ><input type="hidden" name="mc006" class="mc006"  value="N" />
		  <input tabIndex="6" id="mc006" onKeyPress="keyFunction()" name="mc006" <?php if($mc006 == 'Y' ) echo 'checked'; ?>  <?php if($mc006 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>
		
	  <tr>
	    <td class="normal14z"> 備註：</td>
        <td class="normal14" ><input  tabIndex="7" onKeyPress="keyFunction()" id="mc007" name="mc007"  value="<?php echo $mc007; ?>"  type="text"  /></td>	
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/cmsi03_funjs_v.php"); ?> 
	 
 