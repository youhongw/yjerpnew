<script language="javascript"   >   //不更新網頁, 帶出資料按enter 自動找到名稱
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
function showcmsi03(sText){   //不更新網頁 6  庫別 
	var oSpan = document.getElementById("cmsi03disp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	      var cmsi03 = document.getElementById("cmsi03");
		  startcmsi03(cmsi03);		
	 }
	  if (sText=='') {
		  oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; }	
}

function startcmsi03(oInput){         //不更新網頁 6 庫別
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/cms/cmsi03/checkcmsi03/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		showcmsi03(xmlHttp.responseText);	}//顯示服務器結果	
	}
	//xmlHttp.send(null);
}
</script>	
<script type="text/javascript"> 	
//查詢庫別開視窗cmsi03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcmsi03disp").click(function() {
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
		message: $('#divFcmsi03'),
		onOverlayClick: clear_cmsi03disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#cmsi03').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#cmsi03').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/cms/cmsi03/lookup1_cmsi03/'+encodeURIComponent(smb001), 
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
				$('#cmsi03').val(ui.item.value1);
				$('#cmsi03disp').text(ui.item.value2);
				//console.log($('#cmsi03').val());
				return false;
			}else{
				$('#cmsi03disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addcmsi03disp(smb001,smb002){
	$('#cmsi03').val(smb001);
	$('#cmsi03disp').text(smb002);
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}
function clear_cmsi03disp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/cms/cmsi03/clear_sql"
	});
}

</script>	   
<div id="divFcmsi03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cms/cmsi03/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

