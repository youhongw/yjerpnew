<!-- 不更新網頁, 帶出資料  -->
<script language="javascript"   >
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

   function showkey(sText){   //不更新網頁 5 key  檢查資料重複 invi01-add
	 var oSpan = document.getElementById("keydisp");
	 oSpan.innerHTML = sText;		
	 if (!sText) { 
	   $("#keydisp").html("此資料可使用!");
	   oSpan.style.color = "#000000";
	 }	 
	 if (sText) { 
	   $("#keydisp").html("此資料重複!");
	   oSpan.style.color = "#ff0000";
	 //document.getElementById("ma002").focus();
	 } 
    }

function startkey(oInput){         //不更新網頁 key  檢查資料重複 invi01-add
	//首先判斷是否有輸入，沒有輸入直接返回，並提示	
 	if(!oInput.value){
	  //oInput.focus();    //聚焦到用戶名的輸入框
		$("#keydisp").html("欄位不可空白.");      		
		return;
	}
	
	//建立非同步請求    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/not/noti01/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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


<!-- 不更新網頁帶出資料  存款單號 -->
function showchkno1(sText){   
        console.log(sText);
       if  (!sText) { sText=$('input[name=\'tf011\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	        console.log(zno1);
			console.log(zno2);
	   var zno=zno1+zno2;
	   var zno3=parseInt(zno);
	   document.getElementById("tf002").value=zno3;
		
	 }	

<!-- 不更新網頁 計算單號 銷貨單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'tf001\']').val();
	 var zstr=$('input[name=\'tf011\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
	  console.log(zno);
      console.log(zymd);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/not/noti02/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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
</script>

<!--檢查欄位空白 -->
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

<script type="text/javascript"><!--    // 明細 新增 
var product_row = 0; 

function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
	html += '    <input type="hidden"  name="order_product[' + product_row + '][tg002]" value="" />';
	html += '	 <td class="left"><input type="text" tabIndex="17" id="tg003[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg003]" value="" size="10" readonly="readonly" /></td>';
	html += '	 <td class="left"><select tabIndex="18" id="tg004[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg004]" onchange="check_cash(this,' + product_row + ',this.value);" ><option value=\'1\'>1:現金</option><option value=\'2\'>2:轉帳</option></select></td>';
	html += '	 <td class="left"><input class="money" type="text"  tabIndex="19" id="tg008[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg008]" value="" size="10" style="text-align:right;" /></td>';
	html += '	 <td class="left"><select tabIndex="18" id="tg011[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg011]" ><option value=\'1\'>1:公司</option><option value=\'2\'>2:廠商</option><option value=\'3\'>3:人員</option><option value=\'9\'>9:其他</option></select></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="21" id="tg005[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg005]" value="" size="15" style="text-align:right;" /></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="22" id="tg007[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg007]" value="" size="15" style="text-align:right;" readonly="readonly" /></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="22" id="tg012[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg012]" value="" size="15" style="text-align:right;" /></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="23" id="tg013[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg013]" value="" size="20" style="text-align:right;" readonly="readonly" /></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="24" id="tg006[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg006]" value="1101" size="20" style="text-align:right;" /></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="25" id="tg014[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg014]" value="" size="10" style="text-align:right;" /></td>';
	html += '	 <td class="left"><select tabIndex="18" id="tg015[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg015]" ><option value=\'1\'>1:收款人負擔</option><option value=\'2\'>2:付款人負擔</option></select></td>';
	html += '	 <td class="left"><input type="text"  tabIndex="27" id="tg009[' + product_row + ']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tg009]" value="" size="20" style="text-align:right;" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	$('#order_product tfoot').before(html); 
	
	$('input[name=\'order_product[' + product_row + '][mb002]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][mb003]\']').focus();
	});
	$("#product-row" + product_row).click(function(){
		check_data_input();
	});
	$('input[name=\'order_product[' + product_row + '][tg008]\'],#tf006').focusout(function() {
		var sumTotal = 0;
		var Tran = 0;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1');
		var input_1=$('input[name=\'order_product[' + n + '][tg008]\']').val()*1;  
		var input_2=$('#tf006').val()*1;  		
		$(".money").each(function() {
			if(!isNaN(this.value) && this.value.length!=0) {
				sumTotal += parseFloat(this.value);			
			}
		});
		$("#tf013").val(sumTotal);
		Tran = $('#tf006').val();
		if($('#tf006').val()*1<=0 || isNaN($('#tf006').val())) Tran = 1;
		$("#tf014").val(sumTotal*Tran);
	});
	var n = product_row
	//流水號
	var num_1 = 1000;
	var num_2=(parseInt($('input[name=\'order_product[' + parseInt(n-1) + '][tg003]\']').val())*1)+(n*2)+num_1; 
	if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	if(!num_2) num_2=(parseInt($('input[name=\'order_product[' + parseInt(n-2) + '][tg003]\']').val())*1)+(n*2)+num_1; 
	if(!num_2) num_2=1000+n*2;
	if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	$('input[name=\'order_product[' + n + '][tg003]\']').val(num_2);
	
	Enterkey();
	
	product_row++;
}
//-->
function check_data_input(){
	if(!$("#tf001").val()){
		alert("請輸入存款單別");f
		$("#tf001").focus();
	}
	else if(!$("#tf004").val()){
		alert("請輸入銀行代號");
		$("#tf004").focus();
	}
}

function check_cash(thisobj,row,value){
	if(value==1){
		$("input[name=\'order_product["+ row +"][tg005]\']").unbind('dblclick');
		$("input[name=\'order_product["+ row +"][tg005]\']").val("");
		$("input[name=\'order_product["+ row +"][tg007]\']").val("");
		$("input[name=\'order_product["+ row +"][tg012]\']").val("");
		$("input[name=\'order_product["+ row +"][tg013]\']").val("");
		$("input[name=\'order_product["+ row +"][tg006]\']").val("1101");
	}
	else{
		$("input[name=\'order_product["+ row +"][tg005]\']").dblclick(function(){
			noti01a(thisobj, row );
		});
	}
	
}
</script>

