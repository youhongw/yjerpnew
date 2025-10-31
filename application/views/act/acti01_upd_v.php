 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 會計參數設定作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mc001').focus();" tabIndex="8" type='submit'  name='submit' accesskey="s" class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/act/acti01/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php  $mc001c[]=$row->mc001;?>
          <?php  $mc002c[]=$row->mc002;?>
          <?php  $mc003c[]=$row->mc003;?>
          <?php  $mc004c[]=$row->mc004;?>
          <?php  $mc005c[]=$row->mc005;?>
		  <?php  $mc005cdisp[]=$row->mc005disp;?>
          <?php  $mc006c[]=$row->mc006;?>
		   <?php  $mc006cdisp[]=$row->mc006disp;?>
		  <?php  $mc007c[]=$row->mc007;?>
		  <?php  $mc008c[]=$row->mc008;?>
		  
		  <?php  $companyc[]=$row->company;?>
		  <?php  $creatorc[]=$row->creator;?>
		  <?php  $usr_groupc[]=$row->usr_group;?>
		  <?php  $create_datec[]=$row->create_date;?>
		  <?php  $modifierc[]=$row->modifier;?>
		  <?php  $modi_datec[]=$row->modi_date;?>
          <?php  $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $mc001=$mc001c[0];?>
	 <?php $mc002=$mc002c[0];?>
	 <?php $mc003=$mc003c[0];?>
	 <?php $mc004=$mc004c[0];?>
	 <?php $actq03a1=$mc005c[0];?>
	  <?php $actq03a1disp=$mc005cdisp[0];?>
	 <?php $actq03a2=$mc006c[0];?>
	  <?php $actq03a2disp=$mc006cdisp[0];?>
	 <?php $mc007=$mc007c[0];?>
	 <?php $mc008=$mc008c[0];?>
	
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td align="left" class="normal14y"  width="12%"><span class="required">借貸平衡：</span></td>
        <td align="left" class="normal14a"  width="38%"><input tabIndex="1" id="mc001" onKeyPress="keyFunction()" type="text" name="mc001"  value="<?php echo $mc001; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14a"  width="12%"></td>
        <td align="left" class="normal14a"  width="38%"></td>
		
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >本期損益科目：</td>
        <td align="left" class="normal14" ><input tabIndex="2" id="mc005" onKeyPress="keyFunction()" name="actq03a1" onchange="startactq03a1(this)"   value="<?php echo  $actq03a1; ?>"     type="text"  /><img id="Showactq03a1" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a1disp"> <?php   echo $actq03a1disp; ?> </span></td>
	    <td align="left" class="normal14z" >上期損益科目：</td>
        <td align="left" class="normal14" ><input tabIndex="3" id="mc006" onKeyPress="keyFunction()" name="actq03a2" onchange="startactq03a2(this)"   value="<?php echo  $actq03a2; ?>"     type="text"  /><img id="Showactq03a2" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="actq03a2disp"> <?php    echo $actq03a2disp; ?> </span></td>
		
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >輸入總號：</td>
        <td align="left" class="normal14" ><input type="radio" tabIndex="4" name="mc002" <?php if (isset($mc002) && $mc002=="Y") echo "checked";?> value="Y" />必須輸入&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="5" name="mc002" <?php if (isset($mc002) && $mc002=="2") echo "checked";?> value="N" />不須輸入
        </td>
	    <td align="left" class="normal14z" >傳票列印排列：</td>
        <td align="left" class="normal14" ><input type="radio" tabIndex="6" name="mc003" <?php if (isset($mc003) && $mc003=="Y") echo "checked";?> value="Y" />依輸入順序排列&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="7" name="mc003" <?php if (isset($mc003) && $mc003=="N") echo "checked";?> value="N" />依輸入借貸排列
        </td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >建立日期：</td>
        <td align="left" class="normal14" ><input tabIndex="8" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker1" onKeyPress="keyFunction()" type="text" name="create_date"    value="<?php echo $create_date; ?>"  style="background-color:#E7EFEF" /></td>
	    <td align="left" class="normal14z" >修改者代號：</td>
        <td align="left" class="normal14" ><input tabIndex="9" id="modifier" onKeyPress="keyFunction()"  type="text" name="modifier"   value="<?php echo $modifier; ?>"  /></td>
        
	  </tr>
	    <td align="left" class="normal14" ><input  type="hidden" tabIndex="10" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker2"  class="modi_date"    name="modi_date"   value="<?php echo $modi_date; ?>" style="background-color:#E7EFEF" /></td>
    </table>
		
	 <!-- <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
  <?php include("./application/views/fun/acti01_funjs_v.php"); ?>