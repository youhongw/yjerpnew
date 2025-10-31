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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 健保計費建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali04/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  if (!isset($mq001)) { $mq001='';} else { $mq001=$this->input->post('mq001');}
	  if (!isset($mq002)) { $mq002=0;} else { $mq002=$this->input->post('mq002');}
	  if (!isset($mq003)) { $mq003=0;} else { $mq003=$this->input->post('mq003');}
	  if (!isset($mq004)) { $mq004=0;} else { $mq004=$this->input->post('mq004');}
	  if (!isset($mq005)) { $mq005=0;} else { $mq005=$this->input->post('mq005');}
	  if (!isset($mq006)) { $mq006=0;} else { $mq006=$this->input->post('mq006');}
	  if (!isset($mq007)) { $mq007=0;} else { $mq007=$this->input->post('mq007');}
	  if (!isset($mq008)) { $mq008=0;} else { $mq008=$this->input->post('mq008');}
	  if (!isset($mq009)) { $mq009=0;} else { $mq009=$this->input->post('mq009');}
	  if (!isset($mq010)) { $mq010='';} else { $mq010=$this->input->post('mq010');}
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="11%"><span class="required">健保等級：</span></td>
        <td class="normal14a" width="39%">
         <input tabIndex="1" id="mq001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mq001"   value="<?php echo  $mq001; ?>"    type="text" />
		<span id="keydisp" ></span></td>
	    <td class="normal14a" width="11%">投保金額：</td>
        <td class="normal14a"  width="39%"> <input  tabIndex="2" id="mq002" onfocus="this.select()" onKeyPress="keyFunction()"  name="mq002"   value="<?php echo  $mq002; ?>"    type="text"  /></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14">本人：</td>
        <td class="normal14"><input tabIndex="3" id="mq003" onKeyPress="keyFunction()" onfocus="this.select()" name="mq003"   value="<?php echo  $mq003; ?>"    type="text"  /></td>
		<td class="normal14">本人+1眷口：</td>
		<td class="normal14"><input tabIndex="4" id="mq004" onKeyPress="keyFunction()" onfocus="this.select()" name="mq004"   value="<?php echo  $mq004; ?>"  readonly="readonly"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">本人+2眷口：</td>
        <td class="normal14"><input tabIndex="5" id="mq005" onKeyPress="keyFunction()" onfocus="this.select()" name="mq005"   value="<?php echo  $mq005; ?>"  readonly="readonly"  type="text"  /></td>
		<td class="normal14">本人+3眷口：</td>
		<td class="normal14"><input tabIndex="6" id="mq006" onKeyPress="keyFunction()" onfocus="this.select()" name="mq006"   value="<?php echo  $mq006; ?>"  readonly="readonly"  type="text"  /></td>
	  </tr>
	  <tr>
	    <td class="normal14">雇主<?php echo $rates->mr014?>%：</td>
        <td class="normal14"><input tabIndex="7" id="mq007" onKeyPress="keyFunction()" onfocus="this.select()" name="mq007"   value="<?php echo  $mq008; ?>"  readonly="readonly"  type="text"  /></td>
		<td class="normal14">政府<?php echo $rates->mr015?>%：</td>
		<td class="normal14"><input tabIndex="8" id="mq008" onKeyPress="keyFunction()"  onfocus="this.select()" name="mq008"   value="<?php echo  $mq008; ?>"  readonly="readonly"  type="text"  /></td>
	  </tr>
		
	  <tr>	    
	    <td class="normal14">備註：</td>
        <td class="normal14"><input  tabIndex="9" onKeyPress="keyFunction()" id="mq009" name="mq009"  value="<?php echo $mq009; ?>" size="60" type="text"   /></td>	
	    <td class="normal14"></td>
        <td class="normal14"></td>	
	  </tr>
		
	</table>
	   		  
	<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pal/pali04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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
 <?php include("./application/views/fun/pali04_funjs_v.php"); ?> 
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
 