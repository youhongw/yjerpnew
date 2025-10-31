<script type="text/javascript"> 	
//查詢銀行代號開視窗noti01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Shownoti01adisp").click(function() {
	var sma001= $('#copi01').val();
	$('#noti01aframe').attr('src','<?php echo base_url()?>index.php/not/noti01/display_child2/'+sma001);
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
		message: $('#divFnoti01a'),
		onOverlayClick: clear_noti01adisp_sql
	});
	  $('.close').click($.unblockUI);
	});
	//autoFocus: true 改 false 1060704
    $('#noti01a').catcomplete({
        autoFocus: false,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#noti01a').val();
			var smb002= $('#copi01').val();
			$('#noti01a').attr('onchange','');
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/not/noti01/lookup1_noti01a/'+encodeURIComponent(smb001)+'/'+encodeURIComponent(smb002), 
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
				$('#noti01a').val(ui.item.value1);
				$('#noti01adisp').val(ui.item.value2);
				$('#noti01adisp2').val(ui.item.value3);
				//console.log($('#noti01').val());
				return false;
			}else{
				$('#noti01adisp').val("查無資料");
				$('#noti01adisp2').val("查無資料");
				return false;
			}
			
		},
		change: function(event, ui) {
			$('#noti01a').attr('onchange','check_noti01a(this)');
			check_noti01a($('#noti01a').val());
			return false;
		}
		//focus: function(event, ui) {
		//	return false;
		//}
	});
});
function addnoti01adisp(smb001,smb002 , smb003){
	//alert('test2');
	$('#noti01a').val(smb001);
	$('#noti01adisp').val(smb002);
	$('#noti01adisp2').val(smb003);
	$('#noti01').focus();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti01/clear_sql2"
	});
}
function clear_noti01adisp_sql(){
	$.unblockUI();
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti01/clear_sql2"
	});
}
//不更新網頁 輸入直接跳出中文
function check_noti01a(row_obj){
	var smb001= $('#noti01a').val();
	var smb002= $('#copi01').val();
	
	//if(!smb001){$('#noti01adisp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti01/lookup2_noti01a/'+encodeURIComponent(smb001) + '/' + encodeURIComponent(smb002), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#noti01a').val("");
					$('#noti01adisp').val("查無資料");
					$('#noti01adisp2').val("查無資料");
				}
				$('#noti01a').val(smb001);
				$('#noti01adisp').val(data.message[0].value2);
				$('#noti01adisp2').val(data.message[0].value3);
			}else{
				$('#noti01a').val(smb001);
				$('#noti01adisp').val("查無資料");
				$('#noti01adisp2').val("查無資料");
			}
		}
	});
}

</script>	   
<div id="divFnoti01a" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe id="noti01aframe" src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

