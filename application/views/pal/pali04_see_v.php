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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 健保計費建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali04/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
       <?php   $mq001=$row->mq001;?>
          <?php   $mq002=$row->mq002;?>
          <?php   $mq003=$row->mq003;?>
          <?php   $mq004=$row->mq004;?>
          <?php   $mq005=$row->mq005;?>
          <?php   $mq006=$row->mq006;?>
		  <?php   $mq007=$row->mq007;?>
		  <?php   $mq008=$row->mq008;?>
		  <?php   $mq009=$row->mq009;?>
          <?php   $flag=$row->flag;?>	
	<?php  }?>
      
	<table class="form14">
       <tr>
	    <td class="start14a" width="11%"><span class="required">健保等級：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="mq001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" required disabled="disabled" />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="11%">投保金額：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="mq002" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text" disabled="disabled" /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14" >本人：</td>
        <td class="normal14" ><input  tabIndex="3" id="mq003" onKeyPress="keyFunction()"  name="mq003"   value="<?php echo  $mq003; ?>"   disabled="disabled"  type="text"  /></td>
		<td class="normal14" >本人+1眷口：</td>
		<td class="normal14"><input  tabIndex="4" id="mq004" onKeyPress="keyFunction()"  name="mq004"   value="<?php echo  $mq004; ?>"   disabled="disabled"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >本人+2眷口：</td>
        <td class="normal14" ><input  tabIndex="5" id="mq005" onKeyPress="keyFunction()"  name="mq005"   value="<?php echo  $mq005; ?>"   disabled="disabled"  type="text"  /></td>
		<td class="normal14" >本人+3眷口：</td>
		<td class="normal14"><input  tabIndex="6" id="mq006" onKeyPress="keyFunction()"  name="mq006"   value="<?php echo  $mq006; ?>"   disabled="disabled"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >顧主<?php echo $rates->mr014?>%：</td>
        <td class="normal14" ><input  tabIndex="7" id="mq007" onKeyPress="keyFunction()"  name="mq007"   value="<?php echo  $mq007; ?>"    disabled="disabled" type="text"  /></td>
		<td class="normal14" >政府<?php echo $rates->mr015?>%：</td>
		<td class="normal14"><input  tabIndex="8" id="mq008" onKeyPress="keyFunction()"   name="mq008"   value="<?php echo  $mq008; ?>"   disabled="disabled"  type="text"  /></td>
	  </tr>
		
	  <tr>	    
	    <td class="normal14"> 備註：</td>
        <td  class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="mq009" name="mq009"  value="<?php echo $mq009; ?>" size="60" type="text"  disabled="disabled" /></td>	
	    <td class="normal14"></td>
        <td class="normal14"></td>	
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali04/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
	$('#mq002').change();
});
$('#mq002').change(function(){
	var insurance = $('#mq002').val()*<?php echo $rates->mr011;?>/100;
	$('#mq003').val(Math.round(insurance*<?php echo $rates->mr013;?>/100));
	$('#mq004').val(Math.round((insurance*<?php echo $rates->mr013;?>/100))*2);
	$('#mq005').val(Math.round((insurance*<?php echo $rates->mr013;?>/100))*3);
	$('#mq006').val(Math.round((insurance*<?php echo $rates->mr013;?>/100))*4);
	$('#mq007').val(Math.round(<?php echo $rates->mr014;?>*<?php echo $rates->mr012;?>*insurance/100));
	$('#mq008').val(Math.round(<?php echo $rates->mr015;?>*<?php echo $rates->mr012;?>*insurance/100));
});
</script>
