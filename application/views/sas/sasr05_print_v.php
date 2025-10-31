<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶分類統計表 - 列印明細表　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button  style= "cursor:pointer" form="commentForm" onfocus="$('#copq01a').focus();" type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/123'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/sas/sasr05/printa"  method="post"  enctype="multipart/form-data" > 
	<!--<div id="htabs" class="htabs14"><span>列印項目-明細表</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
  	  
	  if(!isset($copq01a)) { $copq01a=''; } else {  $copq01a=$this->input->post('copq01a'); }
	  if(!isset($copq01adisp)) { $copq01adisp=''; } else {  $copq01adisp=$this->input->post('copq01adisp'); }
	  if(!isset($copq01a1)) { $copq01a1='zzzzz'; } else {  $copq01a1=$this->input->post('copq01a1'); }
	  if(!isset($copq01a1disp)) { $copq01a1disp=''; } else {  $copq01a1disp=$this->input->post('copq01a1disp'); }
	  
	  if(!isset($dateo)) { $dateo=''; }
	  if(!isset($datec)) { $datec=''; }
	  if(!isset($dateo1)) { $dateo1=''; }
	  if(!isset($datec1)) { $datec1=date("Y/m/d"); }
	 
	  if(!isset($cmsq09a3)) { $cmsq09a3=''; } else {  $cmsq09a3=$this->input->post('cmsq09a3'); }
	  if(!isset($cmsq09a3disp)) { $cmsq09a3disp=''; } else {  $cmsq09a3disp=$this->input->post('cmsq09a3disp'); }
	  if(!isset($cmsq09a31)) { $cmsq09a31='zzzzzzzz'; } else {  $cmsq09a31=$this->input->post('cmsq09a31'); }
	  if(!isset($cmsq09a31disp)) { $cmsq09a31disp=''; } else {  $cmsq09a31disp=$this->input->post('cmsq09a31disp'); }
	   
	  if(!isset($th004)) { $th004=''; } else {  $th004=$this->input->post('th004'); }
	  if(!isset($th0041)) { $th0041='zzzzzzzzz'; } else {  $th0041=$this->input->post('th0041'); }
	  
	  if(!isset($tc002)) { $tc002=''; } else {  $tc002=$this->input->post('tc002'); }
	  if(!isset($tc0021)) { $tc0021='zzzzzzzzz'; } else {  $tc0021=$this->input->post('tc0021'); }
	  
	  
	  if(!isset($td016)) { $td016='N'; }  else {  $td016=$this->input->post('td016'); }
	  $tg009p='1';
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="11%">起始客戶代號：</td>
	    <td class="normal14" width="39%"><input tabIndex="1" id="copq01a" onKeyPress="keyFunction()"  onchange="startcopq01a(this)" name="copq01a" value="<?php echo $copq01a; ?>"  type="text"  /><img id="Showcopq01a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01adisp"> <?php   echo $copq01adisp; ?> </span></td>
        <td class="normal14y" width="11%">結束客戶代號：</td>
		<td class="normal14" width="39%"><input tabIndex="2" id="copq01a1" onKeyPress="keyFunction()"  onchange="startcopq01a1(this)" name="copq01a1" value="<?php echo $copq01a1; ?>"  type="text"  /><img id="Showcopq01a1" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
        <span id="copq01a1disp"> <?php   echo $copq01a1disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始銷貨日期：</td>
	    <td class="normal14" ><input tabIndex="3" id="dateo" ondblclick="scwShow(this,event);" onChange="dataymd(this)" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF"/></td>
        <td class="normal14z" >結束銷貨日期：</td>
	    <td class="normal14" ><input tabIndex="4" id="datec"  ondblclick="scwShow(this,event);" onChange="dataymd1(this)" onKeyPress="keyFunction()" type="text" name="datec"  value="<?php echo $datec; ?>"  size="20" style="background-color:#E7EFEF"/></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >起始業務員：</td>
	    <td class="normal14" ><input tabIndex="18" id="tg006" onKeyPress="keyFunction()" name="cmsq09a3" onchange="startcmsq09a3(this)"  value="<?php echo $cmsq09a3; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq09a3" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
        <td class="normal14z" >結束業務員：</td>
	    <td class="normal14" ><input tabIndex="18" id="tg0061" onKeyPress="keyFunction()" name="cmsq09a31" onchange="startcmsq09a31(this)"  value="<?php echo $cmsq09a31; ?>"  type="text"   /><a href="javascript:;"><img id="Showcmsq09a31" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
        <span id="cmsq09a31disp"> <?php    echo $cmsq09a31disp; ?> </span></td>
	  </tr>
	    <tr>
	    <td class="normal14z" >起始品號：</td>
	    <td class="normal14" ><input type="text" id="th004"   tabIndex="9"   onKeyPress="keyFunction()"    name="th004" value="<?php echo $th004; ?>"  /></td>
        
        <td class="normal14z" >結束品號：</td>
	    <td class="normal14" ><input type="text" id="th0041"   tabIndex="10"   onKeyPress="keyFunction()"    name="th0041" value="<?php echo $th0041; ?>"  /></td>
        
	  </tr>
	
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tg009p" onKeyPress="keyFunction()" name="tg009p"  tabIndex="12">
            <option <?php if($tg009p == '1') echo 'selected="selected"';?> value='1'>1.A4(橫式)</option>                                                                        
		    <option <?php if($tg009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(橫式)</option>
		  </select></td> 
        <td class="normal14" ></td>		  
		 <td class="normal14" ></td>		 
	  </tr>	
	  
    </table>
	
	  <!--  <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/123'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    </div>-->
		
       </form>
	    <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,日期欄位按2下可開萬年曆選擇日期,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php include_once("./application/views/fun/report_funjs_v.php"); ?> 