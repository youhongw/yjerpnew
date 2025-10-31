
	<!-- javascrit 明細0 -->	  	
	<script type="text/javascript"><!--
	  var totle_row = $('#row_count').val();
	//  var product_row = 1 , vrow = 0, vtj0='0'; 
	  var temp_row = 0;
	var product_row = 0;
	for(temp_row=0;temp_row<totle_row;temp_row++){
		look_up_show(temp_row+1,temp_row,temp_row);
	}
	function look_up_show(product_row,vrow,vtj0){
	$('input[name=\'order_product[' + vrow + '][mf003]\']').blur(function(){
		$('input[name=\'order_product[' + vrow + '][mf004]\']').focus();
		totalSum();
		console.log('test1');		
	});
  
	//合計資料
	$('input[name=\'order_product[' + vrow + '][mf004]\']').focus(function(){
		totalSum();	
        console.log('test2');		
	});
	$('input[name=\'order_product[' + vrow + '][mf004]\']').blur(function(){
		totalSum();	
        console.log('test3');		
	});
	Enterkey();
	
	}
//--></script>
 <script type="text/javascript"><!--  //合計金額

function totalSum1() {

   var sumTotal = 0;
	var sumTotal1 = 0;
	var sumQty = 0;
	var product_row = 0; 
	var sumTax =0; 
	var sumTax1 =0; 
	var tax =0;
	var rate =0;
	console.log('test9');
    $(".mf004").each(function() {
		if(!isNaN(this.value) && this.value.length!=0) {
			sumTotal += parseFloat(this.value);			
		}
    });
	

  	form.me007.value=Math.round(sumTotal);	  //原幣貨款
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

function check_enable(){
	if($('#me007').attr('disabled')=="disabled")
		$('#me007').attr('disabled',false);
	else
		$('#me007').attr('disabled','disabled');
}
</script>

<!-- 不更新網頁帶出資料 noti13a 融資種類 -->
<script type="text/javascript">
function startnoti13a(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	var temp_str = oInput['name'].replace(/order_product\[/g,"");
	temp_str = temp_str.replace(/\]\[mf003\]/g,"");
	temp_str = "mf005"+temp_str+"";
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/noti13a/datanoti13a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  shownoti13a(xmlHttp.responseText,temp_str);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function shownoti13a(sText,temp_str){   //不更新網頁 ta012  融資種類
	$('#shownoti13a').text("");
	$('#'+temp_str).val(sText);
	 if (!sText) { 
	    $('#'+temp_str).val("");
		$('#shownoti13a').text("無此資料!!");
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
<!-- 開啟 noti13a 融資種類 -->
<script type="text/javascript"> 	   
	function noti13a(thisobj,row_count) {
		
	var str = thisobj.name;
	//if($("input[name$='"+str.replace(/td011/,"td004")+"']").val())
	$('#noti13aifmain').attr('src','<?php echo base_url()?>index.php/fun/noti13a/display/mc001/desc/0/0/'+row_count);
	
	$.blockUI({
	css: {
	top: '20%',
	left: '15%',
	height: '500px',
	width: '70%',
	overflow:'auto',
	'-webkit-border-radius': '10px',
	'-moz-border-radius': '10px',
	'-khtml-border-radius': '10px',
	'border-radius': '10px',
	},
	message: $('#divnoti13a'),
	});
		   
	$('.close').click($.unblockUI);
	};
	
	function select_data(mc001,mc002,row){
		$('input[name=\'order_product[' + row + '][mf003]\']').val(mc001);
		$('input[name=\'order_product[' + row + '][mf005]\']').val(mc002);
		$('input[name=\'order_product[' + row + '][mf004]\']').focus();
		$('.close').click();
	}
	</script> 	    	
		   
	<div id="divnoti13a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/noti13a/display" allowTransparency="flase" id="noti13aifmain" name="noti13aifmain" width="95%" height="500" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>
	
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