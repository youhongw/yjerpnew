<!-- 開視窗 copq03a22 訂單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showcopq03a22").click(function() { 	   
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
	message: $('#divFcopq03a22'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFcopq03a22" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq03a/display2" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcopq03a22(sta001,sta002) {	
	form.copq03a22.value=sta001;
	var oSpan = document.getElementById("copq03a22disp");
		oSpan.innerHTML = sta002;
	document.form.copq03a22.focus();    
	return copq03a22;	
}

function dateformat_ymd(oInput){ //年月日日期自動跳轉
	temp = oInput.value.replace(/[^0-9]/g,"");
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

function dateformat_ym(oInput){ //年月日期自動跳轉
	temp = oInput.value.replace(/[^0-9]/g,"");
	if(!temp){oInput.value="";return;}
	var Today=new Date();
	var first = "2000";
	var mid = "  ";
	if(temp.substring(0,4)){first = temp.substring(0,4);}
	if(temp.substring(4,6)){mid = temp.substring(4,6);}
	if(first<1900&&first>0){first = Today.getFullYear();}
	if(mid<10&&mid>0){mid = "0"+(mid*1);}else if(mid>12){mid = 12;}else if(mid<=0){mid="01";}
	oInput.value=first+'/'+mid;
}
//--></script>
<!-- 開視窗 copq03a22 訂單單別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){
	$("#Showcopq03a221").click(function() { 	   
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
	message: $('#divFcopq03a221'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	  
	<div id="divFcopq03a221" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq03a/display21" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 	  
<script type="text/javascript"><!--
  function addcopq03a221(sta001,sta002) {	
	form.copq03a221.value=sta001;
	var oSpan = document.getElementById("copq03a221disp");
		oSpan.innerHTML = sta002;
	document.form.copq03a221.focus();    
	return copq03a221;	
}
//--></script>
<script type="text/javascript"> 	   //開視窗  6 庫別 invi02
	$(document).ready(function(){ 	   
	$("#Showcmsq03a").click(function() { 	   
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
	message: $('#divFcmsq03a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq03a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq03a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq03a(sma001,sma002) {
	form.cmsq03a.value=sma001;
	var oSpan = document.getElementById("cmsq03adisp");
		oSpan.innerHTML = sma002;      	
	document.form.cmsq03a.focus();    
	return cmsq03a;
}
//--></script>
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

<!-- 開視窗 actq03a1 42 會計科目1 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showactq03a1").click(function() { 	   
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
	message: $('#divFactq03a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFactq03a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a1(sma001,sma002) {
	form.bactno.value=sma001;
	var oSpan = document.getElementById("actq03a1disp");
		oSpan.innerHTML = sma002;	
	document.form.bactno.focus();    
	return bactno;
}
//--></script>

<!-- 開視窗 actq03a2 41 會計科目2 -->
<script type="text/javascript"> 	  
    
	$(document).ready(function(){ 	   
	$("#Showactq03a2").click(function() { 	   
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
	message: $('#divFactq03a2'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 
    
</script> 	    	
		   
	<div id="divFactq03a2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display2" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a2(sma001,sma002) {
	form.eactno.value=sma001;
	var oSpan = document.getElementById("actq03a2disp");
		oSpan.innerHTML = sma002;	
	document.form.eactno.focus();    
	return eactno;
}
//--></script>
<!-- 開視窗 actq03a2 41 會計科目4 -->
<script type="text/javascript"> 	  
    
	$(document).ready(function(){ 	   
	$("#Showactq03a4").click(function() { 	   
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
	message: $('#divFactq03a4'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 
    
</script> 	    	
		   
	<div id="divFactq03a4" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/actq03a/display4" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addactq03a4(sma001,sma002) {
	form.bactno.value=sma001;
	var oSpan = document.getElementById("actq03a4disp");
		oSpan.innerHTML = sma002;	
	document.form.bactno.focus();    
	return bactno;
}
//--></script>
<script type="text/javascript"> 	   //開視窗  起客戶代號 invi02
	$(document).ready(function(){ 	   
	$("#Showcopq01a").click(function() { 	   
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
	message: $('#divFcopq01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcopq01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq01a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

	<!-- 開視窗客戶代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址-->
<script type="text/javascript"><!--
  function addcopq01a(sma001,sma002) {
	form.copq01a.value=sma001;
	var oSpan = document.getElementById("copq01adisp");
		oSpan.innerHTML = sma002;	
	document.form.copq01a.focus();    	
	return copq01a;
}
//--></script>

<script type="text/javascript"> 	   //開視窗  迄客戶代號 invi02
	$(document).ready(function(){ 	   
	$("#Showcopq01a1").click(function() { 	   
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
	message: $('#divFcopq01a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcopq01a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copq01a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

	<!-- 開視窗客戶代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址-->
<script type="text/javascript"><!--
  function addcopq01a1(sma001,sma002) {
   
	form.copq01a1.value=sma001;
	var oSpan = document.getElementById("copq01a1disp");
		oSpan.innerHTML = sma002;	
	document.form.copq01a1.focus();    	
	return copq01a1;
}
//--></script>

<script type="text/javascript"> 	   //開視窗  起品號代號 invi02
	$(document).ready(function(){ 	   
	$("#Showinvq02a").click(function() { 	   
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
	message: $('#divFinvq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFinvq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq02a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

	<!-- 開視窗客戶代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址-->
<script type="text/javascript"><!--
  function addinvq02a(sma001,sma002) {
   
	form.invq02a.value=sma001;
 //	form.tg007.value=sma002;
	var oSpan = document.getElementById("invq02adisp");
		oSpan.innerHTML = sma002;	
	document.form.invq02a.focus();    	
	return invq02a;
}
//--></script>
<script type="text/javascript"> 	   //開視窗  迄品號代號 invi02
	$(document).ready(function(){ 	   
	$("#Showinvq02a1").click(function() { 	   
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
	message: $('#divFinvq02a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFinvq02a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/invq02a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

	<!-- 開視窗客戶代號2 簡稱 3電話4連絡人,5幣別,6付款條件,7課稅別 8 送貨地址-->
<script type="text/javascript"><!--
  function addinvq02a1(sma001,sma002) {
   
	form.invq02a1.value=sma001;
 //	form.tg007.value=sma002;
	var oSpan = document.getElementById("invq02a1disp");
		oSpan.innerHTML = sma002;	
	document.form.invq02a1.focus();    	
	return invq02a1;
}
//--></script>
<script type="text/javascript"> 	   //開視窗  主供應商 invi02
	$(document).ready(function(){ 	   
	$("#Showpurq01a").click(function() { 	   
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
	message: $('#divFpurq01a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a(sma001,sma002) {
   
	form.purq01a.value=sma001;
	var oSpan = document.getElementById("purq01adisp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a.focus();    	
	return purq01a;
}
//--></script>
<script type="text/javascript"> 	   //開視窗  迄主供應商 invi02
	$(document).ready(function(){ 	   
	$("#Showpurq01a1").click(function() { 	   
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
	message: $('#divFpurq01a1'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFpurq01a1" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/purq01a/display1" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addpurq01a1(sma001,sma002) {
   
	form.purq01a1.value=sma001;
	var oSpan = document.getElementById("purq01a1disp");
		oSpan.innerHTML = sma002;	
	document.form.purq01a1.focus();    	
	return purq01a1;
}
//--></script>
<!-- 開視窗 copc08a 前置單據 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcopc08a").click(function() { 	   
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
	message: $('#divFormcopc08a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcopc08a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/copc08a/display" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcopc08a(sma001,sma002) {
    var oSpan = document.getElementById("tg049");
		oSpan.innerHTML = 'testtesttest';  
       form.tg048.value=sma001;	
       form.tg049.value=sma002;		   
	url = '<?=base_url() ?>index.php/cop/copi08/copybefore/'+encodeURIComponent(sma001)+'/'+encodeURIComponent(sma002); 
	location = url;
	return true;
}
//--></script>
<!-- 開視窗 cmsq21a2 25 付款條件 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq21a2").click(function() { 	   
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
	message: $('#divFcmsq21a2'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq21a2" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq21a/display2" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq21a2(sma001,sma002) {
	form.cmsq21a2.value=sma001;
	var oSpan = document.getElementById("cmsq21a2disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq21a2.focus();    
	return cmsq21a2;
}
//--></script>

<!-- 開視窗 cmsq05a 部門別 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq05a").click(function() { 	   
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
	message: $('#divFcmsq05a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq05a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq05a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq05a(sta001,sta002) {
	  	  form.cmsq05a.value=sta001;
	var oSpan = document.getElementById("cmsq05adisp");
		oSpan.innerHTML = sta002;
	document.form.cmsq05a.focus();    
	return cmsq05a;
	
}
//--></script>

<!-- 開視窗 cmsq02a 廠別 -->	
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq02a").click(function() { 	   
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
	message: $('#divFcmsq02a'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFcmsq02a" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq02a/display" allowTransparency="flase" name="ifmain" width="640" height="480" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div> 

<script type="text/javascript"><!--
  function addcmsq02a(sta001,sta002) {
	  	  form.cmsq02a.value=sta001;
	var oSpan = document.getElementById("cmsq02adisp");
		oSpan.innerHTML = sta002;
	document.form.cmsq02a.focus();    
	return cmsq02a;
	
}
//--></script>
<!-- 開視窗 cmsq09a3 業務人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a3").click(function() { 	   
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
	message: $('#divFormcmsq09a3'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a3" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display3" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a3(sma001,sma002) {
	form.cmsq09a3.value=sma001;	
	var oSpan = document.getElementById("cmsq09a3disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a3.focus();    
	return cmsq09a3;
}
//--></script>
<!-- 開視窗 cmsq09a3 收款業務人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a31").click(function() { 	   
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
	message: $('#divFormcmsq09a31'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a31" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display31" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a31(sma001,sma002) {
	form.cmsq09a31.value=sma001;	
	var oSpan = document.getElementById("cmsq09a31disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a31.focus();    
	return cmsq09a31;
}
//--></script>
<!-- 開視窗 cmsq09a32  員工人員 -->
<script type="text/javascript"> 	   
	$(document).ready(function(){ 	   
	$("#Showcmsq09a32").click(function() { 	   
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
	message: $('#divFormcmsq09a32'), 	   
	}); 	   
		   
	$('.close').click($.unblockUI); 	   
	}); 	   
	}); 	   
	</script> 	    	
		   
	<div id="divFormcmsq09a32" style="display:none"> 	   
	<div style="float:right;"><input type="button" class="close" value="close" /></div> 	   
	<iframe src="<?php echo base_url()?>index.php/fun/cmsq09a/display32" allowTransparency="flase" name="ifmain" width="620" height="460" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
	</div>

<script type="text/javascript"><!--
  function addcmsq09a32(sma001,sma002) {
	form.cmsq09a32.value=sma001;	
	var oSpan = document.getElementById("cmsq09a32disp");
		oSpan.innerHTML = sma002;	
	document.form.cmsq09a32.focus();    
	return cmsq09a32;
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


function showcopq03a23(sText){                 //不更新網頁 32  銷貨單別 cop/copi0501
	var oSpan = document.getElementById("copq03a23disp");
      //   chkno1();
     
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 copq03a21 銷貨單別 -->        
function startcopq03a23(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#cop/copi0501disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
     
	createXMLHttpRequest();
     
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq03a/datacopq03a23/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq03a23(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}
function showcopq03a22(sText){                 //不更新網頁 32  訂單單別 cop/copi0501
	var oSpan = document.getElementById("copq03a22disp");
      //   chkno1();
     
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 copq03a21 訂單單別 -->        
function startcopq03a22(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#cop/copi0501disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
     
	createXMLHttpRequest();
     
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq03a/datacopq03a22/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq03a22(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}
function showcopq03a221(sText){                 //不更新網頁 32 迄訂單單別 cop/copi0501
	var oSpan = document.getElementById("copq03a221disp");
      //   chkno1();
     
	   oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
	 
}

 <!-- 不更新網頁帶出資料 copq03a21 訂單單別 -->        
function startcopq03a221(oInput){            
  //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#cop/copi0501disp").html("<span style='color:red'>不可空白.</span>");			
	//	return;
//	}
	//建立非同步請求
     
	createXMLHttpRequest();
     
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq03a/datacopq03a221/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq03a221(xmlHttp.responseText);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}

function showcopq01a(sText){   //不更新網頁 32 客戶代號 
	var oSpan = document.getElementById("copq01adisp");
	// alert('sText');		
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

function startcopq01a(oInput){         //不更新網頁 32 客戶代號
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq01a/checkcopq01a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq01a(xmlHttp.responseText);	//顯示服務器結果
         //   alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁,業務人員 -->
function showcmsq09a3(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("cmsq09a3disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,業務人員 -->
function startcmsq09a3(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a3/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a3(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}

<!-- 不更新網頁,收款業務人員 -->
function showcmsq09a31(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("cmsq09a31disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,收款業務人員 -->
function startcmsq09a31(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a31/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a31(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
<!-- 不更新網頁,員工代號 -->
function showcmsq09a32(sText){   //不更新網頁 4  業務人員
	var oSpan = document.getElementById("cmsq09a32disp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}
<!-- 不更新網頁,員工代號 -->
function startcmsq09a32(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq09a/datacmsq09a32/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq09a32(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
<!-- 不更新網頁,交易幣別 -->
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

<!-- 不更新網頁,付款條件 應付-->
function showcmsq21a2(sText){   
	var oSpan = document.getElementById("cmsq21a2disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁,付款條件 -->
function startcmsq21a2(oInput){ 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq21a/datacmsq21a2/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq21a2(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq02a(sText){   //不更新網頁 ta010 廠別
	var oSpan = document.getElementById("cmsq02adisp");
	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 cmsq02a 廠別 -->
function startcmsq02a(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta010disp").html("不可空白.");	
	//	return;
	//}
	//建立非同步請求
  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq02a/datacmsq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq02a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

<!-- 不更新網頁帶出資料  銷貨單號 -->
function showchkno1(sText){   
    
       if  (!sText) { sText=$('input[name=\'tg042\']').val();   
	          zymd1 = sText.substring(0,4); zymd2 = sText.substring(5,7); zymd3 = sText.substring(8,10); sText = zymd1+zymd2+zymd3+'000';  }	
       var zno1=sText.substring(0,8);
	   var zno2=sText.substring(8,11);
	   
	   var zno=zno1+zno2;
	 //  alert(z+no1);
	   var zno3=parseInt(zno)+1;
	   document.getElementById("tg002").value=zno3;
	 //  alert(zno3);
//	   var oSpan = document.getElementById("purq04a31disp");
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

<!-- 不更新網頁 計算單號 銷貨單號 -->	 
function chkno1(oInput){         
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ta006disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
	
	 var zno=$('input[name=\'copq03a23\']').val();
	 var zstr=$('input[name=\'tg042\']').val();
	 var zymd1 = zstr.substring(0,4);
	 var zymd2 = zstr.substring(5,7);
	 var zymd3 = zstr.substring(8,10);
	 var zymd = zymd1+zymd2+zymd3;
    //  alert(zymd);
	  
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi08/datachkno1/" + encodeURIComponent(zno)+ "/" + encodeURIComponent(zymd)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showchkno1(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
function showcopq02a(sText,n){   //不更新網頁 6  單價 
	//var oSpan = document.getElementById("td007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	 var nn=n;
	// var num = sText.length;
	// var sysma200=$('input[name=\'sysma200\']').val();
	// alert(nn);
	// alert(sText);	
	 if (sText>0){
	 $('input[name=\'order_product[' + nn + '][th012]\']').val(sText)};
}

function startcopq02a(oInput,n){         //不更新網頁 6 單價
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
       var nn=n-1;
      var tc004=$('input[name=\'copq01a\']').val();     //客代
	  var td004=$('input[name=\'order_product[' + nn + '][th004]\']').val();  //品號
      var td010=$('input[name=\'order_product[' + nn + '][th009]\']').val();  //單位
	//  alert(tc004+td004+td010);
	//建立非同步請求
   // var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/copq02a/checkcopq02a/" + encodeURIComponent(tc004)+ "/" + encodeURIComponent(td004)+ "/"+ encodeURIComponent(td010)+ "/"+ new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcopq02a(xmlHttp.responseText,nn);	//顯示服務器結果
         // alert(xmlHttp.responseText);  
	}
	
	xmlHttp.send(null);
	 
}

function showcmsq03a(sText){   //不更新網頁 6  庫別 
	var oSpan = document.getElementById("cmsq03adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }
/*	 var nn=n-1;
	 var num = sText.length;
	 var sysma200=$('input[name=\'sysma200\']').val();
	
	 if (num>sysma200){
          $('input[name=\'order_product[' + nn + '][th007disp]\']').val(sText); }  */
}

function startcmsq03a(oInput){         //不更新網頁 6 庫別
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
  //  var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq03a/checkcmsq03a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq03a(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}
function showinvq02a(sText,n){   //不更新網頁 6  品號 
	//var oSpan = document.getElementById("td007disp0");
	//	 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	// if (!sText) { 
	//    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	// }
	// alert(n);
	 var nn=n-1;	
	  var num = sText.length;
	 var str=(sText.split(";",3));
	  var sysma201=$('input[name=\'sysma201\']').val();
	//  alert(nn);
	// alert(str[1]);
	 if (num>sysma201){
     $('input[name=\'order_product[' + nn + '][th005]\']').val(str[0]);  
     $('input[name=\'order_product[' + nn + '][th006]\']').val(str[1]);
	 $('input[name=\'order_product[' + nn + '][th009]\']').val(str[2]);}
}

function startinvq02a(oInput,n){         //不更新網頁 6 品號
      
	 
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mb017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求	
    var nn=n;
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/invq02a/checkinvq02a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showinvq02a(xmlHttp.responseText,nn);	//顯示服務器結果
        //  alert(xmlHttp.responseText);	  
	}
	
	xmlHttp.send(null);
	 
}
<!-- 不更新網頁帶出資料 cmsq05a 部門 -->
function showcmsq05a(sText){   //不更新網頁 ta004 部門
	var oSpan = document.getElementById("cmsq05adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	
}

<!-- 不更新網頁帶出資料 cmsq05a 請購部門 -->
function startcmsq05a(oInput){         //不更新網頁 ta004 部門
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	//if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
	//	$("#ta004disp").html("此欄位不可空白.");	
	//	return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/fun/cmsq05a/datacmsq05a/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showcmsq05a(xmlHttp.responseText);	//顯示服務器結果		
	}
	xmlHttp.send(null);
}
//--></script>

<script type="text/javascript"><!--       
 function seleall(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示	
           document.getElementById('dateyymm').select();		   
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
	  var selval = document.getElementById('tg023').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("approved");
	  if (selval==0) {
	     oSpan.innerHTML = "<span style='color:red'> 核准</span>";}
        else
		{ oSpan.innerHTML = "<span style='color:red'> 未核</span>";}
	 if (selval==2) {
	     oSpan.innerHTML = "<span style='color:red'> 作廢</span>";}
}

//--></script>
<!-- 不更新網頁 檢查 select 欄位 課稅  營業稅率-->	
<script type="text/javascript"><!--       
 function seltax(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	  var selval = document.getElementById('tg017').selectedIndex;
	 //  alert(selval);
	   var oSpan = document.getElementById("taxdisp");
	  if (selval==0) {form.tg044.value=0.05;oSpan.innerHTML = "<span style='color:red'> 應稅外加</span>";}	    
      else if (selval==1){  form.tg044.value=0.05;oSpan.innerHTML = "<span style='color:red'> 應稅內含</span>";}
	  else {  form.tg044.value=0;oSpan.innerHTML = "<span style='color:red'> 不計稅</span>";}
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.bdate.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'bdate\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.bdate.focus(); return bdate;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.dateyy1.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'dateyy1\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.dateyy1.focus(); return dateyy1;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym2(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.ta034c.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'ta034c\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.ta034c.focus(); return ta034c;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym3(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.dateo.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'dateo\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.dateo.focus(); return dateo;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym7(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.datec.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'datec\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.datec.focus(); return datec;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym4(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.dateyymm.value=oInput.value.substring(0,4)+'-'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'dateyymm\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.dateyymm.focus(); return dateyymm;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym5(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.tc002o.value=oInput.value.substring(0,4)+'-'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'tc002o\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.tc002o.focus(); return tc002o;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ym 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataym6(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.tc002c.value=oInput.value.substring(0,4)+'-'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'tc002c\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.tc002c.focus(); return tc002c;}	
}

//--></script>
<script type="text/javascript"><!--       
 function dataym9(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.bdate.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6); 
		   var zstr=$('input[name=\'bdate\']').val();
		 //  alert(zstr.length);
		 
		if  ( zstr.length == 6 ) { 
		    document.form.bdate.focus(); return bdate;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.dateo.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'dateo\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.dateo.focus(); return dateo;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd1(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.datec.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'datec\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.datec.focus(); return datec;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd2(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.dateo1.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'dateo1\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.dateo1.focus(); return dateo1;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd3(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.datec1.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'datec1\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.datec1.focus(); return datec1;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd4(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.datemm1.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'datemm1\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.datemm1.focus(); return datemm1;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd5(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.ta034c.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'ta034c\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.ta034c.focus(); return ta034c;}	
}

//--></script>
<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd6(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.td002c.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'td002c\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.td002c.focus(); return td002c;}	
}

//--></script>

<!-- 不更新網頁 檢查 日期欄位ymd 自動輸入  +'/'+oInput.value.substring(6,8) -->	
<script type="text/javascript"><!--       
 function dataymd7(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.mc003.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mc003\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.mc003.focus(); return mc003;}	
}

//--></script>
<script type="text/javascript"><!--       
 function dataymd8(oInput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
	
		   document.form.mc0031.value=oInput.value.substring(0,4)+'/'+oInput.value.substring(4,6)+'/'+oInput.value.substring(6,8); 
		   var zstr=$('input[name=\'mc0031\']').val();
		 //  alert(zstr.length
		if  ( zstr.length == 8) { 
		    document.form.mc0031.focus(); return mc0031;}	
}

//--></script>
<!-- 開視年月 -->
<script type="text/javascript"><!--  
 function dateym(oInput){
$('.date-picker').datepicker( {
    changeMonth: true, 
    changeYear: true, 
    showButtonPanel: true, 
    dateFormat: 'yy/MM', 
	monthNames: ['01', '02', '03', '04', '05', '06',
            '07', '08', '09', '10', '11', '12'],
	monthNamesShort: ['01', '02', '03', '04', '05', '06',
            '07', '08', '09', '10', '11', '12'],
    onClose: function(dateText, inst) { 
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
        $(this).datepicker('setDate', new Date(year, month, 1)); 
    } 
});
 };
//--></script>

<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>


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

