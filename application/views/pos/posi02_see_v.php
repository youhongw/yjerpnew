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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 門市基本資料建立 - 查看　　　</h1>
	<div style="float:left;padding-top: 5px; ">
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pos/posi02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
         <?php   $ma001=$row->ma001;?>
          <?php   $ma002=$row->ma002;?>
		   <?php   $ma003=$row->ma003;?>
          <?php   $cmsq03a=$row->ma005;?>
          <?php   $ma004=$row->ma004;?>
          <?php   $ma005=$row->ma005;?>
          <?php   $ma006=$row->ma006;?>
		  <?php   $ma007=$row->ma007;?>
		  <?php   $ma008=$row->ma008;?>
		  <?php   $ma009=$row->ma009;?>
		  <?php   $ma010=$row->ma010;?>
		  <?php   $ma011=$row->ma011;?>
		  <?php   $ma012=$row->ma012;?>
		  <?php   $ma013=$row->ma013;?>
		  <?php   $ma014=$row->ma014;?>
		  <?php   $cmsq03adisp=$row->ma005disp;?>
          <?php   $flag=$row->flag;?>	  
         
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="normal14y" width="9%"><span class="required">門市代號：</span></td>
        <td class="normal14a" width="24%" >
         <input  tabIndex="1" id="ma001" onKeyPress="keyFunction()" onchange="startkey(this)" name="ma001"   value="<?php echo  $ma001; ?>"    type="text" required 
disabled="disabled"/>
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="10%">門市簡稱：</td>
        <td class="normal14a"  width="23%"> <input  tabIndex="2" id="ma002" onKeyPress="keyFunction()"  name="ma002"   value="<?php echo  $ma002; ?>"    type="text" 
disabled="disabled" /></td>
		<td class="normal14y"  width="10%"> 門市全稱：</td>
        <td class="normal14a" width="23%"> <input  tabIndex="3" id="ma003" onKeyPress="keyFunction()"  name="ma003"   value="<?php echo  $ma003; ?>"    type="text" 
disabled="disabled" /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >開店日期：</td>
		<td class="normal14">                                                            
			  <input type="text" tabIndex="4"  ondblclick="scwShow(this,event);" onchange="dataymd1(this)" id="ma004" onKeyPress="keyFunction()"   name="ma004" value="<?php echo $ma004; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td> 
		<td class="normal14z" >歸屬庫別：</td>
        <td class="normal14" ><input   tabIndex="5" id="ma005" onKeyPress="keyFunction()" onchange="startcmsq03a(this)" name="cmsq03a" value="<?php echo $cmsq03a; ?>"  type="text" required 
disabled="disabled"/><img id="Showcmsq03a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
         <span id="cmsq03adisp"> <?php    echo $cmsq03adisp; ?> </span></td>
       <td class="normal14z"> 連絡人：</td>
        <td class="normal14" ><input  tabIndex="6" onKeyPress="keyFunction()" id="ma006" name="ma006"  value="<?php echo $ma006; ?>"  type="text" 
disabled="disabled" /></td>	
	  </tr>
		
	  <tr>
	      <td class="normal14z"> 電話：</td>
        <td class="normal14" ><input  tabIndex="7" onKeyPress="keyFunction()" id="ma007" name="ma007"  value="<?php echo $ma007; ?>"  type="text" 
disabled="disabled" /></td>	
		 <td class="normal14z"> 手機：</td>
        <td class="normal14" ><input  tabIndex="8" onKeyPress="keyFunction()" id="ma008" name="ma008"  value="<?php echo $ma008; ?>"  type="text" 
disabled="disabled" /></td>	
		 <td class="normal14z"> EMAIL：</td>
        <td class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="ma009" name="ma009"  value="<?php echo $ma009; ?>"  type="text" 
disabled="disabled" /></td>	
		
	  </tr>
	   <tr>
	      <td class="normal14z"> 資料庫名稱：</td>
        <td class="normal14" ><input  tabIndex="10" onKeyPress="keyFunction()" id="ma012" name="ma012"  value="<?php echo $ma012; ?>"  type="text" 
disabled="disabled" /></td>	
		 <td class="normal14z"> 同步資料庫分：</td>
        <td class="normal14" ><input  tabIndex="11" onKeyPress="keyFunction()" id="ma013" name="ma013"  value="<?php echo $ma013; ?>"  type="text" 
disabled="disabled" /></td>	
		 <td class="normal14z"> 同步開始時間分：</td>
        <td class="normal14" ><input  tabIndex="12" onKeyPress="keyFunction()" id="ma014" name="ma014"  value="<?php echo $ma014; ?>"  type="text" 
disabled="disabled" /></td>	
		
	  </tr>
	  <tr>
	      <td colspan="1" class="normal14z"> 地址：</td>
        <td colspan="3" class="normal14" ><input  tabIndex="13" onKeyPress="keyFunction()" id="ma010" name="ma010"  value="<?php echo $ma010; ?>" size="80" type="text" 
disabled="disabled" /></td>	
       </tr>
	 <tr>		
		<td class="normal14z"> 備註：</td>
        <td colspan="3" class="normal14" ><input  tabIndex="14" onKeyPress="keyFunction()" id="ma011" name="ma011"  value="<?php echo $ma011; ?>" size="80" type="text" disabled="disabled" /></td>	
	
	  </tr>
    </table>
		
	<!--  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
