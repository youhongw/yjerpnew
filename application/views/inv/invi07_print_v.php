<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
   <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 成本調整單建立作業 - 列印明細表　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#tj001o').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button style= "cursor:pointer" form="commentForm" onfocus="$('#tj001o').focus();" type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;
		  <?PHP } ?>
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('inv/invi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi07/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  $tj001o=$this->input->post('tj001o');
	  $tj001c=$this->input->post('tj001c');
	  $tj002o=$this->input->post('tj002o');
	  $tj002c=$this->input->post('tj002c');
	   $singing1=$this->session->userdata('singing1');
	  $singing2=$this->session->userdata('singing2');
	  $tj009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="13%">起始開帳調整單別：</td>
	    <td class="normal14a" width="37%"><input tabIndex="1" id="tj001o" onKeyPress="keyFunction()" type="text" name="tj001o"  value="<?php echo $tj001o; ?>"  size="20" /></td>
        <td class="normal14y" width="13%">結束開帳調整單別：</td>
		<td class="normal14a" width="37%"><input tabIndex="2" id="tj001c" onKeyPress="keyFunction()" type="text" name="tj001c"  value="<?php echo $tj001c; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始開帳調整單號：</td>
	    <td class="normal14" ><input tabIndex="3" id="tj002o" onKeyPress="keyFunction()" type="text" name="tj002o"  value="<?php echo $tj002o; ?>"  size="20" /></td>
        <td class="normal14z" >結束開帳調整單號：</td>
	    <td class="normal14" ><input tabIndex="4" id="tj002c" onKeyPress="keyFunction()" type="text" name="tj002c"  value="<?php echo $tj002c; ?>"  size="20" /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tj009p" onKeyPress="keyFunction()" name="tj009p"  tabIndex="5">
            <option <?php if($tj009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tj009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>
        <td class="start14" >&nbsp;&nbsp;</td>
	    <td class="normal14" >&nbsp;&nbsp;</td>
	  </tr>	
	  <tr>
	    <td class="normal14a" >簽核(直式)：</td>
        <td class="normal14" colspan="3" >
	      <input tabIndex="4" id="singing1" onKeyPress="keyFunction()" type="text" name="singing1"  value="<?php echo $singing1; ?>"  size="120" /></td>
	    <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>
	   <tr>
	    <td class="normal14a" >簽核(橫式)：</td>
        <td class="normal14" colspan="3" >
	      <input tabIndex="5" id="singing2" onKeyPress="keyFunction()" type="text" name="singing2"  value="<?php echo $singing2; ?>"  size="120"   /></td>
	    <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>
    </table>
	
	   <!--  <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button type='submit' accesskey="l" class="button" name='action' value='excel'>轉EXCEL檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>
		  <?PHP } ?>
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('inv/invi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div> -->
		
       </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
  
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?> 