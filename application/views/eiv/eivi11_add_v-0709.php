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

<div id="content" >  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 手開發票建立作業 - 新增</h1>
    </div>
	
    <div class="content" style="background-image:url('<?php echo base_url()?>assets/image/seti02/voc.png'); margin:0px; border:0px;height:1200px; width:auto; background-size:cover;"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi03/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mv001=$this->input->post('mv001');
	  $mv002=$this->input->post('mv002');
	  $cmsq02a=$this->input->post('mv003');
	  $mv004=$this->input->post('mv004');
	  $mv005=$this->input->post('mv005');
	  $mv006=$this->input->post('mv006');
      $mv007=$this->input->post('mv007');		  
	  $cmsq02adisp=$this->input->post('mv003');
	  if (($mv004!="1") && ($mv004!="2") ) { $mv004="1" ;}
	  if (($mv005!="Y") && ($mv005!="N") ) { $mv005="Y" ;}
	  if (($mv006!="Y") && ($mv006!="N") ) { $mv006="Y" ;}
	?>
   
	<table style="width: 100%;" >     <!-- 表格 -->
	     <tr>
         <td><input  tabIndex="1" id="mv001"  name="mv001"   value="<?php echo  $mv001; ?>"    type="text" style="margin-top: 4px;margin-left: 4px" /></td>
		   
	  </tr>	
	<!--	<div id="canvas" style="background-image:url('<?php echo base_url()?>assets/image/seti02/voc.png');
			background-size: 100%;background-repeat: no-repeat;width: 850px;
			border-width: 1px;border-style: solid;"
			ondrop='set_position(event);'
			ondragover='print_position(event);'
			>
			<img src="<?php echo base_url()?>assets/image/seti02/voc.png" style="visibility: hidden;width:100%;" />
		</div> -->
	  
	
	<br/><br/><br/><br/>
	</table>
	   		  
	<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi03/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
  
</div> <!-- div-4 -->

  
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/eivi11_funjs_v.php"); ?> 
	 
 