<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 交易對象資料建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a   accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi15/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi15/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mr001=$row->mr001;?>
          <?php   $mr002=$row->mr002;?>
          <?php   $mr003=$row->mr003;?>
          <?php   $mr004=$row->mr004;?>
		  <?php   $mr005=$row->mr005;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
	 <tr>
	    <td class="normal14y" width="8%"><span class="required">分類代號：</span> </td>
        <td class="normal14a" width="42%"><input   tabIndex="1" id="mr002" onKeyPress="keyFunction()" onchange="startkey(this)" name="mr002" value="<?php echo $mr002; ?>" size="12" type="text" required disabled="disabled"/>
	     <span id="keydisp" ></span></td>
		  <td class="normal14y" width="8%" ><span class="required">分類方式：</span></td>
        <td class="normal14a" width="42%" >
		  <select  tabIndex="2" id="mr001" onKeyPress="keyFunction()"  name="mr001" disabled="disabled">
             <option <?php if($mr001 == '1') echo 'selected="selected"';?> value='1'>1:通路</option>                                                                        
		     <option <?php if($mr001 == '2') echo 'selected="selected"';?> value='2'>2:型態</option>
             <option <?php if($mr001 == '3') echo 'selected="selected"';?> value='3'>3:地區</option>
             <option <?php if($mr001 == '4') echo 'selected="selected"';?> value='4'>4:國家</option>
			 <option <?php if($mr001 == '5') echo 'selected="selected"';?> value='5'>5:路線</option>                                                                        
		     <option <?php if($mr001 == '6') echo 'selected="selected"';?> value='6'>6:其他</option>
             <option <?php if($mr001 == '7') echo 'selected="selected"';?> value='7'>7:抽成</option>
             <option <?php if($mr001 == '8') echo 'selected="selected"';?> value='8'>8:活動</option>
		     <option <?php if($mr001 == '9') echo 'selected="selected"';?> value='9'>9:廠商分類</option>
		  </select>
		  <span id="mr001disp" ></span>
	    </td>
	  </tr>
	  <tr>
	    <td class="normal14z" >分類簡稱：</td>
        <td class="normal14" ><input  tabIndex="3" id="mr003" onKeyPress="keyFunction()" name="mr003"   value="<?php echo  $mr003; ?>"    type="text" disabled="disabled" /></td>
	    <td  class="normal14z" >分類全稱：</td>
        <td  class="normal14"  ><input  tabIndex="4" id="mr004" onKeyPress="keyFunction()" name="mr004"   value="<?php echo  $mr004; ?>"     type="text"  disabled="disabled"/></td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14" ><input  tabIndex="5" id="mr005" onKeyPress="keyFunction()" name="mr005"   value="<?php echo  $mr005; ?>"    type="text" disabled="disabled" /></td>
	    <td  class="normal14" ></td>
        <td  class="normal14"  ></td>
	  </tr>	
    </table>
		
	 <!-- <div class="buttons">
	    <a   accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi15/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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