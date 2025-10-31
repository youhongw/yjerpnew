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
   	var sUrl = "<?php echo base_url()?>index.php/not/noti14/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

<script type="text/javascript"><!--    // 明細 新增 var product_row = 10; row=0;

var product_row = 250; 
var vtj0= 249;
function addItem() {
	product_row = $('#row_count').val();
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][mf001]" value="" />';
    html += '    <td class="left"><input type="text" tabIndex="18" id="mf003['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf003]" value="" size="20" style="text-align:right" onchange="startnoti13a(this)" ondblclick="noti13a(this,'+ product_row +');" /><span id="shownoti13a"></span></td>';
    html += '    <td class="left"><input type="text" tabIndex="17" id="mf005'+ product_row +'" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf005]" size="20" disabled="disabled" style="text-align:right;background-color:#F0F0F0" /></td>';
	html += '    <td class="left"><input type="text" tabIndex="18" class="mf004" id="mf004['+ product_row +']" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf004]" value="" size="20" style="text-align:right" /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	  $('#row_count').val(parseInt(product_row)+1);
	 $('#order_product tfoot').before(html); 
	
	//明細計算
	$('input[name=\'order_product[' +  product_row + '][mf003]\'],input[name=\'order_product[' + product_row + '][mf005]\'],input[name=\'order_product[' + product_row + '][mf004]\']').focusout(function() { 
		 
       //合計資料
		totalSum();		
	
	});
	$('input[name=\'order_product[' +  product_row + '][mf004]\']').focus(function(){
		totalSum();	
        console.log('test2');		
	});
	$('input[name=\'order_product[' +  product_row + '][mf004]\']').blur(function(){
		totalSum();	
        console.log('test3');		
	});
	Enterkey();
	
	product_row++;
}
//-->
</script>
<script type="text/javascript"><!--  //合計金額

function totalSum() {

   var sumTotal = 0;
	var sumTotal1 = 0;
	var sumQty = 0;
	var product_row = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
	console.log('test1119');
    $(".mf004").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal += parseFloat(this.value);			
		}
    });
	

  	form.me007.value=Math.round(sumTotal);	  //原幣貨款
}
//--></script>
 <!-- 明細 品號開視窗   -->  