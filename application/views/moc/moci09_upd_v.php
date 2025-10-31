<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?=base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?=base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?=base_url()?>index.php">退出系統</a>
	   </div>
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/order.png" alt="" /> 加工計價資料建立作業 - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button  style= "cursor:pointer" form="commentForm" onfocus="$('#ma001').focus();" tabIndex="8" type='submit'  accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('moc/moci09/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
	   
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?=base_url()?>index.php/moc/moci09/updsave" method="post" enctype="multipart/form-data" >
	<!-- <div id="htabs" class="htabs14"><span>編輯項目-修改</span></div> -->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php $ma001=$row->ma001;?>
		  <?php $mb002=$row->mb002; ?>
		  <?php $mb003=$row->mb003; ?>
          <?php $ma002=$row->ma002;?>
          <?php $ma003=$row->ma003;?>
          <?php $ma003disp=$row->ma003disp;?>
          <?php $ma004=$row->ma004;?>
          <?php $ma005=$row->ma005;?>
          <?php $ma006=$row->ma006;?>
		  <?php $ma007=$row->ma007;?>
		  <?php $ma008=$row->ma008;?>
		  <?php $ma009=$row->ma009;?>
		  <?php $ma010=$row->ma010;?>
		  <?php $ma010disp=$row->ma010disp;?>
		  <?php $ma011=$row->ma011;?>
		  <?php $ma012=$row->ma012;?>
		  <?php $ma013=$row->ma013;?>
		  <?php $ma014=$row->ma014;?>
          <?php $flag=$row->flag;?>	  
	<?php  }?>
       
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="10%"><span class="required">品號：</span></td>
        <td class="normal14a" width="40%" ><input  id="ma001" readonly="value" name="ma001" value="<?php echo $ma001; ?>"  type="text" style="background-color:#EBEBE4" required="required" /><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="mb002"> <?php    echo $mb002; ?> </span><span id="mb003"> <?php    echo $mb003; ?> </span></td>
	    
		<td class="normal14y" width="10%"><span class="required">幣別：</span></td>
        <td  class="normal14" width="40%" ><input  id="ma010" name="ma010" readonly="value" value="<?php echo $ma010; ?>"  type="text"  required="required" style="background-color:#EBEBE4"/><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="ma010disp"> <?php  echo $ma010disp; ?> </span></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >品名：</td>
        <td class="normal14a"  > <input  readonly="value"  id="mb002" name="mb002"   value="<?php $mb002?>" type="text" style="background-color:#EBEBE4">
		
		<td class="normal14z" ><span class="required">計價單位：</span></td>
        <td class="normal14a"  > <input  id="ma004" readonly="value" name="ma004"   value="<?php echo  $ma004; ?>" required="required" style="background-color:#EBEBE4" type="text" >
	  </tr>
		
	  <tr>
	    <td class="normal14z" >規格：</td>
        <td class="normal14a"  > <input  readonly="value"  id="mb003" name="mb003"   value="<?php $mb003?>" type="text" style="background-color:#EBEBE4">
		
		<td  class="normal14z" >含稅：</td>
        <td  class="normal14"  ><input type="hidden" name="ma011" value="N" />		  
		  <input  type='checkbox' id="ma011" name="ma011" <?php if($ma011 == 'Y' ) echo 'checked';  ?>  <?php if($ma011 != 'N' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >製程代號：</td>
        <td class="normal14a" > <input  id="ma002" name="ma002" readonly="value"  value="<?php echo  $ma002; ?>"    type="text" required="required" style="background-color:#EBEBE4">
		
		<td class="normal14z" >加工單價：</td>
        <td class="normal14a"  > <input  tabIndex="1" id="ma005" onKeyPress="keyFunction()"  name="ma005"   value="<?php echo  $ma005; ?>"    type="text" >
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >加工廠商：</td>
        <td  class="normal14"  ><input type="text" readonly="value" id="ma003"  onchange="startcmsq02a(this)" name="ma003"   value="<?php echo  $ma003; ?>"  required="required" style="background-color:#EBEBE4"  /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="ma003disp"> <?php    echo $ma003disp; ?> </span></td>
		
		<td class="normal14z" >損壞扣款：</td>
        <td class="normal14a"  > <input  tabIndex="2" id="ma006" onKeyPress="keyFunction()"  name="ma006"   value="<?php echo  $ma006; ?>"    type="text" >
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >核價日：</td>
		<td class="normal14a"  ><input type="text" tabIndex="3" id="ma007"  ondblclick="scwShow(this,event);" onchange="dataymd1(this)"     onKeyPress="keyFunction()"    name="ma007" value="<?php echo $ma007; ?>" style="background-color:#E7EFEF" /></td>		
		<td class="normal14z" >生效日：</td>
		<td class="normal14a"   ><input type="text" readonly="value" id="ma012" onchange="dataymd2(this)" name="ma012" value="<?php echo $ma012; ?>" style="background-color:#EBEBE4" required="required"/></td>		
		</tr>
	  <tr>
		
		<td class="normal14z" >失效日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="4" id="ma013"  ondblclick="scwShow(this,event);" onchange="dataymd3(this)"     onKeyPress="keyFunction()"    name="ma013" value="<?php echo $ma013; ?>" style="background-color:#E7EFEF" /></td>	  
	  
	    <td class="normal14z" >初次加工日：</td>
		<td class="normal14a"  ><input type="text" tabIndex="5" id="ma008"  ondblclick="scwShow(this,event);" onchange="dataymd4(this)"     onKeyPress="keyFunction()"    name="ma008" value="<?php echo $ma008; ?>" style="background-color:#E7EFEF" /></td>		
		</tr>
	  <tr>
		<td class="normal14z" >上次加工日：</td>
		<td class="normal14a"   ><input type="text" tabIndex="6" id="ma009"  ondblclick="scwShow(this,event);" onchange="dataymd5(this)"     onKeyPress="keyFunction()"    name="ma009" value="<?php echo $ma009; ?>" style="background-color:#E7EFEF" /></td>		
		<td class="normal14z" >備註：</td>
        <td class="normal14a"  > <input  tabIndex="7" id="ma014" onKeyPress="keyFunction()"  name="ma014"   value="<?php echo  $ma014; ?>"    type="text" >
	  </tr>
	</table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
		
	<!--  <div class="buttons">
	    <button tabIndex="8" type='submit'  accesskey="s"  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?=base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('moc/moci09/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?=base_url()?>assets/image/png/cancle.png" /></a>
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

 <?php include("./application/views/fun/moci09_funjs_v.php"); ?> 