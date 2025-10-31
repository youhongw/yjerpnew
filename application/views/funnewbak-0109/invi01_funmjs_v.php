<script language="javascript"   >   //不更新網頁, 帶出資料按enter 自動找到名稱
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}

function showinvi01a(sText){   //不更新網頁 2  品號類別 
	var oSpan = document.getElementById("invi01adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var invi01a = document.getElementById("invi01a");
		  startinvi01a(invi01a);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}
function showinvi01b(sText){   //不更新網頁 2  品號類別 
	var oSpan = document.getElementById("invi01bdisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var invi01b = document.getElementById("invi01b");
		  startinvi01b(invi01b);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}
function showinvi01c(sText){   //不更新網頁 3  品號類別 
	var oSpan = document.getElementById("invi01cdisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var invi01c = document.getElementById("invi01c");
		  startinvi01c(invi01c);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}
function showinvi01d(sText){   //不更新網頁 4  品號類別 
	var oSpan = document.getElementById("invi01ddisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var invi01d = document.getElementById("invi01d");
		  startinvi01d(invi01d);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}
function startinvi01a(oInput){         //不更新網頁 1 品號會計類別
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi01/checkinvi01/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showinvi01a(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
function startinvi01b(oInput){         //不更新網頁 2 品號類別
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi01/checkinvi01/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showinvi01b(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
function startinvi01c(oInput){         //不更新網頁 3 品號類別
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi01/checkinvi01/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showinvi01c(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
function startinvi01d(oInput){         //不更新網頁 4 品號類別
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/inv/invi01/checkinvi01/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showinvi01d(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
</script>	

<script type="text/javascript"> 	
//查詢品號類別開視窗invi01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showinvi01adisp").click(function() {
		console.log('inv01a');
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},	
		message: $('#divFinvi01a'),
		onOverlayClick: clear_invi01adisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#invi01a').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#invi01a').val();
			//console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi01/lookup1_invi01a/'+encodeURIComponent(smb001), 
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
				$('#invi01a').val(ui.item.value1);
				$('#invi01adisp').text(ui.item.value2);
			//	$('#invi01a').focus();
				//console.log($('#invi01').val());
				return false;
			}else{
				$('#invi01adisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			//   $('#invi01a').focus();
			return false;
		}
	});
});
function addinvi01adisp(smb001,smb002){
	$('#invi01a').val(smb001);
	$('#invi01adisp').text(smb002);
	$('#invi01a').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}
function clear_invi01adisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}
//不更新網頁 輸入直接跳出中文a
function check_invi01a(row_obj){
	var sme001= $('#invi01a').val();
	if(!sme001){$('#invi01adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/inv/invi01/lookup2_invi01a/'+encodeURIComponent(sme001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {me001:row_obj.value},
		success:  
      //  console.log(sme001);		
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#invi01a').val("");
					$('#invi01adisp').text("查無資料");
				}
				console.log(sme001);
				$('#invi01a').val(sme001);
				$('#invi01adisp').text(data.message[0].value2);
			}else{
				$('#invi01a').val(sme001);
				$('#invi01adisp').text("查無資料");
			}
		}
	});
}
</script>	   
<div id="divFinvi01a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi01/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢品號類別開視窗invi01  2//下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showinvi01bdisp").click(function() {
		console.log('inv01b');
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFinvi01b'),
		onOverlayClick: clear_invi01bdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#invi01b').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#invi01b').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi01/lookup1_invi01b/'+encodeURIComponent(smb001), 
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
				$('#invi01b').val(ui.item.value1);
				$('#invi01bdisp').text(ui.item.value2);
				//console.log($('#invi01').val());
				return false;
			}else{
				$('#invi01bdisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addinvi01bdisp(smb001,smb002){
	$('#invi01b').val(smb001);
	$('#invi01bdisp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}
function clear_invi01bdisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}

</script>	   
<div id="divFinvi01b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi01/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢品號類別開視窗invi01  3//下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showinvi01cdisp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFinvi01c'),
		onOverlayClick: clear_invi01cdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#invi01c').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#invi01c').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi01/lookup1_invi01c/'+encodeURIComponent(smb001), 
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
				$('#invi01c').val(ui.item.value1);
				$('#invi01cdisp').text(ui.item.value2);
				//console.log($('#invi01').val());
				return false;
			}else{
				$('#invi01cdisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addinvi01cdisp(smb001,smb002){
	$('#invi01c').val(smb001);
	$('#invi01cdisp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}
function clear_invi01cdisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}

</script>	   
<div id="divFinvi01c" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi01/displayc_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<script type="text/javascript"> 	
//查詢品號類別開視窗invi01  4//下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showinvi01ddisp").click(function() {
	$.blockUI({
		css: {
			top: '15%',
			left: '25%',
			height: '75%',
			width: '50%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divFinvi01d'),
		onOverlayClick: clear_invi01cdisp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#invi01d').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#invi01d').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi01/lookup1_invi01d/'+encodeURIComponent(smb001), 
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
				$('#invi01d').val(ui.item.value1);
				$('#invi01ddisp').text(ui.item.value2);
				//console.log($('#invi01').val());
				return false;
			}else{
				$('#invi01ddisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addinvi01ddisp(smb001,smb002){
	$('#invi01d').val(smb001);
	$('#invi01ddisp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}
function clear_invi01ddisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi01/clear_sql"
	});
}

</script>	   
<div id="divFinvi01d" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi01/displayd_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>