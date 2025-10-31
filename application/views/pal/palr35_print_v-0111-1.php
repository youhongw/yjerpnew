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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 銀行轉帳明細表 - 列印明細表</h1>
    </div>
	
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/palr35/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($copq01a)) { $copq01a=''; } else {  $copq01a=$this->input->post('copq01a'); }
	  if(!isset($copq01adisp)) { $copq01adisp=''; } else {  $copq01adisp=$this->input->post('copq01adisp'); }
	  if(!isset($copq01a1)) { $copq01a1='zz'; } else {  $copq01a1=$this->input->post('copq01a1'); }
	  if(!isset($copq01a1disp)) { $copq01a1disp=''; } else {  $copq01a1disp=$this->input->post('copq01a1disp'); }
	  $date=date("Y");
	  if(!isset($dateo)) { $dateo=$date; }
	  if(!isset($datec)) { $datec='1'; }
	  
	 
	
	   if(!isset($invq02a)) { $invq02a=''; } else {  $invq02a=$this->input->post('invq02a'); }
	   if(!isset($invq02adisp)) { $invq02adisp=''; } else {  $invq02adisp=$this->input->post('invq02adisp'); }
	    if(!isset($invq02a1)) { $invq02a1='zzzzzzzz'; } else {  $invq02a1=$this->input->post('invq02a1'); }
	   if(!isset($invq02a1disp)) { $invq02a1disp=''; } else {  $invq02a1disp=$this->input->post('invq02a1disp'); }
	  $yh009p='2';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="start14a" width="11%">年度：</td>
	    <td class="normal14a" width="39%"><input tabIndex="5" id="dateo" onfocus="this.select" onKeyPress="keyFunction()"  name="dateo" value="<?php echo $dateo; ?>"  type="text"  /></td>
        
	  </tr>
	  <tr>
	    <td class="start14" >列印公司別：</td>
	    <td class="normal14" ><input tabIndex="5" id="datec" onKeyPress="keyFunction()"  name="datec" value="<?php echo $datec; ?>"  type="text"  /><span>1.A公司 2.B公司 3.C公司</span></td>
       
	  
	   <tr>
	    <td class="normal14" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="yh009p" onKeyPress="keyFunction()" name="yh009p"  tabIndex="5">
            <option <?php if($yh009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($yh009p == '2') echo 'selected="selected"';?> value='2'>2.A4((橫式)</option>
		  </select></td>
        <td class="start14" ></td>
	    <td class="normal14" ></td>
	  </tr>	
	  
    </table>
	
	    <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/111'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include_once("./application/views/fun/report_funjs_v.php"); ?> 