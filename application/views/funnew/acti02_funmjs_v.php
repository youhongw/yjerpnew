<script type="text/javascript"> 	
//查詢會計性質開視窗acti02 //下拉選單$('.close').click($.unblockUI);
$(document).ready(function(){
	$("#Showacti02disp").click(function() {
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
		message: $('#divFacti02'),
		onOverlayClick: clear_acti02disp_sql
	});
	  $('.close').click($.unblockUI);
	});
    $('#acti02').catcomplete({
        autoFocus: true,
		delay: 1000,
        minLength: 1,  		
		source:
		function(req, add){
			var smb001= $('#acti02').val();
			console.log(smb001);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/act/acti02/lookup1_acti02/'+encodeURIComponent(smb001), 
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
				$('#acti02').val(ui.item.value1);
				$('#acti02disp').text(ui.item.value2);
				//console.log($('#acti02').val(ui.item.value1));
				return false;
			}else{
				$('#acti02disp').text("查無資料");
				return false;
			}
			
		},
		focus: function(event, ui) {
			return false;
		}
	});
});
function addacti02disp(smb001,smb002){
	$('#acti02').val(smb001);
	$('#acti02disp').text(smb002);
	$('#acti02').focus();
	//check_acti02(smb001);
	//console.log(smb001);
  	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti02/clear_sql"
	}); 
}
function clear_acti02disp_sql(){
	$.unblockUI();
	 $.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/act/acti02/clear_sql"
	}); 
}
//不更新網頁 輸入直接跳出中文
function check_acti02(row_obj){
	var smb001= $('#acti02').val();
	if(!smb001){$('#acti02disp').text("");return;}
	$.ajax({
		url: '<?php echo base_url(); ?>index.php/act/acti02/lookup2_acti02/'+encodeURIComponent(smb001), 
		cache: false, 				
		dataType: 'json',  
		type: 'POST',  
		data: {mb001:row_obj.value},
		success:      
		function(data){
			if(data.response == "true"){
				if(data.message[0].value=="查無資料"){
					$('#acti02').val("");
					$('#acti02disp').text("查無資料");
				}
				$('#acti02').val(smb001);
				$('#acti02disp').text(data.message[0].value2);
			}else{
				$('#acti02').val(smb001);
				$('#acti02disp').text("查無資料");
			}
		}
	});
}
 //ondblclick 按2下開視窗
function search_acti02_window() {
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
		message: $('#divFacti02'),
		onOverlayClick: clear_acti02disp_sql
	});
	  $('.close').click($.unblockUI);
}  
</script>	   
<div id="divFacti02" style="display:none;width:100%;height:100%;">
<div style="float:right;"><input type="button" class="close" value="close" /></div> 
<iframe src="<?php echo base_url()?>index.php/act/acti02/display_child" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe> 	   
</div>
