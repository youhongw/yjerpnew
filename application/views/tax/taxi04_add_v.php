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

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 營業稅申報資料 - 新增　　　</h1>
     <div style="float:left;padding-top: 5px; ">
	 <button style= "cursor:pointer" form="commentForm" onfocus="$('#cmsi11').focus();"  type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/tax/taxi04/addsave" >	
	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Ymd");
	  if(!isset($me001)) { $me001=$this->input->post('me001'); }
	  $cmsi11disp=$this->input->post('cmsi11');
	  $me002=$this->input->post('me002');
      $me003=$this->input->post('me003');
	  $me004=0;
	  if(!isset($me007)) { $me007='1'; } else { $me007=$this->input->post('me007'); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="12%"><span class="required">申報公司：</span> </td>
        <td class="normal14a"  width="38%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $me001; ?>"  type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $cmsi11disp; ?> </span></td>
	    <td class="normal14y" width="12%" >起始年月： </td>
        <td class="normal14a"  width="38%" ><input tabIndex="3" id="me002" class="date-picker" onChange="dateformat_ym(this)" onKeyPress="keyFunction()"    type="text" name="me002"  value="<?php echo $me002; ?>"   style="background-color:#FFFFE4" />
        
           </td>
	    </tr>	
		  
	  <tr>
	    <td class="normal14z" >截止年月： </td>
        <td class="normal14" ><input tabIndex="3" id="me003"  class="date-picker" onChange="dateformat_ym(this)" onKeyPress="keyFunction()"    type="text" name="me003"  value="<?php echo $me003; ?>"   style="background-color:#FFFFE4" />
      <!--   <img  onclick="fPopCalendar(event,me003,me003);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> -->
           </td>
		<td  class="normal14z" >發票份數：</td>
        <td  class="normal14"  ><input type="text"  tabIndex="7" id="me004" onKeyPress="keyFunction()" name="me004"  value="<?php echo $me004; ?>"    /></td>
		
	  </tr>
	  
	  <tr>
	    <td  class="normal14z" >退稅方式：</td>
        <td  class="normal14" ><input type="radio" name="me007" <?php if (isset($me007) && $me007=="1") echo "checked";?> value="1" />1.利用存款帳戶劃撥　 
               <input type="radio" name="me007" <?php if (isset($me007) && $me007=="2") echo "checked";?> value="2" />2.領取退稅支票
        </td>
        <td class="normal14"  ></td>
		<td class="normal14"  ></td>
	  </tr>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
			<li><a href="#tab1"  accesskey="a" >基本資料a</a></li>
			<li><a href="#tab2"  accesskey="b">403資料b</a></li>
		</ul>
		
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料1 -->
	<div id="tab1" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $me008=0;
	  $me009=0;
	  $me010=0;
	  $me011=0;
	  $me012=0;
	  $me013=0;
	  $me014=0;
	  $me015=0;
	  $me016=0;
	  $me017=0;
	  $me018=0;
	  $me019=0;
	  $me024=$this->input->post('me024');
	  $me038=0;
	  $me039=0;
	?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	    <td class="normal14y" width="12%" >銷售固定資產金額：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="7" id="me013" onKeyPress="keyFunction()" name="me013"  value="<?php echo $me013; ?>"    /></td>	
		<td class="normal14y"  width="12%">發票明細表(分)：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="8" id="me008" onKeyPress="keyFunction()" name="me008"  value="<?php echo $me008; ?>"    /></td>
		</tr>	
		  
	   <tr>
	    <td class="normal14z" >不得扣抵憑證費用：</td>
        <td class="normal14"  ><input type="text"  tabIndex="9" id="me014" onKeyPress="keyFunction()" name="me014"  value="<?php echo $me014; ?>"    /></td>	
		<td class="normal14z" >進項憑證(冊)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="10" id="me009" onKeyPress="keyFunction()" name="me009"  value="<?php echo $me009; ?>"    /></td>	    
		</tr>
		
		<tr>
	    <td class="normal14z" >不得扣抵憑證資產：</td>
        <td class="normal14"  ><input type="text"  tabIndex="11" id="me015" onKeyPress="keyFunction()" name="me015"  value="<?php echo $me015; ?>"    /></td>	
		<td class="normal14z" >進項憑證(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="12" id="me010" onKeyPress="keyFunction()" name="me010"  value="<?php echo $me010; ?>"    /></td>	    
		</tr>
	    <tr>
	    <td class="normal14z" >進口免稅貨物：</td>
        <td class="normal14"  ><input type="text"  tabIndex="13" id="me017" onKeyPress="keyFunction()" name="me017"  value="<?php echo $me017; ?>"    /></td>	
		<td class="normal14z" >証明單(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="14" id="me011" onKeyPress="keyFunction()" name="me011"  value="<?php echo $me011; ?>"    /></td>	    
		</tr>
		<tr>
	    <td class="normal14z" >購買國外勞務：</td>
        <td class="normal14"  ><input type="text"  tabIndex="15" id="me018" onKeyPress="keyFunction()" name="me018"  value="<?php echo $me018; ?>"    /></td>	
		<td class="normal14z" >申報聯(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="16" id="me012" onKeyPress="keyFunction()" name="me012"  value="<?php echo $me012; ?>"    /></td>	    
		</tr>
		<tr>
	    <td class="normal14z" >本期積留底稅額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="17" id="me019" onKeyPress="keyFunction()" name="me019"  value="<?php echo $me019; ?>"    /></td>	
		<td class="normal14z" >海關代徵營業稅繳納證(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="18" id="me038" onKeyPress="keyFunction()" name="me038"  value="<?php echo $me038; ?>"    /></td>	    
		</tr>
		<tr>
	    <td class="normal14z" >備註：</td>
        <td class="normal14"  ><input type="text"  tabIndex="19" id="me024" onKeyPress="keyFunction()" name="me024"  value="<?php echo $me024; ?>"    /></td>	
		<td class="normal14z" >零稅率銷貨額清單(分)：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="20" id="me039" onKeyPress="keyFunction()" name="me039"  value="<?php echo $me039; ?>"    /></td>	    
		</tr>
	</table>
	</div>
	
	<!-- 基本資料2 -->
	<div id="tab2" class="tab_content">
	<?php
	  $date=date("Ymd");
	  $me025=0;
	  $me026=0;
	  $me027=0;
	  $me028=0;
	  $me029=0;
	  $me030=0;
	  $me033=0;
	  $me034=0;
	  $me035=0;
	  $me036=0;
	  $me037=0;
	  $me020=0;
	  $me022=0;
	  $me023=0;
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="12%" >特種飲食業25%金額：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="21" id="me025" onKeyPress="keyFunction()" name="me025"  value="<?php echo $me025; ?>"    /></td>	
		<td class="normal14y"  width="12%">稅額：</td>
        <td class="normal14a"  width="38%" ><input type="text"  tabIndex="22" id="me026" onKeyPress="keyFunction()" name="me026"  value="<?php echo $me026; ?>"    /></td>
		</tr>	
		  
	   <tr>
	    <td class="normal14z" >特種飲食業15%金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="23" id="me027" onKeyPress="keyFunction()" name="me027"  value="<?php echo $me027; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="24" id="me028" onKeyPress="keyFunction()" name="me028"  value="<?php echo $me028; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >金融本業收入金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="25" id="me029" onKeyPress="keyFunction()" name="me029"  value="<?php echo $me029; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="26" id="me030" onKeyPress="keyFunction()" name="me030"  value="<?php echo $me030; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >再保收入金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="27" id="me033" onKeyPress="keyFunction()" name="me033"  value="<?php echo $me033; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="28" id="me034" onKeyPress="keyFunction()" name="me034"  value="<?php echo $me034; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >免稅收入金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="29" id="me035" onKeyPress="keyFunction()" name="me035"  value="<?php echo $me035; ?>"    /></td>	
		<td class="normal14a" ></td>             
		 <td class="normal14"  ></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >退回及折讓金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="30" id="me036" onKeyPress="keyFunction()" name="me036"  value="<?php echo $me036; ?>"    /></td>	
		<td class="normal14z" >稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="31" id="me037" onKeyPress="keyFunction()" name="me037"  value="<?php echo $me037; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >銷售土地金額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="32" id="me020" onKeyPress="keyFunction()" name="me020"  value="<?php echo $me020; ?>"    /></td>	
		<td class="normal14z" >中途歇業補徵應繳稅額：</td>             
		 <td class="normal14"  ><input type="text"  tabIndex="33" id="me022" onKeyPress="keyFunction()" name="me022"  value="<?php echo $me022; ?>"    /></td>	    
		</tr>
		 <tr>
	    <td class="normal14z" >中途歇業應退稅額：</td>
        <td class="normal14"  ><input type="text"  tabIndex="34" id="me023" onKeyPress="keyFunction()" name="me023"  value="<?php echo $me023; ?>"    /></td>	
		<td class="normal14a" ></td>             
		 <td class="normal14"  ></td>	    
		</tr>
	  
		
	</table>
	</div>
	 
	</div> <!-- div-7 -->
	
	<!--<div class="buttons">
	<button  type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a accesskey="x" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/back.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
  
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

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
    function showkey(sText){   //不更新網頁 5 key  品號代號 檢查資料重複 invi02-add
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

function startkey(oInput){         //不更新網頁 key 品號代號函數 檢查資料重複 invi02-add
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/tax/taxi04/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
   <!-- 開視年月 -->
<script type="text/javascript"><!--  
/* function dateym(oInput){
$('.date-picker').datepicker( {
    changeMonth: true, 
    changeYear: true, 
    showButtonPanel: true, 
    dateFormat: 'yy/MM', 
	monthNames: ['01', '02', '03', '04', '05', '06',
            '07', '08', '09', '10', '11', '12'],
	monthNamesShort: ['01', '02', '03', '04', '05', '06',
            '07', '08', '09', '10', '11', '12'],
    onClose: function(dateText, inst) { 
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
        $(this).datepicker('setDate', new Date(year, month, 1)); 
    } 
});
 }; */
//--></script>

 <?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 共用函數 -->
 <?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
				 