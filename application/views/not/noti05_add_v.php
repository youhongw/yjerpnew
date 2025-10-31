<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <!--<div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 預計收支建立作業 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#te001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti05/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $te001=$this->input->post('te001');
	  $te002=$this->input->post('te002');
	  $te003=1;
	  $te004=$this->input->post('te004');
	  $te005='NTD';
	  $te006=1;
	  $te007=$this->input->post('te007');
	  $te008=$this->input->post('te008');
	  $te009=$this->input->post('te009');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="11%" ><span class="required">預計收支代號：</span> </td>
        <td class="normal14a" width="39%" ><input   tabIndex="1" id="te001" onKeyPress="keyFunction()" onchange="startkey(this)" name="te001" value="<?php echo $te001; ?>"  type="text" />
	   <td class="normal14y" width="10%">幣別：</td>
        <td class="normal14a" width="40%"><input tabIndex="13" id="te005" onKeyPress="keyFunction()" name="te005" value="<?php echo $te005; ?>" />
		<a href="javascript:;"><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
		<span id="Showcmsq06a_str"></span></td>
		</tr>
	  
	 <tr>
	    <td class="normal14z" >預計日期：</td>
        <td class="normal14" ><input  tabIndex="3" id="te002" onKeyPress="keyFunction()" onclick="scwShow(this,event);" name="te002" value="<?php echo $te002; ?>" />
		 <img  onclick="scwShow(te002,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	     <td class="normal14z" >匯率：</td>
        <td class="normal14" ><input  tabIndex="4" id="te006" onKeyPress="keyFunction()"  name="te006" value="<?php echo $te006; ?>" />
	  
	  </tr>
	  <tr>
	    <td class="normal14z" >收支別：</td>
        <td class="normal14" ><input type="radio" name="te003" <?php if (isset($te003) && $te003=="1") echo "checked";?> value="1" />收入&nbsp;&nbsp;&nbsp; 
               <input type="radio" name="te003" <?php if (isset($te003) && $te003=="-1") echo "checked";?> value="-1" />支出
        </td>
	     <td class="normal14z" >金額：</td>
        <td class="normal14" ><input  tabIndex="6" id="te007" onKeyPress="keyFunction()"  name="te007" value="<?php echo $te007; ?>" />
	  
	  </tr>
	  <tr>
		<td class="normal14z" >銀行代號：</td>
		<td class="normal14" ><input tabIndex="7" id="te004" onchange="startnoti01a(this)" onKeyPress="keyFunction()" name="te004" value="<?php echo $te004; ?>"  />
		<a href="javascript:;"><img id="Shownoti01a" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top" /></span>
		<span id="Shownoti01a_str"></span><span id="te004_str1"></span></td>
		</td>
        <td class="normal14z" >備註：</td>
		<td class="normal14" ><input tabIndex="8" id="te008" onKeyPress="keyFunction()" name="te008" value="<?php echo $te008; ?>"   /></td>
        
	  </tr>
	   <td class="normal14z">實現：</td>		
        <td  class="normal14"  ><input type="hidden" name="te009" class="te009"  value="N" />
		  <input tabIndex="6" id="te009" onKeyPress="keyFunction()" name="te009" <?php if($te009 == 'Y' ) echo 'checked'; ?>  <?php if($te009 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
      <td class="normal14" ></td>
		<td class="normal14" ></td>
	
	</table>
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php  include_once("./application/views/fun/noti05_funjs_v.php"); ?>
 <?php // include_once("./application/views/funnew/noti01a_funmjs_v.php"); ?>  <!-- 銀行帳戶 -->
<?php // include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別開視窗 -->