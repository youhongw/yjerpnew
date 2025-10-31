 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>
	   
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 公司名稱稅籍建立作業 - 修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ml002').focus();" accesskey="s" tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s </span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  tabIndex="9" accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('main/index/101'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/cms/cmsi14/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php  $ml001c[]=$row->ml001;?>
          <?php  $ml002c[]=$row->ml002;?>
          <?php  $ml003c[]=$row->ml003;?>
          <?php  $ml004c[]=$row->ml004;?>
          <?php  $ml005c[]=$row->ml005;?>
          <?php  $ml006c[]=$row->ml006;?>
		  <?php  $ml007c[]=$row->ml007;?>
		  <?php  $ml008c[]=$row->ml008;?>
		  <?php  $ml009c[]=$row->ml009;?>
		  <?php  $ml010c[]=$row->ml010;?>
		  <?php  $ml011c[]=$row->ml011;?>
		  <?php  $ml012c[]=$row->ml012;?>
		  <?php  $ml013c[]=$row->ml013;?>
		  <?php  $ml014c[]=$row->ml014;?>
		  <?php  $ml015c[]=$row->ml015;?>
		  <?php  $ml016c[]=$row->ml016;?>
		  <?php  $ml017c[]=$row->ml017;?>
		  <?php  $ml018c[]=$row->ml018;?>
		  <?php  $ml019c[]=$row->ml019;?>
		  <?php  $companyc[]=$row->company;?>
		  <?php  $creatorc[]=$row->creator;?>
		  <?php  $usr_groupc[]=$row->usr_group;?>
		  <?php  $create_datec[]=$row->create_date;?>
		  <?php  $modifierc[]=$row->modifier;?>
		  <?php  $modi_datec[]=$row->modi_date;?>
          <?php  $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $ml001=$ml001c[0];?>
	 <?php $ml002=$ml002c[0];?>
	 <?php $ml003=$ml003c[0];?>
	 <?php $ml004=$ml004c[0];?>
	 <?php $ml005=$ml005c[0];?>
	 <?php $ml006=$ml006c[0];?>
	 <?php $ml007=$ml007c[0];?>
	 <?php $ml008=$ml008c[0];?>
	 <?php $ml009=$ml009c[0];?>
	 <?php $ml010=$ml010c[0];?>
	 <?php $ml011=$ml011c[0];?>
	 <?php $ml012=$ml012c[0];?>
	 <?php $ml013=$ml013c[0];?>
	 <?php $ml014=$ml014c[0];?>
	 <?php $ml015=$ml015c[0];?>
	 <?php $ml016=$ml016c[0];?>
	 <?php $ml017=$ml017c[0];?>
	 <?php $ml018=$ml018c[0];?>
	 <?php $ml019=$ml019c[0];?>
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td align="left" class="normal14y"  width="9%"><span class="required">公司代號：</span></td>
        <td align="left" class="normal14a"  width="27%"><input tabIndex="1" id="ml001" onKeyPress="keyFunction()" type="text" name="ml001"  value="<?php echo $ml001; ?>"  disabled="disabled" /></td>
	    <td align="left" class="normal14y"  width="10%"><span class="required"></span>公司簡稱：</td>
        <td align="left" class="normal14a"  width="26%"><input tabIndex="2" id="ml002" onKeyPress="keyFunction()" type="text" name="ml002"  value="<?php echo $ml002; ?>"   required  /></td>
		<td align="left"  class="normal14y"  width="9%">公司全稱：</td>
        <td align="left" class="normal14a"  width="29%"><input  tabIndex="3" id="ml003" onKeyPress="keyFunction()" type="text" name="ml003"   value="<?php echo $ml003; ?>"  /></td>
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >存放路徑：</td>
        <td align="left" class="normal14" ><input tabIndex="4" id="ml004" onKeyPress="keyFunction()" type="text" name="ml004"    value="<?php echo $ml004; ?>"   /></td>
	    <td align="left" class="normal14z" >電話：</td>
        <td align="left" class="normal14" ><input tabIndex="5" id="ml005" onKeyPress="keyFunction()"  type="text" name="ml005"   value="<?php echo $ml005; ?>"  /></td>
		<td align="left" class="normal14z" >傳真：</td>
        <td align="left" class="normal14" ><input tabIndex="6" id="ml006" onKeyPress="keyFunction()"  type="text" name="ml006"   value="<?php echo $ml006; ?>"  /></td>	
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >統一編號：</td>
        <td align="left" class="normal14" ><input tabIndex="7" id="ml007" onKeyPress="keyFunction()" type="text" name="ml007"    value="<?php echo $ml007; ?>"   /></td>
	    <td align="left" class="normal14z" >稅籍編號：</td>
        <td align="left" class="normal14" ><input tabIndex="8" id="ml008" onKeyPress="keyFunction()"  type="text" name="ml008"   value="<?php echo $ml008; ?>"  /></td>
		<td align="left" class="normal14z" >負責人：</td>
        <td align="left" class="normal14" ><input tabIndex="9" id="ml009" onKeyPress="keyFunction()"  type="text" name="ml009"   value="<?php echo $ml009; ?>"  /></td>
	  </tr>
	  
	 <tr>
	    <td align="left" class="normal14z" >E-MAIL：</td>
        <td align="left" class="normal14" ><input tabIndex="10" id="ml010" onKeyPress="keyFunction()" type="text" name="ml010"    value="<?php echo $ml010; ?>"   /></td>
	    <td align="left" class="normal14z" >備註：</td>
        <td align="left" class="normal14" ><input tabIndex="11" id="ml011" onKeyPress="keyFunction()"  type="text" name="ml011"   value="<?php echo $ml011; ?>"  /></td>
		<td align="left" class="normal14z" >地址一：</td>
        <td align="left" class="normal14"><input tabIndex="12" id="ml012" onKeyPress="keyFunction()"  type="text" name="ml012" size="40"  value="<?php echo $ml012; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >地址二：</td>
        <td align="left" class="normal14" ><input tabIndex="13" id="ml013" onKeyPress="keyFunction()" type="text" name="ml013"   size="40"   value="<?php echo $ml013; ?>"   /></td>
	    <td align="left" class="normal14z" >英文公司：</td>
        <td align="left" class="normal14" ><input tabIndex="14" id="ml014" onKeyPress="keyFunction()"  type="text" name="ml014"   value="<?php echo $ml014; ?>"  /></td>
		<td align="left" class="normal14z" >英地址1：</td>
        <td align="left" class="normal14" ><input tabIndex="15" id="ml015" onKeyPress="keyFunction()"  type="text" name="ml015"   size="40"  value="<?php echo $ml015; ?>"  /></td>
	  </tr>
	 
	   <tr>
	    <td align="left" class="normal14z" >英地址2：</td>
        <td align="left" class="normal14" ><input tabIndex="16" id="ml016" onKeyPress="keyFunction()" type="text" name="ml016"   size="40"   value="<?php echo $ml016; ?>"   /></td>
	    <td align="left" class="normal14z" >OLAP名稱：</td>
        <td align="left" class="normal14" ><input tabIndex="17" id="ml017" onKeyPress="keyFunction()"  type="text" name="ml017"   value="<?php echo $ml017; ?>"  /></td>
		<td align="left" class="normal14z" >銷售 Cube：</td>
        <td align="left" class="normal14" ><input tabIndex="18" id="ml018" onKeyPress="keyFunction()"  type="text" name="ml018"   value="<?php echo $ml018; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >Cube資訊：</td>
        <td align="left" class="normal14" ><input tabIndex="19" id="ml019" onKeyPress="keyFunction()" type="text" name="ml019"    value="<?php echo $ml019; ?>"   /></td>
	    <td align="left" class="normal14z" >英公司簡稱：</td>
        <td align="left" class="normal14" ><input tabIndex="20" id="company" onKeyPress="keyFunction()"  type="text" name="company"   value="<?php echo $company; ?>"  /></td>
		<td align="left" class="normal14z" >群組代號：</td>
        <td align="left" class="normal14" ><input tabIndex="21" id="usr_group" onKeyPress="keyFunction()"  type="text" name="usr_group"   value="<?php echo $usr_group; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td align="left" class="normal14z" >建立日期：</td>
        <td align="left" class="normal14" ><input tabIndex="22" onfocus="this.select()" ondblclick="scwShow(this,event);" onchange="dataymd1(this)" onKeyPress="keyFunction()" type="text" name="create_date"    value="<?php echo $create_date; ?>"  style="background-color:#E7EFEF" /></td>
	    <td align="left" class="normal14z" >修改者代號：</td>
        <td align="left" class="normal14" ><input tabIndex="23" id="modifier" onKeyPress="keyFunction()"  type="text" name="modifier"   value="<?php echo $modifier; ?>"  /></td>
		<td align="left" class="normal14z" >修改日期：</td>
        <td align="left" class="normal14" ><input tabIndex="24"  onfocus="this.select()"  ondblclick="scwShow(this,event);" onchange="dataymd2(this)" class="modi_date"   type="text" name="modi_date"   value="<?php echo $modi_date; ?>" style="background-color:#E7EFEF" /></td>
	  </tr>
    </table>
		
	<!--  <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/101'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
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
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.create_date.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'create_date\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.create_date.focus(); return create_date;}	
}

//--></script>
<script type="text/javascript"><!--       
 function dataymd2(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.modi_date.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'modi_date\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.modi_date.focus(); return modi_date;}	
}

//--></script>