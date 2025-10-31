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

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 工程品號建立作業 - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#mi001').focus();" tabIndex="8" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ebo/eboi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ebo/eboi02/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $invq02a=$row->mi001;?>
		  <?php   $invq02adisp=$row->mi001disp;?>
		  <?php   $invq02adisp1=$row->mi001disp1;?>
		  <?php   $invq02adisp1=$row->mi001disp1;?>
		  
          <?php   $mi002=$row->mi002;?>
		  <?php   $mi003=$row->mi003;?>
		  <?php   $mi004=$row->mi004;?>
		  <?php   $invi01a=$row->mi005;?>		  
		  <?php   $invi01adisp=$row->mi005disp;?>
         
          <?php   $mi006=$row->mi006;?>
		  <?php   $bomi07=$row->mi007;?>
		  <?php   $bomi07disp=$row->mi007disp;?>
		  <?php   $mi008=$row->mi008;?>
		  <?php   $mi009=$row->mi009;?>
		  <?php   $mi010=$row->mi010;?>
		  <?php   $mi011=$row->mi011;?>
		  <?php   $mi012=$row->mi012;?>
		 
          <?php   $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">  <!-- 表格 -->
       <tr>
	    <td class="normal14y" width="10%"><span class="required">品號：</span></td>
        <td class="normal14a" width="40%" ><input   tabIndex="1" id="mi001" onKeyPress="keyFunction()" onchange="startinvq02a(this)" name="invq02a" value="<?php echo $invq02a; ?>"  type="text" required />
		<img id="Showinvq02adisp" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span><span id="invq02adisp1"> <?php    echo $invq02adisp1; ?> </span></td>
	    <td class="normal14y" width="10%"><span >正式品號：</span></td>
        <td class="normal14a"  width="40%"> <input  tabIndex="4" onKeyPress="keyFunction()" id="mi006" name="mi006"  value="<?php echo $mi006; ?>"  type="text" readonly="readonly" style="background-color:#E7EFEF" /></td>
       
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" ><span >品名： </span></td>
        <td class="normal14" ><input  tabIndex="4" onKeyPress="keyFunction()" id="mi002" name="mi002"  value="<?php echo $mi002; ?>"  type="text"  /></td>
		<td class="normal14z" >規格：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" id="mi003" name="mi003"  value="<?php echo $mi003; ?>"  type="text"  /></td>	
	  </tr>
		<tr>
	    <td class="normal14z" ><span >單位： </span></td>
        <td class="normal14" ><input  tabIndex="4" onKeyPress="keyFunction()" id="mi004" name="mi004"  value="<?php echo $mi004; ?>"  type="text"  /></td>
		<td class="normal14z" >會計：</td>
		<td class="normal14"><input type="text" tabIndex="9" id="invi01a" class="invi01a" onKeyPress="keyFunction()"   onchange="startinvi01a(this)" name="invi01a"   value="<?php echo  trim($invi01a); ?>"    size="6"   />
		<a href="javascript:;"><img id="Showinvi01adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invi01adisp"> <?php  echo $invi01adisp; ?> </span></td></tr>
	  
	  <tr>
	    <td class="normal14z" ><span >標準途程品號： </span></td>
        <td class="normal14" ><input type="text" tabIndex="16" id="bomi07" class="bomi07" onKeyPress="keyFunction()" name="bomi07" onchange="check_bomi07(this)" value="<?php echo $bomi07; ?>"  size="10"    />
		<img id="Showbomi07disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>		
	     <span id="bomi07disp"> <?php   echo $bomi07disp; ?> </span></td>
		 <td class="normal14z" >標準途程代號：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" id="mi008" name="mi008"  value="<?php echo $mi008; ?>"  type="text"  /></td>	
	  </tr>
	  <tr>
	    <td class="normal14z" ><span >品號屬性： </span></td>
        <td class="normal14" ><select tabIndex="27" id="mi009" onKeyPress="keyFunction()" name="mi009" >
            <option <?php if($mi009 == 'P') echo 'selected="selected"';?> value='P'>採購件 </option>                                                                        
		    <option <?php if($mi009 == 'M') echo 'selected="selected"';?> value='M'>自製件 </option>
            <option <?php if($mi009 == 'S') echo 'selected="selected"';?> value='S'>託外加工件 </option>
            <option <?php if($mi009 == 'Y') echo 'selected="selected"';?> value='Y'>虛設品號 </option>
		  </select>
		</td><td class="normal14z" >標準進價：</td>
		<td class="normal14"><input  tabIndex="4" onKeyPress="keyFunction()" id="mi010" name="mi010"  value="<?php echo $mi010; ?>"  type="text"  /></td>	
	  </tr>
	  
	  
	   <tr>
	    <td  class="normal14z" >保稅品：</td>
        <td  class="normal14"  ><input type="hidden" name="mi011"   value="N" />
		  <input type='checkbox'  tabIndex="13" id="mi011"  onKeyPress="keyFunction()" name="mi011" <?php if($mi011 == 'Y' ) echo 'checked'; ?>  <?php if($mi011 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
       <td class="normal14z">備註：</td>		
        <td  class="normal14"  ><input type="text" tabIndex="12" id="mi012"      onKeyPress="keyFunction()"    name="mi012" value="<?php echo $mi012; ?>"  /></td>
	  </tr>
        </table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	 <!-- <div class="buttons">
	    <button tabIndex="8" type='submit' accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ebo/eboi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	   </div>-->
	   
        </form>
		<?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

    </div> <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

 <?php include_once("./application/views/fun/eboi02_funjs_v.php"); ?> 
  <?php include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/invi01_funmjs_v.php"); ?>  <!-- 品號類別 -->
 <?php  include_once("./application/views/funnew/bomi07_funmjs_v.php"); ?>  <!-- 途程品號 -->
