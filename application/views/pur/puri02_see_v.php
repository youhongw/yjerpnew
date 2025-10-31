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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 品號廠商建立作業 - 查看　　　</h1>
	  <div style="float:left;padding-top: 5px; ">
	  <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pur/puri02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
            <?php   $invq02a=$row->mb001;?>
		  <?php   $invq02adisp=$row->mb001disp;?>
		  <?php   $invq02adisp1=$row->mb001disp1;?>
          <?php   $purq01a=$row->mb002;?>
		  <?php   $purq01adisp=$row->mb002disp;?>
          <?php   $cmsq06a=$row->mb003;?>
		  <?php   $cmsq06adisp=$row->mb003disp;?>
          <?php   $mb004=$row->mb004;?>
		  
          <?php   $mb005=$row->mb005;?>
		  <?php   $mb007=$row->mb007;?>
		  <?php   $mb008=$row->mb008;?>
		  <?php   $mb009=$row->mb009;?>
		  <?php   $mb010=$row->mb010;?>
		  <?php   $mb011=$row->mb011;?>
		  <?php   $mb012=$row->mb012;?>
		  <?php   $mb013=$row->mb013;?>
		   <?php  if ($row->mb005>'0') {$mb005=substr($row->mb005,0,4).'/'.substr($row->mb005,4,2).'/'.substr($row->mb005,6,2);} else {$mb005='';} ?>
		    <?php  if ($row->mb008>'0') {$mb008=substr($row->mb008,0,4).'/'.substr($row->mb008,4,2).'/'.substr($row->mb008,6,2);} else {$mb008='';} ?>
			 <?php  if ($row->mb009>'0') {$mb009=substr($row->mb009,0,4).'/'.substr($row->mb009,4,2).'/'.substr($row->mb009,6,2);} else {$mb009='';} ?>
		  <?php  if ($row->mb014>'0') {$mb014=substr($row->mb014,0,4).'/'.substr($row->mb014,4,2).'/'.substr($row->mb014,6,2);} else {$mb014='';} ?>
		 <?php  if ($row->mb015>'0') {$mb015=substr($row->mb015,0,4).'/'.substr($row->mb015,4,2).'/'.substr($row->mb015,6,2);} else {$mb015='';} ?>
		
		 
          <?php   $flag=$row->flag;?>	
	<?php  }?>
      
	<table class="form14">
        <tr>
	    <td class="normal14y" width="8%"><span class="required">品號：</span></td>
        <td class="normal14a" width="42%" ><input readonly="value"  tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" required disabled="disabled" /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span><span id="invq02adisp1"> <?php    echo $invq02adisp1; ?> </span></td>
	    <td class="normal14y" width="10%"><span class="required">廠商代號：</span></td>
        <td class="normal14a"  width="40%"> <input readonly="value"  tabIndex="2" id="mb002" onKeyPress="keyFunction()" onchange="startpurq01a(this)" name="purq01a" value="<?php echo $purq01a; ?>"  type="text" required disabled="disabled"/><img id="Showpurq01a" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
         <span id="purq01adisp"> <?php    echo $purq01adisp; ?> </span></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" ><span class="required">幣別：</span> </td>
        <td class="normal14" ><input readonly="value"  tabIndex="3" id="mb003" onKeyPress="keyFunction()" onchange="startcmsq06a(this)" name="cmsq06a" value="<?php echo $cmsq06a; ?>"  type="text" required disabled="disabled"/><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
         <span id="cmsq06adisp"> <?php    echo $cmsq06adisp; ?> </span> </td>
		<td class="normal14z" >廠商品號：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" id="mb007" name="mb007"  value="<?php echo $mb007; ?>"  type="text" disabled="disabled" /></td>	
	  </tr>
		
	  <tr>
	    <td  class="normal14z" >核價日：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" id="mb008"  onclick="scwShow(this,event);"     onKeyPress="keyFunction()"    name="mb008" value="<?php echo $mb008; ?>"  disabled="disabled" /></td>	  
	    <td class="normal14z">生效日：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="6" id="mb014"  onclick="scwShow(this,event);"     onKeyPress="keyFunction()"    name="mb014" value="<?php echo $mb014; ?>"  disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >失效日：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7" id="mb015"  onclick="scwShow(this,event);"     onKeyPress="keyFunction()"    name="mb015" value="<?php echo $mb015; ?>" disabled="disabled" /></td>	  
	    <td class="normal14z">採購單價：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="8" id="mb011"      onKeyPress="keyFunction()"    name="mb011" value="<?php echo $mb011; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >初次交易：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" id="mb005"  onclick="scwShow(this,event);"     onKeyPress="keyFunction()"    name="mb005" value="<?php echo $mb005; ?>" disabled="disabled" /></td>	  
	    <td class="normal14z">上次進貨日：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="10" id="mb009"  onclick="scwShow(this,event);"     onKeyPress="keyFunction()"    name="mb009" value="<?php echo $mb009; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >計價單位：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11" id="mb004"      onKeyPress="keyFunction()"    name="mb004" value="<?php echo $mb004; ?>"  disabled="disabled"/></td>	  
	    <td class="normal14z">備註：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="mb012"      onKeyPress="keyFunction()"    name="mb012" value="<?php echo $mb012; ?>" disabled="disabled" /></td>
	  </tr>
	   <tr>
	    <td  class="normal14z" >分量計價：</td>
        <td  class="normal14"  ><input type="hidden" name="mb010" class="mb010"  value="N" />
		  <input  type='checkbox' id="mb010" tabIndex="13" onKeyPress="keyFunction()" name="mb010" <?php if($mb010 == 'Y' ) echo 'checked'; ?>  <?php if($mb010 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled"  />
        </td>	  
	    <td class="normal14z">含稅：</td>		
        <td  class="normal14"  ><input type="hidden" name="mb013" class="mb013"  value="N" />
		  <input  type='checkbox' id="mb013" tabIndex="14" onKeyPress="keyFunction()" name="mb013" <?php if($mb013 == 'Y' ) echo 'checked'; ?>  <?php if($mb013 != 'Y' ) echo 'check'; ?> value="Y" size="1" disabled="disabled" />
        </td>
	  </tr>
    </table>
		
	  <!--<div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pur/puri02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
