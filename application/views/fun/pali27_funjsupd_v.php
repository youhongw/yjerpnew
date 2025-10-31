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
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi06/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
<!-- 不更新網頁 檢查 日期欄位 自動輸入  -->	
<script type="text/javascript"><!--       
 function dataapp6(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
		temp = oInput.value.replace(/[^0-9]/g,"");
		if(!temp){return;}
		var Today=new Date();
		var first = "2000";
		var mid = "  ";
		var last = "  ";
		if(temp.substring(0,4)){first = temp.substring(0,4);}
		if(temp.substring(4,6)){mid = temp.substring(4,6);}
		if(temp.substring(6,8)){last = temp.substring(6,8);}if(mid>20){last = temp.substring(5,7);}
		if(first<1900&&first>0){first = Today.getFullYear();}
		if(mid<10&&mid>0){mid = "0"+(mid*1);}else if(mid>12){mid = "0"+Math.floor(mid/10);}else if(mid<=0){mid="01";}
		var days = new Date(first,mid,0).getDate();
		if(last<10&&last>0){last = "0"+(last*1);}else if(last<=0){last="01";}else if(last>days){last=days;}
		oInput.value=first+'/'+mid+'/'+last;
}

//--></script>
<script type="text/javascript"><!--       
 function dataapp7(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
		temp = oInput.value.replace(/[^0-9]/g,"");
		if(!temp){return;}
		var Today=new Date();
		var first = "2000";
		var mid = "  ";
		var last = "  ";
		if(temp.substring(0,4)){first = temp.substring(0,4);}
		if(temp.substring(4,6)){mid = temp.substring(4,6);}
		if(temp.substring(6,8)){last = temp.substring(6,8);}if(mid>20){last = temp.substring(5,7);}
		if(first<1900&&first>0){first = Today.getFullYear();}
		if(mid<10&&mid>0){mid = "0"+(mid*1);}else if(mid>12){mid = "0"+Math.floor(mid/10);}else if(mid<=0){mid="01";}
		var days = new Date(first,mid,0).getDate();
		if(last<10&&last>0){last = "0"+(last*1);}else if(last<=0){last="01";}else if(last>days){last=days;}
		oInput.value=first+'/'+mid+'/'+last;
}

//--></script>
<script type="text/javascript"><!--       
 function dataapp10(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
		temp = oInput.value.replace(/[^0-9]/g,"");
		if(!temp){return;}
		var Today=new Date();
		var first = "2000";
		var mid = "  ";
		var last = "  ";
		if(temp.substring(0,4)){first = temp.substring(0,4);}
		if(temp.substring(4,6)){mid = temp.substring(4,6);}
		if(temp.substring(6,8)){last = temp.substring(6,8);}if(mid>20){last = temp.substring(5,7);}
		if(first<1900&&first>0){first = Today.getFullYear();}
		if(mid<10&&mid>0){mid = "0"+(mid*1);}else if(mid>12){mid = "0"+Math.floor(mid/10);}else if(mid<=0){mid="01";}
		var days = new Date(first,mid,0).getDate();
		if(last<10&&last>0){last = "0"+(last*1);}else if(last<=0){last="01";}else if(last>days){last=days;}
		oInput.value=first+'/'+mid+'/'+last;
}

