<div id="container">  <!-- div-1 -->
  <div id="header">   <!-- div-2 -->
    <div class="div1">
   <!--   <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div> -->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?> 
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box">  <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('adm/admi10/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('adm/admi10/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('adm/admi10/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	 </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/adm/admi10/display/<?php echo $result[0]->mf001;?>"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">  <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mf001=$row->mf001;?>
          <?php   $mf002=$row->mf002;?>
          <?php   $mf003=$row->mf003;?>
		  <?php   $mf004=$row->mf004;?>
          <?php   $mf005=$row->mf005;?>
		  <?php   $mf006=$row->mf006;?>
		  <?php   $mf007=$row->mf007;?>
		  <?php   $mf004disp=$row->mf004disp;?>
		  <?php   $mf007disp=$row->mf007disp;?>
	<?php  }?>
      
	<table class="form14">
	    <tr>
	    <td class="normal14y" width="11%"><span class="required">使用者代號：</span> </td>
            <td class="normal14a" width="89%" ><input   tabIndex="1" id="mf001" onKeyPress="keyFunction()"   name="mf001" value="<?php echo $mf001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z">使用者名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mf002" onKeyPress="keyFunction()" name="mf002"   value="<?php echo  $mf002; ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >使用者密碼：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mf003" onKeyPress="keyFunction()" name="mf003"   value="<?php echo  $mf003; ?>"   /></td>
		
	  </tr>
	   <tr>
	    <td class="normal14z" >群組代號：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="admi04" ondblclick="search_admi04_window()" class="admi04" onKeyPress="keyFunction()" name="mf004"  onchange="check_admi04(this)"  value="<?php echo  $mf004; ?>"  style="background-color:#FFFFE4"  />
		 <a href="javascript:;"><img id="Showadmi04disp" src="<?php echo base_url()?>assets/image/png/group.png" alt="" align="top"/></a>
         <span id="admi04disp"><?php  echo $mf004disp; ?></span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >超級使用者：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="mf005" onKeyPress="keyFunction()" name="mf005"   value="<?php echo  strtoupper($mf005); ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >部門代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="10" ondblclick="search_cmsi05_window()" onKeyPress="keyFunction()" id="cmsi05"  name="mf007"  onblur="check_cmsi05(this)"    value="<?php echo  $mf007; ?>"  style="background-color:#FFFFE4"   />
	      <a href="javascript:;"><img id="Showcmsi05disp" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	      <span id="cmsi05disp" > <?php    echo $mf007disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >備  註：</td>
		<td class="normal14"  ><input type="text" tabIndex="7" id="mf006" onKeyPress="keyFunction()" name="mf006"   value="<?php echo  $mf006; ?>"   /></td>
		
	  </tr>
	  
		 
    </table>
		
	<!--  <div class="buttons">
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('adm/admi10/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	    <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('adm/admi10/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('adm/admi10/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
	  </div> -->
    </form>
		<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>      