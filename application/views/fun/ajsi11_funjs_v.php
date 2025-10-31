<!-- 開視窗 purq04a34 應付憑單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showacpq01a71").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFacpq01a71'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  
	<div id="divFacpq01a71" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/acpq01a/display71" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addacpq01a71(sma001,sma002) {	
	form.acpq01a71.value=sma001;
	var oSpan = document.getElementById("acpq01a71disp");
		oSpan.innerHTML = sma002;
	document.form.acpq01a71.focus();    
	return acpq01a71;	
}
//--></script>
<!-- 開視窗 purq04a34 付款單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showinvq04a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFinvq04a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  
	<div id="divFinvq04a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq04a/display1" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addinvq04a11(sma001,sma002) {	
	form.invq04a.value=sma001;
	var oSpan = document.getElementById("invq04adisp");
		oSpan.innerHTML = sma002;
	document.form.invq04a.focus();    
	return invq04a;	
}
//--></script>
<!-- 開視窗 actq02a 傳票單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showactq02a").click(function() { 	   
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFactq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  

	<div id="divFactq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq02a/display91" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
	
<script type="text/javascript"><!--
  function addactq02a91(sma001,sma002) {	
	form.actq02a.value=sma001;
	var oSpan = document.getElementById("actq02adisp");
		oSpan.innerHTML = sma002;
	document.form.actq02a.focus();    
	return actq02a;	
}
//--></script>
<!-- 不更新網頁, 帶出資料  -->
<script language="javascript"   >
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

   function showkey(sText){   //不更新網頁 5 key  檢查資料重複 invi01-add
	 var oSpan = document.getElementById("keydisp");
	 oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("此資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	 if (sText) { 
	   $("#keydisp").html("此資料重複!");
	   oSpan.style.color = "#ff0000";
	 //document.getElementById("ma002").focus();
	 } 
    }

function startkey(oInput){         //不更新網頁 key  檢查資料重複 invi01-add
	//首先判斷是否有輸入，沒有輸入直接返回，並提示	
 	if(!oInput.value){
	  //oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	
	//建立非同步請求    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/adm/admi01/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

<!--檢查欄位空白 -->
<script type="text/javascript"><!-- 
function checkspace(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#spacedisp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
}
//--></script> 	