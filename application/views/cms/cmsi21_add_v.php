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

<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 付款條件資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#na001').focus();"  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi21/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi21/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $na001=$this->input->post('na001');
	  $na002=$this->input->post('na002');
	  $na003=$this->input->post('na003');
	  $na004=$this->input->post('na004');
	  $na005=$this->input->post('na005');
	  $na006=$this->input->post('na006');
	  $na007=$this->input->post('na007');
	  $na008=$this->input->post('na008');
	  $na009=$this->input->post('na009');
	  $na010=$this->input->post('na010');
	  $na011=$this->input->post('na011');
	  $na012=$this->input->post('na012');
	  $na013=$this->input->post('na013');
	  $na014=$this->input->post('na014');
	  $na015=$this->input->post('na015');
	  $na016=$this->input->post('na016');
	  $na017=$this->input->post('na017');
	  $na018=$this->input->post('na018');
	  $na019=$this->input->post('na019');
	  if (($na004!="1") && ($na004!="2") ) { $na004="1" ;}
	  if (($na008!="1") && ($na008!="2") ) { $na008="1" ;}
	  if (($na013!="1") && ($na013!="2") ) { $na013="1" ;}
	  if (($na012!="N") && ($na012!="Y") ) { $na012="N" ;}
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%"><span class="required">代號：</span> </td>
        <td class="normal14a"  width="38%"><input   tabIndex="1" id="na002" onKeyPress="keyFunction()" onchange="startkey(this)" name="na002" value="<?php echo $na002; ?>"  type="text" required />
	     <span id="keydisp" ></span></td>
		<td class="normal14y" width="11%"><span class="required">類別：</span></td>
        <td class="normal14a" width="39%" >
		  <select  tabIndex="2" id="na001" onKeyPress="keyFunction()"  name="na001" >
             <option <?php if($na001 == '1') echo 'selected="selected"';?> value='1'>1:採購/託外</option>                                                                        
		     <option <?php if($na001 == '2') echo 'selected="selected"';?> value='2'>2:銷售</option>
		  </select>
		  <span id="na001disp" ></span>
	    </td>
	  </tr>
	  <tr>
	    <td class="normal14z" >名稱：</td>
        <td class="normal14"  ><input  tabIndex="3" id="na003" onKeyPress="keyFunction()" name="na003"   value="<?php echo  $na003; ?>"    size="22" type="text"  /></td>
	    <td  class="normal14z">預計收付款日：</td>						
        <td  class="normal14"  ><input tabIndex="4" type="radio" name="na004" <?php if (isset($na004) && $na004=="1") echo "checked";?> value="1" />加日數  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="5" name="na004" <?php if (isset($na004) && $na004=="2") echo "checked";?> value="2" />加月數</td>
	  </tr>	
	  <tr>
	    <td  class="normal14z" >結帳後：</td>
        <td  class="normal14"  ><input   tabIndex="6" id="na005" onKeyPress="keyFunction()" name="na005"  value="<?php echo $na005; ?>"    type="text"  /></td>
	    <td class="normal14z">起算日：</td>						
        <td  class="normal14"  ><select  tabIndex="7" id="na019" onKeyPress="keyFunction()"  name="na019" >
             <option <?php if($na019 == '1') echo 'selected="selected"';?> value='1'>1:結帳日</option>                                                                        
		     <option <?php if($na019 == '2') echo 'selected="selected"';?> value='2'>2:次月初</option>
		  </select>
	  </tr>
	   <tr>
	    <td  class="normal14z" >結帳加：</td>
        <td  class="normal14"  ><input   tabIndex="8" id="na006" onKeyPress="keyFunction()" name="na006"  value="<?php echo $na006; ?>"     type="text"  /></td>
	    <td class="normal14z">個月後逢日：</td>						
        <td  class="normal14"  ><input  tabIndex="9" id="na007" onKeyPress="keyFunction()" name="na007"   value="<?php echo $na007; ?>"   type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14z"> 備註：</td>
        <td class="normal14" ><input  type="text" tabIndex="10" onKeyPress="keyFunction()" id="na017" name="na017" size="40" value="<?php echo $na017; ?>"   /></td>	
		<?php if($na016 == '0')  $na016="N";?> <?php if($na016 == '1')  $na016="Y";?></td>
	    <td  class="normal14z">資金實現日：</td>						
        <td  class="normal14"  ><input  type="radio" tabIndex="11" name="na008" <?php if (isset($na008) && $na008=="1") echo "checked";?> value="1" />加日數  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="12" name="na008" <?php if (isset($na008) && $na008=="2") echo "checked";?> value="2" />加月數</td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >付款後：</td>
        <td  class="normal14"  ><input   tabIndex="13" id="na009" onKeyPress="keyFunction()" name="na009"  value="<?php echo $na009; ?>"    type="text"  /></td>
	    <td class="normal14z">起算日：</td>						
        <td  class="normal14"  ><select  tabIndex="14" id="na018" onKeyPress="keyFunction()"  name="na018" >
             <option <?php if($na018 == '1') echo 'selected="selected"';?> value='1'>1:付款日</option>                                                                        
		     <option <?php if($na018 == '2') echo 'selected="selected"';?> value='2'>2:次月初</option>
		  </select>
	  </tr>
	   <tr>
	    <td  class="normal14z" >付款加：</td>
        <td  class="normal14"  ><input   tabIndex="15" id="na010" onKeyPress="keyFunction()" name="na010"  value="<?php echo $na010; ?>"     type="text"  /></td>
	    <td class="normal14z">個月後逢日：</td>						
        <td  class="normal14"  ><input  tabIndex="16" id="na011" onKeyPress="keyFunction()" name="na011"   value="<?php echo $na011; ?>"   type="text"  /></td>
	  </tr>
	  <tr>
	    <td  class="normal14z">取得折扣方式：</td>						
        <td  class="normal14"  ><input tabIndex="17" type="radio" name="na013" <?php if (isset($na013) && $na013=="1") echo "checked";?> value="1" />提前付款  &nbsp;&nbsp;&nbsp; 
          <input type="radio" tabIndex="15" name="na013" <?php if (isset($na013) && $na013=="2") echo "checked";?> value="2" />縮短票期</td>
	     <td class="normal14z"> 提早天數：</td>
        <td class="normal14" ><input  tabIndex="18" onKeyPress="keyFunction()" id="na014" name="na014"  value="<?php echo $na014; ?>"  type="text"  /></td>	
	  </tr>
       <tr>
	    <td  class="normal14z" >票期提早天兌現：</td>
        <td  class="normal14"  ><input   tabIndex="19" id="na015" onKeyPress="keyFunction()" name="na015"  value="<?php echo $na015; ?>"     type="text"  /></td>
	    <td class="normal14z">折扣％：</td>						
        <td  class="normal14"  ><input  tabIndex="20" id="na016" onKeyPress="keyFunction()" name="na016"   value="<?php echo $na016; ?>"  type="text"  /></td>
	  </tr>	  
	  <tr>
	    <td class="normal14z" >取得折扣：</td>
        <td class="normal14"  ><input type="hidden" name="na012" value="N" />
		<input type='checkbox' tabIndex="21" id="na012" onKeyPress="keyFunction()"  name="na012" <?php if($na012 == 'Y' ) echo 'checked';  ?>  <?php if($na012 != 'Y' ) echo 'check'; ?>  value="Y" size="1"  /></td>
		<?php if($na012 == '0')  $na012="N";?> <?php if($na012 == '1')  $na012="Y";?></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>
	   		  
	<!--<div class="buttons">
	<button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi21/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div>  <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div>  <!-- div-1 --> 
   <?php include("./application/views/fun/cmsi21_funjs_v.php"); ?>
  


 