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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 指定關帳日期作業 - -修改　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#ma018').focus();" tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
   </div>
	</div>
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/act/acti14/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php foreach($results as $row ) : ?>
          <?php   $ma001c[]=$row->ma001;?>
          <?php   $ma002c[]=$row->ma002;?>
          <?php   $ma003c[]=$row->ma003;?>
          <?php   $ma004c[]=$row->ma004;?>
          <?php   $ma005c[]=$row->ma005;?>
          <?php   $ma006c[]=$row->ma006;?>
		  <?php   $ma007c[]=$row->ma007;?>
		  <?php   $ma008c[]=$row->ma008;?>
		  <?php   $ma009c[]=$row->ma009;?>
		  <?php   $ma010c[]=$row->ma010;?>
		  <?php   $ma011c[]=$row->ma011;?>
		  <?php   $ma012c[]=$row->ma012;?>
		  <?php   $ma013c[]=$row->ma013;?>
		  <?php   $ma014c[]=$row->ma014;?>
		  <?php   $ma015c[]=$row->ma015;?>
		  <?php   $ma016c[]=$row->ma016;?>
		  <?php   $ma017c[]=$row->ma017;?>
		  <?php   $ma018c[]=$row->ma018;?>
		  <?php   $ma019c[]=$row->ma019;?>
		  <?php   $ma020c[]=$row->ma020;?>
		  <?php   $ma021c[]=$row->ma021;?>
		  <?php   $ma022c[]=$row->ma022;?>
		  <?php   $ma023c[]=$row->ma023;?>
		  <?php   $ma024c[]=$row->ma024;?>
		  <?php   $ma025c[]=$row->ma025;?>
		  <?php   $ma026c[]=$row->ma026;?>
		  <?php   $ma027c[]=$row->ma027;?>
		  <?php   $ma028c[]=$row->ma028;?>
		  <?php   $ma029c[]=$row->ma029;?>
		  <?php   $ma030c[]=$row->ma030;?>
		   <?php   $ma200c[]=$row->ma200;?>
		    <?php   $ma201c[]=$row->ma201;?>
		    <?php   $ma202c[]=$row->ma202;?>
			<?php   $ma203c[]=$row->ma203;?>
			<?php   $ma204c[]=$row->ma204;?>
			<?php   $ma205c[]=$row->ma205;?>
		  <?php   $cmsq06ac[]=$row->ma003;?>
		  <?php   $cmsq06acdisp[]=$row->ma003;?>
		  
		  <?php   $companyc[]=$row->company;?>
		  <?php   $creatorc[]=$row->creator;?>
		  <?php   $usr_groupc[]=$row->usr_group;?>
		  <?php   $create_datec[]=$row->create_date;?>
		  <?php   $modifierc[]=$row->modifier;?>
		  <?php   $modi_datec[]=$row->modi_date;?>
          <?php   $flagc[]=$row->flag;?>	  
	 <?php endforeach;?>
	 
	 <?php $ma001=$ma001c[0];?>
	 <?php $ma002=$ma002c[0];?>
	 <?php $ma003=$ma003c[0];?>
	 <?php $ma004=$ma004c[0];?>
	 <?php $ma005=$ma005c[0];?>
	 <?php $ma006=$ma006c[0];?>
	 <?php $ma007=$ma007c[0];?>
	 <?php $ma008=$ma008c[0];?>
	 <?php $ma009=$ma009c[0];?>
	 <?php $ma010=$ma010c[0];?>
	 <?php $ma011=$ma011c[0];?>
	 <?php $ma012=$ma012c[0];?>
	 <?php $ma013=$ma013c[0];?>
	 <?php $ma014=$ma014c[0];?>
	 <?php $ma015=$ma015c[0];?>
	 <?php $ma016=$ma016c[0];?>
	 <?php $ma017=$ma017c[0];?>
	 <?php $ma018=$ma018c[0];?>
	 <?php $ma019=$ma019c[0];?>
	 <?php $ma020=$ma020c[0];?>
	 <?php $ma021=$ma021c[0];?>
	 <?php $ma022=$ma022c[0];?>
	 <?php $ma023=$ma023c[0];?>
	 <?php $ma024=$ma024c[0];?>
	 <?php $ma025=$ma025c[0];?>
	 <?php $ma026=$ma026c[0];?>
	 <?php $ma027=$ma027c[0];?>
	 <?php $ma028=$ma028c[0];?>
	 <?php $ma029=$ma029c[0];?>
	 <?php $ma030=$ma030c[0];?>
	  <?php $ma200=$ma200c[0];?>
	   <?php $ma201=$ma201c[0];?>
	    <?php $ma202=$ma202c[0];?>
		<?php $ma203=$ma203c[0];?>
		<?php $ma204=$ma204c[0];?>
	 <?php $ma205=$ma205c[0];?>
	 <?php $ma022=substr($ma022c[0],0,4).'/'.substr($ma022c[0],4,2);?>
	 <?php $ma021=substr($ma021c[0],0,4).'/'.substr($ma021c[0],4,2);?>
	 <?php $ma027=substr($ma027c[0],0,4).'/'.substr($ma027c[0],4,2);?>
	 <?php $ma028=substr($ma028c[0],0,4).'/'.substr($ma028c[0],4,2);?>
	 <?php $ma029=substr($ma029c[0],0,4).'/'.substr($ma029c[0],4,2);?>
	 <?php $ma030=substr($ma030c[0],0,4).'/'.substr($ma030c[0],4,2);?>
	 <?php $ma011=substr($ma011c[0],0,4).'/'.substr($ma011c[0],4,2);?>
	 <?php $ma012=substr($ma012c[0],0,4).'/'.substr($ma012c[0],4,2);?>
	 <?php $ma013=substr($ma013c[0],0,4).'/'.substr($ma013c[0],4,2).'/'.substr($ma013c[0],6,2);?>
	 <?php $ma204=substr($ma204c[0],0,4).'/'.substr($ma204c[0],4,2).'/'.substr($ma204c[0],6,2);?>
	 <?php $cmsq06a=$cmsq06ac[0];?>
	 <?php $cmsq06adisp=$cmsq06acdisp[0];?>
	 
	 <?php $company=$companyc[0];?>
	 <?php $usr_group=$usr_groupc[0];?>
	 <?php $create_date=substr($create_datec[0],0,4).'/'.substr($create_datec[0],4,2).'/'.substr($create_datec[0],6,2);?>
	 <?php $modifier=$modifierc[0];?>
	 <?php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php $flagc=$flagc[0];?>
       
	
	
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		    
			<li><a href="#tab3" accesskey="c" >財務參數c</a></li>	
	    </ul>

    <div class="tab_container"> <!-- div-8 -->
	
	
	<!-- 財務參數 -->
     <div id="tab3" class="tab_content">
	 <table class="form14">     <!-- 表格 -->
	 
	  </tr>
	   <tr>
	    <td class="normal14y" width="12%" >會計關帳年月：</td>
		<td class="normal14a" width="38%"><input tabIndex="23" id="ma018" onKeyPress="keyFunction()"   name="ma018" value="<?php echo $ma018; ?>" type="text"  /></td>
		<td class="normal14a" width="12%"></td>
        <td class="normal14a" width="38%" ></td>
	 </tr>	
	 
	 
	</table>
	</div>
	
		</div>        <!-- div- 可儲存顯示 -->
		 <input type="hidden" class="commpany" name="company" value="" />
	 <!-- <div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/109'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php // include("./application/views/fun/acti14_funjs_v.php"); ?>