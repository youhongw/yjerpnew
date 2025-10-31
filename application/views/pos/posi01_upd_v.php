 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> POS參數設定作業 - 修改　　　</h1>
   <div style="float:left;padding-top: 5px; ">
   <button style= "cursor:pointer" form="commentForm" onfocus="$('#mk001').focus();" tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/126'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  
   </div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pos/posi01/updsave" method="post" enctype="multipart/form-data" >
	
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php  $mk001c[]=$row->mk001;?>
          <?php  $mk002c[]=$row->mk002;?>
          <?php  $mk003c[]=$row->mk003;?>
          <?php  $mk004c[]=$row->mk004;?>
          <?php  $mk005c[]=$row->mk005;?>
          <?php  $mk006c[]=$row->mk006;?>
		  <?php  $mk007c[]=$row->mk007;?>
		  <?php  $mk008c[]=$row->mk008;?>
		  <?php  $mk009c[]=$row->mk009;?>
		  <?php  $mk010c[]=$row->mk010;?>
		  <?php  $mk011c[]=$row->mk011;?>
		  <?php  $mk012c[]=$row->mk012;?>
		  <?php  $mk013c[]=$row->mk013;?>
		  <?php  $mk014c[]=$row->mk014;?>
		  <?php  $mk015c[]=$row->mk015;?>
		  <?php  $mk016c[]=$row->mk016;?>
		  <?php  $mk017c[]=$row->mk017;?>
		  <?php  $mk018c[]=$row->mk018;?>
		  <?php  $mk019c[]=$row->mk019;?>
		  <?php  $mk020c[]=$row->mk020;?>
		  <?php  $mk021c[]=$row->mk021;?>
		  <?php  $mk022c[]=$row->mk022;?>
		  <?php  $mk023c[]=$row->mk023;?>
		  <?php  $mk024c[]=$row->mk024;?>
		  <?php  $companyc[]=$row->company;?>
		  <?php  $creatorc[]=$row->creator;?>
		  <?php  $usr_groupc[]=$row->usr_group;?>
		  <?php  $create_datec[]=$row->create_date;?>
		  <?php  $modifierc[]=$row->modifier;?>
		  <?php  $modi_datec[]=$row->modi_date;?>
          <?php  $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $mk001=$mk001c[0];?>
	 <?php $mk002=$mk002c[0];?>
	 <?php $mk003=$mk003c[0];?>
	 <?php $mk004=$mk004c[0];?>
	 <?php $mk005=$mk005c[0];?>
	 <?php $mk006=$mk006c[0];?>
	 <?php $mk007=$mk007c[0];?>
	 <?php $mk008=$mk008c[0];?>
	 <?php $mk009=$mk009c[0];?>
	 <?php $mk010=$mk010c[0];?>
	 <?php $mk011=$mk011c[0];?>
	 <?php $mk012=$mk012c[0];?>
	 <?php $mk013=$mk013c[0];?>
	 <?php $mk014=$mk014c[0];?>
	 <?php $mk015=$mk015c[0];?>
	 <?php $mk016=$mk016c[0];?>
	 <?php $mk017=$mk017c[0];?>
	 <?php $mk018=$mk018c[0];?>
	 <?php $mk019=$mk019c[0];?>
	 <?php $mk020=$mk020c[0];?>
	 <?php $mk021=$mk021c[0];?>
	 <?php $mk022=$mk022c[0];?>
	 <?php $mk023=$mk023c[0];?>
	 <?php $mk024=$mk024c[0];?>
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td align="left" class="normal14y"  width="9%"><span class="required">公司代號：</span></td>
        <td align="left" class="normal14a"  width="27%"><input tabIndex="1" id="mk001" onKeyPress="keyFunction()" type="text" name="mk001"  value="<?php echo $mk001; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14y"  width="10%">發票類別：</td>
        <td align="left" class="normal14a"  width="26%"><select id="mk020" onKeyPress="keyFunction()" name="mk020" " tabIndex="33">
		    <option <?php if($mk020 == '1') echo 'selected="selected"';?> value='1'>1.列印一般發票 </option>                                                                        
		    <option <?php if($mk020 == '2') echo 'selected="selected"';?> value='2'>2.列印無紙發票証明聯 </option>
            <option <?php if($mk020 == '3') echo 'selected="selected"';?> value='3'>3.不印發票 </option>	
		  </select></td>
		<td align="left"  class="normal14y"  width="11%">自動列印發票：</td>
        <td align="left" class="normal14a"  width="27%"><input type="hidden" name="mk021" class="mk021"  value="N" />
		  <input tabIndex="6" id="mk021" onKeyPress="keyFunction()" name="mk021" <?php if($mk021 == 'Y' ) echo 'checked'; ?>  <?php if($mk021 != 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  />
        </td>
	  </tr>
	   <tr>
	    <td align="left" class="normal14z" >門市代號：</td>
        <td align="left" class="normal14"  ><input tabIndex="1" id="mk022" onKeyPress="keyFunction()" type="text" name="mk022"  value="<?php echo $mk022; ?>"   /></td>
	    <td align="left" class="normal14z" ><span class="required"></span>門市簡稱：</td>
        <td align="left" class="normal14"  ><input tabIndex="2" id="mk002" onKeyPress="keyFunction()" type="text" name="mk002"  value="<?php echo $mk002; ?>"     /></td>
		<td align="left"  class="normal14z"  >門市全稱：</td>
        <td align="left" class="normal14" ><input  tabIndex="3" id="mk003" onKeyPress="keyFunction()" type="text" name="mk003"   value="<?php echo $mk003; ?>"  /></td>
	  </tr> 
	    <tr>
	    <td align="left" class="normal14z" >操作人員代號：</td>
        <td align="left" class="normal14"  ><input tabIndex="1" id="mk023" onKeyPress="keyFunction()" type="text" name="mk023"  value="<?php echo $mk023; ?>"   /></td>
	    <td align="left" class="normal14z" ><span class="required"></span>機台代號：</td>
        <td align="left" class="normal14"  ><input tabIndex="2" id="mk024" onKeyPress="keyFunction()" type="text" name="mk024"  value="<?php echo $mk024; ?>"     /></td>
		<td align="left"  class="normal14"  ></td>
        <td align="left" class="normal14" ></td>
	  </tr> 
	  <tr>
	    <td align="left" class="normal14z" >存放路徑：</td>
        <td align="left" class="normal14" ><input tabIndex="4" id="mk004" onKeyPress="keyFunction()" type="text" name="mk004"    value="<?php echo $mk004; ?>"   /></td>
	    <td align="left" class="normal14z" >電話：</td>
        <td align="left" class="normal14" ><input tabIndex="5" id="mk005" onKeyPress="keyFunction()"  type="text" name="mk005"   value="<?php echo $mk005; ?>"  /></td>
		<td align="left" class="normal14z" >傳真：</td>
        <td align="left" class="normal14" ><input tabIndex="6" id="mk006" onKeyPress="keyFunction()"  type="text" name="mk006"   value="<?php echo $mk006; ?>"  /></td>	
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >統一編號：</td>
        <td align="left" class="normal14" ><input tabIndex="7" id="mk007" onKeyPress="keyFunction()" type="text" name="mk007"    value="<?php echo $mk007; ?>"   /></td>
	    <td align="left" class="normal14z" >稅籍編號：</td>
        <td align="left" class="normal14" ><input tabIndex="8" id="mk008" onKeyPress="keyFunction()"  type="text" name="mk008"   value="<?php echo $mk008; ?>"  /></td>
		<td align="left" class="normal14z" >負責人：</td>
        <td align="left" class="normal14" ><input tabIndex="9" id="mk009" onKeyPress="keyFunction()"  type="text" name="mk009"   value="<?php echo $mk009; ?>"  /></td>
	  </tr>
	  
	 <tr>
	    <td align="left" class="normal14z" >E-MAIL：</td>
        <td align="left" class="normal14" ><input tabIndex="10" id="mk010" onKeyPress="keyFunction()" type="text" name="mk010" size="40"    value="<?php echo $mk010; ?>"   /></td>
	    <td align="left" class="normal14z" >備註：</td>
        <td align="left" class="normal14" ><input tabIndex="11" id="mk011" onKeyPress="keyFunction()"  type="text" name="mk011"   value="<?php echo $mk011; ?>"  /></td>
		<td align="left" class="normal14z" >地址一：</td>
        <td align="left" class="normal14"><input tabIndex="12" id="mk012" onKeyPress="keyFunction()"  type="text" name="mk012" size="40"  value="<?php echo $mk012; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >地址二：</td>
        <td align="left" class="normal14" ><input tabIndex="13" id="mk013" onKeyPress="keyFunction()" type="text" name="mk013"   size="40"   value="<?php echo $mk013; ?>"   /></td>
	    <td align="left" class="normal14z" >英文公司：</td>
        <td align="left" class="normal14" ><input tabIndex="14" id="mk014" onKeyPress="keyFunction()"  type="text" name="mk014"   value="<?php echo $mk014; ?>"  /></td>
		<td align="left" class="normal14z" >英地址1：</td>
        <td align="left" class="normal14" ><input tabIndex="15" id="mk015" onKeyPress="keyFunction()"  type="text" name="mk015"   size="40"  value="<?php echo $mk015; ?>"  /></td>
	  </tr>
	 
	   <tr>
	    <td align="left" class="normal14z" >英地址2：</td>
        <td align="left" class="normal14" ><input tabIndex="16" id="mk016" onKeyPress="keyFunction()" type="text" name="mk016"   size="40"   value="<?php echo $mk016; ?>"   /></td>
	    <td align="left" class="normal14z" >OLAP名稱：</td>
        <td align="left" class="normal14" ><input tabIndex="17" id="mk017" onKeyPress="keyFunction()"  type="text" name="mk017"   value="<?php echo $mk017; ?>"  /></td>
		<td align="left" class="normal14z" >銷售 Cube：</td>
        <td align="left" class="normal14" ><input tabIndex="18" id="mk018" onKeyPress="keyFunction()"  type="text" name="mk018"   value="<?php echo $mk018; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >Cube資訊：</td>
        <td align="left" class="normal14" ><input tabIndex="19" id="mk019" onKeyPress="keyFunction()" type="text" name="mk019"    value="<?php echo $mk019; ?>"   /></td>
	    <td align="left" class="normal14z" >英公司簡稱：</td>
        <td align="left" class="normal14" ><input tabIndex="20" id="company" onKeyPress="keyFunction()"  type="text" name="company"   value="<?php echo $company; ?>"  /></td>
		<td align="left" class="normal14z" >群組代號：</td>
        <td align="left" class="normal14" ><input tabIndex="21" id="usr_group" onKeyPress="keyFunction()"  type="text" name="usr_group"   value="<?php echo $usr_group; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >建立日期：</td>
        <td align="left" class="normal14" ><input tabIndex="22" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker1" onKeyPress="keyFunction()" type="text" name="create_date"    value="<?php echo $create_date; ?>"  style="background-color:#E7EFEF" /></td>
	    <td align="left" class="normal14z" >修改者代號：</td>
        <td align="left" class="normal14" ><input tabIndex="23" id="modifier" onKeyPress="keyFunction()"  type="text" name="modifier"   value="<?php echo $modifier; ?>"  /></td>
		<td align="left" class="normal14z" >修改日期：</td>
        <td align="left" class="normal14" ><input tabIndex="24" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker2"  class="modi_date"   type="text" name="modi_date"   value="<?php echo $modi_date; ?>" style="background-color:#E7EFEF" /></td>
	  </tr>
    </table>
		
	<!--  <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/126'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
	   
    </form>
	<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
</div>        <!-- div-4 -->

     </div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->