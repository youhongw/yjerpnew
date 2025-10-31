 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 刷卡資料設定作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/pal/pali51/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?  $mn001c[]=$row->mn001;?>
          <?  $mn002c[]=$row->mn002;?>
          <?  $mn003c[]=$row->mn003;?>
          <?  $mn004c[]=$row->mn004;?>
          <?  $mn005c[]=$row->mn005;?>
          <?  $mn006c[]=$row->mn006;?>
		  <?  $mn007c[]=$row->mn007;?>
		  <?  $mn008c[]=$row->mn008;?>
		  <?  $mn009c[]=$row->mn009;?>
		  <?  $mn010c[]=$row->mn010;?>
		  <?  $mn011c[]=$row->mn011;?>
		  <?  $mn012c[]=$row->mn012;?>
		  <?  $mn013c[]=$row->mn013;?>
		  <?  $mn014c[]=$row->mn014;?>
		  <?  $mn015c[]=$row->mn015;?>
		  <?  $mn016c[]=$row->mn016;?>
		  <?  $mn017c[]=$row->mn017;?>
		  <?  $mn018c[]=$row->mn018;?>
		  <?  $mn019c[]=$row->mn019;?>
		  <?  $mn020c[]=$row->mn020;?>
		  <?  $mn021c[]=$row->mn021;?>
		  <?  $companyc[]=$row->company;?>
		  <?  $creatorc[]=$row->creator;?>
		  <?  $usr_groupc[]=$row->usr_group;?>
		  <?  $create_datec[]=$row->create_date;?>
		  <?  $modifierc[]=$row->modifier;?>
		  <?  $modi_datec[]=$row->modi_date;?>
          <?  $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $mn001=$mn001c[0];?>
	 <?php $mn002=$mn002c[0];?>
	 <?php $mn003=$mn003c[0];?>
	 <?php $mn004=$mn004c[0];?>
	 <?php $mn005=$mn005c[0];?>
	 <?php $mn006=$mn006c[0];?>
	 <?php $mn007=$mn007c[0];?>
	 <?php $mn008=$mn008c[0];?>
	 <?php $mn009=$mn009c[0];?>
	 <?php $mn010=$mn010c[0];?>
	 <?php $mn011=$mn011c[0];?>
	 <?php $mn012=$mn012c[0];?>
	 <?php $mn013=$mn013c[0];?>
	 <?php $mn014=$mn014c[0];?>
	 <?php $mn015=$mn015c[0];?>
	 <?php $mn016=$mn016c[0];?>
	 <?php $mn017=$mn017c[0];?>
	 <?php $mn018=$mn018c[0];?>
	 <?php $mn019=$mn019c[0];?>
	 <?php $mn020=$mn020c[0];?>
	 <?php $mn021=$mn021c[0];?>
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td align="left" class="start14a"  width="13%"><span class="required">公司代號：</span></td>
        <td align="left" class="normal14a"  width="20%"><input tabIndex="1" id="mn001" onKeyPress="keyFunction()" type="text" name="mn001"  value="<?php echo $mn001; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14a"  width="13%"><span class="required"></span>員工代號起始位置：</td>
        <td align="left" class="normal14a"  width="20%"><input tabIndex="2" id="mn002" onKeyPress="keyFunction()" type="text" name="mn002"  value="<?php echo $mn002; ?>"   required  /></td>
		<td align="left"  class="start14b"  width="13%">員工代號取碼位置：</td>
        <td align="left" class="normal14a"  width="21%"><input  tabIndex="3" id="mn003" onKeyPress="keyFunction()" type="text" name="mn003"   value="<?php echo $mn003; ?>"  /></td>
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14" >刷卡起始位置(年)：</td>
        <td align="left" class="normal14" ><input tabIndex="4" id="mn004" onKeyPress="keyFunction()" type="text" name="mn004"    value="<?php echo $mn004; ?>"   /></td>
	    <td align="left" class="normal14a" >刷卡截止位置(年)：</td>
        <td align="left" class="normal14" ><input tabIndex="5" id="mn005" onKeyPress="keyFunction()"  type="text" name="mn005"   value="<?php echo $mn005; ?>"  /></td>
		<td align="left" class="normal14a" >刷卡起始位置(月)：</td>
        <td align="left" class="normal14" ><input tabIndex="6" id="mn006" onKeyPress="keyFunction()"  type="text" name="mn006"   value="<?php echo $mn006; ?>"  /></td>	
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14" >刷卡截止位置(月)：</td>
        <td align="left" class="normal14" ><input tabIndex="7" id="mn007" onKeyPress="keyFunction()" type="text" name="mn007"    value="<?php echo $mn007; ?>"   /></td>
	    <td align="left" class="normal14" >刷卡起始位置(日)：</td>
        <td align="left" class="normal14" ><input tabIndex="8" id="mn008" onKeyPress="keyFunction()"  type="text" name="mn008"   value="<?php echo $mn008; ?>"  /></td>
		<td align="left" class="start14b" >刷卡取碼位置(日)：</td>
        <td align="left" class="normal14" ><input tabIndex="9" id="mn009" onKeyPress="keyFunction()"  type="text" name="mn009"   value="<?php echo $mn009; ?>"  /></td>
	  </tr>
	  
	 <tr>
	    <td align="left" class="normal14" >刷卡起始位置(時)：</td>
        <td align="left" class="normal14" ><input tabIndex="10" id="mn010" onKeyPress="keyFunction()" type="text" name="mn010"    value="<?php echo $mn010; ?>"   /></td>
	    <td align="left" class="normal14" >刷卡截止位置(時)：</td>
        <td align="left" class="normal14" ><input tabIndex="11" id="mn011" onKeyPress="keyFunction()"  type="text" name="mn011"   value="<?php echo $mn011; ?>"  /></td>
		<td align="left" class="normal14" >刷卡起始位置(分)：</td>
        <td align="left" class="normal14"><input tabIndex="12" id="mn012" onKeyPress="keyFunction()"  type="text" name="mn012"   value="<?php echo $mn012; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="start14b" >刷卡取碼位置(分)：</td>
        <td align="left" class="normal14" ><input tabIndex="13" id="mn013" onKeyPress="keyFunction()" type="text" name="mn013"     value="<?php echo $mn013; ?>"   /></td>
	    <td align="left" class="normal14" >功能碼起始位置：</td>
        <td align="left" class="normal14" ><input tabIndex="14" id="mn014" onKeyPress="keyFunction()"  type="text" name="mn014"   value="<?php echo $mn014; ?>"  /></td>
		<td align="left" class="start14b" >功能碼取碼位置：</td>
        <td align="left" class="normal14" ><input tabIndex="15" id="mn015" onKeyPress="keyFunction()"  type="text" name="mn015"    value="<?php echo $mn015; ?>"  /></td>
	  </tr>
	 
	   <tr>
	    <td align="left" class="normal14" >功能碼(上班)：</td>
        <td align="left" class="normal14" ><input tabIndex="16" id="mn016" onKeyPress="keyFunction()" type="text" name="mn016"      value="<?php echo $mn016; ?>"   /></td>
	    <td align="left" class="normal14" >功能碼(下班)：</td>
        <td align="left" class="normal14" ><input tabIndex="17" id="mn017" onKeyPress="keyFunction()"  type="text" name="mn017"   value="<?php echo $mn017; ?>"  /></td>
		<td align="left" class="normal14" >功能碼(休息開始)：</td>
        <td align="left" class="normal14" ><input tabIndex="18" id="mn018" onKeyPress="keyFunction()"  type="text" name="mn018"   value="<?php echo $mn018; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14" >功能碼(休息結束)：</td>
        <td align="left" class="normal14" ><input tabIndex="19" id="mn019" onKeyPress="keyFunction()" type="text" name="mn019"    value="<?php echo $mn019; ?>"   /></td>
	    <td align="left" class="normal14" >功能碼(加班上班)：</td>
        <td align="left" class="normal14" ><input tabIndex="20" id="mn020" onKeyPress="keyFunction()"  type="text" name="mn020"   value="<?php echo $mn020; ?>"  /></td>
		<td align="left" class="normal14" >功能碼(加班下班)：</td>
        <td align="left" class="normal14" ><input tabIndex="21" id="mn021" onKeyPress="keyFunction()"  type="text" name="mn021"   value="<?php echo $mn021; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14a" >建立日期：</td>
        <td align="left" class="normal14" ><input tabIndex="22" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker1" onKeyPress="keyFunction()" type="text" name="create_date"    value="<?php echo $create_date; ?>"  style="background-color:#E7EFEF" /></td>
	    <td align="left" class="normal14" >修改者代號：</td>
        <td align="left" class="normal14" ><input tabIndex="23" id="modifier" onKeyPress="keyFunction()"  type="text" name="modifier"   value="<?php echo $modifier; ?>"  /></td>
		<td align="left" class="normal14a" >修改日期：</td>
        <td align="left" class="normal14" ><input tabIndex="24" onfocus="scwShow(this,event);" onclick="scwShow(this,event);" id="datepicker2"  class="modi_date"   type="text" name="modi_date"   value="<?php echo $modi_date; ?>" style="background-color:#E7EFEF" /></td>
	  </tr>
    </table>
		
	  <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/111'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	   
    </form>
    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
</div>        <!-- div-4 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->