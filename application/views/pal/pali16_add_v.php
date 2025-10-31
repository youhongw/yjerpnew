<div id="container">   <!-- div-1 -->
  <div id="header">    <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content">    <!-- div-3 -->
  <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 班別資料建立作業 - 新增</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pal/pali16/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general">  <!-- div-6 -->
	<?php
		$date=date("Ymd");
		$mo001=$this->input->post('mo001');
		$mo002=$this->input->post('mo002');
		$mo003=$this->input->post('mo003');
		$mo004=$this->input->post('mo004');
		$mo005=$this->input->post('mo005');
		$mo006=$this->input->post('mo006');
		$mo007=$this->input->post('mo007');
		if (is_array($mo007)){$mo007 = implode(",",$this->input->post('mo007'));}
		if ($mo003 > '0') { $mo003=$this->input->post('mo003');} else { $mo003=date("Hi");}
		if ($mo004 > '0') { $mo004=$this->input->post('mo004');} else { $mo004=date("Hi");}
		if ($mo005 > '0') { $mo005=$this->input->post('mo005');} else { $mo005=date("Hi");}
		if ($mo006 > '0') { $mo006=$this->input->post('mo006');} else { $mo006=date("Hi");}
		if ($mo007 > '0') { $mo007=$mo007;} else { $mo007="";}
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a"  width="11%" ><span class="required">班別代號：</span> </td>
        <td class="normal14"  width="39%"><input   tabIndex="1" id="mo001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mo001" value="<?php echo $mo001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14" ></td>
        <td class="normal14"  ></td>
	  </tr>
	  <tr>
	    <td class="normal14" >班別名稱：</td>
		<td class="normal14"  ><input type="text" tabIndex="2" id="mo002" onKeyPress="keyFunction()" name="mo002"   value="<?php echo  $mo002; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >上班時間：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mo003" onKeyPress="keyFunction()" name="mo003"   value="<?php echo  $mo003; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >下班時間：</td>
		<td class="normal14"  ><input type="text" tabIndex="4" id="mo004" onKeyPress="keyFunction()" name="mo004"   value="<?php echo  $mo004; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >加班時間：</td>
		<td class="normal14"  ><input type="text" tabIndex="5" id="mo005" onKeyPress="keyFunction()" name="mo005"   value="<?php echo  $mo005; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >年上班時間：</td>
		<td class="normal14"  ><input type="text" tabIndex="6" id="mo006" onKeyPress="keyFunction()" name="mo006"   value="<?php echo  $mo006; ?>"   /></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="normal14" >上班日設定：</td>
		<td class="normal14" colspan="3" >
			<?php 
			$t_workdays = explode(",",$mo007);$workdays=array();foreach($t_workdays as $w_k=>$w_v){$workdays[$w_v]=1;}
			$week = array("日","一","二","三","四","五","六");
				for($i=0;$i<=6;$i++){
					echo "星期".$week[$i].":<input name='mo007[]' type='checkbox' value='".$i."' ";
					if(isset($workdays[$i])){echo "checked='checked' ";}
					echo " />　";
				}
			?>
		</td>
	  </tr>
	  
	</table>
	   		  
	<div class="buttons">
	  <button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('pal/pali16/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> 
    </form>
	
    </div>  <!-- div-6 -->
  </div>  <!-- div-5 -->
</div>   <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-3 -->
  </div>   <!-- div-2 -->
</div>    <!-- div-1 -->
<?php include("./application/views/fun/admi01_funjs_v.php"); ?> 