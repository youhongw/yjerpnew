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
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銀行帳號建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti01/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $ma001=$this->input->post('ma001');
	  $ma011=$this->input->post('ma011');
	  $ma006=$this->input->post('ma006');
	  $ma004=$this->input->post('ma004');
	  $ma002=$this->input->post('ma002');
	  $ma012=$this->input->post('ma012');
	  $mf007=$this->input->post('mf007');
	//  if(!isset($mf013)) { $mf013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">銀行代號：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma001" value="<?php echo $ma001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="8%" >備償帳戶</td>
        <td class="normal14a" width="42%" ><input type="checkbox" tabIndex="2" onKeyPress="keyFunction()"  id="ma011" name="ma011" value="1" /></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >銀行行號：</td>
        <td class="normal14" ><input  tabIndex="3" id="ma006" onKeyPress="keyFunction()" onchange="startcmsi16a(this)" name="ma006" /><span><img id="Showcmsi16a" src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span><span id="Showcmsi16a_str"></span>
		<td class="normal14z">銀行帳號：</td>
        <td class="normal14"><input  tabIndex="4" id="ma004" onKeyPress="keyFunction()"  name="ma004" />
	  </tr>
	  
      <tr>
	    <td class="normal14z" >銀行簡稱：</td>
        <td class="normal14" ><input  tabIndex="5" id="ma002" onKeyPress="keyFunction()"  name="ma002" />
		<td class="normal14z">存款種類：</td>
        <td class="normal14">
		<select  tabIndex="6" id="ma012" onKeyPress="keyFunction()"  name="ma012" >
             <option <?php if($ma012 == '1') echo 'selected="selected"';?> value='1'>1:活存</option>                                                                        
		     <option <?php if($ma012 == '2') echo 'selected="selected"';?> value='2'>2:支存</option>
			 <option <?php if($ma012 == '3') echo 'selected="selected"';?> value='3'>3:其他</option> 
		  </select>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行全名：</td>
        <td class="normal14" ><input  tabIndex="7" id="ma003" onKeyPress="keyFunction()"  name="ma003" /><!--<span><img src="<?php echo base_url()?>assets/image/png/bank.png" style="position: relative; top: 3px;" /></span>-->
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >銀行存款科目：</td>
        <td class="normal14" ><input  tabIndex="8" id="ma005" onKeyPress="keyFunction()" onchange="startactq03a(this)" name="ma005" /><span><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/actno.png" style="position: relative; top: 3px;" /></span><span id="ma005_name" ></span>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  <tr>
		<td class="normal14z" >聯絡人：</td>
        <td class="normal14" ><input  tabIndex="9" id="ma007" onKeyPress="keyFunction()"  name="ma007" />
		<td class="normal14z">戶名：</td>
        <td class="normal14"><input  tabIndex="10" id="ma015" onKeyPress="keyFunction()"  name="ma015" />
	  </tr>
	  <tr>
		<td class="normal14z" >電話：</td>
        <td class="normal14" ><input  tabIndex="11" id="ma008" onKeyPress="keyFunction()"  name="ma008" />
		<td class="normal14z" >統編/身分證號：</td>
        <td class="normal14" ><input  tabIndex="12" id="ma016" onKeyPress="keyFunction()"  name="ma016" />
	  </tr>
	  <tr>
		<td class="normal14z" >FAX NO：</td>
        <td class="normal14" ><input  tabIndex="13" id="ma014" onKeyPress="keyFunction()"  name="ma014" />
		<td class="normal14z" >備註：</td>
        <td class="normal14" ><input  tabIndex="14" id="ma013" onKeyPress="keyFunction()"  name="ma013" />
	  </tr>
	  <tr>
	    <td  class="normal14z" >地址：</td>
        <td  class="normal14"  ><input type="text" tabIndex="15"  onKeyPress="keyFunction()" size="60"  id="ma009" name="ma009" value=""   /></td>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  	  <tr>
	    <td  class="normal14" > </td>
        <td  class="normal14"  ><input type="text" tabIndex="16"  onKeyPress="keyFunction()" size="60"  id="ma010" name="ma010" value=""   /></td>
		<td class="normal14" ></td>
        <td class="normal14" ></td>
	  </tr>
	  
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">幣別</td>
              <td width="15%" class="left">存款餘額</td>			  		
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
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti01/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/noti01_funjs_v.php"); ?>