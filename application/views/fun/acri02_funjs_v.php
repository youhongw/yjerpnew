<!-- 開視窗 acrq01a61 結帳單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showacrq01a61").click(function() { 	   
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
	message: $('#divFacrq01a61'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFacrq01a61" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/acrq01a/display61" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addacrq01a61(sta001,sta002) {	
	form.acrq01a61.value=sta001;
	var oSpan = document.getElementById("acrq01a61disp");
		oSpan.innerHTML = sta002;
	document.form.acrq01a61.focus();    
	return acrq01a61;	
}
//--></script>

<script type="text/javascript"> 	   //開視窗  客戶代號 invi02
	$(document).ready(function(){ 	   
	$("#Showcopq01a").click(function() { 	   
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
	message: $('#divFcopq01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcopq01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq01a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

	<!-- 開視窗客戶代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址 9業務a 收款業務-->
<script type="text/javascript"><!--
  function addcopq01a(sma001,sma002,sma005,sma006,sma007,sma008,sma009,sma00a) {
   
	form.copq01a.value=sma001;
 	form.ta008.value=sma002;
 	form.cmsq06a.value=sma005;
	form.cmsq21a2.value=sma006;
	form.ta012.value=sma007;
	form.cmsq09a31.value=sma009;
	
	var oSpan = document.getElementById("copq01adisp");	
		oSpan.innerHTML = sma002;	
	document.form.copq01a.focus();    	
	return copq01a;
}
//--></script>
<!-- 開視窗 copc08a 前置單據 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcopc08a").click(function() { 	   
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
	message: $('#divFormcopc08a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcopc08a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copc08a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcopc08a(sma001,sma002) {
    var oSpan = document.getElementById("ta049");
		oSpan.innerHTML = 'testtesttest';  
       form.ta048.value=sma001;	
       form.ta049.value=sma002;		   
	url = '<?=base_url() ?>index.php/acr/acri02/copybefore/'+encodeURIComponent(sma001)+'/'+encodeURIComponent(sma002); 
	location = url;
	return true;
}
//--></script>
<!-- 開視窗 cmsq21a2 25 付款條件 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq21a2").click(function() { 	   
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
	message: $('#divFcmsq21a2'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq21a2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq21a/display2" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq21a2(sma001,sma002) {
	form.cmsq21a2.value=sma001;
	var oSpan = document.getElementById("cmsq21a2disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq21a2.focus();    
	return cmsq21a2;
}
//--></script>

<!-- 開視窗 cmsq05a 部門別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq05a").click(function() { 	   
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
	message: $('#divFcmsq05a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq05a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq05a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq05a(sta001,sta002) {
	  	  form.cmsq05a.value=sta001;
	var oSpan = document.getElementById("cmsq05adisp");
		oSpan.innerHTML = sta002;
	document.form.cmsq05a.focus();    
	return cmsq05a;
	
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
<!-- 開視窗 cmsq09a3 業務人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a3").click(function() { 	   
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
	message: $('#divFormcmsq09a3'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a3" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display3" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a3(sma001,sma002) {
	form.cmsq09a3.value=sma001;	
	var oSpan = document.getElementById("cmsq09a3disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a3.focus();    
	return cmsq09a3;
}
//--></script>
<!-- 開視窗 cmsq09a3 收款業務人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a31").click(function() { 	   
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
	message: $('#divFormcmsq09a31'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a31" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display31" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a31(sma001,sma002) {
	form.cmsq09a31.value=sma001;	
	var oSpan = document.getElementById("cmsq09a31disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a31.focus();    
	return cmsq09a31;
}
//--></script>
<!-- 開視窗 cmsq09a32  員工人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a32").click(function() { 	   
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
	message: $('#divFormcmsq09a32'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a32" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display32" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a32(sma001,sma002) {
	form.cmsq09a32.value=sma001;	
	var oSpan = document.getElementById("cmsq09a32disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a32.focus();    
	return cmsq09a32;
}
//--></script>
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

<!-- 不更新網頁帶出資料  -->
<script language="javascript"  >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}


function showacrq01a61(sText){                 //不更新網頁 32  結帳單別 cop/copi0501
	var oSpan = document.getElementById("acrq01a61disp");
      //   chkno1();
     
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 acrq01a21 結帳單別 -->        
function startacrq01a61(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#cop/copi0501disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
     
	createXMLHttpRequest();
     
   	var sUrl = "<?php echo base_url()?>index.php/fun/acrq01a/dataacrq01a61/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showacrq01a61(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}


function showcopq01a(sText){   //不更新網頁 32 客戶代號 
	var oSpan = document.getElementById("copq01adisp");
	// alert('sText');		
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startcopq01a(oInput){         //不更新網頁 32 客戶代號
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq01a/checkcopq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq01a(xmlHttp.responseText);	//顯示服務器結果
         //   alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁,業務人員 -->
function showcmsq09a3(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("cmsq09a3disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,業務人員 -->
function startcmsq09a3(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a3/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a3(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁,收款業務人員 -->
function showcmsq09a31(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("cmsq09a31disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,收款業務人員 -->
function startcmsq09a31(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a31/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a31(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
<!-- 不更新網頁,員工代號 -->
function showcmsq09a32(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("cmsq09a32disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,員工代號 -->
function startcmsq09a32(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a32/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a32(xmlHttp.responseText);	//顯示服務器結果		
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
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq06a/datacmsq06a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

<!-- 不更新網頁,付款條件 應付-->
function showcmsq21a2(sText){   
	var oSpan = document.getElementById("cmsq21a2disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,付款條件 -->
function startcmsq21a2(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq21a/datacmsq21a2/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq21a2(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

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

<!-- 不更新網頁帶出資料  結帳單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'ta038\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	 //  alert(z+no1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("ta002").value=zno3;
	 //  alert(zno3);
//	   var oSpan = document.getElementById("purq04a31disp");
//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
//	 if (!sText) { 
//	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
//	 }	
	   
	//	alert(zno3);
	//var oSpan = document.getElementById("ta002");	 
	// oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	 //   oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	

<!-- 不更新網頁 計算單號 結帳單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'acrq01a61\']').val();
	 var zstr=$('input[name=\'ta038\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
    //  alert(zymd);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/acr/acri02/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showchkno1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
function showcopq02a(sText,n){   //不更新網頁 6  單價 
	//var oSpan = document.getElementById("tb007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	 var nn=n;
	// var num = sText.length;
	// var sysma200=$('input[name=\'sysma200\']').val();
	// alert(nn);
	// alert(sText);	
	 if (sText>0){
	 $('input[name=\'order_product[' + nn + '][tj012]\']').val(sText)};
}

function startcopq02a(oInput,n){         //不更新網頁 6 單價
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
       var nn=n-1;
      var tc004=$('input[name=\'copq01a\']').val();     //客代
	  var tb004=$('input[name=\'order_product[' + nn + '][tj004]\']').val();  //品號
      var tb010=$('input[name=\'order_product[' + nn + '][tj008]\']').val();  //單位
	//  alert(tc004+tb004+tb010);
	//建立非同步請求
   // var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq02a/checkcopq02a/" + encodeURIComponent(tc004)+ "/" + encodeURIComponent(tb004)+ "/"+ encodeURIComponent(tb010)+ "/"+ new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq02a(xmlHttp.responseText,nn);	//顯示服務器結果
         // alert(xmlHttp.responseText);  
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq03a(sText,n){   //不更新網頁 6  庫別 
	//var oSpan = document.getElementById("tb007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	 var nn=n-1;
	 var num = sText.length;
	 var sysma200=$('input[name=\'sysma200\']').val();
	// alert(nn);
	// alert(num);
	// alert(sysma200);
	 if (num>sysma200){
          $('input[name=\'order_product[' + nn + '][tj09913disp]\']').val(sText); }  
}

function startcmsq03a(oInput,n){         //不更新網頁 6 庫別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq03a/checkcmsq03a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq03a(xmlHttp.responseText,nn);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
function showinvq02a(sText,n){   //不更新網頁 6  品號 
	//var oSpan = document.getElementById("tb007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	// alert(n);
	 var nn=n-1;	
	  var num = sText.length;
	 var str=(sText.split(";",3));
	  var sysma201=$('input[name=\'sysma201\']').val();
	//  alert(nn);
	// alert(str[1]);
	 if (num>sysma201){
     $('input[name=\'order_product[' + nn + '][tj005]\']').val(str[0]);  
     $('input[name=\'order_product[' + nn + '][tj006]\']').val(str[1]);
	 $('input[name=\'order_product[' + nn + '][tj008]\']').val(str[2]);}
}

function startinvq02a(oInput,n){         //不更新網頁 6 品號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求	
    var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/invq02a/checkinvq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showinvq02a(xmlHttp.responseText,nn);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}
<!-- 不更新網頁帶出資料 cmsq05a 部門 -->
function showcmsq05a(sText){   //不更新網頁 ta004 部門
	var oSpan = document.getElementById("cmsq05adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 cmsq05a 請購部門 -->
function startcmsq05a(oInput){         //不更新網頁 ta004 部門
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq05a/datacmsq05a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq05a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
//--></script>

 <!-- 不更新網頁 檢查欄位空白 -->	
<script type="text/javascript"><!--       
 function checkspace(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#spacedisp").html("<span style='color:red'>不可空白.</span>");	
		return ;
	}
	 
}

//--></script>
<!-- 不更新網頁 檢查 select 欄位 確認碼  -->	
<script type="text/javascript"><!--       
 function selappr(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('ta025').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	  if (selval==0) {
	     oSpan.innerHTML = "<span style='color:black'> 核准</span>";}
        else
		{ oSpan.innerHTML = "<span style='color:black'> 未核</span>";}
	 if (selval==2) {
	     oSpan.innerHTML = "<span style='color:black'> 作廢</span>";}
}

//--></script>
<!-- 不更新網頁 檢查 select 欄位 課稅  營業稅率-->	
<script type="text/javascript"><!--       
 function seltax(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('ta012').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("taxdisp");
	  if (selval==0) {form.ta044.value=0.05;oSpan.innerHTML = "<span style='color:red'> 應稅外加</span>";}	    
      else if (selval==1){  form.ta044.value=0.05;oSpan.innerHTML = "<span style='color:red'> 應稅內含</span>";}
	  else {  form.ta044.value=0;oSpan.innerHTML = "<span style='color:red'> 不計稅</span>";}
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.ta038.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'ta038\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.ta038.focus(); return ta038;}	
}

//--></script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1 a
		setTimeout(function() {
			$('input[name="ta006"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#ta007').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3 c
		setTimeout(function() {
			$('#ta034').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4 g
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '72')){  //tab5 h
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	//跳明細
	if(event.altKey && (keycode == '89')){  //tab6 y
		setTimeout(function() {
			$('select[name=\'order_product[0][tb004]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+y 
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
//--></script>
 <!-- 不更新網頁 下一個定位的索引 --> 	
<script type="text/javascript"> 
$(function () { 
var i = 0;//索引 
//以上的表單位置和上下文之间的關系就是label 後面会有一個input 標籤 type 可能是Password 可能是text 或者是其他的 
//可以按照個人需求修改，這里只定位到 type="text" 的表單如果是又有表單改成 $("label+ input") $("label+ :text")即可按個人需求 
$("class+ input").each(function () { 
$(this).keydown(function (e) { 
if (e.keyCode == 13) { 
i++;//下一個定位的索引 
try { 
$("class+ input")[i].focus(); 
} catch (e) {//到了最後一個的下一個可能找不到元素會出现異常通過 try 捕捉不至於程序出现異常 
return false;//必须要寫以免錯誤信息被提交 
} 
return false;//必须要寫以免錯誤信息被提交
} 
}); 
}); 
}); 
</script> 

<!-- 不更新網頁 自動提示方框資料前置小工具 --> 
<script type="text/javascript"><!--       
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
						
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
								
				currentCategory = item.category;
			}
							
			self._renderItem(ul, item);
		});
	}
});	
//--></script>

<script type="text/javascript"><!--    // 明細 新增 
var product_row = 0; 
var vtj0= -1;
function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][tb001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][tb002]" value="" />';
    html += '    <input type="hidden" name="order_product[' + product_row + '][tb009a]" value="" />';	
//	html += '    <td class="left"><input type="text"  tabIndex="20"  name="order_product[' + product_row + '][tb003]" value="0" size="6" /></td>';
	html += '    <td class="left"><select id="tb004" tabIndex="71" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb004]" ><option  value="1">1.銷貨</option><option value="2">2.銷退</option><option value="3">3.營業日報</option><option value="4">4.資產出售</option><option value="5">5.預收待底</option><option value="6">6.訂單</option><option value="7">7.其他</option></select></td>';
	html += '    <td class="left"><input type="text"  tabIndex="72" id="tb005'+ product_row+'"   name="order_product[' + product_row + '][tb005]" value="" size="12"  /></td>';	
	html += '    <td class="left"><input  tabIndex="73" onKeyPress="keyFunction()" type="text" id="tb006"   name="order_product[' + product_row + '][tb006]" value=""  size="12"  /></td>';
	html += '    <td class="left"><input tabIndex="74"  onKeyPress="keyFunction()"  type="text" id="tb007"   name="order_product[' + product_row + '][tb007]" value="" size="10" /></td>';
	html += '    <td class="left"><input tabIndex="75"  onKeyPress="keyFunction()" type="text"  id="tb003" name="order_product[' + product_row + '][tb003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text" id="tb008" tabIndex="76" onclick="scwShow(this,event);"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb008]" value="<?php echo date("Y/m/d"); ?>" size="10" style="background-color:#E7EFEF"/></td>';
	
	html += '    <td class="left"><input type="text"  tabIndex="77" id="tb013'+ product_row+'"   name="order_product[' + product_row + '][tb013]" value="" size="12"  style="background-color:#E7EFEF" /></td>';
	html += '    <td class="left"><input tabIndex="78"  onKeyPress="keyFunction()"  type="text" id="tb013disp"   name="order_product[' + product_row + '][tb013disp]" value="" size="12" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="79" id="tb021'+ product_row+'"   name="order_product[' + product_row + '][tb021]" value="" size="12" style="background-color:#E7EFEF" /></td>';
	html += '    <td class="left"><input tabIndex="80"  onKeyPress="keyFunction()"  type="text" id="tb021disp"   name="order_product[' + product_row + '][tb021disp]" value="" size="12" style="background-color:#EBEBE4" /></td>';
	
	html += '    <td class="center"><input type="text" tabIndex="81"  class="total_price" id="tb009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb009]" value="0" size="10" style="text-align:right;background-color:#EBEBE4"" /></td>';
	 html += '    <td class="right"><input readonly="value" tabIndex="82" type="text"  id="tb010" name="order_product[' + product_row + '][tb010]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	 html += '    <td class="right"><input readonly="value" tabIndex="83" type="text"  id="tb017" name="order_product[' + product_row + '][tb017]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="center"><input readonly="value" tabIndex="84" type="text"  id="tb018" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb018]" value="0" size="10" style="text-align:right;background-color:#EBEBE4"/></td>';	
    html += '    <td class="right"><input readonly="value"  tabIndex="85" type="text" class="total_price1"  name="order_product[' + product_row + '][tb019]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="center"><input type="text" tabIndex="86" readonly="value"   id="tb020" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb020]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text" id="tb011" tabIndex="87"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb011]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html);  
	 
	
	   	   //下拉視窗 網頁不更新  mb001 tb005 憑證單別輸入
	
    $('input[name=\'order_product[' + product_row + '][tb005]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
             
            vtj0= product_row - 1;
		    smb001= $('#tb005'+vtj0 ).val();			 
            var vmb001=document.getElementById('ta004').value;
			 			
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookup/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
								 
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb008]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb009]\']').val(ui.item.value5);
			     $('input[name=\'order_product[' + n + '][tb017]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][tb018]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][tb019]\']').val(ui.item.value9);
				 $('input[name=\'order_product[' + n + '][tb020]\']').val(ui.item.value10);
				// $('input[name=\'order_product[' + n + '][tb021]\']').val(ui.item.value9);
				// $('input[name=\'order_product[' + n + '][tb011disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });   
		
	    //下拉視窗 網頁不更新  tb013 科目代號輸入
	
    $('input[name=\'order_product[' + product_row + '][tb013]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			   
			 smb001= $('#tb013'+vtj0 ).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookupa/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb013]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb013disp]\']').val(ui.item.value2);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
		
		 //下拉視窗 網頁不更新  tb021 部門代號輸入
	
    $('input[name=\'order_product[' + product_row + '][tb021]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			   
			 smb001= $('#tb021'+vtj0 ).val();
			
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acr/acri02/lookupb/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,  
                success:      
                   function(data){  
                      if(data.response =="true"){
						   add(data.message);	  
                        }
                        							
                    }, 
                      				
                 });  
              },  
            select:   
               function(event, ui) { 
			     var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
                 $('input[name=\'order_product[' + n + '][tb021]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb021disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        }); 
	
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tb009]\'],input[name=\'order_product[' + product_row + '][tb017]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//    var n = vproduct_row;
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		
		var get_total=input_1*1;  
		$('input[name=\'order_product[' + n + '][tb017]\']').val(get_total); 
     
	    var taxp=0;amt1=0;
	    var taxp=$('input[name=\'ta040\']').val();  //稅率
		var amt1=$('input[name=\'order_product[' + n + '][tb009]\']').val();
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][tb018]\']').val(taxamt1);
		$('input[name=\'order_product[' + n + '][tb017]\']').val(amt1);
		
	//	totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2);
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product[' + product_row + '][tb009]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][tb017]\']').val(input_1); 
	});
	
	 //原幣稅額  
	$('input[name=\'order_product[' + product_row + '][tb018]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    var taxp=0;amt1=0;
	    var taxp=$('input[name=\'ta040\']').val();  //稅率
		var amt1=$('input[name=\'order_product[' + n + '][tb017]\']').val();
		var taxamt1=Math.round(amt1*taxp);
		$('input[name=\'order_product[' + n + '][tb018]\']').val(taxamt1);
		$('input[name=\'order_product[' + n + '][tb017]\']').val(amt1);
	    if ($('select[name=\'ta012\']').val()=='1') {$('input[name=\'order_product[' + n + '][tb017]\']').val()=Math.round(amt1-taxamt1);}
		
	});
	//本幣貨幣, 稅額  
	$('input[name=\'order_product[' + product_row + '][tb019]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	    var rate=0;amt1=0;
	    var taxp=$('input[name=\'ta040\']').val();  //稅率
	    var rate=$('input[name=\'ta010\']').val();  //匯率
		var amt1=$('input[name=\'order_product[' + n + '][tb017]\']').val();
		var rateamt1=Math.round(amt1*rate);     //本幣金額
		$('input[name=\'order_product[' + n + '][tb019]\']').val(rateamt1);
		var taxamt1=Math.round(rateamt1*taxp);  //本幣稅額
		$('input[name=\'order_product[' + n + '][tb020]\']').val(taxamt1);
		
	    if ($('select[name=\'ta012\']').val()=='1') {$('input[name=\'order_product[' + n + '][tb019]\']').val()=Math.round(rateamt1-taxamt1);}
		totalSum1();
	});
    //備註  
	$('input[name=\'order_product[' + product_row + '][tb011]\']').focus(function(){
		$('input[name=\'order_product[' + product_row + '][tb005]\']').focus();
		totalSum1();
     });
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
     $('select[name=\'order_product[' + product_row + '][tb004]\']').focus();   //新增一筆
	product_row++;
}
//-->
</script>

<script type="text/javascript"><!--  //合計金額

function totalSum1() {

    var sumTotal = 0;
	var sumTotal1 = 0;
	var sumQty = 0;
	var product_row = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
    $(".total_price").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal += parseFloat(this.value);			
		}
    });
	 $(".total_price1").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal1 += parseFloat(this.value);			
		}
    });
    
    $("#sum_total").html(sumTotal.toFixed(1));
   
  //  form.ta029.value=Math.round(sumTotal);	  //應收金額
  	form.ta029.value=Math.round(sumTotal);	  //原幣貨款
	 var tax=$('input[name=\'ta040\']').val();  //稅率
	 var rate=$('input[name=\'ta010\']').val();  //匯率
	form.ta030.value=Math.round(sumTotal*tax);  //原幣稅額
	form.ta041.value=Math.round(sumTotal1*rate);	  //本幣貨款
	form.ta042.value=Math.round(sumTotal1*rate*tax);  //本幣稅額
	var sumTax =Math.round(sumTotal*tax);
	var sumTax1 =Math.round(sumTotal1*rate*tax);
	//課稅別
	//if ($('select[name=\'ta012\']').val()=='1') {form.ta030.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}
	if ($('select[name=\'ta012\']').val()=='1') {form.ta029.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}
	if ($('select[name=\'ta012\']').val()=='1') {form.ta041.value=Math.round(sumTotal1-sumTax1);sumTotal1=Math.round(sumTotal1-sumTax1);}
	
	var sumTot =Math.round(sumTotal+sumTax);
  //  $("#sum_tax").html(sumTax.toFixed(1));	
	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal1+sumTax1);
  //  $("#sum_tax1").html(sumTax1.toFixed(1));	
	$("#sum_tot1").html(sumTot1.toFixed(1));	
		
}
//--></script>
 <!-- 明細 品號開視窗   -->  