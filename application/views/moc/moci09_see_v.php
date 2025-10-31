<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
	   <?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
 <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 加工計價資料建立作業 - 查看　　　</h1>
	<div style="float:left;padding-top: 5px; ">
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('moc/moci09/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/moc/moci09/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
		  	<?php $ma001=$row->ma001?>

			<?php $invq02adisp=$row->mb002; ?>
			<?php $invq02adisp1=$row->mb003; ?>
			<?php $ma002=$row->ma002; ?>
			<?php $mb002=$row->mb002; ?>
			<?php $mb003=$row->mb003; ?>
			<?php $ma003=$row->ma003; ?>
			<?php $ma003disp=$row->ma003disp; ?>
	  
			<?php $ma004=$row->ma004; ?>
	  <?php $ma005=$row->ma005; ?>
	  <?php $ma006=$row->ma006; ?>
      <?php $ma007=$row->ma007; ?>
	  <?php $ma008=$row->ma008; ?>
	  <?php $ma009=$row->ma009; ?>
	  <?php $ma010=$row->ma010; ?>	  
	  <?php $ma010disp=$row->ma010disp; ?>
	  
	  <?php $ma011=$row->ma011; ?>
	  <?php $ma012=$row->ma012; ?>
	  <?php $ma013=$row->ma013; ?>
	  <?php $ma014=$row->ma014; ?>
	<?php  }?>
      
	<table class="form14">
      <tr>
	    <td class="normal14y" width="10%"><span class="required">品號：</span></td>
        <td class="normal14a" width="40%" ><input   tabIndex="1" id="ma001"  name="ma001" value="<?php echo $ma001; ?>"  type="text" required="required" style="background-color:#EBEBE4"/><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>
         <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span><span id="invq02adisp1"> <?php    echo $invq02adisp1; ?> </span></td>
	    
		<td class="normal14y" width="10%">幣別：</td>
        <td  class="normal14" width="40%" ><input  readonly="value" id="ma010"  name="ma010" value="<?php echo $ma010; ?>"  type="text"  required="required"  style="background-color:#EBEBE4"/><img id="Showcmsq06a" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="ma010disp"> <?php    echo $ma010disp; ?> </span></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >品名：</td>
        <td class="normal14a"  > <input  readonly="value"  id="mb002"  name="mb002"   value="<?php echo $mb002 ?>"    type="text" style="background-color:#EBEBE4">
		
		<td class="normal14z" >計價單位：</td>
        <td class="normal14a"  > <input  readonly="value" id="ma004"  name="ma004"   value="<?php echo  $ma004; ?>" required="required" style="background-color:#EBEBE4" type="text" >
	  </tr>
		
	  <tr>
	    <td class="normal14z" >規格：</td>
        <td class="normal14a"  > <input  readonly="value"  id="mb003"  name="mb003"   value="<?php echo $mb003 ?>"    type="text" style="background-color:#EBEBE4">
		
		<td  class="normal14z" >含稅：</td>
        <td  class="normal14"  ><input type="hidden" name="ma011" value="N" />		  
		  <input  type='checkbox' disabled="disabled" id="ma011" name="ma011" <?php if($ma011 == 'Y' ) echo 'checked';  ?>  <?php if($ma011 != 'N' ) echo 'check'; ?>  value="Y" size="1"   />
        </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >製程代號：</td>
        <td class="normal14a"  > <input  readonly="value" id="ma002"  name="ma002"   value="<?php echo  $ma002; ?>"  style="background-color:#EBEBE4"  type="text" required="required">
		
		<td class="normal14z" >加工單價：</td>
        <td class="normal14a"  > <input  readonly="value" id="ma005"  name="ma005"   value="<?php echo  $ma005; ?>"  style="background-color:#EBEBE4"  type="text" >
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >加工廠商：</td>
        <td  class="normal14"  ><input type="text" readonly="value" id="ma003"  name="ma003"   value="<?php echo  $ma003; ?>" style="background-color:#EBEBE4" required="required"/><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="ma003disp"> <?php    echo $ma003disp; ?> </span></td>
		
		<td class="normal14z" >損壞扣款：</td>
        <td class="normal14a"  > <input  readonly="value" id="ma006" name="ma006"   value="<?php echo  $ma006; ?>"  style="background-color:#EBEBE4"  type="text" >
	  </tr>
	  
	  <tr>
	    <td class="normal14z" >核價日：</td>
		<td class="normal14a"   ><input type="text" readonly="value" onchange="chkno1(this)" id="ma007"  name="ma007" value="<?php echo $ma007; ?>" style="background-color:#EBEBE4" /></td>		
		<td class="normal14z" >生效日：</td>
		<td class="normal14a"   ><input type="text" readonly="value" onchange="chkno1(this)" id="ma012"  name="ma012" value="<?php echo $ma012; ?>" style="background-color:#EBEBE4" required="required"/></td>		
		</tr>
	  <tr>
		<td class="normal14z" >失效日：</td>
		<td class="normal14a"   ><input type="text" readonly="value" onchange="chkno1(this)" id="ma013"  name="ma013" value="<?php echo $ma013; ?>" style="background-color:#EBEBE4" /></td>	  
	  
	    <td class="normal14z" >初次加工日：</td>
		<td class="normal14a"   ><input type="text" readonly="value" onchange="chkno1(this)" id="ma008"  name="ma008" value="<?php echo $ma008; ?>" style="background-color:#EBEBE4" /></td>		
		</tr>
	  <tr>
		<td class="normal14z" >上次加工日：</td>
		<td class="normal14a"   ><input type="text" readonly="value" onchange="chkno1(this)" id="ma009"  name="ma009" value="<?php echo $ma009; ?>" style="background-color:#EBEBE4" /></td>		
		<td class="normal14z" >備註：</td>
        <td class="normal14a" > <input  readonly="value" id="ma014" name="ma014"   value="<?php echo  $ma014; ?>"  style="background-color:#EBEBE4"  type="text" >
	  </tr>
    </table>
		
	  <!--<div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('moc/moci09/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
