<div id="container">  <!-- div-1 -->
  <div id="header">   <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	  </div>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box">  <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 傳票部門別建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali20/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">  <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mj001=$row->mj001;?>
          <?php   $mj002=$row->mj002;?>
          <?php   $mj003=$row->mj003;?>
        
	<?php  }?>
      
	<table class="form14">
         
	  <tr>
	    <td class="start14a" width="12%"><span class="required">傳票部門別代號：</span> </td>
        <td class="normal14a" width="38%"><input   tabIndex="1" id="mj001" onKeyPress="keyFunction()" onchange="checkspace2()" name="mj001" value="<?php echo $mj001; ?>"  type="text" disabled="disabled" required /></td>
		<td class="normal14a" ></td>
        <td class="normal14a"  ></td>
	  </tr>
	  <tr>
	    <td class="normal14" >傳票部門別名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mj002" onKeyPress="keyFunction()" name="mj002"   value="<?php echo  $mj002; ?>" disabled="disabled"  /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >備  註：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mj003" onKeyPress="keyFunction()" name="mj003"   value="<?php echo  $mj003; ?>" disabled="disabled"  /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  
		 
    </table>
		
	  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali20/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
    </form>
		
    </div> <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>    <!-- div-4 -->
    <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  </div>  <!-- div-3 -->
 </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
