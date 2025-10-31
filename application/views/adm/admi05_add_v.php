<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 使用者權限建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#mq001').focus();" type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('adm/admi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/adm/admi05/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  if(!isset($mg001)) {$mg001=$this->input->post('mg001');} else { $mg001=''; }
	  $admq02a=$this->input->post('mg002');
	  $mg006=$this->input->post('mg006');
	  $mg0061=$this->input->post('mg0061');
	  if(!isset($mg003)) {$mg003='0';} else { $mg003='0'; }
	  if(!isset($mg004)) {$mg004='N';} else { $mg004='Y'; }
	  if(!isset($mg005)) {$mg005='N';} else { $mg005='Y'; }
	  $mg007=$this->input->post('mg007');
	  $mg008=$this->input->post('mg008');
	   $mg611='N';$mg612='N';$mg613='N';$mg614='N';$mg615='N';$mg616='N';$mg617='N';$mg618='N';
	   $mg619='N';$mg620='N';$mg621='N';$mg622='N';$mg623='N';$mg624='N';
	   $mg711='N';$mg712='N';$mg713='N';$mg714='N';$mg715='N';$mg716='N';$mg717='N';$mg718='N';
	   $mg719='N';$mg720='N';$mg721='N';$mg722='N';$mg723='N';$mg724='N';
	   $mg811='N';$mg812='N';$mg813='N';$mg814='N';$mg815='N';$mg816='N';$mg817='N';$mg818='N';
	   $mg819='N';$mg820='N';$mg821='N';$mg822='N';$mg823='N';$mg824='N';
	  if(!isset($admq02adisp)) {$admq02adisp=$this->input->post('mg002');} else { $admq02adisp=''; }
	?>
  
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="start14a" width="12%"><span class="required">使用者代號：</span> </td>
        <td class="normal14a" width="38%"><input   tabIndex="1" id="mg001" onKeyPress="keyFunction()" onchange="startkey(this)"  name="mg001" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()" value="<?php echo strtoupper($mg001); ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14a" width="11%">資料管制(Y/N)：</td>
        <td class="normal14a" width="39%"><input type="text" tabIndex="2" id="mg005" onKeyPress="keyFunction()" name="mg005" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg005); ?>"   /></td>
	  </tr>
	  <tr>
	    <td class="normal14a" >程式代碼：</td>
		<td class="normal14"  ><input type="text" tabIndex="3" id="mg002" onKeyPress="keyFunction()"  onchange="startadmq02a(this)" name="admq02a"  onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()" value="<?php echo  strtoupper($admq02a); ?>"   /><img id="Showadmq02a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top" /></a>
		  <span id="admq02adisp"> <?php   echo $admq02adisp; ?> </span></td>
		<td class="normal14">執行權限(Y/N)：</td>
        <td class="normal14"  ><input type="text" tabIndex="4" id="mg004" onKeyPress="keyFunction()" name="mg004" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg004); ?>"   /></td>
		
	  </tr>
	  <tr>
	    <td class="normal14" >頁次權限(0/1/2)：</td>
		<td class="normal14">
		   <input type="text" tabIndex="5" id="mg003" onKeyPress="keyFunction()" name="mg003" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg003); ?>"   /><span>(0可見可改,1可見不可改,2不可見)</span></td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	  
	  <tr>
	    <td class="start14a" width="12%">基本權限：</td>
	    <td class="normal14" colspan="3" >
		         <span  >新增　&nbsp;查詢　&nbsp;修改　&nbsp;刪除　&nbsp;確認　&nbsp;取消　&nbsp;列印　&nbsp;成本　&nbsp;售價　&nbsp;複製　&nbsp;轉檔　&nbsp;管制　&nbsp;結案　&nbsp;確認　&nbsp;全選　&nbsp;不選</span><br>
		        <input type="hidden" name="mg611" class="mg611"  value="N" />
                <input type="checkbox" name="mg611" id="mg611" class="mg611"  <?php if($mg611 == 'Y' ) echo 'checked'; ?>  <?php if($mg611 !== 'Y' ) echo 'check'; ?> value="Y"   />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg612"  class="mg612"  value="N" />
                <input type="checkbox" name="mg612" id="mg612" <?php if($mg612 == 'Y' ) echo 'checked'; ?>  <?php if($mg612 !== 'Y' ) echo 'check'; ?> value="Y"  />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg613" value="N" />
                <input type="checkbox" name="mg613" id="mg613" <?php if($mg613 == 'Y' ) echo 'checked'; ?>  <?php if($mg613 !== 'Y' ) echo 'check'; ?> value="Y"  />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg614" value="N" />
                <input type="checkbox" name="mg614" id="mg614" <?php if($mg614 == 'Y' ) echo 'checked'; ?>  <?php if($mg614 !== 'Y' ) echo 'check'; ?> value="Y"  />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg615" value="N" />
                <input type="checkbox" name="mg615" id="mg615" <?php if($mg615 == 'Y' ) echo 'checked'; ?>  <?php if($mg615 !== 'Y' ) echo 'check'; ?> value="Y"  />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg616" value="N" />
                <input type="checkbox" name="mg616"  id="mg616" <?php if($mg616 == 'Y' ) echo 'checked'; ?>  <?php if($mg616 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg617" value="N" />
                <input type="checkbox" name="mg617" id="mg617" <?php if($mg617 == 'Y' ) echo 'checked'; ?>  <?php if($mg617 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg618"  value="N" />
                <input type="checkbox" name="mg618" id="mg618" <?php if($mg618 == 'Y' ) echo 'checked'; ?>  <?php if($mg618 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg619" value="N" />
                <input type="checkbox" name="mg619" id="mg619" <?php if($mg619 == 'Y' ) echo 'checked'; ?>  <?php if($mg619 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg620" value="N" />
                <input type="checkbox" name="mg620" id="mg620" <?php if($mg620 == 'Y' ) echo 'checked'; ?>  <?php if($mg620 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg621" value="N" />
                <input type="checkbox" name="mg621" id="mg621"  <?php if($mg621 == 'Y' ) echo 'checked'; ?>  <?php if($mg621 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg622" value="N" />
                <input type="checkbox" name="mg622" id="mg622" <?php if($mg622 == 'Y' ) echo 'checked'; ?>  <?php if($mg622 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg623" value="N" />
                <input type="checkbox" name="mg623" id="mg623" <?php if($mg623 == 'Y' ) echo 'checked'; ?>  <?php if($mg623 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg624" value="N" />
                <input type="checkbox" name="mg624" id="mg624" <?php if($mg624 == 'Y' ) echo 'checked'; ?>  <?php if($mg624 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;
				
				<input type="hidden" name="mg006" value="N" />
                <input type="checkbox" name="mg006" onclick="check_mg006y();" onKeyPress="keyFunction()" <?php if($mg006 == 'Y' ) echo 'checked'; ?>  <?php if($mg006 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg0061" value="N" />
                <input type="checkbox" name="mg0061" onclick="check_mg006n();" onKeyPress="keyFunction()" <?php if($mg0061 == 'Y' ) echo 'checked'; ?>  <?php if($mg0061 !== 'Y' ) echo 'check'; ?> value="Y" />
				<!--  <input type="text" tabIndex="6" id="mg006" onfocus="merge6()" onKeyPress="keyFunction()" name="mg006" onkeyup="this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase()"  value="<?php echo  strtoupper($mg006); ?>"  size="18" /> -->
		</td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	  
	   <tr>
	    <td class="start14a" >群組權限：</td>
		<td class="normal14" colspan="3" >
		        <input type="hidden" name="mg711" value="N" />
                <input type="checkbox" name="mg711" <?php if($mg711 == 'Y' ) echo 'checked'; ?>  <?php if($mg711 !== 'Y' ) echo 'check'; ?>  value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg712" value="N" />
                <input type="checkbox" name="mg712" <?php if($mg712 == 'Y' ) echo 'checked'; ?>  <?php if($mg712 !== 'Y' ) echo 'check'; ?>  value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg713" value="N" />
                <input type="checkbox" name="mg713" <?php if($mg713 == 'Y' ) echo 'checked'; ?>  <?php if($mg713 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg714" value="N" />
                <input type="checkbox" name="mg714" <?php if($mg714 == 'Y' ) echo 'checked'; ?>  <?php if($mg714 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg715" value="N" />
                <input type="checkbox" name="mg715" <?php if($mg715 == 'Y' ) echo 'checked'; ?>  <?php if($mg715 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg716" value="N" />
                <input type="checkbox" name="mg716" <?php if($mg716 == 'Y' ) echo 'checked'; ?>  <?php if($mg716 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp; 
				<input type="hidden" name="mg717" value="N" />
                <input type="checkbox" name="mg717" <?php if($mg717 == 'Y' ) echo 'checked'; ?>  <?php if($mg717 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg718" value="N" />
                <input type="checkbox" name="mg718" <?php if($mg718 == 'Y' ) echo 'checked'; ?>  <?php if($mg718 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg719" value="N" />
                <input type="checkbox" name="mg719" <?php if($mg719 == 'Y' ) echo 'checked'; ?>  <?php if($mg719 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg720" value="N" />
                <input type="checkbox" name="mg720" <?php if($mg720 == 'Y' ) echo 'checked'; ?>  <?php if($mg720 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg721" value="N" />
                <input type="checkbox" name="mg721" <?php if($mg721 == 'Y' ) echo 'checked'; ?>  <?php if($mg721 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg722" value="N" />
                <input type="checkbox" name="mg722" <?php if($mg722 == 'Y' ) echo 'checked'; ?>  <?php if($mg722 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg723" value="N" />
                <input type="checkbox" name="mg723" <?php if($mg723 == 'Y' ) echo 'checked'; ?>  <?php if($mg723 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg724" value="N" />
                <input type="checkbox" name="mg724" <?php if($mg724 == 'Y' ) echo 'checked'; ?>  <?php if($mg724 !== 'Y' ) echo 'check'; ?> value="Y" />
		</td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
	  <tr>
	    <td class="start14a" >他組群限：</td>
		<td class="normal14" colspan="3"  >
		        <input type="hidden" name="mg811" value="N" />
                <input type="checkbox" name="mg811" <?php if($mg811 == 'Y' ) echo 'checked'; ?>  <?php if($mg811 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg812" value="N" />
                <input type="checkbox" name="mg812" <?php if($mg812 == 'Y' ) echo 'checked'; ?>  <?php if($mg812 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg813" value="N" />
                <input type="checkbox" name="mg813"<?php if($mg813 == 'Y' ) echo 'checked'; ?>  <?php if($mg813 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg814" value="N" />
                <input type="checkbox" name="mg814"<?php if($mg814 == 'Y' ) echo 'checked'; ?>  <?php if($mg814 !== 'Y' ) echo 'check'; ?>  value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg815" value="N" />
                <input type="checkbox" name="mg815" <?php if($mg815 == 'Y' ) echo 'checked'; ?>  <?php if($mg815 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg816" value="N" />
                <input type="checkbox" name="mg816" <?php if($mg816 == 'Y' ) echo 'checked'; ?>  <?php if($mg816 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp; 
				<input type="hidden" name="mg817" value="N" />
                <input type="checkbox" name="mg817" <?php if($mg817 == 'Y' ) echo 'checked'; ?>  <?php if($mg817 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg818" value="N" />
                <input type="checkbox" name="mg818" <?php if($mg818 == 'Y' ) echo 'checked'; ?>  <?php if($mg818 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg819" value="N" />
                <input type="checkbox" name="mg819" <?php if($mg819 == 'Y' ) echo 'checked'; ?>  <?php if($mg819 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg820" value="N" />
                <input type="checkbox" name="mg820" <?php if($mg820 == 'Y' ) echo 'checked'; ?>  <?php if($mg820 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg821" value="N" />
                <input type="checkbox" name="mg821" <?php if($mg821 == 'Y' ) echo 'checked'; ?>  <?php if($mg821 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp; 
				<input type="hidden" name="mg822" value="N" />
                <input type="checkbox" name="mg822" <?php if($mg822 == 'Y' ) echo 'checked'; ?>  <?php if($mg822 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;
				<input type="hidden" name="mg823" value="N" />
                <input type="checkbox" name="mg823" <?php if($mg823 == 'Y' ) echo 'checked'; ?>  <?php if($mg823 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="mg824" value="N" />
                <input type="checkbox" name="mg824" <?php if($mg824 == 'Y' ) echo 'checked'; ?>  <?php if($mg824 !== 'Y' ) echo 'check'; ?> value="Y" />　&nbsp;&nbsp;&nbsp;
		</td>
		<td class="normal14"></td>
        <td class="normal14"></td>
	  </tr>
		
	</table>
	   		  
	<!--<div class="buttons">
	<button  type='submit' accesskey="s" name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"   id='cancel' name='cancel' href="<?php echo site_url('adm/admi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div>  <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<script type="text/javascript">
function check_mg006y() {
	var checky = "Y";
	console.log(checky);
	document.getElementById("mg611").checked = true;
	document.getElementById("mg612").checked = true;
	document.getElementById("mg613").checked = true;
	document.getElementById("mg614").checked = true;
	document.getElementById("mg615").checked = true;
	document.getElementById("mg616").checked = true;
	document.getElementById("mg617").checked = true;
	document.getElementById("mg618").checked = true;
	document.getElementById("mg619").checked = true;
	document.getElementById("mg620").checked = true;
	document.getElementById("mg621").checked = true;
	document.getElementById("mg622").checked = true;
	document.getElementById("mg623").checked = true;
	document.getElementById("mg624").checked = true; 
	
}

function check_mg006n() {
	var checky = "Y";
	console.log(checky);
	document.getElementById("mg611").checked = false;
	document.getElementById("mg612").checked = false;
	document.getElementById("mg613").checked = false;
	document.getElementById("mg614").checked = false;
	document.getElementById("mg615").checked = false;
	document.getElementById("mg616").checked = false;
	document.getElementById("mg617").checked = false;
	document.getElementById("mg618").checked = false;
	document.getElementById("mg619").checked = false;
	document.getElementById("mg620").checked = false;
	document.getElementById("mg621").checked = false;
	document.getElementById("mg622").checked = false;
	document.getElementById("mg623").checked = false;
	document.getElementById("mg624").checked = false;
}
</script>
 <?php include("./application/views/fun/admi05_funjs_v.php"); ?> 

 