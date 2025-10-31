<!-- 開視窗 invq02a  品號 -->
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
  function addinvq02a(sta001,sta002,sta003,sta004) {	
    
	form.invq02a.value=sta001;
	form.me001disp.value=sta002;
	form.me001disp1.value=sta003;
	form.me001disp2.value=sta004;
	document.getElementById("invq02adisp").innerHTML = sta002;
	document.form.invq02a.focus();    
	return invq02a;	
}
//--></script>

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
	var selval = document.getElementById('me001');
	//建立非同步請求    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/bom/bomi07/checkkey/" + encodeURIComponent(selval)+ "/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

function addItem() {
	html  = '<tbody id="product-row' + product_row + '">';
	html += '  <tr>'; 
	html += '    <td class="left"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][mf001]" value="" />';
	html += '    <input type="hidden"  name="order_product[' + product_row + '][mf002]" value="" />';
    html += '    <td class="left"><input type="text"  tabIndex="11" id="mf004'+ product_row+'"   name="order_product[' + product_row + '][mf004]" value="" size="10" style="background-color:#E7EFEF"  /></td>';	
	html += '    <td class="left"><input   tabIndex="12" onKeyPress="keyFunction()" type="text" id="mf004disp"  name="order_product[' + product_row + '][mf004disp]" value=""  /></td>';
	html += '    <td class="left"><input   tabIndex="13" onKeyPress="keyFunction()" type="text"  id="mf003" name="order_product[' + product_row + '][mf003]" value="0" size="10" style="background-color:#EBEBE4" /></td>';
	html += '    <td class="left"><select  tabIndex="14" id="mf005" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf005]" ><option  value="1">1.廠內製程</option><option value="2">2.託外製程</option></select></td>';
	html += '    <td class="left"><input type="text"  tabIndex="15" onchange="startcmsq03a(this,product_row)" id="mf006'+ product_row+'"   name="order_product[' + product_row + '][mf006]" value="" size="13"  /></td>';	
	html += '    <td class="left"><input readonly="value" type="text"  tabIndex="16"  id="mf007'+ product_row+'"   name="order_product[' + product_row + '][mf007]" value="" size="13" style="background-color:#EBEBE4"  /></td>';
	html += '    <td class="left"><input type="text" tabIndex="17" id="mf008" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf008]" value="" size="20"  /></td>';
    html += '    <td class="right"><input tabIndex="18" type="text"   name="order_product[' + product_row + '][mf019]" value="0" size="10" style="text-align:right" /></td>';
    html += '    <td class="right"><input tabIndex="19" type="text"   name="order_product[' + product_row + '][mf009]" value="00:00:00" size="10" style="text-align:right" /></td>';
    html += '    <td class="right"><input tabIndex="20" type="text"   name="order_product[' + product_row + '][mf010]" value="0" size="10" style="text-align:right" /></td>';
    html += '    <td class="right"><input tabIndex="21" type="text"   name="order_product[' + product_row + '][mf024]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="right"><input tabIndex="22" type="text"   name="order_product[' + product_row + '][mf025]" value="0" size="10" style="text-align:right" /></td>';
    html += '    <td class="right"><input tabIndex="23" type="text"   name="order_product[' + product_row + '][mf011]" value="0" size="10" style="text-align:right" /></td>';
    html += '    <td class="right"><input tabIndex="24" type="text"   name="order_product[' + product_row + '][mf012]" value="0" size="10" style="text-align:right" /></td>';
    html += '    <td class="right"><input tabIndex="18" type="text"   name="order_product[' + product_row + '][mf013]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><input type="text" tabIndex="19" id="mf015" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf015]" value="" size="10"  /></td>';
	html += '    <td class="left"><input type="text" tabIndex="20" id="mf017" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf017]" value="" size="10"  /></td>';
	 html += '    <td class="right"><input tabIndex="21" type="text"   name="order_product[' + product_row + '][mf018]" value="0" size="10" style="text-align:right" /></td>';
	html += '    <td class="left"><select  tabIndex="22" id="mf022" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf022]" ><option  value="0">0.免檢</option><option value="1">1.抽檢減量</option><option value="2">2.抽檢減量</option><option value="3">3.抽檢正常</option><option value="4">4.全檢</option></select></td>';
	 html += '    <td class="right"><input tabIndex="23" type="text"   name="order_product[' + product_row + '][mf026]" value="0" size="10" style="text-align:right" /></td>';
	 
	html += '    <td class="left"><input type="text" tabIndex="33" id="mf023" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mf023]" value="" size="20"  /></td>';
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html); 
	 
	  //下拉視窗 網頁不更新  mb001 mf002 人員姓名輸入
	
    $('input[name=\'order_product[' + product_row + '][mf004]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('mf002').value;
			   
			 if (product_row == "1" ) { smb001= $('#mf0040').val(); }
			 if (product_row == "2" ) { smb001= $('#mf0041').val(); }
			 if (product_row == "3" ) { smb001= $('#mf0042').val(); }
		     if (product_row == "4" ) { smb001= $('#mf0043').val(); }
			 if (product_row == "5" ) { smb001= $('#mf0044').val(); }
			 if (product_row == "6" ) { smb001= $('#mf0045').val(); }
			 if (product_row == "7" ) { smb001= $('#mf0046').val(); }
		     if (product_row == "8" ) { smb001= $('#mf0047').val(); }
			 if (product_row == "9" ) { smb001= $('#mf0048').val(); }
			 if (product_row == "10" ) { smb001= $('#mf0049').val(); }	
			 if (product_row == "11" ) { smb001= $('#mf00410').val(); }
			 if (product_row == "12" ) { smb001= $('#mf00411').val(); }
			 if (product_row == "13" ) { smb001= $('#mf00412').val(); }
		     if (product_row == "14" ) { smb001= $('#mf00413').val(); }
			 if (product_row == "15" ) { smb001= $('#mf00414').val(); }
			 if (product_row == "16" ) { smb001= $('#mf00415').val(); }
			 if (product_row == "17" ) { smb001= $('#mf00416').val(); }
		     if (product_row == "18" ) { smb001= $('#mf00417').val(); }
			 if (product_row == "19" ) { smb001= $('#mf00418').val(); }
			 if (product_row == "20" ) { smb001= $('#mf00419').val(); }	
             if (product_row == "21" ) { smb001= $('#mf00420').val(); }
			 if (product_row == "22" ) { smb001= $('#mf00421').val(); }
			 if (product_row == "23" ) { smb001= $('#mf00422').val(); }
		     if (product_row == "24" ) { smb001= $('#mf00423').val(); }
			 if (product_row == "25" ) { smb001= $('#mf00424').val(); }
			 if (product_row == "26" ) { smb001= $('#mf00425').val(); }
			 if (product_row == "27" ) { smb001= $('#mf00426').val(); }
		     if (product_row == "28" ) { smb001= $('#mf00427').val(); }
			 if (product_row == "29" ) { smb001= $('#mf00428').val(); }
			 if (product_row == "30" ) { smb001= $('#mf00429').val(); }	
			//   smb001=$("#mf002"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/bom/bomi07/lookup/'+encodeURIComponent(smb001), 
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
				 $('input[name=\'order_product[' + n + '][mf004]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mf004disp]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mf008]\']').val(ui.item.value3);
				 $('input[name=\'order_product[' + n + '][mf005]\']').val(ui.item.value4);
				 $('input[name=\'order_product[' + n + '][mf006]\']').val(ui.item.value5);
				 $('input[name=\'order_product[' + n + '][mf007]\']').val(ui.item.value6);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	 
	   //      n 將輸入值為非數位的字元替換為空 輸入不分含稅未稅
	$('input[name=\'order_product[' + product_row + '][mf019]\'],input[name=\'order_product[' + product_row + '][mf009]\']').focusout(function() { 
		//var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 		
		
		//流水號
		var num_1 = 1000;
		var n = this.name.replace(/order_product\[(\d+)].*/, '$1'); 
		var num_2=(parseInt($('input[name=\'order_product[' + n + '][mf003]\']').val())*1)+(n*2)+num_1; 
		if ( num_2 >= 2000 ) { num_2=num_2-1000; }
	    $('input[name=\'order_product[' + n + '][mf003]\']').val(num_2); 
		
	}); 
	//數量游標停在 0 之後 
	$('input[name=\'order_product[' + product_row + '][mf010]\']').focus(function(){
		var real_value = $(this)[0].defaultValue;
		if ($(this).val()==real_value)
		    $(this).val(real_value);
		//	$(this).val('');
	});
	
	$('input[name=\'order_product[' + product_row + '][mf023]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][mf004]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
}
//-->
</script>

 <!-- 明細 品號開視窗   -->  