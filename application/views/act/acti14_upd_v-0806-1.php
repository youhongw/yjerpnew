 <div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php php echo base_url()?>index.php/main"><?php php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php php echo $username ?></span> 已登錄 　
	     <img src="<?php php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php php echo base_url()?>assets/image/order.png" alt="" /> 指定關帳作業 - 修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php php echo base_url()?>index.php/act/acti14/updsave" method="post" enctype="multipart/form-data" >
	<!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php php
    date_default_timezone_set("Asia/Taipei");
	?>
	
	<?php php foreach($results as $row ) : ?>
         
		  <?php   $ma018c[]=$row->ma018;?>
		  <?php   $ma020c[]=$row->ma020;?>
		  
		  <?php   $modifierc[]=$row->modifier;?>
		  <?php   $modi_datec[]=$row->modi_date;?>
          <?php   $flagc[]=$row->flag;?>	  
	 <?php php endforeach;?>
	 
	 
	 <?php php $ma018=$ma018c[0];?>
	 <?php php $ma020=$ma020c[0];?>	
	 <?php php $modifier=$modifierc[0];?>
	 <?php php $modi_date=substr($modi_datec[0],0,4).'/'.substr($modi_datec[0],4,2).'/'.substr($modi_datec[0],6,2);?>
	 <?php php $flagc=$flagc[0];?>
       
	<table class="form14">  <!-- 表格 -->
	  
		 
	  <tr>
	    <td align="left" class="start14a"  width="12">指定關帳年度：</td>
        <td align="left" class="normal14a"  width="88%"><input tabIndex="2" id="ma020" onKeyPress="keyFunction()" type="text" name="ma020"    value="<?php php echo $ma020; ?>"   /></td>
	    
	  </tr>
		 
	  <tr>
	    <td align="left" class="start14a" >指定關帳期別：</td>
        <td align="left" class="normal14a" ><input tabIndex="3" id="ma018" onKeyPress="keyFunction()" type="text" name="ma018"    value="<?php php echo $ma018; ?>"   /></td>
	    
	  </tr>
	  
	 
    </table>
		
	  <div class="buttons">
	    <button tabIndex="8" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="9" id='cancel' name='cancel' href="<?php php echo site_url('main/index'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	   
    </form>
    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
</div>        <!-- div-4 -->
    <?php php  if ($message!=' ') { ?>
	<div class="success"><?php php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php php } ?>
    </div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->