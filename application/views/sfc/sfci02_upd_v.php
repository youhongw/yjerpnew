<div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製程參數設定作業 - -修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/sfc/sfci02/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");

	foreach($results[0] as $key=>$val){
		$$key = $val;
	}
	?>
	
	<?php
		if(!isset($ma001)) { $ma001=$this->input->post('ma001'); }
		if(!isset($ma002)) { $ma002=$this->input->post('ma002'); }
		if(!isset($ma003)) { $ma003=$this->input->post('ma003'); }
		if(!isset($ma004)) { $ma004=$this->input->post('ma004'); }
		if(!isset($ma005)) { $ma005=$this->input->post('ma005'); }
	?>
       
	
	<!--  基本參數 -->
	<div id="tab1" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	<tr>
	    <td class="normal14a" width="18%">生產工時蒐集依據：</td>
		<td class="normal14a"  width="82%"><input type="radio" name="ma001" <?php if (isset($ma001) && $ma001=="1") echo "checked";?> value="1" />報工單  &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="ma001" <?php if (isset($ma001) && $ma001=="2") echo "checked";?> value="2" />移轉單
        </td>
	</tr>
	<tr>	
		<td class="normal14a" >實際工時包含正常完成：</td>
        <td class="normal14a"  ><input type="hidden" name="ma002" value="N" />	
		  <input  type='checkbox' tabIndex="2" id="ma002" onKeyPress="keyFunction()" name="ma002" <?php if($ma002 == 'Y' ) echo 'checked'; ?>  <?php if($ma002 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
	</tr>
	<tr>	
		<td class="normal14a" >實際工時包含重工完成：</td>
        <td class="normal14a"  ><input type="hidden" name="ma003" value="N" />	
		  <input  type='checkbox' tabIndex="2" id="ma003" onKeyPress="keyFunction()" name="ma003" <?php if($ma003 == 'Y' ) echo 'checked'; ?>  <?php if($ma002 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
	</tr>
	<tr>	
		<td class="normal14a" >實際工時包含報廢：</td>
        <td class="normal14a"  ><input type="hidden" name="ma004" value="N" />	
		  <input  type='checkbox' tabIndex="2" id="ma004" onKeyPress="keyFunction()" name="ma004" <?php if($ma004 == 'Y' ) echo 'checked'; ?>  <?php if($ma004 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
	</tr>
	<tr>	
		<td class="normal14a" >報廢數量回饋製令報廢數量：</td>
        <td class="normal14a"  ><input type="hidden" name="ma005" value="N" />	
		  <input  type='checkbox' tabIndex="2" id="ma005" onKeyPress="keyFunction()" name="ma005" <?php if($ma005 == 'Y' ) echo 'checked'; ?>  <?php if($ma005 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
	</tr>
	
	</table>
	</div>

	</div><!-- div- 可儲存顯示 -->
		<input type="hidden" class="commpany" name="company" value="" />
	<div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/171'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	   
    </form>
    </div>    <!-- div-tab -->
 
 
 
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>

</div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->