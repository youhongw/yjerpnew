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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 費用資料建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ips/ipsi01/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $ma001=$row->ma001;?>
          <?php   $ma002=$row->ma002;?>
          <?php   $actq03a=$row->ma003;?>
		  <?php   $actq03adisp=$row->ma003disp;?>
          <?php   $ma004=$row->ma004;?>
		   <?php   $ma005=$row->ma005;?>
	<?php  }?>
      
	<table class="form14">
      <tr>
	    <td class="start14a" width="8%"><span class="required">費用代號：</span></td>
        <td class="normal14a" width="42%" >
         <input  tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma001"   value="<?php echo  $ma001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="8%">費用名稱：</td>
        <td class="normal14a"  width="42%"> <input  tabIndex="2" id="ma002" onKeyPress="keyFunction()"  name="ma002"   value="<?php echo  $ma002; ?>"    type="text"  />
		
	  </tr>	
		  
	  <tr>
	    <td class="normal14" >會計科目： </td>
        <td class="normal14" ><input   tabIndex="3" id="ma003" onKeyPress="keyFunction()" onchange="startactq03a(this)" name="actq03a" value="<?php echo $actq03a; ?>"  type="text" /><img id="Showactq03a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="actq03adisp"> <?php    echo $actq03adisp; ?> </span></td>
		<td class="normal14" >備註：</td>
		<td class="normal14">
			   <input  tabIndex="4" id="ma005" onKeyPress="keyFunction()"  name="ma005"   value="<?php echo  $ma005; ?>"    type="text"  />
        </td>
	  </tr>
	 
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ips/ipsi01/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?>      <!-- see js -->