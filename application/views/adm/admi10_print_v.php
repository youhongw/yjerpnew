<div id="container">  <!-- div-1 -->
  <div id="header">  <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div> -->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>  
    </div>
	
<div id="content">  <!-- div-3 -->
 <div class="box">
    <div class="heading">  <!-- div-4 -->
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者資料建立作業 - 列印明細表　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#find003').focus();" type='submit'  accesskey="p" name='submit'  class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp; 
	    <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mf001c').focus();" type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;
		  <?PHP } ?>		  
		<a  accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('adm/admi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/adm/admi10/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
  	  $mf001c=$this->input->post('mf001c');
	  $mf002c=$this->input->post('mf002c');
	  $mf002c=$this->input->post('mf002c');
	  $singing1=$this->session->userdata('singing1');
	  $singing2=$this->session->userdata('singing2');
	  $tg009p='1'; 
	?>
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">起使用者代號：</td>
        <td class="normal14a" width="89%">
	      <input tabIndex="1" id="mf001c" onKeyPress="keyFunction()" type="text" name="mf001c"  value="<?php echo $mf001c; ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >迄使用者代號：</td>
        <td class="normal14" >
	      <input tabIndex="2" id="mf002c" onKeyPress="keyFunction()" type="text" name="mf002c"  value="<?php echo $mf002c; ?>"   minlength="1" required /></td>
	  </tr>
	  
	    <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="3">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.A4(橫式)</option>
		  </select></td>
		</tr>
		
		 <tr>
	    <td class="normal14z" >簽核(直式)：</td>
        <td class="normal14"  >
	      <input tabIndex="4" id="singing1" onKeyPress="keyFunction()" type="text" name="singing1"  value="<?php echo $singing1; ?>"  size="120" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >簽核(橫式)：</td>
        <td class="normal14"  >
	      <input tabIndex="5" id="singing2" onKeyPress="keyFunction()" type="text" name="singing2"  value="<?php echo $singing2; ?>"  size="120"   /></td>
	  </tr>
    </table>
	
	  <!--  <div class="buttons">
	    <button type='submit'  accesskey="p" name='submit'  class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; 
	    <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>
		  <?PHP } ?>		  
		<a  accesskey="x"  onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('adm/admi10/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div> -->
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div>  <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->