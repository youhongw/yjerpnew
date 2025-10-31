function request(reqURL,process,att){
	//alert(reqURL);
	var xmlHttp = false;//开始初始化XMLHttpRequest对象
	if(window.XMLHttpRequest){ //Mozilla 浏览器
		xmlHttp = new XMLHttpRequest();
		if(xmlHttp.overrideMimeType) {//设置MiME类别
			xmlHttp.overrideMimeType('text/xml');
		}
	}
	else if (window.ActiveXObject) { // IE浏览器
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}
	if(!xmlHttp) { // 异常，创建对象实例失败
		alert("不能创建XMLHttpRequest对象实例.");
		return false;
	}
	xmlHttp.open('GET',reqURL,'true');
	xmlHttp.onreadystatechange = function handleStateChange(){
		if(xmlHttp.readyState == 2) {
			//document.getElementById("tishi").innerHTML = "正在载入......";
		}
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				//alert(xmlHttp.responseText);
				process(xmlHttp.responseText,att);
			}
		}
	}
	xmlHttp.send(null);
}
function testt(str,att){
	document.getElementById(att).innerHTML=str;
}

