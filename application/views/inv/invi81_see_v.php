<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號換算單位建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi81/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi81/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
        <?php   $invq02a=$row->md001;?>
		  <?php   $invq02adisp=$row->md001disp;?>
		  <?php   $md001disp=$row->md001disp;?>
		  <?php   $md001disp1=$row->md001disp1;?>
		  <?php   $md001disp2=$row->md001disp2;?>
          <?php   $md002=$row->md002;?>
          <?php   $md003=$row->md003;?>
		  <?php   $md004=$row->md004;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
	 <tr>
	    <td class="normal14y" width="11%"><span class="required">品號：</span> </td>
        <td class="normal14a" width="39%"><input   tabIndex="1" id="md001" onKeyPress="keyFunction()" readonly="value" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>" type="text" required  disabled="disabled"/><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top" /></a>
	      <span id="invq02adisp"> <?php  echo $invq02adisp; ?> </span></td>	   
		<td class="normal14y" width="11%">品名：</td>
        <td class="normal14a" width="39%" ><input type="text" readonly="value" tabIndex="2" id="md001disp" onKeyPress="keyFunction()" name="md001disp"   value="<?php echo  $md001disp; ?>"  style="background-color:#F5F5F5" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >規格：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" readonly="value" id="md001disp1" onKeyPress="keyFunction()" name="md001disp1"   value="<?php echo  $md001disp1; ?>"  style="background-color:#F5F5F5" disabled="disabled" /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >換算率分子：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="md003" onKeyPress="keyFunction()" name="md003"   value="<?php echo  $md003; ?>"   /></td>
		 <td class="normal14z" >庫存單位：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" readonly="value" id="md001disp2" onKeyPress="keyFunction()" name="md001disp2"   value="<?php echo  $md001disp2; ?>"  style="background-color:#F5F5F5" disabled="disabled"/></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >換算率分母：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="md004" onKeyPress="keyFunction()" name="md004"   value="<?php echo  $md004; ?>"  disabled="disabled" /></td>
		 <td class="normal14z" >換算單位：</td>
		<td class="normal14"  ><input type="text" tabIndex="7" id="md002" onKeyPress="keyFunction()" name="md002"   value="<?php echo  $md002; ?>" disabled="disabled" /></td>
	  </tr>
	 
    </table>
		
	<!--   <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi81/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
    </form>
	<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->