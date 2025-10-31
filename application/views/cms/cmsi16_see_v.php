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
    <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 金融機構建立作業 - 查看　　　</h1>
	<div style="float:left;padding-top: 5px; ">
	<a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi16/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cms/cmsi16/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mo001=$row->mo001;?>
          <?php   $mo002=$row->mo002;?>
          <?php   $mo003=$row->mo003;?>
          <?php   $mo004=$row->mo004;?>
          <?php   $mo005=$row->mo005;?>
          <?php   $mo006=$row->mo006;?>
		 
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="normal14y" width="12%"><span class="required">金融機構代號：</span></td>
        <td class="normal14a" width="38%" >
         <input  tabIndex="1" id="mo001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mo001"   value="<?php echo  $mo001; ?>"    type="text" required disabled="disabled"/>
		 <span id="keydisp" ></span></td>
	    <td class="normal14y" width="12%">金融機構種類：</td>
        <td class="normal14a"  width="38%"> <select tabIndex="2" id="mo002" onKeyPress="keyFunction()" name="mo002" disabled="disabled" >
            <option <?php if($mo002 == '1') echo 'selected="selected"';?> value='1'>本國銀行 </option>                                                                        
		    <option <?php if($mo002 == '2') echo 'selected="selected"';?> value='2'>外國銀行 </option>
            <option <?php if($mo002 == '3') echo 'selected="selected"';?> value='3'>信託投資 </option>
            <option <?php if($mo002 == '4') echo 'selected="selected"';?> value='4'>票券金融 </option>
			<option <?php if($mo002 == '5') echo 'selected="selected"';?> value='5'>信用合作社 </option>                                                                        
		    <option <?php if($mo002 == '6') echo 'selected="selected"';?> value='6'>產物保險 </option>
            <option <?php if($mo002 == '7') echo 'selected="selected"';?> value='7'>漁會信用 </option>
            <option <?php if($mo002 == '8') echo 'selected="selected"';?> value='8'>農會信用 </option>
			<option <?php if($mo002 == '9') echo 'selected="selected"';?> value='9'>郵局 </option>
		  </select>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >金融機構總行： </td>
        <td class="normal14" ><input   tabIndex="3" id="mo003" onKeyPress="keyFunction()"  name="mo003" value="<?php echo $mo003; ?>" size="20" type="text" disabled="disabled" /></td>
		<td class="normal14z" >金融機構地區：</td>
		<td class="normal14"><input  tabIndex="4" id="mo004" onKeyPress="keyFunction()"  name="mo004"   value="<?php echo  $mo004; ?>"  size="20"  type="text" disabled="disabled" /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >金融機構分行：</td>
        <td  class="normal14"  >
		 <input  tabIndex="5" id="mo005" onKeyPress="keyFunction()"  name="mo005"   value="<?php echo  $mo005; ?>"  size="20"  type="text" disabled="disabled" /></td>
	    <td class="normal14z">金融機構名稱：</td>		
        <td  class="normal14"  > <input  tabIndex="6" id="mo006" onKeyPress="keyFunction()"  name="mo006"   value="<?php echo  $mo006; ?>" size="60"   type="text" disabled="disabled" /></td>
	  </tr>
    </table>
		
	 <!-- <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi16/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
