 <!-- 開視窗 copq03a23 銷貨單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showcopq03a23").click(function() { 	   
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
	message: $('#divFcopq03a23'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFcopq03a23" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq03a/display3" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcopq03a23(sta001,sta002) {	
	form.copq03a23.value=sta001;
	var oSpan = document.getElementById("copq03a23disp");
		oSpan.innerHTML = sta002;
	document.form.copq03a23.focus();    
	return copq03a23;	
}
//--></script>
<!-- 開視窗 purq04a34 付款單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showinvq04a").click(function() { 	   
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
	message: $('#divFinvq04a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  
	<div id="divFinvq04a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq04a/display1" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addinvq04a11(sma001,sma002) {	
	form.invq04a.value=sma001;
	var oSpan = document.getElementById("invq04adisp");
		oSpan.innerHTML = sma002;
	document.form.invq04a.focus();    
	return invq04a;	
}
//--></script>
<!-- 開視窗 actq02a 傳票單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showactq02a").click(function() { 	   
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
	message: $('#divFactq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
</script> 	  

	<div id="divFactq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq02a/display91" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
	
<script type="text/javascript"><!--
  function addactq02a91(sma001,sma002) {	
	form.actq02a.value=sma001;
	var oSpan = document.getElementById("actq02adisp");
		oSpan.innerHTML = sma002;
	document.form.actq02a.focus();    
	return actq02a;	
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
	
	//建立非同步請求    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/adm/admi01/checkkey/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
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

<script type="text/javascript"> 
//查詢單別視窗
$(document).ready(function(){
	$("#Showtc001disp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '70%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFpuri04'),
		onOverlayClick: clear_tc001disp_sql
	});
	});
    $('#tc001').catcomplete({
        autoFocus: true,
		delay: 0,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#tc001').val();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri04/'+encodeURIComponent(smb001), 
                cache: false, 				
                dataType: 'json',  
                type: 'POST',  
                data: req,
                success:      
				function(data){  
					if(data.response =="true"){
						add(data.message);
					}
				}
			});
		},  
		select: function(event, ui) {
			if(ui.item.value!="查無資料"){
				$('#tc001').val(ui.item.value1);
				$('#tc001disp').text(ui.item.value2);
				return false;
			}else{
				$('#tc001disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addtc001disp(mb001,mb002){
	$('#tc001').val(mb001);
	$('#tc001disp').text(mb002);
	check_title_no();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri04/clear_sql"
	});
}
function clear_tc001disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pur/puri04/clear_sql"
	});
}
function check_tc001(row_obj){
	var smb001= $('#tc001').val();
	if(!smb001){$('#tc001disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/moc/moci03/lookup_puri04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#tc001').val("");
					$('#tc001disp').text("查無資料");
				}
				$('#tc001').val(data.message[0].value1);
				$('#tc001disp').text(data.message[0].value2);
				check_title_no();
			}else{
				$('#tc001').val("");
				$('#tc001disp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFpuri04" style="display:none;width:100%;height:100%;">
<iframe src="<?php echo base_url()?>index.php/pur/puri04/display_child/0/or_where?key=mq001,mq001&val=54,55" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>