
<div id="container">
  <div id="header">
   <!-- <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
	<!--	<?php // include_once("./application/views/funnew/fun_head_icon.html"); ?> --> 
  <!--  </div> -->

<div id="content"> 
  <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 主件整套展開 - 作業</h1>
    </div>
	
    <div class="content">
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/bom/bomi02/editbefore" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">
	<?php
	  $date=date("Ymd");
	  if(!isset($mz001)) {$mz001=$this->input->post('mz001');} else { $mz001=''; }
	  if(!isset($mz001disp)) {$mz001disp=$this->input->post('mz001');} else { $mz001disp=''; }
	  $mz002=$this->input->post('mz002');
	  $mz003=date("Ymd");
	  $mz004='Y';	 
	  $mz004disp=$this->input->post('mz004disp');
	  if(!isset($mz005)) {$mz005='N';} else { $mz005='Y'; }
	  $mz006=$this->input->post('mz006');
	  $mz007=$this->input->post('mz007');
	  $mz007disp=$this->input->post('mz007disp');
	  if(!isset($admq04adisp)) {$admq04adisp=$this->input->post('mz004');} else { $admq04adisp=''; }
	  if(!isset($cmsq05adisp)) {$cmsq05adisp=$this->input->post('mz007');} else { $cmsq05adisp=''; }
	?>
   
	<table class="form14">     <!-- 表格 -->
		  
	  <tr>
	    <td class="start14a" width="12%"><span class="required">主件品號：</span> </td>
            <td class="normal14a" width="88%" ><input type="text" tabIndex="1" id="invi02" class="invi02" onKeyPress="keyFunction()" name="mz001" onchange="check_invi02(this)" value="<?php echo $mz001; ?>"     />
		  <img id="Showinvi02disp" src="<?php echo base_url()?>assets/image/png/distance.png" alt="" align="top"/></a>		
	     <span id="invi02disp"> <?php   echo $mz001disp; ?> </span></td>
		
	  </tr>
	  <tr>
	    <td class="normal14">數量：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mz002" onKeyPress="keyFunction()" name="mz002"   value="<?php echo  $mz002; ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14" >BOM日期：</td>
		<td class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mz003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mz003"  value="<?php echo $mz003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(mz003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	  </tr>
	  <tr>
	    <td class="normal14" >計算損耗率：</td>
		<td class="normal14"  ><input type="hidden" name="mz004" value="N" />
		<input tabIndex="12" type="checkbox"  id="mz004" onKeyPress="keyFunction()"   name="mz004" <?php if($mz004 == 'Y' ) echo 'checked'; ?>  <?php if($mz004 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14" >展開方式：</td>
		<td class="normal14"  ><select tabIndex="27" id="mz005" onKeyPress="keyFunction()" name="mz005" >
            <option <?php if($mz005 == '1') echo 'selected="selected"';?> value='1'>1:單階 </option>                                                                        
		    <option <?php if($mz005 == '2') echo 'selected="selected"';?> value='2'>2:尾階 </option>
		  </select>
		</td>
	  </tr>
	</table>
	   		  
	<div class="buttons">
	<!--<button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp; -->
	<a class="button" href='javascript:send_back_bomi02("<?php echo $mz001;?>","<?php echo $mz002;?>","<?php echo $mz003;?>","<?php echo $mz004;?>");'>儲 存Alt+s<img src="<?php echo base_url()?>assets/image/png/save.png"/> </a> 
	<!-- <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('bom/bomi02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a> -->
	<button  type='button' onclick="window.parent.$.unblockUI();" class="button" accesskey="x" name='cancel'  value='&nbsp;返 回&nbsp;'><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></button>
	</div> 
	  
    </form>
    </div> 
  </div>
</div>

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> 
  </div> 
   </div> 
   
 <script type="text/javascript">
function send_back_bomi02(mz001,mz002, mz003, mz004){
	console.log('mz001_test');
	console.log(mz001);
	var mz001 = $('input[name=\'mz001\']').attr('value');
	var mz002 = $('input[name=\'mz002\']').attr('value');
	var mz003 = $('input[name=\'mz003\']').attr('value');
	var mz004 = $('input[name=\'mz004\']').attr('value');
	console.log(mz001);
	window.parent.$.unblockUI();
	//console.log(window.parent.import_copi05);
	if(window.parent.import_copi05){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.import_copi05(mz001,mz002,mz003,mz004);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/bom/bomi02/clear_sql"
		});
	}
}
</script>
 <?php //include("./application/views/fun/admi10_funjs_v.php"); ?> 
 <?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 --> 
 <?php  include_once("./application/views/funnew/invi02e_funmjs_v.php"); ?>  <!-- 品號 --> 