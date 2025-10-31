<!-- 開視窗  程式代號 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showadmq02a").click(function() { 	   
	$.blockUI({ 
	  
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px',
	overflow:'hidden', 	
    '-webkit-border-radius': '10px',  
    '-moz-border-radius': '10px',  
    '-khtml-border-radius': '10px', 
    'border-radius': '10px', 
	}, 	   
	message: $('#divFadmq02a'), 	   
	}); 	   
		   
	$('.close').click(window.parent.$.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFadmq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/admq02a/display" allowTransparency="true" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addadmq02a(sma001,sma002) {	
	form.admq02a.value=sma001;
	var oSpan = document.getElementById("admq02adisp");
		oSpan.innerHTML = sma002;
	document.form.admq02a.focus();    
	return admq02a;	
}
//--></script>
 
<!-- 不更新網頁  共用 -->
<script type="text/javascript"><!-- 

var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁  共用 
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
	//	alert(xmlHttp);
}
      
//不更新網頁  key  使用者代號 檢查資料重複
function showkey(sText){    
	var oSpan = document.getElementById("keydisp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("此資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	  if (sText) { 
	   $("#keydisp").html("有此資料!");
	   oSpan.style.color = "#ff0000";
	 //  document.getElementById("ma002").focus();
	 } 
}

//不更新網頁 key 檢查資料重複
function startkey(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/adm/admi05/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
//不更新網頁  程式代號
function showadmq02a(sText){   
	var oSpan = document.getElementById("admq02adisp");	
	   
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	
}

//不更新網頁 程式代號
function startadmq02a(oInput){ 
	// alert('test');
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mg002disp").html("欄位不可空白.");      		
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/admq02a/dataadmq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	 
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showadmq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
</script>

<!--不更新網頁 檢查欄位空白 -->
 <script type="text/javascript"><!--       
 function checkspace(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
	//	oInput.focus();    //聚焦到的輸入框
		$("#spacedisp").html("不可空白.");	
	//	return;
//	}
	 
}

function merge6(oInput){
	 var Value = $('.mg611').val();	 
     alert(Value);
	 return Value;
}
</script>