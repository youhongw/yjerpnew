<!-- 開視窗 copq03a22 訂單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showcopq03a22").click(function() { 	   
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
	message: $('#divFcopq03a22'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFcopq03a22" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq03a/display2" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcopq03a22(sta001,sta002) {	
	form.copq03a22.value=sta001;
	var oSpan = document.getElementById("copq03a22disp");
		oSpan.innerHTML = sta002;
	document.form.copq03a22.focus();    
	return copq03a22;	
}
//--></script>
<!-- 開視窗 invq81a 單位 -->	
<script type="text/javascript"> 	   
	function startinvq81a() {	
	// var n = this.name.replace(/order_product\[(\d+)].*/, '$1');    
	// var ifm = document.getElementById('ifm');
	 //    ifm.innerHTML = $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);	
  
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
	     var product_row1 = 0; 
	$(".total_dc").each(function() {		
		product_row1++;
    });
	   product_row1=product_row1-1;
	 $('input[name=\'order_product[' + product_row1  + '][td010]\']').val(stc002);
	return $("#td010").html(stc002);
	
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

	<!-- 開視窗客戶代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址b 帳單地址-->
<script type="text/javascript"><!--
   function addcopq01a(sma001,sma002,sma005,sma006,sma007,sma008,sma009,sma00a,sma00b) {
   
	form.copq01a.value=sma001;
//	form.ta006.value=sma002;
 	form.cmsq06a.value=sma005;
	form.cmsq21a2.value=sma006;
	form.tc016.value=sma007;
	form.tc010.value=sma008;
	form.tc011.value=sma00b;
	var oSpan = document.getElementById("copq01adisp");
		oSpan.innerHTML = sma002;	
	document.form.copq01a.focus();    	
	return copq01a;
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


function showcopq03a22(sText){                 //不更新網頁 32  訂單單別 cop/copi0501
	var oSpan = document.getElementById("copq03a22disp");
      //   chkno1();
     
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 copq03a21 訂單單別 -->        
function startcopq03a22(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#cop/copi0501disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
     
	createXMLHttpRequest();
     
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq03a/datacopq03a22/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq03a22(xmlHttp.responseText);	//顯示服務器結果
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

<!-- 不更新網頁帶出資料  訂單單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'tc039\']').val();   
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

<!-- 不更新網頁 計算單號 訂單單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'copq03a22\']').val();
	 var zstr=$('input[name=\'tc039\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
    //  alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi06/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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
	//var oSpan = document.getElementById("td007disp0");
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
	 $('input[name=\'order_product[' + nn + '][td011]\']').val(sText)};
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
	  var td004=$('input[name=\'order_product[' + nn + '][td004]\']').val();  //品號
      var td010=$('input[name=\'order_product[' + nn + '][td010]\']').val();  //單位
	//  alert(tc004+td004+td010);
	//建立非同步請求
   // var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq02a/checkcopq02a/" + encodeURIComponent(tc004)+ "/" + encodeURIComponent(td004)+ "/"+ encodeURIComponent(td010)+ "/"+ new Date().getTime();   
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
	//var oSpan = document.getElementById("td007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	 var nn=n-1;
	 var num = sText.length;
	 var sysma200=$('input[name=\'sysma200\']').val();
	 
	 if (num>sysma200){
          $('input[name=\'order_product[' + nn + '][td007disp]\']').val(sText); }  
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
	//var oSpan = document.getElementById("td007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	// alert(n);
	 var nn=n-1;	
	  var num = sText.length;
	 var str=(sText.split(";",3));
	  var sysma201=$('input[name=\'sysma201\']').val();
	// alert(str[1]);
	 if (num>sysma201){
     $('input[name=\'order_product[' + nn + '][td005]\']').val(str[0]);  
     $('input[name=\'order_product[' + nn + '][td006]\']').val(str[1]);
	 $('input[name=\'order_product[' + nn + '][td010]\']').val(str[2]);}
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
	  var selval = document.getElementById('tc027').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	  if (selval==0) {
	     oSpan.innerHTML = "<span style='color:blank'> 核准</span>";}
        else
		{ oSpan.innerHTML = "<span style='color:blank'> 未核</span>";}
	 if (selval==2) {
	     oSpan.innerHTML = "<span style='color:blank'> 作廢</span>";}
}

//--></script>
<!-- 不更新網頁 檢查 select 欄位 課稅  營業稅率-->	
<script type="text/javascript"><!--       
 function seltax(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('tc016').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("tc041");
	  if (selval==0) {form.tc041.value=0.05;}	    
      else if (selval==1){  form.tc041.value=0.05;}
	  else {  form.tc041.value=0;}
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
var product_row = 0; 

function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][td001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][td002]" value="" />';	
//	html += '    <td class="left"><input type="text"  tabIndex="20"  name="order_product[' + product_row + '][td003]" value="0" size="6" /></td>';
	html += '    <td class="left"><input type="text"  class="total_dc" tabIndex="51" onchange="startinvq02a(this,product_row)" id="td004'+ product_row+'" ondblclick="copi02a(this,'+ product_row +');"  name="order_product[' + product_row + '][td004]" value="" size="20" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()" type="text" id="td005"  name="order_product[' + product_row + '][td005]" value=""  style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input readonly="value"  onKeyPress="keyFunction()" type="text" id="td006"   name="order_product[' + product_row + '][td006]" value=""  size="30" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input readonly="value" ondblclick="startinvq81a();"  onKeyPress="keyFunction()"   type="text" id="td010"   name="order_product[' + product_row + '][td010]" value="" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"   readonly="value" tabIndex="22"  name="order_product[' + product_row + '][td003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="52" onchange="startcmsq03a(this,product_row)" id="td007'+ product_row+'"   name="order_product[' + product_row + '][td007]" value="" size="10" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input type="text" readonly="value" tabIndex="53" id="td007disp'+ product_row+'"   name="order_product[' + product_row + '][td007disp]" value="" size="10" style="background-color:#EBEBE4"  /></td>';	
	html += '    <td class="left"><input type="text"  onclick="scwShow(this,event);"  tabIndex="54" id="td013['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td013]" value="<?php echo date("Y/m/d"); ?>" size="10" class="date" style="background-color:#E7EFEF"/></td>';
	html += '    <td class="center"><input type="text" tabIndex="55" onchange="startcopq02a(this,product_row)"  class="total_qty" onfocus="startcopq02a(this,product_row)" id="td008" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td008]" value="1" size="8" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text" tabIndex="56" id="td011" ondblclick="copq06a(this,'+ product_row +');" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td011]" value="0" size="8" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text" readonly="value" tabIndex="57" class="total_price" id="td012" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td012]" value="0" size="8" style="text-align:right;background-color:#EBEBE4" /></td>';
	html += '    <td class="center"><input type="text" readonly="value" tabIndex="58" class="total_qty" id="td009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td009]" value="0" size="8" style="text-align:right" /></td>';
    html += '    <td class="center"><input type="text" tabIndex="59" class="total_qty1" id="td030" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td030]" value="0" size="8" style="text-align:right" /></td>';	
    html += '    <td class="right"><input type="text" class="total_qty2" tabIndex="60" name="order_product[' + product_row + '][td031]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" id="td014" tabIndex="61"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][td014]" value="" size="20" /></td>';
	html += '    <td class="left"><input type="text" id="td020" tabIndex="62"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][td020]" value="" size="20" /></td>';
	html += '    <td class="left"><select id="td016" tabIndex="52" onKeyPress="keyFunction()" name="order_product[' + product_row + '][td016]" ><option  value="N">N.未結案</option><option value="y">y.指定結案</option><option value="Y">Y.自動結案</option></select></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html);  
	 
	
	   	   //下拉視窗 網頁不更新  mb001 td004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][td004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('td004').value;
			   
			 if (product_row == 1 ) { smb001= $('#td0040').val(); }
			 if (product_row == 2 ) { smb001= $('#td0041').val(); }
			 if (product_row == 3 ) { smb001= $('#td0042').val(); }
		     if (product_row == 4 ) { smb001= $('#td0043').val(); }
			 if (product_row == 5 ) { smb001= $('#td0044').val(); }
			 if (product_row == 6 ) { smb001= $('#td0045').val(); }
			 if (product_row == 7 ) { smb001= $('#td0046').val(); }
		     if (product_row == 8 ) { smb001= $('#td0047').val(); }
			 if (product_row == 9 ) { smb001= $('#td0048').val(); }
			 if (product_row == 10 ) { smb001= $('#td0049').val(); }	
			 if (product_row == 11 ) { smb001= $('#td00410').val(); }
			 if (product_row == 12 ) { smb001= $('#td00411').val(); }
			 if (product_row == 13 ) { smb001= $('#td00412').val(); }
		     if (product_row == 14 ) { smb001= $('#td00413').val(); }
			 if (product_row == 15 ) { smb001= $('#td00414').val(); }
			 if (product_row == 16 ) { smb001= $('#td00415').val(); }
			 if (product_row == 17 ) { smb001= $('#td00416').val(); }
		     if (product_row == 18 ) { smb001= $('#td00417').val(); }
			 if (product_row == 19 ) { smb001= $('#td00418').val(); }
			 if (product_row == 20 ) { smb001= $('#td00419').val(); }	
             if (product_row == 21 ) { smb001= $('#td00420').val(); }
			 if (product_row == 22 ) { smb001= $('#td00421').val(); }
			 if (product_row == 23 ) { smb001= $('#td00422').val(); }
		     if (product_row == 24 ) { smb001= $('#td00423').val(); }
			 if (product_row == 25 ) { smb001= $('#td00424').val(); }
			 if (product_row == 26 ) { smb001= $('#td00425').val(); }
			 if (product_row == 27 ) { smb001= $('#td00426').val(); }
		     if (product_row == 28 ) { smb001= $('#td00427').val(); }
			 if (product_row == 29 ) { smb001= $('#td00428').val(); }
			 if (product_row == 30 ) { smb001= $('#td00429').val(); }	
			  if (product_row == 31 ) { smb001= $('#td00430').val(); }
			 if (product_row == 32 ) { smb001= $('#td00431').val(); }
			 if (product_row == 33 ) { smb001= $('#td00432').val(); }
		     if (product_row == 34 ) { smb001= $('#td00433').val(); }
			 if (product_row == 35 ) { smb001= $('#td00434').val(); }
			 if (product_row == 36 ) { smb001= $('#td00435').val(); }
			 if (product_row == 37 ) { smb001= $('#td00436').val(); }
		     if (product_row == 38 ) { smb001= $('#td00437').val(); }
			 if (product_row == 39 ) { smb001= $('#td00438').val(); }
			 if (product_row == 40 ) { smb001= $('#td00439').val(); }
              if (product_row == 41 ) { smb001= $('#td00440').val(); }
			 if (product_row == 42 ) { smb001= $('#td00441').val(); }
			 if (product_row == 43 ) { smb001= $('#td00442').val(); }
		     if (product_row == 44 ) { smb001= $('#td00443').val(); }
			 if (product_row == 45 ) { smb001= $('#td00444').val(); }
			 if (product_row == 46 ) { smb001= $('#td00445').val(); }
			 if (product_row == 47 ) { smb001= $('#td00446').val(); }
		     if (product_row == 48 ) { smb001= $('#td00447').val(); }
			 if (product_row == 49 ) { smb001= $('#td00448').val(); }
			 if (product_row == 50 ) { smb001= $('#td00449').val(); }		
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookup/'+encodeURIComponent(smb001), 
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
			     $('input[name=\'order_product[' + n + '][td010]\']').val(ui.item.value4);
			
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
			   
			  if (product_row == 1 ) { smb001= $('#td0070').val(); }
			 if (product_row == 2 ) { smb001= $('#td0071').val(); }
			 if (product_row == 3 ) { smb001= $('#td0072').val(); }
		     if (product_row == 4 ) { smb001= $('#td0073').val(); }
			 if (product_row == 5 ) { smb001= $('#td0074').val(); }
			 if (product_row == 6 ) { smb001= $('#td0075').val(); }
			 if (product_row == 7 ) { smb001= $('#td0076').val(); }
		     if (product_row == 8 ) { smb001= $('#td0077').val(); }
			 if (product_row == 9 ) { smb001= $('#td0078').val(); }
			 if (product_row == 10 ) { smb001= $('#td0079').val(); }	
			 if (product_row == 11 ) { smb001= $('#td00710').val(); }
			 if (product_row == 12 ) { smb001= $('#td00711').val(); }
			 if (product_row == 13 ) { smb001= $('#td00712').val(); }
		     if (product_row == 14 ) { smb001= $('#td00713').val(); }
			 if (product_row == 15 ) { smb001= $('#td00714').val(); }
			 if (product_row == 16 ) { smb001= $('#td00715').val(); }
			 if (product_row == 17 ) { smb001= $('#td00716').val(); }
		     if (product_row == 18 ) { smb001= $('#td00717').val(); }
			 if (product_row == 19 ) { smb001= $('#td00718').val(); }
			 if (product_row == 20 ) { smb001= $('#td00719').val(); }	
             if (product_row == 21 ) { smb001= $('#td00720').val(); }
			 if (product_row == 22 ) { smb001= $('#td00721').val(); }
			 if (product_row == 23 ) { smb001= $('#td00722').val(); }
		     if (product_row == 24 ) { smb001= $('#td00723').val(); }
			 if (product_row == 25 ) { smb001= $('#td00724').val(); }
			 if (product_row == 26 ) { smb001= $('#td00725').val(); }
			 if (product_row == 27 ) { smb001= $('#td00726').val(); }
		     if (product_row == 28 ) { smb001= $('#td00727').val(); }
			 if (product_row == 29 ) { smb001= $('#td00728').val(); }
			 if (product_row == 30 ) { smb001= $('#td00729').val(); }	
		 	 if (product_row == 31 ) { smb001= $('#td00730').val(); }
			 if (product_row == 32 ) { smb001= $('#td00731').val(); }
			 if (product_row == 33 ) { smb001= $('#td00732').val(); }
		     if (product_row == 34 ) { smb001= $('#td00733').val(); }
			 if (product_row == 35 ) { smb001= $('#td00734').val(); }
			 if (product_row == 36 ) { smb001= $('#td00735').val(); }
			 if (product_row == 37 ) { smb001= $('#td00736').val(); }
		     if (product_row == 38 ) { smb001= $('#td00737').val(); }
			 if (product_row == 39 ) { smb001= $('#td00738').val(); }
			 if (product_row == 40 ) { smb001= $('#td00739').val(); }
              if (product_row == 41 ) { smb001= $('#td00740').val(); }
			 if (product_row == 42 ) { smb001= $('#td00741').val(); }
			 if (product_row == 43 ) { smb001= $('#td00742').val(); }
		     if (product_row == 44 ) { smb001= $('#td00743').val(); }
			 if (product_row == 45 ) { smb001= $('#td00744').val(); }
			 if (product_row == 46 ) { smb001= $('#td00745').val(); }
			 if (product_row == 47 ) { smb001= $('#td00746').val(); }
		     if (product_row == 48 ) { smb001= $('#td00747').val(); }
			 if (product_row == 49 ) { smb001= $('#td00748').val(); }
			 if (product_row == 50 ) { smb001= $('#td00749').val(); }		
			//   smb001=$("#td004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi06/lookupa/'+encodeURIComponent(smb001), 
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
	$('input[name=\'order_product[' + product_row + '][td008]\'],input[name=\'order_product[' + product_row + '][td011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][td008]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][td011]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][td012]\']').val(get_total); 		
		totalSum();
		
		//流水號
		var num_1 = 1000;
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][td003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][td003]\']').val(num_2); 
		
	});
	   //毛重
	$('input[name=\'order_product[' + product_row + '][td030]\']').blur(function(){
		totalSum();
	});
       //材積 
	$('input[name=\'order_product[' + product_row + '][td031]\']').blur(function(){
		totalSum();
	});
	
	//備註,品號
	$('input[name=\'order_product[' + product_row + '][td020]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][td004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	Enterkey();
	product_row++;
}
//-->
</script>

