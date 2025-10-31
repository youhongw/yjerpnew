<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 幣別匯率資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mf001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi06/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $mf001=$this->input->post('mf001');
	  $mf002=$this->input->post('mf002');
	  $mf003=$this->input->post('mf003');
	  $mf004=$this->input->post('mf004');
	  $mf005=$this->input->post('mf005');
	  $mf006=$this->input->post('mf006');
	  $mf007=$this->input->post('mf007');
	//  if(!isset($mf013)) { $mf013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">幣別：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mf001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mf001" value="<?php echo $mf001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="8%" >幣別名稱：</td>
        <td class="normal14a" width="42%" ><input type="text" tabIndex="2"  onKeyPress="keyFunction()"  id="mf002" name="mf002" value="<?php echo $mf002; ?>"   /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >單價取位： </td>
        <td class="normal14" ><select  tabIndex="3" id="mf003" onKeyPress="keyFunction()"  name="mf003" >
             <option <?php if($mf003 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf003 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf003 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option>                                                                        
		     <option <?php if($mf003 == '3') echo 'selected="selected"';?> value='3'>3:小數三位</option>
			 <option <?php if($mf003 == '4') echo 'selected="selected"';?> value='4'>4:小數四位</option>
		  </select>
		<td class="normal14z">金額取位：</td>
        <td class="normal14"><select  tabIndex="4" id="mf004" onKeyPress="keyFunction()"  name="mf004" >
             <option <?php if($mf004 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf004 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf004 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option> 
		  </select>
	  </tr>
	  
      <tr>
	    <td class="normal14z" >單位成本： </td>
        <td class="normal14" ><select  tabIndex="5" id="mf005" onKeyPress="keyFunction()"  name="mf005" >
             <option <?php if($mf005 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf005 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf005 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option>                                                                        
		     <option <?php if($mf005 == '3') echo 'selected="selected"';?> value='3'>3:小數三位</option>
			 <option <?php if($mf005 == '4') echo 'selected="selected"';?> value='4'>4:小數四位</option>
		  </select>
		<td class="normal14z">成本金額：</td>
        <td class="normal14"><select  tabIndex="6" id="mf006" onKeyPress="keyFunction()"  name="mf006" >
             <option <?php if($mf006 == '0') echo 'selected="selected"';?> value='0'>0:整數</option>                                                                        
		     <option <?php if($mf006 == '1') echo 'selected="selected"';?> value='1'>1:小數一位</option>
			 <option <?php if($mf006 == '2') echo 'selected="selected"';?> value='2'>2:小數二位</option> 
		  </select>
	  </tr>	 
	  <tr>
	    <td  class="normal14z" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7"  onKeyPress="keyFunction()" size="60"  id="mf007" name="mf007" value="<?php echo $mf007; ?>"   /></td>
		<td class="normal14z">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">生效日期</td>
              <td width="15%" class="left">銀行買進匯率</td>
			  <td width="15%" class="left">銀行賣出匯率</td>
			  <td width="15%" class="left">報關買進匯率</td>
			  <td width="15%" class="left">報閞賣出匯率</td>
			  		
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
	<!-- 合計     -->
		     <tr>
				<!-- enter 鍵不會跳下一列       -->
				<td ><input type='text' readonly="value" name='ta999'   value=""  style="display:none" /></td>	
              </tr>
			  <br><span>&nbsp;</span>
		<!-- 合計     -->	
	
	 <!--<div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
 <?php include("./application/views/fun/cmsi06_funjs_v.php"); ?>