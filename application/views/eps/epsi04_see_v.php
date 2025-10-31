<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶麥頭資料建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eps/epsi04/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $md001=$row->md001;?>
		  <?php   $md001disp=$row->md001disp;?>
          <?php   $md002=$row->md002;?>
          <?php   $md003=$row->md003;?>
          <?php   $md004=$row->md004;?>
		  <?php   $md005=$row->md005;?>
          <?php   $md006=$row->md006;?>
          <?php   $md007=$row->md007;?>
		  <?php   $mb991=' ';?>
		  <?php   $mb992=' ';?>
		  <?php   $mb999=' ';?>
	<?php  }?>
      
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a"  width="12%"><span class="required">客戶代號：</span> </td>
        <td class="normal14a"  width="48%"><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="md001" value="<?php echo $md001; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $md001disp; ?> </span></td>
	    <td class="normal14a" width="12%" >麥頭代號： </td>
        <td class="normal14a"  width="48%" ><input type="text" tabIndex="3" id="md002"  onKeyPress="keyFunction()" name="md002"   value="<?php echo  $md002; ?>"    size="10"   /></td>
	     </tr>	
		  
	  <tr>
	    <td class="normal14a"  >主要麥頭：</td>	
        <td class="normal14a"  ><input type="hidden" name="md003" value="N" />
		<input tabIndex="12" type="checkbox"  id="md003" onKeyPress="keyFunction()"   name="md003" <?php if($md003 == 'Y' ) echo 'checked'; ?>  <?php if($md003 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	     <td  class="normal14" >麥頭名稱：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="md007" onKeyPress="keyFunction()" name="md007"  value="<?php echo $md007; ?>"  size="20"   /></td>
		 </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" id="md006" onKeyPress="keyFunction()" name="md006"  value="<?php echo $md006; ?>"  size="60"   /></td>
	    <td class="normal14"></td>
        <td class="normal14"></td>	
	  </tr>
	  
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >正麥a</a></li>
			<li><a href="#tab2"  accesskey="b">側麥b</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料1 -->
	<div id="tab1" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	 <tr>	
		<td colspan="1" class="normal14a" width="6%" >正麥：</td>
        <td colspan="3"  class="normal14a" width="94%" ><textarea  tabIndex="25" rows="12" cols="40"  name="md004" id="md004" Wrap="Physical" ><?php echo $md004; ?></textarea></td>
        <script>CKEDITOR.replace( 'md004' );</script>  
	 </tr>	
	</table>
	</div>
	
	<!-- 基本資料2 -->
	<div id="tab2" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	  <tr>	
		<td colspan="1" class="normal14a" width="6%" >側麥：</td>
        <td colspan="3"  class="normal14a" width="94%" ><textarea  tabIndex="25" rows="12" cols="40"  name="md005" id="md005" Wrap="Physical" ><?php echo $md005; ?></textarea></td>
        <script>CKEDITOR.replace( 'md005' );</script>  
	 </tr>	
		
	</table>
	</div>
	  
     </form>
	  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
       <div class="buttons">
	    <a accesskey="x" tabIndex="100" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi04/'.$this->session->userdata('epsi04_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   
	   <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('eps/epsi04/see/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('eps/epsi04/see/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>
		
	  </div> 
</div> <!-- div-4 -->
  <!--  <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>  -->
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>      <!-- see js -->