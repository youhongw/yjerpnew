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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 業務訪問建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/cop/copi82/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $mm001=substr($row->mm001,0,4).'/'.substr($row->mm001,4,2).'/'.substr($row->mm001,6,2);?>
          <?php   $cmsq09a3=$row->mm002;?>
          <?php   $copq81a=$row->mm003;?>
          <?php   $mm004=$row->mm004;?>
          <?php   $mm005=$row->mm005;?>
		   <?php   $mm006=$row->mm006;?>
		  <?php   $mm007=$row->mm007;?>
		  <?php   $mm008=$row->mm008;?>
		  <?php   $mm009=$row->mm009;?>
		  <?php   $mm010=$row->mm010;?>
		  <?php   $cmsq09a3disp=$row->mm002disp;?>
		  <?php   $copq81adisp=$row->mm003disp;?>
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
      <tr>
	    <td class="normal14y" width="10%"><span class="required">訪問日期：</span></td>
        <td class="normal14a" width="23%" >
         <input  tabIndex="1" id="mm001" onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="mm001"   value="<?php echo  $mm001; ?>"    type="text" required style="background-color:#E7EFEF" disabled="disabled"/>
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="10%" >業務員代號：</td>
        <td class="normal14" width="23%" ><input   tabIndex="2" id="mm002" onKeyPress="keyFunction()" onchange="startcmsq09a3(this)" name="cmsq09a3" value="<?php echo $cmsq09a3; ?>"  type="text" required disabled="disabled" /><img id="Showcmsq09a3" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
		<td class="normal14y" width="10%">&nbsp;&nbsp;</td>
        <td class="normal14a" width="24%"></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >客戶代號：</td>
        <td class="normal14" ><input   tabIndex="3" id="mm003" onKeyPress="keyFunction()" onchange="startcopq81a(this)" name="copq81a" value="<?php echo $copq81a; ?>"  type="text" required disabled="disabled"/><img id="Showcopq81a" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
         <span id="copq81adisp"> <?php    echo $copq81adisp; ?> </span></td>
		<td class="normal14z" >級別區分：</td>
		<td  class="normal14"  ><input type="text" tabIndex="4" id="mm004" onKeyPress="keyFunction()" name="mm004"   value="<?php echo $mm004; ?>"  size="4" disabled="disabled" /></td>	
	     <td class="normal14z">客戶類別</td>
        <td class="normal14"><input type="text" tabIndex="4" id="mm008" onKeyPress="keyFunction()" name="mm008"   value="<?php echo $mm008; ?>"  size="10" disabled="disabled" /></td>
	  </tr>
		
	  <tr>
	    <td colspan="1" class="normal14z" >內容描述：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="5" rows="8" cols="50" name="mm005"   id="mm005"  Wrap="Physical"  > <?php echo $mm005; ?> </textarea>  </td>	  
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>	
      <tr>
	    <td colspan="1" class="normal14z" >審核批示：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="5" rows="8" cols="50" name="mm009"   id="mm009"  Wrap="Physical"  > <?php echo $mm009; ?> </textarea>  </td>	  
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>			  
	  <tr>
	    <td colspan="1" class="normal14z" >核准批示：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="5" rows="8" cols="50" name="mm010"   id="mm010"  Wrap="Physical"  > <?php echo $mm010; ?> </textarea>  </td>	  
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>	
    </table>
		
	<!--  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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