//--></script>
<script type="text/javascript"><!--       
 function dataapp11(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
		temp = oInput.value.replace(/[^0-9]/g,"");
		if(!temp){return;}
		var Today=new Date();
		var first = "2000";
		var mid = "  ";
		var last = "  ";
		if(temp.substring(0,4)){first = temp.substring(0,4);}
		if(temp.substring(4,6)){mid = temp.substring(4,6);}
		if(temp.substring(6,8)){last = temp.substring(6,8);}if(mid>20){last = temp.substring(5,7);}
		if(first<1900&&first>0){first = Today.getFullYear();}
		if(mid<10&&mid>0){mid = "0"+(mid*1);}else if(mid>12){mid = "0"+Math.floor(mid/10);}else if(mid<=0){mid="01";}
		var days = new Date(first,mid,0).getDate();
		if(last<10&&last>0){last = "0"+(last*1);}else if(last<=0){last="01";}else if(last>days){last=days;}
		oInput.value=first+'/'+mid+'/'+last;
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
var product_row = 250; 
var vtj0= 249;
function addItem() {
	product_row = $('#row_count').val();
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][tj001]" value="" />';
	html += '    <input type="hidden"  name="order_product[' + product_row + '][tj002]" value="" />';
  //  html += '    <td class="left"><input type="text" onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  tabIndex="8" id="tj002['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj002]" value="<?php echo date("Y/m/d"); ?>" size="10" class="date" style="background-color:#E7EFEF" /></td>';
    //html += '    <td class="left"><input type="text" tabIndex="51" id="tj003" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj003]" value="" size="6" style="text-align:left" /></td>';
	html += '	 <td class="left"><select  tabIndex="'+ product_row +'51" id="tj003'+ product_row +'" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj003]" > <option value="配偶">1.配偶</option> <option value="父母">2.父母</option> <option value="子女">3.子女</option> <option value="祖父母">4.祖父母</option> <option value="孫子女">5.孫子女</option> <option value="外祖父母">6.外祖父母</option> <option value="外孫子女">7.外孫子女</option> <option value="曾祖父母">8.曾祖父母</option> <option value="外曾祖父母">9.外曾祖父母</option> <option value="受監護人">p.受監護人</option></select></td>';
	html += '    <td class="left"><input type="text" tabIndex="'+ product_row +'52" id="tj004" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj004]" value="" size="12" style="text-align:left" /></td>';
	html += '    <td class="left"><input type="text" tabIndex="'+ product_row +'53" id="tj005" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj005]" value="" size="6" style="text-align:left" /></td>';
    html += '    <td class="left"><input type="text" tabIndex="'+ product_row +'54" id="tj006" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj006]" value="" size="12" style="text-align:left" /></td>'; 
	html += '    <td class="left"><select id="tj007" tabIndex="'+ product_row +'55" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj007]" ><option  value="1">1.男</option><option value="2">2.女</option></select></td>';
	html += '    <td class="left"><input type="text" ondblclick="scwShow(this,event);" onchange="dateformat_ymd(this);" tabIndex="'+ product_row +'56" id="tj008['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj008]" value="" size="10" style="background-color:#E7EFEF" /></td>';
	html += '    <td class="left"><select id="tj009" tabIndex="'+ product_row +'57" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj009]" ><option  value="1">1.加保</option><option value="2">2.退保</option><option value="3">3.退休</option><option value="4">4.續保</option><option value="5">5.停保</option></select></td>';
	html += '    <td class="left"><select id="tj013" tabIndex="'+ product_row +'57" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj013]" ><option value="1">1:標準</option><option value="2">2:輕度(25%)</option><option value="3">3:中度(50%)</option><option value="4">4:重度(100%)</option></select></td>';
	html += '    <td class="left"><input type="text" ondblclick="scwShow(this,event);"   tabIndex="'+ product_row +'58" id="tj010['+ product_row +']" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="order_product[' + product_row + '][tj010]" value="" size="10" style="background-color:#E7EFEF" /></td>';
	html += '    <td class="left"><input type="text" tabIndex="'+ product_row +'59" id="tj011" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj011]" value="" size="30" style="text-align:left" /></td>'; 
	html += '    <td class="left"><input type="text" tabIndex="'+ product_row +'60" id="tj012" onKeyPress="keyFunction()" name="order_product[' + product_row + '][tj012]" value="" size="30" style="text-align:left" /></td>'; 
	html += '  </tr>';	
	html += '</tbody>';
	$('#row_count').val(parseInt(product_row)+1);
	$('#order_product tfoot').before(html); 
	
	$('input[name=\'order_product[' + product_row + '][tj006]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][tj003]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
}
//-->
</script>

 <!-- 明細 品號開視窗   -->  