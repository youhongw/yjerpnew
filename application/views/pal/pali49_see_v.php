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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 所得稅扣繳級距建立 - 查看</h1>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali49/display"  method="post" enctype="multipart/form-data" >
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-查看</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
        <?php   $mz001=$row->mz001;?>
          <?php   $mz002=$row->mz002;?>
          <?php   $mz003=$row->mz003;?>
          <?php   $mz004=$row->mz004;?>
          <?php   $mz005=$row->mz005;?>
          <?php   $mz006=$row->mz006;?>
		  <?php   $mz007=$row->mz007;?>
		  <?php   $mz008=$row->mz008;?>
		  <?php   $mz009=$row->mz009;?>
		  <?php   $mz010=$row->mz010;?>
		  <?php   $mz011=$row->mz011;?>
		  <?php   $mz012=$row->mz012;?>
		  <?php   $mz013=$row->mz013;?>
		  <?php   $mz014=$row->mz014;?>
          <?php   $flag=$row->flag;?>	
	<?php  }?>
      
	<table class="form14">
        <tr>
	    <td class="start14a" width="11%"><span class="required">起始所得額：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="mz001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mz001"   value="<?php echo  $mz001; ?>" type="text" disabled="disabled" />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="11%">截止所得額：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="mz002" onKeyPress="keyFunction()"  name="mz002"   value="<?php echo  $mz002; ?>" type="text" disabled="disabled" /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14">扶養0扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="3" id="mz003"  onKeyPress="keyFunction()"  name="mz003"   value="<?php echo  $mz003; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
		<td class="normal14">扶養1扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="4" id="mz004"   onKeyPress="keyFunction()"  name="mz004"   value="<?php echo  $mz004; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養2扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="5" id="mz005"   onKeyPress="keyFunction()"  name="mz005" value="<?php echo  $mz005; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
		<td class="normal14">扶養3扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="6" id="mz006"   onKeyPress="keyFunction()"  name="mz006"   value="<?php echo  $mz006; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養4扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz007"   onKeyPress="keyFunction()"  name="mz007"   value="<?php echo  $mz007; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
		<td class="normal14">扶養5扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz008"   onKeyPress="keyFunction()"  name="mz008"   value="<?php echo  $mz008; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養6扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz009"   onKeyPress="keyFunction()"  name="mz009"   value="<?php echo  $mz009; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
		<td class="normal14">扶養7扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz010"   onKeyPress="keyFunction()"  name="mz010"   value="<?php echo  $mz010; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養8扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz011"   onKeyPress="keyFunction()"  name="mz011"   value="<?php echo  $mz011; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
		<td class="normal14">扶養9扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz012"   onKeyPress="keyFunction()"  name="mz012"   value="<?php echo  $mz012; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養10扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz013"   onKeyPress="keyFunction()"  name="mz013"   value="<?php echo  $mz013; ?>" type="text" readonly="readonly" disabled="disabled" /></td>
		<td class="normal14">扶養11扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz014"   onKeyPress="keyFunction()"  name="mz014"   value="<?php echo  $mz014; ?>" type="text" readonly="readonly" disabled="disabled"/></td>
	  </tr>
    </table>
		
	  <div class="buttons">
	    <a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali49/'.$this->session->userdata('search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
	$('#mz002').change();
});
$('#mz002').change(function(){
	$('#mz003').val(<?php echo $rates->mr001;?>*$('#mz002').val()/100);
	$('#mz004').val(<?php echo $rates->mr002;?>*$('#mz002').val()/100);
	var insurance = $('#mz003').val()*1+$('#mz004').val()*1;
	$('#mz005').val(Math.round(<?php echo $rates->mr003;?>*$('#mz002').val()/100));
	$('#mz006').val(Math.round(<?php echo $rates->mr004;?>*$('#mz002').val()/100));
	$('#mz008').val(<?php echo $rates->mr005;?>*insurance/100);
	$('#mz009').val(Math.round(<?php echo $rates->mr006;?>*insurance/100));
	$('#mz007').val(Math.round($('#mz005').val()*1+$('#mz008').val()*1));
}); */
</script>