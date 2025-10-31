<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">    <!-- div-3 -->
  <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄性質設定(營業日報成本) - 新增</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ajs/ajsi22/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mb001='23';
	  if(!isset($invq04a)) { $invq04a=$this->input->post('invq04a'); }
	  if(!isset($acrq0163disp)) { $invq04adisp=$this->input->post('invq04a'); }
	  if(!isset($actq02a)) { $actq02a=$this->input->post('actq02a'); }
	  if(!isset($actq02adisp)) { $actq02adisp=$this->input->post('actq02a'); }
	  
	  if(!isset($ajsi31)) { $ajsi31=$this->input->post('ajsi31'); }
	  if(!isset($ajsi31disp)) { $ajsi31disp=$this->input->post('ajsi31disp'); }
	  if(!isset($ajsi31a)) { $ajsi31a=$this->input->post('ajsi31a'); }
	  if(!isset($ajsi31adisp)) { $ajsi31adisp=$this->input->post('ajsi31adisp'); }
	  
	  if(!isset($acti03)) { $acti03=$this->input->post('acti03'); }
	  if(!isset($acti03disp)) { $acti03disp=$this->input->post('acti03'); }
	  if(!isset($acti03a)) { $acti03a=$this->input->post('acti03a'); }
	  if(!isset($acti03adisp)) { $acti03adisp=$this->input->post('acti03a'); }
	   if(!isset($acti03b)) { $acti03b=$this->input->post('acti03b'); }
	  if(!isset($acti03bdisp)) { $acti03bdisp=$this->input->post('acti03b'); }
	  $mb002=$this->input->post('mb002');
	  $mb003=$this->input->post('mb003');
	  $mb004=$this->input->post('mb004');
	  $mb005=$this->input->post('mb005');
	  $mb006=$this->input->post('mb006');
	  $mb006disp=$this->input->post('mb006disp');
	  $mb007=$this->input->post('mb007');
	  $mb007disp=$this->input->post('mb007disp');
	  $mb013=$this->input->post('mb013');
	  $mb012=$this->input->post('mb012');
	  $mb012disp=$this->input->post('mb012disp');
	  $mb018=$this->input->post('mb018');
	  $mb019=$this->input->post('mb019');
	  $mb021=$this->input->post('mb021');
	  $mb022=$this->input->post('mb022');
	  $mb020='1';
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a"  width="14%" ><span class="required">營業日報成本性質代號：</span> </td>
        <td class="normal14"  width="86%"><input type="text"  tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mb001" value="<?php echo $mb001; ?>"   required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14" >營業日報成本單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="invq04a"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startinvq04a(this)"  name="invq04a" value="<?php echo strtoupper($invq04a); ?>"  type="text" required />
		<a href="javascript:;"><img id="Showinvq04a" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq04adisp"> <?php    echo $invq04adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14" >傳票單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="mb003"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startactq02a(this)"  name="actq02a" value="<?php echo strtoupper($actq02a); ?>"  type="text" required />
		<a href="javascript:;"><img id="Showactq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="actq02adisp"> <?php    echo $actq02adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td  class="normal14" >底稿開立方式：</td>
        <td  class="normal14" ><input type="radio" name="mb004" <?php if (isset($mb004) && $mb004=="1") echo "checked";?> value="1" />逐張  &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="mb004" <?php if (isset($mb004) && $mb004=="2") echo "checked";?> value="2" />彙總
        </td>
	  </tr>	
	 <tr>
	    <td  class="normal14" >同單號科目彙總：</td>
        <td  class="normal14" ><input type="hidden" name="mb021" value="N" />
		<input tabIndex="12" type="checkbox"  id="mb021" onKeyPress="keyFunction()"   name="mb021" <?php if($mb021 == 'Y' ) echo 'checked'; ?>  <?php if($mb021 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
	  
	   <tr>
	    <td class="normal14" >借方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31" class="mb018" onKeyPress="keyFunction()" name="ajsi31"  onchange="check_ajsi31(this)"  value="<?php echo  $ajsi31; ?>"     size="12"    />
		 <a href="javascript:;"><img id="Showajsi31disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31disp"><?php  echo $ajsi31disp; ?></span></td> 
	  </tr>
	   <tr>
	    <td class="normal14" >貸方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31a" class="mb022" onKeyPress="keyFunction()" name="ajsi31a"  onchange="check_ajsi31a(this)"  value="<?php echo  $ajsi31a; ?>"     size="12"    />
		 <a href="javascript:;"><img id="Showajsi31adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31adisp"><?php  echo $ajsi31adisp; ?></span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >借方會計科目(銷貨)：</td>		
        <td class="normal14"  >
			<input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $mb006; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $mb006disp; ?> </span>
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >貸方會計科目(存貨)：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $mb007; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $mb007disp; ?> </span>
		</td>
	  </tr>	
	  	
	  <tr>
	    <td class="start14a"   ><span class="required">分錄類別：</span> </td>
        <td class="normal14" ><input type="text"  tabIndex="1" id="mb020" onKeyPress="keyFunction()"  name="mb020" value="<?php echo $mb020; ?>"  readonly="readonly"  />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	</table>
	   		  
	<div class="buttons">
	  <button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi22/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
    </form>
	
    </div>  <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>   <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
 <?php  include_once("./application/views/fun/ajsi22_funjs_v.php"); ?> 
 <?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 存貨科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 借方科目 -->
<?php  include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 貸方科目 -->
<?php  include_once("./application/views/funnew/acti03c_funmjs_v.php"); ?>  <!-- 貸方科目 -->
 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/ajsi31_funmjs_v.php"); ?> <!-- 摘要來源 -->
  <?php  include_once("./application/views/funnew/ajsi31a_funmjs_v.php"); ?> <!-- 摘要來源 -->
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#mb001').focus();
	}); 	   
</script> 	    	