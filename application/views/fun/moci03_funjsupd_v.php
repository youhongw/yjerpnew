<!-- 開視窗 purq04a33 採購單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showpurq04a33").click(function() { 	   
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
	message: $('#divFpurq04a33'),
	});
		   
	$('.close').click($.unblockUI);
	});
	});
	</script> 	  
	<div id="divFpurq04a33" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq04a/display33" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addpurq04a33(sta001,sta002) {	
	form.purq04a33.value=sta001;
	var oSpan = document.getElementById("purq04a33disp");
		oSpan.innerHTML = sta002;
	document.form.purq04a33.focus();    
	return purq04a33;	
}
//--></script>
<!-- 開視窗 invq81a 單位 -->	
<script type="text/javascript"> 	   
	function startinvq81a() {
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
	message: $('#divFinvq81a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}; 	   
	   
	</script> 	    	
		   
	<div id="divFinvq81a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq81a/display"   allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addinvq81a(stc001,stc002,stc003) {
		 //   alert(stc002);
	     var product_row1 = 15; 
	$(".total_dc").each(function() {		
		product_row1++;
    });
	   product_row1=product_row1-1;
	 $('input[name=\'order_product[' + product_row1  + '][td009]\']').val(stc002);
	return $("#td009").html(stc002);
	
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
<!-- 開視窗廠商代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址-->
<script type="text/javascript"><!--
  function addpurq01a(sma001,sma002,sma005,sma006,sma007,sma008) {
	form.purq01a.value=sma001;
	form.cmsq06a.value=sma005;
	form.cmsq21a1.value=sma006;
	form.tc018.value=sma007;
	form.tc021.value=sma008;
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
  function addcmsq02a(sta001,sta002) {
	  	  form.cmsq02a.value=sta001;
	var oSpan = document.getElementById("cmsq02adisp");
		oSpan.innerHTML = sta002;
	document.form.cmsq02a.focus();    
	return cmsq02a;
	
}
//--></script>

<!-- 開視窗 cmsq09a4 採購人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a4").click(function() { 	   
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
	message: $('#divFormcmsq09a4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display4" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a4(sma001,sma002) {
	form.cmsq09a4.value=sma001;	
	var oSpan = document.getElementById("cmsq09a4disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a4.focus();    
	return cmsq09a4;
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


function showpurq04a33(sText){                 //不更新網頁 31  請購單別 ta001
	var oSpan = document.getElementById("purq04a33disp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 purq04a33 採購單別 -->        
function startpurq04a33(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
   
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/purq04a/datapurq04a33/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq04a33(xmlHttp.responseText);	//顯示服務器結果		
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
    
       if  (!sText) { sText=$('input[name=\'tc024\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  // alert(zno1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("tc002").value=zno3;
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

<!-- 不更新網頁 計算單號 請購單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'purq04a33\']').val();
	 var zstr=$('input[name=\'tc024\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
    //  alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pur/puri07/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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
function showymd1(oInput,n){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert(oInput.value);		
		 var nn=n-1;
	     var   sText=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
	       $('input[name=\'order_product[' + nn + '][td012]\']').val(sText);   
}
//--></script>

<!-- 不更新網頁 檢查欄位空白 -->	
<script type="text/javascript"><!--       
 function checkspace(oInput){         //不更新網頁 2 請購單號
  
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
	  var selval = document.getElementById('tc014').selectedIndex;
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

<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.tc024.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'tc024\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 8 ) { 
		    document.form.tc024.focus(); return tc024;}	
}

//--></script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1 a
		setTimeout(function() {
			$('input[name="tc010"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2 b
		setTimeout(function() {
			$('#tc021').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3
		setTimeout(function() {
			$('#mv032').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '72')){  //tab5 h
		setTimeout(function() {
			$('#mv048').focus();
		}, 100);	
	}
	//跳明細 alt+y
	if(event.altKey && (keycode == '89')){  //tab6 y
		setTimeout(function() {
			$('input[name=\'order_product[0][td004]\']').focus();
		}, 100);	
	}
	//新增一筆明細 alt+w
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
});
</script> 
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
	
//	html += '    <td class="left"><input type="text"  tabIndex="13"  name="order_product[' + product_row + '][td003]" value="0" size="6" /></td>';
	html += '    <td class="left"><input type="text"   class="total_dc" tabIndex="21" id="td004'+ product_row+'"   name="order_product[' + product_row + '][td004]" value="" size="20" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()" type="text" id="td005"  name="order_product[' + product_row + '][td005]" value=""  /></td>';
	html += '    <td class="left"><input readonly="value"  onKeyPress="keyFunction()" type="text" id="td006"   name="order_product[' + product_row + '][td006]" value=""  size="30" /></td>';
	html += '    <td class="left"><input   ondblclick="startinvq81a();"  onKeyPress="keyFunction()"   type="text" id="td009"   name="order_product[' + product_row + '][td009]" value="" size="6" /></td>';
	html += '    <td class="left"><input type="text"   readonly="value" tabIndex="22"  name="order_product[' + product_row + '][td003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="23" id="td007'+ product_row+'"   name="order_product[' + product_row + '][td007]" value="" size="10" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input type="text"  tabIndex="24" id="td007disp'+ product_row+'"   name="order_product[' + product_row + '][td007disp]" value="" size="10" style="background-color:#EBEBE4"   /></td>';	
	html += '    <td class="left"><input type="text" onchange="showymd1(this,product_row)" ondblclick="scwShow(this,event);"  tabIndex="25" id="td012['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td012]" value="<?php echo date("Y/m/d"); ?>" size="10"  style="background-color:#E7EFEF"/></td>';
	html += '    <td class="center"><input type="text" tabIndex="26" class="total_qty" id="td008" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td008]" value="0" size="10" style="text-align:right" /></td>';
    html += '    <td class="center"><input type="text" tabIndex="27" id="td010" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td010]" value="0" size="10" style="text-align:right" /></td>';	
    html += '    <td class="right"><input readonly="value" type="text" class="total_price" tabIndex="28" name="order_product[' + product_row + '][td011]" value="0" size="10" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text" id="td014" tabIndex="29"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][td014]" value="" size="20" /></td>';
	html += '    <td class="left"><select id="td016" tabIndex="30" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td016]" ><option  value="N">N.未結案</option><option value="y">y.指定結案</option><option value="Y">Y.自動結案</option></select></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 	$('#row_count').val(parseInt(product_row)+1);
	 $('#order_product tfoot').before(html);  
	 
	
	   //下拉視窗 網頁不更新  mb001 td004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			    vtj0= product_row - 1;
		       smb001= $('#td004'+vtj0 ).val();
					 
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri07/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][td006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][td009]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value5);
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value6);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });
	  
	//下拉視窗 網頁不更新  td007  交貨庫別輸入
	
    $('input[name=\'order_product[' + product_row + '][td007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			    smb001= $('#td007'+vtj0 ).val();
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri07/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][td007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][td007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	   
	
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][td008]\'],input[name=\'order_product[' + product_row + '][td010]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td010]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td011]\']').val(get_total); 
       	
		totalSum1();
		
		//流水號
		var num_1 = 1000;
	 //	if ($('input[name=\'order_product[' + n + '][td003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][td003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
  //數量
	$('input[name=\'order_product[' + product_row + '][td008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		    if ($(this).val()=='0')
			$(this).val('');
	});
        
	$('input[name=\'order_product[' + product_row + '][td008]\']').focusout(function(){
	var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
		    if ($(this).val()=='')
			$(this).val('0');
			
			
	});
	   //單價  
	$('input[name=\'order_product[' + product_row + '][td010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});
	     
	$('input[name=\'order_product[' + product_row + '][td010]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='')
			$(this).val('0');
			
			
	});
	
	//備註,品號
	$('input[name=\'order_product[' + product_row + '][td014]\']').blur(function(){
		var product_row = product_row + 1;
		$('input[name=\'order_product[' + product_row + '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;
}
//-->
</script>

<script type="text/javascript"><!--  //合計金額

function totalSum1() {

    var sumTotal =0;
	var sumQty = 0;
	var product_row = 0; 
	var sumTax =0; 
	var tax =0;
    $(".total_price").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal += parseFloat(this.value);			
		}
    });
	
	$(".total_qty").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumQty += parseFloat(this.value);			
		}
    });
    
    $("#sum_total").html(sumTotal.toFixed(1));
  	form.tc019.value=Math.round(sumTotal);	
	  tax=$('input[name=\'tc026\']').val();
	form.tc020.value=Math.round(sumTotal*tax);
	var sumTax =Math.round(sumTotal*tax);
	
	var vtax=1+parseFloat(tax);
	if ($('select[name=\'tc018\']').val()=='1') {form.tc019.value=Math.round(sumTotal/parseFloat(vtax));form.tc020.value=Math.round(sumTotal-form.tc019.value);}
	
	var sumTot =Math.round(sumTotal+sumTax);
    $("#sum_tax").html(sumTax.toFixed(1));	
	//$("#sum_tot").html(sumTot.toFixed(1));	
	 $("#sum_tot").html(parseFloat(form.tc019.value)+parseFloat(form.tc020.value));	
	form.tc023.value=Math.round(sumQty);	
}
//--></script>

 <!-- 明細 品號開視窗   -->  