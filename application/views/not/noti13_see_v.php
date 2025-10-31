<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" />融資種類建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti13/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	 </div>
	  <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/not/noti13/display"  method="post" enctype="multipart/form-data" >
      
	</div>
    <div class="content"> <!-- div-5 -->
	
	<div id="tab-general"> <!-- div-6 -->
	<?php $i=0; ?>
	<?php foreach($result as $row) { ?>
          <?php   $mc001=$row->mc001;?>
          <?php   $mc002=$row->mc002;?>
		  <?php   $mc003=$row->mc003;?>
		   
		    <?php   $flag=$row->flag;?>	
		
		   <?php   $mb991=' ';?>
		   <?php   $mb992=' ';?>
		   <?php   $mb999=' ';?>
	<?php $i = $i + 1 ; }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="8%" ><span class="required">融資種類：</span> </td>
        <td class="normal14a" width="42%" ><input   tabIndex="1" id="mc001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mc001" value="<?php echo $mc001;?>"  type="text" disabled="disabled" />
	  </tr>
	 
	 <tr>
	    <td class="normal14z" >融資名稱：</td>
        <td class="normal14" ><input  tabIndex="2" id="mc002" onKeyPress="keyFunction()"  name="mc002" value="<?php echo $mc002;?>" disabled="disabled" />
	  </tr>
	  
      <tr>
	    <td class="normal14z" >融資性質：</td>
        <td class="normal14" >
		<select  tabIndex="6" id="mc003" onKeyPress="keyFunction()"  name="mc003" disabled="disabled" >
             <option <?php if($mc003 == '1') echo 'selected="selected"';?> value='1'>1:L/C</option>                                                                     
		     <option <?php if($mc003 == '2') echo 'selected="selected"';?> value='2'>2:INVOICE</option>
			 <option <?php if($mc003 == '3') echo 'selected="selected"';?> value='3'>3:應付商業本票/承兌匯票</option>
			 <option <?php if($mc003 == '4') echo 'selected="selected"';?> value='4'>4:應收票據</option>
			 <option <?php if($mc003 == '5') echo 'selected="selected"';?> value='5'>5:資產抵押</option>
			 <option <?php if($mc003 == '9') echo 'selected="selected"';?> value='9'>9:其它</option>
		  </select>
	  </tr>
		
	</table>
	
	 </div>
	</div>
	<!--<div class="buttons">
	<a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti13/display'); ?>" class="button" ><span>返 回Alt+x</span></a>
	</div> -->
	  
      </form>
	  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  
     </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
