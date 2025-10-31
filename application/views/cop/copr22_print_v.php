<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 貨運地址列印 - 列印　　　</h1>
    　<div style="float:left;padding-top: 5px; ">
	　<button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/104'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copr22/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($ma001)) { $ma001=''; } else {  $ma001=$this->input->post('ma001'); }
	  if(!isset($copq01adisp)) { $copq01adisp=''; } else {  $copq01adisp=$this->input->post('copq01adisp'); }
	  if(!isset($count)) { $count=''; } else {  $count=$this->input->post('count'); }
	 
	  $tc009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="15%">選擇客戶代號：</td>
	    <td class="normal14a" width="35%"><input tabIndex="1" id="ma001" onKeyPress="keyFunction()" type="text" name="ma001"  value="<?php echo $ma001; ?>"  size="20" /><a href="javascript:;"><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
		 <span id="copq01adisp"> <?php echo $copq01adisp; ?> </span></td>
	    <td class="start14a" width="15%"></td>
	    <td class="normal14a" width="35%"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >送貨件數：</td>
	    <td class="normal14" ><input tabIndex="3" id="count" onKeyPress="keyFunction()" type="text" name="count"  value="<?php echo "1"; ?>"  size="20" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z">選擇列印紙張：</td>
	    <td class="normal14"><select id="tc009p" onKeyPress="keyFunction()" name="tc009p"  tabIndex="5">
            <option <?php if($tc009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tc009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td>
        <td class="start14"></td>
	    <td class="normal14"></td>
	  </tr>
    </table>
	
	   <!-- <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/104'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include_once("./application/views/fun/report_funjs_v.php"); ?>
<?php include_once("./application/views/fun/copr22_funjs_v.php"); ?>