<script type="text/javascript"><!--  //合計金額

function totalSum() {

    var sumTotal = 0;
	var sumQty = 0;
	var sumQty1 = 0;
	var sumQty2 = 0;
	var product_row = 0; 
	var sumTax =0; 
	var tax =0.00;
	var vtax=0.00;
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
    $(".total_qty1").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumQty1 += parseFloat(this.value);			
		}
    });
	$(".total_qty2").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumQty2 += parseFloat(this.value);			
		}
    });
	
    $("#sum_total").html(sumTotal.toFixed(1));

  	form.tc029.value=Math.round(sumTotal);	
	  tax=$('input[name=\'tc041\']').val();
	form.tc030.value=Math.round(sumTotal*tax);
	var sumTax =Math.round(sumTotal*tax);	
                     
	var vtax=1+parseFloat(tax);
//	if ($('select[name=\'tc016\']').val()=='1') {form.tc019.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}  內含稅/1.05vtax
	if ($('select[name=\'tc016\']').val()=='1') {form.tc029.value=Math.round(sumTotal/parseFloat(vtax));form.tc030.value=Math.round(sumTotal-form.tc029.value);}
	var sumTot =Math.round(sumTotal+sumTax);
    $("#sum_tax").html(sumTax.toFixed(1));	
//	$("#sum_tot").html(sumTot.toFixed(1));	
    $("#sum_tot").html(parseFloat(form.tc029.value)+parseFloat(form.tc030.value));	
	form.tc031.value=Math.round(sumQty);	
	form.tc043.value=Math.round(sumQty1);
	form.tc044.value=Math.round(sumQty2);
}
//--></script>
 <!-- 明細 品號開視窗   -->  
 
 <!-- 開啟查價 -->
