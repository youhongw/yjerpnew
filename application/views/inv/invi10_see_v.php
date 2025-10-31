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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 儲位條碼建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/inv/invi10/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mz001=$row->mz001;?>
		  <?php   $mz001disp=$row->mz001disp;?>
          <?php   $mz002=$row->mz002;?>
          <?php   $mz003=$row->mz003;?>
		   <?php   $mz004=$row->mz004;?>
          <?php   $mz005=$row->mz005;?>
          <?php   $mz006=$row->mz006;?>
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="normal14z" width="11%">品號：</td>
        
		<td  class="normal14a" width="89%" ><input tabIndex="4" id="invi02" readonly="value" onKeyPress="keyFunction()"  ondblclick="search_invi02_window()"  onchange="check_invi02(this)" name="mz001" value="<?php echo $mz001; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showinvi02disp" src="<?php echo base_url()?>assets/image/png/seek.png" alt="" align="top"/></a>
          <span id="invi02disp" ></span> <span id="invi02disp1" ></span> <span id="invi02disp2"> <?php   echo $mz001disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >儲位條碼：</td>
        <td class="normal14a"  > <input  tabIndex="2" id="mz002" readonly="value" onKeyPress="keyFunction()"  name="mz002"   value="<?php echo  $mz002; ?>"    type="text"  />
		
	  </tr>	
		  
	  <tr>
		<td class="normal14z" >容器編號：</td>
		<td class="normal14a"><input  tabIndex="5" id="mz003" onKeyPress="keyFunction()"  name="mz003"   value="<?php echo  $mz003; ?>"    type="text"  /> </td>
       </tr>
	  <tr>
	   <td class="normal14z" >異動日期：</td>
		
        <td class="normal14a"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mz004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mz004"  value="<?php echo $mz004; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mz004,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	   <td class="normal14z" >數量：</td>
		<td class="normal14"><input  tabIndex="5" id="mz005" onKeyPress="keyFunction()"  name="mz005"   value="<?php echo  $mz005; ?>"    type="text"  /> </td>
      </tr>
	  <tr>
	   <td class="normal14z" >備註：</td>
		<td class="normal14a"><input  tabIndex="5" id="mz006" onKeyPress="keyFunction()"  name="mz006"   value="<?php echo  $mz006; ?>"    type="text"  /> </td>
      </tr>
		
	 
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('inv/invi10/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>