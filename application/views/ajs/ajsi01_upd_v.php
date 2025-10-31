 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysma002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 自動分錄參數設定 - 修改　　　</h1>
    <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/161'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/ajs/ajsi01/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php  $ma001c[]=$row->ma001;?>
          <?php  $ma002c[]=$row->ma002;?>
          <?php  $ma003c[]=$row->ma003;?>
          <?php  $ma004c[]=$row->ma004;?>
          <?php  $ma005c[]=$row->ma005;?>
          
		  <?php  $companyc[]=$row->company;?>
		  <?php  $creatorc[]=$row->creator;?>
		  <?php  $usr_groupc[]=$row->usr_group;?>
		  <?php  $create_datec[]=$row->create_date;?>
		  <?php  $modifierc[]=$row->modifier;?>
		  <?php  $modi_datec[]=$row->modi_date;?>
          <?php  $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $ma001=$ma001c[0];?>
	 <?php $ma002=$ma002c[0];?>
	 <?php $ma003=$ma003c[0];?>
	 <?php $ma004=$ma004c[0];?>
	 <?php $ma005=$ma005c[0];?>
	 
	 <?php  $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php  $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  <tr>
	    <td align="left" class="normal14y"  width="20%"><span class="required">存貨科目分類方式：</span></td>
        <td align="left" class="normal14a"  width="80%">
           <select id="ma001" onKeyPress="keyFunction()" name="ma001"  tabIndex="9">
            <option <?php if($ma001 == '1') echo 'selected="selected"';?> value='1'>1.會計</option>                                                                        
		    <option <?php if($ma001 == '2') echo 'selected="selected"';?> value='2'>2.商品</option>
			<option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>3.類別</option>
			<option <?php if($ma001 == '3') echo 'selected="selected"';?> value='3'>4.生管</option>
		  </select></td>
	     </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >收入科目分類方式：</td>
        <td align="left" class="normal14" ><select id="ma002" onKeyPress="keyFunction()" name="ma002"  tabIndex="9">
            <option <?php if($ma002 == '1') echo 'selected="selected"';?> value='1'>1.會計</option>                                                                        
		    <option <?php if($ma002 == '2') echo 'selected="selected"';?> value='2'>2.商品</option>
			<option <?php if($ma002 == '3') echo 'selected="selected"';?> value='3'>3.類別</option>
			<option <?php if($ma002 == '3') echo 'selected="selected"';?> value='3'>4.生管</option>
		  </select></td>
	   </tr>
		 
	  <tr>
	    <td align="left" class="normal14z" >拋轉方式：</td>
        <td align="left" class="normal14" ><input type="radio" name="ma003" <?php if (isset($ma003) && $ma003=="1") echo "checked";?> value="1" />拋轉自動分錄底稿  &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="ma003" <?php if (isset($ma003) && $ma003=="2") echo "checked";?> value="2" />拋轉自動分錄底稿及會計傳票
        </td>
	  </tr>	
	 <tr>
	    <td align="left" class="normal14z" >拋轉傳票同底稿科目彚總：</td>
        <td align="left" class="normal14" ><input type="hidden" name="ma004" value="N" />
		<input tabIndex="12" type="checkbox"  id="ma004" onKeyPress="keyFunction()"   name="ma004" <?php if($ma004 == 'Y' ) echo 'checked'; ?>  <?php if($ma004 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
	   <tr>
	    <td align="left" class="normal14z" >底稿記載原幣：</td>
        <td align="left" class="normal14" ><input type="hidden" name="ma005" value="N" />
		<input tabIndex="12" type="checkbox"  id="ma005" onKeyPress="keyFunction()"   name="ma005" <?php if($ma005 == 'Y' ) echo 'checked'; ?>  <?php if($ma005 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
	  
    </table>
		
	 <!-- <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('main/index/161'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
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