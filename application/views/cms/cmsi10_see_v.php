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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工姓名建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	   <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi10/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi10/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php    $mv001=$row->mv001;?>
          <?php    $mv002=$row->mv002;?>
          <?php    $mv003=$row->mv003;?>
          <?php    $cmsq05a=$row->mv004;?>
          <?php    $mv005=$row->mv005;?>
          <?php    $mv006=$row->mv006;?>
		  <?php    $mv047=$row->mv047;?>
		  <?php    $cmsq05adisp=$row->mv004disp;?>
	<?php  }?>
      
	<table class="form14">
       <tr>
       <td class="normal14y" width="8%"><span class="required">員工代號：</span></td>
        <td class="normal14a" width="42%" >
         <input  tabIndex="1" id="mv001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mv001"   value="<?php echo  $mv001; ?>"    type="text" readonly="readonly" required disabled="disabled" />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="8%">員工姓名：</td>
        <td class="normal14a"  width="42%"> <input  tabIndex="2" id="mv002" onKeyPress="keyFunction()"  name="mv002"   value="<?php echo  $mv002; ?>"    type="text" disabled="disabled" />
		
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >部門代號： </td>
        <td class="normal14" ><input   tabIndex="3" id="mv004" onKeyPress="keyFunction()" onchange="startcmsq05a(this)" name="cmsq05a" value="<?php echo $cmsq05a; ?>"  type="text" disabled="disabled" /><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
         <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
		<td class="normal14z" >英文全名：</td>
		<td class="normal14">
			   <input  tabIndex="4" id="mv047" onKeyPress="keyFunction()"  name="mv047"   value="<?php echo  $mv047; ?>"    type="text" disabled="disabled" />
        </td>
	  </tr>
		
	  
    </table>
		
	 <!-- <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi10/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>