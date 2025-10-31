<script type="text/javascript"> 	
//查詢訂單性質開視窗acri01 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacri01disp").click(function() {
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
		message: $('#divFacri01'),
		onOverlayClick: clear_acri01disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#acri01').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acri01').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/acr/acri01/lookup1_acri01/'+encodeURIComponent(smb001), 
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
				$('#acri01').val(ui.item.value1);
				$('#acri01disp').text(ui.item.value2);
				//console.log($('#acri01').val(ui.item.value1));
				return false;
			}else{
				$('#acri01disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addacri01disp(smb001,smb002){
	$('#acri01').val(smb001);
	$('#acri01disp').text(smb002);
	$('#acri01').focus();
	//check_acri01(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri01/clear_sql"
	}); 
}
function clear_acri01disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/acr/acri01/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_acri01(row_obj){
	var smb001= $('#acri01').val();
	if(!smb001){$('#acri01disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/acr/acri01/lookup1_acri01/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#acri01').val("");
					$('#acri01disp').text("查無資料");
				}
				$('#acri01').val(smb001);
				$('#acri01disp').text(data.message[0].value2);
			}else{
				$('#acri01').val(smb001);
				$('#acri01disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_acri01_window() {
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
		message: $('#divFacri01'),
		onOverlayClick: clear_acri01disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFacri01" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/acr/acri01/displaya_child/" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
