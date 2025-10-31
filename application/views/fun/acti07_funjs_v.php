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
   	var sUrl = "<?php echo base_url()?>index.php/act/acti07/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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
	html += '    <td class="center"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row' + product_row + '\').remove();" /></td>';
  	html += '    <input type="hidden"  name="order_product[' + product_row + '][mh001]" value="" />';
	
    html += '    <td class="left"><input type="text"  tabIndex="51" id="mh002'+ product_row+'"   name="order_product[' + product_row + '][mh002]" value="" size="6"  /></td>';	
	
	html += '    <td class="left"><input type="text"  tabIndex="52"  onclick="scwShow(this,event);"   id="mh003" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mh003]" value="" size="10" class="date" style="background-color:#E7EFEF"/></td>';
	html += '    <td class="left"><input type="text"  tabIndex="53"  onclick="scwShow(this,event);"   id="mh004" onKeyPress="keyFunction()" name="order_product[' + product_row + '][mh004]" value="" size="10" class="date" style="background-color:#E7EFEF"/></td>';
	
	html += '  </tr>';	
    html += '</tbody>';
	 
	 $('#order_product tfoot').before(html); 
	 
	  //下拉視窗 網頁不更新  mb001 mh002 人員姓名輸入
	
    $('input[name=\'order_product[' + product_row + '][mh002]\']').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source: 
		function(req, add){ 	
               	    
          //  var smb001=document.getElementById('mh002').value;
			   
			 if (product_row == "1" ) { smb001= $('#mh0020').val(); }
			 if (product_row == "2" ) { smb001= $('#mh0021').val(); }
			 if (product_row == "3" ) { smb001= $('#mh0022').val(); }
		     if (product_row == "4" ) { smb001= $('#mh0023').val(); }
			 if (product_row == "5" ) { smb001= $('#mh0024').val(); }
			 if (product_row == "6" ) { smb001= $('#mh0025').val(); }
			 if (product_row == "7" ) { smb001= $('#mh0026').val(); }
		     if (product_row == "8" ) { smb001= $('#mh0027').val(); }
			 if (product_row == "9" ) { smb001= $('#mh0028').val(); }
			 if (product_row == "10" ) { smb001= $('#mh0029').val(); }	
			 if (product_row == "11" ) { smb001= $('#mh00210').val(); }
			 if (product_row == "12" ) { smb001= $('#mh00211').val(); }
			
			//   smb001=$("#mh002"+(product_row-1)).val();
			 
            $.ajax({  
                url: '<?php echo base_url(); ?>index.php/act/acti07/lookup/'+encodeURIComponent(smb001), 
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
				 $('input[name=\'order_product[' + n + '][mh002]\']').val(ui.item.value1);
                 $('input[name=\'order_product[' + n + '][mh003]\']').val(ui.item.value2);
				 $('input[name=\'order_product[' + n + '][mh004]\']').val(ui.item.value3);
			
			     return false;
               }, 
			focus: function(event, ui) {
			return false;
		    }
        });  
	 
	
	$('input[name=\'order_product[' + product_row + '][mh004]\']').blur(function(){
		$('input[name=\'order_product[' + product_row + '][mh002]\']').focus();
	});
  
	$('.date').datepicker({dateFormat: 'yy/mm/dd'});
	
	Enterkey();
	
	product_row++;
}
//-->
</script>

 <!-- 明細 品號開視窗   -->  