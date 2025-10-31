<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>
	
<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產分佈清冊 - 列印明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/astr02/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  
	  if(!isset($dateo)) { $dateo=''; }
	  if(!isset($datec)) { $datec=''; }
	  
	  $date=date("Y/m/d");
	
	   if(!isset($cmsi11)) { $cmsi11=''; } else {  $cmsi11=$this->input->post('cmsi11'); }
	   if(!isset($cmsi11disp)) { $cmsi11disp=''; } else {  $cmsi11disp=$this->input->post('cmsi11disp'); }
	   
	  $tc001o=$this->input->post('tc001o');
	  $tc001c=$this->input->post('tc001c');
	  $tc002o=$this->input->post('tc002o');
	  $tc002c=$this->input->post('tc002c');
	  $tc003o=$this->input->post('tc003o');
	  $tc003c=$this->input->post('tc003c');
	  $tc009p='1';
	  
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14a" width="10%">資產類別：</td>
	    <td class="normal14a" width="90%"><input tabIndex="1" id="asti01" onKeyPress="keyFunction()"  onchange="check_asti01(this)" name="tc001o" value="<?php echo $tc001o; ?>"  type="text" style="background-color:#FFFFE4" required  />
		<a href="javascript:;"><img id="Showasti01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti01disp">  </span></td>
	  </tr>
	  <tr>
	    <td class="start14a" >起資產編號：</td>
	    <td class="normal14a"><input tabIndex="2" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this)" name="tc002o" value="<?php echo $tc002o; ?>"  type="text"  />
		  <a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="asti02disp"> </span></td>
	  </tr>
	   <tr>
	    <td class="start14a" >迄資產編號：</td>
	    <td class="normal14a"><input tabIndex="3" id="asti02a" onKeyPress="keyFunction()"  onchange="check_asti02a(this)" name="tc002c" value="<?php echo $tc002c; ?>"  type="text"  />
		  <a href="javascript:;"><img id="Showasti02adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="asti02adisp"> </span></td>
	  </tr>
	   <tr>
	    <td class="start14a" >起始部門：</td>
	    <td class="normal14a" ><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="tc003o"  onblur="check_cmsi05(this)"    value="<?php echo  $tc003o; ?>"     />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" >  </span></td>
	  </tr>
	  <tr>
	    <td class="start14a" >截止部門：</td>
	    <td class="normal14a"><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05a"  name="tc003c"  onblur="check_cmsi05a(this)"    value="<?php echo  $tc003c; ?>"      />
	      <a href="javascript:;"><img id="Showcmsi05adisp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05adisp" >  </span></td>
	  </tr>
	   
	  
	  
	   <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tc009p" onKeyPress="keyFunction()" name="tc009p"  tabIndex="4">
            <option <?php if($tc009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($tc009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(直式)</option>
		  </select></td>
        
	  </tr>	
	  
    </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/141'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>
		
       </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,日期欄位按2下可開萬年曆選擇日期,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php //  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?>  <!-- 開視窗 -->
<?php  include_once("./application/views/funnew/asti01_funmjs_v.php"); ?>  <!-- 類別 -->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?>  <!-- 資產編號 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 --> 