<!-- 不更新網頁帶出資料 noti06a 存款單別 -->
<script type="text/javascript">
function startnoti06a(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/noti06a/datanoti06a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  shownoti06a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function shownoti06a(sText){   //不更新網頁   存款單別
	var oSpan = document.getElementById("Shownoti06a_str");
	//$("#tf001").val(sText);
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>";
	
	 $('#tf001').focus();
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>";
		$("#tf001").val("");
	 }	
}
</script>

<!-- 不更新網頁帶出資料 cmsi16a 銀行機構 -->
<script type="text/javascript">
function startcmsi16a(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsi16a/datacmsi16a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsi16a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsi16a(sText){   //不更新網頁 ta012  銀行機構
	var oSpan = document.getElementById("Showcmsi16a_str");
	$("#ma002").val(sText);
	$("#ma003").val(sText);
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>";
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
</script>

<!-- 不更新網頁帶出資料 actq03a 銀行機構 -->
<script type="text/javascript">
function startactq03a(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/actq03a/dataactq03a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

function showactq03a(sText){   //不更新網頁 ta012  銀行機構
	var oSpan = document.getElementById("ma005_name");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>";
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
</script>

<!-- 開視窗 noti01a 銀行帳號 -->	
<script type="text/javascript">
	$(document).ready(function(){
	$("#Shownoti01a").click(function() {
	$.blockUI({ 	   
	css: { 	   
	top: '20%', 	   
	left: '25%', 	   
	height: '480px', 	   
	width: '850px', 	   
	overflow:'auto', 	   
	'-webkit-border-radius': '10px', 	   
	'-moz-border-radius': '10px', 	   
	'-khtml-border-radius': '10px', 	   
	'border-radius': '10px', 	   
	}, 	   
	message: $('#divFnoti01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	});
	function select_noti01a(ma001,ma002,ma004,ma005,ma011){
		$('#tf004').val(ma001);
		$('#ma002').val(ma002);
		$('#ma004').val(ma004);
		$('#ma005').val(ma005);
		$('#ma003').val(ma005);
		if(ma011 == "1"){
			$('#ma011').attr("checked","checked");
		}
		else if(ma011 == "0"){
			$('#ma011').removeAttr("checked");
		}
	}
</script> 
	<div id="divFnoti01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/noti01a/display" allowTransparency="flase" name="ifmain" width="800" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<!-- 開視窗 noti06a 存提單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Shownoti06a").click(function() { 	   
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
	message: $('#divFnoti06a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	});
	function select_noti06a(no,name){
		$('#tf001').val(no);
		$('#Shownoti06a_str').text(name);
		$('#tf001').focus();
	}	
	</script> 	    	
		   
	<div id="divFnoti06a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/noti06a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 
	
<!-- 開視窗 cmsi16a 銀行機構 -->	
<script type="text/javascript">
	$(document).ready(function(){
	$("#Showcmsi16a").click(function() {
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
	message: $('#divFcmsi16a'),
	});
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	});
	function select_cmsi16a(no,name){
		$('#ma006').val(no);
		$('#ma002').val(name);
		$('#ma003').val(name);
	}
</script> 	    	
		   
	<div id="divFcmsi16a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsi16a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>
	
<!-- 開啟銀行機構(明細用) -->
<script type="text/javascript"> 	  
	function noti01a(thisobj,row_count) {
	$('#select_rows').val(row_count);
	$.blockUI({ 	   
	css: {
	top: '20%',
	left: '20%',
	height: '70%',
	width: '40%',
	overflow:'auto',
	'-webkit-border-radius': '10px',
	'-moz-border-radius': '10px',
	'-khtml-border-radius': '10px',
	'border-radius': '10px',
	},
	message: $('#divnoti01a'),
	});
		   
	$('.close').click($.unblockUI);
	};
	function selectd_noti01a(id,name,no,account,subject){
		$('input[name=\'order_product[' + $('#select_rows').val() + '][tg005]\']').val(id);
		$('input[name=\'order_product[' + $('#select_rows').val() + '][tg007]\']').val(name);
		$('input[name=\'order_product[' + $('#select_rows').val() + '][tg012]\']').val(no);
		$('input[name=\'order_product[' + $('#select_rows').val() + '][tg013]\']').val(account);
		$('input[name=\'order_product[' + $('#select_rows').val() + '][tg006]\']').val(subject);
		$('.close').click();
	}
	</script>

	<div id="divnoti01a" style="display:none">
	<div style="float:right;"><input type="button" class="close" value="close" /></div>
	<iframe src="<?php echo base_url()?>index.php/fun/noti01a/display2" allowTransparency="flase" id="noti01aifmain" name="ifmain" width="95%" height="600px" marginwidth="0" marginheight="0" frameborder="0"></iframe>
	</div>

<!-- 開視窗 actq03a 科目 -->
<script type="text/javascript">
	$(document).ready(function(){
	$("#Showactq03a").click(function(){
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
	message: $('#divFactq03a'),
	});

	$('.close').click($.unblockUI);
	});
	});
	function select_actq03a(no,name){
		$('#ma005').val(no);
		$('#ma005_name').text(name);
	}
</script> 	    	
		   
	<div id="divFactq03a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>
	
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
	function select_cmsq06a(no,name,val){
		$('#tf005').val(no);
		$('#Showcmsq06a_str').text(name);
		$('#tf006').val(val);
	}	
	</script> 	    	
		   
	<div id="divFcmsq06a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq06a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>