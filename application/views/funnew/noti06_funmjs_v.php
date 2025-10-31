<script type="text/javascript"> 	
//查詢訂單性質開視窗noti06 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Shownoti06disp").click(function() {
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
		message: $('#divFnoti06'),
		onOverlayClick: clear_noti06disp_sql
	});
	  $('.close').click($.unblockUI);
	});
  /*  $('#noti06').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#noti06').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/not/noti06/lookup_catcomplete/'+encodeURIComponent(smb001), 
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
				$('#noti06').val(ui.item.value1);
				$('#noti06disp').text(ui.item.value2);
				//console.log($('#noti06').val(ui.item.value1));
				return false;
			}else{
				$('#noti06disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	}); */
});
function addnoti06disp(smb001,smb002){
	$('#noti06').val(smb001);
	$('#noti06disp').text(smb002);
	$('#noti06').focus();
	//check_noti06(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti06/clear_sql"
	}); 
}
function clear_noti06disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/not/noti06/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_noti06(row_obj){
	var smb001= $('#noti06').val();
	if(!smb001){$('#noti06disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/not/noti06/lookup_check/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#noti06').val("");
					$('#noti06disp').text("查無資料");
				}
				$('#noti06').val(smb001);
				$('#noti06disp').text(data.message[0].value2);
			}else{
				$('#noti06').val(smb001);
				$('#noti06disp').text("查無資料");
			}
		}
	});
}
   
</script>	   
<div id="divFnoti06" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/not/noti06/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>

