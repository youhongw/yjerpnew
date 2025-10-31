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

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 信貸融資建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#me001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti14/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti14/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $me001=$this->input->post('me001');
	  $ma002=$this->input->post('ma002');
	  $me002=$this->input->post('me002');
	  $me003=$this->input->post('me003');
	  $me004=$this->input->post('me004');
	  $me005=$this->input->post('me005');
	  $me006=$this->input->post('me006');
	  $me007=$this->input->post('me007');
	  $me008=$this->input->post('me008');
	//  if(!isset($mf013)) { $mf013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 style="position: relative; top: 3px;"-->
	  <tr>
	    <td class="normal14y" width="10%" ><span class="required">信貸銀行：</span> </td>
        <td class="normal14a" width="40%" ><input tabIndex="1" id="me001" onKeyPress="keyFunction()" onchange="startnoti01a(this)" name="me001" value=""  type="text" />
		<a href="javascript:;"><img id="Shownoti01a" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top" /></a>
		<span id="Shownoti01a_str"></span></td>
		<td class="normal14y" width="10%" >授信生效日</td>
        <td class="normal14a" width="40%" ><input tabIndex="4" id="me004" onKeyPress="keyFunction()" onclick="scwShow(this,event);" name="me004" value="<?php echo date("Y/m/d");?>" /></td>
	  </tr>
	 <tr>
	    <td class="normal14z" >銀行名稱：</td>
        <td class="normal14" ><input tabIndex="3" id="ma002" onKeyPress="keyFunction()" name="ma002" style="background-color:#F0F0F0" />
		<td class="normal14z">授信到期日：</td>
        <td class="normal14"><input tabIndex="4" id="me005" onKeyPress="keyFunction()" onclick="scwShow(this,event);"  name="me005" value="<?php echo date("Y/m/d");?>" />
	  </tr>
	  
      <tr>
	    <td class="normal14z" >幣別：</td>
        <td class="normal14" ><input tabIndex="5" id="me002" onKeyPress="keyFunction()" onchange="startcmsi06a(this)" name="me002" />
		<a href="javascript:;"><img id="Showcmsi06a" src="<?php echo base_url()?>assets/image/png/currency.png" style="position: relative; top: 0px;" alt="" align="top" /></a>
		<span id="Showcmsi06a_str"></span></td>
		<td class="normal14z">綜合額度：</td>
        <td class="normal14"><input type="checkbox" tabIndex="6" onKeyPress="keyFunction()" id="me006" name="me006" onchange="check_enable();" /></td>
	  </tr>
	  <tr>
		<td class="normal14z" >匯率：</td>
        <td class="normal14" ><input tabIndex="7" id="me003" onKeyPress="keyFunction()" name="me003" /><!--<span><img src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span>-->
		<td class="normal14z" >額度：</td>
        <td class="normal14" ><input tabIndex="8" id="me007" onKeyPress="keyFunction()" name="me007" style="background-color:#F0F0F0" />
	  </tr>
	  <tr>
		<td class="normal14z">備註：</td>
        <td class="normal14" colspan="3" ><input size="100" tabIndex="9" id="me008" onKeyPress="keyFunction()"  name="me008" />
	  </tr>
	 
 </table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">融資種類</td>
              <td width="15%" class="left">融資名稱</td>
              <td width="15%" class="left">額度</td>	  		
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
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti14/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/noti14_funjs_v.php"); ?>