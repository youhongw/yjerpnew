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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 勞保計費建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali02/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
       <?php   $mp001=$row->mp001;?>
          <?php   $mp002=$row->mp002;?>
          <?php   $mp003=$row->mp003;?>
          <?php   $mp004=$row->mp004;?>
          <?php   $mp005=$row->mp005;?>
          <?php   $mp006=$row->mp006;?>
		  <?php   $mp007=$row->mp007;?>
		  <?php   $mp008=$row->mp008;?>
		  <?php   $mp009=$row->mp009;?>
		  <?php   $mp010=$row->mp010;?>
          <?php   $flag=$row->flag;?>	
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="start14a" width="11%"><span class="required">勞保等級：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="mp001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mp001"   value="<?php echo  $mp001; ?>"    type="text" required disabled="disabled" />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="11%">投保金額：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="mp002" onKeyPress="keyFunction()"  name="mp002"   value="<?php echo  $mp002; ?>"    type="text" disabled="disabled" /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" >保費<?php echo $rates->mr001?>%：</td>
        <td class="normal14" ><input  tabIndex="3" id="mp003" onKeyPress="keyFunction()"  name="mp003"   value="<?php echo  $mp003; ?>"    type="text" disabled="disabled" /></td>
		<td class="normal14" >就業保費<?php echo $rates->mr002?>%：</td>
		<td class="normal14"><input  tabIndex="4" id="mp004" onKeyPress="keyFunction()"  name="mp004"   value="<?php echo  $mp004; ?>"    type="text" disabled="disabled"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >職災<?php echo $rates->mr003?>%：</td>
        <td class="normal14" ><input  tabIndex="5" id="mp005" onKeyPress="keyFunction()" onchange="addsel(this)" name="mp005"   value="<?php echo  $mp005; ?>"    type="text" disabled="disabled" /></td>
		<td class="normal14" >墊償<?php echo $rates->mr004?>%：</td>
		<td class="normal14"><input  tabIndex="6" id="mp006" onKeyPress="keyFunction()"  name="mp006"   value="<?php echo  $mp006; ?>"    type="text" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >顧主<?php echo $rates->mr005?>%：</td>
        <td class="normal14" ><input  tabIndex="7" id="mp008" onKeyPress="keyFunction()" onchange="addsel(this)" name="mp008"   value="<?php echo  $mp008; ?>"    type="text" disabled="disabled" /></td>
		<td class="normal14" >勞工<?php echo $rates->mr006?>%：</td>
		<td class="normal14"><input  tabIndex="8" id="mp009" onKeyPress="keyFunction()"  name="mp009"   value="<?php echo  $mp009; ?>"    type="text" disabled="disabled" /></td>
	  </tr>
		
	  <tr>	    
	    <td class="normal14"> 備註：</td>
        <td  class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="mp010" name="mp010"  value="<?php echo $mp010; ?>" size="60" type="text"  disabled="disabled" /></td>	
	    <td class="normal14">公司加總</td>
        <td class="normal14"><input  tabIndex="10" onKeyPress="keyFunction()" id="mp007" name="mp007"  value="<?php echo $mp007; ?>"  type="text" disabled="disabled" /></td>	
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali02/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
<script>
$(document).ready(function(){
	$('#mp002').change();
});
$('#mp002').change(function(){
	$('#mp003').val(<?php echo $rates->mr001;?>*$('#mp002').val()/100);
	$('#mp004').val(<?php echo $rates->mr002;?>*$('#mp002').val()/100);
	var insurance = $('#mp003').val()*1+$('#mp004').val()*1;
	$('#mp005').val(Math.round(<?php echo $rates->mr003;?>*$('#mp002').val()/100));
	$('#mp006').val(Math.round(<?php echo $rates->mr004;?>*$('#mp002').val()/100));
	$('#mp008').val(<?php echo $rates->mr005;?>*insurance/100);
	$('#mp009').val(Math.round(<?php echo $rates->mr006;?>*insurance/100));
	$('#mp007').val(Math.round($('#mp005').val()*1+$('#mp008').val()*1));
});
</script>