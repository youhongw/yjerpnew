<!-- 開視窗 purq04a34 付款單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showactq02a").click(function() { 	   
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
	message: $('#divFactq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  
	<div id="divFactq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq02a/display91" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addactq02a91(sma001,sma002) {	
	form.actq02a.value=sma001;
	var oSpan = document.getElementById("actq02adisp");
		oSpan.innerHTML = sma002;
	document.form.actq02a.focus();    
	return actq02a;	
}
//--></script>

<script type="text/javascript"> 	   //開視窗  科目代號 invi02
	$(document).ready(function(){ 	   
	$("#Showactq03a").click(function() { 	   
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
	message: $('#divFactq03a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFactq03a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a(sma001,sma002) {
   
	form.actq03a.value=sma001;
	var oSpan = document.getElementById("actq03adisp");
		oSpan.innerHTML = sma002;	
	document.form.actq03a.focus();    	
	return actq03a;
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
	url = '<?=base_url() ?>index.php/act/acti10/copybefore/'+encodeURIComponent(sma001)+'/'+encodeURIComponent(sma002); 
	location = url;
	return true;
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


function showactq02a(sText){                 //不更新網頁 31  請購單別 tc001
	var oSpan = document.getElementById("actq02adisp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 purq04a33 採購單別 -->        
function startactq02a(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#tc001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
   
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/acrq01a/dataactq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showactq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


<!-- 不更新網頁帶出資料  收款單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'ta003\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	//   alert(zno1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("ta002").value=zno3;
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

<!-- 不更新網頁 計算單號 收款單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#tc006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'actq02a\']').val();
	 var zstr=$('input[name=\'ta003\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
   //   alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/act/acti10/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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


function showactq03a(sText){   //不更新網頁 32 客戶代號 
	var oSpan = document.getElementById("actq03adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startactq03a(oInput){         //不更新網頁 32 客戶代號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/actq03a/checkactq03a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showactq03a(xmlHttp.responseText);	//顯示服務器結果		
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

<!-- 不更新網頁 檢查 select 欄位 確認碼  -->	
<script type="text/javascript"><!--       
 function checkbalance(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示 true 1050801
	 var vta007=$('input[name=\'ta007\']').val();
	 var vta008=$('input[name=\'ta008\']').val();
	 
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	    if (vta007==vta008) {
	     return true;}
        else
		{ alert('借貸不平衡');return false;}
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
     html += '    <input type="hidden" name="order_product[' + product_row + '][tb016]" value="Y" />';
//	html += '    <td class="left"><input type="text"  tabIndex="20"  name="order_product[' + product_row + '][tb003]" value="0" size="6" /></td>';
	html += '    <td class="left"><select id="tb004"  class="total_dc" tabIndex="51" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb004]" ><option  value="1">借</option><option value="-1">貸</option></select></td>'; 
	
	html += '    <td class="left"><input type="text"  tabIndex="52" id="tb005'+ product_row+'"   name="order_product[' + product_row + '][tb005]" value="" size="12" style="text-align:left;background-color:#E7EFEF" /></td>';
	html += '    <td class="left"><input tabIndex="53"  onKeyPress="keyFunction()"  type="text" id="tb005disp"   name="order_product[' + product_row + '][tb005disp]" value="" size="12" /></td>';
	html += '    <td class="left"><input tabIndex="54"  onKeyPress="keyFunction()" type="text"  id="tb003" name="order_product[' + product_row + '][tb003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="55" id="tb006'+ product_row+'"   name="order_product[' + product_row + '][tb006]" value="" size="12" style="background-color:#E7EFEF"  /></td>';
	html += '    <td class="left"><input tabIndex="56"  onKeyPress="keyFunction()"  type="text" id="tb006disp"   name="order_product[' + product_row + '][tb006disp]" value="" size="12" style="background-color:#EBEBE4" /></td>';
	
	 html += '    <td class="right"><input  type="text" tabIndex="58"  id="tb013" name="order_product[' + product_row + '][tb013]" value="" size="10" /></td>';
     html += '    <td class="right"><input  type="text" tabIndex="59"  id="tb014" name="order_product[' + product_row + '][tb014]" value="" size="10" style="text-align:right" /></td>';
   
	html += '    <td class="right"><input   type="text" tabIndex="60" class="total_price"  name="order_product[' + product_row + '][tb015]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text"  tabIndex="61"  class="total_price1"  id="tb007" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb007]" value="0" size="10" style="text-align:right" /></td>';
	html += '   <input type="hidden"  class="total_price11"  name="order_product[' + product_row + '][tb0071]" value="0"  /> ';
	html += '   <input type="hidden"  class="total_price12"  name="order_product[' + product_row + '][tb0072]" value="0"  /> ';
	
	html += '    <td class="left"><input type="text" id="tb010" tabIndex="62" onclick="scwShow(this,event);"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb010]" value="" size="30" /></td>';
	html += '    <td class="left"><input type="text" id="tb011" tabIndex="63"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb011]" value="" size="10" /></td>';
	html += '    <td class="left"><input type="text" id="tb012" tabIndex="64"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tb012]" value="" size="20" /></td>';
	html += '  </tr>';		
    html += '</tbody>';
	 $('#row_count').val(parseInt(product_row)+1);
	 $('#order_product tfoot').before(html);  
	 
	
   	  //下拉視窗 網頁不更新  tb005 科目代號輸入
	
    $('input[name=\'order_product[' + product_row + '][tb005]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 
			   
			    vtj0= product_row - 1;
		       smb001= $('#tb005'+vtj0 ).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti10/lookupa/'+encodeURIComponent(smb001), 
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
			     $('input[name=\'order_product[' + n + '][tb005disp]\']').val(ui.item.value2);
			      $('input[name=\'order_product[' + n + '][tb013]\']').val(ui.item.value3);
				   $('input[name=\'order_product[' + n + '][tb014]\']').val(ui.item.value4);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	    	
	   	   //下拉視窗 網頁不更新  mb001 tb006 部門輸入
	
    $('input[name=\'order_product[' + product_row + '][tb006]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
         //   var vmb001=document.getElementById('tc004').value;
			    smb001= $('#tb006'+vtj0 ).val();
				
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/act/acti10/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tb006]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tb006disp]\']').val(ui.item.value2);
			     
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });   
		
    
	
	
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tb014]\'],input[name=\'order_product[' + product_row + '][tb015]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tb003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tb003]\']').val(num_2);
		
	});
	
	// 原幣金額
	$('input[name=\'order_product[' + product_row + '][tb015]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		      if ($(this).val()=='0')
		     $(this).val('');
	});
	
	// 原幣金額
	$('input[name=\'order_product[' + product_row + '][tb015]\']').focusout(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	 var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		 if ($(this).val()=='')
		   	  $(this).val('0');
	});
	
	//原幣copy 本幣test
	$('input[name=\'order_product[' + product_row + '][tb007]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb015]\']').val()*1*$('input[name=\'order_product[' + n + '][tb014]\']').val(); 
	
	//	var test1=$('select[name=\'order_product[' + n + '][tb004]\']').val();
	//	alert(product_row);
	//	alert(test1);
		if ($('select[name=\'order_product[' + n + '][tb004]\']').val()=='1') {
		$('input[name=\'order_product[' + n + '][tb0071]\']').val(input_1);$('input[name=\'order_product[' + n + '][tb0072]\']').val(0);} else {
		$('input[name=\'order_product[' + n + '][tb0072]\']').val(input_1);$('input[name=\'order_product[' + n + '][tb0071]\']').val(0);} 
	});	
	//原幣copy 本幣
	$('input[name=\'order_product[' + product_row + '][tb007]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var input_1=$('input[name=\'order_product[' + n + '][tb015]\']').val()*1*$('input[name=\'order_product[' + n + '][tb014]\']').val(); 
		//  $('input[name=\'order_product[' + n + '][tb0071]\']').val(input_1); 
	     $('input[name=\'order_product[' + n + '][tb007]\']').val(input_1); 
		totalSum1(product_row);
	});	
	
	//摘要
    $('input[name=\'order_product[' + product_row + '][tb010]\']').focus(function(){
	    var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	  
	 //	totalSum1();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;
}
//-->
</script>

<script type="text/javascript"><!--  //合計金額

function totalSum1(n) {

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
	//alert(n);
/*	$(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!= -1 ) {	
            if  (product_row1<30) {
			sumTotal += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb015]\']').val());}
            else 	{var product_row1 = 31; 
			sumTotal += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb015]\']').val());}		
		}
		product_row1++;
    });
	 
	//alert(sumTotal);
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!=1   ) {		    
			sumTotal1 += !isNaN(parseFloat($('input[name=\'order_product[' + product_row1 + '][tb015]\']').val()));			
		}
		product_row1++;
    });  */
	
	
	var product_row1 = 0; 
	$(".total_dc").each(function() {
		
		if(!isNaN(this.value) && this.value!=-1 ) {		    
		//	sumTotal2 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb007]\']').val());	
			   if  (product_row1<30) {
			sumTotal2 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb0071]\']').val());}
            else 	{var product_row1 = 30; 
			sumTotal2 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb0072]\']').val());}		
		}
		product_row1++;
	//	alert($('input[name=\'order_product[' + product_row1 + '][tb007]\']').val());
    });
	
	var product_row1 = 0; 
    $(".total_dc").each(function() {
		if(!isNaN(this.value) && this.value!=1 ) {		    
		//	sumTotal3 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb007]\']').val());		
		     if  (product_row1<30) {
			sumTotal3 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb0071]\']').val());}
            else 	{var product_row1 = 30; 
			sumTotal3 += parseFloat($('input[name=\'order_product[' + product_row1 + '][tb0072]\']').val());}	
		}
		product_row1++;
	//	alert($('input[name=\'order_product[' + product_row1 + '][tb007]\']').val());
    });
	//test
	 var sumDebit = 0;
    $(".total_price11").each(function() {
	//	alert(this.value);
		if(!isNaN(this.value) && this.value.length!=0) {
			sumDebit += parseFloat(this.value);
		}
    });
	 var sumDebit1 = 0;
    $(".total_price12").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumDebit1 += parseFloat(this.value);
		}
    });
	
  
  //  form.ta007.value=Math.round(sumTotal2);	  //本幣借方金額
	 form.ta007.value=Math.round(sumDebit);	 
	
  
    //  form.ta008.value=Math.round(sumTotal3);	  //本幣貸方金額
	  form.ta008.value=Math.round(sumDebit1);	 
	  
	  
	  
 // 	form.ta008.value=Math.round(sumTota2-sumTotal3);	  //本幣貸方金額
	var sumTot =Math.round(sumTotal-sumTotal1);
  	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal2-sumTotal3);
 	$("#sum_tot1").html(sumTot1.toFixed(1));	
	

		
}
//--></script>
 <!-- 明細 品號開視窗   -->  