<!-- 開視窗 bomq03a43 組合單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showbomq03a43").click(function() { 	   
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
	message: $('#divFbomq03a43'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFbomq03a43" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/bomq03a/display3" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addbomq03a43(std001,stf002) {	
	form.bomq03a43.value=std001;
	var oSpan = document.getElementById("bomq03a43disp");
		oSpan.innerHTML = stf002;
	document.form.bomq03a43.focus();    
	return bomq03a43;	
}
//--></script>

<script type="text/javascript"> 	   //開視窗  品號單頭  td006 invq02a1
	$(document).ready(function(){ 	   
	$("#Showinvq02a1").click(function() { 	   
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
	message: $('#divFinvq02a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFinvq02a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq02a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 
<!-- 開視窗 品號,品名, 規格,單位 -->
<script type="text/javascript"><!--
  function addinvq02a1(sma001,sma002,sma003,sma004) {
   
	form.invq02a1.value=sma001;
	form.td004disp.value=sma002;
	form.td004disp1.value=sma003;
	form.td005.value=sma004;

	var oSpan = document.getElementById("invq02a1disp");
		oSpan.innerHTML = sma002;	
	document.form.invq02a1.focus();    	
	return invq02a1;
}
//--></script>

<!-- 開視窗 bomc02a 前置單據 -->
<script type="text/javascript"> 	 
   
	$(document).ready(function(){ 	   

	$("#Showbomc02a").click(function() { 
	
	//var zno=$('input[name=\'invq02a1\']').val(); 
   // alert(zno);	
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
	message: $('#divFormbomc02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
	  
	<div id="divFormbomc02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/bomc02a/display/".$invq02a1.'/'.$td007 allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<!--1主件品號,2組成用量,  std007 成品數量, sma003庫別,std001 組合別  sma001 主件品號            -->
<script type="text/javascript">
  function addbomc02a(sma001,sma002,sma003) {
  //  var oSpan = document.getElementById("cmsq06adisp");
	//	oSpan.innerHTML = 'testtesttest';
    var std007=$('input[name=\'tf007\']').val();
    var std001=$('input[name=\'bomq03a43\']').val();
    var stf002=$('input[name=\'tf002\']').val();
	var ste007=sma003;
       form.td004.value=sma001;		
	//   alert(sma001+std007+sma003+std001);
	url = '<?php echo base_url()?>index.php/bom/bomi06/copybefore/'+encodeURIComponent(sma001)+'/'+std007+'/'+sma003+'/'+std001+'/'+stf002; 
	location = url;
	return true;
}
</script>

<!-- 開視窗 cmsq03a 25 庫別 入庫庫別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq03a1").click(function() { 	   
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
	message: $('#divFcmsq03a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq03a1" style="display:none"> 	   
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


<!-- 不更新網頁帶出資料  -->
<script language="javascript"  >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}


function shbomq03a43(sText){                 //不更新網頁 31  組合單別 td001
	var oSpan = document.getElementById("bomq03a43disp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 bomq03a43  組合單別 -->        
function stbomq03a43(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#td001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
  //  alert(test);
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/bomq03a/databomq03a43/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  shbomq03a43(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showinvq02a1(sText){   //不更新網頁 67 主件品號
	var oSpan = document.getElementById("invq02a1disp");
	
	 var str=(sText.split(";",3));
		form.td004disp.value=str[0];
		form.td004disp1.value=str[1];
		form.td005.value=str[2];
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startinvq02a1(oInput){         //不更新網頁 67  主件品號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	//alert(oInput.value);
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/invq02a/checkinvq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showinvq02a1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁帶出資料  組合單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'tf012\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  // alert(zno1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("tf002").value=zno3;
	 
	 }	

<!-- 不更新網頁 計算單號 組合單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#td006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'bomq03a43\']').val();
	 var zstr=$('input[name=\'tf012\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
	 
    //  alert(zstr);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/bom/bomi06/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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

function shcmsq03a1a(sText){   //不更新網頁 td010 庫別
	var oSpan = document.getElementById("cmsq03adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 cmsq02a 庫別 -->
function stcmsq03a1a(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta010disp").html("不可空白.");	
	//	return;
	//}
	//建立非同步請求
  //  alert(oInput.value);
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq03a/checkcmsq03a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  shcmsq03a1a(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}
function showcmsq03a(sText,n){   //不更新網頁 6  庫別 
	//var oSpan = document.getElementById("te007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	 var nn=n-1;
	 var num = sText.length;
	 var sysma200=$('input[name=\'sysma200\']').val();
	// alert(nn);
	// alert(num);
	// alert(sysma200);
	 if (num>sysma200){
          $('input[name=\'order_product[' + nn + '][te007disp]\']').val(sText); }  
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
	//var oSpan = document.getElementById("te007disp0");
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
     $('input[name=\'order_product[' + nn + '][te004disp]\']').val(str[0]);  
     $('input[name=\'order_product[' + nn + '][te004disp1]\']').val(str[1]);
	 $('input[name=\'order_product[' + nn + '][te005]\']').val(str[2]);}
	 
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
	  var selval = document.getElementById('tf010').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	  if (selval==0) {
	     oSpan.innerHTML = "<span style='color:black'> 核准</span>";}
        else
		{ oSpan.innerHTML = "<span style='color:black'> 未核</span>";}
	 if (selval==2) {
	     oSpan.innerHTML = "<span style='color:black'> 作廢</span>";}
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
var product_row = 15; vproduct_row = 14;

function addItem() {
		html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][te001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][te002]" value="" />';
     html += '    <input type="hidden" name="order_product[' + product_row + '][te010]" value="Y" />';		
//	html += '    <td class="left"><input type="text"  tabIndex="20"  name="order_product[' + product_row + '][te003]" value="0" size="6" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="41" id="te004'+ product_row+'"  onchange="startinvq02a(this,product_row)"  name="order_product[' + product_row + '][te004]" value="" size="20" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input readonly="value"    onKeyPress="keyFunction()" type="text" id="te004disp"  name="order_product[' + product_row + '][te004disp]" value=""  style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input readonly="value"  onKeyPress="keyFunction()" type="text" id="te004disp1"   name="order_product[' + product_row + '][te004disp1]" value=""  size="30" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input  onKeyPress="keyFunction()"  type="text" id="te005"   name="order_product[' + product_row + '][te005]" value="" size="6"  /></td>';
	html += '    <td class="left"><input readonly="value" onKeyPress="keyFunction()" type="text"  id="te003" name="order_product[' + product_row + '][te003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="43" id="te007'+ product_row+'"  onchange="startcmsq03a(this,product_row)"   name="order_product[' + product_row + '][te007]" value="" size="10" style="background-color:#E7EFEF" /></td>';	
	html += '    <td class="left"><input readonly="value" type="text"   id="te007disp'+ product_row+'"   name="order_product[' + product_row + '][te007disp]" value="" size="10" style="background-color:#EBEBE4"  /></td>';	
	

	html += '    <td class="center"><input type="text" tabIndex="46"  id="te008" onKeyPress="keyFunction()"  name="order_product[' + product_row + '][te008]" value="1" size="10" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text" tabIndex="47"  id="te011" onKeyPress="keyFunction()" name="order_product[' + product_row + '][te011]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="center"><input type="text" tabIndex="48"  id="te012" onKeyPress="keyFunction()" name="order_product[' + product_row + '][te012]" value="0" size="10" style="text-align:right" /></td>';
	
		
	html += '    <td class="left"><input type="text" id="te009" tabIndex="59"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][te009]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html);  
	 
	
	   //下拉視窗 網頁不更新  mb001 te004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][te004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('te004').value;
			   
			 if (product_row == 1 ) { smb001= $('#te0040').val(); }
			 if (product_row == 2 ) { smb001= $('#te0041').val(); }
			 if (product_row == 3 ) { smb001= $('#te0042').val(); }
		     if (product_row == 4 ) { smb001= $('#te0043').val(); }
			 if (product_row == 5 ) { smb001= $('#te0044').val(); }
			 if (product_row == 6 ) { smb001= $('#te0045').val(); }
			 if (product_row == 7 ) { smb001= $('#te0046').val(); }
		     if (product_row == 8 ) { smb001= $('#te0047').val(); }
			 if (product_row == 9 ) { smb001= $('#te0048').val(); }
			 if (product_row == 10 ) { smb001= $('#te0049').val(); }	
			 if (product_row == 11 ) { smb001= $('#te00410').val(); }
			 if (product_row == 12 ) { smb001= $('#te00411').val(); }
			 if (product_row == 13 ) { smb001= $('#te00412').val(); }
		     if (product_row == 14 ) { smb001= $('#te00413').val(); }
			 if (product_row == 15 ) { smb001= $('#te00414').val(); }
			 if (product_row == 16 ) { smb001= $('#te00415').val(); }
			 if (product_row == 17 ) { smb001= $('#te00416').val(); }
		     if (product_row == 18 ) { smb001= $('#te00417').val(); }
			 if (product_row == 19 ) { smb001= $('#te00418').val(); }
			 if (product_row == 20 ) { smb001= $('#te00419').val(); }	
             if (product_row == 21 ) { smb001= $('#te00420').val(); }
			 if (product_row == 22 ) { smb001= $('#te00421').val(); }
			 if (product_row == 23 ) { smb001= $('#te00422').val(); }
		     if (product_row == 24 ) { smb001= $('#te00423').val(); }
			 if (product_row == 25 ) { smb001= $('#te00424').val(); }
			 if (product_row == 26 ) { smb001= $('#te00425').val(); }
			 if (product_row == 27 ) { smb001= $('#te00426').val(); }
		     if (product_row == 28 ) { smb001= $('#te00427').val(); }
			 if (product_row == 29 ) { smb001= $('#te00428').val(); }
			 if (product_row == 30 ) { smb001= $('#te00429').val(); }	
			//   smb001=$("#te004"+(product_row-1)).val();
			 //    alert(smb001);
			// alert('test-js1');
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookup/'+encodeURIComponent(smb001), 
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
                
			      $('input[name=\'order_product[' + n + '][te004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][te004disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][te004disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][te005]\']').val(ui.item.value4);
			     $('input[name=\'order_product[' + n + '][te007]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][te007disp]\']').val(ui.item.value6);
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });    
	  
	//下拉視窗 網頁不更新  te007  交貨庫別輸入
	
    $('input[name=\'order_product[' + product_row + '][te007]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('te007').value;
			   
			 if (product_row == 1 ) { smb001= $('#te0070').val(); }
			 if (product_row == 2 ) { smb001= $('#te0071').val(); }
			 if (product_row == 3 ) { smb001= $('#te0072').val(); }
		     if (product_row == 4 ) { smb001= $('#te0073').val(); }
			 if (product_row == 5 ) { smb001= $('#te0074').val(); }
			 if (product_row == "6" ) { smb001= $('#te0075').val(); }
			 if (product_row == "7" ) { smb001= $('#te0076').val(); }
		     if (product_row == "8" ) { smb001= $('#te0077').val(); }
			 if (product_row == "9" ) { smb001= $('#te0078').val(); }
			 if (product_row == "10" ) { smb001= $('#te0079').val(); }	
			 if (product_row == "11" ) { smb001= $('#te00710').val(); }
			 if (product_row == "12" ) { smb001= $('#te00711').val(); }
			 if (product_row == "13" ) { smb001= $('#te00712').val(); }
		     if (product_row == "14" ) { smb001= $('#te00713').val(); }
			 if (product_row == "15" ) { smb001= $('#te00714').val(); }
			 if (product_row == "16" ) { smb001= $('#te00715').val(); }
			 if (product_row == "17" ) { smb001= $('#te00716').val(); }
		     if (product_row == "18" ) { smb001= $('#te00717').val(); }
			 if (product_row == "19" ) { smb001= $('#te00718').val(); }
			 if (product_row == "20" ) { smb001= $('#te00719').val(); }	
             if (product_row == "21" ) { smb001= $('#te00720').val(); }
			 if (product_row == "22" ) { smb001= $('#te00721').val(); }
			 if (product_row == "23" ) { smb001= $('#te00722').val(); }
		     if (product_row == "24" ) { smb001= $('#te00723').val(); }
			 if (product_row == "25" ) { smb001= $('#te00724').val(); }
			 if (product_row == "26" ) { smb001= $('#te00725').val(); }
			 if (product_row == "27" ) { smb001= $('#te00726').val(); }
		     if (product_row == "28" ) { smb001= $('#te00727').val(); }
			 if (product_row == "29" ) { smb001= $('#te00728').val(); }
			 if (product_row == "30" ) { smb001= $('#te00729').val(); }	
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/moc/moci02/lookupa/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][te007]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][te007disp]\']').val(ui.item.value2);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	   
	
     
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][te008]\'],input[name=\'order_product[' + product_row + '][te011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
    
		
	//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
	
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][te003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][te003]\']').val(num_2);  
	
		
	});
	
	
	//取替代件
	$('input[name=\'order_product[' + product_row + '][te009]\']').focus(function(){
	//	totalSum1();
	});

	//備註,品號
//	$('input[name=\'order_product[' + product_row + '][te017]\']').blur(function(){
//		$('input[name=\'order_product[' + product_row + '][te003]\']').focus();
//	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();

	product_row++;
}
//-->
</script>
<script type="text/javascript"><!--  //合計金額

function totalSum1() {

     var sumTotal = 0;
	var sumTotal1 = 0;
	var sumQty = 0;
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
	 $(".total_price1").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal1 += parseFloat(this.value);			
		}
    });
	
	$(".total_qty").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumQty += parseFloat(this.value);			
		}
    });
    
    $("#sum_total").html(sumTotal.toFixed(1));

  	form.tg028.value=Math.round(sumTotal);	  //原幣貨款
	 var tax=$('input[name=\'tg030\']').val();  //稅率
	 var rate=$('input[name=\'tg008\']').val();  //匯率
	form.tg019.value=Math.round(sumTotal*tax);  //原幣稅額
	form.tg031.value=Math.round(sumTotal1*rate);	  //本幣貨款
	form.tg032.value=Math.round(sumTotal1*rate*tax);  //本幣稅額
	var sumTax =Math.round(sumTotal*tax);
	var sumTax1 =Math.round(sumTotal1*rate*tax);
	//課稅別
	if ($('select[name=\'tg010\']').val()=='1') {form.tg028.value=Math.round(sumTotal-sumTax);sumTotal=Math.round(sumTotal-sumTax);}
	if ($('select[name=\'tg010\']').val()=='1') {form.tg031.value=Math.round(sumTotal1-sumTax1);sumTotal1=Math.round(sumTotal1-sumTax1);}
	
	var sumTot =Math.round(sumTotal+sumTax);
  //  $("#sum_tax").html(sumTax.toFixed(1));	
	$("#sum_tot").html(sumTot.toFixed(1));	
	var sumTot1 =Math.round(sumTotal1+sumTax1);
  //  $("#sum_tax1").html(sumTax1.toFixed(1));	
	$("#sum_tot1").html(sumTot1.toFixed(1));	
	form.tg026.value=Math.round(sumQty);	
}
//--></script>

 <!-- 明細 品號開視窗   -->  