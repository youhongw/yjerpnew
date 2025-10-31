<script type="text/javascript"> 	
//查詢訂單性質開視窗copi03 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showcopi03disp").click(function() {
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
				//console.log($('#copi03').val(ui.item.value1));
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
	$('#copi03').focus();
	//check_copi03(smb001);
	//console.log(smb001);
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
//不更新網頁 輸入直接跳出中文
function check_copi03(row_obj){
	var smb001= $('#copi03').val();
	if(!smb001){$('#copi03disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/cop/copi03/lookup2_copi03/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#copi03').val("");
					$('#copi03disp').text("查無資料");
				}
				$('#copi03').val(smb001);
				$('#copi03disp').text(data.message[0].value2);
			}else{
				$('#copi03').val(smb001);
				$('#copi03disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_copi03_window() {
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
		message: $('#divFcopi03'),
		onOverlayClick: clear_copi03disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFcopi03" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/cop/copi03/display_child/22" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
