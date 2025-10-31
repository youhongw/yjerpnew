<script type="text/javascript"> 	   //開視窗  員工 
	$(document).ready(function(){ 	   
	$("#Showpalq01a").click(function() { 	   
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
	message: $('#divFpalq01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpalq01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/palq01a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpalq01a(sma001,sma002,sma003,sma004,sma005) {
   
	form.palq01a.value=sma001;
	form.te004.value=sma005;
	var oSpan = document.getElementById("palq01adisp");
		oSpan.innerHTML = sma002;	
	document.form.palq01a.focus();    	
	return palq01a;
}
//--></script>

<script type="text/javascript"> 	   //開視窗 一定要寫 1 部門
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
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq05a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcmsq05a(sma001,sma002,sma003,sma004) {	
	form.cmsq05a.value=sma001;
	form.mb004.value=sma004;
	var oSpan = document.getElementById("cmsq05adisp");
		oSpan.innerHTML = sma002+' '+sma003;
	//var oSpan1 = document.getElementById("cmsq05adisp1");
	//	oSpan1.innerHTML = sma003;
		 
	document.form.cmsq05a.focus();    
	return cmsq05a;	
}
//--></script>

<!-- 開視窗 cmsq05a 18 交易幣別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq05a").click(function() { 	   
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
	message: $('#divFcmsq05a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq05a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq05a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq05a(sma001,sma002) {
	form.cmsq05a.value=sma001;
	var oSpan = document.getElementById("cmsq05adisp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq05a.focus();    
	return cmsq05a;
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

function startkey(oInput){         //不更新網頁 key 庫別代號函數 檢查資料重複
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi03/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

function showpalq01a(sText){   //不更新網頁 32 員工代號 
	var oSpan = document.getElementById("palq01adisp");
	//console.log('kkk');
	var str=(sText.split(";",3));
	$('input[name=\'te099\']').val(str[0]);
	$('input[name=\'te004\']').val(str[2]);
	//oSpan.innerHTML = "<span style='color:black'>"+jQuery.parseJSON(sText).mv002+"</span>"; 	
	if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	}
}

function startpalq01a(oInput){         //不更新網頁 32 員工代號
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    //var palq01a = $('#tf001').val().replace(/\D/g,'');
    //var date = $('#tf002').val().replace(/\D/g,'');
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/palq01a/datapalq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	console.log(sUrl);
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpalq01a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq05a(sText){   //不更新網頁 18  部門 
	var oSpan = document.getElementById("cmsq05adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,交易幣別 -->
function startcmsq05a(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
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


</script>
<!-- 不更新網頁 檢查 select 欄位 確認碼  -->	
<script type="text/javascript"><!--       
 function addsel(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	 // alert(oInput.value);
	     zamt3=$('input[name=\'md003\']').val();
	      zamt4=$('input[name=\'md004\']').val();
		  zamt5=$('input[name=\'md005\']').val();
		  zamt6=$('input[name=\'md006\']').val();
		  zamt7=$('input[name=\'md007\']').val();
		  zamt8=$('input[name=\'md008\']').val();
		  zamt9=$('input[name=\'md009\']').val();
		  zamt10=$('input[name=\'md010\']').val();
		  zamt11=$('input[name=\'md011\']').val();
		  zamt12=$('input[name=\'md012\']').val();
	
		  zamt13=parseInt(zamt3)+parseInt(zamt4)+parseInt(zamt5)+parseInt(zamt6)+parseInt(zamt7)+parseInt(zamt8)+parseInt(zamt9)+parseInt(zamt10)+parseInt(zamt11)+parseInt(zamt12);
	      form.md013.value=Math.round(zamt13);
	 return md013;
}

//--></script>
<!-- 不更新網頁,檢查欄位  時間是否有誤  -->
<script type="text/javascript"><!--       //檢查欄位空白
 function checktime(oInput){         //不更新網頁 2 商品
      var str=oInput.value;
	  $("#timedisp").html("<span style='color:red'></span>");
	//  alert(str.substr(0,2));
	 if(str.substr(0,2)>'24'){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#timedisp").html("<span style='color:red'>無此小時,請重輸入.</span>");	
		return;
	}
	if(str.substr(2,2)>'60'){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#timedisp").html("<span style='color:red'>無此分鐘,請重輸入.</span>");	
		return;
	}
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#timedisp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
	 
}

//--></script>
<!-- 不更新網頁,檢查欄位空白  -->
<script type="text/javascript"><!--       //檢查欄位空白
 function checkspace(oInput){         //不更新網頁 2 商品
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#spacedisp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
	 
}

//--></script>