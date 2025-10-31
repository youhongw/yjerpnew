<script language="javascript"   >   //不更新網頁, 帶出資料按enter 自動找到名稱
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
function showcmsi09(sText){   //不更新網頁 6  業務人員 
	var oSpan = document.getElementById("cmsi09disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var cmsi09 = document.getElementById("cmsi09");
		  startcmsi09(cmsi09);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}

function startcmsi09(oInput){         //不更新網頁 6 業務人員
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi09/checkcmsi09/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showcmsi09(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
function showcmsi09a(sText){   //不更新網頁 6  計劃人員 
	var oSpan = document.getElementById("cmsi09adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var cmsi09a = document.getElementById("cmsi09a");
		  startcmsi09a(cmsi09a);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}

function startcmsi09a(oInput){         //不更新網頁 6 計劃人員
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi09/checkcmsi09/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showcmsi09a(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
function showcmsi09b(sText){   //不更新網頁 b  採購人員 
	var oSpan = document.getElementById("cmsi09bdisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var cmsi09b = document.getElementById("cmsi09b");
		  startcmsi09b(cmsi09b);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}

function startcmsi09b(oInput){         //不更新網頁 b 採購人員
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi09/checkcmsi09/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showcmsi09b(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
</script>	

<script type="text/javascript"> 	
//查詢業務人員開視窗cmsi09 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09disp").click(function() {
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
		message: $('#divFcmsi09'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
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
				$('#cmsi09').val(ui.item.value1);
				$('#cmsi09disp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
</script>
<script type="text/javascript"> 	
//查詢計劃人員開視窗cmsi09a //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09adisp").click(function() {
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
		message: $('#divFcmsi09a'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09a').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09a').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
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
				$('#cmsi09a').val(ui.item.value1);
				$('#cmsi09adisp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09adisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
//查詢採購人員開視窗cmsi09b //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi09bdisp").click(function() {
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
		message: $('#divFcmsi09b'),
		onOverlayClick: clear_cmsi09disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi09b').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi09b').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi09/lookup1_cmsi09/'+encodeURIComponent(smb001), 
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
				$('#cmsi09b').val(ui.item.value1);
				$('#cmsi09bdisp').text(ui.item.value2);
				//console.log($('#cmsi09a').val());
				return false;
			}else{
				$('#cmsi09bdisp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});

function addcmsi09disp(smb001,smb002){
	
	$('#cmsi09').val(smb001);
	$('#cmsi09disp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function addcmsi09adisp(smb001,smb002){
	
	$('#cmsi09a').val(smb001);
	$('#cmsi09adisp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function addcmsi09bdisp(smb001,smb002){
	
	$('#cmsi09b').val(smb001);
	$('#cmsi09bdisp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}
function clear_cmsi09disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi09/clear_sql"
	});
}

</script>	   
<div id="divFcmsi09" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi09a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

<div id="divFcmsi09b" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi09/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
