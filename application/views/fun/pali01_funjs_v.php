<<!-- 不更新網頁, 帶出資料 -->
<script language="javascript"   >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

 function showimage(sText){   //不更新網頁 5 key  庫別代號 檢查資料重複 
	var oSpan = document.getElementById("showimg");
	//   var img = document.getElementById('sunset');
        console.log(oSpan.height);
	   //  alert(oSpan);
		//oSpan.innerHTML = sText;	
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


<!-- 不更新網頁,客戶總店代號 -->
function showcopq01a(sText){                 
	var oSpan = document.getElementById("copq01adisp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,客戶總店代號 -->
function startcopq01a(oInput){            
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma007disp").html("<span style='color:red'>欄位不可空白.</span>");			
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi01/datacopq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

<!-- 不更新網頁,型態   -->
function showcmsq15a2(sText){                     
	var oSpan = document.getElementById("cmsq15a2disp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,型態   -->
function startcmsq15a2(oInput){            
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma007disp").html("<span style='color:red'>欄位不可空白.</span>");			
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi01/datacmsq15a2/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq15a2(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁,通路   -->
function showcmsq15a1(sText){                    
	var oSpan = document.getElementById("cmsq15a1disp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,通路   -->
function startcmsq15a1(oInput){            
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma007disp").html("<span style='color:red'>欄位不可空白.</span>");			
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi01/datacmsq15a1/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq15a1(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁,地區 -->
function showcmsq15a3(sText){                   
	var oSpan = document.getElementById("cmsq15a3disp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,地區 -->
function startcmsq15a3(oInput){            
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma007disp").html("<span style='color:red'>欄位不可空白.</span>");			
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi01/datacmsq15a3/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq15a3(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁,職稱 -->
function showpalq40a(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("palq40adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,職稱 -->
function startpalq40a(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pal/pali01/datapalq40a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq40a(xmlHttp.responseText);	//顯示服務器結果		
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


<!-- 不更新網頁,付款銀行1 -->
function showcmsq16a(sText){   //不更新網頁 18  付款銀行1
	var oSpan = document.getElementById("cmsq16adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,付款銀行1 -->
function startcmsq16a(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq16a/datacmsq16a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq16a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁帶出資料 cmsq05a 請購部門 -->
function showcmsq05a(sText){   //不更新網頁 ta004 請購部門
	var oSpan = document.getElementById("cmsq05adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 cmsq05a 請購部門 -->
function startcmsq05a(oInput){         //不更新網頁 ta004 請購部門
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
<!-- 不更新網頁帶出資料 palq16a 主要班別-->
function showpalq16a(sText){   //不更新網頁 palq16a 主要班別 mv027
	var oSpan = document.getElementById("palq16adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 palq16a 主要班別-->
function startpalq16a(oInput){         //不更新網頁 palq16a 主要班別
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/palq16a/datapalq16a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq16a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
<!-- 不更新網頁帶出資料 palq09a 學歷-->
function showpalq09a(sText){   //不更新網頁 palq16a 學歷 mv012
	var oSpan = document.getElementById("palq09adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 palq09a 學歷-->
function startpalq09a(oInput){         //不更新網頁 palq09a 學歷
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求	
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/palq09a/datapalq09a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq09a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
<!-- 不更新網頁帶出資料 palq20a 傳票部門別-->
function showpalq20a(sText){   //不更新網頁 ta004 請購部門
	var oSpan = document.getElementById("palq20adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 palq20a 傳票部門別-->
function startpalq20a(oInput){         //不更新網頁 ta004 請購部門
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/palq20a/datapalq20a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq20a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁帶出資料 palq21a 薪資公司別-->
function showpalq21a(sText){   //不更新網頁 ta004 請購部門
	var oSpan = document.getElementById("palq21adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 palq21a 薪資公司別-->
function startpalq21a(oInput){         //不更新網頁 ta004 請購部門
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/palq21a/datapalq21a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq21a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁帶出資料 palq22a 列印別-->
function showpalq22a(sText){   //不更新網頁 ta004 請購部門
	var oSpan = document.getElementById("palq22adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 palq22a palq22a 列印別-->
function startpalq21a(oInput){         //不更新網頁 ta004 請購部門
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/palq22a/datapalq22a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq22a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
<!-- 不更新網頁,年終列印類別 -->
function showpalq41a(sText){   
	var oSpan = document.getElementById("palq41adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,應收票據科目  -->
function startpalq41a(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pal/pali01/datapalq41a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showactq03a2(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
  <!-- 不更新網頁帶出資料  工號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText='1001' };   
	          	
       var zno1=sText
	   
	  // alert(zno1);
	   var zno3=parseInt(zno1)+1;
	   document.getElementById("mv001").value=zno3;
	
	 }	

<!-- 不更新網頁 計算工號  -->	 
function chkno1(oInput){  
	 var zno=$('input[name=\'mv001\']').val();
    //  alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pal/pali01/datachkno1/" + encodeURIComponent(zno)+ "/" + new Date().getTime();   
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
// if ( $('#tab2').focus() ) { alert("The ALT key was NOT pressed!");} else {alert('test');}
//--></script>

<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv008.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv008\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv008.focus(); return mv008;}	
}
function check_len(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert('test');
		     var str1=oInput.value;
		     var str2=str1.length; 
		       console.log(str2);
			  //  alert('test');
		   if  ( str2 == 10 || str2 == 8 || str2 == 0   ) {  } 
		     else { 
		    alert('輸入資料不正確'); }	
		 //  alert(zstr.length);
			
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd2(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv021.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv021\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv021.focus(); return mv021;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd3(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv052.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv052\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv052.focus(); return mv052;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd4(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv022.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv022\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv022.focus(); return mv022;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd5(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv053.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv053\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv053.focus(); return mv053;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd6(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv023.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv023\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv023.focus(); return mv023;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd7(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv048.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv048\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv048.focus(); return mv048;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd8(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv049.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv049\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv049.focus(); return mv049;}	
}
//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd9(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.mv050.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mv050\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.mv050.focus(); return mv050;}	
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
<!-- 開視窗 新增下拉視窗 pali08add 名稱1 -->
	<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showpali08add").click(function() { 	   
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
	message: $('#divFpali08add'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFpali08add" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" onclick="window.location.reload()" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/pal/pali08/addform1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  	
<!-- 開視窗 copq01a 客戶 -->
	<script type="text/javascript"> 	   
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
  function addcopq01a(sma001,sma002) {	
	form.copq01a.value=sma001;
	var oSpan = document.getElementById("copq01adisp");
		oSpan.innerHTML = sma002;
	document.form.copq01a.focus();    
	return copq01a;	
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
	height: '620px', 	   
	width: '650px', 	   
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
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq05a/display" allowTransparency="flase" name="ifmain" width="640" height="600" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
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

<!-- 開視窗 palq16a 主要班別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq16a").click(function() { 	   
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
	message: $('#divFpalq16a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpalq16a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq16a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq16a(sta001,sta002) {
	  	  form.palq16a.value=sta001;
	var oSpan = document.getElementById("palq16adisp");
		oSpan.innerHTML = sta002;
	document.form.palq16a.focus();    
	return palq16a;
	
}
//--></script>
<!-- 開視窗 palq20a 傳票部門 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq20a").click(function() { 	   
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
	message: $('#divFpalq20a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpalq20a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq20a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq20a(sta001,sta002) {
	  	  form.palq20a.value=sta001;
	var oSpan = document.getElementById("palq20adisp");
		oSpan.innerHTML = sta002;
	document.form.palq20a.focus();    
	return palq20a;
	
}
//--></script>
<!-- 開視窗 palq21a 薪資別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq21a").click(function() { 	   
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
	message: $('#divFpalq21a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpalq21a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq21a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq21a(sta001,sta002) {
	  	  form.palq21a.value=sta001;
	var oSpan = document.getElementById("palq21adisp");
		oSpan.innerHTML = sta002;
	document.form.palq21a.focus();    
	return palq21a;
	
}
//--></script>
<!-- 開視窗 palq22a 列印別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq22a").click(function() { 	   
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
	message: $('#divFpalq22a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpalq22a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq22a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq22a(sta001,sta002) {
	  	  form.palq22a.value=sta001;
	var oSpan = document.getElementById("palq22adisp");
		oSpan.innerHTML = sta002;
	document.form.palq22a.focus();    
	return palq22a;
	
}
//--></script>
<!-- 開視窗 cmsq09b 職務類別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09b").click(function() { 	   
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
	message: $('#divFcmsq09b'), 	   
	}); 	   
		  
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq09b" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09b/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq09b(sta001,sta002) {
	  	  form.cmsq09b.value=sta001;
	var oSpan = document.getElementById("cmsq09bdisp");
		oSpan.innerHTML = sta002;
	document.form.cmsq09b.focus();    
	return cmsq09b;
	
}
//--></script>

<!-- 開視窗 cmsq16a1 付款銀行2 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq16a1").click(function() { 	   
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
	message: $('#divFcmsq16a1'), 	   
	}); 	   
		  
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq16a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq16a/display1" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq16a1(sta001,sta002) {
	  	  form.cmsq16a1.value=sta001;
	var oSpan = document.getElementById("cmsq16a1disp");
		oSpan.innerHTML = sta002;
	document.form.cmsq16a1.focus();    
	return cmsq16a1;
	
}
//--></script>

<!-- 開視窗 cmsq16a2 付款銀行2 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq16a2").click(function() { 	   
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
	message: $('#divFcmsq16a2'), 	   
	}); 	   
		 
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq16a2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq16a/display2" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq16a2(sta001,sta002) {
	  	  form.cmsq16a2.value=sta001;
	var oSpan = document.getElementById("cmsq16a2disp");
		oSpan.innerHTML = sta002;
	document.form.cmsq16a2.focus();    
	return cmsq16a2;
	
}
//--></script>
<!-- 開視窗 palq40a 職稱 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq40a").click(function() { 	   
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
	message: $('#divFormpalq40a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormpalq40a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq40a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addpalq40a(sma001,sma002) {
	form.palq40a.value=sma001;	
	var oSpan = document.getElementById("palq40adisp");
		oSpan.innerHTML = sma002;	
	document.form.palq40a.focus();    
	return palq40a;
}
//--></script>

<!-- 開視窗 palq40a1 年級列印類別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq41a").click(function() { 	   
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
	message: $('#divFormpalq41a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormpalq41a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq41a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addpalq41a(sma001,sma002) {
	form.palq41a.value=sma001;	
	var oSpan = document.getElementById("palq41adisp");
		oSpan.innerHTML = sma002;	
	document.form.palq41a.focus();    
	return palq41a;
}
//--></script>


<!-- 開視窗 cmsq09a4 採購人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09b").click(function() { 	   
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
	message: $('#divFormcmsq09b'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09b" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09b/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09b(sma001,sma002) {
	form.cmsq09b.value=sma001;	
	var oSpan = document.getElementById("cmsq09bdisp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09b.focus();    
	return cmsq09b;
}
//--></script>

<!-- 開視窗 actq03a1 42 加工科目 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showactq03a1").click(function() { 	   
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
	message: $('#divFactq03a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFactq03a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a1(sma001,sma002) {
	form.actq03a1.value=sma001;
	var oSpan = document.getElementById("actq03a1disp");
		oSpan.innerHTML = sma002;	
	document.form.actq03a1.focus();    
	return actq03a1;
}
//--></script>

<!-- 開視窗 actq03a2 41 應付帳款別 -->
<script type="text/javascript"> 	  
    
	$(document).ready(function(){ 	   
	$("#Showactq03a2").click(function() { 	   
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
	message: $('#divFactq03a2'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 
    
</script> 	    	
		   
	<div id="divFactq03a2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display2" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a2(sma001,sma002) {
	form.actq03a2.value=sma001;
	var oSpan = document.getElementById("actq03a2disp");
		oSpan.innerHTML = sma002;	
	document.form.actq03a2.focus();    
	return actq03a2;
}
//--></script>

<!-- 開視窗 actq03a3 43 應付票據 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showactq03a3").click(function() { 	   
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
	message: $('#divFactq03a3'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	    	
		   
	<div id="divFactq03a3" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display3" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a3(sma001,sma002) {
	form.actq03a3.value=sma001;
	
	var oSpan = document.getElementById("actq03a3disp");
		oSpan.innerHTML = sma002;	
	document.form.actq03a3.focus();    
	return actq03a3;
	
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

<!-- 開視窗 palq09a  mv012 學歷 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpalq09a").click(function() { 	   
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
	message: $('#divFpalq09a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		 
	<div id="divFpalq09a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq09a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq09a(sma001,sma002) {
	form.palq09a.value=sma001;
	var oSpan = document.getElementById("palq09adisp");
		oSpan.innerHTML = sma002;	
	document.form.palq09a.focus();    
	return palq09a;
}
//--></script>

<!-- 開視窗 purq01a1 海運公司(廠商)  -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpurq01a1").click(function() { 	   
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
	message: $('#divFpurq01a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a1(sma001,sma002) {
	form.purq01a1.value=sma001;
	var oSpan = document.getElementById("purq01a1disp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a1.focus();    
	return purq01a1;
}
//--></script>
<!-- 開視窗 purq01a2 空運公司(廠商)  -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpurq01a2").click(function() { 	   
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
	message: $('#divFpurq01a2'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display2" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a2(sma001,sma002) {
	form.purq01a2.value=sma001;
	var oSpan = document.getElementById("purq01a2disp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a2.focus();    
	return purq01a2;
}
//--></script>

<!-- 開視窗 purq01a3 報關行(廠商)  -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpurq01a3").click(function() { 	   
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
	message: $('#divFpurq01a3'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a3" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display3" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a3(sma001,sma002) {
	form.purq01a3.value=sma001;
	var oSpan = document.getElementById("purq01a3disp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a3.focus();    
	return purq01a3;
}
//--></script>

<!-- 開視窗 purq01a4 驗貨公司(廠商)  -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showpurq01a4").click(function() { 	   
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
	message: $('#divFpurq01a4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display4" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a4(sma001,sma002) {
	form.purq01a4.value=sma001;
	var oSpan = document.getElementById("purq01a4disp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a4.focus();    
	return purq01a4;
}
//--></script>

<!-- 開視窗 copq01a 代理商(客戶)  -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcopq01a1").click(function() { 	   
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
	message: $('#divFcopq01a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcopq01a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq01a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcopq01a1(sma001,sma002) {
	form.copq01a1.value=sma001;
	var oSpan = document.getElementById("copq01a1disp");
		oSpan.innerHTML = sma002;	
	document.form.copq01a1.focus();    
	return copq01a1;
}
//--></script>
<script type="text/javascript">
function pre_pic(obj){ //預覽圖片
  if(obj.files && obj.files[0]){
	  var reader = new FileReader();
	  reader.onload = function(e){
		  $('#ad').attr('src',e.target.result);
	  }
	  reader.readAsDataURL(obj.files[0]);
  }
}
</script>
<!-- 地址1 -->
<SCRIPT language=javascript>

function Buildkey1(num) {
var ctr=1;
document.form.address1.selectedIndex=0;
document.form.code1.value=""; 
document.form.address1.options[0]=new Option("鄉鎮區域","");
/*
定義二階選單內容
if(num=="第一階下拉選單的值") { document.form.address1.options[ctr]=new Option("第二階下拉選單的顯示名稱","第二階下拉選單的值"); ctr=ctr+1; }
*/ 
/*臺北市*/ 
if(num=="1") { document.form.address1.options[ctr]=new Option("中正區","100"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("大同區","103"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("中山區","104"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("松山區","105"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("大安區","106"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("萬華區","108"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("信義區","110"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("士林區","111"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("北投區","112"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("內湖區","114"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("南港區","115"); ctr=ctr+1; }
if(num=="1") { document.form.address1.options[ctr]=new Option("文山區","116"); ctr=ctr+1; }
/*基隆市*/ 
if(num=="2") { document.form.address1.options[ctr]=new Option("仁愛區","200"); ctr=ctr+1; }
if(num=="2") { document.form.address1.options[ctr]=new Option("信義區","201"); ctr=ctr+1; }
if(num=="2") { document.form.address1.options[ctr]=new Option("中正區","202"); ctr=ctr+1; }
if(num=="2") { document.form.address1.options[ctr]=new Option("中山區","203"); ctr=ctr+1; }
if(num=="2") { document.form.address1.options[ctr]=new Option("安樂區","204"); ctr=ctr+1; }
if(num=="2") { document.form.address1.options[ctr]=new Option("暖暖區","205"); ctr=ctr+1; }
if(num=="2") { document.form.address1.options[ctr]=new Option("七堵區","206"); ctr=ctr+1; }
/*新北市*/ 
if(num=="3") { document.form.address1.options[ctr]=new Option("萬里區","207"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("金山區","208"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("板橋區","220"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("汐止區","221"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("深坑區","222"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("石碇區","223"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("瑞芳區","224"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("平溪區","226"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("雙溪區","227"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("貢寮區","228"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("新店區","231"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("坪林區","232"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("烏來區","233"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("永和區","234"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("中和區","235"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("土城區","236"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("三峽區","237"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("樹林區","238"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("鶯歌區","239"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("三重區","241"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("新莊區","242"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("泰山區","243"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("林口區","244"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("蘆洲區","247"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("五股區","248"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("八里區","249"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("淡水區","251"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("三芝區","252"); ctr=ctr+1; } 
if(num=="3") { document.form.address1.options[ctr]=new Option("石門區","253"); ctr=ctr+1; } 
/*宜蘭縣*/
if(num=="4") { document.form.address1.options[ctr]=new Option("宜蘭市","260"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("頭城鎮","261"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("礁溪鄉","262"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("壯圍鄉","263"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("員山鄉","264"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("羅東鎮","265"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("三星鄉","266"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("大同鄉","267"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("五結鄉","268"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("冬山鄉","269"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("蘇澳鎮","270"); ctr=ctr+1; } 
if(num=="4") { document.form.address1.options[ctr]=new Option("南澳鄉","272"); ctr=ctr+1; } 
/*新竹縣市*/
if(num=="5") { document.form.address1.options[ctr]=new Option("新竹市","300"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("竹北市","302"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("湖口鄉","303"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("新豐鄉","304"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("新埔鎮","305"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("關西鎮","306"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("芎林鄉","307"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("寶山鄉","308"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("竹東鎮","310"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("五峰鄉","311"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("橫山鄉","312"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("尖石鄉","313"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("北埔鄉","314"); ctr=ctr+1; } 
if(num=="5") { document.form.address1.options[ctr]=new Option("峨眉鄉","315"); ctr=ctr+1; } 
/*桃園縣*/
if(num=="6") { document.form.address1.options[ctr]=new Option("中壢市","320"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("平鎮市","324"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("龍潭鄉","325"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("楊梅鎮","326"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("新屋鄉","327"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("觀音鄉","328"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("桃園市","330"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("龜山鄉","330"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("龜山鄉","333"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("八德市","334"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("大溪鎮","335"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("復興鄉","336"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("大園鄉","337"); ctr=ctr+1; } 
if(num=="6") { document.form.address1.options[ctr]=new Option("蘆竹鄉","338"); ctr=ctr+1; } 
/*苗栗縣*/
if(num=="7") { document.form.address1.options[ctr]=new Option("竹南鎮","350"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("頭份鎮","351"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("三灣鄉","352"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("南庄鄉","353"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("獅潭鄉","354"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("後龍鎮","356"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("通霄鎮","357"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("苑裡鎮","358"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("苗栗市","360"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("造橋鄉","361"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("頭屋鄉","362"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("公館鄉","363"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("大湖鄉","364"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("泰安鄉","365"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("銅鑼鄉","366"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("三義鄉","367"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("西湖鄉","368"); ctr=ctr+1; } 
if(num=="7") { document.form.address1.options[ctr]=new Option("卓蘭鎮","369"); ctr=ctr+1; }
/*臺中市*/ 
if(num=="8") { document.form.address1.options[ctr]=new Option("中　區","400"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("東　區","401"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("南　區","402"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("西　區","403"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("北　區","404"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("北屯區","406"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("西屯區","407"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("南屯區","408"); ctr=ctr+1; } 
/*臺中縣*/
if(num=="8") { document.form.address1.options[ctr]=new Option("太平區","411"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("大里區","412"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("霧峰區","413"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("烏日區","414"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("豐原區","420"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("后里區","421"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("石岡區","422"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("東勢區","423"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("和平區","424"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("新社區","426"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("潭子區","427"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("大雅區","428"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("神岡區","429"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("大肚區","432"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("沙鹿區","433"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("龍井區","434"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("梧棲區","435"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("清水區","436"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("大甲區","437"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("外埔區","438"); ctr=ctr+1; } 
if(num=="8") { document.form.address1.options[ctr]=new Option("大安區","439"); ctr=ctr+1; }
/*彰化縣*/ 
if(num=="10") { document.form.address1.options[ctr]=new Option("彰化市","500"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("芬園鄉","502"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("花壇鄉","503"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("秀水鄉","504"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("鹿港鎮","505"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("福興鄉","506"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("線西鄉","507"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("和美鎮","508"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("伸港鄉","509"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("員林鎮","510"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("社頭鄉","511"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("永靖鄉","512"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("埔心鄉","513"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("溪湖鎮","514"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("大村鄉","515"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("埔鹽鄉","516"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("田中鎮","520"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("北斗鎮","521"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("田尾鄉","522"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("埤頭鄉","523"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("溪州鄉","524"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("竹塘鄉","525"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("二林鎮","526"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("大城鄉","527"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("芳苑鄉","528"); ctr=ctr+1; } 
if(num=="10") { document.form.address1.options[ctr]=new Option("二水鄉","530"); ctr=ctr+1; } 
/*南投縣*/
if(num=="11") { document.form.address1.options[ctr]=new Option("南投市","540"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("中寮鄉","541"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("草屯鎮","542"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("國姓鄉","544"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("埔里鎮","545"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("仁愛鄉","546"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("名間鄉","551"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("集集鎮","552"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("水里鄉","553"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("魚池鄉","555"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("信義鄉","556"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("竹山鎮","557"); ctr=ctr+1; } 
if(num=="11") { document.form.address1.options[ctr]=new Option("鹿谷鄉","558"); ctr=ctr+1; } 
/*嘉義縣市*/
if(num=="12") { document.form.address1.options[ctr]=new Option("嘉義市","600"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("番路鄉","602"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("梅山鄉","603"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("竹崎鄉","604"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("阿里山","605"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("中埔鄉","606"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("大埔鄉","607"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("水上鄉","608"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("鹿草鄉","611"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("太保市","612"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("朴子市","613"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("東石鄉","614"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("六腳鄉","615"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("新港鄉","616"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("民雄鄉","621"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("大林鎮","622"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("溪口鄉","623"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("義竹鄉","624"); ctr=ctr+1; } 
if(num=="12") { document.form.address1.options[ctr]=new Option("布袋鎮","625"); ctr=ctr+1; } 
/*雲林縣*/
if(num=="13") { document.form.address1.options[ctr]=new Option("斗南鎮","630"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("大埤鄉","631"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("虎尾鎮","632"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("土庫鎮","633"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("褒忠鄉","634"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("東勢鄉","635"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("台西鄉","636"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("崙背鄉","637"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("麥寮鄉","638"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("斗六市","640"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("林內鄉","643"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("古坑鄉","646"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("莿桐鄉","647"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("西螺鎮","648"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("二崙鄉","649"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("北港鎮","651"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("水林鄉","652"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("口湖鄉","653"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("四湖鄉","654"); ctr=ctr+1; } 
if(num=="13") { document.form.address1.options[ctr]=new Option("元長鄉","655"); ctr=ctr+1; } 
/*臺南市*/
if(num=="14") { document.form.address1.options[ctr]=new Option("中西區","700"); ctr=ctr+1; } 
if(num=="14") { document.form.address1.options[ctr]=new Option("東　區","701"); ctr=ctr+1; } 
if(num=="14") { document.form.address1.options[ctr]=new Option("南　區","702"); ctr=ctr+1; } 
if(num=="14") { document.form.address1.options[ctr]=new Option("北　區","704"); ctr=ctr+1; } 
if(num=="14") { document.form.address1.options[ctr]=new Option("安平區","708"); ctr=ctr+1; } 
if(num=="14") { document.form.address1.options[ctr]=new Option("安南區","709"); ctr=ctr+1; } 
/*臺南縣*/
if(num=="15") { document.form.address1.options[ctr]=new Option("永康市","710"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("歸仁鄉","711"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("新化鎮","712"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("左鎮鄉","713"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("玉井鄉","714"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("楠西鄉","715"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("南化鄉","716"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("仁德鄉","717"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("關廟鄉","718"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("龍崎鄉","719"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("官田鄉","720"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("麻豆鎮","721"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("佳里鎮","722"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("西港鄉","723"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("七股鄉","724"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("將軍鄉","725"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("學甲鎮","726"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("北門鄉","727"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("新營市","730"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("後壁鄉","731"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("白河鎮","732"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("東山鄉","733"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("六甲鄉","734"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("下營鄉","735"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("柳營鄉","736"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("鹽水鎮","737"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("善化鎮","741"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("新市鄉","741"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("大內鄉","742"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("山上鄉","743"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("新市鄉","744"); ctr=ctr+1; } 
if(num=="15") { document.form.address1.options[ctr]=new Option("安定鄉","745"); ctr=ctr+1; }
/*高雄市*/
if(num=="16") { document.form.address1.options[ctr]=new Option("新興區","800"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("前金區","801"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("苓雅區","802"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("鹽埕區","803"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("鼓山區","804"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("旗津區","805"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("前鎮區","806"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("三民區","807"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("楠梓區","811"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("小港區","812"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("左營區","813"); ctr=ctr+1; } 
/*高雄市*/
if(num=="16") { document.form.address1.options[ctr]=new Option("仁武區","814"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("大社區","815"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("岡山區","820"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("路竹區","821"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("阿蓮區","822"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("田寮區","823"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("燕巢區","824"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("橋頭區","825"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("梓官區","826"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("彌陀區","827"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("永安區","828"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("湖內區","829"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("鳳山區","830"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("大寮區","831"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("林園區","832"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("鳥松區","833"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("大樹區","840"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("旗山區","842"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("美濃區","843"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("六龜區","844"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("內門區","845"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("杉林區","846"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("甲仙區","847"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("桃源區","848"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("三民區","849"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("茂林區","851"); ctr=ctr+1; } 
if(num=="16") { document.form.address1.options[ctr]=new Option("茄萣區","852"); ctr=ctr+1; } 
/*澎湖縣*/
if(num=="18") { document.form.address1.options[ctr]=new Option("馬公市","880"); ctr=ctr+1; } 
if(num=="18") { document.form.address1.options[ctr]=new Option("西嶼鄉","881"); ctr=ctr+1; } 
if(num=="18") { document.form.address1.options[ctr]=new Option("望安鄉","882"); ctr=ctr+1; } 
if(num=="18") { document.form.address1.options[ctr]=new Option("七美鄉","883"); ctr=ctr+1; } 
if(num=="18") { document.form.address1.options[ctr]=new Option("白沙鄉","884"); ctr=ctr+1; } 
if(num=="18") { document.form.address1.options[ctr]=new Option("湖西鄉","885"); ctr=ctr+1; } 
/*屏東縣*/
if(num=="19") { document.form.address1.options[ctr]=new Option("屏東市","900"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("三地門","901"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("霧台鄉","902"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("瑪家鄉","903"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("九如鄉","904"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("里港鄉","905"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("高樹鄉","906"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("鹽埔鄉","907"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("長治鄉","908"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("麟洛鄉","909"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("竹田鄉","911"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("內埔鄉","912"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("萬丹鄉","913"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("潮州鎮","920"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("泰武鄉","921"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("來義鄉","922"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("萬巒鄉","923"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("崁頂鄉","924"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("新埤鄉","925"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("南州鄉","926"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("林邊鄉","927"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("東港鎮","928"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("琉球鄉","929"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("佳冬鄉","931"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("新園鄉","932"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("枋寮鄉","940"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("枋山鄉","941"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("春日鄉","942"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("獅子鄉","943"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("車城鄉","944"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("牡丹鄉","945"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("恆春鎮","946"); ctr=ctr+1; } 
if(num=="19") { document.form.address1.options[ctr]=new Option("滿州鄉","947"); ctr=ctr+1; } 
/*臺東縣*/
if(num=="20") { document.form.address1.options[ctr]=new Option("台東市","950"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("綠島鄉","951"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("蘭嶼鄉","952"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("延平鄉","953"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("卑南鄉","954"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("鹿野鄉","955"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("關山鎮","956"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("海端鄉","957"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("池上鄉","958"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("東河鄉","959"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("成功鎮","961"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("長濱鄉","962"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("太麻里","963"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("金峰鄉","964"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("大武鄉","965"); ctr=ctr+1; } 
if(num=="20") { document.form.address1.options[ctr]=new Option("達仁鄉","966"); ctr=ctr+1; } 
/*花蓮縣*/
if(num=="21") { document.form.address1.options[ctr]=new Option("花蓮市","970"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("新城鄉","971"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("秀林鄉","972"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("吉安鄉","973"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("壽豐鄉","974"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("鳳林鎮","975"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("光復鄉","976"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("豐濱鄉","977"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("瑞穗鄉","978"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("萬榮鄉","979"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("玉里鎮","981"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("卓溪鄉","982"); ctr=ctr+1; } 
if(num=="21") { document.form.address1.options[ctr]=new Option("富里鄉","983"); ctr=ctr+1; } 
/*金門縣*/
if(num=="22") { document.form.address1.options[ctr]=new Option("金沙鎮","890"); ctr=ctr+1; } 
if(num=="22") { document.form.address1.options[ctr]=new Option("金湖鎮","891"); ctr=ctr+1; } 
if(num=="22") { document.form.address1.options[ctr]=new Option("金寧鄉","892"); ctr=ctr+1; } 
if(num=="22") { document.form.address1.options[ctr]=new Option("金城鎮","893"); ctr=ctr+1; } 
if(num=="22") { document.form.address1.options[ctr]=new Option("烈嶼鄉","894"); ctr=ctr+1; } 
if(num=="22") { document.form.address1.options[ctr]=new Option("烏坵鄉","896"); ctr=ctr+1; }
/*連江縣*/
if(num=="23") { document.form.address1.options[ctr]=new Option("南竿鄉","209"); ctr=ctr+1; } 
if(num=="23") { document.form.address1.options[ctr]=new Option("北竿鄉","210"); ctr=ctr+1; } 
if(num=="23") { document.form.address1.options[ctr]=new Option("莒光鄉","211"); ctr=ctr+1; } 
if(num=="23") { document.form.address1.options[ctr]=new Option("東引鄉","212"); ctr=ctr+1; } 
/*南海諸島*/
if(num=="24") { document.form.address1.options[ctr]=new Option("東　沙","817"); ctr=ctr+1; }
if(num=="24") { document.form.address1.options[ctr]=new Option("南　沙","819"); ctr=ctr+1; }
/*釣魚台列嶼*/
if(num=="25") { document.form.address1.options[ctr]=new Option("釣魚台列嶼","290"); ctr=ctr+1; }

document.form.address1.length=ctr;
document.form.address1.options[0].selected=true;
} 

function address_operate1(){
	var city = $('.sel_city1 :selected').text();
	var country = $('.sel_country1 :selected').text();
	var send_no = $('.sel_country1 :selected').val();
	$("input[value='code1']").val(send_no);
	var address = send_no+city+country;
	$("#mv017").val(address);
}
</SCRIPT>

<!-- 通信地址2 -->
<SCRIPT language=javascript>

function Buildkey(num) {
var ctr=1;
document.form.address.selectedIndex=0;
document.form.code.value=""; 
document.form.address.options[0]=new Option("鄉鎮區域","");
/*
定義二階選單內容
if(num=="第一階下拉選單的值") { document.form.address.options[ctr]=mv234 Option("第二階下拉選單的顯示名稱","第二階下拉選單的值"); ctr=ctr+1; }
*/ 
/*臺北市*/ 
if(num=="1") { document.form.address.options[ctr]=new Option("中正區","100"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("大同區","103"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("中山區","104"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("松山區","105"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("大安區","106"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("萬華區","108"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("信義區","110"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("士林區","111"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("北投區","112"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("內湖區","114"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("南港區","115"); ctr=ctr+1; }
if(num=="1") { document.form.address.options[ctr]=new Option("文山區","116"); ctr=ctr+1; }
/*基隆市*/ 
if(num=="2") { document.form.address.options[ctr]=new Option("仁愛區","200"); ctr=ctr+1; }
if(num=="2") { document.form.address.options[ctr]=new Option("信義區","201"); ctr=ctr+1; }
if(num=="2") { document.form.address.options[ctr]=new Option("中正區","202"); ctr=ctr+1; }
if(num=="2") { document.form.address.options[ctr]=new Option("中山區","203"); ctr=ctr+1; }
if(num=="2") { document.form.address.options[ctr]=new Option("安樂區","204"); ctr=ctr+1; }
if(num=="2") { document.form.address.options[ctr]=new Option("暖暖區","205"); ctr=ctr+1; }
if(num=="2") { document.form.address.options[ctr]=new Option("七堵區","206"); ctr=ctr+1; }
/*新北市*/ 
if(num=="3") { document.form.address.options[ctr]=new Option("萬里區","207"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("金山區","208"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("板橋區","220"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("汐止區","221"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("深坑區","222"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("石碇區","223"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("瑞芳區","224"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("平溪區","226"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("雙溪區","227"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("貢寮區","228"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("新店區","231"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("坪林區","232"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("烏來區","233"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("永和區","234"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("中和區","235"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("土城區","236"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("三峽區","237"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("樹林區","238"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("鶯歌區","239"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("三重區","241"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("新莊區","242"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("泰山區","243"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("林口區","244"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("蘆洲區","247"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("五股區","248"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("八里區","249"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("淡水區","251"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("三芝區","252"); ctr=ctr+1; } 
if(num=="3") { document.form.address.options[ctr]=new Option("石門區","253"); ctr=ctr+1; } 
/*宜蘭縣*/
if(num=="4") { document.form.address.options[ctr]=new Option("宜蘭市","260"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("頭城鎮","261"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("礁溪鄉","262"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("壯圍鄉","263"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("員山鄉","264"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("羅東鎮","265"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("三星鄉","266"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("大同鄉","267"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("五結鄉","268"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("冬山鄉","269"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("蘇澳鎮","270"); ctr=ctr+1; } 
if(num=="4") { document.form.address.options[ctr]=new Option("南澳鄉","272"); ctr=ctr+1; } 
/*新竹縣市*/
if(num=="5") { document.form.address.options[ctr]=new Option("新竹市","300"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("竹北市","302"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("湖口鄉","303"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("新豐鄉","304"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("新埔鎮","305"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("關西鎮","306"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("芎林鄉","307"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("寶山鄉","308"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("竹東鎮","310"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("五峰鄉","311"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("橫山鄉","312"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("尖石鄉","313"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("北埔鄉","314"); ctr=ctr+1; } 
if(num=="5") { document.form.address.options[ctr]=new Option("峨眉鄉","315"); ctr=ctr+1; } 
/*桃園縣*/
if(num=="6") { document.form.address.options[ctr]=new Option("中壢市","320"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("平鎮市","324"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("龍潭鄉","325"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("楊梅鎮","326"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("新屋鄉","327"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("觀音鄉","328"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("桃園市","330"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("龜山鄉","330"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("龜山鄉","333"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("八德市","334"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("大溪鎮","335"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("復興鄉","336"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("大園鄉","337"); ctr=ctr+1; } 
if(num=="6") { document.form.address.options[ctr]=new Option("蘆竹鄉","338"); ctr=ctr+1; } 
/*苗栗縣*/
if(num=="7") { document.form.address.options[ctr]=new Option("竹南鎮","350"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("頭份鎮","351"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("三灣鄉","352"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("南庄鄉","353"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("獅潭鄉","354"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("後龍鎮","356"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("通霄鎮","357"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("苑裡鎮","358"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("苗栗市","360"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("造橋鄉","361"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("頭屋鄉","362"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("公館鄉","363"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("大湖鄉","364"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("泰安鄉","365"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("銅鑼鄉","366"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("三義鄉","367"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("西湖鄉","368"); ctr=ctr+1; } 
if(num=="7") { document.form.address.options[ctr]=new Option("卓蘭鎮","369"); ctr=ctr+1; }
/*臺中市*/ 
if(num=="8") { document.form.address.options[ctr]=new Option("中　區","400"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("東　區","401"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("南　區","402"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("西　區","403"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("北　區","404"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("北屯區","406"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("西屯區","407"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("南屯區","408"); ctr=ctr+1; } 
/*臺中縣*/
if(num=="8") { document.form.address.options[ctr]=new Option("太平區","411"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("大里區","412"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("霧峰區","413"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("烏日區","414"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("豐原區","420"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("后里區","421"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("石岡區","422"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("東勢區","423"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("和平區","424"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("新社區","426"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("潭子區","427"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("大雅區","428"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("神岡區","429"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("大肚區","432"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("沙鹿區","433"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("龍井區","434"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("梧棲區","435"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("清水區","436"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("大甲區","437"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("外埔區","438"); ctr=ctr+1; } 
if(num=="8") { document.form.address.options[ctr]=new Option("大安區","439"); ctr=ctr+1; }
/*彰化縣*/ 
if(num=="10") { document.form.address.options[ctr]=new Option("彰化市","500"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("芬園鄉","502"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("花壇鄉","503"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("秀水鄉","504"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("鹿港鎮","505"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("福興鄉","506"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("線西鄉","507"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("和美鎮","508"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("伸港鄉","509"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("員林鎮","510"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("社頭鄉","511"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("永靖鄉","512"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("埔心鄉","513"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("溪湖鎮","514"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("大村鄉","515"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("埔鹽鄉","516"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("田中鎮","520"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("北斗鎮","521"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("田尾鄉","522"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("埤頭鄉","523"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("溪州鄉","524"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("竹塘鄉","525"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("二林鎮","526"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("大城鄉","527"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("芳苑鄉","528"); ctr=ctr+1; } 
if(num=="10") { document.form.address.options[ctr]=new Option("二水鄉","530"); ctr=ctr+1; } 
/*南投縣*/
if(num=="11") { document.form.address.options[ctr]=new Option("南投市","540"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("中寮鄉","541"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("草屯鎮","542"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("國姓鄉","544"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("埔里鎮","545"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("仁愛鄉","546"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("名間鄉","551"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("集集鎮","552"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("水里鄉","553"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("魚池鄉","555"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("信義鄉","556"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("竹山鎮","557"); ctr=ctr+1; } 
if(num=="11") { document.form.address.options[ctr]=new Option("鹿谷鄉","558"); ctr=ctr+1; } 
/*嘉義縣市*/
if(num=="12") { document.form.address.options[ctr]=new Option("嘉義市","600"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("番路鄉","602"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("梅山鄉","603"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("竹崎鄉","604"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("阿里山","605"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("中埔鄉","606"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("大埔鄉","607"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("水上鄉","608"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("鹿草鄉","611"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("太保市","612"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("朴子市","613"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("東石鄉","614"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("六腳鄉","615"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("新港鄉","616"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("民雄鄉","621"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("大林鎮","622"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("溪口鄉","623"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("義竹鄉","624"); ctr=ctr+1; } 
if(num=="12") { document.form.address.options[ctr]=new Option("布袋鎮","625"); ctr=ctr+1; } 
/*雲林縣*/
if(num=="13") { document.form.address.options[ctr]=new Option("斗南鎮","630"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("大埤鄉","631"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("虎尾鎮","632"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("土庫鎮","633"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("褒忠鄉","634"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("東勢鄉","635"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("台西鄉","636"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("崙背鄉","637"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("麥寮鄉","638"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("斗六市","640"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("林內鄉","643"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("古坑鄉","646"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("莿桐鄉","647"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("西螺鎮","648"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("二崙鄉","649"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("北港鎮","651"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("水林鄉","652"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("口湖鄉","653"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("四湖鄉","654"); ctr=ctr+1; } 
if(num=="13") { document.form.address.options[ctr]=new Option("元長鄉","655"); ctr=ctr+1; } 
/*臺南市*/
if(num=="14") { document.form.address.options[ctr]=new Option("中西區","700"); ctr=ctr+1; } 
if(num=="14") { document.form.address.options[ctr]=new Option("東　區","701"); ctr=ctr+1; } 
if(num=="14") { document.form.address.options[ctr]=new Option("南　區","702"); ctr=ctr+1; } 
if(num=="14") { document.form.address.options[ctr]=new Option("北　區","704"); ctr=ctr+1; } 
if(num=="14") { document.form.address.options[ctr]=new Option("安平區","708"); ctr=ctr+1; } 
if(num=="14") { document.form.address.options[ctr]=new Option("安南區","709"); ctr=ctr+1; } 
/*臺南縣*/
if(num=="15") { document.form.address.options[ctr]=new Option("永康市","710"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("歸仁鄉","711"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("新化鎮","712"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("左鎮鄉","713"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("玉井鄉","714"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("楠西鄉","715"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("南化鄉","716"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("仁德鄉","717"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("關廟鄉","718"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("龍崎鄉","719"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("官田鄉","720"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("麻豆鎮","721"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("佳里鎮","722"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("西港鄉","723"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("七股鄉","724"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("將軍鄉","725"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("學甲鎮","726"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("北門鄉","727"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("新營市","730"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("後壁鄉","731"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("白河鎮","732"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("東山鄉","733"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("六甲鄉","734"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("下營鄉","735"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("柳營鄉","736"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("鹽水鎮","737"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("善化鎮","741"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("新市鄉","741"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("大內鄉","742"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("山上鄉","743"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("新市鄉","744"); ctr=ctr+1; } 
if(num=="15") { document.form.address.options[ctr]=new Option("安定鄉","745"); ctr=ctr+1; }
/*高雄市*/
if(num=="16") { document.form.address.options[ctr]=new Option("新興區","800"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("前金區","801"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("苓雅區","802"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("鹽埕區","803"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("鼓山區","804"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("旗津區","805"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("前鎮區","806"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("三民區","807"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("楠梓區","811"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("小港區","812"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("左營區","813"); ctr=ctr+1; } 
/*高雄市*/
if(num=="16") { document.form.address.options[ctr]=new Option("仁武區","814"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("大社區","815"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("岡山區","820"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("路竹區","821"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("阿蓮區","822"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("田寮區","823"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("燕巢區","824"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("橋頭區","825"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("梓官區","826"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("彌陀區","827"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("永安區","828"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("湖內區","829"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("鳳山區","830"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("大寮區","831"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("林園區","832"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("鳥松區","833"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("大樹區","840"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("旗山區","842"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("美濃區","843"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("六龜區","844"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("內門區","845"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("杉林區","846"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("甲仙區","847"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("桃源區","848"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("三民區","849"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("茂林區","851"); ctr=ctr+1; } 
if(num=="16") { document.form.address.options[ctr]=new Option("茄萣區","852"); ctr=ctr+1; } 
/*澎湖縣*/
if(num=="18") { document.form.address.options[ctr]=new Option("馬公市","880"); ctr=ctr+1; } 
if(num=="18") { document.form.address.options[ctr]=new Option("西嶼鄉","881"); ctr=ctr+1; } 
if(num=="18") { document.form.address.options[ctr]=new Option("望安鄉","882"); ctr=ctr+1; } 
if(num=="18") { document.form.address.options[ctr]=new Option("七美鄉","883"); ctr=ctr+1; } 
if(num=="18") { document.form.address.options[ctr]=new Option("白沙鄉","884"); ctr=ctr+1; } 
if(num=="18") { document.form.address.options[ctr]=new Option("湖西鄉","885"); ctr=ctr+1; } 
/*屏東縣*/
if(num=="19") { document.form.address.options[ctr]=new Option("屏東市","900"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("三地門","901"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("霧台鄉","902"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("瑪家鄉","903"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("九如鄉","904"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("里港鄉","905"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("高樹鄉","906"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("鹽埔鄉","907"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("長治鄉","908"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("麟洛鄉","909"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("竹田鄉","911"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("內埔鄉","912"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("萬丹鄉","913"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("潮州鎮","920"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("泰武鄉","921"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("來義鄉","922"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("萬巒鄉","923"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("崁頂鄉","924"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("新埤鄉","925"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("南州鄉","926"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("林邊鄉","927"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("東港鎮","928"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("琉球鄉","929"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("佳冬鄉","931"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("新園鄉","932"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("枋寮鄉","940"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("枋山鄉","941"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("春日鄉","942"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("獅子鄉","943"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("車城鄉","944"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("牡丹鄉","945"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("恆春鎮","946"); ctr=ctr+1; } 
if(num=="19") { document.form.address.options[ctr]=new Option("滿州鄉","947"); ctr=ctr+1; } 
/*臺東縣*/
if(num=="20") { document.form.address.options[ctr]=new Option("台東市","950"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("綠島鄉","951"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("蘭嶼鄉","952"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("延平鄉","953"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("卑南鄉","954"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("鹿野鄉","955"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("關山鎮","956"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("海端鄉","957"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("池上鄉","958"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("東河鄉","959"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("成功鎮","961"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("長濱鄉","962"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("太麻里","963"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("金峰鄉","964"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("大武鄉","965"); ctr=ctr+1; } 
if(num=="20") { document.form.address.options[ctr]=new Option("達仁鄉","966"); ctr=ctr+1; } 
/*花蓮縣*/
if(num=="21") { document.form.address.options[ctr]=new Option("花蓮市","970"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("新城鄉","971"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("秀林鄉","972"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("吉安鄉","973"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("壽豐鄉","974"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("鳳林鎮","975"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("光復鄉","976"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("豐濱鄉","977"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("瑞穗鄉","978"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("萬榮鄉","979"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("玉里鎮","981"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("卓溪鄉","982"); ctr=ctr+1; } 
if(num=="21") { document.form.address.options[ctr]=new Option("富里鄉","983"); ctr=ctr+1; } 
/*金門縣*/
if(num=="22") { document.form.address.options[ctr]=new Option("金沙鎮","890"); ctr=ctr+1; } 
if(num=="22") { document.form.address.options[ctr]=new Option("金湖鎮","891"); ctr=ctr+1; } 
if(num=="22") { document.form.address.options[ctr]=new Option("金寧鄉","892"); ctr=ctr+1; } 
if(num=="22") { document.form.address.options[ctr]=new Option("金城鎮","893"); ctr=ctr+1; } 
if(num=="22") { document.form.address.options[ctr]=new Option("烈嶼鄉","894"); ctr=ctr+1; } 
if(num=="22") { document.form.address.options[ctr]=new Option("烏坵鄉","896"); ctr=ctr+1; }
/*連江縣*/
if(num=="23") { document.form.address.options[ctr]=new Option("南竿鄉","209"); ctr=ctr+1; } 
if(num=="23") { document.form.address.options[ctr]=new Option("北竿鄉","210"); ctr=ctr+1; } 
if(num=="23") { document.form.address.options[ctr]=new Option("莒光鄉","211"); ctr=ctr+1; } 
if(num=="23") { document.form.address.options[ctr]=new Option("東引鄉","212"); ctr=ctr+1; } 
/*南海諸島*/
if(num=="24") { document.form.address.options[ctr]=new Option("東　沙","817"); ctr=ctr+1; }
if(num=="24") { document.form.address.options[ctr]=new Option("南　沙","819"); ctr=ctr+1; }
/*釣魚台列嶼*/
if(num=="25") { document.form.address.options[ctr]=new Option("釣魚台列嶼","290"); ctr=ctr+1; }

document.form.address.length=ctr;
document.form.address.options[0].selected=true;
} 

function address_operate(){
	var city = $('.sel_city :selected').text();
	var country = $('.sel_country :selected').text();
	var send_no = $('.sel_country :selected').val();
	$("input[value='code']").val(send_no);
	var address = send_no+city+country;
	$("#mv019").val(address);
}
</SCRIPT>
<script type="text/javascript">
function pali08add(obj){ //名稱新增
 window.open('<?php echo base_url()?>index.php/pal/pali08/addform')
}
</script>
<script>
/***Talence 更新自動focus***/
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '65')){  //tab1
		setTimeout(function() {
			$('input[name="mv007"]').focus();
		}, 100);
	}
	if(event.altKey && (keycode == '66')){  //tab2
		setTimeout(function() {
			$('#mv015').focus();
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
});
</script>