<script type="text/javascript"> 	   
	function copq06a(thisobj,row_count) {	
	// var n = this.name.replace(/order_product\[(\d+)].*/, '$1');    
	// var ifm = document.getElementById('ifm');
	//    ifm.innerHTML = $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);
	
	var str = thisobj.name;
	if(!$("input[name$='"+str.replace(/td011/,"td004")+"']").val() || !$("#tc004").val()) return;
	$('#hp_ifmain').attr('src','<?php echo base_url()?>index.php/fun/copq06a/display_hp/td002/desc/0/'+$("#tc004").val()+'/'+$("input[name$='"+str.replace(/td011/,"td004")+"']").val()+'/'+row_count);
	
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '500px', 	   
	width: '640px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divcopq06a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}; 	   
	 
	function select_price(price,row){
		$('input[name=\'order_product[' + row + '][td011]\']').val(price);
		$('.close').click();
	}
	function select_data(a_mb002,b_mb002,b_mb003,a_mb003,a_mb008,row){
		$('input[name=\'order_product[' + row + '][td004]\']').val(a_mb002);
		$('input[name=\'order_product[' + row + '][td005]\']').val(b_mb002);
		$('input[name=\'order_product[' + row + '][td006]\']').val(b_mb003);
		$('input[name=\'order_product[' + row + '][td010]\']').val(a_mb003);
		$('input[name=\'order_product[' + row + '][td011]\']').val(a_mb008);
		$('input[name=\'order_product[' + row + '][td011]\']').focus();
		$('.close').click();
	}
	
	</script> 	    	
		   
	<div id="divcopq06a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq06a/display_hp/td001/desc/0/cn00001" allowTransparency="flase" id="hp_ifmain" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>
	
 <!-- 開啟客戶計價 -->
<script type="text/javascript"> 	   
	function copi02a(thisobj,row_count) {
	// var n = this.name.replace(/order_product\[(\d+)].*/, '$1');    
	// var ifm = document.getElementById('ifm');
	//    ifm.innerHTML = $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);	
	if(!$("#tc004").val())
		return;
	var str = thisobj.name;
	//if($("input[name$='"+str.replace(/td011/,"td004")+"']").val())
	$('#copi02aifmain').attr('src','<?php echo base_url()?>index.php/fun/copi02a/display/a.mb001/desc/0/'+$("#tc004").val()+'/'+row_count);
	
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '15%', 	   
	height: '500px', 	   
	width: '70%', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divcopi02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}; 	   
	 
	</script> 	    	
		   
	<div id="divcopi02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copi02a/display/a.mb001/desc/0/cn00001/" allowTransparency="flase" id="copi02aifmain" name="ifmain" width="95%" height="500" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>
	
	
	
	
	
	
	
	
	
	
	