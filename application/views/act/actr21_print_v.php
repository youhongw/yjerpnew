<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 損 益 表 - 列印明細表　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#vdate').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button style= "cursor:pointer" form="commentForm" onfocus="$('#vdate').focus();" type='submit' accesskey="l" class="button" name='action' value='excel'>excel檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>&nbsp;&nbsp;
		  <?PHP } ?>
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/act/actr21/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  if (!$this->input->post('vdate')) {$vdate=date("Y/m");}
	    $vdate='';
	  $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 class="date-picker"-->
      <tr>
	    <td class="normal14y" width="12%">選擇損益表年月：</td>
	    <td class="normal14" width="88%"><input tabIndex="3" id="vdate" onclick="fPopCalendar(event,this,this)" class="date-picker" onChange="dateformat_ym(this)"  onKeyPress="keyFunction()"    type="text" name="vdate"  value="<?php echo $vdate; ?>"  size="16" style="background-color:#E7EFEF" /></td>
        
	  </tr>
	  
	
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(直式)</option>
		  </select></td> 
        <td class="normal14" ></td>		  
		 <td class="normal14" ></td>		 
	  </tr>	
	 
    </table>
	
	  <!--  <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
		  <button type='submit' accesskey="l" class="button" name='action' value='excel'>excel檔Alt+l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></button>
		  <?PHP } ?>
		  <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
		
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
<?php // include("./application/views/fun/actb04_funjs_v.php"); ?>
<?php // include("./application/views/fun/report_funjs_v.php"); ?> 