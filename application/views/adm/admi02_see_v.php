<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>-->
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 程式代號建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('adm/admi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/adm/admi02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">  <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mb001=$row->mb001;?>
          <?php   $mb002=$row->mb002;?>
          <?php   $mb003=$row->mb003;?>
		  <?php   $mb004=$row->mb004;?>
		  <?php   $mb005=$row->mb005;?>
		  <?php   $mb006=$row->mb006;?>
        
	<?php  }?>
      
	<table class="form14">
	  <tr>
	    <td class="normal14y" width="11%" ><span class="required">程式代號：</span> </td>
        <td class="normal14a" width="39%" ><input   tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="checkspace2()" name="mb001" value="<?php echo $mb001; ?>" disabled="disabled" type="text" required /></td>
		<td class="normal14a" width="10%" ></td>
        <td class="normal14a"  width="40%" ></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >程式名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mb002" onKeyPress="keyFunction()" name="mb002"   value="<?php echo  $mb002; ?>"  disabled="disabled" /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >類  型：</td>
		<td class="normal14"  ><select tabIndex="3" id="mb003" onKeyPress="keyFunction()" name="mb003"  disabled="disabled" >
               <option <?php if($mb003 == '2') echo 'selected="selected"';?> value='2'>2.維護</option>                                                                        
		       <option <?php if($mb003 == '1') echo 'selected="selected"';?> value='1'>1.設定</option>
               <option <?php if($mb003 == '3') echo 'selected="selected"';?> value='3'>3.查詢</option>
               <option <?php if($mb003 == '4') echo 'selected="selected"';?> value='4'>4.批次</option>
			   <option <?php if($mb003 == '5') echo 'selected="selected"';?> value='5'>5.單檔</option>
			   <option <?php if($mb003 == '6') echo 'selected="selected"';?> value='6'>6.多檔</option>
			   <option <?php if($mb003 == '7') echo 'selected="selected"';?> value='7'>7.多檔</option>
			   <option <?php if($mb003 == 'A') echo 'selected="selected"';?> value='A'>A.清單</option>
			   <option <?php if($mb003 == 'B') echo 'selected="selected"';?> value='B'>B.統計</option>
		    </select>
		</td>		
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >系統代號：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="mb004" onKeyPress="keyFunction()" name="mb004"   value="<?php echo  $mb004; ?>" disabled="disabled"  /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >備  註：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="mb005" onKeyPress="keyFunction()" name="mb005"   value="<?php echo  $mb005; ?>"  disabled="disabled" /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >報表否Y/N：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="mb006" onKeyPress="keyFunction()" name="mb006"   value="<?php echo  strtoupper($mb006); ?>" disabled="disabled"  /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	 
		 
    </table>
		
	 <!-- <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('adm/admi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
    </form>
	<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
  	
    </div> <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>    <!-- div-4 -->

    </div>  <!-- div-3 -->
 </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 