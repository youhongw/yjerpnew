<?php // if (!$this->session->userdata('sysml002'))  { ?>
    <!--    <script> alert("Please enter the account password!"); url = '<?=base_url() ?>index.php/login/index';location = url; </script> -->
  <?php // } ?>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
  ?>
<div id="container">   <!-- div-1  -->
<div id="header">      <!-- div-2  <?php echo $systitle ?> $_SESSION['sysml002']$_SESSION['manager'] -->
   <div class="div1"> 
  <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">  </a>	            
		<span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></div> -->
	<!--	<div class="div2"><a style="text-decoration: none; color: #FFFFFF;font-size:14px;text-align: center;top: 6px;"  " href="<?php echo base_url()?>index.php/main"><span ><img src="<?php echo base_url()?>assets/image/company.png" style="position: relative; top: 6px;" /><?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	      <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $this->session->userdata('manager'); ?></span> 已登錄 　
		  <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
  </div>

</div> <!-- div-2 -->
   <div id="content">   <!-- menu內容 -->
   <div class="breadcrumb">  <!-- menu內容導航 -->
</div>   <!-- div-1 -->
