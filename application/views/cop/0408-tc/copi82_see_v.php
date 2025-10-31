<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?=base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 業務訪問建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/cop/copi82/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?  $mm001=substr($row->mm001,0,4).'/'.substr($row->mm001,4,2).'/'.substr($row->mm001,6,2);?>
          <?  $cmsq09a3=$row->mm002;?>
          <?  $copq81a=$row->mm003;?>
          <?  $mm004=$row->mm004;?>
          <?  $mm005=$row->mm005;?>
		  <?  $cmsq09a3disp=$row->mm002disp;?>
		  <?  $copq81adisp=$row->mm003disp;?>
          <?  $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
      <tr>
	    <td class="start14a" width="10%"><span class="required">訪問日期：</span></td>
        <td class="normal14a" width="40%" >
         <input  tabIndex="1" id="mm001" onKeyPress="keyFunction()"  onclick="scwShow(this,event);"  name="mm001"   value="<?php echo  $mm001; ?>"    type="text" required style="background-color:#E7EFEF" disabled="disabled"/>
		<span id="keydisp" ></span></td>
	    <td class="normal14" width="10%" >業務員代號：</td>
        <td class="normal14" width="40%" ><input   tabIndex="2" id="mm002" onKeyPress="keyFunction()" onchange="startcmsq09a3(this)" name="cmsq09a3" value="<?php echo $cmsq09a3; ?>"  type="text" required disabled="disabled" /><img id="Showcmsq09a3" src="<?=base_url()?>assets/image/png/person.png" alt="" align="top"/></a>
         <span id="cmsq09a3disp"> <?php    echo $cmsq09a3disp; ?> </span></td>
		<td class="normal14a">&nbsp;&nbsp;</td>
        <td class="normal14a"></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" >客戶代號：</td>
        <td class="normal14" ><input   tabIndex="3" id="mm003" onKeyPress="keyFunction()" onchange="startcopq81a(this)" name="copq81a" value="<?php echo $copq81a; ?>"  type="text" required disabled="disabled"/><img id="Showcopq81a" src="<?=base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
         <span id="copq81adisp"> <?php    echo $copq81adisp; ?> </span></td>
		<td class="normal14" >級別區分：</td>
		<td  class="normal14"  ><input type="text" tabIndex="4" id="mm004" onKeyPress="keyFunction()" name="mm004"   value="<?php echo $mm004; ?>"  size="4" disabled="disabled" /></td>	
	  </tr>
		
	  <tr>
	    <td colspan="1" class="normal14" >內容描述：</td>
        <td colspan="3"  class="normal14"><textarea  tabIndex="5" rows="8" cols="50" name="mm005"   id="mm005"  Wrap="Physical"  > <?php echo $mm005; ?> </textarea>  </td>	  
	    <td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>		
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('cop/copi82/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
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
