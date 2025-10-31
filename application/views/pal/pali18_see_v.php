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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 勞退級距建立作業 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali18/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
       <?php   $mw001=$row->mw001;?>
          <?php   $mw002=$row->mw002;?>
          <?php   $mw003=0;?>
          <?php   $mw004=0;?>
          <?php   $mw005=0;?>
          <?php   $mw006=0;?>
		  <?php   $mw007=$row->mw007;?>
		  <?php   $mw008=0;?>
		  <?php   $mw009=0;?>
		  <?php   $mw010=$row->mw010;?>
          <?php   $flag=$row->flag;?>	
	<?php  }?>
      
	<table class="form14">
        <tr>
	    <td class="start14a" width="11%"><span class="required">勞退等級：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="mw001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mw001"   value="<?php echo  $mw001; ?>" type="text" />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="11%">月提繳工資：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="mw002" onKeyPress="keyFunction()"  name="mw002"   value="<?php echo  $mw002; ?>" type="text"  /></td>
	  </tr>	
		  
	 <tr>
	    <td class="normal14">保留1<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="3" id="mw003" readonly="readonly" onKeyPress="keyFunction()"  name="mw003"   value="<?php echo  $mw003; ?>" type="text" readonly="readonly" /></td>
		<td class="normal14">保留2<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="4" id="mw004"  readonly="readonly" onKeyPress="keyFunction()"  name="mw004"   value="<?php echo  $mw004; ?>" type="text" readonly="readonly" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">保留3<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="5" id="mw005"  readonly="readonly" onKeyPress="keyFunction()" onchange="addsel(this)" name="mw005" value="<?php echo  $mw005; ?>" type="text" readonly="readonly" /></td>
		<td class="normal14">保留4<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="6" id="mw006"  readonly="readonly" onKeyPress="keyFunction()"  name="mw006"   value="<?php echo  $mw006; ?>" type="text" readonly="readonly" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">保留5<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mw008"  readonly="readonly" onKeyPress="keyFunction()" onchange="addsel(this)" name="mw008"   value="<?php echo  $mw008; ?>" type="text" readonly="readonly" /></td>
		<td class="normal14">保留6<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mw009"  readonly="readonly" onKeyPress="keyFunction()"  name="mw009"   value="<?php echo  $mw009; ?>" type="text" readonly="readonly" /></td>
	  </tr>
		
		
	  <tr>	    
	    <td class="normal14">備註：</td>
        <td class="normal14"><input  tabIndex="9" onKeyPress="keyFunction()" id="mw010" name="mw010"  value="<?php echo $mw010; ?>" size="60" type="text" /></td>	
	    <td class="normal14">公司加總</td>
        <td class="normal14"><input  tabIndex="10" onKeyPress="keyFunction()" id="mw007" name="mw007"  value="<?php echo $mw007; ?>" type="text" style="background-color:#E7EFEF" readonly="readonly" /></td>	
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali18/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
/*$(document).ready(function(){
	$('#mw002').change();
});
$('#mw002').change(function(){
	$('#mw003').val(<?php echo $rates->mr001;?>*$('#mw002').val()/100);
	$('#mw004').val(<?php echo $rates->mr002;?>*$('#mw002').val()/100);
	var insurance = $('#mw003').val()*1+$('#mw004').val()*1;
	$('#mw005').val(Math.round(<?php echo $rates->mr003;?>*$('#mw002').val()/100));
	$('#mw006').val(Math.round(<?php echo $rates->mr004;?>*$('#mw002').val()/100));
	$('#mw008').val(<?php echo $rates->mr005;?>*insurance/100);
	$('#mw009').val(Math.round(<?php echo $rates->mr006;?>*insurance/100));
	$('#mw007').val(Math.round($('#mw005').val()*1+$('#mw008').val()*1));
}); */
</script>