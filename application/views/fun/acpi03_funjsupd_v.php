<!-- 開視窗 purq04a34 付款單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showacpq01a73").click(function() { 	   
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
	message: $('#divFacpq01a73'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  
	<div id="divFacpq01a73" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/acpq01a/display73" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addacpq01a73(sma001,sma002) {	
	form.acpq01a73.value=sma001;
	var oSpan = document.getElementById("acpq01a73disp");
		oSpan.innerHTML = sma002;
	document.form.acpq01a73.focus();    
	return acpq01a73;	
}
//--></script>

<script type="text/javascript"> 	   //開視窗  主供應商 invi02
	$(document).ready(function(){ 	   
	$("#Showpurq01a").click(function() { 	   
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
	message: $('#divFpurq01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a(sma001,sma002) {
   
	form.purq01a.value=sma001;
	var oSpan = document.getElementById("purq01adisp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a.focus();    	
	return purq01a;
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
  function addcmsq02a(stc001,stc002) {
	  	  form.cmsq02a.value=stc001;
	var oSpan = document.getElementById("cmsq02adisp");
		oSpan.innerHTML = stc002;
	document.form.cmsq02a.focus();    
	return cmsq02a;
	
}
//--></script>

<!-- 開視窗 purc09a 前置單據 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpurc09a").click(function() { 	   
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
	message: $('#divFormpurc09a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormpurc09a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purc09a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addpurc09a(sma001,sma002) {
    var oSpan = document.getElementById("cmsq06adisp");
		oSpan.innerHTML = 'testtesttest';  
       form.tc016.value=sma001;		
	url = '<?=base_url() ?>index.php/acp/acpi03/copybefore/'+encodeURIComponent(sma001)+'/'+encodeURIComponent(sma002); 
	location = url;
	return true;
}
//--></script>
<!-- 開視窗 cmsq21a1 25 付款條件 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq21a1").click(function() { 	   
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
	message: $('#divFcmsq21a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq21a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq21a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq21a1(sma001,sma002) {
	form.cmsq21a1.value=sma001;
	var oSpan = document.getElementById("cmsq21a1disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq21a1.focus();    
	return cmsq21a1;
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


function showacpq01a73(sText){                 //不更新網頁 31  請購單別 tc001
	var oSpan = document.getElementById("acpq01a73disp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 purq04a33 採購單別 -->        
function startacpq01a73(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#tc001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
   
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/acpq01a/dataacpq01a73/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showacpq01a73(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq02a(sText){   //不更新網頁 tc010 廠別
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
	//	$("#tc010disp").html("不可空白.");	
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


function showcmsq09a4(sText){   //不更新網頁 67 採購人員 
	var oSpan = document.getElementById("cmsq09a4disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startcmsq09a4(oInput){         //不更新網頁 67  採購人員
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/checkcmsq09a4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁帶出資料  請購單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'tc016\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	//   alert(zno1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("tc002").value=zno3;
	 //  alert(zno3);
//	   var oSpan = document.getElementById("purq04a31disp");
//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
//	 if (!sText) { 
//	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
//	 }	
	   
	//	alert(zno3);
	//var oSpan = document.getElementById("tc002");	 
	// oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	 //   oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	

<!-- 不更新網頁 計算單號 請購單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#tc006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'acpq01a73\']').val();
	 var zstr=$('input[name=\'tc016\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
   //   alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/acp/acpi03/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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


function showpurq01a(sText){   //不更新網頁 32 主供應商 
	var oSpan = document.getElementById("purq01adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startpurq01a(oInput){         //不更新網頁 32 主供應商
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/purq01a/checkpurq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq01a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


function showcmsq02a(sText){   //不更新網頁 tc010 廠別
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
	//	$("#tc010disp").html("不可空白.");	
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

function showcmsq09a4(sText){   //不更新網頁 4  採購人員
	var oSpan = document.getElementById("cmsq09a4disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,採購人員 -->
function startcmsq09a4(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁,付款條件 -->
function showcmsq21a1(sText){   
	var oSpan = document.getElementById("cmsq21a1disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,付款條件 -->
function startcmsq21a1(oInput){         
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq21a/datacmsq21a1/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq21a1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

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
	  var selval = document.getElementById('tc008').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	    if (selval==0) {
	     oSpan.innerHTML = "<span style='color:black'> 核准</span>";}
        else
		{ oSpan.innerHTML = "<span style='color:black'> 未核</span>";}
}

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
var product_row = 250; 
var vtj0= 249;

function addItem() {
	       product_row = $('#row_count').val();
		html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][td001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][td002]" value="" />';
    html += '    <input type="hidden" name="order_product[' + product_row + '][td013a]" value="" />';
//	html += '    <td class="left"><input type="text"  tabIndex="20"  name="order_product[' + product_row + '][td003]" value="0" size="6" /></td>';
	html += '    <td class="left"><select id="td004"  class="total_dc" tabIndex="51" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td004]" ><option  value="1">借</option><option value="-1">貸</option></select></td>'; 
	html += '    <td class="left"><select id="td005" tabIndex="52" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td005]" ><option  value=""></option><option  value="1">1.一般</option><option value="2">2.票據</option><option value="3">3.待抵</option><option value="4">4.沖帳</option><option value="5">5.溢付</option><option value="6">6.差額</option><option value="7">7.拆讓</option><option value="8">8.應收票據轉付</option></select></td>';

	html += '    <td class="left"><input type="text"  tabIndex="53" id="td006'+ product_row+'"   name="order_product[' + product_row + '][td006]" value="" size="12" style="background-color:#E7EFEF" /></td>';
	html += '    <td class="left"><input tabIndex="54"  onKeyPress="keyFunction()"  type="text" id="td007"   name="order_product[' + product_row + '][td007]" value="" size="12" /></td>';
	html += '    <td class="left"><input tabIndex="55"  onKeyPress="keyFunction()" type="text"  id="td003" name="order_product[' + product_row + '][td003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="56" id="td008'+ product_row+'"   name="order_product[' + product_row + '][td008]" value="" size="12" style="background-color:#E7EFEF"  /></td>';
	html += '    <td class="left"><input tabIndex="57"  onKeyPress="keyFunction()"  type="text" id="td008disp"   name="order_product[' + product_row + '][td008disp]" value="" size="12" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="center"><input type="text" tabIndex="58"   id="td010" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td010]" value="" size="5" style="text-align:right;background-color:#EBEBE4" /></td>';
	 html += '    <td class="right"><input  type="text" tabIndex="59"  id="td011" name="order_product[' + product_row + '][td011]" value="1" size="6" /></td>';

    html += '    <td class="right"><input  type="text" tabIndex="60" readonly="value"  name="order_product[' + product_row + '][td012]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="center"><input type="text"   tabIndex="61" readonly="value" id="td013" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td013]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="right"><input   type="text" tabIndex="62" class="total_price"  name="order_product[' + product_row + '][td014]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text"  tabIndex="63" class="total_price1"  id="td015" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td015]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" id="td009" tabIndex="64" onclick="scwShow(this,event);"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][td009]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" id="td016" tabIndex="65"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][td016]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" id="td017" tabIndex="66"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][td017]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	  $('#row_count').val(parseInt(product_row)+1);
	 $('#order_product tfoot').before(html);  
	 
	
   	   //下拉視窗 網頁不更新  mb001 td004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][td006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
            var vmb001=document.getElementById('tc004').value;
			     vtj0= product_row - 1;
		       smb001= $('#td006'+vtj0 ).val();
		
			var utd005=$('select[name=\'order_product[' + vtj0 + '][td005]\']').val();
			 			
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/acp/acpi03/"+'lookup'+utd005+'/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(vmb001), 
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
                 $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td011]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td012]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][td013]\']').val(ui.item.value6);
				 $('input[name=\'order_product[' + n + '][td014]\']').val(ui.item.value7);
				 $('input[name=\'order_product[' + n + '][td015]\']').val(ui.item.value8);
				 $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value9);
				// $('input[name=\'order_product[' + n + '][td011disp]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });   
		
    //下拉視窗 網頁不更新  td008 科目代號輸入
	
    $('input[name=\'order_product[' + product_row + '][td008]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			    vtj0= product_row - 1;
		       smb001= $('#td008'+vtj0 ).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/acp/acpi03/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td008]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td008disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	    	
	
	
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][td007]\'],input[name=\'order_product[' + product_row + '][td015]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	//	totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	
	//金額copy 原幣金額
	$('input[name=\'order_product[' + product_row + '][td014]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1); 
	});
		

	//本幣貨幣  
	$('input[name=\'order_product[' + product_row + '][td015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  	var input_1=$('input[name=\'order_product[' + n + '][td011]\']').val()*1; 
		var input_2=$('input[name=\'order_product[' + n + '][td014]\']').val()*1; 
	     $('input[name=\'order_product[' + n + '][td015]\']').val(input_1*input_2); 
	 	totalSum1();
	});
	//參考單號
    $('input[name=\'order_product[' + product_row + '][td016]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;
}
//-->
</script>

<script type="text/javascript"><!--  //合計金額

function totalSum1() {

    var sumTotal = 0;
	var sumTotal1 = 0;
	var sumTotal2 = 0;
	var sumTotal3 = 0;
	var sumQty = 0;
	var product_row1 = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
	
	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value=='1') {	
             var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 	 
          //   alert(n);			 
			sumTotal += parseFloat($('input[name=\'order_product[' + n + '][td014]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!='1') {		    
		     var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
			sumTotal1 += parseFloat($('input[name=\'order_product[' + n + '][td014]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value=='1') {		
             var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
			sumTotal2 += parseFloat($('input[name=\'order_product[' + n + '][td015]\']').val());			
		}
		product_row1++;
    });
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!='1') {	
             var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 	    
			sumTotal3 += parseFloat($('input[name=\'order_product[' + n + '][td015]\']').val());			
		}
		product_row1++;
    });
   
    form.tc011.value=Math.round(sumTotal);	  //原幣借方金額
  	form.tc012.value=Math.round(sumTotal1);	  //本幣貸方金額
    form.tc013.value=Math.round(sumTotal2);	  //原幣借方金額
  	form.tc014.value=Math.round(sumTotal3);	  //本幣貸方金額
	var sumTot =Math.round(sumTotal-sumTotal1);
  	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal2-sumTotal3);
 	$("#sum_tot1").html(sumTot1.toFixed(1));	

		
}
//--></script>
 <!-- 明細 品號開視窗   -->  