 <div id="container">  <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php  echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php  echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php  echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php  echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box">  <!-- div-4 --> 
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄性質設定(付款單) - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#mb001').focus();" type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('ajs/ajsi12/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content">  <!-- div-5 --> 
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsi12/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>--> 
	<div id="tab-general">  <!-- div-6 --> 
	<?php  foreach($result as $row) { ?>
          <?php   $mb001=$row->mb001;?>
          <?php   $acpq01a73=$row->mb002;?>
		  <?php   $acpq01a73disp=$row->mb002disp;?>
		  <?php   $actq02a=$row->mb003;?>
          <?php   $actq02adisp=$row->mb003disp;?>
		  <?php   $mb004=$row->mb004;?>
		  <?php   $mb005=$row->mb005;?>
		  <?php   $mb021=$row->mb021;?>
		  <?php   $ajsi31=$row->mb018;?>
		  <?php   $ajsi31a=$row->mb022;?>
		  <?php   $ajsi31disp=$row->mb018;?>
		  <?php   $ajsi31adisp=$row->mb022;?>
		  
		  <?php   $mb006=$row->mb006;?>
		  <?php   $mb006disp=$row->mb006disp;?>
		  <?php   $mb007=$row->mb007;?>
		  <?php   $mb007disp=$row->mb007disp;?>
		  <?php   $mb012=$row->mb012;?>
		  <?php   $mb013=$row->mb013;?>
		  <?php   $mb012disp=$row->mb012disp;?>
		 <?php   $mb019=$row->mb019;?>
		 <?php   $mb020=$row->mb020;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
        
	  <tr>
	    <td class="normal14y"  width="12%" ><span class="required">付款單性質代號：</span> </td>
        <td class="normal14"  width="88%"><input type="text"  tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mb001" value="<?php echo $mb001; ?>"   required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >付款單單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="acpq01a73"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startacpq01a73(this)"  name="acpq01a73" value="<?php echo strtoupper($acpq01a73); ?>"  type="text" required />
		<a href="javascript:;"><img id="Showacpq01a73" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acpq01a73disp"> <?php    echo $acpq01a73disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >傳票單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="mb003"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startactq02a(this)"  name="actq02a" value="<?php echo strtoupper($actq02a); ?>"  type="text" required />
		<a href="javascript:;"><img id="Showactq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="actq02adisp"> <?php    echo $actq02adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >底稿開立方式：</td>
        <td  class="normal14" ><input type="radio" name="mb004" <?php if (isset($mb004) && $mb004=="1") echo "checked";?> value="1" />逐張  &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="mb004" <?php if (isset($mb004) && $mb004=="2") echo "checked";?> value="2" />彙總
        </td>
	  </tr>	
	 <tr>
	    <td  class="normal14z" >同單號科目彙總：</td>
        <td  class="normal14" ><input type="hidden" name="mb021" value="N" />
		<input tabIndex="12" type="checkbox"  id="mb021" onKeyPress="keyFunction()"   name="mb021" <?php if($mb021 == 'Y' ) echo 'checked'; ?>  <?php if($mb021 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
	  
	   <tr>
	    <td class="normal14z" >借方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31" class="mb018" onKeyPress="keyFunction()" name="ajsi31"  onchange="check_ajsi31(this)"  value="<?php echo  $ajsi31; ?>"     size="12"    />
		 <a href="javascript:;"><img id="Showajsi31disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31disp"><?php  echo $ajsi31disp; ?></span></td> 
	  </tr>
	   <tr>
	    <td class="normal14z" >貸方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31a" class="mb022" onKeyPress="keyFunction()" name="ajsi31a"  onchange="check_ajsi31a(this)"  value="<?php echo  $ajsi31a; ?>"     size="12"    />
		 <a href="javascript:;"><img id="Showajsi31adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31adisp"><?php  echo $ajsi31adisp; ?></span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z"   ><span class="required">分錄類別：</span> </td>
        <td class="normal14" ><input type="text"  tabIndex="1" id="mb020" onKeyPress="keyFunction()"  name="mb020" value="<?php echo $mb020; ?>"  readonly="readonly"  />
	        <span id="keydisp" ></span></td>
		
	  </tr>
    </table>
		
	<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	<!--<div class="buttons">
	   <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x"  onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('ajs/ajsi12/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>-->
	   
    </form>
	<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php  } ?>
   
    </div>  <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>     <!-- div-4 -->

    </div>  <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>   <!-- div-1 -->
 <?php  include_once("./application/views/fun/ajsi12_funjs_v.php"); ?> 
 <?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 存貨科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 借方科目 -->
<?php  include_once("./application/views/funnew/acti03b_funmjs_v.php"); ?>  <!-- 貸方科目 -->
 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/ajsi31_funmjs_v.php"); ?> <!-- 摘要來源 -->
  <?php  include_once("./application/views/funnew/ajsi31a_funmjs_v.php"); ?> <!-- 摘要來源 -->