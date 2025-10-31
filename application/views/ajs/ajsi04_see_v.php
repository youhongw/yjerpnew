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
 <div class="box">  <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 分錄性質設定(銷貨成本) - 查看　　　</h1>
	 <div style="float:left;padding-top: 5px; ">
	 <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi04/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ajs/ajsi04/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content">  <!-- div-5 -->
	<div id="tab-general">  <!-- div-6 -->
	<?php foreach($result as $row) { ?>
            <?php   $mb001=$row->mb001;?>
          <?php   $copq03a23=$row->mb002;?>
		  <?php   $copq03a23disp=$row->mb002disp;?>
		  <?php   $actq02a=$row->mb003;?>
          <?php   $actq02adisp=$row->mb003disp;?>
		  <?php   $mb004=$row->mb004;?>
		  <?php   $mb005=$row->mb005;?>
		  <?php   $mb021=$row->mb021;?>
		  <?php   $ajsi31=$row->mb018;?>
		  <?php   $ajsi31a=$row->mb022;?>
		  <?php   $ajsi31disp=$row->mb018disp;?>
		  <?php   $ajsi31adisp=$row->mb022disp;?>
		  
		  <?php   $mb006=$row->mb006;?>
		  <?php   $mb006disp=$row->mb006disp;?>
		  <?php   $mb007=$row->mb007;?>
		  <?php   $mb007disp=$row->mb007disp;?>
		  <?php   $mb012=$row->mb012;?>
		   <?php   $mb013=$row->mb013;?>
		   <?php   $mb013disp=$row->mb013disp;?>
		  <?php   $mb012disp=$row->mb012disp;?>
		 <?php   $mb019=$row->mb019;?>
		 <?php   $mb020=$row->mb020;?>
        
	<?php  }?>
      
	<table class="form14">
         
	    <tr>
	    <td class="normal14y"  width="14%" ><span class="required">銷貨成本性質代號：</span> </td>
        <td class="normal14"  width="86%"><input type="text"  tabIndex="1" id="mb001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mb001" value="<?php echo $mb001; ?>"   required />
	        <span id="keydisp" ></span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14z" >銷貨成本單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="copq03a23"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startcopq03a23(this)"  name="copq03a23" value="<?php echo strtoupper($copq03a23); ?>"  type="text" required />
		<a href="javascript:;"><img id="Showcopq03a23" src="<?=base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="copq03a23disp"> <?php    echo $copq03a23disp; ?> </span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >傳票單別：</td>
		<td class="normal14"  ><input tabIndex="1" id="mb003"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startactq02a(this)"  name="actq02a" value="<?php echo strtoupper($actq02a); ?>"  type="text" required />
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
		<input tabIndex="12" type="checkbox"  id="mb021" onKeyPress="keyFunction()"   name="mb021" <?php if($mb021 == 'Y' ) echo 'checked'; ?>  <?php if($mb021 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>	
	  
	   <tr>
	    <td class="normal14z" >借方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31" class="mb018" onKeyPress="keyFunction()" name="ajsi31"  onchange="check_ajsi31(this)"  value="<?php echo  $ajsi31; ?>"     size="12"    />
		 <a href="javascript:;"><img id="Showajsi31disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31disp"><?php  echo $ajsi31disp; ?></span></td> 
	  </tr>
	   <tr>
	    <td class="normal14z" >貸方摘要來源：</td>
		<td class="normal14"  ><input  type="text"  tabIndex="14" id="ajsi31a" class="mb022" onKeyPress="keyFunction()" name="ajsi31a"  onchange="check_ajsi31a(this)"  value="<?php echo  $ajsi31a; ?>"     size="12"    />
		 <a href="javascript:;"><img id="Showajsi31adisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="ajsi31adisp"><?php  echo $ajsi31adisp; ?></span></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >借方會計科目銷貨：</td>		
        <td class="normal14"  >
			<input tabIndex="22" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $mb006; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $mb006disp; ?> </span>
		</td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >借方會計科目贈品：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $mb007; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $mb007disp; ?> </span>
		</td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >貸方會計科目備品：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03b" onKeyPress="keyFunction()" name="acti03b" onblur="check_acti03b(this);"  value="<?php echo $mb012; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03bdisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03bdisp"> <?php echo $mb012disp; ?> </span>
		</td>
	  </tr>	
	  <tr>
	    <td class="normal14z" >貸方會計科目存貨：</td>
        <td class="normal14"  >
			<input tabIndex="23" id="acti03c" onKeyPress="keyFunction()" name="acti03c" onblur="check_acti03c(this);"  value="<?php echo $mb013; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03cdisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03cdisp"> <?php echo $mb013disp; ?> </span>
		</td>
	  </tr>	
	  <tr>
	    <td class="normal14z"   ><span class="required">分錄類別：</span> </td>
        <td class="normal14" ><input type="text"  tabIndex="1" id="mb020" onKeyPress="keyFunction()"  name="mb020" value="<?php echo $mb020; ?>"  readonly="readonly"  />
	        <span id="keydisp" ></span></td>
		
	  </tr>
		 
    </table>
		
	  <!--<div class="buttons">
	    <a accesskey="x" tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('ajs/ajsi04/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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