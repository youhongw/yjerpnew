<div id="container">   <!-- div-1 -->
  <div id="header">     <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	   </div>
    </div>

<div id="content">   <!-- div-3 -->
 <div class="box">   <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 固定資產參數設定作業 - -修改</h1>
    </div>
	
    <div class="content">  <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/ast/asti15/updsave" method="post" enctype="multipart/form-data" >
	 <!--<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>-->
	<div id="tab-general">   <!-- div-tab -->
	<?php
    date_default_timezone_set("Asia/Taipei");

	foreach($results[0] as $key=>$val){
		$$key = $val;
	}
	?>
	
	<?php
		if(!isset($me001)) { $me001=$this->input->post('asti03_asti15'); }
		if(!isset($me002)) { $me002=$this->input->post('asti03_asti15b'); }
		if(!isset($me003)) { $me003=$this->input->post('acti03'); }
		if(!isset($me004)) { $me004=$this->input->post('acti03a'); }
		if(!isset($me005)) { $me005=$this->input->post('me005'); }
		if(!isset($me006)) { $me006='2'; }
		if(!isset($me007)) { $me007=$this->input->post('me007'); }
		if(!isset($me008)) { $me008=$this->input->post('me008'); }
		if(!isset($me001disp)) { $me001disp=$this->input->post('asti03_asti15disp'); }
		if(!isset($me002disp)) { $me002disp=$this->input->post('asti03_asti15bdisp'); }
		if(!isset($acti03disp)) { $acti03disp=$this->input->post('acti03disp'); }
		if(!isset($acti03adisp)) { $acti03adisp=$this->input->post('acti03adisp'); }
	?>
       
	<div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		    <li><a href="#tab1">第一頁</a></li>
	    </ul>

    <div class="tab_container"> <!-- div-8 -->
	<!--  基本參數 -->
	<div id="tab1" class="tab_content">
	<table class="form14">     <!-- 表格 -->
	<tr>
	    <td class="normal14a" width="14%">取得單別：</td>
		<td class="normal14a"  width="86%"><input tabIndex="1" id="asti03_asti15"    onKeyPress="keyFunction()"   name="asti03_asti15" onfocus="" onchange="check_asti03_asti15(this);"  value="<?php echo $me001; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showasti03_asti15disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="asti03_asti15disp"> <?php    echo $me001disp; ?> </span></td>
	</tr>
	<tr>	
		<td class="normal14a" >折舊單別：</td>
        <td class="normal14a"  ><input tabIndex="2" id="asti03_asti15b"    onKeyPress="keyFunction()"   name="asti03_asti15b" onfocus="" onchange="check_asti03_asti15b(this);"  value="<?php echo $me002; ?>" size="12" type="text" required />
		<a href="javascript:;"><img id="Showasti03_asti15bdisp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		<span id="asti03_asti15bdisp"> <?php    echo $me002disp; ?> </span></td>
	</tr>
	<tr>		
		<td class="normal14a" >出售利得科目：</td>
        <td class="normal14a"  >
			<input tabIndex="3" id="acti03" onKeyPress="keyFunction()" name="acti03" onblur="check_acti03(this);"  value="<?php echo $me003; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03disp"> <?php echo $acti03disp; ?> </span>
		</td>
	</tr>
	<tr>		
        <td class="normal14a" >出售損失科目：</td>
        <td class="normal14a"  >
			<input tabIndex="4" id="acti03a" onKeyPress="keyFunction()" name="acti03a" onblur="check_acti03a(this);"  value="<?php echo $me004; ?>"  type="text"   size="12" />
			<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
			<span id="acti03adisp"> <?php echo $acti03adisp; ?> </span>
		</td>
	</tr>
	
	<tr>
		<td class="normal14">年折舊額起算月份：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="me005" name="me005" onchange="check_me005(this);"  value="<?php echo $me005; ?>"  size="12" /></td>
		
		<script>
		function check_me005(me005){
			var me005_val = $('#me005').val();
			var len_me005 = me005_val.length;
			var array_me005 = me005_val.split("");
			
			if(me005_val < 0){
				alert('年折舊額起算月份只能輸入01至12');
				$('#me005').val('');
			}
			else if(len_me005 != 2){
				alert('年折舊額起算月份只能輸入01至12');
				$('#me005').val('');
			}else if(isNaN(me005_val)){
				alert('年折舊額起算月份只能輸入01至12');
				$('#me005').val('');
			}else if(array_me005[0] > 1){
				alert('年折舊額起算月份只能輸入01至12');
				$('#me005').val('aaa');
			}else if(array_me005[0] == 1 && array_me005[1] > 2){
				alert('年折舊額起算月份只能輸入01至12');
				$('#me005').val('');
			}
		};
		</script>
	</tr>
	<tr>	
		<td class="normal14">拋轉方式：</td>
        <td class="normal14"  ><select id="me006" tabIndex="6" onKeyPress="keyFunction()" name="me006" onchange="turn_me006(this);" >                                                                     
		    <option <?php if($me006 == '1') echo 'selected="selected"';?> value='1'>1.拋轉自動分錄底稿 </option>
            <option <?php if($me006 == '2') echo 'selected="selected"';?> value='2'>2.拋轉自動分錄底稿及會計傳票</option>	
		</select></td>	
		</tr>
	<tr>	
		<script>
		$(document).ready(function(){
			$('#me006').val('<?php echo $me006;?>');
		});
		
		function turn_me006(me006){
			var me006_val = me006.value;
			
			switch (me006_val){
				case '1':
					$('#me007').attr('disabled','disabled');
					$('#me007').attr('checked',false);
					break;
				case '2':
					$('#me007').removeAttr('disabled');
					break;
			}
		}
		</script>
		</tr>
	    <tr>	
		<td class="normal14">拋轉傳票同底稿科目彙總</td>
        <td  class="normal14"  ><input type="hidden" name="me007" value="N" />	
		  <input  type='checkbox' tabIndex="7" id="me007" onKeyPress="keyFunction()" name="me007" <?php if($me007 == 'Y' ) echo 'checked'; ?>  <?php if($me007 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
	  </tr>
	  <tr>	
		<td class="normal14">底稿記載原幣</td>
        <td  class="normal14"  ><input type="hidden" name="me008" value="N" />	
		  <input  type='checkbox' tabIndex="8" id="me008" onKeyPress="keyFunction()" name="me008" <?php if($me008 == 'Y' ) echo 'checked'; ?>  <?php if($me008 != 'Y' ) echo 'check'; ?> value="Y" size="1"/>
        </td>
	</tr>
	</table>
	</div>

	</div><!-- div- 可儲存顯示 -->
		<input type="hidden" class="commpany" name="company" value="" />
	<div class="buttons">
	    <button tabIndex="88" type='submit'  name='submit'  class="button" value='&nbsp;儲存F8&nbsp;'><span>&nbsp;儲 存 F8&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a  tabIndex="89" id='cancel' name='cancel' href="<?php echo site_url('main/index/141'); ?>" class="button" ><span>返 回&nbsp;F9&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div>
	   
    </form>
    </div>    <!-- div-tab -->
  </div>      <!-- div-5 -->
 </div>        <!-- div-4 -->
 
 
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱前有*號代表必需輸入欄位,按Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>

</div>   <!-- div-3 -->
  </div>     <!-- div-2 -->
</div>       <!-- div-1 -->
<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti03_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!-- 票據科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!-- 票據科目 -->