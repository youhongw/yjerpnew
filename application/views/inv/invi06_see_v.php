<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 實盤資料建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi06/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
           <?php    $td1001=$row->td1001;?>
          <?php    $td1002=substr($row->td1002,0,4).'/'.substr($row->td1002,4,2).'/'.substr($row->td1002,6,2);?>
          <?php    $cmsq03a=$row->td1003;?>
		  <?php    $cmsq03adisp=$row->td1003disp;?>
          <?php    $td1004=$row->td1004;?>
		  <?php    $invq02a=$row->td1005;?>
	      <?php    $invq02adisp=$row->td1005disp.$row->td1005disp1.$row->td1005disp2;?>
		  <?php    $td1006=$row->td1006;?>
          <?php    $flag=$row->flag;?>	  
	<?php  }?>
      
	<table class="form14">
      <tr>
	    <td class="start14a" width="11%"><span class="required">盤點底稿編號：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="td1001" onKeyPress="keyFunction()" onchange="startkey(this)" name="td1001"   value="<?php echo  $td1001; ?>"    type="text" required disabled="disabled"/>
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="8%">盤點日期：</td>
        <td class="normal14a"  width="42%"> <input  tabIndex="2" onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  id="td1002" onKeyPress="keyFunction()"  name="td1002"   value="<?php echo  $td1002; ?>"    type="text" style="background-color:#E7EFEF" disabled="disabled"/>
		
	  </tr>	
		  
	  <tr>
	    <td class="normal14" >庫別代號： </td>
        <td class="normal14" ><input   tabIndex="3" id="td1003" onKeyPress="keyFunction()" onchange="startcmsq03a(this)" name="cmsq03a" value="<?php echo $cmsq03a; ?>"  type="text" disabled="disabled" /><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
		<td class="normal14" >儲位：</td>
		<td class="normal14">
			   <input  tabIndex="4" id="td1004" onKeyPress="keyFunction()"  name="td1004"   value="<?php echo  $td1004; ?>"    type="text" disabled="disabled" />
        </td>
	  </tr>
	   <tr>
	    <td class="normal14" >品號： </td>
        <td class="normal14" ><input   tabIndex="5" id="td1005" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" disabled="disabled" /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span></td>
		<td class="normal14" >實盤數量：</td>
		<td class="normal14"><input  tabIndex="4" id="td1006" onKeyPress="keyFunction()"  name="td1006"   value="<?php echo  $td1006; ?>"    type="text"  disabled="disabled" /></td>
	  </tr>
	 
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi06/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
