<script language="javascript"   >   //不更新網頁, 帶出資料按enter 自動找到名稱
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
function showcopi03(sText){   //不更新網頁 6  訂單性質 
	var oSpan = document.getElementById("copi03disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var copi03 = document.getElementById("copi03");
		  startcopi03(copi03);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}

function startcopi03(oInput){         //不更新網頁 6 訂單性質
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cop/copi03/checkcopi03/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showcopi03(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
</script>	

<script type="text/javascript"> 	
//查詢訂單性質開視窗copi03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcopi03disp").click(function() {
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
		message: $('#divFcopi03'),
		onOverlayClick: clear_copi03disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#copi03').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#copi03').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cop/copi03/lookup1_copi03/'+encodeURIComponent(smb001), 
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
				$('#copi03').val(ui.item.value1);
				$('#copi03disp').text(ui.item.value2);
				//console.log($('#copi03').val());
				return false;
			}else{
				$('#copi03disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addcopi03disp(smb001,smb002){
	$('#copi03').val(smb001);
	$('#copi03disp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi03/clear_sql"
	});
}
function clear_copi03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cop/copi03/clear_sql"
	});
}

</script>	   
<div id="divFcopi03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cop/copi03/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

