<!-- 開視窗 invq02a 主件品號 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showinvq02a").click(function() { 	   
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
	message: $('#divFinvq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFinvq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq02a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addinvq02a(sta001,sta002,sta003,sta004,sta005) {	
	form.invq02a.value=sta001;
	form.mc001disp.value=sta002;
	form.mc001disp1.value=sta003;
	form.mc001disp2.value=sta004;
	form.mc001disp4.value=sta005;
	var oSpan = document.getElementById("invq02adisp");
		oSpan.innerHTML = sta002;
	document.form.invq02a.focus();    
	return invq02a;	
}
//--></script>
	
<script type="text/javascript"> 	   //開視窗  製令單別 
	$(document).ready(function(){ 	   
	$("#Showmocq01a51").click(function() { 	   
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
	message: $('#divFmocq01a51'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFmocq01a51" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/mocq01a/display51" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addmocq01a51(sma001,sma002) {
   
	form.mocq01a51.value=sma001;
	var oSpan = document.getElementById("mocq01a51disp");
		oSpan.innerHTML = sma002;	
	document.form.mocq01a51.focus();    	
	return mocq01a51;
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


function showinvq02a(sText){                 //不更新網頁 31 主件品號
	  //var oSpan = document.getElementById("invq02adisp");
	  var str=(sText.split(";",5));
	   $('input[name=\'mc001disp\']').val(str[0]);
	   $('input[name=\'mc001disp1\']').val(str[1]);
	   $('input[name=\'mc001disp2\']').val(str[2]);
	    $('input[name=\'mc001disp3\']').val(str[3]);
		 $('input[name=\'mc001disp4\']').val(str[4]);
     //   alert('test');		
	/*   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	*/
	 
}

 <!-- 不更新網頁帶出資料 invq02a 主件品號 -->        
function startinvq02a(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta001disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
   
	createXMLHttpRequest();
   
   	var sUrl = "<?php echo base_url()?>index.php/fun/invq02a/checkinvq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showinvq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}


function smocq01a51(sText){   //不更新網頁 製令單別
	var oSpan = document.getElementById("mocq01a51disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startmocq01a51(oInput){         //不更新網頁 製令單別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
  //  alert('test');
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/mocq01a/mocq01a51/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//alert('test3');
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
	//	alert(QueryString);	
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
		//	alert(xmlHttp.responseText);
		  smocq01a51(xmlHttp.responseText);	//顯示服務器結果		
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
//	   var oSpan = document.getElementById("invq02adisp");
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
	
	 var zno=$('input[name=\'invq02a\']').val();
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

//新增一筆明細 alt+w 
$(document).keydown(function(event){
	var keycode = (event.keyCode ? event.keyCode :event.which);
	if(event.altKey && (keycode == '87' || keycode == '119')){
		addItem();
	}
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
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][tj001]" value="" />';
	html += '    <input type="hidden"  name="order_product[' + product_row + '][tj002]" value="" />';
//	html += '    <td class="left"><input type="text"  tabIndex="13"  name="order_product[' + product_row + '][tj002]" value="0" size="6" /></td>';
	html += '    <td class="left"><input type="text"  tabIndex="51" id="tj004'+ product_row+'"   name="order_product[' + product_row + '][tj004]" value="" size="20"  style="background-color:#E7EFEF"/></td>';	
	html += '    <td class="left"><input readonly="value"   tabIndex="52" onKeyPress="keyFunction()" type="text" id="tj003disp"  name="order_product[' + product_row + '][tj003disp]" value=""  style="background-color:#EBEBE4"/></td>';
	html += '    <td class="left"><input readonly="value"  tabIndex="53" onKeyPress="keyFunction()" type="text" id="tj003disp1"   name="order_product[' + product_row + '][tj003disp1]" value=""  size="30" style="background-color:#EBEBE4"/></td>';
	html += '    <td class="left"><input readonly="value"  tabIndex="54"  onKeyPress="keyFunction()"   type="text" id="tj003disp2"   name="order_product[' + product_row + '][tj003disp2]" value="" size="6" style="background-color:#EBEBE4"/></td>';
	html += '    <td class="left"><input type="text"   readonly="value" tabIndex="52"  name="order_product[' + product_row + '][tj003]" value="0" size="6" style="background-color:#EBEBE4" /></td>';
	//html += '    <td class="left"><input type="text"  ondblclick="scwShow(this,event);"  tabIndex="55" id="tj011['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj011]" value="<?php echo date("Y/m/d"); ?>" size="10"  style="background-color:#E7EFEF"/></td>';
	//html += '    <td class="left"><input type="text"  ondblclick="scwShow(this,event);"  tabIndex="56" id="tj012['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj012]" value="" size="10"  style="background-color:#E7EFEF"/></td>';
	html += '    <td class="left"><input type="text" id="tj008" tabIndex="57"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj008]" value="1" size="10" style="text-align:right" /></td>';
	//html += '    <td class="left"><input type="text" id="tj006" tabIndex="58"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj007]" value="1" size="10" style="text-align:right" /></td>';
	//html += '    <td class="left"><input type="text" id="tj006" tabIndex="59"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj008]" value="0.00" size="10" style="text-align:right" /></td>';
    html += '    <td class="center" ><select id="tj012" tabIndex="60" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj012]" ><option  value="Y">Y:</option><option value="N">N:</option></select></td>'; 
	html += '    <td class="center"><select id="tj011" tabIndex="61" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj011]" ><option  value="1">1.已確認</option><option value="2">2.未確認</option><option  value="3">3.作廢</option></select></td>'; 
	html += '    <td class="left"><input type="text" id="tj010" tabIndex="62"  onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj010]" value="" size="20" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 $('#row_count').val(parseInt(product_row)+1);
	 $('#order_product tfoot').before(html);  
	 
	
	   	   //下拉視窗 網頁不更新  mb001 tm004 品號品名輸入
	
     $('input[name=\'order_product[' + product_row + '][tj004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('tj003').value;
			     vtj0= product_row - 1;
		       smb001= $('#tj004'+vtj0 ).val();
			//   smb001=$("#tj003"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi02/lookup/'+encodeURIComponent(smb001), 
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
                 $('input[name=\'order_product[' + n + '][tj004]\']').val(ui.item.value1);				   
			     $('input[name=\'order_product[' + n + '][tj003disp]\']').val(ui.item.value2);
			     $('input[name=\'order_product[' + n + '][tj003disp1]\']').val(ui.item.value3);
			     $('input[name=\'order_product[' + n + '][tj003disp2]\']').val(ui.item.value4);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });    
	
	
	   
      //  明細 小計    n 將輸入值為非數位的字元替換為空
	$('input[name=\'order_product[' + product_row + '][tj008]\'],input[name=\'order_product[' + product_row + '][tj011]\']').focusout(function() { 
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
	 //	if ($('input[name=\'order_product[' + n + '][tj002]\']').val() == '0' ) { num_1 = 1000; } else { num_1 = 0; }
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][tj003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][tj003]\']').val(num_2); 
	 //	if ( num_2 >= 2000 ) { num_2=num_2-1000;$('input[name=\'order_product[' + n + '][tj002]\']').val(num_2)=$('input[name=\'order_product[' + n + '][tj002]\']').val(num_2)-1000; }
	 //	alert(num_2);
		
	});
	 
	   //單價  
	$('input[name=\'order_product[' + product_row + '][tj008]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
			$(this).val('');
	});
 /*	$('input[name=\'order_product[' + product_row + '][tj010]\']').focusout(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
			//$(this).val('');
	});  */
	
	
	$('input[name=\'order_product[' + product_row + '][tj010]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][tj004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
}
//-->
</script>

 <!-- 明細 品號開視窗   -->  