 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> E-BOM參數設定 - -修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#ml001').focus();" tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/129'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ebo/eboi01/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php   $ml000c[]=$row->ml000;?>
		  <?php   $ml001c[]=$row->ml001;?>
		  
		  <?php   $companyc[]=$row->company;?>
		  <?php   $creatorc[]=$row->creator;?>
		  <?php   $usr_groupc[]=$row->usr_group;?>
		  <?php   $create_datec[]=$row->create_date;?>
		  <?php   $modifierc[]=$row->modifier;?>
		  <?php   $modi_datec[]=$row->modi_date;?>
          <?php   $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $ml000=$ml000c[0];?>
	 <?php $ml001=$ml001c[0];?>
	 <?php $flagc=$flagc[0];?>
       
	
	
	
	
	
	<!-- 財務參數 -->
   
	 <table class="form14">     <!-- 表格 -->
	 
	  </tr>
	   <tr>
	    <td class="normal14y" width="15%" >更新成BOM時版次歸零：</td>
		<td class="normal14a" width="85%"><input type="hidden" name="ml001" value="N" />
		  <input tabIndex="29" id="ml001" onKeyPress="keyFunction()" name="ml001" <?php if($ml001 == 'Y' ) echo 'checked'; ?>  <?php if($ml001 !== 'Y' ) echo 'check'; ?> value="Y" size="1" type='checkbox'  /></td><td class="normal14a" width="12%"></td>
        
	 </tr>	
	 
	</table>
	</div>
		</div>        <!-- div- 可儲存顯示 -->
		 <input type="hidden" class="commpany" name="company" value="" />
	 <!-- <div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/129'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php // include("./application/views/fun/eboi01_funjs_v.php"); ?>