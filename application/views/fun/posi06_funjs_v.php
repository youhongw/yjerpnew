<script type="text/javascript"> 	   //開視窗 一定要寫 1 廠別
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
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq02a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcmsq02a(sma001,sma002) {	
	form.cmsq02a.value=sma001;
	var oSpan = document.getElementById("cmsq02adisp");
		oSpan.innerHTML = sma002;
	document.form.cmsq02a.focus();    
	return cmsq02a;	
}
//--></script>

<script type="text/javascript"> 	   //開視窗  6 庫別 invi02
	$(document).ready(function(){ 	   
	$("#Showcmsq03a").click(function() { 	   
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
	message: $('#divFcmsq03a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq03a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq03a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq03a(sma001,sma002) {
	form.cmsq03a.value=sma001;
	var oSpan = document.getElementById("cmsq03adisp");
		oSpan.innerHTML = sma002;      	
	document.form.cmsq03a.focus();    
	return cmsq03a;
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

function showcmsq03a(sText){                 //不更新網頁 3 庫別   
	var oSpan = document.getElementById("cmsq03adisp");	
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}


function startcmsq03a(oInput){            //不更新網頁 3  庫別
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#cmsq03adisp").html("<span style='color:red'>欄位不可空白.</span>");			
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq03a/checkcmsq03a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq03a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
} 

<!-- 不更新網頁帶出資料  單號 門市代號-->
function showchkno1(sText){ 
      //  alert('test');
       if  (!sText) { sText=$('input[name=\'md001\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  
	   var zno3=parseInt(zno)+1;
	   document.getElementById("md002").value=zno3;
		
	 }	

<!-- 不更新網頁 計算單號 單號 -->	 
function chkno1(oInput){  
     // alert('test');
	 var zno='1';
	// alert(zno);
	 var zstr=$('input[name=\'md001\']').val();
	 //  alert(zstr);
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
      
	// alert(zymd);
	 
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pos/posi06/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	        //alert(test);
		   document.form.md001.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'md001\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length != 10) { 
		    document.form.md001.focus(); return md001;}	
}

</script>
<script type="text/javascript"><!--       //檢查欄位空白
 function checkspace(oInput){         //不更新網頁 2 商品
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	if(!oInput.value){
		oInput.focus();    //聚焦到用戶名的輸入框
		$("#spacedisp").html("<span style='color:red'>不可空白.</span>");	
		return;
	}
	 
}
</script>
