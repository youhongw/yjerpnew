<!-- 不更新網頁 -->
<script type="text/javascript"><!-- 

var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁  共用 
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
	//	alert(xmlHttp);
}
      
function showResult5(sText){   //不更新網頁 5  類別代號 檢查資料重複
	var oSpan = document.getElementById("ma002disp");
		oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#ma002disp").html("類別代號可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	  if (sText) { 
	   $("#ma002disp").html("品號重複!");
	   oSpan.style.color = "#ff0000";
	   document.getElementById("ma002").focus();
	 } 
}

function startCheck5(oInput){         //不更新網頁 5 品號
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
		$("#ma002disp").html("欄位不可空白.");      		
		return;
	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi01/checkdata5/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
</script>

 <script type="text/javascript"><!--       //檢查欄位空白
 function checkspace2(oInput){         //不更新網頁 2 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
    //if(!oInput.value){
	//	oInput.focus();    //聚焦到的輸入框
		$("#ma001disp").html("不可空白.");	
	//	return;
//	}
}
</script>