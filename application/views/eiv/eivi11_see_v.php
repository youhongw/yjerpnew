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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 手開發票建立作業 - 查看</h1>
	<!-- <form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/eiv/eivi11/display"  method="post" enctype="multipart/form-data" > -->
    </div>
	
    <div class="content" style="background-image:url('<?php echo base_url()?>assets/image/seti02/voc.png'); margin:0px; border:0px;height:414px; width:624px; background-size:auto;"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eiv/eivi11/addsave" ><!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
       <?php   $mv001=$row->mv001;?>
          <?php   $mv002=$row->mv002;?>
          <?php   $mv003=$row->mv003;?>
          <?php   $mv004=$row->mv004;?>
          <?php   $mv005=$row->mv005;?>
          <?php   $mv006=$row->mv006;?>
		  <?php   $mv007=$row->mv007;?>
		  <?php   $mv008=$row->mv008;?>
          <?php   $mv009=$row->mv009;?>
		  <?php   $mv010=$row->mv010;?>
		  <?php   $mv011=$row->mv011;?>
		  
		  <?php   $mv026=$row->mv026;?>
		  <?php   $mv027=$row->mv027;?>
		  <?php   $mv028=$row->mv028;?>
		  <?php   $mv053=$row->mv053;?>
		  <?php   $mv054=$row->mv054;?>
		  <?php   $mv055=$row->mv055;?>
		   <?php   $mv056=$row->mv056;?>
          <?php   $flag=$row->flag;?>	
	<?php  }?>
      
	<table style="width: 624; cellpadding=10 border=0 " >     <!-- 表格 -->
	     <tr>
         <td><input  tabIndex="1" id="mv001"  name="mv001"   value="<?php echo  $mv001; ?>"  size="20"  type="text" style="margin-top: 10px;margin-left: 75px" /></td>		   
	  </tr>	
	  <tr>
         <td><input  tabIndex="2" id="mv002"  name="mv002"   value="<?php echo  $mv002; ?>"  size="12"  type="text" style="margin-top: -2px;margin-left: 75px" />		   
	     <span><?php echo "　　" ?></span>
		 <input  tabIndex="3" id="mv054"  name="mv054"   value="<?php echo  $mv054; ?>"  size="2"  type="text" style="margin-left: 140px" />
		 <input  tabIndex="4" id="mv004"  name="mv004" onfocus="startkey();"   value="<?php echo  $mv004; ?>"  size="2"  type="text" style="margin-left: 10px" />
	     <input  tabIndex="5" id="mv005" onblur="check_title_no(this)" name="mv005"   value="<?php echo  $mv005; ?>"  size="2"  type="text" style="margin-left: 10px" /></td>
	     
	  </tr>	
	   <tr>
         <td><input  tabIndex="6" id="mv003"  name="mv003"  onfocus="check_title_no(this)"  value="<?php echo  $mv003; ?>"  size="56"  type="text" style="margin-top: -4px;margin-left: 75px" />   
	     <input type="text"  tabIndex="1" id="mv053"  name="mv053"   value="<?php echo  $mv053; ?>"  size="10"   style="margin-left: 10px;background-color:#F0F0F0;" readonly="readonly" />
		 <input type="text"  tabIndex="1" id="mv055"  name="mv055"   value="<?php echo  $mv055; ?>"  size="6"   style="margin-left: 10px;background-color:#F0F0F0;" readonly="readonly"/></td>
	  </tr>	
	  <tr>
         <td><input  tabIndex="7" id="mv006"  name="mv006"   value="<?php echo  $mv006; ?>"  size="20"  type="text" style="margin-top: 20x;margin-left: 15px" />
		 <input  tabIndex="8" id="mv007"  name="mv007"  onchange="calamt(this)" value="<?php echo  $mv007; ?>"  size="8"  type="text" style="margin-left: 18px" />
		 <input  tabIndex="9" id="mv008"  name="mv008" onchange="calamt(this)"  value="<?php echo  $mv008; ?>"  size="8"  type="text" style="margin-left: 6px" />
		 <input  tabIndex="10" id="mv009"  name="mv009" onfocus="calamt(this)"  onblur="calamt1(this)" value="<?php echo  $mv009; ?>"  size="14"  type="text" style="margin-left: 6px" /></td>		   
	  </tr>	
	     <tr>
         <td><input  tabIndex="11" id="mv026"  name="mv026" onfocus="calamt1(this);NumToCh()"  value="<?php echo  $mv026; ?>"  size="14"  type="text" style="margin-top: 117px;margin-left: 305px" />
		 </td>		   
	  </tr>	
	   <tr>
         <td><input  tabIndex="12" id="mv027"  name="mv027"   value="<?php echo  $mv027; ?>"  size="14"  type="text" style="margin-top: 2px;margin-left: 305px" />
		 </td>		   
	  </tr>	
	  <tr>
         <td><input  tabIndex="13" id="mv028"  name="mv028" onfocus="NumToCh(this)"  value="<?php echo  $mv028; ?>"  size="14"  type="text" style="margin-top: 2px;margin-left: 305px" />
		 </td>		   
	  </tr>	
	   <tr>
         <td><input  tabIndex="14" id="mv056"  name="mv056"   value="<?php echo  $mv056; ?>"  size="47"  type="text" style="text-align:right; margin-top: 1px;margin-left: 110px;background-color:#F0F0F0" readonly="readonly" />
		 </td>		   
	  </tr>	
	<!--	<div id="canvas" style="background-image:url('<?php echo base_url()?>assets/image/seti02/voc.png');
			background-size: 100%;background-repeat: no-repeat;width: 850px;
			border-width: 1px;border-style: solid;"
			ondrop='set_position(event);'
			ondragover='print_position(event);17'
			>
			<img src="<?php echo base_url()?>assets/image/seti02/voc.png" style="visibility: hidden;width:100%;" />
		</div> -->
	  
	
	<br/><br/>
	</table>
		
	  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel'  style="margin-top: 33px;margin-left: 8px" name='cancel' href="<?php echo site_url('eiv/eivi11/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
        </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
    <?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  </div> <!-- div-3 -->
 </div> <!-- div-2 -->
</div> <!-- div-1 -->
