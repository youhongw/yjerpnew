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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 每月發票資料建立 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi03/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pos/posi03/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $cmsq11a=$row->mb001;?>
          <?php   $mb002=$row->mb002;?>
		   <?php   $mb003=$row->mb003;?>
          <?php   $mb005=$row->mb005;?>
          <?php   $mb004=$row->mb004;?>
          <?php   $mb005=$row->mb005;?>
          <?php   $mb006=$row->mb006;?>
		  <?php   $mb007=$row->mb007;?>
		  <?php   $mb008=$row->mb008;?>
		  <?php   $mb009=$row->mb009;?>
		  <?php   $cmsq11adisp=$row->mb001disp;?>
          <?php   $flag=$row->flag;?>	
         
	<?php  }?>
      
	<table class="form14">
        <tr>
	    <td class="normal14y" width="9%"><span class="required">申報公司：</span></td>
        <td class="normal14a" width="24%" ><input   tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startcmsq11a(this)" name="cmsq11a" value="<?php echo $cmsq11a; ?>"  type="text" required disabled="disabled"/><img id="Showcmsq11a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="cmsq11adisp"> <?php    echo $cmsq11adisp; ?> </span></td>
        
	    <td class="normal14y" width="10%">起始年月：</td>
        <td class="normal14a"  width="23%"> <input  tabIndex="2" id="mb002" onKeyPress="keyFunction()"  onChange="dataym1(this)" name="mb002"   value="<?php echo  $mb002; ?>"  style="background-color:#E7EFEF"  type="text"  disabled="disabled"/></td>
		<td class="normal14y"  width="10%"> 截止年月：</td>
        <td class="normal14a" width="23%"> <input  tabIndex="3" id="mb003" onKeyPress="keyFunction()"   onChange="dataym2(this)" name="mb003"   value="<?php echo  $mb003; ?>"   style="background-color:#E7EFEF" type="text" disabled="disabled" /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >發票聯數：</td>
		<td class="normal14">                                                            
			<select id="mb004" onKeyPress="keyFunction()" name="mb004" " tabIndex="52">
			<option <?php if($mb004 == '3') echo 'selected="selected"';?> value='3'>二聯式收銀機發票</option>
		    <option <?php if($mb004 == '1') echo 'selected="selected"';?> value='1'>二聯式發票</option> 
		    <option <?php if($mb004 == '2') echo 'selected="selected"';?> value='2'>三聯式發票</option>
            <option <?php if($mb004 == '4') echo 'selected="selected"';?> value='4'>三聯式收銀機發票</option>
            <option <?php if($mb004 == '5') echo 'selected="selected"';?> value='5'>電子計算機發票</option>
            <option <?php if($mb004 == '6') echo 'selected="selected"';?> value='6'>無紙發票証明聯</option>
			<option <?php if($mb004 == '7') echo 'selected="selected"';?> value='7'>免用統一發票</option>
		</select></td>
		<td class="normal14z" >使用順序碼：</td>
        <td class="normal14" ><input  tabIndex="5" onKeyPress="keyFunction()" id="mb005" name="mb005"  value="<?php echo $mb005; ?>"  type="text" disabled="disabled" /></td>	
       <td class="normal14z"> 起始編號：</td>
        <td class="normal14" ><input  tabIndex="6" onKeyPress="keyFunction()" id="mb006" name="mb006"  value="<?php echo $mb006; ?>"  type="text" disabled="disabled" /></td>	
	  </tr>
		
	  <tr>
	      <td class="normal14z"> 截止編號：</td>
        <td class="normal14" ><input  tabIndex="7" onKeyPress="keyFunction()" id="mb007" name="mb007"  value="<?php echo $mb007; ?>"  type="text" disabled="disabled" /></td>	
		 <td class="normal14z"> 已用編號：</td>
        <td class="normal14" ><input  tabIndex="8" onKeyPress="keyFunction()" id="mb008" name="mb008"  value="<?php echo $mb008; ?>"  type="text" disabled="disabled" /></td>	
		 <td class="normal14"></td>
        <td class="normal14" ></td>	
		
	  </tr>
	  
	  <tr>		
		<td class="normal14z"> 備註：</td>
        <td colspan="3" class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="mb009" name="mb009"  value="<?php echo $mb009; ?>" size="80" type="text" disabled="disabled" /></td>	
	
	  </tr>
    </table>
		
	 <!-- <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi03/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
