<script type="text/javascript"><!--
	  var totle_row = $('#row_count').val();
	//  var product_row = 1 , vrow = 0, vtj0='0'; 
	  var temp_row = 0;
	var product_row = 0;
	for(temp_row=0;temp_row<totle_row;temp_row++){
		look_up_show(temp_row+1,temp_row,temp_row);
	}
	function look_up_show(product_row,vrow,vtj0){
	$('input[name=\'order_product[' + vrow + '][tg004]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][tg008]\']').focus();
		totalSum();
		console.log('test1');		
	});
  
	//合計資料
	$('input[name=\'order_product[' + vrow + '][tg008]\']').focus(function(){
		totalSum();	
        console.log('test2');		
	});
	$('input[name=\'order_product[' + vrow + '][tg008]\']').blur(function(){
		totalSum();	
        console.log('test3');		
	});
	Enterkey();
	
	}
//--></script>

 


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