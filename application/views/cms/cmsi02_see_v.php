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
    <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 廠別資料建立作業 - 查看　　　</h1>
	<div style="float:left;padding-top: 5px; ">
	<a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mb001=$row->mb001;?>
          <?php   $mb002=$row->mb002;?>
          <?php   $mb003=$row->mb003;?>
          <?php   $mb004=$row->mb004;?>
          <?php   $mb005=$row->mb005;?>
          <?php   $mb006=$row->mb006;?>
		  <?php   $mb007=$row->mb007;?>
		  <?php   $mb008=$row->mb008;?>
		  <?php   $mb009=$row->mb009;?>
		  <?php   $mb010=$row->mb010;?>
	<?php  }?>
      
	<table class="form14">
      <tr>
	      <td class="normal14y" width="10%"><span class="required">廠別代號：</span></td>
          <td class="normal14a" width="40%">
		   <input tabIndex="1" id="mb001" onKeyPress="keyFunction()" type="text" name="mb001"  value="<?php echo $mb001; ?>"  readonly="readonly" disabled="disabled"/></td>	    			
	      <td class="normal14y" width="10%">廠別名稱：</td>
          <td class="normal14a" width="40%">
		   <input tabIndex="2" id="mb002" onKeyPress="keyFunction()" type="text" name="mb002"  value="<?php echo $mb002; ?>"  disabled="disabled"  /></td>
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z">電話：</td>
        <td align="left" class="normal14"><input tabIndex="3" id="mb003" onKeyPress="keyFunction()" type="text" name="mb003"  value="<?php echo $mb003; ?>" size="20"   disabled="disabled" /></td>
	    <td align="left"  class="normal14z">傳真：</td>
        <td align="left" class="normal14"><input  tabIndex="4" id="mb004" onKeyPress="keyFunction()"  type="text" name="mb004"   value="<?php echo $mb004; ?>" size="20" disabled="disabled" /></td>
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z">地址一：</td>
        <td align="left" class="normal14"><input  tabIndex="5" id="mb005" onKeyPress="keyFunction()"  type="text" name="mb005"   value="<?php echo $mb005; ?>" size="60" disabled="disabled" /></td>
	    <td align="left" class="normal14z">地址二：</td>
        <td align="left" class="normal14"><input  tabIndex="6" id="mb006" onKeyPress="keyFunction()"  type="text" name="mb006"   value="<?php echo $mb006; ?>" size="60" disabled="disabled" /></td>
	  </tr>
		 
	  <tr>
	    <td align="left" class="normal14z">備註：</td>
        <td align="left"  class="normal14"><input  tabIndex="7" id="mb007" onKeyPress="keyFunction()"  type="text" name="mb007"   value="<?php echo $mb007; ?>" size="60" disabled="disabled" /></td>
	    <td class="normal14z">E-Mail：</td>
        <td class="normal14"><input  tabIndex="8" id="mb008" onKeyPress="keyFunction()"  type="text" name="mb008"   value="<?php echo $mb008; ?>" size="36" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z"> 英文地址一：</td>
        <td class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="mb009" name="mb009"  value="<?php echo $mb009; ?>"  size="60" type="text" disabled="disabled" /></td>	
	    <td class="normal14z">英文地址二：</td>
        <td class="normal14"><input  tabIndex="10" onKeyPress="keyFunction()" id="mb010" name="mb010"  value="<?php echo $mb010; ?>"  size="60" type="text" disabled="disabled" /></td>	
	  </tr>
    </table>
		
	 <!-- <div class="buttons">
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
