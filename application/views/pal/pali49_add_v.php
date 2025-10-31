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

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 所得稅扣繳級距建立 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali49/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  if (!isset($mz001)) { $mz001='';} else { $mz001=$this->input->post('mz001');}
	  if (!isset($mz002)) { $mz002=0;} else { $mz002=$this->input->post('mz002');}
	  if (!isset($mz003)) { $mz003=0;} else { $mz003=$this->input->post('mz003');}
	  if (!isset($mz004)) { $mz004=0;} else { $mz004=$this->input->post('mz004');}
	  if (!isset($mz005)) { $mz005=0;} else { $mz005=$this->input->post('mz005');}
	  if (!isset($mz006)) { $mz006=0;} else { $mz006=$this->input->post('mz006');}
	  if (!isset($mz007)) { $mz007=0;} else { $mz007=$this->input->post('mz007');}
	  if (!isset($mz008)) { $mz008=0;} else { $mz008=$this->input->post('mz008');}
	  if (!isset($mz009)) { $mz009=0;} else { $mz009=$this->input->post('mz009');}
	  if (!isset($mz010)) { $mz010=0;} else { $mz010=$this->input->post('mz010');}
	  if (!isset($mz011)) { $mz011=0;} else { $mz011=$this->input->post('mz011');}
	  if (!isset($mz012)) { $mz012=0;} else { $mz012=$this->input->post('mz012');}
	  if (!isset($mz013)) { $mz013=0;} else { $mz013=$this->input->post('mz013');}
	  if (!isset($mz014)) { $mz014=0;} else { $mz014=$this->input->post('mz013');}
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="11%"><span class="required">起始所得額：</span></td>
        <td class="normal14a" width="39%" >
         <input  tabIndex="1" id="mz001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mz001"   value="<?php echo  $mz001; ?>" type="text" />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="11%">截止所得額：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="mz002" onKeyPress="keyFunction()"  name="mz002"   value="<?php echo  $mz002; ?>" type="text"  /></td>
	  </tr>	
		  
	 <tr>
	    <td class="normal14">扶養0扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="3" id="mz003"  onKeyPress="keyFunction()"  name="mz003"   value="<?php echo  $mz003; ?>" type="text"  /></td>
		<td class="normal14">扶養1扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="4" id="mz004"   onKeyPress="keyFunction()"  name="mz004"   value="<?php echo  $mz004; ?>" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養2扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="5" id="mz005"   onKeyPress="keyFunction()"  name="mz005" value="<?php echo  $mz005; ?>" type="text"  /></td>
		<td class="normal14">扶養3扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="6" id="mz006"   onKeyPress="keyFunction()"  name="mz006"   value="<?php echo  $mz006; ?>" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養4扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz007"   onKeyPress="keyFunction()"  name="mz007"   value="<?php echo  $mz007; ?>" type="text"  /></td>
		<td class="normal14">扶養5扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz008"   onKeyPress="keyFunction()"  name="mz008"   value="<?php echo  $mz008; ?>" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養6扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz009"   onKeyPress="keyFunction()"  name="mz009"   value="<?php echo  $mz009; ?>" type="text"  /></td>
		<td class="normal14">扶養7扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz010"   onKeyPress="keyFunction()"  name="mz010"   value="<?php echo  $mz010; ?>" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養8扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz011"   onKeyPress="keyFunction()"  name="mz011"   value="<?php echo  $mz011; ?>" type="text"  /></td>
		<td class="normal14">扶養9扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz012"   onKeyPress="keyFunction()"  name="mz012"   value="<?php echo  $mz012; ?>" type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">扶養10扣繳額<?php echo ''?>：</td>
        <td class="normal14"><input  tabIndex="7" id="mz013"   onKeyPress="keyFunction()"  name="mz013"   value="<?php echo  $mz013; ?>" type="text"  /></td>
		<td class="normal14">扶養11扣繳額<?php echo ''?>：</td>
		<td class="normal14"><input  tabIndex="8" id="mz014"   onKeyPress="keyFunction()"  name="mz014"   value="<?php echo  $mz014; ?>" type="text"  /></td>
	  </tr>
		
	</table>
	   		  
	<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali49/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include("./application/views/fun/pali49_funjs_v.php"); ?> 
<script>
/*$(document).ready(function(){
	$('#mz002').change();
});
$('#mz002').change(function(){
	$('#mz003').val(<?php echo $rates->mr001;?>*$('#mz002').val()/100);
	$('#mz004').val(<?php echo $rates->mr002;?>*$('#mz002').val()/100);
	var insurance = $('#mz003').val()*1+$('#mz004').val()*1;
	$('#mz005').val(<?php echo $rates->mr003;?>*insurance/100);
	$('#mz006').val(<?php echo $rates->mr004;?>*insurance/100);
	$('#mz008').val(<?php echo $rates->mr005;?>*insurance/100);
	$('#mz009').val(Math.round(<?php echo $rates->mr006;?>*insurance/100));
	$('#mz007').val(Math.round($('#mz005').val()*1+$('#mz008').val()*1));
}); */
</script>