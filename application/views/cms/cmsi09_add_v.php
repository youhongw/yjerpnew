<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <!--<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 職務類別資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mj001').focus();"  type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s </span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi09/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $mj001=$this->input->post('mj001');
	  $mj002=$this->input->post('mj002');
	  $mj003=$this->input->post('mj003');
	  $mj004=$this->input->post('mj004');
	
	//  if(!isset($mj013)) { $mj013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">職務代號：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mj001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mj001" value="<?php echo $mj001; ?>" type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="8%" >職務名稱：</td>
        <td class="normal14a" width="42%" ><input type="text" tabIndex="2"  onKeyPress="keyFunction()" size="16"  id="mj003" name="mj003" value="<?php echo $mj003; ?>"   /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >職務分類： </td>
        <td class="normal14" ><select  tabIndex="3" id="mj002" onKeyPress="keyFunction()"  name="mj002" >
             <option <?php if($mj002 == '1') echo 'selected="selected"';?> value='1'>1:物管</option>                                                                      
		     <option <?php if($mj002 == '2') echo 'selected="selected"';?> value='2'>2:生管</option>
			 <option <?php if($mj002 == '3') echo 'selected="selected"';?> value='3'>3:業務</option>                                                                        
		     <option <?php if($mj002 == '4') echo 'selected="selected"';?> value='4'>4:採購</option>
			 <option <?php if($mj002 == '5') echo 'selected="selected"';?> value='5'>5:會計</option>
			 <option <?php if($mj002 == '6') echo 'selected="selected"';?> value='6'>6:出納</option>
			 <option <?php if($mj002 == '7') echo 'selected="selected"';?> value='7'>7:倉庫</option>
			 <option <?php if($mj002 == '8') echo 'selected="selected"';?> value='8'>8:研發</option>
			 <option <?php if($mj002 == '9') echo 'selected="selected"';?> value="9">9:製造</option>
			 <option <?php if($mj002 == 'A') echo 'selected="selected"';?> value="A">A:品管</option>
			 <option <?php if($mj002 == 'B') echo 'selected="selected"';?> value="B">B:管理</option>
			 <option <?php if($mj002 == 'C') echo 'selected="selected"';?> value="C">C:工程</option>
			 <option <?php if($mj002 == 'D') echo 'selected="selected"';?> value="D">D:生技</option>	
			 <option <?php if($mj002 == 'E') echo 'selected="selected"';?> value="E">E:船務</option>
             <option <?php if($mj002 == 'F') echo 'selected="selected"';?> value="F">F:廠務</option>
			 <option <?php if($mj002 == 'G') echo 'selected="selected"';?> value="G">G:貿易</option>
			 <option <?php if($mj002 == 'H') echo 'selected="selected"';?> value="H">H:總務</option>	
			 <option <?php if($mj002 == 'I') echo 'selected="selected"';?> value="I">I:人事</option>
			 <option <?php if($mj002 == 'Z') echo 'selected="selected"';?> value="Z">Z:其他</option>
		  </select>
		<td class="normal14z">備註：</td>
        <td class="normal14"><input type="text" tabIndex="4"  onKeyPress="keyFunction()" size="50"  id="mj004" name="mj004" value="<?php echo $mj004; ?>"   /></td>
	  </tr>
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">人員代號</td>
              <td width="15%" class="left">人員姓名</td>
			  <td width="15%" class="left">備註</td>
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="6"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi09/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
 <?php include("./application/views/fun/cmsi09_funjs_v.php"); ?>
  