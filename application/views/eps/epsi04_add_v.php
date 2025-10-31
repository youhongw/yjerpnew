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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 客戶麥頭基本資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/eps/epsi04/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	  if(!isset($md001)) { $md001=$this->input->post('md001'); }
	  if(!isset($md001disp)) { $md001disp=$this->input->post('md001disp'); }
	  if(!isset($md002)) { $md002=$this->input->post('md002'); }
	  
	  if(!isset($md003)) { $md003=$this->input->post('md003'); }
	  if(!isset($md004)) { $md004=$this->input->post('md004'); }
	  if(!isset($md005)) { $md005=$this->input->post('md005'); }
	  if(!isset($md006)) { $md006=$this->input->post('md006'); }
	  if(!isset($md007)) { $md007=$this->input->post('md007'); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="12%"><span class="required">客戶代號：</span> </td>
        <td class="normal14a"  width="48%"><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="md001" value="<?php echo $md001; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $md001disp; ?> </span></td>
	    <td class="normal14a" width="12%" >麥頭代號： </td>
        <td class="normal14a"  width="48%" ><input type="text" tabIndex="3" id="md002"  onKeyPress="keyFunction()" name="md002"   value="<?php echo  $md002; ?>"    size="10"   /></td>
	     </tr>	
		  
	  <tr>
	    <td class="normal14a"  >主要麥頭：</td>	
        <td class="normal14a"  ><input type="hidden" name="md003" value="N" />
		<input tabIndex="12" type="checkbox"  id="md003" onKeyPress="keyFunction()"   name="md003" <?php if($md003 == 'Y' ) echo 'checked'; ?>  <?php if($md003 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	     <td  class="normal14" >麥頭名稱：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="md007" onKeyPress="keyFunction()" name="md007"  value="<?php echo $md007; ?>"  size="20"   /></td>
		 </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" id="md006" onKeyPress="keyFunction()" name="md006"  value="<?php echo $md006; ?>"  size="60"   /></td>
	    <td class="normal14"></td>
        <td class="normal14"></td>	
	  </tr>
	  
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >正麥a</a></li>
			<li><a href="#tab2"  accesskey="b">側麥b</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料1 -->
	<div id="tab1" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	 <tr>	
		<td colspan="1" class="normal14a" width="6%" >正麥：</td>
        <td colspan="3"  class="normal14a" width="94%" ><textarea  tabIndex="25" rows="12" cols="40"  name="md004" id="md004" Wrap="Physical" ><?php echo $md004; ?></textarea></td>
        <script>CKEDITOR.replace( 'md004' );</script>  
	 </tr>	
	</table>
	</div>
	
	<!-- 基本資料2 -->
	<div id="tab2" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	  <tr>	
		<td colspan="1" class="normal14a" width="6%" >側麥：</td>
        <td colspan="3"  class="normal14a" width="94%" ><textarea  tabIndex="25" rows="12" cols="40"  name="md005" id="md005" Wrap="Physical" ><?php echo $md005; ?></textarea></td>
        <script>CKEDITOR.replace( 'md005' );</script>  
	 </tr>	
		
	</table>
	</div>
	 
	</div> <!-- div-7 -->
	
	<div class="buttons">
	<button  type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('eps/epsi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	</div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div>  <!-- div-1 -->

<script language="javascript"   >   //不更新網頁, 帶出資料
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
    function showkey(sText){   //不更新網頁 5 key  客戶麥頭代號 檢查資料重複 epsi04-add
	var oSpan = document.getElementById("keydisp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	  if (sText) { 
	   $("#keydisp").html("資料重複!");
	   oSpan.style.color = "#ff0000";
	 //  document.getElementById("ma002").focus();
	 } 
}

function startkey(oInput){         //不更新網頁 key 客戶麥頭代號函數 檢查資料重複 epsi04-add
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/eps/epsi04/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showkey(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
</script>
   
 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/copi01a_funmjs_v.php"); ?>  <!-- 客戶回傳多欄 -->
				 