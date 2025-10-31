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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 製令成本建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cst/csti04/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	 
	  $me001=$this->input->post('me001');
	  $me001disp=$this->input->post('me001disp');
	  $me001disp1=$this->input->post('me001disp1');
	  $me001disp2=$this->input->post('me001disp2');
      $me002=$this->input->post('me002');
	  $me003=$this->input->post('me003');
      $me004=$this->input->post('me004');	  
      $me005=$this->input->post('me005');
      $me006=$this->input->post('me006');
	  $me007=$this->input->post('me007');
	  $me008=$this->input->post('me008');
      $me009=$this->input->post('me009');	  
      $me010=$this->input->post('me010');
      $me011=$this->input->post('me011');
	  $me012=$this->input->post('me012');
	  $me013=$this->input->post('me013');
      $me014=$this->input->post('me014');	  
      $me015=$this->input->post('me015');
      $me016=$this->input->post('me016');
	  $me017=$this->input->post('me017');
	  $me018=$this->input->post('me018');
      $me019=$this->input->post('me019');	  
      $me020=$this->input->post('me020');
	  $me021=$this->input->post('me021');
	  $me022=$this->input->post('me022');
	  $me023=$this->input->post('me023');
      $me024=$this->input->post('me024');	  
      $me025=$this->input->post('me025');
      $me026=$this->input->post('me026');
	  $me027=$this->input->post('me027');
	  $me028=$this->input->post('me028');
      $me029=$this->input->post('me029');	  
      $me030=$this->input->post('me030');
	  $me031=$this->input->post('me031');
	  $me032=$this->input->post('me032');
	  $me033=$this->input->post('me033');
      $me034=$this->input->post('me034');	  
      $me035=$this->input->post('me035');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">製令單別：</span> </td>
        <td class="normal14a"  width="23%"><input type="text" tabIndex="1" id="me034"  onKeyPress="keyFunction()"  onchange="startkey(this)"  name="me034" value="<?php echo $me034; ?>" size="20"  required />
		 </td>
	    <td class="normal14a"  width="10">製令單號：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="3"  id="me035"  onKeyPress="keyFunction()" name="me035"   value="<?php echo  $me035; ?>"    size="12"    /></td>
		<td class="normal14a" width="10%">年月：</td>
        <td class="normal14a" width="24%" ><input type="text" tabIndex="4"  id="me002" onKeyPress="keyFunction()" name="me002"   value="<?php echo  $me002; ?>"    size="12"    /></td>	
         </tr>	
		  
	  <tr>
	    <td class="normal14" >品號： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me001" onKeyPress="keyFunction()"  name="me001" value="<?php echo $me001; ?>" size="30"  required /></td>
		<td  class="normal14" >品名：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me001disp" onKeyPress="keyFunction()" name="me001disp"  value="<?php echo $me001disp; ?>"  size="20"  style="background-color:#F5F5F5" /></td>
		<td class="normal14" >規格：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8" readonly="value" id="me001disp1" onKeyPress="keyFunction()" name="me001disp1"   value="<?php echo $me001disp1; ?>"  size="20"  style="background-color:#F5F5F5"  /></td>
	    
	  </tr>
		
	  <tr>
	    <td  class="normal14" >單位：</td>
        <td  class="normal14"  ><input type="text" tabIndex="10" id="me001disp2" onKeyPress="keyFunction()" name="me001disp2"  value="<?php echo $me001disp2; ?>"  size="10"  style="background-color:#F5F5F5" /></td>
	    </tr>
	  
	  
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >詳細欄位a</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料1 -->
	<div id="tab1" class="tab_content">
	
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	    <tr>
	    <td class="normal14a"  width="16%">期初在製約量-材料：</td>
        <td class="normal14a"  width="17%"><input type="text" tabIndex="1" id="me005"  onKeyPress="keyFunction()"    name="me005" value="<?php echo $me005; ?>"  />
		 </td>
	    <td class="normal14a"  width="10">本期生產入庫：</td>
        <td class="normal14a"  width="23%" ><input type="text" tabIndex="3" readonly="value" id="me003"  onKeyPress="keyFunction()" name="me003"   value="<?php echo  $me003; ?>"      /></td>
		<td class="normal14a" width="16%">期未在製約量鎖定：</td>
        <td class="normal14a" width="18%" ><input type="text" tabIndex="4" readonly="value" id="me023" onKeyPress="keyFunction()" name="me023"   value="<?php echo  $me023; ?>"  size="2"   /></td>	
         </tr>	
		<tr>
	    <td class="normal14" >期初在製約量-人工製費： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me006" onKeyPress="keyFunction()"  name="me006" value="<?php echo $me006; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >託外進貨：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me004" onKeyPress="keyFunction()" name="me004"  value="<?php echo $me004; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未在製約量-材料：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8" id="me024" onKeyPress="keyFunction()" name="me024"   value="<?php echo $me024; ?>"   /></td>
	     </tr>  
	   <tr>
	    <td class="normal14" >期初在製約量-加工費用： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me014" onKeyPress="keyFunction()"  name="me014" value="<?php echo $me014; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >報廢數量：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me015" onKeyPress="keyFunction()" name="me015"  value="<?php echo $me015; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未在製約量-人工製費：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me025" onKeyPress="keyFunction()" name="me025"   value="<?php echo $me025; ?>"   /></td>
	     </tr>  
		<tr>
	    <td class="normal14" >期初材料成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me007" onKeyPress="keyFunction()"  name="me007" value="<?php echo $me007; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期材料成本：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me016" onKeyPress="keyFunction()" name="me016"  value="<?php echo $me016; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未在製約量-加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me026" onKeyPress="keyFunction()" name="me026"   value="<?php echo $me026; ?>"   /></td>
	     </tr>  
		 <tr>
	    <td class="normal14" >期初人工成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me008" onKeyPress="keyFunction()"  name="me008" value="<?php echo $me008; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期人工成本：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me017" onKeyPress="keyFunction()" name="me017"  value="<?php echo $me017; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未材料成本：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me027" onKeyPress="keyFunction()" name="me027"   value="<?php echo $me027; ?>"   /></td>
	     </tr>  
		  <tr>
	    <td class="normal14" >期初製造費用： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me009" onKeyPress="keyFunction()"  name="me009" value="<?php echo $me009; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期製造費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me018" onKeyPress="keyFunction()" name="me018"  value="<?php echo $me018; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未人工成本：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me028" onKeyPress="keyFunction()" name="me028"   value="<?php echo $me028; ?>"   /></td>
	     </tr> 
		  <tr>
	    <td class="normal14" >期初加工費用： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me010" onKeyPress="keyFunction()"  name="me010" value="<?php echo $me010; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期加工費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me019" onKeyPress="keyFunction()" name="me019"  value="<?php echo $me019; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未製造費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me029" onKeyPress="keyFunction()" name="me029"   value="<?php echo $me029; ?>"   /></td>
	     </tr> 
		  <tr>
	    <td class="normal14" >期初在製合計： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me010tot" onKeyPress="keyFunction()"  name="me010tot" value="<?php echo $me007+$me008+$me009+$me010; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期投入合計：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me019tot" onKeyPress="keyFunction()" name="me019tot"  value="<?php echo $me016+$me017+$me018+$me019; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >期未加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me030" onKeyPress="keyFunction()" name="me030"   value="<?php echo $me030; ?>"   /></td>
	     </tr> 
		   <tr>
	    <td class="normal14" >本期下階人工成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me020" onKeyPress="keyFunction()"  name="me020" value="<?php echo $me020; ?>"  style="background-color:#F5F5F5" /></td>
		<td  class="normal14" >本期下階製造費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me021" onKeyPress="keyFunction()" name="me021"  value="<?php echo $me021; ?>"   style="background-color:#F5F5F5" /></td>
		<td class="normal14" >本期下階加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me022" onKeyPress="keyFunction()" name="me022"   value="<?php echo $me022; ?>" style="background-color:#F5F5F5"  /></td>
	     </tr> 
		    <tr>
	    <td class="normal14" >期未下階人工成本： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me031" onKeyPress="keyFunction()"  name="me031" value="<?php echo $me031; ?>"  /></td>
		<td  class="normal14" >期未下階製造費用：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me032" onKeyPress="keyFunction()" name="me032"  value="<?php echo $me032; ?>"  /></td>
		<td class="normal14" >期未下階加工費用：</td>						
        <td  class="normal14"  ><input  type="text" tabIndex="8"  id="me033" onKeyPress="keyFunction()" name="me033"   value="<?php echo $me033; ?>"  /></td>
	     </tr> 
		   <tr>
	    <td class="normal14" >期未在製合計： </td>
        <td class="normal14" ><input type="text" tabIndex="6" id="me030tot" onKeyPress="keyFunction()"  name="me030tot" value="<?php echo $me027+$me028+$me029+$me030; ?>"  /></td>
		 </tr> 
	</table>
	</div>
	
	
	 
	</div> <!-- div-7 -->
	
	<div class="buttons">
	<button  type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('cst/csti04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
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
    function showkey(sText){   //不更新網頁 5 key  品號代號 檢查資料重複 csti04-add
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

function startkey(oInput){         //不更新網頁 key 品號代號函數 檢查資料重複 csti04-add
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cst/csti04/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
 <?php // include_once("./application/views/funnew/cmsi03_funmjs_v.php"); ?> <!-- 庫別 -->
				 