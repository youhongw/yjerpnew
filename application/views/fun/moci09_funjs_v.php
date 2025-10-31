<!-- 不更新網頁, 帶出資料 -->
<script language="javascript"   >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

   function showkey(sText){   //不更新網頁 5 key  客戶代號 檢查資料重複 
	var oSpan = document.getElementById("keydisp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("此資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	  if (sText) { 
	   $("#keydisp").html("此資料重複!");
	   oSpan.style.color = "#ff0000";
	 //  document.getElementById("ma002").focus();
	 } 
   }

<!-- 不更新網頁,key 檢查資料重複 -->
function startkey(oInput){         
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi01/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

<!-- 不更新網頁,交易幣別 -->
function showcmsq06a(sText){   //不更新網頁 18  交易幣別 
	var oSpan = document.getElementById("cmsq06adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,交易幣別 -->
function startcmsq06a(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi01/checkcmsq06a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq06a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	      //  alert('test');
		   document.form.ma020.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'ma020\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.ma020.focus(); return ma020;}	
}

//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 1 品號
	$(document).ready(function(){
	$("#Showinvq02a").click(function() { 	   
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
	message: $('#divFinvq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFinvq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq02a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addinvq02a(sma001,sma002,sma003,sma004) {	
	form.invq02a.value=sma001;
	form.mb002.value=sma002;
	form.mb003.value=sma003;
	var oSpan = document.getElementById("invq02adisp");
		oSpan.innerHTML = sma002+' '+sma003;
	//var oSpan1 = document.getElementById("invq02adisp1");
	//	oSpan1.innerHTML = sma003;
		 
	document.form.invq02a.focus();    
	return invq02a;	
}
//--></script>

<!-- 開視窗 cmsq02a 廠別 -->	
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq02a").click(function() { 	   
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
	message: $('#divFcmsq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq02a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq02a(sta001,sta002) {
	  	  form.cmsq02a.value=sta001;
	var oSpan = document.getElementById("cmsq02adisp");
		oSpan.innerHTML = sta002;
	document.form.cmsq02a.focus();    
	return cmsq02a;
	
}
//--></script>

<script language="javascript"   >
function showcmsq02a(sText){   //不更新網頁 ta010 廠別
	var oSpan = document.getElementById("cmsq02adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 cmsq02a 廠別 -->
function startcmsq02a(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta010disp").html("不可空白.");	
	//	return;
	//}
	//建立非同步請求
  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq02a/datacmsq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
</script>
<script text="javascript">
function startinvq02a(oInput){            //不更新網頁 3  品號
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#invq02adisp").html("<span style='color:red'>欄位不可空白.</span>");			
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/invq02a/checkinvq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showinvq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
</script>

<!-- 開視窗 cmsq06a 18 交易幣別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq06a").click(function() { 
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
	message: $('#divFcmsq06a'), 	   
	}); 	   
	$('.close').click($.unblockUI);	
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq06a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq06a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq06a(sma001,sma002) {
	form.cmsq06a.value=sma001;
	var oSpan = document.getElementById("cmsq06adisp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq06a.focus();    
	return cmsq06a;
}
//--></script>


<script type="text/javascript">
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1 a
		setTimeout(function() {
			$('input[name="ma004"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#ma079').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3 c
		setTimeout(function() {
			$('#ma032').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4 g
		setTimeout(function() {
			$('#ma017').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '72')){  //tab5 h
		setTimeout(function() {
			$('#ma048').focus();
		}, 100);	
	}
	
});
</script>