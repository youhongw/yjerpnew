<script type="text/javascript"> 	   //開視窗 一定要寫 1 會計
	$(document).ready(function(){
	$("#ShowblockUI1").click(function() { 	   
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
	message: $('#divForm1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divForm1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/inv/invq01a/display1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addOrder1(sma001,sma002) {	
	form.mb005.value=sma001;
	var oSpan = document.getElementById("mb005disp");
		oSpan.innerHTML = sma002;
	document.form.mb005.focus();    
	return mb005;	
}
//--></script>
	
	
<script type="text/javascript"> 	   //開視窗 一定要寫 2 商品
	$(document).ready(function(){ 	   
	$("#ShowblockUI2").click(function() { 	   
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
	message: $('#divForm2'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/inv/invq01a/display2" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addOrder2(sma001,sma002) {
	    form.mb006.value=sma001;
	var oSpan = document.getElementById("mb006disp");
		oSpan.innerHTML = sma002;
	document.form.mb006.focus();    
	return mb006;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 3 類別
	$(document).ready(function(){ 	   
	$("#ShowblockUI3").click(function() { 	   
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
	message: $('#divForm3'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm3" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/inv/invq01a/display3" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addOrder3(sma001,sma002) {
	  form.mb007.value=sma001;
	var oSpan = document.getElementById("mb007disp");
		oSpan.innerHTML = sma002;
	document.form.mb007.focus();    
	return mb007;
	
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 4 生管
	$(document).ready(function(){ 	   
	$("#ShowblockUI4").click(function() { 	   
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
	message: $('#divForm4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/inv/invq01a/display4" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addOrder4(sma001,sma002) {
	form.mb008.value=sma001;	
	var oSpan = document.getElementById("mb008disp");
		oSpan.innerHTML = sma002;	
	document.form.mb008.focus();    
	return mb008;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 6 庫別
	$(document).ready(function(){ 	   
	$("#ShowblockUI6").click(function() { 	   
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
	message: $('#divForm6'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm6" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq03a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addOrder6(sma001,sma002) {
	form.mb017.value=sma001;
	var oSpan = document.getElementById("mb017disp");
		oSpan.innerHTML = sma002;	
	document.form.mb017.focus();    
	return mb017;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 7 生產線別
    
	$(document).ready(function(){ 	   
	$("#ShowblockUI7").click(function() { 	   
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
	message: $('#divForm7'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 
    
</script> 	    	
		   
	<div id="divForm7" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq04a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addOrder7(sma001,sma002) {
	form.mb068.value=sma001;
	var oSpan = document.getElementById("mb068disp");
		oSpan.innerHTML = sma002;	
	document.form.mb068.focus();    
	return mb068;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 8 途程品號
	$(document).ready(function(){ 	   
	$("#ShowblockUI8").click(function() { 	   
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
	message: $('#divForm8'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	    	
		   
	<div id="divForm8" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/bom/bomq07a/display" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addOrder8(sma001,sma002) {
	form.mb010.value=sma001;
	form.mb011.value=sma002;
	var oSpan = document.getElementById("mb011");
		oSpan.innerHTML = sma002;	
	document.form.mb010.focus();    
	return mb010;
	
}
//--></script>
<script type="text/javascript"> 	   //開視窗 一定要寫 21 計劃人員
	$(document).ready(function(){ 	   
	$("#ShowblockUI21").click(function() { 	   
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
	message: $('#divForm21'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divForm21" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?=base_url()?>index.php/cms/cmsq09a/display1" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addOrder21(sma001,sma002) {
	form.mb018.value=sma001;
	var oSpan = document.getElementById("mb018disp");
		oSpan.innerHTML = sma002;	
	document.form.mb018.focus();    
	return mb018;
}
//--></script>

<script language="javascript"   >   //不更新網頁, 帶出資料
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}


function showResult1(sText){                 //不更新網頁 1 會計    
	var oSpan = document.getElementById("mb005disp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startCheck1(oInput){            //不更新網頁 1  會計
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#mb005disp").html("<span style='color:red'>欄位不可空白.</span>");			
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata1/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult2(sText){   //不更新網頁 2  商品
	var oSpan = document.getElementById("mb006disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startCheck2(oInput){         //不更新網頁 2 商品
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata2/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult2(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult3(sText){   //不更新網頁 3  類別
	var oSpan = document.getElementById("mb007disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startCheck3(oInput){         //不更新網頁 3 類別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata3/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult3(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult4(sText){   //不更新網頁 4  生管
	var oSpan = document.getElementById("mb008disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startCheck4(oInput){         //不更新網頁 4 生管
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata4/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult4(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult5(sText){   //不更新網頁 5  品號 檢查資料重複
	var oSpan = document.getElementById("mb001disp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#mb001disp").html("可使用!");
	   oSpan.style.color = "blank";
	 }	 
	  if (sText) { 
	   $("#mb001disp").html("不可修改!");
	   oSpan.style.color = "red";
	 //  document.getElementById("mb001").focus();
	 } 
}

function startCheck5(oInput){         //不更新網頁 5 品號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#mb001disp").html("<span style='color:red'>欄位不可空白.</span>");
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata5/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult5(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult6(sText){   //不更新網頁 6  庫別 檢查資料重複
	var oSpan = document.getElementById("mb017disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startCheck6(oInput){         //不更新網頁 6 庫別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata6/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult6(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult7(sText){   //不更新網頁 7  生產線別 檢查資料重複
	var oSpan = document.getElementById("mb068disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startCheck7(oInput){         //不更新網頁 7  生產線別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata7/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult7(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult8(sText){   //不更新網頁 8  途程品號 檢查資料重複
	var oSpan = document.getElementById("mb010disp");
		oSpan.innerHTML = sText;
      document.getElementById("mb011").value = sText;
      $('input[name=\'mb011\']').attr('value') = sText;
	  
	  oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startCheck8(oInput){         //不更新網頁  8  途程品號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata8/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult8(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showResult21(sText){   //不更新網頁 21  計劃人員 檢查資料重複
	var oSpan = document.getElementById("mb018disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startCheck21(oInput){         //不更新網頁 21  計劃人員
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/inv/invi02/checkdata21/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showResult21(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


</script>

 <script type="text/javascript"><!--       //檢查欄位空白
 function checkspace2(oInput){         //不更新網頁 2 商品
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#mb002disp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
	 
}

//--></script> 	
 
<script type="text/javascript"><!-- 	// enterkey 測試   
	$(document).ready(function(){ 	   
//	$('#mb001').focus(); 	   
	Enterkey(); 	   
	}); 	   
//--></script> 	   
		   
<script type="text/javascript"><!-- 	// enterkey 測試    
	function Enterkey() { 	   
	$("input").not( $(":button") ).keypress(function (evt) { 	   
	if (evt.keyCode == 13) { 	   
	if ($(this).attr("type") !== 'submit'){ 	   
	var fields = $(this).parents('form:eq(0),body').find('button, input, textarea'); 	   
	var index = fields.index( this ); 	   
	if ( index > -1 && ( index + 1 ) < fields.length ) { 	   
	fields.eq( index + 1 ).focus(); 	   
	} 	   
	$(this).blur(); 	   
	return false; 	   
	} 	   
	} 	   
	}); 	   
	} 	   
//--></script>
 	