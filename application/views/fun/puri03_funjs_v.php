<!-- 開視窗 purq04a32 單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showpurq04a32").click(function() { 	   
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
	message: $('#divFpurq04a32'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFpurq04a32" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq04a/display32" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addpurq04a32(sta001,sta002) {	
	form.purq04a32.value=sta001;
	var oSpan = document.getElementById("purq04a32disp");
		oSpan.innerHTML = sta002;
	document.form.purq04a32.focus();    
	return purq04a32;	
}
//--></script>
	
<script type="text/javascript"> 	   //開視窗  主供應商 invi02
	$(document).ready(function(){ 	   
	$("#Showpurq01a").click(function() { 	   
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
	message: $('#divFpurq01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a(sma001,sma002) {
   
	form.purq01a.value=sma001;
	var oSpan = document.getElementById("purq01adisp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a.focus();    	
	return purq01a;
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


function showpurq04a32(sText){                 //不更新網頁 31  核價單別 ta001
	var oSpan = document.getElementById("purq04a32disp");
      //   chkno1();
     //   alert('test');		
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 purq04a32 請購單別 -->        
function startpurq04a32(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
   
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/purq04a/datapurq04a32/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq04a32(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


function showpurq01a(sText){   //不更新網頁 32 主供應商 
	var oSpan = document.getElementById("purq01adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startpurq01a(oInput){         //不更新網頁 32 主供應商
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/purq01a/checkpurq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpurq01a(xmlHttp.responseText);	//顯示服務器結果		
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
     // alert(oInput);
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq06a/datacmsq06a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)	
       //   alert(xmlHttp.responseText);			
		  showcmsq06a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁帶出資料  核價單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'tl010\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	  
	   var zno3=parseInt(zno)+1;
	   document.getElementById("tl002").value=zno3;
	 //  alert(zno3);
//	   var oSpan = document.getElementById("purq04a32disp");
//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
//	 if (!sText) { 
//	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
//	 }	
	   
	//	alert(zno3);
	//var oSpan = document.getElementById("ta002");	 
	// oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	 //   oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	

<!-- 不更新網頁 計算單號 請購單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'purq04a32\']').val();
	 var zstr=$('input[name=\'tl010\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
    //  alert(zno);
	 
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pur/puri03/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
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
	     var   sText=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
	       $('input[name=\'order_product[' + nn + '][tm014]\']').val(sText);   
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
	  var selval = document.getElementById('tl006').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	    if (selval==0) {
	     oSpan.innerHTML = "<span style='color:blank'> 核准</span>";}
        else if (selval==1)
		{ oSpan.innerHTML = "<span style='color:blank'> 未核</span>";}
	    else { oSpan.innerHTML = "<span style='color:blank'> 作廢</span>";}
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	       // alert(test);
		   document.form.tl010.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'tl010\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 8 ) { 
		    document.form.tl010.focus(); return tl010;}	
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
var product_row = 0; 
var vtj0= -1;
function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][tm001]" value="" />';
	html += '    <input type="hidden" name="order_product[' + product_row + '][tm002]" value="" />';	
//	html += '    <td class="left"><input type="text"  tabIndex="13"  name="order_product[' + product_row + '][tm003]" value="0" size="6" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="51" id="tm004'+ product_row+'"   name="order_product[' + product_row + '][tm004]" value="" size="20"  style="background-color:#E7EFEF"/></td>';	
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()" type="text" id="tm005"  name="order_product[' + product_row + '][tm005]" value=""  /></td>';
	html += '    <td class="left"><input readonly="value"  onKeyPress="keyFunction()" type="text" id="tm006"   name="order_product[' + product_row + '][tm006]" value=""  size="30" /></td>';
	html += '    <td class="left"><input readonly="value"   onKeyPress="keyFunction()"   type="text" id="tm009"   name="order_product[' + product_row + '][tm009]" value="" size="6" /></td>';
	html += '    <td class="left"><input type="text"   readonly="value" tabIndex="52"  name="order_product[' + product_row + '][tm003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><input type="text" onchange="showymd1(this,product_row)" ondblclick="scwShow(this,event);" onfocus="this.select()" tabIndex="53" id="tm014['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tm014]" value="<?php echo date("Y/m/d"); ?>" size="10"  style="background-color:#E7EFEF"/></td>';
	html += '    <td class="left"><input type="text" id="tm012" tabIndex="54"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tm007]" value="" size="20" /></td>';
    html += '    <td class="center"><input type="text" tabIndex="55" id="tm010" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tm010]" value="0" size="6" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" id="tm011" tabIndex="56"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tm011]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html);  
	 
	
	   	   //下拉視窗 網頁不更新  mb001 tm004 品號品名輸入
	
    $('input[name=\'order_product[' + product_row + '][tm004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tm004').value;
			   vtj0= product_row - 1;
		       smb001= $('#tm004'+vtj0 ).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/pur/puri03/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tm004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tm005]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tm006]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tm009]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });    
	
	
	   
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tm010]\'],input[name=\'order_product[' + product_row + '][tm011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
	 //	if ($('input[name=\'order_product[' + n + '][tm003]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tm003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tm003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][tm003]\']').val(num_2)=$('input[name=\'order_product[' + n + '][tm003]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	 
	   //單價  
	$('input[name=\'order_product[' + product_row + '][tm010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
             if ($(this).val()=='0')		 
			 $(this).val('');
	});
	//單價  
	$('input[name=\'order_product[' + product_row + '][tm010]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		     $(this).val(real_value);
             if ($(this).val()=='')		 
			 $(this).val('0');
	});
	
	//
	$('input[name=\'order_product[' + product_row + '][tm011]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][tm004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
}
//-->
</script>

 <!-- 明細 品號開視窗   -->  