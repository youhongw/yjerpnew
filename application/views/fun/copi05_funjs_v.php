<!-- 開視窗 copq03a21 單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showcopq03a21").click(function() { 	   
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
	message: $('#divFcopq03a21'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFcopq03a21" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq03a/display1" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcopq03a21(sma001,sma002) {	
	form.copq03a21.value=sma001;
	var oSpan = document.getElementById("copq03a21disp");
		oSpan.innerHTML = sma002;
	document.form.copq03a21.focus();    
	return copq03a21;	
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
	 $('input[name=\'order_product[' + product_row1  + '][tb008]\']').val(stc002);
	return $("#tb008").html(stc002);
	
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

<script type="text/javascript"><!--
  function addcopq01a(sma001,sma002,sma005,sma006,sma007) {
   
	form.copq01a.value=sma001;
	form.ta006.value=sma002;
	form.cmsq06a.value=sma005;
	form.ta010.value=sma006;
	form.ta022.value=sma007;
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


function showcopq03a21(sText){                 //不更新網頁 31  核價單別 cop/copi0501
	var oSpan = document.getElementById("copq03a21disp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 copq03a21 核價單別 -->        
function startcopq03a21(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#cop/copi0501disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
   
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq03a/datacopq03a21/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq03a21(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}


function showcopq01a(sText){   //不更新網頁 32 客戶代號 
	var oSpan = document.getElementById("copq01adisp");
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
	 $('input[name=\'order_product[' + nn + '][tb009]\']').val(sText)};
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
	  var td004=$('input[name=\'order_product[' + nn + '][tb004]\']').val();  //品號
      var td010=$('input[name=\'order_product[' + nn + '][tb008]\']').val();  //單位
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
	//  alert(nn);
	// alert(str[1]);
	 if (num>sysma201){
     $('input[name=\'order_product[' + nn + '][tb005]\']').val(str[0]);  
     $('input[name=\'order_product[' + nn + '][tb006]\']').val(str[1]);
	 $('input[name=\'order_product[' + nn + '][tb008]\']').val(str[2]);}
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
<!-- 不更新網頁帶出資料  核價單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'ta013\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  
	   var zno3=parseInt(zno)+1;
	   document.getElementById("ta002").value=zno3;
	//   alert(zno3);
//	   var oSpan = document.getElementById("copq03a21disp");
//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
//	 if (!sText) { 
//	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
//	 }	
	   
	//	alert(zno3);
	//var oSpan = document.getElementById("cop/copi0502");	 
	// oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	 //   oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	

<!-- 不更新網頁 計算單號 請購單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#cop/copi0506disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'copq03a21\']').val();
	 var zstr=$('input[name=\'ta013\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
     // alert(zno);
	 
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi05/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showchkno1(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}
function showymd1(oInput,n){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert(oInput.value);		
		 var nn=n-1;
	     if  (sText.length==8) {
	     var   sText=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 		   
		  $('input[name=\'order_product[' + nn + '][tb016]\']').val(sText);  } 
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
 <!-- 不更新網頁 檢查 select 欄位 課稅  -->	
<script type="text/javascript"><!--       
 function taxa(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('ta022').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("taxdisp");
	    if (selval<=1) {
	     form.ta024.value=0.05;}
        else
		{form.ta024.value=0;}
}

//--></script>
<!-- 不更新網頁 檢查 select 欄位 確認碼  -->	
<script type="text/javascript"><!--       
 function selappr(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('ta019').selectedIndex;
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
<script type="text/javascript"><!--       
 function seleall(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示	
           document.getElementById('ta013').select();		   
}
//--></script>

<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.ta013.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'ta013\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.ta013.focus(); return ta013;}	
}

//--></script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	
	//跳明細
	if(event.altKey && (keycode == '89')){  //tab6 y
		setTimeout(function() {
			$('input[name=\'order_product[0][tb004]\']').focus();
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
//	html += '    <td class="left"><input type="text"  tabIndex="13"  name="order_product[' + product_row + '][tb003]" value="0" size="6" /></td>';
	html += '    <td class="left"><input type="text" class="total_dc" tabIndex="51" onchange="startinvq02a(this,product_row)" id="tb004'+ product_row+'"   name="order_product[' + product_row + '][tb004]" value="" size="20" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()" type="text" id="tb005"  name="order_product[' + product_row + '][tb005]" value=""  /></td>';
	html += '    <td class="left"><input readonly="value"  onKeyPress="keyFunction()" type="text" id="tb006"   name="order_product[' + product_row + '][tb006]" value=""  size="30" /></td>';
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()" ondblclick="startinvq81a();"  type="text" id="tb008"   name="order_product[' + product_row + '][tb008]" value="" size="6" /></td>';
	html += '    <td class="left"><input type="text"   readonly="value" tabIndex="52"  name="order_product[' + product_row + '][tb003]" value="0" size="6" style="background-color:#F5F5F5" /></td>';
	html += '    <td class="left"><input type="text" onchange="showymd1(this,product_row)" ondblclick="scwShow(this,event);" onfocus="this.select()"  tabIndex="53" id="tb016['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb016]" value="<?php echo date("Y/m/d"); ?>" size="10"  style="background-color:#E7EFEF"/></td>';
	html += '    <td class="center"><input type="text" tabIndex="54" onchange="startcopq02a(this,product_row)"  class="total_qty" id="tb007" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb007]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text"  tabIndex="55" id="tb009" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb009]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" id="tb010"  tabIndex="56" class="total_price" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb010]" value="0" size="10" style="text-align:right"  /></td>';
    html += '    <td class="left"><input type="text" id="tb020" tabIndex="57"  class="total_qty1" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb020]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" id="tb021" tabIndex="58"   class="total_qty2" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb021]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" id="tb018" tabIndex="59"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb018]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" id="tb012" tabIndex="60"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb012]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html);  
	 
	
	   	   //下拉視窗 網頁不更新  mb001 tb004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][tb004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tb004').value;
			     vtj0= product_row - 1;
		       smb001= $('#tb004'+vtj0 ).val();
			
			//   smb001=$("#tb004"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/cop/copi05/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tb008]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });    
	
	
	   
        //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tb007]\'],input[name=\'order_product[' + product_row + '][tb009]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb007]\']').val()*1;  
		var input_2=$('input[name=\'order_product[' + n + '][tb009]\']').val()*1;  
		var get_total=input_1*input_2;  
		$('input[name=\'order_product[' + n + '][tb010]\']').val(get_total);
		
		//totalSum1();
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2); 
	});
	    //數量游標停在 0 之後 
	$('input[name=\'order_product[' + product_row + '][tb007]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		    if ($(this).val()=='0')
			$(this).val('');
	});
	    //數量 
	$('input[name=\'order_product[' + product_row + '][tb007]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		
		  if ($(this).val()=='')
		   	  $(this).val('0');
	});
	  //單價  游標停在 0 之後
	$('input[name=\'order_product[' + product_row + '][tb009]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		     if ($(this).val()=='0')
			$(this).val('');
	});  
	  //單價  
	$('input[name=\'order_product[' + product_row + '][tb009]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		
		if ($(this).val()=='')
		 	$(this).val('0');
	});  
	 //金額  
	$('input[name=\'order_product[' + product_row + '][tb010]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
	    totalSum1();
	});
	
	//客品
	$('input[name=\'order_product[' + product_row + '][tb018]\']').focus(function(){
		totalSum1();
	});
	//備註,品號
  	$('input[name=\'order_product[' + product_row + '][tb012]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][tb004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	$('input[name=\'order_product[' + product_row + '][tb004]\']').focus();
	product_row++;
}
//-->
</script>
<script type="text/javascript"><!--  //合計金額

function totalSum1() {

    var sumTotal = 0;
	var sumTotal1 = 0;
	var sumQty = 0;
	var sumQty1 = 0;
	var sumQty2 = 0;
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

  	form.ta009.value=Math.round(sumTotal);	  //; 報價金額

	 var tax=$('input[name=\'ta024\']').val();  //稅率
	 var rate=$('input[name=\'ta008\']').val();  //匯率
	 
	form.ta023.value=Math.round(sumTotal*tax);  //原幣稅額
	
	var sumTax =Math.round(sumTotal*tax);
	
	var sumTot =Math.round(sumTotal+sumTax); 
	$("#sum_tot").html(sumTot.toFixed(1));	    //合計金額
	
	form.ta025.value=Math.round(sumQty);	  //; 總數量
	form.ta027.value=Math.round(sumQty1);	  //; 毛重
	form.ta028.value=Math.round(sumQty2);	  //; 總材積
	
	//課稅別
//	if ($('select[name=\'ta022\']').val()=='1') {form.ta009.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}	
	
	//var sumTot =Math.round(sumTotal+sumTax); 
	//  $("#sum_tot").html(sumTot.toFixed(1));	

}
//--></script>
 <!-- 明細 品號開視窗   -->  