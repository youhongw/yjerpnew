<div id="container">  <!-- div-1 -->
  <div id="header">   <!-- div-2 -->
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
 <div class="box">  <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄性質設定(收款單) - 查看　　　</h1>
	<div style="float:left;padding-top: 5px; ">
	<a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi08/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsi08/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">  <!-- div-5 -->
	<div id="tab-general">  <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mb001=$row->mb001;?>
          <?php   $acrq01a63=$row->mb002;?>
		  <?php   $acrq01a63disp=$row->mb002disp;?>
		  <?php   $actq02a=$row->mb003;?>
          <?php   $actq02adisp=$row->mb003disp;?>
		  <?php   $mb004=$row->mb004;?>
		  <?php   $mb021=$row->mb021;?>
		  <?php   $ajsi31=$row->mb018;?>
		  <?php   $ajsi31a=$row->mb022;?>
		  <?php   $ajsi31disp=$row->mb018;?>
		  <?php   $ajsi31adisp=$row->mb022;?>
        
	<?php  }?>
      
	<table class="form14">
         
	   <tr>
	    <td class="normal14y"  width="12%" ><span class="required">收款單性質代號：</span> </td>
        <td class="normal14"  width="88%"><input type="text"  tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mb001" value="<?php echo $mb001; ?>"  readonly="readonly" disabled="disabled"  required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >收款單單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="mb002"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startacrq01a63(this)"  name="acrq01a63" value="<?php echo strtoupper($acrq01a63); ?>"  type="text"  disabled="disabled"  required />
		<a href="javascript:;"><img id="Showacrq01a63" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="acrq01a63disp"> <?php    echo $acrq01a63disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >傳票單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="mb003"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startactq02a(this)"  name="actq02a" value="<?php echo strtoupper($actq02a); ?>"  type="text" disabled="disabled" required />
		<a href="javascript:;"><img id="Showactq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="actq02adisp"> <?php    echo $actq02adisp; ?> </span></td>
	  </tr>
	  <tr>
	    <td  class="normal14z" >底稿開立方式：</td>
        <td  class="normal14" ><input type="radio" name="mb004" <?php if (isset($mb004) && $mb004=="1") echo "checked";?> value="1" />逐張  &nbsp;&nbsp;&nbsp; 
               <input type="radio" name="mb004" <?php if (isset($mb004) && $mb004=="2") echo "checked";?> value="2" />彙總
        </td>
	  </tr>	
	 <tr>
	    <td  class="normal14z" >同單號科目彙總：</td>
        <td  class="normal14" ><input type="hidden" name="mb021" value="N" />
		<input tabIndex="12" type="checkbox"  id="mb021" onKeyPress="keyFunction()"   name="mb021" <?php if($mb021 == 'Y' ) echo 'checked'; ?>  <?php if($mb021 !== 'Y' ) echo 'check'; ?> value="Y" size="1"  disabled="disabled"   /></td>
	  </tr>	
	   <tr>
	    <td class="normal14z" >借方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31" class="mb018" onKeyPress="keyFunction()" name="ajsi31"  onchange="check_ajsi31(this)"  value="<?php echo  $ajsi31; ?>"     size="12"  disabled="disabled"    />
		 <a href="javascript:;"><img id="Showajsi31disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31disp"><?php  echo $ajsi31disp; ?></span></td> 
	  </tr>
	   <tr>
	    <td class="normal14z" >貸方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31a" class="mb022" onKeyPress="keyFunction()" name="ajsi31a"  onchange="check_ajsi31a(this)"  value="<?php echo  $ajsi31a; ?>"     size="12"  disabled="disabled"    />
		 <a href="javascript:;"><img id="Showajsi31adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31adisp"><?php  echo $ajsi31adisp; ?></span></td>
	  </tr>
		 
    </table>
		
	 <!--  <div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi08/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div>-->
    </form>
		<?php if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.' ' ?> </div>  <?php } ?>
 
    </div> <!-- div-6 -->
  </div>   <!-- div-5 -->
</div>    <!-- div-4 -->

    </div>  <!-- div-3 -->
 </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php  include_once("./application/views/funnew/fun_disabled_v.php"); ?> 