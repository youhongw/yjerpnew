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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應收票據票況表 - 列印明細表　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/110'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    
	</div>
	</div>
	<div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/notr06/printa"  method="post"  enctype="multipart/form-data" > 
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
	  $acrq01a63=$this->input->post('acrq01a63');
	  $acrq01a63disp=$this->input->post('acrq01a63disp');
	  $tc009p='1';
	  if (!isset($tc200)) {$tc200='Y';} else {$tc200=$this->input->post('tc200');}
	  $tc201=$this->input->post('tc201');
	  $tc202=$this->input->post('tc202');
	  $tc203=$this->input->post('tc203');
	  $tc204=$this->input->post('tc204');
	  $tc205=$this->input->post('tc205');
	  $tc206=$this->input->post('tc206');
	  $tc207=$this->input->post('tc207');
	  $tc208=$this->input->post('tc208');
	  $tc209=$this->input->post('tc209');
	  
	?>
       
	<table class="form14">   <!-- 表格 -->
      <tr>
	    <td class="normal14y" width="14%">選擇當時票況：</td>
	    <td class="normal14a" width="86%">
                 <input type="hidden" name="tc200" class="tc200"  value="N" />
				<input type="checkbox" name="tc200" class="tc200"  <?php if($tc200 == 'Y' ) echo 'checked'; ?>  <?php if($tc200 !== 'Y' ) echo 'check'; ?> value="Y"   />
				收票
			    <input type="hidden" name="tc201" class="tc201"  value="N" />
                <input type="checkbox" name="tc201" class="tc201"  <?php if($tc201 == 'Y' ) echo 'checked'; ?>  <?php if($tc201 !== 'Y' ) echo 'check'; ?> value="Y"   /> 
				託收
				
				<input type="hidden" name="tc202" class="tc202"  value="N" />
                <input type="checkbox" name="tc202" <?php if($tc202 == 'Y' ) echo 'checked'; ?>  <?php if($tc202 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
				　撤票
				<input type="hidden" name="tc203" value="N" />				
                <input type="checkbox" name="tc203" <?php if($tc203 == 'Y' ) echo 'checked'; ?>  <?php if($tc203 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
				　融資
				<input type="hidden" name="tc204" value="N" />
                <input type="checkbox" name="tc204" <?php if($tc204 == 'Y' ) echo 'checked'; ?>  <?php if($tc204 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　轉付
				<input type="hidden" name="tc205" value="N" />
                <input type="checkbox" name="tc205" <?php if($tc205 == 'Y' ) echo 'checked'; ?>  <?php if($tc205 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　退票
				<input type="hidden" name="tc206" value="N" />				
                <input type="checkbox" name="tc206" <?php if($tc206 == 'Y' ) echo 'checked'; ?>  <?php if($tc206 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　兌現
				<input type="hidden" name="tc207" value="N" />				
                <input type="checkbox" name="tc207" <?php if($tc207 == 'Y' ) echo 'checked'; ?>  <?php if($tc207 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　還票
				<input type="hidden" name="tc208" value="N" />
			    <input type="checkbox" name="tc208" <?php if($tc208 == 'Y' ) echo 'checked'; ?>  <?php if($tc208 !== 'Y' ) echo 'check'; ?> value="Y"  /> 
                　呆帳
							
	   </td>
	  </tr>
	   <tr>
	    <td class="normal14z" >截止異動日期：</td>
	    <td class="normal14a" ><input tabIndex="1" id="dateo" ondblclick="scwShow(this,event);" onChange="dateformat_ym(this);" onKeyPress="keyFunction()" type="text" name="dateo"  value="<?php echo $dateo; ?>"  size="20" style="background-color:#E7EFEF" />
        <img  onclick="scwShow(dateo,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="normal14z" >選擇託收銀行：</td>
	    <td class="normal14a"><input tabIndex="3" id="noti01a" onKeyPress="keyFunction()"  onchange="check_noti01a(this)" name="noti01a" value="<?php echo $tc001o; ?>" size="12" type="text"  />
			<a href="javascript:;"><img id="Shownoti01adisp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
		    <span id="noti01adisp1">  </span>
		</td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇票據種類：</td>
	    <td class="normal14a"><input tabIndex="1" id="tc001c"   onKeyPress="keyFunction()" type="text" name="tc001c"  value="<?php echo $tc001c; ?>"  size="20"  /></td>
      
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇幣別：</td>
	    <td class="normal14a"><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi06"  name="cmsi06"  onblur="check_cmsi06(this)"    value="<?php echo  $tc002o; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
	      <span id="cmsi06disp" >  </span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇收款單別：</td>
	    <td class="normal14a"><input tabIndex="1" id="tc002c"    onKeyPress="keyFunction()"  onChange="startacrq01a63(this)"  name="acrq01a63" value="<?php echo $tc002c; ?>"  type="text"  />
		<a href="javascript:;"><img id="Showacrq01a63" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acrq01a63disp"> <?php    echo $acrq01a63disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >選擇部門代號：</td>
	    <td class="normal14a"><input type="text" tabIndex="10" onKeyPress="keyFunction()" id="cmsi05"  name="cmsi05"  onblur="check_cmsi05(this)"    value="<?php echo  $tc003o; ?>"   size="12"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" >  </span></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇傳票拋轉狀態：</td>
	    <td class="normal14a"><select id="tc003c" onKeyPress="keyFunction()" name="tc003c"  tabIndex="4">
            <option <?php if($tc003c == '0') echo 'selected="selected"';?> value='0'>0.全部</option>  
            <option <?php if($tc003c == '1') echo 'selected="selected"';?> value='1'>0.已拋轉</option> 			
		    <option <?php if($tc003c == '2') echo 'selected="selected"';?> value='2'>1.未拋轉</option>
		  </select></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >選擇列印紙張：</td>
	    <td class="normal14" ><select id="tc009p" onKeyPress="keyFunction()" name="tc009p"  tabIndex="4">
            <option <?php if($tc009p == '1') echo 'selected="selected"';?> value='1'>1.A4(直式)</option>                                                                        
		    <option <?php if($tc009p == '2') echo 'selected="selected"';?> value='2'>2.Letter(直式)</option>
		  </select></td>
        
	  </tr>	
	  
    </table>
	
	  <!--  <div class="buttons">
	      <button  type='submit' tabIndex="98" accesskey="p" name='submit' class="button"   target="_new" value='&nbsp;列印F8&nbsp;'><span>列 印Alt+p</span><img src="<?php echo base_url()?>assets/image/png/print.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	      <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()"  id='cancel' name='cancel' href="<?php echo site_url('main/index/110'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php include_once("./application/views/fun/acri03_funjs_v.php"); ?>   <!-- 收款單別開視窗 --> 
<?php  include_once("./application/views/funnew/noti01a_funmjs_v.php"); ?>  <!-- 銀行帳戶 -->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?>  <!-- 部門開視窗 --> 
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別開視窗 --> 