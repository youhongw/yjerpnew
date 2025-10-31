<<!-- 不更新網頁, 帶出資料 -->
<script language="javascript"   >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

   function showkey(sText){   //不更新網頁 5 key  庫別代號 檢查資料重複 
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
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi01/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma022.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma022\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 7) { 
		    document.form.ma022.focus(); return ma022;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym2(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert('test');
		   document.form.ma011.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma011\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma011.focus(); return ma011;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym3(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma012.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma012\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma012.focus(); return ma012;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym4(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma021.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma021\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma021.focus(); return ma021;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym5(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma021.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma021\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma021.focus(); return ma021;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym6(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma027.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma027\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma027.focus(); return ma027;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym7(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma028.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma028\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma028.focus(); return ma028;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym8(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma029.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma029\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma029.focus(); return ma029;}	
}
//--></script>
<script type="text/javascript"><!--       
 function dataym9(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	     //   alert('test');
		   document.form.ma030.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ma030\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length  != 7) { 
		    document.form.ma030.focus(); return ma030;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.ma013.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'ma013\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.ma013.focus(); return ma013;}	
}

//--></script>
<script type="text/javascript"><!--       
 function dataymd2(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.ma204.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'ma204\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.ma204.focus(); return ma204;}	
}

//--></script>

<!-- 不更新網頁,檢查欄位空白  -->
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
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1
		setTimeout(function() {
			$('input[name="ma001"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2
		setTimeout(function() {
			$('#ma007').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '67')){  //tab3
		setTimeout(function() {
			$('#ma016').focus();
		}, 100);	
	}
	if(event.altKey && (keycode == '71')){  //tab4
		setTimeout(function() {
			$('#ma022').focus();
		}, 100);	
	}
});
</script>