<script type="text/javascript"> 	
//查詢訂單性質開視窗invi04 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showinvi04disp").click(function() {
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
		message: $('#divFinvi04'),
		onOverlayClick: clear_invi04disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#invi04').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#invi04').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/inv/invi04/lookup1_invi04/'+encodeURIComponent(smb001), 
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
				$('#invi04').val(ui.item.value1);
				$('#invi04disp').text(ui.item.value2);
				//console.log($('#invi04').val(ui.item.value1));
				return false;
			}else{
				$('#invi04disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addinvi04disp(smb001,smb002){
	$('#invi04').val(smb001);
	$('#invi04disp').text(smb002);
	$('#invi04').focus();
	//check_invi04(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi04/clear_sql"
	}); 
}
function clear_invi04disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/inv/invi04/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_invi04(row_obj){
	var smb001= $('#invi04').val();
	if(!smb001){$('#invi04disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/inv/invi04/lookup2_invi04/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#invi04').val("");
					$('#invi04disp').text("查無資料");
				}
				$('#invi04').val(smb001);
				$('#invi04disp').text(data.message[0].value2);
			}else{
				$('#invi04').val(smb001);
				$('#invi04disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_invi04_window() {
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
		message: $('#divFinvi04'),
		onOverlayClick: clear_invi04disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFinvi04" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/inv/invi04/displayb_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
